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
if(strlen($_REQUEST["crearEvento"])!=15){
 $nhc = consultarNHC($conexion, $_REQUEST["crearEvento"]);
}else{
    $nhc = consultarNHC2($conexion, $_REQUEST["crearEvento"]);
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

	<div id="d1" style="padding-top:10px; width: 100%; z-index: 100000; position:relative; background-color:white;">
     <a id="close" style="margin-left:5%" class="" onClick="javascript:close_clip()"><img src="images/burger.png" width="40" /></a>

     <div id="d11">
      <?php
       if(isset($_SESSION['login'])){
       ?> <a href="logout.php"><img class="sesion" src="images/on.png" width="40"></img></a><p class="sesion2"><a href="logout.php"><strong>Desconectar</strong></a></p><?php
       } else {
       ?>
      <a href="login.php"><img class="sesion" src="images/on.png" width="40"></img></a><p class="sesion2"><a href="logout.php"><strong>Conectar</strong></a></p><?php					}
       ?>
      <a id="back" style="position:relative; top:-180px" onClick="window.history.back()"><img src="images/back.png" width="40" /></a>
     </div></div>

     <div class="menu">
	  <?php
	   include_once ("menu.php");
	  ?>
	 </div>
	  <?php
	   include_once ("menu2.php");
	  ?>
      <p id="" style="text-align:center; margin-top: 50px"><strong>CREA EVENTO</strong></p>
      <div style="margin-top:50px; margin-left: 25%; width: 50%">
      <form id="evento" action="accion_crear_evento.php">
          Tipo de evento:
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
          Fecha de suceso:
				<input type="text" class="form-control" name="fechasuceso" placeholder="dd-mm-aa hh24:mm:ss"/>
				<br />
          Fecha de fin del suceso:
				<input type="text" class="form-control" name="fechafinsuceso" placeholder="dd-mm-aa hh24:mm:ss"/>
				<br />
          Comentarios:
				<input type="text" class="form-control" name="comentarios"/>
				<br />
          NHC del paciente:
				<input type="text" class="form-control" name="nhc" value="<?php if(isset($nhc))echo $nhc['NHC'];?>"/>
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