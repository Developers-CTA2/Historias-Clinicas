<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Consulta;
use  Carbon\Carbon;


class PatientsController extends Controller
{
    public function show(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);
        $search = $request->input('search', '');

        $query = Persona::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('codigo', 'like', "%$search%")
                    ->orWhere('nombre', 'like', "%$search%")
                    ->orWhere('sexo', 'like', "%$search%");
            });
        }

        $count = $query->count();
        $data = $query->with('consulta', 'nutricional')->offset($offset)->limit($limit)->get();

        // Mapear los datos para incluir la fecha de la última consulta
        $formattedData = $data->map(function ($paciente) {
            $fecha = optional($paciente->consulta->last())->fecha ?? 'Sin consulta';
            $fecha2 = optional($paciente->nutricional->last())->fecha ?? 'Sin consulta';
            if ($fecha != 'Sin consulta') {
                $consulta = Carbon::parse($fecha)->locale('es')->isoFormat('LL');
            } else {
                $consulta = 'Sin consulta';
            }
            if ($fecha2 != 'Sin consulta') {
                $nutricional = Carbon::parse($fecha2)->locale('es')->isoFormat('LL');
            } else {
                $nutricional = 'Sin consulta';
            }
            return [
                'id' => $paciente->id_persona,
                'codigo' => $paciente->codigo,
                'nombre' => $paciente->nombre,
                'sexo' => $paciente->sexo,
                'consultorio' => $consulta,
                'nutricion' => $nutricional,
            ];
        });

        return response()->json(['results' => $formattedData, 'count' => $count]);
    }


    public function Patients_View()
    {
        $breadcrumbs = [
            ['name' => 'Pacientes', '' => ''],
        ];

        return view('patients.seePatient', compact('breadcrumbs'));
    }

    public function Patient_details($id)
    {
        $Personal = Persona::with([
            'domicilio',
            'persona_enfermedades.enfermedad_especifica',
            'toxicomanias_persona',
            'nutricional'
        ])->find($id);

        if (!$Personal) {
            $breadcrumbs = [
                ['name' => 'Pacientes', '' => ''],
            ];

            return view('patients.seePatient', compact('breadcrumbs'));
        }

        // // Accede a los datos de las relaciones
        // $alergias = $Personal->Persona_alergia;
        // $nutricionales = $Personal->nutricional;
        $domicilio = $Personal->domicilio;
        $enfermedades = $Personal->persona_enfermedades;
        $toxicomanias = $Personal->persona_toxicomanias;
 
        return response()->json($toxicomanias);
        $breadcrumbs = [
            ['name' => 'Pacientes', 'url' =>  route('patients.patients')],
            ['name' => 'Expediente', '' => ''],

        ];
        return view('patients.expediente', compact('breadcrumbs',  'Personal', 'domicilio', 'enfermedades'));
    }
}
