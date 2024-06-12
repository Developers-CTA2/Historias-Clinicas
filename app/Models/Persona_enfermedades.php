<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona_enfermedades extends Model
{
    // use HasFactory;
    // protected $table = 'persona_enfermedades';

    protected $fillable = [
        'id_enfermedad',
    ];


    // // public function persona()
    // // {
    // //     return $this->belongsTo(Persona::class, 'id_persona');
    // // }

    // // public function persona_enfermedad()
    // // {
    // //     return $this->belongsTo(Enfermedad_especifica::class, 'id_enfermedad');
    // // }

    // public function persona()
    // {
    //     return $this->belongsTo(Persona::class, 'id_persona');
    // }

    // public function persona_enfermedad()
    // {
    //     return $this->belongsTo(Enfermedad_especifica::class, 'id_ahf');
    // }

    use HasFactory;

    protected $table = 'persona_enfermedades';

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    public function especificar_ahf()
    {
        return $this->belongsTo(Enfermedad_especifica::class, 'id_ahf');
    }
}
