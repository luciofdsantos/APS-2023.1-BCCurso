<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPC extends Model{
    protected $table = 'ppc';

    protected $fillable = [
        'periodo',
        'vigente',
        'path',
        'nome',
        'curso_id',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class,'curso_id');
    }

    public function matriz() 
    {
        return $this->hasOne(MatrizCurricular::class,'ppc_id');
    }

} 