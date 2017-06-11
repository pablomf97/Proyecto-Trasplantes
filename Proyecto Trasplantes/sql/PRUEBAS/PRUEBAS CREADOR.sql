CREATE OR REPLACE PACKAGE PRUEBAS_CREADOR AS

    PROCEDURE inicializar;
    PROCEDURE insertar(nombre_prueba VARCHAR2, w_nom_creador VARCHAR2, salidaEsperada BOOLEAN);
    PROCEDURE actualizar(nombre_prueba VARCHAR2, w_nom_creador VARCHAR2, salidaEsperada BOOLEAN);
    PROCEDURE eliminar(nombre_prueba VARCHAR2, w_cod_creador integer, salidaEsperada BOOLEAN);

END PRUEBAS_CREADOR;
/
CREATE OR REPLACE
PACKAGE BODY PRUEBAS_CREADOR AS



  PROCEDURE inicializar AS
  BEGIN
    DELETE FROM CREADOR;
  END inicializar;
  
  PROCEDURE insertar (nombre_prueba VARCHAR2, w_nom_creador VARCHAR2, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    Cre CREADOR%ROWTYPE;
    w_cod_creador INTEGER;
     BEGIN
    INSERT INTO CREADOR VALUES(sec_oidc.NEXTVAL, w_nom_creador, '23456789A', 'Alguno', 'Cirugía Hepatobiliar', null);
    w_cod_creador := sec_oidc.CURRVAL;
    
    SELECT * INTO Cre FROM CREADOR WHERE OID_C = w_cod_creador;
    IF (Cre.TIPOCREADOR<>w_nom_creador) THEN
      salida := false;
    END IF;
    COMMIT WORK;
    
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));
    
    EXCEPTION WHEN OTHERS THEN
      DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
      ROLLBACK;
  END insertar;
  
  

  PROCEDURE actualizar (nombre_prueba VARCHAR2, w_nom_creador VARCHAR2, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    Cre CREADOR%ROWTYPE;
    w_cod_creador INTEGER;
  BEGIN
    w_cod_creador := sec_oidc.CURRVAL;
    UPDATE CREADOR SET TIPOCREADOR = w_nom_creador WHERE OID_C = w_cod_creador;  
    
  SELECT * INTO Cre FROM CREADOR WHERE OID_C = w_cod_creador;
  IF(Cre.TIPOCREADOR<>w_nom_creador) THEN
    salida:= false;
  END IF;
  COMMIT WORK;
    
  DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false,salidaEsperada));
    ROLLBACK;
  END actualizar;  
    
    
    
  PROCEDURE eliminar (nombre_prueba VARCHAR2, w_cod_creador INTEGER, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := true;
    n_creador integer;
  BEGIN
    DELETE FROM CREADOR WHERE OID_C = w_cod_creador; 
    
    SELECT COUNT (*) INTO n_creador FROM CREADOR WHERE OID_C = w_cod_creador;
    IF (n_creador <> 0) THEN
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