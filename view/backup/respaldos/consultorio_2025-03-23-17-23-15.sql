DROP TABLE IF EXISTS `appointment`;
CREATE TABLE `appointment` (
  `codcit` int(11) NOT NULL AUTO_INCREMENT,
  `dates` date NOT NULL,
  `hour` time NOT NULL,
  `codpaci` int(11) NOT NULL,
  `coddoc` int(11) NOT NULL,
  `codespe` int(11) NOT NULL,
  `estado` char(1) NOT NULL,
  `fecha_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`codcit`),
  KEY `codpaci` (`codpaci`,`coddoc`,`codespe`),
  KEY `coddoc` (`coddoc`),
  KEY `codespe` (`codespe`),
  CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`codpaci`) REFERENCES `customers` (`codpaci`),
  CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`coddoc`) REFERENCES `doctor` (`coddoc`),
  CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`codespe`) REFERENCES `specialty` (`codespe`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `appointment` VALUES ('5','2024-08-31','23:00:00','1','2','4','1','2024-08-31 22:41:33');
INSERT INTO `appointment` VALUES ('6','2025-02-05','15:26:00','1','2','4','1','2025-02-04 15:27:27');
INSERT INTO `appointment` VALUES ('7','2025-02-06','11:18:00','15','2','4','1','2025-02-04 23:19:07');
INSERT INTO `appointment` VALUES ('8','2025-02-06','13:22:00','1','2','4','1','2025-02-04 23:20:58');
INSERT INTO `appointment` VALUES ('9','2025-03-08','10:56:00','1','2','4','1','2025-03-07 23:21:24');
INSERT INTO `appointment` VALUES ('10','2025-03-09','07:14:00','1','2','4','1','2025-03-08 00:22:06');
INSERT INTO `appointment` VALUES ('11','2025-03-08','08:20:00','1','2','4','1','2025-03-08 00:22:01');
INSERT INTO `appointment` VALUES ('12','2025-03-10','08:34:00','1','2','4','0','2025-03-08 00:35:09');

DROP TABLE IF EXISTS `auditoria`;
CREATE TABLE `auditoria` (
  `id_auditoria` int(11) NOT NULL AUTO_INCREMENT,
  `tabla` varchar(50) DEFAULT NULL,
  `accion` varchar(50) DEFAULT NULL,
  `cod_registro` int(11) DEFAULT NULL,
  `datos` text DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_auditoria`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `auditoria` VALUES ('1','appointment','UPDATE','9','9,2025-03-08,10:56:00,1,2,4,1,2025-03-07 23:21:24','2025-03-07 23:21:24');
INSERT INTO `auditoria` VALUES ('2','appointment','INSERT','10','10,2025-03-09,07:14:00,1,2,4,0,2025-03-08 00:15:18','2025-03-08 00:15:18');
INSERT INTO `auditoria` VALUES ('3','appointment','INSERT','11','11,2025-03-08,08:20:00,1,2,4,0,2025-03-08 00:21:33','2025-03-08 00:21:33');
INSERT INTO `auditoria` VALUES ('4','appointment','UPDATE','11','11,2025-03-08,08:20:00,1,2,4,1,2025-03-08 00:22:01','2025-03-08 00:22:01');
INSERT INTO `auditoria` VALUES ('5','appointment','UPDATE','10','10,2025-03-09,07:14:00,1,2,4,1,2025-03-08 00:22:06','2025-03-08 00:22:06');
INSERT INTO `auditoria` VALUES ('6','appointment','INSERT','12','12,2025-03-10,08:34:00,1,2,4,0,2025-03-08 00:35:09','2025-03-08 00:35:09');
INSERT INTO `auditoria` VALUES ('7','usuarios','INSERT','3','3,Prueba,Prueba,jmrm19722@gmail.com,f6015242d72929144748c476840db4b4,3','2025-03-21 22:33:02');
INSERT INTO `auditoria` VALUES ('8','usuarios','INSERT','4','4,Pruebas,Pruebas,gramolca@gmail.com,f6015242d72929144748c476840db4b4,4','2025-03-22 00:19:17');
INSERT INTO `auditoria` VALUES ('9','usuarios','UPDATE','3','3,Secretaria,Secretaria,secretaria@gmail.com,f6015242d72929144748c476840db4b4,1','2025-03-22 00:40:10');
INSERT INTO `auditoria` VALUES ('10','usuarios','UPDATE','4','4,Medico,Medico,medico@gmail.com,f6015242d72929144748c476840db4b4,1','2025-03-22 00:40:58');
INSERT INTO `auditoria` VALUES ('11','usuarios','UPDATE','4','4,Medico,Medico,medico@gmail.com,f6015242d72929144748c476840db4b4,4','2025-03-22 00:41:32');
INSERT INTO `auditoria` VALUES ('12','usuarios','UPDATE','3','3,Secretaria,Secretaria,secretaria@gmail.com,f6015242d72929144748c476840db4b4,3','2025-03-22 00:41:37');
INSERT INTO `auditoria` VALUES ('13','usuarios','UPDATE','4','4,Zaidelys Rondón,Medico,medico@gmail.com,f6015242d72929144748c476840db4b4,4','2025-03-23 09:37:05');
INSERT INTO `auditoria` VALUES ('14','usuarios','UPDATE','3','3,Lilian Quintero,Secretaria,secretaria@gmail.com,f6015242d72929144748c476840db4b4,3','2025-03-23 09:39:34');

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `codpaci` int(11) NOT NULL AUTO_INCREMENT,
  `dnipa` char(8) NOT NULL,
  `nombrep` varchar(50) NOT NULL,
  `apellidop` varchar(50) NOT NULL,
  `seguro` char(10) NOT NULL,
  `tele` char(9) NOT NULL,
  `sexo` char(15) NOT NULL,
  `cargo` char(1) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `fecha_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_nacimiento` date DEFAULT NULL,
  PRIMARY KEY (`codpaci`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `customers` VALUES ('1','7574583','Manuel','Aparicio','Si','424336390','Masculino','2','manu','$2y$10$wpq1r2y5JlhBFt2DGSCQTOSuMl8RNyP7bgdTnYlPK91OITvlAoaeO','1','2025-02-04 15:53:55','2009-01-25');
INSERT INTO `customers` VALUES ('15','30091322','Juan','Bolívar','Si','042433639','Masculino','2','prueba','$2y$10$94nb52rHmdwrDv1r7HPFiO/1Hh7tcvKE5gUu4G0swNMpA88GEebr.','1','2024-12-01 20:41:19','2010-01-15');

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE `doctor` (
  `coddoc` int(11) NOT NULL AUTO_INCREMENT,
  `dnidoc` char(8) NOT NULL,
  `nomdoc` varchar(50) NOT NULL,
  `apedoc` varchar(50) NOT NULL,
  `codespe` int(11) NOT NULL,
  `sexo` char(15) NOT NULL,
  `telefo` char(9) NOT NULL,
  `fechanaci` date NOT NULL,
  `correo` varchar(50) NOT NULL,
  `naciona` varchar(35) NOT NULL,
  `estado` char(15) NOT NULL,
  `fecha_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`coddoc`),
  KEY `codespe` (`codespe`),
  CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`codespe`) REFERENCES `specialty` (`codespe`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `doctor` VALUES ('2','11187524','Yenitze','Perdomo','4','Masculino','042430807','1995-09-09','example@gmail.com','Castor Nieves Rios','1','2024-09-13 12:06:49');

DROP TABLE IF EXISTS `historia_medica_normal`;
CREATE TABLE `historia_medica_normal` (
  `id_historia` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `nombre_madre` varchar(255) NOT NULL,
  `nombre_padre` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `talla` decimal(5,2) DEFAULT NULL,
  `perimetro_cefalico` text NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` text NOT NULL,
  `temperatura` float DEFAULT NULL,
  `saturacion_oxigeno` float DEFAULT NULL,
  `pulso` int(11) DEFAULT NULL,
  `presion_arterial` varchar(50) DEFAULT NULL,
  `respiracion` int(11) DEFAULT NULL,
  `antecedentes_familiares` text DEFAULT NULL,
  `antecedentes_personales` text DEFAULT NULL,
  `examen_ojos` text DEFAULT NULL,
  `examen_nariz` text DEFAULT NULL,
  `examen_oidos` text DEFAULT NULL,
  `examen_boca` text DEFAULT NULL,
  `examen_cuello` text DEFAULT NULL,
  `examen_torax` text DEFAULT NULL,
  `examen_corazon` text DEFAULT NULL,
  `examen_pulmones` text DEFAULT NULL,
  `examen_abdomen` text DEFAULT NULL,
  `examen_genitales` text DEFAULT NULL,
  `examen_articulaciones` text DEFAULT NULL,
  `diagnostico_tratamiento` text DEFAULT NULL,
  `id_paciente` int(11) NOT NULL,
  PRIMARY KEY (`id_historia`),
  KEY `id_paciente` (`id_paciente`),
  CONSTRAINT `historia_medica_normal_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `customers` (`codpaci`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO `historia_medica_normal` VALUES ('13','2025-01-15','Prueba','Pruebas','2010-01-15','35.00','30.00','30','El Bosque','04243363970','12','12','121','21','21','Bien','Bien','Bien','Bien','Bien','Bien','Bien','Bien','Bien','Bien','Bien','Bien','Bien','Bien','15');

DROP TABLE IF EXISTS `historial_cambios`;
CREATE TABLE `historial_cambios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `campo` varchar(50) NOT NULL,
  `valor_anterior` text NOT NULL,
  `valor_nuevo` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `horario`;
CREATE TABLE `horario` (
  `codhor` int(11) NOT NULL AUTO_INCREMENT,
  `nomhor` varchar(30) NOT NULL,
  `coddoc` int(11) NOT NULL,
  `estado` char(1) NOT NULL,
  `fere` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`codhor`),
  KEY `coddoc` (`coddoc`),
  CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`coddoc`) REFERENCES `doctor` (`coddoc`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `pagos`;
CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL AUTO_INCREMENT,
  `codcit` int(11) NOT NULL,
  `codpaci` int(11) NOT NULL,
  `coddoc` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `monto_bs` decimal(10,2) NOT NULL,
  `metodo_pago` int(11) NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_pago`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `pagos` VALUES ('4','5','1','2','10.00','587.94','1','0102','2025-02-04 16:39:05');
INSERT INTO `pagos` VALUES ('5','6','1','2','20.00','1175.88','1','0105','2025-02-04 23:23:15');

DROP TABLE IF EXISTS `specialty`;
CREATE TABLE `specialty` (
  `codespe` int(11) NOT NULL AUTO_INCREMENT,
  `nombrees` varchar(50) NOT NULL,
  `fecha_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`codespe`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `specialty` VALUES ('4','Pediatría','2020-09-27 22:41:59');

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `cargo` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `usuarios` VALUES ('1','Yenitze Perdomo','Admin','yenitze@hotmail.com','e3afed0047b08059d0fada10f400c1e5','1');
INSERT INTO `usuarios` VALUES ('3','Lilian Quintero','Secretaria','secretaria@gmail.com','f6015242d72929144748c476840db4b4','3');
INSERT INTO `usuarios` VALUES ('4','Zaidelys Rondón','Medico','medico@gmail.com','f6015242d72929144748c476840db4b4','4');

