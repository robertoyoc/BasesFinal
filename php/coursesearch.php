<?php
	require 'conexion.php';

	$clavecurso = $_POST['clavecurso'];
	$query = "SELECT nomina, clave, nombre FROM curso, instructor WHERE clave = '$clavecurso' AND curso.instructor = instructor.id";

	$enlace->real_query($query);
	$resultado = $enlace->use_result();

	if($resultado){
		$fila = $resultado->fetch_assoc();
		if($fila['clave'] != ""){
			$result = array(
				'clave' => $fila['clave'],
				'nombre' => $fila['nombre'],
				'nomina' => $fila['nomina'],

				'status' => 'Encontrado'
				);
		}
		else{
			$result = array('status' => 'Error, no encontrado');
		}
	}

	echo json_encode($result);

?>