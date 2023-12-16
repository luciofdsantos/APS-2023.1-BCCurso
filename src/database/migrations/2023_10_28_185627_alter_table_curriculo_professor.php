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
        Schema::table('curriculo_professor', function (Blueprint $table) {
            $table->string('curriculo')->nullable()->change();
            $table->string('link')->nullable()->change();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('curriculo_professor', function (Blueprint $table) {
            $table->string('curriculo')->nullable(false)->change();
            $table->string('link')->nullable(false)->change();
       });
    }
};
