CREATE OR REPLACE 
PACKAGE PRUEBAS_PROPIEDADEVENTO AS 
    PROCEDURE inicializar;
    PROCEDURE insertar (nombre_prueba VARCHAR2, w_nom_pro VARCHAR2, salidaEsperada BOOLEAN);
    PROCEDURE actualizar(nombre_prueba VARCHAR2, w_cod_pro integer, w_nom_pro VARCHAR2, salidaEsperada BOOLEAN);
    PROCEDURE eliminar(nombre_prueba VARCHAR2, w_cod_pro integer, salidaEsperada BOOLEAN);

END PRUEBAS_PROPIEDADEVENTO;
/
create or replace
PACKAGE BODY PRUEBAS_PROPIEDADEVENTO AS

  PROCEDURE inicializar AS
  BEGIN
    DELETE FROM PROPIEDAD_EVENTO;
  END inicializar;
  
  
  
  PROCEDURE insertar (nombre_prueba VARCHAR2, w_nom_pro VARCHAR2, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    Prop PROPIEDAD_EVENTO%ROWTYPE;
    w_cod_pro INTEGER;
  BEGIN
    INSERT INTO PROPIEDAD_EVENTO VALUES(1, null, 1);
    
    w_cod_pro := 1;
    SELECT * INTO Prop FROM PROPIEDAD_EVENTO WHERE w_cod_pro=1;
    IF (Prop.NOMBRE<>w_nom_pro) THEN
      salida := false;
    END IF;
    COMMIT WORK;
    
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));
    
    EXCEPTION WHEN OTHERS THEN
      DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
      ROLLBACK;
  END insertar;
  
  
  
  PROCEDURE actualizar (nombre_prueba VARCHAR2, w_cod_pro INTEGER, w_nom_pro VARCHAR2, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    Prop PROPIEDAD_EVENTO%ROWTYPE;
  BEGIN
    UPDATE PROPIEDAD_EVENTO SET nombre=w_nom_pro WHERE OID_PE=w_cod_pro;
    
  SELECT * INTO Prop FROM PROPIEDAD_EVENTO WHERE OID_PE=w_cod_pro;
  IF(Prop.nombre<>w_nom_pro) THEN
    salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false,salidaEsperada));
    ROLLBACK;
  END actualizar;
  
  
  
  PROCEDURE eliminar (nombre_prueba VARCHAR2, w_cod_pro INTEGER, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := true;
    n_propiedad integer;
  BEGIN
    DELETE FROM PROPIEDAD_EVENTO WHERE OID_PE=w_cod_pro;
    
    SELECT COUNT (*) INTO n_propiedad FROM PROPIEDAD_EVENTO WHERE OID_PE=w_cod_pro;
    IF (n_propiedad<>0) THEN
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