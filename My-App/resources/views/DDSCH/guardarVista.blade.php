@extends('adminlte::page')

@section('title', 'Guardar Vista')

@section('content_header')
<div class="header">
    <center>
    <h3>Sistema de Control de Registro de Formato de Movimiento de Personal</h3>
 <h5>Departamento Dirección General de Recursos Humanos y Organización/Dirección integral de puestos y servicios personales</h5>
    </center>
</div>
	
@stop

@section('content')
@foreach ($Fomope as $Fomopes)

<h3>{{$Fomopes->color_estado}}</h3>
@endforeach
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('css/content_header.css') }}">
@stop