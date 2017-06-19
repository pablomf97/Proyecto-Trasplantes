<?php
session_start();

if (isset($_SESSION["cama"])) {
    $cama = $_SESSION["cama"];
    unset($_SESSION["cama"]);

    require_once("gestionBD.php");
    require_once("gestionar_HabitacionCama.php");

    $conexion = crearConexionBD();
    $return = eliminarCama($conexion, $cama["NIF"]);

    if ($return === true) {
        Header("Location: todas_camas.php");
    } else Header("Location: todas_camas.php");
    cerrarConexionBD($conexion);
}
else Header("Location: login.php"); // Se ha tratado de acceder directamente a este PHP
?>