<?php 
	session_start();
	
	if(!isset($_SESSION['login'])){
		Header("Location: login.php");
	}
?>

<?php

require_once ("gestionBD.php");
require_once ("funcionesConsultaCreador.php");

$conexion = crearConexionBD();
$filas = consultarTodosLaboratorios($conexion);
cerrarConexionBD($conexion);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Laboratorios - Proyecto Trasplantes</title>
		<link rel="stylesheet" type="text/css" href="css/main.css" />
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
			<div id="d1" style="width: 100%; z-index: 100000; postion:relative; background-color:white; padding:1%">
				<a id="close" style="margin-left:5%" class="" onClick="javascript:close_clip()"><img src="images/burger.png" width="40" /></a>
			</div>
			<div id="d11">
						<?php 
					if(isset($_SESSION['login'])){
						?> <a href="logout.php"><img class="sesion" src="images/on.png" width="40"></img></a><p class="sesion2"><strong>Desconectar</strong></p><?php 
					} else {
						?> <a href="login.php"><img class="sesion" src="images/on.png" width="40"></img></a><p class="sesion2"><strong>Conectar</strong></p><?php
					}
				?>
			</div>
				<a id="back" onClick="window.history.back()"><img src="images/back.png" width="40" /></a>
			<div class="menu">
				<?php
				include_once ("menu.php");
				?>
			</div>
			<div class="medico">
				<div style="overflow-x:auto; width: 50%; margin-left: 25%;">
				<br><br>
				<table style="border-radius:5px; border-collapse: collapse; width: 100%; border: 1px solid black; text-align:left; padding:5px;" class="tabla">
					<tr><th>Sección</th>
						<th>Usuario encargado</th>
					</tr>
					<?php
						foreach ($filas as $fila) {
					?>
					<tr>
						<td><?php echo $fila['USUARIO']; ?></td><?php ?>
						<td><?php echo $fila['SECCION']; ?></td><?php ?>
					</tr>
					<?php
					}
					?>
				</table>
			</div>
			</div>
			<?php
			include_once ("footer.php");
			?>
		</div>
	</body>
</html>