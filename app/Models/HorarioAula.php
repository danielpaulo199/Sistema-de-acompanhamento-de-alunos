<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioAula extends Model
{
    protected $fillable = [
        'turno',
        'dia_semana',
        'ordem_aula',
        'materia_codigo',
    ];

    protected $casts = [
        'dia_semana' => 'integer',
        'ordem_aula' => 'integer',
    ];
}
