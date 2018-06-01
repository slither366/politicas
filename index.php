<?php
session_start();
require 'funcs/conexion.php';
require 'funcs/funcs.php';

$errors = array();

if(!empty($_POST)){
	$usuario = $mysqli->real_escape_string($_POST['usuario']);
	$password = $mysqli->real_escape_string($_POST['password']);

	if(isNullLogin($usuario,$password)){
		$errors[] = "Debe llenar todos los campos";
	}

	$errors[] = login($usuario,$password);
}
?>
<html>
<head>
	<title>Login</title>
		<!--
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<script src="js/bootstrap.min.js" ></script>
	-->
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">			

	<style>
	.slider{
		height: 100vh;
		background: #b0ecff;
		background-size: cover;
		background-position: center;

	}
</style>		
</head>

<body>
	<div class="container">
		<div class="row slider align-items-center justify-content-center">

			<div class="card border-white">
				<div class="card-header bg-primary text-center">
					<h5 class="card-title font-weight-light text-light">Iniciar Sesion</h5>
				</div>

				<div class="card-body">

					<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

					<form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
						<div class="form-group">
							<label for="">Usuario:</label>
							<input id="usuario" type="text" placeholder="usuario o email" class="form-control" name="usuario" value="" required>
						</div>

						<div class="form-group">
							<label for="">Contraseña:</label>
							<input id="password" type="password" placeholder="password" class="form-control" name="password" required>
						</div>

						<div class="form-group d-flex justify-content-center">
							<button id="btn-login" type="submit" class="btn btn-success">Iniciar Sesion</button>
						</div>
					</form>
					<?php
					echo resultBlock($errors);
					?>	
					<div class="d-flex justify-content-end">
						<span class="badge badge-pill badge-warning"><a href="recupera.php" class="text-white">Recuperar Password!</a></span>
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