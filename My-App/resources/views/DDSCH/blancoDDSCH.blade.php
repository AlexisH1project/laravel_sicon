@extends('layouts.adminlte')
@section('content')

<center>
<br>
<div class="col-md-8 col-md-offset-8 ">
    <!-- <form name="captura2" action="./Controller/agregarNewRegistro.php" method="POST">  -->

    <form  enctype="multipart/form-data" id="formDatos" name="captura1" action="{{route('getFomopeTable')}}" method="POST"> 
        @csrf
             <div class="form-row">
                <input type="text" class="form-control" id="botonAccion" name="botonAccion" value="" style="display:none">
                <input type="text" class="form-control" id="guardarDoc" name="guardarDoc" value="" style="display:none">
            </div> 
            <div class="form-row">
                <div class="form-group col-md-12" >
                    <label class="plantilla-label estilo-colorg" for="unidad">Unidad:</label>
                    <input onkeypress="" type="text" class="form-control unexp border border-dark" id="unidad" name="unidad" placeholder="Ej. 513" value="@if(!empty($unidad)){{$unidad}}@endif" onkeyup="" required>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                  <div class="md-form mt-0">
                   <label class="plantilla-label estilo-colorg" for="rfc" >RFC: </label>
                    <input type="text"  type="text" class="form-control rfcL border border-dark" id="rfc" name="rfc" placeholder="RFC" value="@if(!empty($rfc)){{$rfc}}@endif"  onkeyup="" placeholder="Ingresa rfc" maxlength="13"  required>
                  </div>
                </div>

                <div class="col">
                  <div class="md-form mt-0">
                    <label class="plantilla-label estilo-colorg" for="CURP">CURP: </label>
                        <input type="text" class="form-control border border-dark" id="curp" name="curp" placeholder="Ingresa CURP" value="@if(!empty($curp)){{$curp}}@endif" maxlength="18"  required>
                  </div>
                </div>
            </div>
            <br>
              <div class="form-group col-md-12" >	
                  <label class="plantilla-label estilo-colorg" for="nombreT">NOMBRE COMPLETO: </label>
            </div>

              <div class="form-row">
                  
                  <input type="text" style="display:none;" class="form-control border border-dark" id="listaDoc" name="listaDoc" placeholder="Apellido Paterno" value="" >

                  <div class="col">
                  <div class="md-form mt-0">
                    <input type="text" class="form-control border border-dark" id="apellido1" name="apellido1" placeholder="Apellido Paterno" value="@if(!empty($apellido1)){{$apellido1}}@endif" maxlength="30"required>
                  </div>
                </div>

                <div class="col">
                  <div class="md-form mt-0">
                    <input type="text" class="form-control border border-dark" id="apellido2" name="apellido2" placeholder="Apellido Materno" value="@if(!empty($apellido2)){{$apellido2}}@endif" maxlength="30"required>
                  </div>
                </div>

                <div class="col">
                  <div class="md-form mt-0">
                    <input type="text" class="form-control border border-dark" id="nombre" name="nombre" placeholder="Nombre" maxlength="40" value="@if(!empty($nombre)){{$nombre}}@endif" required>
                  </div>
                </div>
            </div>
    </div>
    <div class="col-md-4 col-md-offset-4">

              <div class="form-group col-md-8" >
                  <label class="plantilla-label estilo-colorg" for="fechaIngreso"> FECHA DE RECIBIDO: </label>
                <input type="date" class="form-control border border-dark" id="fechaIngreso" name="fechaIngreso" placeholder="Ingresa Fecha del ingreso" value="@if(!empty($fechaIngreso)){{$fechaIngreso}}@endif" required>
                
              </div>
          <div class="form-row">
        <div class="form-group col-md-6">
                <div class="text-center">
                    <label class="plantilla-label estilo-colorg" for="del2">*Del:</label>
                </div>
                    <input type="date" class="form-control border border-dark" id="del2" name="del2" placeholder="Del" value="@if(!empty($del2)){{$del2}}@endif" required>

                </small> 
            </div>
            <div class="form-group col-md-6">
                <div class="text-center">
                    <label class="plantilla-label estilo-colorg" for="al3">al:</label>
                </div>
            <input  type="date" class="form-control border border-dark" id="al3" name="al3" value="@if(!empty($al3)){{$al3}}@endif" placeholder="al" requiered> <!--required-->
            </div>
        </div>
              <div class="form-group col-md-12" >	
                  <label class="plantilla-label estilo-colorg" for="TipoEntregaArchivo">TIPO DE ENTREGA: </label>
            </div>

              <div class="form-group col-md-12" >
                  <input id="TipoEntregaArchivo" type="radio" name="TipoEntregaArchivo" value="Ninguno" style="display:none" checked >
                <label class="radio-inline"><input id="TipoEntregaArchivo" type="radio" name="TipoEntregaArchivo" value="Fisico" required>Fisico</label>
                <label class="radio-inline"><input id="TipoEntregaArchivo" type="radio" name="TipoEntregaArchivo" value="Digital" required >Digital</label>
                <label class="radio-inline"><input id="TipoEntregaArchivo" type="radio" name="TipoEntregaArchivo" value="Ambos" required >Ambos</label>
              </div> 
    </div>
    <br>
    <div class="col-md-9">

        <div class="form-row">
                    <div class="col">

                                   <select class="form-control border border-dark mdb-select md-form" name="documentoSelct">
                                   @foreach ($Documentos as $doc)
                                   <option value="{{$doc->nombre_documento}}">{{$doc->nombre_documento}}</option>
                                   @endforeach     
                                       </select>  
           </div>		
       </div>

   </div>

   @if(!empty($Documents))
   <input id="Docs" name="Docs" type="hidden" value="{{$Documents}}">
   @endif

   <br><br>
   <div class="col-md-8 col-md-offset-8">
    <div class="form-row">

         <div class="col">
             <div class="md-form md-0">

               <input type="file" id="nameArchivo" name="nameArchivo" required>
 
           </div>
       </div>
   <div class="col">
         <div class="md-form md-0">
            <input type="button" onclick="enviarDatos();" class="btn btn-outline-info tamanio-button" value="Guardar Documento" name="botonAccion"><br>
       </div>	
       <br>
   </div>	
</div>	
</div>


<div class="card-body table-responsive p-0" style="height: 400px;">
    <table class="table table-head-fixed table-bordered table-hover">  
      <tbody>
@foreach ($Documentos as $doc)
<tr>
    <td>{{$doc->nombre_documento}}</td>

    
@if(!empty($Documents))
@if(strpos($Documents,$doc->nombre_documento) !== false)
<td><button class="btn btn-success" > ✔</button></td>
@elseif(strpos($Documents,$doc->nombre_documento) !== true)
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
  <button id="enviarT" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Enviar
   </button>



											<!-- Modal -->
											<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="exampleModalLabel">Confirmar</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                                    <div class="modal-body">
                                                      ¿Estas seguro de enviar esta información?
                                                    </div>
                                      <center>
                                <div class="form-group col-md-8">
                                      <div class="box" >
  
                                          <label  class="plantilla-label estilo-colorg" for="laQna">¿A quien será turnado?</label>
                                                   
                                                  <select class="form-control border border-dark custom-select" name="usuar">
                                                      
                                            
                                                      <option value=""></option>
                                                            
                                                      </select>
                                          </div>
                                           <br>  
  
                                  </div>
                                          </center>
                                                    <div class="modal-footer">
  
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
                                                      <input type="button" onclick="nuevoFomope();" class="btn btn-primary" value="Aceptar" name="botonAccion">
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              
</form>
</center>
<script type="text/javascript">
function enviarDatos(){
				var formulario = document.captura1;
				formulario.action= './blancoDDSCH';
				document.getElementById("botonAccion").value = "Aceptar";

				    var a = $("#unidad").val();
				    var b = $("#rfc").val();
				    var c = $("#curp").val();
				    var d = $("#apellido1").val();
				    var e = $("#apellido2").val();
				    var f = $("#nombre").val();
				    var g = $("#fechaIngreso").val();
				    //var h = $("#TipoEntregaArchivo").val();
				    var i = $("#del2").val();

				     if (b !== '') {
					      var tamRFC = b.length;
					 	if (tamRFC<13){
					    	alert("RFC no valido");
					    }
					 }
					 if (c !== '') {
					      var tamCURP = c.length;
					 	if (tamCURP<18){
					    	alert("CURP no valido");
					    }

					 }
				     var tamCURP = c.length;

				      if (a=="" || tamRFC<13 || tamCURP<18 || d==""|| e==""|| f==""|| g==""|| $('input:radio[name=TipoEntregaArchivo]:checked').val() =="Ninguno" || i=="" ) {
				        alert("Falta completar campo");		
				        return false;
				      } else 
				      	formulario.submit();
		 }

         function nuevoFomope(){
				var formulario = document.captura1;
				formulario.action= './agregarNewFomope';
				document.getElementById("botonAccion").value = "Aceptar";

				    var a = $("#unidad").val();
				    var b = $("#rfc").val();
				    var c = $("#curp").val();
				    var d = $("#apellido1").val();
				    var e = $("#apellido2").val();
				    var f = $("#nombre").val();
				    var g = $("#fechaIngreso").val();
				    //var h = $("#TipoEntregaArchivo").val();
				    var i = $("#del2").val();

				     if (b !== '') {
					      var tamRFC = b.length;
					 	if (tamRFC<13){
					    	alert("RFC no valido");
					    }
					 }
					 if (c !== '') {
					      var tamCURP = c.length;
					 	if (tamCURP<18){
					    	alert("CURP no valido");
					    }

					 }
				     var tamCURP = c.length;

				      if (a=="" || tamRFC<13 || tamCURP<18 || d==""|| e==""|| f==""|| g==""|| $('input:radio[name=TipoEntregaArchivo]:checked').val() =="Ninguno" || i=="" ) {
				        alert("Falta completar campo");		
				        return false;
				      } else 
				      	formulario.submit();
		 }

</script>
@endsection