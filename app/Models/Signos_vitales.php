<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signos_vitales extends Model
{
    use HasFactory;

    protected $table = 'signos_vitales';

    protected $fillable = [
        'temperatura',
        'frecuencia_car',
        'ritmo_resp',
        'presion_art',
        'peso',
        'glucosa',
        'talla',
    ];

    public function consulta()
    {
        return $this->belongsTo(Consulta::class, 'id_consulta');
    }
}
