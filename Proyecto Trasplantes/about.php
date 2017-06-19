<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Sobre nosotros - Proyecto Trasplantes</title>
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
			<div id="d1" style="width: 100%; z-index: 100000; position:relative; background-color:white; padding:1%">
				<a id="close" style="margin-left:5%" class="" onClick="javascript:close_clip()"><img src="images/burger.png" width="40" /></a>

			</div>
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

			<div class="col-12 col-tab-12 texto1 txtabout">
				Somos un grupo de estudiantes que ha participado en este proyecto en el que el objetivo es lograr una web para
				administrar la planta de cirugía Hepato-Bilio-Pancreática y Trasplante Hepático del Hospital Universitario Virgen
				del Rocío. En ella se podrá administrar a los distintos pacientes, los distintos episodios que les ocurren a éstos,
				las medicaciones correspondientes a cada uno de ellos, etc.
				<br>
				<br>

				En este proyecto han participado:
				<ul>
                    <li>Antonio Manuel Montaño Aguilera. (Alumno)</li>
                    <li>Peter John Cutino Mata. (Alumno)</li>
                    <li>Irene Martín Chavero. (Alumna)</li>
                    <li>Pablo Martínez Figueroa. (Alumno)</li>
                    <li>Mario Bizcocho González. (Alumno)</li>
                    <li>Miguel Ángel Gómez Bravo. (Doctor)</li>
                </ul>
			</div>
			<?php
			include_once ("footer.php");
			?>
		</div>
	</body>
</html>