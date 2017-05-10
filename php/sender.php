<?php

$origen = $_GET['origen'];

if($origen == 'Inicio'){
	
	
}elseif($origen=='Salir'){
	session_start();
	session_unset();
	session_destroy();
	
	header("Location: ../");
}
elseif ($origen == 'Alumnos') {
	header("Location: ../html/alumnos.html");
}
elseif($origen =='Admin'){
	header("Location: ../html/admin.html");
}
elseif($origen == 'Cursos'){
	header("Location: ../html/cursos.html");
}


?>