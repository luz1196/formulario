<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>editar Clase Usuario</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<link rel="stylesheet" href="../fonts/fontawesome/css/all.css">
	<link rel="stylesheet" href="../fonts/fontawesome/css/fontawesome.css">


	<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php

include ('../conexionDB/conexionBD.php');
include('../includes/header.php');

if (isset($_GET['editarClaseUsuario'])) {

	$editarId = $_GET['editarClaseUsuario'];

	$consultaEditar = "SELECT * FROM clase_usuario WHERE id ='$editarId'";

	$ejecutarEditar = mysqli_query ($enlace, $consultaEditar);
	$fila = mysqli_fetch_array($ejecutarEditar);
	
	$avances = $fila['avance'];
	$avanceVideos = $fila['avanceVideo'];
	$usuarios = $fila['idUsuario'];
	$cursos = $fila['idCurso'];
	$modulos = $fila['idModulo'];
	$clases = $fila['idClase'];
}
?>

<div class="modal">
	<div class="form-modal" class="w-50" align="center">
		<form method="POST"  action="../lógica/lib.php">
			<h3 class="text-center">Editar clase Usuario</h3>
			<input type="hidden" value="<?php echo $editarId; ?>" name="editarId">

			
			<!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label text-aling="left" style="font-size:17px;">Avance</label>
				<input type="text" placeholder="avance" value="<?php echo $avances; ?>" class="form-control w-50" name="avance" required>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label text-aling="left" style="font-size:17px;">Avance video</label>
				<input type="text" placeholder="avance Video" value="<?php echo $avanceVideos; ?>" class="form-control w-50" name="avanceVideo" required>
			</div>-->

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Usuario</label>
				<input list="usuario" placeholder="usuario" value="<?php echo $usuarios;?>" class="form-control" name="idUsuario" required> 
				<datalist id="usuario">
						<?php
						$registros=mysqli_query($enlace,"select id, nombreUsuario from usuario") or
 						die("Problemas en el select:".mysqli_error($enlace));
 						while ($reg=mysqli_fetch_array($registros))
 						{
  						echo "<option value='".$reg[id]."'>".$reg[nombreUsuario]."</option>";
  						}
						?>
					</datalist>
			</div>	

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Curso</label>
				<select placeholder="curso" value="<?php echo $cursos; ?>" class="form-control" name="idCurso" required
				<?php
					$registros=mysqli_query($enlace,"select id, nombre from curso") or
 					die("Problemas en el select:".mysqli_error($enlace));
					while ($reg=mysqli_fetch_array($registros))
						{
  						echo "<option value='$reg[id]'>$reg[nombre]</option>";
						}
					?>;>	
					<option disabled selected>CURSO</option></select> 		
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Modulo</label>
				<select placeholder="modulo" value="<?php echo $modulos; ?>" class="form-control" name="idModulo" required
					<?php
					$registros=mysqli_query($enlace,"select id, nombre from modulo") or
 					die("Problemas en el select:".mysqli_error($enlace));
					while ($reg=mysqli_fetch_array($registros))
						{
  						echo "<option value='$reg[id]'>$reg[nombre]</option>";
						}
					?>;>	
					<option disabled selected>MODULO</option></select> 
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Clase</label>
				<select placeholder="clase" value="<?php echo $clases; ?>" class="form-control" name="idClase" required 
				<?php
					$registros=mysqli_query($enlace,"select id, contenidoClase from clase") or
 					die("Problemas en el select:".mysqli_error($enlace));
					while ($reg=mysqli_fetch_array($registros))
						{
  						echo "<option value='$reg[id]'>$reg[contenidoClase]</option>";
						}
					?>;>	
					<option disabled selected>CLASE</option></select>
			</div>

			<br>
			<div align="center">
				<button name="actualizarClaseUsuario" class="btn btn-success" type="submit" style="width: 180px">	
					Actualizar
					<i class="fas fa-pen"></i>
				</button>
			</div>
		</form>
		
	</div>
</div>
</body>
</html>