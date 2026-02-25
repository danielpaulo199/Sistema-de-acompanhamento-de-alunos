@extends('layouts.app')

@section('title', $aluno->nome)

@push('styles')
<style>
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        color: var(--verde);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 1.5rem;
        transition: gap 0.2s;
    }

    .back-link:hover { gap: 0.6rem; }

    /* PERFIL */
    .perfil-grid {
        display: grid;
        grid-template-columns: 320px 1fr;
        gap: 1.5rem;
        align-items: start;
    }

    @media (max-width: 900px) {
        .perfil-grid { grid-template-columns: 1fr; }
    }

    .perfil-card {
        background: white;
        border-radius: 20px;
        border: 1px solid var(--borda);
        box-shadow: var(--sombra);
        overflow: hidden;
        position: sticky;
        top: 80px;
    }

    .perfil-banner {
        height: 100px;
        background: linear-gradient(135deg, var(--verde), #40916C);
    }

    .perfil-avatar {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        border: 4px solid white;
        margin: -45px auto 0;
        position: relative;
        z-index: 1;
        overflow: hidden;
        background: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        display: block;
    }

    .perfil-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .perfil-initials {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Fraunces', serif;
        font-size: 2rem;
        font-weight: 700;
        color: white;
        background: linear-gradient(135deg, #52B788, #2D6A4F);
    }

    .perfil-info {
        padding: 1rem 1.5rem 1.5rem;
        text-align: center;
    }

    .perfil-nome {
        font-family: 'Fraunces', serif;
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--cinza-escuro);
        margin-bottom: 0.25rem;
    }

    .perfil-meta {
        font-size: 0.8rem;
        color: var(--cinza);
        margin-bottom: 1.25rem;
    }

    .perfil-counts {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
        margin-bottom: 1.25rem;
    }

    .count-box {
        padding: 0.75rem;
        border-radius: 12px;
        text-align: center;
    }

    .count-box-dif {
        background: var(--vermelho-claro);
    }

    .count-box-qual {
        background: var(--verde-menta);
    }

    .count-number {
        font-family: 'Fraunces', serif;
        font-size: 1.5rem;
        font-weight: 700;
        line-height: 1;
    }

    .count-box-dif .count-number { color: var(--vermelho); }
    .count-box-qual .count-number { color: var(--verde); }

    .count-label {
        font-size: 0.7rem;
        font-weight: 600;
        margin-top: 0.2rem;
    }

    .count-box-dif .count-label { color: var(--vermelho); }
    .count-box-qual .count-label { color: var(--verde); }

    .perfil-obs {
        background: var(--cinza-claro);
        border-radius: 12px;
        padding: 0.85rem 1rem;
        font-size: 0.85rem;
        color: var(--cinza);
        text-align: left;
        line-height: 1.5;
        margin-bottom: 1rem;
    }

    .perfil-acoes {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    /* SEÇÃO PRINCIPAL */
    .secao-titulo {
        font-family: 'Fraunces', serif;
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--cinza-escuro);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* CARACTERISTICA TAGS */
    .caract-section {
        margin-bottom: 1.5rem;
    }

    .caract-type-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .type-dificuldade { color: var(--vermelho); }
    .type-qualidade { color: var(--verde); }

    .caract-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.6rem;
    }

    .caract-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0.9rem;
        border-radius: 12px;
        font-size: 0.85rem;
        border: 1px solid transparent;
        position: relative;
    }

    .caract-tag-dif {
        background: var(--vermelho-claro);
        border-color: rgba(231,111,81,0.2);
        color: #6B2737;
    }

    .caract-tag-qual {
        background: var(--verde-menta);
        border-color: rgba(45,106,79,0.2);
        color: #1B4332;
    }

    .caract-tag-title { font-weight: 600; }

    .caract-tag-nivel {
        font-size: 0.7rem;
        padding: 0.1rem 0.4rem;
        border-radius: 8px;
        font-weight: 600;
    }

    .nivel-alto { background: rgba(231,111,81,0.3); color: var(--vermelho); }
    .nivel-medio { background: rgba(244,162,97,0.3); color: #B7791F; }
    .nivel-baixo { background: rgba(43,108,176,0.3); color: var(--azul); }

    .caract-delete-btn {
        background: none;
        border: none;
        cursor: pointer;
        color: rgba(0,0,0,0.3);
        font-size: 0.9rem;
        padding: 0;
        line-height: 1;
        transition: color 0.2s;
    }

    .caract-delete-btn:hover { color: var(--vermelho); }

    .empty-caract {
        color: var(--cinza);
        font-size: 0.85rem;
        font-style: italic;
        padding: 0.75rem;
        background: var(--cinza-claro);
        border-radius: 10px;
    }

    /* FORM ADD CARACTERISTICA */
    .form-add-card {
        background: white;
        border-radius: 16px;
        border: 1.5px dashed var(--borda);
        margin-bottom: 1.5rem;
        overflow: hidden;
    }

    .form-add-toggle {
        width: 100%;
        padding: 0.9rem 1.25rem;
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--verde);
        transition: background 0.2s;
    }

    .form-add-toggle:hover { background: var(--verde-bg); }

    .form-add-body {
        padding: 1.25rem;
        border-top: 1px solid var(--borda);
        display: none;
    }

    .form-add-body.open { display: block; }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    @media (max-width: 600px) {
        .form-row { grid-template-columns: 1fr; }
    }

    /* SUGESTÕES */
    .sugestoes-section {
        margin-top: 2rem;
    }

    .sugestao-categoria {
        margin-bottom: 1.5rem;
    }

    .sugestao-cat-header {
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--cinza);
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .sugestao-cat-header::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--borda);
    }

    .sugestoes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1rem;
    }

    .sugestao-card {
        background: white;
        border-radius: 14px;
        border: 1px solid var(--borda);
        box-shadow: var(--sombra);
        overflow: hidden;
        transition: box-shadow 0.2s;
    }

    .sugestao-card:hover {
        box-shadow: var(--sombra-md);
    }

    .sugestao-card-header {
        padding: 1rem 1.1rem 0.75rem;
        border-bottom: 1px solid var(--borda);
        background: linear-gradient(to right, var(--azul-claro), white);
    }

    .sugestao-titulo {
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--cinza-escuro);
        margin-bottom: 0.3rem;
    }

    .sugestao-meta {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .sugestao-duracao {
        font-size: 0.75rem;
        color: var(--cinza);
        display: flex;
        align-items: center;
        gap: 0.2rem;
    }

    .sugestao-body {
        padding: 1rem 1.1rem;
    }

    .sugestao-descricao {
        font-size: 0.85rem;
        color: var(--cinza);
        line-height: 1.5;
        margin-bottom: 0.75rem;
    }

    .sugestao-expandir {
        background: none;
        border: none;
        cursor: pointer;
        color: var(--azul);
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0;
        font-family: 'DM Sans', sans-serif;
        transition: opacity 0.2s;
    }

    .sugestao-expandir:hover { opacity: 0.7; }

    .sugestao-detalhes {
        display: none;
        margin-top: 0.75rem;
        padding-top: 0.75rem;
        border-top: 1px dashed var(--borda);
    }

    .sugestao-detalhes.open { display: block; }

    .detalhe-titulo {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: var(--cinza);
        margin-bottom: 0.3rem;
        margin-top: 0.75rem;
    }

    .detalhe-titulo:first-child { margin-top: 0; }

    .detalhe-texto {
        font-size: 0.82rem;
        color: var(--cinza-escuro);
        line-height: 1.6;
        white-space: pre-line;
    }

    .no-sugestoes {
        background: var(--cinza-claro);
        border-radius: 14px;
        padding: 2rem;
        text-align: center;
        color: var(--cinza);
        font-size: 0.9rem;
        border: 1px dashed var(--borda);
    }

    .tab-container {
        margin-bottom: 1.5rem;
    }

    .tabs {
        display: flex;
        gap: 0.5rem;
        background: var(--cinza-claro);
        padding: 0.4rem;
        border-radius: 12px;
        width: fit-content;
        margin-bottom: 1.25rem;
    }

    .tab-btn {
        padding: 0.5rem 1.1rem;
        border-radius: 9px;
        border: none;
        background: none;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--cinza);
        transition: all 0.2s;
    }

    .tab-btn.active {
        background: white;
        color: var(--verde);
        box-shadow: var(--sombra);
    }

    .tab-content { display: none; }
    .tab-content.active { display: block; }
</style>
@endpush

@section('content')
<a href="{{ route('alunos.index') }}" class="back-link">← Voltar à Turma</a>

<div class="perfil-grid">
    <!-- COLUNA ESQUERDA: PERFIL -->
    <div>
        <div class="perfil-card">
            <div class="perfil-banner"></div>
            <div class="perfil-avatar">
                @if($aluno->foto)
                    <img src="{{ asset('storage/' . $aluno->foto) }}" alt="{{ $aluno->nome }}">
                @else
                    <div class="perfil-initials">{{ $aluno->initials }}</div>
                @endif
            </div>
            <div class="perfil-info">
                <div class="perfil-nome">{{ $aluno->nome }}</div>
                <div class="perfil-meta">
                    @if($aluno->data_nascimento)
                        🎂 {{ $aluno->data_nascimento->format('d/m/Y') }}<br>
                    @endif
                    @if($aluno->turno)
                        🕒 Turno: {{ ucfirst($aluno->turno) }}<br>
                    @endif
                    @if($aluno->responsavel)
                        👤 {{ $aluno->responsavel }}<br>
                    @endif
                    @if($aluno->telefone_responsavel)
                        📱 {{ $aluno->telefone_responsavel }}
                    @endif
                </div>

                <div class="perfil-counts">
                    <div class="count-box count-box-dif">
                        <div class="count-number">{{ $aluno->dificuldades->count() }}</div>
                        <div class="count-label">Dificuldades</div>
                    </div>
                    <div class="count-box count-box-qual">
                        <div class="count-number">{{ $aluno->qualidades->count() }}</div>
                        <div class="count-label">Qualidades</div>
                    </div>
                </div>

                @if($aluno->observacoes)
                <div class="perfil-obs">
                    <strong>📝 Observações:</strong><br>{{ $aluno->observacoes }}
                </div>
                @endif

                <div class="perfil-acoes">
                    <a href="{{ route('alunos.edit', $aluno) }}" class="btn btn-secondary">✏️ Editar Perfil</a>
                    <form action="{{ route('alunos.destroy', $aluno) }}" method="POST"
                          onsubmit="return confirm('Tem certeza que deseja remover {{ $aluno->nome }}? Esta ação não pode ser desfeita.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="width:100%">🗑️ Remover Aluno</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- COLUNA DIREITA -->
    <div>
        <!-- ABAS -->
        <div class="tabs">
            <button class="tab-btn active" onclick="showTab('caracteristicas')">📋 Perfil de Aprendizagem</button>
            <button class="tab-btn" onclick="showTab('sugestoes')">💡 Sugestões de Atividades
                @if($sugestoesPorCategoria->count() > 0)
                    <span style="background:var(--verde);color:white;padding:0.1rem 0.45rem;border-radius:20px;font-size:0.7rem;margin-left:0.2rem;">
                        {{ $sugestoesPorCategoria->flatten()->count() }}
                    </span>
                @endif
            </button>
        </div>

        <!-- TAB: CARACTERÍSTICAS -->
        <div class="tab-content active" id="tab-caracteristicas">

            <!-- FORM ADD -->
            <div class="form-add-card">
                <button class="form-add-toggle" onclick="toggleForm()">
                    <span id="toggle-icon">➕</span> Adicionar Dificuldade ou Qualidade
                </button>
                <div class="form-add-body" id="form-add-body">
                    <form action="{{ route('alunos.caracteristicas.store', $aluno) }}" method="POST">
                        @csrf
                        <div class="form-row" style="margin-bottom:1rem">
                            <div class="form-group" style="margin:0">
                                <label class="form-label">Tipo *</label>
                                <select name="tipo" class="form-control" required onchange="updateTipoStyle(this)">
                                    <option value="">Selecione...</option>
                                    <option value="dificuldade">⚠️ Dificuldade</option>
                                    <option value="qualidade">⭐ Qualidade</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin:0">
                                <label class="form-label">Área / Categoria *</label>
                                <select name="categoria" class="form-control" required>
                                    <option value="">Selecione...</option>
                                    @foreach($categorias as $key => $label)
                                        <option value="{{ $key }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row" style="margin-bottom:1rem">
                            <div class="form-group" style="margin:0">
                                <label class="form-label">Título *</label>
                                <input type="text" name="titulo" class="form-control" placeholder="Ex: Dificuldade com sílabas complexas" required>
                            </div>
                            <div class="form-group" style="margin:0">
                                <label class="form-label">Nível</label>
                                <select name="nivel" class="form-control" required>
                                    <option value="baixo">🟦 Baixo</option>
                                    <option value="medio" selected>🟨 Médio</option>
                                    <option value="alto">🟥 Alto</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Descrição (opcional)</label>
                            <textarea name="descricao" class="form-control" rows="2"
                                placeholder="Detalhes sobre essa característica..."></textarea>
                        </div>
                        <div style="display:flex;gap:0.75rem;justify-content:flex-end">
                            <button type="button" class="btn btn-secondary btn-sm" onclick="toggleForm()">Cancelar</button>
                            <button type="submit" class="btn btn-primary btn-sm">✅ Salvar</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- DIFICULDADES -->
            <div class="caract-section">
                <div class="caract-type-header type-dificuldade">⚠️ Dificuldades</div>
                @if($aluno->dificuldades->count() > 0)
                <div class="caract-list">
                    @foreach($aluno->dificuldades as $d)
                    <div class="caract-tag caract-tag-dif" title="{{ $d->descricao }}">
                        <span class="caract-tag-title">{{ $d->titulo }}</span>
                        <span class="caract-tag-nivel nivel-{{ $d->nivel }}">
                            {{ ucfirst($d->nivel) }}
                        </span>
                        <form action="{{ route('alunos.caracteristicas.destroy', [$aluno, $d]) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="caract-delete-btn" title="Remover" onclick="return confirm('Remover esta característica?')">✕</button>
                        </form>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-caract">Nenhuma dificuldade cadastrada ainda.</div>
                @endif
            </div>

            <!-- QUALIDADES -->
            <div class="caract-section">
                <div class="caract-type-header type-qualidade">⭐ Qualidades e Pontos Fortes</div>
                @if($aluno->qualidades->count() > 0)
                <div class="caract-list">
                    @foreach($aluno->qualidades as $q)
                    <div class="caract-tag caract-tag-qual" title="{{ $q->descricao }}">
                        <span class="caract-tag-title">{{ $q->titulo }}</span>
                        <span class="caract-tag-nivel nivel-{{ $q->nivel }}">
                            {{ ucfirst($q->nivel) }}
                        </span>
                        <form action="{{ route('alunos.caracteristicas.destroy', [$aluno, $q]) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="caract-delete-btn" title="Remover" onclick="return confirm('Remover esta característica?')">✕</button>
                        </form>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-caract">Nenhuma qualidade cadastrada ainda.</div>
                @endif
            </div>
        </div>

        <!-- TAB: SUGESTÕES -->
        <div class="tab-content" id="tab-sugestoes">
            @if($aluno->dificuldades->count() === 0)
                <div class="no-sugestoes">
                    <div style="font-size:2.5rem;margin-bottom:0.75rem">💡</div>
                    <strong>Nenhuma dificuldade cadastrada ainda.</strong><br>
                    Adicione as dificuldades do aluno para receber sugestões de atividades personalizadas!
                </div>
            @elseif($sugestoesPorCategoria->count() === 0)
                <div class="no-sugestoes">
                    <div style="font-size:2.5rem;margin-bottom:0.75rem">🔍</div>
                    <strong>Nenhuma sugestão encontrada para as dificuldades cadastradas.</strong><br>
                    Verifique se as categorias estão mapeadas corretamente.
                </div>
            @else
                <div style="background:var(--azul-claro);border:1px solid rgba(43,108,176,0.2);border-radius:14px;padding:1rem 1.25rem;margin-bottom:1.5rem;font-size:0.88rem;color:#2B6CB0;">
                    💡 <strong>Sugestões baseadas nas dificuldades de {{ $aluno->nome }}.</strong>
                    Todas as atividades abaixo foram selecionadas especificamente para ajudar nessas áreas.
                </div>

                <div class="sugestoes-section">
                    @foreach($sugestoesPorCategoria as $categoria => $sugestoes)
                    <div class="sugestao-categoria">
                        <div class="sugestao-cat-header">
                            📚 {{ $categorias[$categoria] ?? ucfirst($categoria) }}
                        </div>
                        <div class="sugestoes-grid">
                            @foreach($sugestoes as $sugestao)
                            <div class="sugestao-card">
                                <div class="sugestao-card-header">
                                    <div class="sugestao-titulo">{{ $sugestao->titulo }}</div>
                                    <div class="sugestao-meta">
                                        @if($sugestao->duracao_minutos)
                                        <span class="sugestao-duracao">⏱️ {{ $sugestao->duracao_minutos }} min</span>
                                        @endif
                                        <span class="badge badge-nivel-{{ $sugestao->nivel_dificuldade }}">
                                            {{ ucfirst($sugestao->nivel_dificuldade) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="sugestao-body">
                                    <div class="sugestao-descricao">{{ $sugestao->descricao }}</div>
                                    <button class="sugestao-expandir" onclick="toggleDetalhes(this)">
                                        ▼ Ver detalhes completos
                                    </button>
                                    <div class="sugestao-detalhes">
                                        @if($sugestao->materiais)
                                        <div class="detalhe-titulo">📦 Materiais necessários</div>
                                        <div class="detalhe-texto">{{ $sugestao->materiais }}</div>
                                        @endif
                                        @if($sugestao->passo_a_passo)
                                        <div class="detalhe-titulo">🔢 Passo a passo</div>
                                        <div class="detalhe-texto">{{ $sugestao->passo_a_passo }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function showTab(tab) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
    document.getElementById('tab-' + tab).classList.add('active');
    event.target.classList.add('active');
}

function toggleForm() {
    const body = document.getElementById('form-add-body');
    const icon = document.getElementById('toggle-icon');
    body.classList.toggle('open');
    icon.textContent = body.classList.contains('open') ? '✕' : '➕';
}

function toggleDetalhes(btn) {
    const detalhes = btn.nextElementSibling;
    detalhes.classList.toggle('open');
    btn.textContent = detalhes.classList.contains('open') ? '▲ Fechar detalhes' : '▼ Ver detalhes completos';
}
</script>
@endpush
