<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use  Carbon\Carbon;
use App\Models\Alergia;
use App\Models\Especificar_ahf;
use App\Models\Toxicomanias;
use App\Http\Requests\StorePatientRequest;
use Illuminate\Support\Facades\DB;



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


    public function create()
    {
        $breadcrumbs = [
            ['name' => 'Pacientes', 'url' => route('patients.patients')],
            ['name' => 'Agregar paciente', '' => ''],

        ];
        // $tipos_ahf = Tipo_ahf::all();
        $enfermedades = Especificar_ahf::all();
        $toxicomania = Toxicomanias::all();
        $alergias = Alergia::all();
        return view('admin.AddPatient', compact('enfermedades', 'toxicomania', 'alergias', 'breadcrumbs'));
    }


    public function store(StorePatientRequest $request)
    {
        $validate = $request->validated();

        $persona = null;
        $created_by = auth()->user()->id;
        

        DB::transaction(function () use ($validate, &$persona, $created_by) {

            // Insertar la persona
            $dataPersonal = $this->dataPersonalForDB($validate);
            $persona = Persona::create($dataPersonal['dataPerson']);
            
            // Insertar el domicilio
            $persona->domicilio()->create($dataPersonal['dataDomicilio']);

            // Insertar las enfermedades familiares
            $diseasesFamiliar = $this->dataDiseasesFamiliar($validate, $persona->id_persona);
            $persona->persona_ahf()->createMany($diseasesFamiliar);

            // Insertar las enfermedades personales 
            $diseasesPersonal = $this->dataDiseasesPersonal($validate, $persona->id_persona);
            $persona->persona_enfermedades()->createMany($diseasesPersonal['diseases']);
            $persona->persona_alergia()->createMany($diseasesPersonal['allegeries']);
            $persona->hospitalizaciones()->createMany($diseasesPersonal['hopitalizations']);
            $persona->traumatismos()->createMany($diseasesPersonal['traumatisms']);
            $persona->transfusiones()->createMany($diseasesPersonal['transfusions']);
            $persona->ant_quirurgicos()->createMany($diseasesPersonal['cirugies']);

            // Insertar las toxicomanias
            $persona->toxicomanias_persona()->createMany($this->dataDrugsAddiction($validate, $persona->id_persona));   

        });


        // $dataPersonal = $this->dataPersonalForDB($validate);
        // $dataDiseasesFamiliar = $this->dataDiseasesFamiliar($validate, 1);
        // $dataDiseasesPersonal = $this->dataDiseasesPersonal($validate, 1);
        // $dataDrugsAddiction = $this->dataDrugsAddiction($validate, 1);




        return response()->json(['message' => 'Paciente creado correctamente', 'data' => [
            // $dataPersonal,
            auth()->user()->id
            // 'dataPersonal' => $dataPersonal,
            // $validate,
            // $validate['listHereditaryFamilialDiseases'],
            // 'dataDiseasesFamiliar' => $dataDiseasesFamiliar,
            // 'dataDiseasesPersonal' => $dataDiseasesPersonal,
            // 'dataDrugsAddiction' => $dataDrugsAddiction,
        ]], 201);
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

    private function dataPersonalForDB($data)
    {

        return [
            'dataPerson' => [
                'codigo' => $data['code'],
                'nombre' => $data['name'],
                'sexo' => $data['gender'] == '1' ? 'Masculino' : 'Femenino',
                'ocupacion' => $data['career'],
                'fecha_nacimiento' => $data['birthdate'],
                'telefono' => $data['phone'],
                'nss' => $data['nss'],
                'telefono_emerge' => $data['emergencyPhone'],
                'contacto_emerge' => $data['emergencyName'],
                'parentesco_emerge' => $data['relationship'],
                'fecha_registro' => Carbon::now(),
                'religion' => $data['religion'],
                'created_by' => auth()->user()->id,
            ],
            'dataDomicilio' => [
                'calle' => $data['street'],
                'num' => $data['number'],
                'num_intt' => $data['number'],
                'colonia' => $data['colony'],
                'cp' => $data['cp'],
                'municipio' => $data['city'],
                'estado' => $data['state'],
                'pais' => 'México',
            ]
        ];
    }

    private function dataDiseasesFamiliar($data, $id)
    {
        $diseases = [];
        foreach ($data['listHereditaryFamilialDiseases'] as $disease) {
            $diseases[] = [
                'id_ahf' => $disease['id'],
                'id_persona' => $id,
            ];
        }
        return $diseases;
    }

    private function dataDiseasesPersonal($data, $id)
    {
        $diseases = [];
        $allegeries = [];
        $hopitalizations = [];
        $traumatisms = [];
        $transfusions = [];
        $cirugies = [];

        foreach ($data['listPathologicalHistory'] as $item) {
            if ($item['type'] == 'enfermedad') {
                $diseases[] = [
                    'id_enfermedad' => $item['idReferenceTable'],
                    'id_persona' => $id,
                ];
            }

            if ($item['type'] == 'alergia') {
                $allegeries[] = [
                    'id_alergia' => $item['idReferenceTable'],
                    'id_persona' => $id,
                    'especificar' => $item['reason']
                ];
            }

            if ($item['type'] == 'hospitalizacion') {
                $hopitalizations[] = [
                    'fecha' => $item['value'],
                    'id_persona' => $id,
                    'detalles' => $item['reason']
                ];
            }

            if ($item['type'] == 'traumatismo') {
                $traumatisms[] = [
                    'fecha' => $item['value'],
                    'id_persona' => $id,
                    'detalles' => $item['reason']
                ];
            }

            if ($item['type'] == 'transfusion') {
                $transfusions[] = [
                    'fecha' => $item['value'],
                    'id_persona' => $id,
                    'detalles' => $item['reason']
                ];
            }

            if ($item['type'] == 'cirugia') {
                $cirugies[] = [
                    'fecha' => $item['value'],
                    'id_persona' => $id,
                    'detalles' => $item['reason']
                ];
            }
        }
        return [
            'diseases' => $diseases,
            'allegeries' => $allegeries,
            'hopitalizations' => $hopitalizations,
            'traumatisms' => $traumatisms,
            'transfusions' => $transfusions,
            'cirugies' => $cirugies,
        ];
    }

    private function dataDrugsAddiction($data, $id)
    {
        $toxicomanias = [];
        foreach ($data['listDrugAddiction'] as $item) {

            $desde_cuando = Carbon::now()->subYears($item['input1'])->format('Y-m-d');
            $observacion = $item['input2'];



            $toxicomanias[] = [
                'id_toxicomania' => $item['idReferenceTable'],
                'id_persona' => $id,
                'desde_cuando' => $desde_cuando,
                'observacion' => $observacion,
            ];
        }
        return $toxicomanias;
    }
}
