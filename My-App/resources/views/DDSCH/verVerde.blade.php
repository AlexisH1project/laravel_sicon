@extends('layouts.adminlte')

@section('content')

<div id="content" class="p-4 p-md-5 pt-5">

    <center>
        
<div class="col-md-8 col-md-offset-8">
               <form name="captura1" enctype="multipart/form-data" action="{{route('DDSCH.updateVerde')}}" method="POST"> 
                   @csrf
                <div class="form-row">
                      <input type="text" class="form-control" id="userName" name="userName" value="" style="display:none">
                  </div>
                  <div class="form-row">
                      <input type="text" class="form-control" id="idFom" name="idFom" value="{{$fomopeId}}" style="display:none">
                  </div>

                  
                      <div class="form-row">
                      <div class="col">
                        <div class="form-group col-md-12">
                            <label class="plantilla-label estilo-colorg" for="fAlaborar">FECHAS ENTREGA DE EXPEDIENTE A RELACIONES LABORALES: </label>
                          <input type="date" class="form-control unexp border border-dark" id="fechaRLaborales" name="fechaRLaborales">
                        </div>
                      </div>	
                      <div class="col">

                          <div class="form-group col-md-12" >
                             <label class="plantilla-label estilo-colorg" for="ofEntregaL">OFICIO ENTREGA EXPEDIENTE A RELACIONES LABORALES:</label> 
                            
                          <input type="text" class="form-control unexp border border-dark" id="ofEntregaRL" name="ofEntregaRL" placeholder="OFICIO ENTREGA EXPEDIENTE RELACIONES LABORALES" maxlength="65">
                       </div>
                        </div>		
                      
                  </div>
                  <br>
                  

                      <div class="form-group">
                      <label for="archivo_1">Adjuntar un archivo (.pdf)</label>
                      <input type="file" name="nameArchivo" required>
                
                    </div>
                  <br>
                  

                  <div class="form-row">
                      <div class="col">
                        <div class="form-group col-md-12" >
                            <label class="plantilla-label estilo-colorg" for="fechaUnidad">FECHA ENTREGA EXPEDIENTE UNIDAD: </label>
                          <input type="date" class="form-control unexp border border-dark" id="fechaEntregaUnidad" name="fechaEntregaUnidad" >
                        </div>
                      </div>	
                      <div class="col">

                         <div class="form-group col-md-12" >
                                 <label  class="plantilla-label estilo-colorg" for="ofUnidad">OFICIO ENTREGA EXPEDIENTE UNIDAD: </label> 
                              <input type="text" class="form-control unexp border border-dark" id="ofEntregaUnidad" name="ofEntregaUnidad" placeholder="OFICIO ENTREGA EXPEDIENTE UNIDAD" maxlength="49">	
                            </div>		

                        </div>		
                      
                  </div>

                  
                    <div class="form-group col-md-12" >
                        <label class="plantilla-label estilo-colorg" for="oficio">OFICIO ENTREGA SEGUROS: </label>
                      <input type="text" class="form-control unexp border border-dark" id="ofEntrega" name="ofEntrega" placeholder="Ingresa el oficio de entrega" maxlength="25"required>
                    </div>

                    <!-- <div class="form-group col-md-12">
                          <div class="col text-center">
                                <button type="submit" class="btn btn-primary">Agregar Informacion</button>
                          </div>
           
           kji9             </div> -->
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
                                     <input type="submit" class="btn btn-primary" name="acept" value="Aceptar">
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