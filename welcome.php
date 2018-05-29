<?php
	session_start();
	require 'funcs/conexion.php';
	include 'funcs/funcs.php';
	
	if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}
	
	$idUsuario = $_SESSION['id_usuario'];
	
	$sql = "SELECT id, nombre FROM usuarios WHERE id = '$idUsuario'";
	$result = $mysqli->query($sql);
	
	$row = $result->fetch_assoc();	
?>
<html>
	<head>
		<title>Welcome</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<script src="js/bootstrap.min.js" ></script>
		
		<style>
			body {
			padding-top: 20px;
			padding-bottom: 20px;
			}
		</style>
	</head>
	
	<body>
		<div class="container">			
			<nav class='navbar navbar-default'>
				<div class='container-fluid'>
					<div class='navbar-header'>
						<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>
							<span class='sr-only'>Men&uacute;</span>
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>
						</button>
					</div>
					
					<div id='navbar' class='navbar-collapse collapse'>
						<ul class='nav navbar-nav'>
							<li class='active'><a href='welcome.php'>Inicio</a></li>			
						</ul>
						
						<?php if($_SESSION['tipo_usuario']==1) { ?>
							<ul class='nav navbar-nav'>
								<li><a href='#'>Administrar Usuarios</a></li>
							</ul>
						<?php } ?>
						
						<ul class='nav navbar-nav navbar-right'>
							<li><a href='logout.php'>Cerrar Sesi&oacute;n</a></li>
						</ul>
					</div>
				</div>
			</nav>	
			
			<div class="jumbotron" style="background-color:#d5f4e6;">
				<div class="pl-1">
					<h1><?php echo 'Bienvenid@:</br><small>'.utf8_decode($row['nombre']); '</small>'?></h1>
				</div>
				<br />
				<ul class="list-group">
					<a href="transferencias/transfer_pendientes.php" class="list-group-item">Transferencias Pendientes de Recepcion <span class="label label-danger" align="center">110</span></a>
					<a href="#" class="list-group-item">Deposito Bancario Pendiente <span class="label label-success">0</span></a>
				<a href="#" class="list-group-item">Remesas Fuera de Rango <span class="label label-success">0</span></a>
				<a href="#" class="list-group-item">Cierre de dia Pendiente <span class="label label-success">0</span></a>
				<a href="#" class="list-group-item">Acumulacion de Deficit Excesivo <span class="label label-success">0</span></a>
				<a href="#" class="list-group-item">Cuadratura de Anulacion Pendiente <span class="label label-success">0</span></a>					
				<a href="#" class="list-group-item">ASL's Pendientes <span class="label label-success">0</span></a>
				<a href="#" class="list-group-item">Cierre de día Pendiente <span class="label label-success">0</span></a>
				<a href="#" class="list-group-item">Acumulacion de Deficit Excesivo <span class="label label-success">0</span></a>					
				</ul> 				
			</div>
		</div>
	</body>
</html>		