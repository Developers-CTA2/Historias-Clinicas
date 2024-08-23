<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Persona_enfermedades;


class APPController extends Controller
{


    /*
    Funcion para agregar una nueva enfermedad desde la vista del Expediente
*/
    public function Store(Request $request)
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
    Funcion para agregar una nueva enfermedad desde la vista del Expediente
*/
    public function Update_Disease(Request $request)
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
}
