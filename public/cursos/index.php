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
<section class="container">
	<section id="initial-data">
		<h3>Registrar un nuevo curso</h3>
		<form action="">
			<p>Nombre:</p><input type="text" name="name" id="name" required><br>
			<select id="carreras">
				<option value="IT">IT</option>
				<option value="IS">IS</option>
				<option value="CP">CP</option>
				<option value="LA">LA</option>
			</select>
			<p>Clave:</p><input type="text" name="id" id="matrícula" required><br>
			<p>Instructor:</p><input type="text" name="instructor" id="instructor" required><br>
			<input type="submit" value="Registrar">
		</form>
	</section>
	<section id="search">
		<h3>Buscar información del curso</h3>
		<form onsubmit="return search()">
			<p>Calve:</p><input type="text" id="">
		</form>
	</section>
</section>

</body>
</html>