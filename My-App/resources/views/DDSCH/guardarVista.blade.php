@extends('adminlte::page')

@section('title', 'Bandeja')

@section('content_header')
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bordv plantilla-inputv fixed-top">
    <center>
        <div class="container plantilla-inputv " align="center">
      <div class="collapse navbar-collapse" id="navbarResponsive">
          
              <div class="form-row " >
               
        <ul class="navbar-nav ml-auto">          
       
            
            <h3  class="estilo-colorn">Sistema de Control de Registro de Formato de Movimiento de Personal
          </h3>
          <h3  class="estilo-colorv">............
          </h3>
        </ul>

         <ul class="navbar-nav ml-auto">          
      
         <h5 class=" estilo-color">Departamento Dirección General de Recursos Humanos y Organización/Dirección integral de puestos y servicios personales</h5>
        </ul>  
      </div>
      <br>
     
    </div> 
</center>
    <br>
    <br>
  </nav>
@stop

@section('content')
@foreach ($Fomope as $Fomopes)

<h3>{{$Fomopes->color_estado}}</h3>
@endforeach
@stop
