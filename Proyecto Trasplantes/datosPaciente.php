<?php
	session_start();
	if(!isset($_SESSION['login'])){
		Header("Location: login.php");
	}
	
	require_once("gestionBD.php");
	require_once("funcionesConsultaPaciente.php");

	$conexion=crearConexionBD();
	if(isset($_REQUEST["verEventos"])) {
        $nif = $_REQUEST["verEventos"];
        $fila = consultarPaciente($conexion, $nif);
        $_SESSION["nuevo"] = FALSE;
    }else {
        $_SESSION["nuevo"] = TRUE;
        $fila = null;
    }

	if(isset($_SESSION["paciente"])){
		$paciente=$_SESSION["paciente"];
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
	   <div class="ola">
                           <?php
                             if(isset($_SESSION['login'])){
                               ?> <a style="position:absolute; left:80%; top:30px" href="logout.php"><img src="images/on.png" width="40"></img></a><p style="position:absolute; left:55%; top:65px"><a href="logout.php"><strong>Conectado</strong></a></p><?php
                               } else {
                               ?> <a style="position:absolute; left:80%; top:30px" href="login.php"><img src="images/on.png" width="40"></img></a><p style="position:absolute; left:55%; top:65px"><a href="logout.php"><strong>No estas conectado</strong></a></p><?php					}
                               ?>
                            <a id="back"  style="position:absolute; left:2%; top:30px" onClick="window.history.back()"><img src="images/back.png" width="40" /></a>
                        </div>
	  <div class="ola">
                     <?php
                       if(isset($_SESSION['login'])){
                         ?> <a style="position:absolute; left:80%; top:30px" href="logout.php"><img src="images/on.png" width="40"></img></a><p style="position:absolute; left:55%; top:65px"><a href="logout.php"><strong>Conectado</strong></a></p><?php
                         } else {
                         ?> <a style="position:absolute; left:80%; top:30px" href="login.php"><img src="images/on.png" width="40"></img></a><p style="position:absolute; left:55%; top:65px"><a href="logout.php"><strong>No estas conectado</strong></a></p><?php					}
                         ?>
                      <a id="back"  style="position:absolute; left:2%; top:30px" onClick="window.history.back()"><img src="images/back.png" width="40" /></a>
                  </div>
			<div class="texto" id="creap" style="margin-left:25%; margin-top:140px; width:50%">
				<article class="paciente">
					<form method="post" action="controlador_paciente.php">
						<div class="fila_paciente" style="position: relative; padding:5px">
                            <?php
                            if((isset($_SESSION["nuevo"]) and $_SESSION["nuevo"]==TRUE)||isset($paciente)) {
                                ?><h3>Creando nuevo paciente:</h3>
                                <!-- Editando título -->

                                <label for="NOMBRE">Nombre:</label>
                                <input class="form-control" id="NOMBRE" name="NOMBRE"
                                                   type=<?php if(!isset($paciente)) echo('"text"'); else echo'"hidden"'; ?> value="<?php echo $fila["NOMBRE"]; ?>"/><?php if (!isset($temp)) echo($fila["NOMBRE"]); ?>

                                <label for="NIF">NIF:</label>
                                <input class="form-control" id="NIF" name="NIF" pattern="^[0-9]{8}[A-Z]"
                                                title="Ocho dígitos seguidos de una letra mayúscula"
                                                type=<?php if(!isset($paciente)) echo('"text"'); else echo'"hidden"'; ?> value="<?php echo $fila["NIF"]; ?>"/><?php if (!isset($temp)) echo($fila["NIF"]); ?>

                                 <label for="NSEGSOC">Nº Seguridad Social: </label>
                                 <input class="form-control" id="NSEGSOC" name="NSEGSOC"
                                                                type=<?php if(!isset($paciente)) echo('"text"'); else echo'"hidden"'; ?> value="<?php echo $fila["NSEGSOC"]; ?>"/> <?php if (!isset($temp)) echo($fila["NSEGSOC"]); ?>

                                 <label for="FECHANAC">Fecha de nacimiento:</label>
                                 <input class="form-control" id="FECHANAC" pattern="[0-9]{2}/[0-9]{2}/[0-9]{2}"
                                                                title="dd/mm/aa" name="FECHANAC"
                                                                type=<?php if(!isset($paciente)) echo('"text"'); else echo'"hidden"'; ?> value="<?php echo $fila["FECHANAC"]; ?>"/><?php if (!isset($temp)) echo($fila["FECHANAC"]); ?>

                                 <label for="DIRECCION">Dirección:</label>
                                 <input class="form-control" id="DIRECCION" name="DIRECCION" type="text"
                                                      value="<?php echo $fila["DIRECCION"]; ?>"/>

                                 <label for="CP">Código postal:</label>
                                 <input class="form-control" id="CP" name="CP" type="text" pattern="^[0-9]{5}"
                                                          title="Cinco dígitos" value="<?php echo $fila["CP"]; ?>"/>

                                 <label for="LOCALIDAD">Localidad:</label>
                                 <input class="form-control" id="LOCALIDAD" name="LOCALIDAD" type="text"
                                                      value="<?php echo $fila["LOCALIDAD"]; ?>"/>

                                 <label for="PROVINCIA">Provincia:</label>
                                 <input class="form-control" id="PROVINCIA" name="PROVINCIA" type="text"
                                                      value="<?php echo $fila["PROVINCIA"]; ?>"/>

                                 <label for="TELEFONO">Teléfono:</label>
                                 <input class="form-control" id="TELEFONO" name="TELEFONO" pattern="^[0-9]{9}"
                                                     title="Nueve dígitos" type="tel"
                                                     value="<?php echo $fila["TELEFONO"]; ?>"/>

                                 <label for="MEDICOFAMILIA">Médico de familia:</label>
                                 <input class="form-control" id="MEDICOFAMILIA" name="MEDICOFAMILIA" type="text"
                                                              value="<?php echo $fila["MEDICOFAMILIA"]; ?>"/>

                                 <label for="CENTROSALUD">Provincia:</label>
                                 <input class="form-control" id="CENTROSALUD" name="CENTROSALUD" type="text"
                                                            value="<?php echo $fila["CENTROSALUD"]; ?>"/>
                                <?php
                            }else{
                            ?>
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

									<!-- mostrando título -->
									<input id="NOMBRE" name="NOMBRE" type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>
									<div class="paciente_param"><em><?php echo $fila["NOMBRE"]; ?></em>, DNI: <em><?php echo $fila["NIF"]; ?></em></div>
									<div class="paciente_param">Número de seguridad social: <em><?php echo $fila["NSEGSOC"]; ?></em></div>
									<div class="paciente_param">Fecha de nacimiento: <em><?php echo $fila["FECHANAC"]; ?></em></div>
									<div class="paciente_param">Dirección: <em><?php echo $fila["DIRECCION"]."</em>, CP: <em>".$fila["CP"].", ".$fila["LOCALIDAD"]." (".$fila["PROVINCIA"].")"; ?></em></div>
									<div class="paciente_param">Teléfono: <em><?php echo $fila["TELEFONO"]; ?></em></div>
									<div class="paciente_param">Centro de salud: <em><?php echo $fila["CENTROSALUD"]; ?></em></div>
									<div class="paciente_param">Médico de familia: <em><?php echo $fila["MEDICOFAMILIA"]; ?></em></div>
							</div>
                            <?php } ?>


							<?php if ((isset($paciente) and ($paciente["NIF"] == $fila["NIF"]))||$_SESSION["nuevo"]==TRUE) { ?>
									<button id="grabar" name="grabar" type="submit" style="position:relative; left: 85%; top:-690px" class="editar_fila">
										<img src="images/save.png" class="editar_fila" width="40px" height="40px" alt="Guardar modificación">
									</button>
							<?php } else {?>
									<button id="editar" name="editar" type="submit" style="position:relative; left: 85%; top:-690px" class="editar_fila">
										<img src="images/edit.png" width="40px" height="40px" class="editar_fila" alt="Editar paciente">
									</button>
							<?php } ?>


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