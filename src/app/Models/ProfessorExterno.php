<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessorExterno extends Model
{
    protected $table = 'professor_externo';

    protected $fillable =[
        'nome', 'filiacao'
    ];

    public function bancas() {
        return $this->belongsToMany(Banca::class, 'banca_professor_externo', 'professor_externo_id', 'banca_id');

    }
}
