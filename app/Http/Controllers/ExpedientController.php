<?php

namespace App\Http\Controllers;

use App\Models\Alergia;
use App\Models\Consulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Persona;
use App\Models\Persona_ahf;
use App\Models\Enfermedad_especifica;
use App\Models\Escolaridad;
use App\Models\Hemotipo;
use App\Models\Medidas;
use App\Models\Nutricional;
use App\Models\Rep_estado;
use App\Models\Toxicomanias;
use App\Traits\ImcTrait;

class ExpedientController extends Controller
{

    use ImcTrait;

    /* 
        Funcion que obtiene todos los datos del paciente seleccionado, ademas manda el breadcrumb
    */
    public function Patient_details($id)
    {
        $Personal = Persona::with([
            'domicilio.rep_estado',
            'escolaridad',
            'hemotipo',
            'persona_enfermedades.enfermedad_especifica',
            'toxicomanias_persona.toxicomanias',
            'nutricional',
            'persona_ahf.especificar_ahf',
            'Persona_alergia.alergias',
            'transfusiones',
            'hospitalizaciones',
            'traumatismos',
            'ant_quirurgicos',
            'gyo',
        ])->find($id);

        if (!$Personal) { // No existe el paciente
            return redirect()->route('patients.index');
        }

        $domicilio = $Personal->domicilio;
        $enfermedades = $Personal->persona_enfermedades;
        $toxicomanias = $Personal->toxicomanias_persona;
        $ahf = $Personal->persona_ahf;
        $alergias = $Personal->Persona_alergia;
        $transfusiones = $Personal->transfusiones;
        $hospitalizaciones = $Personal->hospitalizaciones;
        $traumatismos = $Personal->traumatismos;
        $quirurgicos = $Personal->ant_quirurgicos;
        $gyo = $Personal->gyo;
        $escolaridad = $Personal->escolaridad;
        $hemotipo = $Personal->hemotipo;
        //return response()->json($ahf);

        $ahfIds = $ahf->pluck('especificar_ahf.id_tipo_ahf');

        $esp_ahf = Enfermedad_especifica::whereNotIn('id_tipo_ahf', $ahfIds)->get();  // No repeat
        $rep_estados = Rep_estado::all();
        $hemotipos = Hemotipo::all();
        $escolaridades = Escolaridad::all();
        $Toxicomanias = Toxicomanias::all();

        $breadcrumbs = [
            ['name' => 'Pacientes', 'url' =>  route('patients.index')],
            ['name' => 'Expediente', '' => ''],

        ];

        // Medidas corporales 
        $Nutri = Nutricional::with(['medidas'])->where('id_persona', $id)->latest()->first();
        $consul = Consulta::with(['signos_vitales'])->where('id_persona', $id)->latest()->first();

        // return response()->json([$Nutri, $consul]);

        $Medidas = $this->Measures($Nutri, $consul);  // Evaluar cual es más reciente
        //return response()->json($Medidas);
        return view('patients.expediente', compact('breadcrumbs', 'Medidas', 'Personal', 'escolaridad', 'hemotipo', 'domicilio', 'enfermedades', 'toxicomanias', 'ahf', 'alergias', 'transfusiones', 'hospitalizaciones', 'quirurgicos', 'traumatismos', 'gyo', 'esp_ahf', 'rep_estados', 'hemotipos', 'escolaridades', 'Toxicomanias'));

    }

    /*
        Funcion para ver los detalles de las enfermedades personales patologicas
    */
    public function Details_APP($id)
    {
        $Personal = Persona::with([
            'persona_enfermedades.enfermedad_especifica',
            'Persona_alergia.alergias',
            'transfusiones',
            'hospitalizaciones',
            'traumatismos',
            'ant_quirurgicos',

        ])->find($id);


        if (!$Personal) { // No existe el paciente
            return redirect()->route('patients.index');
        }

        // Data 
        $alergias = $Personal->Persona_alergia;
        $transfusiones = $Personal->transfusiones;
        $hospitalizaciones = $Personal->hospitalizaciones;
        $traumatismos = $Personal->traumatismos;
        $quirurgicos = $Personal->ant_quirurgicos;
        $enfermedades = $Personal->persona_enfermedades;

        $esp_Ids = $enfermedades->pluck('enfermedad_especifica.id_tipo_ahf');
        $Ant_pp = Enfermedad_especifica::whereNotIn('id_tipo_ahf', $esp_Ids)->get();  // No repeat
        $SelectAlergias = Alergia::all();  // No repeat

        //return response()->json($alergias);

        $breadcrumbs = [
            ['name' => 'Expediente', 'url' =>   route('admin.medical_record', ['id' => $id])],
            ['name' => 'Detalles', '' => ''],

        ];
        return view('patients.expedient_cards.modals_expedient.Details_App', compact('breadcrumbs', 'Ant_pp', 'alergias', 'transfusiones', 'hospitalizaciones', 'traumatismos', 'quirurgicos', 'enfermedades', 'SelectAlergias'));
    }


    /* 
        Funcion para mandar el arreglo de las medidas corporales del registro en caso de tenerlas, si no manda --
    */

    protected function Measures($Nutri, $consul)
    {

        $Medidas = array(
            "Peso" => "--",
            "Estatura" => "--",
            "Estatura" => "--",
            "Cintura" => "--",
            "Cadera" => "--",
        );

        if (empty($Nutri) && empty($consul)) { //Ninguna 
           // return view('patients.expediente', compact('breadcrumbs', 'Medidas', 'Personal', 'escolaridad', 'hemotipo', 'domicilio', 'enfermedades', 'toxicomanias', 'ahf', 'alergias', 'transfusiones', 'hospitalizaciones', 'quirurgicos', 'traumatismos', 'gyo', 'esp_ahf', 'rep_estados', 'hemotipos', 'escolaridades', 'Toxicomanias'));
        } else {
            if (!empty($Nutri) && !empty($consul)) {  // Ambas verificar cual es mas reciente 
                if ($Nutri->created_at > $consul->created_at) {  // nutricion mas reciente Todo de nutricion
                    $Medidas['Peso'] = $Nutri->medidas->peso_actual;
                    $Medidas['Estatura'] = $Nutri->medidas->estatura;
                    $Medidas['Imc'] = $this->calculateIMC($Medidas['Peso'], $Nutri->medidas->estatura); 
                    $Medidas['Cintura'] = $Nutri->medidas->circunferencia_cintura;
                    $Medidas['Cadera'] = $Nutri->medidas->circunferencia_cadera;
                } else { // consulta mas reciente 
                    $Medidas['Peso'] = $consul->signos_vitales->peso;
                    $Medidas['Estatura'] = $consul->signos_vitales->talla;
                    $Medidas['Imc'] = $this->calculateIMC($Medidas['Peso'], $consul->signos_vitales->talla);
                    $Medidas['Cintura'] = $Nutri->medidas->circunferencia_cintura;
                    $Medidas['Cadera'] = $Nutri->medidas->circunferencia_cadera;
                }
            } else {
                if (!empty($Nutri)) {
                    $Medidas['Peso'] = $Nutri->medidas->peso_actual ;
                    $Medidas['Estatura'] = $Nutri->medidas->estatura ;
                    $Medidas['Imc'] = $this->calculateIMC($Medidas['Peso'], $Nutri->medidas->estatura);
                    $Medidas['Cintura'] = $Nutri->medidas->circunferencia_cintura;
                    $Medidas['Cadera'] = $Nutri->medidas->circunferencia_cadera;
                } else {
                    $Medidas['Peso'] = $consul->signos_vitales->peso ?? 0;
                    $talla = $consul->signos_vitales->talla ?? 0;
                    $Medidas['Estatura'] = $talla; 
                    $Medidas['Imc'] = $this->calculateIMC($Medidas['Peso'] , $talla);
                }
            }
        }
        return $Medidas;
    }
}
