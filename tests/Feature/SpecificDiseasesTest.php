<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class SpecificDiseasesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    /*  Funcion para el inicio de sesion */
    private function signIn($code, $password)
    {
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');

        $user = User::where('user_name', $code)->first();
        $authenticated = $this->post('/login', [
            'user_name' => $user->user_name,
            'password' => $password
        ]);
        return $authenticated;
    }

    /* Funcion para ver los tipos de enfermedades con un usuario con permisos */
    public function test_diseases_page()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->get('/admin/obt-specific-diseases');

        $response->assertStatus(200)
            ->assertJsonStructure([ //Esto asegura que la estructura del JSON es la esperada, sin verificar valores específicos en los campos.
                'count',
                'results' => [
                    '*' => [         
                    'nombre',
                    'id_especifica_ahf',
                    'id_tipo_ahf',
                    ]
                ]
            ]);
    }

    /* Funcion para agregar una nueva enfermedad especifica  */
    public function test_specific_add()
    {
        $code = '2166104';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/add-specific-diseases', [
            'Name' => 'Tostada de tinga',
            'Type' => 1,
        ]);

        $response->assertStatus(200); 

    }

    /* Funcion para agregar una nueva enfermedad  especifica pero el tipo no existe  */
    public function test_specific_add_type_dont_exist()
    {
        $code = '2166104';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/add-specific-diseases', [
            'Name' => 'Tostadas',
            'Type' => 100,
        ]);

        $response->assertStatus(400);  // Error 

    }

    /* Funcion para agregar una nueva enfermedad especifica pero el nombre ya existe */
    public function test_specific_add_duplicate_data()
    {
        $code = '2166104';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/add-specific-diseases', [
            'Name' => 'Hipercolesterolemia',
            'Type' => 1,
        ]);

        $response->assertStatus(400);  // Error 

    }

    /* Funcion para agregar una nueva enfermedad especifica pero los datos son vacios*/
    public function test_specific_add_empty_data()
    {
        $code = '2166104';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/add-specific-diseases', [
            'Name' => '',
            'Type' => '',
        ]);

        $response->assertStatus(400);  // Error 

    }

    /* Funcion para editar una enfermedad especifica  */
    public function test_specific_edit()
    {
        $code = '2166104';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/edit-specific-diseases', [
            'Esp' => 1,
            'Tipo' => 1,
            'Name' => 'Prueba',
        ]);

        $response->assertStatus(200);  // Error 

    }

    /* Funcion para editar una enfermedad especifica  */
    public function test_specific_edit_empty_data()
    {
        $code = '2166104';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/edit-specific-diseases', [
            'Esp' => 1,
            'Tipo' => "",
            'Name' => '',
        ]);

        $response->assertStatus(400);  // Error 

    }

    /* Funcion para editar una enfermedad especifica  pero el tipo de enfermadad no existe*/
    public function test_specific_edit_type_dont_exist()
    {
        $code = '2166104';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/edit-specific-diseases', [
            'Esp' => 1,
            'Tipo' => 100,
            'Name' => 'Galleta',
        ]);

        $response->assertStatus(400);  // Error 

    }

    /* Funcion para editar una enfermedad especifica  pero el Id del registro no existe*/
    public function test_specific_edit_id_dont_exist()
    {
        $code = '2166104';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/edit-specific-diseases', [
            'Esp' => 500,
            'Tipo' => 1,
            'Name' => 'Papitas',
        ]);

        $response->assertStatus(400);  // Error 

    }

    /* Funcion para editar una enfermedad especifica el nombre ye  existe*/
    public function test_specific_edit_duplicate_data()
    {
        $code = '2166104';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/edit-specific-diseases', [
            'Esp' => 1,
            'Tipo' => 1,
            'Name' => 'Hipercolesterolemia',
        ]);

        $response->assertStatus(400);  // Error 

    }

}
