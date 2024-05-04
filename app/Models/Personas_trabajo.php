<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personas_trabajo extends Model
{
    use HasFactory;
    protected $connection = 'sistema_personal';
    public $timestamps = false;
    protected $table = 'personas_trabajo';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'id_persona',
        'codigo',
        'principal',
        'nombramiento',
        'horas_trabajo',
        'turno',
        'horario_oficial',
        'horario_actual',
        'tipo_contrato',
        'fecha_termino',
        'distincion_ad',
        'id_categoria',
        'id_estado',
        'area_distincion',
    ];

    // Relaciones
    public function nombramientoPersona()
    {
        return $this->belongsTo(Nombramiento::class, 'nombramiento', 'id');
    }

    public function administrativo()
    {
        return $this->belongsTo(Administrativo::class, 'id_persona');
    }

}
