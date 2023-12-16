<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ata extends Model
{
    protected $table = 'ata';

    protected $fillable = [
        'data',
        'descricao',
        'colegiado_id'
    ];

    public function colegiado() {
        return $this->belongsTo(Colegiado::class, 'colegiado_id', 'id');
    }

}
