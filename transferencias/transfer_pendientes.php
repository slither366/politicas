<?php
	session_start();
	require '../funcs/conexion.php';
	include '../funcs/funcs.php';
	
	if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}
	
	$idUsuario = $_SESSION['id_usuario'];
	
?>
<html>
	<head>
		<title>Transferencias Pendientes</title>
		
		<link rel="stylesheet" href="../css/bootstrap.min.css" >
		<link rel="stylesheet" href="../css/bootstrap-theme.min.css" >
		<script src="../js/bootstrap.min.js" ></script>

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
							<li class='active'><a href='..\welcome.php'>Inicio</a></li>			
						</ul>
						
						<?php if($_SESSION['tipo_usuario']==1) { ?>
							<ul class='nav navbar-nav'>
								<li><a href='#'>Administrar Usuarios</a></li>
							</ul>
						<?php } ?>
						
						<ul class='nav navbar-nav navbar-right'>
							<li><a href='..\logout.php'>Cerrar Sesi&oacute;n</a></li>
						</ul>
					</div>
				</div>
			</nav>	
			
			<div class="jumbotron" style="background-color:#d5f4e6;">
				<div class="pl-4">
					<h1>Guias Transferencias <small>Pendientes</small></h1>
				</div>
				<br />
				<div class="container">
					<div class="table-responsive">          
						<table class="table table-hover" >
							<thead class="thead-dark">
								<tr>
									<th scope="col">#</th>
									<th scope="col">Origen</th>
									<th scope="col">Destino</th>
									<th scope="col">N°Guias</th>
									<th scope="col">Cant.Mat</th>
									<th scope="col">Fecha Menor</th>
									<th scope="col">Semaforo</th>
								</tr>
							</thead>
							<tfoot>							
								<tr>
									<th></th>
									<th></th>
									<th align="left">Totales:</th>
									<th align="center">184</th>
									<th>1432</th>
									<th></th>
									<th></th>
								</tr>		
							</tfoot>							
							<tbody>
								<tr>
									<th scope="row">1</th>
									<td>C58-PUNO LIMA 3</td>
									<td>C54-JULIACA SAN ROMAN 2</td>
									<td>30</td>
									<td>256</td>
									<td>14/05/2018</td>
									<td><span class="label label-danger">Pendiente</span></td>
								</tr>
								<tr>
									<th scope="row">2</th>
									<td>C58-PUNO LIMA 3</td>
									<td>C55-JULIACA SAN ROMAN 3</td>
									<td>75</td>
									<td>601</td>
									<td>14/05/2018</td>
									<td><span class="label label-warning">Pendiente</span></td>
								</tr>
								<tr>
									<th scope="row">3</th>
									<td>C58-PUNO LIMA 3</td>
									<td>D61-JULIACA HUANCANE</td>
									<td>32</td>
									<td>228</td>
									<td>14/05/2018</td>
									<td><span class="label label-danger">Pendiente</span></td>
								</tr>
								<tr>
									<th scope="row">4</th>
									<td>C58-PUNO LIMA 3</td>
									<td>T91-PUNO LOS INCAS</td>
									<td>47</td>
									<td>347</td>
									<td>14/05/2018</td>
									<td><span class="label label-warning">Pendiente</span></td>
								</tr>		
								
							</tbody>			
						</table>
					</div>
				</div>
				
				
			</div>
			
			<div class="jumbotron" style="background-color:#d5f4e6;">
				<div class="pl-4">
					<h1>Detalle de:</br><small>C58-PUNO LIMA 3 	A C54-JULIACA SAN ROMAN 2</small></h1>
				</div>				
				<br />
				<div class="container">
					<div class="table-responsive">          
						<table class="table table-hover" >
							<thead class="thead-dark">
								<tr>
									<th scope="col">#</th>
									<th scope="col">Cod. Documento</th>
									<th scope="col">Cant. Productos</th>
									<th scope="col">Fecha Creación</th>
								</tr>
							</thead>						
							<tbody>
								<tr>
									<th scope="row">1</th>
									<td>3330009989</td>
									<td>16</td>
									<td>13/05/2018</td>
								</tr>
								<tr>
									<th scope="row">2</th>
									<td>3330009990</td>
									<td>8</td>
									<td>14/05/2018</td>
								</tr>
								<tr>
									<th scope="row">3</th>
									<td>3330009991</td>
									<td>32</td>
									<td>15/05/2018</td>
								</tr>
								<tr>
									<th scope="row">4</th>
									<td>3330009992</td>
									<td>8</td>
									<td>14/05/2018</td>
								</tr>		
								
							</tbody>			
						</table>
					</div>
				</div>
				
				
			</div>			
		</div>
	
	</body>
</html>