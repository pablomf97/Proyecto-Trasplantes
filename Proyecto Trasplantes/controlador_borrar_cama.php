<?php
session_start();

    $cama["NIF"] = $_REQUEST["cama"];

    $_SESSION["cama"] = $cama;

    Header("Location: accion_borrar_cama.php");
?>