@extends('layouts.adminlte')
@extends('layouts.librerias')

@section('content')
<!-- <link rel = "stylesheet" href= "{{ asset('css/jquery/jquery-ui.min.css') }}"> -->
<body>
    <!-- <form> -->
    <form  enctype="multipart/form-data" id="formDatos" name="captura1" action="{{route('guardar.doc')}}" method="post"> 
			@csrf
                    <div class="form-row">
                        <div class="col">
								<div class="form-group col-md-12">
                                    <label class="plantilla-label" for="elRfc">*RFC:</label>
                                    <input type="text" class="form-control border border-dark" id="rfc" name="rfc"  value="@if(!empty($rfc)){{$rfc}}@endif" placeholder="RFC" placeholder="Ingresa rfc" maxlength="13" required>
                                </div>
						<div class="form-group col-md-12">
							<div class="box" >
								<label  class="plantilla-label" for="arch">Movimientos: </label>
								<select class="form-control border border-dark"  id="movFecha" name="movFecha">
								@if(!empty($movimiento))
									<option value="{{$movimiento}}"> @if(!empty($movimientoAll)){{$movimientoAll}}@endif</option>
								@endif
								</select>
							</div>
						</div>
						
						@if(!empty($Documents))
   								<input id="Docs" name="Docs" type="hidden" value="{{$Documents}}">
							@endif

								<div class="form-group col-md-12">
									<div class="box" >
									<label  class="plantilla-label" for="arch">Nombre del archivo: </label>
									<select class="form-control border border-dark custom-select" name="documentoSelect">
										@foreach($listDoc as $doc)
											<option value="{{$doc->documentos}}"> {{$doc->nombre_documento}} </option>
										@endforeach
									</select>
									</div>
								</div>
						</div>
						<div class="col">
				  			<div class="col">
				  			<label  class="plantilla-label" for="nombreT">NOMBRE COMPLETO: </label>
						   <div class="form-group col-md-12">
						        <input type="text" class="form-control border border-dark" id="apellido1" value="@if(!empty($apellido1)){{$apellido1}}@endif" name="apellido1" placeholder="Apellido Paterno" maxlength="30" required>
						      </div>
						    </div>
						    <div class="col">
						     <div class="form-group col-md-12">
						        <input type="text" class="form-control border border-dark" id="apellido2" value="@if(!empty($apellido2)){{$apellido2}}@endif" name="apellido2" placeholder="Apellido Materno" value="<?php if(isset($_POST["apellido2"])){ echo $_POST["apellido2"];} ?>" maxlength="30"required>
						      </div>
						    </div>
						    <div class="col">
						     <div class="form-group col-md-12">
						        <input type="text" class="form-control border border-dark" id="nombre" value="@if(!empty($nombre)){{$nombre}}@endif" name="nombre" placeholder="Nombre" maxlength="40" value="<?php if(isset($_POST["nombre"])){ echo $_POST["nombre"];} ?>" required>
						      </div>
						    </div>
						<br>
						<div class="form-group">
						    <label  class="plantilla-label" for="archivo_1">Adjuntar un archivo</label>
						    <input type="file" id="nameArchivo" name="nameArchivo" required>
						  </div>
						</div>
						<div class="form-group col-md-12">
							<div class="col text-center">
								<div class="columnaBoton">
    			                    <input type="submit" class="btn btn btn-danger tamanio-button plantilla-input text-white bord" value="Guardar" name="botonAccion">   
								</div>
							</div>
						</div>
					</div>           
	</form>
	<form enctype="multipart/form-data" method="GET" action="{{route('General.guardarVista')}}" >
		<div class="form-group col-md-12">
			<div class="col text-center">
				<div class="columnaBoton">
					<input type="submit" class="btn btn-secondary"  value="Borrar" name="botonBorrar">   
				</div>
			</div>
		</div>
	</form>


	

<div class="card-body table-responsive p-0" style="height: 400px;">
    <table class="table table-head-fixed table-bordered table-hover">  
      <tbody>
@foreach ($listDoc as $doc)
<tr>
    <td>{{$doc->nombre_documento}}</td>	
	@if(!empty($Documents))
	@if(strpos($Documents,$doc->documentos) !== false)
	<td><button class="btn btn-success" > ✔ </button></td>
	@elseif(strpos($Documents,$doc->documentos) !== true)
	<td><button class="btn btn-danger" > X </button></td>
	@endif
	@elseif(empty($Documents))
	<td><button class="btn btn-danger" > X </button></td>
	@endif

</tr>
@endforeach 

      </tbody>
    </table>
  </div>

    <script type="text/javascript">
		var msg = '{{Session::get('alert')}}';
		var exist = '{{Session::has('alert')}}';
		if(exist){
			alert(msg);
		}

        $(document).ready(function () { 
            $('#rfc').autocomplete({
                source: function(request, response){
                    $.ajax({
						url:"{{ route('Serch.rfc')}}",
                        dataType:'json',
                        data:{
                            term: request.term
                        },
                        success: function(data){
                            response(data)
                        }
                    });
                },select: function (event, ui){
							$(this).val(ui.item.label);
							var request = ui.item.value;
							console.log(request);
							//alert(buscarid);
							$.ajax({
								url: "{{ route('Serch.Crfc')}}",
								dataType: 'json',
								data: {
									term2: request									
								},
								success: function(data){
									var infEmpleado = eval(data);
									console.log(data);
								    //   console.log(infEmpleado.length);
                                    //document.getElementById("rfc").value = infEmpleado[1] ;
									document.getElementById("apellido1").value = infEmpleado[0].apellido1 ;
									document.getElementById("apellido2").value = infEmpleado[0].apellido2 ;
									document.getElementById("nombre").value = infEmpleado[0].nombre ;
									// $("#movFecha option[value='X']").remove();
								  for(var i=1; i < infEmpleado.length; i++){ 
								        console.log(infEmpleado[i]);
									    if(infEmpleado[i].id != null){
											var miSelect2 = document.getElementById("movFecha");
											var aTag = document.createElement('option');
											aTag.setAttribute('value',infEmpleado[i].id);
											aTag.innerHTML = "( Codigo: "+infEmpleado[i].codigo+" ) ( Fecha: "+infEmpleado[i].fecha+" ) (Qna: "+infEmpleado[i].qna+") (Año: "+infEmpleado[i].anio+" )";
											miSelect2.appendChild(aTag);
										}else{
											// var miSelect2 = document.getElementById("movFecha");
											$('#movFecha').empty().append('<option selected="selected" value="x"></option>');
										}
									}
								}
							});
							return false;
						}
            });
        });

        </script>

</body>
@endsection


