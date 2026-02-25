<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sugestoes_atividades', function (Blueprint $table) {
            $table->id();
            $table->string('categoria'); // deve corresponder às categorias de dificuldades
            $table->string('titulo');
            $table->text('descricao');
            $table->text('materiais')->nullable();
            $table->text('passo_a_passo')->nullable();
            $table->integer('duracao_minutos')->nullable();
            $table->enum('nivel_dificuldade', ['baixo', 'medio', 'alto'])->default('medio');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sugestoes_atividades');
    }
};
