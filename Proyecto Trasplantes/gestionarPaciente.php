<?php
	function modificar_paciente($conexion,$paciente) {
		try {
			$stmt=$conexion->prepare('CALL ACTUALIZAR_PACIENTE(:w_nif,
	          :w_dir, :w_cp, :w_localidad, :w_provincia, :w_telef, :w_medico, :w_centro)');
			$stmt->bindParam(':w_nif',$paciente["NIF"]);
			$stmt->bindParam(':w_dir',$paciente["DIRECCION"]);
			$stmt->bindParam(':w_cp',$paciente["CP"]);
			$stmt->bindParam(':w_localidad',$paciente["LOCALIDAD"]);
			$stmt->bindParam(':w_provincia',$paciente["PROVINCIA"]);
			$stmt->bindParam(':w_telef',$paciente["TELEFONO"]);
			$stmt->bindParam(':w_medico',$paciente["MEDICOFAMILIA"]);
			$stmt->bindParam(':w_centro',$paciente["CENTROSALUD"]);
			$stmt->execute();
			return "";
		} catch(PDOException $e) {
			return $e->getMessage();
	    }
	}
	function nuevo_paciente($conexion,$paciente) {
		try {
			$stmt=$conexion->prepare('CALL DATOS_PACIENTE(:w_nombre, :w_nif, :w_seg, :w_fechanac,
	          :w_dir, :w_cp, :w_localidad, :w_provincia, :w_telef, :w_medico, :w_centro)');
			$stmt->bindParam(':w_nombre',$paciente["NOMBRE"]);
			$stmt->bindParam(':w_nif',$paciente["NIF"]);
			$stmt->bindParam(':w_seg',$paciente["NSEGSOC"]);
			$stmt->bindParam(':w_fechanac',$paciente["FECHANAC"]);
			$stmt->bindParam(':w_dir',$paciente["DIRECCION"]);
			$stmt->bindParam(':w_cp',$paciente["CP"]);
			$stmt->bindParam(':w_localidad',$paciente["LOCALIDAD"]);
			$stmt->bindParam(':w_provincia',$paciente["PROVINCIA"]);
			$stmt->bindParam(':w_telef',$paciente["TELEFONO"]);
			$stmt->bindParam(':w_medico',$paciente["MEDICOFAMILIA"]);
			$stmt->bindParam(':w_centro',$paciente["CENTROSALUD"]);
			$stmt->execute();
			return "";
		} catch(PDOException $e) {
			return $e->getMessage();
	    }
	}
?>