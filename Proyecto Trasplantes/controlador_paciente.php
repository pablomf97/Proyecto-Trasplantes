<?php
session_start();

require_once("gestionBD.php");
require_once("gestionarUsuarios.php");
require_once("gestionarPacientes.php");

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
    try {
        $conexion=crearConexionBD();
        $errores=validarDatosPaciente($conexion, $paciente);
        cerrarConexionBD($conexion);
    }catch (PDOException $e){
        $_SESSION["errores"]="<p>Error en validación al entrar en BD.</p>";
        header("Location: datosPaciente.php");
    }

    if(count($errores)>0) {
        $_SESSION["errores"] = $errores;
        header("Location: datosPaciente.php");
    }

    if (isset($_REQUEST["editar"])){
        Header("Location: datosPaciente.php?verEventos=".$paciente["NIF"]);
    }
    else if(count($errores)>0) {
        $_SESSION["errores"] = $errores;
        unset($_SESSION["paciente"]);
        header("Location: datosPaciente.php");
    }
    else if (isset($_REQUEST["grabar"])) Header("Location: accion_modificar_paciente.php");
}
else
    Header("Location: datosPaciente.php");

function validarDatosPaciente($conexion, $paciente){
    $errores = array();
    // NOMBRE
    if(empty($paciente["NOMBRE"]) || $paciente["NOMBRE"]=="") {
        $errores[] = "<p>El nombre no puede estar vacío.</p>";
    }
    // DNI
    if(empty($paciente["NIF"]) || $paciente["NIF"]=="") {
        $errores[] = "<p>El NIF no puede estar vacío.</p>";
    }
    else if(!preg_match("/^[0-9]{8}[A-Z]$/", $paciente["NIF"])){
        $errores[] = "<p>El DNI debe tener 8 números, seguidos de una letra mayúscula.</p>";
    }
    else if(validar_dni($paciente["NIF"]) == 'no valido'){
        $errores[] = "<p>El NIF no tiene la letra correcta</p>";
    }
    else if(consultarPaciente($conexion, "hola", $paciente["NIF"])>0){
        $errores[] = "<p>El paciente ya existe</p>";
    }
    // NUMERO DE SS
    if(empty($paciente["NSEGSOC"]) || $paciente["NSEGSOC"]=="") {
        $errores[] = "<p>El número de seguridad social no puede estar vacío.</p>";
    }
    else if(!preg_match("/^[0-9]{12}/", $paciente["NSEGSOC"])){
        $errores[] = "<p>El número de seguridad social no tiene 12 caractéres";
    }
    // FECHA DE NACIMIENTO
    if(empty($paciente["FECHANAC"]) || $paciente["FECHANAC"]=="") {
        $errores[] = "<p>La fecha de nacimiento no puede estar vacía.</p>";
    }
    else if(!preg_match("/^[0-9]{2}\/[0-9]{2}\/[0-9]{2}$/", $paciente["FECHANAC"])){
        $errores[] = "<p><L></L>a fecha de nacimiento no cumple el formato dd/mm/aa</p>";
    }
    // CP
    if(!preg_match("/^[0-9]{5}/", $paciente["CP"])){
        $errores[] = "<p>El código postal no tiene 5 dígitos</p>";
    }
    // TELEFONO
    if(!preg_match("/^[0-9]{9}/", $paciente["TELEFONO"])){
        $errores[] = "<p>El teléfono no tiene 9 dígitos</p>";
    }
    return $errores;
}

?>