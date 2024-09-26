<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class UsersTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    /*  Funcion para el inicio de sesion */
    private function signIn($code, $password)
    {

        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');

        /* 
            Para ser funcionar estas pruebas es 
            necesario modificar el login para acceder 
            con codigos ficticios.
        */

        $user = User::where('user_name', $code)->first();

        $authenticated = $this->post('/login', [
            'user_name' => $user->user_name,
            'password' => $password
        ]);

        return $authenticated;
    }
    /* Funcion para ver los usuarios con un usuario con permisos */
    public function test_users_page()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->get('/users/obt-usuarios');

        $response->assertStatus(200)
            ->assertJsonStructure([ //Esto asegura que la estructura del JSON es la esperada, sin verificar valores específicos en los campos.
                'count',
                'results' => [
                    '*' => [
                        'id',
                        'estado',
                        'user_name',
                        'name',
                        'role_name',
                        'role_id'
                    ]
                ]
            ]);
    }

    /*  Funcion para ver los usuarios per en este caso con un usuario que no tiene permisos */
    public function test_users_page_Permissions()
    {
        $code = '2166104';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->get('/users/obt-usuarios');

        // Verificar que el 'count' sea correcto y que 'results' no esté vacío
        $response->assertStatus(403)->assertSee('Acceso prohibido');
    }

    /* Funcion para ver los detalles de un usuario con un usuario que si tiene permisos */
    public function test_users_view_details()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->get('/users/user-details/2');  // id de un usuario x

        $response->assertStatus(200)->assertSee('Detalles del usuario'); // Permite ver la ventana

    }

    /* Funcion para verlos detalles de un usuario con un usuario que NO tiene permisos */
    public function test_users_view_details_permissions()
    {
        $code = '2166104';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->get('/users/user-details/2');  // id de un usuario x

        $response->assertStatus(403)->assertSee('Acceso prohibido'); // NO permite ver la ventana
    }

    //  DESACTIVAR 

    /* Funcion para inhabilitar un usuario que existe y con un usuario con el permiso */
    public function test_users_desactive_user_page()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/users/desactive-user', [
            'Id' => '1',
        ]);

        $response->assertStatus(200); // Permite realizar la accion
    }
    /* Funcion para inhabilitar un usuario que existe y con un usuario SIN el permiso */
    public function test_users_desactive_user_page_permissions()
    {
        $code = '2166104';  /// usuario sin permisos
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        // $response = $this->get('/users/desactive-user');  // id de un usuario x

        $response = $this->post('/users/desactive-user', [
            'Id' => '1',
        ]);

        $response->assertStatus(403); // Acceso denegado
    }

    /* Funcion para inhabilitar un usuario que NO existe y con un usuario con el permiso */
    public function test_users_desactive_user_page_user_empty_data()
    {
        $code = '2166104';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/users/desactive-user', [
            'Id' => '1',
        ]);

        $response->assertStatus(403)->assertSee('Acceso prohibido'); // Acceso denegado
    }

    /* Funcion para inhabilitar un usuario que NO existe y con un usuario con el permiso */
    public function test_users_desactive_user_page_user_empty_data_permissions()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/users/desactive-user', [
            'Id' => '',
        ]);

        $response->assertStatus(400); // Datos vacios
    }

    /* Funcion para inhabilitar un usuario que NO existe y con un usuario con el permiso */
    public function test_users_desactive_user_page_user_invalid_data()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/users/desactive-user', [
            'Id' => 'taco',
        ]);

        $response->assertStatus(400); // Dato invalido
    }

    /* Funcion para inhabilitar un usuario que NO existe y con un usuario con el permiso */
    public function test_users_desactive_user_page_user_dont_exist()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/users/desactive-user', [
            'Id' => '44',
        ]);

        $response->assertStatus(400); // Datos vacios
    }

    // EDITAR 

    /* Funcion para editar los datos de un usuario sin perimos  */
    public function test_users_edit_user()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/users/edit-user', [
            'id' => '1',
            'email' => 'hola@gmail.com',
            'cedula' => '',
            'userType' => '3',
            'estado' => 'Activo'
        ]);

        $response->assertStatus(200);  
    }

    public function test_users_edit_user_permissions()
    {
        $code = '2166104';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/users/edit-user', [
            'id' => '1',
            'email' => 'hola@gmail.com',
            'cedula' => '',
            'userType' => '3',
            'estado' => 'Activo'
        ]);

        $response->assertStatus(403)->assertSee('Acceso prohibido');  // Acceso denegado
    }

    /* Funcion para editar los datos de un usuario sin perimos  */
    public function test_users_edit_user_empty_data()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/users/edit-user', [
            'id' => '1',
            'email' => 'hola@gmail.com',
            'cedula' => '',
            'userType' => '3',
            'estado' => ''
        ]);

        $response->assertStatus(302);  // Error en los datos 
    }

    /// AGREGAR 

    /* Funcion para editar los datos de un usuario sin perimos  */
    public function test_users_add_user()
    {
        // DA ERROR POR LA VALIDACION DEL ARCHIVO PDF
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/users/new-user', [
            'code' => '1212011',
            'name' => 'Taco Dorado',
            'email' => 'hola@gmail.com',
            'cedula' => '',
            'userType' => 3,
            'estado' => 'Activo',
            'file' => 'Activo.pdf'
        ]);

        $response->assertStatus(302);  
    }

    /* Funcion para editar los datos de un usuario sin perimos  */
    public function test_users_add_user_permisssions()
    { 
        $code = '2166104';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/users/new-user', [
            'code' => '1212011',
            'name' => 'Taco Dorado',
            'email' => 'hola@gmail.com',
            'cedula' => '',
            'userType' => 3,
            'estado' => 'Activo',
            'file' => 'Activo.pdf'
        ]);

        $response->assertStatus(403)->assertSee('Acceso prohibido');  // Acceso denegado
    }






}
