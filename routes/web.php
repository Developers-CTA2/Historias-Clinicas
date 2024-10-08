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
use App\Http\Controllers\MedicalPrescriptionController;
use App\Http\Controllers\NutritionHistoryController;
use App\Http\Controllers\AHFController;
use App\Http\Controllers\APNPController;
use App\Http\Controllers\APPController;
use App\Http\Controllers\FileUserController;
use App\Http\Controllers\NutritionConsultationController;
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
        return redirect()->route('login');
    });
});


/*  Debe haber iniciado sesion  */
Route::middleware('auth')->group(function () {

    // Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::prefix('home')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/get-data-statistics', [HomeController::class, 'getDataStatistics'])->name('get-data-statistics');
        Route::get('/data-statistics-diseases/{month}/{year}', [HomeController::class, 'getDataStatisticsDiseases'])->name('data-statistics-diseases');
        Route::get('/data-statistics-sex/{month}/{year}', [HomeController::class, 'getDataStatisticsSex'])->name('data-statistics-sex');
        Route::get('/data-statistics-type-person/{month}/{year}', [HomeController::class, 'getDataStatisticsTypePerson'])->name('data-statistics-typeperson');
    });


    /*        USERS        */

    /*  Solo el admnistrador  */
    Route::middleware('UserType:Administrador')->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'breadCrumb'])->name('users.users');
            Route::get('/obt-usuarios', [UserController::class, 'showUser'])->name('users.obt-usuarios');
            Route::post('/desactive-user', [UserController::class, 'Desactive'])->name('users.desactive-user');
            Route::get('/add-user', [UserController::class, 'breadCrumbAdd'])->name('users.add-user');
            Route::get('/user-details/{id}', [UserController::class, 'userDetails'])->name('users.user-details');
            Route::post('/End-Point-Persons', [EndPointPersonsController::class, 'getUser'])->name('End-Point-Persons');
            Route::post('/edit-user', [UserController::class, 'Update'])->name('users.edit-user');
            Route::post('/new-user', [UserController::class, 'store'])->name('new-user');

            // Download PDF
            Route::get('/confidentiality-letter/{id_user}/download', [FileUserController::class, 'getUserFile'])->name('users.file');

            // Download PDF
            Route::get('/download-template', [FileUserController::class, 'downloadTemplate'])->name('users.download-template');
        });
    });

    /*  ADMINISTRACION  */
    Route::prefix('admin')->group(function () {
        // DISEASES
        Route::get('/diseases', [DiseasesController::class, 'Diseases_View'])->name('admin.diseases');
        Route::get('/obt-diseases', [DiseasesController::class, 'showdiseases'])->name('obt-diseases');
        Route::post('/edit-diseases', [DiseasesController::class, 'Update_disease'])->name('edit-diseases');
        Route::post('/add-diseases', [DiseasesController::class, 'Store_disease'])->name('add-diseases');

        // SPECIFIC
        Route::get('/specific-diseases', [SpecificDiseasesController::class, 'specific_View'])->name('admin.specific-diseases');
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



            /* Solo el admnistrador  AGREGAR Y EDITAR EXPEDEIENTE  */
            Route::middleware('UserType:Administrador')->group(function () {
                // PD
                Route::get('/APP/{id}', [ExpedientController::class, 'Details_APP'])->name('admin.medical_record/APP');
                Route::post('/Update_Personal_Data', [PatientsController::class, 'Update_Personal_Data'])->name('Update_Personal_Data');
                //AHF
                Route::post('/Update_Ahf', [AHFController::class, 'Update'])->name('Update_Ahf');
                Route::post('/Store_Ahf', [AHFController::class, 'Store'])->name('Store_Ahf');
                Route::post('/Delete_Ahf', [AHFController::class, 'Delete'])->name('Delete_Ahf');
                // APNP 
                Route::post('/Update_BloodType', [APNPController::class, 'Update_BloodType'])->name('Update_BloodType');
              // Route::post('/Update_School', [APNPController::class, 'Update_School'])->name('Update_School');
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
                //  GYO
                Route::post('/Update_Gyo', [GYOController::class, 'Update_Gyo'])->name('Update_Gyo');
            });
        });

        Route::prefix('/consultation/{id_persona}')->group(function () {
            Route::get('/new', [ConsultationController::class, 'create'])->name('consultation.new');
            Route::post('/save', [ConsultationController::class, 'store'])->name('consultation.save');

            Route::prefix('/history')->group(function () {
                Route::get('/', [HistoryConsultationController::class, 'show'])->name('consultation.history');
                Route::prefix('/{id_consulta}')->group(function () {
                    Route::get('/details', [HistoryConsultationController::class, 'details'])->name('consultation.history.details');
                    Route::get('/pdf', [MedicalPrescriptionController::class, 'generateMedicalPrescription'])->name('consultation.history.pdf');
                });

                Route::get('/get-consultation', [HistoryConsultationController::class, 'getConsultationsPerson'])->name('consultation.history.obt-consultations');
            });
        });

        Route::prefix('/nutrition/{id_persona}')->group(function () {
            Route::prefix('/complete/nutrition-history')->group(function () {
                Route::get('/', [NutritionHistoryController::class, 'create'])->name('nutrition.complete.nutrition-history');
                Route::post('/save', [PatientsController::class, 'nutritionStore'])->name('complete.nutrition.history.store');
            });
            Route::prefix('/consultation')->group(function () {
                Route::get('/new', [NutritionConsultationController::class, 'create'])->name('nutrition.consultation.create');
                Route::post('/save', [NutritionConsultationController::class, 'store'])->name('nutrition.consultation.store');
            });

            Route::prefix('/history')->group(function () {
                Route::get('/', [NutritionHistoryController::class, 'show'])->name('nutrition.consultation.history');
                Route::prefix('/{id_consulta}')->group(function () {
                    Route::get('/details', [NutritionHistoryController::class, 'details'])->name('nutrition.consultation.history.details');
                });

                Route::get('/get-consultation', [NutritionHistoryController::class, 'getConsultationsPerson'])->name('nutrition.consultation.history.obt-consultations');
            });
        });
    });

    /* APIS */
    Route::get('/api/web-service/get-person/{code}/{type}/{person}', [WebServicePersonController::class, 'getPersonWebService'])->name('api.web-service.get-person');
    Route::get('/api/get-deseases/{id}', [SpecificDiseasesController::class, 'getSpecificDiseases'])->name('api.get-deseases');
    Route::get('/api/get-all-diseases', [SpecificDiseasesController::class, 'getSpecificDiseasesAll'])->name('api.get-all-deseases');

    Route::get('/form-api', [WebServicePersonController::class, 'index'])->name('api.form');



    // AGENDAR CITAS
    Route::prefix('/calendar')->group(function () {
        Route::get('/', [CitasController::class, 'agenda'])->name('showCalendar');

        Route::prefix('/medical_appointment')->group(function () {
            Route::get('/{fecha}', [CitasController::class, 'mostrarCitas'])->name('citas.index');
            Route::get('/get-citas/{fecha}', [CitasController::class, 'getCitas'])->name('citas.get');
            Route::get('/get-citas/get-cita/{id}', [CitasController::class, 'getCitasPersona'])->name('citas.get-person');
            // Edit cita
            Route::post('/{id}/update', [CitasController::class, 'update'])->name('editCita');
            Route::delete('/{id}/delete', [CitasController::class, 'delete'])->name('deleteCita');
            Route::post('/save_appointment', [CitasController::class, 'guardarCita'])->name('guardarCita');
       
        });

        Route::get('/next_appointment', [CitasController::class, 'proximaCita']);
    });

});


Route::get('/test', [CitasController::class, 'users'])->name('testCitas');
