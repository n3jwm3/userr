<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashbaordController;
use App\Http\Controllers\AdminController;

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


Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'Authlogin']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('forgot-password', [AuthController::class, 'forgotpassword']);
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword']);
Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'PostReset']);


Route::group(['middleware' => 'admin'],function(){

    Route::get('admin/dashbaord', [DashbaordController::class, 'dashbaord']);
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
});
Route::group(['middleware' => 'teacher'],function(){

    Route::get('teacher/dashbaord', [DashbaordController::class, 'dashbaord']);
});
Route::group(['middleware' => 'student'],function(){

    Route::get('student/dashbaord', [DashbaordController::class, 'dashbaord']);
});
Route::group(['middleware' => 'parent'],function(){

    Route::get('parent/dashbaord', [DashbaordController::class, 'dashbaord']);
});
