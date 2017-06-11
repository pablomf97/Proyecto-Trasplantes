create or replace PACKAGE PRUEBAS_HISTORIACLINICA AS

    PROCEDURE inicializar;
    PROCEDURE insertar(nombre_prueba VARCHAR2, w_nhc VARCHAR2, salidaEsperada BOOLEAN);
    PROCEDURE actualizar(nombre_prueba VARCHAR2, w_nhc VARCHAR2, salidaEsperada BOOLEAN);
    PROCEDURE eliminar(nombre_prueba VARCHAR2, w_cod_hc VARCHAR2, salidaEsperada BOOLEAN);

END PRUEBAS_HISTORIACLINICA;
/
create or replace PACKAGE BODY PRUEBAS_HISTORIACLINICA AS

  PROCEDURE inicializar AS
  BEGIN
    DELETE FROM HISTORIA_CLINICA;
  END inicializar;
  
  
  
  PROCEDURE insertar (nombre_prueba VARCHAR2, w_nhc VARCHAR2, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    Hc HISTORIA_CLINICA%ROWTYPE;
    w_cod_hc VARCHAR2;
  BEGIN
    INSERT INTO HISTORIA_CLINICA VALUES(w_nhc, '12345678A');
    
    w_cod_hc := w_nhc;
    SELECT * INTO Hc FROM HISTORIA_CLINICA WHERE NHC = w_cod_hc;
    IF (Hc.NHC<>w_cod_hc) THEN
      salida := false;
    END IF;
    COMMIT WORK;
    
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida, salidaEsperada));
    
    EXCEPTION WHEN OTHERS THEN
      DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false, salidaEsperada));
      ROLLBACK;
  END insertar;
  
  
  
  PROCEDURE actualizar (nombre_prueba VARCHAR2, w_nhc VARCHAR2, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := TRUE;
    Hc HISTORIA_CLINICA%ROWTYPE;
    w_cod_hc VARCHAR2;
  BEGIN
    w_cod_hc := w_nhc;
    UPDATE HISTORIA_CLINICA SET NHC = w_nhc WHERE NHC = w_cod_hc;
    
  SELECT * INTO Hc FROM HISTORIA_CLINICA WHERE NHC = w_cod_hc;
  IF(Hc.NHC<>w_nhc) THEN
    salida:= false;
  END IF;
  COMMIT WORK;
  
  DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));
  
  EXCEPTION
  WHEN OTHERS THEN
    DBMS_OUTPUT.put_line(nombre_prueba || ':' || ASSERT_EQUALS(false,salidaEsperada));
    ROLLBACK;
  END actualizar;
  
  
  
  PROCEDURE eliminar (nombre_prueba VARCHAR2, w_cod_hc VARCHAR2, salidaEsperada BOOLEAN) AS
    salida BOOLEAN := true;
    n_historiaclinica integer;
  BEGIN
    DELETE FROM HISTORIA_CLINICA WHERE NHC = w_cod_hc;
    
    SELECT COUNT (*) INTO n_historiaclinica FROM HISTORIA_CLINICA WHERE NHC = w_cod_hc;
    IF (n_historiaclinica <> 0) THEN
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