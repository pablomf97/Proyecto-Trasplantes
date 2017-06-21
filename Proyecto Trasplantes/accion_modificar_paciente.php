<?php
session_start();

if (isset($_SESSION["paciente"])) {
    $paciente = $_SESSION["paciente"];
    unset($_SESSION["paciente"]);

    require_once("gestionBD.php");
    require_once("gestionarPaciente.php");

    $conexion = crearConexionBD();
    if(isset($_SESSION["nuevo"]) and $_SESSION["nuevo"]===TRUE){
        $excepcion = nuevo_paciente($conexion,$paciente);
        unset($_SESSION["nuevo"]);
    }else{
        $excepcion = modificar_paciente($conexion,$paciente);
        unset($_SESSION["nuevo"]);
    }
    cerrarConexionBD($conexion);

    if ($excepcion<>"") {
        $_SESSION["excepcion"] = $excepcion;
        $_SESSION["destino"] = "datosPaciente.php";
        Header("Location: excepcion.php");
    }
    else
        Header("Location: datosPaciente.php?verEventos=".$paciente["NIF"]);
}
else Header("Location: datosPaciente.php"); // Se ha tratado de acceder directamente a este PHP
?>
