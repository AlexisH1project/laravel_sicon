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

    public function resultados_curp(Request $request){
        $term = $request->get('term');
        $resultado = DB::table('ct_empleados')->select('*')->where('curp', 'LIKE', '%'.$term.'%')->get();
        $data = [];
        foreach ($resultado as $registro) {
            # code...
            $data[] = [
                'curp' => $registro->curp
            ];
        }
        return $data;
    }

  
}
