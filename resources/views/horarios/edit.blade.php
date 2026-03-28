@extends('layouts.app')

@section('title', 'Editar horários — Profe Andressa')

@push('styles')
<style>
    .horarios-edit-intro { max-width: 720px; margin-bottom: 1.5rem; color: var(--cinza); line-height: 1.5; }
    .horarios-form-section { margin-bottom: 2.5rem; }
    .horarios-form-section h2 {
        font-family: 'Fraunces', serif;
        font-size: 1.25rem;
        margin-bottom: 0.75rem;
        color: var(--cinza-escuro);
    }
    .tabela-edit-wrap { overflow-x: auto; border-radius: 16px; border: 1px solid var(--borda); background: white; box-shadow: var(--sombra); }
    .tabela-edit { width: 100%; border-collapse: collapse; min-width: 640px; font-size: 0.8rem; }
    .tabela-edit th, .tabela-edit td { border: 1px solid var(--borda); padding: 0.35rem; }
    .tabela-edit th { background: var(--verde-bg); color: var(--verde); font-weight: 600; font-size: 0.72rem; }
    .tabela-edit td.cel-hora { background: var(--cinza-claro); font-weight: 600; font-size: 0.68rem; white-space: nowrap; }
    .tabela-edit select {
        width: 100%;
        max-width: 140px;
        padding: 0.35rem 0.25rem;
        border-radius: 8px;
        border: 1px solid var(--borda);
        font-family: inherit;
        font-size: 0.75rem;
        background: white;
    }
    .tabela-edit select.opt-planejamento { border-color: var(--amarelo); background: #FFFBF0; }
    .legenda-planejamento {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.8rem;
        margin-top: 0.5rem;
        padding: 0.35rem 0.65rem;
        background: var(--amarelo-claro);
        border-radius: 8px;
        color: #8B5A00;
    }
    .horarios-form-actions { margin-top: 1.5rem; display: flex; gap: 0.75rem; flex-wrap: wrap; }
</style>
@endpush

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Editar horários das turmas</h1>
        <p class="page-subtitle">Matutino e vespertino — segunda a sexta, 5 aulas por dia.</p>
    </div>
    <a href="{{ route('home') }}" class="btn btn-secondary">← Voltar ao início</a>
</div>

<p class="horarios-edit-intro">
    As disciplinas de <strong>Educação Física</strong>, <strong>Ensino Religioso</strong>, <strong>Educação financeira</strong>, <strong>Inglês</strong> e <strong>Artes</strong> são ministradas por outros professores: na visualização da home elas aparecem em destaque como tempo de planejamento para você.
</p>

<form action="{{ route('horarios.update') }}" method="post">
    @csrf
    @method('PUT')

    @foreach(['matutino' => ['Turno matutino', $horariosMatutino], 'vespertino' => ['Turno vespertino', $horariosVespertino]] as $turnoKey => $pack)
    <div class="horarios-form-section">
        <h2>{{ $turnoKey === 'matutino' ? '🌅' : '🌆' }} {{ $pack[0] }}</h2>
        <div class="legenda-planejamento">📌 No formulário, matérias de planejamento aparecem com fundo amarelo na lista.</div>
        <div class="tabela-edit-wrap" style="margin-top:1rem;">
            <table class="tabela-edit">
                <thead>
                    <tr>
                        <th>Aula / horário</th>
                        @foreach([1=>'Seg.',2=>'Ter.',3=>'Qua.',4=>'Qui.',5=>'Sex.'] as $d => $lab)
                            <th>{{ $lab }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                @foreach(range(1,5) as $ordem)
                    @php $h = $pack[1][$ordem]; @endphp
                    <tr>
                        <td class="cel-hora">{{ $ordem }}ª · {{ $h['inicio'] }}–{{ $h['fim'] }}</td>
                        @foreach(range(1,5) as $dia)
                            @php
                                $cel = $quadro[$turnoKey][$dia][$ordem] ?? null;
                                $val = ($cel !== null ? $cel->materia_codigo : null) ?? '';
                            @endphp
                            <td>
                                <select name="horarios[{{ $turnoKey }}][{{ $dia }}][{{ $ordem }}]" class="{{ $val && \App\Services\HorariosService::ehPlanejamento($val) ? 'opt-planejamento' : '' }}">
                                    <option value="">— Selecione —</option>
                                    @foreach($materias as $codigo => $nom)
                                        <option value="{{ $codigo }}" {{ $val === $codigo ? 'selected' : '' }} class="{{ \App\Services\HorariosService::ehPlanejamento($codigo) ? 'opt-planejamento' : '' }}">{{ $nom }}</option>
                                    @endforeach
                                </select>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endforeach

    <div class="horarios-form-actions">
        <button type="submit" class="btn btn-primary">Salvar horários</button>
        <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
@endsection
