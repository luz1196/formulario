<?php 	
include('../conexionDB/conexionBD.php');
include('../includes/header.php'); 
error_reporting(E_ALL ^ E_NOTICE);


$error = false;

if(isset($_POST['enviar'])){

	$nombre = $_POST['nombre'];
	$modulos = $_POST['modulos'];
	$horas = $_POST['horas'];
	$fechaAcutalizacion = $_POST['fechaAcutalizacion'];
	$descripcion = $_POST['descripcion'];
	$profesor = $_POST['profesor'];
	$disponible = $_POST['disponible'];
	$calificación = $_POST['calificación'];
	$destacado = $_POST['destacado'];
	$cursoSugerido = $_POST['cursoSugerido'];
	$totalClases = $_POST['totalClases'];
	$tipoCategoria = $_POST ['tipoCategoria']; 

	if($tipoCategoria=="" || $descripcion==""){
		echo "Por farvor seleccione una Categoría";
	}else if(isset($nombre) && !file_exists($nombre)){ 
		mkdir("../../content/".$_POST["nombre"], 0777,true); 
		}
		else
		{ 
		echo "La carpeta de este curso ya existe";
	} 

	$imagenCurso= "content/".$nombre."/".$_FILES['urlImagen']['name'];//muestra la ruta en la tabla
		$ruta = "../../content/".$nombre."/".$_FILES['urlImagen']['name'];			
		$tipo_archivo = $_FILES['urlImagen']['type'];
		$tamano_archivo = $_FILES['urlImagen']['size'];


	$imagenM = "content/".$nombre."/".$_FILES['urlImagenMini']['name'];
		$ruta1="../../content/".$nombre."/".$_FILES['urlImagenMini']['name'];		
		$tipo_archivoM = $_FILES['urlImagenMini']['type'];
		$size_archivoM = $_FILES['urlImagenMini']['size'];

	$validarNombreCurso = mysqli_query($enlace,"select nombre from curso where nombre='$nombre'");


	if(isset($_FILES['urlImagen'])){
			if($tipo_archivo != "image/jpeg" && $tipo_archivo != "image/png" && $tipo_archivo != "image/gif")
		{
			Echo "Formato de imagen no permitido";

		}else if($tamano_archivo > 50000000 )
			{
				Echo "Tamaño de imagen no permitido";

		}else{
				
				$guardarimg = @move_uploaded_file($_FILES["urlImagen"]["tmp_name"], $ruta);
			}
		}


	if(isset($_FILES['urlImagenMini'])){
			if($tipo_archivoM != "image/jpeg" && $tipo_archivo != "image/png" && $tipo_archivo != "image/gif")
		{
			Echo "Formato de imagen no permitido";

		}else if($tamano_archivoM > 50000000 )
			{
				Echo "Tamaño de imagen no permitido";

		}else{
				
				$guardarimgM = @move_uploaded_file($_FILES["urlImagenMini"]["tmp_name"], $ruta1);
			}
		}
		if(mysqli_num_rows($validarNombreCurso)>0) 
		{ 
			$error = '<h5 style="color: red;">Ya existe un curso con este nombre.</h5> <br>';
		}else{

			
					$insertSQL = "INSERT INTO curso VALUES (null,
					'$nombre', 
					'$modulos',
					'$horas',
					'$fechaAcutalizacion',		
					'$descripcion',
					'$profesor',
					'$disponible',
					'$imagenCurso',
					'$calificación',
					'$destacado',
					'$cursoSugerido',
					'$totalClases',
					'$imagenM',
					'$tipoCategoria')";

					$ejecutarSQL = mysqli_query($enlace, $insertSQL);
				}
			}
		
		
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Curso</title>
</head>

<body>

	<button type="button" class="btn-warning">Crear Curso</button>
	<br>
		<?php 
	if ($error) {
		echo $error;							
	}
	?>

	<div class="modal" style="display: none;">
		<div class="form-modal" class="w-50" align="center">

			<form method="post"  enctype="multipart/form-data">
				<h3> Crear Curso </h3>
				
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Nombre</label>
					<input type="text" class="form-control" name="nombre" required>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label text-aling="left" style="font-size:17px;">Número de Modulos</label>
					<input type="number" class="form-control" name="modulos" required>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Horas</label>
					<input type="number" class="form-control" name="horas" required>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Fecha de actualización</label>
					<input type="date"  class="form-control" name="fechaAcutalizacion" style="font-size: 15px;" required>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Descripción</label>
					<textarea class="form-control" name="descripcion" rows="4" required>
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
					<input type="text" class="form-control" name="profesor" required> 
				</div>

	

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Agregar Imagen</label>					
					<input type="file" class="form-control" name="urlImagen" accept="image/*" required>		
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label text-aling="left" style="font-size:17px;">Calificación</label>
					<input type="number" class="form-control" name="calificación" required> 
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Destacado</label>
					<input type="text" class="form-control" name="destacado" required> 
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Cursos sugeridos</label>
					<input type="text" class="form-control" name="cursoSugerido" required> 
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Total clases</label>
					<input type="number" class="form-control" name="totalClases" required> 
				</div>
	
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Agregar imagen mini</label>					
					<input type="file" class="form-control" name="urlImagenMini" accept="imge/*" required>
				</div>



				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Categoría</label>
					<select class="form-control" name="tipoCategoria" id="categoria" style="font-size: 15px" required="">
					<?php 
					$registros=mysqli_query($enlace,"select id, nombre_categoria from tipo_categoria") or
					die("Problemas en el select: ".mysqli_error($enlace));
					while ($reg=mysqli_fetch_array($registros)) 
					{
						echo"<option value='".$reg[id]."'>".$reg[nombre_categoria]."</option>";
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
			<th>Nombre</th>
			<th>Número de Modulos</th>
			<th>Horas</th>
			<th>Fecha de actualización</th>
			<th>Descripción</th>
			<th>Disponible</th>
			<th>Profesor</th>
			<th>Imagen</th>
			<th>Calificación</th>
			<th>Destacados</th>
			<th>Cursos Sugeridos</th>
			<th>Total clases</th>
			<th>Imagen Mini</th>
			<th>Categoria</th>
			<th><i class="fas fa-pen"></i></th>
			<th><i class="fas fa-trash"></i></th>
			<th></th>
			<th></th>
		</tr>

		<?php

		$consultaRegistros = "SELECT c.id, nombre, numeroModulos, horas, fechaActualizacion, descripcion, profesor, disponible, urlImagen, 
			calificacion, destacado, cursosSugeridos, totalClases, urlImagenMini, nombre_categoria  from curso as c
			left join tipo_categoria as t ON c.idTipoCategoria = t.id";
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
					<td>'.$fila[7].'</td>
					<td>'.$fila[6].'</td>
					<td>'.$fila[8].'</td>
					<td>'.$fila[9].'</td>
					<td>'.$fila[10].'</td>
					<td>'.$fila[11].'</td>
					<td>'.$fila[12].'</td>
					<td>'.$fila[13].'</td>
					<td>'.$fila[14].'</td>


					<td> <a href="../htmlEditar/editarCurso.php?editarCurso='.$fila[0].'"> Editar </a> </td>
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
            var confirmar = confirm("Al borrar este curso borrará también todos sus módulos y clases, esta seguro de borrar este registro? ");
            if (confirmar == true) {

                 window.location.href="../lógica/lib.php?eliminarCurso="+y;
                 
            } else {
                 window.location ="curso.php";

            }
        }

</script>
</body>
</html>