<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultationRequest;
use HTMLPurifier_Config;
use HTMLPurifier;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Persona;
use App\Models\Consulta;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\error;

class ConsultationController extends Controller
{


    public function create($id_persona)
    {

        $breadcrumbs = [
            ['name' => 'Pacientes', 'url' => route('patients.index')],
            ['name' => 'Expediente', 'url' => route('admin.medical_record', $id_persona)],
            ['name' => 'Historial de consultas', 'url' => route('consultation.history', $id_persona)],
            ['name' => 'Nueva consulta', '' => ''],
        ];

        $person = Persona::findOrfail($id_persona);

    
        $person->edad = Carbon::parse($person->fecha_nacimiento)->age;  
        $dateNow = Carbon::now()->locale('es')->isoFormat('LL');
        // return response()->json($person);

        return view('patients.newConsultation', compact('breadcrumbs', 'person','dateNow'));
    }

    public function store(StoreConsultationRequest $request, $id_persona)
    {

        try {
            $validate = $request->validated();
            $dataConsultation = $this->purifyRequest($validate);
            $dataSignVital = $this->extractSignVitalConsultation($validate);
            $diagnosticLabels = $this->extractDiagnosticLabels($validate['diagnosticLabels']);


            DB::transaction(function () use ($dataConsultation, $dataSignVital, $diagnosticLabels,$id_persona) {

                $person = Persona::findOrfail($id_persona);
                $dataConsultation = $this->completeDataConsultation($dataConsultation);
                $consulta = $person->consulta()->create($dataConsultation);
                $consulta->signos_vitales()->create($dataSignVital);
                $consulta->consulta_has_enfermedad()->attach($diagnosticLabels);
            });

            // Get id of the consultation

            $idConsultation = Consulta::latest()->first()->id_consulta;

            return response()->json(['title' => 'Éxito..', 'message' => 'La consulta se ha guardado correctamente', 'error' => null, 'idConsultation' => $idConsultation]);
        } catch (\Exception $e) {
            Log::error('Error al guardar la consulta del paciente: ' . $e->getMessage());
            return response()->json(['title' => 'Oops.. ha sucedido un error', 'message' => 'Error al guardar la consulta del paciente', 'error' => $e], 500);
        }
    }

    


    private function extractSignVitalConsultation($data)
    {
        return [
            'frecuencia_cardiaca' => $data['frecuenciaCardiaca'],
            'ritmo_respiratorio' => $data['frecuenciaRespiratoria'],
            'presion_arterial' => $data['presionArterial'],
            'peso' => $data['pesoKilogramos'],
            'temperatura' => $data['temperatura'],
            'sindrome_autoinmune_tirogastrico' => $data['satPorcentaje'],
            'glucosa' => $data['glucosa'],
            'talla' => $data['talla'],
        ];
    }

    private function extractDiagnosticLabels($data)
    {
        $diagnosticLabels = [];

        foreach ($data as $label) {
            $diagnosticLabels[] = [
                'id_enfermedad' => $label
            ];
        }

        return $diagnosticLabels;
    }


    private function purifyRequest($request)
    {
        $data = [];

        $data['motivo_consulta'] = $this->purifyHtml($request['reason']);
        $data['exploracion_fisica'] = $this->purifyHtml($request['physical_exam']);
        $data['diagnostico'] = $this->purifyHtml($request['diagnosis']);
        $data['tratamiento'] = $this->purifyHtml($request['treatment']);

        if (isset($request['aux'])) {
            $data['auxiliares_dx_tx_previo'] = $this->purifyHtml($request['aux']);
        }

        if (isset($request['observations'])) {
            $data['observaciones'] = $this->purifyHtml($request['observations']);
        }

        return $data;
    }


    private function purifyHtml($html)
    {
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        return $purifier->purify($html);
    }

    private function completeDataConsultation($data)
    {
        // Obtener la fecha y hora actual
        $horaActual = Carbon::now()->toTimeString();

        $turno = '';

        if($horaActual >= '06:00:00' && $horaActual <= '13:59:59'){
            $turno = 'matutino';
        }else if($horaActual >= '14:00:00' && $horaActual <= '21:59:59'){
            $turno = 'vespertino';
        }else{
            $turno = 'nocturno';
        }

        $data['created_by'] = auth()->id();
        $data['updated_by'] = auth()->id();
        $data['turno']  = $turno;

        return $data;
    }
}
