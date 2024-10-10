<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class AllergyTest extends TestCase
{
    /**
     * A basic feature test example.
     */
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

    /* Funcion para ver los registros de alergias  */
    public function test_allergies_page()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->get('/admin/obt-allergies');

        $response->assertStatus(200)
            ->assertJsonStructure([ //Esto asegura que la estructura del JSON es la esperada, sin verificar valores específicos en los campos.
                'count',
                'results' => [
                    '*' => [
                        'nombre',
                        'id_alergia',
                    ]
                ]
            ]);
    }

    /* Funcion para agregar un registro de una alergia */
    public function test_allergies_add()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/add-allergy', [
            'Name' => 'Taco dorado',
        ]);

        $response->assertStatus(200);  // Error 
    }

    /* Funcion para agregar un registro de una alergia pero el dato es vacio*/
    public function test_allergies_add_empty_data()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/add-allergy', [
            'Name' => '',
        ]);

        $response->assertStatus(400);  // Error 
    }

    /* Funcion para agregar un registro de una alergia pero el dato es vacio*/
    public function test_allergies_add_duplicate_data()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/add-allergy', [
            'Name' => 'Alergias alimentarias',
        ]);

        $response->assertStatus(400);  // Error 
    }

    /* Funcion para editar un registro de una alergia */
    public function test_allergies_edit()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/add-allergy', [
            'Id' => 1,
            'Name' => 'prueba alergia',
        ]);

        $response->assertStatus(200);  // Error 
    }

    /* Funcion para editar un registro de una alergia pero un dato es vacio */
    public function test_allergies_edit_empty_data()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/add-allergy', [ 
            'Id' => 1,
            'Name' => '',
        ]);

        $response->assertStatus(400);  // Error 
    }

    /* Funcion para editar un registro de una alergia pero el Id del registro no existe */
    public function test_allergies_edit_id_dont_exist()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/add-allergy', [
            'Id' => 115,
            'Name' => 'Hola mundo',
        ]);

        $response->assertStatus(400);  // Error 
    }



}
