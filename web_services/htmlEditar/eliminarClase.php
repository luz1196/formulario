<?php 
/* --------------- ELIMINAR CLASE --------------- */

include  ('../conexionDB/conexionBD.php');

if (isset($_GET['eliminar'])) {

	$eliminarId = $_GET['eliminar'];

	$consultaElim ="DELETE FROM clase WHERE id = $eliminarId";

	$ejecutarElim = mysqli_query ($enlace, $consultaElim);
	
	if (!$ejecutarElim) {
		die("Error al eliminar.");
	}

	$_SESSION['message'] = 'Remove complete.';
	$_SESSION['message_type'] = 'Danger.';
	header("Location: clase.php");
}

?>