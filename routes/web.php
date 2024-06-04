<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\addPatientsController;
use App\Http\Controllers\EndPointPersonsController;
use App\Http\Controllers\DiseasesController;
use App\Http\Controllers\SpecificDiseasesController;



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

    // ///////      USUARIOS 
    // Route::get('/users', function () {
    //     return view('admin.View-Users');
    // })->name('users');


    /*        USERS        */
    Route::prefix('users')->group(function () {
        Route::get('/obt-usuarios', [UserController::class, 'showUser'])->name('users.obt-usuarios');
        Route::get('/users', [UserController::class, 'breadCrumb'])->name('users.users');
        Route::post('/desactive-user', [UserController::class, 'Desactive'])->name('users.desactive-user');
        Route::get('/add-user', [UserController::class, 'breadCrumbAdd'])->name('users.add-user');
        Route::get('/user-details/{id}', [UserController::class, 'userDetails'])->name('users.user-details');
        Route::post('/End-Point-Persons', [EndPointPersonsController::class, 'getUser'])->name('End-Point-Persons');
        Route::post('/edit-user', [UserController::class, 'Update'])->name('users.edit-user');
        Route::post('/new-user', [UserController::class, 'store'])->name('new-user');

    });


    Route::prefix('admin')->group(function () {
        /*  ADMINISTRACION  */

        Route::get('/diseases', [DiseasesController::class, 'breadCrumb'])->name('admin.diseases');
        Route::get('/obt-diseases', [DiseasesController::class, 'showdiseases'])->name('obt-diseases');
        Route::post('/edit-diseases', [DiseasesController::class, 'Update_disease'])->name('edit-diseases');


        Route::get('/specific-diseases', function () {
            return view('administrar.View-Especifics');
        })->name('admin/specific-diseases');
        Route::get('/specific-diseases', [SpecificDiseasesController::class, 'breadCrumb'])->name('admin/specific-diseases');

        Route::get('/obt-specific-diseases', [SpecificDiseasesController::class, 'showdiseases'])->name('obt-specific-diseases');
        Route::post('/edit-specific-diseases', [SpecificDiseasesController::class, 'Update_specific'])->name('edit-specific-diseases');
    });





    ///// SEGURIDAD  
    Route::post('/Verify-password', [UserController::class, 'verifyPass'])->name('Verify-password');
    Route::post('/Change-password', [UserController::class, 'ChangePassword'])->name('Change-password');

    ///// REGISTROS DE PACIENTES
    Route::get('/agregar_paciente', function () {
        return view('admin.AddPatient');
    })->name('showForm');



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
});

// AGENDAR CITAS
Route::get('/agendar_citas', function () {
    return view('admin.agenda');
})->name('showAgenda');
