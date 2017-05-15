<?php
	require 'conexion.php';

	$curso = $_POST['r_clave'];
	$matricula = $_POST['matricula'];
	
	$query = "INSERT INTO inscripcion VALUES ('$matricula', '$curso');";

	if ($enlace->query($query) === TRUE) {
		$result = array('status' => "Inscrito", 'msg' => "Alumno inscrito correctamente");
	}
	elseif($enlace->errno==1062){
		$result = array('status' => "Denegado", 'msg' => "Este alumno ya se encuentra inscrito");
	}
	else {
    	$Error=  "Error: " . $query . "<br>" . $enlace->errno;
    	$result = array('status' => "Error", 'msg' => $Error);
	}
	echo json_encode($result);

?>