<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('caracteristicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained()->onDelete('cascade');
            $table->enum('tipo', ['dificuldade', 'qualidade']);
            $table->string('categoria'); // ex: leitura, escrita, matematica, comportamento, etc
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->enum('nivel', ['baixo', 'medio', 'alto'])->default('medio');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('caracteristicas');
    }
};
