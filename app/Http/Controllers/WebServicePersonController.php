<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebServiceGetPersonRequest;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\error;

class WebServicePersonController extends Controller
{
    //


    public function index(){
        return view('patients.form');
    }

    public function getPersonWebService($code, $type)
    {

        $validated = Validator::make(['code' => $code, 'type' => $type], [
            'code' => 'required|string',
            'type' => 'required|numeric|in:1,2',
        ]);

        try {

            if($validated->fails()){
                return response()->json(['title' => 'Error', 'message' => 'Ha sucedido un error inesperado al obtener el registro', 'error' => $validated->errors()], 500);
            }

            // type 1 = Trabajadores, type 2 = Alumnos

            $urlLogin = env('API_URL','') . env('ENDPOIN_API_LOGIN','');
            
            $urlGetPerson = $type == 1 ? env('ENDPOIN_API_WORKER') : env('ENDPOIN_API_STUDENT');
            $urlGetPerson = env('API_URL','') . $urlGetPerson;

            $urlLogout = env('API_URL','') . env('ENDPOIN_API_LOGOUT','');

            $headers = [
                'Content-Type: application/json',
            ];

            $dataLogin = [
                'email' => env('API_USER',''),
                'password' => env('API_PASSWORD',''),
            ];

            $response = $this->requestWebService($urlLogin, $headers, $dataLogin, 'POST');

            if($response['status'] != 200){
                return response()->json(['title' => 'Error', 'message' => 'Ha sucedido un error inesperado al obtener el token de acceso', 'error' => $response], 500);
            }

            $token = $response['data']->token;
            
            $headers = [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token,
            ];

            $response = $this->requestWebService($urlGetPerson . $code, $headers, []);

            if($response['status'] != 200){
                return response()->json(['title' => 'Error', 'message' => 'Ha sucedido un error inesperado al obtener el registro', 'error' => $response], 500);
            }

            $dataPerson = $response['data'];

            // Logout from API
            $responseLogout = $this->requestWebService($urlLogout, $headers, []);

            if($responseLogout['status'] != 200){
                return response()->json(['title' => 'Error', 'message' => 'Ha sucedido un error inesperado al cerrar la sesión', 'error' => $responseLogout], 500);
            }

            return response()->json(['title' => 'Éxito', 'message' => 'Persona encontrada', 'data' => $dataPerson], 200);

            
        } catch (\Exception $e) {
            $type = gettype($e);
            return response()->json(['message' => 'Ha sucedido un error inesperado al obtener el registro', 'error' => $e], 500);
        }
    }


    

    private function requestWebService($url, $headers, $data, $method = 'GET')
    {
        $payload = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        $result = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return [
            'data' => json_decode($result),
            'status' => $http_status,
        ];
    }
}
