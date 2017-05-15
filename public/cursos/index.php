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
	<link rel="stylesheet" type="text/css" href="../css/cursos.css">
	<link rel="shorcout icon" href=".../img/notebook.png">
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
			echo "<p>Instructor</p><select name='instructor'>";
				while ( $fila = $resultado->fetch_assoc()){
					echo "<option value='".$fila['id']."'> ". $fila['nomina']."</option>";
				}
			echo "</select><br>"
			?>
			<input type="submit" value="Registrar">
		</form>
	</section>
	<section id="search">
		<h3>Modificar información del curso</h3>
		<form id="searchcourse">
			<p>Clave:</p><input type="text" id="clavecurso" name="clavecurso" required>
			<input type="submit" value="Buscar">
		</form>
		<br>
		<form id="modifycourse">
			<p>Nombre:</p><input type="text" name="name" id="r_name"><br>
			<p>Clave:</p><input type="text" id="r_clave" name="r_clave"><br>
			<?php
				$enlace = mysqli_connect("localhost", "proyectofinal", "kevin", "proyectofinal");

				if (!$enlace) {
			    	echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
			    	echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
			    	echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
			    	exit;
				}
				$claveins = $_GET['r_clave'];
				$query = "SELECT id, nomina FROM instructor ORDER BY id asc";
				$enlace->real_query($query);
				$resultado = $enlace->use_result();
				$query2 = "SELECT nomina FROM instructor where id = (SELECT instructor
																	FROM curso
																	WHERE clave = '$claveins')";
				$enlace->real_query($query2);
				$resultado2 = $enlace->use_result();
				echo "<p>Instructor</p>
				<select name='instructor' id='r_instructor'>";
				echo "<option value='".$resultado2."'>".$resultado2."</option>";
				while ( $fila = $resultado->fetch_assoc()){
					echo "<option value='".$fila['id']."'> ". $fila['nomina']."</option>";
				}
				echo "</select><br>"
			?>
			<input type="button" value="Actualizar" id="updatecourse"><br>
			<input type="button" value="Borrar" id="deletecourse"><br><br>
		</form>
	</section>
	<section id="inscribir">
		<h3>Inscribir alumno</h3>
		<form id="inscribiralumno">
			<p>Clave del curso:</p><input type="text" id="r_clave" name="r_clave"><br>
			<p>Matrícula del alumno:</p><input type="text" id="matricula" name="matricula"><br>
			<input type="submit" value="Inscribir">
		</form>
	</section>
	<section id="desinscribir">
		<h3>Desinscribir alumno</h3>
		<form id="desinsalumnos">
			<p>Clave del curso:</p><input type="text" id="r_clave" name="r_clave"><br>
			<p>Matrícula del alumno:</p><input type="text" id="matricula" name="matricula"><br>
			<input type="submit" value="Desinscribir">
		</form>
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

$("#desinscribir").on('submit', function(e){
	e.preventDefault();
	//checar que clave materia sea de 4 
	var JSONdata = $("#desinsalumnos").serializeArray();
	$.ajax({
		url: "../../php/coursedesinscribir.php",
		type: "POST",	
		dataType: 'JSON',
		data: JSONdata,
		success: function (data){
			if(data.status = "Desinscrito"){
				showMessage(data.msg, 5000);
			}
		}
	});
});

$("#inscribir").on('submit', function(e){
	e.preventDefault();
	//checar que clave materia sea de 4 
	var JSONdata = $("#inscribiralumno").serializeArray();
	$.ajax({
		url: "../../php/courseinscribir.php",
		type: "POST",	
		dataType: 'JSON',
		data: JSONdata,
		success: function (data){
			if(data.status = "Inscrito"){
				showMessage(data.msg, 5000);
			}
		}
	});
});

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

$("#searchcourse").on('submit', function(e){
	e.preventDefault();
	//checar que clave materia sea de 4 
	var JSONdata = $("#searchcourse").serializeArray();
	$.ajax({
		url: "../../php/coursesearch.php",
		type: "POST",	
		dataType: 'JSON',
		data: JSONdata,
		success: function (data){
			if(data.status=="Encontrado"){
					$("#r_clave").val(data.clave);
					$("#r_name").val(data.nombre);
					$("#instructor").val(data.nomina);
					showMessage(data.status, 2000);
				}
				else{
					showMessage(data.status, 3000);
				}
		}
	});
});

$("#updatecourse").on('click', function(){
	//checar que clave materia sea de 4 

	var JSONdata = $("#modifycourse").serializeArray();
	$.ajax({
		url: "../../php/courseupdate.php",
		type: "POST",	
		dataType: 'JSON',
		data: JSONdata,
		success: function (data){
			alert("");
			message.html(data);
			message.css("visibility", "visible");
			setTimeout(function(){message.css("visibility", "hidden");  }, 5000);
		},
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }   
	});
});

$("#deletecourse").on('click', function(){
	//checar que clave materia sea de 4 
	var JSONdata = $("#modifycourse").serializeArray();
	$.ajax({
		url: "../../php/coursedelete.php",
		type: "POST",	
		dataType: 'JSON',
		data: JSONdata,
		success: function (data){
			$("#r_name").val('');
			$("#r_clave").val('');
			$("#instructor").val('');
			showMessage(data.msg, 5000);
		}
	});
});
</script>
</html>