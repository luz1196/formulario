<?php 	
include  ('../conexionDB/conexionBD.php');
include('../includes/header.php'); 
error_reporting(E_ALL ^ E_NOTICE);

$error = false;

if(isset($_POST['enviar'])){

	$avance = $_POST['avance'];
	$terminado = $_POST['terminado'];
	$iniciado = $_POST['iniciado'];
	$favorito = $_POST['favorito'];
	$usuario = $_POST['idUsuario'];
	$curso = $_POST['idCurso'];
		

					$insertSQL = "INSERT INTO curso_usuario VALUES (null,
					'$avance', 
					'$terminado',
					'$iniciado',
					'$favorito',		
					'$usuario',
					'$curso')";

					$ejecutarSQL = mysqli_query($enlace, $insertSQL);
}

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Clase</title>
</head>

<body>

	<button type="button" class="btn-warning">Crear Curso Usuario</button>
	<br>
	<?php 
	if ($error) {
		echo $error;							
	}
	?>


	<div class="modal" style="display: none;">
		<div class="form-modal" class="w-50" align="center">
			<form method="post" >
				<h3> Crear Curso Usuario </h3>
				
				<!--
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">					
					<input type="number" placeholder="avance" class="form-control w-50" name="avance" required>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<input type="text" placeholder="terminado" class="form-control w-50" name="terminado" required>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<input type="text" placeholder="iniciado" class="form-control w-50" name="iniciado" required>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<input type="text" placeholder="favorito" class="form-control w-50" name="favorito" required>
				</div>-->

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Usuario</label>
					<input list="usuario" class="form-control" name="idUsuario" required>
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
					<label  style="font-size:17px;">Curso</label>
					<select class="form-control" name="idCurso" style="font-size: 15px" required>
					<?php
					$registros=mysqli_query($enlace,"select id, nombre from curso") or
 					die("Problemas en el select:".mysqli_error($enlace));
					while ($reg=mysqli_fetch_array($registros))
						{
  						echo "<option value='".$reg[id]."'>".$reg[nombre]."</option>";
  						}
					?>;
					<option disabled selected></option>
				</select>
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
	<table class="table table-hover text-center">
		<tr>
			<th>Usuario</th>
			<th>Curso</th>
			<th>Iniciado</th>
			<th>Avance</th>
			<th>Terminado</th>
			<th>Favorito</th>
			<th><i class="fas fa-pen"></i></th>
			<th><i class="fas fa-trash"></i></th>
			<th></th>
			<th></th>
		</tr>

		<?php

		$consultaRegistros = "SELECT cu.id, avance, terminado, iniciado, favorito, nombreUsuario, c.nombre from curso_usuario as cu 
			left join usuario as u ON cu.idUsuario = u.id
			left join curso as c ON cu.idCurso = c.id";
			
		$ejecutarRegistros = mysqli_query($enlace, $consultaRegistros); 
		$verFilas = mysqli_num_rows($ejecutarRegistros);
		$fila = mysqli_fetch_array($ejecutarRegistros);

		if (!$ejecutarRegistros) {
			echo 'Error.';
		} else {
			if ($verFilas<1) {
				echo '<tr><td>Sin registros</td></tr>';
			} else {
				for ($i = 0; $i < $fila; $i++) {
					echo '<tr>
					<td>'.$fila[5].'</td>
					<td>'.$fila[6].'</td>
					<td>'.$fila[3].'</td>
					<td>'.$fila[1].'</td>
					<td>'.$fila[2].'</td>
					<td>'.$fila[4].'</td>
					<td> <a href="../htmlEditar/editarCursoUsuario.php?editarCursoUsuario='.$fila[0].'"> Editar </a> </td>
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
            var confirmar = confirm("¿Esta seguro de eliminarlo? ");
            if (confirmar == true) {

                 window.location.href="../lógica/lib.php?eliminarCursoUsuario="+y;

            } else {
                 window.location ="curso_usuario.php";

            }
        }

</script>
</body>
</html>