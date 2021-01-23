@extends('layouts.adminlte')

@section('content')
<center>
<br>
<h3>Consulta de Estado FOMOPE</h3>
<br>
<form method="POST" action="{{route('getFomopeTable')}}">
    @csrf
    <input type='hidden' name='redirect' class='btn btn btn-success text-white bord' value='consultaEstado'> 
    <div class="plantilla-input text-center">
        <div class="form-row">
            <div class="col">
                <div class="form-group col-md-12">
                    <label class="plantilla-labe estilo-colorg" for="elRfc">RFC:</label>
                    <input type="text" class="form-control border-dark" id="rfc" name="rfc" value=""maxlength="13">
                </div>
        
            </div>
            <div class="col">
                <div class="form-group col-md-12">
                    <label class="plantilla-label estilo-colorg" for="nombreB">Nombre:</label>
                    <input type="text" class="form-control border-dark" id="nombreBus" name="nombreBus" value="" maxlength="40">
                </div>

            </div>
            <div class="col">
                <div class="form-group col-md-12">
                    <label class="plantilla-label estilo-colorg" for="apellidoB">Apellido Paterno:</label>
                    <input type="text" class="form-control border-dark" id="apellidoBus" name="apellidoBus" value="" maxlength="30">
                </div>

            </div>
            <div class="col">
                <div class="form-group col-md-12">
                    <label class="plantilla-label estilo-colorg" for="apellidoM">Apellido Materno:</label>
                    <input type="text" class="form-control border-dark" value="" id="apellidoMb" name="apellidoMb" maxlength="30">
                </div>

            </div>
            <div class="col">
                <div class="form-group col-md-12">
                    <label class="plantilla-label estilo-colorg" for="unidadB">Unidad:</label>
                    <input type="text" class="form-control unexp border border-dark" id="unidadBus" value="" name="unidadBus" maxlength="60">
                </div>

            </div>
            <div class="col">

                <div class="form-group col-md-12">
                    <label  class="plantilla-label estilo-colorg" for="qnaOption">QNA: </label>
                         
                        <select class="form-control border-dark" name="qnaOption">
                         
                            <option  data-subtext=""></option>        
                            </select>
                </div>
            </div>
            <div class="col">

                <div class="form-group col-md-12">
                    <label  class="plantilla-label estilo-colorg" for="anio">Año: </label>
                        <select class="form-control border-dark" name="anio">									
                          <option value=""></option>
                          <option value="2019">2019</option>
                          <option value="2020">2020</option>
                          <option value="2021">2021</option>
                        </select>	
                </div>
            </div>
        </div>

    <div class="col-sm-12">
        <div class="form-row">

        <div class="form-group col-md-12">
            <div class="col text-center">
                    <input type="submit" name="buscar" onclick="" class="btn btn btn-danger tamanio-button plantilla-input text-white bord" value="Buscar">
                <br>
            </div>
        </div>

        </div>
    </div>
</form>

<div class="form-group col-md-12">
            <div class="col text-center">
                    <button type="button" onclick="location.href='{{ route('General.consultaEstado') }}'" class="btn btn-secondary" name="borrar" value="Borrar">Borrar</button>  
            </div>
        </div>

@if(!empty($fomope))
<br>
<div class="card bg-secondary text-white">
    <div class="card-body plantilla-inputg text-center"><h2>Consulta</h2></div>
    </div>
<div class="card-body table-responsive p-0" style="height: 400px;">
    <table class="table table-head-fixed table-bordered table-hover">
      <thead class="thead-light">
        <tr>
            <th scope="titulo">RFC</th>
            <th scope="titulo">Estado Fomope</th>
            <th scope="titulo">Unidad</th>
            <th scope="titulo">Última modificación</th>
            <th scope="titulo">Movimiento</th>
            <th scope="titulo">Entrega operados a la unidad</th>
            <th scope="titulo">Entrega expediente relaciones laborales</th>
            <th scope="titulo">Envio a validación</th>
            <th scope="titulo">Envio a validación</th>

        </tr>
      </thead>
      <tbody>

@foreach ($fomope as $busqueda)
<tr>
    <td>{{$busqueda->rfc}}</td>
    <td>{{getEstadoFomope($busqueda->color_estado)}}</td>
	<td>{{$busqueda->unidad}}</td>
	<td>{{$busqueda->quincenaAplicada}}</td>
	<td>{{$busqueda->fechaIngreso}}</td>
	<td>{{$busqueda->codigoMovimiento}}</td>
	<td>{{$busqueda->fechaAutorizacion}}</td>
  <td>{{$busqueda->fechaCaptura}}</td>
  <td>
    <form action = "{{ route('General.verList') }}" method="POST">
        @csrf
        <input type="hidden" name="fomopeVer" value="{{$busqueda->id_movimiento}}">
        <input type="submit" class='btn-secondary' value ="Ver lista de Doc.">
    </form>
                         
  </td>
</tr>
@endforeach    
      </tbody>
    </table>
  </div>
</div>

<br><br>
<form action = "{{ route('General.reporteBusqueda') }}" method="POST">
    @csrf
   @foreach ($fomope as $collecion)
       <input type="hidden" name="fomope[]" value="{{$collecion->id_movimiento}}">
   @endforeach
      <input type="submit" class='btn btn btn-success text-white bord' value ="Generar Excel">
</form>
@endif
</center>
@endsection