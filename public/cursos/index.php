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
		<form id="courseregister">
			<p>Nombre:</p><input type="text" name="name" id="name" required><br>
			<p>Carrera:</p><select name="carrera" id="carreras">
				<option value="IT">IT</option>
				<option value="IS">IS</option>
				<option value="CP">CP</option>
				<option value="LA">LA</option>
			</select><br>
			<p>Clave:</p><input type="text" name="clavenumber" id="clavemateria" required><br>
			<?php
			$enlace = mysqli_connect("localhost", "proyectofinal", "kevin", "proyectofinal");

	if (!$enlace) {
    	echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    	echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    	echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    	exit;
	}
			$query = "SELECT id, nomina FROM instructor ORDER BY id asc";
			
			$enlace->real_query($query);
			$resultado = $enlace->use_result();
			echo "<select name='instructor'>";
				while ( $fila = $resultado->fetch_assoc()){
					echo "<option value='".$fila['id']."'> ". $fila['nomina']."</option>";
				}
			echo "</select>"
			?>
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
			<p>Contraseña:</p><input type="text" id="r_password" name="r_password"><br>
			<p>Inscribir alumno:</p><input type="text" name="imatricula" id="imatricula">
			<input type="submit" value="Inscribir"><br>
			<p>Desinscribir alumno:</p><input type="text" name="dmatricula" id="dmatricula">
			<input type="submit" value="Desinscribir"><br>
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
function showMessage(data, time){
	message.html(data);
	message.css("visibility", "visible");
	setTimeout(function(){message.css("visibility", "hidden");  }, time);
}

$("#courseregister").on('submit', function(e){
	e.preventDefault();
	//checar que clave materia sea de 4 
	var JSONdata = $("#courseregister").serializeArray();
	$.ajax({
		url: "../../php/courseregister.php",
		type: "POST",	
		dataType: 'JSON',
		data: JSONdata,
		success: function (data){
			if(data.status = "Aceptado"){
				showMessage(data.msg, 5000);
			}
		}
	});
});

	
	/*function search(){
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
		var imatricula = document.getElementById('imatricula').value;
		var dmatricula = document.getElementById('dmatricula').value;
		var tamaño = clave.length;
		var tamañoim = imatricula.length;
		var tamañodm = dmatricula.length;
		if(tamaño+1!=10){
			message.html("La clave debe tener una extensión de 10 caracteres");
			message.css("visibility", "visible");
			setTimeout(function(){message.css("visibility", "hidden");  }, 5000);
		}
		if(imatricula == ""){
			break;
		} else if(tamañoim+1!=10){
			message.html("La matrícula del alumno a registrar debe tener una extensión de 10 caracteres");
			message.css("visibility", "visible");
			setTimeout(function(){message.css("visibility", "hidden");  }, 5000);
		}
		if(dmatricula == ""){
			break;
		} else if(tamañodm+1!=10){
			message.html("La matrícula del alumno a desinscribir debe tener una extensión de 10 caracteres");
			message.css("visibility", "visible");
			setTimeout(function(){message.css("visibility", "hidden");  }, 5000);
		}
		else{
			var dataen = 'clave=' + clave+ '&nombre=' + name + '&instructor=' + instructor + '&password=' + password + '&imatricula' + matricula + 'dmatricula' + dmatricula; 
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
	function deletecourse(){
		var clave = document.getElementById('carreras').value + document.getElementById('clavemateria').value;
		var tamaño = clave.length;
		if(tamaño+1!=10){
			message.html("La clave debe tener una extensión de 10 caracteres");
			message.css("visibility", "visible");
			setTimeout(function(){message.css("visibility", "hidden");  }, 5000);
		}
		else{
			var dataen = 'clave=' + clave; 
			$.ajax({
			url: "../../php/coursedelete.php",
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
	*/
</script>

</html>