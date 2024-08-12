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
        'estado_id',
        'pais',
        'created_by',
        'updated_by',

    ];

    public function persona()
    {
        return $this->hasOne(Persona::class, 'domicilio_id', 'id_domicilio');
    }

    public function rep_estado()
    {
        return $this->hasOne(Rep_estado::class, 'id_estado', 'estado_id');
    }
}
 