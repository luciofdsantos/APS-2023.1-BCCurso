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
        Schema::table('servidor', function (Blueprint $table) {
            $table->dropForeign('servidor_usuario_id_foreign');
            $table->dropColumn('usuario_id');
            $table->foreignId('user_id')->constrained(
                table: 'users'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servidor', function (Blueprint $table) {
            $table->dropForeign('servidor_user_id_foreign');
            $table->dropColumn('user_id');
            $table->foreignId('usuario_id')->constrained(
                table: 'usuario'
            );
        });
    }
};
