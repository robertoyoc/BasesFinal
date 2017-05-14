<?php
$enlace = mysqli_connect("localhost", "proyectofinal", "kevin", "proyectofinal");

	if (!$enlace) {
    	echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    	echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    	echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    	exit;
	}

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