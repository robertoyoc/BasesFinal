<?php
	require 'conexion.php';

	$usuario = $_POST['usuario'];

	$query = "select id, usuario from usuarios where usuario= '$usuario'";

	$enlace->real_query($query);
	$resultado = $enlace->use_result();


	if($resultado){
		$fila = $resultado->fetch_assoc();
		if($fila['usuario'] != ""){

			$localuser = $fila['usuario'];
			$id = $fila['id'];

			$s_query = "select nomina, correo from instructor where id = '$id'";
			$enlace->real_query($s_query);
			$resultado = $enlace->use_result();

			$result = array('status' => 'Encontrado', 'usuario' => $fila['usuario'], );
		}
		else{
			$result = array('usuario' => "", 'status' => 'Error, no encontrado');
		}

	}

	echo json_encode($result);


?>