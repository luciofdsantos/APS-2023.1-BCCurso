<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagemPostagem extends Model
{
    use HasFactory;

    protected $table = 'imagem_postagem';

    protected $fillable = [
        'imagem',
        'postagem_id',
    ];
    
    public function postagem(){
        return $this->belongsTo(Postagem::class);
    }
}
