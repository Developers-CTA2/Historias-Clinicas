<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\Administrativo;
use App\Models\Consulta;
 use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
 
use Illuminate\Support\Facades\Validator;
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

        $query = User::query()->where('user_name', '!=', '010101')->orderby('estado');

        if (!empty($search)) {

            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'like', "%$search%")
                    ->orWhere('users.user_name', 'like', "%$search%")
                    ->orWhere('users.estado', 'like', "%$search%");
            });
        }

        $total = $query->count()-1;
        $users = $query
            ->select('users.id', 'users.estado', 'users.user_name', 'users.name', 'roles.name as role_name', 'roles.id as role_id') // Selecciona los campos de interés
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('users.id', '!=', auth()->user()->id)
            ->get();

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
        $validated = $request->validated();
    //return response()->json($validated);

        // Validar datos
        // $validator = Validator::make($request->all(), [
        //     'Id' => 'required|numeric|exists:users,id',
        //     'Email' => 'required|email',
        //     'Type' => 'required|numeric|in:1,2,3',
        //     'Status' => 'required|numeric|in:1,2',
        //     'Cedula' => 'nullable|numeric',
        // ], $messages);

        // Error en algun dato
        // if ($validator->fails()) {
        //     return response()->json(['type' => 0, 'errors' => $validator->errors()], 400);
        // }

       
        $Status = $request->status;
        
        if ($Status == 1) {
            $Status = "Activo";
        } else {
            $Status = "Inactivo";
        }
        $user = User::where('id', $request->id)->first();

        if ($user) {
            DB::transaction(function () use ($request, $user, $Status) {
                $user->update([          
                    'email' =>$request->email,
                    'estado' => $Status,
                    'cedula' => $request->cedula,
                    'updated_at' => now(),
                ]);
                $user->syncRoles($request->userType);
            });

            return response()->json(['status' => 200, 'msg' => 'Datos editados correctamente.']);
        // } else {
        //     return response()->json(['type' => 1, 'msg' => 'El usuario ya existe en la base de datos.'], 400);
         }
        return response()->json(['status' => 404, 'msg' => 'Error, algo salio mal, intentalo más tarde.']);
    }

    /*
        Funcion para eliminar el acceso al sistema a un usuario en especifico
    */
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
}
