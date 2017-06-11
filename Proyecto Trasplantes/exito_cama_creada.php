<?php session_start();

if(!isset($_SESSION['login'])){
		Header("Location: login.php");
	}

require_once ("gestionBD.php");
require_once ("gestionarEventos.php");

// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
// if (isset($_SESSION["formulario"])) {
// 
	// $_SESSION["formulario"] = null;
	// $_SESSION["errores"] = null;
// } else
	// Header("Location: creacionEventos.php");

$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Proyecto Trasplantes</title>
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
			<div id="d1" style="width: 100%; z-index: 100000; postion:relative; background-color:white; padding:1%">
				<a id="close" style="margin-left:5%" class="" onClick="javascript:close_clip()"><img src="images/burger.png" width="40" /></a>
			</div>
			<div class="menu">
				<?php
				include_once ("menu.php");
				?>
			</div>
			<div>
				<?php if (crearCama($conexion, $_REQUEST["numero"], $_REQUEST["paciente"], $_REQUEST["habitacion"]) === true) {
		?>
				<h1>Evento creado</h1>
				<div >	
			   		Pulsa <a href="about.php">aquí</a> para acceder a la información sobre los desarrolladores.
				</div>
		<?php } else { ?>
				<h1>Error al crear cama.</h1>
				<div>	
					Pulsa <a href="crear_cama.php">aquí</a> para volver al formulario.
					<?php 
					$var = getOID_H($conexion, $_REQUEST["habitacion"]);
					echo $var["OID_H"];
					?>
					
				</div>
		<?php } ?>
			</div>
			<?php
			include_once ("footer.php");
			cerrarConexionBD($conexion);
			?>
		</div>
	</body>
</html>