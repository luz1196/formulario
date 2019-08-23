<?php

include  ('conexionDB/conexionBD.php');
$error = false;

if(isset($_POST['login'])){

	$user = $_POST['nombreUsuario'];
    $pass = $_POST['clave'];

    $sql2 = "SELECT * FROM usuario WHERE nombreUsuario ='$user'" ;

    $resulta = mysqli_query($enlace,$sql2);


   if ( mysqli_num_rows($resulta) == 1 ) {

        $datas = mysqli_fetch_assoc($resulta);

        if ( password_verify($pass,$datas['contrasena'])) {
            header("Location: index.php");
       
        } else {
            $error = '<h5 style="color: red;">Contraseña incorrecta.</h5> <br>';
        }
    } else {
        $error = '<h5 style="color: red;">Nombre de usuario incorrecto.</h5> <br>';
    }
   
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Iniciar sesión</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" href="fonts/fontawesome/css/all.css">
	<link rel="stylesheet" href="fonts/fontawesome/css/fontawesome.css">
	<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="wrapper">
		<?php include('includes/headerI.php'); ?>
		<div class="container-fluid">	
			<div class="row">	
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 offset-md-6">
					<form method="post" enctype="multipart/form-data" style="padding-top: 132px;">
						<h3 style="color: white;"> Inicia sesión </h3>
						<?php 
						if ($error) {
							echo $error;							
						}
						?>
						<div>
							<input type="text" placeholder="nombre de usuario" class="form-control" name="nombreUsuario" required>
						</div>
						<div>
							<input type="password" placeholder="contraseña" class="form-control" name="clave" required>
						</div>
						<div>
							<input type="checkbox" name="agree-term" id="agree-term" class="agree-term">
							<label for="agree-term" class="label-agree-term" style="color: white; font-size: 17px; font-weight: bold;"><span><span></span></span>Recuérdame.</label>
						</div>
						<br>
						<button name="login" class="btn btn-success" style="width: 180px">	
							Ingrese
							<i class="fas fa-sign-in-alt"></i>
						</button>

						<a href="registro.php" class="btn btn-info" style="width: 126px; padding: 0.65rem 0.5rem; font-family: Montserrat-SemiBold;">
							Regístrese
							<i class="fas fa-pen"></i>
						</a>
					</form>
				</div>
			</div>	
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="fonts/fontawesome/js/fontawesome.js"></script>

	<script src="js/main.js"></script>
</body>
</html>
