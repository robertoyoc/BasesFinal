<?php
	session_start();
	if(is_null($_SESSION['perfil'])||$_SESSION['perfil']=='instr')
		header("Location: ../../");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Control de Asistencia</title>
	<link rel="stylesheet" type="text/css" href="../css/alumnos.css">
	<link rel="shorcout icon" href="../img/notebook.png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
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
<section class="container">
	<section class="initial-data">
		<h3>Registrar nuevo alumno</h3>
		<form id="studentregister">
			<p>Nombre (s): </p> <input type="text" id="f_name" name="nombre" required><br>
  			<p>Apellido Paterno:</p>  <input type="text" id="ap_pat" name="ap_pat" required><br>
  			<p>Apellido Materno:</p>  <input type="text" id="ap_mat" name="ap_mat" required><br>
  			<p>Matrícula:</p>  <input type="text" id="matricula" name="matricula" required=""><br><br>
  			<input type="submit" value="Registrar">
  		</form>
	</section>
	<section class="initial-data">
		<h3>Modificar información del alumno </h3>
		<form id="studentsearch">
  			<p>Matrícula:</p>  <input type="text" id="findmatricula" name="matricula" required="">
  			<input type="submit" value="Buscar">
  		</form>
  		<br>
  		<form id="studentmodify">
  			<p>Nombre (s): </p> <input type="text" id="rf_name" name="nombre" ><br>
  			<p>Apellido Paterno:</p>  <input type="text" id="rap_pat" name="ap_pat"><br>
  			<p>Apellido Materno:</p>  <input type="text" id="rap_mat" name="ap_mat"><br>
  			<p>Matrícula:</p>  <input type="text" id="rmatricula" name="matricula" readonly=""><br><br>
  			<input type="button" id="studentdelete" value="Borrar">
  			<input type="button" id="studentupdate" value="Actualizar">
  		</form>
	</section>

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

$("#studentregister").on('submit', function (e){
	e.preventDefault();
	var mat = document.getElementById('matricula').value;
	var tamaño = mat.length;
	if(tamaño+1!=10){
		showMessage("La matricula debe tener una extensión de 10 caracteres", 3000);
	}
	else{
		var JSONdata = $("#studentregister").serializeArray();
		console.log(JSONdata);
		$("#f_name").val('');
		$("#ap_pat").val('');
		$("#ap_mat").val('');
		$("#matricula").val('');
		$.ajax({
		url: "../../php/studentregister.php",
		type: "POST",		
		data: JSONdata,
		dataType: 'JSON',
		success: function (data){
			showMessage(data.status, 3000);
		}
		});

	}

});
$("#studentsearch").on('submit', function (e){
	e.preventDefault();
	var mat = document.getElementById('findmatricula').value;
	var tamaño = mat.length;
	if(tamaño+1!=10){
		showMessage("La matricula debe tener una extensión de 10 caracteres", 3000);
	}
	else{
		var JSONdata = $("#studentsearch").serializeArray();
		$("#findmatricula").val('');
		
		$.ajax({
		url: "../../php/studentsearch.php",
		type: "POST",		
		data: JSONdata,
		dataType: 'JSON',
		success: function (data){
			if(data.status=="Encontrado"){
				$("#rmatricula").val(data.matricula);
				$("#rf_name").val(data.nombre);
				$("#rap_pat").val(data.ap_pat);
				$("#rap_mat").val(data.ap_mat);
			}
			showMessage(data.status, 3000);
		}
		});

	}

});
$("#studentdelete").on('click', function (e){
		var JSONdata = $("#studentmodify").serializeArray();
		
		$.ajax({
		url: "../../php/studentdelete.php",
		type: "POST",		
		data: JSONdata,
		dataType: 'JSON',
		success: function (data){
			$("#rmatricula").val('');
			$("#rf_name").val('');
			$("#rap_pat").val('');
			$("#rap_mat").val('');
			showMessage(data.status, 3000);
		}
		});

});
$("#studentupdate").on('click', function (e){
		var JSONdata = $("#studentmodify").serializeArray();
		
		$.ajax({
		url: "../../php/studentupdate.php",
		type: "POST",		
		data: JSONdata,
		dataType: 'JSON',
		success: function (data){
			showMessage(data.status, 3000);
		}
		});

});

</script>
</html>