<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GyoRequest;
use App\Models\Gyo;
use Illuminate\Support\Facades\DB;


class GYOController extends Controller
{
    /*
    Funcion para editar una enfermedad del paciente desde la vista del expediente
*/
    public function Update_Gyo(GyoRequest $request)
    {
        try{
            $validate = $request->validated();

            $Reg = Gyo::where('id', $validate['Id_reg'])->first();

            $Data = $validate['Data'];

            if($Reg){
                DB::transaction(function () use ($Reg, $Data) {
                    $Reg->update([
                        'menarca' => $Data['menarca'],
                        'fecha_um' => $Data['menstruacion'],
                        's_gestacion' => $Data['gest'],
                        'ciclos' => $Data['ciclos'],
                        'dias_x_dias' => ($Data['dias_1'].",". $Data['dias_2']),
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
            }

            return response()->json(['title' => '¡Exito!', 'msg' => 'Datos actualizados exitosamente.'], 200);

        } catch (\Exception $e) {

            return response()->json(['title' => 'Error', 'msg' => 'Ha ocurrido un error al crear el expediente del paciente', 'error' => $e], 500);
        }
       
    }
}
