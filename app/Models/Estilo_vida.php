<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estilo_vida extends Model
{
    use HasFactory;

    protected $table = 'estilo_vida';
    public $timestamps = true;

    protected $fillable = [
        'id_persona',
        'actividad',
        'tipo_ejercicio',
        'frecuencia_ejercicio',
        'duracion_ejercicio',
        'created_by',
        'updated_by',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
}
