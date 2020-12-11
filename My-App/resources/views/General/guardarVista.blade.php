@extends('adminlte::page')

@section('title', 'Guardar Vista')

@section('content_header')
<div class="header">
    <center>
    <h3>Sistema de Control de Registro de Formato de Movimiento de Personal</h3>
 <h5>Departamento Dirección General de Recursos Humanos y Organización/Dirección integral de puestos y servicios personales</h5>
    </center>
</div>

    <form enctype="multipart/form-data" method="post" action=""> 
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group col-md-12">
                                    <label class="plantilla-label" for="elRfc">*RFC:</label>
                                    
                                    <input type="text"  type="text" class="form-control rfcL border border-dark" id="rfcL_1" name="rfcL_1" placeholder="RFC" value="<?php if(isset($_POST["rfcL_1"])){ echo $_POST["rfcL_1"];} ?>"  onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Ingresa rfc" maxlength="13"  required>
                                </div>
                            </div>
                        </div>
	</form>
@stop
@extends('layouts.adminlte')

@section('content')


@endsection