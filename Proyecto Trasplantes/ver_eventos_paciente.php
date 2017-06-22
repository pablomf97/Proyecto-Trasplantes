<?php

session_start();

if(!isset($_SESSION['login'])){
		Header("Location: login.php");
	}

require_once ("gestionBD.php");
require_once ("gestionarEventos.php");
require_once ("gestionarPacientes.php");

$conexion = crearConexionBD();
$nif = $_REQUEST["verEventos"];


    $_SESSION['datosClave'] = $nif;


$nombre = consultarNombrePacienteSegunNIF($conexion, $nif);
$filas = consultarTodosEventos2($conexion, $nif);
	
//$datosPaciente = consultarPaciente($conexion, $_REQUEST["verEventos"]);

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
            <?php
			 if (isset($error)) {
				echo "<div class=\"error\">";
				echo "No existen eventos con ese filtro.";
				echo "</div>";
			 }
			?>
			<p style="text-align: center; padding-top: 50px;  margin-top:100px">
			<strong>PACIENTE:
			<?php
			  echo $nombre['NOMBRE'];
			?>
			<br><br>
			</strong></p>
			<div style="margin-left:25%; width:50%;">

            			<form style="text-align:center;" method="get" action="datosPaciente.php">
                            <input type="hidden" value="<?php echo($nif)?>" name="verEventos">
            			    <button class="btn btn-primary" style="width:100%" type="submit">Datos</button>
            			</form>
            			</div>
            <div style="overflow-x:auto; width: 50%; margin-left: 25%; margin-top: 20px">
			<table style="width: 100%" class="medico">
				<tr>
				    <th>TIPO DE EVENTO</th>
				    <th>FECHA DE CREACIÓN</th> 
				    <th>FECHA DEL EVENTO</th>
				    <th>FECHA DEL FIN DEL EVENTO</th>
				    <th>MODIFICAR</th>
  				</tr>
  				
				<?php
					
					foreach ($filas as $fila) {?>
					<tr>
					    <td><?php echo $fila['TIPOEVENTO'];?></td>
						<td><?php echo $fila['FECHACREACION'];?></td>
						<td><?php echo $fila['FECHASUCESO'];?></td>
						<td><?php echo $fila['FECHAFINSUCESO'];?></td>
						<td><form action="form_modificar_evento.php" method="GET">
              <input type="text" style="width:50px; display:none" id="oid_evento" name="oid_evento" value="<?php echo $fila['OID_E'];?>">
              <input type="submit" value="Editar" />
              </form>
            </td>
						
					</tr>
					<?php
					}
				?>
					</table>
					<div style="margin-top: 20px">
					<form action="creacionEventos.php" method="GET">
                          <input type="text" id="crearEvento" name="crearEvento" value="<?php echo $nif;?>" style="display:none">
                          <input type="submit" style="width: 100%" class="btn btn-primary" value="Crear evento" />
            </form></div>
		   </div>
			<?php
			include_once ("footer.php");
			?>
		</div>
		<?php cerrarConexionBD($conexion); ?>
	</body>
</html>
