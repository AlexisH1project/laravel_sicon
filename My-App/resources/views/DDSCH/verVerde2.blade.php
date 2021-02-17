@extends('layouts.adminlte')

@section('content')
<div id="content" class="p-4 p-md-5 pt-5">


    <center>
        <div class="col-md-8 col-md-offset-8">
                         <form name="captura1" action="{{route('DDSCH.autorizarVerde2')}}" method="POST"> 
                            @csrf
                             <div class="form-row">
                                
                            </div>
                            <div class="form-row">
                                <input readonly type="text" class="form-control unexp border border-dark" id="idFom" name="idFom" value="{{$fomope->id_movimiento}}" style="display:none">
                            </div>
                            <div class="form-row">
                                <div class="col">
                                  <div class="form-group col-md-12">
                                      <label class="plantilla-label estilo-colorg" for="fAlaborar">FECHAS ENTREGA DE EXPEDIENTE A RELACIONES LABORALES: </label>
                                    <input readonly type="date" class="form-control unexp border border-dark" id="fechaRLaborales" value="{{$fomope->fechaEntregaRLaborales}}" name="fechaRLaborales">
                                  </div>
                                </div>	
                                <div class="col">
    
                                    <div class="form-group col-md-12" >
                                       <label class="plantilla-label estilo-colorg" for="ofEntregaL">OFICIO ENTREGA EXPEDIENTE A RELACIONES LABORALES:</label> 
                                      
                                    <input readonly type="text" class="form-control unexp border border-dark" id="ofEntregaRL" value="{{$fomope->OfEntregaRLaborales }}" name="ofEntregaRL" placeholder="OFICIO ENTREGA EXPEDIENTE RELACIONES LABORALES" maxlength="65">
                                 </div>
                                  </div>		
                                
                            </div>
                            <br>
                            
    
                                <div class="form-group col-md-4" >
                                <label class="plantilla-label estilo-colorg" for="ejemplo_archivo_1">Archivo adjunto: </label>
                                <input readonly type="text"class="form-control unexp border border-dark" value="{{$fomope->fomopeDigital}}" id="ejemplo_archivo_1" name="ejemplo_archivo_1">
                               <!--  <p class="help-block">Ejemplo de texto de ayuda.</p> -->
                              </div>
                            <br>
                            
    
                            <div class="form-row">
                                <div class="col">
                                  <div class="form-group col-md-12" >
                                      <label class="plantilla-label estilo-colorg" for="fechaUnidad">FECHA ENTREGA EXPEDIENTE UNIDAD: </label>
                                    <input readonly type="date" class="form-control unexp border border-dark" value="{{$fomope->fechaEntregaUnidad}}" id="fechaEntregaUnidad" name="fechaEntregaUnidad" >
                                  </div>
                                </div>	
                                <div class="col">
    
                                   <div class="form-group col-md-12" >
                                           <label class="plantilla-label estilo-colorg" for="ofUnidad">OFICIO ENTREGA EXPEDIENTE UNIDAD: </label> 
                                        <input readonly type="text" class="form-control unexp border border-dark" id="ofEntregaUnidad" value="{{$fomope->OfEntregaUnidad}}" name="ofEntregaUnidad" placeholder="OFICIO ENTREGA EXPEDIENTE UNIDAD" maxlength="49">	
                                      </div>		
    
                                  </div>		
                                
                            </div>
    
                                <div class="form-group col-md-12" >
                                  <label class="plantilla-label estilo-colorg" for="oficio">OFICIO ENTREGA SEGUROS: </label>
                                <input type="text" class="form-control unexp border border-dark" id="ofEntrega" name="ofEntrega" value="{{$fomope->oficioEntrega}}" placeholder="Ingresa el oficio de entrega" maxlength="25"required>
                              </div>
    
                    
    
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
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
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
                                                           <button type="submit" class="btn btn-primary">Aceptar</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
    
                                  <br>
                            
                                
                            
                        </form>  
                        <form name="captura2" action="{{route('DDSCH.rechazoVerde2')}}" method="POST">
                            @csrf
                            <div class="form-row">
                            </div>
                            <div class="form-row">
                                <input readonly type="text" class="form-control unexp border border-dark" id="idFom" name="idFom" value="{{$fomope->id_movimiento}}" style="display:none">
                            </div>
                            
                            <div class="form-group col-md-6">
                                <button type="button" name="rechazo" id="rechazo" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalRT" >Rechazar </button>
    
    
                            </div>
                        
                                    <div class="modal fade" id="exampleModalRT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Rechazo/modificar datos</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                         <textarea class="form-control border border-dark" id="MotivoRechazo" rows = "4" name="comentarioR" placeholder="Motivo...." required></textarea>
                                       
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">REGRESAR</button>
                                        <input type="submit" class="btn btn-primary" id="descargar" name="accionB"  value="Enviar">
                                      </div>
                                     
                                    </div>
                                  </div>
                                </div>
    
                    </div>
    
    
                        </form>
    
    </center>
                    
                        <script src="js/bootstrap.min.js"></script>
           <script src="js/main.js"></script>
                    </div>

@endsection