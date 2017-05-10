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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
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
		<h3>Registrar nuevo alumno</h3>
		<form onsubmit="return registrar()">
			<p>Nombre (s): </p> <input type="text" id="f_name" name="f_name" required><br>
  			<p>Apellido Paterno:</p>  <input type="text" id="ap_pat" name="ap_pat" required><br>
  			<p>Apellido Materno:</p>  <input type="text" id="ap_mat" name="ap_mat" required><br>
  			<p>Matrícula:</p>  <input type="text" id="matricula" name="id" required=""><br><br>
  			<input type="submit" value="Registrar">
  		</form>
	</section>
	<section id="search">
		<h3>Buscar información del alumno </h3>
		<form onsubmit=" return search()">
  			<p>Matrícula:</p>  <input type="text" id="findmatricula" name="id" required="">
  			<input type="submit" value="Buscar">
  		</form>
  		<br>
  		<form>
  			<p>Nombre (s): </p> <input type="text" id="rf_name" name="rf_name" readonly><br>
  			<p>Apellido Paterno:</p>  <input type="text" id="rap_pat" name="rap_pat" readonly><br>
  			<p>Apellido Materno:</p>  <input type="text" id="rap_mat" name="rap_mat" readonly><br>
  			<p>Matrícula:</p>  <input type="text" id="rmatricula" name="rmatricula" readonly><br><br>
  		</form>
	</section>

</section>
	<div id="message">

	</div>
	

</body>

<script type="text/javascript">
message = $("#message");
	function registrar(){
		var fname = document.getElementById('f_name').value;
		var appat = document.getElementById('ap_pat').value;
		var apmat = document.getElementById('ap_mat').value;
		var mat = document.getElementById('matricula').value;
		var tamaño = mat.length;
		if(tamaño+1!=10){
			message.html("La matrícula debe tener una extensión de 10 caracteres");
			message.css("visibility", "visible");
			setTimeout(function(){message.css("visibility", "hidden");  }, 5000);
		}
		else{
			var dataen = 'matricula=' + mat+ '&nombre=' + fname + '&ap_pat=' + appat  + '&ap_mat=' + apmat; 
			$.ajax({
			url: "../../php/studentregister.php",
			type: "POST",		
			data: dataen
			}).done(function(echo){
			if (echo != "") {
				message.html(echo);
				message.css("visibility", "visible");
				setTimeout(function(){message.css("visibility", "hidden");  }, 5000);
			}

		});
		}
	return false;
	}
	function search(){
				document.getElementById("rmatricula").value= "";
				document.getElementById("rf_name").value= "";
				document.getElementById("rap_pat").value= "";
				document.getElementById("rap_mat").value= "";
		var mat = document.getElementById('findmatricula').value;
		var tamaño = mat.length;
		if(tamaño+1!=10){
			message.html("La matrícula debe tener una extensión de 10 caracteres");
			message.css("visibility", "visible");
			setTimeout(function(){message.css("visibility", "hidden");  }, 5000);
		}
		else{
			var dataen = 'matricula=' + mat;
			$.ajax({
			url: "../../php/studentsearch.php",
			type: "POST",		
			data: dataen	
			}).done(function(echo){
			var data = echo.split(";");
			if (data.length == 4) {
				var data = echo.split(";");
				document.getElementById("rmatricula").value= data[0];
				document.getElementById("rf_name").value= data[1];
				document.getElementById("rap_pat").value= data[2];
				document.getElementById("rap_mat").value= data[3];
			}
			else{
				message.html("Alumno no encontrado");
				message.css("visibility", "visible");
				setTimeout(function(){message.css("visibility", "hidden");  }, 5000);
			}

		});
		}
	return false;
	}
</script>
</html>