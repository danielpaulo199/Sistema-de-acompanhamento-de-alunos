<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Caracteristica;
use App\Models\SugestaoAtividade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlunoController extends Controller
{
    public function index()
    {
        $alunos = Aluno::withCount(['dificuldades', 'qualidades'])->orderBy('nome')->get();
        $alunosMatutino = $alunos->where('turno', 'matutino')->values();
        $alunosVespertino = $alunos->where('turno', 'vespertino')->values();
        $alunosSemTurno = $alunos->whereNull('turno')->values();
        return view('alunos.index', compact('alunos', 'alunosMatutino', 'alunosVespertino', 'alunosSemTurno'));
    }

    public function create()
    {
        return view('alunos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'data_nascimento' => 'nullable|date',
            'turno' => 'required|in:matutino,vespertino',
            'responsavel' => 'nullable|string|max:255',
            'telefone_responsavel' => 'nullable|string|max:20',
            'observacoes' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $aluno = Aluno::create($validated);

        return redirect()->route('alunos.show', $aluno)->with('success', 'Aluno cadastrado com sucesso!');
    }

    public function show(Aluno $aluno)
    {
        $aluno->load(['dificuldades', 'qualidades']);

        // Buscar sugestões baseadas nas categorias de dificuldades
        $categoriasDificuldades = $aluno->dificuldades->pluck('categoria')->unique();
        $sugestoes = SugestaoAtividade::whereIn('categoria', $categoriasDificuldades)->get();

        // Agrupar sugestões por categoria
        $sugestoesPorCategoria = $sugestoes->groupBy('categoria');

        $categorias = $this->getCategorias();

        return view('alunos.show', compact('aluno', 'sugestoesPorCategoria', 'categorias'));
    }

    public function edit(Aluno $aluno)
    {
        return view('alunos.edit', compact('aluno'));
    }

    public function update(Request $request, Aluno $aluno)
    {
//        dd([
//            'hasFile' => $request->hasFile('foto'),
//            'file' => $request->file('foto'),
//            'all' => $request->all(),
//        ]);
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'data_nascimento' => 'nullable|date',
            'responsavel' => 'nullable|string|max:255',
            'telefone_responsavel' => 'nullable|string|max:20',
            'turno' => 'required|in:matutino,vespertino',
            'observacoes' => 'nullable|string',
            'foto'=> "image|nullable"
        ]);

        if ($request->hasFile('foto')) {
            if ($aluno->foto) {
                Storage::disk('public')->delete($aluno->foto);
            }

            $validated['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $aluno->update($validated);

        return redirect()->route('alunos.show', $aluno)->with('success', 'Aluno atualizado com sucesso!');
    }

    public function destroy(Aluno $aluno)
    {
        if ($aluno->foto) {
            Storage::disk('public')->delete($aluno->foto);
        }
        $aluno->delete();

        return redirect()->route('alunos.index')->with('success', 'Aluno removido com sucesso!');
    }

    public function storeCaracteristica(Request $request, Aluno $aluno)
    {
        $validated = $request->validate([
            'tipo' => 'required|in:dificuldade,qualidade',
            'categoria' => 'required|string',
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'nivel' => 'required|in:baixo,medio,alto',
        ]);

        $validated['aluno_id'] = $aluno->id;
        Caracteristica::create($validated);

        return redirect()->route('alunos.show', $aluno)->with('success', 'Característica adicionada com sucesso!');
    }

    public function destroyCaracteristica(Aluno $aluno, Caracteristica $caracteristica)
    {
        $caracteristica->delete();
        return redirect()->route('alunos.show', $aluno)->with('success', 'Característica removida!');
    }

    public function imprimirSugestao(Aluno $aluno, SugestaoAtividade $sugestao)
    {
        return view('alunos.imprimir-sugestao', compact('aluno', 'sugestao'));
    }

    private function getCategorias()
    {
        return [
            'leitura' => 'Leitura',
            'escrita' => 'Escrita',
            'matematica' => 'Matemática',
            'interpretacao' => 'Interpretação de Texto',
            'calculo_mental' => 'Cálculo Mental',
            'atencao' => 'Atenção / Concentração',
            'comportamento' => 'Comportamento',
            'socializacao' => 'Socialização',
            'criatividade' => 'Criatividade',
            'raciocinio_logico' => 'Raciocínio Lógico',
            'oralidade' => 'Oralidade',
            'ciencias' => 'Ciências',
            'historia_geografia' => 'História e Geografia',
            'artes' => 'Artes',
        ];
    }
}
