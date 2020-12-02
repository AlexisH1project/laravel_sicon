<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
  

  
    public function consultaEstado(){

        //$Fomope = DB::table('fomope')->get();
        return view('General.consultaEstado');
    }
    public function filtroDescargar(){

        //$Fomope = DB::table('fomope')->get();
        return view('General.filtroDescargar');
    }
    public function generarReporte(){

        //$Fomope = DB::table('fomope')->get();
        return view('General.generarReporte');
    }
    public function guardarVista(){

        //$Fomope = DB::table('fomope')->get();
        return view('General.guardarVista');
    }



}
