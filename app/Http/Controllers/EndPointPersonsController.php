<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EndPointPersonsController extends Controller
{
    public function getUser(Request $request)
    {

        $validateFormCreateUser = $request->validate([
            'code' => 'required',
        ]);


        if (!$validateFormCreateUser) {
            return response()->json(['respuesta' => false]);
        }

        try {

            $code = $validateFormCreateUser['code'];
            if(strlen($code) == 7){
                $type_endpoint = 'ENDPOINT_WORKER';
            }else if(strlen($code) == 9){
                $type_endpoint = 'ENDPOINT_STUDENT';
            }


            // Configuraciones para el consumo del web service
            $url = env('URL', '') . env($type_endpoint);

            $headers = array(
                'Content-Type: application/json',
            );
            $data = array(
                'code' => $code
            );

            $payload = json_encode($data);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($ch);
            $result = json_decode($result, true);

            // throw new \Exception('Error al obtener el usuario');

            if ($result["ok"]) {
                // Verificar si el usuario ya existe 
                $user = User::where('user_name', $code)
                    ->first();

                if ($user) {
                    return response()->json(['respuesta' => false, 'message' => 'El usuario ya está registrado al sistema.'], 400);
                }


                return response()->json(['respuesta' => true, 'data' => $result]);
            } else {
                return response()->json(['respuesta' => false, 'message' => 'No se encontró ningun usuario con el código ingresado.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['respuesta' => false, 'message' => 'Error al obtener al usuario que está buscando', 'error' => $e->getMessage()], 500);
        }
    }

}
