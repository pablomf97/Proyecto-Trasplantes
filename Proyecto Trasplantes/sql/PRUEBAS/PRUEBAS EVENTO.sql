CREATE OR REPLACE 
PACKAGE PRUEBAS_EVENTO AS 
    PROCEDURE inicializar;
    PROCEDURE insertar (nombre_prueba VARCHAR2, w_tipo_eve VARCHAR2, salidaEsperada BOOLEAN);
    PROCEDURE actualizar(nombre_prueba VARCHAR2, w_tipo_eve VARCHAR2, salidaEsperada BOOLEAN);
    PROCEDURE eliminar(nombre_prueba VARCHAR2, w_cod_eve integer, salidaEsperada BOOLEAN);

END PRUEBAS_EVENTO;
/
create or replace
PACKAGE BODY PRUEBAS_EVENTO AS

  PROCEDURE inicializar AS
  BEGIN
    DELETE FROM EVENTO;
  END inicializar;
  
  
  
  PROCEDURE insertar (nombre_prueba VARCHAR2, w_tipo_eve VARCHAR2, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    Even EVENTO%ROWTYPE;
    w_cod_eve INTEGER;
  BEGIN
    INSERT INTO EVENTO VALUES(sec_oide.NEXTVAL, w_tipo_eve, SYSTIMESTAMP, to_date('18-06-17 10:34:09', 'dd-mm-yy hh24:mi:ss'), to_date('18-06-17 10:34:09', 'dd-mm-yy hh24:mi:ss'),'Aguno', '123456789123456', sec_oidc.CURRVAL);
    
    w_cod_eve := sec_oide.CURRVAL;
    SELECT * INTO Even FROM EVENTO WHERE OID_E = w_cod_eve;
    IF (Even.tipoEvento<>w_tipo_eve) THEN
      salida := false;
    END IF;
    COMMIT WORK;
    
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));
    
    EXCEPTION WHEN OTHERS THEN
      DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
      ROLLBACK;
  END insertar;
  
  
  
  PROCEDURE actualizar (nombre_prueba VARCHAR2, w_tipo_eve VARCHAR2, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    Even EVENTO%ROWTYPE;
    w_cod_eve INTEGER;
  BEGIN
    w_cod_eve := sec_oide.CURRVAL;
    UPDATE EVENTO SET tipoEvento = w_tipo_eve WHERE OID_E = w_cod_eve;
    
  SELECT * INTO Even FROM EVENTO WHERE OID_E = w_cod_eve;
  IF(Even.tipoEvento<>w_tipo_eve) THEN
    salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false,salidaEsperada));
    ROLLBACK;
  END actualizar;
  
  
  
  PROCEDURE eliminar (nombre_prueba VARCHAR2, w_cod_eve INTEGER, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := true;
    n_evento integer;
  BEGIN
    DELETE FROM EVENTO WHERE OID_E=w_cod_eve;
    
    SELECT COUNT (*) INTO n_evento FROM EVENTO WHERE OID_E=w_cod_eve;
    IF (n_evento<>0) THEN
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