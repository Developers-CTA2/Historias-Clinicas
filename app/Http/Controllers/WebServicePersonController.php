<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class WebServicePersonController extends Controller
{
    //

    public function getPersonWebService($code, $token)
    {

        try {

            
            

            if ($token == null) {
                $url = env('API_URL', '') . env('ENDPOIN_API_LOGIN', '');
            }else{

            }




            

            $headers = array(
                'Content-Type: application/json',
                'Username:' . env('HEADER_USERNAME_API', ''),
                'Password:' . env('HEADER_PASSWORD_API', '')
            );
            $data = array(
                'codigo' => $code
            );

            $payload = json_encode($data);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        } catch (\Exception $e) {
            $type = gettype($e);
            return response()->json(['message' => 'Ha sucedido un error inesperado al obtener el registro', 'error' => $e], 500);
        }
    }
}
