<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipos_enfermedades;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DiseasesController extends Controller
{

    /*
        Funcion que retorna la vista de diseases con lños 
    */
    public function Diseases_View()
    {
        $breadcrumbs = [
            ['name' => 'Enfermedades', '' => ''],

        ];

        $Types = Tipos_enfermedades::all();
        return view('administrar.View-Diseases', ['Types' => $Types], compact('breadcrumbs'));
    }

    /*
        Funcion que manda los registros de las enfermedades para ser mostrados en la tabla de Grid Js  
*/
    public function showdiseases(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);
        $search = $request->input('search', '');

        $query = Tipos_enfermedades::query();;

        if (!empty($search)) {
            $query->where('nombre', 'like', "%$search%");
        }

        $count = $query->count();
        $diseases = $query->offset($offset)
            ->limit($limit)
            ->get();

        return response()->json([
            'results' => $diseases,
            'count' => $count,
        ]);
    }
    /*
        Funcion para agregar un nuevo registro de un tipo de enfermedad
    */

    public function Store_disease(Request $request)
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

        $diseases = Tipos_enfermedades::where('nombre', $Name)->first();

        if ($diseases) {
            return response()->json(['type' => 1, 'msg' => 'El tipo de enfermedad ya esta resgistrada en el sistema.'], 400);
        } else {

            DB::transaction(function () use ($Name) {
                $disease = new Tipos_enfermedades;
                $disease->nombre = $Name;
                $disease->created_by = auth()->user()->id;
                $disease->updated_by = auth()->user()->id;
                $disease->save();
            });
            return response()->json(['status' => 200, 'msg' => 'Exito, se agrego correctamente.']);
        }
        return response()->json(['status' => 404, 'msg' => 'Error, algo salio mal.']);
    }

    /*
        Funcion para hacer un updata en algun registro de un tipo de enfermedad 
*/
    public function Update_disease(Request $request)
    {
        // Errores en español 
        $messages = [
            'Id.required' => 'El ID de la enfermedad es obligatorio.',
            'Id.numeric' => 'El ID de la enfermedad debe ser un número.',
            'Id.exists' => 'El ID de la enfermedad no existe en la base de datos.',
            'Name.required' => 'El nombre de la enfermedad  es obligatorio.',
            'Name.string' => 'El nombre de la enfermedad debe ser una cadena.',
        ];
        // Validar datos
        $validator = Validator::make($request->all(), [
            'Id' => 'required|numeric|exists:tipos_enfermedades,id_tipo_ahf',
            'Name' => 'required|string',
        ], $messages);

        // Error en algun dato
        if ($validator->fails()) {
            return response()->json(['type' => 0, 'status' => 202, 'errors' => $validator->errors()], 400);
        }

        $Id =  intval($request['Id']);
        $Name = $request['Name'];

        $disease = Tipos_enfermedades::where('nombre', $Name)->first();

        if ($disease) {
            return response()->json(['type' => 1, 'msg' => 'El dato ya existe en la base de datos.'], 400);
        } else {
            $Update = Tipos_enfermedades::where('id_tipo_ahf', $Id)->first();

            DB::transaction(function () use ($Name, $Update) {
                $Update->update([
                    'nombre' => $Name,
                    'updated_by' => auth()->user()->id,
                ]);
            });
            return response()->json(['status' => 200, 'msg' => 'Datos editados correctamente.']);
        }
    }
}
