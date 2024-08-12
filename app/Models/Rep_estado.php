<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rep_estado extends Model
{
    protected $table = 'rep_estado';
    protected $primaryKey = 'id_estado';
    public $incrementing = true;

    protected $fillable = [
        'nombre',
        'created_by',
        'updated_by',

    ];

    public function Domocilio()
    {
        return $this->hasOne(Domicilio::class, 'estado_id', 'id_estado');
    }
}
