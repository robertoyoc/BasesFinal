<?php
	require 'conexion.php';

	$clavecurso = $_POST['clavecurso'];

	$query = "select * from course where clave = '$clavecurso'";

	if ($enlace->query($query) === TRUE) {
		$result = array('status' => "Encontrado", 'msg' => "Curso enconyrado correctamente");
	}
	elseif($enlace->errno==1062){
		$result = array('status' => "No encontrado", 'msg' => "Este curso no se encuentra registrado");
	}
	else {
    	$Error=  "Error: " . $query . "<br>" . $enlace->errno;
    	$result = array('status' => "Error", 'msg' => $Error);
	}
	echo json_encode($result);

?>