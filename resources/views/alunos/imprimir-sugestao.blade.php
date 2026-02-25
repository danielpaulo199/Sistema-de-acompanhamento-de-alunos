<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atividade para {{ $aluno->nome }}</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #ffffff;
            color: #1f2933;
            margin: 0;
            padding: 2rem;
        }
        .page {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
            border: 1px solid #ddd;
        }
        h1 {
            font-size: 1.6rem;
            margin-bottom: 0.25rem;
        }
        .aluno-nome {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }
        .atividade-titulo {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }
        .label {
            font-weight: 600;
            margin-top: 1rem;
            margin-bottom: 0.25rem;
        }
        .texto {
            border: 1px solid #ddd;
            padding: 0.75rem;
            min-height: 60px;
            white-space: pre-line;
        }
        .rodape {
            margin-top: 2rem;
            font-size: 0.8rem;
            color: #707683;
            display: flex;
            justify-content: space-between;
        }
        @media print {
            body {
                padding: 0;
            }
            .page {
                border: none;
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="page">
        <h1>Atividade Personalizada</h1>
        <div class="aluno-nome">
            Aluno(a): <strong>{{ $aluno->nome }}</strong>
            @if($aluno->turno)
                — Turno: {{ ucfirst($aluno->turno) }}
            @endif
        </div>

        <div class="atividade-titulo">{{ $sugestao->titulo }}</div>

        @if($sugestao->descricao)
            <div class="label">Descrição / Enunciado:</div>
            <div class="texto">{{ $sugestao->descricao }}</div>
        @endif

        @if($sugestao->materiais)
            <div class="label">Materiais necessários:</div>
            <div class="texto">{{ $sugestao->materiais }}</div>
        @endif

        @if($sugestao->passo_a_passo)
            <div class="label">Passo a passo / Orientações:</div>
            <div class="texto">{{ $sugestao->passo_a_passo }}</div>
        @endif

        <div class="rodape">
            <span>Data: ______ / ______ / ______</span>
            <span>Assinatura do(a) responsável: __________________________</span>
        </div>
    </div>
</body>
</html>

