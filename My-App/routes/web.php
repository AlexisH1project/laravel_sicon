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
Route::post('DDSCH/Consulta', [DDSCHController::class, 'getFomopeTable'])-> name('DDSCH.getFomopeTable');
Route::get('DDSCH/autorizacionDDSCH/{fomope}', [DDSCHController::class, 'autorizacionFomope'])-> name('autorizacionFomope');
Route::get('DDSCH/blancoDDSCH', [DDSCHController::class, 'blancoDDSCH'])-> name('blancoDDSCH');
Route::post('DDSCH/blancoDDSCH', [DDSCHController::class, 'EnviarFomope'])-> name('EnviarFomope');
Route::post('DDSCH/agregarNewFomope', [DDSCHController::class, 'agregarNewFomope'])-> name('agregarNewFomope');
Route::post('DDSCH/rechazarFomope', [DDSCHController::class, 'rechazarFomope'])-> name('rechazarFomope');
Route::get('DDSCH/verVerde/{id_fomope}', [DDSCHController::class, 'verVerde'])-> name('DDSCH.verdeDDSCH');
Route::get('DDSCH/verAmarillo0/{id_fomope}', [DDSCHController::class, 'verAmarillo0'])-> name('DDSCH.verAmarillo0');
Route::get('DDSCH/verVerde2/{id_fomope}', [DDSCHController::class, 'verVerde2'])-> name('DDSCH.verVerde2');
Route::get('DDSCH/negroEditar/{id_fomope}', [DDSCHController::class, 'negroEditar'])-> name('DDSCH.negroEditar');
Route::get('DDSCH/grisEditar/{id_fomope}', [DDSCHController::class, 'grisEditar'])-> name('DDSCH.grisEditar');
Route::post('DDSCH/autorizarAmarillo0', [DDSCHController::class, 'autorizarAmarillo0'])-> name('DDSCH.autorizarAmarillo0');
Route::post('DDSCH/rechazoAmarillo0', [DDSCHController::class, 'rechazoAmarillo0'])-> name('DDSCH.rechazoAmarillo0');
Route::post('DDSCH/updateNegro', [DDSCHController::class, 'updateNegro'])-> name('DDSCH.updateNegro');
Route::post('DDSCH/eliminarFomope', [DDSCHController::class, 'eliminarFomope'])-> name('DDSCH.eliminarFomope');
Route::post('DDSCH/updateVerde', [DDSCHController::class, 'updateVerde'])-> name('DDSCH.updateVerde');
Route::post('DDSCH/rechazoVerde2', [DDSCHController::class, 'rechazoVerde2'])-> name('DDSCH.rechazoVerde2');
Route::post('DDSCH/autorizarVerde2', [DDSCHController::class, 'autorizarVerde2'])-> name('DDSCH.autorizarVerde2');

Route::get('General/consultaEstado', [GeneralController::class, 'consultaEstado'])-> name('General.consultaEstado');
Route::post('General/reporteBusqueda', [GeneralController::class, 'reporteBusqueda'])-> name('General.reporteBusqueda');
Route::get('General/filtroDescargar', [GeneralController::class, 'filtroDescargar'])-> name('General.filtroDescargar');
Route::post('General/verList', [GeneralController::class, 'verList'])-> name('General.verList');
Route::post('General/downloadPDF', [GeneralController::class, 'downloadPDF'])-> name('General.downloadPDF');

// **************************** busqueda automatizada (Autocompletar datos)
Route::get('General/generarReporte', [GeneralController::class, 'generarReporte'])-> name('General.generarReporte');
Route::get('General/guardarVista', 'GeneralController@indexGuardarVista')-> name('General.guardarVista');
Route::get('Serch/rfc', 'GeneralController@resultados_rfc')->name('Serch.rfc');
Route::get('Serch/Crfc', 'GeneralController@resultadosC_rfc')->name('Serch.Crfc');
Route::get('Serch/unidad', 'GeneralController@resultados_unidad')->name('Serch.unidad');
//****************************** Guardar documento en el sistema */
Route::get('guardar/doc', 'GeneralController@guardarDocView')->name('guardar.doc.view');
Route::post('guardar/doc', 'GeneralController@guardarDoc')->name('guardar.doc');


Route::get('DSPO/autorizaDSPO', [DSPOController::class, 'autorizaDSPO'])-> name('DSPO.autorizaDSPO');
Route::post('DSPO/Consulta', [DSPOController::class, 'getFomopeTableDSPO'])-> name('DSPO.getFomopeTable');
Route::get('DSPO/autorizacionFomope/{fomope}', [DSPOController::class, 'autorizacionFomope'])-> name('DSPO.autorizacionFomope');
Route::get('DSPO/capDSPO', [DSPOController::class, 'capDSPO'])-> name('DSPO.capDSPO');
Route::get('DSPO/correosUR', [DSPOController::class, 'correosUR'])-> name('DSPO.correosUR');
Route::get('DSPO/generarReportePC', [DSPOController::class, 'generarReportePC'])-> name('DSPO.generarReportePC');
Route::get('DSPO/form_FOMOPE/{id_fomope}', [DSPOController::class, 'form_FOMOPE'])-> name('DSPO.form_FOMOPE');
Route::get('DSPO/form_FOMOPEAnalista/{id_fomope}', [DSPOController::class, 'form_FOMOPEAnalista'])-> name('DSPO.form_FOMOPEAnalista');
Route::get('DSPO/autorizarNomina/{id_fomope}', [DSPOController::class, 'autorizarNomina'])-> name('DSPO.autorizarNomina');
Route::get('DSPO/editarAnalista/{id_fomope}', [DSPOController::class, 'editarAnalista'])-> name('DSPO.editarAnalista');
Route::post('DSPO/agregar_FOMOPE', [DSPOController::class, 'agregar_FOMOPE'])-> name('DSPO.agregar_FOMOPE');
Route::post('DSPO/aceptarFomope', [DSPOController::class, 'aceptarFomope'])-> name('DSPO.aceptarFomope');
Route::post('DSPO/observacion', [DSPOController::class, 'observacion'])-> name('DSPO.observacion');
Route::post('DSPO/eliminarFomope', [DSPOController::class, 'eliminarFomope'])-> name('DSPO.eliminarFomope');

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

