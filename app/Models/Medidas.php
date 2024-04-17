<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medidas extends Model
{
    use HasFactory;

    protected $table = 'medidas';

    protected $fillable = [
        'peso_actual',
        'peso_habitual',
        'estatura',
        'circunf_cintura',
        'circunf_cadera',
    ];

    public function nutricional()
    {
        return $this->belongsTo(Nutricional::class, 'id_nutricional');
    }
}
