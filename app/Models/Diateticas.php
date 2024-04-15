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
        'quien_prepara',
        'come_entre_c',
        'apetito',
        'alim_pref',
        'alim_no_pref',
        'alergia',
        'alergia_a_que',
        'suplementos',
        'vasos_agua',
        'vasos_bebidas',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
}
