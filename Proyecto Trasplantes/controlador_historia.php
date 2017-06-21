<?php
    session_start();
    require_once("gestionarPaciente.php");
    require_once("gestionBD.php");

    $conexion = crearConexionBD();

    if (isset($_REQUEST["nhc"])) {
        $nhc = $_REQUEST["nhc"];
        $nif = $_REQUEST["nif"];

        $return = anyadir_historia($conexion, $nif, $nhc);

        if ($return === true) {
            Header("Location: datosPaciente.php?verEventos=".$nif);
        } else {
            Header("Location: datosPaciente.php");
        }
    } else {
        Header("Location: datosPaciente.php");
    }
?>
