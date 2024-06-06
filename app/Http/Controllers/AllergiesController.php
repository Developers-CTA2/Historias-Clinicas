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


    public function showAllergies(Request $request){
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
            'Id.required' => 'El campo Tipo de AHF es obligatorio.',
            'Id.numeric' => 'El campo Tipo de AHF debe ser un número.',
            'Id.exists' => 'El ID de tipo de AHF no existe en la base de datos.',
            'Name.required' => 'El campo nombre es obligatorio.',
            'Name.string' => 'El campo nombre debe ser una cadena.',
        ];
        // Validar datos
        $validator = Validator::make($request->all(), [
            'Id' => 'required|numeric|exists:tipo_ahf,id_tipo_ahf',
            'Name' => 'required|string',
        ], $messages);

        // Error en algun dato
        if ($validator->fails()) {
            return response()->json(['status' => 202, 'errors' => $validator->errors()]);
        }

        $Id =  intval($request['Id']);
        $Name = $request['Name'];

        $Allergy = Alergia::where('id_alergia', $Id)->first();

        if ($Allergy) {
            DB::transaction(function () use ($Name, $Allergy) {
                $Allergy->update([
                    'nombre' => $Name,
                ]);
            });
            return response()->json(['status' => 200, 'msg' => 'Datos editados correctamente.']);
        } else {
            return response()->json(['status' => 404, 'msg' => 'Error, algo salio mal.']);
        }
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
            return response()->json(['status' => 202, 'errors' => $validator->errors()]);
        }
        $Name = $request['Name'];
        $Allergy = Alergia::where('nombre', $Name)->first();

        if ($Allergy) {
            return response()->json(['status' => 202, 'msg' => 'La alergia ya esta resgistrada en el sistema.']);
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
