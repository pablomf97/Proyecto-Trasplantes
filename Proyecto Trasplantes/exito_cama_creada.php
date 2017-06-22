<?php session_start();

if(!isset($_SESSION['login'])){
		Header("Location: login.php");
	}

require_once ("gestionBD.php");
require_once ("gestionarEventos.php");
require_once ("gestionar_HabitacionCama.php");

 //Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
 if (isset($_SESSION["formulario"])) {
     $cama = $_SESSION["formulario"];
	 $_SESSION["formulario"] = null;
	 $_SESSION["errores"] = null;
 } else
	 Header("Location: crear_cama.php");

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
				<div id="d1" style="padding-top:10px; width: 100%; z-index: 100000; position:relative; background-color:white;">
            				<a id="close" style="margin-left:5%" class="" onClick="javascript:close_clip()"><img src="images/burger.png" width="40" /></a>


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
			<?php
			include_once ("menu2.php");
			?>
			 <div class="ola">
               <?php
               if(isset($_SESSION['login'])){
               ?> <a style="position:absolute; left:80%; top:30px" href="logout.php"><img src="images/on.png" width="40"></img></a><p style="position:absolute; left:55%; top:65px"><a href="logout.php"><strong>Conectado</strong></a></p><?php
               } else {
               ?> <a style="position:absolute; left:80%; top:30px" href="login.php"><img src="images/on.png" width="40"></img></a><p style="position:absolute; left:55%; top:65px"><a href="logout.php"><strong>No estas conectado</strong></a></p><?php					}
               ?>
               <a id="back"  style="position:absolute; left:2%; top:30px" onClick="window.history.back()"><img src="images/back.png" width="40" /></a>
             </div>
			<div "text-align:center; margin-top:30px">
				<?php if (crearCama($conexion, $cama["paciente"], $cama["numero"], $cama["habitacion"]) === true) {
		?>
				<h1>Cama creada</h1>
				<div >	
			   		Pulsa <a href="todas_camas.php">aquí</a> para volver al listado de todas las camas.
				</div>
		<?php } else { ?>
				<h1>Error al crear cama.</h1>
				<div>	
					Pulsa <a href="crear_cama.php">aquí</a> para volver al formulario.
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