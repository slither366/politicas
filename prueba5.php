<?php
session_start();
require '/funcs/conexion.php';
include '/funcs/funcs.php';

	if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}

	$idUsuario = $_SESSION['id_usuario'];
	$dniDest = $_SESSION['dni'];

	date_default_timezone_set('America/Los_Angeles');

	$ObjetoFecha = new DateTime("2018-07-31");

	$dia_mes = $ObjetoFecha->format('j');

	$fecha = $ObjetoFecha->format('c');
	$numeroDias = $ObjetoFecha->format('t');
	$numeroMes = $ObjetoFecha->format('m');
	$ano = $ObjetoFecha->format('Y');
	$dia_ini_mes = $ano.'-'.$numeroMes.'-'.'01';
	$dia_fin_mes = $ano.'-'.$numeroMes.'-'.$numeroDias;

	$ObjFechaIniMes = new DateTime($dia_ini_mes);
	$num_sem_ini_mes = $ObjFechaIniMes->format('W');
	$ObjFechaFinMes = new DateTime($dia_fin_mes);
	$num_sem_fin_mes = $ObjFechaFinMes->format('W');

	$num_dia_sem = $ObjFechaIniMes->format('w');
	$num_dia_sem = $num_dia_sem == 0 ? 7 : $num_dia_sem;
	$num_sem_en_ano = $ObjetoFecha->format('W');
	$num_sem_x_mes   = $num_sem_fin_mes-$num_sem_ini_mes+1;


	echo 'FECHA: '.$fecha.'</br>';
	echo '# de Dia: '.$numeroDias.'</br>';
	echo '# de Mes: '.$numeroMes.'</br>';
	echo '# fecha: '.$dia_ini_mes.'</br>';
	echo '# dia de Semana: '.$num_dia_sem.'</br>';
	echo '# semana en el Año: '.$num_sem_en_ano.'</br>';
	echo '# semana Inicio de Mes: '.$num_sem_ini_mes.'</br>';
	echo '# semana Fin de Mes: '.$num_sem_fin_mes.'</br>';
	echo '# semanas en mes: '.$num_sem_x_mes.'</br>';

	//Sacamos la semana del día uno usando el objeto creado en el punto 1.
	//Si es Enero directamente lo inicializamos a cero
	$semanaPrimerDia = $ObjetoFecha->format('n') == 1 ? 0 : $ObjetoFecha->format('W');
	//Nos da la semana del año en la que estamos
	//El parámetro n nos indica el mes en el que 
	//estamos sin ceros iniciales: Enero = 1.

	//Movemos la fecha hacia delante el numero de días
	//que tiene el mes menos uno.
	$intervalo = $numeroDias -1;
	$ObjetoFecha->modify("+" . $intervalo . " days");

	//Y sacamos la semana en la que estamos

	//sumamos 1 porque la primera semana tambien hay que contarla
	echo '# Count dias: '.$numeroDias.'</br>';
	echo 'numero_mes: '.$numeroMes.'</br>';
	echo 'dia_semana: '.$num_dia_sem.'</br>';
	echo 'primer dia semana: '.$semanaPrimerDia.'</br>';

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
			background-color: #F3F3F3;
		}

		#pruebita1{
			border: solid 1px;
			border-color: black;
		}		

	</style>

	<script type="text/javascript">
		$(document).ready(function(){
		    $("tr:odd").css("background-color", "#ddd"); // filas impares
		    $("tr:even").css("background-color", "#ccc"); // filas pares
		});		
	</script>

</head>

<body id="bodyTransfer">
	<table style="background: white;">
		<thead>
			<th>Lunes</th>
			<th>Martes</th>
			<th>Miercoles</th>
			<th>Jueves</th>
			<th>Viernes</th>
			<th>Sábado</th>
			<th>Domingo</th>
		</thead>

		<tbody>
			<?php
			$contenidoDias = array(
				"16" => array(0=>150, 1=>110),
				"21" => array(0=>375, 1=>280)
			);

			for($i=1;$i<=$num_sem_x_mes;$i++){ ?>
				<tr><!--Iniciamos las filas de la tabla.	-->
					<?php 
			for($d=1;$d<=7;$d++){//Recorremos los días de la semana
				if($i == 1){// Si es igual al 1er día del mes iniciamos el contador de días
					if($d >= $num_dia_sem){
						$dia = isset($dia) ? $dia+1 : 1;
					}
				}
				elseif(isset($dia) && $dia<$numeroDias){$dia++;//Dia siguiente 
				}else{unset($dia);}// Eliminamos la variable

				if(isset($dia)){//Pintamos los días del mes.
					?>
					<td class="dianormal pt-0 pb-0" width="100" height="90px">
						<table width="100%" height="100%">
							<tbody>
								<tr>
									<td class="diacal pt-0 pb-0" height="25%" style="font-size: 12px;"><?php echo $dia; ?></td>
								</tr>
								<tr>
									<td class="pretachcal pt-0 pb-0" height="25%" style="font-size: 12px;">
										<?php 
										if($dia == 9){
											echo "0021684368";
										}else if($dia == 10){
											echo "0021684368";
										}
										?>
									</td>
								</tr>
								<tr>
									<td class="precio pt-0 pb-0" height="25%" style="font-size: 12px;">
										<?php 
										if($dia == 9){
											echo "S/.11441.25";
										}else if($dia == 10){
											echo "S/. 10488.6";
										}
										?>
									</td>
								</tr>
								<tr>
									<td class="precio pt-0 pb-0" height="25%" style="font-size: 12px;">
										<?php 
										if($dia == 9){
											echo "13/07/2018";
										}else if($dia == 10){
											echo "13/07/2018";
										}
										?>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
					<?php
				}else{
				//Pintamos celdas vacias
					?>
					<td class="dianomes">&nbsp;</td>
					<?php
				}
			}
			?></tr>
			<?php
		}
		?>
	</tbody>
</table>
</body>
</html>