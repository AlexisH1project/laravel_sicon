@extends('layouts.adminlte')

@section('content')
    <center><h1 class="display-1">Bienvenido {{Auth::user()->name}}</h1></center>
@endsection