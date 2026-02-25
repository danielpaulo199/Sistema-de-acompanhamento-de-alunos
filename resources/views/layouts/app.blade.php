<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Profe Andressa') — Acompanhamento de Alunos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;0,9..144,700;1,9..144,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --verde: #2D6A4F;
            --verde-claro: #52B788;
            --verde-menta: #B7E4C7;
            --verde-bg: #F0FDF4;
            --amarelo: #F4A261;
            --amarelo-claro: #FFF3CD;
            --vermelho: #E76F51;
            --vermelho-claro: #FDECEA;
            --azul: #2B6CB0;
            --azul-claro: #EBF8FF;
            --cinza-escuro: #1A202C;
            --cinza: #4A5568;
            --cinza-claro: #F7FAFC;
            --borda: #E2E8F0;
            --branco: #FFFFFF;
            --sombra: 0 1px 3px rgba(0,0,0,0.08), 0 1px 2px rgba(0,0,0,0.04);
            --sombra-md: 0 4px 6px rgba(0,0,0,0.07), 0 2px 4px rgba(0,0,0,0.04);
            --sombra-lg: 0 10px 15px rgba(0,0,0,0.08), 0 4px 6px rgba(0,0,0,0.04);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #F4F7F4;
            color: var(--cinza-escuro);
            min-height: 100vh;
        }

        /* NAVBAR */
        .navbar {
            background: var(--verde);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
            box-shadow: 0 2px 8px rgba(45,106,79,0.25);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }

        .navbar-logo {
            width: 36px;
            height: 36px;
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .navbar-title {
            font-family: 'Fraunces', serif;
            font-size: 1.2rem;
            font-weight: 600;
            color: white;
            line-height: 1.2;
        }

        .navbar-subtitle {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.7);
            font-weight: 400;
        }

        .navbar-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-nav {
            background: rgba(255,255,255,0.15);
            color: white;
            border: 1px solid rgba(255,255,255,0.25);
            padding: 0.4rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .btn-nav:hover {
            background: rgba(255,255,255,0.25);
            color: white;
        }

        /* MAIN */
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1.5rem;
        }

        /* PAGE HEADER */
        .page-header {
            margin-bottom: 2rem;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            font-family: 'Fraunces', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--verde);
            line-height: 1.2;
        }

        .page-subtitle {
            color: var(--cinza);
            margin-top: 0.3rem;
            font-size: 0.95rem;
        }

        /* BUTTONS */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.55rem 1.2rem;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-primary {
            background: var(--verde);
            color: white;
            box-shadow: 0 2px 6px rgba(45,106,79,0.3);
        }

        .btn-primary:hover {
            background: #235e43;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(45,106,79,0.35);
        }

        .btn-secondary {
            background: white;
            color: var(--cinza-escuro);
            border: 1px solid var(--borda);
            box-shadow: var(--sombra);
        }

        .btn-secondary:hover {
            background: var(--cinza-claro);
            border-color: #CBD5E0;
        }

        .btn-danger {
            background: var(--vermelho);
            color: white;
        }

        .btn-danger:hover {
            background: #d05a3d;
        }

        .btn-sm {
            padding: 0.3rem 0.7rem;
            font-size: 0.8rem;
            border-radius: 7px;
        }

        /* CARDS */
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: var(--sombra);
            border: 1px solid var(--borda);
            overflow: hidden;
        }

        .card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--borda);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-title {
            font-family: 'Fraunces', serif;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--cinza-escuro);
        }

        .card-body {
            padding: 1.5rem;
        }

        /* FORMS */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--cinza);
            margin-bottom: 0.4rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .form-control {
            width: 100%;
            padding: 0.65rem 0.9rem;
            border: 1.5px solid var(--borda);
            border-radius: 10px;
            font-size: 0.9rem;
            color: var(--cinza-escuro);
            background: white;
            font-family: 'DM Sans', sans-serif;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--verde-claro);
            box-shadow: 0 0 0 3px rgba(82,183,136,0.15);
        }

        .form-control.is-invalid {
            border-color: var(--vermelho);
        }

        .invalid-feedback {
            font-size: 0.8rem;
            color: var(--vermelho);
            margin-top: 0.3rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        @media (max-width: 640px) {
            .form-grid { grid-template-columns: 1fr; }
        }

        /* ALERTS */
        .alert {
            padding: 0.9rem 1.2rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .alert-success {
            background: var(--verde-menta);
            color: var(--verde);
            border: 1px solid rgba(45,106,79,0.2);
        }

        .alert-error {
            background: var(--vermelho-claro);
            color: var(--vermelho);
            border: 1px solid rgba(231,111,81,0.2);
        }

        /* BADGE */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.2rem 0.65rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-dificuldade {
            background: var(--vermelho-claro);
            color: var(--vermelho);
        }

        .badge-qualidade {
            background: var(--verde-menta);
            color: var(--verde);
        }

        .badge-nivel-baixo {
            background: #EBF8FF;
            color: #2B6CB0;
        }

        .badge-nivel-medio {
            background: var(--amarelo-claro);
            color: #B7791F;
        }

        .badge-nivel-alto {
            background: var(--vermelho-claro);
            color: var(--vermelho);
        }

        /* FOOTER */
        footer {
            text-align: center;
            padding: 2rem;
            color: #A0AEC0;
            font-size: 0.8rem;
        }
    </style>
    @stack('styles')
</head>
<body>

<nav class="navbar">
    <a href="{{ route('alunos.index') }}" class="navbar-brand">
        <div class="navbar-logo">📚</div>
        <div>
            <div class="navbar-title">Profe Andressa</div>
            <div class="navbar-subtitle">Acompanhamento de Alunos</div>
        </div>
    </a>
    <div class="navbar-actions">
        <a href="{{ route('alunos.index') }}" class="btn-nav">🏠 Turma</a>
        <a href="{{ route('alunos.create') }}" class="btn-nav">+ Novo Aluno</a>
    </div>
</nav>

<div class="main-container">
    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">⚠️ {{ session('error') }}</div>
    @endif

    @yield('content')
</div>

<footer>
    Sistema de Acompanhamento de Alunos — Made by Daniel Paulo ❤️
</footer>

@stack('scripts')
</body>
</html>
