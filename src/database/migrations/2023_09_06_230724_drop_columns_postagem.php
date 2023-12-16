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
        Schema::table('postagem', function (Blueprint $table) {
            $table->dropColumn('imagem');
            $table->dropColumn('arquivo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('postagem', function (Blueprint $table) {
            $table->string('imagem');
            $table->dropColumn('arquivo');
        });
    }
};
