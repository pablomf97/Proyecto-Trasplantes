<?php
session_start();

require_once ("gestionBD.php");

if (!isset($_SESSION['formulario'])) {
	$formulario["tipo"] = "";
	$formulario['nom'] = "";
	$formulario['nif'] = "";
	$formulario["sec"] = "";
	$formulario["espec"] = "";
	$formulario["nick"] = "";
	$formulario["pass"] = "";
	$formulario["confirmpass"] = "";

	$_SESSION['formulario'] = $formulario;

} else {
	$formulario = $_SESSION['formulario'];
}

if (isset($_SESSION["errores"])){
		$errores = $_SESSION["errores"];
		unset($_SESSION["errores"]);
	}

$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Registro - Proyecto Trasplantes</title>
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<link rel="stylesheet" type="text/css" href="css/about.css" />
		<link rel="stylesheet" type="text/css" href="css/estilo_pass.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js"></script>
		<script type="text/javascript" src="code.js"></script>
		<script type="text/javascript" src="validacion_contraseña.js"></script>
		<script type="text/javascript">
			function toggle(elemento) {
				if (elemento.value == "Medico") {
					document.getElementById("datosPersonales").style.display = "block";
					document.getElementById("nombre").style.display = "block";
					document.getElementById("dni").style.display = "block";
					document.getElementById("especialidad").style.display = "block";
					document.getElementById("seccion").style.display = "none";
					document.getElementById("usuario").style.display = "block";
					document.getElementById("password").style.display = "block";
					document.getElementById("submit").style.display = "block";

				} else {
					if (elemento.value == "Enfermero") {
						document.getElementById("datosPersonales").style.display = "block";
						document.getElementById("nombre").style.display = "block";
						document.getElementById("dni").style.display = "block";
						document.getElementById("especialidad").style.display = "none";
						document.getElementById("seccion").style.display = "none";
						document.getElementById("usuario").style.display = "block";
						document.getElementById("password").style.display = "block";
						document.getElementById("submit").style.display = "block";
					} else {
						if (elemento.value == "Laboratorio") {
							document.getElementById("datosPersonales").style.display = "block";
							document.getElementById("nombre").style.display = "none";
							document.getElementById("dni").style.display = "none";
							document.getElementById("especialidad").style.display = "none";
							document.getElementById("seccion").style.display = "block";
							document.getElementById("usuario").style.display = "block";
							document.getElementById("password").style.display = "block";
							document.getElementById("submit").style.display = "block";
						}
					}
				}
			}
			
			$(document).ready(function() {
				$("#pass").on("keyup", function() {
				// Calculo el color
				passwordColor();
			});
			});
		</script>

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
			<div class="registro">
				<form method="get" action="confirmacion_registro.php">
					<fieldset>
						<dl>
							<dt>
								<label>¿Qué tipo de creador eres?</label>
							</dt>
							<dd>
								<input class="" type="radio" name="tipo" onclick="toggle(this)" value="Medico" <?php if(isset($formulario["tipo"]) && $formulario["tipo"] == "Medico") echo ' checked ';?>">
								Medico
								<input class="" type="radio" name="tipo" onclick="toggle(this)" value="Enfermero" <?php if(isset($formulario["tipo"]) && $formulario["tipo"] == "Enfermero") echo ' checked ';?>">
								Enfermero
								<input class="" type="radio" name="tipo" onclick="toggle(this)" value="Laboratorio" <?php if(isset($formulario["tipo"]) && $formulario["tipo"] == "Laboratorio") echo ' checked ';?>">
								Laboratorio
							</dd>
						</dl>
					</fieldset>
					<div id="datosPersonales" style="display: none">
						<legend>
							<p style="margin-top:20px; margin-bottom: 3px">Datos personales:</p>
							<br>
						</legend>
					</div>
					<div id="nombre" style="display: none">
						<label for="nom">Nombre:</label>
						<input class="form-control" name="nom" type="text" size="40" value="<?php if(isset($formulario['nom'])) echo $formulario['nom'];?>"/>
					</div>
                    <br>
					<div id="dni" style="display: none">
						<label for="nif">DNI:</label>
						<input class="form-control" name="nif" type="text" size="40" value="<?php if(isset($formulario['nif'])) echo $formulario['nif'];?>"/>
					</div>
					<br>
					<div id="especialidad" style="display: none">
						<label for="especialidad">Especialidad:</label>
						<select name="espec" value="<?php if(isset($formulario['espec'])) echo $formulario['espec'];?>">
							<option value="Cirugía Hepatobiliar">Cirugía Hepatobiliar</option>
							<option value="Laparoscopia">Laparoscopia</option>
							<option value="Endocrinología">Endocrinología</option>
						</select>
						<br>
						<br>
					</div>
					<div id="seccion" style="display: none">
						<label for="seccion">Sección:</label>
						<select name="sec" value="<?php if(isset($formulario['sec'])) echo $formulario['sec'];?>">
							<option value="Hematología">Hematología</option>
							<option value="Bioquímica clínica">Bioquímica clínica</option>
							<option value="Microbiología">Microbiología</option>
							<option value="Coproparasitología">Coproparasitología</option>
							<option value="Microbiología">Microbiología</option>
							<option value="Bacteriología">Bacteriología</option>
							<option value="Inmunología">Inmunología</option>
							<option value="Hormonas">Hormonas</option>
							<option value="Marcadores tumorales">Marcadores tumorales</option>
						</select>
						<br>
					</div>
					<div id="usuario" style="display: none">
						<legend>
							<p style="margin-top:20px; margin-bottom: 3px">Datos de usuario:</p>
							<br>
						</legend>
						<label for="nick">Nombre de usuario:</label>
						<input class="form-control" name="nick" type="text" size="40" value="<?php if(isset($formulario['nick'])) echo $formulario['nick'];?>"required/>
						<br>
					</div>
					<div id="password" style="display: none">
					<label for="pswd">Password:</label>
                    <span><input id="pswd"  class="form-control" type="password" size="40" name="pswd" /></span>
						<br>
					<label for="confirmpass">Confirmar password:</label>
					<input class="form-control" name="confirmpass" type="password" size="40" required/>
					</div>
					<div id="pswd_info">
                        <h4>La contraseña debe cumplir los siguientes requisitos:</h4>
                        <ul>
                          <li id="letter" class="invalid">Por lo menos <strong>una letra</strong>
                          </li>
                          <li id="capital" class="invalid">Por lo menos <strong>una mayúscula</strong>
                          </li>
                          <li id="number" class="invalid">Por lo menos <strong>un número</strong>
                          </li>
                          <li id="length" class="invalid">Por lo menos <strong>8 carácteres</strong>
                          </li>
                        </ul>
                      </div>
					<br>
					<div id="submit" style="display:none;">
						<input id="sub2" class="btn btn-primary" type="submit" value="Enviar" />
					</div>
				</form>
			</div>
			<div style="color:red; margin-left: 38.5%">
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
			cerrarConexionBD($conexion);
			?>
		</div>
	</body>
</html>