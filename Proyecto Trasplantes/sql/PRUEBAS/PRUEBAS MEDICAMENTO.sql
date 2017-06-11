create or replace PACKAGE PRUEBAS_MEDICAMENTO AS

    PROCEDURE inicializar;
    PROCEDURE insertar(nombre_prueba VARCHAR2, w_nombre_med VARCHAR2, salidaEsperada BOOLEAN);
    PROCEDURE actualizar(nombre_prueba VARCHAR2, w_nombre_med VARCHAR2, salidaEsperada BOOLEAN);
    PROCEDURE eliminar(nombre_prueba VARCHAR2, w_cod_med integer, salidaEsperada BOOLEAN);

END PRUEBAS_MEDICAMENTO;
/
create or replace PACKAGE BODY PRUEBAS_MEDICAMENTO AS

  PROCEDURE inicializar AS
  BEGIN
    DELETE FROM MEDICAMENTO;
  END inicializar;
  
  
  
  PROCEDURE insertar (nombre_prueba VARCHAR2, w_nombre_med VARCHAR2, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    Med MEDICAMENTO%ROWTYPE;
    w_cod_med INTEGER;
  BEGIN
    INSERT INTO MEDICAMENTO VALUES(sec_oidm.NEXTVAL, w_nombre_med, sec_oidc.CURRVAL);
    
    w_cod_med := sec_oidm.CURRVAL;
    SELECT * INTO Med FROM MEDICAMENTO WHERE OID_M = w_cod_med;
    IF (Med.NOMBRE<>w_nombre_med) THEN
      salida := false;
    END IF;
    COMMIT WORK;
    
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));
    
    EXCEPTION WHEN OTHERS THEN
      DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
      ROLLBACK;
  END insertar;
  
  
  
  PROCEDURE actualizar (nombre_prueba VARCHAR2, w_nombre_med VARCHAR2, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    Med MEDICAMENTO%ROWTYPE;
    w_cod_med INTEGER;
  BEGIN
  w_cod_med := sec_oidm.CURRVAL;
    UPDATE MEDICAMENTO SET NOMBRE = w_nombre_med WHERE OID_M = w_cod_med;
    
  SELECT * INTO Med FROM MEDICAMENTO WHERE OID_M = w_cod_med;
  IF(Med.NOMBRE<>w_nombre_med) THEN
    salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false,salidaEsperada));
    ROLLBACK;
  END actualizar;
  
  
  
  PROCEDURE eliminar (nombre_prueba VARCHAR2, w_cod_med INTEGER, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := true;
    n_medicamento integer;
  BEGIN
    DELETE FROM MEDICAMENTO WHERE OID_M = w_cod_med;
    
    SELECT COUNT (*) INTO n_medicamento FROM MEDICAMENTO WHERE OID_M = w_cod_med;
    IF (n_medicamento <> 0) THEN
      salida := false;
    END IF;
    COMMIT WORK;
    
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));
    
    EXCEPTION
    WHEN OTHERS THEN
      DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false,salidaEsperada));
      ROLLBACK;
  END eliminar;
  
END;