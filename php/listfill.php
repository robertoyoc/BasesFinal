<?php
	require 'conexion.php';
	
	$curso = $_POST['curso'];

	$query = "select matricula, nombre, apellido_pat, apellido_mat from inscripcion natural join alumno where clave= '$curso'";

	$enlace->real_query($query);
	$resultado = $enlace->store_result();


	if($resultado){
		echo "<form><ul>";
		while($fila = $resultado->fetch_assoc()){
			echo "<li><p>".$fila['nombre']." ".$fila['apellido_pat']." ".$fila['apellido_mat']."</p> - <p>".$fila['matricula']."</p><input class= 'inputs' type='checkbox' value='".$fila['matricula']."'></li>";
		}
		echo "</ul></form>";
	}


?>