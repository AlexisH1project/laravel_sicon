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