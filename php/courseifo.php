<?php
	require 'conexion.php';

	$clave = $_POST['clave'];



	$query = "select count(num_sesion) from sesion where curso = '$clave'";

	$enlace->real_query($query);
	$resultado = $enlace->store_result();


	if($resultado){
		$fila = $resultado->fetch_assoc();
		echo "<br>";
		echo "Número de sesiones: ".$fila['count(num_sesion)'];
	}
	$query = "select count(matricula) from inscripcion where clave = '$clave'";

	$enlace->real_query($query);
	$resultado = $enlace->store_result();
	if($resultado){
		$fila = $resultado->fetch_assoc();
		echo "<br>";
		echo "Número de alumnos: ".$fila['count(matricula)'];
	}




?>