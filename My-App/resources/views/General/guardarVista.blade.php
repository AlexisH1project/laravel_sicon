@extends('layouts.adminlte')
@extends('layouts.librerias')

@section('content')
<!-- <link rel = "stylesheet" href= "{{ asset('css/jquery/jquery-ui.min.css') }}"> -->

    <!-- <form  enctype="multipart/form-data" id="formDatos" name="captura1" action="" method="POST">  -->
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group col-md-12">
                                    <label class="plantilla-label" for="elRfc">*CURP:</label>
                                    
                                    <input type="text" class="" id="curp" name="curp" placeholder="CURP" placeholder="Ingresa curp" maxlength="13"  required>
                                </div>
                            </div>
                        </div>
                        <input type="button" class="" value="Aceptar" name="botonAccion">              
	<!-- </form> -->

    <script>
 
        alert("sss");

        var opciones = ['carro', 'moto', 'bici'];
        $(document).ready(function () { 
           $('#curp').autocomplete({
                source: function(request, response){
                    $.ajax({
                        url:"{{ route('serch.guadarDoc')}}",
                        dataType:'json',
                        data:{
                            term: request.term
                        },
                        success: function(data){
                            response(data)
                            
                        }
                    });
                }
            });
        });
        // $(document).ready(function () { 
                
        //         $('#curp').autocomplete({
        //         source: opciones
                
        //         });
        //     });
    </script>
@endsection


