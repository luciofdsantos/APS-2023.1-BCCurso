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
        Schema::table('tcc', function (Blueprint $table) {
            $table->foreignId('banca_id')->nullable()
            ->references('id')->on('banca');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tcc', function (Blueprint $table) {
            $table->foreignId('banca_id')->nullable()
            ->references('id')->on('banca')
            ->onDelete('CASCADE');
        });
    }
};