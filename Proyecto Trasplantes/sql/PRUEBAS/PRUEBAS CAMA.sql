CREATE OR REPLACE PACKAGE PRUEBAS_CAMA AS

    PROCEDURE inicializar;
    PROCEDURE insertar(nombre_prueba VARCHAR2, w_numero_cama INTEGER, salidaEsperada BOOLEAN);
    PROCEDURE actualizar(nombre_prueba VARCHAR2, w_numero_cama INTEGER, salidaEsperada BOOLEAN);
    PROCEDURE eliminar(nombre_prueba VARCHAR2, w_cod_cama integer, salidaEsperada BOOLEAN);

END PRUEBAS_CAMA;
/
CREATE OR REPLACE
PACKAGE BODY PRUEBAS_CAMA AS



  PROCEDURE inicializar AS
  BEGIN
    DELETE FROM CAMA;
  END inicializar;
  
  PROCEDURE insertar (nombre_prueba VARCHAR2, w_numero_cama INTEGER, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    Ca CAMA%ROWTYPE;
    w_cod_cama INTEGER;
     BEGIN
    INSERT INTO CAMA VALUES(sec_oidca.NEXTVAL, w_numero_cama, '12345678A', sec_oidh.CURRVAL);
    w_cod_cama := sec_oidca.CURRVAL;
    
    SELECT * INTO Ca FROM CAMA WHERE OID_CA = w_cod_cama;
    IF (Ca.NUMERO<>w_numero_cama) THEN
      salida := false;
    END IF;
    COMMIT WORK;
    
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));
    
    EXCEPTION WHEN OTHERS THEN
      DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
      ROLLBACK;
  END insertar;
  
  
    
  PROCEDURE actualizar (nombre_prueba VARCHAR2, w_numero_cama INTEGER, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    Ca CAMA%ROWTYPE;
    w_cod_cama INTEGER;
  BEGIN
    w_cod_cama := sec_oidca.CURRVAL;
    UPDATE CAMA SET NUMERO = w_numero_cama WHERE OID_CA = w_cod_cama;  
    
  SELECT * INTO Ca FROM CAMA WHERE OID_CA = w_cod_cama;
  IF(Ca.NUMERO<>w_numero_cama) THEN
    salida:= false;
  END IF;
  COMMIT WORK;
    
  DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false,salidaEsperada));
    ROLLBACK;
  END actualizar;  
    
    
    
  PROCEDURE eliminar (nombre_prueba VARCHAR2, w_cod_cama INTEGER, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := true;
    n_cama integer;
  BEGIN
    DELETE FROM CAMA WHERE OID_CA = w_cod_cama; 
    
    SELECT COUNT (*) INTO n_cama FROM CAMA WHERE OID_CA = w_cod_cama;
    IF (n_cama <> 0) THEN
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