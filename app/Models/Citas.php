<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citas extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $fillable = [
        'paciente_id',
        'tipo_profesional',
        'fecha',
        'hora',
        'motivo',
    ];

    public function pacientes()
    {
        return $this->belongsTo(Pacientes::class, 'paciente_id');
    }

}
