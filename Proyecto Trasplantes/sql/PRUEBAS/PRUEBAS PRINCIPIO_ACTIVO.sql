CREATE OR REPLACE 
PACKAGE PRUEBAS_PRINCIPIO_ACTIVO AS 
    PROCEDURE inicializar;
    PROCEDURE insertar (nombre_prueba VARCHAR2, w_nombre VARCHAR2, salidaEsperada BOOLEAN);
    PROCEDURE actualizar(nombre_prueba VARCHAR2, w_nombre VARCHAR2, salidaEsperada BOOLEAN);
    PROCEDURE eliminar(nombre_prueba VARCHAR2, w_oid_pa number, salidaEsperada BOOLEAN);

END PRUEBAS_PRINCIPIO_ACTIVO;
/
create or replace
PACKAGE BODY PRUEBAS_PRINCIPIO_ACTIVO AS

  PROCEDURE inicializar AS
  BEGIN
    DELETE FROM PRINCIPIO_ACTIVO;
  END inicializar;

  PROCEDURE insertar (nombre_prueba VARCHAR2, w_nombre VARCHAR2, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    PrincAc PRINCIPIO_ACTIVO%ROWTYPE;
    w_oid_pa NUMBER;
  BEGIN
    INSERT INTO PRINCIPIO_ACTIVO VALUES(sec_oidpa.NEXTVAL, w_nombre, sec_oidm.CURRVAL);
    
    w_oid_pa := sec_oidpa.CURRVAL;
    SELECT * INTO PrincAc FROM PRINCIPIO_ACTIVO WHERE OID_PA=w_oid_pa;
    IF (PrincAc.NOMBRE<>w_nombre) THEN
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
    PrincAc PRINCIPIO_ACTIVO%ROWTYPE;
    w_oid_pa NUMBER;
  BEGIN
    w_oid_pa := sec_oidpa.CURRVAL;
    UPDATE PRINCIPIO_ACTIVO SET NOMBRE=w_nombre WHERE OID_PA=w_oid_pa;
    
  SELECT * INTO PrincAc FROM PRINCIPIO_ACTIVO WHERE OID_PA=w_oid_pa;
  IF(PrincAc.NOMBRE<>w_nombre) THEN
    salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false,salidaEsperada));
    ROLLBACK;
  END actualizar;
  
  
  
  PROCEDURE eliminar (nombre_prueba VARCHAR2, w_oid_pa number, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := true;
    n_principio_activo integer;
  BEGIN
    DELETE FROM PRINCIPIO_ACTIVO WHERE OID_PA=w_oid_pa;
    
    SELECT COUNT (*) INTO n_principio_activo FROM PRINCIPIO_ACTIVO WHERE OID_PA=w_oid_pa;
    IF (n_principio_activo<>0) THEN
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