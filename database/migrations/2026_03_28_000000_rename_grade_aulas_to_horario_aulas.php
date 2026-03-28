<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('grade_aulas') && ! Schema::hasTable('horario_aulas')) {
            Schema::rename('grade_aulas', 'horario_aulas');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('horario_aulas') && ! Schema::hasTable('grade_aulas')) {
            Schema::rename('horario_aulas', 'grade_aulas');
        }
    }
};
