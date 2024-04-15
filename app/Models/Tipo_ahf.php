<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_ahf extends Model
{
    use HasFactory;

    protected $table = 'tipo_ahf';
    protected $primaryKey = 'id_tipo_ahf';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];

    public function especificar_ahf()
    {
        return $this->hasMany(Especificar_ahf::class, 'id_tipo_ahf');
    }
}
