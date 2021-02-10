@extends('layouts.adminlte')

@section('content')	
         <form enctype="multipart/form-data" id="formDatos" name="captura1" action="{{route('DDSCH.updateNegro')}}" method="POST">
            @csrf 
            <div class="form-row">
                <input type="text" class="form-control" id="idFom" name="idFom" value="{{$fomope->id_movimiento}}" style="display:none">
            </div>

            <div class="form-row">
                <div class="form-group col-md-12" >
                    <label class="plantilla-label estilo-colorg" for="unexp_1">Unidad:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="unexp_1" name="unexp_1" placeholder="Ej. 111" value="{{$fomope->unidad}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                </div>
            </div>

            <div class="form-row">
                
                <div class="col">
                  <div class="md-form mt-0">
                   <label class="plantilla-label estilo-colorg" for="rfcL_1" >RFC: </label>
                    <input type="text"  type="text" class="form-control rfcL border border-dark" id="rfcL_1" name="rfcL_1" placeholder="RFC" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Ingresa rfc" maxlength="13" value="{{$fomope->rfc}}" required>
                  </div>
                </div>
                
                <div class="col">
                  <div class="md-form mt-0">
                    <label class="plantilla-label estilo-colorg" for="CURP">CURP: </label>
                        <input type="text" class="form-control border border-dark" id="curp" name="curp" placeholder="Ingresa CURP" maxlength="18" value="{{$fomope->curp}}" required>
                  </div>
                </div>
            </div>
            <br>
              <div class="form-group col-md-12" >	
                  <label class="plantilla-label estilo-colorg" for="nombreT">NOMBRE COMPLETO: </label>
            </div>

              <div class="form-row">
                  <div class="col">
                  <div class="md-form mt-0">
                    <input type="text" class="form-control border border-dark" id="apellido1" name="apellido1" placeholder="Apellido Paterno" value="{{$fomope->apellido_1}}" maxlength="30"required>
                  </div>
                </div>

                <div class="col">
                  <div class="md-form mt-0">
                    <input type="text" class="form-control border border-dark" id="apellido2" name="apellido2" placeholder="Apellido Materno" value="{{$fomope->apellido_2}}" maxlength="30"required>
                  </div>
                </div>

                <div class="col">
                  <div class="md-form mt-0">
                    <input type="text" class="form-control border border-dark" id="nombre" name="nombre" placeholder="Nombre" value="{{$fomope->nombre}}" maxlength="40" required>
                  </div>
                </div>
            </div>
    </div>
    <div class="col-md-4 col-md-offset-4">

              <div class="form-group col-md-12" >
                  <label class="plantilla-label estilo-colorg" for="fechaIngreso"> FECHA DE RECIBIDO: </label>
                <input type="date" class="form-control border border-dark" id="fechaIngreso" name="fechaIngreso" placeholder="Ingresa Fecha del ingreso" value="{{$fomope->fechaRecibido}}" required>
                
              </div>
      <div class="form-row">
        <div class="form-group col-md-6">
                <div class="text-center">
                    <label  class="plantilla-label estilo-colorg" for="del">*Del:</label>
                </div>
                <input type="date" class="form-control border border-dark" id="del" name="del" placeholder="Del" value="{{$fomope->vigenciaDel}}" required>
                <small name= "alertVigencia" id= "alertVigencia" class="text-danger">
                </small> 
            </div>
            <div class="form-group col-md-6">
                <div class="text-center">
                    <label class="plantilla-label estilo-colorg" for="al">al:</label>
                </div>
            <input  type="date" class="form-control border border-dark" value="{{$fomope->vigenciaAl}}" id="al" name="al" placeholder="al"> <!--required-->
            </div>
        </div>
              <div class="form-group col-md-12" >	
                  <label for="TipoEntregaArchivo">TIPO DE ENTREGA: </label>
            </div>

              <div class="form-group col-md-12" >
                  <input id="TipoEntregaArchivo" type="radio" name="TipoEntregaArchivo" value="Ninguno" style="display:none" checked >
                <label class="radio-inline"><input id="TipoEntregaArchivo" type="radio" name="TipoEntregaArchivo" value="Fisico" required>Fisico</label>
                <label class="radio-inline"><input id="TipoEntregaArchivo" type="radio" name="TipoEntregaArchivo" value="Digital" required >Digital</label>
                <label class="radio-inline"><input id="TipoEntregaArchivo" type="radio" name="TipoEntregaArchivo" value="Ambos" required >Ambos</label>
              </div> 

                <div class="form-group shadow-textarea">
                  <label class="plantilla-label estilo-colorg" for="exampleFormControlTextarea6">*Motivo de rechazo</label>
                  <textarea class="form-control z-depth-1 border border-dark" id="comentarioR" name="comentarioR" rows="3" placeholder="Escribe el motivo del rechazo...">{{$fomope->justificacionRechazo}}</textarea>
                </div>
</div>	
        <div class="col-md-8 col-md-offset-8">
             <div class="form-row">

                  <div class="col">
                      <div class="md-form md-0">
                        <input type="file" id="nameArchivo" name="nameArchivo" >
                    </div>
                </div>

               <!-- <label  class="plantilla-label" for="arch">Nombre del archivo: </label> -->
                  <div class="col">
                      <div class="md-form md-0">
                        <div class="box" >

                            <select class="form-control border border-dark mdb-select md-form" name="documentoSelct">
                                @foreach ($Documentos as $doc)
                                <option value="{{$doc->documentos}}">{{$doc->nombre_documento}}</option>
                                @endforeach     
                                    </select>  
                            </div>


                      <!-- <div class="md-form md-0">
                        <input type="text" class="form-control unexp border border-dark" id="archA" name="archA" placeholder="Ingresa el nombre del archivo" maxlength="35" required >
                    </div> -->
                </div>
            </div>	
            <div class="col">
                  <div class="md-form md-0">
                    <input type="submit" name="guardarAdj" onclick="eliminarRequier()" class="btn btn-outline-info tamanio-button" value="Guardar Documento"><br>
                </div>	
            </div>	


	
        </div>	
                    


  <br>  			<br>  	


             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                 Actualizar información 
                                </button>
                              <br>

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
                                        ¿Estas seguro de agregar esta información?
                                      </div>
                        <center>
                  <div class="form-group col-md-8">
                        <div class="box" >

                            <label  class="plantilla-label estilo-colorg" for="laQna">¿A quien será turnado?</label>
                                        
                                        <select class="form-control border border-dark custom-select" name="usuar">
                                                      
                                            
                                            @foreach ($usuarios as $user)
                                            @if($user->id_rol==3  || $user->id_rol==2)
                                            <option value="{{$user->usuario}}">{{$user->name}}</option>
                                            @endif
                                            @endforeach
                                                    
                                              </select>
                            </div>
                             <br>  

                            </div>
                            </center>
                                      <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
                                        <input type="submit" class="btn btn-primary" value="Aceptar" onclick="enviarDatos()" name="botonAccion">
                                      </div>
                                    </div>
                                  </div>
                                </div>

        </form>  
        <br>
        <br>
        <form name="elimin" enctype="multipart/form-data" action="{{route('DDSCH.eliminarFomope')}}" method="POST"> 
        @csrf   
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal1">
                                Eliminar Fomope 
                                </button>
                              <br>

                                  <div class="form-row">
                <input type="text" class="form-control" id="noFomope" name="noFomope" value="{{$fomope->id_movimiento}}" style="display:none">
            </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Información</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        ¿Estás seguro de eliminar la información del fomope?
                                      </div>
                                      <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
                                        <input type="submit" class="btn btn-danger" value="Eliminar" name="accionB">
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                    </form>  
</center>




@endsection