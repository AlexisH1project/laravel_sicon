<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
  
    public function index()
    {
        return view('General.guardarVista');

    }
  
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
    public function resultados_rfc(Request $request){
        $term = $request->get('term');
        $resultado = DB::table('ct_empleados')->select('*')->where('rfc', 'LIKE', '%'.$term.'%')->get();
        $contador = 0;
        $data = [];
        foreach ($resultado as $registro) {
            $data[$contador] = $registro->rfc;
            $contador++;
        }
        return $data;
    }

    public function resultadosC_rfc(Request $request){

        $term = $request->get('term2');
        $empleado = DB::table('ct_empleados')
        ->where('rfc',$term)
        ->get();
        // foreach ($empleado as $e1) {
        //     $value[0]= array( 
        //         "apellido1"=> $e1->apellido_1,
        //         "apellido2"=> $e1->apellido_2,
        //         "nombre"=> $e1->nombre,
        //         "curp"=> $e1->curp
        //     );
        // }
        //var_dump($value);

        $value[0]= array( 
            "apellido1"=> "SS",
            "apellido2"=> "SDSDS",
            "nombre"=> "SASA",
            "curp"=> "ASS"
        );

        // $resFomope = DB::table('fomope')
        // ->where('rfc',$empleado->rfc)
        // ->get();
       
        // $value[1]= 0;

       
        // $value[1]= 0;
        // $i = 1;
        // foreach ($resFomope as $row) {

        //     $value[$i] = array( 
        //         "id"-> $row->id_movimiento,
        //         "codigo"-> $row->codigoMovimiento,
        //         "fecha"-> $row->vigenciaDel,
        //         "anio"-> $row->anio,
        //         "qna"-> $row->qnaDeAfectacion
        //     );
        //     $i++;
        // }
        //return $value;
        echo json_encode($value);
    }

  
}
