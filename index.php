<?php
	session_start();

	if(isset($_SESSION['perfil'])){
		if($_SESSION['perfil'] == "admin"){
			header("Location: public/admin");
		}
		else if($_SESSION['perfil']=='instr')
			header("Location: public/instructor");
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Control de Asistencia</title>
	<meta charset="utf-8">
	<link rel="shorcout icon" href="../../img/notebook.png">
	<link rel="stylesheet" type="text/css" href="public/css/index.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

</head>
<body>

<section id="message">
	
</section>
<form name="formulario" id="acesso" onsubmit= "return acceder()"  >

	<div class="textf">Usuario: </div><input type="text" id="usuario" name="usuario"><br><br>
	<div class="textf">Contraseña: </div><input type="password" id="password" name="password"><br><br>
	<input class="btn" type="submit" value="Iniciar" />
</form>
</body>

<script>

	function acceder(){
	message = $("#message");
		var user = document.getElementById('usuario').value;
		var pass = document.getElementById('password').value;
		var dataen = 'usuario=' + user+ '&password=' + pass; 
	$.ajax({
		url: "php/login.php",
		type: "POST",		
		data: dataen	
		}).done(function(echo){
			if (echo != "") {
				message.html(echo);
				message.css("visibility", "visible");
			} else {
				window.location.replace("");
			}
		});
	return false;
	}
</script>

</html>