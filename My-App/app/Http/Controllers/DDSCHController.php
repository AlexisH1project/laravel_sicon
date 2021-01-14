<?php


namespace App\Http\Controllers;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Auth;
use App\Fomope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DDSCHController extends Controller
{
    public function autorizaDDSCH(){

        //$Fomope = DB::table('fomope')->get();
        return view('DDSCH.autorizaDDSCH');
    }

    public function capDDSCH(){
        return view('DDSCH.capDDSCH');
    }

    public function actualizarFecha(){
        return view('DDSCH.actualizarFecha');
    }
    public function guardarVistaEventuales(){
        return view('DDSCH.guardarVistaEventuales');
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
}
