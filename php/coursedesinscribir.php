<?php
	require 'conexion.php';

	$curso = $_POST['r_clave'];
	$matricula = $_POST['matricula'];
	
	$query = "DELETE FROM inscripcion 
			  WHERE matricula = '$matricula' AND  clave = '$curso';";

	if ($enlace->query($query) === TRUE) {
		$result = array('status' => "Desinsnscrito", 'msg' => "Alumno desinscrito correctamente");
	}
	elseif($enlace->errno==1062){
		$result = array('status' => "Denegado", 'msg' => "Este alumno no se encuentra en este curso");
	}
	else {
    	$Error=  "Error: " . $query . "<br>" . $enlace->errno;
    	$result = array('status' => "Error", 'msg' => $Error);
	}
	echo json_encode($result);

?>