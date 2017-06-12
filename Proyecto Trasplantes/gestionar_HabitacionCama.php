<?php
function crear_habitacion($conexion, $hab) {
	try {
		$consulta = "CALL ASIGNAR_HABITACION(TO_NUMBER(:planta), TO_NUMBER(:numero))";
		$stmt =$conexion -> prepare($consulta);
		$stmt -> bindParam(':planta', $hab["planta"]);
		$stmt -> bindParam(':numero', $hab["numero"]);
		$stmt -> execute();
		return true;
	} catch (PDOException $e) {
		$e -> getMessage();
		return $e;
	}
}
function getOID_H($conexion, $habitacion){
    try{
        $consulta = "SELECT OID_H FROM HABITACION"
            . " WHERE (NUMERO = :w_numero)";
        $stmt=$conexion->prepare($consulta);
        $stmt->bindParam(':w_numero',$habitacion);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }catch(PDOException $e) {
        return $e -> getMessage();
    }
}

function crearCama($conexion, $paciente, $numero, $habitacion) {
    try {
        $oidh=getOID_H($conexion, $habitacion);
        $stmt=$conexion->prepare('CALL ASIGNAR_CAMA(:w_numero,
:w_nif, :w_oidh)');
        $stmt->bindParam(':w_nif',$paciente);
        $stmt->bindParam(':w_numero',$numero);
        $stmt->bindParam(':w_oidh',$oidh['OID_H']);
        $stmt->execute();
        return true;
    } catch(PDOException $e) {
        return $e->getMessage();
    }
}
?>