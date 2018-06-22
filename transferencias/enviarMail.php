<?php
session_start();
require '../funcs/conexion.php';
include '../funcs/funcs.php';
require_once 'PHPMailer/PHPMailerAutoload.php';

$titulo = $mysqli->real_escape_string($_POST['vTitulo']);
$emails = $mysqli->real_escape_string($_POST['vEmails']);
$detCorreo = $mysqli->real_escape_string($_POST['vdetCorreo']);


if(isset($_POST['vTitulo'])&&$_POST['vEmails']&&$_POST['vdetCorreo']){

	//Transformando String a Array
	$arrayEmails = explode(";",$emails);

	if(enviarVariosEmail($arrayEmails, $titulo, $detCorreo)){
		echo "Se Envió Correo";
	}else{
		echo "Error al Enviar Correo!";
	}
}

?>