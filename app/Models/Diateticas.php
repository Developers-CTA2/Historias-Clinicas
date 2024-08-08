<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diateticas extends Model
{
    use HasFactory;

    protected $table = 'indicadores_dietéticos';

    protected $fillable = [
        'id_persona',
        'comidas_al_dia',
        'apetito',
        'alimentos_no_preferidos',
        'qien_prepara_comida',
        'suplementos',
        'grasas_consumidas',
        'created_by',
        'updated_by',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
}
