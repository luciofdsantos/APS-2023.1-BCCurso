<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArquivoPostagem extends Model
{
    use HasFactory;

    protected $table = 'arquivo_postagem';

    protected $fillable = [
        'nome',
        'path',
        'postagem_id',
    ];

    public function postagem(){
        return $this->belongsTo(Postagem::class);
    }
}
