<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DIPSPController extends Controller
{

    public function autorizaDIPSP(){

        //$Fomope = DB::table('fomope')->get();
        return view('DIPSP.autorizaDIPSP');
    }

}
