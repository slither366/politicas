<?php
require '../funcs/conexion.php';
include '../funcs/funcs.php';
//$resultado = $_POST['origen'] + $_POST['destino'] + $_POST['jefeDestino'];

$dniDest = $_POST['jefeDestino'];
$datosLocalesDepTarde= getLocDepPendTarde("2",$dniDest);
$datosDepoTardeDet= getDepPendTardeDet("2",$dniDest);
?>

<html>
<head>
	<title>Transferencias Pendientes</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<style>
			/*#pruebita1{
			border: solid 1px;
			border-color: black;*/
</style>

<script type="text/javascript">
	function ocultarDetalleTabla(codLocal){
		$("#tbodyDetalle tr").hide();
		$("#tbodyDetalle tr:contains("+codLocal+")").show();                
	}

	function mostrarTodosTabla(){
		$("#tbodyDetalle tr").show();         
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
		<div class="row mt-4"> <!-- Inicia el margen desde el Top -->
			<div class="col-12 pl-0 pr-0 d-flex flex-row justify-content-between" id="pruebita1">
				<div class="card col-xl-5 col-lg-5 col-md-6 pl-0 pr-0" style="border-radius: unset;border: solid 1px;border-color: #3C8DBC;">
					<div class="card-header pt-2" style="border-radius: unset;text-align: left;background-color: #3C8DBC;max-height: 3rem; color: white;">LEYENDA DE SEMAFOROS
					</div>
					<div class="card-body pt-2 pb-2" style="background: #E9ECEF;font-size: 14px">
						<div class="row">
							<div class="col-12 pb-2">
								<span>- Locales depositar hasta la 13:00 del siguiente día al Cierre día.</span>
							</div>
							<div class="col-4" style="text-align: center;">
								<span class="badge badge-info" style="font-size: 15px; cursor:pointer;color: white;" onclick="filtrarSemaforo('Menor 1')">Menor 1 día</span>
							</div>
							<div class="col-4" style="text-align: center;">
								<span class="badge badge-warning" style="font-size: 15px; cursor:pointer;color: white;" onclick="filtrarSemaforo('Mayor 1')">Mayor 1 día</span>
							</div>
							<div class="col-4" style="text-align: center;">
								<span class="badge badge-danger" style="font-size: 15px; text-align: center; cursor:pointer;color: white;" onclick="filtrarSemaforo('Mayor 2')">Mayor 2 días</span>
							</div>
							<div class="col-4" style="text-align: center;">
								<span style="font-size: 12px">Mayor a las 13:00 pm.</span>
							</div>
							<div class="col-4" style="text-align: center;">
								<span style="font-size: 12px">Posterior a 24 Horas.</span>
							</div>
							<div class="col-4" style="	text-align: center;">
								<span style="font-size: 12px">Posterior a 48 Horas.</span>
							</div>							
						</div>
					</div>
				</div>
				<div class="card col-xl-6 col-lg-6 col-md-6 pl-0 pr-0" style="border-radius: unset;border: solid 1px;border-color: #3C8DBC;">
					<div class="card-header pt-2" style="border-radius: unset;text-align: left;background-color: #3C8DBC;max-height: 3rem; color: white;">FILTRO LOCALES DETALLE</div>
					<div class="card-body pt-2 pb-2" style="background: #E9ECEF;font-size: 14px">
						<div class="row">
							<div class="col-2" style="text-align: center;">
								<a class="badge badge-secondary" style="font-size: 15px; cursor:pointer;color: white;" onclick="mostrarTodosTabla()">Todos</a>
							</div>
							<?php
							if ($datosLocalesDepTarde){
								foreach($datosLocalesDepTarde as $dato) {
									?>

									<div class="col-2 pb-1" style="text-align: center;">
										<a class="badge badge-success" style="font-size: 15px; cursor:pointer;color: white;" onclick="ocultarDetalleTabla(<?php echo "'".$dato["locales"]."'";?>)"><?php echo $dato["locales"];?></a>
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

	<section class="container" id="jbtDetalle">
		<div class="row mt-4 justify-content-center" id="pruebita1"> <!-- Inicia el margen desde el Top-->
			<div class="col-12 pl-0 pr-0" id="pruebita1">
				<div class="card mb-3" style="border-radius: unset;border: solid 1px;border-color: #3C8DBC;">
					<div class="card-header pt-2" style="border-radius: unset;text-align: left;background-color: #3C8DBC;max-height: 3rem; color: white;">DETALLE DEPOSITOS TARDE</div>
					<div class="card-body" style="background: #E9ECEF">
						<div class="table-responsive" style="height:360px;">
							<table class="table table-hover table-bordered" style="background: white;">
								<thead style="font-size: 13px;">
									<tr>
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
											<tr>
												<td scope="col" class="text-center"><?php echo $dato["rownum"];?></td>
												<td class="text-center" style="font-size: 13px;"><?php echo $dato["cod_local"];?></td>
												<td class="text-center" style="font-size: 13px;"><?php echo $dato["fech_cierre"];?></td>
												<td class="text-center" style="font-size: 13px;"><?php echo $dato["fech_oper"];?></td>
												<td class="text-center" style="font-size: 13px;"><?php echo $dato["mon"];?></td>
												<td class="text-center" style="font-size: 13px;"><?php echo $dato["mon_dep"];?></td>
												<td class="text-center" style="font-size: 12px;"><?php echo $dato["time_dif"];?></td>
												<td class="text-center" style="font-size: 13px;"><?php echo $dato["num_oper"];?></td>
												<td class="text-center" style="font-size: 13px;"><?php echo $dato["usu_dep"];?></td>
												<td class="text-center">
													<?php
													$dife_min = $dato["dif_min"];
													if($dife_min<=1440){
														echo '<span class="badge badge-info">Menor 1 día</span>';
													}else if($dife_min<=2880){
														echo '<span class="badge badge-warning">Mayor 1 día</span>';
													}else{
														echo '<span class="badge badge-danger">Mayor 2 días</span>';
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
						<div class="col-md-12 text-center">
							<ul class="pagination pagination-lg pager" id="myPager"></ul>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</section>

	<script src="../bootstrap/js/bootstrap.js"></script>				
</body>
</html>