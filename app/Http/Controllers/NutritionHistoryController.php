<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNutritionMedicalRecordRequest;
use App\Models\Persona;
use App\Models\Diateticas;
use App\Models\Estilo_vida;
use App\Models\Nutricional;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NutritionHistoryController extends Controller
{

    // Renderizar la vista de historial de consulta de nutrición
    public function show($id)
    {

        // Breadcrumbs
        $breadcrumbs = [
            ['name' => 'Pacientes', 'url' => route('patients.index')],
            ['name' => 'Expediente del paciente', 'url' => route('admin.medical_record', ['id' => $id])],
            ['name' => 'Historial de consulta de nutrición', '' => ''],
        ];

        // Get the person data
        $person = Persona::findOrfail($id);
        // Get the total of consultations
        $totalConsultas = $person->nutricional()->orderBy('created_at', 'desc')->get()->count();
        // Get the id of the person
        $idPersona = $person->id_persona;

        return view('patients.nutritionHistoryConsultation', compact('idPersona', 'totalConsultas', 'breadcrumbs'));
    }

    // Renderizar la vista de crear historial de consulta de nutrición
    public function create($id)
    {

        $breadcrumbs = [
            ['name' => 'Pacientes', 'url' => route('patients.index')],
            ['name' => 'Expediente del paciente', '' => route('admin.medical_record', ['id' => $id])],
            ['name' => 'Historial de consulta', '' => ''],
        ];

        $person = Persona::findOrFail($id);

        $estiloVida = $person->estilo_vida->last();
        $indicadoresDieteticos = $person->diateticas->last();
        $person->edad = Carbon::parse($person->fecha_nacimiento)->age;
        $dateNow = now()->toDateString();

        if($estiloVida == null || $indicadoresDieteticos == null){
            return view('patients.completeHistoryNutrition', compact('person', 'dateNow', 'breadcrumbs'));
        }

        
        return view('patients.newNutritionConsultation', compact('person', 'dateNow', 'breadcrumbs'));
    }

    // Guardar el historial de consulta de nutrición
    public function store(StoreNutritionMedicalRecordRequest $request)
    {

        try {

            // Validate the request
            $request->validated();


            DB::transaction(function () use ($request) {
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
            });

            return response()->json(['status' => 'success', 'message' => 'Historial guardado correctamente.'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error al guardar el historial de consulta de nutrición.'], 500);
        }
    }

    // Renderizar la vista de detalles de la consulta
    public function details($id_persona, $id_consulta)
    {


        $breadcrumbs = [
            ['name' => 'Pacientes', 'url' => route('patients.index')],
            ['name' => 'Expediente del paciente', 'url' => route('admin.medical_record', ['id' => $id_persona])],
            ['name' => 'Historial de consultas', 'url' => route('nutrition.consultation.history', ['id_persona' => $id_persona])],
            ['name' => 'Detalles de la consulta', '' => ''],
        ];

        // Get data of the nutritional consultation
        $consulta = Nutricional::findOrfail($id_consulta);
        $consulta->fecha = $consulta->created_at->locale('es')->format('h:i:s A') . ' - ' . $consulta->created_at->locale('es')->isoFormat('LL');
        // Get data of the patient
        $person = $consulta->persona;
        $person->edad = Carbon::parse($person->fecha_nacimiento)->age;

        // Get data of the doctor
        $doctor = $consulta->user;

        // Get data of the indicators dietetics
        $indicadoresDieteticos = $consulta->persona->diateticas->last();

        // Get data of the lifestyle
        $estiloVida = $consulta->persona->estilo_vida->last();

        // Get data of the measures
        $medidas = $consulta->medidas;

        // Calculate IMC and classification
        $imc = $this->calculateIMC($medidas->peso_actual, $medidas->estatura);


        return view('patients.detailsNutritionConsultation', compact('consulta', 'person', 'doctor', 'indicadoresDieteticos', 'estiloVida', 'medidas', 'imc', 'breadcrumbs'));
    }

    // Obtener las consultas de la persona de nutrición
    public function getConsultationsPerson(Request $request, $id_persona)
    {

        try {
            // Obtener los parámetros de la url
            $offset = $request->input('offset', 0);
            $limit = $request->input('limit', 10);


            // Obtener las consultas de la persona
            $consultas = Nutricional::where('id_persona', $id_persona)
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
            return response()->json(['message' => 'Error al obtener los registros','data' => $e], 500);
        }
    }


    protected function calculateIMC($peso, $estatura)
    {
        $estatura = $estatura / 100;
        $imc = round($peso / ($estatura * $estatura));

        return $this->clasificacionIMC($imc);
    }

    protected function clasificacionIMC($imc)
    {

        $imcData = [];

        if ($imc < 18.5) {
            $imcData =  [
                'titleImc' => 'Bajo peso',
                'url' => 'bajo-peso.png'
            ];
        } elseif ($imc >= 18.5 && $imc <= 24.9) {
            $imcData =  [
                'titleImc' => 'Normal',
                'url' => 'normal.png'
            ];
        } elseif ($imc >= 25 && $imc <= 29.9) {
            $imcData =  [
                'titleImc' => 'Sobrepeso',
                'url' => 'sobrepeso.png'
            ];
        } elseif ($imc >= 30) {
            $imcData =  [
                'titleImc' => 'Obesidad',
                'url' => 'obesidad.png'
            ];
        } else {
            $imcData =  [
                'titleImc' => 'Error',
                'url' => 'error.png'
            ];
        }

        return $imcData;
    }
}
