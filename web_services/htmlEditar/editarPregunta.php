<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>editarPregunta</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<link rel="stylesheet" href="../fonts/fontawesome/css/all.css">
	<link rel="stylesheet" href="../fonts/fontawesome/css/fontawesome.css">


	<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php

include ('../conexionDB/conexionBD.php');

error_reporting(E_ALL ^ E_NOTICE);

if (isset($_GET['editarPregunta'])) {

	$editarId = $_GET['editarPregunta'];

	$consultaEditar = "SELECT * FROM pregunta WHERE id ='$editarId'";

	$ejecutarEditar = mysqli_query ($enlace, $consultaEditar);
	$fila = mysqli_fetch_array($ejecutarEditar);
	
	$preguntas = $fila['pregunta'];
	$primeraRespuestas = $fila['primeraRespuesta'];
	$segundaRespuestas = $fila['segundaRespuesta'];
	$terceraRespuestas = $fila['terceraRespuesta'];
	$cuartaRespuestas = $fila['cuartaRespuesta'];
	$respuestaCorrectas = $fila['respuestaCorrecta'];
	$contenidoAuxiliars = $fila['contenidoAuxiliar'];
	$idContenidoPreguntas = $fila['idContenidoPregunta'];

	$des_Pregunta= "SELECT descripcion FROM contenido_pregunta WHERE id=".$idContenidoPreguntas;
	$preguntaName= mysqli_query($enlace, $des_Pregunta);

	if ($reg =mysqli_fetch_array($preguntaName)) {
		$desc_pregunta = $reg['descripcion'];
	}
	
}

?>

<div class="modal">
	<div class="form-modal" class="w-100" align="center">

		<form method="POST" action="../lógica/lib.php" enctype="multipart/form-data">
			<h3 class="text-center">Editar Pregunta</h3>
			<input type="hidden" value="<?php echo $editarId; ?>" name="editarId">
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Pregunta</label>
				<input type="text" placeholder="pregunta" value="<?php echo $preguntas; ?>" class="form-control" name="pregunta" required>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Primera respuesta</label>
				<input type="text" placeholder="primera Respuesta" value="<?php echo $primeraRespuestas; ?>" class="form-control" name="primeraRespuesta" required>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Segunda respuesta</label>
				<input type="text" placeholder="segunda Respuesta" value="<?php echo $segundaRespuestas; ?>" class="form-control" name="segundaRespuesta" required>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Tercera respuesta</label>
				<input type="text" placeholder="terceraRespuesta" value="<?php echo $terceraRespuestas; ?>" class="form-control" name="terceraRespuesta" required>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label text-aling="left" style="font-size:17px;">Cuarta respuesta</label>
				<input type="text" placeholder="cuartaRespuesta" value="<?php echo $cuartaRespuestas; ?>" class="form-control" name="cuartaRespuesta" required> 
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Respuesta Correcta</label>
				<input type="text" placeholder="respuestaCorrecta" value="<?php echo $respuestaCorrectas; ?>" class="form-control" name="respuestaCorrecta" required>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Agregar Contenido Auxiliar</label>
				<input type="file" placeholder="contenidoAuxiliar" value="<?php echo $contenidoAuxiliars; ?>" class="form-control" name="contenidoAuxiliar" accept="video/*, application/pdf">
				<input type="hidden" name="prevcontAux" value="<?php echo $contenidoAuxiliars; ?>"/>
					
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Contenido regunta</label>

				<select placeholder="idContenidoPregunta" class="form-control" name="idContenidoPregunta" required>
				 <option value="<?php echo $idContenidoPreguntas; ?>" selected=""><?php echo $desc_pregunta;?>
				</option>
					<?php
					$registros=mysqli_query($enlace,"select id, descripcion from contenido_pregunta") or
 					die("Problemas en el select:".mysqli_error($enlace));
					while ($reg=mysqli_fetch_array($registros))
						{
  						echo "<option value='".$reg[id]."'>".$reg[descripcion]."</option>";
  						}
					?>;
					</select>
			</div>

			<br>
			<div align="center">
				<button name="actualizarPregunta" class="btn btn-success" type="submit" style="width: 180px">	
					Actualizar
					<i class="fas fa-pen"></i>
				</button>
			</div>

		</form>
	</div>
</div>
</body>
</html>