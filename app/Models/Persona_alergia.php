<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona_alergia extends Model
{
    use HasFactory;

    protected $table = 'persona_alergia';

    protected $fillable = [
        'id_alergia',
        'especificar',
    ];

    public function alergias()
    {
        return $this->belongsTo(Alergia::class, 'id_alergia');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
}
