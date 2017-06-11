SET SERVEROUTPUT ON;
/********************************************************
******************PRUEBAS DE PACIENTE********************
********************************************************/
  execute PRUEBAS_PACIENTE.INICIALIZAR;
  execute PRUEBAS_PACIENTE.INSERTAR('Prueba 1 - Insercion del paciente', 'Alguien', true);
  execute PRUEBAS_PACIENTE.ACTUALIZAR('Prueba 2 - Actualizar paciete', '12345678A', 'Otro', true);
  execute PRUEBAS_PACIENTE.ELIMINAR('Prueba 3 - Eliminar paciente', 1, false);
/********************************************************
*****************PRUEBAS DE MEDICAMENTO******************FUNCIONA
********************************************************/
  execute AÑADIR_CREADOR('Medico', '23456789A', 'Alguno','Laparoscopia', null);

  execute PRUEBAS_MEDICAMENTO.INICIALIZAR;
  execute PRUEBAS_MEDICAMENTO.INSERTAR('Prueba 1 - Insercion del medicamento', 'Alguno', true);
  execute PRUEBAS_MEDICAMENTO.ACTUALIZAR('Prueba 2 - Actualizar medicamento', 'Otro', true);
  execute PRUEBAS_MEDICAMENTO.ELIMINAR('Prueba 3 - Eliminar medicamento', sec_oidm.CURRVAL, true);
/********************************************************
********************PRUEBAS DE CAMA**********************FUNCIONA
********************************************************/
  execute DATOS_PACIENTE('Alguien', '12345678A', '123456789123', TO_DATE('2001-01-01','YYYY-MM-DD'), 'Alguna', 10000, 'Alguna', 'Alguna', 123456789, 'Alguien', 'Alguno');
  execute ASIGNAR_HABITACION(3 , 1);

  execute PRUEBAS_CAMA.INICIALIZAR;
  execute PRUEBAS_CAMA.INSERTAR('Prueba 1 - Insercion de cama', 1, true);
  execute PRUEBAS_CAMA.ACTUALIZAR('Prueba 2 - Actualizar numero de cama', 02, true);
  execute PRUEBAS_CAMA.ELIMINAR('Prueba 3 - Eliminar cama', sec_oidca.CURRVAL, true);
/********************************************************
*****************PRUEBAS DE HABITACION*******************FUNCIONA
********************************************************/
  execute PRUEBAS_HABITACION.INICIALIZAR;
  execute PRUEBAS_HABITACION.INSERTAR('Prueba 1 - Insercion habitacion', 1, true);
  execute PRUEBAS_HABITACION.ACTUALIZAR('Prueba 2 - Actualizar numero habitacion', 1, 02, true);
  execute PRUEBAS_HABITACION.ELIMINAR('Prueba 3 - Eliminar habitacion', 1, true);
/********************************************************
*****************PRUEBAS DE CREADOR**********************FUNCIONA
********************************************************/
  execute PRUEBAS_CREADOR.INICIALIZAR;
  execute PRUEBAS_CREADOR.INSERTAR('Prueba 1 - Insercion creador', 'Medico', true);
  execute PRUEBAS_CREADOR.ACTUALIZAR('Prueba 2 - Actualizar nombre creador', 'Laboratorio', true);
  execute PRUEBAS_CREADOR.ELIMINAR('Prueba 3 - Eliminar creador', sec_oidc.CURRVAL, true);
/********************************************************
*****************PRUEBAS DE PRINCIPIO ACTIVO*************FUNCIONA
********************************************************/
  execute AÑADIR_CREADOR('Medico', '23456789A', 'Alguno','Laparoscopia', null);
  execute AÑADIR_MEDICAMENTO('Alguno', sec_oidc.CURRVAL);

  execute PRUEBAS_PRINCIPIO_ACTIVO.INICIALIZAR;
  execute PRUEBAS_PRINCIPIO_ACTIVO.INSERTAR('Prueba 1 - Insercion principio activo', 'Ibuprofeno', true);
  execute PRUEBAS_PRINCIPIO_ACTIVO.ACTUALIZAR('Prueba 2 - Actualizar nombre principio activo', 'Codeína', true);
  execute PRUEBAS_PRINCIPIO_ACTIVO.ELIMINAR('Prueba 3 - Eliminar creador', sec_oidpa.CURRVAL, true);
/********************************************************
*****************PRUEBAS DE DONANTE**********************FUNCIONA
********************************************************/
  execute DATOS_PACIENTE('Alguien', '12345678A', '123456789123', TO_DATE('2001-01-01','YYYY-MM-DD'), 'Alguna', 10000, 'Alguna', 'Alguna', 123456789, 'Alguien', 'Alguno');
  execute AÑADIR_CREADOR('Medico', '23456789A', 'Alguno','Laparoscopia', null);
  execute ASIGNAR_HISTORIA('123456789123456', '12345678A');
  execute CREAR_EVENTO('Operacion', SYSTIMESTAMP, to_date('18-06-17 10:34:09', 'dd-mm-yy hh24:mi:ss'), to_date('18-06-17 10:34:09', 'dd-mm-yy hh24:mi:ss'),'Aguno', '123456789123456', sec_oidc.CURRVAL);
  execute AÑADIR_PROPIEDADEVENTO(null, sec_oide.CURRVAL);

  execute PRUEBAS_DONANTE.INICIALIZAR;
  execute PRUEBAS_DONANTE.INSERTAR('Prueba 1 - Insercion donante', 'Alguien', true);
  execute PRUEBAS_DONANTE.ACTUALIZAR('Prueba 2 - Actualizar nombre donante', 'Otro', true);
  execute PRUEBAS_DONANTE.ELIMINAR('Prueba 3 - Eliminar donante', sec_oiddo.CURRVAL, true);
/********************************************************
*****************PRUEBAS DE SE COMPONE DE****************FUNCIONA
********************************************************/
  execute AÑADIR_CREADOR('Medico', '23456789A', 'Alguno','Laparoscopia', null);
  execute AÑADIR_MEDICAMENTO('Alguno', sec_oidc.CURRVAL);
  execute AÑADIR_PRINCIPIOACTIVO('Alguno', sec_oidm.CURRVAL);

  execute PRUEBAS_SE_COMPONE_DE.INICIALIZAR;
  execute PRUEBAS_SE_COMPONE_DE.INSERTAR('Prueba 1 - Insercion componente a medicamento', true);
  execute PRUEBAS_SE_COMPONE_DE.ACTUALIZAR('Prueba 2 - Actualizar', sec_oidp.CURRVAL, true);
  execute PRUEBAS_SE_COMPONE_DE.ELIMINAR('Prueba 3 - Eliminar componente', sec_oiddo.CURRVAL, true);
  /******************************************************
*****************PRUEBAS DE EVENTO***********************FUNCIONA
********************************************************/
  execute DATOS_PACIENTE('Alguien', '12345678A', '123456789123', TO_DATE('2001-01-01','YYYY-MM-DD'), 'Alguna', 10000, 'Alguna', 'Alguna', 123456789, 'Alguien', 'Alguno');
  execute AÑADIR_CREADOR('Medico', '23456789A', 'Alguno','Laparoscopia', null);
  
  execute PRUEBAS_EVENTO.INICIALIZAR;
  execute PRUEBAS_EVENTO.INSERTAR('Prueba 1 - Insercion de un evento', 'Operacion',true);
  execute PRUEBAS_EVENTO.ACTUALIZAR('Prueba 2 - Actualizar evento', 'Prueba', true);
  execute PRUEBAS_EVENTO.ELIMINAR('Prueba 3 - Eliminar evento', sec_oide.CURRVAL, true);
/*******************************************************
*****************PRUEBAS DE SE RECETA CON***************FUNCIONA
*******************************************************/
  execute AÑADIR_CREADOR('Medico', '23456789A', 'Alguno','Laparoscopia', null);
  execute AÑADIR_MEDICAMENTO('Alguno', sec_oidc.CURRVAL);
  execute CREAR_EVENTO('Operacion', SYSTIMESTAMP, to_date('18-06-17 10:34:09', 'dd-mm-yy hh24:mi:ss'), to_date('18-06-17 10:34:09', 'dd-mm-yy hh24:mi:ss'),'Aguno', '123456789123456', sec_oidc.CURRVAL);
  
  execute PRUEBAS_SE_RECETA_CON.INICIALIZAR;
  execute PRUEBAS_SE_RECETA_CON.INSERTAR('Prueba 1 - Insercion',true);
  execute PRUEBAS_SE_RECETA_CON.ACTUALIZAR('Prueba 2 - Actualizar', sec_oidp.CURRVAL, true);
  execute PRUEBAS_SE_RECETA_CON.ELIMINAR('Prueba 3 - Eliminar', true);