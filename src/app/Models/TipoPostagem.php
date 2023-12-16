<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPostagem extends Model {

    protected $table = 'tipo_postagem';

    public $timestamps = false;

    protected $fillable = [
        'nome'
    ];
}
