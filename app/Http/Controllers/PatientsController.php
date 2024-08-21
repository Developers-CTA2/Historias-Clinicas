<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use  Carbon\Carbon;
use App\Models\Alergia;
use App\Models\Enfermedad_especifica;
use App\Models\Toxicomanias;
use App\Http\Requests\StorePatientRequest;
use App\Models\Hemotipo;
use App\Models\Domicilio;
use App\Models\Escolaridad;
use App\Models\Rep_estado;
use Illuminate\Support\Facades\DB;



class PatientsController extends Controller
{

    /*
     Funcion que retorna la vista de Ver pacientes junto con el breadcrumb
    */
    public function index()
    {
        $breadcrumbs = [
            ['name' => 'Pacientes', '' => ''],
        ];

        return view('patients.seePatient', compact('breadcrumbs'));
    }

    /* 
    Funcion para mostrar los pacientes registrados en el sistema
    */
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
            ['name' => 'Pacientes', 'url' => route('patients.index')],
            ['name' => 'Agregar paciente', '' => ''],

        ];
        // $tipos_ahf = Tipo_ahf::all();
        $enfermedades = Enfermedad_especifica::all();
        $toxicomania = Toxicomanias::all();
        $alergias = Alergia::all();
        $hemotipos = Hemotipo::all();
        $escolidades = Escolaridad::all();
        $estados = Rep_estado::all();

        return view('admin.AddPatient', compact('enfermedades', 'toxicomania', 'alergias', 'breadcrumbs', 'hemotipos', 'escolidades', 'estados'));
    }


    public function store(StorePatientRequest $request)
    {

        try {
            
            $validate = $request->validated();

            DB::transaction(function () use ($validate) {


                // Obtener los datos necesarios para la inserción
                $dataPersonal = $this->dataPersonalForDB($validate);

                // Insertar el domicilio
                $domicilio = Domicilio::create($dataPersonal['dataDomicilio']);
                // Insertar la persona
                $persona = $domicilio->persona()->create($dataPersonal['dataPerson']);

                // Insertar las enfermedades familiares
                $diseasesFamiliar = $this->dataDiseasesFamiliar($validate);
                $persona->persona_ahf()->createMany($diseasesFamiliar);

                // Insertar las enfermedades personales 
                $diseasesPersonal = $this->dataDiseasesPersonal($validate);
                $persona->persona_enfermedades()->createMany($diseasesPersonal['diseases']);
                $persona->persona_alergia()->createMany($diseasesPersonal['allegeries']);
                $persona->hospitalizaciones()->createMany($diseasesPersonal['hopitalizations']);
                $persona->traumatismos()->createMany($diseasesPersonal['traumatisms']);
                $persona->transfusiones()->createMany($diseasesPersonal['transfusions']);
                $persona->ant_quirurgicos()->createMany($diseasesPersonal['cirugies']);

                // Insertar las toxicomanias
                $persona->toxicomanias_persona()->createMany($this->dataDrugsAddiction($validate));

                // Si es mujer, insertar los datos de embarazo
                if ($dataPersonal['dataPerson']['sexo'] == 'Femenino') {
                    $gyo = $this->dataGyo($validate);
                    $persona->gyo()->create($gyo);
                }
            });



            return response()->json(['title' => 'Éxito', 'message' => 'Expediente del paciente creado correctamente', 'error' => null], 201);
        } catch (\Exception $e) {
            return response()->json(['title' => 'Error', 'message' => 'Ha ocurrido un error al crear el expediente del paciente', 'error' => $e], 500);
        }
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
                'hemotipo_id' => $data['bloodType'],
                'escolaridad_id' => $data['scholarship'],
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
                'cuidad_municipio' => $data['city'],
                'estado_id' => $data['state'],
                'pais' => 'México',
                'created_by' => auth()->user()->id,
            ]
        ];
    }

    private function dataDiseasesFamiliar($data)
    {
        $diseases = [];
        foreach ($data['listHereditaryFamilialDiseases'] as $disease) {
            $diseases[] = [
                'id_ahf' => $disease['id']
            ];
        }
        return $diseases;
    }

    private function dataDiseasesPersonal($data)
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
                    'id_enfermedad' => $item['idReferenceTable']
                ];
            }

            if ($item['type'] == 'alergia') {
                $allegeries[] = [
                    'id_alergia' => $item['idReferenceTable'],
                    'especificar' => $item['reason']
                ];
            }

            if ($item['type'] == 'hospitalizacion') {
                $hopitalizations[] = [
                    'fecha' => $item['value'],
                    'detalles' => $item['reason']
                ];
            }

            if ($item['type'] == 'traumatismo') {
                $traumatisms[] = [
                    'fecha' => $item['value'],
                    'detalles' => $item['reason']
                ];
            }

            if ($item['type'] == 'transfusion') {
                $transfusions[] = [
                    'fecha' => $item['value'],
                    'detalles' => $item['reason']
                ];
            }

            if ($item['type'] == 'cirugia') {
                $cirugies[] = [
                    'fecha' => $item['value'],
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

    private function dataDrugsAddiction($data)
    {
        $toxicomanias = [];
        foreach ($data['listDrugAddiction'] as $item) {

            $desde_cuando = Carbon::now()->subYears($item['date'])->format('Y-m-d');
            $observacion = $item['description'];



            $toxicomanias[] = [
                'id_toxicomania' => $item['idReferenceTable'],
                'desde_cuando' => $desde_cuando,
                'observacion' => $observacion,
            ];
        }
        return $toxicomanias;
    }

    private function dataGyo($data)
    {

        $gyo = $data['listGynecologyObstetrics'];

        return [
            'menarca' => $gyo['menarca'],
            'fecha_um' => $gyo['fum'],
            's_gestacion' => $gyo['estaEmbarazada'] ? Carbon::now()->diffInWeeks($gyo['fum']) : 0,
            'dias_x_dias' => $gyo['diasSangrado'] . ',' . $gyo['diasCiclo'],
            'ciclos' => $gyo['cicloRegular'] ? 'Regular' : 'Irregular',
            'ivs' => $gyo['inicioVidaSexual'],
            'parejas_s' => 2,
            'gestas' => $gyo['numGestas'] + $gyo['numPartos'] + $gyo['numAbortos'] + $gyo['numCesareas'],
            'partos' => $gyo['numPartos'],
            'abortos' => $gyo['numAbortos'],
            'cesareas' => $gyo['numCesareas'],
            'fecha_citologia' => $gyo['fechaCitologia'],
            'metodo' => $gyo['metodoDescriptivo'],
            'mastografia' => $gyo['mastografia'],
        ];
    }
}
