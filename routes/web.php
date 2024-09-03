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
use App\Http\Controllers\AHFController;
use App\Http\Controllers\APNPController;
use App\Http\Controllers\APPController;
use App\Http\Controllers\GYOController;

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
        Route::get('/obt-pacientes', [PatientsController::class, 'show'])->name('obt-pacientes');
        Route::get('/add-patient', [PatientsController::class, 'create'])->name('patients.add-patient');
        Route::post('/save-patient', [PatientsController::class, 'store'])->name('save-patient');
        
        // Medical record 
        Route::prefix('/medical_record')->group(function () {
            Route::get('/{id}', [ExpedientController::class, 'Patient_details'])->name('admin.medical_record');
            Route::post('/Update_Personal_Data', [PatientsController::class, 'Update_Personal_Data'])->name('Update_Personal_Data');
            //AHF
            Route::post('/Update_Ahf', [AHFController::class, 'Update'])->name('Update_Ahf');
            Route::post('/Store_Ahf', [AHFController::class, 'Store'])->name('Store_Ahf');
            Route::post('/Delete_Ahf', [AHFController::class, 'Delete'])->name('Delete_Ahf');
            // APNP 
            Route::post('/Update_BloodType', [APNPController::class, 'Update_bloodType'])->name('Update_BloodType');
            Route::post('/Update_School', [APNPController::class, 'Update_School'])->name('Update_School');
            Route::post('/Update_School', [APNPController::class, 'Update_School'])->name('Update_School');
            Route::post('/Add_Adiction', [APNPController::class, 'Add_Adiction'])->name('Add_Adiction');
            
            // APP
            Route::post('/Add_Disease', [APPController::class, 'Add_Disease'])->name('Add_Disease');
            Route::post('/Update_Disease', [APPController::class, 'Update_Disease'])->name('Update_Disease');
            Route::post('/Delete_Disease', [APPController::class, 'Delete_Disease'])->name('Delete_Disease');
            Route::post('/Add_Allergy', [APPController::class, 'Store_Allergy'])->name('Add_Allergy');
            Route::post('/Update_Allergy', [APPController::class, 'Update_Allergy'])->name('Update_Allergy');
            Route::post('/Add_Hospital', [APPController::class, 'Add_Hospital'])->name('Add_Hospital');
            Route::post('/Update_Hospital', [APPController::class, 'Update_Hospital'])->name('Update_Hospital');
            Route::post('/Add_Transfusion', [APPController::class, 'Add_Transfusion'])->name('Add_Transfusion');
            Route::post('/Update_Transfusion', [APPController::class, 'Update_Transfusion'])->name('Update_Transfusion');
            Route::post('/Add_Surgery', [APPController::class, 'Add_Surgery'])->name('Add_Surgery');
            Route::post('/Update_Surgery', [APPController::class, 'Update_Surgery'])->name('Update_Surgery');
            Route::post('/Add_Trauma', [APPController::class, 'Add_Trauma'])->name('Add_Trauma');
            Route::post('/Update_Trauma', [APPController::class, 'Update_Trauma'])->name('Update_Trauma');
          
            Route::post('/Update_Gyo', [GYOController::class, 'Update_Gyo'])->name('Update_Gyo');


            // Route::post('/add_ahf_Data', [ExpedientController::class, 'add_Ahf_Data'])->name('add_Ahf_Data');
            // Route::post('/Update_APNP', [ExpedientController::class, 'Update_APNP'])->name('Update_APNP');
            Route::get('/APP/{id}', [ExpedientController::class, 'Details_APP'])->name('admin.medical_record/APP');
         
    
    
    });
        

        Route::prefix('/consultation/{id_persona}')->group(function () {
            Route::get('/new',[ConsultationController::class,'create'])->name('consultation.new');
            Route::post('/save',[ConsultationController::class,'store'])->name('consultation.save');

            Route::get('/history',[HistoryConsultationController::class,'show'])->name('consultation.history');
            Route::get('/history/{id_consulta}/details',[HistoryConsultationController::class,'details'])->name('consultation.history.details');
            Route::get('/history/get-consultation',[HistoryConsultationController::class,'getConsultationsPerson'])->name('consultation.history.obt-consultations');
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
    Route::get('/api/web-service/get-person/{code}/{type}', [WebServicePersonController::class, 'getPersonWebService'])->name('api.web-service.get-person');
    Route::get('/api/get-deseases/{id}', [SpecificDiseasesController::class, 'getSpecificDiseases'])->name('api.get-deseases');
    Route::get('/api/get-all-diseases', [SpecificDiseasesController::class, 'getSpecificDiseasesAll'])->name('api.get-all-deseases');

    Route::get('/form-api', [WebServicePersonController::class, 'index'])->name('api.form');
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
