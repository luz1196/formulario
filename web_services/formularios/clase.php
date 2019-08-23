<?php 	
include  ('../conexionDB/conexionBD.php');
include('../includes/header.php'); 

error_reporting(E_ALL ^ E_NOTICE);

$error = false;

if(isset($_POST['enviar'])){

	
	$descripcion = $_POST['descripcion'];
	$titulo = $_POST['titulo'];
	$modulo = $_POST['modulo'];
	$tipo = $_POST['tipo'];
	$curso = $_POST['curso'];
	$idPregunta = $_POST['idPregunta'];


		$idCurso = "SELECT nombre FROM curso WHERE id=".$curso;
		$ejecutarSQL = mysqli_query($enlace, $idCurso);
		$regCur = mysqli_fetch_array($ejecutarSQL);
		foreach($regCur as $valueC){
			$ncurso=$valueC;
		}

		$idModulo = "SELECT nombre FROM modulo WHERE id=".$modulo;
		$ejecutarSQL = mysqli_query($enlace, $idModulo);
		$regMod = mysqli_fetch_array($ejecutarSQL);
		foreach($regMod as $valueM){
			$nmodulo=$valueM;
		}

	$imagen = "content/".$ncurso."/".$nmodulo."/".$titulo."/".$_FILES['urlImagenPrev']['name'];
	$directorio= "../../content/".$ncurso."/".$nmodulo."/";

	$validarTitulo = mysqli_query($enlace,"select titulo from clase where titulo='$titulo'");

	if($tipo=="" || $curso=="" || $modulo=="" || $descripcion=="" ){
		echo "Por favor diligencie todos los campos";
	}else if(isset($titulo) && !file_exists($nombre))
		{ 
		mkdir($directorio."/".$_POST['titulo'], 0777, true);
		}else{ 
			echo "La carpeta de esta clase ya existe";
		}

	$contenidoC ="content/".$ncurso."/".$nmodulo."/".$titulo."/".$_FILES['contenidoClase']['name'];
				//$cont1 = "content/".$ncurso."/".$nmodulo."/".$titulo."/".$_FILES['contenidoClase']['name'];		
				//$cont2 = "content/".$ncurso."/".$nmodulo."/".$titulo."/".$_FILES['contenidoClase']['name'];
				//$cont3 = "content/".$ncurso."/".$nmodulo."/".$titulo."/".$_FILES['contenidoClase']['name'];

if($_POST['tipo']=="4"){		
		$contenido = $idPregunta;
			$next = false;
	}else{
		$contenido = $contenidoC;
	}
			
	$ruta = "../../content/".$ncurso."/".$nmodulo."/".$titulo."/".$_FILES['urlImagenPrev']['name'];
	$tipo_archivo = $_FILES['urlImagenPrev']['type'];
	$tamano_archivo = $_FILES['urlImagenPrev']['size'];
	$ruta3 = "../../content/".$ncurso."/".$nmodulo."/".$titulo."/".$_FILES['contenidoClase']['name'];

	$tipo_archivoC = $_FILES['contenidoClase']['type'];
	$ext = pathinfo($_FILES['contenidoClase']['name'], PATHINFO_EXTENSION);

	$next = true;
	
	//valida tipo de archivo a cargar
	
		if($_POST['tipo']=="1"){
				if($ext != "mp3" && $ext != "mp4"){
					$next= false;
					Echo "Formato de archivo no permitido";
				}else{
					$resultadoC = @move_uploaded_file($_FILES["contenidoClase"]["tmp_name"], $ruta3);
					$contenidoC = $cont1;

				}
			}
			else if($_POST['tipo']=="2"){
				if($ext != "mp3" && $ext != "mp4"){
					$next= false;
					Echo "Formato de archivo no permitido";
					$contenidoC = $cont1;
				}else{
					$resultadoC = @move_uploaded_file($_FILES["contenidoClase"]["tmp_name"], $ruta3);
					$contenidoC = $cont2;
				}
			}
			else if($_POST['tipo']=="3"){
				if(substr($tipo_archivoC, -3) != "pdf"){
					$next= false;
					Echo "Formato de archivo no permitido";
				}else{
					$resultadoC = @move_uploaded_file($_FILES["contenidoClase"]["tmp_name"], $ruta3);
					$contenidoC = $cont3;
				}
			
			}else if($_POST['tipo']=="4"){
				if(empty($_POST['idPregunta'])){		
					$next= false;
					echo"seleccione el cuestionario";				
				}		
			}

////valida imagen
if(isset($_FILES['urlImagenPrev'])){
	if($tipo_archivo != "image/jpeg" && $tipo_archivo != "image/png" && $tipo_archivo != "image/gif")
		{	
			$next= false;
			Echo "Formato de imagen no permitido";			
		}
		else if($tamano_archivo > 50000000 )	
			{
				Echo "Tamaño de imagen no permitido";
				$next= false;
					}else{
					$resultado = @move_uploaded_file($_FILES["urlImagenPrev"]["tmp_name"], $ruta);
					$next= true;			
					}

		if(mysqli_num_rows($validarTitulo)>0) 
		{ 
			$error = '<h5 style="color: red;">Ya existe una clase con este nombre.</h5> <br>';
		}else{

					$insertSQL = "INSERT INTO clase VALUES (null,

							'$contenido',
							'$imagen',
							'$descripcion',
							'$titulo',		
							'$modulo',
							'$tipo',
							'$curso')";

					$ejecutarSQL = mysqli_query($enlace, $insertSQL);		
		}

	}

}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">

	<title>Clase</title>
</head>

<body>
	<button type="button" class="btn-warning">Crear Clase</button>
	<br>
		<?php 
	if ($error) {
		echo $error;							
	}
	?>

	<div class="modal" style="display: none;">

		<div class="form-modal" class="w-50" align="center">

			<form method="post"  enctype="multipart/form-data">
				<h3 text-align="center"> Crear Clase </h3>
			
				<div class="cl-xs-1o2 col-sm-12 col-md-12 col-lg-12" align="left">					
				<label style="font-size:17px;">Título</label>
					<input type="text" class="form-control" name="titulo" style="font-size:15px;" required="">
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Descripción</label>
					<textarea class="form-control" name="descripcion" rows="4" required="textarea">
					</textarea>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label text-aling="left" style="font-size:17px;">Agregar imagen</label>				
					<input type="file"  class="form-control" name="urlImagenPrev" accept="image/*" required="">									
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label style="font-size:17px;">Tipo de contenido</label>
					<select  class="form-control" id="tipo_contenido" name="tipo" style="font-size: 15px;"  onchange="habilitar();" required="">
					<?php
					$registros=mysqli_query($enlace,"select id, nombreTipo from tipo_clase") or
 					die("Problemas en el select:".mysqli_error($enlace));
					while ($reg=mysqli_fetch_array($registros))
						{
  						echo "<option value='".$reg[id]."'>".$reg[nombreTipo]."</option>";
						}
					?>			
					<option disabled selected class="form-control" style="font-size: 15px"></option>
					</select>
				</div>


				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Id cuestionario</label>
					<select  class="form-control" name="idPregunta" style="font-size: 15px"> 
					<?php
					$registros=mysqli_query($enlace,"select id, pregunta from pregunta") or
 					die("Problemas en el select:".mysqli_error($enlace));
					while ($reg=mysqli_fetch_array($registros))
						{
  						echo "<option value='".$reg[id]."'>".$reg[pregunta]."</option>";
						}
					?>			
					<option disabled selected></option>
					</select>
				</div>


				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
				<label text-aling="left" style="font-size:17px;">Agregar contenido</label>				
				<input type="file" class="form-control" name="contenidoClase" accept="video/*, application/pdf" disabled="" id="agregar_contenido" >
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Curso</label>
					<select  class="form-control" name="curso" style="font-size: 15px" required="">
					<?php
					$registros=mysqli_query($enlace,"select id, nombre from curso") or
 					die("Problemas en el select:".mysqli_error($enlace));
					while ($reg=mysqli_fetch_array($registros))
						{
  						echo "<option value='".$reg[id]."'>".$reg[nombre]."</option>";
						}
					?>;>			
					<option disabled selected class="form-control" style="font-size: 15px"></option>
					</select>
				</div>
				
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Modulo</label>
					<select  class="form-control" name="modulo" style="font-size: 15px" required="">
					<?php
					$registros=mysqli_query($enlace,"select id, nombre from modulo") or
 					die("Problemas en el select:".mysqli_error($enlace));
					while ($reg=mysqli_fetch_array($registros))
						{
  						echo "<option value='".$reg[id]."'>".$reg[nombre]."</option>";
						}
					?>;>	
					<option disabled selected></option></select>
				</div>
					
				<br>
				<div align="center">
					<button name="enviar" class="btn btn-success" style="width: 180px" >	
						Crear
						<i  class="fas fa-pen" ></i>
					</button>
				</div>
			</form> 

		</div>
	</div>

	<br>
	<br>
	<div table>
	<table class="table table-hover text-center">
		<tr>
			<th>Titulo</th>
			<th>Descripción</th>
			<th>Url Imagen</th>
			<th>Tipo de contenido</th>
			<th>contenido</th>
			<th>Curso</th>
			<th>Modulo</th>
			<th><i class="fas fa-pen"></i></th>
			<th><i class="fas fa-trash"></i></th>
			<th></th>
			<th></th>
		</tr>

		<?php

		$consultaRegistros = "SELECT cl.id, cl.contenidoClase, cl.urlImagenPrev, cl.descripcion, cl.titulo,  m.nombre, t.nombreTipo, c.nombre, c.id, m.id from clase as cl
				left join modulo as m ON cl.idModulo = m.id
				left join tipo_clase as t ON cl.idTipoClase = t.id
				left join curso as c ON cl.idCurso = c.id ";
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
					<td>'.$fila[4].'</td>
					<td>'.$fila[3].'</td>
					<td>'.$fila[2].'</td>
					<td>'.$fila[6].'</td>
					<td>'.$fila[1].'</td>
					<td>'.$fila[7].'</td>
					<td>'.$fila[5].'</td>

					<td> <a href="../htmlEditar/editarClase.php?editarClase='.$fila[0].'"> Editar </a> </td>

					<td> <a Onclick="confirmarBorrar('.$fila[0].','.$fila[9].','.$fila[8].')" style="color:#FF9C9D"> Borrar </a> </td>
					</tr>';
					$fila = mysqli_fetch_array($ejecutarRegistros);
				}
			}
		}
		?>
	</table>
</div>
	<br><br>
	<?php include('../includes/footer.php'); ?>
	<script>
	$('.btn-warning').click(function(){
		$('.modal').toggle();
			$('.table').hide(); 

	});
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

function confirmarBorrar(idclase, idmodulo, idcurso){
            var confirmar = confirm("¿Al borrar esta clase borrará también su contenido, esta seguro de borrar este registro? ");
            if (confirmar == true) {
                 window.location.href="../lógica/lib.php?eliminarClase="+idclase+"&modulo="+idmodulo+"&curso="+idcurso;
            } else {
                 window.location ="clase.php";

            }
        }
 </script>

</body>
</html>

