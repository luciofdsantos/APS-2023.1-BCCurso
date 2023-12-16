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
        Schema::create('colegiado', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('numero_portaria');
            $table->timestamp('inicio');
            $table->timestamp('fim');

            $table->foreignId('coordenador_id')
            ->references('id')->on('professor')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');

            $table->foreignId('arquivo_portaria_id')
            ->references('id')->on('arquivo_portaria')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colegiado');
    }
};
