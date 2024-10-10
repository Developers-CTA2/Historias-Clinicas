<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GyoRequest;
use App\Models\Gyo;
use Illuminate\Support\Facades\DB;


class GYOController extends Controller
{
    /*
    Funcion para editar una el expediente GYO del paciente desde la vista del expediente
*/
    public function Update_Gyo(GyoRequest $request)
    {
        $validate = $request->validated();
        try {

            $Reg = Gyo::where('id', $validate['Id_reg'])->first();
            $Data = $validate['Data'];
            if ($Reg) {

                DB::transaction(function () use ($Reg, $Data) {
                    $Reg->update([
                        'menarca' => $Data['menarca'],
                        'fecha_um' => $Data['menstruacion'],
                        's_gestacion' => $Data['gest'],
                        'ciclos' => $Data['ciclos'],
                        'dias_x_dias' => ($Data['dias_1'] . "," . $Data['dias_2']),
                        'ivs' => $Data['inicio'],
                        'parejas_s' => $Data['parejas'],
                        'gestas' => $Data['gestas'],
                        'partos' => $Data['partos'],
                        'abortos' => $Data['abortos'],
                        'cesareas' => $Data['cesareas'],
                        'fecha_citologia' => $Data['last_c'],
                        'fecha_citologia' => $Data['last_c'],
                        'metodo' => $Data['met'],
                        'mastografia' => $Data['mast'],
                        'updated_at' => now(),
                    ]);
                });
                return response()->json(['message' => 'Registro de GYO actualizado correctamente.', 'error' => null], 201);
            }
            //return response()->json([ 'msg' => 'Datos actualizados exitosamente.'], 200);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Algo salio mal al realizar la petición.', 'error' => $e->getMessage()], 500);
        }
    }
}
