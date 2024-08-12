<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;

class Enfermedad_especifica extends Model
{
    use HasFactory;

    protected $table = 'enfermedades_especificas';
    protected $primaryKey = 'id_especifica_ahf';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'id_tipo_ahf',
        'created_by',
        'updated_by',
    ];

    public function tipo_ahf()
    {
        return $this->belongsTo(Tipos_enfermedades::class, 'id_tipo_ahf');
    }

    public function persona_ahf()
    {
        return $this->hasMany(Persona_ahf::class, 'id_ahf');
    }

    public function persona_enfermedad()
    {
        return $this->hasMany(Persona_enfermedades::class, 'id_enfermedad');
    }

    public function consulta_has_enfermedad() : belongsToMany
    {
        return $this->belongsToMany(Consulta::class, 'consulta_has_enfermedades','id_consulta','id_consulta');
    }
}

