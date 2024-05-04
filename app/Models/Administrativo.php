<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrativo extends Model
{
    use HasFactory;
    protected $connection = 'sistema_personal';
    protected $table = 'administrativos';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'nombre',
        'fecha_nacimiento',
        'fecha_ingreso',
        'sexo',
        'ultimo_grado',
        'estado_id', 
        'correo', 
        'tel_emergencia', 
    ];

    public function trabajos()
    {
        return $this->hasMany(Personas_trabajo::class, 'id_persona');
    }
}
