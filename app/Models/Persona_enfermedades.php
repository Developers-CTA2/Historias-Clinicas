<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona_enfermedades extends Model
{
    // use HasFactory;
    // protected $table = 'persona_enfermedades';

    
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'persona_enfermedades';
    protected $fillable = ['id_enfermedad'];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    public function enfermedad_especifica()
    {
        return $this->belongsTo(Enfermedad_especifica::class, 'id_enfermedad');
    }
}
