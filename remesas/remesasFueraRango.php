<?php
session_start();
require '../funcs/conexion.php';
include '../funcs/funcs.php';

	if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}

	$idUsuario = $_SESSION['id_usuario'];
	$dniDest = $_SESSION['dni'];	

	$nomMesRemesas = getMesRemesas(3,'');	
	$locRemPendiente= getLocRemPend(3,'7','');
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

		#pruebita1, #section1{
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

		@media (min-width: 100px) and (max-width: 768px){
			/*#btnH5{
				width: 140px;
				
				}*/

				#titH5{
					font-size: 13px;
				}

				#titulo1{
					font-size: 20px;
					font-weight: bold;
					text-align: center;
				}
			}

			@media (min-width: 768px) and (max-width: 2000px){
			/*#btnH5{
				width: 120px;
				}*/
				#titulo1{
					font-size: 25px;
					font-weight: bold;
					text-align: center;
				}
			}

			@media (min-width: 100px) and (max-width: 400px){
				#imgCorreo{
					width: 100%;
				}	

				.linkCorreo {
					right: 0px;
				}
			}

			@media (min-width: 400px) and (max-width: 1800px){
				#imgCorreo{
					width: 150%;
				}		

				.linkCorreo {
					right: 18px;
				}	
			}
		</style>

		<script type="text/javascript">
			var titCorreo = "";
			var desCorreo = "";

			function mostrarDetLocRemesasPend(dni_zonal,num_mes){
				$("#frmCorreo").hide();
				var parametros = {
					"jefeDestino" : dni_zonal,
					"pMonth" : num_mes
				};
				$.ajax({
					data:  parametros,
					url:   'detRemesasFueraRango.php',
					type:  'post',
					beforeSend: function () {
					//alert("Procesando, espere por favor Procesando...");
				},
				success:  function (response) {
					$("#section1").html(response);
				}
			});
			}
		</script>
	</head>

	<body id="bodyTransfer">

		<div class="linkCorreo">
			<div >
				<a onclick="mostrarEnvioCorreo();return false;" id="linkCorreo1"><img src= "mail.svg" id="imgCorreo"></a>
			</div>
		</div>	

		<nav class="navbar navbar-expand-sm navbar-expand-md navbar-expand-lg navbar-dark sticky-top mt-0 pt-0 pb-0 mb-0" id="pruebita1" style="background:#E30313">

			<a class="navbar-brand pt-0 mt-0 mb-0 pb-0" href="../welcome.php" id="pruebita1" >
				<img src="../images/LogoFP.png" class="d-inline-block align-top" alt="Logo" id="pruebita1" style="width: 150px;">
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

		<section class="container" id="pruebita1">
			<div class="mt-0 pt-4 pb-4 mb-0" id="pruebita1">
				<div id="titulo1">REMESAS FUERA DE RANGO</div>
			</div>
			<div class="row mt-0 pt-0 mb-0 justify-content-center" id="pruebita1"> <!-- Inicia el margen desde el Top-->

				<?php
				if ($nomMesRemesas){ 
					foreach($nomMesRemesas as $dato) {
						?>			
						<div class="col-xl-3 col-lg-4 col-md-5 col-sm-5 col-10 pb-4" id="pruebita1">
							<div class="card text-white bg-info" id="pruebita1">
								<div class="d-flex flex-row card-header pb-2 pt-2" id="pruebita1">
									<div class="d-flex " id="titH5" style="width:80%;">
										<?php
										echo strtoupper($dato["mes"]);
										?>
									</div>
									<div class="" id="pruebita1" style="width:20%;text-align: right;">
										<span class="badge badge-light" style="font-size: 18px;">
											<?php echo getCountLocRemesasMes(3,$dato["numMes"],'');?></span>
										</div>

									</div>
									<div class="card-body" id="pruebita1">
										<div id="titCardTrans" id="pruebita1">

										</div>
										<div style="text-align: center" id="pruebita1">
											<a class="btn btn-warning btn-lg" id="btnH5" style="width: 95%;" onclick="mostrarDetLocRemesasPend(<?php echo "'".$_SESSION['dni']."'"?>,<?php echo $dato["numMes"];?>);return false;">Ver Locales</a>
										</div>
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

			<section class="container" id="section1" >

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