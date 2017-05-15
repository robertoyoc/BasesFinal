<?php
	require 'conexion.php';
	$clave = $_POST['curso'];

	$query = "select num_sesion from sesion where curso='$clave'";
			
	$enlace->real_query($query);
	$resultado = $enlace->store_result();
	echo "<p>Sesión:</p><select name='session' id='session'>";
	while ( $fila = $resultado->fetch_assoc()){
		echo "<option value='".$fila['num_sesion']."'> ". $fila['num_sesion']."</option>";
	}
	echo "</select>";
?>