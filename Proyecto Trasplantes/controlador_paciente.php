<?php	
	session_start();
	
	if (isset($_REQUEST["NIF"])){
		$paciente["NOMBRE"] = $_REQUEST["NOMBRE"];
		$paciente["NIF"] = $_REQUEST["NIF"];
		$paciente["NSEGSOC"] = $_REQUEST["NSEGSOC"];
		$paciente["FECHANAC"] = $_REQUEST["FECHANAC"];
		$paciente["DIRECCION"] = $_REQUEST["DIRECCION"];
		$paciente["CP"] = $_REQUEST["CP"];
		$paciente["LOCALIDAD"] = $_REQUEST["LOCALIDAD"];
		$paciente["PROVINCIA"] = $_REQUEST["PROVINCIA"];
		$paciente["TELEFONO"] = $_REQUEST["TELEFONO"];
		$paciente["MEDICOFAMILIA"] = $_REQUEST["MEDICOFAMILIA"];
		$paciente["CENTROSALUD"] = $_REQUEST["CENTROSALUD"];
		
		$_SESSION["paciente"] = $paciente;
			
		if (isset($_REQUEST["editar"])){
			Header("Location: datosPaciente.php");
		}
		else if (isset($_REQUEST["grabar"])) Header("Location: accion_modificar_paciente.php");
	}
	else 
		Header("Location: datosPaciente.php");

?>
