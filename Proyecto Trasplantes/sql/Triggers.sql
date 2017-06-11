DROP TRIGGER trg_8;
DROP TRIGGER trg_7;
DROP TRIGGER trg_6;
DROP TRIGGER trg_5;
DROP TRIGGER trg_4;
DROP TRIGGER trg_3;
DROP TRIGGER trg_2;
DROP TRIGGER trg_1;

create or replace trigger trg_8
  BEFORE INSERT ON SE_RECETA_CON
  FOR EACH ROW
    DECLARE
    eventos EVENTO.OID_E%TYPE;
    propiedadesE PROPIEDAD_EVENTO.OID_E%TYPE;
    propiedadesP PROPIEDAD_EVENTO.OID_P%TYPE;
    recetaP SE_RECETA_CON.OID_P%TYPE;
  BEGIN
  SELECT OID_E INTO eventos FROM EVENTO WHERE TIPOEVENTO = 'RecetaMedicacion';
  IF (eventos <> propiedadesE)
  THEN raise_application_error(-20001, 'Solo se puede recetar en un evento tipo recetaMedicacion');
  ELSE IF (propiedadesP <> recetaP)
  THEN raise_application_error(-20001, 'Solo se puede recetar en un evento tipo recetaMedicacion');
  END IF;
  END IF;
  END;
/
create or replace trigger trg_7
  BEFORE DELETE ON HISTORIA_CLINICA
  FOR EACH ROW
  BEGIN
  raise_application_error(-20001, 'No se puede borrar una historia clínica');
  END;
/
create or replace trigger trg_6
  BEFORE INSERT ON MEDICAMENTO
  FOR EACH ROW
    DECLARE
    lab INTEGER;
  begin
  SELECT COUNT(*) INTO lab FROM CREADOR WHERE CREADOR.OID_C = OID_C AND CREADOR.TIPOCREADOR = 'Laboratorio';
  IF (lab = 0)
  THEN raise_application_error(-20001, 'Esa OID_C no pertenece a un laboratorio');
  END IF;
  end;
/
create or replace trigger trg_5
  BEFORE INSERT on EVENTO
  FOR EACH ROW
    DECLARE
    numEnfs INTEGER;
    tipoEvento EVENTO.tipoEvento%TYPE;
  begin
  SELECT COUNT(*) INTO numEnfs FROM CREADOR WHERE CREADOR.OID_C = OID_C AND CREADOR.TIPOCREADOR = 'Enfermero';
  IF (tipoEvento = 'Operacion' or tipoEvento = 'Alta' or tipoEvento = 'Donacion' and (numEnfs >0))
  THEN raise_application_error(-20001, 'Un enfermero no puede crear un evento "Operacion"');
  END IF;
  end;
/
create or replace trigger trg_4
  BEFORE INSERT on EVENTO
  FOR EACH ROW
    DECLARE
    numLabs INTEGER;
    tipoEvento EVENTO.tipoEvento%TYPE;
  begin
  SELECT COUNT(*) INTO numLabs FROM CREADOR WHERE CREADOR.OID_C = OID_C AND CREADOR.TIPOCREADOR = 'Laboratorio';
  IF (tipoEvento = 'Operacion' or tipoEvento = 'Prueba' or tipoEvento = 'Deceso' or tipoEvento = 'Alta' and (numLabs >0))
  THEN raise_application_error(-20001, 'Un laboratorio no puede crear ese tipo de evento');
  END IF;
  end;
/
create or replace trigger trg_3
  BEFORE DELETE ON DONANTE
  for each row
  begin
  raise_application_error(-20001, 'No se puede eliminar un donante');
  END;
/
create or replace trigger trg_2
  BEFORE INSERT ON EVENTO
  FOR EACH ROW
    DECLARE
    fechaSuceso Evento.fechaSuceso%TYPE;
    fechaFinSuceso Evento.fechaFinSuceso%TYPE;
  begin
  IF (fechaSuceso < SYSDATE OR fechaFinSuceso < SYSDATE)
  THEN raise_application_error(-20001, 'La fecha de suceso no puede ser menor a la actual');
  END IF;
  end;
/
create or replace trigger trg_1
  before delete on PACIENTE
  for each row
  begin
  raise_application_error(-20001, 'No se puede eliminar un paciente');
  end;