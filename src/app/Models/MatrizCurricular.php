<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatrizCurricular extends Model
{
    protected $table = 'matriz_curricular';

    protected $fillable = [
        'path',
        'nome',
        'ppc_id',
    ];

    public function ppc()
    {
        return $this->belongsTo(PPC::class);
    }
}
