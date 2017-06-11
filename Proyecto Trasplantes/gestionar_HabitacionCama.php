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
?>
