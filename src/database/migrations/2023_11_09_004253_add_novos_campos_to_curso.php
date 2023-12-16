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
        Schema::table('curso', function (Blueprint $table) {
            $table->string('descricao')->after('nome')->nullable();
            $table->string('modalidade')->after('horario');
            $table->string('tipo')->after('horario');
            $table->string('habilitacao')->after('horario')->nullable();
            $table->integer('ano_implementacao')->after('horario')->nullable();
            $table->integer('vagas_ofertadas_anualmente')->after('horario')->nullable();
            $table->integer('vagas_ofertadas_turma')->after('horario')->nullable();
            $table->string('periodicidade_ingresso')->after('horario')->nullable();
            $table->float('tempo_min_conclusao')->after('horario')->nullable();
            $table->float('tempo_max_conclusao')->after('horario')->nullable();
            $table->integer('nota_enade')->after('horario');
            $table->integer('nota_in_loco_SINAES')->after('horario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('curso', function (Blueprint $table) {
            $table->dropColumn([
                'descricao',
                'modalidade',
                'tipo',
                'habilitacao',
                'ano_implementacao',
                'vagas_ofertadas_anualmente',
                'vagas_ofertadas_turma',
                'periodicidade_ingresso',
                'tempo_min_conclusao',
                'tempo_max_conclusao',
                'nota_enade',
                'nota_in_loco_SINAES',
            ]);
        });
    }
};
