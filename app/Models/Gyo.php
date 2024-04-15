<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gyo extends Model
{
    use HasFactory;

    protected $table = 'gyo';

    protected $fillable = [
        'menarca',
        'fecha_um',
        'c_regulares',
        'diasxdias',
        'ivs',
        'parejas_s',
        'gestas',
        'partos',
        'abortos',
        'cesarias',
        'fecha_citologia',
        'metodo',
        'mastografia',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
}
