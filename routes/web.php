<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\addPatientsController;
use App\Http\Controllers\WebServicePersonController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});



Route::middleware('auth')->group(function () {

    // Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/home', [HomeController::class, 'index'])->name('home');


    ///////      USUARIOS 
    Route::get('/users', function () {
        return view('admin.View-Users');
    })->name('users');
    Route::get('/obt-usuarios', [UserController::class, 'showUser'])->name('obt-usuarios');
    Route::get('/users', [UserController::class, 'breadCrumb'])->name('users');

    Route::get('/add-user', function () {
        return view('admin.Add-User');
    })->name('add-user');

    Route::get('/add-user', [UserController::class, 'breadCrumbAdd'])->name('add-user');

    Route::get('/user-details/{id}', [UserController::class, 'userDetails'])->name('user-details');

    //Route::get('/usuarios', [UserController::class, 'show'])->name('usuarios');
    Route::post('/editar-usuario', [UserController::class, 'Update'])->name('editar-usuario');
    Route::post('/agregar-usuario', [UserController::class, 'store'])->name('agregar-usuario');
    Route::post('/eliminar-usuario', [UserController::class, 'delete'])->name('eliminar-usuario');
    Route::post('/verificar-codigo', [UserController::class, 'CheckUsers'])->name('verificar-codigo');

    //CheckUsers
    ///// SEGURIDAD  
    Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('reset-password');

    Route::post('/Verify-password', [UserController::class, 'verifyPass'])->name('Verify-password');
    Route::post('/Change-password', [UserController::class, 'ChangePassword'])->name('Change-password');

    ///// REGISTROS DE PACIENTES



    ///// VER PACIENTES
    Route::get('/ver_pacientes', function () {
        return view('admin.seePatient');
    })->name('showPatients');
    Route::get('/ver_pacientes', [PatientsController::class, 'breadCrumb'])->name('showPatients');
    Route::get('/obt-pacientes', [PatientsController::class, 'show'])->name('obt-pacientes');

    Route::get('/expediente/{id}', function ($id) {
        return view('admin.expediente');
    });

    //AGREGAR PACIENTE
    Route::post('/buscar-persona', [addPatientsController::class, 'buscarPersona']);
    Route::get('/agregar_paciente', [AddPatientsController::class, 'showForm'])->name('showForm');
    Route::get('/enfermedades-relacionadas/{tipoAHFId}', [AddPatientsController::class, 'getEnfermedadesRelacionadas'])->name('enfermedades-relacionadas');



    // Verificar rol 
    Route::middleware('role:admin')->group(function () {
    });



    /* APIS */
    Route::post('/api/get-person', [WebServicePersonController::class, 'getPersonWebService'])->name('api.get-person');

});

// AGENDAR CITAS
Route::get('/agendar_citas', function () {
    return view('admin.agenda');
})->name('showAgenda');
