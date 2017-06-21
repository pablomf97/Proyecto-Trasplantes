<?php
session_start();

if(!isset($_SESSION['login'])){
		Header("Location: login.php");
	}

require_once ("gestionBD.php");
require_once ("gestionarEventos.php");
require_once ("gestionarPacientes.php");
if (isset($_SESSION["formulario"])) {
	$formulario = $_SESSION["formulario"];
	unset($_SESSION["formulario"]);
	unset($_SESSION["errores"]);
} else {
	Header("Location:form_buscar_eventos.php");
}
			
$conexion = crearConexionBD();
$filas = consultarTodosEventos($conexion, $formulario["filtro"], $formulario["valorFiltro"]);
	if (count($filas)==0){
		 $error= "error";	
	}
$nif = $formulario["valorFiltro"];
$datosPaciente = consultarPaciente($conexion, $formulario["filtro"], $formulario["valorFiltro"]);
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
            		    <main>
			<?php
				if (isset($error)) {
					echo "<div class=\"error\">";
					echo "No existen eventos con ese filtro.";
					echo "</div>";
				}
			?>
			<p style="text-align: center; padding-top: 50px">
				<strong>PACIENTE:</strong>
			<?php
					echo $datosPaciente['NOMBRE'];
			?>
			</p>
			<br><br>
			<div>
             <br><br>
			 <table style="overflow-x:auto; width: 50%; margin-left:25%" class="medico">
				<tr>
				    <th>TIPO DE EVENTO</th>
				    <th>FECHA DE CREACIÓN</th> 
				    <th>FECHA DEL EVENTO</th>
				    <th>FECHA DEL FIN DEL EVENTO</th>
				    <th>OPCIONES</th>
  				</tr>
  				
				<?php
					if(isset($filas2)){
						$filasMostradas = $filas2;
					}else{
						$filasMostradas = $filas;
					}
					foreach ($filasMostradas as $fila) {?>
					<tr>
					    <td><?php echo $fila['TIPOEVENTO'];?></td>
						<td><?php echo trim($fila['FECHACREACION'], ',{0-9}');?></td>
						<td><?php echo trim($fila['FECHASUCESO'], '%:');?></td>
						<td><?php echo $fila['FECHAFINSUCESO'];?></td>
					    <td><form action="form_modificar_evento.php" method="GET">
              <input style="width:20px" type="text" id="oid_evento" name="oid_evento" value="<?php echo $fila['OID_E'];?>">
              <input type="submit" value="Editar" />
              </form>
              </td>
					</tr>
					<?php
					}
				?>
					</table>
                <form action="creacionEventos.php" method="GET" style="overflow-x:auto; width: 50%; margin-left:25%">
                    <input type="text" id="crearEvento" name="crearEvento" value="<?php echo $nif;?>" style="display:none">
                    <input type="submit" style="width: 100%" class="btn btn-primary" value="Crear evento" />
                </form>
					</div>
			<?php
			include_once ("footer.php");
			?>
		</div>
	</body>
</html>
