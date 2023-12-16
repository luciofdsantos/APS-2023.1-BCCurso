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
        Schema::create('colegiado_servidor', function (Blueprint $table) {
            $table->foreignId('servidor_id')
            ->references('id')->on('servidor')
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
        Schema::dropIfExists('colegiado_servidor');
    }
};
