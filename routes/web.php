<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HorarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('horarios/editar', [HorarioController::class, 'edit'])->name('horarios.edit');
Route::put('horarios', [HorarioController::class, 'update'])->name('horarios.update');

Route::resource('alunos', AlunoController::class);

Route::get('alunos/{aluno}/sugestoes/{sugestao}/imprimir', [AlunoController::class, 'imprimirSugestao'])
    ->name('alunos.sugestoes.imprimir');

Route::post('alunos/{aluno}/caracteristicas', [AlunoController::class, 'storeCaracteristica'])
    ->name('alunos.caracteristicas.store');

Route::delete('alunos/{aluno}/caracteristicas/{caracteristica}', [AlunoController::class, 'destroyCaracteristica'])
    ->name('alunos.caracteristicas.destroy');
