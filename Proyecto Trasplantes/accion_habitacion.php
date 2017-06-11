<?php
	session_start();
	
	require_once ("gestionBD.php");

if (isset($_SESSION["formulario"])) {
	$formulario["planta"] = $_REQUEST["planta"];
	$formulario["numero"] = $_REQUEST["numero"];
	$_SESSION["formulario"] = $formulario;
	Header("exito_habitacion.php");
} else {
	Header("Location: anyadir_habitacion.php");
}


?>