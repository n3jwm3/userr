<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashbaordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DisponibiliteController;
use App\Http\Controllers\SpecialiteController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\LocalController;


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
    return view('interface1/interface01');
})->name('interface1');
Route::get('/login', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'Authlogin']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('forgot-password', [AuthController::class, 'forgotpassword']);
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword']);
Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'PostReset']);


Route::get('/planning/excel', [DashbaordController::class, 'exportExcel'])->name('exportExcel');
Route::get('/planning/pdf', [DashbaordController::class, 'exportPdf'])->name('exportPdf');

Route::group(['middleware' => 'admin'],function(){

    Route::get('admin/dashbaord', [DashbaordController::class, 'dashbaord']);

    Route::get('/planning/pdf', [DashbaordController::class, 'exportPdf'])->name('exportPdf');




    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::delete('admin/admin/delete/{id}', [AdminController::class, 'delete'])->name('destt');


    //class url
    Route::get('admin/class/list', [ClasseController::class, 'list']);
    Route::get('admin/class/add', [ClasseController::class, 'add']);
    Route::post('admin/class/add', [ClasseController::class, 'insert']);




    //teacher url
    Route::get('admin/teacher/list', [TeacherController::class, 'list'])->name('listte');
    Route::get('admin/teacher/add', [TeacherController::class, 'add']);
    Route::post('admin/teacher/add', [TeacherController::class, 'insert'])->name('inser');
    Route::get('admin/teacher/{id}/edit', [TeacherController::class, 'edit'])->name('edi');
    Route::post('admin/teachre/update', [TeacherController::class, 'update'])->name('updat');
    Route::put('admin/teachre/update/{id}', [TeacherController::class, 'update'])->name('updat');
    Route::delete('admin/teacher/delete/{id}', [TeacherController::class, 'delete'])->name('dest');
    Route::get('admin/teacher/{id}', [TeacherController::class, 'show'])->name('sho')->middleware('auth');
    //route importer enseignants
 Route::get('import-excel', [TeacherController::class, 'import_excel']);
 Route::post('import-excel', [TeacherController::class, 'import_excel_post']);


    //specialite url
    // la route pour retourner liste des specialite
    Route::get('admin/specialites/list', [SpecialiteController::class, 'listespecialite'])->name('specialites.specialite');
    Route::post('/ajouter/traitement', [SpecialiteController::class, 'ajouter_specialite']);
    Route::delete('/delete_formation/{id}', [SpecialiteController::class, 'supprimer_specialite'])->name('strformation');
    Route::get('/update_formation/{id}', [SpecialiteController::class, 'update_specialite']);
    Route::post('/update/traitement', [SpecialiteController::class, 'update_specialite_traitement'])->name('update.traitement');



//// route pour afficher les module :
Route::get('/Modules/module','App\Http\Controllers\ModuleController@listemodule') ->name('Modules.module');
// la route pour ajouter des module :
Route::post('/add/traitement','App\Http\Controllers\ModuleController@ajouter_module');
// pour la supression d'un module :
Route::delete('/delete_module/{id}','App\Http\Controllers\ModuleController@supprimer_mod')->name('strmodule');
// la route pour afficher la vue de update :
Route::get('/update_module/{id}','App\Http\Controllers\ModuleController@update_mod');
// effectuer la modification des modules :
Route::post('/updatemodule/traitement','App\Http\Controllers\ModuleController@modifier_module');
// la route pour inserer un module :
Route::post('/add/traitement','App\Http\Controllers\ModuleController@ajouter_module');

// pour la supression d'un module :
Route::get('/delete_module/{id}','App\Http\Controllers\ModuleController@supprimer_mod');

// la route pour la recherche d'un module
Route::get('/search','App\Http\Controllers\ModuleController@search');


//url locaux
Route::resource('local',LocalController::class);

 //route importer salles
 Route::get('import_excel_local', [LocalController::class, 'import_excel_local']);
 Route::post('import_excel_local', [LocalController::class, 'import_excel_local_post']);


 //lien de bachir de algo
 Route::get('/GestionPlanning', [\App\Http\Controllers\GestionplanningController::class, 'index'])->name('GestionPlanning');
Route::get('/GestionHoraire', [\App\Http\Controllers\GestionHorraireController::class, 'index'])->name('GestionHoraire');
// la route pour afficher le planning pour examen :
Route::get('planning','App\Http\Controllers\PlanningController@afficherplanning')->name('planning');


// la route pour la génération
 Route::post('/generation/traitement','App\Http\Controllers\GestionplanningController@gererexamen');

// traitement pour plusieurs affectation :
Route::post('/traitement/cre','App\Http\Controllers\CrenauController@affecter');


// la route pour la génération :
Route::post('/generer/traitement','App\Http\Controllers\GestionHorraireController@genererPlanning')->name('genererPlanning');
});








Route::group(['middleware' => 'teacher'],function(){

    Route::get('teacher/dashbaord', [DashbaordController::class, 'dashbaord']);


    //Disponibilite url
    Route::get('teacher/disponibilite/list', [DisponibiliteController::class, 'list'])->name('lo');
    Route::get('teacher/disponibilite/add', [DisponibiliteController::class, 'add']);
    Route::post('teacher/disponibilite/add', [DisponibiliteController::class, 'insert'])->name('str');
    Route::delete('/delete_disponibilite/{id}', [DisponibiliteController::class, 'destroy'])->name('strdis');

});

