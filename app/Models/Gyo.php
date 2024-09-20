<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gyo extends Model
{
    use HasFactory;

    protected $table = 'gyo';
    protected $primaryKey = 'id';
    public $incrementing = true;


    protected $fillable = [
        'id_persona',
        'menarca',
        'fecha_um',
        's_gestacion',
        'ciclos',
        'dias_x_dias',
        'ivs',
        'parejas_s',
        'gestas',
        'partos',
        'abortos',
        'cesareas',
        'fecha_citologia',
        'metodo',
        'mastografia',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
}
