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

			<style>
			body {
				padding-top: 0px;
				padding-bottom: 20px;
			}

			/* Por debajo de 400px */
			@media (min-width: 100px) and (max-width: 700px){
				.Titulo{
					font-size:20px;
					font-weight: bold;
				}
			}

			@media (min-width: 100px) and (max-width: 700px){
				.SubTitulo{
					font-size:16px;
				}
			}
		</style>

		<script type="text/javascript">
			$(document).ready(function(){
				$("#ocultarDivs").click(function(){
					$('#target').hide(3000);
					//$('.target').hide("fast");
				});			
				$("#mostrarDetalle").click(function(){
					$('#target').show(3000);
					$('.target').show("slow");
				});
				$("#ocultarDetalle").click(function(){
					$('#target').hide(3000);
					$('.target').hide("fast");
				});
			});
		</script>

	</head>

	<body>

		<?php
		$datos = getGuiasTransPreDet(1,$_SESSION['dni']);
		$totalGuias = 0;
		$totCantLoc = 0;
		foreach($datos as $dato) {
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
									<a href="#" class="btn btn-warning btn-lg btn-block" id="ocultarDivs" onclick = "ejecutarDetalle();"><b class="h6"><strong>Guias Pend: <?php echo $dato["tot"];?></strong></b></a>
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

		<script>
			function ejecutarDetalle(){
				document.write('<?php echo accion(); ?>');
			}
		</script>


		<?php
		function accion(){

		}

		?>

		<section class="container2" style="display:none;" id="jbtDetalle">
			<div class="pl-4">
				<h1 class="text-center Titulo">Detalle de Guias Pendientes</h1>
				<div class="SubTitulo text-center"><strong>C58-PUNO LIMA 3</strong> AL <strong>C54-JULIACA SAN ROMAN 2</strong></div>
			</div>				
			<div class="container3">
				<div class="table-responsive">          
					<table class="table table-hover" >
						<thead class="thead-dark">
							<tr>
								<th scope="col">#</th>
								<th scope="col">Cod. Documento</th>
								<th scope="col">Cant. Productos</th>
								<th scope="col">Fecha Creación</th>
							</tr>
						</thead>						
						<tbody>
							<tr>
								<th scope="row">1</th>
								<td>3330009989</td>
								<td>16</td>
								<td>13/05/2018</td>
							</tr>
							<tr>
								<th scope="row">2</th>
								<td>3330009990</td>
								<td>8</td>
								<td>14/05/2018</td>
							</tr>
							<tr>
								<th scope="row">3</th>
								<td>3330009991</td>
								<td>32</td>
								<td>15/05/2018</td>
							</tr>
							<tr>
								<th scope="row">4</th>
								<td>3330009992</td>
								<td>8</td>
								<td>14/05/2018</td>
							</tr>		

						</tbody>			
					</table>
				</div>
			</div>
		</section>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="../bootstrap/js/bootstrap.js"></script>			
		<script src="../js/transfePend.js"></script>	
	</body>
	</html>