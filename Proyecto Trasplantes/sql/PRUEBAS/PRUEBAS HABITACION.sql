CREATE OR REPLACE 
PACKAGE PRUEBAS_HABITACION AS 
    PROCEDURE inicializar;
    PROCEDURE insertar (nombre_prueba VARCHAR2, w_cod_hab integer, salidaEsperada BOOLEAN);
    PROCEDURE actualizar(nombre_prueba VARCHAR2, w_cod_hab_old integer, w_cod_hab_new integer, salidaEsperada BOOLEAN);
    PROCEDURE eliminar(nombre_prueba VARCHAR2, w_cod_hab integer, salidaEsperada BOOLEAN);

END PRUEBAS_HABITACION;
/
create or replace
PACKAGE BODY PRUEBAS_HABITACION AS

  PROCEDURE inicializar AS
  BEGIN
    DELETE FROM HABITACION;
  END inicializar;
  
  
  
  PROCEDURE insertar (nombre_prueba VARCHAR2, w_cod_hab INTEGER, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    Hab HABITACION%ROWTYPE;
  BEGIN
    INSERT INTO HABITACION VALUES(w_cod_hab, 3 , 1);
    
    SELECT * INTO Hab FROM HABITACION WHERE w_cod_hab=1;
    IF (Hab.NUMERO<>w_cod_hab) THEN
      salida := false;
    END IF;
    COMMIT WORK;
    
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));
    
    EXCEPTION WHEN OTHERS THEN
      DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
      ROLLBACK;
  END insertar;
  
  
  
  PROCEDURE actualizar(nombre_prueba VARCHAR2, w_cod_hab_old integer, w_cod_hab_new integer, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    Hab HABITACION%ROWTYPE;
  BEGIN
    UPDATE HABITACION SET NUMERO = w_cod_hab_new WHERE NUMERO = w_cod_hab_old;
    
  SELECT * INTO Hab FROM HABITACION WHERE NUMERO = w_cod_hab_new;
  IF(Hab.NUMERO<>w_cod_hab_new) THEN
    salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false,salidaEsperada));
    ROLLBACK;
  END actualizar;
  
  
  
  PROCEDURE eliminar(nombre_prueba VARCHAR2, w_cod_hab integer, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := true;
    n_habitacion integer;
  BEGIN
    DELETE FROM HABITACION WHERE OID_H = w_cod_hab;
    
    SELECT COUNT (*) INTO n_habitacion FROM HABITACION WHERE OID_H = w_cod_hab;
    IF (n_habitacion<>0) THEN
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