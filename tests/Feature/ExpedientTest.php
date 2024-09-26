<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class ExpedientTest extends TestCase
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
    public function test_expedient_page()
    {
        $code = '010101';
        $password = 'Aa@1';
        $authenticated = $this->signIn($code, $password);

        $response = $this->get('/patients/medical_record/1');// Id de un paciente

        $response->assertStatus(200)->assertSee('Acceso prohibido'); // Acceso denegado

    }

}
