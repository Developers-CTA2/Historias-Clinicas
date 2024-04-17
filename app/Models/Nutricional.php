<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nutricional extends Model
{
    use HasFactory;

    protected $table = 'nutricional';
    protected $primaryKey = 'id_nutricional';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'motivo_consul',
        'diagnostico',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
    public function medidas()
    {
        return $this->hasMany(Medidas::class, 'id_nutricional');
    }
}
