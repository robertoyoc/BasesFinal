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
	<link rel="stylesheet" type="text/css" href="../css/usuarios.css">
	<link rel="shorcout icon" href="../img/notebook.png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
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
		<h3>Registrar nuevo administrador</h3>
		<form id="adminregister">
			<p>Usuario: </p> <input type="text" id="r_usuario" name="usuario" required><br>
  			<p>Contraseña: </p>  <input type="password" id="r_contrasena" name="contrasena" required><br><br>
  			<input type="submit" value="Registrar">
  		</form>
	</section>
	<section class="initial-data">
		<h3>Actualizar información del administrador </h3>
		<form id="adminsearch">
  			<p>Usuario:</p>  <input name="usuario" id="usuariofield" required="">
  			<input type="submit" value="Buscar">
  		</form>
  		<br>
  		<form id="adminmodify">
  			<p>Usuario: </p> <input type="text" id="u_usuario" name="usuario" readonly=""><br>
  			<p>Nueva contraseña: </p> <input type="password" id="u_contrasena" name="contrasena"><br><br>
  			<input type="button" id="admindelete" value="Borrar">
  			<input type="button" id="adminupdate" value="Actualizar">
  		</form>
	</section>

</section>
<section class="container">
	<section class="initial-data">
		<h3>Registrar nuevo instructor</h3>
		<form id="instrregister">
			<p>Usuario: </p> <input type="text" id="i_usuario" name="usuario" required><br>
			<p>Nombre completo: </p> <input type="text" id="i_nombre" name="nombre"><br>
  			<p>Contraseña: </p>  <input type="password" id="i_contrasena" name="contrasena" required>
			<p>Nómina: </p> <input type="text" id="nomina" name="nomina"><br>
  			<p>Correo:</p>  <input type="text" id="correo" name="correo" required><br><br>
  			<input type="submit" value="Registrar">
  		</form>
	</section>
	<section class="initial-data">
		<h3>Actualizar la información del instructor </h3>
		<form id="instrsearch">
  			<p>Usuario:</p>  <input name="usuario" id="instructorfield" required="">
  			<input type="submit" value="Buscar">
  		</form>
  		
  		<form id="instrmodify">
			<p>Usuario: </p> <input type="text" id="ui_usuario" name="usuario" readonly=""><br>
			<p>Nombre completo: </p> <input type="text" id="ui_nombre" name="nombre" required><br>
  			<p>Nueva contraseña: </p>  <input type="password" id="ui_contrasena" name="contrasena" required>
			<p>Nómina: </p> <input type="text" id="u_nomina" name="nomina"><br>
  			<p>Correo:</p>  <input type="text" id="u_correo" name="correo" required><br><br>
  			<input type="button" id="instrdelete" value="Borrar">
  			<input type="button" id="instrupdate" value="Actualizar">
  		</form>
	</section>

</section>
	<div id="message">

	</div>
	

</body>

<script type="text/javascript">

	var message = $("#message");

	function showMessage(text, time){
		message.text(text);
		message.css("visibility", "visible");
		setTimeout(function(){message.css("visibility", "hidden");  }, time);
	}
	
	$("#adminregister").on("submit", function (e){
		e.preventDefault();
		var JSONdata = $("#adminregister").serializeArray();
			
		$.ajax({
			url: "../../php/adminregister.php",
			type: "POST",		
			data: JSONdata,
			dataType: 'JSON',
			success: function(data){
				showMessage(data.status, 3000);
				$("#r_usuario").val('');
				$("#r_contrasena").val('');
			}
		
		})
			
	});
	$("#adminsearch").on("submit", function (e){
		e.preventDefault();
		var JSONdata = $("#adminsearch").serializeArray();

		$("#usuariofield").val("");

		$.ajax({
			url: "../../php/adminsearch.php",
			type: "POST",		
			data: JSONdata,
			dataType: 'JSON',
			success: function(data){
				if(data.status=="Encontrado"){
					$("#u_usuario").val(data.usuario);
					showMessage(data.status, 2000);
				}
				else{
					showMessage(data.status, 3000);
				}
				
			}	
		
		})
			
	});
	$("#admindelete").on("click", function(){
		var JSONdata = $("#adminmodify").serializeArray();
			
		$.ajax({
			url: "../../php/deleteuser.php",
			type: "POST",		
			data: JSONdata,
			dataType: 'JSON',
			success: function(data){
				showMessage(data.status, 3000);
				$("#u_usuario").val('');
				$("#u_contrasena").val('');
			}
		
		})

	});
	$("#adminupdate").on("click", function(){
		var JSONdata = $("#adminmodify").serializeArray();
			
		$.ajax({
			url: "../../php/adminupdate.php",
			type: "POST",		
			data: JSONdata,
			dataType: 'JSON',
			success: function(data){
				showMessage(data.status, 3000);
				$("#u_usuario").val('');
				$("#u_contrasena").val('');
			}
		
		})

	});
	$("#instrregister").on("submit", function(e){
		e.preventDefault();
		var JSONdata = $("#instrregister").serializeArray();
			
		$.ajax({
			url: "../../php/instrregister.php",
			type: "POST",		
			data: JSONdata,
			dataType: 'JSON',
			success: function(data){
				if(data.status == "Aceptado"){
					showMessage(data.msg, 3000);
					$("#nomina").val('');
					$("#i_nombre").val('');
					$("#correo").val('');
					$("#i_usuario").val('');
					$("#i_contrasena").val('');
					
				}
				else{
					showMessage(data.msg, 5000);
					$("#nomina").val('');
				}

			}
		
		})

	});
	$("#instrsearch").on("submit", function (e){
		e.preventDefault();
		var JSONdata = $("#instrsearch").serializeArray();

		$("#instructorfield").val("");

		$.ajax({
			url: "../../php/instrsearch.php",
			type: "POST",		
			data: JSONdata,
			dataType: 'JSON',
			success: function(data){
				if(data.status=="Encontrado"){
					$("#ui_usuario").val(data.usuario);
					$("#ui_nombre").val(data.nombre);
					$("#u_correo").val(data.correo);
					$("#u_nomina").val(data.nomina);
					showMessage(data.status, 2000);
				}
				else{
					showMessage(data.status, 5000);
				}
				
			}	
		
		});
			
	});
	$("#instrdelete").on("click", function(){
		var JSONdata = $("#instrmodify").serializeArray();
			
		$.ajax({
			url: "../../php/deleteuser.php",
			type: "POST",		
			data: JSONdata,
			dataType: 'JSON',
			success: function(data){
				showMessage(data.status, 3000);
				$("#ui_usuario").val('');
				$("#ui_nombre").val('');
				$("#ui_contrasena").val('');
				$("#u_correo").val('');
				$("#u_nomina").val('');
			}
		
		})

	});
	$("#instrupdate").on("click", function(){
		var JSONdata = $("#instrmodify").serializeArray();
			
		$.ajax({
			url: "../../php/instrupdate.php",
			type: "POST",		
			data: JSONdata,
			dataType: 'JSON',
			success: function(data){
				showMessage(data.status, 5000);
				$("#ui_usuario").val('');
				$("#ui_nombre").val('');
				$("#ui_contrasena").val('');
				$("#u_correo").val('');
				$("#u_nomina").val('');
			}
		
		})

	});



</script>
</html>