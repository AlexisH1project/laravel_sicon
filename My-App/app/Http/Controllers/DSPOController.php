<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DSPOController extends Controller
{

    public function autorizaDSPO(){

        //$Fomope = DB::table('fomope')->get();
        return view('DSPO.autorizaDSPO');
    }

    public function capDSPO(){

        //$Fomope = DB::table('fomope')->get();
        return view('DSPO.capDSPO');
    }

    public function correosUR(){
        return view('DSPO.correosUR');
    }

    public function generarReportePC(){
        return view('DSPO.generarReportePC');
    }

    public function form_FOMOPE(Request $request){
        $fomopeId = $request->get('NFomope');
        $usuarios = DB::table('users')->get();
        $fechaSistema = DB::table('m1ct_fechasnomina')->where('estadoActual','abierta')->first();
        $Documentos = DB::table('m1ct_documentos')->get();
        $mytime = Carbon::now();
        $mytime->setTimezone('GMT-6'); 
        $anio=$mytime->weekYear();

       $fomope = DB::table('fomope')->where('id_movimiento',$fomopeId)->first();
        return view('DSPO.form_FOMOPE', compact('fomope', 'usuarios', 'fechaSistema', 'anio', 'Documentos'));
    }

    public function form_FOMOPEAnalista(Request $request){
        $fomopeId = $request->get('NFomope');
        $usuarios = DB::table('users')->get();
        $fechaSistema = DB::table('m1ct_fechasnomina')->where('estadoActual','abierta')->first();
        $Documentos = DB::table('m1ct_documentos')->get();
        $mytime = Carbon::now();
        $mytime->setTimezone('GMT-6'); 
        $anio=$mytime->weekYear();

       $fomope = DB::table('fomope')->where('id_movimiento',$fomopeId)->first();
        return view('DSPO.form_FOMOPEAnalista', compact('fomope', 'usuarios', 'fechaSistema', 'anio', 'Documentos'));
    }

    public function autorizarNomina(Request $request){
        return view('DSPO.autorizarNomina');
    }

    public function editarAnalista(Request $request){
        return view('DSPO.editarAnalista');
    }

    public function agregar_FOMOPE(Request $request){
         return view('DSPO.agregar_FOMOPE');
    }

    public function aceptarFomope(Request $request){
        $mytime = Carbon::now();
        $mytime->setTimezone('GMT-6'); 
        $fomopeId = $request->get('noFomope');
        $fomope = DB::table('fomope')->where('id_movimiento',$fomopeId)->first();
        $user_Fecha =$mytime->toDateString()." - ". Auth::user()->usuario;

        if(Auth::user()->id_rol==3 OR Auth::user()->id_rol==2){
            $nuevoColorEstado = "naranja";
        }elseif(Auth::user()->id_rol== 4 && $fomope->color_estado == 'naranja'){
            $nuevoColorEstado = "azul";
        }elseif(Auth::user()->id_rol== 4 && $fomope->color_estado == 'azul'){
            $nuevoColorEstado = "rosa";
        }

        if((Auth::user()->id_rol==3 OR Auth::user()->id_rol==2) OR (Auth::user()->id_rol== 4 && $fomope->color_estado == 'naranja') OR (Auth::user()->id_rol== 4 && $fomope->color_estado == 'azul')){

            $update = DB::update(
            'update fomope set color_estado = ?, usuario_name = ?, fechaEnviadaRubricaDspo = ?, fechaAutorizacion = ? where id_movimiento = ?',
            [$nuevoColorEstado, Auth::user()->name, $mytime->toDateString(),$user_Fecha, $fomope->id_movimiento]
            );

            $insert = DB::insert(
            'insert into historial (id_movimiento,usuario,fechaMovimiento,horaMovimiento) values (?,?,?,?)',                
            [$fomope->id_movimiento, Auth::user()->usuario, $mytime->toDateString(),  $mytime->toTimeString()]
        );

        $aceptarFomopeV = "true";


        }else{
        $aceptarFomopeV = "false";
        }

        return view('DSPO.autorizaDSPO',compact('aceptarFomopeV'));
   }

    public function observacion(Request $request){
        $mytime = Carbon::now();
    $mytime->setTimezone('GMT-6'); 
    $fomopeId = $request->get('noFomope');
    $observacion = $request->get('rechazoM');
    $fomope = DB::table('fomope')->where('id_movimiento',$fomopeId)->first();
    $user_Fecha =$mytime->toDateString()." - ". Auth::user()->usuario;

   if(Auth::user()->id_rol==3 OR Auth::user()->id_rol==2 OR Auth::user()->id_rol== 4){

    if(Auth::user()->id_rol==3 OR Auth::user()->id_rol==4){
        $update = DB::update(
            'update fomope set color_estado = ?, usuario_name = ?, justificacionRechazo = ?, fechaCaptura = ?, fechaAutorizacion = ? where id_movimiento = ?',
            ["negro1", Auth::user()->name,$observacion,$user_Fecha,"En espera de autorización", $fomope->id_movimiento]
        );
    }elseif(Auth::user()->id_rol==2){
        $update = DB::update(
            'update fomope set color_estado = ?, usuario_name = ?, justificacionRechazo = ?, fechaAutorizacion = ?, fechaCaptura = ? where id_movimiento = ?',
            ["negro1", Auth::user()->name,$observacion,$user_Fecha,"En espera de captura", $fomope->id_movimiento]
        );

    }

            $insert = DB::insert(
            'insert into rechazos (id_movimiento,justificacionRechazo,usuario,fechaRechazo) values (?,?,?,?)',                
            [$fomope->id_movimiento,$observacion, Auth::user()->usuario, $mytime->toDateString()]
        );    

            $insert = DB::insert(
            'insert into historial (id_movimiento,usuario,fechaMovimiento,horaMovimiento) values (?,?,?,?)',                
            [$fomope->id_movimiento, Auth::user()->usuario, $mytime->toDateString(),  $mytime->toTimeString()]
        );

        $banderaRechazo="true";
    

    }else{
        $banderaRechazo="false";
    }

    return view('DSPO.autorizaDSPO',compact('banderaRechazo'));
    }



}
