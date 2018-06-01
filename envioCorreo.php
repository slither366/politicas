<?php
session_start();
require 'funcs/conexion.php';
include 'funcs/funcs.php';

$errors = array();

$mail = $_SESSION['email'];
?>
<html>
<head>
	<title>Recuperar Password</title>
		<!--
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<script src="js/bootstrap.min.js" ></script>-->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">

		<style>
		.slider{
			height: 100vh;
			background: #b0ecff;
			background-size: cover;
		}
	</style>		
</head>

<body>
	<div class="container">
		<div class="row slider align-items-center justify-content-center">
			<div class="col-xl-7 col-lg-8 col-md-8 col-sm-8 col-10">
				<div class="card border-white">
					<div class="card-header bg-primary text-center">
						<h5 class="card-title font-weight-light text-light">Mensaje</h5>
					</div>

					<div class="card-body">
						<div class="d-flex justify-content-start"><p>Hemos enviado un correo electronico a la direccion <?php echo $mail ?> para restablecer tu password.</p></div>
						<div class="d-flex justify-content-end">
							<span class="badge badge-pill badge-warning"><a href="index.php" class="text-white">Regresar Inicio!</a></span>
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