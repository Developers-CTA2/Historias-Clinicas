<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstatusCita extends Model
{
    use HasFactory;

    protected $table = 'estatus_cita';
    protected $fillable = [
        'status'
    ];

    public function citas()
    {
        return $this->hasMany(Citas::class);
    }

}
