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
		if(!$stmt= $mysqli->prepare("
			UPDATE tb_persona
			SET cod_tipo_persona=?, nombre=?,paterno=?,materno=?,cod_estado=1,fecha_reg=SYSDATE()
			WHERE dni = ?")){
			die("Revisar Consulta registraPersona!");
		}
		$stmt->bind_param('issss', $cod_tipo_persona,$nom,$pat,$mat,$dni);
	}else{
		if(!$stmt = $mysqli->prepare("INSERT INTO tb_persona (dni,cod_tipo_persona,nombre,paterno,materno,cod_estado,fecha_reg) 
			VALUES(?,?,?,?,?,1,SYSDATE())")){
			die("Fallo la Ejecucion registraPersona!");
		}
		$stmt->bind_param('sisss', $dni,$cod_tipo_persona,$nom,$pat,$mat);
	}

	if ($stmt->execute()){
		return $dni;//$mysqli->insert_id;
	}else{
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

	//Enviar correo solo a 1 persona
function enviarEmail($email, $nombre, $asunto, $cuerpo){

	require_once 'PHPMailer/PHPMailerAutoload.php';

	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'tls'; //Modificar
	$mail->Host = gethostbyname('smtp.gmail.com');; //Modificar
	$mail->Port = 587; //Modificar
	
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);

	$mail->Username = 'dfloreslearner@gmail.com';//Correo del Servidor
	$mail->Password = 'FLLUD001'; //Clave Correo Servidor
	
	$mail->setFrom('dfloreslearner@gmail.com','Dr. David Flores');//Nombre del Usuario que Envía
	$mail->addAddress($email, $nombre);//Correo y Usuario al que se envía
	
	$mail->Subject = $asunto;//asunto del correo
	$mail->Body    = $cuerpo;//contenido del correo
	$mail->IsHTML(true);

	if($mail->send()){
		return true;
	}else{
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;			
		return false;
	}
}

	//Enviar correo a varios Locales
function enviarVariosEmail($arrayLocales, $asunto, $cuerpo){

	require_once 'PHPMailer/PHPMailerAutoload.php';

	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'tls'; //Modificar
	$mail->Host = gethostbyname('smtp.gmail.com');; //Modificar
	$mail->Port = 587; //Modificar
	
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);

	//#### Revisar Siempre Bien estos 2 datos que si no son los correctos nunca enviará correo
	//#### También validar "Permitir el acceso de aplicaciones menos seguras" como en GMAIL
	$mail->Username = 'dfloreslearner@gmail.com';//Correo del Servidor
	$mail->Password = 'FLLUD001'; //Clave Correo Servidor 
	
	$mail->setFrom('dfloreslearner@gmail.com','Dr. David Flores');//Nombre del Usuario que Envía

	foreach ($arrayLocales as $email) {/*list($email, $nombre*/
		$mail->addAddress($email, '');//Correo y Usuario al que se envía
	}

	$mail->Subject = $asunto;//asunto del correo
	$mail->Body    = $cuerpo;//contenido del correo
	$mail->IsHTML(true);
	
	if($mail->send()){
		return true;
	}else{
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;			
		return false;
	}
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

function getCantGuiasTransPend($codPoli,$jzona)
{
	global $mysqli;
	$estado = 0;

	if($codPoli==1){
		if(!$stmt = $mysqli->prepare(
			"SELECT count(DISTINCT tc.loc_dest) CANT_LOCALES
			FROM tb_estado_documentos te, tb_semaforo ts, tb_estado_semaforo tes,
			tb_politicas tp,tb_cab_documentos tc
			WHERE te.cod_semaforo = ts.cod_semaforo
			AND ts.cod_est_semaforo = tes.cod_est_semaforo
			AND tp.cod_politicas = te.cod_politicas
			AND te.cod_doc = tc.cod_doc
			AND tp.cod_politicas = ?
			AND tc.jzona_dest = ?
			AND tes.cod_est_semaforo = $estado")){
			die("Revisar Consulta getGuiasTransPend!");
		}
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

function getGuiasTransPreDet($codPoli,$jzona)
{
	global $mysqli;
	$estado = 0;

	if($codPoli==1){
		if(!$stmt = $mysqli->prepare(
			"SELECT tc.loc_ori,tc.loc_dest,DATE_FORMAT(MIN(fec_crea_origen),'%d/%b/%Y')fecha,
			count(tc.num_doc_ori) tot_guias,tlOri.descripcion desOri,tlDest.descripcion desDest,
			tlDest.correo correoDest
			FROM tb_estado_documentos te, tb_semaforo ts, tb_estado_semaforo tes,
			tb_politicas tp,tb_cab_documentos tc,tb_locales tlOri,tb_locales tlDest
			WHERE te.cod_semaforo = ts.cod_semaforo
			AND ts.cod_est_semaforo = tes.cod_est_semaforo
			AND tp.cod_politicas = te.cod_politicas
			AND te.cod_doc = tc.cod_doc
			AND tlOri.cod_local = tc.loc_ori
			AND tlDest.cod_local = tc.loc_dest
			AND tp.cod_politicas = ?
			AND tc.jzona_dest = ?
			AND tes.descripcion = 'PENDIENTE' 
			GROUP BY tc.loc_ori,tc.loc_dest;")){
			die("Revisar Consulta getGuiasTransPend!");
		}
	}

	$stmt->bind_param('is', $codPoli, $jzona);
	if(!$stmt->execute()){
		die("Fallo la Ejecucion getGuiasTransPend!");
	}

	$stmt->store_result();
	$num = $stmt->num_rows;

	if ($num > 0)
	{
		$stmt->bind_result($a,$b,$c,$d,$e,$f,$g);
		while ($stmt->fetch()) {
			$outArr[] = ['ori' => $a, 'dest' => $b, 'fech' => $c, 'tot' => $d, 'oriDesc' => $e, 'destDesc' => $f, 'destCorreo' => $g];
		}

		$stmt->close();
		return $outArr;			
	}
	else
	{
		return null;	
	}
}	

function getGuiasTransProDet($ori,$dest,$dniDest)
{
	global $mysqli;
	$estado = 0;
	$codPoli = 1;

	if($codPoli==1){
		if(!$stmt = $mysqli->prepare(
			"SELECT (@rownum:=@rownum+1) AS rownum,tc.num_doc_ori,tc.total_prod,DATE_FORMAT(tc.fec_crea_origen,'%d/%b/%Y') fecha
			FROM tb_cab_documentos tc,(SELECT @rownum:=0) r,tb_locales tl1,tb_locales tl2
			WHERE tl1.cod_local = tc.loc_ori
			AND tl2.cod_local = tc.loc_dest
			AND tc.loc_ori = ?
			AND tc.loc_dest = ?
			AND tc.jzona_dest= ?
			ORDER BY tc.num_doc_ori")){
			die("Revisar Consulta getGuiasTransPend!");
		}
	}

	$stmt->bind_param('sss', $ori,$dest,$dniDest);
	if(!$stmt->execute()){
		die("Fallo la Ejecucion getGuiasTransPend!");
	}

	$stmt->store_result();
	$num = $stmt->num_rows;

	if ($num > 0)
	{
		$stmt->bind_result($a,$b,$c,$d);
		while ($stmt->fetch()) {
			$outArr[] = ['num' => $a, 'doc' => $b, 'tot' => $c, 'fech' => $d];
		}

		$stmt->close();
		return $outArr;			
	}
	else
	{
		return null;	
	}
}

function getCountLocDepPend($codPoli,$jzona)
{
	global $mysqli;

	if($codPoli==2){
		if(!$stmt = $mysqli->prepare(
			"SELECT count(distinct(cod_local)) cant_loc 
			FROM tb_deposito_pendiente td
			WHERE td.num_doc_jef_zona=?;")){
			die("Revisar Consulta tb_deposito_pendiente!");
		}
	}

	$stmt->bind_param('s', $jzona);
	if(!$stmt->execute()){
		die("Fallo la Ejecucion tb_deposito_pendiente!");
	}

	$stmt->store_result();
	$num = $stmt->num_rows;

	if ($num > 0){
		$stmt->bind_result($_campo);
		$stmt->fetch();
		return $_campo;		
	}
	else{
		return null;
	}
}

function getLocDepPend($codPoli,$jzona)
{
	global $mysqli;

	if($codPoli==2){
		if(!$stmt = $mysqli->prepare(
			"SELECT distinct(td.cod_local) locales
			FROM tb_deposito_pendiente td
			WHERE td.num_doc_jef_zona =?;")){
			die("Revisar Consulta tb_deposito_pendiente!");
		}
	}

	$stmt->bind_param('s', $jzona);
	if(!$stmt->execute()){
		die("Fallo la Ejecucion tb_deposito_pendiente!");
	}

	$stmt->store_result();
	$num = $stmt->num_rows;

	if ($num > 0)
	{
		$stmt->bind_result($a);
		while ($stmt->fetch()) {
			$outArr[] = ['locales' => $a];
		}

		$stmt->close();
		return $outArr;			
	}
	else
	{
		return null;	
	}
}

function getLocDepoPendDet($codPoli,$jzona)
{
	global $mysqli;

	if($codPoli==2){
		if(!$stmt = $mysqli->prepare(
			"SELECT (@rownum:=@rownum+1) AS rownum,td.cod_local,td.dia_mes,Date_format(td.fecha_mes,'%d/%m/%Y') fecha_pendiente,td.num_doc_jef_zona,
			CONCAT( 
			    TIMESTAMPDIFF(DAY, DATE_ADD(ADDTIME(td.fecha_mes,'13:00:00'),INTERVAL 1 DAY), NOW()), ' dias, ', 
			    MOD(TIMESTAMPDIFF(HOUR, DATE_ADD(ADDTIME(td.fecha_mes,'13:00:00'),INTERVAL 1 DAY), NOW()), 24), ' horas y ', 
			    MOD(TIMESTAMPDIFF(MINUTE, DATE_ADD(ADDTIME(td.fecha_mes,'13:00:00'),INTERVAL 1 DAY), NOW()), 60), ' minutos' 
			) time_dif,
			TIMESTAMPDIFF(DAY, DATE_ADD(ADDTIME(td.fecha_mes,'13:00:00'),INTERVAL 1 DAY), NOW())*24*60+
			MOD(TIMESTAMPDIFF(HOUR, DATE_ADD(ADDTIME(td.fecha_mes,'13:00:00'),INTERVAL 1 DAY), NOW()), 24)*60+
			MOD(TIMESTAMPDIFF(MINUTE, DATE_ADD(ADDTIME(td.fecha_mes,'13:00:00'),INTERVAL 1 DAY), NOW()), 60) min_dif			
			FROM tb_deposito_pendiente td,(SELECT @rownum:=0) r 
			WHERE num_doc_jef_zona = ?;")){
			die("Revisar Consulta tb_deposito_pendiente!");
		}
	}

	$stmt->bind_param('s', $jzona);
	if(!$stmt->execute()){
		die("Fallo la Ejecucion tb_deposito_pendiente!");
	}

	$stmt->store_result();
	$num = $stmt->num_rows;

	if ($num > 0)
	{
		$stmt->bind_result($a,$b,$c,$d,$e,$f,$g);
		while ($stmt->fetch()) {
			$outArr[] = ['rownum' => $a, 'cod_local' => $b, 'dia_mes' => $c, 'fecha_pendiente' => $d, 'num_doc_jefe_zona' => $e, 'time_dif' => $f, 'min_dif' => $g];
		}

		$stmt->close();
		return $outArr;			
	}
	else
	{
		return null;	
	}
}

function getDepositoPendTarde($codPoli,$jzona)
{
	global $mysqli;

	if($codPoli==2){
		if(!$stmt = $mysqli->prepare(
			"SELECT count(distinct(td.cod_local)) cant_loc
			FROM tb_deposito_tarde td
			WHERE td.num_doc_jef_zona =?;")){
			die("Revisar Consulta tb_deposito_tarde!");
		}
	}

	$stmt->bind_param('s', $jzona);
	if(!$stmt->execute()){
		die("Fallo la Ejecucion tb_deposito_tarde!");
	}

	$stmt->store_result();
	$num = $stmt->num_rows;

	if ($num > 0){
		$stmt->bind_result($_campo);
		$stmt->fetch();
		return $_campo;		
	}
	else{
		return null;
	}
}

function getLocDepPendTarde($codPoli,$jzona)
{
	global $mysqli;

	if($codPoli==2){
		if(!$stmt = $mysqli->prepare(
			"SELECT distinct(td.cod_local) locales
			FROM tb_deposito_tarde td
			WHERE td.num_doc_jef_zona =?;")){
			die("Revisar Consulta tb_deposito_tarde!");
		}
	}

	$stmt->bind_param('s', $jzona);
	if(!$stmt->execute()){
		die("Fallo la Ejecucion tb_deposito_tarde!");
	}

	$stmt->store_result();
	$num = $stmt->num_rows;

	if ($num > 0)
	{
		$stmt->bind_result($a);
		while ($stmt->fetch()) {
			$outArr[] = ['locales' => $a];
		}

		$stmt->close();
		return $outArr;			
	}
	else
	{
		return null;	
	}
}

function getTotalizadoDepTarde($codPoli,$jzona)
{
	global $mysqli;

	if($codPoli==2){
		if(!$stmt = $mysqli->prepare(
			"SELECT con.cod_local,sum(con.min_1) min_1,sum(con.may_1) may_1,sum(con.may_2) may_2,
					sum(con.min_1)+sum(con.may_1)+sum(con.may_2) total
				FROM(
					SELECT td.cod_local,
					CASE
					WHEN dif_min<=720
					THEN 1 ELSE 0
					END min_1,
					CASE
					WHEN dif_min>720 && dif_min<=2160
					THEN 1 ELSE 0
					END may_1,
					CASE
					WHEN dif_min>2160 && dif_min<=99999
					THEN 1 ELSE 0
					END may_2
					FROM tb_deposito_tarde td
					WHERE td.num_doc_jef_zona = ?
				) con
				WHERE 1=1
				GROUP BY 1
				ORDER BY 5 DESC;
			")){
			die("Revisar Consulta tb_deposito_tarde!");
		}
	}

	$stmt->bind_param('s', $jzona);
	if(!$stmt->execute()){
		die("Fallo la Ejecucion tb_deposito_tarde!");
	}

	$stmt->store_result();
	$num = $stmt->num_rows;

	if ($num > 0)
	{
		$stmt->bind_result($a,$b,$c,$d,$e);
		while ($stmt->fetch()) {
			$outArr[] = ['cod_local' => $a,'min_1' => $b,'may_1' => $c,'may_2' => $d,'total' => $e];
		}

		$stmt->close();
		return $outArr;			
	}
	else
	{
		return null;	
	}
}

function getTotalizadoDepPend($codPoli,$jzona)
{
	global $mysqli;

	if($codPoli==2){
		if(!$stmt = $mysqli->prepare(
			"SELECT con2.cod_local,sum(con2.min_1) min_1,sum(con2.may_1) may_1,sum(con2.may_2) may_2
				FROM(
					SELECT con.cod_local,
						CASE
						WHEN con.min_dif<=720
						THEN 1 ELSE 0
						END min_1,
						CASE
						WHEN con.min_dif>720 && con.min_dif<=2160
						THEN 1 ELSE 0
						END may_1,
						CASE
						WHEN con.min_dif>2160 && con.min_dif<=99999
						THEN 1 ELSE 0
						END may_2
					FROM(
						SELECT cod_local,
						TIMESTAMPDIFF(DAY, DATE_ADD(ADDTIME(td.fecha_mes,'13:00:00'),INTERVAL 1 DAY), NOW())*24*60+
						MOD(TIMESTAMPDIFF(HOUR, DATE_ADD(ADDTIME(td.fecha_mes,'13:00:00'),INTERVAL 1 DAY), NOW()), 24)*60+
						MOD(TIMESTAMPDIFF(MINUTE, DATE_ADD(ADDTIME(td.fecha_mes,'13:00:00'),INTERVAL 1 DAY), NOW()), 60) min_dif
						FROM tb_deposito_pendiente td
						WHERE td.num_doc_jef_zona = ?
					) con
				) con2
				WHERE 1=1
				GROUP BY 1
				ORDER BY 1;
			")){
			die("Revisar Consulta tb_deposito_tarde!");
		}
	}

	$stmt->bind_param('s', $jzona);
	if(!$stmt->execute()){
		die("Fallo la Ejecucion tb_deposito_tarde!");
	}

	$stmt->store_result();
	$num = $stmt->num_rows;

	if ($num > 0)
	{
		$stmt->bind_result($a,$b,$c,$d);
		while ($stmt->fetch()) {
			$outArr[] = ['cod_local' => $a,'min_1' => $b,'may_1' => $c,'may_2' => $d];
		}

		$stmt->close();
		return $outArr;			
	}
	else
	{
		return null;	
	}
}

function getDepPendTardeDet($codPoli,$jzona)
{
	global $mysqli;

	if($codPoli==2){
		if(!$stmt = $mysqli->prepare(
			"SELECT (@rownum:=@rownum+1) AS rownum,td.cod_local,
			CONCAT(ELT(WEEKDAY(td.fecha_cierre_dia) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'),' ',Date_format(td.fecha_cierre_dia,'%d/%m/%Y')) as fecha_cierre_dia,
			CONCAT(ELT(WEEKDAY(td.fecha_op_bancaria) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'),' ',Date_format(td.fecha_op_bancaria,'%d/%m/%Y  %k:%i:%s')) as fecha_op_bancaria,
			td.moneda,td.monto_deposito,
			CASE
			WHEN WEEKDAY(td.fecha_cierre_dia)=5
			THEN
			CONCAT( 
			TIMESTAMPDIFF(DAY, DATE_ADD(ADDTIME(td.fecha_cierre_dia,'13:00:00'),INTERVAL 2 DAY), td.fecha_op_bancaria), ' dias, ', 
			MOD(TIMESTAMPDIFF(HOUR, DATE_ADD(ADDTIME(td.fecha_cierre_dia,'13:00:00'),INTERVAL 2 DAY), td.fecha_op_bancaria), 24), ' horas y ', 
			MOD(TIMESTAMPDIFF(MINUTE, DATE_ADD(ADDTIME(td.fecha_cierre_dia,'13:00:00'),INTERVAL 2 DAY), td.fecha_op_bancaria), 60), ' min' 
			)
			ELSE
			CONCAT( 
			TIMESTAMPDIFF(DAY, DATE_ADD(ADDTIME(td.fecha_cierre_dia,'13:00:00'),INTERVAL 1 DAY), td.fecha_op_bancaria), ' dias, ', 
			MOD(TIMESTAMPDIFF(HOUR, DATE_ADD(ADDTIME(td.fecha_cierre_dia,'13:00:00'),INTERVAL 1 DAY), td.fecha_op_bancaria), 24), ' horas y ', 
			MOD(TIMESTAMPDIFF(MINUTE, DATE_ADD(ADDTIME(td.fecha_cierre_dia,'13:00:00'),INTERVAL 1 DAY), td.fecha_op_bancaria), 60), ' min' 
			)
			END tiempo_diferencia,td.num_operacion,td.usuario,td.dif_min,Date_format(td.fecha_cierre_dia,'%d/%m/%Y') f_cierre
			FROM tb_deposito_tarde td, (SELECT @rownum:=0) r
			WHERE td.num_doc_jef_zona =?
			order by 1,10;")){
			die("Revisar Consulta tb_deposito_tarde!");
		}
	}

	$stmt->bind_param('s', $jzona);
	if(!$stmt->execute()){
		die("Fallo la Ejecucion tb_deposito_tarde!");
	}

	$stmt->store_result();
	$num = $stmt->num_rows;

	if ($num > 0)
	{
		$stmt->bind_result($z,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j);
		while ($stmt->fetch()) {
			$outArr[] = ['rownum' => $z,'cod_local' => $a, 'fech_cierre' => $b, 'fech_oper' => $c, 'mon' => $d, 'mon_dep' => $e, 'time_dif' => $f, 'num_oper' => $g, 'usu_dep' => $h, 'dif_min' => $i];
		}

		$stmt->close();
		return $outArr;			
	}
	else
	{
		return null;	
	}
}



?>