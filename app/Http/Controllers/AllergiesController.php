<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alergia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AllergiesController extends Controller
{
    public function Allergies_View()
    {
        $breadcrumbs = [
            ['name' => 'Alergias', '' => ''],

        ];

        $Allergies = Alergia::all();
        return view('administrar.View-Allergies', ['Allergies' => $Allergies],  compact('breadcrumbs'));
    }


    public function showAllergies(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);
        $search = $request->input('search', '');

        $query = Alergia::query();;

        if (!empty($search)) {
            $query->where('nombre', 'like', "%$search%");
        }

        $diseases = $query->offset($offset)
            ->limit($limit)
            ->get();

        return response()->json([
            'results' => $diseases,
            'count' => $diseases->count(),
        ]);
    }


    public function Update_allergies(Request $request)
    {
        // Errores en español 
        $messages = [
            'Id.required' => 'El campo ID es obligatorio.',
            'Id.numeric' => 'El campo ID debe ser un número.',
            'Id.exists' => 'El ID de la alergia no existe en la base de datos.',
            'Name.required' => 'El campo nombre es obligatorio.',
            'Name.string' => 'El campo nombre debe ser una cadena.',
        ];
        // Validar datos
        $validator = Validator::make($request->all(), [
            'Id' => 'required|numeric|exists:alergias,id_alergia',
            'Name' => 'required|string',
        ], $messages);

        // Error en algun dato
        if ($validator->fails()) {
            return response()->json(['type' => 0, 'errors' => $validator->errors()], 400);
        }

        $Id =  intval($request['Id']);
        $Name = $request['Name'];
        // Verificamos que no se duplique el nombre
         $Allergy = Alergia::where('nombre', $Name)->first();

        if ($Allergy) {
            return response()->json(['type' => 1, 'msg' => 'El dato ya esta en la base de datos.'], 400);
        } else {

            $Update = Alergia::where('id_alergia', $Id)->first();
            DB::transaction(function () use ($Name, $Update) {
                $Update->update([
                    'nombre' => $Name,
                ]);
            });
            return response()->json(['status' => 200, 'msg' => 'Datos editados correctamente.']);
        }
        return response()->json(['status' => 404, 'msg' => 'Error, algo salio mal.']);
    }


    public function Store_allergy(Request $request)
    {
        // Errores en español 
        $messages = [
            'Name.required' => 'El campo nombre es obligatorio.',
            'Name.string' => 'El campo nombre debe ser una cadena.',
        ];
        // Validar datos
        $validator = Validator::make($request->all(), [
            'Name' => 'required|string',
        ], $messages);

        // Error en algun dato
        if ($validator->fails()) {
            return response()->json(['type' => 0, 'errors' => $validator->errors()], 400);
        }
        $Name = $request['Name'];
        $Allergy = Alergia::where('nombre', $Name)->first();

        if ($Allergy) {
            return response()->json(['type' => 1, 'msg' => 'La alergia ya esta resgistrada en el sistema.'], 400);

        } else {
            DB::transaction(function () use ($Name) {
                $Allergy = new Alergia();
                $Allergy->nombre = $Name;
                $Allergy->save();
            });
            return response()->json(['status' => 200, 'msg' => 'Exito, la alergia se agrego correctamente.']);
        }
        return response()->json(['status' => 404, 'msg' => 'Error, algo salio mal.']);
    }
}
