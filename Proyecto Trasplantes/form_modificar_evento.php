<?php
session_start();

require_once ("gestionBD.php");
require_once ("gestionarPacientes.php");
require_once ("gestionarEventos.php");

if(!isset($_SESSION['login'])){
		Header("Location: login.php");
	}

if (!isset($_SESSION['formulario'])) {
	$formulario["tipoevento"] = "";
	$formulario['fechasuceso'] = "";
	$formulario['fechafinsuceso'] = "";
	$formulario["comentarios"] = "";
	$formulario["nhc"] = "";
    $formulario["oid_e"] = $_REQUEST["oid_evento"];
	$_SESSION['formulario'] = $formulario;

} else {
	$formulario = $_SESSION['formulario'];
}
if (isset($_SESSION["errores"])) {
	$errores = $_SESSION["errores"];
	unset($_SESSION["errores"]);
}

$conexion = crearConexionBD();

$filas = consultarEvento($conexion, $_REQUEST["oid_evento"]);
$nif = consultarNIF($conexion, $filas['NHC']);
//$datosPaciente = consultarPaciente($conexion, $_REQUEST["verEventos"]);
cerrarConexionBD($conexion);
?>

<!DOCTYPE html>
<html lang="es">
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
			<div id="modif" style="margin-left: 25%; width: 50%">
			<form id="evento" action="accion_actualiza_evento.php">
                <?php
                $fechas = substr($filas['FECHASUCESO'], 0, 17);
                $fechafs = substr($filas['FECHAFINSUCESO'], 0, 17);
                ?>
				
				<select class="form-control" name="tipoevento">
					<option value="Operacion" <?php
					if (isset($filas['TIPOEVENTO']) && $filas['TIPOEVENTO'] == "Operacion") {
						echo "selected";
					}
					?>>Operacion</option>
					<option value="Prueba" <?php
					if (isset($filas['TIPOEVENTO']) && $filas['TIPOEVENTO'] == "Prueba") {
						echo "selected";
					}
					?>>Prueba</option>
					<option value="Ingreso" <?php
					if (isset($filas['TIPOEVENTO']) && $filas['TIPOEVENTO'] == "Ingreso") {
						echo "selected";
					}
					?>>Ingreso</option>
					<option value="Eventualidad" <?php
					if (isset($filas['TIPOEVENTO']) && $filas['TIPOEVENTO'] == "Eventualidad") {
						echo "selected";
					}
					?>>Eventualidad</option>
					<option value="Deceso" <?php
					if (isset($filas['TIPOEVENTO']) && $filas['TIPOEVENTO'] == "Deceso") {
						echo "selected";
					}
					?>>Deceso</option>
					<option value="Alta" <?php
					if (isset($filas['TIPOEVENTO']) && $filas['TIPOEVENTO'] == "Alta") {
						echo "selected";
					}
					?>>Alta</option>
					<option value="Donacion" <?php
					if (isset($filas['TIPOEVENTO']) && $filas['TIPOEVENTO'] == "Donacion") {
						echo "selected";
					}
					?>>Donacion</option>
					<option value="Otro" <?php
					if (isset($filas['TIPOEVENTO']) && $filas['TIPOEVENTO'] == "Otro") {
						echo "selected";
					}
					?>>Otro</option>
					<option value="RecetaMedicacion" <?php
					if (isset($filas['TIPOEVENTO']) && $filas['TIPOEVENTO'] == "RecetaMedicacion") {
						echo "selected";
					}
					?>>RecetaMedicacion</option>
				</select>
				<br />
				<input type="text" class="form-control" name="fechasuceso" placeholder="dd-mm-aa hh24:mm:ss" value="<?php echo $fechas; ?>"/>
				<br />
				<input type="text" class="form-control" name="fechafinsuceso" placeholder="dd-mm-aa hh24:mm:ss" value="<?php echo $fechafs; ?>"/>
				<br />
				<input type="text" class="form-control" name="comentarios" placeholder="comentarios" value="<?php echo $filas['COMENTARIOS'] ?>">
				<br />
				<input type="text" class="form-control" name="nhc" placeholder="nhc" value="<?php echo $filas['NHC'] ?>"/>
                <input type="hidden" name="oid_e" value="<?php echo $filas['OID_E']?>"/>
                <input type="hidden" name="nif" value="<?php echo $nif['NIF']?>"/>
				<br />
				<input type="submit" style="width:100%" class="btn btn-primary" value="Modificar"/>
			</form>
			</div>
			<div>
				<?php
				if (isset($errores) && count($errores) > 0) {
					echo "<div class='error'>";
					foreach ($errores as $value) {
						echo "<h5>" . $value . "</h5>";
					}
					echo "</div>";
				}
				?>
			</div>
			<?php
			include_once ("footer.php");
			?>
		</div>
	</body>
</html>
