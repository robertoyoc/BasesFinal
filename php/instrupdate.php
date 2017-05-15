<?php
	require 'conexion.php';
	$usuario = $_POST['usuario'];
	$nombre = $_POST['nombre'];
	$contrasena = $_POST['contrasena'];
	$nomina = $_POST['nomina'];
	$correo = $_POST['correo'];
	if($contrasena!= ""){
		$cambio = true;
	}
	else{
		$cambio = false;
	}


	$querys = "select id from usuarios where usuario = '$usuario'";

	$enlace->real_query($querys);
	$resultado = $enlace->store_result();


	if($resultado){
		$fila = $resultado->fetch_assoc();
		$id = $fila['id'];
	}


	$pass = md5($contrasena);

	$query = "update usuarios set contrasena = '$pass' where id = $id";
	$squery = "update instructor set nomina = '$nomina', nombre= '$nombre', correo = '$correo' where id = $id";

	$primera =$enlace->query($squery);


	if ($primera == TRUE &&$cambio) {
		if($enlace->query($query) ===TRUE){
			$result = array('status' => "Datos actualizados correctamente");
		}
		else {
		$Error =  "Error: " . $query . "<br>" . $enlace->error;
		$result = array('status' => $Error);
		}
	}
	else if($primera == TRUE &&!$cambio){
		$result = array('status' => "Datos actualizados correctamente");
	}
	elseif($enlace->errno==1062){
		$result = array('status' => "Esta nomina ya se encuentra registrada");
	}
	else {
		$Error =  "Error: " . $query . "<br>" . $enlace->errno;
		$result = array('status' => $Error);
	}
	echo json_encode($result);



?>