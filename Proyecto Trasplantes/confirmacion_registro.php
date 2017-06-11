<?php
session_start();

require_once ("gestionBD.php");

// ¿Hemos llegado a esta página mediante el formulario?
if (isset($_SESSION["formulario"])) {
	//Recogemos los datos rellenados anteriormente
	$nuevoUsuario["tipo"] = $_REQUEST["tipo"];
	$nuevoUsuario["nom"] = $_REQUEST["nom"];
	$nuevoUsuario["nif"] = $_REQUEST["nif"];
	$nuevoUsuario["sec"] = $_REQUEST["sec"];
	$nuevoUsuario["espec"] = $_REQUEST["espec"];
	$nuevoUsuario["nick"] = $_REQUEST["nick"];
	$nuevoUsuario["pass"] = $_REQUEST["pass"];
	$nuevoUsuario["confirmpass"] = $_REQUEST["confirmpass"];

} else {//Si no, vamos de regreso al formulario de registro
	Header("Location: registro.php");
}

//Guardamos la variable local con los datos anteriores
$_SESSION["formulario"] = $nuevoUsuario;

//Procedemos a la validación

try {
	$conexion = crearConexionBD();
	$errores = validarDatosUsuario($conexion, $nuevoUsuario);
	cerrarConexionBD($conexion);
} catch(PDOException $e) {
	// Mensaje de depuración
	$_SESSION["errores"] = "<p>ERROR en la validación: fallo en el acceso a la base de datos.</p><p>" . $e -> getMessage() . "</p>";
	Header('Location: registro.php');
}

// Si se han detectado errores
if (count($errores) > 0) {
	// Guardo en la sesión los mensajes de error y volvemos al formulario
	$_SESSION["errores"] = $errores;
	Header('Location: registro.php');
} else
	// Si todo va bien, vamos a la página de éxito (inserción del usuario en la base de datos)
	Header('Location: exito_registro.php');

/**************PROCESO DE VALIDACIÓN****************/

function validarDatosUsuario($conexion, $nuevoUsuario) {
	$errores = array();

	//*******************TIPO
	if ($nuevoUsuario["tipo"] != "Medico" && $nuevoUsuario["tipo"] != "Enfermero" && $nuevoUsuario["tipo"] != "Laboratorio") {
		$errores[] = "<p>El tipo de creador debe ser médico, enfermero, o laboratorio.</p>";
	}

	//*******************NIF
	if ($nuevoUsuario["tipo"] == "Medico" || $nuevoUsuario["tipo"] == "Enfermero") {
		if ($nuevoUsuario["nif"] == "") {
			$errores[] = "<p>El DNI no puede estar vacío.</p>";
		} else if (!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoUsuario["nif"])) {
			$errores[] = "<p>El DNI debe tener 8 números, seguidos de una letra mayúscula.</p>";
		}
	}
	//******************NOMBRE
	if ($nuevoUsuario["tipo"] == "Medico" || $nuevoUsuario["tipo"] == "Enfermero") {
		if ($nuevoUsuario["nom"] == "") {
			$errores[] = "<p>El nombre no puede estar vacío.</p>";
		}
	}
	//******************USUARIO
	if (strlen($nuevoUsuario["nick"]) > 25) {
		$errores[] = "<p>La longitud del nombre de usuario no puede ser mayor de 25 caracteres.</p>";
	}

	//******************CONTRASEÑA
	if (strlen($nuevoUsuario["pass"]) < 8) {
		$errores[] = "<p>La longitud de la contraseña debe ser de 8 caracteres.</p>";
	} else if (!preg_match("/[a-z]+/", $nuevoUsuario["pass"]) || !preg_match("/[A-Z]+/", $nuevoUsuario["pass"]) || !preg_match("/[0-9]+/", $nuevoUsuario["pass"])) {
		$errores[] = "<p>La contraseña debe tener al menos una mayúscula, una minúscula, y un dígito.</p>";
	} else if ($nuevoUsuario["pass"] != $nuevoUsuario["confirmpass"]) {
		$errores[] = "<p>Las contraseñas no coinciden</p>";
	}

	return $errores;
}
?>