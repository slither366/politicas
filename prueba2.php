<?php
require 'funcs/conexion.php';
include 'funcs/funcs.php';
require_once 'PHPMailer/PHPMailerAutoload.php';

$arrayPrueba = [["dflores@mifarma.com.pe","David Flowers"],["slither366@gmail.com", "Slither"],["slither366@outlook.com.pe", "Jose Pinedo"]];


if(enviarVariosEmail($arrayPrueba, "Mensajes de Prueba", "Por favor validar las siguientes Interfaces")){
	echo "Enviado";
}else{
	echo "Cuevita malo!";
}


?>