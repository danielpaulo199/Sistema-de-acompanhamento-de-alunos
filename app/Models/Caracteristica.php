<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'tipo',
        'categoria',
        'titulo',
        'descricao',
        'nivel',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function sugestoesAtividades()
    {
        return SugestaoAtividade::where('categoria', $this->categoria)->get();
    }
}
