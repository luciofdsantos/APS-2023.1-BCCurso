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
        Schema::create('arquivo_ppc', function (Blueprint $table) {
            $table->id();
            $table->string("nome");
            $table->string("path");
            $table->foreignId('ppc_id')->constrained(
                table: 'ppc'
            )->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arquivo_ppc');
    }
};
