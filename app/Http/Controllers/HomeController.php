<?php

namespace App\Http\Controllers;

use App\Services\HorariosService;

class HomeController extends Controller
{
    public function index()
    {
        $agora = HorariosService::agoraBr();
        $colecao = HorariosService::celulasHorario();
        $quadro = HorariosService::quadroIndexadoPorTurno($colecao);
        $ctx = HorariosService::contextoPainel($agora, $quadro);
        $horariosMatutino = HorariosService::horariosTurno('matutino');
        $horariosVespertino = HorariosService::horariosTurno('vespertino');

        return view('home', compact('quadro', 'ctx', 'horariosMatutino', 'horariosVespertino'));
    }
}
