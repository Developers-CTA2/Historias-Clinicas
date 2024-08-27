<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Folio extends Model
{
    use HasFactory;

    protected $table = 'folios';
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $fillable = [
        'type',
        'number',
        'id_persona',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }

    public function consulta() : HasOne
    {
        return $this->hasOne(Consulta::class, 'id_folio');
    }
}
