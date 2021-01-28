@extends('layouts.adminlte')

@section('content')
<div id="content" class="p-4 p-md-5 pt-5">

      
      		

    <div class="formulario_fomope">

    
        <br><br>
<center>
         <form name="captura1" action="{{route('DSPO.aceptarFomope')}}" method="POST"> 
            @csrf
                    
                    <div class="col text-center">
                    
        </div>

        <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="plantilla-label estilo-colorg"for="unidad1">Unidad:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="unidad1" name="unidad1" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->unidad}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                </div>
            </div>
            <div class="form-row">
                        <input type="text" class="form-control" id="noFomope" name="noFomope" value="{{$fomope->id_movimiento}}" style="display:none">
                    </div>
                    <div class="form-row">
                        <input type="text" class="form-control" id="color_esta" name="color_esta" value="{{$fomope->color_estado}}" style="display:none">
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
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="plantilla-label estilo-colorg" for="rfc_fomo">RFC:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="rfc_fomo" name="rfc_fomo" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->rfc}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                </div>

                <div class="form-group col-md-6">
                    <label class="plantilla-label estilo-colorg" for="curp1">Curp:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="curp1" name="curp1" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->curp}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                </div>
            </div>
                <div class="form-row">
                <div class="form-group col-md-5">
                    <label class="plantilla-label estilo-colorg" for="apPater">Apellido Paterno:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="apPater" name="apPater" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->apellido_1}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label class="plantilla-label estilo-colorg"for="apmater">*Apellido Materno:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="apmater" name="apmater" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->apellido_2}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                </div>

                <div class="form-group col-md-5">
                    <label class="plantilla-label estilo-colorg" for="nombres">Nombre(s):</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="nombres" name="nombres" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->nombre}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="plantilla-label estilo-colorg" for="fechIngr">*Fecha ingreso:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="fechIngr" name="fechIngr" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->fechaIngreso}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                </div>

                <div class="form-group col-md-6">
                    <label class="plantilla-label estilo-colorg" for="ofentre">*Oficio entrega:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="ofentre" name="ofentre" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->oficioEntrega}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                </div>

                <div class="form-group col-md-6">
                    <label class="plantilla-label estilo-colorg" for="tipoentre">Tipo de entrega:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="tipoentre" name="tipoentre" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->tipoEntrega}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                </div>

                <div class="form-group col-md-6">
                    <label class="plantilla-label estilo-colorg" for="tipoacc">Tipo de acción:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="tipoacc" name="tipoacc" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->tipoDeAccion}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                </div>
            </div>

                <div class="form-group col-md-10">
                    <label class="plantilla-label estilo-colorg" for="justirech">Justificación rechazo:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="justirech" name="justirech" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->justificacionRechazo}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>

            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="plantilla-label estilo-colorg" for="quinapli">Quincena aplicada:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="quinapli" name="quinapli" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->quincenaAplicada}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                </div>


                <div class="form-group col-md-4">
                    <label class="plantilla-label estilo-colorg" for="aniofo">Año:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="aniofo" name="aniofo" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->anio}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
            
            </div>
                <div class="form-group col-md-4">
                    <label class="plantilla-label estilo-colorg" for="ofunid">*Oficio Unidad:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control unexp border border-dark" id="ofunid" name="ofunid" placeholder="Ej. OAG-CA-3735-2020" value="{{$fomope->oficioUnidad}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>

            </div>
        </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label class="plantilla-label estilo-colorg" for="fechaofi">*Fecha de oficio:</label>
                    <input onkeypress="return pulsar(event)" type="date" class="form-control border border-dark" id="fechaofi" name="fechaofi" placeholder="Fecha Oficio" value="{{$fomope->fechaOficio}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                    <small name= "alertFechaIngreso" id= "alertFechaIngreso" class="text-danger">
                    </small>  
                </div>
            
            <div class="form-row">
                <div class="form-group col-md-13">
                    <label class="plantilla-label estilo-colorg" for="fechareci">*Fecha de recibido:</label>
                    <input onkeypress="return pulsar(event)" type="date" class="form-control border border-dark" id="fechareci" name="fechareci" placeholder="Fecha de recibido" value="{{$fomope->fechaRecibido}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                    <small name= "alertFechaIngreso" id= "alertFechaIngreso" class="text-danger">
                    </small>  
                </div>
            </div>
                <div class="form-row">
                <div class="form-group col-md-114">
                    <label class="plantilla-label estilo-colorg" for="codigo">*Código:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control border border-dark" id="codigo" name="codigo" placeholder="Ej. 165" value="{{$fomope->codigo}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                </div>
            </div>
        </div>
                <div class="form-row">
                <div class="form-group col-md-10">
                    <label class="plantilla-label estilo-colorg" for="NO">No. de puesto:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control border border-dark" id="num_pues" name="num_pues" placeholder="Ej. 0001" value="{{$fomope->n_puesto}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>

            </div>
                <div class="form-group col-md-7">
                    <label class="plantilla-label estilo-colorg" for="NO">Clave presupuestaria:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control border border-dark" id="clavepres" name="clavepres" placeholder="Ej. 0001" value="{{$fomope->clavePresupuestaria}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                </div>
            
                
                <div class="form-group col-md-12">
                    <label class="plantilla-label estilo-colorg" for="codmov">*Código de movimiento:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control cod2 border border-dark" id="cod2_1" name="cod2_1" placeholder="Ej. 4550" value="{{$fomope->codigoMovimiento}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                        <div class="text-center">
                            <label class="plantilla-label estilo-colorg" for="del2">*Del:</label>
                        </div>
                        <input onkeypress="return pulsar(event)" type="date" class="form-control border border-dark" id="del2" name="del2" placeholder="Del" value="{{$fomope->vigenciaDel}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                        <small name= "alertVigencia" id= "alertVigencia" class="text-danger">
                        </small> 
                    </div>
                    <div class="form-group col-md-6">
                        <div class="text-center">
                            <label class="plantilla-label estilo-colorg" for="al3">al:</label>
                        </div>
                        <input onkeypress="return pulsar(event)" type="date" class="form-control border border-dark" id="al3" name="al3" placeholder="al" value="{{$fomope->vigenciaAl}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly> <!---->
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label class="plantilla-label estilo-colorg" for="estad">*Estado:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control border border-dark" id="estad" name="estad" placeholder="Ej. Ciudad de México" maxlength="13" value="{{$fomope->entidad}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                </div>
                <div class="form-group col-md-5">
                    <label class="plantilla-label estilo-colorg" for="consema">*Consecutivo maestro de puestos:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control colon border border-dark" id="consema" name="consema" placeholder="Ej. 170" value="{{$fomope->consecutivoMaestroPuestos}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label class="plantilla-label estilo-colorg" for="plaza1">*Plaza:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control colon border border-dark" id="plaza1" name="plaza1" placeholder="Ej. 1" value="{{$fomope->puestos}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                </div>
            </div>
                <div class="form-group col-md-5">
                    <label class="plantilla-label estilo-colorg" for="observ">*Observaciones:</label>
                    <input onkeypress="return pulsar(event)" type="text" class="form-control colon border border-dark" id="observ" name="observ" placeholder="Ej. 11-01-19 LA DIRECTORA GENERAL INDICA QUE SE REQUIERE OFICIO DE AUTORIZACION CON JUSTIFICACION PARA OCUPACION." value="{{$fomope->observaciones}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                </div>
                
                <div class="form-group col-md-6">
                    <label class="plantilla-label estilo-colorg" for="fechaendipsp">*Fecha de envio DIPSP:</label>
                    <input onkeypress="return pulsar(event)" type="date" class="form-control border border-dark" id="fechaendipsp" name="fechaendipsp" placeholder="Fecha de envio a firma DGRH" value="{{$fomope->fechaEnviadaRubricaDipsp}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                    <small name= "alertFechaIngreso" id= "alertFechaIngreso" class="text-danger">
                    </small>  
                </div>


                 <div class="form-group col-md-6">
                    <label class="plantilla-label estilo-colorg" for="fechaendgrh">*Fecha de envio a firma DGRH:</label>
                    <input onkeypress="return pulsar(event)" type="date" class="form-control border border-dark" id="fechaendgrh" name="fechaendgrh" placeholder="Fecha de envio a firma DGRH" value="{{$fomope->fechaEnviadaRubricaDgrho}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                    <small name= "alertFechaIngreso" id= "alertFechaIngreso" class="text-danger">
                    </small>  
                </div>

                <div class="form-group col-md-6">
                    <label class="plantilla-label estilo-colorg" for="fecharecspc">*Fecha de recibido en SPC:</label>
                    <input onkeypress="return pulsar(event)" type="date" class="form-control border border-dark" id="fecharecspc" name="fecharecspc" placeholder="Fecha de recibido en SPC" value="{{$fomope->fechaRecepcionSpc}}"  onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                    <small name= "alertFechaIngreso" id= "alertFechaIngreso" class="text-danger">
                    </small>  
                </div>
                <div class="form-group col-md-6">
                    <label class="plantilla-label estilo-colorg" for="fechenvvb">*Fecha de envio a VoBo SPC:</label>
                    <input onkeypress="return pulsar(event)" type="date" class="form-control border border-dark" id="fechenvvb" name="fechenvvb" placeholder="Fecha de envio a VoBo SPC" value="{{$fomope->fechaEnvioSpc}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                    <small name= "alertFechaIngreso" id= "alertFechaIngreso" class="text-danger">
                    </small>  
                </div>

                
                <div class="form-group col-md-5">
                    <label class="plantilla-label estilo-colorg" for="foliospc">*Folio SPC:</label>
                    <input onkeypress="return pulsar(event)"  type="text" class="form-control colon border border-dark" id="foliospc" name="foliospc" placeholder="Ej. 2020" value="{{$fomope->folioSpc}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly>
                </div>
                <div class="form-group col-md-6">
                        <div class="text-center">
                            <label class="plantilla-label estilo-colorg" for="fechanom">Fecha captura nomina:</label>
                        </div>
                        <input onkeypress="return pulsar(event)" type="date" class="form-control border border-dark" id="fechanom" name="fechanom" placeholder="Ej" value="{{$fomope->fechaCapturaNomina}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly> <!--required-->
                    </div>
                 <div class="form-group col-md-6">
                        <div class="text-center">
                            <label class="plantilla-label estilo-colorg" for="al3">Fecha entregada del trabajador para archivo gral.- Lourdes Arredondo Cortes:</label>
                        </div>
                        <input onkeypress="return pulsar(event)" type="date" class="form-control border border-dark" id="fechaenlo" name="fechaenlo" placeholder="fechaenlo" value="{{$fomope->fechaEntregaArchivo}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required readonly> <!--required-->
                    </div>

        <!--</form>-->

    </div>
    <br><br>
    

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                              Autorizar
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Autorización Fomope</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    ¿Está seguro que la información a autorizar es la correcta?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
                                       <button type="submit" class="btn btn-primary">Autorizar</button>
                                       
                                  </div>
                                </div>
                              </div>
                            </div>
                            <br>
                            </form>
                            <br>

                <form name="captura" action="{{route('DSPO.observacion')}}" method="POST"> 
                    @csrf
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal1" data-whatever="@getbootstrap" >Rechazar</button>

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
                                  {{-- comment 
                                  
                                 
                                    <textarea class="form-control border border-dark" id="obs" name="obs" rows = "4" value = "" placeholder="Observación por rechazo" required></textarea>
                                 --}}
            
                                    <input type="text" class="form-control" id="rechazoM" name="rechazoM" value="" placeholder="Observación por rechazo" required>
                                 <div class="form-row">
                                    <input type="text" class="form-control" id="noFomope" name="noFomope" value="{{$fomope->id_movimiento}}" style="display:none">
                                    </div>
                                    <div class="form-row">
                        <input type="text" class="form-control" id="color_esta" name="color_esta" value="{{$fomope->color_estado}}" style="display:none">
                    </div>
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
                                <button type="submit" class="btn btn-primary">Rechazar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                </form>

      </center>

@endsection