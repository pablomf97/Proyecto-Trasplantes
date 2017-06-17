<?php
	session_start();
	if(!isset($_SESSION['login'])){
		Header("Location: login.php");
	}
	
	require_once("gestionBD.php");
	require_once("funcionesConsultaPaciente.php");
	
	$conexion=crearConexionBD();
    $nif = $_REQUEST["verEventos"];
	
	$fila=consultarPaciente($conexion,nif);
	if(isset($_SESSION["paciente"])){
		$paciente=$_SESSION["paciente"];
	}
	$_SESSION["nuevo"]=FALSE;
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
				<a id="close" style="margin-left:5%" class="" "><img src="images/burger.png" width="40" /></a>
				<a id="event" style="margin-right:25%" class="event" href="ver_eventos_paciente.php"><img src="images/eventview.png" width="40" /></a>
				<?php 
					if(isset($_SESSION['login'])){
						?> <a href="logout.php"><button class="sesion">Desconectar</button></a> <?php
					} else {
						?> <a href="login.php"><button class="sesion">Iniciar sesión</button></a><?php
					}
				?>
			</div>
			<div class="menu">
				<?php
				include_once ("menu.php");
				?>
			</div>
			<div class="tituloPagina">Información de paciente</div>
			<div class="col-5 col-tab-5 texto">
				<article class="paciente">
					<form method="post" action="controlador_paciente.php">
						<div class="fila_paciente">
							<div class="datos_paciente">		
								<input id="NOMBRE" name="NOMBRE"
									type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>
								<input id="NIF" name="NIF"
									type="hidden" value="<?php echo $fila["NIF"]; ?>"/>
								<input id="NSEGSOC" name="NSEGSOC"
									type="hidden" value="<?php echo $fila["NSEGSOC"]; ?>"/>
								<input id="FECHANAC" name="FECHANAC"
									type="hidden" value="<?php echo $fila["FECHANAC"]; ?>"/>
								<input id="DIRECCION" name="DIRECCION"
									type="hidden" value="<?php echo $fila["DIRECCION"]; ?>"/>
								<input id="CP" name="CP"
									type="hidden" value="<?php echo $fila["CP"]; ?>"/>
								<input id="LOCALIDAD" name="LOCALIDAD"
									type="hidden" value="<?php echo $fila["LOCALIDAD"]; ?>"/>
								<input id="PROVINCIA" name="PROVINCIA"
									type="hidden" value="<?php echo $fila["PROVINCIA"]; ?>"/>
								<input id="TELEFONO" name="TELEFONO"
									type="hidden" value="<?php echo $fila["TELEFONO"]; ?>"/>
								<input id="MEDICOFAMILIA" name="MEDICOFAMILIA"
									type="hidden" value="<?php echo $fila["MEDICOFAMILIA"]; ?>"/>
								<input id="CENTROSALUD" name="CENTROSALUD"
									type="hidden" value="<?php echo $fila["CENTROSALUD"]; ?>"/>
									
							<?php
								if (isset($paciente)) { 
									if(isset($_SESSION["nuevo"]) and $_SESSION["nuevo"]===TRUE and isset($paciente)){
										$temp=TRUE;
										?><h3>Creando nuevo paciente:</h3>
										<?php
									}?>
									<!-- Editando título -->
									<h4>Nombre: <input id="NOMBRE" name="NOMBRE" type=<?php if(isset($temp)) echo('"text"'); else echo'"hidden"'; ?> value="<?php echo $fila["NOMBRE"]; ?>"/><?php if(!isset($temp)) echo($fila["NOMBRE"]); ?>	</h4>
									<h4>NIF: <input id="NIF" name="NIF" pattern="^[0-9]{8}[A-Z]" title="Ocho dígitos seguidos de una letra mayúscula" type=<?php if(isset($temp)) echo('"text"'); else echo'"hidden"'; ?> value="<?php echo $fila["NIF"]; ?>"/><?php if(!isset($temp)) echo($fila["NIF"]); ?>	</h4>
									<h4>Nº Seguridad Social: <input id="NSEGSOC" name="NSEGSOC" type=<?php if(isset($temp)) echo('"text"'); else echo'"hidden"'; ?> value="<?php echo $fila["NSEGSOC"]; ?>"/> <?php if(!isset($temp)) echo($fila["NSEGSOC"]); ?>	</h4>
									<h4>Fecha de nacimiento: <input id="FECHANAC" pattern="[0-9]{2}/[0-9]{2}/[0-9]{2}" title="dd/mm/aa" name="FECHANAC" type=<?php if(isset($temp)) echo('"text"'); else echo'"hidden"'; ?> value="<?php echo $fila["FECHANAC"]; ?>"/><?php if(!isset($temp)) echo($fila["FECHANAC"]); ?>	</h4>
									<h4>Dirección: <input id="DIRECCION" name="DIRECCION" type="text" value="<?php echo $fila["DIRECCION"]; ?>"/>	</h4>
									<h4>Código postal: <input id="CP" name="CP" type="text" pattern="^[0-9]{5}" title="Cinco dígitos" value="<?php echo $fila["CP"]; ?>"/>	</h4>
									<h4>Localidad: <input id="LOCALIDAD" name="LOCALIDAD" type="text" value="<?php echo $fila["LOCALIDAD"]; ?>"/>	</h4>
									<h4>Provincia: <input id="PROVINCIA" name="PROVINCIA" type="text" value="<?php echo $fila["PROVINCIA"]; ?>"/>	</h4>
									<h4>Teléfono: <input id="TELEFONO" name="TELEFONO" pattern="^[0-9]{9}" title="Nueve dígitos" type="tel" value="<?php echo $fila["TELEFONO"]; ?>"/>	</h4>
									<h4>Médico de familia: <input id="MEDICOFAMILIA" name="MEDICOFAMILIA" type="text" value="<?php echo $fila["MEDICOFAMILIA"]; ?>"/>	</h4>
									<h4>Centro de salud: <input id="CENTROSALUD" name="CENTROSALUD" type="text" value="<?php echo $fila["CENTROSALUD"]; ?>"/>	</h4>
								<?php
								unset($temp);
							} else { 
								?>
									<!-- mostrando título -->
									<input id="NOMBRE" name="NOMBRE" type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>
									<div class="paciente_param"><em><?php echo $fila["NOMBRE"]; ?></em>, DNI: <em><?php echo $fila["NIF"]; ?></em></div>
									<div class="paciente_param">Número de seguridad social: <em><?php echo $fila["NSEGSOC"]; ?></em></div>
									<div class="paciente_param">Fecha de nacimiento: <em><?php echo $fila["FECHANAC"]; ?></em></div>
									<div class="paciente_param">Dirección: <em><?php echo $fila["DIRECCION"]."</em>, CP: <em>".$fila["CP"].", ".$fila["LOCALIDAD"]." (".$fila["PROVINCIA"].")"; ?></em></div>
									<div class="paciente_param">Teléfono: <em><?php echo $fila["TELEFONO"]; ?></em></div>
									<div class="paciente_param">Centro de salud: <em><?php echo $fila["CENTROSALUD"]; ?></em></div>
									<div class="paciente_param">Médico de familia: <em><?php echo $fila["MEDICOFAMILIA"]; ?></em></div>
							<?php } ?>
							</div>
							
							<div id="botones_fila">
							<?php if (isset($paciente) and ($paciente["NIF"] == $fila["NIF"])) { ?>
									<button id="grabar" name="grabar" type="submit" class="editar_fila">
										<img src="images/save.png" class="editar_fila" width="50px" height="50px" alt="Guardar modificación">
									</button>
							<?php } else {?>
									<button id="editar" name="editar" type="submit" class="editar_fila">
										<img src="images/edit.png" width="50px" height="50px" class="editar_fila" alt="Editar paciente">
									</button>
							<?php } ?>
							</div>
						</div>
					</form>
				</article>
			</div>
			<?php
			include_once ("footer.php");
			cerrarConexionBD($conexion);
			?>
		</div>
	</body>
</html>