<?php
	include 'config.php';

	$mysqli=new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE); //servidor, usuario de base de datos, contrase�a del usuario, nombre de base de datos
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>