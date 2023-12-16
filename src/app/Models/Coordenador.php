<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coordenador extends Model
{
    protected $table = 'coordenador';

    protected $fillable = [
        'horario_atendimento',
        'email_contato',
        'sala_atendimento',
        'professor_id',
        'curso_id'
    ];

    public function professor()
    {
        return $this->hasOne(Professor::class, 'id', 'professor_id');
    }

    public function curso()
    {
        return $this->hasOne(Curso::class, 'id', 'curso_id');
    }
}
