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
        Schema::create('colegiado_aluno', function (Blueprint $table) {
            $table->foreignId('aluno_id')
            ->references('id')->on('aluno')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');

            $table->foreignId('colegiado_id')
            ->references('id')->on('colegiado')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colegiado_aluno');
    }
};
