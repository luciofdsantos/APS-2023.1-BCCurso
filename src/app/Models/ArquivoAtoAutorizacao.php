<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArquivoAtoAutorizacao extends Model
{
    protected $table = 'arquivo_ato_autorizacao';

    protected $fillable = [
        'nome',
        'path',
        'curso_id',
    ];
}
