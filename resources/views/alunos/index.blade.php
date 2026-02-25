@extends('layouts.app')

@section('title', 'Profe Andressa')

@push('styles')
<style>
    .turma-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 1.25rem 1.5rem;
        border: 1px solid var(--borda);
        box-shadow: var(--sombra);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }

    .stat-icon-green { background: var(--verde-menta); }
    .stat-icon-yellow { background: var(--amarelo-claro); }
    .stat-icon-red { background: var(--vermelho-claro); }

    .stat-number {
        font-family: 'Fraunces', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--cinza-escuro);
        line-height: 1;
    }

    .stat-label {
        font-size: 0.8rem;
        color: var(--cinza);
        margin-top: 0.2rem;
        font-weight: 500;
    }

    /* GRID DE ALUNOS */
    .alunos-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1.25rem;
    }

    .aluno-card {
        background: white;
        border-radius: 18px;
        border: 1px solid var(--borda);
        box-shadow: var(--sombra);
        overflow: hidden;
        transition: all 0.25s;
        text-decoration: none;
        color: inherit;
        display: block;
        cursor: pointer;
    }

    .aluno-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--sombra-lg);
        border-color: var(--verde-claro);
    }

    .aluno-card-top {
        height: 80px;
        background: linear-gradient(135deg, var(--verde), #40916C);
        position: relative;
    }

    .aluno-avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        border: 3px solid white;
        position: absolute;
        bottom: -35px;
        left: 50%;
        transform: translateX(-50%);
        overflow: hidden;
        background: white;
        box-shadow: 0 3px 10px rgba(0,0,0,0.15);
    }

    .aluno-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .aluno-initials {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Fraunces', serif;
        font-size: 1.4rem;
        font-weight: 700;
        color: white;
        background: linear-gradient(135deg, #52B788, #2D6A4F);
    }

    .aluno-card-body {
        padding: 2.5rem 1.25rem 1.25rem;
        text-align: center;
    }

    .aluno-nome {
        font-family: 'Fraunces', serif;
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--cinza-escuro);
        margin-bottom: 0.75rem;
    }

    .aluno-stats {
        display: flex;
        justify-content: center;
        gap: 0.75rem;
    }

    .aluno-stat-pill {
        display: flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.25rem 0.65rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .pill-dificuldade {
        background: var(--vermelho-claro);
        color: var(--vermelho);
    }

    .pill-qualidade {
        background: var(--verde-menta);
        color: var(--verde);
    }

    .aluno-card-footer {
        padding: 0.75rem 1.25rem;
        border-top: 1px solid var(--borda);
        text-align: center;
        font-size: 0.8rem;
        color: var(--verde);
        font-weight: 500;
        background: var(--verde-bg);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.3rem;
    }

    /* EMPTY STATE */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 20px;
        border: 2px dashed var(--borda);
    }

    .empty-state-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
    }

    .empty-state h2 {
        font-family: 'Fraunces', serif;
        font-size: 1.5rem;
        color: var(--cinza-escuro);
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: var(--cinza);
        margin-bottom: 1.5rem;
    }

    @media (max-width: 640px) {
        .turma-stats { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Minha Turma</h1>
        <p class="page-subtitle">Clique em um aluno para ver o perfil completo e sugestões de atividades</p>
    </div>
    <a href="{{ route('alunos.create') }}" class="btn btn-primary">
        ➕ Cadastrar Aluno
    </a>
</div>

@if($alunos->count() > 0)
<div class="turma-stats">
    <div class="stat-card">
        <div class="stat-icon stat-icon-green">👥</div>
        <div>
            <div class="stat-number">{{ $alunos->count() }}</div>
            <div class="stat-label">Alunos cadastrados</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon-yellow">⚠️</div>
        <div>
            <div class="stat-number">{{ $alunos->sum('dificuldades_count') }}</div>
            <div class="stat-label">Dificuldades registradas</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon-red">⭐</div>
        <div>
            <div class="stat-number">{{ $alunos->sum('qualidades_count') }}</div>
            <div class="stat-label">Qualidades registradas</div>
        </div>
    </div>
</div>

<div class="alunos-grid">
    @foreach($alunos as $aluno)
    <a href="{{ route('alunos.show', $aluno) }}" class="aluno-card">
        <div class="aluno-card-top">
            <div class="aluno-avatar">
                @if($aluno->foto)
                    <img src="{{ asset('storage/' . $aluno->foto) }}" alt="{{ $aluno->nome }}">
                @else
                    <div class="aluno-initials">{{ $aluno->initials }}</div>
                @endif
            </div>
        </div>
        <div class="aluno-card-body">
            <div class="aluno-nome">{{ $aluno->nome }}</div>
            <div class="aluno-stats">
                <div class="aluno-stat-pill pill-dificuldade">
                    ⚠️ {{ $aluno->dificuldades_count }} dificuldade{{ $aluno->dificuldades_count != 1 ? 's' : '' }}
                </div>
                <div class="aluno-stat-pill pill-qualidade">
                    ⭐ {{ $aluno->qualidades_count }} qualidade{{ $aluno->qualidades_count != 1 ? 's' : '' }}
                </div>
                @if($aluno->turno)
                    <div class="aluno-stat-pill" style="background: var(--azul-claro); color: var(--azul);">
                        🕒 {{ ucfirst($aluno->turno) }}
                    </div>
                @endif
            </div>
        </div>
        <div class="aluno-card-footer">
            Ver perfil completo →
        </div>
    </a>
    @endforeach
</div>

@else
<div class="empty-state">
    <div class="empty-state-icon">🎒</div>
    <h2>Nenhum aluno cadastrado ainda</h2>
    <p>Comece cadastrando os alunos da sua turma do 5º ano.</p>
    <a href="{{ route('alunos.create') }}" class="btn btn-primary">
        ➕ Cadastrar Primeiro Aluno
    </a>
</div>
@endif
@endsection
