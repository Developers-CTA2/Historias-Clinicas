<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class AddictionsTest extends TestCase
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
    public function test_addictions_page()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->get('/admin/obt-addictions');

        $response->assertStatus(200)
            ->assertJsonStructure([ //Esto asegura que la estructura del JSON es la esperada, sin verificar valores específicos en los campos.
                'count',
                'results' => [
                    '*' => [
                        'nombre',
                        'id',
                    ]
                ]
            ]);
    }

    /* Funcion para agregar un registro de una addiccion */
    public function test_addictions_add()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/add-addiction', [
            'Name' => 'Taco dorado',
        ]);

        $response->assertStatus(200);  // Error 
    }

    /* Funcion para agregar un registro de una addiccion con el dato vacio*/
    public function test_addictions_add_empty_data()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/add-addiction', [
            'Name' => '',
        ]);

        $response->assertStatus(400);  // Error 
    }

    /* Funcion para agregar un registro de una addiccion con un dato duplicado */
    public function test_addictions_add_duplicate_data()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/add-addiction', [
            'Name' => 'Tabaquismo',
        ]);

        $response->assertStatus(400);  // Error 
    }
    
    /* Funcion para editar un registro de una addiccion */
    public function test_addictions_edit()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/add-addiction', [
            'Id' => 1,
            'Name' => 'Prueba',
        ]);

        $response->assertStatus(200);  // Error 
    }

    /* Funcion para editar un registro de una addiccion pero con un dato vacio */
    public function test_addictions_edit_empty_data()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/add-addiction', [
            'Id' => 1,
            'Name' => '',
        ]);

        $response->assertStatus(400);  // Error 
    }

    /* Funcion para editar un registro de una addiccion pero con un dato vacio */
    public function test_addictions_edit_duplicate_data()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/add-addiction', [
            'Id' => 1,
            'Name' => 'Tabaquismo',
        ]);

        $response->assertStatus(400);  // Error 
    }

    /* Funcion para editar un registro de una addiccion pero el Id no existe */
    public function test_addictions_edit_id_dont_exist()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/add-addiction', [
            'Id' => 115,
            'Name' => 'Quesillo',
        ]);

        $response->assertStatus(400);  // Error 
    }

}
