<?php

use illuminate\http\Request;

function getEstadoFomope($request){
    $estadoF=$request; 
    if(strcmp($request,"negro1") == 0){
        $estadoF = "DDSCH Rechazo";

    }elseif(strcmp($request,"negro")==0){
        $estadoF = "Unidad Edición";

    }elseif(strcmp ($request,"amarillo")==0){
        $estadoF = "DSPO captura";
        
    }elseif(strcmp ($request,"amarillo0")==0){
        $estadoF = "DDSCH Autorización";
        
    }elseif(strcmp ($request,"cafe")==0){
        $estadoF = "DSPO Autorización";
        
    }elseif(strcmp ($request,"naranja")==0){
        $estadoF = "DIPSP Autorización";
        
    }elseif(strcmp ($request,"azul")==0){
        $estadoF= "DGRHO Autorización";
        
    }elseif(strcmp ($request,"rosa")==0){
        $estadoF = "DSPO nomina";
        
    }elseif(strcmp ($request, "verde" ) == 0){
        $estadoF = "DDSCH loteo";
        
    }elseif(strcmp ($request, "verde2" ) == 0){
        $estadoF = "DDSCH Autorización Loteo";
        
    }elseif(strcmp ($request, "gris" ) == 0){
        $estadoF = "DDSCH Edición";
        
    }elseif(strcmp ($request, "guinda" ) == 0){
        $estadoF = "Finalizado";
        
    }
    return $estadoF;
}



function buscaArchivoDoc_Mov($rfc, $documento, $apellido_1, $apellido_2, $nombre, $id_movimiento){

					$dir_subida = '../storage/app/public/DOCUMENTOS_MOV/'.$documento."/";
					$dir_subidaMov = '../storage/app/public/DOCUMENTOS_MOV/'.$documento."/";
					$asiganarRutaDoc = '../storage/app/public/DOCUMENTOS_MOV/'.$documento."/";

					// Arreglo con todos los nombres de los archivos
					$files = array_diff(scandir($dir_subida), array('.', '..')); 
					$ruta = $dir_subidaMov;
					$index=0;

					if(is_dir($ruta)) {
                    if($dir = opendir($ruta)) {
                    while(($archivo = readdir($dir)) !== false) {    
                    if($archivo != '.' && $archivo != '..') {   
                    if (is_dir($ruta.$archivo)) {                
                    $leercarpeta = $ruta.$archivo. "/";
                    if(is_dir($leercarpeta)){
                    if($dir2 = opendir($leercarpeta)){
                    while(($archivo2 = readdir($dir2)) !== false){
                    if($archivo2 != '.' && $archivo2 != '..') {
                    
                    $datosPDF[$index]= $archivo2;
                    echo $datosPDF[$index];
                    $index++;

	                } }                   
                    closedir($dir2);
                    } }
                    } } }
                    closedir($dir);
                    } }
                         $nombreAdescargar[]="";
                    									$i=0;
												foreach($files as $file){	
													$data = explode("_",$file);
													$conId[$i] = count($data);
												    $data2 = explode(".",$file);
													$indice = count($data2);	
                                                    $extencion = $data2[$indice-1];
                                                    
                                                    // Nombre del archivo
                                                    
												    $extractRfc = $data[0];
												    $extractDoc = $data[1];
											 		if($rfc == $extractRfc && $documento == strtolower($extractDoc)){
											 		
											 			if($conId[$i] == 7){
											 				$nombreAdescargar[$i] = $data[0]."_".$data[1]."_".$data[2]."_".$data[3]."_".$data[4]."_".$data[5]."_."."$extencion";
											 			}elseif($conId[$i] == 8){
                                                            $nombreAdescargar[$i] = $data[0]."_".$data[1]."_".$data[2]."_".$data[3]."_".$data[4]."_".$data[5]."_".$data[6]."_."."$extencion";
											 			}else{
                                                            $nombreAdescargar[$i] = $data[0]."_".$data[1]."_".$data[2]."_".$data[3]."_".$data[4]."_."."$extencion";
                                                         }					
														}
                                            $i++;
                                                  }

                    return $nombreAdescargar;

}