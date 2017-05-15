<?php
require($_SERVER["DOCUMENT_ROOT"].'\basesfinal\php\conexion.php');
	session_start();
	if(is_null($_SESSION['perfil'])||$_SESSION['perfil']=='admin')
		header("Location: ../../");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Control de Asistencia</title>
	<meta charset="utf-8">
	<link rel="shorcout icon" href="../img/notebook.png">
	<link rel="stylesheet" type="text/css" href="../css/asistencia.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body>
<header>
		<ul id="menu">
			<li class="item"><a href="../instructor">Inicio</a></li>
			<li class="item"><a href="../info">Mis Cursos</a></li>
			<li class="item"><a href="../asistencia">Asistencia</a></li>
			<li class="item"><a href="#Nosotros">Nosotros</a></li>
			<li class="item"><a href="#Ayuda">Ayuda</a></li>
			<li class="item"><a href="../../php/logout.php">Salir</a></li>

		</ul>
</header>
<section id="cursoselection">
<h3> Mis Cursos asignados </h3>
<form id="courseinfo">
<?php
$user = $_SESSION['usuario'];
	$query = "select clave, nombre 
from curso NATURAL  join instructor NATURAL  join usuarios
where usuarios.usuario = '$user'";
			
	$enlace->real_query($query);
	$resultado = $enlace->use_result();
	echo "<p>Curso:</p><select name='curso' id='curso'>";
	while ( $fila = $resultado->fetch_assoc()){
		echo "<option value='".$fila['clave']."'> ". $fila['nombre']."</option>";
	}
	echo "</select>"
?>
<input type="password" id="pass" name="password">
<input type="submit" value="Pasar lista">
</form>
	
</section>
<section id="list">
	
</section>
<div id="message">

</div>

</body>
<script type="text/javascript">
message = $("#message");

function showMessage(data,time){
	message.html(data);
	message.css("visibility", "visible");
	setTimeout(function(){message.css("visibility", "hidden");  }, time);
}
	$("#courseinfo").on("submit", function (e){
		e.preventDefault();
			$("#list").html("");

		$.ajax({
			url: "../../php/listfill.php",
			data: "curso=IT1040",
			type:'POST',
			success: function (data){
				$("#list").html(data);
			}

		});
	});

</script>
</html>