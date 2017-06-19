<?php 
	session_start();
	
	if(!isset($_SESSION['login'])){
		Header("Location: login.php");
	}
	
	require_once("gestionBD.php");
	require_once("gestionarPacientes.php");
    require_once("gestionar_HabitacionCama.php");
	$conexion = crearConexionBD();
    $filas = mostrarTodasLasCamas($conexion);
    cerrarConexionBD($conexion);
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


                                    			<div class="menu col-3 col-tab-3">
                                    				<?php
                                    				include_once ("menu.php");
                                    				?>
                                    			</div>
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
				</div>
			<div class="menu">
				<?php
				include_once ("menu.php");
				?>
			</div>
			<div class="medico">
			<div style="overflow-x:auto; width: 50%; margin-left: 25%;">
				<br><br>
				<table style="border-radius:5px; width: 100%; text-align:left; padding:5px;" class="tabla">
					<tr>
						<th>NUMERO DE CAMA</th>
						<th>NIF PACIENTE</th>
						<th>NOMBRE PACIENTE</th>
						<th>OPCIONES</th>
					</tr>
					<?php foreach($filas as $fila){
						$nif = consultarNombrePacienteSegunNIF($conexion, $fila['NIF']);
						$oidh = consultarNumeroHab($conexion, $fila['NIF'])
						?>
                    <form id="cama" class="cama" action="controlador_borrar_cama.php">
				        <tr>
					        <td><?php echo $oidh['NUMERO'];?>-<?php echo $fila['NUMERO'];?></td>
					        <td><?php echo $fila['NIF'];?></td>
					        <td><?php echo $nif['NOMBRE']?></td>
                            <input name="cama" type="hidden" value="<?php echo $fila['NIF'];?>"/>
                            <td><input id="borrar" name="submit" type="submit" class="borrar_cama" value="Eliminar"/></td>
                        </tr>
                    </form>
                    <?php }?>
				</table>
				<br>
				<br>
                <a href="crear_cama.php"><button type="submit" style="width: 100%" class="btn btn-primary">Crear cama</button></a>
			</div>
			</div>
			<?php
			include_once ("footer.php");
			?>
		</div>
	</body>
</html>