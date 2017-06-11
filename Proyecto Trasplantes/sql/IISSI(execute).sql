/************************
****CREACION DE FILAS****
************************/
/*Pacientes*/
execute DATOS_PACIENTE('Jos� Cabeza Zambrano', '12345678A', '123456789123', TO_DATE('1995-05-16','YYYY-MM-DD'), 'Direcci�n 1', 10001, 'Localidad 1', 'Provincia 1', 697471953, 'M�dico 1', 'Centro 1');
execute DATOS_PACIENTE('Andr�s Mart�n Carrasco', '23456789A', '123456789124', TO_DATE('1970-01-11','YYYY-MM-DD'), 'Direcci�n 2', 10002, 'Localidad 2', 'Provincia 2', 632149658, 'M�dico 2', 'Centro 2');
execute DATOS_PACIENTE('Francisco P�rez V�zquez', '34567890A', '123456789125', TO_DATE('1997-07-14','YYYY-MM-DD'), 'Direcci�n 3', 10003, 'Localidad 3', 'Provincia 3', 654321987, 'M�dico 3', 'Centro 3');
execute DATOS_PACIENTE('Jos� Castro Jim�nez', '12345678B', '123456789128', TO_DATE('1995-05-16','YYYY-MM-DD'), 'Direcci�n 1', 10001, 'Localidad 1', 'Provincia 1', 697471993, 'M�dico 1', 'Centro 1');
execute DATOS_PACIENTE('Jos� Bernardo Juan', '12345658P', '123456789121', TO_DATE('1995-05-16','YYYY-MM-DD'), 'Direcci�n 1', 10001, 'Localidad 1', 'Provincia 1', 697471969, 'M�dico 1', 'Centro 1');
/*******************Creadores********************/
/*M�dicos*/
execute A�ADIR_CREADOR('Medico', '23456789A', 'Nombre m�dico 1', 'Laparoscopia', null, 'nommed1', '1234');
execute A�ADIR_CREADOR('Medico', '23456781A', 'Nombre m�dico 2', 'Endocrinolog�a', null, 'nommed2', '5678');
/*Laboratorios*/
execute A�ADIR_CREADOR('Laboratorio', null, null, null, 'Hematologia', 'lab1', '123');
execute A�ADIR_CREADOR('Laboratorio', null, null, null, 'Microbiolog�a', 'lab2', '456');
/*Enfermero*/
execute A�ADIR_CREADOR('Enfermero', '34567891A', 'Nombre enfermero 1', null, null, 'enf1', '123');
execute A�ADIR_CREADOR('Enfermero', '34567892A', 'Nombre enfermero 2', null, null, 'enf2', '456');
/*Habitaciones*/
execute ASIGNAR_HABITACION(3 , 1);
execute ASIGNAR_HABITACION(3, 2);
/*Camas ------- Los oids hay que cambiarlos en funci�n de los oids que genere la secuencia poque son un poco aleatorios*/
execute ASIGNAR_CAMA(1, '12345678A', 5);
execute ASIGNAR_CAMA(2, '23456789A', 6);
execute ASIGNAR_CAMA(1, '34567890A', 6);
execute ASIGNAR_CAMA(2, '12345678B', 5);
/*Historia cl�nica*/
execute ASIGNAR_HISTORIA('123456789123456', '12345678A');
execute ASIGNAR_HISTORIA('234567891234567', '23456789A');
execute ASIGNAR_HISTORIA('345678912345678', '34567890A');
/*Evento*/
execute CREAR_EVENTO('Operacion', SYSTIMESTAMP, to_date('18-07-17 10:34:09', 'dd-mm-yy hh24:mi:ss'), to_date('18-06-17 10:34:09', 'dd-mm-yy hh24:mi:ss'), 'Comentario 1', '123456789123456', 13);
execute CREAR_EVENTO('Prueba', SYSTIMESTAMP, to_date('18-07-20 10:34:09', 'dd-mm-yy hh24:mi:ss'), to_date('18-06-20 10:34:09', 'dd-mm-yy hh24:mi:ss'), 'Comentario 2', '234567891234567', 14);
execute CREAR_EVENTO('Alta', SYSTIMESTAMP, to_date('18-07-23 10:34:09', 'dd-mm-yy hh24:mi:ss'), to_date('18-06-23 10:34:09', 'dd-mm-yy hh24:mi:ss'), 'Comentario 2', '345678912345678', 15);
/*Propiedad evento*/
execute A�ADIR_PROPIEDADEVENTO(null, 2);
execute A�ADIR_PROPIEDADEVENTO(null, 3);
execute A�ADIR_PROPIEDADEVENTO(null, 4);
/*Donante*/
execute A�ADIR_DONANTE('Donante', 'Alguno', '12345678A', 1);
/*Medicamento*/
execute A�ADIR_MEDICAMENTO('Alguno', 13);
/*Principio activo*/
execute A�ADIR_PRINCIPIOACTIVO('Alguno', 1);
/*Se compone de*/
execute A�ADIR_SECOMPONEDE(1, 1);
/*A�adir receta*/
execute A�ADIR_RECETA(1,1);
/*************************
***ELIMINACION DE FILAS***
*************************/
execute ELIMINAR_CAMA_CON_ID(1);
execute ELIMINAR_CAMA_CON_NIF('12345678A');
/*************************
**ACTUALIZACION DE FILAS**
*************************/
execute ACTUALIZAR_EVENTO(1, 'Prueba', to_date('19-06-17 10:34:09', 'dd-mm-yy hh24:mi:ss'), to_date('20-06-17 10:34:09', 'dd-mm-yy hh24:mi:ss'),'Alguno');
execute ACTUALIZAR_PACIENTE('12345678A', 'Otra', 10001, 'Otra', 'Otra', 234567891, 'Otro', 'Otro');
execute ACTUALIZAR_CAMA(1, '23456789A');
execute ACTUALIZAR_DONANTE(1, '23456789A');
execute ACTUALIZAR_PROPIEDADEVENTO(1, null);