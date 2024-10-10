<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use  Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    /*
        Funcion que manda la vista y ademnas en breadcrum
    */
    public function profile_View()
    {
        $breadcrumbs = [
            ['name' => 'Mi perfil', '' => ''],

        ];

        $usuario = Auth::user();
        $role = $usuario->roles->first()->name;
        $Date = Carbon::parse($usuario->created_at)->locale('es')->isoFormat('LL');

        if ($usuario) {
            return view('profile.Details-profile',   compact('breadcrumbs', 'usuario', 'role', 'Date'));
        } else {
            // Redirigir o manejar el caso cuando no hay un usuario autenticado
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta página.');
        }
    }



    /*
        Funcion para verificar que la contraseña ingresada es la correcta  Cu@ltos1
    */
    public function verifyPass(Request $request)
    {

        // Errores en español 
        $messages = [
            'Pass.required' => 'El campo de contraseña es requerido',
            'Pass.max' => 'La contraseña excede los 13 caracteres',
        ];

        $data = Validator::make($request->all(), [
            'Pass' => 'required|string|max:13',
        ], $messages);

        // Error en algun dato
        if ($data->fails()) {
            return response()->json(['type' => 0, 'errors' => $data->errors()], 400);
        }

        // Verificamos si la contraseña coincide 
        if (Hash::check($request['Pass'], auth()->user()->password)) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['errors' => 'La contraseña es incorrecta'], 404);
        }
    }

    /*
        Funcion para cambiar la contraseña del usuario en la sesion
     */
    public function changePass(Request $request)
    {
        // Errores en español 
        $messages = [
            'Pass.required' => 'El campo de contraseña es requerido',
            'Pass.max' => 'La contraseña excede los 13 caracteres',
        ];

        $data = Validator::make($request->all(), [
            'Pass' => 'required|string|max:13',
        ], $messages);

        // Error en algun dato
        if ($data->fails()) {
            return response()->json(['type' => 0, 'errors' => $data->errors()], 400);
        }

        $pass = $request['Pass'];

        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=])(.{4,13})$/', $pass)) {
            return response()->json(['errors' => 'La contraseña no tiene una estructura válida.'], 401);
        } else {
            DB::transaction(
                function () use ($pass) {
                    $usuario = User::find(auth()->user()->id);
                    $usuario->password = Hash::make($pass);
                    $usuario->save();
                }
            );
            return response()->json(['msg' => '¡Éxito! La contraseña fue cambiada con exitosamente.'], 200);
        }
        return response()->json(['errors' => '¡Error! Algo salio mal ar realizar la petición'], 404);
    }
}
