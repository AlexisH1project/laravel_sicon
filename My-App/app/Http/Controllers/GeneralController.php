<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class GeneralController extends Controller
{
  
    public function indexGuardarVista()
    {   
        $listDoc = DB::table('m1ct_documentos')->select('*')->get();
        return view('General.guardarVista')->with('listDoc',$listDoc);
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

    public function verList(){
        $Documentos = DB::table('m1ct_documentos')->get();
        return view('General.verList', compact('Documentos'));
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
        exit;
    }

    public function resultadosC_rfc(Request $request){

        $term2 = $request->get('term2');
        $empleado = DB::table('ct_empleados')
        ->where('rfc','=',$term2)
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

    public function guardarDoc(Request $request){
        $file = $request->file('nameArchivo');
        //indicamos que queremos guardar un nuevo archivo en el disco local
        // Storage::disk('public')->put('DOCUMENTOS_MOV', File::get($file));
        // Storage::disk('public')->put($nombre, $file);
        $mytime = Carbon::now();
        $mytime->setTimezone('GMT-6');
        // echo $request->get('rfc');
        $hora = str_replace ( ":", '',$mytime->toTimeString()); 
        $fecha = str_replace ( "-", '',$mytime->toDateString()); 
        $ingresosID = $request->get('movFecha');
        if($ingresosID == "x"){
            return redirect()->back() ->with('alert', 'No es posible guardar documentos con este usuario, no tiene un registro previo');
        }else{
            //obtenemos el nombre del archivo
            $fileName = $request->nameArchivo->getClientOriginalName();  
            $extencion = explode(".",$fileName);
            $concatenarNombreC = strtoupper($request->get('rfc')."_". $request->get('documentoSelect')."_". $request->get('apellido1')."_". $request->get('apellido2')."_". $request->get('nombre')."_".$fecha.$hora."_". $request->get('movFecha')."_.".$extencion[1]); // strtoupper: lo pasa a mayuscula todo 
			// rename ($fichero_subido,$concatenarNombreC); 
            $path = $file->storeAs('DOCUMENTOS_MOV', $fileName); // Guarda documento en la carpetta correspondiente ./public/storage/app/DOCUEMTOS_MOV
            Storage::move($path, 'DOCUMENTOS_MOV/'.$request->get('documentoSelect').'/'.$concatenarNombreC);
            // Storage::disk('public')->put($fileName, $fileName);  **Ocupa la lib: use Illuminate\Support\Facades\Storage; *** los guarda en ./public/storage/app/public
            $listDoc = DB::table('m1ct_documentos')->select('*')->get();
            $Docs = $request->get('Docs');
            $docSeleccionado = $request->get('documentoSelect');
            $Documents = $docSeleccionado.$Docs;
            $rfc = $request->get('rfc');
            $apellido2 = $request->get('apellido2'); 
            $apellido1 = $request->get('apellido1');
            $nombre = $request->get('nombre');
            $movimiento = $request->get('movFecha');

            $consultaFomope = DB::table('fomope')->get();
            foreach($consultaFomope as $rowFomope){
                $movimientoAll = "( Codigo: ".$rowFomope->codigoMovimiento." ) ( Fecha: ".$rowFomope->	fechaIngreso." ) (Qna: ".$rowFomope->qnaDeAfectacion.") (Año: ".$rowFomope->anio." )";
            }
            
            return view('General.guardarVista', compact('listDoc', 'Documents', 'listDoc','rfc', 'apellido2', 'apellido1', 'nombre', 'movimiento','movimientoAll'));
            //return redirect()->back() ->with('elRfc',$request->get('rfc')) ->with('elNombre', $request->get('nombre'));

            // return view('General.guardarVista')->with('listDoc',$listDoc)
            //                                     ->with('formulario',$request);
                // ->with('success','You have successfully upload file.')
                // ->with('rfc',$request->get('rfc'));
        }
    }
  
}
