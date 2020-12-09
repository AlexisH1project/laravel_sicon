@extends('layouts.adminlte')

@section('content')
<div class='background_content'>
         <!-- Page Content  -->
         <div id="content" class="p-4 p-md-5 pt-5">
      	<center>
				<form method="post" action=""> 
				<div class="rounded border border-dark plantilla-inputv text-center">

				  			<label  class="plantilla-label estilo-colorg" for="nombreT">NOMBRE COMPLETO: </label>
					<div class="form-row">
						   <div class="form-group col-md-4">
						        <input type="text" class="form-control unexp border border-dark" id="apellido1" name="apellido1" placeholder="Apellido Paterno" maxlength="30" required>
						      </div>	
						     <div class="form-group col-md-4">
						        <input type="text" class="form-control unexp border border-dark" id="apellido2" name="apellido2" placeholder="Apellido Materno" maxlength="30" required>
						      </div>

						     <div class="form-group col-md-4">
						        <input type="text" class="form-control unexp border border-dark" id="nombre" name="nombre" placeholder="Nombre" maxlength="40" value="" required >
						      </div>
				<div class="col-sm-12">
					<div class="form-row">

					<div class="form-group col-md-12">
						<div class="col text-center">
							<input type="submit" name="buscar" class="btn btn btn-danger tamanio-button plantilla-input text-white bord" value="Buscar"><br>

							<!-- <button type="submit" name="buscar" class="btn btn-outline-info tamanio-button">Buscar</button> -->
						</div>
					</div>

					</div>
				</div>
			</form>
		</div>
    </center>

    <br>
		<br>

		<table class="table table-hover table-white">
						<thead>
						    <tr>
							<!-- <td>Observacion</td>
							<td>ID Fomope</td> -->
						      <th class="estilo-colorg" scope="titulo">Nombre</th>
						      <th class="estilo-colorg" scope="titulo">Archivo</th>
						      
						   </tr>
					 	 </thead>

					<?php 
						$banderHay = 0;
						if($request->has('buscar')){// $_SERVER['REQUEST_METHOD'] == 'POST' if(){
							$elNombre = strtoupper($_POST['nombre']);
							$elApellido1 = strtoupper($_POST['apellido1']);
							$elApellido2 = strtoupper($_POST['apellido2']);
							//echo $elApellido1 . $elApellido2 .  $elNombre;

								$dir_subida = './Controller/documentos/';

								// Arreglo con todos los nombres de los archivos
								$files = array_diff(scandir($dir_subida), array('.', '..')); 
								
								foreach($files as $file){
								    // Divides en dos el nombre de tu archivo utilizando el . 
								    $data = explode("_",$file);
								    $data2 = explode("_.",$file);
									$indice = count($data2);	

									$extencion = $data2[$indice-1];
								    // Nombre del archivo
								    $extractRfc = $data[0];
								    $nameAdj = $data[1];

								    //Identificamos que nombre real de archivo es, interpretanso la nombreclatura doc_ 
					
						
										$sqlNombreDoc = "SELECT nombre_documento FROM m1ct_documentos WHERE documentos = '$nameAdj'";
										$resNombreDoc = mysqli_query($conexion,$sqlNombreDoc);
										$rowNombreDoc = mysqli_fetch_row($resNombreDoc);
										//$nombreAdescargar = $ver[4]."_".$ver[$i]."_".$ver[6]."_".$ver[7]."_".$ver[8]."_.PDF";

								    //echo $data[4];
								    // Extensión del archivo 

								    if(($data[2] == $elApellido1) AND ($data[3] == $elApellido2) AND ($data[4] == $elNombre)){
								      		$nombreCompleto = $elApellido1." ".$elApellido2." ".$elNombre;
								   			$banderHay ++;
								    		

						?>        	
						<tr>
													<td><?php echo $nombreCompleto  ?></td>
													<td><?php echo $rowNombreDoc[0] ?></td>
													<td>
													<form method="post" action="./Controller/verPDF.php">
														<input type="text" name="nombreDecarga" value="<?php echo $file ?>" style="display:none" >
														<input type="submit" name="Descargar" value="Ver"  class="btn btn-info">
														<!-- <button type="button" class="btn btn-info" id="" >Descargar</button>  -->
													</form>
													</td>
						</tr>
												
							<?php

									  }
								}
							?>

			<?php
								$dir_subida = './Controller/Documentos/';

								// Arreglo con todos los nombres de los archivos
								$files = array_diff(scandir($dir_subida), array('.', '..')); 
								
								foreach($files as $file){
								    // Divides en dos el nombre de tu archivo utilizando el . 
								    $data = explode("_",$file);
								    $data2 = explode("_.",$file);
									$indice = count($data2);	

									$extencion = $data2[$indice-1];
								    // Nombre del archivo
								    $extractRfc = $data[0];
								    $nameAdj = $data[1];

								    

								    if(($data[1] == $elApellido1) AND ($data[2] == $elApellido2) AND ($data[3] == $elNombre)){
								      		$nombreCompleto = $elApellido1." ".$elApellido2." ".$elNombre;
								   			$banderHay ++;
								    		

						?>        	
						<tr>
													<td><?php echo $nombreCompleto  ?></td>
													<td>Archivos de Loteo</td>
													<td>
													<form method="post" action="./Controller/decargaZip.php">
														<input type="text" name="nombreDecarga" value="<?php echo $file ?>" style="display:none" >
														<input type="submit" name="Descargar" value="Descargar"  class="btn btn-info">
														<!-- <button type="button" class="btn btn-info" id="" >Descargar</button>  -->
													</form>
													</td>
						</tr>
												
							<?php

										}
									}
									if($banderHay == 0){
											
											echo('
												<br>
												<br>
												<div class="col-sm-12 ">
												<div class="p-3 mb-5 bg-warning text-dark ">
												    <div class="card-body"><h2 align="center">No existe resultados de la busqueda, vuelve intentar.</h2></div>
											</div>
											</div>');
									}

						}
							?>

		</table>

</div>
@stop

@endsection