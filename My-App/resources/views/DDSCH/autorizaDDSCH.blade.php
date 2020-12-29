@extends('layouts.adminlte')
@section('css')
<link rel="stylesheet" href="{{url('css\autorizaDDSCH.css')}}">    
@endsection


@section('content')
<div class="CapturarFomope">
    <button type="button" onclick="location.href='{{ route('blancoDDSCH') }}'" class="btn-sicon text-center">Capturar Fomope</button>

  </div>

<div class="bgsand" style="background: #F2EBD7">
    <form method="POST" action="{{route('getFomopeTable')}}"> 
        @csrf
        <input type='hidden' name='redirect' class='btn btn btn-success text-white bord' value='autorizaDDSCH'>
        <div class="plantilla-inputv text-center">
            <div class="form-row">
                <div class="col">
                    <div class="form-group col-md-12">

                        <label class="plantilla-label" for="elRfc">*RFC:</label>
                        <input type="text" class="form-control border-dark" id="rfc" name="rfc" placeholder="Ingresa rfc" maxlength="13"  >
                    
                    </div>
                </div>

                <div class="col">

                    <div class="form-group col-md-12">

                        <label  class="plantilla-label" for="laQna">*QNA: </label>    
                            <select class="form-control custom-select border-dark" name="qnaOption">
                               
                                <option  data-subtext=""></option>
                                      
                                </select>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group col-md-12">

                        <label  class="plantilla-label" for="elAnio">AÑO: </label>  
                            <select class="form-control custom-select border-dark" name="anio">
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

                  <!--  <input type="submit" name="buscar" onclick="" class="btn-sicon" value="Buscar"><br> -->
                     <button type="submit" name="buscar" class="btn btn-outline-info tamanio-button">Buscar</button> 
              
              </div>
            </div>
            </div>
        </div>
    </form>  
</div>
</div>

<div>
@if(!empty($fomope))
<br>
<div class="card bg-secondary text-white">
    <div class="card-body plantilla-inputg text-center"><h2>Busqueda</h2></div>
    </div>
<div class="card-body table-responsive p-0" style="height: 400px;">
    <table class="table table-head-fixed table-bordered table-hover">
      <thead class="thead-light">
        <tr>
            <th scope="titulo">Estado Fomope</th>
            <th scope="titulo">Unidad</th>
            <th scope="titulo">RFC</th>
            <th scope="titulo">QNA</th>
            <th scope="titulo">Fecha de Ingreso</th>
            <th scope="titulo">Codigo Mov.</th>
            <th scope="titulo">Fecha Autorización</th>
            <th scope="titulo">Fecha de Captura</th>
        </tr>
      </thead>
      <tbody>

@foreach ($fomope as $busqueda)
<tr>
    <td>{{getEstadoFomope($busqueda->color_estado)}}</td>
	<td>{{$busqueda->unidad}}</td>
	<td>{{$busqueda->rfc}}</td>
	<td>{{$busqueda->quincenaAplicada}}</td>
	<td>{{$busqueda->fechaIngreso}}</td>
	<td>{{$busqueda->codigoMovimiento}}</td>
	<td>{{$busqueda->fechaAutorizacion}}</td>
  <td>{{$busqueda->fechaCaptura}}</td>
  <td>
	@if(strcmp($busqueda->color_estado,"negro")==0)
            <button type="button" class="btn btn-outline-secondary" onclick="" id="" >Editar</button>
  @elseif(strcmp($busqueda->color_estado,"verde2")==0)
            <button type="button" class="btn btn-outline-secondary" onclick="" id="" >Ver</button>
  @elseif(strcmp($busqueda->color_estado,"verde")==0)
            <button type="button" class="btn btn-outline-secondary" onclick="" id="" >Capturar</button>
  @elseif(strcmp($busqueda->color_estado,"gris")==0)
            <button type="button" class="btn btn-outline-secondary" onclick="" id="" >Editar</button>
  @elseif(strcmp($busqueda->color_estado,"amarillo0")==0)
            <button type="button" class="btn btn-outline-secondary" onclick="" id="" >Ver</button>	
  @endif                         
  </td>
</tr>
@endforeach    
      </tbody>
    </table>
  </div>
</div>
    
@endif

<div class="card bg-secondary text-white">
    <div class="card-body plantilla-inputg text-center"><h2>Autorizar</h2></div>
    </div>
@php                    
$fomopeAutorizar = DB::table('fomope')->where('color_estado', 'like', 'amarillo0')->orWhere('color_estado', 'like', 'verde2')->get();	  				
@endphp

<div class="card-body table-responsive p-0" style="height: 400px;">
    <table class="table table-head-fixed table-bordered table-hover">
      <thead class="thead-light">
        <tr>
          <th scope="titulo">Autorizar</th>
            <th scope="titulo">Estado Fomope</th>
            <th scope="titulo">Unidad</th>
            <th scope="titulo">RFC</th>
            <th scope="titulo">QNA</th>
            <th scope="titulo">Fecha de Ingreso</th>
            <th scope="titulo">Codigo Mov.</th>
            <th scope="titulo">Fecha Autorización</th>
            <th scope="titulo">Fecha de Captura</th>
        </tr>
      </thead>
      <tbody>

@foreach ($fomopeAutorizar as $busqueda)
<tr>
  <td>
    <form method="POST" action="{{route('autorizacionFomope')}}"> 
      @csrf
    <div class="custom-control custom-radio">
      <label><input type="checkbox" value="{{$busqueda->id_movimiento}}" name="fomope[]"></label>
    </div>
  </td>
  <td>{{getEstadoFomope($busqueda->color_estado)}}</td>
	<td>{{$busqueda->unidad}}</td>
	<td>{{$busqueda->rfc}}</td>
	<td>{{$busqueda->quincenaAplicada}}</td>
	<td>{{$busqueda->fechaIngreso}}</td>
	<td>{{$busqueda->codigoMovimiento}}</td>
	<td>{{$busqueda->fechaAutorizacion}}</td>
  <td>{{$busqueda->fechaCaptura}}</td>
  <td>
    @if(strcmp($busqueda->color_estado,"amarillo0")==0)
              <button type="button" class="btn btn-outline-secondary" onclick="" id="" >Ver</button>
    @elseif(strcmp($busqueda->color_estado,"verde2")==0)
              <button type="button" class="btn btn-outline-secondary" onclick="" id="" >Ver</button>
    @endif                         
    </td>
</tr>
@endforeach    
      </tbody>
    </table>
  </div>
  <button type="submit" name="" class="btn btn-outline-info tamanio-button">Autorizar</button> 
</form> 
  <div class="card bg-secondary text-white">
    <div class="card-body plantilla-inputg text-center"><h2>Rechazados</h2></div>
    </div>
  @php                    
$fomopeRechazados = DB::table('fomope')->where('color_estado', 'like', 'gris')->orWhere('color_estado', 'like', 'negro')->get();	  				
@endphp

<div class="card-body table-responsive p-0" style="height: 400px;">
    <table class="table table-head-fixed table-bordered table-hover">
      <thead class="thead-light">
        <tr>
            <th scope="titulo">Estado Fomope</th>
            <th scope="titulo">Unidad</th>
            <th scope="titulo">RFC</th>
            <th scope="titulo">QNA</th>
            <th scope="titulo">Fecha de Ingreso</th>
            <th scope="titulo">Codigo Mov.</th>
            <th scope="titulo">Fecha Autorización</th>
            <th scope="titulo">Fecha de Captura</th>
        </tr>
      </thead>
      <tbody>

@foreach ($fomopeRechazados as $busqueda)
<tr>
    <td>{{getEstadoFomope($busqueda->color_estado)}}</td>
	<td>{{$busqueda->unidad}}</td>
	<td>{{$busqueda->rfc}}</td>
	<td>{{$busqueda->quincenaAplicada}}</td>
	<td>{{$busqueda->fechaIngreso}}</td>
	<td>{{$busqueda->codigoMovimiento}}</td>
	<td>{{$busqueda->fechaAutorizacion}}</td>
  <td>{{$busqueda->fechaCaptura}}</td>
  <td>
    @if(strcmp($busqueda->color_estado,"gris")==0)
              <button type="button" class="btn btn-outline-secondary" onclick="" id="" >Editar</button>
    @elseif(strcmp($busqueda->color_estado,"negro")==0)
              <button type="button" class="btn btn-outline-secondary" onclick="" id="" >Editar</button>
    @endif                         
    </td>
</tr>
@endforeach    
      </tbody>
    </table>
  </div>

<div class="card bg-secondary text-white">
<div class="card-body plantilla-inputg text-center"><h2>Por Escanear</h2></div>
</div>
  @php                    
$fomopeEscanear = DB::table('fomope')->where('color_estado', 'like', 'verde')->get();	  				
@endphp
<div class="card-body table-responsive p-0" style="height: 400px;">
    <table class="table table-head-fixed table-bordered table-hover">
      <thead class="thead-light">
        <tr>
            <th scope="titulo">Estado Fomope</th>
            <th scope="titulo">Unidad</th>
            <th scope="titulo">RFC</th>
            <th scope="titulo">QNA</th>
            <th scope="titulo">Fecha de Ingreso</th>
            <th scope="titulo">Codigo Mov.</th>
            <th scope="titulo">Fecha Autorización</th>
            <th scope="titulo">Fecha de Captura</th>
        </tr>
      </thead>
      <tbody>

@foreach ($fomopeEscanear as $busqueda)
<tr>
    <td>{{getEstadoFomope($busqueda->color_estado)}}</td>
	<td>{{$busqueda->unidad}}</td>
	<td>{{$busqueda->rfc}}</td>
	<td>{{$busqueda->quincenaAplicada}}</td>
	<td>{{$busqueda->fechaIngreso}}</td>
	<td>{{$busqueda->codigoMovimiento}}</td>
	<td>{{$busqueda->fechaAutorizacion}}</td>
  <td>{{$busqueda->fechaCaptura}}</td>
  <td>
    @if(strcmp($busqueda->color_estado,"verde")==0)
              <button type="button" class="btn btn-outline-secondary" onclick="" id="" >Capturar</button>
    @endif                         
    </td>
</tr>
@endforeach    
      </tbody>
    </table>
  </div>


@endsection