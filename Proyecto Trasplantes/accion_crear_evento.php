<?php
session_start();

require_once ("gestionBD.php");

if (isset($_SESSION["formulario"])) {
	$nuevoEvento["tipoevento"] = $_REQUEST["tipoevento"];
	$nuevoEvento["fechasuceso"] = $_REQUEST["fechasuceso"];
	$nuevoEvento["fechafinsuceso"] = $_REQUEST["fechafinsuceso"];
	$nuevoEvento["comentarios"] = $_REQUEST["comentarios"];
	$nuevoEvento["nhc"] = $_REQUEST["nhc"];
	
} else {
	Header("Location: creacionEventos.php");
}

$_SESSION["formulario"] = $nuevoEvento;

try {
	$conexion = crearConexionBD();
	$errores = validarDatosEvento($conexion, $nuevoEvento);
	cerrarConexionBD($conexion);
} catch(PDOException $e) {
	// Mensaje de depuración
	$_SESSION["errores"] = "<p>ERROR en la validación: fallo en el acceso a la base de datos.</p><p>" . $e -> getMessage() . "</p>";
	Header('Location: creacionEventos.php');
}

// Si se han detectado errores
if (count($errores) > 0) {
	// Guardo en la sesión los mensajes de error y volvemos al formulario
	$_SESSION["errores"] = $errores;
	Header('Location: creacionEventos.php');
} else
	// Si todo va bien, vamos a la página de éxito
	Header('Location: exito_evento.php');

function validarDatosEvento($conexion, $nuevoEvento) {
	
	$errores = array();
	
	if (strlen($nuevoEvento["nhc"]) != 15) {
		$errores[] = "<p>La longitud del NHC debe ser de 15 numeros</p>";
	}
	if (strlen($nuevoEvento["comentarios"]) > 50) {
		$errores[] = "<p>El comentario no puede superar los 50 carateres</p>";
	}
	
}
?>