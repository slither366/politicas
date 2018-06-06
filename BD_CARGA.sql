CREATE DATABASE IF NOT EXISTS db_politicas DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE db_politicas;

CREATE TABLE IF NOT EXISTS tb_locales(
cod_local varchar(5) NOT NULL,
cod_cia	varchar(3) NOT NULL,
descripcion varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE tb_locales
  ADD PRIMARY KEY (cod_local);

INSERT INTO tb_locales VALUES('C58','007','C58-PUNO LIMA 4');
INSERT INTO tb_locales VALUES('C54','007','C54-JULIACA SAN ROMAN 2');

CREATE TABLE IF NOT EXISTS tb_estado_semaforo(
cod_est_semaforo int(1) NOT NULL,
descripcion varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE tb_estado_semaforo
  ADD PRIMARY KEY (cod_est_semaforo);

INSERT INTO tb_estado_semaforo VALUES(0,'PENDIENTE');
INSERT INTO tb_estado_semaforo VALUES(1,'TERMINADO');

CREATE TABLE IF NOT EXISTS tb_semaforo(
cod_semaforo int(2) NOT NULL,
semaforo			varchar(30) NOT NULL,
cod_est_semaforo 		int(1) NOT NULL,
rango_dias varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE tb_semaforo
  ADD PRIMARY KEY (cod_semaforo);

ALTER TABLE tb_semaforo
	ADD FOREIGN KEY(cod_est_semaforo) REFERENCES tb_estado_semaforo(cod_est_semaforo);

INSERT INTO tb_semaforo VALUES(1,'VERDE',1,'0 DIAS');
INSERT INTO tb_semaforo VALUES(2,'AMARILLO',0,'ENTRE 5 Y 10 DIAS');
INSERT INTO tb_semaforo VALUES(3,'NARANJA',0,'ENTRE 10 Y 20 DIAS');
INSERT INTO tb_semaforo VALUES(4,'ROJO',0,'MAYOR A 20 DIAS');

CREATE TABLE IF NOT EXISTS tb_politicas(
cod_politicas int(2) NOT NULL,
descripcion varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE tb_politicas
  ADD PRIMARY KEY (cod_politicas);

INSERT INTO tb_politicas VALUES(1,'GUIAS DE TRANSFERENCIA');
INSERT INTO tb_politicas VALUES(2,'DEPOSITO BANCARIO');
INSERT INTO tb_politicas VALUES(3,'REMESAS FUERA DE RANGO');
INSERT INTO tb_politicas VALUES(4,'CIERRE DIA PENDIENTE');
INSERT INTO tb_politicas VALUES(5,'ACUMULACION DE DEFICIT');
INSERT INTO tb_politicas VALUES(6,'ANULACION DE CUADRATURA');
INSERT INTO tb_politicas VALUES(7,'ASL PENDIENTE');
INSERT INTO tb_politicas VALUES(8,'OC DIRECTA');
INSERT INTO tb_politicas VALUES(9,'RECEPCION DE ENTREGAS');
INSERT INTO tb_politicas VALUES(10,'GUIAS DE DEVOLUCION');

CREATE TABLE IF NOT EXISTS tb_tipo_persona(
cod_tipo_persona	int(2) NOT NULL,
descripcion	varchar(50)	NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE tb_tipo_persona
	ADD PRIMARY KEY(cod_tipo_persona);

INSERT INTO tb_tipo_persona VALUES(1,'ADMINISTRADOR');
INSERT INTO tb_tipo_persona VALUES(2,'SUBGERENTE ZONAL');
INSERT INTO tb_tipo_persona VALUES(3,'JEFE ZONAL');

CREATE TABLE IF NOT EXISTS tb_estado(
cod_estado	int(1) NOT NULL,
descripcion	varchar(50)	NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE tb_estado
	ADD PRIMARY KEY(cod_estado);

INSERT INTO tb_estado VALUES(0,'INACTIVO');
INSERT INTO tb_estado VALUES(1,'ACTIVO');

CREATE TABLE IF NOT EXISTS tb_persona(
dni					varchar(8) NOT NULL,
cod_tipo_persona int(2) NOT NULL,
nombre			varchar(50) NOT NULL,
paterno			varchar(50) NOT NULL,
materno		  varchar(50) NOT NULL,
cod_estado			int(1) NOT NULL,
fecha_reg		datetime
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE tb_persona
  ADD PRIMARY KEY (dni);

ALTER TABLE tb_persona
  ADD FOREIGN KEY(cod_tipo_persona) REFERENCES tb_tipo_persona(cod_tipo_persona);

ALTER TABLE tb_persona
  ADD FOREIGN KEY(cod_estado) REFERENCES tb_estado(cod_estado);

INSERT INTO tb_persona VALUES('44752002',1,'DAVID','FLORES','LUJAN',1,'2018-06-06');
INSERT INTO tb_persona VALUES('40601632',3,'IVOONE MILAGROS','RINCON','SANTOS',1,'2018-06-06');

CREATE TABLE IF NOT EXISTS usuarios(
  id int(11) NOT NULL,
  usuario varchar(30) NOT NULL,
  password varchar(130) NOT NULL,
-- nombre varchar(100) NOT NULL,
  correo varchar(80) NOT NULL,
  last_session datetime DEFAULT NULL,
  activacion int(11) NOT NULL DEFAULT '0',
  token varchar(40) NOT NULL,
  token_password varchar(100) DEFAULT NULL,
  password_request int(11) DEFAULT '0',
	dni varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE usuarios
  ADD PRIMARY KEY (id);

ALTER TABLE usuarios
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE usuarios
  ADD FOREIGN KEY(dni) REFERENCES tb_persona(dni);

INSERT INTO usuarios(usuario,password,correo,activacion,token,token_password,password_request,dni) VALUES('DFLORES','$10$SlkE/74OwrEpdTBrcasJnuSh3cygTx/gJkPiWcLdXbRBq/Zrxximi','slither366@gmail.com',1,'2f3e7f0a024080730c9c389aa3735dd4','',0,'44752002');
INSERT INTO usuarios(usuario,password,correo,activacion,token,token_password,password_request,dni) VALUES('IRINCON','$10$gMsYbj7bQfjB5RFaGvjRx.fEZqy0kaGDmINUDJfXgW7m/1nWn4IWa','dflores@mifarma.com.pe',1,'6c7740d87d34e5d5e1d42e0bcb9fc4f3','',0,'40601632');

CREATE TABLE IF NOT EXISTS tb_cab_documentos(
cod_doc varchar(7) NOT NULL,
num_doc_ori	varchar(15) NOT NULL,-- numero documento origen
loc_ori varchar(5),
loc_dest varchar(5),
total_prod int(3), 
fec_crea_origen datetime,
jzona_ori varchar(8),
jzona_dest varchar(8),
mail_jefe_o varchar(30),
mail_gerente_o varchar(30),
mail_jefe_d varchar(30),
mail_gerente_d varchar(30)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE tb_cab_documentos
  ADD PRIMARY KEY (cod_doc);

ALTER TABLE tb_cab_documentos 
	ADD FOREIGN KEY(loc_ori) REFERENCES tb_locales(cod_local);

ALTER TABLE tb_cab_documentos 
	ADD FOREIGN KEY(loc_dest) REFERENCES tb_locales(cod_local);

ALTER TABLE tb_cab_documentos 
	ADD FOREIGN KEY(jzona_ori) REFERENCES tb_persona(dni);

ALTER TABLE tb_cab_documentos 
	ADD FOREIGN KEY(jzona_dest) REFERENCES tb_persona(dni);

INSERT INTO tb_cab_documentos VALUES('0000001','3330009989','C58','C54',256,'2018-05-14','44752002','40601632','DFLORES','mquispe','IRINCON','mgomez');

CREATE TABLE IF NOT EXISTS tb_det_documentos(
cod_det_doc int(10) NOT NULL,
cod_doc varchar(7) NOT NULL,
cod_prod varchar(10) NOT NULL, 
desc_prod varchar(100) NOT NULL, 
desc_unid_present varchar(100),
cant_mov int(6),
val_frac int(4)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE tb_det_documentos
  ADD PRIMARY KEY (cod_det_doc);

ALTER TABLE tb_det_documentos
  MODIFY cod_det_doc int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE tb_det_documentos 
	ADD FOREIGN KEY(cod_doc) REFERENCES tb_cab_documentos(cod_doc);

INSERT INTO tb_det_documentos VALUES(1,'0000001','512587','DORSOF 2% OFT','FCO 5 ML','1','1');
INSERT INTO tb_det_documentos VALUES(2,'0000001','134123','DOLONET FORTE 400 MG','CJA 100 CAP','100','100');
INSERT INTO tb_det_documentos VALUES(3,'0000001','132153','DR ZAID COL BABY S/ALCOHOL','FCO 200 ML','2','100');
INSERT INTO tb_det_documentos VALUES(4,'0000001','137857','DR ZAID TALCO','FCO 200 GR','3','3');
INSERT INTO tb_det_documentos VALUES(5,'0000001','132186','DR ZAID TALCO','FCO 600 GR','3','3');

CREATE TABLE IF NOT EXISTS tb_estado_documentos(
cod_estado_doc 			INT(7) NOT NULL,
cod_politicas 			int(2) NOT NULL,
cod_doc 	varchar(7) NOT NULL,
cod_semaforo 				int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE tb_estado_documentos
  ADD PRIMARY KEY (cod_estado_doc);

ALTER TABLE tb_estado_documentos
  MODIFY cod_estado_doc int(7) NOT NULL AUTO_INCREMENT;

ALTER TABLE tb_estado_documentos
	ADD FOREIGN KEY(cod_politicas) REFERENCES tb_politicas(cod_politicas);

ALTER TABLE tb_estado_documentos
	ADD FOREIGN KEY(cod_doc) REFERENCES tb_cab_documentos(cod_doc);

ALTER TABLE tb_estado_documentos
	ADD FOREIGN KEY(cod_semaforo) REFERENCES tb_semaforo(cod_semaforo);

INSERT INTO tb_estado_documentos VALUES(1,'1','0000001','2');