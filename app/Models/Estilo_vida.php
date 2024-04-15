<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estilo_vida extends Model
{
    use HasFactory;

    protected $table = 'estilo_vida';

    protected $fillable = [
        'actividad',
        'ejercicio',
        'frecuencia',
        'duracion',
        'inicio',
        'alcohol',
        'tabaco',
        'cafe',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
}
