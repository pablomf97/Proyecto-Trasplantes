<?php
function consultarTodosPacientes($conexion) {
	$consulta = "SELECT * FROM PACIENTES";
    return $conexion->query($consulta);
}
function consultarPaciente($conexion, $nif) {
	try {
		$consulta = "SELECT * FROM PACIENTE"
				  . " WHERE (NIF = :w_nif)";
	    $stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':w_nif',$nif);
		$stmt->execute();
		$result = $stmt->fetch();
			
		return $result;
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}
function consultarDNI($conexion, $nhc) {
	try {
		$consulta = "SELECT NIF FROM HISTORIA_CLINICA"
				  . " WHERE (NIF = :w_nif)";
	    $stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':w_nif',$nhc);
		$stmt->execute();
		$result = $stmt->fetch();
		
		return $result["NIF"];
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}
function consultarNHC($conexion, $nif) {
	try {
		$consulta = "SELECT NHC FROM HISTORIA_CLINICA"
				  . " WHERE NIF = :w_nif";
	    $stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':w_nif',$nif);
		$stmt->execute();
		$result=$stmt->fetch();
    	return $result["NHC"];	
		
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}
?>