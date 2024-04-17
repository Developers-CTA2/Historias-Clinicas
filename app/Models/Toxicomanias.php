<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toxicomanias extends Model
{
    use HasFactory;

    protected $table = 'toxicomanias';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'nombre', 
    ];

    public function Persona_toxi()
    {
        return $this->hasMany(Persona_toxicomanias::class, 'id_toxicomanias');
    }
}
