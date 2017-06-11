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

function consultarUsuario($conexion, $usuario, $pass) {
	$consulta = "SELECT COUNT(*) AS TOTAL FROM CREADOR WHERE USUARIO=:usuario AND PASS=:pass";
	$stmt = $conexion -> prepare($consulta);
	$stmt -> bindParam(':usuario', $usuario);
	$stmt -> bindParam(':pass', $pass);
	$stmt -> execute();
	return $stmt -> fetchColumn();
}
?>