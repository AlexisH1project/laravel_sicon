@extends('layouts.adminlte')

@section('content')
<div id="content" class="p-4 p-md-5 pt-5">
{{$fomope->color_estado}}



    <center>
        
            <div class="col-md-8 col-md-offset-8">
               <form name="captura1" action="./Controller/autorizarAmarillo0.php" method="POST"> 
                   <div class="form-row">
                      <input type="text" class="form-control" id="userName" name="userName" value="" style="display:none">
                  </div>
                  <div class="form-row">
                      <input type="text" class="form-control" id="idFom" name="idFom" value="" style="display:none">
                  </div>
                  
                  <div class="form-row">
                      <div class="form-group col-md-12" >
                          <label class="plantilla-label estilo-colorg" for="unexp_1">Unidad:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="unexp_1" name="unexp_1" placeholder="Ej. 111" value="" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                      </div>
                  </div>

                  <div class="form-row">
                      <div class="col">
                        <div class="md-form mt-0">
                         <label class="plantilla-label estilo-colorg" for="rfcL">RFC: </label>
                          <input type="text" class="form-control unexp border border-dark" id="rfc" name="rfc" placeholder="Ingresa rfc" maxlength="13" value=""   readonly>
                        </div>
                      </div>

                      <div class="col">
                        <div class="md-form mt-0">
                          <label class="plantilla-label estilo-colorg" for="CURP">CURP: </label>
                              <input type="text" class="form-control unexp border border-dark" id="curp" name="curp" placeholder="Ingresa CURP" maxlength="18" value="" readonly>
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
                          <input type="text" class="form-control unexp border border-dark" id="apellido1" name="apellido1" placeholder="Apellido Paterno" value="" maxlength="30"required readonly>
                        </div>
                      </div>

                      <div class="col">
                        <div class="md-form mt-0">
                          <input type="text" class="form-control unexp border border-dark" id="apellido2" name="apellido2" placeholder="Apellido Materno" value="" maxlength="30"required readonly>
                        </div>
                      </div>

                      <div class="col">
                        <div class="md-form mt-0">
                          <input type="text" class="form-control unexp border border-dark" id="nombre" name="nombre" placeholder="Nombre" value="" maxlength="40" required readonly>
                        </div>
                      </div>
                  </div>
          </div>
          <div class="col-md-4 col-md-offset-4">

                    <div class="form-group col-md-12" >
                        <label class="plantilla-label estilo-colorg" for="fechaIngreso"> FECHA DE RECIBIDO: </label>
                      <input type="date" class="form-control unexp border border-dark" id="fechaIngreso" name="fechaIngreso" placeholder="Ingresa Fecha del ingreso" value="" required readonly>
                      
                    </div>
                  <div class="form-row">
              <div class="form-group col-md-6">
                      <div class="text-center">
                          <label class="plantilla-label estilo-colorg" for="del">*Del:</label>
                      </div>
                      <input type="date" class="form-control unexp border border-dark " id="del" value="" name="del" placeholder="Del" required readonly>
                      <small name= "alertVigencia" id= "alertVigencia" class="text-danger">
                      </small> 
                  </div>
                  <div class="form-group col-md-6">
                      <div class="text-center">
                          <label class="plantilla-label estilo-colorg" for="al">al:</label>
                      </div>
                  <input  type="date" class="form-control unexp border border-dark" value="" id="al" name="al" placeholder="al" required readonly> <!--required-->
                  </div>
              </div>

                    <div class="form-group col-md-12" >	
                        <label class="plantilla-label estilo-colorg" for="TipoEntregaArchivo">TIPO DE ENTREGA: </label>
                  </div>

                    <div class="form-group col-md-12" >
                          <input  class="form-control unexp border border-dark" id="TipoEntregaArchivo" type="text" name="TipoEntregaArchivo" value="" required readonly >
                    </div>

                      <div class="form-group col-md-8">
                              <div class="box" >

                                  <label  class="plantilla-label estilo-colorg" for="elejir">¿A QUIEN SERÁ TURNADO?</label>
                                           
                                          <select class="form-control border border-dark custom-select" name="usuar">
                                              
                                              <option value="">   </option>
                       
                                              <option value=""></option>
                                                      
                                          </select>
                                  </div>
                                   <br>  

                      </div>

                    <div class="form-group col-md-12" >	
                        <label class="plantilla-label estilo-colorg" for="listaArchivos">LISTA DE ARCHIVOS: </label>
                  </div>

                </div>	
                		
                  <br>	
                  <button type="button" class="btn btn-primary" id="capturaF" data-toggle="modal" data-target="#exampleModal">
                                       Autorizar
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
                                              ¿Estas seguro de autorizar esta información?
                                            </div>
                              <center>
                          
                                  </center>
                                            <div class="modal-footer">

                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
                                                 <button type="submit"  class="btn btn-primary">Aceptar</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                        <br>
                  
              </form>  
              <form name="captura2" action="./Controller/rechazoAmarillo0.php" method="POST">
                  <div class="form-row">
                      <input type="text" class="form-control" id="userName" name="userName" value="" style="display:none">
                  </div>
                  <div class="form-row">
                      <input type="text" class="form-control" id="idFom" name="idFom" value="" style="display:none">
                  </div>
                  
              <div class="form-group col-md-6">

                      <button type="button" name="rechazo" id="rechazo" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal1" data-whatever="@getbootstrap">Rechazar</button>
                      <input type="submit" name="tipButton" style="display: none;" id="bandejaEntrada" class="btn btn-primary" value="bandeja de entrada">

              </div>
                      <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Motivo de rechazo</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form>
                                  <input type="date" class="form-control unexp border border-dark" id="fechareci" name="fechareci" placeholder="Ingresa Fecha del ingreso" style="display: none;" value="" required readonly>
                               <textarea class="form-control border border-dark" id="obs" rows = "4" name="comentarioR" placeholder="Observación por rechazo" required> </textarea>
                                <div class="form-row">
                                  <input type="text" class="form-control unexp border border-dark" id="noFomope" name="noFomope" value="" style="display:none">
                                  </div>
                                  <div class="form-row">
                                      <input type="text" class="form-control unexp border border-dark" id="id_rol" name="id_rol" value="" style="display:none">
                                  </div>
                                  <div class="form-row">
                                      <input type="text" class="form-control unexp border border-dark" id="usuario" name="usuario" value="" style="display:none">
                                  </div>
                              </form>
                            </div>
                          

                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">REGRESAR</button>
                              <input type="submit" name="tipButton" id="descargar" onclick="verBoton()" class="btn btn-primary" value="aceptar">
                            </div>
                            
                          </div>
                        </div>
                      </div>

              </form>

    </center>

    <script type="text/javascript">

        function enviarDatos(){
                        var formulario = document.captura1;
                        formulario.action= './verAmarillo0';
        
                            var a = $("#unidad").val();
                                  formulario.submit();
                 }


@endsection