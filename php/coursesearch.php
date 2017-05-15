<?php
	require 'conexion.php';

	$clavecurso = $_POST['clavecurso'];

	$query = "select * from course where clave = '$clavecurso'";

	$enlace->real_query($query);
	$resultado = $enlace->use_result();

	if($resultado){
		$fila = $resultado->fetch_assoc();
		if($fila['clavecurso'] != ""){
			$result = array('clavecurso' => $fila['clavecurso'], 'status' => 'Encontrado');
		}
		else{
			$result = array('clavecurso' => "", 'status' => 'Error, no encontrado');
		}
	}

	echo json_encode($result);

?>