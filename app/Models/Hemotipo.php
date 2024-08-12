<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hemotipo extends Model
{
    use HasFactory;
    protected $table = 'hemotipo';
    protected $primaryKey = 'id_hemotipo';
    public $incrementing = true;

    protected $fillable = [
        'nombre',
        'created_by',
        'updated_by',

    ];

    public function persona_hemotipo()
    {
        return $this->hasOne(Persona::class, 'id_hemotipo', 'hemotipo_id');
    }
}
