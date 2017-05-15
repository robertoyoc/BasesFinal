<?php

	require 'conexion.php';

	$matricula = $_POST['matricula'];

	$query = "select * from alumno where matricula = '$matricula'";

	$enlace->real_query($query);
	$resultado = $enlace->use_result();
	
	if($resultado){
		session_start();
		$fila = $resultado->fetch_assoc();
		if($fila['matricula'] != ""){
			$result = array(
				'status' => "Encontrado",
				'matricula' => $fila['matricula'],
				'nombre' => $fila['nombre'],
				'ap_pat' => $fila['apellido_pat'],
				'ap_mat' => $fila['apellido_mat']


				);
		}
		else
			$result = array(
				'status' => "No encontrado");

	}
	else
	{
		$result = array(
				'status' => "No encontrado");
			
	}
	echo json_encode($result)


?>