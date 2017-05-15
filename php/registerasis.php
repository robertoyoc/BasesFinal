<?php
	require 'conexion.php';
	

	$asistentesstring= $_POST['asistentes'];
	$faltantesstring = $_POST['faltantes'];
	$curso = $_POST['curso'];
	$sesion = $_POST['session'];

	$asistentes = explode("|", $asistentesstring);
	

	$count =0;
	while ($count<count($asistentes)) {
		if($asistentes[$count] != ""){
			$matricula = $asistentes[$count];
			$query = "insert into asistencias values ('$matricula', $sesion, '$curso', true);";
			$enlace->query($query);
			echo $query;
		}
		$count++;
	}
	$faltantes = explode("|", $faltantesstring);
	$count =0;
	while ($count<count($faltantes)) {
		if($faltantes[$count] != ""){
			$matricula = $faltantes[$count];
			$query = "insert into asistencias values ('$matricula', $sesion, '$curso', false);";
			$enlace->query($query);
		}
		$count++;
	}
	echo $enlace->error;
	


?>