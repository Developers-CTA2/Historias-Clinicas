<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traumatismos extends Model
{
    use HasFactory;

    protected $table = 'traumatismos';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'id_persona',
        'fecha',
        'detalles',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
}
