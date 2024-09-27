<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNutritionMedicalRecordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Persona;
use  Carbon\Carbon;
use App\Models\Alergia;
use App\Models\Enfermedad_especifica;
use App\Models\Toxicomanias;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePersonalDataRequest;
use App\Models\Diateticas;
use App\Models\Hemotipo;
use App\Models\Domicilio;
use App\Models\Escolaridad;
use App\Models\Estilo_vida;
use App\Models\Rep_estado;



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
            $fecha = optional($paciente->consulta->last())->created_at ?? 'Sin consulta';
            $fecha2 = optional($paciente->nutricional->last())->created_at ?? 'Sin consulta';
            if ($fecha != 'Sin consulta') {
                $consulta =
                Carbon::parse($fecha)->locale('es')->isoFormat('D [de] MMM [de] YYYY');
            } else {
                $consulta = 'Sin consulta';
            }
            if ($fecha2 != 'Sin consulta') {
                $nutricional = Carbon::parse($fecha2)->locale('es')->isoFormat('D [de] MMM [de] YYYY');
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
        $toxicomanias = Toxicomanias::all();
        $alergias = Alergia::all();
        $hemotipos = Hemotipo::all();
        $escolidades = Escolaridad::all();
        $estados = Rep_estado::all();

        return view('admin.AddPatient', compact('enfermedades', 'toxicomanias', 'alergias', 'breadcrumbs', 'hemotipos', 'escolidades', 'estados'));
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


    // Store the data of nutrition patient

    public function nutritionStore(StoreNutritionMedicalRecordRequest $request)
    {
        try {

            $validate = $request->validated();

            DB::transaction(function () use ($validate) {
                $indicadoresDieteticos = new Diateticas([
                    'id_persona' => $validate['id_persona'],
                    'comidas_al_dia' => $validate['comidas_al_dia'],
                    'qien_prepara_comida' => $validate['qien_prepara_comida'],
                    'apetito' => $validate['apetito'],
                    'alimentos_no_preferidos' => $validate['alimentos_no_preferidos'],
                    'suplementos' => $validate['suplementos'],
                    'grasas_consumidas' => $validate['grasas_consumidas'],
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                ]);
                $indicadoresDieteticos->save();

                $estiloVida = new Estilo_vida([
                    'id_persona' => $validate['id_persona'],
                    'actividad' => $validate['actividad'],
                    'tipo_ejercicio' => $validate['tipo_ejercicio'],
                    'frecuencia_ejercicio' => $validate['frecuencia_ejercicio'],
                    'duracion_ejercicio' => $validate['duracion_ejercicio'],
                    'created_by' => auth()->user()->id,
                    'updated_by' => auth()->user()->id,
                ]);
                $estiloVida->save();
            });

            return response()->json(['status' => 'success', 'message' => 'Historial guardado correctamente, el historial se ha completado. Enseguida te redireccionará para generar la consulta','idPersona'=> $validate['id_persona']], 200);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error al guardar el historial', 'error' => $e], 500);
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

                // Eliminar enfermedades familiares que se repiten en personales
                $diseases = array_unique($diseases, SORT_REGULAR);

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
            'gestas' => $gyo['numPartos'] + $gyo['numAbortos'] + $gyo['numCesareas'],
            'partos' => $gyo['numPartos'],
            'abortos' => $gyo['numAbortos'],
            'cesareas' => $gyo['numCesareas'],
            'fecha_citologia' => $gyo['fechaCitologia'],
            'metodo' => $gyo['metodoDescriptivo'],
            'mastografia' => $gyo['mastografia'],
        ];
    }

    /*  
        Funcion para hacer un update en los datos del paciente 
    */
    public function Update_Personal_Data(UpdatePersonalDataRequest $request)
    {
        $data = $request->validated();

        // $data = $request->validate([
        //     'Type' => 'required|numeric',
        //     'Id_dom' => 'required|numeric',
        //     'Id' => 'required|numeric|exists:personas,id_persona',
        //     'Direction.country' => 'required|string',
        //     'Direction.state' => 'required|numeric|exists:rep_estado,id_estado',
        //     'Direction.city' => 'required|string',
        //     'Direction.colony' => 'required|string',
        //     'Direction.cp' => 'required|numeric',
        //     'Direction.street' => 'required|string',
        //     'Direction.ext' => 'required|numeric',
        //     'Direction.int' => 'nullable|string',
        //     'Personal.name' => 'required|string',
        //     'Personal.tel' => 'required|string',
        //     'Personal.gender' => 'required|string',
        //     'Personal.birthday' => 'required|date',
        //     'Personal.religion' => 'required|string',
        //     'Personal.ocupation' => 'required|string',
        //     'Personal.nss' => 'required|numeric',
        //     'Personal.name_e' => 'required|string',
        //     'Personal.tel_e' => 'required|string',
        //     'Personal.parent_e' => 'required|string',
        //     'Personal.school' => 'required|numeric|exists:escolaridad,id_escolaridad',
        // ]);

        $name = $data['Personal']['name'];
        $tel = $data['Personal']['tel'];
        $birthday = $data['Personal']['birthday'];
        $gender = $data['Personal']['gender'];
        $religion = $data['Personal']['religion'];
        $ocupation = $data['Personal']['ocupation'];
        $nss = $data['Personal']['nss'];
        $name_e = $data['Personal']['name_e'];
        $tel_e = $data['Personal']['tel_e'];
        $parent_e = $data['Personal']['parent_e'];
        $school = $data['Personal']['school'];

        $country = $data['Direction']['country'];
        $state = $data['Direction']['state'];
        $city = $data['Direction']['city'];
        $cp = $data['Direction']['cp'];
        $colony = $data['Direction']['colony'];
        $num_int = $data['Direction']['int'];
        $ext = $data['Direction']['ext'];
        $street = $data['Direction']['street'];
        $Id = $data['Id'];

        //  return response()->json($data);

        switch ($data['Type']) {
            case 1: {  // Solo cambiaron los datos personales 
                    $Personal = Persona::where('id_persona', $Id)->first();

                    DB::transaction(function () use ($name, $tel, $birthday, $gender, $religion, $ocupation, $nss, $name_e, $tel_e, $parent_e, $Personal, $school) {
                        $Personal->update([
                            'nombre' => $name,
                            'ocupacion' => $ocupation,
                            'fecha_nacimiento' => $birthday,
                            'escolaridad_id' => $school,
                            'sexo' => $gender,
                            'telefono' => $tel,
                            'telefono_emerge' => $tel_e,
                            'contacto_emerge' => $name_e,
                            'parentesco_emerge' => $parent_e,
                            'nss' => $nss,
                            'religion' => $religion,
                            'updated_by' => Auth::id()
                        ]);
                    });
                    return response()->json(['status' => 200, 'msg' => 'Datos actualizados correctamente.']);
                }
            case 2: {    // Solo cambiaron los datos del domicilio
                    $Domicilio = Domicilio::where('id_domicilio', $data['Id_dom'])->first();

                    if ($Domicilio) {
                        DB::transaction(function () use ($country, $state, $city, $cp, $colony, $num_int, $ext, $street, $Domicilio) {
                            $Domicilio->update([
                                'cuidad_municipio' => $city,
                                'estado_id' => $state,
                                'pais' => $country,
                                'calle' => $street,
                                'num' => $ext,
                                'num_int' => $num_int,
                                'colonia' => $colony,
                                'cp' => $cp,
                                'updated_by' => Auth::id()
                            ]);
                        });
                        return response()->json(['status' => 200, 'msg' => 'Datos actualizados correctamente.']);
                    } else {
                        return response()->json(['msg' => 'Error al actualizar los datos.'], 404);
                    }
                }
            case 3: {   // Cambiaron los datos del domicilio y personales
                    $Personal = Persona::where('id_persona', $data['Id'])->first();
                    $Domicilio = Domicilio::where('id_domicilio', $data['Id_dom'])->first();

                    DB::transaction(function () use ($name, $tel, $birthday, $gender, $religion, $ocupation, $nss, $name_e, $tel_e, $parent_e, $country, $street, $ext, $num_int, $colony, $cp, $city, $state, $Personal, $Domicilio) {
                        $Personal->update([
                            'nombre' => $name,
                            'ocupacion' => $ocupation,
                            'fecha_nacimiento' => $birthday,
                            'sexo' => $gender,
                            'telefono' => $tel,
                            'telefono_emerge' => $tel_e,
                            'contacto_emerge' => $name_e,
                            'parentesco_emerge' => $parent_e,
                            'nss' => $nss,
                            'religion' => $religion,
                            'updated_by' => Auth::id()

                        ]);

                        $Domicilio->update([
                            'ciudad_municipio' => $city,
                            'estado_id' => $state,
                            'pais' => $country,
                            'calle' => $street,
                            'num' => $ext,
                            'num_int' => $num_int,
                            'colonia' => $colony,
                            'cp' => $cp,
                            'updated_by' => Auth::id()

                        ]);
                    });
                    return response()->json(['status' => 200, 'msg' => 'Datos actualizados correctamente.']);
                }
        }
        return response()->json(['status' => 404, 'msg' => 'Error al actualizar los datos']);
    }
}
