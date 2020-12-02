<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DSPOController extends Controller
{

    public function autorizaDSPO(){

        //$Fomope = DB::table('fomope')->get();
        return view('DSPO.autorizaDSPO');
    }

    public function capDSPO(){

        //$Fomope = DB::table('fomope')->get();
        return view('DSPO.capDSPO');
    }

    public function correosUR(){
        return view('DSPO.correosUR');
    }

    public function generarReportePC(){
        return view('DSPO.generarReportePC');
    }

}
