<?php
session_start();
require '../funcs/conexion.php';
include '../funcs/funcs.php';

	if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}
	
	$idUsuario = $_SESSION['id_usuario'];
	?>
	<html>
	<head>
		<title>Transferencias Pendientes</title>
			<!--<link rel="stylesheet" href="css/bootstrap.min.css" >
			<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
			<script src="js/bootstrap.min.js" ></script>
			<script src='https://www.google.com/recaptcha/api.js'></script>-->
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<!-- Bootstrap CSS -->
			<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
			<script src="../js/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
			<style>
			body {
				padding-top: 0px;
				padding-bottom: 20px;
			}
			.table-responsive{
				overflow:scroll;
				height:200px;			
			}
			/* Por debajo de 400px */
			@media (min-width: 100px) and (max-width: 400px){
				.Titulo{
					font-size:20px;
					font-weight: bold;
				}

				.SubTitulo{
					font-size:16px;
				}

				.TextTable{
					font-size:12px;	
				}
			}
		</style>

		<script type="text/javascript">
			function mostrarDetGuias(ori, dest, jefeDest,oriDesc,destDesc){
				var parametros = {
					"origen" : ori,
					"destino" : dest,
					"jefeDestino": jefeDest,
					"oriDesc" : oriDesc,
					"destDesc" : destDesc
				};
				$.ajax({
					data:  parametros,
					url:   'detGuiasTabla.php',
					type:  'post',
					beforeSend: function () {
						$("#wait_1").html("Procesando, espere por favor Procesando...");
					},
					success:  function (response) {
						$("#jbtDetalle").html(response);
					}
				});
			}
		</script>
	</head>

	<body>

		<?php
		$datos = getGuiasTransPreDet(1,$_SESSION['dni']);
		$totalGuias = 0;
		$totCantLoc = 0;
		foreach($datos as $dato) {
			//echo $dato["tot"];
			$totalGuias = $totalGuias + $dato["tot"];
			$totCantLoc = $totCantLoc + 1;
		}
		?>		
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
				<h1 class="text-center Titulo">Guias de Transferencias Pendientes</h1>
			</div>

			<div>
				<div class="lead text-right SubTitulo mt-0 pt-0">Total Guias Pend.: <strong><?php echo $totalGuias?></strong></div>
				<div class="lead text-right SubTitulo mt-0 pt-0">N° Locales Pend.: <strong><?php echo $totCantLoc?></strong></div>
			</div>			

			<div class="row">

				<?php
				if ($datos){ 
					foreach($datos as $dato) {
						?>        	
						<div class="col-sm-6 col-md-4 col-lg-4 col-xl-3 mt-3 pt-0" id="target">
							<div class="card">
								<div class="card-header bg-success text-white">
									De: <?php echo $dato["ori"];?> a <b class="h4 font-weight-bold text-dark"><?php echo $dato["dest"];?></b>
								</div>
								<div class="card-body">
									<h5 class="card-title text-secondary">Fech.Crea: <strong>
										<?php echo $dato["fech"];?>
									</strong></h5>
									<a class="btn btn-warning btn-lg btn-block" onclick="mostrarDetGuias(<?php echo "'".$dato['ori']."'"?>,<?php echo "'".$dato['dest']."'"?>,<?php echo "'".$_SESSION['dni']."'"?>,<?php echo "'".$dato['oriDesc']."'"?>,<?php echo "'".$dato['destDesc']."'"?>);return false;">
										<b class="h6"><strong>Guias Pend: <?php echo $dato["tot"];?></strong></b>
									</a>
								</div>
							</div>
						</div>                
						<?php
					}
				} else {
					echo "No se encontraron datos";
				}
				?>
			</div>
		</section>

		<section class="container2" id="jbtDetalle">

		</section>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="../bootstrap/js/bootstrap.js"></script>			
		<script src="../js/transfePend.js"></script>
	</body>
	</html>