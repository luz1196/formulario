<?php 	
include  ('../conexionDB/conexionBD.php');
include('../includes/header.php'); 

$error = false;

if(isset($_POST['enviar'])){

	$avance = $_POST['avance'];
	$avanceVideo = $_POST['avanceVideo'];
	$usuario = $_POST['idUsuario'];
	$curso = $_POST['idCurso'];
	$modulo = $_POST['idModulo'];
	$clase = $_POST['idClase'];
	
					$insertSQL = "INSERT INTO clase_usuario VALUES (null,
					'$avance',
					'$avanceVideo',
					'$usuario',
					'$curso',		
					'$modulo',
					'$clase')";

					$ejecutarSQL = mysqli_query($enlace, $insertSQL);

}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Clase Usuario</title>
</head>

<body>
	<button type="button" class="btn-warning">Crear Clase Usuario</button>
	<br>

	<div class="modal" style="display: none;">
		<div class="form-modal" class="w-50" align="center">

			<form method="post">
				<h3> Crear Clase Usuario </h3>
				
				<!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label text-aling="left" style="font-size:17px;">Avance</label>
					<input type="number" placeholder="avance" class="form-control w-50" name="avance" required>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label text-aling="left" style="font-size:17px;">Avance video</label>
					<input type="text" placeholder="avance Video" class="form-control w-50" name="avanceVideo" required>
				</div>-->

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Usuario</label>
					<select class="form-control" name="idUsuario" required
					<?php
					$registros=mysqli_query($enlace,"select id, nombre from usuario") or
 					die("Problemas en el select:".mysqli_error($enlace));
					while ($reg=mysqli_fetch_array($registros))
						{
  						echo "<option value='$reg[id]'>$reg[nombre]</option>";
						}
					?>;>			
						<option disabled selected></option>

					</select>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Curso</label>
					<select  class="form-control" name="idCurso" style="font-size: 15px"
					<?php
					$registros=mysqli_query($enlace,"select id, nombre from curso") or
 					die("Problemas en el select:".mysqli_error($enlace));
					while ($reg=mysqli_fetch_array($registros))
						{
  						echo "<option value='$reg[id]'>$reg[nombre]</option>";
						}
					?>;>			
						<option disabled selected></option>
					</select>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Modulo</label>
					<select  class="form-control" name="idModulo" style="font-size: 15px"
					<?php
					$registros=mysqli_query($enlace,"select id, nombre from modulo") or
 					die("Problemas en el select:".mysqli_error($enlace));
					while ($reg=mysqli_fetch_array($registros))
						{
  						echo "<option value='$reg[id]'>$reg[nombre]</option>";
						}
					?>;>	
					<option disabled selected></option></select>
				</div>

		
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Clase</label>
					<select  class="form-control" name="idClase" style="font-size: 15px"
					<?php
					$registros=mysqli_query($enlace,"select id, contenidoClase from clase") or
 					die("Problemas en el select:".mysqli_error($enlace));
					while ($reg=mysqli_fetch_array($registros))
						{
  						echo "<option value='$reg[id]'>$reg[contenidoClase]</option>";
						}
					?>;>	
					<option disabled selected></option></select>
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
			<th>Avance</th>
			<th>Video</th>
			<th>Usuario</th>
			<th>Curso</th>
			<th>Modulo</th>
			<th>Clase</th>
			<th><i class="fas fa-pen"></i></th>
			<th><i class="fas fa-trash"></i></th>
			<th></th>
			<th></th>
		</tr>

		<?php


/*SELECT id,contenidoClase,urlImagenPrev,descripcion,titulo,nombre,nombretipo 
from clase c
inner join modulo m on c.id = m.idmodulo 
inner join tipo_categoria tc on c.id = idtipoclase*/


		$consultaRegistros = "SELECT * FROM clase_usuario";
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
					<td>'.$fila[4].'</td>
					<td>'.$fila[5].'</td>
					<td>'.$fila[6].'</td>
					<td> <a href="../htmlEditar/editarClaseUsuario.php?editarClaseUsuario='.$fila[0].'">Editar</a> </td>
					<td> <a Onclick="confirmarBorrar('.$fila[0].');" style="color:#FF9C9D">Borrar</a> </td>
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
            var confirmar = confirm("¿Esta seguro de eliminarlo? ");
            if (confirmar == true) {

                 window.location.href="../lógica/lib.php?eliminarModulo="+y;

            } else {
                 window.location ="modulo.php";

            }
        }

</script>
</body>
</html>>