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
            $table->dropUnique('users_curriculo_lattes_unique');
            $table->dropColumn('login');
        });

        Schema::dropIfExists('usuario');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('login');
            $table->unique('curriculo_lattes');
        });

        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string("login")->unique();
            $table->string("senha");
            $table->timestamps();
        });
    }
};
