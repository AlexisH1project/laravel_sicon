<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('hola', function () {
    return 'Holaaa bb';
});

Route::get('administra/{nEmpresa}/{especialidad}', function($nEmpresa,$laEspecialidad){
    return 'Esta empresa se dara de alta: '.$nEmpresa. ' Su especialidad es: '.$laEspecialidad;
});