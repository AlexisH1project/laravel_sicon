<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DDSCHController;
use App\Http\Controllers\DSPOController;
use App\Http\Controllers\DIPSPController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
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

Route::get('DDSCH/autorizaDDSCH', [DDSCHController::class, 'autorizaDDSCH'])-> name('DDSCH.autorizaDDSCH');
Route::get('DDSCH/actualizarFecha', [DDSCHController::class, 'actualizarFecha'])-> name('DDSCH.actualizarFecha');
Route::get('DDSCH/qrtxt', [DDSCHController::class, 'qrtxt'])-> name('DDSCH.qrtxt');
Route::get('DDSCH/capDDSCH', [DDSCHController::class, 'capDDSCH'])-> name('DDSCH.capDDSCH');
Route::get('DDSCH/guardarVistaEventuales', [DDSCHController::class, 'guardarVistaEventuales'])-> name('DDSCH.guardarVistaEventuales');
Route::post('Consulta', [DDSCHController::class, 'getFomopeTable'])-> name('getFomopeTable');
Route::post('DDSCH/autorizacionDDSCH', [DDSCHController::class, 'autorizacionFomope'])-> name('autorizacionFomope');
Route::get('DDSCH/blancoDDSCH', [DDSCHController::class, 'blancoDDSCH'])-> name('blancoDDSCH');
Route::post('DDSCH/blancoDDSCH', [DDSCHController::class, 'EnviarFomope'])-> name('EnviarFomope');
Route::post('DDSCH/agregarNewFomope', [DDSCHController::class, 'agregarNewFomope'])-> name('agregarNewFomope');
Route::post('DDSCH/rechazarFomope', [DDSCHController::class, 'rechazarFomope'])-> name('rechazarFomope');

Route::get('General/consultaEstado', [GeneralController::class, 'consultaEstado'])-> name('General.consultaEstado');
Route::post('General/reporteBusqueda', [GeneralController::class, 'reporteBusqueda'])-> name('General.reporteBusqueda');
Route::get('General/filtroDescargar', [GeneralController::class, 'filtroDescargar'])-> name('General.filtroDescargar');
Route::get('General/verList', [GeneralController::class, 'verList'])-> name('General.verList');
// **************************** busqueda automatizada
Route::get('General/generarReporte', [GeneralController::class, 'generarReporte'])-> name('General.generarReporte');
Route::get('General/guardarVista', 'GeneralController@indexGuardarVista')-> name('General.guardarVista');
Route::get('Serch/rfc', 'GeneralController@resultados_rfc')->name('Serch.rfc');
Route::get('Serch/Crfc', 'GeneralController@resultadosC_rfc')->name('Serch.Crfc');
//****************************** Guardar documento en el sistema */
Route::get('guardar/doc', 'GeneralController@guardarDocView')->name('guardar.doc.view');
Route::post('guardar/doc', 'GeneralController@guardarDoc')->name('guardar.doc');



Route::get('DSPO/autorizaDSPO', [DSPOController::class, 'autorizaDSPO'])-> name('DSPO.autorizaDSPO');
Route::get('DSPO/capDSPO', [DSPOController::class, 'capDSPO'])-> name('DSPO.capDSPO');
Route::get('DSPO/correosUR', [DSPOController::class, 'correosUR'])-> name('DSPO.correosUR');
Route::get('DSPO/generarReportePC', [DSPOController::class, 'generarReportePC'])-> name('DSPO.generarReportePC');

Route::get('DIPSP/autorizaDIPSP', [DIPSPController::class, 'autorizaDIPSP'])-> name('DIPSP.autorizaDIPSP');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');
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

