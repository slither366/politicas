<?php
session_start();
require '/funcs/conexion.php';
include '/funcs/funcs.php';

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
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
		<script src="/js/jquery-3.3.1.min.js" crossorigin="anonymous"></script>

		<style>

		#bodyTransfer {
			padding-top: 0px;
			padding-bottom: 0px;
			margin-bottom: 0px;
			background-color: #E9ECEF;
		}

		#pruebita1{
			border: solid 1px;
			border-color: black;
		}
		
		body {
			font-family: WebFont;
			/*font-family: 'PT Serif Caption';*/
		}

		@media (min-width: 100px) and (max-width: 400px){
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

		function aler(){
			alert("funciona");
		}		

	</script>	
</head>

<body id="bodyTransfer">
	<section class="container" id="pruebita1">
		<div class="mt-0 pt-4 pb-4 mb-0" id="pruebita1">
			<div id="titulo1"></div>
		</div>
		<div class="row mt-0 pt-0 mb-0 justify-content-center" id="pruebita1"> <!-- Inicia el margen desde el Top-->
			
			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 pb-4" id="pruebita1">
				<div class="card " id="pruebita1" style="background: #3880C8;">
					<div class="card-body text-white mt-3 pt-0 mb-2 pb-0 ml-2 pl-0 mr-2 pr-0" id="pruebita1">
						<div class="d-flex flex-row bd-highlight justify-content-between mt-0 pt-0 " id="pruebita1" style="height: 100px;">
							<div class="d-flex bd-highlight" id="pruebita1" style="width: 40%;height: 100%;text-align:center;">
								<div id="pruebita1" class="align-self-center">
									<a><img src= "shipped.svg" id="icoImg"></a>
								</div>
							</div>
							<div class="bd-highlight mt-0 pt-0" id="pruebita1" style="width: 60%;height: 100%;">
								<div class="d-flex align-items-end flex-column bd-highlight mt-0 pt-0" id="pruebita1" style="height: 100%;">
									<div class="display-4 bd-highlight pt-0 mt-0" id="pruebita1" style="line-height: 0.7;">26</div>
									<div class="mt-auto bd-highlight" id="tit1" style="margin:0px;padding: 0px;">Transferencias Pendientes</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer bg-light mt-0 pt-0 mb-0 pb-0" id="etiqueta" onclick="<?php echo getCantGuiasTransPend(1,$_SESSION['dni']); ?>">
						<div class="d-flex flex-row justify-content-between" id="pruebita1" style="height:40px;">
							<div class="align-self-center" style="color: #3880C8;width: 60%;">
								Ver Detalle
							</div>
							<div class="align-self-center" id="pruebita1" style="color: #3880C8;width: 20%;">
								<div id="pruebita1" style="text-align: right">
									<a><img src= "right-arrow.svg" id="icoImg2"></a>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>


			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 pb-4" id="pruebita1">
				<div class="card " id="pruebita1" style="background: #56AF41;">
					<div class="card-body text-white mt-3 pt-0 mb-2 pb-0 ml-2 pl-0 mr-2 pr-0" id="pruebita1">
						<div class="d-flex flex-row bd-highlight justify-content-between mt-0 pt-0 " id="pruebita1" style="height: 100px;">
							<div class="d-flex bd-highlight" id="pruebita1" style="width: 40%;height: 100%;text-align:center;">
								<div id="pruebita1" class="align-self-center">
									<a><img src= "wallet.svg" id="icoImg"></a>
								</div>
							</div>
							<div class="bd-highlight mt-0 pt-0" id="pruebita1" style="width: 60%;height: 100%;">
								<div class="d-flex align-items-end flex-column bd-highlight mt-0 pt-0" id="pruebita1" style="height: 100%;">
									<div class="display-4 bd-highlight pt-0 mt-0" id="pruebita1" style="line-height: 0.7;">26</div>
									<div class="mt-auto bd-highlight" id="tit1" style="margin:0px;padding: 0px;">Deposito Bancario Pendiente</div>
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
									<a><img src= "right-arrow2.svg" id="icoImg2"></a>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>


			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 pb-4" id="pruebita1">
				<div class="card " id="pruebita1" style="background: #E99926;">
					<div class="card-body text-white mt-3 pt-0 mb-2 pb-0 ml-2 pl-0 mr-2 pr-0" id="pruebita1">
						<div class="d-flex flex-row bd-highlight justify-content-between mt-0 pt-0 " id="pruebita1" style="height: 100px;">
							<div class="d-flex bd-highlight" id="pruebita1" style="width: 40%;height: 100%;text-align:center;">
								<div id="pruebita1" class="align-self-center">
									<a><img src= "24hours2.svg" id="icoImg"></a>
								</div>
							</div>
							<div class="bd-highlight mt-0 pt-0" id="pruebita1" style="width: 60%;height: 100%;">
								<div class="d-flex align-items-end flex-column bd-highlight mt-0 pt-0" id="pruebita1" style="height: 100%;">
									<div class="display-4 bd-highlight pt-0 mt-0" id="pruebita1" style="line-height: 0.7;">26</div>
									<div class="mt-auto bd-highlight" id="tit1" style="margin:0px;padding: 0px;">Remesas Fuera de Rango</div>
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
									<a><img src= "right-arrow3.svg" id="icoImg2"></a>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>

			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 pb-4" id="pruebita1">
				<div class="card " id="pruebita1" style="background: #DA4235;">
					<div class="card-body text-white mt-3 pt-0 mb-2 pb-0 ml-2 pl-0 mr-2 pr-0" id="pruebita1">
						<div class="d-flex flex-row bd-highlight justify-content-between mt-0 pt-0 " id="pruebita1" style="height: 100px;">
							<div class="d-flex bd-highlight" id="pruebita1" style="width: 40%;height: 100%;text-align:center;">
								<div id="pruebita1" class="align-self-center">
									<a><img src= "wallet.svg" id="icoImg"></a>
								</div>
							</div>
							<div class="bd-highlight mt-0 pt-0" id="pruebita1" style="width: 60%;height: 100%;">
								<div class="d-flex align-items-end flex-column bd-highlight mt-0 pt-0" id="pruebita1" style="height: 100%;">
									<div class="display-4 bd-highlight pt-0 mt-0" id="pruebita1" style="line-height: 0.7;">26</div>
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
									<a><img src= "right-arrow4.svg" id="icoImg2"></a>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>

			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 pb-4" id="pruebita1">
				<div class="card " id="pruebita1" style="background: #DA4235;">
					<div class="card-body text-white mt-3 pt-0 mb-2 pb-0 ml-2 pl-0 mr-2 pr-0" id="pruebita1">
						<div class="d-flex flex-row bd-highlight justify-content-between mt-0 pt-0 " id="pruebita1" style="height: 100px;">
							<div class="d-flex bd-highlight" id="pruebita1" style="width: 40%;height: 100%;text-align:center;">
								<div id="pruebita1" class="align-self-center">
									<a><img src= "wallet.svg" id="icoImg"></a>
								</div>
							</div>
							<div class="bd-highlight mt-0 pt-0" id="pruebita1" style="width: 60%;height: 100%;">
								<div class="d-flex align-items-end flex-column bd-highlight mt-0 pt-0" id="pruebita1" style="height: 100%;">
									<div class="display-4 bd-highlight pt-0 mt-0" id="pruebita1" style="line-height: 0.7;">26</div>
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
									<a><img src= "right-arrow4.svg" id="icoImg2"></a>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>

			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 pb-4" id="pruebita1">
				<div class="card " id="pruebita1" style="background: #E99926;">
					<div class="card-body text-white mt-3 pt-0 mb-2 pb-0 ml-2 pl-0 mr-2 pr-0" id="pruebita1">
						<div class="d-flex flex-row bd-highlight justify-content-between mt-0 pt-0 " id="pruebita1" style="height: 100px;">
							<div class="d-flex bd-highlight" id="pruebita1" style="width: 40%;height: 100%;text-align:center;">
								<div id="pruebita1" class="align-self-center">
									<a><img src= "wallet.svg" id="icoImg"></a>
								</div>
							</div>
							<div class="bd-highlight mt-0 pt-0" id="pruebita1" style="width: 60%;height: 100%;">
								<div class="d-flex align-items-end flex-column bd-highlight mt-0 pt-0" id="pruebita1" style="height: 100%;">
									<div class="display-4 bd-highlight pt-0 mt-0" id="pruebita1" style="line-height: 0.7;">26</div>
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
									<a><img src= "right-arrow3.svg" id="icoImg2"></a>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>

			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 pb-4" id="pruebita1">
				<div class="card " id="pruebita1" style="background: #56AF41;">
					<div class="card-body text-white mt-3 pt-0 mb-2 pb-0 ml-2 pl-0 mr-2 pr-0" id="pruebita1">
						<div class="d-flex flex-row bd-highlight justify-content-between mt-0 pt-0 " id="pruebita1" style="height: 100px;">
							<div class="d-flex bd-highlight" id="pruebita1" style="width: 40%;height: 100%;text-align:center;">
								<div id="pruebita1" class="align-self-center">
									<a><img src= "wallet.svg" id="icoImg"></a>
								</div>
							</div>
							<div class="bd-highlight mt-0 pt-0" id="pruebita1" style="width: 60%;height: 100%;">
								<div class="d-flex align-items-end flex-column bd-highlight mt-0 pt-0" id="pruebita1" style="height: 100%;">
									<div class="display-4 bd-highlight pt-0 mt-0" id="pruebita1" style="line-height: 0.7;">26</div>
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
									<a><img src= "right-arrow2.svg" id="icoImg2"></a>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>

			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 pb-4" id="pruebita1">
				<div class="card " id="pruebita1" style="background: #3880C8;">
					<div class="card-body text-white mt-3 pt-0 mb-2 pb-0 ml-2 pl-0 mr-2 pr-0" id="pruebita1">
						<div class="d-flex flex-row bd-highlight justify-content-between mt-0 pt-0 " id="pruebita1" style="height: 100px;">
							<div class="d-flex bd-highlight" id="pruebita1" style="width: 40%;height: 100%;text-align:center;">
								<div id="pruebita1" class="align-self-center">
									<a><img src= "wallet.svg" id="icoImg"></a>
								</div>
							</div>
							<div class="bd-highlight mt-0 pt-0" id="pruebita1" style="width: 60%;height: 100%;">
								<div class="d-flex align-items-end flex-column bd-highlight mt-0 pt-0" id="pruebita1" style="height: 100%;">
									<div class="display-4 bd-highlight pt-0 mt-0" id="pruebita1" style="line-height: 0.7;">26</div>
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
									<a><img src= "right-arrow.svg" id="icoImg2"></a>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>

			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-10 pb-4" id="pruebita1">
				<div class="card " id="pruebita1" style="background: #E99926;">
					<div class="card-body text-white mt-3 pt-0 mb-2 pb-0 ml-2 pl-0 mr-2 pr-0" id="pruebita1">
						<div class="d-flex flex-row bd-highlight justify-content-between mt-0 pt-0 " id="pruebita1" style="height: 100px;">
							<div class="d-flex bd-highlight" id="pruebita1" style="width: 40%;height: 100%;text-align:center;">
								<div id="pruebita1" class="align-self-center">
									<a><img src= "wallet.svg" id="icoImg"></a>
								</div>
							</div>
							<div clas+s="bd-highlight mt-0 pt-0" id="pruebita1" style="width: 60%;height: 100%;">
								<div class="d-flex align-items-end flex-column bd-highlight mt-0 pt-0" id="pruebita1" style="height: 100%;">
									<div class="display-4 bd-highlight pt-0 mt-0" id="pruebita1" style="line-height: 0.7;">26</div>
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
									<a><img src= "right-arrow3.svg" id="icoImg2"></a>
								</div>
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
									<div class="display-4 bd-highlight pt-0 mt-0" id="pruebita1" style="line-height: 0.7;"><?php echo getCountLocRemesas(3,''); ?></div>
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

		<div class="row mt-0 pt-0 mb-0 justify-content-center" id="pruebita1"> <!-- Inicia el margen desde el Top-->

		</div>		

	</section>

	<section class="container2" id="section2"></section>

	<section class="container3" id="frmCorreo"></section>

	<!--mt-0 mb-0 col-sm-6 col-md-4 col-lg-4-->
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="/bootstrap/js/bootstrap.js"></script>			
	<!--<script src="../js/transfePend.js"></script>-->
</body>
</html>