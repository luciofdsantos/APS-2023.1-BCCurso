<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArquivoPPC extends Model
{
    use HasFactory;

    protected $table = 'arquivo_ppc';

    protected $fillable = [
        'nome',
        'path',
        'ppc_id',
    ];

    public function ppc(){
        return $this->belongsTo(PPC::class);
    }
}