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
        Schema::create('alunos_projetos', function (Blueprint $table) {
            $table->foreignId('aluno_id')->constrained(
                table: 'aluno'
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
        Schema::dropIfExists('alunos_projetos');
    }
};
