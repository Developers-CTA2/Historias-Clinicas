<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diateticas extends Model
{
    use HasFactory;

    protected $table = 'dieteticas';

    protected $fillable = [
        'comidas_dia',
        'apetito',
        'alim_no_pref',
        'alergias',
        'suplementos',
        'vasos_agua',
        'vasos_bebidas',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
}
