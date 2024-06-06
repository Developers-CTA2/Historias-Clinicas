<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especificar_ahf;
use App\Models\Tipo_ahf;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DiseasesController extends Controller
{
    public function Diseases_View()
    {
        $breadcrumbs = [
            ['name' => 'Enfermedades', '' => ''],

        ];

        $Types = Tipo_ahf::all();
        return view('administrar.View-Diseases', ['Types' => $Types], compact('breadcrumbs'));
    }

    public function Store_disease(Request $request){
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
        $diseases = Tipo_ahf::where('nombre', $Name)->first();

        if($diseases){
            return response()->json(['status' => 202, 'msg' => 'La tipo de enfermedad ya esta resgistrada en el sistema.']);

        }else{
            DB::transaction(function () use ($Name) {
                $disease = new Tipo_ahf;
                $disease->nombre = $Name;
                $disease->save();
            });
            return response()->json(['status' => 200, 'msg' => 'Exito, se agrego correctamente.']);

        }
        return response()->json(['status' => 404, 'msg' => 'Error, algo salio mal.']);

    }



    public function showdiseases(Request $request){
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);
        $search = $request->input('search', '');

        $query= Tipo_ahf::query();;

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


    public function Update_disease(Request $request){
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

        $disease = Tipo_ahf::where('id_tipo_ahf', $Id)->first();

        if ($disease) {
            DB::transaction(function () use ($Name, $disease) {
                $disease->update([
                    'nombre' => $Name,
                ]);
            });
            return response()->json(['status' => 200, 'msg' => 'Datos editados correctamente.']);
        } else {
            return response()->json(['status' => 404, 'msg' => 'Error, algo salio mal.']);
        }
    }

}
