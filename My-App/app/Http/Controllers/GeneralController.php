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

        $term2 = $request->get('term2');
        $empleado = DB::table('ct_empleados')
        ->where('rfc',$term2)
        ->get();
        // $empleado = DB::select('select * from ct_empleados where rfc = :rfc', ['rfc' => $term]);
   
        foreach ($empleado as $row) {
            $value[0] = array( 
                'apellido1'=> $row->apellido_1,
                'apellido2'=> $row->apellido_2,
                'nombre'=> $row->nombre,
                'curp'=> $row->curp
            );
        }

        $registrosEmpleado = DB::table('fomope')
        ->where('rfc',$term2)
        ->get();

        $value[1]= 0;
        $i = 1;
        foreach ($registrosEmpleado as $rowReg) {
            $value[$i] = array( 
                "id"=> $rowReg->id_movimiento,
                "codigo"=> $rowReg->codigoMovimiento,
                "fecha"=> $rowReg->vigenciaDel,
                "anio"=> $rowReg->anio,
                "qna"=>  $rowReg->qnaDeAfectacion
            );
            $i++;
        }
        // return response()->json($value);
        echo json_encode($value);
        exit;

    }

  
}
