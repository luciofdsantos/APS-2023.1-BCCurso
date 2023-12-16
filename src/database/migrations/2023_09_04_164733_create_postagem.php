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
        Schema::create('postagem', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('texto');
            $table->foreignId('tipo_postagem_id')->constrained(
                table: 'tipo_postagem'
            );
            $table->string('imagem')->nullable();
            $table->string('arquivo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postagem');
    }
};
