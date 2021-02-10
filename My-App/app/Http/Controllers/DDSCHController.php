<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DDSCHController extends Controller
{
    public function autorizaDDSCH(){

        //$Fomope = DB::table('fomope')->get();
        return view('DDSCH.autorizaDDSCH');
    }

    public function capDDSCH(){
        return view('DDSCH.capDDSCH');
    }

    public function verVerde(){
        return view('DDSCH.verVerde');
    }

    public function verVerde2(){
        return view('DDSCH.verVerde2');
    }

    public function negroEditar(Request $request){

        $Documentos = DB::table('m1ct_documentos')->get();
        $fomopeId = $request->get('NFomope');
        $usuarios = DB::table('users')->get();
        $fomope = DB::table('fomope')->where('id_movimiento',$fomopeId)->first();
     
       return view('DDSCH.negroEditar', compact('Documentos', 'usuarios', 'fomope'));
    }

    public function grisEditar(){
        return view('DDSCH.grisEditar');
    }



    public function verAmarillo0(Request $request){
        $fomopeId = $request->get('NFomope');
        $usuarios = DB::table('users')->get();
       $fomope = DB::table('fomope')->where('id_movimiento',$fomopeId)->first();
        return view('DDSCH.verAmarillo0', compact('fomope', 'usuarios'));
    }

    public function actualizarFecha(){
        return view('DDSCH.actualizarFecha');
    }

    public function qrtxt(){
        return view('DDSCH.qrtxt');
    }

    public function blancoDDSCH(){
        $Documentos = DB::table('m1ct_documentos')->get();
        $usuarios = DB::table('users')->get();
        return view('DDSCH.blancoDDSCH', compact('Documentos', 'usuarios'));
    }

    public function EnviarFomope(Request $request){
        
        $Documentos = DB::table('m1ct_documentos')->get();
        $usuarios = DB::table('users')->get();
        $quincena = DB::table('m1ct_fechasnomina')->where('estadoActual','abierta')->value('id_qna');
        $unidad = $request->get('unidad');
        $rfc = $request->get('rfc');
        $curp = $request->get('curp');
        $apellido1 = $request->get('apellido1');
        $apellido2 = $request->get('apellido2');
        $nombre = $request->get('nombre');
        $fechaIngreso = $request->get('fechaIngreso');
        $al3 = $request->get('al3');
        $del2 = $request->get('del2');
        $DocumentoAdd = $request->get('documentoSelct');
        $Docs = $request->get('Docs');
        $Documents = $DocumentoAdd.$Docs;
        $mytime = Carbon::now();
        $mytime->setTimezone('GMT-6'); 
        

        DB::table('fomope')
        ->updateOrInsert(
            [
                'unidad' => $unidad,
                'rfc' => $rfc,
                'curp' => $curp,
                'apellido_1' => $apellido1,
                'apellido_2' => $apellido2,
                'nombre' => $nombre,
                'fechaIngreso' => $fechaIngreso,
                'vigenciaDel' => $del2,
                'vigenciaAl' => $al3
            ],
            [
                'color_estado' => "amarillo0",
                'usuario_name' => Auth::user()->usuario,
                'unidad' => $unidad,
                'rfc' => $rfc,
                'curp' => $curp,
                'apellido_1' => $apellido1,
                'apellido_2' => $apellido2,
                'nombre' => $nombre,
                'fechaIngreso' => $fechaIngreso,
                'vigenciaDel' => $del2,
                'vigenciaAl' => $al3,
                'tipoDeAccion' => "",
                'justificacionRechazo' => "",
                'quincenaAplicada' => $quincena, //llenar
                'anio' => $mytime->weekYear(), //llenar
                'oficioUnidad' => "",
                'codigo' => "",
                'n_puesto' => "",
                'clavePresupuestaria' => "",
                'codigoMovimiento' => "",
                'descripcionMovimiento' => "",
                'entidad' => "",
                'consecutivoMaestroPuestos' => "",
                'puestos' => "",
                'usuarioAdjuntarDoc' => "",
                'idProfesionalCarrera' => "",
                'fechaValidacionPersonal' => $mytime->toDateString()
            ]
        );

        return view('DDSCH.blancoDDSCH', compact('usuarios','Documentos', 'Documents', 'DocumentoAdd', 'unidad', 'rfc', 'curp', 'apellido1', 'apellido2', 'nombre', 'fechaIngreso', 'del2', 'al3'));
    }

    public function agregarNewFomope(Request $request){
        
        $Documentos = DB::table('m1ct_documentos')->get();
        $quincena = DB::table('m1ct_fechasnomina')->where('estadoActual','abierta')->value('id_qna');
        $unidad = $request->get('unidad');
        $rfc = $request->get('rfc');
        $curp = $request->get('curp');
        $apellido1 = $request->get('apellido1');
        $apellido2 = $request->get('apellido2');
        $nombre = $request->get('nombre');
        $fechaIngreso = $request->get('fechaIngreso');
        $al3 = $request->get('al3');
        $del2 = $request->get('del2');
        $tipoEntregaAdd = $request->get('TipoEntregaArchivo');
        $radioAdd_rechazar = $request->get('botonAccion');
        $motivoR = $request->get('motivoR');
        $analista = $request->get('usuar');
        $DocumentoAdd = $request->get('documentoSelct');
        $mytime = Carbon::now();
        $mytime->setTimezone('GMT-6'); 
        $user_Fecha =$mytime->toDateString()." - ". Auth::user()->usuario;

        if(Auth::user()->id_rol == 1){
            $colorAccion = "amarillo";
            $fechaAutorizacion ="";
        }else if(Auth::user()->id_rol == 0){
            $colorAccion = "amarillo0";
            $fechaAutorizacion = Auth::user()->usuario." - ".$mytime->toDateString();
        }

        DB::table('fomope')
        ->updateOrInsert(
            [
                'unidad' => $unidad,
                'rfc' => $rfc,
                'curp' => $curp,
                'apellido_1' => $apellido1,
                'apellido_2' => $apellido2,
                'nombre' => $nombre,
                'fechaIngreso' => $fechaIngreso,
                'vigenciaDel' => $del2,
                'vigenciaAl' => $al3
            ],
            [
                'color_estado' => $colorAccion,
                'usuario_name' => Auth::user()->usuario,
                'unidad' => $unidad,
                'rfc' => $rfc,
                'curp' => $curp,
                'apellido_1' => $apellido1,
                'apellido_2' => $apellido2,
                'nombre' => $nombre,
                'fechaIngreso' => $fechaIngreso,
                'vigenciaDel' => $del2,
                'vigenciaAl' => $al3,
                'tipoEntrega' => $tipoEntregaAdd,
                'fechaAutorizacion' => $fechaAutorizacion,
                'tipoDeAccion'=> "Aceptar",
                'justificacionRechazo' => $motivoR,
                'quincenaAplicada' => $quincena,//$laQna,
                'fechaEntregaArchivo' => $mytime->toDateString(),
                'fechaEntregaRLaborales' => "Pendiente",
                'OfEntregaRLaborales' => "Pendiente",
                'fomopeDigital' => "Pendiente",
                'fechaEntregaUnidad' => "Pendiente",
                'OfEntregaUnidad' => "Pendiente",
                'fechaAutorizacion' => $user_Fecha,
                'analistaCap' => $analista,
                'fechaCaptura' => $user_Fecha,
                'tipoDeAccion' => "",
                'justificacionRechazo' => "",
                'anio' => $mytime->weekYear(), //llenar
                'oficioUnidad' => "",
                'codigo' => "",
                'n_puesto' => "",
                'clavePresupuestaria' => "",
                'codigoMovimiento' => "",
                'descripcionMovimiento' => "",
                'entidad' => "",
                'consecutivoMaestroPuestos' => "",
                'puestos' => "",
                'usuarioAdjuntarDoc' => "",
                'idProfesionalCarrera' => "",
                'fechaValidacionPersonal' => $mytime->toDateString()
                
            ]
        );

        $ultimoFomope = DB::table('fomope')->max('id_movimiento');

        DB::table('ct_empleados')
        ->updateOrInsert(
            [
                'rfc' => $rfc,
                'curp' => $curp,
                'apellido_1' => $apellido1,
                'apellido_2' => $apellido2,
                'nombre' => $nombre
            ],
            [
                'rfc' => $rfc,
                'curp' => $curp,
                'apellido_1' => $apellido1,
                'apellido_2' => $apellido2,
                'nombre' => $nombre
            ]
        );

        DB::table('historial')
        ->updateOrInsert(
            [
                'id_movimiento' => $ultimoFomope,
                'usuario' => Auth::user()->usuario,
                'fechaMovimiento' => $mytime->toDateString(),
                'horaMovimiento' => $mytime->toTimeString()
            ],
            [
                'id_movimiento' => $ultimoFomope,
                'usuario' => Auth::user()->usuario,
                'fechaMovimiento' => $mytime->toDateString(),
                'horaMovimiento' => $mytime->toTimeString()
            ]
        );

    }

    public function rechazarFomope(Request $request){
        
        $Documentos = DB::table('m1ct_documentos')->get();
        $penultimoFomope = DB::table('fomope')->max('id_movimiento');
        $quincena = DB::table('m1ct_fechasnomina')->where('estadoActual','abierta')->value('id_qna');
        $unidad = $request->get('unidad');
        $rfc = $request->get('rfc');
        $curp = $request->get('curp');
        $apellido1 = $request->get('apellido1');
        $apellido2 = $request->get('apellido2');
        $nombre = $request->get('nombre');
        $fechaIngreso = $request->get('fechaIngreso');
        $al3 = $request->get('al3');
        $del2 = $request->get('del2');
        $tipoEntregaAdd = $request->get('TipoEntregaArchivo');
        $radioAdd_rechazar = $request->get('botonAccion');
        $motivoR = $request->get('comentarioR');
        $analista = $request->get('usuar');
        $DocumentoAdd = $request->get('documentoSelct');
        $mytime = Carbon::now();
        $mytime->setTimezone('GMT-6'); 
        $user_Fecha =$mytime->toDateString()." - ". Auth::user()->usuario;

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("excel/rechazoL.xls");
        $sheet = $spreadsheet->getActiveSheet();  
        $sheet->setCellValue('H11',$fechaIngreso);
        $sheet->setCellValue('D13', $apellido1." ".$apellido2." ".$nombre);
        $sheet->setCellValue('D15', $motivoR);
        $sheet->setCellValue('D19', $unidad);
        $sheet->setCellValue('D23', $motivoR);
        $sheet->setCellValue('B32', Auth::user()->name);
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="volanteRechazo_'.$curp.'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');


        if(Auth::user()->id_rol == 1){
            $fechaAutorizacion ="";
        }else if(Auth::user()->id_rol == 0){
            $fechaAutorizacion = $user_Fecha;
        }

        DB::table('fomope')
        ->updateOrInsert(
            [
                'unidad' => $unidad,
                'rfc' => $rfc,
                'curp' => $curp,
                'apellido_1' => $apellido1,
                'apellido_2' => $apellido2,
                'nombre' => $nombre,
                'fechaIngreso' => $fechaIngreso,
                'vigenciaDel' => $del2,
                'vigenciaAl' => $al3
            ],
            [
                'color_estado' => "negro",
                'usuario_name' => Auth::user()->usuario,
                'unidad' => $unidad,
                'rfc' => $rfc,
                'curp' => $curp,
                'apellido_1' => $apellido1,
                'apellido_2' => $apellido2,
                'nombre' => $nombre,
                'fechaIngreso' => $fechaIngreso,
                'vigenciaDel' => $del2,
                'vigenciaAl' => $al3,
                'tipoEntrega' => $tipoEntregaAdd,
                'tipoDeAccion'=> "Rechazar",
                'justificacionRechazo' => $motivoR,
                'fechaAutorizacion' => $fechaAutorizacion,
                'quincenaAplicada' => $quincena,//$laQna,
                'fechaEntregaArchivo' => $mytime->toDateString(),
                'fechaEntregaRLaborales' => "Pendiente",
                'OfEntregaRLaborales' => "Pendiente",
                'fomopeDigital' => "Pendiente",
                'fechaEntregaUnidad' => "Pendiente",
                'OfEntregaUnidad' => "Pendiente",
                'fechaAutorizacion' => $user_Fecha,
                'analistaCap' => $analista,
                'fechaCaptura' => $user_Fecha,
                'tipoDeAccion' => "",
                'justificacionRechazo' => "",
                'anio' => $mytime->weekYear(), //llenar
                'oficioUnidad' => "",
                'codigo' => "",
                'n_puesto' => "",
                'clavePresupuestaria' => "",
                'codigoMovimiento' => "",
                'descripcionMovimiento' => "",
                'entidad' => "",
                'consecutivoMaestroPuestos' => "",
                'puestos' => "",
                'usuarioAdjuntarDoc' => "",
                'idProfesionalCarrera' => "",
                'fechaValidacionPersonal' => $mytime->toDateString()
            ]
        );
        $ultimoFomope = DB::table('fomope')->max('id_movimiento');

        DB::table('rechazos')
        ->updateOrInsert(
            [
                'id_movimiento' => $ultimoFomope,
                'justificacionRechazo' => $motivoR,
                'usuario' => Auth::user()->usuario,
                'fechaRechazo' => $mytime->toDateString()
            ],
            [
                'id_movimiento' => $ultimoFomope,
                'justificacionRechazo' => $motivoR,
                'usuario' => Auth::user()->usuario,
                'fechaRechazo' => $mytime->toDateString()
            ]
        );

        DB::table('historial')
        ->updateOrInsert(
            [
                'id_movimiento' => $ultimoFomope,
                'usuario' => Auth::user()->usuario,
                'fechaMovimiento' => $mytime->toDateString(),
                'horaMovimiento' => $mytime->toTimeString()
            ],
            [
                'id_movimiento' => $ultimoFomope,
                'usuario' => Auth::user()->usuario,
                'fechaMovimiento' => $mytime->toDateString(),
                'horaMovimiento' => $mytime->toTimeString()
            ]
        );


        
    }




    public function getFomopeTable(Request $request){
        $rfcBuscar = $request->get('rfc');
        $qnaBuscar = $request->get('qnaOption');
        $anioBuscar = $request->get('anio');
        $nombreBuscar = $request->get('nombreBus');
        $apellidoBuscar = $request->get('apellidoBus');
	    $apellidomBuscar = $request->get('apellidoMb');
        $unidadBuscar = $request->get('unidadBus');
        $ruta = $request->get('redirect');

        $fomope = DB::table('fomope')->select('*')
                ->where(function ($query) use($rfcBuscar, $qnaBuscar, $anioBuscar, $nombreBuscar, $apellidoBuscar, $apellidomBuscar, $unidadBuscar){
                            if($rfcBuscar !=null){
                                $query->where('rfc', 'LIKE', '%'.$rfcBuscar.'%');
                            }
                            if($qnaBuscar !=null){
                                $query->where('quincenaAplicada', 'LIKE', '%'.$qnaBuscar.'%');
                            }
                            if($anioBuscar !=null){
                                $query->where('anio', 'LIKE', '%'.$anioBuscar.'%');
                            }
                            if($nombreBuscar !=null){
                                $query->where('nombre', 'LIKE', '%'.$nombreBuscar.'%');
                            }
                            if($apellidoBuscar !=null){
                                $query->where('apellido_1', 'LIKE', '%'.$apellidoBuscar.'%');
                            }
                            if($apellidomBuscar !=null){
                                $query->where('apellido_2', 'LIKE', '%'.$apellidomBuscar.'%');
                            }
                            if($unidadBuscar !=null){
                                $query->where('unidad', 'LIKE', '%'.$unidadBuscar.'%');
                            }
                        })->get();

                        if($ruta=="autorizaDDSCH"){
                            return view('DDSCH.autorizaDDSCH', compact('fomope'));
                        }elseif($ruta=="consultaEstado"){
                            return view('General.consultaEstado', compact('fomope'));
                        }elseif($ruta=="autorizaDSPO"){
                            return view('DSPO.autorizaDSPO', compact('fomope'));
                        }elseif($ruta=="capDPO"){
                            return view('DSPO.capDSPO', compact('fomope'));
                        }
    }

    public function autorizacionFomope(Request $request){
    
    $fomopeAutorizarId = $request->get('fomope');
    $fomopesS = DB::table('fomope')->select('*')->whereIn('id_movimiento', $fomopeAutorizarId)->get();
    $mytime = Carbon::now();
    $mytime->setTimezone('GMT-6'); 
    $user_Fecha =$mytime->toDateString()." - ". Auth::user()->usuario;
    foreach($fomopesS as $fomope){

        if(strcmp($fomope->color_estado,"amarillo0")==0){
            
            $update = DB::update(
                'update fomope set color_estado = ?, usuario_name = ?, fechaAutorizacion = ? where id_movimiento = ?',
                ['amarillo', Auth::user()->name, $user_Fecha, $fomope->id_movimiento]
            );
        }elseif(strcmp($fomope->color_estado,"verde2")==0){

            $update = DB::update(
                'update fomope set color_estado = ?, usuario_name = ?, fechaEntregaArchivo = ?, fechaAutorizacion = ? where id_movimiento = ?',
                ['guinda', Auth::user()->name, $mytime->toDateString(),$user_Fecha, $fomope->id_movimiento]
            );
        }
        $insert = DB::insert(
            'insert into historial (id_movimiento,usuario,fechaMovimiento,horaMovimiento) values (?,?,?,?)',                
            [$fomope->id_movimiento, Auth::user()->usuario, $mytime->toDateString(),  $mytime->toTimeString()]
        );

        }
        return view('DDSCH.autorizaDDSCH');
    }

    public function autorizarAmarillo0(Request $request){
        $fomopeId = $request->get('idFom');
        $analista = $request->get('usuar');
        $fomope = DB::table('fomope')->where('id_movimiento', $fomopeId)->first();
        $mytime = Carbon::now();
        $mytime->setTimezone('GMT-6'); 
        $user_Fecha =$mytime->toDateString()." - ". Auth::user()->usuario;
       
    
                            
                $update = DB::update(
                    'update fomope set color_estado = ?, usuario_name = ?, fechaAutorizacion = ?, analistaCap = ? where id_movimiento = ?',
                    ['amarillo', Auth::user()->name, $user_Fecha,$analista, $fomope->id_movimiento]
                );
                insertarHistorial($fomope->id_movimiento);
               
        
                $mensaje = "el fomope fue actualizado";
                return view('DDSCH.autorizaDDSCH', compact('mensaje'));
    }

    public function  rechazoAmarillo0(Request $request){
        $fomopeId = $request->get('idFom');
        $analista = $request->get('usuar');
        $fomope = DB::table('fomope')->where('id_movimiento', $fomopeId)->first();
        $mytime = Carbon::now();
        $mytime->setTimezone('GMT-6'); 
        $user_Fecha =$mytime->toDateString()." - ". Auth::user()->usuario;
        $motivoR = $request->get('comentarioR');
        $newColorEstado = "negro";

            $update = DB::update(
                "update fomope set justificacionRechazo = ?, usuario_name=?,color_estado=? WHERE id_movimiento = ? ",
                [$motivoR, Auth::user()->name, $newColorEstado,  $fomope->id_movimiento]
            );
        
           
        insertarHistorial($fomope->id_movimiento);
        insertarRechazo($fomope->id_movimiento, $motivoR);

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("excel/rechazoL.xls");
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('H11', $mytime->toDateString());
        $sheet->setCellValue('D13', $fomope->apellido_1 . " " . $fomope->apellido_2 . " " . $fomope->nombre);
     //   $sheet->setCellValue('D14', $movimientoYcodigo);
        $sheet->setCellValue('D19', $fomope->unidad);
        $sheet->setCellValue('D23', $motivoR);
        $sheet->setCellValue('B32', Auth::user()->name);
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="volanteRechazo_' . $fomope->curp . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');

    }

    public function updateNegro(Request $request){
        $fomopeId = $request->get('idFom');
        $unidad = $request->get('unexp_1');
        $rfc = $request->get('rfcL_1');
        $curp = $request->get('curp');
        $apellido1 = $request->get('apellido1');
        $apellido2 = $request->get('apellido2');
        $nombre = $request->get('nombre');
        $fechaIngreso = $request->get('fechaIngreso');
        $tipoEntrega = $request->get('TipoEntregaArchivo');
        $radioRechazar = "agregar";
		$motivoR = $request->get('comentarioR');	
		$fechaDel = $request->get('del');	
		$fechaAl = $request->get('al');	
		$analista = $request->get('usuar');
        $archivo = $request->get('nameArchivo');
        $doc=$request->get('documentoSelect');

        $fomope = DB::table('fomope')->where('id_movimiento', $fomopeId)->first();
        $mytime = Carbon::now();
        $mytime->setTimezone('GMT-6'); 
        $user_Fecha =$mytime->toDateString()." - ". Auth::user()->usuario;
        $quincena = DB::table('m1ct_fechasnomina')->where('estadoActual','abierta')->value('id_qna');
        $Documentos = DB::table('m1ct_documentos')->get();
        $usuarios = DB::table('users')->get();

        $hora = str_replace ( ":", '',$mytime->toTimeString()); 
        $fecha = str_replace ( "-", '',$mytime->toDateString()); 


        if(Auth::user()->id_rol==0){
            $colorAccion="amarillo0";
            $fechaAutorizacion="";
            $fechaCaptura=$user_Fecha;
            $ruta='DDSCH.capDDSCH';

        }elseif(Auth::user()->id_rol==1){
            $colorAccion="amarillo";
            $fechaAutorizacion=$user_Fecha;
            $fechaCaptura="";
            $ruta='DDSCH.autorizaDDSCH';

        }
        if(empty($fechaAl)){
            $fechaAl="";
        }

        if($fechaIngreso<=$mytime->toDateString()){

        //verificar que haya un archivo subido por el usuario
if($request->hasFile('nameArchivo')){
    $file = $request->file('nameArchivo');
    $fileName = $request->nameArchivo->getClientOriginalName();  
    $extencion = explode(".",$fileName);
    $ext = $extencion[1];
    $concatenarNombreC = strtoupper($rfc)."_".$doc."_". $apellido1."_". $apellido2."_". $nombre."_".$fecha.$hora."_". $fomope->id_movimiento."_.".$ext; // strtoupper: lo pasa a mayuscula todo 
    $path = $file->storeAs('public/DOCUMENTOS_MOV/'.$doc."/", $fileName); // Guarda documento en la carpetta correspondiente ./public/storage/app/DOCUEMTOS_MOV
    Storage::move($path, 'public/DOCUMENTOS_MOV/'.$doc.'/'.$concatenarNombreC);
 }

        insertarHistorial($fomope->id_movimiento);
        $update = DB::update(
            "update fomope set color_estado=?,usuario_name=?, unidad=?,rfc=?,curp=?,apellido_1=?,apellido_2=?,nombre=?,fechaIngreso=?,tipoEntrega=?,tipoDeAccion=?,justificacionRechazo=?,fechaCaptura=?, fechaAutorizacion = ?, analistaCap=?, vigenciaDel = ?, vigenciaAl = ?, quincenaAplicada = ? WHERE id_movimiento = ?",
            [$colorAccion,Auth::user()->usuario,$unidad,$rfc,$curp,$apellido1,$apellido2,$nombre,$fechaIngreso,$tipoEntrega,$radioRechazar,$motivoR,$fechaCaptura,$fechaAutorizacion,$analista,$fechaDel, $fechaAl,$quincena ,$fomope->id_movimiento]
        );
        $mensaje="el fomope fue actualizado";
        return view($ruta, compact('mensaje'));
   
    }else{
        $mensaje="La fecha no puede ser mayor a la actual";
        return view('DDSCH.negroEditar', compact('mensaje', 'fomope','Documentos', 'usuarios'));
    }

        
    }

    public function eliminarFomope(Request $request){

        $fomopeId = $request->get('noFomope');
        $elBoton = $request->get('accionB'); //arreglar
        $fomope = DB::table('fomope')->where('id_movimiento', $fomopeId)->first();

            $unidadC = $request->get('unidadCorrespondiente');
            insertarHistorial($fomope->id_movimiento);
            
        $update = DB::update(
            "update fomope set color_estado = ? WHERE id_movimiento = ?",
            ["rojo", $fomope->id_movimiento]
        );
        $mensaje = "Se elimino el fomope";
        if(Auth::user()->id_rol == 2){
            
            return view('DSPO.autorizaDSPO', compact('mensaje'));
       }elseif (Auth::user()->id_rol == 3) {
                       
        return view('DSPO.capDSPO', compact('mensaje'));
       }
       elseif (Auth::user()->id_rol == 0 && $unidadC != '') {
                       
         return view('DDSCH.capDDSCH', compact('mensaje'));
       }
       elseif (Auth::user()->id_rol == 0 && $unidadC == '' ) {
                       
          return view('DDSCH.capDDSCH', compact('mensaje'));
       }
       elseif (Auth::user()->id_rol == 1) {
        return view('DDSCH.autorizaDDSCH', compact('mensaje'));
       }
    }

    public function updateVerde(Request $request){
		$id_Fom = $request->get('idFom');
		$fechaRLaboralesAdd =  $request->get('fechaRLaborales');
		$ofEntregaRLAdd =  $request->get('ofEntregaRL');
		$fechaEntregaUnidadAdd = $request->get('fechaEntregaUnidad');
		$ofEntregaUnidadAdd = $request->get('ofEntregaUnidad');
		$ofEntregaSeg = $request->get('ofEntrega');
		$motivoR = $request->get('comentarioR');
		$dir_subida = './documentos';

        
        $fomope = DB::table('fomope')->where('id_movimiento', $$id_Fom)->first();
        $mytime = Carbon::now();
        $mytime->setTimezone('GMT-6'); 
        $user_Fecha =$mytime->toDateString()." - ". Auth::user()->usuario;
        $quincena = DB::table('m1ct_fechasnomina')->where('estadoActual','abierta')->value('id_qna');
        $Documentos = DB::table('m1ct_documentos')->get();
        $usuarios = DB::table('users')->get();



        if(Auth::user()->id_rol==0){
            $colorAccion="verde2";
            $fechaAutorizacion="";
            $fechaCaptura=$user_Fecha;
            $ruta='DDSCH.capDDSCH';

        }elseif(Auth::user()->id_rol==1){
            $colorAccion="guinda";
            $fechaAutorizacion=$user_Fecha;
            $fechaCaptura="";
            $ruta='DDSCH.autorizaDDSCH';

        }

        if($fechaRLaboralesAdd<=$mytime->toDateString() AND $fechaEntregaUnidadAdd<=$mytime->toDateString()){

        
        insertarHistorial($fomope->id_movimiento);

        $update = DB::update(
            "update fomope set color_estado=?,usuario_name=?, oficioEntrega = '$', fechaEntregaRLaborales='$',OfEntregaRLaborales='$',fechaEntregaUnidad = '$',OfEntregaUnidad='$', 	justificacionRechazo= '$motivoR',fechaCaptura=?, fechaAutorizacion = ? WHERE id_movimiento = ?",
            [$colorAccion,Auth::user()->usuario,$ofEntregaSeg,$fechaRLaboralesAdd,$ofEntregaRLAdd,$fechaEntregaUnidadAdd,$ofEntregaUnidadAdd,$motivoR,$fechaCaptura,$fechaAutorizacion ,$fomope->id_movimiento]
        );
        $mensaje="el fomope fue actualizado";
        return view($ruta, compact('mensaje'));
   
    }else{
        $mensaje="La fecha no puede ser mayor a la actual";
        return view('DDSCH.grisEditar', compact('mensaje', 'fomope','Documentos', 'usuarios'));
    }


    }
}

