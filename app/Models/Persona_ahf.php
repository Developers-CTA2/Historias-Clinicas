<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona_ahf extends Model
{
    use HasFactory;

    protected $table = 'persona_ahf';

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    public function especificar_ahf()
    {
        return $this->belongsTo(Enfermedad_especifica::class, 'id_ahf');
    }
}
