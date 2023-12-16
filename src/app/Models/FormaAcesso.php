<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaAcesso extends Model
{
    protected $table = 'formas_acesso';

    protected $fillable = [
        'curso_id', 
        'forma_acesso', 
        'porcentagem_vagas'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }
}
