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
            $table->foreignId('professor_id')->constrained(
                table: 'professor'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projeto', function (Blueprint $table) {
            $table->dropColumn('professor_id');
        });
    }
};
