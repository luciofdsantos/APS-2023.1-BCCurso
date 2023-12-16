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
        Schema::create('banca_professor', function (Blueprint $table) {
            $table->foreignId('banca_id')
            ->references('id')->on('banca')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE')
            ->constrained();

            $table->foreignId('professor_id')
            ->references('id')->on('professor')
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE')
            ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banca_professor');
    }
};
