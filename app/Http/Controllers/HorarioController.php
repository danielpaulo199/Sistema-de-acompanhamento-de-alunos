<?php

namespace App\Http\Controllers;

use App\Models\HorarioAula;
use App\Services\HorariosService;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function edit()
    {
        $colecao = HorariosService::celulasHorario();
        $quadro = HorariosService::quadroIndexadoPorTurno($colecao);
        $materias = HorariosService::MATERIAS;
        $horariosMatutino = HorariosService::horariosTurno('matutino');
        $horariosVespertino = HorariosService::horariosTurno('vespertino');

        return view('horarios.edit', compact('quadro', 'materias', 'horariosMatutino', 'horariosVespertino'));
    }

    public function update(Request $request)
    {
        $permitidos = array_keys(HorariosService::MATERIAS);

        foreach (HorariosService::TURNOS as $turno) {
            $payload = $request->input('horarios.'.$turno, []);
            if (! is_array($payload) || count($payload) !== 5) {
                return redirect()->back()->withInput()->with('error', 'Dados do turno '.$turno.' inválidos.');
            }
            foreach (range(1, 5) as $dia) {
                if (! isset($payload[$dia]) || ! is_array($payload[$dia]) || count($payload[$dia]) !== 5) {
                    return redirect()->back()->withInput()->with('error', 'Preencha todos os dias e aulas do turno '.($turno === 'matutino' ? 'matutino' : 'vespertino').'.');
                }
                foreach (range(1, 5) as $ordem) {
                    $codigo = $payload[$dia][$ordem] ?? null;
                    if ($codigo === '' || $codigo === null) {
                        $codigo = null;
                    } elseif (! in_array($codigo, $permitidos, true)) {
                        return redirect()->back()->withInput()->with('error', 'Matéria inválida selecionada.');
                    }
                    HorarioAula::query()->updateOrCreate(
                        [
                            'turno' => $turno,
                            'dia_semana' => $dia,
                            'ordem_aula' => $ordem,
                        ],
                        ['materia_codigo' => $codigo]
                    );
                }
            }
        }

        return redirect()->route('home')->with('success', 'Horários atualizados com sucesso!');
    }
}
