<?php
	require 'conexion.php';

	$usuario = $_POST['usuario'];
	$contrasena = $_POST['contrasena'];

	$pass = md5($contrasena);

	$query = "insert into usuarios(usuario, contrasena, perfil) values ('$usuario', '$pass', 'admin');";

	if ($enlace->query($query) === TRUE) {
		$result = array('status' => "Usuario registrado correctamente");
	}
	elseif($enlace->errno==1062){
		$result = array('status' => "Este usuario ya se encuentra registrado");
	}
	else {
		$Error =  "Error: " . $query . "<br>" . $enlace->errno;
		$result = array('status' => $Error);
	}
	echo json_encode($result);



?>