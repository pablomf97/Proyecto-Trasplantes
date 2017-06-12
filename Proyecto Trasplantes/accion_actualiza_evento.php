<?php
session_start();

require_once ("gestionBD.php");

if (isset($_SESSION["formulario"])) {
    $actualizaEvento["tipoevento"] = $_REQUEST["tipoevento"];
    $actualizaEvento["fechasuceso"] = $_REQUEST["fechasuceso"];
    $actualizaEvento["fechafinsuceso"] = $_REQUEST["fechafinsuceso"];
    $actualizaEvento["comentarios"] = $_REQUEST["comentarios"];
    $actualizaEvento["nhc"] = $_REQUEST["nhc"];
    $actualizaEvento["oid_e"] = $_REQUEST["oid_e"];
    $actualizaEvento["nif"] = $_REQUEST["nif"];

} else {
    Header("Location: form_modificar_evento.php");
}

$_SESSION["formulario"] = $actualizaEvento;

try {
    $conexion = crearConexionBD();
    $errores = validarDatosEvento($conexion, $actualizaEvento);
    cerrarConexionBD($conexion);
} catch(PDOException $e) {
    // Mensaje de depuración
    $_SESSION["errores"] = "<p>ERROR en la validación: fallo en el acceso a la base de datos.</p><p>" . $e -> getMessage() . "</p>";
    Header('Location: form_modificar_evento.php');
}

// Si se han detectado errores
if (count($errores) > 0) {
    // Guardo en la sesión los mensajes de error y volvemos al formulario
    $_SESSION["errores"] = $errores;
    Header('Location: form_modificar_evento.php');
} else
    // Si todo va bien, vamos a la página de éxito (inserción del usuario en la base de datos)
    Header('Location: exito_evento_modificado.php');

function validarDatosEvento($conexion, $actualizaEvento) {

    $errores = array();

    if (strlen($actualizaEvento["nhc"]) != 15) {
        $errores[] = "<p>La longitud del NHC debe ser de 15 numeros</p>";
    }
    if (strlen($actualizaEvento["comentarios"]) > 50) {
        $errores[] = "<p>El comentario no puede superar los 50 carateres</p>";
    }

}
?>