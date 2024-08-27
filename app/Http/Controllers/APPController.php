<?php

namespace App\Http\Controllers;

use App\Models\Persona_alergia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Persona_enfermedades;
use Illuminate\Support\Facades\Auth;


class APPController extends Controller
{

    ////// ENFERMEDADES
    /*
    Funcion para agregar una nueva enfermedad desde la vista del Expediente
*/
    public function Store_Disease(Request $request)
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
    public function Store_Allergy(Request $request)
    {
        try {
            $messages = [
                'Id_person.required' => 'El ID de la persona es requerido.',
                'Id_person.numeric' => 'El ID de la persona debe ser un número.',
                'Id_person.exists' => 'El ID de la persona NO existe.',
                'Id.required' => 'El ID del la enfermedad es requerido.',
                'Id.numeric' => 'El ID del la enfermedad es válido.',
                'Id.exists' => 'El ID del la enfermedad no existe.',
                'Descrption.required' => 'La descripción de la alergia es requerida.',
            ];

            $validator = Validator::make($request->all(), [
                'Id_person' => 'required|numeric|exists:personas,id_persona',
                'Id' => 'required|numeric|exists:alergias,id_alergia',
                'Descrption' => 'required|string ',
            ], $messages);

            if ($validator->fails()) {
                return response()->json(['msg' => "Error en los datos recibidos.", 'errors' => $validator->errors()], 400);
            }

            $Id_Persona = $request['Id_person'];
            $AllergyId = $request['Id'];
            $Description = $request['Descrption'];

            DB::transaction(function () use ($Id_Persona, $AllergyId, $Description) {
                $Persona_Allergy = new Persona_alergia();
                $Persona_Allergy->id_persona = $Id_Persona;
                $Persona_Allergy->id_alergia = $AllergyId;
                $Persona_Allergy->especificar = $Description;
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
    Funcion para editar una enfermedad del paciente desde la vista del expediente
*/
    public function Update_Allergy(Request $request)
    {
        $messages = [
            'Id_reg.required' => 'El ID del registro es requerido.',
            'Id_reg.numeric' => 'El ID del registro debe ser un número.',
            'Id_reg.exists' => 'El ID del registro  NO existe.',
            'Id.required' => 'El ID del la alergia es requerida.',
            'Id.numeric' => 'El ID del la alergia es válida.',
            'Id.exists' => 'El ID del la alergia no existe.',
            'Description.required' => 'La descripción de la alergia es requerida.',
        ];
        $validator = Validator::make($request->all(), [
            'Id_reg' => 'required|numeric|exists:persona_alergia,id',
            'Id' => 'required|numeric|exists:alergias,id_alergia',
            'Description' => 'required|string',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['msg' => "Error en los datos recibidos.", 'errors' => $validator->errors()], 400);
        }
        $Id_reg = $request['Id_reg'];
        $IdAllergy = $request['Id'];
        $Descrption = $request['Description'];

        $registro = Persona_alergia::where('id', $Id_reg)->first();
        if ($registro) {
            try {
                DB::transaction(function () use ($registro, $IdAllergy,  $Descrption) {
                    $registro->update([
                        'id_alergia' => $IdAllergy,
                        'especificar' => $Descrption,
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



}
