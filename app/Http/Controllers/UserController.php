<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Consulta;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

use  Carbon\Carbon;

class UserController extends Controller
{

    /*
        Funcion que retorna la vista de usuarios y el breadcrumb 
   */
    public function breadCrumb()
    {
        $breadcrumbs = [
            ['name' => 'Usuarios', '' => ''],

        ];

        return view('user.View-Users', compact('breadcrumbs'));
    }

    /* Funcion para ver los detalles del usuario selecciondo */
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
        $count = Consulta::where('created_by', $id)->count();
        $created_at = Carbon::parse($usuario->created_at)->locale('es')->isoFormat('LL');

        return view('user.User-Details', compact('usuario', 'roleName', 'breadcrumbs', 'count', 'created_at'));
    }

    /*
    Funcion que retorna la vista de agregar un usuario y el breadcrumb
 */
    public function breadCrumbAdd()
    {
        $breadcrumbs = [
            ['name' => 'Usuarios', 'url' => route("users.users")],
            ['name' => 'Agregar usuario', '' => ''],

        ];

        return view('user.Add-User', compact('breadcrumbs'));
    }

    /*
    Funcion para agregar un nuevo registro a la tabla de usuarios 
*/
    public function store(StoreUserRequest $request)
    {

        $validated = $request->validated();

        $users = User::where('user_name', $request->only('code'))->first();
        if ($users) {
            return response()->json(['title' => 'Oops..!', 'msg' => 'El usuario ya existe en el sistema.'], 409);
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
                        'sex' => $request->sex,
                        'cedula' => $request->cedula,
                        'file' => $filename,
                        'estado' => 'Activo',
                        'password' => bcrypt($_ENV['DEFAULT_PASS']),
                    ])->syncRoles($role);
                    // Envío de correo electrónico
                    // Mail::to($mail)->send(new RegistroMail($username));
                }
            );
            return response()->json(['status' => 200, 'title' => '¡Éxito!', 'msg' => 'El usuario fue agregado al sistema.']);
        }
        return response()->json(['resultado' => 400, 'title' => 'Oops..!', 'msg' => '¡Error! Hubo un error al registrar un nuevo usuario al sistema.']);
    }


    /*
        Funcion para mostrar todos los usuarios del sistema a excepcion de usuario de la sesion
    */
    public function showUser(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);
        $search = $request->input('search', '');

        $query = User::with('roles')
                ->where('users.id', '!=', auth()->user()->id)
                ->whereNot('users.user_name', '010101');

        if (!empty($search)) {

            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'like', "%$search%")
                    ->orWhere('users.user_name', 'like', "%$search%")
                    ->orWhere('users.estado', 'like', "%$search%");
            });
        }

        $total = $query->count();  // Restamos el usuario de CTA
        $users = $query->skip($offset)
                        ->take($limit)
                        ->get();

        $users = $users->map(function($query){
            $query->sexType =  $query->sex === 'Masculino' ? 1 : 2;
            return $query;
        });
        
        return response()->json([
            'results' => $users,
            'count' => $total,
        ]);
    }


    /*
     Funcion para actualizar los datos de un usuario
    */
    public function update(UpdateUserRequest $request)
    {
        $validate = $request->validated();

        
        $Status =  ""; // FORMATO DEL ESTADO
        if ($validate['estado'] == 1) {
            $Status = "Activo";
        } else {
            $Status = "Inactivo";
        }
        
        $user = User::where('id', $validate['id'])->first();
        
        try {
            DB::transaction(function () use ($validate, $user, $Status) {
                $user->update([
                    'email' => $validate['email'],
                    'estado' => $Status,
                    'cedula' => $validate['cedula'],
                    'updated_at' => now(),
                ]);
                $user->syncRoles(intval($validate['userType']));
            });
            return response()->json(['status' => 200, 'msg' => 'Datos del usuario actualizados correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['msg' => 'Error, algo salio mal, intentalo más tarde.', 'error' => $e->getMessage()],500);
        }
    }

    /*
        Funcion para eliminar el acceso al sistema a un usuario en especifico
    */


    public function Desactive(Request $request)
    {
        $messages = [
            'Id.required' => 'El compo ID del usuario es obligatorio.',
            'Id.numeric' => 'El compo ID del usuario debe ser un número.',
            'Id.exists' => 'El ID ingresado no corresponde a ningun usuario.',
        ];

        $data = Validator::make($request->all(), [
            'Id' => 'required|numeric|exists:users,id',
        ], $messages);

        if ($data->fails()) {
            //return response()->json(['status' => 400, 'msg' => $data->errors()]);
            return response()->json(['errors' => $data->errors()], 400);
        }

        $Id = intval($request['Id']);
        $user = User::where('id', $Id)->first();

        try {
            DB::transaction(function () use ($user) {
                $user->update([
                    'estado' => "Inactivo",
                    'updated_at' => now(),
                ]);
            });
            return response()->json(['status' => 200, 'msg' => 'Se elimino el acceso al sistema.']);
        } catch (\Exception $e) {
            return response()->json(['errors' => 'Ha ocurrido un error al realizar la petición', 'error' => $e], 500);
        }
    }
}
