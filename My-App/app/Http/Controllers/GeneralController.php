<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

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

    public function verList(Request $request){
        $id_movimiento = $request->get('fomopeVer');
        $Fomope = DB::table('fomope')->select('*')->where('id_movimiento',$id_movimiento)->first();
        $Documentos = DB::table('m1ct_documentos')->get();
        return view('General.verList', compact('Documentos','Fomope'));
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

    public function resultados_unidad(Request $request){
        $term = $request->get('term');
        $resultado = DB::table('ct_unidades')->select('*')->where('descripcion', 'LIKE', '%'.$term.'%')->get();
        $contador = 0;
        $data = [];
        foreach ($resultado as $registro) {
            $data[$contador] = $registro->descripcion;
            $contador++;
        }
        return $data;
        exit;
    }


    public function reporteBusqueda(Request $request){
        $fomy = $request->get('fomope');
        $fomopes = DB::table('fomope')->select('*')->whereIn('id_movimiento', $fomy)->get();

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("excel/reporteFiltro.xls");
        $sheet = $spreadsheet->getActiveSheet();
        $sheet = $spreadsheet->getSheetByName('Estructura');
        $fila=8;
        foreach($fomopes as $fomope){
            
                        $sheet->setCellValue('A'.$fila, $fomope->id_movimiento); 
		                $sheet->setCellValue('B'.$fila, getEstadoFomope($fomope->color_estado)); 
		                $sheet->setCellValue('C'.$fila, $fomope->usuario_name); 
		                $sheet->setCellValue('D'.$fila, $fomope->unidad); 
		                $sheet->setCellValue('E'.$fila, $fomope->rfc); 
		                $sheet->setCellValue('F'.$fila, $fomope->curp);
		                $sheet->setCellValue('G'.$fila, $fomope->apellido_1);
		                $sheet->setCellValue('H'.$fila, $fomope->apellido_2);
		                $sheet->setCellValue('I'.$fila, $fomope->nombre);
		                $sheet->setCellValue('J'.$fila, $fomope->fechaIngreso);
		                $sheet->setCellValue('K'.$fila, $fomope->oficioEntrega);
		                $sheet->setCellValue('L'.$fila, $fomope->tipoEntrega);
		                $sheet->setCellValue('M'.$fila, $fomope->tipoDeAccion);
		                $sheet->setCellValue('N'.$fila, $fomope->justificacionRechazo);
		                $sheet->setCellValue('O'.$fila, $fomope->quincenaAplicada);
		                $sheet->setCellValue('P'.$fila, $fomope->anio);
		                $sheet->setCellValue('Q'.$fila, $fomope->oficioUnidad);
		                $sheet->setCellValue('R'.$fila, $fomope->fechaOficio);
		                $sheet->setCellValue('S'.$fila, $fomope->fechaRecibido);
		                $sheet->setCellValue('T'.$fila, $fomope->codigo);
		                $sheet->setCellValue('U'.$fila, $fomope->n_puesto);
		                $sheet->setCellValue('V'.$fila, $fomope->clavePresupuestaria);
		                $sheet->setCellValue('W'.$fila, $fomope->codigoMovimiento);
		                $sheet->setCellValue('X'.$fila, $fomope->descripcionMovimiento);
		                $sheet->setCellValue('Y'.$fila, $fomope->vigenciaDel);
		                $sheet->setCellValue('Z'.$fila, $fomope->vigenciaAl);
						$sheet->setCellValue('AA'.$fila, $fomope->entidad); 
						$sheet->setCellValue('AB'.$fila, $fomope->consecutivoMaestroPuestos); 
						$sheet->setCellValue('AC'.$fila, $fomope->puestos); 
						$sheet->setCellValue('AD'.$fila, $fomope->observaciones); 
						$sheet->setCellValue('AE'.$fila, $fomope->fechaEnviadaRubricaDspo); 
						$sheet->setCellValue('AF'.$fila, $fomope->fechaEnviadaRubricaDipsp); 
						$sheet->setCellValue('AG'.$fila, $fomope->fechaEnviadaRubricaDgrho); 
						$sheet->setCellValue('AH'.$fila, $fomope->fechaRecepcionSpc); 
						$sheet->setCellValue('AI'.$fila, $fomope->fechaEnvioSpc); 
						$sheet->setCellValue('AJ'.$fila, $fomope->fechaReciboDspo); 
						$sheet->setCellValue('AK'.$fila, $fomope->folioSpc); 
						$sheet->setCellValue('AL'.$fila, $fomope->fechaCapturaNomina); 
						$sheet->setCellValue('AM'.$fila, $fomope->fechaEntregaArchivo); 
						$sheet->setCellValue('AN'.$fila, $fomope->fechaEntregaRLaborales); 
						$sheet->setCellValue('AO'.$fila, $fomope->OfEntregaRLaborales); 
						$sheet->setCellValue('AP'.$fila, $fomope->fomopeDigital); 
						$sheet->setCellValue('AQ'.$fila, $fomope->fechaEntregaUnidad); 
						$sheet->setCellValue('AR'.$fila, $fomope->OfEntregaUnidad); 
						$sheet->setCellValue('AS'.$fila, $fomope->fechaAutorizacion); 
						$sheet->setCellValue('AT'.$fila, $fomope->analistaCap); 
						$sheet->setCellValue('AU'.$fila, $fomope->fechaCaptura); 
					/*	$sheet->setCellValue('AV'.$fila, $fomope->doc1); 
						$sheet->setCellValue('AW'.$fila, $fomope->doc2); 
						$sheet->setCellValue('AX'.$fila, $fomope->doc3); 
						$sheet->setCellValue('AY'.$fila, $fomope->doc4); 
						$sheet->setCellValue('AZ'.$fila, $fomope->doc5); 
		                $sheet->setCellValue('BA'.$fila, $fomope->doc6); 
		                $sheet->setCellValue('BB'.$fila, $fomope->doc7); 
		                $sheet->setCellValue('BC'.$fila, $fomope->doc8); 
		                $sheet->setCellValue('BD'.$fila, $fomope->doc9); 
		                $sheet->setCellValue('BE'.$fila, $fomope->doc10); 
		                $sheet->setCellValue('BF'.$fila, $fomope->doc11); 
		                $sheet->setCellValue('BG'.$fila, $fomope->doc12); 
		                $sheet->setCellValue('BH'.$fila, $fomope->doc13); 
		                $sheet->setCellValue('BI'.$fila, $fomope->doc14); 
		                $sheet->setCellValue('BJ'.$fila, $fomope->doc15); 
		                $sheet->setCellValue('BK'.$fila, $fomope->doc16); 
		                $sheet->setCellValue('BL'.$fila, $fomope->doc17); 
		                $sheet->setCellValue('BM'.$fila, $fomope->doc18); 
		                $sheet->setCellValue('BN'.$fila, $fomope->doc19); 
		                $sheet->setCellValue('BO'.$fila, $fomope->doc20); 
		                $sheet->setCellValue('BP'.$fila, $fomope->doc21); 
		                $sheet->setCellValue('BK'.$fila, $fomope->doc22); 
		                $sheet->setCellValue('BR'.$fila, $fomope->doc23); 
		                $sheet->setCellValue('BS'.$fila, $fomope->doc24); 
		                $sheet->setCellValue('BT'.$fila, $fomope->doc25); 
		                $sheet->setCellValue('BU'.$fila, $fomope->doc26); 
		                $sheet->setCellValue('BV'.$fila, $fomope->doc27); 
		                $sheet->setCellValue('BW'.$fila, $fomope->doc28); 
		                $sheet->setCellValue('BX'.$fila, $fomope->doc29); 
		                $sheet->setCellValue('BY'.$fila, $fomope->doc30); 
		                $sheet->setCellValue('BZ'.$fila, $fomope->doc31);
		                $sheet->setCellValue('CA'.$fila, $fomope->doc32); 
		                $sheet->setCellValue('CB'.$fila, $fomope->doc33); 
		                $sheet->setCellValue('CC'.$fila, $fomope->doc34); 
		                $sheet->setCellValue('CD'.$fila, $fomope->doc35); 
		                $sheet->setCellValue('CE'.$fila, $fomope->doc36); 
		                $sheet->setCellValue('CF'.$fila, $fomope->doc37); 
		                $sheet->setCellValue('CG'.$fila, $fomope->doc38); 
		                $sheet->setCellValue('CH'.$fila, $fomope->doc39); 
		                $sheet->setCellValue('CI'.$fila, $fomope->doc40); 
		                $sheet->setCellValue('CJ'.$fila, $fomope->doc41); 
		                $sheet->setCellValue('CK'.$fila, $fomope->doc42); 
		                $sheet->setCellValue('CL'.$fila, $fomope->doc43); 
		                $sheet->setCellValue('CM'.$fila, $fomope->doc44); 
		                $sheet->setCellValue('CN'.$fila, $fomope->doc45); 
		                $sheet->setCellValue('CO'.$fila, $fomope->doc46); 
		                $sheet->setCellValue('CP'.$fila, $fomope->doc47); 
		                $sheet->setCellValue('CK'.$fila, $fomope->doc48); 
		                $sheet->setCellValue('CR'.$fila, $fomope->doc49); 
		                $sheet->setCellValue('CS'.$fila, $fomope->doc50); 
		                $sheet->setCellValue('CT'.$fila, $fomope->doc51); 
		                $sheet->setCellValue('CU'.$fila, $fomope->doc52); 
		                $sheet->setCellValue('CV'.$fila, $fomope->doc53); 
		                $sheet->setCellValue('CW'.$fila, $fomope->doc54); 
		                $sheet->setCellValue('CX'.$fila, $fomope->doc55); 
		                $sheet->setCellValue('CY'.$fila, $fomope->doc56); 
		                $sheet->setCellValue('CZ'.$fila, $fomope->doc57); 
		                $sheet->setCellValue('DA'.$fila, $fomope->doc58); 
		                $sheet->setCellValue('DB'.$fila, $fomope->doc59); 
		                $sheet->setCellValue('DC'.$fila, $fomope->doc60); 
		                $sheet->setCellValue('DD'.$fila, $fomope->doc61); 
		                $sheet->setCellValue('DE'.$fila, $fomope->doc62); 
		                $sheet->setCellValue('DF'.$fila, $fomope->doc63); 
		                $sheet->setCellValue('DG'.$fila, $fomope->doc64); 
		                $sheet->setCellValue('DH'.$fila, $fomope->doc65); 
		                $sheet->setCellValue('DI'.$fila, $fomope->doc66); 
		                $sheet->setCellValue('DJ'.$fila, $fomope->doc67); 
		                $sheet->setCellValue('DK'.$fila, $fomope->doc68); 
		                $sheet->setCellValue('DL'.$fila, $fomope->doc69); 
		                $sheet->setCellValue('DM'.$fila, $fomope->doc70); 
		                $sheet->setCellValue('DN'.$fila, $fomope->doc71);*/
		                $sheet->setCellValue('AV'.$fila, $fomope->qnaDeAfectacion);
		                $sheet->setCellValue('AW'.$fila, $fomope->usuarioAdjuntarDoc);
		                $sheet->setCellValue('AX'.$fila, $fomope->idProfesionalCarrera); 
                        $sheet->setCellValue('AY'.$fila, $fomope->fechaValidacionPersonal);

                        $fila=$fila+1;
                        

        }

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="reporteConsulta.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');

        
      
    }

    public function downloadPDF(Request $request){
        $Documento = $request->get('Documento'); 
        $nombreDeArchivoDescarga = $request->get('nombreDoc'); 
        $data2 = explode(".",$nombreDeArchivoDescarga);
        $indice = count($data2);
        $tipoArchivo = $data2[$indice-1];

	if($tipoArchivo == "zip" || $tipoArchivo == "ZIP" || $tipoArchivo == "7z" || $tipoArchivo == "7Z"){
		header("Content-type: application/zip");
        header("Content-Transfer-Encoding: binary");
		//readfile("./DOCUMENTOS/".$nombreDeArchivoDescarga); 
		readfile('../storage/app/public/DOCUMENTOS_MOV/'.$Documento."/".$nombreDeArchivoDescarga); 
        //readfile("./DOC_FOMOPES/".$nombreDeArchivoDescarga); 
        //readfile($nombreDeArchivoDescarga); 
       	//readfile("./DOCUMENTOS_RES/".$nombreDeArchivoDescarga); 
        //readfile("./DOCUMENTOS_PDC/".$nombreDeArchivoDescarga); 

	}else{
		header("Content-type: application/PDF");
		readfile('../storage/app/public/DOCUMENTOS_MOV/'.$Documento."/".$nombreDeArchivoDescarga); 
	//	readfile("./DOCUMENTOS/".$nombreDeArchivoDescarga); 
	//	readfile("./DOC_FOMOPES/".$nombreDeArchivoDescarga); 
     //   readfile($nombreDeArchivoDescarga); 
	//	readfile("./DOCUMENTOS_RES/".$nombreDeArchivoDescarga); 
	//	readfile("./DOCUMENTOS_PDC/".$nombreDeArchivoDescarga); 

	}
       // $extencion = explode(".",$DocumentoAdescargar);

        // project/public/download/info.pdf
        /*
        $file= public_path(). "../storage/app/public/DOCUMENTOS_MOV/".$DocumentoAdescargar;
    
        $headers = array(
                  'Content-Type: application/pdf',
                );
    
        return Response::download($file, 'filename.pdf', $headers);
        */
      return response()->download(storage_path(). "\app\public\DOCUMENTOS_MOV/".$Documento."/".$nombreDeArchivoDescarga);
    
    }





  
}
