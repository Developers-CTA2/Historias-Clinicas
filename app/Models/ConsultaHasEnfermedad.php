<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultaHasEnfermedad extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_enfermedad'    
    ];

    public function enfermedad(){
        return $this->belongsTo(Enfermedad_especifica::class, 'id_enfermedad');   
    }

    public function consulta(){
        return $this->belongsTo(Consulta::class, 'id_consulta');   
    }
    
}
