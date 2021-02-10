@extends('layouts.adminlte')
<style>
  .modal-header, h4, .close {
    background-color: #5cb85c;
    color:white !important;
    text-align: center;
    font-size: 30px;
  }
  .modal-footer {
    background-color: #f9f9f9;
  }
  </style>

@section('content')
   
        <div id="content" class="p-4 p-md-5 pt-5">
         
          
          <div class="formulario_fomope">
  
  
               <div class="form-group col-md-4">
                          <label class="plantilla-label" for="NombrC">Empleado:</label>
                          <input type="text" class="form-control border border-dark" id="rfcC" name="rfcC" value="{{$fomope->rfc}}" readonly >
                          <input type="text" class="form-control border border-dark" id="nameComp" name="nameComp" value="{{$fomope->apellido_1.' '.$fomope->apellido_2.' '.$fomope->nombre}}" readonly >
  
              </div>
              <div class="form-group col-md-6">
                          <label class="plantilla-label" for="NombrU">Unidad:</label>
                          <input type="text" class="form-control border border-dark" id="nameComp" name="nameComp" value="{{$fomope->unidad}}" readonly >
              </div>
              
              <div class="form-group col-md-60">
                              <button type="button" name="rechazoInicial" id="rechazoInicial" class="btn btn-danger" data-toggle="modal" data-target="#RechInicial" >Rechazar por captura inicial</button>
  
              </div>
  
              <div class="form-group col-md-6">
                          <label class="plantilla-label" for="listD">Documentos :</label>
              </div>
              <center>
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
                </center>
                 
              <br>
  
          
              
              


              <form enctype="multipart/form-data" method="POST" action="{{route('DSPO.agregar_FOMOPE')}}" name="captura1" id="captura1"> 
                @csrf
              
                  <div class="form-row">
                          <div class="modal fade" id="exampleModalR" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Motivo de rechazo</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                       <textarea class="form-control z-depth-1" id="comentarioR" name="comentarioR" rows="3" placeholder="Escribe el motivo del rechazo..."></textarea>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
                                      <input type="submit" class="btn btn-primary" value="Rechazar" name="botonAccion">
                                    </div>
                                  </div>
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

                              <div class="form-group col-md-2">
                                  <label  class="plantilla-label" for="elAnio">AÑO: </label>
                                       <input type="text" class="form-control" id="anio" name="anio" value="{{$anio}}" readonly >
                              <div class="form-row">
                              <input type="text" class="form-control" id="noFomope" name="noFomope" value="{{$fomope->id_movimiento}}" style="display:none">
                          </div>
                          <br>
  
                              
                  </div>
  
  
                              
                  </div>
                              
                      <div class="form-row">
                          <div class="form-group col-md-5">
                                  <label class="plantilla-label" for="ofunid">*Oficio unidad:</label>
                                  <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="ofunid" name="ofunid" placeholder="Ej. OAG-CA-3735-2020" value="" maxlength="80" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                              </div>
                      <div class="form-group col-md-6">
                          <label class="plantilla-label" for="fechaofi">*Fecha de oficio:</label>
                          <input type="date" class="form-control border border-dark" id="fechaofi" name="fechaofi" placeholder="Fecha Oficio" required>
                          <small name= "alertFechaIngreso" id= "alertFechaIngreso" class="text-danger">
                          </small>  
                      </div>
                  </div>
                      <div class="form-row">
                      <div class="form-group col-md-5">
                          <label class="plantilla-label" for="fechareci">*Fecha de recibido:</label>
                          <input type="date" class="form-control border border-dark" id="fechareci" name="fechareci" placeholder="Fecha de recibido" required>
                          <small name= "alertFechaIngreso" id= "alertFechaIngreso" class="text-danger">
                          </small>  
  
                      </div>
                      <div class="form-group col-md-4">
                          <label class="plantilla-label" for="codigo">*Código:</label><div class="container">
                               <input onkeypress="return pulsar(event)" type="text" class="form-control border border-dark" id="codigo" name="codigo" placeholder="Ej. 123" value="" maxlength="9" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                          <small name= "alertFechaIngreso" id= "alertFechaIngreso" class="text-danger">
                          </small>  
                              </div>
                      </div>
                      <div class="form-group col-md-2">
                          <label class="plantilla-label" for="NO">No. de puesto:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control border border-dark" id="num_pues" name="num_pues" placeholder="Ej. 0001" value="" maxlength="5" onkeyup="javascript:this.value=this.value.toUpperCase();">
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-4">
                          <label class="plantilla-label" for="NO">Clave presupuestaria:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control border border-dark" id="clavepres" name="clavepres" placeholder="Ej. 0001" value="" maxlength="35" onkeyup="javascript:this.value=this.value.toUpperCase();">
                      </div>
                      <div class="form-group col-md-8">
                          <label class="plantilla-label" for="codmov">*Código de movimiento:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control cod2 border border-dark" id="cod2_1" name="cod2_1" placeholder="Ej. 4550" value="" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-5">
                              <div class="text-center">
                                  <label class="plantilla-label" for="del2">*Del:</label>
                              </div>
                              <input type="date" class="form-control border border-dark" id="del2" name="del2" placeholder="Del"required>
                              <small name= "alertVigencia" id= "alertVigencia" class="text-danger">
                              </small> 
                          </div>
                          <div class="form-group col-md-5">
                              <div class="text-center">
                                  <label class="plantilla-label" for="al3">al:</label>
                              </div>
                          <input  type="date" class="form-control border border-dark" id="al3" name="al3" placeholder="al"> <!--required-->
                          </div>
                      </div>
                      <div class="form-row">
                      
                      <div class="form-row">
                          <div class="form-group col-mt-8">
                          <label class="plantilla-label" for="estad">*Estado:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control cod3 border border-dark" id="cod3_1" name="cod3_1" placeholder="Ej. Ciudad de México" value="Ciudad de México" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                      </div>
  
                      <div class="form-group col-mt-8">
                          <label class="plantilla-label" for="consema">*Consecutivo maestro de puestos:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control colon border border-dark" id="consema" name="consema" placeholder="Ej. 170" value="" maxlength="5" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                      </div>
                      <div class="col-md-4">
                      </div>
                  </div>
                      <div class="form-group col-md-6">
                          <label class="plantilla-label" for="observ">*Observaciones:</label>
                          <input onkeypress="return pulsar(event)" type="text" class="form-control colon border border-dark" id="observ" name="observ" placeholder="Ej. 11-01-19 LA DIRECTORA GENERAL INDICA QUE SE REQUIERE OFICIO DE AUTORIZACION CON JUSTIFICACION PARA OCUPACION." value="" maxlength="150" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                      </div>
                      <div class="form-row">
                      
  
                      <div class="form-group col-md-6">
                          <label class="plantilla-label" for="fecharecspc">*Fecha de recibido en SPC:</label>
                          <input  type="date" class="form-control border border-dark" id="fecharecspc" name="fecharecspc" placeholder="Fecha de recibido en SPC"  >
                          <small name= "alertFechaIngreso" id= "alertFechaIngreso" class="text-danger">
                          </small>  
                      
                      </div>
  
                      <div class="form-group col-md-6">
                          <label class="plantilla-label" for="fechenvvb">*Fecha de envio a VoBo SPC:</label>
                          <input type="date" class="form-control border border-dark" id="fechenvvb" name="fechenvvb" placeholder="Fecha de envio a VoBo SPC"  >
                          <small name= "alertFechaIngreso" id= "alertFechaIngreso" class="text-danger">
                          </small>  
                      </div>
                      <div class="form-group col-md-6">
                          <label class="plantilla-label" for="fecharecdspo">*Fecha de recibo DSPO:</label>
                          <input  type="date" class="form-control border border-dark" id="fecharecdspo" name="fecharecdspo" placeholder="Fecha de envio a VoBo SPC" >
                          <small name= "alertFechaIngreso" id= "alertFechaIngreso" class="text-danger">
                          </small>  
                      </div>
                      
                      <div class="form-group col-md-6">
                          <label class="plantilla-label" for="foliospc">*Folio SPC:</label>
                          <input  type="text" class="form-control colon border border-dark" id="foliospc" name="foliospc" placeholder="Ej. 2020" value="" maxlength="5"  >
                      </div>
                          <div class="form-group col-md-12">
                                  <button type="button" class="btn btn-primary" name="capturaF" id="capturaF" data-toggle="modal" data-target="#exampleModal1">Capturar Fomope </button>
                                 
                              <input type="submit" class="btn btn-primary" id="bandejaEntrada" name="accionB" style="display: none;"  value="bandeja principal">
                              <input type="text" class="form-control" id="noFomope" name="noFomope" value="{{$fomope->id_movimiento}}" style="display:none">
                                   
  
                          </div>
  
                          <div class="form-group col-md-60">
                              <button type="button" name="rechazo" id="rechazo" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalRT" >Rechazo por validacion </button>
  
  
                          </div>
                          <div class="form-group col-md-10">
                              <button type="button" name="genera" id="genera" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalPC" >Reporte profesional de Carrera</button>
  
  
                          </div>
                      </div>
                                                  <br>
                              
                                  <!-- Modal -->
                                  <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel1">Captura Fomope</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          ¿Está seguro que quiere capturar la información del FOMOPE? 
                                            NOTA: Las fechas no deben ser mayores a la actual 
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
                                          <input type="submit" class="btn btn-primary" onclick="eliminarReq()" name="accionB" value="Capturar">
  
                                             <!-- <button type="submit" class="btn btn-primary">Capturar</button> -->
                                             
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                              
                              <div class="modal fade" id="RechInicial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Rechazo por captura</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                       <textarea class="form-control border border-dark" id="MotivoRechazoCap" rows = "4" name="comentarioR2" placeholder="Redactar el volante de rechazo" required></textarea>
                                     
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">REGRESAR</button>
                                      <input type="submit" class="btn btn-primary" id="rechI" onclick="rechazarPorCapI()" name="accionB"  value="Aceptar rechazo por captura">
                                    </div>
                                   
                                  </div>
                                </div>
                              </div>
  
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
  
  
                          <div class="modal fade" id="exampleModalPC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel2">Reporte Profesional de carrera</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                       <textarea class="form-control border border-dark" id="idProfesional" rows = "4" name="idProfesional" placeholder="id Profesional de carrera" required></textarea>
                                     
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">REGRESAR</button>
                                      <input type="submit" class="btn btn-primary" id="generar" onclick="eliminarReq2()" name="accionB"  value="generar">
                                    </div>
                                   
                                  </div>
                                </div>
                              </div>
  
                  </div>
  
              </form>
  
  
          </div>
  
              
  
          </div>

@endsection
<script type="text/javascript">
			
  function pulsar(e) {
      tecla = (document.all) ? e.keyCode :e.which; 
      return (tecla!=13); 
  } 

  

</script>


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
    $(document).on('keydown', '.cod4', function(){
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
                var cod2 = response[0]['cod4'];
                var nomb_mov = response[0]['nomb_mov'];
                document.getElementById('cod4_'+indice).value = cod2;
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
        $('#idProfesional').removeAttr("required");
        $("#MotivoRechazoCap").removeAttr("required");


  }
  function eliminarReq2(){
       $('#MotivoRechazo').removeAttr("required");
        $("#MotivoRechazoCap").removeAttr("required");


  }

  function rechazarPorCapI(){
      $("#ofunid").removeAttr("required");
        $("#fechaofi").removeAttr("required");
        $("#fechareci").removeAttr("required");
        $("#codigo").removeAttr("required");
         $("#cod2_1").removeAttr("required");
         $("#del2").removeAttr("required");
        //var g = $("#MotivoRechazo").val();
        $("#MotivoRechazo").removeAttr("required");
        //var h = $("#TipoEntregaArchivo").val();
       $('#idProfesional').removeAttr("required");

      $('#capturaF').hide();
            $('#rechazo').hide();
            $('#genera').hide();
            $('#rechazoInicial').hide();
            var btn_2 = document.getElementById('bandejaEntrada');
                btn_2.style.display = 'inline';
  }


  function verBoton(){
      var a = $("#ofunid").val();
        var b = $("#fechaofi").val();
        var c = $("#fechareci").val();
        var d = $("#codigo").val();
        var e = $("#cod2_1").val();
        var f = $("#del2").val();
        //$("#MotivoRechazo").val();
    
        //var h = $("#TipoEntregaArchivo").val();
       $('#idProfesional').removeAttr("required");
        
        if (a=="" || b=="" || c==""|| d==""|| e==""|| f=="") {
              return false;
          }else{
          $("#MotivoRechazoCap").removeAttr("required");
            $('#capturaF').hide();
            $('#rechazo').hide();
            $('#genera').hide();
            var btn_2 = document.getElementById('bandejaEntrada');
                btn_2.style.display = 'inline';
             }
  }
  function nobackbutton(){
     window.location.hash="no-back-button";
     window.location.hash="Again-No-back-button" //chrome
     window.onhashchange=function(){window.location.hash="no-back-button";}
  }


  
</script>