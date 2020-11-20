<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fomope
class FomopeController extends Controller
{
    public function create(Request $request){
        $Fomope = new Fomope();

        $Fomope -> color_estado = $request -> color_estado;
    }
}
