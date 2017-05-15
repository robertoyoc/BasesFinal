<?php
	require 'conexion.php';

	$nombre = $_POST['r_name'];
	$clave = $_POST['r_clave'];
	$instructor = $_POST['r_instructor'];

	$query = "update curso 
			  set clave='$clave', 
			  nombre='$nombre', 
			  instructor = (select id
			  				from instructor
			  				where nomina = '$instructor') 
			  where clave='$clave'";

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