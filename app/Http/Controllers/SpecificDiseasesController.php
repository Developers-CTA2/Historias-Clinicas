<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enfermedad_especifica;
use App\Models\Tipos_enfermedades;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Tipo_ahf;

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
        $count = $query->count();
        $diseases = $query->offset($offset)
            ->limit($limit)
            ->orderBy('id_especifica_ahf', 'desc')
            ->get();

        return response()->json([
            'results' => $diseases,
            'count' => $count,
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
            return response()->json(['type' => 0, 'errors' => $validator->errors()],400);
        }

        $Id_Type =  intval($request['Tipo']);
        $Id_Esp = intval($request['Esp']);
        $Name = $request['Name'];

        $disease = Enfermedad_especifica::where('id_tipo_ahf', $Id_Type)->where('nombre', $Name)->first();

        if ($disease) {
            return response()->json(['type' => 1, 'msg' => 'El dato ya esta en la base de datos.'], 400);
        } else {

        $espe = Enfermedad_especifica::where('id_especifica_ahf', $Id_Esp)->first();
            DB::transaction(function () use ($Id_Type, $Name, $espe) {
                $espe->update([
                    'nombre' => $Name,
                    'id_tipo_ahf' => $Id_Type,
                    'updated_by' => auth()->user()->id,
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
            return response()->json(['type' => 0, 'errors' => $validator->errors()], 400);
        }

        $Id_type =  intval($request['Type']);
        $Name = $request['Name'];

        $diseases = Enfermedad_especifica::where('nombre', $Name)->where('id_tipo_ahf', $Id_type)->first();

        if ($diseases) {
            return response()->json(['type' => 1, 'msg' => 'El dato ya esta en la base de datos.'], 400);
        } else {
            DB::transaction(function () use ($Name, $Id_type) {
                $disease = new Enfermedad_especifica;
                $disease->nombre = $Name;
                $disease->id_tipo_ahf = $Id_type;
                $disease->created_by = auth()->user()->id;
                $disease->updated_by = auth()->user()->id;
                $disease->save();
            });
            return response()->json(['status' => 200, 'msg' => 'Exito, se agrego correctamnete.']);
        }
        return response()->json(['status' => 404, 'msg' => 'Error, algo salio mal.']);
    }

    public function getSpecificDiseases($typeId)
    {

        // Verificar si el tipo de AHF existe
        $type = Tipo_ahf::find($typeId);

        if (!$type) {
            return response()->json(['status' => 404, 'msg' => 'El tipo de AHF no existe.'],404);
        }

        $diseases = Enfermedad_especifica::where('id_tipo_ahf', $typeId)->get();
        return response()->json($diseases);
    }


    public function getSpecificDiseasesAll()
    {
        try {
            $diseases = Enfermedad_especifica::select('id_especifica_ahf', 'nombre')->get();
            return response()->json($diseases);

        }catch(\Exception $e){
            return response()->json(['status' => 500, 'msg' => 'Error, algo salio mal.','error' => $e],500);
        }
    }
}
