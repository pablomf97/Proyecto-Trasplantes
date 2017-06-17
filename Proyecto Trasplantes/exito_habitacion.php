<?php session_start();

if(!isset($_SESSION['login'])){
    Header("Location: login.php");
}

require_once ("gestionBD.php");
require_once ("gestionar_HabitacionCama.php");

//Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION["formulario"])) {
    $hab = $_SESSION["formulario"];
    $_SESSION["formulario"] = null;
    $_SESSION["errores"] = null;
} else
    Header("Location: anyadir_habitacion.php");

$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Proyecto Trasplantes</title>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/about.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js"></script>
    <script type="text/javascript" src="code.js"></script>

</head>

<body>
<div class="columnas">
    <div class="cabecera">
        <?php
        include_once ("header.php");
        ?>
    </div>
    <div id="d1" style="width: 100%; z-index: 100000; postion:relative; background-color:white; padding:1%">
        <a id="close" style="margin-left:5%" class="" onClick="javascript:close_clip()"><img src="images/burger.png" width="40" /></a>
    </div>
    <div class="menu">
        <?php
        include_once ("menu.php");
        ?>
    </div>
    <div>
        <?php if (crear_habitacion($conexion, $hab) === true) {
            ?>
            <h1>Habitación creada</h1>
            <div >
                Pulsa <a href="about.php">aquí</a> para acceder a la información sobre los desarrolladores.
            </div>
        <?php } else { ?>
            <h1>Error al crear habitación.</h1>
            <div>
                Pulsa <a href="anyadir_habitacion.php">aquí</a> para volver al formulario.
            </div>
        <?php } ?>
    </div>
    <?php
    include_once ("footer.php");
    cerrarConexionBD($conexion);
    ?>
</div>
</body>
</html>