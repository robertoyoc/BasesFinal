<?php
$enlace = mysqli_connect("localhost", "proyectofinal", "kevin", "proyectofinal");

	if (!$enlace) {
    	echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    	echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    	echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    	exit;
	}

	$clave = $_POST['clave'];
	$name = $_POST['name'];
	$instructor = $_POST['instructor'];
	$password = $_POST['password'];
	$matricula = $_POST['matricula'];

	$query = "insert into curso values ('$clave', '$name', '$instructor', '$password');";
	$inscribe = "insert into inscripcion values ('$matricula', 'clave');";

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