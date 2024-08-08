<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    use HasFactory;

    protected $table = 'domicilio';
    protected $primaryKey = 'id_domicilio';
    public $incrementing = true;

    protected $fillable = [
        'cuidad_municipio',
        'calle',
        'num',
        'num_int',
        'colonia',
        'cp',
        'estado',
        'pais',
        'id_persona',
    ];

    public function persona()
    {
        return $this->hasOne(Persona::class, 'domicilio_id', 'id_domicilio');
    }
}
 