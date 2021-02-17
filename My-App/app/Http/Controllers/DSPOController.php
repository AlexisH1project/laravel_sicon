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

class DSPOController extends Controller
{

    public function autorizaDSPO()
    {

        //$Fomope = DB::table('fomope')->get();
        return view('DSPO.autorizaDSPO');
    }

    public function capDSPO()
    {

        //$Fomope = DB::table('fomope')->get();
        return view('DSPO.capDSPO');
    }

    public function correosUR()
    {
        return view('DSPO.correosUR');
    }

    public function generarReportePC()
    {
        return view('DSPO.generarReportePC');
    }

    public function form_FOMOPE($fomopeId)
    {
        $usuarios = DB::table('users')->get();
        $fechaSistema = DB::table('m1ct_fechasnomina')->where('estadoActual', 'abierta')->first();
        $Documentos = DB::table('m1ct_documentos')->get();
        $mytime = Carbon::now();
        $mytime->setTimezone('GMT-6');
        $anio = $mytime->weekYear();

        $fomope = DB::table('fomope')->where('id_movimiento', $fomopeId)->first();
        return view('DSPO.form_FOMOPE', compact('fomope', 'usuarios', 'fechaSistema', 'anio', 'Documentos'));
    }

    public function form_FOMOPEAnalista($fomopeId)
    {
        $usuarios = DB::table('users')->get();
        $fechaSistema = DB::table('m1ct_fechasnomina')->where('estadoActual', 'abierta')->first();
        $Documentos = DB::table('m1ct_documentos')->get();
        $mytime = Carbon::now();
        $mytime->setTimezone('GMT-6');
        $anio = $mytime->weekYear();

        $fomope = DB::table('fomope')->where('id_movimiento', $fomopeId)->first();
        return view('DSPO.form_FOMOPEAnalista', compact('fomope', 'usuarios', 'fechaSistema', 'anio', 'Documentos'));
    }

    public function autorizarNomina($fomopeId)
    {
        $mytime = Carbon::now();
        $mytime->setTimezone('GMT-6');
        $fomope = DB::table('fomope')->where('id_movimiento', $fomopeId)->first();
        $user_Fecha = $mytime->toDateString() . " - " . Auth::user()->usuario;
 
        $update = DB::update(
            'update fomope set color_estado = ?, usuario_name = ?, fechaAutorizacion = ? where id_movimiento = ?',
            ["verde", Auth::user()->name, $user_Fecha, $fomope->id_movimiento]
        );
        insertarHistorial($fomope->id_movimiento);

        if (Auth::user()->id_rol == 2) {
            $mensaje = "el fomope fue actualizado";
            return view('DSPO.autorizaDSPO', compact('mensaje'));
        } elseif (Auth::user()->id_rol == 3) {
            $mensaje = "el fomope fue actualizado";
            return view('DSPO.capDSPO', compact('mensaje'));

        }
       
    }

    public function editarAnalista($fomopeId)
    {
        $usuarios = DB::table('users')->get();
        $fechaSistema = DB::table('m1ct_fechasnomina')->where('estadoActual', 'abierta')->first();
        $Documentos = DB::table('m1ct_documentos')->get();
        $mytime = Carbon::now();
        $mytime->setTimezone('GMT-6');
        $anio = $mytime->weekYear();

        $fomope = DB::table('fomope')->where('id_movimiento', $fomopeId)->first();
        return view('DSPO.editarAnalista', compact('fomope', 'usuarios', 'fechaSistema', 'anio', 'Documentos'));
    }

    public function agregar_FOMOPE(Request $request)
    {

        $fomopeId = $request->get('noFomope');
        $elBoton = $request->get('accionB'); //arreglar
        $qna_Add = $request->get('qnaOption');
        $anio_Add = $request->get('anio');
        $of_unidad = $request->get('ofunid');
        $fecha_oficio = $request->get('fechaofi');
        $fecha_recibido = $request->get('fechareci');
        $codigo = $request->get('codigo');
        $no_puesto = $request->get('num_pues');
        $clave_presupuestaria = $request->get('clavepres');
        $movimientoYcodigo = $request->get('cod2_1');
        $nombreCompletoMov = explode("_", $request->get('cod2_1'));
        $del_1 = $request->get('del2');
        $al_1 = $request->get('al3');
        $estado_en = $request->get('cod3_1');
        $consecutivo_maestro_impuestos = $request->get('consema');
        $observaciones = $request->get('observ');
        $fecha_recibido_spc = $request->get('fecharecspc');
        $fecha_envio_spc = $request->get('fechenvvb');
        $fecha_recibo_dspo = $request->get('fechenvvb');
        $folio_spc = $request->get('foliospc');
        $mytime = Carbon::now();
        $mytime->setTimezone('GMT-6');
        $fomope = DB::table('fomope')->where('id_movimiento', $fomopeId)->first();
        $user_Fecha = $mytime->toDateString() . " - " . Auth::user()->usuario;
        $Documentos = DB::table('m1ct_documentos')->get();
        $fechaSistema = DB::table('m1ct_fechasnomina')->where('estadoActual', 'abierta')->first();
        $anio = $mytime->weekYear();
        echo $fomopeId;


        if (empty($of_unidad)) {
            $of_unidad = "-";
        }
        if (empty($fecha_oficio)) {
            $fecha_oficio = "-";
        }
        if (empty($fecha_recibido)) {
            $fecha_recibido = "-";
        }
        if (empty($codigo)) {
            $codigo = "-";
        }
        if (empty($no_puesto)) {
            $no_puesto = "-";
        }
        if (empty($clave_presupuestaria)) {
            $clave_presupuestaria = "-";
        }
        if (empty($del_1)) {
            $del_1 = "-";
        }
        if (empty($al_1)) {
            $al_1 = "-";
        }
        if (empty($consecutivo_maestro_impuestos)) {
            $consecutivo_maestro_impuestos = "-";
        }
        if (empty($observaciones)) {
            $observaciones = "-";
        }
        if (empty($fecha_recibido_spc)) {
            $fecha_recibido_spc = "-";
        }
        if (empty($fecha_envio_spc)) {
            $fecha_envio_spc = "-";
        }
        if (empty($fecha_recibo_dspo)) {
            $fecha_recibo_dspo = "-";
        }

        if (empty($folio_spc)) {
            $folio_spc = "-";
        }


        if ($elBoton == "Capturar" || $elBoton == "aceptar y modificar") {
            // if(count($nombreCompletoMov)>0){
            // $codigo_movimiento = $nombreCompletoMov[0];
            // $concepto = $nombreCompletoMov[1];
            //   }else{
            $codigo_movimiento = "";
            $concepto = "";
            //}
            if ($elBoton == "Capturar" || Auth::user()->id_rol == 3) {
                $colorAenviar = "cafe";
                $estadoFecha = "En espera de autorización";
            } else {
                $estadoFecha = $user_Fecha;
                $colorAenviar = "negro1";
            }

            if ($fecha_recibido <= $mytime->toDateString() and $fecha_oficio <= $mytime->toDateString() and $fecha_recibido_spc <= $mytime->toDateString() and $fecha_envio_spc <= $mytime->toDateString() and $fecha_recibo_dspo <= $mytime->toDateString()) {

                $update = DB::update(
                    'update fomope set usuario_name = ? ,color_estado= ? ,qnaDeAfectacion= ?,anio=? ,oficioUnidad=? ,fechaOficio=? ,fechaRecibido=?,codigo= ?,n_puesto=?,clavePresupuestaria=?,codigoMovimiento=?,descripcionMovimiento=?,vigenciaDel=?,vigenciaAl=?,entidad=?,consecutivoMaestroPuestos=?,observaciones=?,fechaRecepcionSpc=?,fechaEnvioSpc=?,fechaReciboDspo=?,folioSpc=?, fechaCaptura = ?, fechaAutorizacion = ? WHERE id_movimiento = ?',
                    [Auth::user()->name, $colorAenviar, $mytime->toDateString(), $qna_Add, $anio_Add, $of_unidad, $fecha_oficio, $fecha_recibido, $codigo, $no_puesto, $clave_presupuestaria, $codigo_movimiento, $concepto, $del_1, $al_1, $estado_en, $consecutivo_maestro_impuestos, $observaciones, $fecha_recibido_spc, $fecha_envio_spc, $fecha_recibo_dspo, $folio_spc, $user_Fecha, $estadoFecha, $fomope->id_movimiento]
                );
                insertarHistorial($fomope->id_movimiento);
            if ($elBoton != "aceptar y modificar") {
                if (Auth::user()->id_rol == 2) {
                    $mensaje = "el fomope fue capturado";
                    return view('DSPO.form_FOMOPE', compact('mensaje', 'fomope', 'Documentos', 'fechaSistema', 'anio'));
                } elseif (Auth::user()->id_rol == 3) {
                    $mensaje = "el fomope fue actualizado";
                    return view('DSPO.form_FOMOPE', compact('mensaje', 'fomope', 'Documentos', 'fechaSistema', 'anio'));

                }
            }else if ($elBoton == "aceptar y modificar") {
                if (Auth::user()->id_rol == 2) {
                    $mensaje = "el fomope fue capturado";
                    return view('DSPO.autorizaDSPO', compact('mensaje'));
                } elseif (Auth::user()->id_rol == 3) {
                    $mensaje = "el fomope fue actualizado";
                    return view('DSPO.capDSPO', compact('mensaje'));

                }
                
                }
            } else {
                $mensaje = "Se detecto incosistencia en las fechas";
                return view('DSPO.form_FOMOPE', compact('mensaje', 'fomope', 'Documentos', 'fechaSistema', 'anio'));
            }
        } else if ($elBoton == "descargar" || $elBoton == "Aceptar rechazo por captura") {
            // if(count($nombreCompletoMov)>0){
            // $codigo_movimiento = $nombreCompletoMov[0];
            // $concepto = $nombreCompletoMov[1];
            //}else{
            $codigo_movimiento = "";
            $concepto = "";
            //}
            insertarHistorial($fomope->id_movimiento);

            if ($elBoton == "Aceptar rechazo por captura") {
                $motivoR = $request->get('comentarioR2');
                $newColorEstado = "negro";

                $update = DB::update(
                    "update fomope set justificacionRechazo = ?, usuario_name=?,color_estado=?,qnaDeAfectacion=?,anio=?,oficioUnidad=?,fechaOficio=?,fechaRecibido=?,codigo=?,n_puesto=?,clavePresupuestaria=?,codigoMovimiento=?,descripcionMovimiento=?,vigenciaDel=?,vigenciaAl=?,entidad=?,consecutivoMaestroPuestos=?,observaciones=?,fechaRecepcionSpc=?,fechaEnvioSpc=?,fechaReciboDspo=?,folioSpc=?, fechaCaptura = ? WHERE id_movimiento = ? ",
                    [$motivoR, Auth::user()->name, $newColorEstado, $qna_Add, $anio_Add, $of_unidad, $fecha_oficio, $fecha_recibido, $codigo, $no_puesto, $clave_presupuestaria, $codigo_movimiento, $concepto, $del_1, $al_1, $estado_en, $consecutivo_maestro_impuestos, $observaciones, $fecha_recibido_spc, $fecha_envio_spc, $fecha_recibo_dspo, $folio_spc, $user_Fecha, $fomope->id_movimiento]
                );
            } else {
                $motivoR = $request->get('comentarioR');
                $newColorEstado = "negro1";
                $fAutorizacion = "En espera de autorización";

                $update = DB::update(
                    "update fomope set justificacionRechazo = ?, usuario_name=?,color_estado=?,qnaDeAfectacion=?,anio=?,oficioUnidad=?,fechaOficio=?,fechaRecibido=?,codigo=?,n_puesto=?,clavePresupuestaria=?,codigoMovimiento=?,descripcionMovimiento=?,vigenciaDel=?,vigenciaAl=?,entidad=?,consecutivoMaestroPuestos=?,observaciones=?,fechaRecepcionSpc=?,fechaEnvioSpc=?,fechaReciboDspo=?,folioSpc=?, fechaCaptura = ?, fechaAutorizacion = ? WHERE id_movimiento = ? ",
                    [$motivoR, Auth::user()->name, $newColorEstado, $qna_Add, $anio_Add, $of_unidad, $fecha_oficio, $fecha_recibido, $codigo, $no_puesto, $clave_presupuestaria, $codigo_movimiento, $concepto, $del_1, $al_1, $estado_en, $consecutivo_maestro_impuestos, $observaciones, $fecha_recibido_spc, $fecha_envio_spc, $fecha_recibo_dspo, $folio_spc, $user_Fecha, $user_Fecha, $fAutorizacion, $fomope->id_movimiento]
                );
            }
            insertarRechazo($fomope->id_movimiento, $motivoR);

            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("excel/rechazoT.xls");
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('H10', $mytime->toDateString());
            $sheet->setCellValue('D12', $fomope->apellido_1 . " " . $fomope->apellido_2 . " " . $fomope->nombre);
            $sheet->setCellValue('D14', $movimientoYcodigo);
            $sheet->setCellValue('D18', $fomope->unidad);
            $sheet->setCellValue('D22', $motivoR);
            $sheet->setCellValue('B31', Auth::user()->name);
            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="volanteRechazo_' . $fomope->curp . '.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
        } else if ($elBoton == "generar") {
            $idProfCarrera = $request->get('idProfesional');

            $update = DB::update(
                "update fomope set usuario_name = ?, idProfesionalCarrera = ? WHERE id_movimiento = ?",
                [Auth::user()->name, $idProfCarrera, $fomope->id_movimiento]
            );

            $templateWord = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('word/DGRHO_DIPSP_2020_MEMORANDUM_126.docx'));
            // --- Asignamos valores a la plantilla
            $templateWord->setValue('nombres', $fomope->nombre);
            $templateWord->setValue('fecha', $mytime->toDateString());
            $templateWord->setValue('apellido1', $fomope->apellido_1);
            $templateWord->setValue('apellido2', $fomope->apellido_2);
            $templateWord->setValue('unidad', $fomope->unidad);
            $templateWord->setValue('idProfCar', $idProfCarrera);
            // // --- Guardamos el documento
            $templateWord->saveAs('word/DGRHO_DIPSP_2020_MEMORANDUM_' . $idProfCarrera . '.docx');
            header("Content-Disposition: attachment; filename=DGRHO_DIPSP_2020_MEMORANDUM_" . $idProfCarrera . ".docx; charset=iso-8859-1");
            echo file_get_contents('word/DGRHO_DIPSP_2020_MEMORANDUM_' . $idProfCarrera . '.docx');
            $mensaje="hola";
        }else if($elBoton == "bandeja principal"){	
            if (Auth::user()->id_rol == 2) {
                return view('DSPO.autorizaDSPO');
            } elseif (Auth::user()->id_rol == 3) {
        
                return view('DSPO.capDSPO');

            }
        }
        
    }
    public function aceptarFomope(Request $request)
    {
        $mytime = Carbon::now();
        $mytime->setTimezone('GMT-6');
        $fomopeId = $request->get('noFomope');
        $fomope = DB::table('fomope')->where('id_movimiento', $fomopeId)->first();
        $user_Fecha = $mytime->toDateString() . " - " . Auth::user()->usuario;

        if (Auth::user()->id_rol == 3 or Auth::user()->id_rol == 2) {
            $nuevoColorEstado = "naranja";
        } elseif (Auth::user()->id_rol == 4 && $fomope->color_estado == 'naranja') {
            $nuevoColorEstado = "azul";
        } elseif (Auth::user()->id_rol == 4 && $fomope->color_estado == 'azul') {
            $nuevoColorEstado = "rosa";
        }

        if ((Auth::user()->id_rol == 3 or Auth::user()->id_rol == 2) or (Auth::user()->id_rol == 4 && $fomope->color_estado == 'naranja') or (Auth::user()->id_rol == 4 && $fomope->color_estado == 'azul')) {

            $update = DB::update(
                'update fomope set color_estado = ?, usuario_name = ?, fechaEnviadaRubricaDspo = ?, fechaAutorizacion = ? where id_movimiento = ?',
                [$nuevoColorEstado, Auth::user()->name, $mytime->toDateString(), $user_Fecha, $fomope->id_movimiento]
            );

            $insert = DB::insert(
                'insert into historial (id_movimiento,usuario,fechaMovimiento,horaMovimiento) values (?,?,?,?)',
                [$fomope->id_movimiento, Auth::user()->usuario, $mytime->toDateString(),  $mytime->toTimeString()]
            );

            $mensaje = "Fomope Aceptado Correctamente";
        } else {
            $mensaje = "Hubo un error aceptando el fomope";
        }

        return view('DSPO.autorizaDSPO', compact('mensaje'));
    }

    public function observacion(Request $request)
    {
        $mytime = Carbon::now();
        $mytime->setTimezone('GMT-6');
        $fomopeId = $request->get('noFomope');
        $observacion = $request->get('rechazoM');
        $fomope = DB::table('fomope')->where('id_movimiento', $fomopeId)->first();
        $user_Fecha = $mytime->toDateString() . " - " . Auth::user()->usuario;

        if (Auth::user()->id_rol == 3 or Auth::user()->id_rol == 2 or Auth::user()->id_rol == 4) {

            if (Auth::user()->id_rol == 3 or Auth::user()->id_rol == 4) {
                $update = DB::update(
                    'update fomope set color_estado = ?, usuario_name = ?, justificacionRechazo = ?, fechaCaptura = ?, fechaAutorizacion = ? where id_movimiento = ?',
                    ["negro1", Auth::user()->name, $observacion, $user_Fecha, "En espera de autorización", $fomope->id_movimiento]
                );
            } elseif (Auth::user()->id_rol == 2) {
                $update = DB::update(
                    'update fomope set color_estado = ?, usuario_name = ?, justificacionRechazo = ?, fechaAutorizacion = ?, fechaCaptura = ? where id_movimiento = ?',
                    ["negro1", Auth::user()->name, $observacion, $user_Fecha, "En espera de captura", $fomope->id_movimiento]
                );
            }

            $insert = DB::insert(
                'insert into rechazos (id_movimiento,justificacionRechazo,usuario,fechaRechazo) values (?,?,?,?)',
                [$fomope->id_movimiento, $observacion, Auth::user()->usuario, $mytime->toDateString()]
            );

            $insert = DB::insert(
                'insert into historial (id_movimiento,usuario,fechaMovimiento,horaMovimiento) values (?,?,?,?)',
                [$fomope->id_movimiento, Auth::user()->usuario, $mytime->toDateString(),  $mytime->toTimeString()]
            );

            $mensaje = "El rechazo fue registrado";
        } else {
            $mensaje = "Hubo un problema rechazando el fomope";
        }

        return view('DSPO.autorizaDSPO', compact('mensaje'));
    }

    public function eliminarFomope(Request $request){

        $fomopeId = $request->get('noFomope');
        $elBoton = $request->get('accionB'); //arreglar
        $fomope = DB::table('fomope')->where('id_movimiento', $fomopeId)->first();

        if($elBoton == "Eliminar"){
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
                       
        // return view('DDSCH.autorizaDDSCH', compact('mensaje'));
       }
       elseif (Auth::user()->id_rol == 0 && $unidadC == '' ) {
                       
         // return view('DDSCH.autorizaDDSCH', compact('mensaje'));
       }
       elseif (Auth::user()->id_rol == 1) {
        return view('DDSCH.autorizaDDSCH', compact('mensaje'));
       }

    }

    }

    public function getFomopeTableDSPO(Request $request){
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

    public function autorizacionFomope($fomope){
    
        //$fomopeAutorizarId = $request->get('fomope');
        $data = explode(",",$fomope);
        $fomopesS = DB::table('fomope')->select('*')->whereIn('id_movimiento', $data)->get();
        $mytime = Carbon::now();
        $mytime->setTimezone('GMT-6'); 
        $user_Fecha =$mytime->toDateString()." - ". Auth::user()->usuario;
        foreach($fomopesS as $fomope){
    
                            
                $update = DB::update(
                    'update fomope set color_estado = ?, usuario_name = ?, fechaAutorizacion = ? where id_movimiento = ?',
                    ['naranja', Auth::user()->name, $user_Fecha, $fomope->id_movimiento]
                );
                insertarHistorial($fomope->id_movimiento);
               
        } 
                      return view('DSPO.autorizaDSPO');
        }

    
    }

