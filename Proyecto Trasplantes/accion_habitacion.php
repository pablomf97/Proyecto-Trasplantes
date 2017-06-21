<?php
session_start();
require_once("gestionar_HabitacionCama.php");
require_once("gestionBD.php");

if (isset($_SESSION["formulario"])) {
    $hab["planta"] = $_REQUEST["planta"];
    $hab["numero"] = $_REQUEST["numero"];

}else
    Header("Location: anyadir_habitacion.php");

$_SESSION["formulario"]=$hab;
try {
    $conexion=crearConexionBD();
    $errores=validarDatosHabitacion($conexion, $hab);
    cerrarConexionBD($conexion);
}catch (PDOException $e){
    $_SESSION["errores"]="<p>Error en validación al entrar en BD.</p>";
    header("Location: anyadir_habitacion.php");
}
if(count($errores)>0){
    $_SESSION["errores"]=$errores;
    header("Location: anyadir_habitacion.php");
}else{
    header("Location: exito_habitacion.php");
}


function validarDatosHabitacion($conexion, $hab){
    $errores = array();
    if($hab["planta"] < 1 || $hab["planta"] > 8){
        $errores[] = "<p>La planta debe estar comprendida entre el 1 y el 8</p>";
    }
    $sub = substr($hab["numero"],0,1);
    if($sub != $hab["planta"]){
        $errores[] = "<p>El primer dígito del número de habitación debe ser el mismo que la planta</p>";
    }
    if((getOID_H($conexion,$hab["numero"]))!= ""){
        $errores[] = "<p>Esa habitación ya está creada</p>";
    }
    return $errores;
}
?>
