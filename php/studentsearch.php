<?php
$enlace = mysqli_connect("localhost", "proyectofinal", "roberto", "proyectofinal");

	if (!$enlace) {
    	echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    	echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    	echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    	exit;
	}

	$matricula = $_POST['matricula'];

	$query = "select * from alumno where matricula = '$matricula'";

	$enlace->real_query($query);
	$resultado = $enlace->use_result();
	
	if($resultado){
		session_start();
		$fila = $resultado->fetch_assoc();
		if(isset($fila)){
			
			echo $fila['matricula'].";".$fila['nombre'].";".$fila['apellido_pat'].";".$fila['apellido_mat'];
		}
		else
			die("No encontrado");

	}
	else
	{
		die("No encontrado");
	}


?>