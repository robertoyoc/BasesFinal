<?php
	require 'conexion.php';

	$usuario = $_POST['usuario'];

	$query = "select usuario from usuarios where usuario= '$usuario'";

	$enlace->real_query($query);
	$resultado = $enlace->use_result();


	if($resultado){
		$fila = $resultado->fetch_assoc();
		if($fila['usuario'] != ""){
			$result = array('usuario' => $fila['usuario'], 'status' => 'Encontrado');
		}
		else{
			$result = array('usuario' => "", 'status' => 'Error, no encontrado');
		}

	}

	echo json_encode($result);


?>