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
        Schema::create('coordenador', function (Blueprint $table) {
            $table->id();
            $table->string('horario_atendimento');
            $table->string('email_contato');
            $table->string('sala_atendimento');
            $table->foreignId('professor_id')->constrained(
                table: 'professor'
            );
            $table->foreignId('curso_id')->constrained(
                table: 'curso'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coordenador');
    }
};
