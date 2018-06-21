<?php
session_start();
require '../funcs/conexion.php';
include '../funcs/funcs.php';

$mailDest = $_POST['correo_dest'];
//$corOri = $_POST('correo_ori');
//$corDest = $_POST('correo_dest');
//echo $corDest;
//Make sure that the session variable actually exists!
/*if(isset($_SESSION['guiasTransPend'])){
    //Loop through it like any other array.
	$arrayGuias = $_SESSION['guiasTransPend'];
}*/

$GLOBALS['titCorreo'] = "Estimados por favor cerrar sus Guias de Transferencias Pendientes";
$GLOBALS['desCorreo'] = "Actualmente se cuenta con un buen numero de Guias de Transferencias Pendientes en sus locales. Si necesitan algún apoyo por favor no duden en contactarme.";

//$resultado = $_POST['origen'] + $_POST['destino'] + $_POST['jefeDestino'];

//$ori = $_POST['origen'];
//$dest = $_POST['destino'];
//$dniDest = $_POST['jefeDestino'];
//$oriDesc = mb_convert_case($_POST['oriDesc'], MB_CASE_TITLE, "UTF-8");//Transformo el texto a Mayusculas
//$destDesc = mb_convert_case($_POST['destDesc'], MB_CASE_TITLE, "UTF-8");//Transformo el texto a Mayusculas
?>

<html>
<head>
	<title>Transferencias Pendientes</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<style>
	body {
		margin-top: 40px;
		margin-bottom: 30px;
		background: #E9ECEF;
	}

	#bodyDetalle{
		background: #E9ECEF;
	}

	#cont1{
		padding-top: 20px;
		padding-bottom: 20px;
		border: 0px;
		/*border-color: black;
		background: orange;*/
	}

	#col1{
		border: solid 0px;
		/*border-color: black;
		background: orange;*/
	}
</style>
<!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
</head>

<body>
	<div class="container" id="cont1">
		<div class="row">

			<div class="div col-xl-3 col-lg-3 col-md-2" id="col1"></div>

			<div class="div col-xl-6 col-lg-6 col-md-8 col-12" id="col1">

				<div class="card border-white">
					<div class="card-header bg-primary text-center">
						<h5 class="card-title font-weight-light text-light">Enviar Correo</h5>
					</div>

					<div class="card-body">
						<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
						<form id="signupform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">

							<div id="signupalert" style="display:none" class="alert alert-danger">
								<p>Error:</p>
								<span></span>
							</div>

							<div class="form-group">
								<label for="titulo">Titulo:</label>
								<input type="text" class="form-control" name="titulo" placeholder="Escribe el Titulo de Tu correo" value=<?php echo "'".$titCorreo."'" ?> 
								required>

							</div>

							<div class="form-group">
								<label for="emails">Para:</label>
								<input type="text" class="form-control" name="emails" placeholder="Ingresar los Correos Destinos" value=<?php echo "'".$mailDest."'" ?> 
								required>

							</div>							

							<div class="form-group">
								<label for="detalle">Descripcion:</label>
								<textarea class="form-control" name="detalle" rows="6"><?php echo $desCorreo ?></textarea>
							</div>

							<div class="form-group d-flex justify-content-center">                      
								<button id="btn-signup" type="submit" class="btn btn-success">Enviar</button>
							</div>
						</form>
					</div>
				</div>
				
			</div>

			<div class="div col-xl-3 col-lg-3 col-md-2" id="col1"></div>

		</div>
	</div>

	<script src="../bootstrap/js/bootstrap.js"></script>				
</body>
</html>