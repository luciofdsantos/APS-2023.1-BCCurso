<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postagem extends Model {

    protected $table = 'postagem';
    
    protected $fillable = [
        'titulo',
        'texto',
        'tipo_postagem_id',
        'menu_inicial',
    ];

    public function imagens(){
        return $this->hasMany(ImagemPostagem::class);
    }

    public function arquivos(){
        return $this->hasMany(ArquivoPostagem::class);
    }
}