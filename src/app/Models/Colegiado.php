<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colegiado extends Model
{
    protected $table = 'colegiado';

    protected $fillable = [
        'numero_portaria',
        'inicio',
        'fim',
        'coordenador_id',
        'atual'
    ];

    public function presidente() {
        return $this->hasOne(Professor::class, 'id', 'coordenador_id');
    }

    public function arquivoPortaria() {
        return $this->hasOne(ArquivoPortaria::class, 'id', 'arquivo_portaria_id');
    }

    public function professores() {
        return $this->belongsToMany(Professor::class, 'colegiado_professor', 'colegiado_id', 'professor_id');
    }

    public function tecnicosAdm() {
        return $this->belongsToMany(Servidor::class, 'colegiado_servidor', 'colegiado_id', 'servidor_id');
    }

    public function alunos() {
        return $this->belongsToMany(Aluno::class, 'colegiado_aluno', 'colegiado_id', 'aluno_id');
    }

    public function atas() {
        return $this->hasMany(Ata::class, 'colegiado_id', 'id');
    }
}
