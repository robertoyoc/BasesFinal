<?php
	require 'conexion.php';

	$nombre = $_POST['r_name'];
	$clave = $_POST['r_clave'];
	$instructor = $_POST['instructor'];

	$query = "insert into curso (clave, nombre, instructor) values ('$clave', '$name', '$instructor');";

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