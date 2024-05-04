<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;



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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

//Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/contadores', [HomeController::class, 'counts'])->name('contadores');
Route::post('/detailsPeople', [HomeController::class, 'CountDetailsPeople'])->name('detailsPeople');


///////      USUARIOS 
Route::get('/a', function () {
    return view('welcome');
})->name('a');


///////      USUARIOS 
Route::get('/usuarios', function () {
    return view('admin.seeUsers');
})->name('usuarios');
Route::get('/obt-usuarios', [UserController::class, 'showUser'])->name('obt-usuarios');

Route::get('/agregar_usuario', function () {
    return view('admin.addUsers');
})->name('showUsers');

Route::get('/detalles/{id}', [UserController::class, 'userDetails'])->name('user.details');



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

Route::get('/agregar_paciente', function () {
    return view('admin.AddPatient');
})->name('showForm');

Route::get('/ver_pacientes', function () {
    return view('admin.seePatient');
})->name('showPatients');

Route::get('/obt-pacientes', [PatientsController::class, 'show'])->name('obt-pacientes');

Route::get('/expediente/{id}', function ($id) {
    return view('admin.expediente');
});


// Verificar rol 
Route::middleware('role:admin')->group(function () {

});

// AGENDAR CITAS
Route::get('/agendar_citas', function () {
    return view('admin.agenda');
})->name('showAgenda');

