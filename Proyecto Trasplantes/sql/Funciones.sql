/****************************
*******AÑADIR DONANTE********
****************************/

create or replace PROCEDURE añadir_donante
  (w_donante IN DONANTE.DONANTE%TYPE,
  w_organo IN DONANTE.ORGANO%TYPE,
  w_nif IN DONANTE.NIF%TYPE,
  w_oidp IN DONANTE.OID_P%TYPE) IS
  
  BEGIN
  INSERT INTO DONANTE
          VALUES (sec_oiddo.nextval, w_donante, w_organo, w_nif, w_oidp);
  COMMIT WORK;
  END añadir_donante;
/

/****************************
*****AÑADIR MEDICAMENTO******
****************************/

create or replace PROCEDURE añadir_medicamento
  (w_nombre IN MEDICAMENTO.NOMBRE%TYPE,
  w_oidc IN MEDICAMENTO.OID_C%TYPE) IS
  
  BEGIN
  INSERT INTO MEDICAMENTO
          VALUES (sec_oidm.nextval, w_nombre, w_oidc);
  COMMIT WORK;
  END añadir_medicamento;
/
/****************************
********ASIGNAR CAMA*********
****************************/

create or replace PROCEDURE asignar_cama
  (w_numero IN CAMA.NUMERO%TYPE,
  w_nif IN CAMA.NIF%TYPE,
  w_oidh IN CAMA.OID_H%TYPE) IS
  
  BEGIN
  INSERT INTO CAMA
          VALUES (sec_oidca.nextval, w_numero, w_nif, w_oidh);
  COMMIT WORK;
  END asignar_cama;
/
/****************************
*****ASIGNAR HABITACION******
****************************/

create or replace PROCEDURE asignar_habitacion
  (w_planta IN HABITACION.PLANTA%TYPE,
  w_numero IN HABITACION.NUMERO%TYPE) IS
  
  BEGIN
  INSERT INTO HABITACION
          VALUES (sec_oidh.nextval, w_planta, w_numero);
  COMMIT WORK;
  END asignar_habitacion;
/
/****************************
******ASIGNAR HISTORIA*******
****************************/

create or replace PROCEDURE asignar_historia
  (w_nhc IN HISTORIA_CLINICA.NHC%TYPE,
  w_nif IN HISTORIA_CLINICA.NIF%TYPE) IS
  
  BEGIN
  INSERT INTO HISTORIA_CLINICA
          VALUES (w_nhc, w_nif);
  COMMIT WORK;
  END asignar_historia;
/
/****************************
********CREAR EVENTO*********
****************************/

create or replace PROCEDURE crear_evento
  (w_tipoevento IN EVENTO.TIPOEVENTO%TYPE,
  w_fechacreacion IN EVENTO.FECHACREACION%TYPE,
  w_fechasuceso IN EVENTO.FECHASUCESO%TYPE,
  w_fechafinsuceso IN EVENTO.FECHAFINSUCESO%TYPE,
  w_comentarios IN EVENTO.COMENTARIOS%TYPE,
  w_nhc IN EVENTO.NHC%TYPE,
  w_oidc IN EVENTO.OID_C%TYPE) IS
  
  BEGIN
  INSERT INTO EVENTO
          VALUES (sec_oide.nextval, w_tipoevento, w_fechacreacion, w_fechasuceso,
          w_fechafinsuceso, w_comentarios, w_nhc, w_oidc);
  COMMIT WORK;
  END crear_evento;
/
/****************************
*******DATOS PACIENTE********
****************************/

create or replace PROCEDURE datos_paciente
  (w_nombre IN PACIENTE.NOMBRE%TYPE,
  w_nif IN PACIENTE.NIF%TYPE,
  w_seg IN PACIENTE.NSEGSOC%TYPE,
  w_fechanac IN PACIENTE.FECHANAC%TYPE,
  w_dir IN PACIENTE.DIRECCION%TYPE,
  w_cp IN PACIENTE.CP%TYPE,
  w_localidad IN PACIENTE.LOCALIDAD%TYPE,
  w_provincia IN PACIENTE.PROVINCIA%TYPE,
  w_telef IN PACIENTE.TELEFONO%TYPE,
  w_medico IN PACIENTE.MEDICOFAMILIA%TYPE,
  w_centro IN PACIENTE.CENTROSALUD%TYPE) 
  
  IS
  
  BEGIN
  INSERT INTO PACIENTE
          VALUES (w_nombre, w_nif, w_seg, w_fechanac,
          w_dir, w_cp, w_localidad, w_provincia, w_telef, w_medico, w_centro);
  COMMIT WORK;
  END datos_paciente;
/
/****************************
****AÑADIR PRINCIPIOACTIVO***
****************************/

create or replace PROCEDURE añadir_principioactivo
  (w_nombre IN PRINCIPIO_ACTIVO.NOMBRE%TYPE,
  w_oidm IN PRINCIPIO_ACTIVO.OID_M%TYPE)

  IS

  BEGIN
  INSERT INTO PRINCIPIO_ACTIVO
          VALUES (sec_oidpa.nextval, w_nombre, w_oidm);
  COMMIT WORK;
  END añadir_principioactivo;
/
/****************************
***AÑADIR PROPIEDADEVENTO****
****************************/
create or replace PROCEDURE añadir_propiedadevento
  (w_contenido IN PROPIEDAD_EVENTO.CONTENIDO%TYPE,
  w_oide IN PROPIEDAD_EVENTO.OID_E%TYPE) IS
  
  BEGIN
  INSERT INTO PROPIEDAD_EVENTO
          VALUES (sec_oidp.nextval, w_contenido, w_oide);
  COMMIT WORK;
  END añadir_propiedadevento;
/
/****************************
*****AÑADIR SECOMPONEDE******
****************************/

create or replace PROCEDURE añadir_secomponede
  (w_oidm IN SE_COMPONE_DE.OID_M%TYPE,
  w_oidpa IN SE_COMPONE_DE.OID_PA%TYPE)
  
  IS
  
  BEGIN
  INSERT INTO SE_COMPONE_DE
          VALUES (sec_oidd.nextval, w_oidm, w_oidpa);
  COMMIT WORK;
  END añadir_secomponede;
/
/****************************
*******AÑADIR RECETA*********
****************************/

create or replace PROCEDURE añadir_receta
  (w_oidm IN SE_RECETA_CON.OID_M%TYPE,
  w_oidp IN SE_RECETA_CON.OID_P%TYPE)
  
  IS
  
  BEGIN INSERT INTO SE_RECETA_CON
          VALUES (sec_oidr.nextval, w_oidm, w_oidp);
  COMMIT WORK;
  END añadir_receta;
/
/****************************
*******AÑADIR CREADOR********
****************************/
CREATE OR REPLACE PROCEDURE añadir_creador(
  w_tipocreador IN CREADOR.TIPOCREADOR%TYPE,
  w_dni IN CREADOR.DNI%TYPE,
  w_nombre IN CREADOR.NOMBRE%TYPE,
  w_especialidad IN CREADOR.ESPECIALIDAD%TYPE,
  w_seccion IN CREADOR.SECCION%TYPE, 
  w_usuario IN CREADOR.USUARIO%TYPE,
  w_pass IN CREADOR.PASS%TYPE) IS

  BEGIN
  INSERT INTO CREADOR
        VALUES (sec_oidc.nextval, w_tipocreador, w_dni,
        w_nombre, w_especialidad, w_seccion, w_usuario, w_pass);
  COMMIT WORK;
  END añadir_creador;
/
/****************************
*******ELIMINAR CAMAS********
****************************/
create or replace PROCEDURE ELIMINAR_CAMA_CON_NIF(
  w_nif IN CAMA.NIF%TYPE) IS
  
  BEGIN
  DELETE FROM CAMA WHERE NIF = w_nif;
  COMMIT WORK;
  END ELIMINAR_CAMA_CON_NIF;
/
create or replace PROCEDURE ELIMINAR_CAMA_CON_ID(
  w_oidca IN CAMA.OID_CA%TYPE) IS
  
  BEGIN
  DELETE FROM CAMA WHERE OID_CA = w_oidca;
  COMMIT WORK;
  END ELIMINAR_CAMA_CON_ID;
/
/***************************
******ACTUALIZAR CAMA******
***************************/
CREATE OR REPLACE PROCEDURE ACTUALIZAR_CAMA(
  w_oidca IN CAMA.OID_CA%TYPE,
  w_nif IN CAMA.NIF%TYPE) IS
  
  BEGIN
  UPDATE CAMA
  SET NIF = w_nif
  WHERE OID_CA = w_oidca;
  COMMIT WORK;
  END ACTUALIZAR_CAMA;
/
/*****************************
******ACTUALIZAR EVENTO*******
*****************************/
CREATE OR REPLACE PROCEDURE ACTUALIZAR_EVENTO(
  w_oide IN EVENTO.OID_E%TYPE,
  w_tipoevento IN EVENTO.TIPOEVENTO%TYPE,
  w_fechasuceso IN EVENTO.FECHASUCESO%TYPE,
  w_fechafinsuceso IN EVENTO.FECHAFINSUCESO%TYPE,
  w_comentarios IN EVENTO.COMENTARIOS%TYPE) IS
  
  BEGIN
  UPDATE EVENTO 
  SET TIPOEVENTO = w_tipoevento, FECHASUCESO = w_fechasuceso,
  FECHAFINSUCESO = w_fechafinsuceso, COMENTARIOS = w_comentarios
  WHERE OID_E = w_oide;
  COMMIT WORK;
  END ACTUALIZAR_EVENTO;
/
/*****************************
*****ACTUALIZAR PACIENTE******
*****************************/
CREATE OR REPLACE PROCEDURE ACTUALIZAR_PACIENTE(
  w_nif IN PACIENTE.NIF%TYPE,
  w_dir IN PACIENTE.DIRECCION%TYPE,
  w_cp IN PACIENTE.CP%TYPE,
  w_localidad IN PACIENTE.LOCALIDAD%TYPE,
  w_provincia IN PACIENTE.PROVINCIA%TYPE,
  w_telefono IN PACIENTE.TELEFONO%TYPE,
  w_medicofamilia IN PACIENTE.MEDICOFAMILIA%TYPE,
  w_centrosalud IN PACIENTE.CENTROSALUD%TYPE) IS
  
  BEGIN
  UPDATE PACIENTE
  SET DIRECCION = w_nif, CP = w_cp,
  LOCALIDAD = w_localidad, PROVINCIA = w_provincia, TELEFONO = w_telefono,
  MEDICOFAMILIA = w_medicofamilia, CENTROSALUD = w_centrosalud
  WHERE NIF = w_nif;
  COMMIT WORK;
  END ACTUALIZAR_PACIENTE;
/
/****************************
*****ACTUALIZAR DONANTE******
****************************/
CREATE OR REPLACE PROCEDURE ACTUALIZAR_DONANTE(
  w_oiddo IN DONANTE.OID_DO%TYPE,
  w_nif IN DONANTE.NIF%TYPE) IS
  
  BEGIN
  UPDATE DONANTE
  SET NIF = w_nif
  WHERE OID_DO = w_oiddo;
  COMMIT WORK;
  END ACTUALIZAR_DONANTE;
/
/****************************
*****ACTUALIZAR DONANTE******
****************************/
CREATE OR REPLACE PROCEDURE ACTUALIZAR_PROPIEDADEVENTO(
  w_oidp IN PROPIEDAD_EVENTO.OID_P%TYPE,
  w_contenido IN PROPIEDAD_EVENTO.CONTENIDO%TYPE) IS
  
  BEGIN
  UPDATE PROPIEDAD_EVENTO
  SET CONTENIDO = w_contenido
  WHERE OID_P = w_oidp;
  COMMIT WORK;
  END ACTUALIZAR_PROPIEDADEVENTO;
/
/***********************
*****ASSERT_EQUALS******
***********************/
CREATE OR REPLACE 
FUNCTION ASSERT_EQUALS (salida BOOLEAN, salida_esperada BOOLEAN) RETURN VARCHAR2 AS
BEGIN
    IF (salida = salida_esperada) THEN
      RETURN 'EXITO';
    ELSE 
      RETURN 'FALLO';
    END IF;
END ASSERT_EQUALS;
/
/*****************************************************
********OBTENER EVENTOS SEGUN NIF Y TIPO EVENTO*******
******************************************************/

create or replace FUNCTION getEventosTipo(w_nif IN PACIENTE.NIF%TYPE, w_tipo IN EVENTO.TIPOEVENTO%TYPE)
RETURN SYS_REFCURSOR AS c SYS_REFCURSOR;
BEGIN
  OPEN c FOR SELECT OID_E, TIPOEVENTO, FECHACREACION, FECHASUCESO, FECHAFINSUCESO, COMENTARIOS, NHC, OID_C, nif FROM EVENTO,PACIENTE where (nif=w_nif) and (tipoEvento=w_tipo);
  RETURN c;
END getEventosTipo;
/
/************************************
********OBTENER CAMA SEGUN NIF*******
************************************/

create or replace FUNCTION getCama(w_nif IN PACIENTE.NIF%TYPE)
RETURN SYS_REFCURSOR AS c SYS_REFCURSOR;
BEGIN
  OPEN c FOR SELECT * FROM CAMA where (nif=w_nif);
  RETURN c;
END getCama;
/
/****************************************
********OBTENER PACIENTE SEGUN NIF*******
****************************************/

create or replace FUNCTION getPaciente(w_nif IN PACIENTE.NIF%TYPE)
RETURN SYS_REFCURSOR AS c SYS_REFCURSOR;
BEGIN
  OPEN c FOR SELECT * FROM PACIENTE where (nif=w_nif);
  RETURN c;
END getPaciente;
/
/****************************************
********OBTENER EVENTOS SEGUN NHC********
****************************************/

create or replace FUNCTION getEventos(w_nhc IN HISTORIA_CLINICA.NHC%TYPE)
RETURN SYS_REFCURSOR AS c SYS_REFCURSOR;
BEGIN
  OPEN c FOR SELECT * FROM EVENTO where (nhc=w_nhc);
  RETURN c;
END getEventos;
/
/****************************************
********OBTENER DONANTE SEGUN NIF********
****************************************/

create or replace FUNCTION getDonante(w_nif IN PACIENTE.NIF%TYPE)
RETURN SYS_REFCURSOR AS c SYS_REFCURSOR;
BEGIN
  OPEN c FOR SELECT * FROM DONANTE where (nif=w_nif);
  RETURN c;
END getDonante;