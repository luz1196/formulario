<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>editarCurso</title>
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

if (isset($_GET['editarCurso'])) {

	$editarId = $_GET['editarCurso'];

	$consultaEditar = "SELECT * FROM curso WHERE id ='$editarId'";

	$ejecutarEditar = mysqli_query ($enlace, $consultaEditar);
	$fila = mysqli_fetch_array($ejecutarEditar);
	
	$nombres = $fila['nombre'];
	$numeroModuloss = $fila['numeroModulos'];
	$horass = $fila['horas'];
	$fechaActualizacions = $fila['fechaActualizacion'];
	$descripcions = $fila['descripcion'];
	$profesors = $fila['profesor'];
	$disponibles = $fila['disponible'];

	$imagensC = $fila['urlImagen'];

	$calificacions = $fila['calificacion'];
	$destacados = $fila['destacado'];
	$sugeridos = $fila['cursosSugeridos'];
	$totals = $fila['totalClases'];
	$imagenminis = $fila['urlImagenMini'];

	$ruta1="../../content/".$nombres."/".$_FILES['urlImagenMini']['name'];
    

	$idTipoCategorias = $fila['idTipoCategoria'];
	$nombre_Categoria= "SELECT nombre_categoria FROM tipo_categoria WHERE id=".$idTipoCategorias;
	$categoriaName= mysqli_query($enlace, $nombre_Categoria);

	if($reg1 =mysqli_fetch_array($categoriaName))	{
		$nombre_categoria =$reg1['nombre_categoria'];
	}

}
?>

<div class="modal">
	<div class="form-modal" class="w-50" align="center">
		
		<form method="POST"  action="../lógica/lib.php" enctype="multipart/form-data">
			<h3 class="text-center">Editar curso</h3>
			<input type="hidden" value="<?php echo $editarId; ?>" name="editarId">
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Nombre</label>
				<input type="text" placeholder="nombre" value="<?php echo $nombres; ?>" class="form-control" name="nombre" required>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Número de Modulos</label>
				<input type="text" placeholder="numero Modulos" value="<?php echo $numeroModuloss; ?>" class="form-control" name="numeroModulos" required>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Horas</label>
				<input type="text" placeholder="horas" value="<?php echo $horass; ?>" class="form-control" name="horas" required>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Fecha de actualización</label>
				<input type="date" placeholder="fecha Actualizacion" value="<?php echo $fechaActualizacions; ?>" class="form-control" name="fechaActualizacion" required>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Descripción</label>
				<textarea placeholder="descripcion" value="<?php echo $descripcions; ?>" class="form-control" name="descripcion" rows="4"  required> 
					<?php
					echo $descripcions;					
					?>
				</textarea>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
			<label style="font-size:17px;">Disponible</label>
					<br>	
						Sí <input type="radio" name="disponible" value="Sí" required>
						No <input type="radio" name="disponible" value="No" required> 
					<br>
					<br>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Profesor</label>
				<input type="text" placeholder="profesor" value="<?php echo $profesors; ?>" class="form-control" name="profesor" required>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Agregar imagen</label>
				<input type="file" placeholder="urlImagen" value="<?php echo $imagensC; ?>" class="form-control" name="urlImagen" accept="image/*">
				<input type="hidden" name="previmgC" value="<?php echo $imagensC; ?>"/>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Calificación</label>
				<input type="text" placeholder="calificacion" value="<?php echo $calificacions; ?>" class="form-control" name="calificacion" required>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label  style="font-size:17px;">Destacados </label>
				<input type="" placeholder="destacado" value="<?php echo $destacados; ?>" class="form-control" name="destacado" required>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label tyle="font-size:17px;">Cursos sugeridos</label>
				<input type="text" placeholder="cursos Sugeridos" value="<?php echo $sugeridos; ?>" class="form-control" name="cursosSugeridos" required>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label text-aling="left" style="font-size:17px;">Total Clases</label>
				<input type="text" placeholder="total Clases" value="<?php echo $totals; ?>" class="form-control" name="totalClases" required>
			</div>
		
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"align="left">
				<label style="font-size:17px;">Agregar imagen mini</label>
				
				<input type="file" placeholder="urlImagenMini" value="<?php echo $rutaM; ?>" class="form-control" name="urlImagenMini" accept="image/*">


				<input type="hidden" name="previmgM" value="<?php echo $imagenminis; ?>"/>
			</div>


			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Modulo</label>

				<select placeholder="Tipo Categoria" class="form-control" name="idTipoCategoria" required>
					<option value="<?php echo $idTipoCategorias; ?>" selected=""><?php echo $nombre_categoria;?></option>
				<?php
					$registros=mysqli_query($enlace,"select id, nombre_categoria from tipo_categoria") or
 					die("Problemas en el select:".mysqli_error($enlace));
					while ($reg=mysqli_fetch_array($registros))
						{
  						echo "<option value='".$reg[id]."'>".$reg[nombre_categoria]."</option>";
						}
					?>					
					</select>
			</div>	
			
			<br>
			<div align="center">
				<button name="actualizarCurso" class="btn btn-success" type="submit" style="width: 180px">	
					Actualizar
					<i class="fas fa-pen"></i>
				</button>
			</div>

		</form>
	</div>
</div>
<script type="text/javascript">
function activar()
{
var a=document.getElementById('cambiarImgM');
var b= j.value
if(b!=1)
{
	document.getElementById('imagenMini').disabled=false;
}
else
document.getElementById('imagenMini').disabled=true;
}

</script>
</body>
</html>