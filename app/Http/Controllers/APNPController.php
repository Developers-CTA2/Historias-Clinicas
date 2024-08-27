<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Persona;
use App\Http\Requests\AddictionsRequest;
use App\Models\Persona_toxicomanias;
use  Carbon\Carbon;

class APNPController extends Controller
{
    /*
        Funcion para hacer el update en la escolaridad de algun registro  
    */
    public function Update_School(Request $request)
    {
        $messages = [
            'Id_person.required' => 'El ID de la persona es requerido.',
            'Id_person.numeric' => 'El ID de la persona debe ser un número.',
            'Id_person.exists' => 'El ID de la persona NO existe.',
            'Id_school.numeric' => 'El dato de la escoalridad no es válido.',
            'Id_school.exists' => 'La escolaridad no es válida.',
        ];

        $validator = Validator::make($request->all(), [
            'Id_person' => 'required|numeric|exists:personas,id_persona',
            'Id_school' => 'required|numeric|exists:escolaridad,id_escolaridad',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['msg' => "Error en los datos recibidos.", 'errors' => $validator->errors()], 400);
        }

        $Id =  intval($request['Id_person']);
        $Id_school = intval($request['Id_school']);

        $school = Persona::where('id_persona', $Id)->first();

        if ($school) {
            try {
                DB::transaction(function () use ($school, $Id_school) {
                    $school->update([
                        'escolaridad_id' => $Id_school,
                    ]);
                });
                return response()->json(['status' => 200]);
            } catch (\Exception $e) {
                return response()->json(['status' => 500, 'msg' => 'Error al realizar la operación', 'error' => $e->getMessage()]);
            }
        } else {

            return response()->json(['status' => 404, 'msg' => 'Error al actualizar los datos']);
        }
    }

    /*
    Función para hecer un update en el tipo de sangre de algun registros
    */
    public function Update_bloodType(Request $request)
    {
        $messages = [
            'Id_person.required' => 'El ID de la persona es requerido.',
            'Id_person.numeric' => 'El ID de la persona debe ser un número.',
            'Id_person.exists' => 'El ID de la persona NO existe.',
            'Id_hemotipo.required' => 'El Hemotipo es requerido.',
            'Id_hemotipo.numeric' => 'El dato del hemotipo no es válido.',
            'Id_hemotipo.exists' => 'El hemotipo no es válido.',
        ];

        $validator = Validator::make($request->all(), [
            'Id_person' => 'required|numeric|exists:personas,id_persona',
            'Id_hemotipo' => 'required|numeric|exists:hemotipo,id_hemotipo',
        ], $messages);

        // Error en algún dato
        if ($validator->fails()) {
            return response()->json(['msg' => "Error en los datos recibidos.", 'errors' => $validator->errors()], 400);
        }
        $Id =  intval($request['Id_person']);
        $BloodType = intval($request['Id_hemotipo']);
        $Person = Persona::where('id_persona', $Id)->first();
        if ($Person) {
            try {
                DB::transaction(function () use ($Person, $BloodType) {
                    $Person->update([
                        'hemotipo_id' => $BloodType,
                    ]);
                });
                return response()->json(['status' => 200]);
            } catch (\Exception $e) {
                return response()->json(['status' => 500, 'msg' => 'Error al realizar la operación', 'error' => $e->getMessage()]);
            }
        } else {
            return response()->json(['status' => 404, 'msg' => 'Error al actualizar los datos']);
        }
    }



    /*
    Funcion para agregar una nueva toxicomania desde la vista del Expediente
*/
    public function Add_Adiction(AddictionsRequest $request)
    {
        try {
            $validate = $request->validated();

            $Id_Persona = $validate['IdPerson'];
            $Data = $validate['Data'];
            DB::transaction(function () use ($Id_Persona, $Data) {
                $Persona_Addiction = new Persona_toxicomanias();
                $Persona_Addiction->id_persona = $Id_Persona;
                $Persona_Addiction->id_toxicomania = $Data['idReferenceTable'];
                $Persona_Addiction->observacion = $Data['description'];
                $Persona_Addiction->desde_cuando =
                Carbon::now()->subYears($Data['date'])->format('Y-m-d');
                $Persona_Addiction->created_at = now();
                $Persona_Addiction->save();
            });

            return response()->json(['title' => 'Éxito', 'message' => 'Toxicomanía agregada correctamente', 'error' => null], 201);
        } catch (\Exception $e) {

            return response()->json(['title' => 'Error', 'message' => 'Ha ocurrido un error al crear el expediente del paciente', 'error' => $e], 500);
        }
    }
}
