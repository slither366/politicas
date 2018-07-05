<?php
session_start();
require '../funcs/conexion.php';
include '../funcs/funcs.php';

	if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}

	$idUsuario = $_SESSION['id_usuario'];
	$dniDest = $_SESSION['dni'];	
	?>
	<html>
	<head>
		<title>Transferencias Pendientes</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
		<script src="../js/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
		<link href="/static/fontawesome/fontawesome-all.css" rel="stylesheet">

		<style>
		/*body {
			padding-top: 0px;
			padding-bottom: 20px;
			background-color: #E9ECEF;
			}*/
			#bodyTransfer {
				padding-top: 0px;
				padding-bottom: 0px;
				margin-bottom: 0px;
				background-color: #E9ECEF;
			}

			#btnH5{
				font-weight: bold;
				font-size: 16px;
				width: 200px;
			}

			#titH5{
				text-align: center;
				font-weight: bold;
				font-size: 18px;
			}

			.card-title{
				text-align: center;
			}

			#titCardTrans{
				text-align: center;
			}

			#pruebita1{
			/*border: solid 1px;
			border-color: black;*/
		}

	</style>

	<script type="text/javascript">
		function mostrarDetDepositoPend(dni_zonal){
			var parametros = {
				"jefeDestino" : dni_zonal
			};
			$.ajax({
				data:  parametros,
				url:   'detDepositoPendiente.php',
				type:  'post',
				beforeSend: function () {
					//alert("Procesando, espere por favor Procesando...");
				},
				success:  function (response) {
					$("#section2").html(response);
				}
			});
		}

		function mostrarDetDepositoTarde(dni_zonal){
			var parametros = {
				"jefeDestino" : dni_zonal
			};
			$.ajax({
				data:  parametros,
				url:   'detDepositoTarde.php',
				type:  'post',
				beforeSend: function () {
					//alert("Procesando, espere por favor Procesando...");
				},
				success:  function (response) {
					$("#section2").html(response);
				}
			});
		}
	</script>
</head>

<body id="bodyTransfer">
	<nav class="navbar navbar-expand-sm navbar-expand-md navbar-expand-lg navbar-dark bg-primary sticky-top">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>  

		<a class="navbar-brand" href="../welcome.php">
			<img src="../images/logo.png" width="40" height="30" class="d-inline-block align-top" alt="Logo">
			TaskManager
		</a>

		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav mr-auto ml-auto text-center">
				<a class="nav-item nav-link active" href="../welcome.php">Inicio</a>

				<?php if($_SESSION['tipo_usuario']==1) { ?>
					<a class="nav-item nav-link" href="registro.php">Registrar Usuario</a>
				<?php } ?>
			</div>
		</div>  
		<div class="d-flex justify-content-around">
			<a href="../logout.php" class="btn btn-danger border-white">Cerrar Sesi&oacute;n</a>
		</div>
	</nav>

	<section class="container">
		<div class="pl-4 mt-4 pt-0">
			<h1 class="text-center Titulo">Deposito Bancario Pendiente</h1>
		</div>
		<div class="row mt-4 justify-content-center" id="pruebita1"> <!-- Inicia el margen desde el Top-->

			<div class=" col-xl-4 col-sm-6 col-md-4 col-lg-4 mt-3">
				<div class="card text-white bg-info mb-3" style="max-width: 18rem;">
					<div class="card-header" id="titH5">DEPOSITO PENDIENTE</div>
					<div class="card-body">
						<div id="titCardTrans">
							<h1><span class="badge badge-light"><?php echo getCountLocDepPend(2,$_SESSION['dni']);?></span></h1>
						</div>
						<div style="text-align: center" id="pruebita1">
							<a class="btn btn-warning btn-lg" id="btnH5" onclick="mostrarDetDepositoPend(<?php echo "'".$_SESSION['dni']."'"?>);return false;">Ver Detalle</a>
						</div>
					</div>
				</div>
			</div>

			<div class=" col-xl-4 col-sm-6 col-md-4 col-lg-4 mt-3">
				<div class="card text-white bg-info mb-3" style="max-width: 18rem;">
					<div class="card-header" id="titH5">DEPOSITADO TARDE</div>
					<div class="card-body">
						<div id="titCardTrans" id="pruebita1">
							<h1><span class="badge badge-light"><?php echo getDepositoPendTarde(2,$_SESSION['dni']);?></span></h1>
						</div>
						<div style="text-align: center" id="pruebita1">
							<a class="btn btn-warning btn-lg" id="btnH5" onclick="mostrarDetDepositoTarde(<?php echo "'".$_SESSION['dni']."'"?>);return false;">Ver Detalle</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="container2" id="section2"></section>

	<!--mt-0 mb-0 col-sm-6 col-md-4 col-lg-4-->
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="../bootstrap/js/bootstrap.js"></script>			
	<!--<script src="../js/transfePend.js"></script>-->
</body>
</html>