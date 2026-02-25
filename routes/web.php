<?php

use App\Http\Controllers\AlunoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('alunos.index');
});

Route::resource('alunos', AlunoController::class);

Route::get('alunos/{aluno}/sugestoes/{sugestao}/imprimir', [AlunoController::class, 'imprimirSugestao'])
    ->name('alunos.sugestoes.imprimir');

Route::post('alunos/{aluno}/caracteristicas', [AlunoController::class, 'storeCaracteristica'])
    ->name('alunos.caracteristicas.store');

Route::delete('alunos/{aluno}/caracteristicas/{caracteristica}', [AlunoController::class, 'destroyCaracteristica'])
    ->name('alunos.caracteristicas.destroy');
