$(document).ready(function(){
    $(document).on('keydown', '.rfcL', function(){
        var id = this.id;
        var splitid = id.split('_');
        var indice = splitid[1];
        $('#'+id).autocomplete({
            source: function(request, response){
                $.ajax({
                    url: "resultados_rfc.php",
                    type: 'post',
                    dataType: "json",
                    data: {
                        busqueda: request.term,request:1

                    },
                    success: function(data){
                        response(data);
                        
                    }
                });
            },select: function (event, ui){
                $(this).val(ui.item.label);
                var buscarid = ui.item.value;
                console.log(buscarid);
                //alert(buscarid);
                $.ajax({
                    url: 'resultados_rfc.php',
                    type: 'post',
                    data: {
                        buscarid:buscarid,request:2,
                        
                    },
                    success: function(data){
                        var infEmpleado = eval(data);
                        console.log(data);
                        console.log(infEmpleado[0].apellido1);
                          console.log(infEmpleado.length);

                        //document.getElementById("rfc").value = infEmpleado[1] ;
                        document.getElementById("apellido1").value = infEmpleado[0].apellido1 ;
                        document.getElementById("apellido2").value = infEmpleado[0].apellido2 ;
                        document.getElementById("nombre").value = infEmpleado[0].nombre ;
                        
                      for(var i=1; i < infEmpleado.length; i++){ 
                            console.log(infEmpleado[i]);
                            if(infEmpleado[i].id != null){

                            var miSelect2 = document.getElementById("movFecha");
                            var aTag = document.createElement('option');
                            aTag.setAttribute('value',infEmpleado[i].id);
                            aTag.innerHTML = "( Codigo: "+infEmpleado[i].codigo+" ) ( Fecha: "+infEmpleado[i].fecha+" ) (Qna: "+infEmpleado[i].qna+") (Año: "+infEmpleado[i].anio+" )";
                            miSelect2.appendChild(aTag);
                            }
                        }


                    }
                });
                return false;
            }
        });
    });
});
