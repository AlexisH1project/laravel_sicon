@extends('layouts.adminlte')
@section('css')
@endsection


@section('content')
<div class="bgsand" style="background: #F2EBD7">
    <form method="POST" action="{{route('DSPO.getFomopeTable')}}"> 
        @csrf
        {{-- Este valor "redirect" debe de cambiar dependiendo de que usuario estas generando  --}}
        <input type='hidden' name='redirect' class='btn btn btn-success text-white bord' value='autorizaDSPO'>
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
    @if(strcmp($busqueda->color_estado,"amarillo")==0)
    <button type="button" class="btn btn-outline-secondary" onclick="mandarFormFomope('{{$busqueda->id_movimiento}}')" id="" >Capturar</button>
    @elseif(strcmp($busqueda->color_estado,"cafe")==0)
    <button type="button" class="btn btn-outline-secondary" onclick="mandarFormFomopeAnalista()" id="" >Autorización</button>
    @elseif(strcmp($busqueda->color_estado,"negro1")==0)
    <button type="button" class="btn btn-outline-secondary" onclick="mandarEditarAnalista()" id="" >Editar</button>
    @elseif(strcmp($busqueda->color_estado,"rosa")==0)
    <button type="button" class="btn btn-outline-secondary" data-toggle="modal"  data-target="#exampleModalN" >Nomina</button>
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
    <div class="card-body plantilla-inputg text-center"><h2>Por autorizar</h2></div>
    </div>
@php                    
$fomopeAutorizar = DB::table('fomope')->where('color_estado', 'like', 'cafe')->get();	  				
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
    <form enctype="multipart/form-data" method="POST" action="{{route('DSPO.autorizacionFomope')}}" name="captura1" id="captura1"> 
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
  <input type="text" class="form-control" id="NFomope" name="NFomope" value="{{$busqueda->id_movimiento}}" style="display:none">
  <td>
   
    @if(strcmp($busqueda->color_estado,"cafe")==0)
    <button type="button" class="btn btn-outline-secondary" onclick="mandarFormFomopeAnalista()" id="" >Autorización</button>
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
    <div class="card-body plantilla-inputg text-center"><h2>Por capturar</h2></div>
    </div>
  @php                    
$fomopeCapturar = DB::table('fomope')->where('color_estado', 'like', 'amarillo')->get();	  				
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

@foreach ($fomopeCapturar as $busqueda)
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
    @if(strcmp($busqueda->color_estado,"amarillo")==0)
    <button type="button" class="btn btn-outline-secondary" onclick="mandarFormFomope('{{$busqueda->id_movimiento}}')" id="" >Capturar</button>                     
  @endif  
  </td>
</tr>
@endforeach    
      </tbody>
    </table>
  </div>

<div class="card bg-secondary text-white">
<div class="card-body plantilla-inputg text-center"><h2>Editar rechazados</h2></div>
</div>
  @php                    
$fomopeEscanear = DB::table('fomope')->where('color_estado', 'like', 'negro1')->get();	  				
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
    @if(strcmp($busqueda->color_estado,"negro1")==0)
    <button type="button" class="btn btn-outline-secondary" onclick="mandarEditarAnalista('{{$busqueda->id_movimiento}}')" id="" >Editar</button>
    @endif                         
    </td>
</tr>
@endforeach    
      </tbody>
    </table>
  </div>

  <div class="card bg-secondary text-white">
    <div class="card-body plantilla-inputg text-center"><h2>Nomina</h2></div>
    </div>
      @php                    
    $fomopeEscanear = DB::table('fomope')->where('color_estado', 'like', 'rosa')->get();	  				
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
        @if(strcmp($busqueda->color_estado,"rosa")==0)
        <button type="button" class="btn btn-outline-secondary" data-toggle="modal"  data-target="#exampleModalN" >Nomina</button>
    @endif                        
        </td>
    </tr>
    @endforeach    
          </tbody>
        </table>
      </div>
  <script type="text/javascript">
    function mandarFormFomope(idmov){
        		var formulario = document.captura1;
                formulario.action= './form_FOMOPE';
			    var a = $("#NFomope").val();
          var b =idmov; 
          console.log(b);
				      	formulario.submit();
			}

    
    
    function mandarFormFomopeAnalista(){
        		var formulario = document.captura1;
        formulario.action= './form_FOMOPEAnalista';
				    var a = $("#NFomope").val(); 
				      	formulario.submit();

			}


    
    
    function mandarEditarAnalista(){
        		var formulario = document.captura1;
        formulario.action= './editarAnalista';
				    var a = $("#NFomope").val(); 
				      	formulario.submit();

			}

    
    
    function mandarAutorizarNomina(){
        		var formulario = document.captura1;
        formulario.action= './autorizarNomina';
				    var a = $("#NFomope").val(); 
				      	formulario.submit();

			}

                         

</script>
@endsection

<div class="modal fade" id="exampleModalN" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
      <div class="modal-body">
        ¿Quieres mandar a lotear el fomope?
      </div>
      <div class="form-row">
      <input type="text" class="form-control" id="idDatosA" name="idDatosA" style="display:none">
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO, Regresar</button>
         <input type="button" id="autorizarNsi" value="SI, Guardar Fecha actual" class="btn btn-primary" onclick="mandarAutorizarNomina()">
      </div>
  </form>
    </div>
  </div>
</div>