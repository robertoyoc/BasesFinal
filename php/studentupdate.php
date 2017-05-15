<?php
	require 'conexion.php';
	$matricula = $_POST['matricula'];
	$nombre = $_POST['nombre'];
	$apellido_pat = $_POST['ap_pat'];
	$apellido_mat = $_POST['ap_mat'];


	$query = "update alumno set nombre = '$nombre', apellido_pat = '$apellido_pat', apellido_mat = '$apellido_mat' where matricula = '$matricula'";

	if ($enlace->query($query) === TRUE) {
		$result = array('status' => "Datos actualizados correctamente");
	}
	else {
		$Error =  "Error: " . $query . "<br>" . $enlace->errno;
		$result = array('status' => $Error);
	}
	echo json_encode($result);



?>