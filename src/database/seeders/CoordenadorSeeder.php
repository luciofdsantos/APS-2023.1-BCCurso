<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Coordenador;
use App\Models\Curso;
use App\Models\Professor;
use App\Models\Servidor;
use App\Models\AreaProfessor;
use App\Models\CurriculoProfessor;

class CoordenadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $curso = Curso::create([
            'turno' => 'Integral',
            'nome' => 'Ciência da Computação',
            'carga_horaria' => '3600',
            'sigla' => 'BCC',
            'tipo' => 'Bacharelado',
            'modalidade' => 'Presencial',
        ]);

        $user = User::create([
            'name' => 'Danilo',
            'email' => 'danilo@mail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$8g.nFvO/wZGiaAA1u/ELROVfUbzYiaHpXC/UT.9eFiOTE5sCwPyWq'
        ]);

        $user->assignRole(['professor', 'coordenador']);

        $servidor = Servidor::create([
            'nome' => 'Danilo',
            'email' => 'danilo@mail.com',
            'user_id' => $user->id,
        ]);

        $professor = Professor::create([
            'servidor_id' => $servidor->id,
        ]);

        $coordenador = Coordenador::create([
            'horario_atendimento' => '',
            'email_contato' => 'danilo.silva@ifnmg.edu.br',
            'sala_atendimento' => 'Sala de Coordenacao',
            'professor_id' => $professor->id,
            'curso_id' => $curso->id,
        ]);

        $area_professor = AreaProfessor::create([
            'professor_id'=> $professor->id,
        ]);

        $curriculo_professor = CurriculoProfessor::create([         //talvez tirar isso depois
            'professor_id'=> $professor->id,
            'curriculo'=>'',
            'link'=>'',
        ]);
    }
}
