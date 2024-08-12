<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escolaridad extends Model
{
    use HasFactory;
    protected $table = 'escolaridad';
    protected $primaryKey = 'id_escolaridad';
    public $incrementing = true;

    protected $fillable = [
        'nombre',
        'created_by',
        'updated_by',

    ];

    // public function persona_escolaridad()
    // {
    //     return $this->hasOne(Persona::class, 'escolaridad_id', 'id_escolaridad');
    // }
}
