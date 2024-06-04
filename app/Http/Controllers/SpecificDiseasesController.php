<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especificar_ahf;
use App\Models\Tipo_ahf;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SpecificDiseasesController extends Controller
{
    public function breadCrumb()
    {

        $breadcrumbs = [
            ['name' => 'Enfermedades', 'url' => route("admin.diseases")],
            ['name' => 'Específicas', '' => ''],

        ];

        $Types = Tipo_ahf::all();
        return view('administrar.View-Especifics', ['Types' => $Types], compact('breadcrumbs'));
    }

    public function showdiseases(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);
        $search = $request->input('search', '');

        $query = Especificar_ahf::with('tipo_ahf');

        if (!empty($search)) {
            $query->where('nombre', 'like', "%$search%")
                ->orWhereHas('tipo_ahf', function ($q) use ($search) {
                    $q->where('nombre', 'like', "%$search%");
                });
        }
        $diseases = $query->offset($offset)
            ->limit($limit)
            ->get();

        return response()->json([
            'results' => $diseases,
            'count' => $diseases->count(),
        ]);
    }


    public function Update_specific(Request $request)
    {

        // Errores en español 
        $messages = [
            'Tipo.required' => 'El campo Tipo de AHF es obligatorio.',
            'Tipo.numeric' => 'El campo Tipo de AHF debe ser un número.',
            'Tipo.exists' => 'El ID de tipo de AHF no existe en la base de datos.',
            'Esp.required' => 'El campo ID de específico es obligatorio.',
            'Esp.numeric' => 'El campo ID de específicoF debe ser un número.',
            'Esp.exists' => 'El  campo ID de específico no existe en la base de datos.',
            'Name.required' => 'El campo nombre es obligatorio.',
            'Name.string' => 'El campo nombre debe ser una cadena.',
        ];
        // Validar datos
        $validator = Validator::make($request->all(), [
            'Tipo' => 'required|numeric|exists:tipo_ahf,id_tipo_ahf',
            'Esp' => 'required|numeric|exists:especificar_ahf,id_especifica_ahf',
            'Name' => 'required|string',
        ], $messages);

        // Error en algun dato
        if ($validator->fails()) {
            return response()->json(['status' => 202, 'errors' => $validator->errors()]);
        }

        $Id_Type =  intval($request['Tipo']);
        $Id_Esp = intval($request['Esp']);
        $Name = $request['Name'];

        $disease = Especificar_ahf::where('id_especifica_ahf', $Id_Esp)->first();

        if ($disease) {
            DB::transaction(function () use ($Id_Type, $Name, $disease) {
                $disease->update([
                    'nombre' => $Name,
                    'id_tipo_ahf' => $Id_Type,
                ]);
            });
            return response()->json(['status' => 200, 'msg' => 'Datos editados correctamente.']);
        } else {
            return response()->json(['status' => 404, 'msg' => 'Error, algo salio mal.']);
        }
    }

}
