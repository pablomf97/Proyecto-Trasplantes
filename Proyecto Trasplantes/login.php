<?php
	session_start();
  	
  	include_once("gestionBD.php");
 	include_once("gestionarUsuarios.php");
	
	if (isset($_POST['submit'])){
		$usuario = $_POST['nick'];
		$pass = $_POST['pass'];

		$conexion = crearConexionBD();
		$num_usuarios = consultarUsuario($conexion,$usuario,$pass);
		cerrarConexionBD($conexion);
	
		if ($num_usuarios == 0)
			$login = "error";	
		else {
			$_SESSION['login'] = $usuario;
			Header("Location: about.php");
		}	
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Login - Proyecto Trasplantes</title>
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<link rel="stylesheet" type="text/css" href="css/about.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js"></script>
		<script type="text/javascript" src="code.js"></script>

	</head>

	<body>
		<div class="columnas">
			<div class="cabecera">
				<?php
				include_once ("header.php");
				?>
			</div>
				<div id="d1" style="padding-top:10px; width: 100%; z-index: 100000; position:relative; background-color:white;">
            				<a id="close" style="margin-left:5%" class="" onClick="javascript:close_clip()"><img src="images/burger.png" width="40" /></a>


            			<div class="menu col-3 col-tab-3">
            				<?php
            				include_once ("menu.php");
            				?>
            			</div>
            			<div id="d11">
            		     <?php
            					if(isset($_SESSION['login'])){
            						?> <a href="logout.php"><img class="sesion" src="images/on.png" width="40"></img></a><p class="sesion2"><a href="logout.php"><strong>Desconectar</strong></a></p><?php
            					} else {
            						?> <a href="login.php"><img class="sesion" src="images/on.png" width="40"></img></a><p class="sesion2"><a href="logout.php"><strong>Conectar</strong></a></p><?php					}
            				?>
            				<a id="back" style="position:relative; top:-180px" onClick="window.history.back()"><img src="images/back.png" width="40" /></a>

            			</div>
            			</div>
            <div class="menu">
				<?php
				include_once ("menu.php");
				?>
			</div>
		    <main>
				<?php
				if (isset($login)) {
					echo "<div class=\"error\">";
					echo "<p22>Error, problema con la contraseña o puede no existir el usuario</p22>";
					echo "</div>";
				}
				?>
                <div id="log">
				<!-- The HTML login form -->
				<form action="login.php" method="post">
					<div>
						<label for="usuario">Usuario: </label>
						<input class="form-control" type="text" name="nick" id="usuario" />
					</div>
					<br>
					<div>
						<label for="pass">Contraseña: </label>
						<input class="form-control" type="password" name="pass" id="pass" />
					</div>
					<br>
					<input class="btn btn-primary" type="submit" name="submit" id="sub3" value="submit" />
				</form>
                <br>
				<p>
					¿No estás registrado? <a href="registro.php">¡Registrate!</a>
				</p>
				</div>
			</main>
			<?php
			include_once ("footer.php");
			?>
		</div>
	</body>
</html>