<?php

function isNull($nombre,$paterno,$materno/*, $user, $pass, $pass_con, $email*/){
if(strlen(trim($nombre)) < 1 || strlen(trim($paterno)) < 1 || strlen(trim($materno)) < 1 /*|| strlen(trim($user)) < 1 || strlen(trim($pass)) < 1 || strlen(trim($pass_con)) < 1 || strlen(trim($email)) < 1*/)
{
	return true;
} else {
	return false;
}
}

function isEmail($email)
{
	if (filter_var($email, FILTER_VALIDATE_EMAIL)){
		return true;
	} else {
		return false;
	}
}

function validaPassword($var1, $var2)
{
	if (strcmp($var1, $var2) !== 0){
		return false;
	} else {
		return true;
	}
}

function minMax($min, $max, $valor){
	if(strlen(trim($valor)) < $min)
	{
		return true;
	}
	else if(strlen(trim($valor)) > $max)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function personaExiste($dni)
{
	global $mysqli;

	if(!$stmt = $mysqli->prepare("SELECT dni FROM tb_persona WHERE dni = ? LIMIT 1")){
		die("Revisar Consulta PersonaExiste!");
	}

	$stmt->bind_param("s", $dni);

	if(!$stmt->execute()){
		die("Fallo la Ejecucion PersonaExiste!");
	}

	$stmt->store_result();
	$num = $stmt->num_rows;
	$stmt->close();

	if ($num > 0){
		return true;
	} else {
		return false;
	}
}

function usuarioExiste($usuario)
{
	global $mysqli;

	if(!$stmt = $mysqli->prepare("SELECT id FROM usuarios WHERE usuario = ? LIMIT 1")){
		die("Revisar Consulta usuarioExiste!");
	}

	$stmt->bind_param("s", $usuario);

	if(!$stmt->execute()){
		die("Fallo la Ejecucion usuarioExiste!");
	}

	$stmt->store_result();
	$num = $stmt->num_rows;
	$stmt->close();

	if ($num > 0){
		return true;
	} else {
		return false;
	}
}

function emailExiste($email)
{
	global $mysqli;

	if(!$stmt = $mysqli->prepare("SELECT id FROM usuarios WHERE correo = ? LIMIT 1")){
		die("Revisar Consulta emailExiste!");
	}

	$stmt->bind_param("s", $email);

	if(!$stmt->execute()){
		die("Fallo la Ejecucion emailExiste!");		
	}

	$stmt->store_result();
	$num = $stmt->num_rows;
	$stmt->close();

	if ($num > 0){
		return true;
	} else {
		return false;
	}
}

function dniExiste($dni)
{
	global $mysqli;

	if(!$stmt = $mysqli->prepare("SELECT dni FROM tb_persona WHERE dni = ? LIMIT 1")){
		die("Revisar Consulta dniExiste!");
	}

	$stmt->bind_param("s", $dni);

	if(!$stmt->execute()){
		die("Fallo la Ejecucion dniExiste!");		
	}

	$stmt->store_result();
	$num = $stmt->num_rows;
	$stmt->close();

	if ($num > 0){
		return true;
	} else {
		return false;
	}
}	

function generateToken()
{
	$gen = md5(uniqid(mt_rand(), false));
	return $gen;
}

function hashPassword($password)
{
	$hash = password_hash($password, PASSWORD_DEFAULT);
	return $hash;
}

function resultBlock($errors){
	if(count($errors) > 0)
	{
		echo "<div id='error' class='alert alert-danger' role='alert'>
		<a href='#' onclick=\"showHide('error');\">Revisar los siguientes campos:</a>
		<ul>";
		foreach($errors as $error)
		{
			echo "<li>".$error."</li>";
		}
		echo "</ul>";
		echo "</div>";
	}
}

function registraPersona($dni,$cod_tipo_persona,$nombre,$paterno,$materno){
	global $mysqli;

	$nom = strtoupper($nombre);
	$pat = strtoupper($paterno);
	$mat = strtoupper($materno);

	if(personaExiste($dni)){
		if(!$stmt= $mysqli->prepare("UPDATE tb_persona
			SET cod_tipo_persona=?, nombre=?,paterno=?,materno=?,cod_estado=1,fecha_reg=SYSDATE()
			WHERE dni = ?")){
			die("Revisar Consulta registraPersona!");
		}
		$stmt->bind_param('issss', $cod_tipo_persona,$nom,$pat,$mat,$dni);
	}else{
		if(!$stmt = $mysqli->prepare("INSERT INTO tb_persona (dni,cod_tipo_persona,nombre,paterno,materno,cod_estado,fecha_reg) VALUES(?,?,?,?,?,1,SYSDATE())")){
			die("Fallo la Ejecucion registraPersona!");
		}
		$stmt->bind_param('sisss', $dni,$cod_tipo_persona,$nom,$pat,$mat);
	}

	if ($stmt->execute()){
			return $dni;//$mysqli->insert_id;
		} else {
			return 0;
		}
	}
	
	function registraUsuario($usuario, $pass_hash, $email, $activo, $token, $dni){
		
		global $mysqli;

		if(!$stmt = $mysqli->prepare("INSERT INTO usuarios (usuario, password, correo, activacion, token, dni) VALUES(?,?,?,?,?,?)")){
			die("Revisar Consulta registraUsuario!");
		}
		$stmt->bind_param('sssiss', $usuario, $pass_hash, $email, $activo, $token, $dni);
		
		if ($stmt->execute()){
			return $mysqli->insert_id;
		} else {
			return 0;
		}
	}
	
	function enviarEmail($email, $nombre, $asunto, $cuerpo){
		
		require_once 'PHPMailer/PHPMailerAutoload.php';
		
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls'; //Modificar
		$mail->Host = 'smtp.gmail.com'; //Modificar
		$mail->Port = 587; //Modificar
		
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);
		
		$mail->Username = 'slither366@gmail.com';//Modificar
		$mail->Password = 'Mifarma2019'; //Modificar
		
		$mail->setFrom('slither366@gmail.com', 'Emisor'); //Modificar
		$mail->addAddress($email, $nombre);
		
		$mail->Subject = $asunto;
		$mail->Body    = $cuerpo;
		$mail->IsHTML(true);
		
		if($mail->send())
			return true;
		else
			return false;
	}
	
	function validaIdToken($id, $token){
		global $mysqli;
		
		if(!$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE id = ? AND token = ? LIMIT 1")){
			die("Revisar Consulta validaIdToken!");
		}

		$stmt->bind_param("is", $id, $token);

		if(!$stmt->execute()){
			die("Fallo la Ejecucion validaIdToken!");
		}

		$stmt->store_result();
		$rows = $stmt->num_rows;
		
		if($rows > 0) {
			$stmt->bind_result($activacion);
			$stmt->fetch();
			
			if($activacion == 1){
				$msg = "La cuenta ya se activo anteriormente.";
			} else {
				if(activarUsuario($id)){
					$msg = 'Cuenta activada.';
				} else {
					$msg = 'Error al Activar Cuenta';
				}
			}
		} else {
			$msg = 'No existe el registro para activar.';
		}
		return $msg;
	}
	
	function activarUsuario($id)
	{
		global $mysqli;
		
		if(!$stmt = $mysqli->prepare("UPDATE usuarios SET activacion=1 WHERE id = ?")){
			die("Revisar Consulta activarUsuario!");
		}

		$stmt->bind_param('s', $id);
		$result = $stmt->execute();
		$stmt->close();
		return $result;
	}
	
	function isNullLogin($usuario, $password){
		if(strlen(trim($usuario)) < 1 || strlen(trim($password)) < 1)
		{
			return true;
		}
		else
		{
			return false;
		}		
	}
	
	function login($usuario, $password)
	{
		global $mysqli;

		if(!$stmt = $mysqli->prepare("SELECT u.id, t.cod_tipo_persona, u.password, u.dni, CONCAT(t.nombre,' ',t.paterno) datos FROM usuarios u,tb_persona t WHERE u.dni = t.dni AND usuario = ? || correo = ? LIMIT 1")){
			die("Revisar Consulta login!");
		}

		$stmt->bind_param("ss", $usuario, $usuario);

		if(!$stmt->execute()){
			die("Fallo la Ejecucion login!");
		}

		$stmt->store_result();
		$rows = $stmt->num_rows;

		if($rows > 0) {
			
			if(isActivo($usuario)){
				
				$stmt->bind_result($id, $id_tipo, $passwd, $dni, $datos);
				$stmt->fetch();
				
				$validaPassw = password_verify($password, $passwd);
				
				if($validaPassw){
					
					lastSession($id);
					$_SESSION['id_usuario'] = $id;
					$_SESSION['tipo_usuario'] = $id_tipo;
					$_SESSION['dni'] = $dni;
					$_SESSION['datos'] = $datos;
					
					header("location: welcome.php");
				} else {
					
					$errors = "La contrase&ntilde;a es incorrecta";
				}
			} else {
				$errors = 'El usuario no esta activo';
			}
		} else {
			$errors = "El nombre de usuario o correo electr&oacute;nico no existe";
		}
		return $errors;
	}
	
	function lastSession($id)
	{
		global $mysqli;
		
		if(!$stmt = $mysqli->prepare("UPDATE usuarios SET last_session=NOW(), token_password='', password_request=1 WHERE id = ?")){
			die("Revisar Consulta lastSession!");
		}

		$stmt->bind_param('s', $id);

		if(!$stmt->execute()){
			die("Fallo la Ejecucion lastSession!");
		}

		$stmt->close();
	}
	
	function isActivo($usuario)
	{
		global $mysqli;
		
		if(!$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE usuario = ? || correo = ? LIMIT 1")){
			die("Revisar Consulta isActivo!");
		}else{
			$stmt->bind_param('ss', $usuario, $usuario);
		}

		if(!$stmt->execute()){
			die("Fallo la Ejecucion lastSession!");
		}

		$stmt->bind_result($activacion);
		$stmt->fetch();
		
		if ($activacion == 1)
		{
			return true;
		}
		else
		{
			return false;	
		}
	}	
	
	function generaTokenPass($user_id)
	{
		global $mysqli;
		
		$token = generateToken();
		
		if(!$stmt = $mysqli->prepare("UPDATE usuarios SET token_password=?, password_request=1 WHERE id = ?")){
			die("Revisar Consulta generaTokenPass!");
		}

		$stmt->bind_param('ss', $token, $user_id);

		if(!$stmt->execute()){
			die("Fallo la Ejecucion generaTokenPass!");
		}

		$stmt->close();
		
		return $token;
	}
	
	function getValor($campo, $campoWhere, $valor)
	{
		global $mysqli;

		if(!$stmt = $mysqli->prepare("SELECT $campo FROM usuarios u,tb_persona t WHERE u.dni = t.dni AND $campoWhere = ? LIMIT 1")){
			die("Revisar Consulta getValor!");
		}

		$stmt->bind_param('s', $valor);

		if(!$stmt->execute()){
			die("Fallo la Ejecucion getValor!");
		}

		$stmt->store_result();
		$num = $stmt->num_rows;
		
		if ($num > 0)
		{
			$stmt->bind_result($_campo);
			$stmt->fetch();
			return $_campo;
		}
		else
		{
			return null;	
		}
	}
	
	function getPasswordRequest($id)
	{
		global $mysqli;
		
		if(!$stmt = $mysqli->prepare("SELECT password_request FROM usuarios WHERE id = ?")){
			die("Revisar Consulta getPasswordRequest!");
		}

		$stmt->bind_param('i', $id);

		if(!$stmt->execute()){
			die("Fallo la Ejecucion getValor!");
		}

		$stmt->bind_result($_id);
		$stmt->fetch();
		
		if ($_id == 1)
		{
			return true;
		}
		else
		{
			return null;	
		}
	}
	
	function verificaTokenPass($user_id, $token){
		
		global $mysqli;
		
		if(!$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE id = ? AND token_password = ? AND password_request = 1 LIMIT 1")){
			die("Revisar Consulta verificaTokenPass!");
		}

		$stmt->bind_param('is', $user_id, $token);

		if(!$stmt->execute()){
			die("Fallo la Ejecucion verificaTokenPass!");
		}

		$stmt->store_result();
		$num = $stmt->num_rows;
		
		if ($num > 0)
		{
			$stmt->bind_result($activacion);
			$stmt->fetch();
			if($activacion == 1)
			{
				return true;
			}
			else 
			{
				return false;
			}
		}
		else
		{
			return false;	
		}
	}
	
	function cambiaPassword($password, $user_id, $token){
		global $mysqli;

		if(!$stmt = $mysqli->prepare("UPDATE usuarios SET password = ?, token_password='', password_request=0 WHERE id = ? AND token_password = ?")){
			die("Revisar Consulta cambiaPassword!");
		}

		$stmt->bind_param('sis', $password, $user_id, $token);
		
		if($stmt->execute()){
			return true;
		} else {
			return false;		
		}
	}
	
	/*$campoFrom,$campoWhere, $valor*/
	/*"SELECT * FROM $campoFrom WHERE $campoWhere = ? LIMIT 1"*/
	function getGrupoDatos(){
		global $mysqli;

		if(!$stmt = $mysqli->prepare("SELECT * FROM $campoFrom WHERE $campoWhere = ? LIMIT 1")){
			die("Revisar Consulta getGrupoDatos!");
		}

		$stmt->bind_param('s', $valor);

		if(!$stmt->execute()){
			die("Fallo la Ejecucion getGrupoDatos!");
		}

		$stmt->store_result();
		$num = $stmt->num_rows;
		
		if ($num > 0)
		{
			$stmt->bind_result($_campo);
			$stmt->fetch();
			return $_campo;
		}
		else
		{
			return null;	
		}
	}

	function getGuiasTransPend($codPoli,$jzona)
	{
		global $mysqli;
		//$stmt = $mysqli->prepare("SELECT * FROM $campoFrom WHERE $campoWhere = ? LIMIT 1");
		if(!$stmt = $mysqli->prepare(
			"SELECT count(te.cod_estado_doc) CANT_GUIAS 
			FROM tb_estado_documentos te, tb_semaforo ts, tb_estado_semaforo tes,
			tb_politicas tp,tb_cab_documentos tc
			WHERE te.cod_semaforo = ts.cod_semaforo
			AND ts.cod_est_semaforo = tes.cod_est_semaforo
			AND tp.cod_politicas = te.cod_politicas
			AND te.cod_doc = tc.cod_doc
			AND tp.cod_politicas = ?
			AND tc.jzona_dest = ?
			AND tes.descripcion = 'PENDIENTE'")){
			die("Revisar Consulta getGuiasTransPend!");
		}

		$stmt->bind_param('is', $codPoli, $jzona);

		if(!$stmt->execute()){
			die("Fallo la Ejecucion getGuiasTransPend!");
		}

		$stmt->store_result();
		$num = $stmt->num_rows;

		if ($num > 0)
		{
			$stmt->bind_result($_campo);
			$stmt->fetch();
			return $_campo;
		}
		else
		{
			return null;	
		}
	}
	
