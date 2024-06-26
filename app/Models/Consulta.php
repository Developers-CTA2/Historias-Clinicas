<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $table = 'consulta';
    protected $primaryKey = 'id_consulta';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'hora',
        'turno',
        'nombre_medico',
        'diagnostico',
        'tratamiento',
        'observaciones',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    public function signos_vitales()
    {
        return $this->hasMany(Signos_vitales::class, 'id_consulta');
    }
}
