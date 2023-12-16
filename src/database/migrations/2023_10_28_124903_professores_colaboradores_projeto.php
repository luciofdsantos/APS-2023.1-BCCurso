<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('professores_colaboradores_projeto', function (Blueprint $table) {
            $table->foreignId('professor_id')->constrained(
                table: 'professor'
            )->onDelete("cascade");
            $table->foreignId('projeto_id')->constrained(
                table: 'projeto'
            )->onDelete("cascade");
        });

        Schema::create('professores_externos_projeto', function (Blueprint $table) {
            $table->foreignId('professor_externo_id')->constrained(
                table: 'professor_externo'
            )->onDelete("cascade");
            $table->foreignId('projeto_id')->constrained(
                table: 'projeto'
            )->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professores_colaboradores_projeto');

        Schema::dropIfExists('professores_externos_projeto');
    }
};
