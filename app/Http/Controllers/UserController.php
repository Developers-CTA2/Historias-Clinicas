<?php

namespace App\Http\Controllers;

use App\Mail\RegistroMail;
use App\Mail\ResetearMail;

use App\Models\User;
use App\Models\Administrativo;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;

class UserController extends Controller
{
    public function store(Request $request)
    {

        $data = $request->validate([
            'codigo' => 'required',
            'nombre' => 'required',
            'tipo' => 'required',
        ]);

        // Volvemos a validar los datos 
        if (!preg_match('/^[0-9]{7,10}$/', $data['codigo']) || !preg_match('/^[a-zA-ZáÁéÉíÍóÓúÚÑñ ]+$/', $data['nombre'])) {
            return response()->json(['status' => 400, 'msg' => '¡Error! Hubo un error al recibir los parámetros para la petición.']);
        }

        // dump($username);

        $username = $data['codigo'];
        $nombre = $data['nombre'];
        $Rol = $data['tipo'];

        $administrativo = Administrativo::where('codigo', $data['codigo'])->first();

        if (!$administrativo) {
            return response()->json(['status' => 404, 'msg' => '¡Error! No se encontró un administrativo con el código proporcionado.']);
        }

        $mail = $administrativo->correo;

        $usuario = User::where('user_name', $username)->first();

        if ($usuario) {

            // Si el nombre ya existe 
            return response()->json(['status' => 202, 'msg' => '¡Error!, el usuario ya existe en el sistema.']);
        } else {

            DB::transaction(
                function () use ($username, $nombre, $Rol, $mail) {
                    // Si el usuario no existe, crea un nuevo usuario con contraseña por defecto
                    $user = new User;
                    $user->user_name = $username;
                    $user->name = $nombre;
                    $user->password = bcrypt('Cu@ltos2024');
                    $user->save(); // Guarda el usuario en la base de datos

                    $role = Role::find($Rol); //Buscar si el rol existe
                    if ($role) {
                        $user->syncRoles($role);  // Asignarle su rol 
                    }
                    // Envío de correo electrónico
                    Mail::to($mail)->send(new RegistroMail($username));
                }
            );

            return response()->json(['status' => 200, 'msg' => '¡Éxito! el usuario fue agregado al sistema.']);
        }

        return response()->json(['resultado' => 400, 'msg' => '¡Error! Hubo un error al al realizar la petición.']);
    }

    /* Funcion para buscar el nombre del usuario segun el codigo que se escribio */
    public function CheckUsers(Request $request){ 
         
        $data = $request->validate([
            'code' => 'required',
        ]);

        $username = $data['code'];   

        if (!preg_match('/^[0-9]{7,10}$/', $username)) {
            return response()->json(['status' => 400, 'msg' => '¡Error! Hubo un error al recibir los parámetros para la petición.']);
        }

        $Administrativo = Administrativo::where('codigo', $username)->first();
        if (!$Administrativo) {
            // Si el nombre ya existe 
            return response()->json(['status' => 202, 'msg' => '¡Error!, el código agregado no esta enlazado a ningun trabajador.']);
        } else {

            $user = User::where('user_name', $username)->first();

            if ($user) {
                return response()->json(['status' => 202, 'msg' => '¡Error!, Ya existe un usuario con el código ingresado.']);
            } else {
                $nombre = $Administrativo->nombre;
                // Si el nombre ya existe 
                return response()->json(['status' => 200, 'msg' =>  $nombre, 'code' => $username]);
            }
        }
    }

    /*
        Funcion para verificar que la contraseña que se ingreso coincide con la que se ingreso
    */
    public function verifyPass(Request $request)
    {
        $data = $request->validate([
            'pass' => 'required',
        ]);

        $contrasenaIngresada = $data['pass'];

        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%^&+=])(.{4,})$/', $contrasenaIngresada)) {
            return response()->json(['status' => 400, 'msg' => '¡Error! Hubo un error al recibir los parámetros para la petición.']);
        }

        // Verificamos si la contraseña coincidde 
        if (Hash::check($contrasenaIngresada, auth()->user()->password)) {
            return response()->json(['status' => 200, 'msg' => 'correcto']);
        } else {
            return response()->json(['status' => 404, 'msg' => 'La contraseña  no coincide con la contraseña actual.']);
        }
    }

    /*
        Funcion para cambiar la contraseña de la sesion
    */
    public function ChangePassword(Request $request)
    {
        $data = $request->validate([
            'Password' => 'required',
          
        ]);

        $pass = $data['Password'];

        // Validamos que tengan la estructura
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
            return response()->json(['status' => 200, 'msg' => '¡Éxito! Se cambio la contraseña con exito, espera a que la página se recarge. ']);
        }
        return response()->json(['resultado' => 400, 'msg' => '¡Error! Hubo un error al al realizar la petición.']);
    }


    
    /*
        Funcion para mostrar todos los usuarios del sistema a ecepcion de usuario de la sesion
    */
    public function show()
    {

        $users = DB::table('users')
            ->select('users.id', 'users.user_name', 'users.name',  'roles.name as role_name', 'roles.id as role_id') // Selecciona los campos de interés
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('users.id', '!=', auth()->user()->id)
            ->get();


        $Contador = User::count();

        return view('admin.Users', compact('users', 'Contador'));      // retornar a vista users 
    }
    /*
        Funcion para resetear la contraseña de un usuario.
    */
    public function resetPassword(Request $request)
    {
        $data = $request->validate([
            'Name' => 'required',
        ]);

        $username = $data['Name'];

        $administrativo = Administrativo::where('codigo', $data['Name'])->first();

        $mail = $administrativo->correo;

        if (!preg_match('/^[0-9]{7,10}$/', $username)) {
            return response()->json(['status' => 400, 'msg' => '¡Error! Hubo un error al recibir los parámetros para la petición.']);
        }
        // Busca al usuario por el nombre de usuario
        $user = User::where('user_name', $username)->first();
        if ($user) {
            DB::transaction(
                function () use ($user) {
                    // Genera una nueva contraseña
                    $newPassword = bcrypt('Cu@ltos2024');
                    $user->password = $newPassword;
                    $user->save();
                }               
            );
            Mail::to($mail)->send(new ResetearMail($username));
            return response()->json(['status' => 200, 'msg' => '¡Éxito! Se reseteo la contraseña con éxito.']);
        } else {
            return response()->json(['status' => 404, 'msg' => '¡Error! No hay ningun usuario con el código' . $username . "."]);
        }
        return response()->json(['resultado' => 400, 'msg' => '¡Error! Hubo un error al al realizar la petición.']);
    }

    public function delete(Request $request)
    {

        if (Auth::check()) {
            // Obtén el nombre de usuario de la solicitud AJAX
            $username = $request->input('Codigo');

            if (!preg_match('/^[0-9]{7,10}$/', $username)) {
                return response()->json(['status' => 400, 'msg' => '¡Error! Hubo un error al recibir los parámetros para la petición.']);
            }

            // Busca al usuario por el nombre de usuario
            $user = User::where('user_name', $username)->first();

            if ($user) {
                DB::transaction(function () use ($user) {
                    $user->delete();
                });

                return response()->json(['status' => 200, 'msg' => '¡Éxito! El usuario fue borrado del sistema.'], 200, [], JSON_NUMERIC_CHECK);
            } else {
                return response()->json(['status' => 404, 'msg' => '¡Error! No hay ningún usuario con el código. ' . $username . '.']);
            }

            return response()->json(['status' => 400, 'msg' => '¡Error! Hubo un error al realizar la petición.']);
        }
    }


    public function Update(Request $request)
    {

        if (Auth::check()) {
            // Obtén el nombre de usuario de la solicitud AJAX
            $username = $request->input('Username');
            $Name = $request->input('Name');
            $Id = $request->input('Id');
            $Rol = $request->input('Rol');


            if (!preg_match('/^[0-9]{7,10}$/', $username) || !preg_match('/^[a-zA-ZáÁéÉíÍóÓúÚÑñ ]+$/', $Name) || $Rol == "" || $Id == "") {
                return response()->json(['status' => 400, 'msg' => '¡Error! Hubo un error al recibir los parámetros para la petición.']);
            }

            // Verificar que el rol exista 
            $Rol = Role::where('id', $Rol)->first();

            if ($Rol) { // Si existe el rol 

                // Busca al usuario por el ID 
                $user = User::where('user_name', $username)->where('id', '!=', $Id)->first();

                if ($user) {  //Exsite ya un usuario con el nuevo código que se desea editar

                    return response()->json(['status' => 404, 'msg' => '¡Error! Ya existe otro usuario con el código ' . $username . '.']);
                } else {  // Si se llego a cambiar al código y esta disponible. 
                    $user = User::where('id', $Id)->first();

                    DB::transaction(function () use ($user, $username, $Name, $Id, $Rol) {

                        $user->update([
                            'name' => $Name,
                            'user_name' => $username,
                        ]);
                        // Asignamos el rol 
                        $user->syncRoles([$Rol]);
                    });

                    return response()->json(['status' => 200, 'msg' => '¡Éxito! Los datos del usuario fueron modificados.'],);
                }
            } else { // No existe el rol 

                return response()->json(['status' => 404, 'msg' => '¡Error! Hubo un error al realizar la petición ya que un dato es inválido. ' . $username . '.']);
            }

            return response()->json(['status' => 400, 'msg' => '¡Error! Hubo un error al realizar la petición.']);
        }
    }
}
