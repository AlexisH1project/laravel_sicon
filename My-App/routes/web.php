<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DDSCHController;
use App\Http\Controllers\DSPOController;
use App\Http\Controllers\DIPSPController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\LoginController;
use App\User;
use App\Role;


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
Auth::routes();
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    $user = Auth::user();
    echo $user;
    return view('auth/login');
});

Route::get('/registrar', function(){
    return view('auth/register');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('DDSCH/autorizaDDSCH', [DDSCHController::class, 'autorizaDDSCH']);
Route::get('DDSCH/actualizarFecha', [DDSCHController::class, 'actualizarFecha']);
Route::get('General/consultaEstado', [GeneralController::class, 'consultaEstado']);
Route::get('General/filtroDescargar', [GeneralController::class, 'filtroDescargar']);
Route::get('General/generarReporte', [GeneralController::class, 'generarReporte']);
Route::get('General/guardarVista', [GeneralController::class, 'guardarVista']);
Route::get('DDSCH/guardarVistaEventuales', [DDSCHController::class, 'guardarVistaEventuales']);
Route::get('DDSCH/qrtxt', [DDSCHController::class, 'qrtxt']);
Route::get('/menuPrincipal/{usuario}', [DDSCHController::class, 'menuPrincipal'])-> name('roles.menuPrincipal');
Route::get('DDSCH/capDDSCH', [DDSCHController::class, 'capDDSCH']);
Route::get('DSPO/autorizaDSPO', [DSPOController::class, 'autorizaDSPO']);
Route::get('DSPO/capDSPO', [DSPOController::class, 'capDSPO']);
Route::get('DSPO/correosUR', [DSPOController::class, 'correosUR']);
Route::get('DSPO/generarReportePC', [DSPOController::class, 'generarReportePC']);
Route::get('DIPSP/autorizaDIPSP', [DIPSPController::class, 'autorizaDIPSP']);

// Pruebas para roles:

Route::get('/test', function(){
    // return Role:: create([
    //     'name' => 'Autorizador',
    //     'slug' => 'Autorizador',
    //     'description' => 'Autorizador',
    //     'full-access' => 'Yes'
    // ]);


    // $user = User::find(1);
    // $user->roles()->sync([1,2]);
    // return $user->roles;
    
    $user = Auth::user();
    return $user;
});

