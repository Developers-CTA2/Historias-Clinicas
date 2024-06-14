<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enfermedad_especifica;
use App\Models\Tipos_enfermedades;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SpecificDiseasesController extends Controller
{
    public function specific_View()
    {

        $breadcrumbs = [
            ['name' => 'Enfermedades', 'url' => route("admin.diseases")],
            ['name' => 'Específicas', '' => ''],

        ];

        $Types = Tipos_enfermedades::all();
        return view('administrar.View-Specific', ['Types' => $Types], compact('breadcrumbs'));
    }

    public function showdiseases(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);
        $search = $request->input('search', '');

        $query = Enfermedad_especifica::with('tipo_ahf');

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
            'Tipo' => 'required|numeric|exists:tipos_enfermedades,id_tipo_ahf',
            'Esp' => 'required|numeric|exists:enfermedades_especificas,id_especifica_ahf',
            'Name' => 'required|string',
        ], $messages);

        // Error en algun dato
        if ($validator->fails()) {
            return response()->json(['status' => 202, 'errors' => $validator->errors()]);
        }

        $Id_Type =  intval($request['Tipo']);
        $Id_Esp = intval($request['Esp']);
        $Name = $request['Name'];

        $disease = Enfermedad_especifica::where('id_tipo_ahf', $Id_Type)->where('nombre', $Name)->first();

        if ($disease) {
            return response()->json(['status' => 404, 'msg' => 'Error, el dato ya existe.']);
        } else {

        $espe = Enfermedad_especifica::where('id_especifica_ahf', $Id_Esp)->first();
            DB::transaction(function () use ($Id_Type, $Name, $espe) {
                $espe->update([
                    'nombre' => $Name,
                    'id_tipo_ahf' => $Id_Type,
                ]);
            });
            return response()->json(['status' => 200, 'msg' => 'Datos editados correctamente.']);
        }
        return response()->json(['status' => 404, 'msg' => 'Error, intentalo más tarde.']);

    }


    public function Store_specific(Request $request)
    {
        // Errores en español 
        $messages = [
            'Type.required' => 'El campo Tipo de AHF es obligatorio.',
            'Type.numeric' => 'El campo Tipo de AHF debe ser un número.',
            'Type.exists' => 'El ID de tipo de AHF no existe en la base de datos.',
            'Name.required' => 'El campo nombre es obligatorio.',
            'Name.string' => 'El campo nombre debe ser una cadena.',
        ];
        // Validar datos
        $validator = Validator::make($request->all(), [
            'Type' => 'required|numeric|exists:tipos_enfermedades,id_tipo_ahf',
            'Name' => 'required|string',
        ], $messages);

        // Error en algun dato
        if ($validator->fails()) {
            return response()->json(['status' => 202, 'errors' => $validator->errors()]);
        }

        $Id_type =  intval($request['Type']);
        $Name = $request['Name'];

        $diseases = Enfermedad_especifica::where('nombre', $Name)->where('id_tipo_ahf', $Id_type)->first();

        if ($diseases) {
            return response()->json(['status' => 202, 'msg' => 'El dato ya esta en la base de datos.']);
        } else {
            DB::transaction(function () use ($Name, $Id_type) {
                $disease = new Enfermedad_especifica;
                $disease->nombre = $Name;
                $disease->id_tipo_ahf = $Id_type;
                $disease->save();
            });
            return response()->json(['status' => 200, 'msg' => 'Exito, se agrego correctamnete.']);
        }
        return response()->json(['status' => 404, 'msg' => 'Error, algo salio mal.']);
    }
}
