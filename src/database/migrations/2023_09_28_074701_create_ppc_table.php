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
        Schema::create('ppc', function (Blueprint $table) {
            $table->id();
            $table ->string("periodo");
            $table ->string("status");
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
        Schema::dropIfExists('ppc');
    }
};
