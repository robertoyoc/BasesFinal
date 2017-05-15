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
	<link rel="stylesheet" type="text/css" href="../css/cursos.css">
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
		<h3>Registrar un nuevo curso</h3>
		<form onsubmit="return registrar()">
			<p>Nombre:</p><input type="text" name="name" id="name" required><br>
			<p>Carrera:</p><select id="carreras">
				<option value="IT">IT</option>
				<option value="IS">IS</option>
				<option value="CP">CP</option>
				<option value="LA">LA</option>
			</select><br>
			<p>Clave:</p><input type="text" name="id" id="clavemateria" required><br>
			


			<p>Contraseña:</p><input type="text" name="password" id="password" required><br>
			<input type="submit" value="Registrar">
		</form>
	</section>
	<section id="search">
		<h3>Buscar información del curso</h3>
		<form onsubmit="return search()">
			<p>Clave:</p><input type="text" id="findclave" name="id" required>
			<input type="submit" value="Buscar">
		</form>
		<br>
		<form>
			<p>Nombre:</p><input type="text" name="r_name" id="r_name" readonly><br>
			<p>Clave:</p><input type="text" id="r_clave" name="r_clave" readonly><br>
			<p>Instructor:</p><input type="text" name="r_instructor" id="r_instructor" readonly><br>
			<p>Contraseña:</p><input type="text" id="r_password" name="r_password" readonly><br><br>
		</form>
	</section>
	<section id="update">
		<h3>Modificar datos de un curso</h3>
		<form onsubmit="return search()">
			<p>Clave:</p><input type="text" id="findclave" name="id" required>
			<input type="submit" value="Buscar">
		</form>
		<form onsubmit="return actualizar()">
			<p>Nombre:</p><input type="text" name="r_name" id="r_name"><br>
			<p>Clave:</p><input type="text" id="r_clave" name="r_clave"><br>
			<p>Instructor:</p><input type="text" name="r_instructor" id="r_instructor"><br>
			<p>Contraseña:</p><input type="text" id="r_password" name="r_password"><br><br>
			<p>Inscribir alumno:</p><input type="text" name="matricula" id="matricula">
			<input type="submit" value="Registrar">
		</form>
	</section>
	<section id="delete">
		<h3>Eliminar un curso</h3>
		<form onsubmit="return search()">
			<p>Clave:</p><input type="text" id="findclave" name="id" required>
			<input type="submit" value="Buscar">
		</form>
		<form onsubmit="return deletecourse()">
			<p>Nombre:</p><input type="text" name="r_name" id="r_name" readonly><br>
			<p>Clave:</p><input type="text" id="r_clave" name="r_clave" readonly><br>
			<p>Instructor:</p><input type="text" name="r_instructor" id="r_instructor" readonly><br>
			<p>Contraseña:</p><input type="text" id="r_password" name="r_password" readonly><br><br>
			<input type="submit">
		</form>
		<br>
	</section>
</section>
	<div id="message">
		
	</div>
</body>
<script type="text/javascript">
message = $("#message");
	function registrar(){
		var name = document.getElementById('name').value;
		var clave = document.getElementById('carreras').value + document.getElementById('clavemateria').value;
		var instructor = document.getElementById('instructor').value;
		var password = document.getElementById('password').value;
		var tamaño = clave.length;
		if(tamaño+1!=10){
			message.html("La clave debe tener una extensión de 10 caracteres");
			message.css("visibility", "visible");
			setTimeout(function(){message.css("visibility", "hidden");  }, 5000);
		}
		else{
			var dataen = 'clave=' + clave+ '&nombre=' + name + '&instructor=' + instructor + '&password=' + password; 
			$.ajax({
			url: "../../php/courseregister.php",
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
				document.getElementById('carreras').value ="";
				document.getElementById('clavemateria').value= "";
				document.getElementById("name").value= "";
				document.getElementById("instructor").value= "";
				document.getElementById("password").value= "";
		var clave = document.getElementById('findclave').value;
		var tamaño = mat.length;
		var tamañopass = password.length;
		if(tamaño+1!=10){
			message.html("La clave debe tener una extensión de 10 caracteres");
			message.css("visibility", "visible");
			setTimeout(function(){message.css("visibility", "hidden");  }, 5000);
		}
		else{
			var dataen = 'clave=' + clave;
			$.ajax({
			url: "../../php/coursesearch.php",
			type: "POST",		
			data: dataen	
			}).done(function(echo){
			var data = echo.split(";");
			if (data.length == 4) {
				var data = echo.split(";");
				document.getElementById("r_clave").value= data[0];
				document.getElementById("r_name").value= data[1];
				document.getElementById("r_instructor").value= data[2];
				document.getElementById("r_password").value= data[3];
			}
			else{
				message.html("Curso no encontrado");
				message.css("visibility", "visible");
				setTimeout(function(){message.css("visibility", "hidden");  }, 5000);
			}

		});
		}
	return false;
	}	
	function actualizar(){
		var name = document.getElementById('name').value;
		var clave = document.getElementById('carreras').value + document.getElementById('clavemateria').value;
		var instructor = document.getElementById('instructor').value;
		var password = document.getElementById('password').value;
		var matricula = document.getElementById('matricula').value;
		var tamaño = clave.length;
		var tamañom = matricula.length;
		if(tamaño+1!=10){
			message.html("La clave debe tener una extensión de 10 caracteres");
			message.css("visibility", "visible");
			setTimeout(function(){message.css("visibility", "hidden");  }, 5000);
		}
		if(matricula == ""){
			break;
		} else if(tamañom+1!=10){
			message.html("La matrícula del alumno a registrar debe tener una extensión de 10 caracteres");
			message.css("visibility", "visible");
			setTimeout(function(){message.css("visibility", "hidden");  }, 5000);
		}
		else{
			var dataen = 'clave=' + clave+ '&nombre=' + name + '&instructor=' + instructor + '&password=' + password + '&matricula' + matricula; 
			$.ajax({
			url: "../../php/courseupdate.php",
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
</script>

</html>