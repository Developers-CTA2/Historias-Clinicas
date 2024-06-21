<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Signos_vitales extends Model
{
    use HasFactory;

    protected $table = 'signos_vitales';

    protected $fillable = [
        'temperatura',
        'frecuencia_cardiaca',
        'ritmo_respiratorio',
        'presion_arterial',
        'peso',
        'glucosa',
        'talla',
        'temperatura',
        'Síndrome_autoinmune_tirogastrico',

    ];

    public function consulta(): BelongsTo
    {
        return $this->belongsTo(Consulta::class, 'id_consulta');
    }
    
}
