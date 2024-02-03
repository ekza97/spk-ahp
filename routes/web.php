<?php

use App\Helpers\Helper;
use App\Models\Kriteria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackApp\ExamController;
use App\Http\Controllers\BackApp\RoleController;
use App\Http\Controllers\BackApp\SoalController;
use App\Http\Controllers\BackApp\UserController;
use App\Http\Controllers\BackApp\KelasController;
use App\Http\Controllers\BackApp\MapelController;
use App\Http\Controllers\BackApp\StudentController;
use App\Http\Controllers\BackApp\TeacherController;
use App\Http\Controllers\BackApp\KriteriaController;
use App\Http\Controllers\BackApp\AlternatifController;
use App\Http\Controllers\BackApp\PermissionController;
use App\Http\Controllers\BackApp\BobotKriteriaController;
use App\Http\Controllers\BackApp\StudentHasExamController;
use App\Http\Controllers\BackApp\BobotAlternatifController;
use App\Http\Controllers\BackApp\RankingController;

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
    return to_route('login');
});

Auth::routes([
    'verify'=>false
]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('kriteria', KriteriaController::class)->except(['create','show']);
    Route::resource('alternatif', AlternatifController::class)->except(['create','show']);
    Route::resource('bobot-kriteria', BobotKriteriaController::class)->except(['create','show']);
    Route::controller(BobotAlternatifController::class)->group(function () {
        Route::get('/bobot-alternatif/{id}', 'index')->name('bobot-alternatif.index');
        Route::post('/bobot-alternatif', 'store')->name('bobot-alternatif.store');
    });
    Route::controller(RankingController::class)->group(function () {
        Route::get('/ranking', 'index')->name('ranking.index');
    });

    //setting menu
    Route::resource('users', UserController::class)->except(['create','show']);
    Route::resource('roles', RoleController::class)->except(['create','show']);
    Route::resource('permissions', PermissionController::class)->only(['index','store','destroy']);
});