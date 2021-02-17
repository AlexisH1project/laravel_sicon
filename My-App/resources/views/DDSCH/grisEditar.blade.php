@extends('layouts.adminlte')

@section('content')

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">


            <center>
                
                    <div class="col-md-8 col-md-offset-8">
                       <form name="captura1" enctype="multipart/form-data" action="{{route('DDSCH.updateVerde')}}" method="POST"> 
                        @csrf 
                           <div class="form-row">
                          </div>
                          <div class="form-row">
                              <input type="text" class="form-control" id="idFom" name="idFom" value="{{$fomope->id_movimiento}}" style="display:none">
                          </div>
  
  
                              <div class="form-group col-md-12 shadow-textarea">
                                <label for="exampleFormControlTextarea6">Motivo de rechazo</label>
                                <textarea class="form-control border border-dark z-depth-1" required readonly id="comentarioR" name="comentarioR" rows="3" placeholder="Escribe el motivo del rechazo...">{{$fomope->justificacionRechazo}}</textarea>
                              </div>
                          
                              <div class="form-row">
                              <div class="col">
                                <div class="form-group col-md-12">
                                    <label class="plantilla-label estilo-colorg"  for="fAlaborar">FECHAS ENTREGA DE EXPEDIENTE A RELACIONES LABORALES: </label>
                                  <input type="date" class="form-control border border-dark" id="fechaRLaborales"  value="{{$fomope->fechaEntregaRLaborales}}" name="fechaRLaborales">
                                </div>
                              </div>	
                              <div class="col">
  
                                  <div class="form-group col-md-12" >
                                     <label class="plantilla-label estilo-colorg" for="ofEntregaL">OFICIO ENTREGA EXPEDIENTE A RELACIONES LABORALES:</label> 
                                    
                                  <input type="text" class="form-control border border-dark" id="ofEntregaRL" name="ofEntregaRL" value="{{$fomope->OfEntregaRLaborales}}" placeholder="OFICIO ENTREGA EXPEDIENTE RELACIONES LABORALES" maxlength="65">
                               </div>
                                </div>		
                              
                          </div>
                          <br>
                          
  
                              
                              <div class="form-group">
                              <label class="plantilla-label estilo-colorg" for="archivo_1"><i>(Opcional)</i>  Adjuntar un archivo (.pdf)</label>
                              <!--  <input type="hidden" name="MAX_FILE_SIZE" value="30000" /> -->
                              <input type="file" name="nameArchivo">
                             <!--  <p class="help-block">Ejemplo de texto de ayuda.</p> -->
                            </div>
                          <br>
                          
  
                          <div class="form-row">
                              <div class="col">
                                <div class="form-group col-md-12" >
                                    <label class="plantilla-label estilo-colorg" for="fechaUnidad">FECHA ENTREGA EXPEDIENTE UNIDAD: </label>
                                  <input type="date"class="form-control border border-dark" id="fechaEntregaUnidad" name="fechaEntregaUnidad" value="{{$fomope->fechaEntregaUnidad}}" >
                                </div>
                              </div>	
                              <div class="col">
  
                                 <div class="form-group col-md-12" >
                                         <label class="plantilla-label estilo-colorg" for="ofUnidad">OFICIO ENTREGA EXPEDIENTE UNIDAD: </label> 
                                      <input type="text" class="form-control border border-dark" id="ofEntregaUnidad" value="{{$fomope->OfEntregaUnidad}}" name="ofEntregaUnidad" placeholder="OFICIO ENTREGA EXPEDIENTE UNIDAD" maxlength="49">	
                                    </div>		
  
                                </div>		
                              
                          </div>
  
                          <div class="form-group col-md-8" >
                                <label class="plantilla-label estilo-colorg" for="oficio">OFICIO ENTREGA SEGUROS: </label>
                              <input type="text" class="form-control border border-dark" id="ofEntrega" name="ofEntrega" value="{{$fomope->oficioEntrega}}" placeholder="Ingresa el oficio de entrega" maxlength="25"required>
                            </div>
  
  
                          
                            <!-- <div class="form-group col-md-12">
                                  <div class="col text-center">
                                        <button type="submit" class="btn btn-primary">Agregar Informacion</button>
                                  </div>
                          </div> -->
                          <!-- Button trigger modal -->
                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    Agregar Informacion
                                  </button>
  
                                  <!-- Modal -->
                                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Corroborar Informacion</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          ¿Estas seguro que la informacion a actualizar es la correcta?
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
                                     <!--      <button type="submit" class="btn btn-secondary" >Aceptar</button> -->
  
                                             <input type="submit" class="btn btn-primary" name="acepto" value="Aceptar">
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
                                      <center>
                               
                                          </center>
                                                    <div class="modal-footer">
  
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
                                                      <input type="submit" class="btn btn-danger" value="Eliminar" name="accionB">
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
  
                                                  </form>  
  
                  </div>
  
            </center>
@endsection