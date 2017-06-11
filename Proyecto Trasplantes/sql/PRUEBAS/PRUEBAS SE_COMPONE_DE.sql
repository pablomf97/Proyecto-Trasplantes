CREATE OR REPLACE 
PACKAGE PRUEBAS_SE_COMPONE_DE AS
    PROCEDURE inicializar;
    PROCEDURE insertar (nombre_prueba VARCHAR2, salidaEsperada BOOLEAN);
    PROCEDURE actualizar(nombre_prueba VARCHAR2, w_oid_pa NUMBER, salidaEsperada BOOLEAN);
    PROCEDURE eliminar(nombre_prueba VARCHAR2, salidaEsperada BOOLEAN);

END PRUEBAS_SE_COMPONE_DE;
/
create or replace
PACKAGE BODY PRUEBAS_SE_COMPONE_DE AS

  PROCEDURE inicializar AS
  BEGIN
    DELETE FROM SE_COMPONE_DE;
  END inicializar;

  PROCEDURE insertar (nombre_prueba VARCHAR2, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    SeComDe SE_COMPONE_DE%ROWTYPE;
    w_oid_d NUMBER;
  BEGIN
    INSERT INTO SE_COMPONE_DE VALUES(sec_oidr.NEXTVAL, sec_oidm.CURRVAL, sec_oidpa.CURRVAL);
    w_oid_d := sec_oidd.CURRVAL;
    SELECT * INTO SeComDe FROM SE_COMPONE_DE WHERE OID_D = w_oid_d;
    IF (SeComDe.OID_D<>w_oid_d) THEN
      salida := false;
    END IF;
    COMMIT WORK;
    
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));
    
    EXCEPTION WHEN OTHERS THEN
      DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
      ROLLBACK;
  END insertar;
  
  
  
  PROCEDURE actualizar (nombre_prueba VARCHAR2, w_oid_pa NUMBER, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    SeComDe SE_COMPONE_DE%ROWTYPE;
    w_oid_m NUMBER;
  BEGIN
    w_oid_m := sec_oidm.CURRVAL;
    UPDATE SE_COMPONE_DE SET OID_PA=w_oid_pa WHERE OID_M = w_oid_m;
    
  SELECT * INTO SeComDe FROM SE_COMPONE_DE WHERE OID_M = w_oid_m;
  IF(SeComDe.OID_PA<>w_oid_pa) THEN
    salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false,salidaEsperada));
    ROLLBACK;
  END actualizar;
  
  
  
  PROCEDURE eliminar (nombre_prueba VARCHAR2, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := true;
    n_se_compone_de integer;
    w_oid_d NUMBER;
  BEGIN
    w_oid_d := sec_oidd.CURRVAL;
    DELETE FROM SE_COMPONE_DE WHERE OID_D = w_oid_d;
    
    SELECT COUNT (*) INTO n_se_compone_de FROM SE_COMPONE_DE WHERE OID_D = w_oid_d;
    IF (n_se_compone_de<>0) THEN
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