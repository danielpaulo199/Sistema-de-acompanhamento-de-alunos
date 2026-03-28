<?php

namespace App\Services;

use App\Models\HorarioAula;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class HorariosService
{
    public const TURNOS = ['matutino', 'vespertino'];

    public const MATERIAS = [
        'portugues' => 'Português',
        'matematica' => 'Matemática',
        'educacao_fisica' => 'Educação Física',
        'historia' => 'História',
        'ensino_religioso' => 'Ensino Religioso',
        'geografia' => 'Geografia',
        'ciencias' => 'Ciências',
        'informatica' => 'Informática',
        'educacao_financeira' => 'Educação financeira',
        'ingles' => 'Inglês',
        'artes' => 'Artes',
    ];

    /** Disciplinas ministradas por outros professores — período de planejamento para a titular. */
    public const MATERIAS_PLANEJAMENTO = [
        'educacao_fisica',
        'ensino_religioso',
        'educacao_financeira',
        'ingles',
        'artes',
    ];

    private const DIAS_PT = [
        1 => 'segunda-feira',
        2 => 'terça-feira',
        3 => 'quarta-feira',
        4 => 'quinta-feira',
        5 => 'sexta-feira',
        6 => 'sábado',
        7 => 'domingo',
    ];

    private const HORARIOS_MATUTINO = [
        1 => ['inicio' => '07:45', 'fim' => '08:30'],
        2 => ['inicio' => '08:30', 'fim' => '09:15'],
        3 => ['inicio' => '09:15', 'fim' => '10:15'],
        4 => ['inicio' => '10:15', 'fim' => '11:00'],
        5 => ['inicio' => '11:00', 'fim' => '11:45'],
    ];

    private const HORARIOS_VESPERTINO = [
        1 => ['inicio' => '13:00', 'fim' => '13:45'],
        2 => ['inicio' => '13:45', 'fim' => '14:30'],
        3 => ['inicio' => '14:30', 'fim' => '15:30'],
        4 => ['inicio' => '15:30', 'fim' => '16:15'],
        5 => ['inicio' => '16:15', 'fim' => '17:00'],
    ];

    public static function horariosTurno(string $turno): array
    {
        return $turno === 'vespertino' ? self::HORARIOS_VESPERTINO : self::HORARIOS_MATUTINO;
    }

    public static function labelMateria(?string $codigo): ?string
    {
        if ($codigo === null || $codigo === '') {
            return null;
        }

        return self::MATERIAS[$codigo] ?? $codigo;
    }

    public static function ehPlanejamento(?string $codigo): bool
    {
        return $codigo && in_array($codigo, self::MATERIAS_PLANEJAMENTO, true);
    }

    public static function slotAtivoNoHorario(Carbon $agora, string $turno): ?int
    {
        $hora = $agora->format('H:i');
        $slots = self::horariosTurno($turno);

        foreach ($slots as $num => $range) {
            $ini = $range['inicio'];
            $fim = $range['fim'];
            $ultima = $num === 5;
            if ($hora >= $ini && ($ultima ? $hora <= $fim : $hora < $fim)) {
                return (int) $num;
            }
        }

        return null;
    }

    /** Janela do turno no relógio (primeiro início → último fim). */
    public static function turnoEstaNoExpediente(Carbon $agora, string $turno): bool
    {
        $slots = self::horariosTurno($turno);
        $hora = $agora->format('H:i');
        $primeiro = $slots[1]['inicio'];
        $ultimo = $slots[5]['fim'];

        return $hora >= $primeiro && $hora <= $ultimo;
    }

    public static function nomeDiaPt(int $diaIso): string
    {
        return self::DIAS_PT[$diaIso] ?? '';
    }

    public static function celulasHorario(): Collection
    {
        return HorarioAula::query()->orderBy('turno')->orderBy('dia_semana')->orderBy('ordem_aula')->get();
    }

    /**
     * @return array<string, array<int, array<int, HorarioAula|null>>>
     */
    public static function quadroIndexadoPorTurno(Collection $linhas): array
    {
        $out = [
            'matutino' => [],
            'vespertino' => [],
        ];
        foreach (range(1, 5) as $d) {
            $out['matutino'][$d] = array_fill(1, 5, null);
            $out['vespertino'][$d] = array_fill(1, 5, null);
        }
        foreach ($linhas as $celula) {
            $out[$celula->turno][$celula->dia_semana][$celula->ordem_aula] = $celula;
        }

        return $out;
    }

    public static function agoraBr(): Carbon
    {
        // return Carbon::now('America/Sao_Paulo');
        return Carbon::create(2026, 3, 27, 8, 15, 0, 'America/Sao_Paulo');
    }

    /**
     * Contexto para o painel inicial: saudação, aula corrente, planejamentos, etc.
     *
     * @param  array<string, array<int, array<int, HorarioAula|null>>>  $quadro
     */
    public static function contextoPainel(Carbon $agora, array $quadro): array
    {
        $diaIso = (int) $agora->dayOfWeekIso;
        $ehDiaLetivo = $diaIso >= 1 && $diaIso <= 5;
        $nomeDia = self::nomeDiaPt($diaIso);

        $h = (int) $agora->format('G');
        if ($h < 12) {
            $saudacao = 'Bom dia';
        } elseif ($h < 18) {
            $saudacao = 'Boa tarde';
        } else {
            $saudacao = 'Boa noite';
        }

        $horaRelogio = $agora->format('H:i');

        $turnoAtivo = null;
        $slot = null;
        $intervaloEntreTurnos = false;

        if ($ehDiaLetivo) {
            $hora = $agora->format('H:i');
            if ($hora > '11:45' && $hora < '13:00') {
                $intervaloEntreTurnos = true;
            } elseif (self::turnoEstaNoExpediente($agora, 'matutino')) {
                $turnoAtivo = 'matutino';
                $slot = self::slotAtivoNoHorario($agora, 'matutino');
            } elseif (self::turnoEstaNoExpediente($agora, 'vespertino')) {
                $turnoAtivo = 'vespertino';
                $slot = self::slotAtivoNoHorario($agora, 'vespertino');
            }
        }

        $materiaCodigo = null;
        $materiaLabel = null;
        $ehPlanej = false;
        $faixaHorario = null;

        if ($ehDiaLetivo && $turnoAtivo && $slot) {
            $cel = $quadro[$turnoAtivo][$diaIso][$slot] ?? null;
            $materiaCodigo = $cel !== null ? $cel->materia_codigo : null;
            $materiaLabel = self::labelMateria($materiaCodigo);
            $ehPlanej = self::ehPlanejamento($materiaCodigo);
            $sl = self::horariosTurno($turnoAtivo)[$slot];
            $faixaHorario = $sl['inicio'].' às '.$sl['fim'];
        }

        $mensagemAula = null;
        if (! $ehDiaLetivo) {
            $mensagemAula = '😎 Sem aulas hoje.';
        } elseif ($intervaloEntreTurnos) {
            $mensagemAula = 'Intervalo entre o turno matutino e o vespertino. Aproveite para descansar!';
        } elseif ($turnoAtivo && $slot) {
            if ($materiaLabel) {
                $turnoNome = $turnoAtivo === 'matutino' ? 'matutina' : 'vespertina';
                if ($ehPlanej) {
                    $mensagemAula = $materiaLabel;
                } else {
                    $mensagemAula = $materiaLabel;
                }
            } else {
                $mensagemAula = 'Estamos no horário da '.$slot.'ª aula, mas a disciplina ainda não está definida no cadastro de horários.';
            }
        } elseif ($ehDiaLetivo) {
            $mensagemAula = 'Fora do horário de aulas de hoje.';
        }

        $aulasHoje = [];
        if ($ehDiaLetivo) {
            foreach (self::TURNOS as $t) {
                foreach (range(1, 5) as $ord) {
                    $c = $quadro[$t][$diaIso][$ord] ?? null;
                    $cod = $c !== null ? $c->materia_codigo : null;
                    $aulasHoje[] = [
                        'turno' => $t,
                        'ordem' => $ord,
                        'label' => self::labelMateria($cod),
                        'codigo' => $cod,
                        'planejamento' => self::ehPlanejamento($cod),
                        'horario' => self::horariosTurno($t)[$ord],
                    ];
                }
            }
        }

        return [
            'saudacao' => $saudacao,
            'nome_dia' => $nomeDia,
            'hora_atual' => $horaRelogio,
            'eh_dia_letivo' => $ehDiaLetivo,
            'dia_iso' => $diaIso,
            'turno_ativo' => $turnoAtivo,
            'ordem_aula_atual' => $slot,
            'faixa_horario_atual' => $faixaHorario,
            'materia_atual_codigo' => $materiaCodigo,
            'materia_atual_label' => $materiaLabel,
            'aula_atual_eh_planejamento' => $ehPlanej,
            'intervalo_entre_turnos' => $intervaloEntreTurnos,
            'mensagem_detalhe_aula' => $mensagemAula,
            'aulas_do_dia' => $aulasHoje,
        ];
    }
}
