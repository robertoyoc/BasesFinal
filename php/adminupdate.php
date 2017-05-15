<?php
	require 'conexion.php';
	$usuario = $_POST['usuario'];
	$contrasena = $_POST['contrasena'];

	$pass = md5($contrasena);

	$query = "update usuarios set contrasena = '$pass' where usuario = '$usuario'";

	if ($enlace->query($query) === TRUE) {
		$result = array('status' => "Contraseña actualizada correctamente");
	}
	else {
		$Error =  "Error: " . $query . "<br>" . $enlace->errno;
		$result = array('status' => $Error);
	}
	echo json_encode($result);



?>