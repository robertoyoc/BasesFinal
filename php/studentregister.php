<?php

	require 'conexion.php';

	$matricula = $_POST['matricula'];
	$nombre = $_POST['nombre'];
	$apellido_pat = $_POST['ap_pat'];
	$apellido_mat = $_POST['ap_mat'];

	$query = "insert into alumno values ('$matricula', '$nombre', '$apellido_pat', '$apellido_mat');";

	if ($enlace->query($query) === TRUE) {
    	$result = array('status' => "Alumno registrado correctamente");
	}
	elseif($enlace->errno==1062){
		$result = array('status' => "Esta matricula ya se encuentra registrada");
	}
	else {
    	$Error =  "Error: " . $query . "<br>" . $enlace->errno;
		$result = array('status' => $Error);
	}
	echo json_encode($result);


?>