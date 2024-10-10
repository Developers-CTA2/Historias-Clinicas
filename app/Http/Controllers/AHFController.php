<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Persona;
use App\Models\Persona_ahf;
use App\Http\Requests\AHFRequest;


class AHFController extends Controller
{

    /* 
   Funcion para hacer un update en un registro de antecedente heredofamiliar
*/
    public function Update(AHFRequest $request)
    {

        $data = $request->validated();



        $registro = persona_ahf::where('id', $data['Id_reg'])->first();

        if ($registro) {
            try {
                DB::transaction(function () use ($registro, $data) {
                    $registro->update([
                        'id_ahf' => $data['Id_ahf'],
                        'updated_by' => Auth::id()
                    ]);
                });
                return response()->json(['status' => 200]);
            } catch (\Exception $e) {
                return response()->json(['msg' => 'Algo salio mal al realizar la petición', 'error' => $e->getMessage()], 500);
            }
        } else {
            return response()->json(['error' => '¡Error! El registro que se desea actualizar no existe.'], 404);
        }
    }

    /*
    Funcion para Agregar una nueva AHF a un registro de una perosna 
*/
    public function store(AHFRequest $request)
    {
        $data = $request->validated();
        try {
            DB::transaction(function () use ($data) {
                $Persona_ahf = new persona_ahf();
                $Persona_ahf->id_persona = $data['Id_person'];
                $Persona_ahf->id_ahf = $$data['Id_ahf'];
                $Persona_ahf->created_at = Auth::id();
                $Persona_ahf->save();
            });
            return response()->json(['status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Algo salio mal al realizar la petición', 'error' => $e->getMessage()], 500);
        }
    }

    /*
    Funcion para eliminar un registro de la tabla Persona_ahf 
*/
    public function Delete(Request $request)
    {
        $data = $request->validate([
            'Id_reg' => 'required|numeric|exists:persona_ahf,id',
        ]);
        $id = $data['Id_reg'];
        $registro = persona_ahf::where('id', $id)->first();
        if ($registro) {
            try {
                DB::transaction(function () use ($registro) {
                    $registro->delete();
                });
                return response()->json(['status' => 200]);
            } catch (\Exception $e) {
                return response()->json(['status' => 500,  'error' => $e->getMessage()]);
            }
        } else {
            return response()->json(['status' => 404, 'msg' => 'Error al actualizar los datos']);
        }
    }
}
