<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LuluController extends Controller
{
    public function lulu(){

        $Fomope = DB::table('fomope')->get();
        return view('roles.lulu', compact('Fomope'));
    }

    public function menuPrincipal($usuario){

       // $Usuario=DB::table('usuarios')->where('usuario',$usuario)->first();
        return view('roles.menuPrincipal', compact('u'));

    }

}
