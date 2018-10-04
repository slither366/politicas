<?php
session_start();
require '../funcs/conexion.php';
include '../funcs/funcs.php';

	if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}
	
	$dniDest = $_POST['jefeDestino'];
	$numMes = $_POST['pMonth'];

	$nomMesRemesas = getMesRemesas(3,'');// el vacio es el dni del jefe zonal
	$locRemPendiente= getLocRemPend(3,$numMes,'');
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

		#bodyTransfer {
			padding-top: 0px;
			padding-bottom: 0px;
			margin-bottom: 0px;
			background-color: #F3F3F3;
		}

		#btnH5{
			font-weight: bold;
			font-size: 16px;
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
			border: solid 1px;
			border-color: black;
		}

		.linkCorreo {
			position: fixed;
			bottom: 200px;
			color: white;
			z-index: 1;
			cursor: pointer;
			/*border:1px solid black;*/
		}

		@media (min-width: 100px) and (max-width: 450px){
			#miniBtn{
				/*background-image: url("mail2.png");*/
				font-size:13px;
			}
		}

		@media (min-width: 450px) and (max-width: 2000px){
			#miniBtn{
				/*background-image: url("mail2.png");*/
				font-size:15px;
			}
		}

		</style>

	</head>

	<body id="bodyTransfer">

			<section class="container" id="pruebita1">
				<div class="row justify-content-between"> <!-- Inicia el margen desde el Top -->
					<div class="col-xl-12 col-lg-6 col-md-8 col-sm-12 col-12 pl-0 pr-0 pb-4" id="pruebita1">
						<div class="card pl-0 pr-0" style="border-radius: unset;border: solid 1px;border-color: #3C8DBC;">
							<div class="card-header pt-2" style="border-radius: unset;text-align: left;background-color: #3C8DBC;max-height: 3rem; color: white;">FILTRO LOCALES DETALLE</div>
							<div class="card-body pt-2 pb-2" style="background: #E9ECEF;font-size: 14px">
								<div class="row">
									<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-3" style="text-align: center;">
										<a class="badge badge-secondary" style="cursor:pointer;color: white;" onclick="mostrarTodosTabla()" id="miniBtn">Todos</a>
									</div>
									<?php
									if ($locRemPendiente){
										foreach($locRemPendiente as $dato) {
											?>

											<div class="col-xl-1 col-lg-2 col-md-2 col-sm-2 col-3 pb-2" style="text-align: center;">
												<a class="badge badge-success" style="cursor:pointer;color: white;" onclick="ocultarDetalleTabla(<?php echo "'".$dato["locales"]."'";?>)" id="miniBtn"><?php echo $dato["locales"];?></a>
											</div>

											<?php
										}
									} else {
										echo "No se encontraron datos";
									}
									?>						
								</div>
							</div>
						</div>						
					</div>				

				</div>
			</section>


			<section class="container2" id="section2"></section>

			<section class="container3" id="frmCorreo"></section>

			<!--mt-0 mb-0 col-sm-6 col-md-4 col-lg-4-->
			<!-- Optional JavaScript -->
			<!-- jQuery first, then Popper.js, then Bootstrap JS -->
			<script src="../bootstrap/js/bootstrap.js"></script>		
			<!--<script src="../js/transfePend.js"></script>-->
		</body>
		</html>