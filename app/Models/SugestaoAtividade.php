<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SugestaoAtividade extends Model
{
    use HasFactory;

    protected $table = 'sugestoes_atividades';

    protected $fillable = [
        'categoria',
        'titulo',
        'descricao',
        'materiais',
        'passo_a_passo',
        'duracao_minutos',
        'nivel_dificuldade',
    ];
}
