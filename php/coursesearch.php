<?php
$enlace = mysqli_connect("localhost", "proyectofinal", "kevin", "proyectofinal");

	if (!$enlace) {
    	echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    	echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    	echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    	exit;
	}

	$clave = $_POST['clave'];

	$query = "select * from course where clave = '$clave'";

	$enlace->real_query($query);
	$resultado = $enlace->use_result();
	
	if($resultado){
		session_start();
		$fila = $resultado->fetch_assoc();
		if(isset($fila)){
			
			echo $fila['clave'].";".$fila['name'].";".$fila['instructor'].";".$fila['contraseña'];
		}
		else
			die("No encontrado");

	}
	else
	{
		die("No encontrado");
	}


?>