@extends('layouts.adminlte')
@extends('layouts.librerias')

@section('content')
<!-- <link rel = "stylesheet" href= "{{ asset('css/jquery/jquery-ui.min.css') }}"> -->
<body>
    <form>
    <!-- <form  enctype="multipart/form-data" id="formDatos" name="captura1" action="" method="POST">  -->
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group col-md-4">
                                    <label class="plantilla-label" for="elRfc">*RFC:</label>
                                    
                                    <input type="text" class="form-control" id="rfc" name="rfc" placeholder="RFC" placeholder="Ingresa rfc" maxlength="13" required>
                                    
                                    <div id="countryList">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="button" class="" value="Aceptar" name="botonAccion">              
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
							var buscarid = ui.item.value;
							console.log(buscarid);
							//alert(buscarid);
							$.ajax({
								url: "{{ route('Serch.Crfc')}}",
								dataType: 'json',
								data: {
									term2: buscarid.term2									
								},
								success: function(data){
									var infEmpleado = eval(data);
									console.log(data);
									console.log(infEmpleado[0].apellido1);
								    //   console.log(infEmpleado.length);

                                      //document.getElementById("rfc").value = infEmpleado[1] ;


								// 	document.getElementById("apellido1").value = infEmpleado[0].apellido1 ;
								// 	document.getElementById("apellido2").value = infEmpleado[0].apellido2 ;
								// 	document.getElementById("nombre").value = infEmpleado[0].nombre ;
									
								//   for(var i=1; i < infEmpleado.length; i++){ 
								//         console.log(infEmpleado[i]);
								// 	    if(infEmpleado[i].id != null){

								//         var miSelect2 = document.getElementById("movFecha");
								// 	    var aTag = document.createElement('option');
								// 	    aTag.setAttribute('value',infEmpleado[i].id);
								// 	    aTag.innerHTML = "( Codigo: "+infEmpleado[i].codigo+" ) ( Fecha: "+infEmpleado[i].fecha+" ) (Qna: "+infEmpleado[i].qna+") (Año: "+infEmpleado[i].anio+" )";
								// 	    miSelect2.appendChild(aTag);
								// 		}
								// 	}


								}
							});
							return false;
						}
            });
        });


        </script>

</body>
@endsection


