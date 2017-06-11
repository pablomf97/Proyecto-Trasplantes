CREATE OR REPLACE PACKAGE PRUEBAS_PACIENTE AS

    PROCEDURE inicializar;
    PROCEDURE insertar(nombre_prueba VARCHAR2, w_nom_pac VARCHAR2, salidaEsperada BOOLEAN);
    PROCEDURE actualizar(nombre_prueba VARCHAR2, w_cod_pac CHAR, w_nom_pac VARCHAR2, salidaEsperada BOOLEAN);
    PROCEDURE eliminar(nombre_prueba VARCHAR2, w_cod_pac integer, salidaEsperada BOOLEAN);

END PRUEBAS_PACIENTE;
/
CREATE OR REPLACE
PACKAGE BODY PRUEBAS_PACIENTE AS



  PROCEDURE inicializar AS
  BEGIN
    DELETE FROM PACIENTE;
  END inicializar;
  
  PROCEDURE insertar (nombre_prueba VARCHAR2, w_nom_pac VARCHAR2, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    Pac PACIENTE%ROWTYPE;
    w_cod_pac CHAR;
  BEGIN
    
    INSERT INTO PACIENTE VALUES(w_nom_pac, '12345679A', '123456789123', TO_DATE('2001-01-01','YYYY-MM-DD'), 'Alguna', 10000, 'Alguna', 'Alguna', 123456789, 'Alguien', 'Alguno');
    w_cod_pac := '12345679A';
    
    SELECT * INTO Pac FROM PACIENTE WHERE NIF = w_cod_pac;
    IF (Pac.NOMBRE<>w_nom_pac) THEN
      salida := false;
    END IF;
    COMMIT WORK;
    
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));
    
    EXCEPTION WHEN OTHERS THEN
      DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
      ROLLBACK;
  END insertar;
  
  
    
  PROCEDURE actualizar (nombre_prueba VARCHAR2, w_cod_pac CHAR, w_nom_pac VARCHAR2, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    Pac PACIENTE%ROWTYPE;
  BEGIN
    UPDATE PACIENTE SET NOMBRE = w_nom_pac WHERE NIF = w_cod_pac;  
    
  SELECT * INTO Pac FROM PACIENTE WHERE NIF = w_cod_pac;
  IF(Pac.NOMBRE<>w_nom_pac) THEN
    salida:= false;
  END IF;
  COMMIT WORK;
    
  DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false,salidaEsperada));
    ROLLBACK;
  END actualizar;  
    
    
    
  PROCEDURE eliminar (nombre_prueba VARCHAR2, w_cod_pac INTEGER, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := true;
    n_paciente integer;
  BEGIN
    DELETE FROM PACIENTE WHERE NIF = w_cod_pac; 
    
    SELECT COUNT (*) INTO n_paciente FROM PACIENTE WHERE NIF = w_cod_pac;
    IF (n_paciente <> 0) THEN
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