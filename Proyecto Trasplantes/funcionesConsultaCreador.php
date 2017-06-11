<?php
function consultarTodosMedicos($conexion) {
	$consulta = "SELECT * FROM CREADOR"
		. " WHERE (CREADOR.TIPOCREADOR = 'Medico')";
    return $conexion->query($consulta);
}

function consultarTodosEnfermeros($conexion) {
	$consulta = "SELECT * FROM CREADOR"
		. " WHERE (CREADOR.TIPOCREADOR = 'Enfermero')";
	return $conexion->query($consulta);
}

function consultarTodosLaboratorios($conexion) {
	$consulta = "SELECT * FROM CREADOR"
		. " WHERE (CREADOR.TIPOCREADOR = 'Laboratorio')";
	return $conexion->query($consulta);
}
?>