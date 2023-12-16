<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tipo_postagem', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->timestamps();
        });

        DB::table('tipo_postagem')->insert(
            array(
                'nome' => 'Convite TCC'
            )
        );

        DB::table('tipo_postagem')->insert(
            array(
                'nome' => 'Evento'
            )
        );

        DB::table('tipo_postagem')->insert(
            array(
                'nome' => 'Aviso'
            )
        );

        DB::table('tipo_postagem')->insert(
            array(
                'nome' => 'Oportunidades'
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_postagem');
    }
};
