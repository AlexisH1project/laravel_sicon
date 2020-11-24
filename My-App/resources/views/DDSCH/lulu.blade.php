@extends('adminlte::page')

@section('title', 'Bandeja')

@section('content_header')
    <h1>Bandeja</h1>
@stop

@section('content')
@foreach ($Fomope as $Fomopes)

<h3>{{$Fomopes->color_estado}}</h3>
@endforeach
@stop

