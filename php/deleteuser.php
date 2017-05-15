<?php
	require 'conexion.php';
	$usuario = $_POST['usuario'];

	$query = "delete from usuarios where usuario= '$usuario'";

	if ($enlace->query($query) === TRUE) {
		$result = array('status' => "Usuario eliminado");
	}
	else {
		$Error =  "Error: " . $query . "<br>" . $enlace->errno;
		$result = array('status' => $Error);
	}
	echo json_encode($result);



?>