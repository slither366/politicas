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
			background-color: #F3F3F3;
		}

		/*#altoCard{
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
		}*/

		#etiqueta{
			cursor:pointer;
		}

		/*#pruebita1{
			border: solid 1px;
			border-color: black;
		}*/

		@media (min-width: 100px) and (max-width: 400px){
			.Titulo{
				font-size:20px;
				font-weight: bold;
			}

			#icoImg{
				width: 90%;
			}

			#icoImg2{
				width: 60%;
			}

			#tit1{
				font-size:16px;
				text-align: right;
				line-height: 1.2;
			}			
		}

		@media (min-width: 400px) and (max-width: 576px){
			#icoImg{
				width: 60%;
			}

			#icoImg2{
				width: 35%;
			}

			#tit1{
				font-size:18px;
				text-align: right;
				line-height: 1.2;
			}						
		}

		@media (min-width: 576px) and (max-width: 2000px){
			#icoImg{
				width: 95%;
			}

			#icoImg2{
				width: 60%;
			}
			#tit1{
				font-size:18px;
				text-align: right;
				line-height: 1.2;
			}	
		}		

	</style>

	<script type="text/javascript">


	</script>
</head>

<body>

	<nav class="navbar navbar-expand-sm navbar-expand-md navbar-expand-lg navbar-dark sticky-top mt-0 pt-0 pb-0 mb-0" id="pruebita1" style="background:#E30313">

		<a class="navbar-brand pt-0 mt-0 mb-0 pb-0" href="#" id="pruebita1">
			<img src="images/LogoFP.png" class="d-inline-block align-top" alt="Logo" id="pruebita1" style="width: 150px;">
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

			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 pb-4" id="pruebita1">
				<div class="card " id="pruebita1" style="background: #3880C8;">
					<div class="card-body text-white mt-3 pt-0 mb-2 pb-0 ml-2 pl-0 mr-2 pr-0" id="pruebita1">
						<div class="d-flex flex-row bd-highlight justify-content-between mt-0 pt-0 " id="pruebita1" style="height: 100px;">
							<div class="d-flex bd-highlight" id="pruebita1" style="width: 40%;height: 100%;text-align:center;">
								<div id="pruebita1" class="align-self-center">
									<a><img src= "images/shipped.svg" id="icoImg"></a>
								</div>
							</div>
							<div class="bd-highlight mt-0 pt-0" id="pruebita1" style="width: 60%;height: 100%;">
								<div class="d-flex align-items-end flex-column bd-highlight mt-0 pt-0" id="pruebita1" style="height: 100%;">
									<div class="display-4 bd-highlight pt-0 mt-0" id="pruebita1" style="line-height: 0.7;"><?php echo getCantGuiasTransPend(1,$_SESSION['dni']); ?></div>
									<div class="mt-auto bd-highlight" id="tit1" style="margin:0px;padding: 0px;">Transferencias Pendientes</div>
								</div>
							</div>
						</div>
					</div>

					<div class="card-footer bg-light mt-0 pt-0 mb-0 pb-0" id="etiqueta" onclick="location.href='transferencias/transfer_pendientes.php';">
						<div class="d-flex flex-row justify-content-between" id="pruebita1" style="height:40px;">
							<div class="align-self-center" style="color: #3880C8;width: 60%;">
								Ver Detalle
							</div>
							<div class="align-self-center" id="pruebita1" style="color: #3880C8;width: 20%;">
								<div id="pruebita1" style="text-align: right">
									<a><img src= "images/right-arrow.svg" id="icoImg2"></a>
								</div>
							</div>
						</div>
					</div>	

				</div>
			</div>

			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 pb-4" id="pruebita1">
				<div class="card " id="pruebita1" style="background: #56AF41;">
					<div class="card-body text-white mt-3 pt-0 mb-2 pb-0 ml-2 pl-0 mr-2 pr-0" id="pruebita1">
						<div class="d-flex flex-row bd-highlight justify-content-between mt-0 pt-0 " id="pruebita1" style="height: 100px;">
							<div class="d-flex bd-highlight" id="pruebita1" style="width: 40%;height: 100%;text-align:center;">
								<div id="pruebita1" class="align-self-center">
									<a><img src= "images/bank.svg" id="icoImg"></a>
								</div>
							</div>
							<div class="bd-highlight mt-0 pt-0" id="pruebita1" style="width: 60%;height: 100%;">
								<div class="d-flex align-items-end flex-column bd-highlight mt-0 pt-0" id="pruebita1" style="height: 100%;">
									<div class="display-4 bd-highlight pt-0 mt-0" id="pruebita1" style="line-height: 0.7;"><?php echo getDepositoPendTarde(2,$_SESSION['dni']); ?></div>
									<div class="mt-auto bd-highlight" id="tit1" style="margin:0px;padding: 0px;">Deposito Bancario Pendiente</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer bg-light mt-0 pt-0 mb-0 pb-0" id="etiqueta" onclick="location.href='deposito/deposito_pendiente.php';">
						<div class="d-flex flex-row justify-content-between" id="pruebita1" style="height:40px;">
							<div class="align-self-center" id="pruebita1" style="color: #56AF41;width: 60%;">
								Ver Detalle
							</div>
							<div class="align-self-center" id="pruebita1" style="color: #56AF41;width: 20%;">
								<div id="pruebita1" style="text-align: right">
									<a><img src= "images/right-arrow2.svg" id="icoImg2"></a>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>

			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 pb-4" id="pruebita1">
				<div class="card " id="pruebita1" style="background: #E99926;">

					<div class="card-body text-white mt-3 pt-0 mb-2 pb-0 ml-2 pl-0 mr-2 pr-0" id="pruebita1">
						<div class="d-flex flex-row bd-highlight justify-content-between mt-0 pt-0 " id="pruebita1" style="height: 100px;">
							<div class="d-flex bd-highlight" id="pruebita1" style="width: 40%;height: 100%;text-align:center;">
								<div id="pruebita1" class="align-self-center">
									<a><img src= "images/24hours2.svg" id="icoImg"></a>
								</div>
							</div>
							<div class="bd-highlight mt-0 pt-0" id="pruebita1" style="width: 60%;height: 100%;">
								<div class="d-flex align-items-end flex-column bd-highlight mt-0 pt-0" id="pruebita1" style="height: 100%;">
									<div class="display-4 bd-highlight pt-0 mt-0" id="pruebita1" style="line-height: 0.7;"><?php echo getCountLocRemesasTodos(3,''); ?></div>
									<div class="mt-auto bd-highlight" id="tit1" style="margin:0px;padding: 0px;">Remesas Fuera de Rango</div>
								</div>
							</div>
						</div>
						
					</div>
					<div class="card-footer bg-light mt-0 pt-0 mb-0 pb-0" id="etiqueta" onclick="location.href='remesas/remesasFueraRango.php';">
						<div class="d-flex flex-row justify-content-between" id="pruebita1" style="height:40px;">
							<div class="align-self-center" id="pruebita1" style="color: #E99926;width: 60%;">
								Ver Detalle
							</div>
							<div class="align-self-center" id="pruebita1" style="color: #E99926;width: 20%;">
								<div id="pruebita1" style="text-align: right">
									<a><img src= "images/right-arrow3.svg" id="icoImg2"></a>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>

			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 pb-4" id="pruebita1">
				<div class="card " id="pruebita1" style="background: #DA4235;">
					<div class="card-body text-white mt-3 pt-0 mb-2 pb-0 ml-2 pl-0 mr-2 pr-0" id="pruebita1">
						<div class="d-flex flex-row bd-highlight justify-content-between mt-0 pt-0 " id="pruebita1" style="height: 100px;">
							<div class="d-flex bd-highlight" id="pruebita1" style="width: 40%;height: 100%;text-align:center;">
								<div id="pruebita1" class="align-self-center">
									<a><img src= "" id="icoImg"></a>
								</div>
							</div>
							<div class="bd-highlight mt-0 pt-0" id="pruebita1" style="width: 60%;height: 100%;">
								<div class="d-flex align-items-end flex-column bd-highlight mt-0 pt-0" id="pruebita1" style="height: 100%;">
									<div class="display-4 bd-highlight pt-0 mt-0" id="pruebita1" style="line-height: 0.7;">0</div>
									<div class="mt-auto bd-highlight" id="tit1" style="margin:0px;padding: 0px;">Cierre Día Pendiente</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer bg-light mt-0 pt-0 mb-0 pb-0" id="etiqueta" onclick="aler();return false;">
						<div class="d-flex flex-row justify-content-between" id="pruebita1" style="height:40px;">
							<div class="align-self-center" id="pruebita1" style="color: #DA4235;width: 60%;">
								Ver Detalle
							</div>
							<div class="align-self-center" id="pruebita1" style="color: #DA4235;width: 20%;">
								<div id="pruebita1" style="text-align: right">
									<a><img src= "images/right-arrow4.svg" id="icoImg2"></a>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>

			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 pb-4" id="pruebita1">
				<div class="card " id="pruebita1" style="background: #DA4235;">
					<div class="card-body text-white mt-3 pt-0 mb-2 pb-0 ml-2 pl-0 mr-2 pr-0" id="pruebita1">
						<div class="d-flex flex-row bd-highlight justify-content-between mt-0 pt-0 " id="pruebita1" style="height: 100px;">
							<div class="d-flex bd-highlight" id="pruebita1" style="width: 40%;height: 100%;text-align:center;">
								<div id="pruebita1" class="align-self-center">
									<a><img src= "" id="icoImg"></a>
								</div>
							</div>
							<div class="bd-highlight mt-0 pt-0" id="pruebita1" style="width: 60%;height: 100%;">
								<div class="d-flex align-items-end flex-column bd-highlight mt-0 pt-0" id="pruebita1" style="height: 100%;">
									<div class="display-4 bd-highlight pt-0 mt-0" id="pruebita1" style="line-height: 0.7;">0</div>
									<div class="mt-auto bd-highlight" id="tit1" style="margin:0px;padding: 0px;">Acumulación Deficit Excesivo</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer bg-light mt-0 pt-0 mb-0 pb-0" id="etiqueta" onclick="aler();return false;">
						<div class="d-flex flex-row justify-content-between" id="pruebita1" style="height:40px;">
							<div class="align-self-center" id="pruebita1" style="color: #DA4235;width: 60%;">
								Ver Detalle
							</div>
							<div class="align-self-center" id="pruebita1" style="color: #DA4235;width: 20%;">
								<div id="pruebita1" style="text-align: right">
									<a><img src= "images/right-arrow4.svg" id="icoImg2"></a>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>

			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 pb-4" id="pruebita1">
				<div class="card " id="pruebita1" style="background: #E99926;">
					<div class="card-body text-white mt-3 pt-0 mb-2 pb-0 ml-2 pl-0 mr-2 pr-0" id="pruebita1">
						<div class="d-flex flex-row bd-highlight justify-content-between mt-0 pt-0 " id="pruebita1" style="height: 100px;">
							<div class="d-flex bd-highlight" id="pruebita1" style="width: 40%;height: 100%;text-align:center;">
								<div id="pruebita1" class="align-self-center">
									<a><img src= "" id="icoImg"></a>
								</div>
							</div>
							<div class="bd-highlight mt-0 pt-0" id="pruebita1" style="width: 60%;height: 100%;">
								<div class="d-flex align-items-end flex-column bd-highlight mt-0 pt-0" id="pruebita1" style="height: 100%;">
									<div class="display-4 bd-highlight pt-0 mt-0" id="pruebita1" style="line-height: 0.7;">0</div>
									<div class="mt-auto bd-highlight" id="tit1" style="margin:0px;padding: 0px;">Cuadratura Anulación Pendiente</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer bg-light mt-0 pt-0 mb-0 pb-0" id="etiqueta" onclick="aler();return false;">
						<div class="d-flex flex-row justify-content-between" id="pruebita1" style="height:40px;">
							<div class="align-self-center" id="pruebita1" style="color: #E99926;width: 60%;">
								Ver Detalle
							</div>
							<div class="align-self-center" id="pruebita1" style="color: #E99926;width: 20%;">
								<div id="pruebita1" style="text-align: right">
									<a><img src= "images/right-arrow3.svg" id="icoImg2"></a>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>

			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 pb-4" id="pruebita1">
				<div class="card " id="pruebita1" style="background: #56AF41;">
					<div class="card-body text-white mt-3 pt-0 mb-2 pb-0 ml-2 pl-0 mr-2 pr-0" id="pruebita1">
						<div class="d-flex flex-row bd-highlight justify-content-between mt-0 pt-0 " id="pruebita1" style="height: 100px;">
							<div class="d-flex bd-highlight" id="pruebita1" style="width: 40%;height: 100%;text-align:center;">
								<div id="pruebita1" class="align-self-center">
									<a><img src= "" id="icoImg"></a>
								</div>
							</div>
							<div class="bd-highlight mt-0 pt-0" id="pruebita1" style="width: 60%;height: 100%;">
								<div class="d-flex align-items-end flex-column bd-highlight mt-0 pt-0" id="pruebita1" style="height: 100%;">
									<div class="display-4 bd-highlight pt-0 mt-0" id="pruebita1" style="line-height: 0.7;">0</div>
									<div class="mt-auto bd-highlight" id="tit1" style="margin:0px;padding: 0px;">Asl's Pendientes</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer bg-light mt-0 pt-0 mb-0 pb-0" id="etiqueta" onclick="aler();return false;">
						<div class="d-flex flex-row justify-content-between" id="pruebita1" style="height:40px;">
							<div class="align-self-center" id="pruebita1" style="color: #56AF41;width: 60%;">
								Ver Detalle
							</div>
							<div class="align-self-center" id="pruebita1" style="color: #56AF41;width: 20%;">
								<div id="pruebita1" style="text-align: right">
									<a><img src= "images/right-arrow2.svg" id="icoImg2"></a>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>

			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 pb-4" id="pruebita1">
				<div class="card " id="pruebita1" style="background: #3880C8;">
					<div class="card-body text-white mt-3 pt-0 mb-2 pb-0 ml-2 pl-0 mr-2 pr-0" id="pruebita1">
						<div class="d-flex flex-row bd-highlight justify-content-between mt-0 pt-0 " id="pruebita1" style="height: 100px;">
							<div class="d-flex bd-highlight" id="pruebita1" style="width: 40%;height: 100%;text-align:center;">
								<div id="pruebita1" class="align-self-center">
									<a><img src= "" id="icoImg"></a>
								</div>
							</div>
							<div class="bd-highlight mt-0 pt-0" id="pruebita1" style="width: 60%;height: 100%;">
								<div class="d-flex align-items-end flex-column bd-highlight mt-0 pt-0" id="pruebita1" style="height: 100%;">
									<div class="display-4 bd-highlight pt-0 mt-0" id="pruebita1" style="line-height: 0.7;">0</div>
									<div class="mt-auto bd-highlight" id="tit1" style="margin:0px;padding: 0px;">Cierre Día Pendiente</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer bg-light mt-0 pt-0 mb-0 pb-0" id="etiqueta" onclick="aler();return false;">
						<div class="d-flex flex-row justify-content-between" id="pruebita1" style="height:40px;">
							<div class="align-self-center" id="pruebita1" style="color: #3880C8;width: 60%;">
								Ver Detalle
							</div>
							<div class="align-self-center" id="pruebita1" style="color: #3880C8;width: 20%;">
								<div id="pruebita1" style="text-align: right">
									<a><img src= "images/right-arrow.svg" id="icoImg2"></a>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>

			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12 pb-4" id="pruebita1">
				<div class="card " id="pruebita1" style="background: #E99926;">
					<div class="card-body text-white mt-3 pt-0 mb-2 pb-0 ml-2 pl-0 mr-2 pr-0" id="pruebita1">
						<div class="d-flex flex-row bd-highlight justify-content-between mt-0 pt-0 " id="pruebita1" style="height: 100px;">
							<div class="d-flex bd-highlight" id="pruebita1" style="width: 40%;height: 100%;text-align:center;">
								<div id="pruebita1" class="align-self-center">
									<a><img src= "" id="icoImg"></a>
								</div>
							</div>
							<div clas+s="bd-highlight mt-0 pt-0" id="pruebita1" style="width: 60%;height: 100%;">
								<div class="d-flex align-items-end flex-column bd-highlight mt-0 pt-0" id="pruebita1" style="height: 100%;">
									<div class="display-4 bd-highlight pt-0 mt-0" id="pruebita1" style="line-height: 0.7;">0</div>
									<div class="mt-auto bd-highlight" id="tit1" style="margin:0px;padding: 0px;">Acumulación Deficit Excesivo</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer bg-light mt-0 pt-0 mb-0 pb-0" id="etiqueta" onclick="aler();return false;">
						<div class="d-flex flex-row justify-content-between" id="pruebita1" style="height:40px;">
							<div class="align-self-center" id="pruebita1" style="color: #E99926;width: 60%;">
								Ver Detalle
							</div>
							<div class="align-self-center" id="pruebita1" style="color: #E99926;width: 20%;">
								<div id="pruebita1" style="text-align: right">
									<a><img src= "images/right-arrow3.svg" id="icoImg2"></a>
								</div>
							</div>
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