<?php
session_start();
require 'funcs/conexion.php';
include 'funcs/funcs.php';

	if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}

	$idUsuario = $_SESSION['id_usuario'];
	$errors = array();

	$sql = "select * from TB_TIPO_PERSONA";
	$resultado = $mysqli->query($sql);
//$row = $resultado->fetch_array(MYSQLI_ASSOC);

	if(!empty($_POST)){
		$nombre = $mysqli->real_escape_string($_POST['nombre']);
		$paterno = $mysqli->real_escape_string($_POST['paterno']);
		$materno = $mysqli->real_escape_string($_POST['materno']);
		$usuario = $mysqli->real_escape_string($_POST['usuario']);
		$password = $mysqli->real_escape_string($_POST['password']);
		$con_password = $mysqli->real_escape_string($_POST['con_password']);
		$email = $mysqli->real_escape_string($_POST['email']);
		//$captcha = $mysqli->real_escape_string($_POST['g-recaptcha-response']);
		$tipusu = $mysqli->real_escape_string($_POST['tipo_usu']);
		$dni = $mysqli->real_escape_string($_POST['dni']);

		$activo = 0;//cuando registremos el usuario siempre este desactivado
		$tipo_usuario = 2;//que privilegios tendra el usuario. Usuario Normal.
		/*$secret = '6LfqIloUAAAAAJAbDBmtGifYx5Gn3jaiKZbs_q-l';//Clave secreta del captcha
		
		if(!$captcha){
			$errors[] = "Por favor verifica el captcha";
		}*/

	if(isNull($nombre,$paterno,$materno/*,$usuario,$password,$con_password,$email*/)){
		$errors[] = "Debe llenar todos los campos";
	}
	if(!isEmail($email)){
		$errors[] = "Dirección de correo inválida";
	}

	if(!validaPassword($password,$con_password)){
		$errors[] = "Las contraseñas no coinciden";
	}

	if(usuarioExiste($usuario)){
		$errors[] = "El nombre de usuario $usuario ya existe!";
	}

	if(emailExiste($email)){
		$errors[] = "El correo electronico $email ya existe!";
	}	

	if(dniExiste($dni)){
		$errors[] = "El dni $dni ya existe!";
	}			
/*
	if(count($errors) == 0){
		$arrContextOptions=array(
			"ssl"=>array(
				"verify_peer"=>false,
				"verify_peer_name"=>false,
			),
		);*/
/*
			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha", false, stream_context_create($arrContextOptions));
			$arr = json_decode($response, TRUE);
*/
/*			if($arr['success'])
{*/

	if(count($errors) == 0){
		$pass_hash = hashPassword($password);
		$token = generateToken();

						$regPersona = registraPersona($dni,$tipusu,$nombre,$paterno,$materno);//registra y devuelve el dni

						if($regPersona >0){
							$registro = registraUsuario($usuario,$pass_hash,$email,$activo,$token,$regPersona);

							if($registro >0){
								$url = 'http://'.$_SERVER["SERVER_NAME"].'/politicas/activar.php?id='.$registro.'&val='.$token;
								$asunto = 'Activar Cuenta - Sistema de Usuarios';
								$cuerpo = "Estimado $nombre: <br/><br/>Para continuar con el proceso de registro, es indispensable de click en la siguiente liga <a href='$url'>Activar Cuenta</a>";

								if(enviarEmail($email, $nombre, $asunto, $cuerpo)){
									echo "Para terminar el proceso de registro siga las instrucciones que le hemos enviado a la dirección de correoelectrónico: $email";
									echo "<br><a href='index.php'>Iniciar Sesion</a>";
									exit;
								}
							}else{
								$errors[] = "Error al Registrar Usuario";
							}

						}else{
							$errors[] = "Error al Registrar Persona";
						}
					}
					/*echo '<h2>Thanks</h2>';
					echo 'Bienvenido '.'<b>'.$arr['hostname'].'</b>';*/
				}
				?>
				<html>
				<head>
					<title>Registro</title>

			<!--<link rel="stylesheet" href="css/bootstrap.min.css" >
			<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
			<script src="js/bootstrap.min.js" ></script>
			<script src='https://www.google.com/recaptcha/api.js'></script>-->
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

			<!-- Bootstrap CSS -->
			<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">

			<style>
			body {
				padding-top: 20px;
				padding-bottom: 20px;
			}

			.slider{

				background:#d5f4e6;
				background-size: cover;
				background-position: center;

			}			
		</style>


	</head>

	<body>
		<div class="container">

			<nav class="navbar navbar-expand-sm navbar-expand-md navbar-expand-lg navbar-dark bg-primary sticky-top">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>  

				<a class="navbar-brand" href="#">
					<img src="images/logo.png" width="40" height="30" class="d-inline-block align-top" alt="Logo">
					TaskManager
				</a>

				<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
					<div class="navbar-nav mr-auto ml-auto text-center">
						<a class="nav-item nav-link active" href="welcome.php">Inicio</a>

						<?php if($_SESSION['tipo_usuario']==1) { ?>
							<a class="nav-item nav-link" href="registro.php">Registrar Usuario</a>
						<?php } ?>
					</div>
				</div>  
				<div class="d-flex justify-content-around">
					<a href="logout.php" class="btn btn-danger border-white">Cerrar Sesi&oacute;n</a>
				</div>
			</nav>	


			<div class="jumbotron" style="background-color:#d5f4e6;">
				<div class="row slider align-items-center justify-content-center">
					<div class=" col-xl-5 col-lg-6 col-md-8 col-sm-10 col-12">
						<div class="card border-white">
							<div class="card-header bg-primary text-center">
								<h5 class="card-title font-weight-light text-light">Registrar Usuario</h5>
							</div>

							<div class="card-body">

								<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
								<form id="signupform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">

									<div id="signupalert" style="display:none" class="alert alert-danger">
										<p>Error:</p>
										<span></span>
									</div>

									<div class="form-group">
										<label for="nombre">Nombre:</label>
										<input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php if(isset($nombre)) echo $nombre; ?>" required >

									</div>


									<div class="form-group">
										<label for="paterno">Paterno:</label>
										<input type="text" class="form-control" name="paterno" placeholder="paterno" value="<?php if(isset($paterno)) echo $paterno; ?>" required >
									</div>	

									<div class="form-group">
										<label for="materno">Materno:</label>

										<input type="text" class="form-control" name="materno" placeholder="materno" value="<?php if(isset($materno)) echo $materno; ?>" required >
									</div>			

									<div class="form-group">
										<label for="dni">Dni:</label>
										<input type="text" class="form-control" name="dni" placeholder="dni" value="<?php if(isset($dni)) echo $dni; ?>" required >
									</div>

									<div class="form-group">
										<label for="usuario">Usuario</label>
										<input type="text" class="form-control" name="usuario" placeholder="Usuario" value="<?php if(isset($usuario)) echo $usuario; ?>" >
									</div>

									<div class="form-group">
										<label for="password">Password</label>
										<input type="password" class="form-control" name="password" placeholder="Password" >
									</div>

									<div class="form-group">
										<label for="con_password">Confirmar Password</label>
										<input type="password" class="form-control" name="con_password" placeholder="Confirmar Password" >
									</div>

									<div class="form-group">
										<label for="email">Email</label>
										<input type="email" class="form-control" name="email" placeholder="Email" value="<?php if(isset($email)) echo $email; ?>" >
									</div>

									<div class="form-group">
										<label for="tipo_usu">Tipo Usuario</label>
										<select class="form-control" name="tipo_usu" id="tipo_usu">
											<option value="0">Seleccionar Estado</option>
											<?php while($row = $resultado->fetch_assoc()) { ?>
												<option value="<?php echo $row['cod_tipo_persona']; ?>"><?php echo $row['descripcion']; ?></option>
											<?php } ?>
										</select>
									</div>		

									<div class="form-group">
										<label for="captcha"></label>
										<div class="g-recaptcha col-md-9" data-sitekey="6LfqIloUAAAAANZFa6h8JqLBp1DCc-hfVaREi2IE"></div>
									</div>

									<div class="form-group d-flex justify-content-center">                                   
										<button id="btn-signup" type="submit" class="btn btn-success">Enviar</button>
									</div>
								</form>


								<?php
								echo resultBlock($errors);
								?>
								<div class="d-flex justify-content-end">
									<span class="badge badge-pill badge-warning"><a href="index.php" class="text-white">Regresar Inicio!</a></span>
								</div>	
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="bootstrap/js/bootstrap.js"></script>		
	</body>
	</html>													