<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DDSCHController extends Controller
{
    public function lulu(){

        $Fomope = DB::table('fomope')->get();
        return view('DDSCH.lulu', compact('Fomope'));
    }

    public function actualizarFecha(){

        $Fomope = DB::table('fomope')->get();
        return view('DDSCH.actualizarFecha', compact('Fomope'));
    }
    public function consultaEstado(){

        $Fomope = DB::table('fomope')->get();
        return view('DDSCH.consultaEstado', compact('Fomope'));
    }
    public function filtroDescargar(){

        $Fomope = DB::table('fomope')->get();
        return view('DDSCH.filtroDescargar', compact('Fomope'));
    }
    public function generarReporte(){

        $Fomope = DB::table('fomope')->get();
        return view('DDSCH.generarReporte', compact('Fomope'));
    }
    public function guardarVista(){

        $Fomope = DB::table('fomope')->get();
        return view('DDSCH.guardarVista', compact('Fomope'));
    }
    public function guardarVistaEventuales(){

        $Fomope = DB::table('fomope')->get();
        return view('DDSCH.guardarVistaEventuales', compact('Fomope'));
    }
    public function qrtxt(){

        $Fomope = DB::table('fomope')->get();
        return view('DDSCH.qrtxt', compact('Fomope'));
    }

    public function menuPrincipal($usuario){

        $Usuario=DB::table('usuarios')->where('usuario',$usuario)->first();
        return view('menuPrincipal', compact('Usuario'));

    }



}
