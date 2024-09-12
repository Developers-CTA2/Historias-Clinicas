<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;



    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Usar el user_name para el login 
     *
     * @return string
     */
    public function username()
    {
        return 'user_name';
    }

    public function credentials(Request $request)
    {
        return [
            'user_name' => $request->user_name,
            'password' => $request->password,
            'estado' =>  'Activo'
        ];
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        // Verificar si el usuario existe pero está inactivo
        $user = User::where('user_name', $request->user_name)->first();

        // return response()->json([$user]);

        if ($user && $user->estado != 'Activo') {
            // Enviar un mensaje personalizado si el usuario está inactivo
            throw ValidationException::withMessages([
                'user_name' => [trans('No puedes iniciar sesión, tu cuenta está inactiva.')],
            ]);
        }

        // Si no coincide la contraseña o el usuario no existe
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
}
