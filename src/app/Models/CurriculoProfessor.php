<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculoProfessor extends Model
{
    protected $table = 'curriculo_professor';
    
    protected $fillable = [
        'curriculo',
        'link',
        'professor_id',
    ];

    public function professor(){
        return $this->belongsTo(Professor::class);
    }
}
