@extends('layouts.app')

@section('title', 'Início — Profe Andressa')

@push('styles')
<style>
    .welcome-hero {
        background: linear-gradient(135deg, var(--verde) 0%, #40916C 100%);
        color: white;
        border-radius: 20px;
        padding: 1.75rem 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--sombra-md);
        border: 1px solid rgba(255,255,255,0.2);
    }
    .welcome-hero h1 {
        font-family: 'Fraunces', serif;
        font-size: 1.65rem;
        font-weight: 700;
        margin-bottom: 0.35rem;
        line-height:1.25;
    }
    .welcome-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem 1.75rem;
        margin-top: 1rem;
        font-size: 0.95rem;
        opacity: 0.95;
    }
    .welcome-meta span {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }
    .welcome-detalhe {
        margin-top: 1rem;
        padding: 0.9rem 1.1rem;
        background: rgba(255,255,255,0.12);
        border-radius: 12px;
        font-size: 0.95rem;
        line-height: 1.45;
    }
    .welcome-detalhe.destaque-planejamento {
        background: rgba(244, 162, 97, 0.35);
        border: 1px solid rgba(255,255,255,0.35);
    }
    .horarios-secao {
        margin-bottom: 2.5rem;
    }
    .horarios-secao-cabecalho {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }
    .horarios-secao-titulo {
        font-family: 'Fraunces', serif;
        font-size: 1.35rem;
        font-weight: 600;
        color: var(--cinza-escuro);
    }
    .horarios-secao-sub {
        color: var(--cinza);
        font-size: 0.88rem;
        margin-top: 0.2rem;
    }
    .tabela-horarios-wrap {
        overflow-x: auto;
        border-radius: 16px;
        border: 1px solid var(--borda);
        box-shadow: var(--sombra);
        background: white;
    }
    .tabela-horarios {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.78rem;
        min-width: 520px;
    }
    .tabela-horarios th, .tabela-horarios td {
        border: 1px solid var(--borda);
        padding: 0.45rem 0.35rem;
        text-align: center;
        vertical-align: middle;
    }
    .tabela-horarios th {
        background: var(--verde-bg);
        font-weight: 600;
        color: var(--verde);
        font-size: 0.72rem;
    }
    .tabela-horarios th:first-child, .tabela-horarios td.cel-hora {
        background: var(--cinza-claro);
        font-weight: 600;
        color: var(--cinza);
        white-space: nowrap;
        font-size: 0.68rem;
    }
    .tabela-horarios td.cel-mat {
        max-width: 110px;
        line-height: 1.25;
    }
    .cel-planejamento {
        background: var(--amarelo-claro);
        color: #8B5A00;
        font-weight: 600;
    }
    .cel-vazio {
        color: #A0AEC0;
        font-style: italic;
    }
    .cel-agora {
        outline: 2px solid var(--verde);
        outline-offset: -2px;
        box-shadow: inset 0 0 0 1px var(--verde-claro);
    }
    .badge-horario-planejamento {
        display: inline-block;
        margin-top: 0.15rem;
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: var(--amarelo);
        opacity: 0.95;
    }
    .sec-matutino .horarios-secao-titulo { color: var(--verde); }
    .sec-vespertino .horarios-secao-titulo { color: #B7791F; }
</style>
@endpush

@section('content')
@php
    $diasNomes = [1=>'Seg.',2=>'Ter.',3=>'Qua.',4=>'Qui.',5=>'Sex.'];
@endphp

<div class="welcome-hero">
    <h1>{{ $ctx['saudacao'] }}, Andressa!</h1>
    <p style="opacity:0.92;font-size:1rem;">Hoje é {{ $ctx['nome_dia'] }}.</p>
    <div class="welcome-meta">
        <span>🕐 <strong id="relogio-vivo">{{ $ctx['hora_atual'] }}</strong></span>
        @if($ctx['eh_dia_letivo'] && $ctx['turno_ativo'] && $ctx['ordem_aula_atual'] && $ctx['faixa_horario_atual'])
            <span>📖 {{ $ctx['ordem_aula_atual'] }}ª aula ({{ $ctx['faixa_horario_atual'] }}) — turno {{ $ctx['turno_ativo'] === 'matutino' ? 'matutino' : 'vespertino' }}</span>
        @elseif($ctx['intervalo_entre_turnos'])
            <span>☕ Intervalo entre turnos</span>
        @endif
    </div>
    @if($ctx['mensagem_detalhe_aula'])
    <div class="welcome-detalhe {{ $ctx['aula_atual_eh_planejamento'] ? 'destaque-planejamento' : '' }}">
        {{ $ctx['mensagem_detalhe_aula'] }}
        @if($ctx['aula_atual_eh_planejamento'])
            <div class="badge-horario-planejamento">Tempo de planejamento</div>
        @endif
    </div>
    @endif
</div>

@foreach(['matutino' => ['🌅 Turno matutino', 'sec-matutino', $horariosMatutino], 'vespertino' => ['🌆 Turno vespertino', 'sec-vespertino', $horariosVespertino]] as $turnoKey => $meta)
<div class="horarios-secao {{ $meta[1] }}">
    <div class="horarios-secao-cabecalho">
        <div>
            <h3 class="horarios-secao-titulo">{{ $meta[0] }}</h3>
        </div>
    </div>
    <div class="tabela-horarios-wrap">
        <table class="tabela-horarios">
            <thead>
                <tr>
                    <th>Aula</th>
                    @foreach(range(1,5) as $d)
                        <th>{{ $diasNomes[$d] }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
            @foreach(range(1,5) as $ordem)
                @php
                    $h = $meta[2][$ordem];
                    $linhaHora = $h['inicio'].'–'.$h['fim'];
                @endphp
                <tr>
                    <td class="cel-hora">{{ $ordem }}ª<br><span style="font-weight:500;font-size:0.62rem;">{{ $linhaHora }}</span></td>
                    @foreach(range(1,5) as $dia)
                        @php
                            $cel = $quadro[$turnoKey][$dia][$ordem] ?? null;
                            $cod = $cel !== null ? $cel->materia_codigo : null;
                            $label = \App\Services\HorariosService::labelMateria($cod);
                            $pl = \App\Services\HorariosService::ehPlanejamento($cod);
                            $ehAgora = $ctx['eh_dia_letivo']
                                && $ctx['turno_ativo'] === $turnoKey
                                && (int)$ctx['dia_iso'] === $dia
                                && (int)$ctx['ordem_aula_atual'] === $ordem;
                        @endphp
                        <td class="cel-mat {{ $pl ? 'cel-planejamento' : '' }} {{ !$label ? 'cel-vazio' : '' }} {{ $ehAgora ? 'cel-agora' : '' }}">
                            @if($label)
                                {{ $label }}
                                @if($pl)<span class="badge-horario-planejamento">Plan.</span>@endif
                            @else
                                —
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endforeach

<div style="text-align:center;margin:2rem 0;">
    <a href="{{ route('alunos.index') }}" class="btn btn-secondary">Ver alunos da turma →</a>
</div>
@endsection

@push('scripts')
<script>
(function(){
    function tick(){
        var el = document.getElementById('relogio-vivo');
        if(!el) return;
        var now = new Date();
        var h = String(now.getHours()).padStart(2,'0');
        var m = String(now.getMinutes()).padStart(2,'0');
        el.textContent = h + ':' + m;
    }
    tick();
    setInterval(tick, 1000);
})();
</script>
@endpush
