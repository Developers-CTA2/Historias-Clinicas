<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toxicomanias;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class AddictionsController extends Controller
{
    /*  
        Breadcrumb para mandar la vista 
    */
    public function Addictions_View()
    {
        $breadcrumbs = [
            ['name' => 'Toxicomanías', '' => ''],

        ];

         return view('administrar.View-Addictions',   compact('breadcrumbs'));
    }

/*
    Funcion para mostrar las toxicomanias
*/
    public function showdaddictions(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);
        $search = $request->input('search', '');

        $query = Toxicomanias::query();;

        if (!empty($search)) {
            $query->where('nombre', 'like', "%$search%");
        }

        $Addictions = $query->offset($offset)
            ->limit($limit)
            ->get();

        return response()->json([
            'results' => $Addictions,
            'count' => $Addictions->count(),
        ]);
    }

    /* 
        Funcion para hacer un update en alguna toxicomania
    */ 
    public function Update_addictions(Request $request)
    {
        // Errores en español 
        $messages = [
            'Id.required' => 'El campo ID es obligatorio.',
            'Id.numeric' => 'El campo ID debe ser un número.',
            'Id.exists' => 'El ID no existe en la base de datos.',
            'Name.required' => 'El campo nombre es obligatorio.',
            'Name.string' => 'El campo nombre debe ser una cadena.',
        ];
        // Validar datos
        $validator = Validator::make($request->all(), [
            'Id' => 'required|numeric|exists:toxicomanias,id',
            'Name' => 'required|string',
        ], $messages);

        // Error en algun dato
        if ($validator->fails()) {
            return response()->json(['status' => 202, 'errors' => $validator->errors()]);
        }

        $Id =  intval($request['Id']);
        $Name = $request['Name'];

        $Addiction = Toxicomanias::where('id', $Id)->first();

        if ($Addiction) {
            DB::transaction(function () use ($Name, $Addiction) {
                $Addiction->update([
                    'nombre' => $Name,
                ]);
            });
            return response()->json(['status' => 200, 'msg' => 'Datos editados correctamente.']);
        } else {
            return response()->json(['status' => 404, 'msg' => 'Error, algo salio mal.']);
        }
    }

    /*
        Funcion para agregar una nueva toxicomania al sistema 
    */
    public function Store_addiction(Request $request)
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
        $Addiction = Toxicomanias::where('nombre', $Name)->first();

        if ($Addiction) {
            return response()->json(['status' => 202, 'msg' => 'La toxicomania ya esta resgistrada en el sistema.']);
        } else {
            DB::transaction(function () use ($Name) {
                $Addiction = new Toxicomanias();
                $Addiction->nombre = $Name;
                $Addiction->save();
            });
            return response()->json(['status' => 200, 'msg' => 'Exito, la alergia se agrego correctamente.']);
        }
        return response()->json(['status' => 404, 'msg' => 'Error, algo salio mal.']);
    }
}
