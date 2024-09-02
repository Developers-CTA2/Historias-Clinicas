<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNutritionConsultation;
use App\Models\Medidas;
use App\Models\Nutricional;
use App\Models\Persona;
use Carbon\Carbon;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NutritionConsultationController extends Controller
{
    //

    public function create($id_persona)
    {

        $data = $id_persona;

        $breadcrumbs = [
            ['name' => 'Pacientes', 'url' => route('patients.index')],
            ['name' => 'Expediente del paciente', '' => route('admin.medical_record', ['id' => $id_persona])],
            ['name' => 'Nueva consulta de nutrición', '' => '']
        ];

        $person = Persona::findOrFail($id_persona);
        $person->edad = Carbon::parse($person->fecha_nacimiento)->age;
        $dateNow = Carbon::now()->locale('es')->isoFormat('LL');

        $nutricionalData = Nutricional::where('id_persona', $id_persona)->first();
        $medidasData = $nutricionalData ? Medidas::find($nutricionalData->id_medida) : null;


        return view('patients.newNutritionConsultation', compact('person', 'dateNow', 'nutricionalData', 'medidasData', 'breadcrumbs'));
    }

    public function store(StoreNutritionConsultation $request)
    {
        try {

            $validate = $request->validated();
        

            DB::transaction(function () use ($validate) {
                // Guardar datos en medidas
                $medidas = Medidas::create([
                    'peso_actual' => $validate['peso_actual'],
                    'peso_habitual' => $validate['peso_habitual'],
                    'estatura' => $validate['estatura'],
                    'circunferencia_cintura' => $validate['circunferencia_cintura'],
                    'circunferencia_cadera' => $validate['circunferencia_cadera'],
                ]);

                $consulta = $medidas->nutricional()->create([
                    'id_persona' => $validate['id_persona'],
                    'id_medida' => $medidas->id_medida,
                    'vasos_agua' => $validate['vasos_agua'],
                    'motivo_consulta' => $validate['motivo_consulta'],
                    'toma_medicamentos' => $validate['toma_medicamentos'],
                    'diagnostico' => $validate['diagnostico'],
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                ]);

                
            });

            // Get last consultation
            $id_consulta = Nutricional::where('id_persona',$validate['id_persona'])->get()->last()->id_nutricional;

            return response()->json(['status' => 'success', 'message' => 'Historial guardado correctamente.','idPersona' => $validate['id_persona'], 'idConsulta' => $id_consulta ], 200);
        } catch (\Exception $e) {
            Log::error('Error en consulta: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Error en el servidor'], 500);
        }
    }
}
