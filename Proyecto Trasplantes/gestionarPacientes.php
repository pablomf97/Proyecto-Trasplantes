<?php
/*
 * #===========================================================#
 * #	Este fichero contiene las funciones de gestión
 * #	de pacientes de la capa de acceso a datos
 * #==========================================================#
 */
 
 
function consultarNIF($conexion, $nhc) {
	try {
		$consulta = "SELECT NIF FROM HISTORIA_CLINICA" . " WHERE (NHC = :w_nhc)";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':w_nhc', $nhc);
		$stmt -> execute();
		$result = $stmt -> fetch();

		return $result;
	} catch(PDOException $e) {
		return $e -> getMessage();
	}
}

function consultarPaciente($conexion, $filtro, $valorFiltro) {
	try {
		if ($filtro == "nhc") {
			$nif = consultarNIF($conexion, $valorFiltro);
			$consulta = "SELECT * FROM PACIENTE" . " WHERE (NIF = :w_nif)";
			$stmt = $conexion -> prepare($consulta);
			$stmt -> bindParam(':w_nif', $nif['NIF']);
		} else {
			$consulta = "SELECT * FROM PACIENTE" . " WHERE (NIF = :w_nif)";
			$stmt = $conexion -> prepare($consulta);
			$stmt -> bindParam(':w_nif', $valorFiltro);
		}

		$stmt -> execute();
		$result = $stmt -> fetch();

		return $result;
	} catch(PDOException $e) {
		return $e -> getMessage();
	}
}

function consultarPacienteCama($conexion, $valorFiltro) {
    try {
        $consulta = "SELECT COUNT(NIF) FROM PACIENTE" . " WHERE (NIF = :w_nif)";
        $stmt = $conexion -> prepare($consulta);
        $stmt -> bindParam(':w_nif', $valorFiltro);

        $stmt -> execute();
        $result = $stmt -> fetch();

        return $result[0];
    } catch(PDOException $e) {
        return $e -> getMessage();
    }
}

function consultarPacientesConFiltro($conexion, $filtro, $valorFiltro) {
	try {

		if ($filtro == "nombre") {
			$consulta = "SELECT * FROM PACIENTE" . " WHERE NOMBRE LIKE '%$valorFiltro%'";
		} else if ($filtro == "provincia") {
			$consulta = "SELECT * FROM PACIENTE" . " WHERE PROVINCIA LIKE '%$valorFiltro%'";
		} else if ($filtro == "medicoFamilia") {
			$consulta = "SELECT * FROM PACIENTE" . " WHERE MEDICOFAMILIA LIKE '%$valorFiltro%'";
		} else if ($filtro == "centroSalud") {
			$consulta = "SELECT * FROM PACIENTE" . " WHERE CENTROSALUD LIKE '%$valorFiltro%'";
		}

		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':w_valorFiltro', $valorFiltro);
		$stmt -> execute();

		return $stmt;
	} catch(PDOException $e) {
		return $e -> getMessage();
	}
}

//CONSULTAR TODAS LAS CAMAS

function mostrarTodasLasCamas($conexion) {
	$consulta = "SELECT NUMERO, NIF FROM CAMA";
	return $conexion -> query($consulta);
}

function consultarNombrePacienteSegunNIF($conexion, $nif) {
	$consulta = "SELECT NOMBRE FROM PACIENTE WHERE NIF = :nif";
	$stmt = $conexion -> prepare($consulta);
	$stmt -> bindParam(':nif', $nif);
	$stmt -> execute();
	$result = $stmt -> fetch();
	return $result;
}

//CONSULTAR CAMA CONCRETA

function consultarOidh($conexion, $valorFiltro) {
	try {
			$consulta = "SELECT OID_H FROM CAMA WHERE NIF=:nif";
			$stmt = $conexion -> prepare($consulta);
			$stmt -> bindParam(':nif', $valorFiltro);
		$stmt -> execute();
		$result = $stmt -> fetch();
		return $result;
	} catch (PDOException $e) {
		return $e -> getMessage();
	}
}

function consultarCamaNumeroYHabitacion($conexion, $numero, $habitacion){
    $oidh=consultarOidh($conexion, $habitacion);
    try {
        $consulta = "SELECT OID_CA FROM CAMA WHERE (NUMERO=:numero AND OID_H=:oidh)";
        $stmt = $conexion -> prepare($consulta);
        $stmt -> bindParam(':numero', $numero);
        $stmt -> bindParam(':oidh', $oidh);
        $stmt -> execute();
        $result = $stmt -> fetch();
        return $result;
    } catch (PDOException $e) {
        return $e -> getMessage();
    }
}

function consultarNumeroHab($conexion, $valorFiltro) {
	try {
		$oidh = consultarOidh($conexion, $valorFiltro);
		$consulta = "SELECT NUMERO FROM HABITACION WHERE OID_H =:oid";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':oid', $oidh['OID_H']);
		$stmt -> execute();
		$result = $stmt -> fetch();
		return $result;
	} catch (PDOException $e) {
		return $e -> getMessage();
	}
}

function consultarCama($conexion, $valorFiltro) {
	try {

			$consulta = "SELECT NUMERO FROM CAMA WHERE NIF = :nif";
			$stmt = $conexion -> prepare($consulta);
			$stmt -> bindParam(':nif', $valorFiltro);
		$stmt -> execute();
		$result = $stmt -> fetch();
		return $result;
	} catch (PDOException $e) {
		return $e -> getMessage();
	}
}

function consultarCama2($conexion, $valorFiltro) {
    try {
        $consulta = "SELECT COUNT(NUMERO) FROM CAMA WHERE NIF = :nif";
        $stmt = $conexion -> prepare($consulta);
        $stmt -> bindParam(':nif', $valorFiltro);
        $stmt -> execute();
        $result = $stmt -> fetch();
        return $result[0];
    } catch (PDOException $e) {
        return $e -> getMessage();
    }
}
?>