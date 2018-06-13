<?php
require '../funcs/conexion.php';
include '../funcs/funcs.php';
//$resultado = $_POST['origen'] + $_POST['destino'] + $_POST['jefeDestino'];

$ori = $_POST['origen'];
$dest = $_POST['destino'];
$dniDest = $_POST['jefeDestino'];
$oriDesc = mb_convert_case($_POST['oriDesc'], MB_CASE_TITLE, "UTF-8");
$destDesc = mb_convert_case($_POST['destDesc'], MB_CASE_TITLE, "UTF-8");
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
		</head>

		<body>

			<?php
			$datos = getGuiasTransProDet($ori,$dest,$dniDest);
			?>

			<div class="pl-4 mt-4 pt-0 ml-5">
				<h1 class="text-left Titulo"><small>Detalle de:</br><?php echo $ori.'-'.$oriDesc.' A '.$dest.'-'.$destDesc ?></small></h1>
			</div>				
			<br />

			<div class="container">
				<div class="table-responsive">          
					<table class="table table-hover TextTable table-sm">
						<thead class="thead-dark">
							<tr>
								<th scope="col" class="text-center">#</th>
								<th scope="col" class="text-center">Cod. Documento</th>
								<th scope="col" class="text-center">Cant. Prod.</th>
								<th scope="col" class="text-center">Fecha Creación</th>
							</tr>
						</thead>

						<tbody class="tablaBody">
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


			<script src="../bootstrap/js/bootstrap.js"></script>				
		</body>
		</html>