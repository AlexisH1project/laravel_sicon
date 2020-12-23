@extends('layouts.adminlte')
@extends('layouts.librerias')

@section('content')
<!-- <link rel = "stylesheet" href= "{{ asset('css/jquery/jquery-ui.min.css') }}"> -->
<body>
    <form>
    <!-- <form  enctype="multipart/form-data" id="formDatos" name="captura1" action="" method="POST">  -->
                    <div class="form-row">
                        <div class="col">
								<div class="form-group col-md-12">
                                    <label class="plantilla-label" for="elRfc">*RFC:</label>
                                    <input type="text" class="form-control border border-dark" id="rfc" name="rfc" placeholder="RFC" placeholder="Ingresa rfc" maxlength="13" required>
                                </div>
							<input type="text" style="display:none;" class="form-control border border-dark" id="listaDoc" name="listaDoc" value="<?php if(isset($_POST["listaDoc"])){ echo $_POST["listaDoc"];} ?>" >
							<input type="text" class="form-control" id="guardarDoc" name="guardarDoc" value="<?php if(isset($_POST["guardarDoc"])){ echo $_POST["guardarDoc"];} ?>" style="display:none">
						<div class="md-form md-0">
							<div class="box" >
								<label  class="plantilla-label" for="arch">Movimientos: </label>
								<select class="form-control border border-dark" id="movFecha" name="movFecha">
								</select>
							</div>
						</div>
						</div>
						<div class="col">
				  			<div class="col">
				  			<label  class="plantilla-label" for="nombreT">NOMBRE COMPLETO: </label>
						   <div class="form-group col-md-12">
						        <input type="text" class="form-control border border-dark" id="apellido1" name="apellido1" placeholder="Apellido Paterno" maxlength="30" required>
						      </div>
						    </div>
						    <div class="col">
						     <div class="form-group col-md-12">
						        <input type="text" class="form-control border border-dark" id="apellido2" name="apellido2" placeholder="Apellido Materno" value="<?php if(isset($_POST["apellido2"])){ echo $_POST["apellido2"];} ?>" maxlength="30"required>
						      </div>
						    </div>
						    <div class="col">
						     <div class="form-group col-md-12">
						        <input type="text" class="form-control border border-dark" id="nombre" name="nombre" placeholder="Nombre" maxlength="40" value="<?php if(isset($_POST["nombre"])){ echo $_POST["nombre"];} ?>" required>
						      </div>
						    </div>
						    	<div class="form-group">
						    <label  class="plantilla-label" for="archivo_1">Adjuntar un archivo</label>
						    <input type="file" id="nameArchivo" name="nameArchivo" required>
						  </div>
						</div>
                        <input type="button" class="" value="Aceptar" name="botonAccion">   
					</div>           
	</form>

    <script type="text/javascript">
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
									
								  for(var i=1; i < infEmpleado.length; i++){ 
								        console.log(infEmpleado[i]);
									    if(infEmpleado[i].id != null){
											var miSelect2 = document.getElementById("movFecha");
											var aTag = document.createElement('option');
											aTag.setAttribute('value',infEmpleado[i].id);
											aTag.innerHTML = "( Codigo: "+infEmpleado[i].codigo+" ) ( Fecha: "+infEmpleado[i].fecha+" ) (Qna: "+infEmpleado[i].qna+") (Año: "+infEmpleado[i].anio+" )";
											miSelect2.appendChild(aTag);
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


