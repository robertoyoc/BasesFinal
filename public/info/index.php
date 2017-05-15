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
	<link rel="stylesheet" type="text/css" href="../css/instructor.css">
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
<section class="container">
<section class="initial-data">
<h3> Mis Cursos asignados </h3>
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
<input type="button" id="viewInfo" value="Ver info">
<div id="resultado"> </div>
</section>
	
</section>

</body>
<script type="text/javascript">
	$("#viewInfo").on('click', function (){
		var clave = $("#curso").val();
		$.ajax({
			url: "../../php/courseifo.php",
			type: "POST",
			data: "clave=" + clave,
			success: function (data){
				$("#resultado").html(data);
			}	

		});

	});
</script>
</html>