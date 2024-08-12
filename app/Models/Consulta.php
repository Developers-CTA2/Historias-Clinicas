<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\belongsToMany;


class Consulta extends Model
{
    use HasFactory;

    protected $table = 'consulta';
    protected $primaryKey = 'id_consulta';
    public $incrementing = true;
    
    protected $fillable = [
        'hora',
        'turno',
        'motivo_consulta',
        'auxiliares_dx_tx_previo',
        'exploracion_fisica',
        'diagnostico',
        'tratamiento',
        'observaciones',
        'created_by',
        'updated_by',
        
    ];

    public function persona() : BelongsTo
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    public function signos_vitales() : HasOne
    {
        return $this->hasOne(Signos_vitales::class, 'id_consulta');
    }

    public function consulta_has_enfermedad() : belongsToMany
    {
        return $this->belongsToMany(Enfermedad_especifica::class,'consulta_has_enfermedades','id_consulta','id_enfermedad');
    }
}
