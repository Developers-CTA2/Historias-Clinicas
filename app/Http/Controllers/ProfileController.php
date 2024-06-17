<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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
        Funcion para verificar que la contraseña ingresada es la correcta
    */
    public function verifyPass(Request $request)
    {
        $data = $request->validate([
            'Pass' => 'required|string',
        ]);

        $pass = $data['Pass'];

        // Verificamos si la contraseña coincide 
        if (Hash::check($pass, auth()->user()->password)) {
            return response()->json(['status' => 200, 'msg' => 'correcto']);
        } else {
            return response()->json(['status' => 404, 'msg' => 'La contraseña  no coincide con la contraseña actual.']);
        }
    }

    /*
        Funcion para cambiar la contraseña del usuario en la sesion
     */
    public function changePass(Request $request)
    {
        $data = $request->validate([
            'Pass' => 'required|string',
        ]);

        $pass = $data['Pass'];
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=])(.{4,})$/', $pass)) {
            return response()->json(['status' => 400, 'msg' => '¡Error! Hubo un error al recibir los parámetros para la petición.']);
        } else {
            DB::transaction(
                function () use ($pass) {
                    $usuario = User::find(auth()->user()->id);
                    $usuario->password = Hash::make($pass);
                    $usuario->save();
                }
            );
            return response()->json(['status' => 200, 'msg' => '¡Éxito! La contraseña fue cambiada con éxito. ']);
        }
        return response()->json(['resultado' => 400, 'msg' => '¡Error! Hubo un error al al realizar la petición.']);
    }
}
