<?php
 
session_start();

if(!isset($_SESSION['login'])){
		Header("Location: login.php");
	}

require_once ("gestionBD.php");
require_once ("gestionarPacientes.php");
if (isset($_SESSION["formulario"])) {
	$formulario = $_SESSION["formulario"];
	unset($_SESSION["formulario"]);
	unset($_SESSION["errores"]);
} else {
	Header("Location:form_buscar_eventos.php");}
 
$conexion = crearConexionBD();
$filas = consultarPacientesConFiltro($conexion, $formulario["filtro"], $formulario["valorFiltro"]);
		if (count($filas)==0){
	  		$error= "error";
 		}
$consHabitacion = consultarNumeroHab($conexion, $formulario["valorFiltro"]);
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
			<div class="menu">
				<?php
				include_once ("menu.php");
				?>
			</div>
			<?php
				if (isset($error)) {
					echo "<div class=\"error\">";
					echo "No existen eventos con ese filtro.";
					echo "</div>";
				}
			?>
			<p id="pac" style="text-align: center;"><strong>PACIENTES:</strong></p>
			<div style="overflow-x:auto; width: 70%; margin-left: 15%;">
				<br><br>
				<table style="border-radius:5px; border-collapse: collapse; width: 100%; border: 1px solid black; text-align:left; padding:5px;" class="medico">
				<tr>
				    <th>NOMBRE</th>
				    <th>NIF</th> 
				    <th>LOCALIDAD</th>
				    <th>TELEFONO</th>
				    <th>MEDICOFAMILIA</th>
				    <th>CENTROSALUD</th>
				    <th>NUMERO DE CAMA</th>
				    <th>OPCIONES</th>
  				</tr>
  				
				<?php
					foreach ($filas as $fila) {
						$consCama = consultarCama($conexion, $fila['NIF']);
						$oidhabitacion = consultarOidh($conexion, $fila['NIF']);
						$habitacion = consultarNumeroHab($conexion, $fila['NIF']);
						?>
					<tr>
					    <td><?php echo $fila['NOMBRE'];?></td>
						<td><?php echo $fila['NIF'];?></td>
						<td><?php echo $fila['LOCALIDAD'];?></td>
						<td><?php echo $fila['TELEFONO'];?></td>
						<td><?php echo $fila['MEDICOFAMILIA'];?></td>
						<td><?php echo $fila['CENTROSALUD'];?></td>
						<td><?php echo $habitacion['NUMERO'];?>-<?php echo $consCama['NUMERO']?></td>
						<td>
            	 <form action="ver_eventos_paciente.php" method="GET">
                          <input type="text" id="verEventos" style="width: 55px" name="verEventos" value="<?php echo $fila['NIF'];?>" display="none">
                          <input type="submit" value="Ver eventos" />
                        </form>
                        </td>
					</tr> 
					<?php
					} ?>
					</table>
					
					
					
			<?php
			include_once ("footer.php");
			?>
		</div>
	</body>
</html>