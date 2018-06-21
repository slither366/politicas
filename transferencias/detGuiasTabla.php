<?php
require '../funcs/conexion.php';
include '../funcs/funcs.php';
//$resultado = $_POST['origen'] + $_POST['destino'] + $_POST['jefeDestino'];

$ori = $_POST['origen'];
$dest = $_POST['destino'];
$dniDest = $_POST['jefeDestino'];
$oriDesc = mb_convert_case($_POST['oriDesc'], MB_CASE_TITLE, "UTF-8");//Transformo el texto a Mayusculas
$destDesc = mb_convert_case($_POST['destDesc'], MB_CASE_TITLE, "UTF-8");//Transformo el texto a Mayusculas
?>

<html>
<head>
	<title>Transferencias Pendientes</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<style>
	body {
		padding-top: 0px;
		padding-bottom: 0px;
		background: #E9ECEF;
	}

	#bodyDetalle{
		background: #E9ECEF;
	}

	#cont1{
		padding-top: 20px;
		padding-bottom: 20px;
		border: 0px;
		border-color: black;
	}

	#cont2{
		padding-top: 0px;
		padding-bottom: 0px;
		border: 0px;
	}

	#col1{
		border: solid 0px;
		border-color: black;
	}

	#col2{
		border: solid 0px;
		border-color: black;
	}

</style>

<script type="text/javascript">
	
	$(window).ready(function(){
		$("#btnDescargar").click(function(event) {
			$("#datos_a_enviar").val( 
				$("<div>").append($("#titLocal").eq(0).clone()).html() + 
				$("<div>").append($("#tablaDetalle").eq(0).clone()).html()
				);
			$("#FormularioExportacion").submit();
		});
	});

</script>
<!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
</head>

<body>
	<?php
	$datos = getGuiasTransProDet($ori,$dest,$dniDest);
	?>

	<div class="pl-4 mt-4 pt-0 ml-5">
		<h1 class="text-left Titulo" id="titLocal"><small>Detalle de:</br><strong><?php echo $ori.'-'.$oriDesc.' AL <br/>'.$dest.'-'.$destDesc ?></strong></small></h1>
	</div>				

	<div class="container" id="cont1">
		<div class="row">

			<div class="div col-xl-2 col-lg-3 col-md-2" id="col1"></div>

			<div class="div col-xl-8 col-lg-6 col-md-8 col-12" id="col1">

				<div class="table-responsive">      
					<table class="table table-hover TextTable table-sm" id="tablaDetalle">
						<thead class="thead-dark">
							<tr>
								<th scope="col" class="text-center">#</th>
								<th scope="col" class="text-center">Cod. Documento</th>
								<th scope="col" class="text-center">Cant. Prod.</th>
								<th scope="col" class="text-center">Fecha Creación</th>
							</tr>
						</thead>

						<tbody>
							<?php
							if ($datos){
								foreach($datos as $dato) {
									?>
									<tr>
										<th scope="row" class="text-center"><?php echo $dato["num"];?></th>
										<td class="text-center"><?php echo $dato["doc"];?></td>
										<td class="text-center"><?php echo $dato["tot"];?></td>
										<td class="text-center"><?php echo $dato["fech"];?></td>
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

			<div class="div col-xl-2 col-lg-3 col-md-2" id="col1"></div>

		</div>
	</div>


	<!--<img src="export_to_excel.gif" class="botonExcel" />-->
	<div class="container" id="cont2">
		<div class="row justify-content-center">

			<div class="div col-xl-3 col-lg-3 col-md-4 col-sm-5 col-7 align-self-center" id="col2">

				<form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">

					<button type="button" class="btn btn-info btn-lg btn-block" id="btnDescargar" style="text-center">Descargar</button>		
					<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />

				</form>
			</div>


		</div>
	</div>

	<script src="../bootstrap/js/bootstrap.js"></script>				
</body>
</html>