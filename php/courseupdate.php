<?php
	require 'conexion.php';

	$nombre = $_POST['name'];
	$clave = $_POST['r_clave'];
	$instructor = $_POST['instructor'];

	$query = "UPDATE curso 
			  SET clave='$clave', 
			  nombre='$nombre', 
			  instructor = (SELECT id
			  				FROM instructor
			  				WHERE nomina = '$instructor') 
			  WHERE clave='$clave'";

	if ($enlace->query($query) === TRUE) {
    	echo "Curso actualizado correctamente";
	}
	elseif($enlace->errno==1062){
		echo "Esta clave ya se encuentra registrada";
	}
	else {
    	echo "Error: " . $query . "<br>" . $enlace->errno;
	}
?>