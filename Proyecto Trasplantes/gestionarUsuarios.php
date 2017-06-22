<?php
function alta_usuario($conexion, $usuario) {
	try {
		$consulta = "CALL AÑADIR_CREADOR(:tipo, :nif, :nom, :espec, :sec, :nick, :pass)";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':tipo', $usuario["tipo"]);
		$stmt -> bindParam(':nif', $usuario["nif"]);
		$stmt -> bindParam(':nom', $usuario["nom"]);
		$stmt -> bindParam(':espec', $usuario["espec"]);
		$stmt -> bindParam(':sec', $usuario["sec"]);
		$stmt -> bindParam(':nick', $usuario["nick"]);
		$stmt -> bindParam(':pass', $usuario["pass"]);

		if ($usuario["tipo"] == "Medico") {
			$usuario["sec"] = null;
		} else if ($usuario["tipo"] == "Enfermero") {
			$usuario["espec"] = null;
			$usuario["sec"] = null;
		} else if ($usuario["tipo"] == "Laboratorio"){
			$usuario["espec"] = null;
			$usuario["nif"] = null;
			$usuario["nom"] = null;
		}

		$stmt -> execute();

		return true;
	} catch(PDOException $e) {
		return false;
		echo $e -> getMessage();
	}
}

function consultarDNIUsuario($conexion, $dni){
    try{
        $consulta = "SELECT * FROM CREADOR WHERE DNI = :nif";
        $stmt = $conexion -> prepare($consulta);
        $stmt -> bindParam(':nif', $dni);
        $stmt -> execute();
        $result = $stmt->fetch();
        return $result;
    } catch (PDOException $e){
        return $e -> getMessage();
    }
}

function consultarNick($conexion, $usuario){
    try{
        $consulta = "SELECT USUARIO FROM CREADOR WHERE USUARIO = :nick";
        $stmt = $conexion -> prepare($consulta);
        $stmt -> bindParam(':nick', $usuario);
        $stmt -> execute();
        $result = $stmt -> fetch();
        return $result;
} catch(PDOException $e){
        return $e -> getMessage();
    }
}

function consultarUsuario($conexion, $usuario, $pass) {
	$consulta = "SELECT COUNT(*) AS TOTAL FROM CREADOR WHERE USUARIO=:usuario AND PASS=:pass";
	$stmt = $conexion -> prepare($consulta);
	$stmt -> bindParam(':usuario', $usuario);
	$stmt -> bindParam(':pass', $pass);
	$stmt -> execute();
	return $stmt -> fetchColumn();
}

function validar_dni($dni){
    $letra = substr($dni, -1);
    $numeros = substr($dni, 0, -1);
    if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 ){
        $result = 'valido';
    }else{
        $result = 'no valido';
    }
    return $result;
}
?>