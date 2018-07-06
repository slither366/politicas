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
		#tblSemaforo{
			font-size:12px;	
		}
	}

	@media (min-width: 992px) and (max-width: 2000px){
		#fontTrTabla{
			/*background-image: url("mail2.png");*/
			font-size:13px;
		}
		#tblSemaforo{
			font-size:13px;	
		}
	}

</style>

<script type="text/javascript">
	function ocultarDetalleTabla(codLocal){
		$("#tbodyDetalle tr").hide();
		$("#tbodyDetalle tr:contains("+codLocal+")").show(); 
		$("#tbodyTotDet tr").hide();
		$("#tbodyTotDet tr:contains("+codLocal+")").show();
	}

	function mostrarTodosTabla(){
		$("#tbodyDetalle tr").show();
		$("#tbodyTotDet tr").show();    
	}

	function filtrarSemaforo(textFiltro){
		$("#tbodyDetalle tr").hide();
		$("#tbodyDetalle tr:contains("+textFiltro+")").show(); 
	}
</script>
<!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
</head>

<body>
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
			<div class="col-8 pl-0 pr-0" id="pruebita1">
				<div class="card" style="border-radius: unset;border: solid 1px;border-color: #3C8DBC;">
					<div class="card-header pt-2" style="border-radius: unset;text-align: left;background-color: #3C8DBC;max-height: 3rem; color: white;">Semaforos Totalizados</div>
					<div class="card-body" style="background: #E9ECEF">
						<div class="table-responsive" style="max-height:220px;">
							<table class="table table-hover table-bordered" style="background: white;">
								<thead style="font-size: 13px;">
									<tr id="fontTrTabla">
										<!--<th scope="col">#</th>-->
										<th scope="col" class="text-center">LOCAL</th>
										<th scope="col" class="text-center"><span class="badge badge-info" id="tblSemaforo">MENOR 1 DÍA</span></th>
										<th scope="col" class="text-center"><span class="badge badge-warning" id="tblSemaforo" style="color: white;">MAYOR 1 DÍA</span></th>
										<th scope="col" class="text-center"><span class="badge badge-danger" id="tblSemaforo">MAYOR 2 DÍA</span></th>
										<th scope="col" class="text-center" style="font-weight: bold;">TOTALES</th>
										<th scope="col">MAIL</th>
									</tr>
								</thead>
								<tbody id="tbodyTotDet">
									<?php
									if ($datosTotalDepTarde){
										foreach($datosTotalDepTarde as $dato) {							
											?>
											<tr id="fontTrTabla" style="height: 10px;">
												<td class="text-center pt-1 pb-1" style="font-weight: bold;"><?php echo $dato["cod_local"];?></td>
												<td class="text-center pt-1 pb-1"><?php echo $dato["min_1"];?></td>
												<td class="text-center pt-1 pb-1"><?php echo $dato["may_1"];?></td>
												<td class="text-center pt-1 pb-1"><?php echo $dato["may_2"];?></td>
												<td class="text-center pt-1 pb-1" style="font-weight: bold;"><?php echo $dato["total"];?></td>
												<td>
													<div class="flex-grow-1 custom-control custom-checkbox align-middle" id="pruebita1" style="text-align:right;">
														<!--El input trabaja con el label para enviar datos a la otra pantalla-->
														<input type="checkbox" class="checkbox custom-control-input" 
														checked="checked" 
														value="">
														<label class="custom-control-label"></label>
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
										<th scope="col">#</th>
										<th scope="col">Local</th>
										<th scope="col">Dia Cierre</th>
										<th scope="col">Dia Oper.Bancaria</th>
										<th scope="col">Mon</th>
										<th scope="col">Monto</th>
										<th scope="col">Time Diferencia</th>
										<th scope="col">N°.Operacion</th>
										<th scope="col">Usuario Local</th>
										<th scope="col">Semaforo</th>
									</tr>
								</thead>
								<tbody id="tbodyDetalle">
									<?php
									if ($datosDepoTardeDet){
										foreach($datosDepoTardeDet as $dato) {							
											?>
											<tr id="fontTrTabla">
												<td scope="col" class="text-center"><?php echo $dato["rownum"];?></td>
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