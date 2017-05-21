<?php
	require 'conexion.php';

	$usuario = $_POST['usuario'];

	$query = "select usuario, perfil from usuarios where usuario= '$usuario'";

	$enlace->query($query);
	$resultado = $enlace->use_result();


	if($resultado){
		$fila = $resultado->fetch_assoc();
		if($fila['usuario'] != "" &&$fila['perfil']=='admin'){
			$result = array('usuario' => $fila['usuario'], 'status' => 'Encontrado');
		}
		else{
			$result = array('usuario' => "", 'status' => 'No encontrado');
		}

	}

	echo json_encode($result);


?>