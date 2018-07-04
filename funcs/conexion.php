<?php
include 'config.php';

	$mysqli=new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos

	mysqli_set_charset($mysqli,'utf8');//Sirve para que muestre las Ñ y Tildes con normalidad en la Web

	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
	?>