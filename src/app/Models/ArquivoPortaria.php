<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArquivoPortaria extends Model
{
    protected $table = 'arquivo_portaria';

    protected $fillable = [
        'nome',
        'path'
    ];
}
