<?php
require '../funcs/conexion.php';
include '../funcs/funcs.php';
//$resultado = $_POST['origen'] + $_POST['destino'] + $_POST['jefeDestino'];

$dniDest = $_POST['jefeDestino'];
$datosLocalesDepTarde= getLocDepPendTarde("2",$dniDest);
$datosDepoTardeDet= getDepPendTardeDet("2",$dniDest);
$datosTotalDepTarde= getTotalizadoDepTarde("2",$dniDest)

?>

<html>
<head>
	<title>Transferencias Pendientes</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
	<script src="../js/jquery-3.3.1.min.js" crossorigin="anonymous"></script>

	<style>
	@media (min-width: 100px) and (max-width: 450px){
		#miniBtn{
			/*background-image: url("mail2.png");*/
			font-size:13px;
		}

		#miniText{
			font-size:10px;
		}
	}

	@media (min-width: 450px) and (max-width: 2000px){
		#miniBtn{
			/*background-image: url("mail2.png");*/
			font-size:15px;
		}
	}

	@media (min-width: 100px) and (max-width: 992px){
		#fontTrTabla{
			/*background-image: url("mail2.png");*/
			font-size:10px;
		}

		#tblSemaforo, #tblSemafTotalizado{
			font-size:10px;	
		}

		#imgCorreo{
			width: 150%;
		}

		#divCorreo2{
			width: 30px;
		}

		#imgCorreo2{
			width: 70%;
		}

	}

	@media (min-width: 992px) and (max-width: 2000px){
		#fontTrTabla{
			/*background-image: url("mail2.png");*/
			font-size:13px;
		}
		#tblSemaforo, #tblSemafTotalizado{
			font-size:13px;	
		}

		#imgCorreo{
			width: 150%;
		}

		#divCorreo2{
			width: 35px;
		}

		#imgCorreo2{
			width: 70%;
		}		
	}

	.alertita1 {
		position: fixed;
		display:block; 
		top:50%; 
		right:20%;
		left: 20%;
		z-index: 99;
			/*border-color: black;
			border:solid 1px;*/
		}

	</style>

	<script type="text/javascript">
		var correosFrom = "";

		$(window).ready(function() {

			var ventana_ancho = $(window).width();
			if(ventana_ancho<576){
				$("#tblSemaforoTot1").text("LOC");
				$("#tblSemaforoTot2").text("< 1");
				$("#tblSemaforoTot3").text("> 1");
				$("#tblSemaforoTot4").text("> 2");
				$("#tblSemaforoTot5").text("TOT");
				$("#tblSemafDetTarde2").text("LOC");
				$("#tblSemafDetTarde3").text("D.CIERRE");
				$("#tblSemafDetTarde4").text("OP.BANC");
				$("#tblSemafDetTarde5").text("M");
				$("#tblSemafDetTarde6").text("MON");
				$("#tblSemafDetTarde7").text("TIM.DIF");
				$("#tblSemafDetTarde8").text("N°OPER");
				$("#tblSemafDetTarde9").text("USU.LOC");
				$("#tblSemafDetTarde10").text("SEMAF");
			}

			$("input:checkbox:checked").click(function() {
				var local = "";
				$("#frmCorreo").show();
				armarListaCorreos();
				mostrarEnvioCorreo();//Este envío de correos se encuentra en deposito_pendiente.php

				if(($("#"+$(this).attr("id")).is(':checked'))) {
					local = $(this).attr("id");
					alertaPantalla("Enviar Mail al" + local);
				} 

			});

			armarListaCorreos();
		});

		function armarListaCorreos(){
			correosFrom = "";
			$("input:checkbox:checked").each(function(){
				correosFrom = correosFrom + $(this).val().toLowerCase() + ";";
			});
		}

		function alertaPantalla(mensaje){
			$("#divAlertInt1").html(mensaje);
			$(".alertita1").fadeIn(2000);
			$(".alertita1").fadeOut(2000);
		}

		function ocultarDetalleTabla(codLocal){
			$("#tbodyDetalle tr").hide();
			$("#tbodyDetalle tr:contains("+codLocal+")").show(); 
			$("#tbodyTotDet tr").hide();
			$("#tbodyTotDet tr:contains("+codLocal+")").show();
			$('input:checkbox').prop('checked', false);
			$('#'+codLocal).prop('checked', true);
			armarListaCorreos();
			mostrarEnvioCorreo();
		}

		function mostrarTodosTabla(){
			$("#tbodyDetalle tr").show();
			$("#tbodyTotDet tr").show();

			$('input:checkbox').prop('checked', true);
			armarListaCorreos();
			mostrarEnvioCorreo();
		}

		function filtrarSemaforo(textFiltro){
			$("#tbodyDetalle tr").hide();
			$("#tbodyDetalle tr:contains("+textFiltro+")").show(); 
		}

		$(document).ready(function(){
			$("input:checkbox:checked").click(function() {
			/*if(($("#"+$(this).attr("id")).is(':checked'))) {
				$local = $(this).attr("id").substring(3,7);
				alertaPantalla("Enviar Mail al" + $local);
			} else {  
						//$("#divAlertInt").html("Cambio!");  
					}  

				});*/
			});
		});

	</script>
</head>

<body>

	<div class="alertita1" style="display:none;">
		<div class="row justify-content-center">
			<div class="col col-xl-4 col-lg-4 col-md-5 col-sm-6 col-10 text-center alert alert-success" role="alert" id="divAlertInt1">
				Enviar Correo a C54.
			</div>
		</div>
	</div>

	<section class="container" id="pruebita1">
		<div class="row justify-content-between"> <!-- Inicia el margen desde el Top -->
			<div class="col-xl-5 col-lg-5 col-md-8 col-sm-12 col-12 pl-0 pr-0 pb-4" id="pruebita1">
				<div class="card" style="border-radius: unset;border: solid 1px;border-color: #3C8DBC;">
					<div class="card-header" style="border-radius: unset;text-align: left;background-color: #3C8DBC;max-height: 3rem; color: white;">LEYENDA DE SEMAFOROS
					</div>
					<div class="card-body" style="background: #E9ECEF;font-size: 14px">
						<div class="row">
							<div class="col-12 pb-2">
								<span id="miniText">- Locales depositar hasta la 13:00 del siguiente día al Cierre día.</span>
							</div>
							<div class="col-4" style="text-align: center;">
								<span class="badge badge-info" style="cursor:pointer;color: white;" onclick="filtrarSemaforo('Menor 1')" id="miniBtn">Menor 1</span>
							</div>
							<div class="col-4" style="text-align: center;">
								<span class="badge badge-warning" style="cursor:pointer;color: white;" onclick="filtrarSemaforo('Mayor 1')" id="miniBtn">Mayor 1</span>
							</div>
							<div class="col-4" style="text-align: center;">
								<span class="badge badge-danger" style="text-align: center; cursor:pointer;color: white;" onclick="filtrarSemaforo('Mayor 2')" id="miniBtn">Mayor 2</span>
							</div>
							<div class="col-4" style="text-align: center;">
								<span id="miniText">Desde 13:00 - 23:59</span>
							</div>
							<div class="col-4" style="text-align: center;">
								<span id="miniText">Dia Siguiente al Cierre</span>
							</div>
							<div class="col-4" style="	text-align: center;">
								<span id="miniText">2° Dia Posterior al Cierre</span>
							</div>							
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 col-12 pl-0 pr-0 pb-4" id="pruebita1">
				<div class="card pl-0 pr-0" style="border-radius: unset;border: solid 1px;border-color: #3C8DBC;">
					<div class="card-header pt-2" style="border-radius: unset;text-align: left;background-color: #3C8DBC;max-height: 3rem; color: white;">FILTRO LOCALES DETALLE</div>
					<div class="card-body pt-2 pb-2" style="background: #E9ECEF;font-size: 14px">
						<div class="row">
							<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-3" style="text-align: center;">
								<a class="badge badge-secondary" style="cursor:pointer;color: white;" onclick="mostrarTodosTabla()" id="miniBtn">Todos</a>
							</div>
							<?php
							if ($datosLocalesDepTarde){
								foreach($datosLocalesDepTarde as $dato) {
									?>

									<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-3 pb-2" style="text-align: center;">
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

	<section class="container" id="pruebita1">
		<div class="row justify-content-left pb-4" id="pruebita1"> <!-- Inicia el margen desde el Top-->
			<div class="col-xl-10 col-lg-12 col-md-12 col-sm-12 col-12 pl-0 pr-0" id="pruebita1">
				<div class="card" style="border-radius: unset;border: solid 1px;border-color: #3C8DBC;">
					<div class="card-header pt-2" style="border-radius: unset;text-align: left;background-color: #3C8DBC;max-height: 3rem; color: white;">SEMAFOROS TOTALIZADOS</div>
					<div class="card-body" style="background: #E9ECEF">
						<div class="table-responsive" style="max-height:220px;">
							<table class="table table-hover table-bordered" style="background: white;" id="tbodyFilTot"> 
								<thead>
									<tr id="fontTrTabla">
										<!--<th scope="col">#</th>-->
										<th scope="col" class="text-center" id="tblSemaforoTot1">LOCAL</th>
										<th scope="col" class="text-center"><span class="badge badge-info" id="tblSemaforoTot2">MENOR 1 DÍA</span></th>
										<th scope="col" class="text-center"><span class="badge badge-warning" id="tblSemaforoTot3" style="color: white;">MAYOR 1 DÍA</span></th>
										<th scope="col" class="text-center"><span class="badge badge-danger" id="tblSemaforoTot4">MAYOR 2 DÍA</span></th>
										<th scope="col" class="text-center" style="font-weight: bold;" id="tblSemaforoTot5">TOTALES</th>
										<th scope="col" class="text-center">MAIL</th>
									</tr>	
								</thead>
								<tbody id="tbodyTotDet">
									<?php
									if ($datosTotalDepTarde){
										foreach($datosTotalDepTarde as $dato) {							
											?>
											<tr id="fontTrTabla" style="height: 30px;" style="vertical-align: center" >
												<td class="text-center pt-1 pb-0" style="font-weight: bold; vertical-align: center"><?php echo $dato["cod_local"];?></td>
												<td class="text-center pt-1 pb-0"><?php echo $dato["min_1"];?></td>
												<td class="text-center pt-1 pb-0"><?php echo $dato["may_1"];?></td>
												<td class="text-center pt-1 pb-0"><?php echo $dato["may_2"];?></td>
												<td class="text-center pt-1 pb-0" style="font-weight: bold;"><?php echo $dato["total"];?></td>
												<td id="pruebita1" class="pt-0 pb-0 mt-0 mb-0">
													<div class="d-flex flex-row justify-content-center align-items-end" id="pruebita1">
														<div class="p-0 bd-highlight" id="divCorreo2">
															<a onclick=""><img  src= "mail.svg" id="imgCorreo2"></a>
														</div>
														<div class="p-0 bd-highlight" id="pruebita1">
															<div class="custom-control custom-checkbox" id="pruebita1">
																<!--El input trabaja con el label para enviar datos a la otra pantalla-->
																
																<input type="checkbox" class="checkbox custom-control-input" 
																id=<?php echo "'".$dato['cod_local']."'"?> checked="checked" 
																value=<?php echo "'".$dato['correo']."'"?>>
																<label class="custom-control-label" id="pruebita1" for=<?php echo "'".$dato['cod_local']."'"?>></label>

															</div>
														</div>
													</div>
												</td>
											</tr>
											<?php
										}
									} else {
										echo "No se encontraron datos";
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</section>

	<section class="container" id="jbtDetalle">
		<div class="row justify-content-center pb-4" id="pruebita1"> <!-- Inicia el margen desde el Top-->
			<div class="col-12 pl-0 pr-0" id="pruebita1">
				<div class="card" style="border-radius: unset;border: solid 1px;border-color: #3C8DBC;">
					<div class="card-header pt-2" style="border-radius: unset;text-align: left;background-color: #3C8DBC;max-height: 3rem; color: white;">DETALLE DEPOSITOS TARDE</div>
					<div class="card-body" style="background: #E9ECEF">
						<div class="table-responsive" style="max-height:360px;">
							<table class="table table-hover table-bordered" style="background: white;">
								<thead style="font-size: 13px;">
									<tr id="fontTrTabla">
										<th scope="col" id="tblSemafDetTarde1" class="text-center">#</th>
										<th scope="col" id="tblSemafDetTarde2" class="text-center">Local</th>
										<th scope="col" id="tblSemafDetTarde3" class="text-center">Dia Cierre</th>
										<th scope="col" id="tblSemafDetTarde4" class="text-center">Dia Oper.Bancaria</th>
										<th scope="col" id="tblSemafDetTarde5" class="text-center">Mon</th>
										<th scope="col" id="tblSemafDetTarde6" class="text-center">Monto</th>
										<th scope="col" id="tblSemafDetTarde7" class="text-center">Time Diferencia</th>
										<th scope="col" id="tblSemafDetTarde8" class="text-center">N°.Operacion</th>
										<th scope="col" id="tblSemafDetTarde9" class="text-center">Usuario Local</th>
										<th scope="col" id="tblSemafDetTarde10" class="text-center">Semaforo</th>
									</tr>
								</thead>
								<tbody id="tbodyDetalle">
									<?php
									if ($datosDepoTardeDet){
										foreach($datosDepoTardeDet as $dato) {							
											?>
											<tr id="fontTrTabla">
												<td scope="col" class="text-center" id="tblSemafDetTarFirst"><?php echo $dato["rownum"];?></td>
												<td class="text-center" style="font-weight: bold;"><?php echo $dato["cod_local"];?></td>
												<td class="text-center"><?php echo $dato["fech_cierre"];?></td>
												<td class="text-center"><?php echo $dato["fech_oper"];?></td>
												<td class="text-center"><?php echo $dato["mon"];?></td>
												<td class="text-center"><?php echo $dato["mon_dep"];?></td>
												<td class="text-center"><?php echo $dato["time_dif"];?></td>
												<td class="text-center"><?php echo $dato["num_oper"];?></td>
												<td class="text-center"><?php echo $dato["usu_dep"];?></td>
												<td class="text-center">
													<?php
													$dife_min = $dato["dif_min"];
													if($dife_min<=720){//12*60 -> medio día
														echo '<span class="badge badge-info" id="tblSemaforo">Menor 1 día</span>';
													}else if($dife_min<=2160){//12*60 + 24*60 -> dia y medio
														echo '<span class="badge badge-warning" id="tblSemaforo">Mayor 1 día</span>';
													}else{//luego del dia y medio
														echo '<span class="badge badge-danger" id="tblSemaforo">Mayor 2 días</span>';
													}
													?>
												</td>
											</tr>
											<?php
										}
									} else {
										echo "No se encontraron datos";
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</section>

	<script src="../bootstrap/js/bootstrap.js"></script>				
</body>
</html>