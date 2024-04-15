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
    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'nombre',
        'domiclio',
        'ocupacion',
        'fecha_nacimiento',
        'sexo',
        'telefono',
        'contacto_emerge',
        'nss',
        'fecha_registro',
        'religion',
        'usuario_reg',
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

    public function persona_taxicomanias()
    {
        return $this->hasMany(Persona_taxicomanias::class, 'id_persona');
    }

    public function gyo()
    {
        return $this->hasMany(Gyo::class, 'id_persona');
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
        return $this->hasMany(Domicilio::class, 'id_persona');
    }

    public function consulta()
    {
        return $this->hasMany(Consulta::class, 'id_persona');
    }
}
