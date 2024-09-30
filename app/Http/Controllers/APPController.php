<?php

namespace App\Http\Controllers;

use App\Models\Ant_quirurgicos;
use App\Models\Hospitalizaciones;
use App\Models\Persona_alergia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Persona_enfermedades;
use App\Models\Transfusiones;
use App\Models\Persona;
use App\Models\Traumatismos;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\AllergiesRequest;
use App\Http\Requests\ManageAPPRequest;



class APPController extends Controller
{

    ////// ENFERMEDADES
    /*
    Funcion para agregar una nueva enfermedad desde la vista del Expediente
*/
    public function Add_Disease(Request $request)
    {
        try {
            $messages = [
                'Id_person.required' => 'El ID de la persona es requerido.',
                'Id_person.numeric' => 'El ID de la persona debe ser un número.',
                'Id_person.exists' => 'El ID de la persona NO existe.',
                'Id.required' => 'El ID del la enfermedad es requerido.',
                'Id.numeric' => 'El ID del la enfermedad es válido.',
                'Id.exists' => 'El ID del la enfermedad no existe.',
            ];

            $validator = Validator::make($request->all(), [
                'Id_person' => 'required|numeric|exists:personas,id_persona',
                'Id' => 'required|numeric|exists:enfermedades_especificas,id_especifica_ahf',
            ], $messages);

            if ($validator->fails()) {
                return response()->json(['msg' => "Error en los datos recibidos.", 'errors' => $validator->errors()], 400);
            }

            $Id_Persona = $request['Id_person'];
            $Disease = $request['Id'];
            DB::transaction(function () use ($Id_Persona, $Disease) {
                $Persona_Diseases = new Persona_enfermedades();
                $Persona_Diseases->id_persona = $Id_Persona;
                $Persona_Diseases->id_enfermedad = $Disease;
                $Persona_Diseases->created_at = now();
                $Persona_Diseases->save();
            });

            return response()->json(['title' => 'Éxito', 'message' => 'Toxicomanía agregada correctamente', 'error' => null], 201);
        } catch (\Exception $e) {

            return response()->json(['title' => 'Error', 'message' => 'Ha ocurrido un error al crear el expediente del paciente', 'error' => $e], 500);
        }
    }
    /*
    Funcion para editar una enfermedad del paciente desde la vista del expediente
*/
    public function Update_Disease(Request $request)
    {
        $messages = [
            'Id_reg.required' => 'El ID del registro es requerido.',
            'Id_reg.numeric' => 'El ID del registro debe ser un número.',
            'Id_reg.exists' => 'El ID del registro  NO existe.',
            'Id.required' => 'El ID del la enfermedad es requerido.',
            'Id.numeric' => 'El ID del la enfermedad es válido.',
            'Id.exists' => 'El ID del la enfermedad no existe.',
        ];
        $validator = Validator::make($request->all(), [
            'Id_reg' => 'required|numeric|exists:persona_enfermedades,id',
            'Id' => 'required|numeric|exists:enfermedades_especificas,id_especifica_ahf',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['msg' => "Error en los datos recibidos.", 'errors' => $validator->errors()], 400);
        }
        $Id_reg = $request['Id_reg'];
        $Disease = $request['Id'];
        $registro = Persona_enfermedades::where('id', $Id_reg)->first();
        if ($registro) {
            try {
                DB::transaction(function () use ($registro, $Disease) {
                    $registro->update([
                        'id_enfermedad' => $Disease,
                        'updated_by' => Auth::id()
                    ]);
                });
                return response()->json(['status' => 200]);
            } catch (\Exception $e) {
                return response()->json(['status' => 500, 'error' => $e->getMessage()]);
            }
        } else {
            return response()->json(['status' => 404, 'error' => 'Error al actualizar los datos']);
        }
    }
    /*
    Funcion para eliminar una enfermedad del expediente del paciente
*/
    public function Delete_Disease(Request $request)
    {
        $messages = [
            'Id_reg.required' => 'El ID del registro es requerido.',
            'Id_reg.numeric' => 'El ID del registro debe ser un número.',
            'Id_reg.exists' => 'El ID del registro  NO existe.',
        ];
        $validator = Validator::make($request->all(), [
            'Id_reg' => 'required|numeric|exists:persona_enfermedades,id',
        ], $messages);
        if ($validator->fails()) {
            return response()->json(['msg' => "Error en los datos recibidos.", 'errors' => $validator->errors()], 400);
        }

        $Id_reg = $request['Id_reg'];
        $registro = Persona_enfermedades::where('id', $Id_reg)->first();
        if ($registro) {
            try {
                DB::transaction(function () use ($registro) {
                    $registro->delete();
                });
                return response()->json(['status' => 200]);
            } catch (\Exception $e) {
                return response()->json(['status' => 500, 'error' => $e->getMessage()]);
            }
        } else {
            return response()->json(['status' => 404, 'error' => 'Error al actualizar los datos']);
        }
    }


    //// ALERGIAS 
    /*
    Funcion para agregar una nueva enfermedad desde la vista del Expediente
*/
    public function Store_Allergy(AllergiesRequest $request)
    {
        try {

            $data = $request->validated();

            DB::transaction(function () use ($data) {
                $Persona_Allergy = new Persona_alergia();
                $Persona_Allergy->id_persona = $data['Id_person'];
                $Persona_Allergy->id_alergia = $data['Id'];
                $Persona_Allergy->especificar = $data['Description'];
                $Persona_Allergy->created_at = now();
                $Persona_Allergy->save();
            });

            return response()->json([
                'title' => 'Éxito',
                'message' => 'Toxicomanía agregada correctamente',
                'error' => null
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['title' => 'Error', 'message' => 'Ha ocurrido un error al crear el expediente del paciente', 'error' => $e], 500);
        }
    }

    /*
    Funcion para editar una alergia al paciente desde la vista del expediente
*/
    public function Update_Allergy(AllergiesRequest $request)
    {
        $data = $request->validated();

        $registro = Persona_alergia::where('id', $data['Id_reg'])->first();
        if ($registro) {
            try {
                DB::transaction(function () use ($registro, $data) {
                    $registro->update([
                        'id_alergia' => $data['Id'],
                        'especificar' => $data['Description'],
                        'updated_at' => now(),
                    ]);
                });
                return response()->json(['status' => 200]);
            } catch (\Exception $e) {
                return response()->json(['status' => 500, 'error' => $e->getMessage()]);
            }
        } else {
            return response()->json(['status' => 404, 'error' => 'Error al actualizar los datos']);
        }
    }

    /*
    Funcion para agregar un nuevo registro de Hospitalizacion desde la vista del Expediente
*/
    public function Add_Hospital(ManageAPPRequest $request)
    {
        $data = $request->validated();
        try {

            $Personal = Persona::find($data['Id_person']);

            if (!$Personal) { // No existe el paciente
                return response()->json(['message' => 'El ID recibido no pertenece a ningun paciente'], 404);
            }

            DB::transaction(function () use ($data) {
                $Hospitalizacion = new Hospitalizaciones();
                $Hospitalizacion->id_persona = $data['Id_person'];
                $Hospitalizacion->fecha = $data['Date'];
                $Hospitalizacion->detalles = $data['Description'];
                $Hospitalizacion->created_at = now();
                $Hospitalizacion->save();
            });

            return response()->json(['message' => 'Registro de hospitalizacíon agregado correctamente.', 'error' => null], 201);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Algo salio mal al realizar la petición.', 'error' => $e->getMessage()], 500);
        }
    }

    /*
    Funcion para hacer un update a un registro de una hospitalizacion
*/
    public function Update_Hospital(ManageAPPRequest $request)
    {
        $data = $request->validated();
        try {
            $registro = Hospitalizaciones::where('id', $data['Id_person'])->first();
            if (!$registro) {
                return response()->json(['message' => 'El ID recibido no pertenece a ningun registro de hospitalizaciones'], 404);
            }
            DB::transaction(function () use ($registro, $data) {
                $registro->update([
                    'detalles' => $data['Description'],
                    'fecha' => $data['Date'],
                    'updated_at' => now(),
                ]);
            });
            return response()->json(['message' => 'Registro de hospitalizacíon actualizado correctamente.', 'error' => null], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Algo salio mal al realizar la petición.', 'error' => $e->getMessage()], 500);
        }
    }

    /*
    Funcion para agregar un nuevo registro de una transfusion desde la vista del Expediente
*/
    public function Add_Transfusion(ManageAPPRequest $request)
    {
        $data = $request->validated();

        try {

            $Personal = Persona::find($data['Id_person']);
            if (!$Personal) { // No existe el paciente
                return response()->json(['message' => 'El ID recibido no pertenece a ningun paciente'], 404);
            }
            DB::transaction(function () use ($data) {
                $Hospitalizacion = new Transfusiones();
                $Hospitalizacion->id_persona = $data['Id_person'];
                $Hospitalizacion->fecha = $data['Date'];
                $Hospitalizacion->detalles = $data['Description'];
                $Hospitalizacion->created_at = now();
                $Hospitalizacion->save();
            });
            return response()->json(['message' => 'Registro de transfusión agregado correctamente.', 'error' => null], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Algo salio mal al realizar la petición.', 'error' => $e->getMessage()], 500);
        }
    }

    /*
    Funcion para hacer un update en un registro de una transfusion 
*/

    public function Update_Transfusion(ManageAPPRequest $request)
    {
        $data = $request->validated();
        try {

            $registro = Transfusiones::where('id', $data['Id_person'])->first();
            if (!$registro) {
                return response()->json(['message' => 'El ID recibido no pertenece a ningun registro de transfusiones'], 404);
            }
            DB::transaction(function () use ($registro, $data) {
                $registro->update([
                    'detalles' => $data['Description'],
                    'fecha' => $data['Date'],
                    'updated_at' => now(),
                ]);
            });

            return response()->json(['message' => 'Registro de transfusión actualizado correctamente.', 'error' => null], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ha ocurrido un error al crear el expediente del paciente', 'error' => $e], 500);
        }
    }

    /*
    Funcion para agregar un nuevo registro de una cirugia desde la vista del Expediente
*/
    public function Add_Surgery(ManageAPPRequest $request)
    {
        $data = $request->validated();
        try {

            $Personal = Persona::find($data['Id_person']);
            if (!$Personal) { // No existe el paciente
                return response()->json(['message' => 'El ID recibido no pertenece a ningun paciente'], 404);
            }

            DB::transaction(function () use ($data) {
                $Ant_Quirurgicos = new Ant_quirurgicos();
                $Ant_Quirurgicos->id_persona = $data['Id_person'];
                $Ant_Quirurgicos->fecha = $data['Date'];
                $Ant_Quirurgicos->detalles = $data['Description'];
                $Ant_Quirurgicos->created_at = now();
                $Ant_Quirurgicos->save();
            });

            return response()->json(['message' => 'Registro de cirugía agregado correctamente.', 'error' => null], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Algo salio mal al realizar la petición.', 'error' => $e->getMessage()], 500);
        }
    }

    /*
        Funcion para hacer un update en un regostro de una cirugia 
    */
    public function Update_Surgery(ManageAPPRequest $request)
    {
        $data = $request->validated();
        try {
            $registro = Ant_quirurgicos::where('id', $data['Id_person'])->first();
            if (!$registro) {
                return response()->json(['message' => 'El ID recibido no pertenece a ningun registro de cirugías.'], 404);
            }

            DB::transaction(function () use ($registro, $data) {
                $registro->update([
                    'detalles' => $data['Description'],
                    'fecha' => $data['Date'],
                    'updated_at' => now(),
                ]);
            });
            return response()->json(['message' => 'Registro de cirugía actualizado correctamente.', 'error' => null], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Algo salio mal al realizar la petición.', 'error' => $e->getMessage()], 500);
        }
    }

    /*
    Funcion para agregar un nuevo registro de un traumatismo desde la ventana de expediente
*/
    public function Add_Trauma(ManageAPPRequest $request)
    {
        $data = $request->validated();
        try {

            $Personal = Persona::find($data['Id_person']);
            if (!$Personal) { // No existe el paciente
                return response()->json(['message' => 'El ID recibido no pertenece a ningun paciente'], 404);
            }
            DB::transaction(function () use ($data) {
                $Ant_Quirurgicos = new Traumatismos();
                $Ant_Quirurgicos->id_persona = $data['Id_person'];
                $Ant_Quirurgicos->fecha = $data['Date'];
                $Ant_Quirurgicos->detalles = $data['Description'];
                $Ant_Quirurgicos->created_at = now();
                $Ant_Quirurgicos->save();
            });

            return response()->json(['message' => 'Registro de traumatismo agregado correctamente.', 'error' => null], 201);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Algo salio mal al realizar la petición.', 'error' => $e->getMessage()], 500);
        }
    }

    /*
    Funcion para hacer un update en un registro de un traumatismo 
*/
    public function Update_Trauma(ManageAPPRequest $request)
    {
        $data = $request->validated();
        try {
            $registro = Traumatismos::where('id', $data['Id_person'])->first();
            if (!$registro) {
                return response()->json(['message' => 'El ID recibido no pertenece a ningun registro de traumatismos.'], 404);
            }
            DB::transaction(function () use ($registro, $data) {
                $registro->update([
                    'detalles' => $data['Description'],
                    'fecha' => $data['Date'],
                    'updated_at' => now(),
                ]);
            });
            return response()->json(['message' => 'Registro de traumatismo actualizado correctamente.', 'error' => null], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Algo salio mal al realizar la petición.', 'error' => $e->getMessage()], 500);
        }
    }
}
