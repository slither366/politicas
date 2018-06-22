<?php
require 'funcs/conexion.php';
include 'funcs/funcs.php';
require_once 'PHPMailer/PHPMailerAutoload.php';

/*
$arrayPrueba = [["dflores@mifarma.com.pe",""],["slither366@gmail.com", ""],["slither366@outlook.com.pe", ""]];
*/

$cadena = "dflores@mifarma.com.pe,slither366@gmail.com,slither366@outlook.com.pe";

//Transformando String a Array
$arrayValores = explode(",",$cadena);
/*foreach ($valores as $email) {
	echo $email.'<br/>';
}*/

if(enviarVariosEmail($arrayValores, "Mensajes de Prueba", "Por favor validar las siguientes Interfaces")){
	echo "Enviado";

}else{
	echo "Cuevita malo!";
}


?>