<?php 
/* --------------- ELIMINAR USUARIO --------------- */

include ('conexionBD.php');

if (isset($_GET['eliminar'])) {

	$eliminarId = $_GET['eliminar'];

	$consultaElim ="DELETE FROM usuario WHERE id = $eliminarId";

	$ejecutarElim = mysqli_query ($enlace, $consultaElim);
	
	if (!$ejecutarElim) {
		die("Error al eliminar.");
	}

	$_SESSION['message'] = 'Remove complete.';
	$_SESSION['message_type'] = 'Danger.';
	header("Location: usuario.php");
}

?>