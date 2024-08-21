<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Persona;
use App\Models\Persona_ahf;
use App\Models\Enfermedad_especifica;
use App\Models\Escolaridad;
use App\Models\Hemotipo;
use App\Models\Rep_estado;
use App\Models\Toxicomanias;
use App\Http\Requests\AddictionsRequest;
use App\Models\Persona_toxicomanias;
use  Carbon\Carbon;


class ExpedientController extends Controller
{
    /* 
        Funcion que obtiene todos los datos del paciente seleccionado, ademas mande el breadcrumb
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

        if (!$Personal) {

            $breadcrumbs = [
                ['name' => 'Pacientes', '' => ''],
            ];

            return view('patients.seePatient', compact('breadcrumbs'));
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

        //return response()->json($escolaridad);

        $breadcrumbs = [
            ['name' => 'Pacientes', 'url' =>  route('patients.index')],
            ['name' => 'Expediente', '' => ''],

        ];
        return view('patients.expediente', compact('breadcrumbs',  'Personal', 'escolaridad', 'hemotipo', 'domicilio', 'enfermedades', 'toxicomanias', 'ahf', 'alergias', 'transfusiones', 'hospitalizaciones', 'quirurgicos', 'traumatismos', 'gyo', 'esp_ahf', 'rep_estados', 'hemotipos', 'escolaridades', 'Toxicomanias'));
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

        // No existe la persona
        if (!$Personal) {
            $breadcrumbs = [
                ['name' => 'Pacientes', '' => ''],
            ];

            return view('patients.seePatient', compact('breadcrumbs'));
        }
        // Data 
        $alergias = $Personal->Persona_alergia;
        $transfusiones = $Personal->transfusiones;
        $hospitalizaciones = $Personal->hospitalizaciones;
        $traumatismos = $Personal->traumatismos;
        $quirurgicos = $Personal->ant_quirurgicos;
        $enfermedades = $Personal->persona_enfermedades;

        $esp_Ids = $enfermedades->pluck('especificar_ahf.id_tipo_ahf');
        $Ant_pp = Enfermedad_especifica::whereNotIn('id_tipo_ahf', $esp_Ids)->get();  // No repeat
        $Ant_pp = Enfermedad_especifica::whereNotIn('id_tipo_ahf', $esp_Ids)->get();  // No repeat

        return response()->json($Ant_pp);

        $breadcrumbs = [
            ['name' => 'Expediente', 'url' =>   route('admin.medical_record', ['id' => $id])],
            ['name' => 'Detalles', '' => ''],

        ];
        return view('patients.expedient_cards.modals_expedient.Details_App', compact('breadcrumbs', 'Ant_pp'));
    }


    /*
    Funcion para agregar una nueva toxicomania desde la vista del Expediente
*/
    public function Add_Adiction(AddictionsRequest $request)
    {
        try {
            $validate = $request->validated();

            $Id_Persona = $validate['IdPerson'];
            $Data = $validate['Data'];
            DB::transaction(function () use ($Id_Persona, $Data) {
                $Persona_Addiction = new Persona_toxicomanias();
                $Persona_Addiction->id_persona = $Id_Persona;
                $Persona_Addiction->id_toxicomania = $Data['idReferenceTable'];
                $Persona_Addiction->observacion = $Data['description'];
                $Persona_Addiction->desde_cuando =
                    Carbon::now()->subYears($Data['date'])->format('Y-m-d');
                $Persona_Addiction->created_at = now();
                $Persona_Addiction->save();
            });

            return response()->json(['title' => 'Éxito', 'message' => 'Toxicomanía agregada correctamente', 'error' => null], 201);
        } catch (\Exception $e) {

            return response()->json(['title' => 'Error', 'message' => 'Ha ocurrido un error al crear el expediente del paciente', 'error' => $e], 500);
        }
    }
}
