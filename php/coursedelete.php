<?php
	require 'conexion.php';

	$r_clave = $_POST['r_clave'];

	$query = "DELETE FROM curso WHERE clave = '$r_clave'";

	if ($enlace->query($query) === TRUE) {
		$result = array('status' => "Borrado", 'msg' => "Curso borrado correctamente");
	}
	else {
    	$Error=  "Error: " . $query . "<br>" . $enlace->errno;
    	$result = array('status' => "Error", 'msg' => $Error);
	}
	echo json_encode($result);
?>