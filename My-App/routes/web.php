<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DDSCHController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('auth/login');
});

Route::get('cursos', [CursoController::class, 'index']);

Route::get('cursos/create', [CursoController::class, 'create']);

Route::get('cursos/{curso}', [CursoController::class, 'show']);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('DDSCH/lulu', [DDSCHController::class, 'lulu']);
Route::get('DDSCH/actualizarFecha', [DDSCHController::class, 'actualizarFecha']);
Route::get('DDSCH/consultaEstado', [DDSCHController::class, 'consultaEstado']);
Route::get('DDSCH/filtroDescargar', [DDSCHController::class, 'filtroDescargar']);
Route::get('DDSCH/generarReporte', [DDSCHController::class, 'generarReporte']);
Route::get('DDSCH/guardarVista', [DDSCHController::class, 'guardarVista']);
Route::get('DDSCH/guardarVistaEventuales', [DDSCHController::class, 'guardarVistaEventuales']);
Route::get('DDSCH/qrtxt', [DDSCHController::class, 'qrtxt']);
Route::get('/menuPrincipal/{usuario}', [DDSCHController::class, 'menuPrincipal'])-> name('roles.menuPrincipal');

