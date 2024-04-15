<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fracturas extends Model
{
    use HasFactory;

    protected $table = 'fracturas';

    protected $fillable = [
        'fecha',
        'detalles',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
}
