<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medidas extends Model
{
    use HasFactory;

    protected $table = 'medidas';

    // Definir la clave primaria
    protected $primaryKey = 'id_medida';
    public $incrementing = true;
    protected $keyType = 'int';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'peso_actual',
        'peso_habitual',
        'estatura',
        'circunferencia_cintura',
        'circunferencia_cadera',
    ];

    // Relación con el modelo Nutricional
    public function nutricional()
    {
        return $this->hasOne(Nutricional::class, 'id_medida', 'id_medida');
    }
}

