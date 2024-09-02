<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Persona;
use App\Models\Consulta;

class HistoryConsultationController extends Controller
{
    // Renderizar la vista de historial de consulta
    public function show($id_persona)
    {
        $breadcrumbs = [
            ['name' => 'Pacientes', 'url' => route('patients.index')],
            ['name' => 'Historial de consulta', '' => ''],
        ];

        $person = Persona::findOrfail($id_persona);
        $totalConsultas = $person->consulta()->orderBy('created_at', 'desc')->get()->count();
        $idPersona = $person->id_persona;

        return view('patients.historyConsultation', compact('idPersona','totalConsultas' ,'breadcrumbs'));
    }

    public function getConsultationsPerson(Request $request, $id_persona)
    {
        try {
            // Obtener los parámetros de la url
            $offset = $request->input('offset', 0);
            $limit = $request->input('limit', 10);

            // Obtener las consultas de la persona
            

            $consultas = Consulta::where('id_persona', $id_persona)
                ->orderBy('created_at', 'desc')
                ->skip($offset)
                ->take($limit)
                ->get();

            if ($consultas->isEmpty()) {
                return response()->json([]);
            }

            $consultas = $consultas->transform(function ($consulta) {
                $consulta->fecha = $consulta->created_at->locale('es')->format('h:i:s A') . ' - ' . $consulta->created_at->locale('es')->isoFormat('LL');
                return $consulta;
            });

            return response()->json($consultas);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener los registros', 'data' => $e], 500);
        }
    }

// Renderizar la vista de detalles de la consulta
    public function details($id_persona, $id_consulta)
    {

        $breadcrumbs = [
            ['name' => 'Pacientes', 'url' => route('patients.index')],
            ['name' => 'Expediente', 'url' => route('consultation.history',['id_persona' => $id_persona])],
            ['name' => 'Historial de consultas', 'url' => route('consultation.history',['id_persona' => $id_persona])],
            ['name' => 'Detalles de la consulta', '' => ''],
            
        ];

        $consulta = Consulta::findOrfail($id_consulta);
        $person = $consulta->persona;
        $doctor = $consulta->user;
        $signosVitales = $consulta->signos_vitales;
        $person->edad = Carbon::parse($person->fecha_nacimiento)->age;
        $consulta->fecha = $consulta->created_at->locale('es')->format('h:i:s A') . ' - ' . $consulta->created_at->locale('es')->isoFormat('LL');  

        return view('patients.detailsConsultation', compact('consulta', 'person', 'signosVitales','doctor','breadcrumbs'));
    }
}
