<?php
	require 'conexion.php';

	$clave = $_POST['clave'];
	
	$query = "delete from curso where clave = '$clave';";

	if ($enlace->query($query) === TRUE) {
    	echo "Curso borrado correctamente";
	}
	else {
    	echo "Error: " . $query . "<br>" . $enlace->errno;
	}


?>