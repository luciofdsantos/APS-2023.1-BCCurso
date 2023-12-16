<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('curso', function (Blueprint $table) {
            $table->integer('nota_enade')->after('horario')->nullable()->change();
            $table->integer('nota_in_loco_SINAES')->after('horario')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('curso', function (Blueprint $table) {
            $table->integer('nota_enade')->after('horario')->change();
            $table->integer('nota_in_loco_SINAES')->after('horario')->change();
        });
    }
};
