<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Página principal</title>
	<link rel="stylesheet" href="../registro/css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

	
<?php 
include  ('conexionDB/conexionBD.php'); 
include 'includes/headerI.php';
?>
	<br><br>
	<div class="container">
		<div class="row">

			<div class="col-lg-4 col-md-6 mb-4">
				<div class="card">
					<label align="text-center">USUARIO</label>
					<a href="formularios/usuario.php"><img class="card-img-top" src="http://placehold.it/600x300" alt=""></a>					
				</div>
			</div>

			<div class="col-lg-4 col-md-6 mb-4">
				<div class="card">
					<label align="text-center">CURSO</label>
					<a href="formularios/curso.php"><img class="card-img-top" src="http://placehold.it/600x300" alt=""></a>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 mb-4">
				<div class="card">
				<label align="text-center">MODULO</label>
					<a href="formularios/modulo.php"><img class="card-img-top" src="http://placehold.it/600x300" alt=""></a>					
				</div>
			</div>


			<div class="col-lg-4 col-md-6 mb-4">
				<div class="card">
				<label align="text-center">CLASE</label>
					<a href="formularios/clase.php"><img class="card-img-top" src="http://placehold.it/600x300" alt=""></a>					
				</div>
			</div>

			<div class="col-lg-4 col-md-6 mb-4">
				<div class="card">
				<label align="text-center">CURSO_USUARIO</label>
					<a href="formularios/curso_usuario.php"><img class="card-img-top" src="http://placehold.it/600x300" alt=""></a>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 mb-4">
				<div class="card">
					<label align="text-center">CLASE_USUARIO</label>
					<a href="formularios/clase_usuario.php"><img class="card-img-top" src="http://placehold.it/600x300" alt=""></a>
					</div>
			</div>
	
			<div class="col-lg-4 col-md-6 mb-4">
				<div class="card">
				<label align="text-center">PREGUNTA</label>
					<a href="formularios/pregunta.php"><img class="card-img-top" src="http://placehold.it/600x300" alt=""></a>					
				</div>
			</div>

		</div>
		<!-- /.row -->
	</div>
</div>

</body>
</html>