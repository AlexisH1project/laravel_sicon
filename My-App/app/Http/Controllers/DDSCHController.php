<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DDSCHController extends Controller
{
    public function autorizaDDSCH(){

        //$Fomope = DB::table('fomope')->get();
        return view('DDSCH.autorizaDDSCH');
    }

    public function capDDSCH(){

        //$Fomope = DB::table('fomope')->get();
        return view('DDSCH.capDDSCH');
    }

    public function actualizarFecha(){

        //$Fomope = DB::table('fomope')->get();
        return view('DDSCH.actualizarFecha');
    }
    public function guardarVistaEventuales(){

        //$Fomope = DB::table('fomope')->get();
        return view('DDSCH.guardarVistaEventuales');
    }
    public function qrtxt(){

        //$Fomope = DB::table('fomope')->get();
        return view('DDSCH.qrtxt');
    }

}
