<?php
session_start();

if (isset($_REQUEST["NIF"])){
    $paciente["NOMBRE"] = $_REQUEST["NOMBRE"];
    $paciente["NIF"] = $_REQUEST["NIF"];
    $paciente["NSEGSOC"] = $_REQUEST["NSEGSOC"];
    $paciente["FECHANAC"] = $_REQUEST["FECHANAC"];
    $paciente["DIRECCION"] = $_REQUEST["DIRECCION"];
    $paciente["CP"] = $_REQUEST["CP"];
    $paciente["LOCALIDAD"] = $_REQUEST["LOCALIDAD"];
    $paciente["PROVINCIA"] = $_REQUEST["PROVINCIA"];
    $paciente["TELEFONO"] = $_REQUEST["TELEFONO"];
    $paciente["MEDICOFAMILIA"] = $_REQUEST["MEDICOFAMILIA"];
    $paciente["CENTROSALUD"] = $_REQUEST["CENTROSALUD"];

    $_SESSION["paciente"] = $paciente;

    $errores=validarDatosPaciente($paciente);
    if(count($errores)>0) {
        $_SESSION["excepcion"] = $errores;
        $_SESSION["destino"]="datosPaciente.php";
        header("Location: excepcion.php");
    }

    if (isset($_REQUEST["editar"])){
        Header("Location: datosPaciente.php?verEventos=".$paciente["NIF"]);
    }
    else if (isset($_REQUEST["grabar"])) Header("Location: accion_modificar_paciente.php");
}
else
    Header("Location: datosPaciente.php");

function validarDatosPaciente($paciente){
    $errores = array();
    if(empty($paciente["NOMBRE"]) || $paciente["NOMBRE"]=="") {
        $errores[] = "<p>El nombre no puede estar vacío.</p>";
    }
    if(empty($paciente["NIF"]) || $paciente["NIF"]=="") {
        $errores[] = "<p>El NIF no puede estar vacío.</p>";
    }
    if(empty($paciente["NSEGSOC"]) || $paciente["NSEGSOC"]=="") {
        $errores[] = "<p>El número de seguridad social no puede estar vacío.</p>";
    }
    if(empty($paciente["FECHANAC"]) || $paciente["FECHANAC"]=="") {
        $errores[] = "<p>La fecha de nacimiento no puede estar vacía.</p>";
    }
    return $errores;
}

?>
