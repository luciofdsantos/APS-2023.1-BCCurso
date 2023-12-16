<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banca extends Model
{
    protected $table = 'banca';

    protected $fillable = [
        'data',
        'local',
        'professor_id'
    ];

    public function professoresExternos() {
        return $this->belongsToMany(ProfessorExterno::class, 'banca_professor_externo', 'banca_id', 'professor_externo_id');
    }

    public function professores() {
        return $this->belongsToMany(Professor::class, 'banca_professor', 'banca_id', 'professor_id');
    }

    public function presidente() {
        return $this->hasOne(Professor::class, 'id', 'professor_id');
    }
}
