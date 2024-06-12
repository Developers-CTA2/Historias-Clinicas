<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\addPatientsController;
use App\Http\Controllers\WebServicePersonController;
use App\Http\Controllers\EndPointPersonsController;
use App\Http\Controllers\DiseasesController;
use App\Http\Controllers\SpecificDiseasesController;
use App\Http\Controllers\AllergiesController;
use App\Http\Controllers\AddictionsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CitasController;



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


    /*  ADMINISTRACION  */
    Route::prefix('admin')->group(function () {
        // DISEASES
        Route::get('/diseases', [DiseasesController::class, 'Diseases_View'])->name('admin.diseases');
        Route::get('/obt-diseases', [DiseasesController::class, 'showdiseases'])->name('obt-diseases');
        Route::post('/edit-diseases', [DiseasesController::class, 'Update_disease'])->name('edit-diseases');
        Route::post('/add-diseases', [DiseasesController::class, 'Store_disease'])->name('add-diseases');

        // SPECIFIC
        Route::get('/specific-diseases', [SpecificDiseasesController::class, 'specific_View'])->name('admin/specific-diseases');
        Route::get('/obt-specific-diseases', [SpecificDiseasesController::class, 'showdiseases'])->name('obt-specific-diseases');
        Route::post('/edit-specific-diseases', [SpecificDiseasesController::class, 'Update_specific'])->name('edit-specific-diseases');
        Route::post('/add-specific-diseases', [SpecificDiseasesController::class, 'Store_specific'])->name('add-specific-diseases');

        // ALLERGIES
        Route::get('/allergies', [AllergiesController::class, 'Allergies_View'])->name('admin.allergies');
        Route::get('/obt-allergies', [AllergiesController::class, 'showAllergies'])->name('obt-allergies');
        Route::post('/edit-allergies', [AllergiesController::class, 'Update_allergies'])->name('edit-allergies');
        Route::post('/add-allergy', [AllergiesController::class, 'Store_allergy'])->name('add-allergy');

        // ADICTIONS
        Route::get('/addictions', [AddictionsController::class, 'Addictions_View'])->name('admin.addictions');
        Route::get('/obt-addictions', [AddictionsController::class, 'showdaddictions'])->name('obt-addictions');
        Route::post('/edit-addictions', [AddictionsController::class, 'Update_addictions'])->name('edit-addictions');
        Route::post('/add-addiction', [AddictionsController::class, 'Store_addiction'])->name('add-addiction');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/details', [ProfileController::class, 'Profile_View'])->name('profile.details');
        Route::post('/verify-password', [ProfileController::class, 'verifyPass'])->name('verify-password');
        Route::post('/change-password', [ProfileController::class, 'changePass'])->name('change-password');
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
Route::get('/agendar_citas', [CitasController::class, 'agenda'])->name('showAgenda');
Route::get('/citas-dia', [CitasController::class, 'citasDelDia']);

Route::get('/citas', function () {
    return view('admin.citas');
})->name('showCitas');

Route::get('/citas', [CitasController::class, 'mostrarCitas'])->name('showCitas');
Route::post('/guardar-cita', [CitasController::class, 'guardarCita'])->name('guardarCita');
Route::get('/proxima-cita', [CitasController::class, 'proximaCita']);




