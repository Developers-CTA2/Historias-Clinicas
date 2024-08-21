<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Persona;
use App\Models\Persona_ahf;

class AHFController extends Controller
{

    /* 
   Funcion para hacer un update en un registro de antecedente heredofamiliar
*/
    public function Update(Request $request)
    {
        $data = $request->validate([
            'Id_reg' => 'required|numeric|exists:persona_ahf,id',
            'Id_ahf' => 'required|numeric|exists:enfermedades_especificas,id_especifica_ahf',
        ]);

        $id = $data['Id_reg'];
        $ahf = $data['Id_ahf'];

        $registro = persona_ahf::where('id', $id)->first();

        if ($registro) {
            try {
                DB::transaction(function () use ($registro, $ahf) {
                    $registro->update([
                        'id_ahf' => $ahf,
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
    Funcion para Agregar una nueva AHF a un registro de una perosna 
*/
    public function store(Request $request)
    {
        $data = $request->validate([
            'Id_ahf' => 'required|numeric|exists:enfermedades_especificas,id_especifica_ahf',
            'Id_person' => 'required|numeric|exists:personas,id_persona'
        ]);

        $id_persona = $data['Id_person'];
        $id_ahf = $data['Id_ahf'];

        $Persona = persona::where('id_persona', $id_persona)->first();
        if ($Persona) { // Si encontro la persona 
            try {
                DB::transaction(function () use ($id_persona, $id_ahf) {
                    $Persona_ahf = new persona_ahf();
                    $Persona_ahf->id_persona = $id_persona;
                    $Persona_ahf->id_ahf = $id_ahf;
                    $Persona_ahf->created_at = Auth::id();
                    $Persona_ahf->save();
                });
                return response()->json(['status' => 200]);
            } catch (\Exception $e) {
                return response()->json(['status' => 500, 'error' => $e->getMessage()]);
            }
        } else { // No encontro a la persona
            return response()->json(['status' => 404, 'msg' => '¡Error! No se encontro el registro.']);
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
