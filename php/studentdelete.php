<?php
	require 'conexion.php';
	$matricula = $_POST['matricula'];

	$query = "delete from alumno where matricula= '$matricula'";

	if ($enlace->query($query) === TRUE) {
		$result = array('status' => "Alumno eliminado");
	}
	else {
		$Error =  "Error: " . $query . "<br>" . $enlace->errno;
		$result = array('status' => $Error);
	}
	echo json_encode($result);



?>