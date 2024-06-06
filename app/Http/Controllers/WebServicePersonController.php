<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class WebServicePersonController extends Controller
{
    //

    public function getPersonWebService(Request $request)
    {

        try {


            $data = $request->all();

            $person[] = [
                'Codigo' => '2921073',
                'Nombre' => 'EDUARDO SOLANO GUZMAN',
                'Estado' => 1,
                'Carrera' => 'Licenciado en CTA'

        ];

            $person[] = [
                'Codigo' => '2921074',
                'Nombre' => 'JUAN PEREZ',
                'Estado' => 1,
                'Carrera' => 'Ing Computacion'
            ];

            // throw new \Exception('Error al obtener el usuario');

            foreach ($person as $key => $value) {
                if ($value['Codigo'] == $request->code) {
                    return response()->json($value);
                }
            }
            return response()->json(['message' => 'No se encontro el registro', 'error' => null], 404);

        } catch (\Exception $e) {
            $type = gettype($e);
            return response()->json(['message' => 'Ha sucedido un error inesperado al obtener el registro', 'error' => $e],500);
        }
    }
}
