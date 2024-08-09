<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Persona;
use App\Models\Nutricional;
use App\Models\Medidas;
use Carbon\Carbon;

class newConsultationNutritionController extends Controller
{
    public function show($id_persona)
    {
        $breadcrumbs = [
            ['name' => 'Pacientes', 'url' => route('patients.index')],
            ['name' => 'Consulta', '' => ''],
        ];

        $person = Persona::findOrFail($id_persona);
        $person->edad = Carbon::parse($person->fecha_nacimiento)->age;
        $dateNow = Carbon::now()->locale('es')->isoFormat('LL');

        $nutricionalData = Nutricional::where('id_persona', $id_persona)->first();
        $medidasData = $nutricionalData ? Medidas::find($nutricionalData->id_medida) : null;

        return view('patients.newConsultationNutrition', compact('person', 'dateNow', 'nutricionalData', 'medidasData', 'breadcrumbs'));
    }

    public function crear($id)
    {
        $person = Persona::findOrFail($id);
        $dateNow = now()->toDateString();
        return view('admin.consulta.crear', compact('person', 'dateNow'));
    }

    public function consulta(Request $request)
    {
        try {
            $request->validate([
                'id_persona' => 'required|numeric|exists:personas,id_persona',
                'vasos_agua' => 'required|integer',
                'motivo_consulta' => 'required|string',
                'toma_medicamentos' => 'required|string',
                'diagnostico' => 'nullable|string',
                'peso_actual' => 'required|numeric',
                'peso_habitual' => 'required|numeric',
                'estatura' => 'required|numeric',
                'circunferencia_cintura' => 'required|numeric',
                'circunferencia_cadera' => 'required|numeric',
            ]);

            // Guardar datos en medidas
            $medidas = Medidas::create([
                'peso_actual' => $request->peso_actual,
                'peso_habitual' => $request->peso_habitual,
                'estatura' => $request->estatura,
                'circunferencia_cintura' => $request->circunferencia_cintura,
                'circunferencia_cadera' => $request->circunferencia_cadera,
            ]);

            // Guardar datos nutricionales
            $nutricional = Nutricional::create([
                'id_persona' => $request->id_persona,
                'id_medida' => $medidas->id_medida,
                'vasos_agua' => $request->vasos_agua,
                'motivo_consulta' => $request->motivo_consulta,
                'toma_medicamentos' => $request->toma_medicamentos,
                'diagnostico' => $request->diagnostico,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            return response()->json(['status' => 'success', 'message' => 'Historial guardado correctamente.'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error en consulta: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Error en el servidor'], 500);
        }
    }
}
