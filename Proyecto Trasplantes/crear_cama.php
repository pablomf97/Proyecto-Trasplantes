<?php
	session_start();
	if(!isset($_SESSION['login'])){
		Header("Location: login.php");
	}
	
	require_once("gestionBD.php");
	
	$conexion=crearConexionBD();

if (!isset($_SESSION['formulario'])) {
$formulario["numero"] = "";
$formulario['paciente'] = "";
$formulario['habitacion'] = "";

$_SESSION['formulario'] = $formulario;

} else {
    $formulario = $_SESSION['formulario'];
}

if (isset($_SESSION["errores"])){
    $errores=$_SESSION["errores"];
    unset($_SESSION["errores"]);
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
			</div>
			<div style="margin-top: 40px; font-size:20px; text-align: center"><strong>Asignar cama</strong></div>
            <div>
                <?php
                    if(isset($errores) && count($errores)>0){
                        echo "<div class='error'>";
                        foreach ($errores as $patata){
                            echo "<h5>".$patata."</h5>";
                        }
                        echo "</div>";
                    }
                ?>
            </div>
			<div style="margin-top:130px; margin-left:25%; width:50%;" class=" col-5 col-tab-5 texto">
				<form id="crearCama" method="get" action="controlador_cama.php" onsubmit="return validateForm()">
					<fieldset><legend>Datos de la cama</legend>
						<div><label for="numero">Número de cama:</label>
							<input id="numero" class="form-control" name="numero" type="number" size="3"/><br>
						</div>
						<div><label for="paciente">Paciente asociado (NIF):</label>
							<input id="paciente" class="form-control" name="paciente" type="string"/><br>
						</div>
						<div><label for="habitacion">Número de habitación:</label>
							<input id="habitacion" class="form-control" name="habitacion" type="number"/>
						</div>					
					</fieldset>
					<br>
					<div><input type="submit" class="btn btn-primary" style="width:100%" value="Enviar" /></div>
				</form>
			</div>
			<?php
			include_once ("footer.php");
			cerrarConexionBD($conexion);
			?>
		</div>
	</body>
</html>