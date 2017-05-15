<?php
	require 'conexion.php';

	$nombre = $_POST['name'];
	$clave = $_POST['carrera'];
	$cnumber = $_POST['clavenumber'];
	$instructor = $_POST['instructor'];

	$clavecurso = $clave.$cnumber;

	$query = "INSERT INTO curso VALUES ('$clavecurso', '$nombre', '$instructor');";

	if ($enlace->query($query) === TRUE) {
		$result = array('status' => "Aceptado", 'msg' => "Curso registrado correctamente");
	}
	elseif($enlace->errno==1062){
		$result = array('status' => "Denegado", 'msg' => "Esta clave ya se encuentra registrada");
	}
	else {
    	$Error=  "Error: " . $query . "<br>" . $enlace->errno;
    	$result = array('status' => "Error", 'msg' => $Error);
	}
	echo json_encode($result);


?>