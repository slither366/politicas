<?php 
$resultado = $_POST['valorCaja1'] + $_POST['valorCaja2']; 
echo $resultado.'<br/>';
?>
<html>
<head>
	<title>Detalle Transferencias</title>
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

						</tbody>			
					</table>
				</div>
			</div>


		</div>			
	</div>

	<script src="../bootstrap/js/bootstrap.js"></script>				
</body>
</html>