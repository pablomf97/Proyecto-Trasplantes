<?php
    session_start();
    require_once("gestionarPacientes.php");
    require_once("gestionar_HabitacionCama.php");
	require_once("gestionBD.php");
	
	if (isset($_SESSION["formulario"])) {
        $cama["numero"] = $_REQUEST["numero"];
        $cama["paciente"] = $_REQUEST["paciente"];
        $cama["habitacion"] = $_REQUEST["habitacion"];


    }else
		Header("Location: crear_cama.php");

	$_SESSION["formulario"]=$cama;
	try {
        $conexion=crearConexionBD();
        $errores=validarDatosCama($conexion,$cama);
        cerrarConexionBD();
    }catch (PDOException $e){
        $_SESSION["errores"]="<p>Error en validación al entrar en BD.</p>";
        header("Location: crear_cama.php");
    }
    if(count($errores)>0){
        $_SESSION["errores"]=$errores;
        header("Location: crear_cama.php");
    }else{
        header("Location: exito_cama_creada.php");
    }


	function validarDatosCama($conexion, $cama){
	    $errores = array();
	    if(!($cama["numero"]>=1 and $cama["numero"]<=2)){
	        $errores[]="<p>No se puede usar un número de cama distinto de 1 o 2.</p>";
        }
        if(consultarPacienteCama($conexion,$cama["paciente"])==0){
            $errores[]="<p>Este paciente no existe.</p>";
        }
        if(count(getOID_H($conexion,$cama["habitacion"]))==0){
            $errores[]="<p>Esta habitación no existe.</p>";
        }
        if((consultarCama2($conexion,$cama["paciente"]))!=0){
            $cama_asignada=consultarCama($conexion,$cama["paciente"]);
            $habitacion_cama=
            $errores[]="<p>Este paciente ya tiene cama asignada: </p>";
        }
        return $errores;
    }
?>
