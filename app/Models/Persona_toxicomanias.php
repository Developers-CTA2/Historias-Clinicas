<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona_toxicomanias extends Model
{
    use HasFactory;

    protected $table = 'personas_toxicomanias';

    protected $fillable = [
        'cantidad',
        'desde_cuando',
        'observacion',
        'id_toxicomania'
    ];

    public function toxicomanias()
    {
        return $this->belongsTo(Toxicomanias::class, 'id_toxicomania', 'id');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
}
