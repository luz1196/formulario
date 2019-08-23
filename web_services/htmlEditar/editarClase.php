<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Editar Clase</title>
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

if (isset($_GET['editarClase'])) {


	$editarId = $_GET['editarClase'];

	$consultaEditar = "SELECT * FROM clase WHERE id ='$editarId'";

	$ejecutarEditar = mysqli_query ($enlace, $consultaEditar);
	$fila = mysqli_fetch_array($ejecutarEditar);
	
	$titulos = $fila['titulo'];	
	$descripcions = $fila['descripcion'];
	$imagens = $fila['urlImagenPrev'];
	$tipos = $fila['idTipoClase'];
	$contenidos = $fila['contenidoClase'];
	$cursos = $fila['idCurso'];
	$modulos = $fila['idModulo'];

	$idPreguntas = $_POST['idPregunta'];
	$directorio= "../../content/".$ncurso."/".$nmodulo."/".$actTitulo."/";

	
//
	$nombre_tipo= "SELECT * FROM tipo_clase WHERE id=".$tipos;//
	$tipoName = mysqli_query($enlace,$nombre_tipo);

	if($reg1=mysqli_fetch_array($tipoName))
	{
		$nombre_select= $reg1['nombreTipo'];//campo tipo
	}
//
	$nombre_Cursos= "SELECT nombre FROM curso WHERE id=".$cursos;
	$cursoName= mysqli_query($enlace, $nombre_Cursos);

	if($reg2 =mysqli_fetch_array($cursoName))
	{
		$nombre_curso =$reg2['nombre'];
	}
//
	$nombre_Modulos= "SELECT nombre FROM modulo WHERE id=".$modulos;
	$moduloName= mysqli_query($enlace, $nombre_Modulos);

	if ($reg3 =mysqli_fetch_array($moduloName)) {
		$nombre_modulo = $reg3['nombre'];
	}

	$Pregunta= "SELECT pregunta FROM pregunta";
	$preguntaName= mysqli_query($enlace, $Pregunta);

	if ($reg4 =mysqli_fetch_array($preguntaName)){
		$cuestionario = $reg4['pregunta'];
	}

}
?>

<div class="modal">
	<div class="form-modal" class="w-50" align="center">
		<form method="POST"  action="../lógica/lib.php" enctype="multipart/form-data">
			<h3 class="text-center">Editar clase</h3>			
			<input type="hidden" value="<?php echo $editarId; ?>" name="editarId">


			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Título</label>
				<input type="text" placeholder="titulo" value="<?php echo $titulos; ?>" class="form-control" name="titulo" required>
			</div>


			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Descripción</label>
				<textarea placeholder="descripcion" value="<?php echo $descripcions; ?>" class="form-control" name="descripcion" rows="4" required>
					<?php
					echo $descripcions;					
					?>
				</textarea>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
			<label  style="font-size:17px;">Agregar imagen</label>
				<input type="file" placeholder="imagen" value="<?php echo $imagens; ?>"class="form-control" name="urlImagenPrev" accept="image/*"/>
				<input type="hidden" name="previmg" value="<?php echo $imagens; ?>"/>					
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
			<label style="font-size:17px;">Tipo de contenido</label>
				<select placeholder="tipo"  class="form-control" name="idTipoClase" id="tipo_contenido" onchange="habilitar();">
					<option value="<?php echo $tipos;?>" selected=""><?php echo $nombre_select; ?></option>
					<?php
					$registros=mysqli_query($enlace,"select id, nombreTipo from tipo_clase") or
 					die("Problemas en el select:".mysqli_error($enlace));
					while ($reg=mysqli_fetch_array($registros))
						{
  						echo "<option value='".$reg[id]."'>".$reg[nombreTipo]."</option>";
						}
					?>					
				</select>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
			<label style="font-size:17px;">Cuestionario</label>
				<select placeholder="idPregunta"  class="form-control" name="idPregunta">
					<option value="<?php echo $idPreguntas;?>" selected=""><?php echo $cuestionario; ?></option>
					<?php
					$registros=mysqli_query($enlace,"select id, pregunta from pregunta") or
 					die("Problemas en el select:".mysqli_error($enlace));
					while ($reg=mysqli_fetch_array($registros))
						{
  						echo "<option value='".$reg[id]."'>".$reg[pregunta]."</option>";
						}
					?>
				</select>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
			<label style="font-size:17px;">Agregar contenido</label>	
				<input type="file" placeholder="contenido" value="<?php echo $contenidos; ?>" class="form-control" name="contenidoClase" accept="video/*, application/pdf" disabled="" id="agregar_contenido" >
				<input type="hidden" name="prevcont" value="<?php echo $contenidos; ?>"/>
			</div>


			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Curso</label>
				<select placeholder="curso" class="form-control" name="idCurso" required>
					<option value="<?php echo $cursos; ?>" selected=""><?php echo $nombre_curso;?></option>
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
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Modulo</label>
				<select placeholder="modulo" class="form-control" name="idModulo" required>
					<option value="<?php echo $modulos; ?>" selected=""><?php echo $nombre_modulo;?></option>
				<?php
					$registros=mysqli_query($enlace,"select id, nombre from modulo") or
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
				<button name="actualizarClase" class="btn btn-success" type="submit" style="width: 180px">	
					Actualizar
					<i class="fas fa-pen"></i>
				</button>
			</div>

		</form>
	</div>
</div>

<script>
function habilitar()
{
var j=document.getElementById('tipo_contenido');
var k= j.value
if(k!=4)
{
	document.getElementById('agregar_contenido').disabled=false;
}
else
document.getElementById('agregar_contenido').disabled=true;
}

</script>
</body>
</html>