@extends('layouts.adminlte')

@section('content')
        <!-- Page Content  -->
 <div id="content" class="p-4 p-md-5 pt-5">
        <center>
              
  <div class="formulario_fomope">
  
          <div class="formulario_fomope">
  
              
              <br><br>
  
              <form method="post" name="ffomope" action="{{ route('DSPO.agregar_FOMOPE') }}"> 
                @csrf
                   <div class="form-group col-md-6">
                          <label class="plantilla-label" for="listD">Documentos :</label>
              </div>
              <div class="card-body table-responsive p-0" style="height: 300px;">
              <table class="table table-head-fixed table-bordered table-hover">  
                <tbody>
          @foreach ($Documentos as $doc)
          <tr>
              <td>{{$doc->nombre_documento}}</td>
            <td>
                  @php
                  $ext='_.PDF';
                  $nombreBuscar =$fomope->rfc.'_'.strtoupper($doc->documentos).'_'.$fomope->apellido_1.'_'.$fomope->apellido_2.'_'.$fomope->nombre.'_'.$fomope->id_movimiento.$ext;
                  $busquedaDoc = buscaArchivoDoc_Mov($fomope->rfc, $doc->documentos, $fomope->apellido_1, $fomope->apellido_2, $fomope->nombre, $fomope->id_movimiento);
                  @endphp 
                  @if(!empty($busquedaDoc))
                  @foreach ($busquedaDoc as $documentoLoc)  
                  @if(!empty($documentoLoc))
                  <form action = "{{ route('General.downloadPDF') }}" method="POST">
                      @csrf
                      <input type="hidden" name="Documento" value="{{$doc->documentos}}">
                      <input type="hidden" name="nombreDoc" value="{{$documentoLoc}}">
                      <input type="submit" class='btn btn-outline-secondary' value ="Ver">
                  </form>
                   @else
          <button class="btn btn-danger" > X </button>
            @endif
            
              @endforeach
              @endif {{-- fin del if empty --}}
          </td></tr>
          @endforeach    
                </tbody>
              </table>  
            </div> 
              <br>
                  <div class=" plantilla-inputb text-center">
                          <div class="col text-center">
                      <div class="form-row">
                          <div class="form-group col-md-12">
                          <label class="plantilla-label estilo-colorg" for="justirech" style="color:red;">Justificación rechazo:</label>
                           <textarea class="form-control z-depth-1" onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="justirech" name="justirech" readonly >{{$fomope->justificacionRechazo}}</textarea>
                          </div>
  
                  </div>
  
                  <div class="form-row">
                  <div class="form-group col-md-6">
                          <label class="plantilla-label estilo-colorg" for="unidad1">Unidad:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="unidad1" name="unidad1" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->unidad}}"   required readonly>
                      </div>
                  </div>
              </div>
              
              <div class="form-row">
                              <input type="text" class="form-control" id="noFomope" name="noFomope" value="{{$fomope->id_movimiento}}" style="display:none">
                          </div>
                
                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <label class="plantilla-label estilo-colorg" for="rfc_fomo">RFC:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="rfc_fomo" name="rfc_fomo" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->rfc}}"  required readonly>
                      </div>
  
                      <div class="form-group col-md-6">
                          <label class="plantilla-label estilo-colorg" for="curp1">Curp:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="curp1" name="curp1" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->curp}}"  required readonly>
                      </div>
                  </div>
                      <div class="form-row">
                      <div class="form-group col-md-5">
                          <label class="plantilla-label estilo-colorg" for="apPater">Apellido Paterno:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="apPater" name="apPater" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->apellido_1}}"  required readonly>
                      </div>
                  <div class="form-row">
                      <div class="form-group col-md-5">
                          <label class="plantilla-label estilo-colorg" for="apmater">*Apellido Materno:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="apmater" name="apmater" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->apellido_2}}"  required readonly>
                      </div>
  
                      <div class="form-group col-md-5">
                          <label class="plantilla-label estilo-colorg" for="nombres">Nombre(s):</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="nombres" name="nombres" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->nombre}}"  required readonly>
                      </div>
                  </div>
  
                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <label class="plantilla-label estilo-colorg" for="fechIngr">*Fecha ingreso:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="fechIngr" name="fechIngr" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->fechaIngreso}}"  required readonly>
                      </div>
  
                      <div class="form-group col-md-6">
                          <label class="plantilla-label estilo-colorg" for="ofentre">*Oficio entrega:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="ofentre" name="ofentre" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->oficioEntrega}}"  required readonly>
                      </div>
  
                      <div class="form-group col-md-6">
                          <label class="plantilla-label estilo-colorg" for="tipoentre">Tipo de entrega:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="tipoentre" name="tipoentre" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->tipoEntrega}}"  required readonly>
                      </div>
  
                      <div class="form-group col-md-6">
                          <label class="plantilla-label estilo-colorg" for="tipoacc">Tipo de acción:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="tipoacc" name="tipoacc" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->tipoDeAccion}}"  required readonly>
                      </div>
                  </div>
  
                      
                  
                  <div class="form-group col-md-2">
                    <label  class="plantilla-label" for="laQna">*QNA: </label>
                        <select class="form-control border border-dark custom-select" id="qnaOption" name="qnaOption" required>
                                <option  value="{{$fechaSistema->id_qna}}"> {{ $fechaSistema->id_qna}}</option>
                                <option  value="{{$fechaSistema->id_qna+1}}" >{{$fechaSistema->id_qna+1}} </option>
                                <option  value="{{$fechaSistema->id_qna-1}}" >{{$fechaSistema->id_qna-1}} </option>
                                     
                        </select>
                </div>
  
  
                  
  
                              <div class="form-group col-md-3">
                                  <label  class="plantilla-label estilo-colorg" for="elAnio">AÑO: </label>
                                  <input type="text" class="form-control" id="anio" name="anio" value="{{$anio}}" readonly >
                              </div>
                      <div class="form-group col-md-4">
                          <label class="plantilla-label estilo-colorg" for="ofunid">*Oficio Unidad:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="ofunid" name="ofunid" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->oficioUnidad}}" maxlength="80"  required >
  
                  </div>
              </div>
                  <div class="form-row">
                      <div class="form-group col-mt-8">
                          <label class="plantilla-label estilo-colorg" for="fechaofi">*Fecha de oficio:</label>
                          <input onkeypress="return pulsar(event)" type="date" class="form-control border border-dark" id="fechaofi" name="fechaofi" placeholder="Fecha Oficio" value="{{$fomope->fechaOficio}}"  required >
                          <small name= "alertFechaIngreso" id= "alertFechaIngreso" class="text-danger">
                          </small>  
                      </div>
                  
              
                      <div class="form-group col-mt-8">
                          <label class="plantilla-label estilo-colorg" for="fechareci">*Fecha de recibido:</label>
                          <input onkeypress="return pulsar(event)" type="date" class="form-control border border-dark" id="fechareci" name="fechareci" placeholder="Fecha de recibido" value="{{$fomope->fechaRecibido}}"  required >
                          <small name= "alertFechaIngreso" id= "alertFechaIngreso" class="text-danger">
                          </small>  
                      </div>
                  
                  
              
                      <div class="form-group col-mt-8">
                          <label class="plantilla-label estilo-colorg" for="codigo">*Código:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control border border-dark" id="codigo" name="codigo" placeholder="Ej. 165" value="{{$fomope->codigo}}" maxlength="9"  required >
                      </div>
                  
  
                  <div class="form-group col-mt-8">
                          <label class="plantilla-label estilo-colorg" for="NO">No. de puesto:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control border border-dark" id="num_pues" name="num_pues" placeholder="Ej. 0001" value="{{$fomope->n_puesto}}" maxlength="4" >
  
                  </div>
                      <div class="form-group col-md-8">
                          <label class="plantilla-label estilo-colorg" for="clavepres">Clave presupuestaria:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control border border-dark" id="clavepres" name="clavepres" placeholder="Ej. 0001" value="{{$fomope->clavePresupuestaria}}" maxlength="35"  required >
                      </div>
              </div>
                  
                      <div class="form-row">
                      <div class="form-group col-md-12">
                          <label class="plantilla-label estilo-colorg" for="codmov">*Código de movimiento:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control cod2 border border-dark" id="cod2_1" name="cod2_1" placeholder="Ej. 4550" value="{{$fomope->codigoMovimiento}}" maxlength="5"  required>
                      </div>
  
                          
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-4">
                              <div class="text-center">
                                  <label class="plantilla-label estilo-colorg" for="del2">*Del:</label>
                              </div>
                              <input onkeypress="return pulsar(event)" type="date" class="form-control border border-dark" id="del2" name="del2" placeholder="Del" value="{{$fomope->vigenciaDel}}"  required >
                              <small name= "alertVigencia" id= "alertVigencia" class="text-danger">
                              </small> 
                          </div>
                          <div class="form-group col-md-4">
                              <div class="text-center">
                                  <label class="plantilla-label estilo-colorg" for="al3">al:</label>
                              </div>
                              <input onkeypress="return pulsar(event)" type="date" class="form-control border border-dark" id="al3" name="al3" placeholder="al" value="{{$fomope->vigenciaAl}}"  > <!---->
                          </div>
                  </div>
                  <div class="form-row">
  
                          <div class="form-group col-mt-4">
                          <label class="plantilla-label estilo-colorg" for="estad">*Estado:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control cod3 border border-dark" id="cod3_1" name="cod3_1" placeholder="Ej. Ciudad de México" value="{{$fomope->entidad}}" maxlength="30"  required>
                      </div>
                      <div class="form-group col-md-5">
                          <label class="plantilla-label estilo-colorg" for="consema">*Consecutivo maestro de puestos:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control colon border border-dark" id="consema" name="consema" placeholder="Ej. 170" value="{{$fomope->consecutivoMaestroPuestos}}" maxlength="5" >
                      </div>
                  
                      <div class="form-group col-md-5">
                          <label class="plantilla-label estilo-colorg" for="observ">Observaciones:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control colon border border-dark" id="observ" name="observ" placeholder="Ej. 11-01-19 LA DIRECTORA GENERAL INDICA QUE SE REQUIERE OFICIO DE AUTORIZACION CON JUSTIFICACION PARA OCUPACION." value="{{$fomope->observaciones}}" maxlength="150" >
                      </div>
                      <div class="form-group col-mt-4">
                          <label class="plantilla-label estilo-colorg" for="fecharecspc">Fecha de recibido en SPC:</label>
                          <input onkeypress="return pulsar(event)" type="date" class="form-control border border-dark" id="fecharecspc" name="fecharecspc" placeholder="Fecha de recibido en SPC" value="{{$fomope->fechaRecepcionSpc}}" >
                          <small name= "alertFechaIngreso" id= "alertFechaIngreso" class="text-danger">
                          </small>  
                      </div>
              </div>
  
                  <div class="form-row">
  
                      <div class="form-group col-mt-5">
                          <label class="plantilla-label estilo-colorg" for="fechenvvb">Fecha de envio a VoBo SPC:</label>
                          <input onkeypress="return pulsar(event)" type="date" class="form-control border border-dark" id="fechenvvb" name="fechenvvb" placeholder="Fecha de envio a VoBo SPC" value="{{$fomope->fechaEnvioSpc}}"   >
                          <small name= "alertFechaIngreso" id= "alertFechaIngreso" class="text-danger">
                          </small>  
                      </div>
  
                      
                      <div class="form-group col-md-5">
                          <label class="plantilla-label estilo-colorg" for="foliospc">Folio SPC:</label>
                          <input onkeypress="return pulsar(event)"  type="text" class="form-control colon border border-dark" id="foliospc" name="foliospc" placeholder="Ej. 2020" value="{{$fomope->folioSpc}}" maxlength="5"   >
                      </div>
  
                  </div>
                  
                  </div>
  
          
  
                          <div class="form-row">
                              <input type="text" class="form-control" id="noFomope" name="noFomope" value="{{$fomope->id_movimiento}}" style="display:none">
                          </div>
                          <br>
                          <div class="form-row">
                              <button type="button" name="guardarF" id="guardarF" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
                                  Guardar Fomope 
                              </button>
                                      
                                  <input type="submit" class="btn btn-primary" id="bandejaEntrada" name="accionB" style="display: none;"  value="bandeja principal">
                          </div>
                          <br>
  
                          <div class="form-row">
                              <button type="button" name="rechazo" id="rechazo" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalRT" >Rechazo por validacion </button>
                          </div>
  
                                  <div class="modal fade" id="exampleModalRT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Volante de rechazo</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                       <textarea class="form-control border border-dark" id="MotivoRechazo" rows = "4" name="comentarioR" placeholder="Redactar el volante de rechazo" required></textarea>
                                     
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">REGRESAR</button>
                                      <input type="submit" class="btn btn-primary" id="descargar" onclick="verBoton()" name="accionB"  value="descargar">
                                    </div>
                                   
                                  </div>
                                </div>
                              </div>
  
                  </div>
  
                                  <br>
  
  
                                  <br>
                                  <br>
                              
                                  <!-- Modal -->
                                  <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel1">Editar Fomope</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          ¿Está seguro que quiere editar la información del FOMOPE?
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
                                             <input type="submit" class="btn btn-primary" onclick="eliminarReq()" value="aceptar y modificar" name="accionB">
                                             
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                          </div>
                      
  
                  </div>
  
              </form>
              <form name="elimin" enctype="multipart/form-data" action="{{ route('DSPO.eliminarFomope') }}" method="POST"> 
                          @csrf 
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalSup">
                                              Eliminar Fomope 
                          </button>
                                            <br>
  
                            <div class="form-row">
                          <input type="text" class="form-control" id="noFomope" name="noFomope" value="{{$fomope->id_movimiento}}" style="display:none">
                          </div>

                                              <!-- Modal -->
                                              <div class="modal fade" id="exampleModalSup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<script type="text/javascript">

  $(document).ready(function(){
    $(document).on('keydown', '.cod2', function(){
      var id = this.id;
      var splitid = id.split('_');
      var indice = splitid[1];
      $('#'+id).autocomplete({
        source: function(request, response){
          $.ajax({
            url: "resultados_cmov.php",
            type: 'post',
            dataType: "json",
            data: {
              busqueda: request.term,request:1
            },
            success: function(data){
              response(data);
            }
          });
        },
        select: function (event, ui){
          $(this).val(ui.item.label);
          var buscarid = ui.item.value;
          $.ajax({
            url: 'resultados_cmov.php',
            type: 'post',
            data: {
              buscarid:buscarid,request:2
            },
            dataType: 'json',
            success:function(response){
              var len = response.length;
              if(len > 0){
                var idmov = response[0]['idmov'];
                var cod2 = response[0]['cod2'];
                var nomb_mov = response[0]['nomb_mov'];
                document.getElementById('cod2_'+indice).value = cod2;
                document.getElementById('nomb_mov_'+indice).value = nomb_mov;
              }
            }
          });
          return false;
        }
      });
    });
  });


  $(document).ready(function(){
    $(document).on('keydown', '.cod3', function(){
      var id = this.id;
      var splitid = id.split('_');
      var indice = splitid[1];
      $('#'+id).autocomplete({
        source: function(request, response){
          $.ajax({
            url: "resultados_estado.php",
            type: 'post',
            dataType: "json",
            data: {
              busqueda: request.term,request:1
            },
            success: function(data){
              response(data);
            }
          });
        },
        select: function (event, ui){
          $(this).val(ui.item.label);
          var buscarid = ui.item.value;
          $.ajax({
            url: 'resultados_estado.php',
            type: 'post',
            data: {
              buscarid:buscarid,request:2
            },
            dataType: 'json',
            success:function(response){
              var len = response.length;
              if(len > 0){
                var idmov = response[0]['idEstado'];
                var cod3 = response[0]['cod3'];
                var nomb_edo = response[0]['nomb_edo'];
                document.getElementById('cod3_'+indice).value = cod3;
                document.getElementById('nomb_edo_'+indice).value = nomb_edo;
              }
            }
          });
          return false;
        }
      });
    });
  });

  function verDoc(nombre,laExtencion){
    window.location.href = 'Controller/controllerDescarga.php?nombreDecarga='+nombre+'&extencion='+laExtencion;

  }

  function eliminarReq(){
       $('#MotivoRechazo').removeAttr("required");

  }

  
  function verBoton(){
      var a = $("#ofunid").val();
        var b = $("#fechaofi").val();
        var c = $("#fechareci").val();
        var d = $("#codigo").val();
        var e = $("#cod2_1").val();
        var f = $("#del2").val();
        var g = $("#MotivoRechazo").val();
    
        //var h = $("#TipoEntregaArchivo").val();
        
        if (a=="" || b=="" || c==""|| d==""|| e==""|| f==""|| g=="") {
              return false;
          }else{
            $('#guardarF').hide();
            $('#rechazo').hide();
            var btn_2 = document.getElementById('bandejaEntrada');
                btn_2.style.display = 'inline';
             }
  }
</script>
<script src="js/funciones.js"></script>