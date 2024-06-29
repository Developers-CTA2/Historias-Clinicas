<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';
    protected $primaryKey = 'id_persona';
    public $incrementing = true;
    
    protected $fillable = [
        'codigo',
        'domicilio_id',
        'nombre',
        'domiclio',
        'ocupacion',
        'fecha_nacimiento',
        'sexo',
        'telefono',
        'telefono_emerge',
        'contacto_emerge',
        'parentesco_emerge',
        'escolaridad',
        'nss',
        'fecha_registro',
        'religion',
        'created_by',
        'updated_by',
    ];

    public function Persona_alergia()
    {
        return $this->hasMany(Persona_alergia::class, 'id_persona');
    }

    public function transfusiones()
    {
        return $this->hasMany(Transfusiones::class, 'id_persona');
    }

    public function fracturas()
    {
        return $this->hasMany(Fracturas::class, 'id_persona');
    }

    public function traumatismos()
    {
        return $this->hasMany(Traumatismos::class, 'id_persona');
    }

    public function hospitalizaciones()
    {
        return $this->hasMany(Hospitalizaciones::class, 'id_persona');
    }

    public function ant_quirurgicos()
    {
        return $this->hasMany(Ant_quirurgicos::class, 'id_persona');
    }

    public function persona_ahf()
    {
        return $this->hasMany(Persona_ahf::class, 'id_persona');
    }

    public function persona_enfermedades()
    {
        return $this->hasMany(Persona_enfermedades::class, 'id_persona');
    }

    public function toxicomanias_persona()
    {
        return $this->hasMany(Persona_toxicomanias::class, 'id_persona', 'id_persona');
    }

    public function gyo()
    {
        return $this->hasOne(Gyo::class, 'id_persona');
    }

    public function estilo_vida()
    {
        return $this->hasMany(Estilo_vida::class, 'id_persona');
    }

    public function diateticas()
    {
        return $this->hasMany(Diateticas::class, 'id_persona');
    }

    public function domicilio()
    {
        return $this->belongsTo(Domicilio::class, 'domicilio_id', 'id_domicilio');
    }
    public function consulta()
    {
        return $this->hasMany(Consulta::class, 'id_persona');
    }
    public function nutricional()
    {
        return $this->hasMany(Nutricional::class, 'id_persona');
    }
}
