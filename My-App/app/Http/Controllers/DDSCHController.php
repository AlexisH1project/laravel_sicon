<?php

namespace App\Http\Controllers;

use App\Fomope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DDSCHController extends Controller
{
    public function autorizaDDSCH(){

        //$Fomope = DB::table('fomope')->get();
        return view('DDSCH.autorizaDDSCH');
    }

    public function capDDSCH(){

        //$Fomope = DB::table('fomope')->get();
        return view('DDSCH.capDDSCH');
    }

    public function actualizarFecha(){

        //$Fomope = DB::table('fomope')->get();
        return view('DDSCH.actualizarFecha');
    }
    public function guardarVistaEventuales(){

        //$Fomope = DB::table('fomope')->get();
        return view('DDSCH.guardarVistaEventuales');
    }
    public function qrtxt(){

        //$Fomope = DB::table('fomope')->get();
        return view('DDSCH.qrtxt');
    }

    public function getFomopeTable(Request $request){
        $rfcBuscar = $request->get('rfc');
        $qnaBuscar = $request->get('qnaOption');
        $anioBuscar = $request->get('anio');
        $nombreBuscar = $request->get('nombreBus');
        $apellidoBuscar = $request->get('apellidoBus');
	    $apellidomBuscar = $request->get('apellidoMb');
        $unidadBuscar = $request->get('unidadBus');

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
        return view('DDSCH.autorizaDDSCH', compact('fomope'));
    }
}
