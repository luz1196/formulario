<?php 	

include  ('../conexionDB/conexionBD.php');
include('../includes/header.php'); 

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
		$error = '<h5 class="text-center" style="color: red;">Correo ya registrado.</h5> <br>';; 
	} else {

		if(mysqli_num_rows($validarNombreUsuario)>0) { 
			$error = '<h5 class="text-center" style="color: red;">Nombre de usuario ya registrado.</h5> <br>';
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

				} else {
					$error = '<h5 class="text-center" style="color: red;">Ingrese un correo válido.</h5> <br>';
				}

			} else {
				$error = '<h5 class="text-center" style="color: red;"> El teléfono y celular deben ser números. </h5> <br>';
			}
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Usuario</title>
</head>

<body>
	<button type="button" class="btn-warning">Crear usuario</button>
	<br>
	<?php 
	if ($error) {
		echo $error;							
	}
	?>

	<div class="modal" style="display: none;">
		<div class="form-modal" class="w-50" align="center">

			<form method="post">
				<h3> Crear usuario </h3>
				
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Nombre</label>
					<input type="text" class="form-control " name="nombre" required>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label text-aling="left" style="font-size:17px;">Email</label>
					<input type="email" class="form-control " name="correo" required>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Cuidad</label>
					<input type="text" class="form-control " name="ciudad" required>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Contraseña</label>
					<input type="password" class="form-control " name="clave" style="font-size: 15px;">
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Usuario</label>
					<input type="text" class="form-control " name="nombreUsuario" required>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Número de elefono</label>
					<input type="number" class="form-control " name="telefono" required> 
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Número de celular</label>
					<input type="number" class="form-control" name="celular" required>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<h5>Autorizado:
						Sí <input type="radio" name="autorizado" value="Sí" required>
						No <input type="radio" name="autorizado" value="No" required> 
					</h5>
				</div>
				<br>
				<div align="center">
					<button name="enviar" class="btn btn-success" style="width: 180px">	
						Crear
						<i class="fas fa-pen"></i>
					</button>
				</div>
			</form> 
		</div>
	</div>

	<br>
	<br>
	<table class="table table-hover text-center">
		<tr>
			<th>Nombre</th>
			<th>Correo</th>
			<th>Ciudad</th>
			<th>Nombre de usuario</th>
			<th>Teléfono</th>
			<th>Celular</th>
			<th>Autorizado</th>
			<th><i class="fas fa-pen"></i></th>
			<th><i class="fas fa-trash"></i></th>
			<th></th>
			<th></th>
		</tr>

		<?php

		$consultaRegistros = "SELECT * FROM usuario";
		$ejecutarRegistros = mysqli_query($enlace, $consultaRegistros); 
		$verFilas = mysqli_num_rows($ejecutarRegistros);
		$fila = mysqli_fetch_array($ejecutarRegistros);

		if (!$ejecutarRegistros) {
			echo 'Error.';
		} else {
			if ($verFilas<1) {
				echo '<h5>Sin registros</h5>'; 
			} else {
				for ($i = 0; $i < $fila; $i++) {
					echo '<tr>
					<td>'.$fila[1].'</td>
					<td>'.$fila[2].'</td>
					<td>'.$fila[3].'</td>
					<td>'.$fila[5].'</td>
					<td>'.$fila[6].'</td>
					<td>'.$fila[7].'</td>
					<td>'.$fila[8].'</td>
					<td> <a href="../htmlEditar/editarUsuario.php?editarUsuario='.$fila[0].'"> Editar </a> </td>
					<td> <a Onclick="confirmarBorrar('.$fila[0].');" style="color:#FF9C9D"> Borrar </a> </td>
					</tr>';
					$fila = mysqli_fetch_array($ejecutarRegistros);
				}
			}
		}
		?>
	</table>
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

                 window.location.href="../lógica/lib.php?eliminarUsuario="+y;

            } else {
                 window.location ="usuario.php";

            }
        }

</script>
</body>

</html>