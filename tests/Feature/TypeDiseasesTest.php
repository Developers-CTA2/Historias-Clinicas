<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;



class TypeDiseasesTest extends TestCase
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

        $response = $this->get('/admin/obt-diseases');

        $response->assertStatus(200)
            ->assertJsonStructure([ //Esto asegura que la estructura del JSON es la esperada, sin verificar valores específicos en los campos.
                'count',
                'results' => [
                    '*' => [
                        'nombre',
                        'id_tipo_ahf',
                    ]
                ]
            ]);
    }

    /* Funcion para ver agregar un nuevo tipo de enfermedad  */
    public function test_diseases_add()
    {
        $code = '2166104';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/add-diseases', [
            'Name' => 'Tostada de tinga',
        ]);

        $response->assertStatus(200);  // Error 

    }

    /* Funcion para ver agregar un nuevo tipo de enfermedad pero dara error ya que va un dato vacio  */
    public function test_diseases_add_empty_data()
    {
        $code = '2166104';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/add-diseases', [
            'Name' => '',
        ]);

        $response->assertStatus(400);  // Error 

    }
    /* Funcion para agregar un datp duplicado */
    public function test_diseases_add_duplicate_data()
    {
        $code = '2166104';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/add-diseases', [
            'Name' => 'Dislipidemias',
        ]);

        $response->assertStatus(400);  // Error 

    }
    /* Funcion para editra los datos de un tipo de enfermedad  */
    public function test_diseases_edit_data()
    {
        $code = '2166104';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/edit-diseases', [
            'Id' => '1',
            'Name' => 'Traka',
        ]);

        $response->assertStatus(200);  // Error 

    }
    /* Funcion para editar una enfermedad pero dara error ya que va eun dato vacio*/
    public function test_diseases_edit_empty_data()
    {
        $code = '2166104';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/edit-diseases', [
            'Id' => '',
            'Name' => 'Taco dorado',
        ]);

        $response->assertStatus(400);  // Error 

    }

    /* Funcion para editar una enfermedad pero el dato se duplicará con otro */
    public function test_diseases_edit_duplicated_data()
    {
        $code = '2166104';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->post('/admin/edit-diseases', [
            'id' => '5',
            'Name' => 'Neurológicas',
        ]);

        $response->assertStatus(400);  // Error 

    }
}
