@extends('layouts.adminlte')
@section('content')

<center>
<br>
<div class="col-md-8 col-md-offset-8 ">
    <!-- <form name="captura2" action="./Controller/agregarNewRegistro.php" method="POST">  -->

    <form  enctype="multipart/form-data" id="formDatos" name="captura1" action="" method="POST"> 
             <div class="form-row">
                <input type="text" class="form-control" id="botonAccion" name="botonAccion" value="" style="display:none">
                <input type="text" class="form-control" id="guardarDoc" name="guardarDoc" value="" style="display:none">
            </div> 
            <div class="form-row">
                <div class="form-group col-md-12" >
                    <label class="plantilla-label estilo-colorg" for="unexp_1">Unidad:</label>
                    <input onkeypress="" type="text" class="form-control unexp border border-dark" id="unexp_1" name="unexp_1" placeholder="Ej. 513" value="" onkeyup="" required>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                  <div class="md-form mt-0">
                   <label class="plantilla-label estilo-colorg" for="rfcL_1" >RFC: </label>
                    <input type="text"  type="text" class="form-control rfcL border border-dark" id="rfcL_1" name="rfcL_1" placeholder="RFC" value=""  onkeyup="" placeholder="Ingresa rfc" maxlength="13"  required>
                  </div>
                </div>

                <div class="col">
                  <div class="md-form mt-0">
                    <label class="plantilla-label estilo-colorg" for="CURP">CURP: </label>
                        <input type="text" class="form-control border border-dark" id="curp" name="curp" placeholder="Ingresa CURP" value="" maxlength="18"  required>
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
                    <input type="text" class="form-control border border-dark" id="apellido1" name="apellido1" placeholder="Apellido Paterno" value="" maxlength="30"required>
                  </div>
                </div>

                <div class="col">
                  <div class="md-form mt-0">
                    <input type="text" class="form-control border border-dark" id="apellido2" name="apellido2" placeholder="Apellido Materno" value="" maxlength="30"required>
                  </div>
                </div>

                <div class="col">
                  <div class="md-form mt-0">
                    <input type="text" class="form-control border border-dark" id="nombre" name="nombre" placeholder="Nombre" maxlength="40" value="" required>
                  </div>
                </div>
            </div>
    </div>
    <div class="col-md-4 col-md-offset-4">

              <div class="form-group col-md-8" >
                  <label class="plantilla-label estilo-colorg" for="fechaIngreso"> FECHA DE RECIBIDO: </label>
                <input type="date" class="form-control border border-dark" id="fechaIngreso" name="fechaIngreso" placeholder="Ingresa Fecha del ingreso" value="" required>
                
              </div>
          <div class="form-row">
        <div class="form-group col-md-6">
                <div class="text-center">
                    <label class="plantilla-label estilo-colorg" for="del2">*Del:</label>
                </div>
                    <input type="date" class="form-control border border-dark" id="del2" name="del2" placeholder="Del" value="" required>

                </small> 
            </div>
            <div class="form-group col-md-6">
                <div class="text-center">
                    <label class="plantilla-label estilo-colorg" for="al3">al:</label>
                </div>
            <input  type="date" class="form-control border border-dark" id="al3" name="al3" value="" placeholder="al" requiered> <!--required-->
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
           <input type="submit" name="guardarAdj" onclick="" class="btn btn-outline-info tamanio-button" value="Guardar Documento"><br>
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
	<td><button class="btn btn-danger" > X </button></td>
</tr>
@endforeach    
      </tbody>
    </table>
  </div>
</center>
@endsection