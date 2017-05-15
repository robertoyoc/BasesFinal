<?php
	require 'conexion.php';

	$usuario = $_POST['usuario'];
	$nombre = $_POST['nombre'];
	$contrasena = $_POST['contrasena'];
	$nomina = $_POST['nomina'];
	$correo = $_POST['correo'];

	$pass = md5($contrasena);

	$queryusers = "insert into usuarios(usuario, contrasena, perfil) values ('$usuario', '$pass', 'instr');";

	if ($enlace->query($queryusers) === TRUE) {
		$id = $enlace->insert_id;
		$queryinstr = "insert into instructor values ('$id', '$nombre', '$nomina', '$correo')";
		if ($enlace->query($queryinstr) === TRUE) {		
			$result = array('status' => "Aceptado", 'msg'=> "Usuario registrado correctamente");
		}
		elseif($enlace->errno==1062){
			$queryaux = "delete from usuarios where id = '$id'";
			$enlace ->query($queryaux);
			$result = array('status' => "Denegado", 'msg'=> "Esta nomina ya se encuentra registrada");
		}
		else {
		$Error =  "Error: " . $query . "<br>" . $enlace->errno;
		$result = array('status' => "Error", 'msg' => $Error);
		}
	}
	elseif($enlace->errno==1062){
		$result = array('status' => "Denegado", 'msg'=> "Este usuario ya se encuentra registrado");
	}
	else {
		$Error =  "Error: " . $query . "<br>" . $enlace->errno;
		$result = array('status' => "Error", 'msg' => $Error);
	}

	
	echo json_encode($result);



?>