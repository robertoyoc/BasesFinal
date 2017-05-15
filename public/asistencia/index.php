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
<div class="asd">
<?php
$user = $_SESSION['usuario'];
	$query = "select clave, nombre 
from curso NATURAL  join instructor NATURAL  join usuarios
where usuarios.usuario = '$user'";
			
	$enlace->real_query($query);
	$resultado = $enlace->store_result();
	echo "<p>Curso:</p><select name='curso' id='curso'>";
	while ( $fila = $resultado->fetch_assoc()){
		echo "<option value='".$fila['clave']."'> ". $fila['nombre']."</option>";
	}
	echo "</select>";
?>
</div>
<div id="sessions" class="asd">
	Sesión:<select name="session" id="session">
		<option> </option>
	</select>
</div>
<input type="submit" value="Pasar lista">
</form>
	
</section>
<section id="list">
	
</section>
<br> <br>
<input type="submit" id="registrarlista" value="Registrar">
</form>
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
	$('#curso').change(function (){
		$("#list").html("");
		var curso = $("#curso").val();
		var data = "curso=" + curso;
		$.ajax({
			url: "../../php/sessionfill.php",
			data: data,
			type:'POST',
			success: function (data){
				$("#sessions").html(data);
			}

		});

	});

	$("#courseinfo").on("submit", function (e){
		e.preventDefault();
		$("#list").html("");
		var data = $("#courseinfo").serialize();

		$.ajax({
			url: "../../php/listfill.php",
			data: data,
			type:'POST',
			success: function (data){
				$("#list").html(data);
			}

		});
	});
	$("#registrarlista").on('click', function(){
		
		var inputs = document.getElementsByClassName( 'inputs' ),
		
    	asistentes  = [].map.call(inputs, function( input ) {
    		if (input.checked)
        		return input.value;

    	}).join('|');
    	var inputs = document.getElementsByClassName( 'inputs' ),
		
    	faltantes = [].map.call(inputs, function( input ) {
    		if (!input.checked)
        		return input.value;

    	}).join('|');
    	console.log(faltantes);
    	console.log(asistentes);
    	var curso = $("#curso").val();
    	var session = $("#session").val();
    	var data = "asistentes=" + asistentes + "&faltantes=" + faltantes+ "&curso=" + curso + "&session=" + session;
    	console.log(data);



    	$.ajax({
    		url: "../../php/registerasis.php",
			data:  data,
			type:'POST',
			success: function (data){
				showMessage(data, 5000);
			}   
    	});
    	
	});


</script>
</html>