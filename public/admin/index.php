<?php
	session_start();
	if(is_null($_SESSION['perfil'])||$_SESSION['perfil']=='instr')
		header("Location: ../../");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Control de Asistencia</title>
	<meta charset="utf-8">
	<link rel="shorcout icon" href="../img/notebook.png">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
<header>
		<ul id="menu">
			<li class="item"><a href="../admin">Inicio</a></li>
			<li class="item"><a href="../alumnos">Alumnos</a></li>
			<li class="item"><a href="../cursos?r_clave=">Cursos</a></li>
			<li class="item"><a href="../usuarios">Usuarios</a></li>
			<li class="item"><a href="#Nosotros">Nosotros</a></li>
			<li class="item"><a href="#Ayuda">Ayuda</a></li>
			<li class="item"><a href="../../php/logout.php">Salir</a></li>

		</ul>
</header>

<img src="../img/bienvenido.png" id="welcome">
	
</img>

</body>
</html>