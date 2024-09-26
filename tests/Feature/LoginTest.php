<?php

namespace Tests\Feature;

use App\Models\Hemotipo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;

use Tests\TestCase;
use App\Models\User; // Asegúrate de importar el modelo User si usas factories

class LoginTest extends TestCase
{
    use RefreshDatabase; // Usar RefreshDatabase para que las pruebas de la base de datos se aíslen correctamente

    /**
     * Verificar que la página de login está disponible.
     */
    public function test_login_page()
    {
       Artisan::call('migrate');
       Artisan::call('db:seed');
        // Verificar que la ruta de login existe
        $response = $this->get('/login');

        $response
            ->assertStatus(200);
            
    }


    public function test_user_can_login()
    {
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');
        // Crear un usuario usando factories
        $users = Hemotipo::all();
    
        // Intentar iniciar sesión
        $response = $this->post('/login', [
            'user_name' => '010101',
            'password' => 'Aa@1'
        ]);

        // Verificar que la sesión se ha iniciado correctamente y se redirige al home
        $response->assertRedirect('/home')->assertSessionHasNoErrors();
    }

    // Verificar que el usuario no puede iniciar sesión con credenciales incorrectas
    public function test_user_cannot_login_with_incorrect_credentials()
    {

        $response = $this->post('/login', [
            'user_name' => '010101',
            'password' => 'Aa@12'
        ]);

        $response->assertStatus(302)->assertSessionHasErrors(['user_name' => 'Estas credenciales no coinciden con nuestros registros.']);

    }

    public function test_login_validation_username()
    {

        $response = $this->post('/login', [
            'user_name' => '',
            'password' => 'Aa@1'
        ]);

        $response->assertStatus(302)->assertSessionHasErrors(['user_name' => 'El campo user name es obligatorio.']);

    }

    public function test_login_validation_password()
    {

        $response = $this->post('/login', [
            'user_name' => '010101',
            'password' => ''
        ]);

        $response->assertStatus(302)->assertSessionHasErrors(['password' => 'El campo contraseña es obligatorio.']);

    }

    public function test_login_validation_permissions()
    {

        $response = $this->post('/login', [
            'user_name' => '2726319',
            'password' => 'Aa@1'
        ]);

        $response->assertStatus(302)->assertSessionHasErrors(['user_name' => 'No puedes iniciar sesión, tu cuenta está inactiva.']);

    }
   
}
