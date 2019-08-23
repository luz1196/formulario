<?php 	
include  ('../conexionDB/conexionBD.php');
include('../includes/header.php'); 

error_reporting(E_ALL ^ E_NOTICE);

$error = false;

if(isset($_POST['enviar'])){

		$nombre = $_POST['nombre'];
		$numeroClases = $_POST['numeroClases'];
		$curso = $_POST['curso'];
		$validarNombre = mysqli_query($enlace, "select nombre from modulo where nombre='$nombre'");

		$idCurso = "SELECT nombre FROM curso WHERE id=".$curso;
		$ejecutarSQL = mysqli_query($enlace, $idCurso);
		$regCur = mysqli_fetch_assoc($ejecutarSQL);
		foreach($regCur as $value){
			$ncurso=$value;
		}
		
		$directorio= "../../content/".$ncurso."/";

		if($curso==""){
			echo "Por favor seleccione un curso";
		}else if(isset($nombre) && !file_exists($nombre))
			{ 
				mkdir($directorio."/".$_POST['nombre'], 0777, true);
			}else{ 
					echo "La carpeta de este modulo ya existe";
				}

				
		if(mysqli_num_rows($validarNombre)>0) 
		{ 
			$error = '<h5 style="color: red;">Ya existe un modulo con este nombre.</h5> <br>';
		}else{


					$insertSQL = "INSERT INTO modulo VALUES (null,
					'$nombre', 
					'$numeroClases',
					'$curso')";
					$ejecutarSQL = mysqli_query($enlace, $insertSQL);


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

	<button type="button" class="btn-warning">Crear Modulo</button>
	<br>
	<?php 
	if ($error) {
		echo $error;							
	}
	?>

<div class="modal" style="display: none;">
	<div class="form-modal" class="w-50" align="center">

		<form method="post" >
				<h3> Crear Modulo </h3>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">Nombre</label>
					<input type="text" class="form-control" name="nombre" required>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label  style="font-size:17px;">Número de clases</label>
					<input type="number" class="form-control" name="numeroClases" required>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="left">
					<label style="font-size:17px;">curso</label>
					<select class="form-control" name="curso" style="font-size: 15px" required="">
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
			<th>Nombre</th>
			<th>Numero de clases</th>
			<th>Curso</th>
			<th><i class="fas fa-pen"></i></th>
			<th><i class="fas fa-trash"></i></th>
			<th></th>
			<th></th>
		</tr>

		<?php

		$consultaRegistros = "SELECT m.id, m.nombre, m.numeroClases, c.nombre, c.id from modulo as m
								left join curso as c ON m.idCurso = c.id";
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
																				
					<td> <a href="../htmlEditar/editarModulo.php?editarModulo='.$fila[0].'"> Editar </a> </td>
					<td> <a Onclick="confirmarBorrar('.$fila[0].','.$fila[4].');" style="color:#FF9C9D"> Borrar </a> </td>
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

	function confirmarBorrar(idmodulo,idcurso){
            var confirmar = confirm("¿Al borrar este módulo borrará también todas sus clases, esta seguro de borrar este registro? ");
            if (confirmar == true) {

                 window.location.href="../lógica/lib.php?eliminarModulo="+idmodulo+"&curso="+idcurso;
  
            } else {
                 window.location ="modulo.php";

            }
        }
	</script>
</body>
</html>