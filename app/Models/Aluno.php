<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'foto',
        'data_nascimento',
        'responsavel',
        'telefone_responsavel',
        'turno',
        'observacoes',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    public function caracteristicas()
    {
        return $this->hasMany(Caracteristica::class);
    }

    public function dificuldades()
    {
        return $this->hasMany(Caracteristica::class)->where('tipo', 'dificuldade');
    }

    public function qualidades()
    {
        return $this->hasMany(Caracteristica::class)->where('tipo', 'qualidade');
    }

    public function getInitialsAttribute()
    {
        $parts = explode(' ', $this->nome);
        $initials = '';
        foreach (array_slice($parts, 0, 2) as $part) {
            $initials .= strtoupper(substr($part, 0, 1));
        }
        return $initials;
    }
}
