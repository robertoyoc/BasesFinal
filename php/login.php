<?php

	require 'conexion.php';

	$contr = $_POST['password'];
	$user = $_POST['usuario'];

	$pass = md5($contr);

	$query = "select * FROM usuarios where usuario='$user'";

	$enlace->real_query($query);
	$resultado = $enlace->use_result();
	
	if($resultado){
		
		$fila = $resultado->fetch_assoc();

		if($pass == $fila['contrasena']){
			session_start();
			$_SESSION['perfil'] = $fila['perfil'];
			$_SESSION['usuario'] = $fila['usuario'];
			die();
		}else
			die('Contraseña incorrecta');
	}
	else
	{
		die('Usuario no encontrado');
	}

mysqli_close($enlace);
?>