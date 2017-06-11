<?php
     /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión     			 
     * #	de eventos de la capa de acceso a datos 		
     * #==========================================================#
     */

     
     
function consultarNHC($conexion, $nif) {
	try {
		$consulta = "SELECT NHC FROM HISTORIA_CLINICA"
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

function consultarTodosEventos2($conexion, $valorFiltro) {
  try{
      $nhc=consultarNHC($conexion,$valorFiltro);
      $consulta = "SELECT * FROM EVENTO"
        . " WHERE (NHC = :w_nhc)";
      $stmt=$conexion->prepare($consulta);
      $stmt->bindParam(':w_nhc',$nhc['NHC']);
    
    $stmt->execute();
      return $stmt;
  }catch(PDOException $e) {
    return $e->getMessage();
    }
  
}
     
     
function consultarTodosEventos($conexion, $filtro, $valorFiltro) {
	try{
		$nhc;	
		if($filtro=="nif"){
			$nhc=consultarNHC($conexion,$valorFiltro);
			$consulta = "SELECT * FROM EVENTO"
			  . " WHERE (NHC = :w_nhc)";
			$stmt=$conexion->prepare($consulta);
			$stmt->bindParam(':w_nhc',$nhc['NHC']);
		}else{
			$consulta = "SELECT * FROM EVENTO"
				  . " WHERE (NHC = :w_nhc)";
			$stmt=$conexion->prepare($consulta);
			$stmt->bindParam(':w_nhc',$valorFiltro);
		}
		$stmt->execute();
    	return $stmt;
	}catch(PDOException $e) {
		return $e->getMessage();
    }
	
}

function consultarEventosPorTipo($conexion, $nhc, $tipoevento) {
	try{
		$consulta = "SELECT * FROM EVENTO"
			  . " WHERE (NHC = :w_nhc)AND(TIPOEVENTO = :w_tipoevento)";
	
	    $stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':w_nhc',$nhc['NHC']);
		$stmt->bindParam(':w_tipoevento',$tipoevento);
		$stmt->execute();
		
    	return $stmt;
	}catch(PDOException $e) {
		return $e->getMessage();
    }
}

////////////////////////PARA LA CREACION DE EVENTOS//////////////////////////////////

 function getOID_C($conexion){
 try{
  $consulta = "SELECT OID_C FROM CREADOR WHERE (USUARIO= :usuario_nick)";
  $stmt = $conexion -> prepare($consulta);
  $stmt -> bindParam(':usuario_nick', $_SESSION['login']);
  $stmt -> execute();
  $result = $stmt -> fetch();
  return $result;
 }catch(PDOException $e) {
  return $e -> getMessage();
}
}
 
 function modificarEvento($conexion, $oide, $tipo, $fechasuceso, $fechafinsuceso, $comentarios) {
 try {
  $stmt = $conexion ->prepare('CALL ACTUALIZAR_EVENTO(:oide, :tipo, :fechasuceso, :fechafinsuceso, :comentarios)');
  $stmt -> bindParam(':oide', $oide);
  $stmt -> bindParam(':tipo', $tipo);
  $stmt -> bindParam(':fechasuceso', $fechasuceso);
  $stmt -> bindParam(':fechafinsuceso', $fechafinsuceso);
  $stmt -> bindParam(':comentarios', $comentarios);
  $stmt -> execute();
  return "";
 } catch(PDOException $e) {
  return $e -> getMessage();
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
 
 function crearCama($conexion, $numero, $paciente, $habitacion) {
    try {
      $oidh=getOID_H($conexion, $habitacion);
      $stmt=$conexion->prepare('CALL ASIGNAR_CAMA(:w_numero,
            :w_nif, :w_oidh');
      $stmt->bindParam(':w_nif',$cama["paciente"]);
      $stmt->bindParam(':w_numero',$cama["numero"]);
      $stmt->bindParam(':w_oidh',$oidh['OID_H']);
      $stmt->execute();
      return true;
    } catch(PDOException $e) {
      return $e->getMessage();
      }
  }
 
 function consultarEvento($conexion, $oid) {
  try{
    $consulta = "SELECT * FROM EVENTO"
        . " WHERE (OID_E = :w_oid)";
  
      $stmt=$conexion->prepare($consulta);
    $stmt->bindParam(':w_oid',$oid);
  
    $stmt->execute();
    $result = $stmt -> fetch();
  return $result;
    }catch(PDOException $e) {
    return $e->getMessage();
    }
}
 
function crearEvento($conexion, $evento) {
 try {
  $oid_c = getOID_C($conexion);
  $result = $oid_c['OID_C'];
  $consulta = "CALL CREAR_EVENTO(:tipo, to_date(:fechasuceso, 'dd/mm/yy hh24:mi:ss'),to_date(:fechafinsuceso, 'dd/mm/yy hh24:mi:ss'),:comentarios,:nhc,CAST(:oid_c AS INTEGER))";

  $stmt = $conexion -> prepare($consulta);
  
  $stmt -> bindParam(':tipo', $evento["tipoevento"]);
  
  $stmt -> bindParam(':fechasuceso', $evento["fechasuceso"]);
  $stmt -> bindParam(':fechafinsuceso', $evento["fechafinsuceso"]);
  $stmt -> bindParam(':comentarios', $evento["comentarios"]);
  $stmt -> bindParam(':nhc', $evento["nhc"]);
  $stmt -> bindParam(":oid_c", $result);
  $stmt -> execute();

  return true;
 } catch (PDOException $e) {
  $e -> getMessage();
  return $e;
 }
}

?>