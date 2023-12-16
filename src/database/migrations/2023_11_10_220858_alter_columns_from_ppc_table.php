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
        Schema::table('ppc', function (Blueprint $table) {
            $table->boolean('vigente')->after('status')->nullable();
            $table->string('nome')->after('id');
            $table->string('path')->after('id')->unique();
            $table->dropColumn('status');
            $table->dropColumn('periodo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ppc', function (Blueprint $table) {
            $table->boolean('status')->after('vigente')->nullable();
            $table->dropColumn('vigente');
            $table->string('periodo')->after('id');
            $table->dropColumn('nome');
            $table->dropColumn('path');

        });
    }
};
