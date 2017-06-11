<?php
session_start();

require_once ("gestionBD.php");
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

	$_SESSION['formulario'] = $formulario;

} else {
	$formulario = $_SESSION['formulario'];
}
if (isset($_SESSION["errores"])) {
	$errores = $_SESSION["errores"];
	unset($_SESSION["errores"]);
}

$conexion = crearConexionBD();
if(isset($_REQUEST["crearEvento"])){
 $nhc = consultarNHC($conexion, $_REQUEST["crearEvento"]);
}else if(isset($_REQUEST["crearEvento1"])&&(isset($_REQUEST["crearEvento2"]))){
 if($_REQUEST["crearEvento1"]=="nif"){
  $nhc = consultarNHC($conexion, $_REQUEST["crearEvento2"]);
 }else{
  $nhc = $_REQUEST["crearEvento2"];
 }
}
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
      <p id="" style="text-align:center; margin-top: 50px"><strong>CREA EVENTO</strong></p>
      <div style="margin-top:50px; margin-left: 25%; width: 50%">
      <form id="evento" action="accion_crear_evento.php">
        <select style="text-align:center" class="form-control" name="tipoevento">
          <option value="Operacion">Operacion</option>
          <option value="Prueba">Prueba</option>
          <option value="Ingreso">Ingreso</option>
          <option value="Eventualidad">Eventualidad</option>
          <option value="Deceso">Deceso</option>
          <option value="Alta">Alta</option>
          <option value="Donacion">Donacion</option>
          <option value="Otro">Otro</option>
          <option value="RecetaMedicacion">RecetaMedicacion</option>
        </select>
				<br />
				<input type="text" class="form-control" name="fechasuceso" placeholder="dd-mm-aa hh24:mm:ss"/>
				<br />
				<input type="text" class="form-control" name="fechafinsuceso" placeholder="dd-mm-aa hh24:mm:ss"/>
				<br />
				<input type="text" class="form-control" name="comentarios"/>
				<br />
				<input type="text" class="form-control" name="nhc" value="<?php if(isset($nhc))echo $nhc['NHC']?>"/>
				<br />
				<input type="submit" class="btn btn-primary" style="width:100%" value="Crear"/>
			</form>
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