<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servidor extends Model
{
    protected $table = 'servidor';
    
    protected $fillable = [
        'nome',
        'email',
        'user_id',
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
