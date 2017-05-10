<?php
$enlace = mysqli_connect("localhost", "proyectofinal", "roberto", "proyectofinal");

	if (!$enlace) {
    	echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    	echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    	echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    	exit;
	}

	$matricula = $_POST['matricula'];
	$nombre = $_POST['nombre'];
	$apellido_pat = $_POST['ap_pat'];
	$apellido_mat = $_POST['ap_mat'];

	$query = "insert into alumno values ('$matricula', '$nombre', '$apellido_pat', '$apellido_mat');";

	if ($enlace->query($query) === TRUE) {
    	echo "Alumno registrado correctamente";
	}
	elseif($enlace->errno==1062){
		echo "Esta matricula ya se encuentra registrada";
	}
	else {
    	echo "Error: " . $query . "<br>" . $enlace->errno;
	}


?>