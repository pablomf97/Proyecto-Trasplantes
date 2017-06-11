<?php
session_start();
if (isset($_SESSION["formulario"])) {
	$formulario["valorFiltro"] = $_REQUEST["valorFiltro"];
	$formulario["filtro"] = $_REQUEST["filtro"];
	$_SESSION["formulario"] = $formulario;
	$errores = validarDatosBusqueda($formulario);
} else {
	Header("Location:vistaPrincipal.php");
}

if (count($errores) > 0) {
	$_SESSION["errores"] = $errores;
	Header("Location:form_buscar_eventos.php");
} else if (($formulario["filtro"] == "nif" || $formulario["filtro"] == "nhc")) {
	Header("Location:consulta_cama.php");
}

function validacionDeConsulta($formulario) {
	if (empty($formulario["valorFiltro"])) {
		$errores[] = "<p>El valor del filtro no puede estar vacío</p>";
	} else if ((!preg_match("/^[0-9]{8}[A-Z]$/", $formulario["valorFiltro"])) && $formulario["filtro"] == "nif") {
		$errores[] = "<p>El NIF debe contener 8 números y una letra mayúscula: " . $formulario["valorFiltro"] . "</p>";
	} else if ((!preg_match("/^[0-9]{15}$/", $formulario["valorFiltro"])) && $formulario["filtro"] == "nhc") {
		$errores[] = "<p>El NHC debe contener 15 números: " . $formulario["valorFiltro"] . "</p>";
	}
	return $errores;
}
?>