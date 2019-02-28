
--
-- Estrutura da tabela 'n_roles'
--

DROP TABLE n_roles CASCADE;
CREATE TABLE n_roles (
descripcion_rol varchar(100),
id_rol int4 NOT NULL DEFAULT nextval(('public.n_roles_id_rol_seq'::text)::regclass)
);

--
-- Creating data for 'n_roles'
--

INSERT INTO n_roles VALUES ('1','ADMINISTRADOR');
INSERT INTO n_roles VALUES ('2','ANALISTA');


--
-- Creating index for 'n_roles'
--

ALTER TABLE ONLY  n_roles  ADD CONSTRAINT  id_rol  PRIMARY KEY  (id_rol);

--
-- Estrutura da tabela 'n_unidad_solicitante'
--

DROP TABLE n_unidad_solicitante CASCADE;
CREATE TABLE n_unidad_solicitante (
descripcion_unidad varchar(100),
id_unidad_solicitante int4 NOT NULL DEFAULT nextval('n_unidad_solicitante_id_unidad_solicitante_seq'::regclass)
);

--
-- Creating data for 'n_unidad_solicitante'
--

INSERT INTO n_unidad_solicitante VALUES ('1','CENTRO ESTRATÉGICO DE SEGURIDAD Y PROTECCIÓN DE LA PATRIA');
INSERT INTO n_unidad_solicitante VALUES ('2','DIRECCIÓN ADJUNTA');
INSERT INTO n_unidad_solicitante VALUES ('3','DIRECCIÓN DE ESTUDIOS WEB 2.0');
INSERT INTO n_unidad_solicitante VALUES ('4','DIRECCIÓN DE ESTUDIOS SOCIALES');
INSERT INTO n_unidad_solicitante VALUES ('5','DIRECCIÓN DE ESTUDIOS TECNOLÓGICOS Y DE INFORMACIÓN');
INSERT INTO n_unidad_solicitante VALUES ('6','DIRECCIÓN DE GESTIÓN ADMINISTRATIVA');
INSERT INTO n_unidad_solicitante VALUES ('7','DIRECCIÓN DE INVESTIGACIONES SOCIALES');
INSERT INTO n_unidad_solicitante VALUES ('8','DIRECCIÓN DE SEGURIDAD INTEGRAL');


--
-- Creating index for 'n_unidad_solicitante'
--

ALTER TABLE ONLY  n_unidad_solicitante  ADD CONSTRAINT  id_unidad_solicitante  PRIMARY KEY  (id_unidad_solicitante);

--
-- Estrutura da tabela 't_animales'
--

DROP TABLE t_animales CASCADE;
CREATE TABLE t_animales (
id_animal int4 NOT NULL,
animal varchar(-5)
);

--
-- Creating data for 't_animales'
--

INSERT INTO t_animales VALUES ('1','CARNERO');
INSERT INTO t_animales VALUES ('2','TORO');
INSERT INTO t_animales VALUES ('3','CIENPIES');
INSERT INTO t_animales VALUES ('4','ALACRAN');
INSERT INTO t_animales VALUES ('5','LEON');
INSERT INTO t_animales VALUES ('6','RANA');
INSERT INTO t_animales VALUES ('7','PERICO');
INSERT INTO t_animales VALUES ('8','RATON');
INSERT INTO t_animales VALUES ('9','AGUILA');
INSERT INTO t_animales VALUES ('10','TIGRE');
INSERT INTO t_animales VALUES ('11','GATO');
INSERT INTO t_animales VALUES ('12','CABALLO');
INSERT INTO t_animales VALUES ('13','MONO');
INSERT INTO t_animales VALUES ('14','PALOMA');
INSERT INTO t_animales VALUES ('15','ZORRO');
INSERT INTO t_animales VALUES ('16','OSO');
INSERT INTO t_animales VALUES ('17','PAVO');
INSERT INTO t_animales VALUES ('18','BURRO');
INSERT INTO t_animales VALUES ('19','CHIVO');
INSERT INTO t_animales VALUES ('20','COCHINO');
INSERT INTO t_animales VALUES ('21','GALLO');
INSERT INTO t_animales VALUES ('22','CAMELLO');
INSERT INTO t_animales VALUES ('23','CEBRA');
INSERT INTO t_animales VALUES ('24','IGUANA');
INSERT INTO t_animales VALUES ('25','GALLINA');
INSERT INTO t_animales VALUES ('26','VACA');
INSERT INTO t_animales VALUES ('27','PERRO');
INSERT INTO t_animales VALUES ('28','ZAMURO');
INSERT INTO t_animales VALUES ('29','ELEFANTE');
INSERT INTO t_animales VALUES ('30','CAIMAN');
INSERT INTO t_animales VALUES ('31','LAPA');
INSERT INTO t_animales VALUES ('32','ARDILLA');
INSERT INTO t_animales VALUES ('33','PESCADO');
INSERT INTO t_animales VALUES ('34','VENADO');
INSERT INTO t_animales VALUES ('36','CULEBRA');
INSERT INTO t_animales VALUES ('35','JIRAFA');
INSERT INTO t_animales VALUES ('37','DELFIN');
INSERT INTO t_animales VALUES ('38','BALLENA');


--
-- Creating index for 't_animales'
--

ALTER TABLE ONLY  t_animales  ADD CONSTRAINT  id_animal  PRIMARY KEY  (id_animal);

--
-- Estrutura da tabela 't_estadisticas_loto'
--

DROP TABLE t_estadisticas_loto CASCADE;
CREATE TABLE t_estadisticas_loto (
animal varchar(-5),
id_estadisticas int4 NOT NULL DEFAULT nextval('t_estadisticas_loto_id_estadisticas_seq'::regclass),
dia varchar(-5),
estatus int4 DEFAULT 1,
mes varchar(-5),
loteria varchar(-5),
anio int4,
color varchar(-5),
sorteo varchar(-5)
);

--
-- Creating data for 't_estadisticas_loto'
--

INSERT INTO t_estadisticas_loto VALUES ('8','DOMINGO-1','OCTUBRE','2017','LAPA','NEGRO','9-AM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('9','DOMINGO-1','OCTUBRE','2017','PESCADO','NEGRO','11-AM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('12','DOMINGO-1','OCTUBRE','2017','GALLO','ROJO','12-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('14','DOMINGO-1','OCTUBRE','2017','CEBRA','ROJO','1-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('17','DOMINGO-1','OCTUBRE','2017','RANA','NEGRO','3-PM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('18','DOMINGO-1','OCTUBRE','2017','TORO','NEGRO','4-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('19','DOMINGO-1','OCTUBRE','2017','ELEFANTE','NEGRO','4-PM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('20','DOMINGO-1','OCTUBRE','2017','OSO','ROJO','5-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('21','DOMINGO-1','OCTUBRE','2017','CARNERO','ROJO','5-PM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('22','DOMINGO-1','OCTUBRE','2017','GALLINA','ROJO','6-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('23','DOMINGO-1','OCTUBRE','2017','OSO','ROJO','6-PM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('24','DOMINGO-1','OCTUBRE','2017','GATO','NEGRO','7-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('25','DOMINGO-1','OCTUBRE','2017','DELFIN','NEUTRO','7-PM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('27','LUNES-2','OCTUBRE','2017','TORO','NEGRO','10-AM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('29','LUNES-2','OCTUBRE','2017','ALACRAN','NEGRO','11-AM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('30','LUNES-2','OCTUBRE','2017','COCHINO','NEGRO','11-AM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('31','LUNES-2','OCTUBRE','2017','DELFIN','NEUTRO','12-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('32','LUNES-2','OCTUBRE','2017','LAPA','NEGRO','1-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('26','LUNES-2','OCTUBRE','2017','AGUILA','ROJO','9-AM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('10','DOMINGO-1','OCTUBRE','2017','BALLENA','NEUTRO','10-AM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('11','DOMINGO-1','OCTUBRE','2017','COCHINO','NEGRO','11-AM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('13','DOMINGO-1','OCTUBRE','2017','BURRO','ROJO','12-PM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('15','DOMINGO-1','OCTUBRE','2017','CEBRA','ROJO','1-PM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('16','DOMINGO-1','OCTUBRE','2017','PERRO','ROJO','2-PM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('37','LUNES-2','OCTUBRE','2017','VACA','NEGRO','3-PM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('36','LUNES-2','OCTUBRE','2017','CIEMPIES','ROJO','4-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('38','LUNES-2','OCTUBRE','2017','PAVO','NEGRO','5-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('39','LUNES-2','OCTUBRE','2017','OSO','ROJO','4-PM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('7','DOMINGO-1','OCTUBRE','2017','GALLINA','ROJO','10-AM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('35','LUNES-2','OCTUBRE','2017','RANA','ROJO','3-PM','GRANJA','0');
INSERT INTO t_estadisticas_loto VALUES ('28','LUNES-2','OCTUBRE','2017','BALLENA','NEUTRO','10-AM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('33','LUNES-2','OCTUBRE','2017','BURRO','ROJO','12-PM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('34','LUNES-2','OCTUBRE','2017','PERRO','ROJO','2-PM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('42','LUNES-2','OCTUBRE','2017','CEBRA','ROJO','1-PM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('43','LUNES-2','OCTUBRE','2017','VENADO','ROJO','6-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('44','LUNES-2','OCTUBRE','2017','RATO','NEGRO','7-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('45','MARTES-3','OCTUBRE','2017','LAPA','NEGRO','10-AM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('46','MARTES-3','OCTUBRE','2017','CAIMAN','ROJO','11-AM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('47','MARTES-3','OCTUBRE','2017','JIRAFA','NEGRO','12-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('48','MARTES-3','OCTUBRE','2017','ELEFANTE','NEGRO','1-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('49','MARTES-3','OCTUBRE','2017','MONO','NEGRO','4-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('50','MARTES-3','OCTUBRE','2017','ARDILLA','ROJO','5-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('51','MARTES-3','OCTUBRE','2017','PERICO','ROJO','7-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('52','MARTES-3','OCTUBRE','2017','GALLINA','ROJO','9-AM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('53','MARTES-3','OCTUBRE','2017','LEON','ROJO','10-AM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('54','MARTES-3','OCTUBRE','2017','CIEMPIES','ROJO','11-AM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('55','MARTES-3','OCTUBRE','2017','PAVO','NEGRO','12-AM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('56','MARTES-3','OCTUBRE','2017','PESCADO','NEGRO','1-PM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('57','MARTES-3','OCTUBRE','2017','CAIMAN','ROJO','2-PM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('58','MIERCOLES-4','OCTUBRE','2017','VENADO','ROJO','10-AM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('59','MARTES-3','OCTUBRE','2017','VENADO','ROJO','3-PM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('60','MIERCOLES-4','OCTUBRE','2017','RATO','NEGRO','11-AM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('61','MARTES-3','OCTUBRE','2017','ELEFANTE','NEGRO','4-PM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('62','MIERCOLES-4','OCTUBRE','2017','BURRO','ROJO','12-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('63','MARTES-3','OCTUBRE','2017','CULEBRA','ROJO','5-PM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('64','MIERCOLES-4','OCTUBRE','2017','COCHINO','NEGRO','1-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('65','MARTES-3','OCTUBRE','2017','RATO','NEGRO','6-PM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('66','MARTES-3','OCTUBRE','2017','ARDILLA','ROJO','7-PM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('67','MIERCOLES-4','OCTUBRE','2017','PERICO','ROJO','4-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('68','MIERCOLES-4','OCTUBRE','2017','PALOMA','ROJO','9-AM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('69','MIERCOLES-4','OCTUBRE','2017','JIRAFA','NEGRO','10-AM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('70','MIERCOLES-4','OCTUBRE','2017','DELFIN','NEUTRO','11-AM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('71','MIERCOLES-4','OCTUBRE','2017','DELFIN','NEUTRO','5-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('72','MIERCOLES-4','OCTUBRE','2017','VACA','NEGRO','12-AM','GRANJA','1');
INSERT INTO t_estadisticas_loto VALUES ('73','MIERCOLES-4','OCTUBRE','2017','RANA','NEGRO','6-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('74','MIERCOLES-4','OCTUBRE','2017','CAIMAN','ROJO','7-PM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('76','JUEVES-5','OCTUBRE','2017','CIEMPIES','ROJO','11-AM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('75','JUEVES-5','OCTUBRE','2017','ZORRO','NEGRO','10-AM','LOTTO ACTIVO','1');
INSERT INTO t_estadisticas_loto VALUES ('77','JUEVES-5','OCTUBRE','2017','CAMELLO','NEGRO','12-PM','LOTTO ACTIVO','1');


--
-- Creating index for 't_estadisticas_loto'
--

ALTER TABLE ONLY  t_estadisticas_loto  ADD CONSTRAINT  id_estadisticas  PRIMARY KEY  (id_estadisticas);

--
-- Estrutura da tabela 't_usuarios'
--

DROP TABLE t_usuarios CASCADE;
CREATE TABLE t_usuarios (
apellidos varchar(50),
clave varchar(-5),
fecha_registro date DEFAULT now(),
id_usuario int4 NOT NULL DEFAULT nextval('t_usuarios_id_usuario_seq'::regclass),
usuario varchar(50),
estatus bool DEFAULT true,
correo varchar(50),
cedula varchar(30),
nombres varchar(50),
rol int2
);

--
-- Creating data for 't_usuarios'
--

INSERT INTO t_usuarios VALUES ('2','12345678','Richard','BRITO',NULL,'2017-08-10','LUIS','25d55ad283aa400af464c76d713c07ad','t','1');
INSERT INTO t_usuarios VALUES ('3','12345679','Michel','Brito','','2017-11-15','DEBANHI','25d55ad283aa400af464c76d713c07ad','t','1');


--
-- Creating index for 't_usuarios'
--

ALTER TABLE ONLY  t_usuarios  ADD CONSTRAINT  id_usuario  PRIMARY KEY  (id_usuario);
