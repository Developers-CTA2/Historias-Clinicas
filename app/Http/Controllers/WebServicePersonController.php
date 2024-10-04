<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebServiceGetPersonRequest;
use App\Models\Persona;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\error;

class WebServicePersonController extends Controller
{
    //

    public function index()
    {
        return view('patients.form');
    }

    public function getPersonWebService($code, $type, $person)
    {

        try {
            $validated = Validator::make(
                ['code' => $code, 'type' => $type,'person' => $person],
                [
                    'code' => 'required|numeric|digits_between:7,9',
                    'type' => 'required|numeric|in:1,2',
                    'person' => 'required|in:user,patient',
                ],
                [
                    'code.required' => 'El código es requerido',
                    'code.string' => 'El código debe ser numérico',
                    'code.min' => 'El código debe tener entre 7 y 9 dígitos',
                    'type.required' => 'El tipo de persona es requerido',
                    'type.numeric' => 'El tipo de persona debe ser numérico',
                    'type.in' => 'El tipo de persona no es válido',
                    'person.required' => 'El tipo de persona es requerido',
                    'person.in' => 'El tipo de persona no es válido',
                ]
            );



            $responseWithErrors = [
                'title' => 'Oops...!',
                'msg' => 'Lo sentimos, ocurrió un error inesperado. Intenta nuevamente más tarde.',
                'error' => [],

            ];

            if ($validated->fails()) {
                return response()->json(['title' => 'Oops...!', 'msg' => 'Lo sentimos, ocurrió un error inesperado.', 'error' => $validated->errors()], 400);
            }



            // throw new \Exception('Error en la validación');

            $urlLogin = env('API_URL', '') . env('ENDPOIN_API_LOGIN', '');

            $urlGetPerson = $type == 1 ? env('ENDPOIN_API_WORKER') : env('ENDPOIN_API_STUDENT');
            $urlGetPerson = env('API_URL', '') . $urlGetPerson;

            $urlLogout = env('API_URL', '') . env('ENDPOIN_API_LOGOUT', '');

            $headers = [
                'Content-Type: application/json',
            ];

            $dataLogin = [
                'email' => env('API_USER', ''),
                'password' => env('API_PASSWORD', ''),
            ];

            $response = $this->requestWebService($urlLogin, $headers, $dataLogin, 'POST');

            if ($response['status'] != 200) {
                $responseWithErrors['error'] = $response;
                return response()->json($responseWithErrors, 500);
            }

            $token = $response['data']->token;

            $headers = [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token,
            ];

            $response = $this->requestWebService($urlGetPerson . $code, $headers, []);

            if ($response['status'] != 200) {

                if ($response['data']->message == 'El código de trabajador no es válido o no existe') {
                    $responseWithErrors['msg'] = 'El código de trabajador no existe';
                    return response()->json($responseWithErrors, 404);
                }

                $responseWithErrors['error'] = $response;
                return response()->json($responseWithErrors, 500);
            }

            $dataPerson = $response['data'];

            // Logout from API
            $responseLogout = $this->requestWebService($urlLogout, $headers, []);

            if ($responseLogout['status'] != 200) {
                $responseWithErrors['error'] = $responseLogout;



                return response()->json($responseWithErrors, 500);
            }

            // throw new \Exception('Error en la validación');

            if ($person == 'patient') {

                // Verificar si la persona ya existe en la base de datos
                $person = Persona::where('codigo', $code)->first();

                if ($person) {
                    // Mandar mensaje de que la persona ya existe
                    $responseWithErrors['msg'] = 'El paciente ya tiene un expediente médico';
                    $responseWithErrors['title'] = 'Expediente existente';
                    return response()->json($responseWithErrors, 400);
                }
            } else {
                $user = User::where('user_name', $code)->first();

                if($user){
                    $responseWithErrors['msg'] = 'El usuario ya está registrado en el sistema';
                    $responseWithErrors['title'] = 'Usuario existente';
                    return response()->json($responseWithErrors, 400);
                }
            }



            return response()->json(['title' => 'Éxito', 'msg' => 'Persona encontrada', 'data' => $dataPerson, 'type' => $type], 200);
        } catch (\Exception $e) {
            $type = gettype($e);
            $responseWithErrors['error'] = $e;
            return response()->json($responseWithErrors, 500);
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
