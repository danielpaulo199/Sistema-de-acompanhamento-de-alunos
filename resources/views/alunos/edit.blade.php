@extends('layouts.app')

@section('title', 'Editar — ' . $aluno->nome)

@push('styles')
<style>
    .form-card {
        background: white;
        border-radius: 20px;
        border: 1px solid var(--borda);
        box-shadow: var(--sombra-md);
        max-width: 700px;
        margin: 0 auto;
        overflow: hidden;
    }

    .form-card-header {
        background: linear-gradient(135deg, #2B6CB0, #4299E1);
        padding: 2rem;
        color: white;
    }

    .form-card-title {
        font-family: 'Fraunces', serif;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .form-card-body { padding: 2rem; }

    .section-divider {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--cinza);
        margin: 1.75rem 0 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--borda);
    }

    .foto-preview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: var(--cinza-claro);
        border: 2px dashed var(--borda);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        cursor: pointer;
        margin-bottom: 0.5rem;
        overflow: hidden;
    }

    .foto-preview img { width: 100%; height: 100%; object-fit: cover; }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--borda);
        margin-top: 1.5rem;
    }
</style>
@endpush

@section('content')
<a href="{{ route('alunos.show', $aluno) }}" class="back-link">← Voltar ao Perfil</a>

<div class="form-card">
    <div class="form-card-header">
        <div class="form-card-title">✏️ Editar Aluno</div>
        <div class="form-card-subtitle">{{ $aluno->nome }}</div>
    </div>

    <div class="form-card-body">
        @if($errors->any())
            <div class="alert alert-error">⚠️ Por favor, corrija os erros abaixo.</div>
        @endif

        <form action="{{ route('alunos.update', $aluno) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="display:flex;align-items:center;gap:1.5rem;margin-bottom:1rem">
                <div>
                    <label for="foto" style="cursor:pointer">
                        <div class="foto-preview" id="fotoPreview">
                            @if($aluno->foto)
                                <img src="{{ asset('storage/' . $aluno->foto) }}" alt="{{ $aluno->nome }}">
                            @else
                                {{ $aluno->initials }}
                            @endif
                        </div>
                    </label>
                    <div style="font-size:0.75rem;color:var(--cinza);text-align:center">Clique para alterar</div>
                    <input type="file" id="foto" name="foto" accept="image/*" style="display:none" onchange="previewFoto(this)">
                </div>
                <div style="flex:1">
                    <div class="form-group">
                        <label class="form-label">Nome Completo *</label>
                        <input type="text" name="nome" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}"
                            value="{{ old('nome', $aluno->nome) }}" required>
                        @error('nome') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <div class="section-divider">Informações Pessoais</div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" class="form-control"
                        value="{{ old('data_nascimento', $aluno->data_nascimento->format('Y-m-d')) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Turno *</label>
                    <select name="turno" class="form-control {{ $errors->has('turno') ? 'is-invalid' : '' }}" required>
                        <option value="">Selecione...</option>
                        <option value="matutino" {{ old('turno', $aluno->turno) === 'matutino' ? 'selected' : '' }}>Matutino</option>
                        <option value="vespertino" {{ old('turno', $aluno->turno) === 'vespertino' ? 'selected' : '' }}>Vespertino</option>
                    </select>
                    @error('turno') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="section-divider">Responsável</div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Nome do Responsável</label>
                    <input type="text" name="responsavel" class="form-control"
                        value="{{ old('responsavel', $aluno->responsavel) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Telefone</label>
                    <input type="text" name="telefone_responsavel" class="form-control"
                        value="{{ old('telefone_responsavel', $aluno->telefone_responsavel) }}">
                </div>
            </div>

            <div class="section-divider">Observações</div>

            <div class="form-group">
                <label class="form-label">Observações Gerais</label>
                <textarea name="observacoes" class="form-control" rows="3">{{ old('observacoes', $aluno->observacoes) }}</textarea>
            </div>

            <div class="form-actions">
                <a href="{{ route('alunos.show', $aluno) }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">💾 Salvar Alterações</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewFoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('fotoPreview');
            preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
