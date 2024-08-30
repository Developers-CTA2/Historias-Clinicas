<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrativo;
use App\Models\Alergia;
use App\Models\Enfermedad_especifica;
use App\Models\Personas_trabajo;
use App\Models\Nombramiento;
use App\Models\Tipo_ahf;
use App\Models\Especificar_ahf;
use App\Models\Toxicomanias;

class addPatientsController extends Controller
{
    //METODO PARA BUSCAR A UNA PERSONA EXISTENTE EN ADMINISTRATIVO
    public function buscarPersona(Request $request)
    {
        $codigo = $request->input('codigo');
        $persona = Administrativo::where('codigo', $codigo)->first();

        if ($persona) {
            // Obtener el primer registro de trabajo asociado a la persona
            $trabajo = $persona->trabajos->first();

            if ($trabajo) {
                // Si hay un registro de trabajo, obtener el nombramiento
                $nombramiento = $trabajo->nombramiento;

                // Buscar el nombre correspondiente al número de nombramiento en la tabla Nombramiento
                $nombreNombramiento = Nombramiento::where('id', $nombramiento)->value('nombre');
            } else {
                // Si no hay registro de trabajo, establecer el nombramiento y su nombre como nulos
                $nombramiento = null;
                $nombreNombramiento = null;
            }

            // Devolver los datos de la persona y el nombramiento
            return response()->json(['existe' => true, 'persona' => $persona, 'nombramiento' => $nombreNombramiento]);
        } else {
            // Persona no encontrada
            return response()->json(['existe' => false]);
        }
    }

    

    //METODO PARA OBTENER LOS TIPOS DE AHF
    public function showForm()
    {

        $breadcrumbs = [
            ['name' => 'Pacientes', 'url' => ''],
            ['name' => 'Agregar paciente', ''=> ''],

        ];
        // $tipos_ahf = Tipo_ahf::all();
        $enfermedades = Enfermedad_especifica::all();
        $toxicomania = Toxicomanias::all();
        $alergias = Alergia::all();
        return view('admin.AddPatient', compact('enfermedades','toxicomania', 'alergias','breadcrumbs'));
    }

    public function getEnfermedadesRelacionadas($tipoAHFId)
    {
        $enfermedades = Enfermedad_especifica::where('id_tipo_ahf', $tipoAHFId)->get();
        return response()->json($enfermedades);
    }
}
