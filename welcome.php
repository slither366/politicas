<?php
session_start();
require 'funcs/conexion.php';
include 'funcs/funcs.php';

	if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}
	
	$idUsuario = $_SESSION['id_usuario'];
	
	//$sql = "SELECT id, nombre FROM usuarios WHERE id = '$idUsuario'";
	$sql = "SELECT u.id, t.nombre FROM usuarios u,tb_persona t WHERE u.dni = t.dni AND u.id = '$idUsuario'";
	$result = $mysqli->query($sql);
	
	$row = $result->fetch_assoc();	
	?>

	<html>
	<head>
		<title>Welcome</title>
		<!--
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<script src="js/bootstrap.min.js" ></script>-->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
		
		<style>
		body {
			padding-top: 20px;
			padding-bottom: 20px;
		}
	</style>
</head>

<body>
	<div class="container">

		<nav class="navbar navbar-expand-sm navbar-expand-md navbar-expand-lg navbar-dark bg-primary sticky-top">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>  

			<a class="navbar-brand" href="../welcome.php">
				<img src="images/logo.png" width="40" height="30" class="d-inline-block align-top" alt="Logo">
				TaskManager
			</a>

			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav mr-auto ml-auto text-center">
					<a class="nav-item nav-link active" href="welcome.php">Inicio</a>

					<?php if($_SESSION['tipo_usuario']==1) { ?>
						<a class="nav-item nav-link" href="registro.php">Registrar Usuario</a>
					<?php } ?>
				</div>
			</div>  
			<div class="d-flex justify-content-around text-white">
				<?php echo 'Bienvenid@:'.utf8_decode($row['nombre']); ?>
			</div>			
			<div class="d-flex justify-content-around">
				<a href="logout.php" class="btn btn-danger border-white">Cerrar Sesi&oacute;n</a>
			</div>
		</nav>		

		<div class="jumbotron" style="background-color:#d5f4e6;">
			<div class="row">

				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
					<div class="card" style="height: 200px;">
						<div class="card-body">
							<h5 class="card-title">Transferencias Pendientes de Recepcion</h5>
							<p class="card-text"></p>
							<a href="transferencias/transfer_pendientes.php" class="btn btn-warning btn-lg btn-block">7 Locales</a>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
					<div class="card" style="height: 200px;">
						<div class="card-body">
							<h5 class="card-title">Deposito Bancario Pendiente</h5>
							<p class="card-text"></p>
							<a href="#" class="btn btn-success btn-lg btn-block">1 Local</a>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
					<div class="card" style="height: 200px;">
						<div class="card-body">
							<h5 class="card-title">Remesas Fuera de Rango  --------</h5>
							<p class="card-text"></p>
							<a href="#" class="btn btn-danger btn-lg btn-block">15 Locales</a>
						</div>
					</div>
				</div>  
			
				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
					<div class="card" style="height: 200px;">
						<div class="card-body">
							<h5 class="card-title">Cierre de dia Pendiente  --------</h5>
							<p class="card-text"></p>
							<a href="#" class="btn btn-success btn-lg btn-block">0 Locales</a>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
					<div class="card" style="height: 200px;">
						<div class="card-body">
							<h5 class="card-title">Acumulacion de Deficit Excesivo  --------</h5>
							<p class="card-text"></p>
							<a href="#" class="btn btn-warning btn-lg btn-block">4 Locales</a>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
					<div class="card" style="height: 200px;">
						<div class="card-body">
							<h5 class="card-title">Cuadratura de Anulacion Pendiente</h5>
							<p class="card-text"></p>
							<a href="#" class="btn btn-danger btn-lg btn-block">10 Locales</a>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
					<div class="card" style="height: 200px;">
						<div class="card-body">
							<h5 class="card-title">ASL's Pendientes  ----------------</h5>
							<p class="card-text"></p>
							<a href="#" class="btn btn-warning btn-lg btn-block">8 Locales</a>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
					<div class="card" style="height: 200px;">
						<div class="card-body">
							<h5 class="card-title">Cierre de día Pendiente  -----------</h5>
							<p class="card-text"></p>
							<a href="#" class="btn btn-success btn-lg btn-block">0 Locales</a>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-3">
					<div class="card" style="height: 200px;">
						<div class="card-body">
							<h5 class="card-title">Acumulacion de Deficit Excesivo -----</h5>
							<p class="card-text"></p>
							<a href="#" class="btn btn-success btn-lg btn-block">2 Locales</a>
						</div>
					</div>
				</div>

			</div>
		</div>


	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="bootstrap/js/bootstrap.js"></script>	
</body>
</html>