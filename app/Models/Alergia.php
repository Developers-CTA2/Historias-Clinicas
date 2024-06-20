<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alergia extends Model
{
    use HasFactory;

    protected $table = 'alergias';
    protected $primaryKey = 'id_alergia';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'created_by',
        'updated_by',
    ];

    public function alergia()
    {
        return $this->hasMany(Persona_alergia::class, 'id_alergia');
    }
}
