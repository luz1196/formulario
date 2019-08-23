<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>editarModulo</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<link rel="stylesheet" href="../fonts/fontawesome/css/all.css">
	<link rel="stylesheet" href="../fonts/fontawesome/css/fontawesome.css">


	<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php
error_reporting(E_ALL ^ E_NOTICE);

include ('../conexionDB/conexionBD.php');
include('../includes/header.php'); 



if (isset($_GET['editarModulo'])) {

	$editarId = $_GET['editarModulo'];

	$consultaEditar = "SELECT * FROM modulo WHERE id ='$editarId'";

	$ejecutarEditar = mysqli_query ($enlace, $consultaEditar);
	$fila = mysqli_fetch_array($ejecutarEditar);
	
	$nombres = $fila['nombre'];
	$numeroClasess = $fila['numeroClases'];
	$idCursos = $fila['idCurso'];

	$nombre_Cursos= "SELECT nombre FROM curso WHERE id=".$idCursos;
	$cursoName= mysqli_query($enlace, $nombre_Cursos);

	if($reg1=mysqli_fetch_array($cursoName))
	{
		$nombre_curso =$reg1['nombre'];
	}

}
?>

<div class="modal">
	<div class="form-modal" class="w-100" align="center">
		<form method="POST" action="../lógica/lib.php">
			<h3 class="text-center">Editar Modulo</h3>
			<input type="hidden" value="<?php echo $editarId; ?>" name="editarId">
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label text-aling="left" style="font-size:17px;">Nombre</label>
				<input type="text" placeholder="nombre" value="<?php echo $nombres; ?>" class="form-control" name="nombre" required>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label text-aling="left" style="font-size:17px;">Número de clases</label>
				<input type="number" placeholder="numero de lases" value="<?php echo $numeroClasess; ?>" class="form-control" name="numeroClases" required>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label text-aling="left" style="font-size:17px;">Curso</label>
				<select placeholder="curso" class="form-control" name="idCurso" required>
					<option value="<?php echo $idCursos; ?>" selected=""><?php echo $nombre_curso;?></option>
					<?php
					$registros=mysqli_query($enlace,"select id, nombre from curso") or
 					die("Problemas en el select:".mysqli_error($enlace));
					while ($reg=mysqli_fetch_array($registros))
						{
  						echo "<option value='".$reg[id]."'>".$reg[nombre]."</option>";
						}
					?>		
					</select>
			</div>	
			
			<br>
			<div align="center">
				<button name="actualizarModulo" class="btn btn-success" type="submit" style="width: 180px">	
					Actualizar
					<i class="fas fa-pen"></i>
				</button>
			</div>
			
		</form>
	</div>
</div>
</body>
</html>