CREATE OR REPLACE 
PACKAGE PRUEBAS_DONANTE AS 
    PROCEDURE inicializar;
    PROCEDURE insertar (nombre_prueba VARCHAR2, w_nombre VARCHAR2, salidaEsperada BOOLEAN);
    PROCEDURE actualizar(nombre_prueba VARCHAR2, w_nombre VARCHAR2, salidaEsperada BOOLEAN);
    PROCEDURE eliminar(nombre_prueba VARCHAR2, w_oid_do integer, salidaEsperada BOOLEAN);

END PRUEBAS_DONANTE;
/
create or replace
PACKAGE BODY PRUEBAS_DONANTE AS

  PROCEDURE inicializar AS
  BEGIN
    DELETE FROM DONANTE;
  END inicializar;
  
  
  
  PROCEDURE insertar (nombre_prueba VARCHAR2, w_nombre VARCHAR2, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    Don DONANTE%ROWTYPE;
    w_oid_do INTEGER;
  BEGIN
  INSERT INTO DONANTE VALUES(sec_oiddo.NEXTVAL, w_nombre, 'corazon', '12345678A', sec_oidp.CURRVAL);
    
    w_oid_do := sec_oiddo.CURRVAL;
    SELECT * INTO Don FROM DONANTE WHERE OID_DO = w_oid_do;
    IF (Don.DONANTE<>w_nombre) THEN
      salida := false;
    END IF;
    COMMIT WORK;
    
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));
    
    EXCEPTION WHEN OTHERS THEN
      DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
      ROLLBACK;
  END insertar;
  
  
  
  PROCEDURE actualizar (nombre_prueba VARCHAR2, w_nombre VARCHAR2, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    Don DONANTE%ROWTYPE;
    w_oid_do INTEGER;
  BEGIN
    w_oid_do := sec_oiddo.CURRVAL;
    UPDATE DONANTE SET DONANTE=w_nombre WHERE OID_DO=w_oid_do;
    
  SELECT * INTO Don FROM DONANTE WHERE OID_DO=w_oid_do;
  IF(Don.DONANTE<>w_nombre) THEN
    salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false,salidaEsperada));
    ROLLBACK;
  END actualizar;
  
  
  
  PROCEDURE eliminar (nombre_prueba VARCHAR2, w_oid_do INTEGER, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := true;
    n_donante integer;
  BEGIN
    DELETE FROM DONANTE WHERE OID_DO=w_oid_do;
    
    SELECT COUNT (*) INTO n_donante FROM DONANTE WHERE OID_DO=w_oid_do;
    IF (n_donante<>0) THEN
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