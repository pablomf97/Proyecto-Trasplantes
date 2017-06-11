<?php
session_start();
if(!isset($_SESSION['login'])){
		Header("Location: login.php");
	}


if (!isset($_SESSION['formulario'])) {
	$formulario['valorFiltro'] = "";
	$formulario['filtro'] = "";
	$_SESSION['formulario'] = $formulario;
	// Si ya existían valores, los cogemos para inicializar el formulario
} else {
	$formulario = $_SESSION['formulario'];

}

if (isset($_SESSION["errores"])) {
	$errores = $_SESSION["errores"];
	unset($_SESSION["errores"]);
}
// Si en la sesión hay errores, los guardamos en una variable local
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
			<div id="d1" style="width: 100%; z-index: 100000; position:relative; background-color:white; padding:1%">
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
			<div id="menucss" class="menu">
				<?php
				include_once ("menu.php");
				?>
			</div>
			<div style="color:red; top: 85px; position:relative; margin-left: 58.5%">
			<?php
			if (isset($errores) && count($errores) > 0) {
				echo "<div class = error>";
				foreach ($errores as $value) {
					echo "<h5>" . $value . "<h5>";
				}
				echo "</div>";
			}
			?>
			</div>
			<form id="buscarEventos" method="get" action="accion_buscar_eventos.php">
				<p>
					<i style="color:red">Los campos obligatorios están marcados con </i><em style="color:red">*</em>
				</p>
				<label for="valorFiltro">Buscar paciente: </label>
				<input class="form-control" type="valorFiltro" name="valorFiltro" id="valorFiltro" placeholder="NIF" value="" required/>
				<br>

                <label for="filtro">Buscar por: </label>
                <select id="filtro" name="filtro">
                    <option value="nombre"<?php
					if (isset($formulario['filtro']) && $formulario['filtro'] == "nombre") {
						echo "selected";
					}
					?>>Nombre</option>
					<option value="nif" <?php
					if (isset($formulario['filtro']) && $formulario['filtro'] == "nif") {
						echo "selected";
					}
					?>>NIF</option>
					<option value="provincia"<?php
					if (isset($formulario['filtro']) && $formulario['filtro'] == "provincia") {
						echo "selected";
					}
					?>>Provincia</option>
					<option value="nhc" <?php
					if (isset($formulario['filtro']) && $formulario['filtro']=="nhc"){
						echo "selected";
					}
					?>>NHC</option>
					<option value="medicoFamilia"<?php
					if (isset($formulario['filtro']) && $formulario['filtro'] == "medicoFamilia") {
						echo "selected";
					}
					?>>Médico de familia</option>
					<option value="centroSalud" <?php
					if (isset($formulario['filtro']) && $formulario['filtro'] == "centroSalud") {
						echo "selected";
					}
					?>>Centro de Salud</option>
                  </select>

				<br>
				<br>
				</fieldset>

				<input id="sub" class="btn btn-primary" type="submit" value="Buscar" />
			</form>
			<?php
			include_once ("footer.php");
			?>
	</body>
</html>
