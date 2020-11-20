@extends('layouts.siconPlantilla')
@section('title', 'Lulu')

<?php			$usuarioSeguir =  "Lulu";			?>

<script type="text/javascript">

	function obtenerRadioSeleccionado(formulario, nombre, userRol){
		var contador = 0;
		 elementosSelectR = [];
		 elementos = document.getElementById(formulario).elements;
		 longitud = document.getElementById(formulario).length;
		 for (var i = 0; i < longitud; i++){
			 if(elementos[i].name == nombre && elementos[i].type == "checkbox" && elementos[i].checked == true){
						elementosSelectR[contador]=elementos[i].value;
						//alert(elementosSelectR[contador]);
						contador++;
			 }
		 }
		 if(contador > 0){
			window.location.href = './Controller/autorizarTodoLulu.php?id_fomope='+elementosSelectR+'&idSeguir='+userRol;

		 }
		 //return false;
	} 

</script>





@section('content')
<h1>Bienvenido a la pagina lulu</h1>
@foreach ($Fomope as $Fomopes)
<?php echo hola;
if($Fomopes->color_estado==$usuario){ ?>
<h3>{{$Fomopes->color_estado}}</h3>
<?php }	?>
@endforeach

@endsection

