<?php
	session_start();
	if(is_null($_SESSION['perfil']))
		header("Location: ../../");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Control de Asistencia</title>
	<link rel="stylesheet" type="text/css" href="../css/alumnos.css">
	<link rel="shorcout icon" href="../../img/notebook.png">
</head>

<body>
<header>
		<ul id="menu">
			<li class="item"><a href="../admin">Inicio</a></li>
			<li class="item"><a href="../alumnos">Alumnos</a></li>
			<li class="item"><a href="../cursos">Cursos</a></li>
			<li class="item"><a href="#Nosotros">Nosotros</a></li>
			<li class="item"><a href="#Ayuda">Ayuda</a></li>
			<li class="item"><a href="../../php/logout.php">Salir</a></li>

		</ul>
</header>
	

</body>
</html>