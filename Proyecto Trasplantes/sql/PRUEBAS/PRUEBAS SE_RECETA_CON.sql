CREATE OR REPLACE 
PACKAGE PRUEBAS_SE_RECETA_CON AS
    PROCEDURE inicializar;
    PROCEDURE insertar (nombre_prueba VARCHAR2, salidaEsperada BOOLEAN);
    PROCEDURE actualizar(nombre_prueba VARCHAR2, w_oid_p NUMBER, salidaEsperada BOOLEAN);
    PROCEDURE eliminar(nombre_prueba VARCHAR2, salidaEsperada BOOLEAN);

END PRUEBAS_SE_RECETA_CON;
/
create or replace
PACKAGE BODY PRUEBAS_SE_RECETA_CON AS

  PROCEDURE inicializar AS
  BEGIN
    DELETE FROM SE_RECETA_CON;
  END inicializar;

  PROCEDURE insertar (nombre_prueba VARCHAR2, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    SeRecCon SE_RECETA_CON%ROWTYPE;
    w_oid_r NUMBER;
  BEGIN
    INSERT INTO SE_RECETA_CON VALUES(sec_oidr.NEXTVAL, sec_oidm.CURRVAL, sec_oidp.CURRVAL);
    w_oid_r := sec_oidr.CURRVAL;
    SELECT * INTO SeRecCon FROM SE_RECETA_CON WHERE OID_R=w_oid_r;
    IF (SeRecCon.OID_R<>w_oid_r) THEN
      salida := false;
    END IF;
    COMMIT WORK;
    
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));
    
    EXCEPTION WHEN OTHERS THEN
      DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
      ROLLBACK;
  END insertar;
  
  
  
  PROCEDURE actualizar (nombre_prueba VARCHAR2, w_oid_p NUMBER, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    SeRecCon SE_RECETA_CON%ROWTYPE;
    w_oid_m NUMBER;
  BEGIN
    w_oid_m := sec_oidm.CURRVAL;
    UPDATE SE_RECETA_CON SET OID_P=w_oid_p WHERE OID_M=w_oid_m;
    
  SELECT * INTO SeRecCon FROM SE_RECETA_CON WHERE OID_M=w_oid_m;
  IF(SeRecCon.OID_P<>w_oid_p) THEN
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
    n_se_receta_con integer;
    w_oid_r NUMBER;
  BEGIN
    w_oid_r := sec_oidr.CURRVAL;
    DELETE FROM SE_RECETA_CON WHERE OID_R=w_oid_r;
    
    SELECT COUNT (*) INTO n_se_receta_con FROM SE_RECETA_CON WHERE OID_R=w_oid_r;
    IF (n_se_receta_con<>0) THEN
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