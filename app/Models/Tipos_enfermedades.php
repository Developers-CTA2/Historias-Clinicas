<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipos_enfermedades extends Model
{
    use HasFactory;

    protected $table = 'tipos_enfermedades';
    protected $primaryKey = 'id_tipo_ahf';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'created_by',
        'updated_by',
    ];

    public function especificar_ahf()
    {
        return $this->hasMany(Enfermedad_especifica::class, 'id_tipo_ahf');
    }
}
