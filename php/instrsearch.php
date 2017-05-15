<?php
	require 'conexion.php';

	$usuario = $_POST['usuario'];

	$query = "select usuario, nombre, nomina, correo, perfil from usuarios, instructor where usuario= '$usuario' and usuarios.id = instructor.id";

	$enlace->real_query($query);
	$resultado = $enlace->use_result();


	if($resultado){
		$fila = $resultado->fetch_assoc();
		if($fila['usuario'] != "" && $fila['perfil']== "instr"){
			$result = array('status' => 'Encontrado', 'usuario' => $fila['usuario'], 'nombre'=> $fila['nombre'], 'correo' => $fila['correo'], 'nomina' => $fila['nomina'],);
		}
		else{
			$result = array('status' => 'Error, no encontrado');
		}

	}

	echo json_encode($result);


?>