<?php

namespace App\Http\Controllers;
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
        return view('DDSCH.blancoDDSCH', compact('Documentos'));
    }

    public function EnviarFomope(Request $request){
        
        $Documentos = DB::table('m1ct_documentos')->get();
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

        DB::table('fomope')
        ->updateOrInsert(
            [
                'unidad' => $unidad,
                'rfc' => $rfc,
                'curp' => $curp,
                'apellido_1' => $apellido1,
                'apellido_2' => $apellido2,
                'nombre' => $nombre
            ],
            [
                'unidad' => $unidad,
                'rfc' => $rfc,
                'curp' => $curp,
                'apellido_1' => $apellido1,
                'apellido_2' => $apellido2,
                'nombre' => $nombre,
                'color_estado' => "amarillo",
                'fechaIngreso' => $fechaIngreso,
                'tipoDeAccion' => "x",
                'justificacionRechazo' => "x",
                'quincenaAplicada' => "x",
                'anio' => "x",
                'oficioUnidad' => "x",
                'codigo' => "x",
                'n_puesto' => "x",
                'usuario_name' => "x"
            ]
        );

        return view('DDSCH.blancoDDSCH', compact('Documentos', 'Documents', 'DocumentoAdd', 'unidad', 'rfc', 'curp', 'apellido1', 'apellido2', 'nombre', 'fechaIngreso', 'del2', 'al3'));
    }

    public function agregarNewFomope(Request $request){
        echo "hola";
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
    $user_Fecha =$mytime->toDateString()." - ". Auth::user()->name;
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
            [$fomope->id_movimiento, Auth::user()->name, $mytime->toDateString(),  $mytime->toTimeString()]
        );

        }
        return view('DDSCH.autorizaDDSCH');
    }
}
