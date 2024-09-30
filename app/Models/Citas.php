<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EstatusCita;

class Citas extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'tipo_profesional',
        'fecha',
        'hora',
        'motivo',
        'estatus_cita_id',
    ];

    public function estatusCita()
    {
        return $this->belongsTo(EstatusCita::class);
    }


}
