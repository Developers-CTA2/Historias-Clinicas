<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospitalizaciones extends Model
{
    use HasFactory;

    protected $table = 'hospitalizaciones';

    protected $fillable = [
        'fecha',
        'detalles',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
}
