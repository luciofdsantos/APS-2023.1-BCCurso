<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArquivoTcc extends Model
{
    protected $table = 'arquivo_tcc';

    protected $fillable = [
        'nome',
        'path'
    ];
}
