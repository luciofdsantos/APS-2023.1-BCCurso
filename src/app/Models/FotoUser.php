<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoUser extends Model
{
    use HasFactory;

    protected $table = 'foto_user';

    protected $fillable = [
        'foto',
        'user_id',
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
