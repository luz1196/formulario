<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Usuario</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<link rel="stylesheet" href="../fonts/fontawesome/css/all.css">
	<link rel="stylesheet" href="../fonts/fontawesome/css/fontawesome.css">


	<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php

include  ('../conexionDB/conexionBD.php');
include('../includes/header.php');


if (isset($_GET['editarUsuario'])) {

	$editarId = $_GET['editarUsuario'];

	$consultaEditar = "SELECT * FROM usuario WHERE id ='$editarId'";

	$ejecutarEditar = mysqli_query ($enlace, $consultaEditar);
	$fila = mysqli_fetch_array($ejecutarEditar);

	$nombres = $fila['nombre']; 
	$correos = $fila['correo'];
	$ciudads = $fila['ciudad'];
	$nombreUsuarios = $fila['nombreUsuario'];
	$telefonos = $fila['telefono'];
	$celulars = $fila['celular'];
	$autorizados = $fila['autorizado'];
}
?>

<div class="modal">
	<div class="form-modal">
		<form method="POST" class="w-100" action="../lógica/lib.php">
			<h3 class="text-center">Editar usuario</h3>
			<input type="hidden" value="<?php echo $editarId; ?>" name="editarId">
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label text-aling="left" style="font-size:17px;">Nombre</label>
				<input type="text" placeholder="nombre" value="<?php echo $nombres; ?>" class="form-control" name="nombre" required>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label text-aling="left" style="font-size:17px;">Email</label>
				<input type="email" placeholder="correo" value="<?php echo $correos; ?>" class="form-control" name="correo" required>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label text-aling="left" style="font-size:17px;">Ciudad</label>
				<input type="text" placeholder="password" value="<?php echo $ciudads; ?>" class="form-control" name="ciudad" required>
			</div>




			<!--div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label text-aling="left" style="font-size:17px;">Contraseña</label>
				<input type="password"  value="<?php echo $ciudad; ?>" class="form-control" name="ciudad" required>
			</div-->




			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label text-aling="left" style="font-size:17px;">Usuario</label>
				<input type="text" placeholder="nombre de usuario" value="<?php echo $nombreUsuarios; ?>" class="form-control" name="nombreUsuario" required>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label text-aling="left" style="font-size:17px;">Número de telefono</label>
				<input type="text" placeholder="teléfono" value="<?php echo $telefonos; ?>" class="form-control" name="telefono" required> 
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label text-aling="left" style="font-size:17px;">Número de celular</label>
				<input type="text" placeholder="celular" value="<?php echo $celulars; ?>" class="form-control" name="celular" required>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h5>Autorizado:
					Sí <input type="radio" name="autorizado" value="Sí" required>
					No <input type="radio" name="autorizado" value="No" required> 
				</h5>
			</div>

			<br>
			<div align="center">
			<button name="actualizarUsuario" class="btn btn-success" type="submit" style="width: 180px">	
				Actualizar
				<i class="fas fa-pen"></i>
			</button>
		</div>
		</form>
	</div>
</div>
</body>
</html>