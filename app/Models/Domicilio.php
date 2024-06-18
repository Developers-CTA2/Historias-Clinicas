<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    use HasFactory;

    protected $table = 'domicilio';
    
    protected $fillable = [
        'cuidad_municipio',
        'calle',
        'num',
        'num_int',
        'colonia',
        'cp',
        'estado',
        'pais',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
}
