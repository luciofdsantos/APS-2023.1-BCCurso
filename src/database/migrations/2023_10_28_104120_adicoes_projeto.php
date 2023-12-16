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
        Schema::table('projeto', function (Blueprint $table) {
            $table->text('titulo');
            $table->string('fomento')->nullable();
            $table->string('link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projeto', function (Blueprint $table) {
            $table->dropColumn('titulo');
            $table->dropColumn('fomento');
            $table->dropColumn('link');
        });
    }
};
