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
        Schema::create('servidor', function (Blueprint $table) {
            $table->id();
            $table->string("nome");
            $table->string("email")->unique();
            $table->foreignId('usuario_id')->constrained(
                table: 'usuario'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servidor');
    }
};
