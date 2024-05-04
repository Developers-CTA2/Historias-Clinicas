<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nombramiento extends Model
{
    use HasFactory;
    protected $connection = 'sistema_personal';
    protected $table = 'nombramientos';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'nombre',
    ];

    public function personasTrabajo()
    {
        return $this->hasMany(Personas_trabajo::class, 'nombramiento', 'id');
    }

}
