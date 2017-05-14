<?php
	require 'conexion.php';
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