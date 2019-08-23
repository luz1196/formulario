<?php

include  ('conexionDB/conexionBD.php');

$error = false;

if(isset($_POST['enviar'])){

	$nombre = $_POST['nombre'];
	$correo = $_POST['correo'];
	$ciudad = $_POST['ciudad'];
	$clave = $_POST['clave'];
	$nombreUsuario = $_POST['nombreUsuario'];
	$telefono = $_POST['telefono'];
	$celular = $_POST['celular'];
	$autorizado = $_POST['autorizado'];

	$clavecif = password_hash($clave, PASSWORD_DEFAULT, array("cost"=>12));

	$validarCorreo = mysqli_query($enlace,"select correo from usuario where correo='$correo'"); 
	$validarNombreUsuario = mysqli_query($enlace,"select nombreUsuario from usuario where nombreUsuario='$nombreUsuario'"); 

	if(mysqli_num_rows($validarCorreo)>0) { 
		$error = '<h5 style="color: red;">Correo ya registrado.</h5> <br>';; 
	} else {

		if(mysqli_num_rows($validarNombreUsuario)>0) { 
			$error = '<h5 style="color: red;">Nombre de usuario ya registrado.</h5> <br>';
		} else {

			if (is_numeric($telefono) && is_numeric($celular)) {

				if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
					$insertSQL = "INSERT INTO usuario VALUES (null,
					'$nombre', 
					'$correo',
					'$ciudad',
					'$clavecif',		
					'$nombreUsuario',
					'$telefono',
					'$celular',
					'$autorizado')";

					$ejecutarSQL = mysqli_query($enlace, $insertSQL);

					if ($ejecutarSQL) {
						echo "<script>alert('Registro exitoso.')</script>";
						echo "<script>window.open('index.php','_self')</script>";
					}

				} else {
					$error = '<h5 style="color: red;">Ingrese un correo válido.</h5> <br>';
				}

			} else {
				$error = '<h5 style="color: red;"> El teléfono y celular deben ser números. </h5> <br>';
			}
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registro</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" href="fonts/fontawesome/css/all.css">
	<link rel="stylesheet" href="fonts/fontawesome/css/fontawesome.css">

	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="wrapper">
		<?php include('includes/headerI.php'); ?>
		<div class="container-fluid">	
			<div class="row">	
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 offset-md-6">
					<form method="post" enctype="multipart/form-data">
						<h3> Formulario de registro </h3>
						<?php 
						if ($error) {
							echo $error;							
						}
						?>
						<div>
							<input type="text" placeholder="nombre" class="form-control" name="nombre" required>
						</div>
						<div>
							<input type="email" placeholder="correo electronico" class="form-control" name="correo" required>
						</div>
						<div>
							<input type="text" placeholder="ciudad" class="form-control" name="ciudad" required>
						</div>
						<div>
							<input type="password" placeholder="contraseña" class="form-control" name="clave" style="font-size: 15px;">
						</div>
						<div>
							<input type="text" placeholder="nombre de usuario" class="form-control" name="nombreUsuario" required>
						</div>
						<div>
							 <input type="text" placeholder="teléfono" class="form-control" name="telefono" required> 
						</div>
						<div>
							<input type="text" placeholder="celular" class="form-control" name="celular" required>
						</div>
						<div>
							<h5>Autorizado:
								Sí <input type="radio" name="autorizado" value="Sí" required>
								No <input type="radio" name="autorizado" value="No" required> 
							</h5>
						</div>
						<br>
						<button name="enviar" class="btn btn-success" style="width: 180px">	
							Regístrese
							<i class="fas fa-pen"></i>
						</button>

						<a href="login.php" class="btn btn-info" style="width: 125px; padding: 0.65rem 0.5rem; font-family: Montserrat-SemiBold">
							Volver
							<i class="fas fa-arrow-left"></i>
						</a>
					</form>
				</div>
			</div>	
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="fonts/fontawesome/js/fontawesome.js"></script>
	<script src="js/main.js"></script>
</body>
</html>

