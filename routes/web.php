<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WebServicePersonController;
use App\Http\Controllers\EndPointPersonsController;
use App\Http\Controllers\DiseasesController;
use App\Http\Controllers\SpecificDiseasesController;
use App\Http\Controllers\AllergiesController;
use App\Http\Controllers\AddictionsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\HistoryConsultationController;
use App\Http\Controllers\ExpedientController;
use App\Http\Controllers\NutritionHistoryController;
use App\Http\Controllers\newConsultationNutritionController;

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
        Route::get('/', [UserController::class, 'breadCrumb'])->name('users.users');
        Route::get('/obt-usuarios', [UserController::class, 'showUser'])->name('users.obt-usuarios');
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

    Route::prefix('patients')->group(function () {
        Route::get('/', [PatientsController::class, 'index'])->name('patients.index');
       // Route::get('/user-details/{id}', [UserController::class, 'userDetails'])->name('users.user-details');
        Route::get('/expediente/{id}', [ExpedientController::class, 'Patient_details'])->name('admin.expediente');
        Route::get('/obt-pacientes', [PatientsController::class, 'show'])->name('obt-pacientes');
        Route::get('/add-patient', [PatientsController::class, 'create'])->name('patients.add-patient');
        Route::post('/save-patient', [PatientsController::class, 'store'])->name('save-patient');
        Route::post('/expediente/Update_Personal_Data', [ExpedientController::class, 'Update_Personal_Data'])->name('Update_Personal_Data');
        Route::post('/expediente/Update_ahf_Data', [ExpedientController::class, 'Update_Ahf_Data'])->name('Update_Ahf_Data');
        Route::post('/expediente/add_ahf_Data', [ExpedientController::class, 'add_Ahf_Data'])->name('add_Ahf_Data');

        // Route::get('/expediente{/id}', function ($id) {
        //     return view('admin.expediente');
        // });

        Route::prefix('/consultation')->group(function () {
            Route::get('/{id_persona}/new',[ConsultationController::class,'create'])->name('consultation.new');
            Route::post('/{id_persona}/save',[ConsultationController::class,'store'])->name('consultation.save');

            Route::get('/{id_persona}/history',[HistoryConsultationController::class,'show'])->name('consultation.history');
            Route::get('/{id_persona}/history/{id_consulta}/details',[HistoryConsultationController::class,'details'])->name('consultation.history.details');
            Route::get('/{id_persona}/history/get-consultation',[HistoryConsultationController::class,'getConsultationsPerson'])->name('consultation.history.obt-consultations');
        }); 

        Route::prefix('/nutricion')->group(function () {
            Route::get('/historial-nutricion/{id_persona}', [NutritionHistoryController::class, 'show'])->name('historial.nutricion');
            Route::get('/historial-nutricion/create/{id}', [NutritionHistoryController::class, 'create'])->name('historial.nutricion.create');
            Route::post('/historial-nutricion/store', [NutritionHistoryController::class, 'store'])->name('historial.nutricion.store');

            Route::get('/consulta/create/{id}', [newConsultationNutritionController::class, 'crear'])->name('consulta.nutricion.create');
            Route::post('/consulta/store', [newConsultationNutritionController::class, 'consulta'])->name('consulta.nutricion.store');
            Route::get('/consulta/{id_persona}', [newConsultationNutritionController::class, 'show'])->name('consulta.nutricion.show');
        }); 

    });

    

    ///// REGISTROS DE PACIENTES
    


    ///// VER PACIENTES
   
    // Route::get('/ver_pacientes', [PatientsController::class, 'breadCrumb'])->name('showPatients');
    

    //AGREGAR PACIENTE
    // Route::post('/buscar-persona', [addPatientsController::class, 'buscarPersona']);
    // Route::get('/agregar_paciente', [AddPatientsController::class, 'showForm'])->name('showForm');
    // Route::get('/enfermedades-relacionadas/{tipoAHFId}', [AddPatientsController::class, 'getEnfermedadesRelacionadas'])->name('enfermedades-relacionadas');


    // Route::prefix('nutrition')->group(function () {
    //     Route::get('/details', [ProfileController::class, 'Profile_View'])->name('profile.details.nutrition');
         
    // });






    // Verificar rol 


    /* APIS */
    Route::post('/api/get-person/{code}/{token}', [WebServicePersonController::class, 'getPersonWebService'])->name('api.get-person');
    Route::get('/api/get-deseases/{id}', [SpecificDiseasesController::class, 'getSpecificDiseases'])->name('api.get-deseases');
    Route::get('/api/get-all-diseases', [SpecificDiseasesController::class, 'getSpecificDiseasesAll'])->name('api.get-all-deseases');
    
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
Route::post('/guardarCita', [CitasController::class, 'guardarCita'])->name('guardarCita');
Route::get('/validar-hora/{fecha}/{hora}/{tipo_profesional}', [CitasController::class, 'validarHora']);


Route::get('/proxima-cita', [CitasController::class, 'proximaCita']);

Route::put('/citas/{id}', [CitasController::class, 'actualizar'])->name('actualizarCita');
Route::get('/validar-hora-modificar/{id}/{fecha}/{hora}', [CitasController::class, 'validarHoraModificar']);

Route::put('/citas/cancelar/{id}', [CitasController::class, 'cancelar'])->name('cancelarCita');
Route::delete('/citas/eliminar/{id}', [CitasController::class, 'eliminar'])->name('eliminarCita');






