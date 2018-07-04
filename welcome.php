<?php
session_start();
require 'funcs/conexion.php';
include 'funcs/funcs.php';

const TIP_PEND_RECEP = 1;

	if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}

	$idUsuario = $_SESSION['id_usuario'];
	$dni = $_SESSION['dni'];
	$datos = $_SESSION['datos'];

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
			padding-top: 0px;
			padding-bottom: 20px;
			background-color: #E9ECEF;
		}

		#altoCard{
			height: 180px;
		}

		#titCardTrans{
			height: 90px;
			color: #148c9f;
		}

		#titH5{
			font-weight: bold;
		}

		#btnH5{
			font-weight: bold;
		}

		.box-contorno{
			border-style: solid;
			border-width: thick;
			box-shadow: -3px 3px 3px 0px #c1c1c1;
		}
		.btn-texto{
			font-size: 15px;
		}

		.card-title{
			text-align: center;
		}

		@media (min-width: 100px) and (max-width: 400px){
			.Titulo{
				font-size:20px;
				font-weight: bold;
			}
		</style>
	</head>

	<body>


		<nav class="navbar navbar-expand-sm navbar-expand-md navbar-expand-lg navbar-dark bg-primary sticky-top">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>  

			<a class="navbar-brand" href="#">
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
				<?php echo 'Bienvenid@:'.$datos; ?>
			</div>			
			<div class="d-flex justify-content-around">
				<a href="logout.php" class="btn btn-danger border-white">Cerrar Sesi&oacute;n</a>
			</div>
		</nav>		

		<section class="container">

			<div class="pl-4 mt-4 pt-0">
				<h1 class="text-center Titulo">Task Manager: Politicas Pendientes</h1>
			</div>

			<div class="row mt-4"> <!-- Inicia el margen desde el Top-->

				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 mt-3">
					<div class="card" id="altoCard"">
						<div class="card-body">
							<div id="titCardTrans">
								<h5 class="card-title" id="titH5">Transferencias Pendientes de Recepcion</h5>
							</div>
							<div>
								<a href="transferencias/transfer_pendientes.php" class="btn btn-warning btn-lg btn-block" id="btnH5"><?php echo getCantGuiasTransPend(1,$_SESSION['dni']); ?> Locales</a>
							</div>
						</div>
					</div>
				</div>		

				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 mt-3">
					<div class="card" id="altoCard"">
						<div class="card-body">
							<div id="titCardTrans">
								<h5 class="card-title" id="titH5">Deposito Bancario Pendiente</h5>
							</div>
							<div>
								<a href="deposito/deposito_pendiente.php" class="btn btn-warning btn-lg btn-block" id="btnH5"><?php echo getDepositoPendTarde(2,$_SESSION['dni']); ?> Locales</a>
							</div>								
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 mt-3">
					<div class="card" id="altoCard">
						<div class="card-body">
							<div id="titCardTrans">
								<h5 class="card-title" id="titH5">Remesas Fuera de Rango</h5>
							</div>
							<div>
								<a href="#" class="btn btn-success btn-lg btn-block" id="btnH5">0 Local</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 mt-3">
					<div class="card" id="altoCard">
						<div class="card-body">
							<div id="titCardTrans">
								<h5 class="card-title" id="titH5">Cierre de dia Pendiente</h5>
							</div>
							<div>
								<a href="#" class="btn btn-success btn-lg btn-block" id="btnH5">0 Local</a>
							</div>
						</div>
					</div>
				</div>		

				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 mt-3">
					<div class="card" id="altoCard">
						<div class="card-body">
							<div id="titCardTrans">
								<h5 class="card-title" id="titH5">Acumulacion de Deficit Excesivo</h5>
							</div>
							<div>
								<a href="#" class="btn btn-success btn-lg btn-block" id="btnH5">0 Local</a>
							</div>
						</div>
					</div>
				</div>							

				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 mt-3">
					<div class="card" id="altoCard">
						<div class="card-body">
							<div id="titCardTrans">
								<h5 class="card-title" id="titH5">Cuadratura de Anulacion Pendiente</h5>
							</div>
							<div>
								<a href="#" class="btn btn-success btn-lg btn-block" id="btnH5">0 Local</a>
							</div>
						</div>
					</div>
				</div>	

				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 mt-3">
					<div class="card" id="altoCard">
						<div class="card-body">
							<div id="titCardTrans">
								<h5 class="card-title" id="titH5">ASL's Pendientes</h5>
							</div>
							<div>
								<a href="#" class="btn btn-success btn-lg btn-block" id="btnH5">0 Local</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 mt-3">
					<div class="card" id="altoCard">
						<div class="card-body">
							<div id="titCardTrans">
								<h5 class="card-title" id="titH5">Cierre de día Pendiente</h5>
							</div>
							<div>
								<a href="#" class="btn btn-success btn-lg btn-block" id="btnH5">0 Local</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 mt-3">
					<div class="card" id="altoCard">
						<div class="card-body">
							<div id="titCardTrans">
								<h5 class="card-title" id="titH5">Acumulacion de Deficit Excesivo</h5>
							</div>
							<div>
								<a href="#" class="btn btn-success btn-lg btn-block" id="btnH5">0 Local</a>
							</div>
						</div>
					</div>
				</div>
			</div>				
		</section>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="bootstrap/js/bootstrap.js"></script>	
	</body>
	</html>