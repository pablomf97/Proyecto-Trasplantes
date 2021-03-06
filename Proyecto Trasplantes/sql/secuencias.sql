DROP SEQUENCE sec_oidc;
DROP SEQUENCE sec_oidh;
DROP SEQUENCE sec_oidca;
DROP SEQUENCE sec_oidm;
DROP SEQUENCE sec_oidpa;
DROP SEQUENCE sec_oide;
DROP SEQUENCE sec_oidp;
DROP SEQUENCE sec_oidr;
DROP SEQUENCE sec_oidd;
DROP SEQUENCE sec_oiddo;


CREATE SEQUENCE sec_oidc;

CREATE OR REPLACE TRIGGER crea_oid_creador
BEFORE INSERT ON CREADOR
FOR EACH ROW
BEGIN
 SELECT sec_oidc.NEXTVAL INTO :NEW.OID_C FROM DUAL;
END;
/
CREATE SEQUENCE sec_oidh;

CREATE OR REPLACE TRIGGER crea_oid_habitacion
BEFORE INSERT ON HABITACION
FOR EACH ROW
BEGIN
 SELECT sec_oidh.NEXTVAL INTO :NEW.OID_H FROM DUAL;
END;
/
CREATE SEQUENCE sec_oidca;

CREATE OR REPLACE TRIGGER crea_oid_cama
BEFORE INSERT ON CAMA
FOR EACH ROW
BEGIN
 SELECT sec_oidca.NEXTVAL INTO :NEW.OID_CA FROM DUAL;
END;
/
CREATE SEQUENCE sec_oidm;

CREATE OR REPLACE TRIGGER crea_oid_medicamento
BEFORE INSERT ON MEDICAMENTO
FOR EACH ROW
BEGIN
 SELECT sec_oidm.NEXTVAL INTO :NEW.OID_M FROM DUAL;
END;
/
CREATE SEQUENCE sec_oidpa;

CREATE OR REPLACE TRIGGER crea_oid_principio_activo
BEFORE INSERT ON PRINCIPIO_ACTIVO
FOR EACH ROW
BEGIN
 SELECT sec_oidpa.NEXTVAL INTO :NEW.OID_PA FROM DUAL;
END;
/
CREATE SEQUENCE sec_oide;

CREATE OR REPLACE TRIGGER crea_oid_evento
BEFORE INSERT ON EVENTO
FOR EACH ROW
BEGIN
 SELECT sec_oide.NEXTVAL INTO :NEW.OID_E FROM DUAL;
END;
/
CREATE SEQUENCE sec_oidp;

CREATE OR REPLACE TRIGGER crea_oid_propiedad_evento
BEFORE INSERT ON PROPIEDAD_EVENTO
FOR EACH ROW
BEGIN
 SELECT sec_oidp.NEXTVAL INTO :NEW.OID_P FROM DUAL;
END;
/
CREATE SEQUENCE sec_oidr;

CREATE OR REPLACE TRIGGER crea_oid_se_receta_con
BEFORE INSERT ON SE_RECETA_CON
FOR EACH ROW
BEGIN
 SELECT sec_oidr.NEXTVAL INTO :NEW.OID_R FROM DUAL;
END;
/
CREATE SEQUENCE sec_oidd;

CREATE OR REPLACE TRIGGER crea_oid_se_compone_de
BEFORE INSERT ON SE_COMPONE_DE
FOR EACH ROW
BEGIN
 SELECT sec_oidd.NEXTVAL INTO :NEW.OID_D FROM DUAL;
END;
/
CREATE SEQUENCE sec_oiddo;

CREATE OR REPLACE TRIGGER crea_oid_donante
BEFORE INSERT ON DONANTE
FOR EACH ROW
BEGIN
 SELECT sec_oiddo.NEXTVAL INTO :NEW.OID_DO FROM DUAL;
END;