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
    	$result  = array('status' =>  "Curso actualizado correctamente");
	}
	elseif($enlace->errno==1062){
		$result  = array('status' =>  "Esta clave ya se encuentra registrada");
	}
	else {
    	$Error= "Error: " . $query . "<br>" . $enlace->errno;
    	$result  = array('status' =>  $Error);
	}
	echo json_encode($result);
?>