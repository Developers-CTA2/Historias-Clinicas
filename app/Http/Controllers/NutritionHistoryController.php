<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Diateticas;
use App\Models\Estilo_vida;
use Carbon\Carbon;

class NutritionHistoryController extends Controller
{
    public function show($id_persona)
    {
        $breadcrumbs = [
            ['name' => 'Pacientes', 'url' => route('patients.index')],
            ['name' => 'Historial de consulta', '' => ''],
        ];

        $person = Persona::findOrFail($id_persona);
        $person->edad = Carbon::parse($person->fecha_nacimiento)->age;
        $dateNow = Carbon::now()->locale('es')->isoFormat('LL');

        $indicadores = Diateticas::where('id_persona', $id_persona)->get();
        $estiloVida = Estilo_vida::where('id_persona', $id_persona)->get();

        return view('patients.historyNutrition', compact('person', 'dateNow', 'indicadores', 'estiloVida', 'breadcrumbs'));
    }

    public function create($id)
    {

        $breadcrumbs = [
            ['name' => 'Pacientes', 'url' => route('patients.index')],
            ['name' => 'Historial de consulta', '' => ''],
        ];

        $person = Persona::findOrFail($id);
        $dateNow = now()->toDateString();
        return view('patients.newConsultationNutrition', compact('person', 'dateNow', 'breadcrumbs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_persona' => 'required|numeric|exists:personas,id_persona',
            'comidas_al_dia' => 'required|integer',
            'qien_prepara_comida' => 'required|string',
            'apetito' => 'required|string',
            'alimentos_no_preferidos' => 'nullable|string',
            'suplementos' => 'nullable|string',
            'grasas_consumidas' => 'nullable|string',
            'actividad' => 'required|string',
            'tipo_ejercicio' => 'required|string',
            'frecuencia_ejercicio' => 'required|string',
            'duracion_ejercicio' => 'required|string',
        ]);

        $indicadoresDieteticos = new Diateticas([
            'id_persona' => $request->id_persona,
            'comidas_al_dia' => $request->comidas_al_dia,
            'qien_prepara_comida' => $request->qien_prepara_comida,
            'apetito' => $request->apetito,
            'alimentos_no_preferidos' => $request->alimentos_no_preferidos,
            'suplementos' => $request->suplementos,
            'grasas_consumidas' => $request->grasas_consumidas,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);
        $indicadoresDieteticos->save();

        $estiloVida = new Estilo_Vida([
            'id_persona' => $request->id_persona,
            'actividad' => $request->actividad,
            'tipo_ejercicio' => $request->tipo_ejercicio,
            'frecuencia_ejercicio' => $request->frecuencia_ejercicio,
            'duracion_ejercicio' => $request->duracion_ejercicio,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);
        $estiloVida->save();

        return response()->json(['status' => 'success', 'message' => 'Historial guardado correctamente.'], 200);
    }
}
