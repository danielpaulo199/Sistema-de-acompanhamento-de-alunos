<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horario_aulas', function (Blueprint $table) {
            $table->id();
            $table->string('turno', 20);
            $table->unsignedTinyInteger('dia_semana');
            $table->unsignedTinyInteger('ordem_aula');
            $table->string('materia_codigo', 40)->nullable();
            $table->timestamps();

            $table->unique(['turno', 'dia_semana', 'ordem_aula']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horario_aulas');
    }
};
