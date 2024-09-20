<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nutricional extends Model
{
    use HasFactory;

    protected $table = 'nutricional';
    protected $primaryKey = 'id_nutricional';
    public $incrementing = true;

    protected $fillable = [
        'id_persona',
        'id_medida',
        'vasos_agua',
        'motivo_consulta',
        'toma_medicamentos',
        'diagnostico',
        'created_by',
        'updated_by',
    ];

    // Relación con el modelo Persona
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    // Relación con el modelo Medidas
    public function medidas()
    {
        return $this->belongsTo(Medidas::class, 'id_medida', 'id_medida');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
}
