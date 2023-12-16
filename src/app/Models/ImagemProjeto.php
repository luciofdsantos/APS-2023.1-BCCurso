<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagemProjeto extends Model
{
    use HasFactory;

    protected $table = 'imagem_projeto';

    protected $fillable = [
        'imagem',
        'projeto_id',
    ];

}
