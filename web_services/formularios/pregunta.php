<?php 	
include  ('../conexionDB/conexionBD.php');
include('../includes/header.php'); 

error_reporting(E_ALL ^ E_NOTICE);


$error = false;

if(isset($_POST['enviar'])){
	
	$pregunta = $_POST['pregunta'];
	$primeraRespuesta = $_POST['primeraRespuesta'];
	$segundaRespuesta = $_POST['segundaRespuesta'];
	$terceraRespuesta = $_POST['terceraRespuesta'];
	$cuartaRespuesta = $_POST['cuartaRespuesta'];
	$respuestaCorrecta = $_POST['respuestaCorrecta'];
	$idContenidoPregunta = $_POST['idContenidoPregunta'];

		$contenidoAuxiliar= "content/Contenido_Auxiliar/".$_FILES['contenidoAuxiliar']['name'];
						
		//$tipo_archivo = $_FILES['contenidoAuxiliar']['type'];
		$tamano_archivo = $_FILES['contenidoAuxiliar']['size'];
		$rutaP = "../../content/Contenido_Auxiliar/" . $_FILES['contenidoAuxiliar']['name'];
		$ext = pathinfo($_FILES['contenidoAuxiliar']['name'], PATHINFO_EXTENSION);


	if(isset($_FILES['contenidoAuxiliar'])){
				if($ext != "pdf" && $ext != "doc" && $ext != "docx")
		{
			Echo "Formato de archivo no permitido";

		}else if($tamano_archivo > 50000000 )
			{
				Echo "Tamaño de archivo no permitido";

				}else{
						
						$guardar = @move_uploaded_file($_FILES["contenidoAuxiliar"]["tmp_name"], $rutaP);

							$insertSQL = "INSERT INTO pregunta VALUES (null,

								'$pregunta', 
								'$primeraRespuesta',
								'$segundaRespuesta',
								'$terceraRespuesta',
								'$cuartaRespuesta',
								'$respuestaCorrecta',
								'$contenidoAuxiliar',
								'$idContenidoPregunta')";

							$ejecutarSQL = mysqli_query($enlace, $insertSQL) or die ("error");
						
				}
		
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Pregunta</title>
</head>

<body>

	<button type="button" class="btn-warning">Crear Pregunta</button>
	<br>
	<?php 
	if ($error) {
		echo $error;							
	}
	?>

<div class="modal" style="display: none;">
	<div class="form-modal" class="w-50" align="center">
		<form action="" method="post"  enctype="multipart/form-data">
				<h3>Crear  Pregunta</h3>
				
	
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Pregunta</label>
					<input type="text"  class="form-control" name="pregunta" required>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Primera respuesta</label>
					<input type="text" class="form-control" name="primeraRespuesta" required>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Segunda respuesta</label>
					<input type="text"  class="form-control" name="segundaRespuesta" required>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Tercera respuesta</label>
					<input type="text"  class="form-control" name="terceraRespuesta" required>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Cuarta respuesta</label>
					<input type="text"  class="form-control" name="cuartaRespuesta" required>
				</div>


				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Respuesta Correcta</label>
					<select  class="form-control" name="respuestaCorrecta">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					</select>
				</div>
	
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Agregar Contenido Auxiliar</label>
					<input type="file" class="form-control" name="contenidoAuxiliar" accept="video/*, application/pdf">
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Contenido Pregunta</label>
					<select class="form-control" name="idContenidoPregunta" style="font-size: 15px" required>
					<?php
					$registros=mysqli_query($enlace,"select id, descripcion from contenido_pregunta") or
 					die("Problemas en el select:".mysqli_error($enlace));
					while ($reg=mysqli_fetch_array($registros))
						{
  						echo "<option value='".$reg[id]."'>".$reg[descripcion]."</option>";
						}
					?>;>
					<option disabled selected></option>
				</select>
				</div>

				<br>
				<div align="center">
					<button name="enviar" type="submit" class="btn btn-success" style="width: 180px">	
						Crear
						<i class="fas fa-pen"></i>
					</button>
				</div>
		</form> 

	</div>
</div>


	<br>
	<table class="table table-hover text-center">
		<tr>
			<th>Pregunta</th>
			<th>Respuesta 1</th>
			<th>Respuesta 2</th>
			<th>Respuesta 3</th>
			<th>Respuesta 4</th>
			<th>Repuesta Correcta</th>
			<th>Contenido Auxiliar</th>
			<th>Descripción Contenido</th>
			<th><i class="fas fa-pen"></i></th>
			<th><i class="fas fa-trash"></i></th>
			<th></th>
			<th></th>
		</tr>

		<?php

		$consultaRegistros = "SELECT p.id, pregunta, primeraRespuesta,segundaRespuesta,terceraRespuesta, cuartaRespuesta, respuestaCorrecta,
			contenidoAuxiliar, c.descripcion from pregunta as p
			left join contenido_pregunta as c ON p.idContenidoPregunta= c.id";
		$ejecutarRegistros = mysqli_query($enlace, $consultaRegistros); 
		$verFilas = mysqli_num_rows($ejecutarRegistros);
		$fila = mysqli_fetch_array($ejecutarRegistros);

		if (!$ejecutarRegistros) {
			echo 'Error.';
		} else {
			if ($verFilas<1) {
				echo '<tr><td>Sin registro</td></tr>';
			} else {
				for ($i = 0; $i < $fila; $i++) {
					echo '<tr>
					<td>'.$fila[1].'</td>
					<td>'.$fila[2].'</td>
					<td>'.$fila[3].'</td>
					<td>'.$fila[4].'</td>
					<td>'.$fila[5].'</td>
					<td>'.$fila[6].'</td>
					<td>'.$fila[7].'</td>
					<td>'.$fila[8].'</td>
					<td> <a href="../htmlEditar/editarPregunta.php?editarPregunta='.$fila[0].'"> Editar </a> </td>
					<td> <a a Onclick="confirmarBorrar('.$fila[0].');" style="color:#FF9C9D"> Borrar </a> </td>
					</a> </td>
					</tr>';
					$fila = mysqli_fetch_array($ejecutarRegistros);
				}
			}
		}
		?>
	</table>

		<br><br>
	<br><br>

	<?php include('../includes/footer.php'); ?>
	<script>
	$('.btn-warning').click(function() {
		$('.modal').toggle();
			$('.table').hide();
	});

	function confirmarBorrar(y){
            var confirmar = confirm("¿Esta seguro de eliminar este registro? ");
            if (confirmar == true) {

                 window.location.href="../lógica/lib.php?eliminarPregunta="+y;

            } else {
                 window.location ="pregunta.php";

            }
        }

	</script>
</body>
</html>