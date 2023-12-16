<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaProfessor extends Model
{
    protected $table = 'area_professor';
    
    protected $fillable = [
        'area',
        'link',
        'professor_id',
    ];
}
