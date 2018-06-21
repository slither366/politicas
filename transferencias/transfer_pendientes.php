<?php
session_start();
require '../funcs/conexion.php';
include '../funcs/funcs.php';

	if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}

	$idUsuario = $_SESSION['id_usuario'];
	?>

	<?php
	$datos = getGuiasTransPreDet(1,$_SESSION['dni']);
	$_SESSION['guiasTransPend'] = $datos;

	$totalGuias = 0;
	$totCantLoc = 0;

	if($datos > 0){
		foreach($datos as $dato) {
			$totalGuias = $totalGuias + $dato["tot"];
			$totCantLoc = $totCantLoc + 1;
		}
	}
	?>	
	<html>
	<head>
		<title>Transferencias Pendientes</title>
		<meta charset="utf-8">
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
			background-color: #E9ECEF;
		}
		
		#jbtDetalle{
			background-color: #E9ECEF;
		}

		.table-responsive{
			overflow:scroll;
			height:200px;	
		}

		#btnDescargar{
			font-size:16px;
			font-weight: bold;
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

			#btnDescargar{
				font-size:14px;
				font-weight: bold;
			}
		}

			/*.linkCorreo{
				position: fixed;
				top: 580px;
				z-index: 100;
				right: 0;
				}*/

				.linkCorreo {
					position: fixed;
					left: 0;
					bottom: 100px;
					width: 100%;
					color: white;
					text-align: right;
					z-index: 100;
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

				function mostrarEnvioCorreo(mailDest){
					var parametros = {
						"correo_dest" : mailDest
					};
					$.ajax({
						data:  parametros,
						url:   'formEnviarCorreo.php',
						type:  'post',
						beforeSend: function () {
							$("#wait_2").html("Procesando, espere por favor Procesando...");
						},
						success:  function (response) {
							$("#frmCorreo").html(response);
						}
					});
				}

				function armarListaCorreos(){
					var correosFrom = "";
					$("input:checkbox:checked").each(function() {
								//alert($(this).val());
								//alert($(this).attr("id"));
								correosFrom = correosFrom + $(this).val() + ";";
							});
					//alert(correosFrom);
					mostrarEnvioCorreo(correosFrom);
				}

				$(window).ready(function(){

					$("input:checkbox:checked").click(function() {
						armarListaCorreos();
					});
						/*
						$("#eyes").click(function(){
							//alert(alto + " px");
							$("body").animate({ scrollTop: $(document).height()}, 2000);
						});			

						// Mueve el enfoque de pantalla al reporte
						$(".btn").click(function(){

							alto=$(document).height();

							if(alto>1058){
								alto = alto - 1060;
							}else{
								alto=$(document).height();
							}

							//alert($(document).height());
							//alert(alto);
							$("body").animate({ scrollTop: alto}, 2000);    
						});
						*/

						/*
						$("#btnVerGuias").click(function(){
							$("body").animate({ scrollTop: $(document).height()}, 2000);    
						});
						*/

						// Generar reporte en excel
						/*$("#btnDescargar").click(function(e) {
							window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#jbtDetalle').html()));
							e.preventDefault();
						});*/

					});

				</script>
			</head>

			<body id="bodyTransfer">

				<div class="linkCorreo">
					<div id="eyes">
						<a onclick="armarListaCorreos();return false;">
							<img src= "mail.png"> </a>
						</div>
					</div>
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
									<div class="col-sm-6 col-md-4 col-lg-4 mt-3 pt-0">
										<div class="card">

											<div class="card-header bg-success text-white d-flex">
												<div >
													De: <?php echo $dato["ori"];?> a 
													<b class="h4 font-weight-bold text-dark">
														<?php echo $dato["dest"];?>
													</b>
												</div>
												<div class="flex-grow-1 custom-control custom-checkbox align-middle" style="text-align: right;">
													<input type="checkbox" class="checkbox custom-control-input" 
													id=<?php echo "'".$dato['ori'].$dato['dest']."'"?> checked="checked" 
													value=<?php echo "'".$dato['destCorreo']."'"?>>
													<label class="custom-control-label" for=<?php echo "'".$dato['ori'].$dato['dest']."'"?> ></label>
												</div>
											</div>

											<div class="card-body">
												<h5 class="card-title text-secondary">Fech.Crea: <strong>
													<?php echo $dato["fech"];?>
												</strong></h5>
												<a class="btn btn-warning btn-lg btn-block" onclick="mostrarDetGuias(<?php echo "'".$dato['ori']."'"?>,<?php echo "'".$dato['dest']."'"?>,<?php echo "'".$_SESSION['dni']."'"?>,<?php echo "'".$dato['oriDesc']."'"?>,<?php echo "'".$dato['destDesc']."'"?>);return false;" id="btnVerGuias">
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

					<section class="container2" id="jbtDetalle"></section>

					<section class="container4 " id="frmCorreo"></section>
					<!--mt-0 mb-0 col-sm-6 col-md-4 col-lg-4-->
					<!-- Optional JavaScript -->
					<!-- jQuery first, then Popper.js, then Bootstrap JS -->
					<script src="../bootstrap/js/bootstrap.js"></script>			
					<!--<script src="../js/transfePend.js"></script>-->
				</body>
				</html>