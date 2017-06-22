<?php
    session_start();
    require_once("gestionarPaciente.php");
    require_once("gestionBD.php");

    if (isset($_REQUEST["nhc"])) {
        $nhc = $_REQUEST["nhc"];
        $nif = $_REQUEST["nif"];

        try {
            $conexion=crearConexionBD();
            $errores=validarNHC($conexion, $nhc);
            cerrarConexionBD($conexion);
        }catch (PDOException $e){
            $_SESSION["errores"]="<p>Error en validación al entrar en BD.</p>";
            header("Location: datosPaciente.phpverEventos=".$nif);
        }

        if(count($errores)>0) {
            $_SESSION["errores"] = $errores;
            header("Location: datosPaciente.php?verEventos=".$nif);
        }

        if (count($errores) == 0) {
            anyadir_historia($conexion, $nif, $nhc);
            Header("Location: datosPaciente.php?verEventos=".$nif);
        } else {
            Header("Location: datosPaciente.php?verEventos=".$nif);
        }
    } else {
        Header("Location: datosPaciente.php");
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function validarNHC($conexion, $nhc) {
        $errores = array();
        //VACIO O NUMERO CARACTERES
        if (empty($nhc) || $nhc == "" || !preg_match("/^[0-9]{15}/", $nhc)) {
            $errores[] = "<p>El NHC no es válido.</p>";
        }
        return $errores;
    }
?>
