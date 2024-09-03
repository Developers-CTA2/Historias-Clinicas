<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
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
use Illuminate\Support\Facades\Validator;
use  Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Breadcrumb para la vista de agregar usuario 
    public function breadCrumbAdd()
    {
        $breadcrumbs = [
            ['name' => 'Usuarios', 'url' => route("users.users")],
            ['name' => 'Agregar usuario', '' => ''],

        ];

        return view('user.Add-User', compact('breadcrumbs'));
    }

    // Breadcrumb para la vista de ver usuarios 
    public function breadCrumb()
    {
        $breadcrumbs = [
            ['name' => 'Usuarios', '' => ''],

        ];

        return view('user.View-Users', compact('breadcrumbs'));
    }

    // Funcion para ver los detalles del usuario selecciondo 
    public function userDetails($id)
    {
        $usuario = User::find($id);
        if (!$usuario) {
            $breadcrumbs = [
                ['name' => 'Usuarios', '' => ''],

            ];
            return view('user.View-Users', compact('breadcrumbs'));
        }

        $breadcrumbs = [
            ['name' => 'Usuarios', 'url' => route('users.users')],
            ['name' => 'Detalles', '' => ''],

        ];
        $roleName = $usuario->roles->first()->name; // Consulta el tipo de rol del usuario
        $count = 0;
        $created_at = Carbon::parse($usuario->created_at)->locale('es')->isoFormat('LL');

        return view('user.User-Details', compact('usuario', 'roleName', 'breadcrumbs', 'count', 'created_at'));
    }

    public function store(StoreUserRequest $request)
    {

        $validated = $request->validated();
        
        
        //$user = User::where('id', $Id)->first();

        $users = User::where('user_name', $request->only('code'))->first();
        if ($users) {
            return response()->json(['status' => 202, 'msg' => '¡Error! El usuario ya existe en el sistema.']);
        } else {

            // Store the file securely 
            $filename = $request->file('file')->store('cartas-compromiso');

             DB::transaction(
                function () use ($request, $filename) {

                    // Obtiene el rol
                    $role = Role::findOrFail($request->userType); //Buscar si el rol existe
                    
                    // Si el usuario no existe, crea un nuevo usuario con contraseña por defecto
                    User::create([
                        'user_name' => $request->code,
                        'name' => $request->name,
                        'email' => $request->email,
                        'cedula' => $request->cedula,
                        'file' => $filename,
                        'estado' => 'Activo',
                        'password' => bcrypt(env('DEFAULT_PASSWORD', 'Cu@ltos2024')),
                    ])->syncRoles($role);
                    
                    
                    // Envío de correo electrónico
                   // Mail::to($mail)->send(new RegistroMail($username));
                }
            );
            return response()->json(['status' => 200, 'msg' => '¡Éxito! el usuario fue agregado al sistema.']);
        }
        return response()->json(['resultado' => 400, 'msg' => '¡Error! Hubo un error al al realizar la petición.']);
    }


    /*
        Funcion para mostrar todos los usuarios del sistema a excepcion de usuario de la sesion
    */
    public function showUser(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);
        $search = $request->input('search', '');

        $query = User::query();

        if (!empty($search)) {

            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'like', "%$search%")
                    ->orWhere('users.user_name', 'like', "%$search%")
                    ->orWhere('users.estado', 'like', "%$search%");
            });
        }

        $users = $query
            ->select('users.id', 'users.estado', 'users.user_name', 'users.name', 'roles.name as role_name', 'roles.id as role_id') // Selecciona los campos de interés
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('users.id', '!=', auth()->user()->id)
            ->get();

        return response()->json([
            'results' => $users,
            'count' => $users->count(),
        ]);
    }
    /*
     Funcion para actualizar los datos de un usuario
    */
    public function update(Request $request)
    {
        // Errores en español 
        $messages = [
            'Id.required' => 'El campo ID es obligatorio.',
            'Id.numeric' => 'El campo ID debe ser un número.',
            'Id.exists' => 'El usuario no existe en la base de datos.',
            'Email.required' => 'El campo Email es obligatorio.',
            'Email.email' => 'El campo Email debe ser una dirección de correo válida.',
            'Type.required' => 'El campo Tipo es obligatorio.',
            'Type.numeric' => 'El campo Tipo debe ser un número.',
            'Type.in' => 'El campo Tipo de usuario no es válido.',
            'Status.required' => 'El campo Estado es obligatorio.',
            'Status.numeric' => 'El campo Estado debe ser un número.',
            'Status.in' => 'El campo Estado no es válido.',
            'Cedula.numeric' => 'El campo Cedula debe ser un número válido.',
        ];
        // Validar datos
        $validator = Validator::make($request->all(), [
            'Id' => 'required|numeric|exists:users,id',
            'Email' => 'required|email',
            'Type' => 'required|numeric|in:1,2,3',
            'Status' => 'required|numeric|in:1,2',
            'Cedula' => 'nullable|numeric',
        ], $messages);

        // Error en algun dato
        if ($validator->fails()) {
            return response()->json(['type' => 0, 'errors' => $validator->errors()], 400);

            // return response()->json(['status' => 202, 'errors' => $validator->errors()]);
        }

        $Id = $request['Id'];
        $Email = $request['Email'];
        $Tipo = intval($request['Type']);
        $Status = $request['Status'];
        $Cedula = $request['Cedula'];

        if ($Status == 1) {
            $Status = "Activo";
        } else {
            $Status = "Inactivo";
        }
        $user = User::where('id', $Id)->first();

        if ($user) {
            DB::transaction(function () use ($Email, $Tipo, $Status, $Cedula, $user) {
                $user->update([
                    'email' => $Email,
                    'estado' => $Status,
                    'cedula' => $Cedula,
                    'updated_at' => now(),
                ]);
                $user->syncRoles([$Tipo]);
            });

            return response()->json(['status' => 200, 'msg' => 'Datos editados correctamente.']);
        } else {
            return response()->json(['type' => 1, 'msg' => 'El usuario ya existe en la base de datos.'], 400);
        }
        return response()->json(['status' => 404, 'msg' => 'Error, algo salio mal.']);
    }

    public function Desactive(Request $request)
    {
        $data = $request->validate([
            'Id' => 'required|numeric|',
        ]);

        $Id = intval($data['Id']);


        $user = User::where('id', $Id)->first();

        if ($user) {
            DB::transaction(function () use ($user) {
                $user->update([
                    'estado' => "Inactivo",
                    'updated_at' => now(),
                ]);
            });

            return response()->json(['status' => 200, 'msg' => 'Se elimino el acceso al sistema.']);
        } else {
            return response()->json(['status' => 404, 'msg' => 'Error, algo salio mal.']);
        }
    }

































    /* Funcion para buscar el nombre del usuario segun el codigo que se escribio */
    public function CheckUsers(Request $request)
    {
        $data = $request->validate([
            'code' => 'required',
        ]);

        $username = $data['code'];

        if (!preg_match('/^[0-9]{7,10}$/', $username)) {
            return response()->json(['status' => 400, 'msg' => '¡Error! Hubo un error al recibir los parámetros para la petición.']);
        }

        $administrativo = Administrativo::on('sistema_personal')->where('codigo', $username)->first();
        if (!$administrativo) {
            // Si el código no está enlazado a ningún trabajador
            return response()->json(['status' => 202, 'msg' => '¡Error!, el código agregado no está enlazado a ningún trabajador.']);
        } else {
            $user = User::where('user_name', $username)->first();

            if ($user) {
                // Si ya existe un usuario con el código ingresado
                return response()->json(['status' => 202, 'msg' => '¡Error!, Ya existe un usuario con el código ingresado.']);
            } else {
                $nombre = $administrativo->nombre;
                // Si el código existe y no hay usuario asociado
                return response()->json(['status' => 200, 'msg' => $nombre, 'code' => $username]);
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
}
