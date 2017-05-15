<?php
	require 'conexion.php';

	$clave = $_POST['clave'];
	$name = $_POST['name'];
	$instructor = $_POST['instructor'];
	$password = $_POST['password'];
	$imatricula = $_POST['imatricula'];
	$dmatricula = $_POST['dmatricula'];

	$query = "insert into curso values ('$clave', '$name', '$instructor', '$password');";
	$inscribe = "insert into inscripcion values ('$imatricula', 'clave');";
	$desinscribe = "delete from inscripcion where matricula = '$dmatricula';";

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