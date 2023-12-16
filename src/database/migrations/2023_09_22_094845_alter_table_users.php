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
        Schema::table('users', function (Blueprint $table) {
            $table->string('curriculo_lattes')->nullable()->default(null)->unique();
            $table->string('titulacao')->nullable()->default(null);
            $table->string('biografia')->nullable()->default(null);
            $table->string('area')->nullable()->default(null);
            $table->string('foto')->nullable()->default(null);
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('curriculo_lattes');
            $table->dropColumn('titulacao');
            $table->dropColumn('biografia');
            $table->dropColumn('area');
            $table->dropColumn('foto');
        });
    }
};
