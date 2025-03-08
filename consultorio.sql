-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-03-2025 a las 05:48:48
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `consultorio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `appointment`
--

CREATE TABLE `appointment` (
  `codcit` int(11) NOT NULL,
  `dates` date NOT NULL,
  `hour` time NOT NULL,
  `codpaci` int(11) NOT NULL,
  `coddoc` int(11) NOT NULL,
  `codespe` int(11) NOT NULL,
  `estado` char(1) NOT NULL,
  `fecha_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `appointment`
--

INSERT INTO `appointment` (`codcit`, `dates`, `hour`, `codpaci`, `coddoc`, `codespe`, `estado`, `fecha_create`) VALUES
(5, '2024-08-31', '23:00:00', 1, 2, 4, '1', '2024-09-01 02:41:33'),
(6, '2025-02-05', '15:26:00', 1, 2, 4, '1', '2025-02-04 19:27:27'),
(7, '2025-02-06', '11:18:00', 15, 2, 4, '1', '2025-02-05 03:19:07'),
(8, '2025-02-06', '13:22:00', 1, 2, 4, '1', '2025-02-05 03:20:58'),
(9, '2025-03-08', '10:56:00', 1, 2, 4, '1', '2025-03-08 03:21:24'),
(10, '2025-03-09', '07:14:00', 1, 2, 4, '1', '2025-03-08 04:22:06'),
(11, '2025-03-08', '08:20:00', 1, 2, 4, '1', '2025-03-08 04:22:01'),
(12, '2025-03-10', '08:34:00', 1, 2, 4, '0', '2025-03-08 04:35:09');

--
-- Disparadores `appointment`
--
DELIMITER $$
CREATE TRIGGER `after_insert_appointment` AFTER INSERT ON `appointment` FOR EACH ROW BEGIN
    INSERT INTO auditoria (tabla, accion, cod_registro, datos)
    VALUES ('appointment', 'INSERT', NEW.codcit, CONCAT_WS(',', NEW.codcit, NEW.dates, NEW.hour, NEW.codpaci, NEW.coddoc, NEW.codespe, NEW.estado, NEW.fecha_create));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_appointment` AFTER UPDATE ON `appointment` FOR EACH ROW BEGIN
    INSERT INTO auditoria (tabla, accion, cod_registro, datos)
    VALUES ('appointment', 'UPDATE', NEW.codcit, CONCAT_WS(',', NEW.codcit, NEW.dates, NEW.hour, NEW.codpaci, NEW.coddoc, NEW.codespe, NEW.estado, NEW.fecha_create));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id_auditoria` int(11) NOT NULL,
  `tabla` varchar(50) DEFAULT NULL,
  `accion` varchar(50) DEFAULT NULL,
  `cod_registro` int(11) DEFAULT NULL,
  `datos` text DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`id_auditoria`, `tabla`, `accion`, `cod_registro`, `datos`, `fecha`) VALUES
(1, 'appointment', 'UPDATE', 9, '9,2025-03-08,10:56:00,1,2,4,1,2025-03-07 23:21:24', '2025-03-08 03:21:24'),
(2, 'appointment', 'INSERT', 10, '10,2025-03-09,07:14:00,1,2,4,0,2025-03-08 00:15:18', '2025-03-08 04:15:18'),
(3, 'appointment', 'INSERT', 11, '11,2025-03-08,08:20:00,1,2,4,0,2025-03-08 00:21:33', '2025-03-08 04:21:33'),
(4, 'appointment', 'UPDATE', 11, '11,2025-03-08,08:20:00,1,2,4,1,2025-03-08 00:22:01', '2025-03-08 04:22:01'),
(5, 'appointment', 'UPDATE', 10, '10,2025-03-09,07:14:00,1,2,4,1,2025-03-08 00:22:06', '2025-03-08 04:22:06'),
(6, 'appointment', 'INSERT', 12, '12,2025-03-10,08:34:00,1,2,4,0,2025-03-08 00:35:09', '2025-03-08 04:35:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `codpaci` int(11) NOT NULL,
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
  `fecha_nacimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`codpaci`, `dnipa`, `nombrep`, `apellidop`, `seguro`, `tele`, `sexo`, `cargo`, `usuario`, `clave`, `estado`, `fecha_create`, `fecha_nacimiento`) VALUES
(1, '7574583', 'Manuel', 'Aparicio', 'Si', '424336390', 'Masculino', '2', 'manu', '$2y$10$wpq1r2y5JlhBFt2DGSCQTOSuMl8RNyP7bgdTnYlPK91OITvlAoaeO', '1', '2025-02-04 19:53:55', '2009-01-25'),
(15, '30091322', 'Juan', 'Bolívar', 'Si', '042433639', 'Masculino', '2', 'prueba', '$2y$10$94nb52rHmdwrDv1r7HPFiO/1Hh7tcvKE5gUu4G0swNMpA88GEebr.', '1', '2024-12-02 00:41:19', '2010-01-15');

--
-- Disparadores `customers`
--
DELIMITER $$
CREATE TRIGGER `after_insert_customers` AFTER INSERT ON `customers` FOR EACH ROW BEGIN
    INSERT INTO auditoria (tabla, accion, cod_registro, datos)
    VALUES ('customers', 'INSERT', NEW.codpaci, CONCAT_WS(',', NEW.codpaci, NEW.dnipa, NEW.nombrep, NEW.apellidop, NEW.seguro, NEW.tele, NEW.sexo, NEW.cargo, NEW.usuario, NEW.clave, NEW.estado, NEW.fecha_create, NEW.fecha_nacimiento));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_customers` AFTER UPDATE ON `customers` FOR EACH ROW BEGIN
    INSERT INTO auditoria (tabla, accion, cod_registro, datos)
    VALUES ('customers', 'UPDATE', NEW.codpaci, CONCAT_WS(',', NEW.codpaci, NEW.dnipa, NEW.nombrep, NEW.apellidop, NEW.seguro, NEW.tele, NEW.sexo, NEW.cargo, NEW.usuario, NEW.clave, NEW.estado, NEW.fecha_create, NEW.fecha_nacimiento));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctor`
--

CREATE TABLE `doctor` (
  `coddoc` int(11) NOT NULL,
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
  `fecha_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctor`
--

INSERT INTO `doctor` (`coddoc`, `dnidoc`, `nomdoc`, `apedoc`, `codespe`, `sexo`, `telefo`, `fechanaci`, `correo`, `naciona`, `estado`, `fecha_create`) VALUES
(2, '11187524', 'Yenitze', 'Perdomo', 4, 'Masculino', '042430807', '1995-09-09', 'example@gmail.com', 'Castor Nieves Rios', '1', '2024-09-13 16:06:49');

--
-- Disparadores `doctor`
--
DELIMITER $$
CREATE TRIGGER `after_insert_doctor` AFTER INSERT ON `doctor` FOR EACH ROW BEGIN
    INSERT INTO auditoria (tabla, accion, cod_registro, datos)
    VALUES ('doctor', 'INSERT', NEW.coddoc, CONCAT_WS(',', NEW.coddoc, NEW.dnidoc, NEW.nomdoc, NEW.apedoc, NEW.codespe, NEW.sexo, NEW.telefo, NEW.fechanaci, NEW.correo, NEW.naciona, NEW.estado, NEW.fecha_create));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_doctor` AFTER UPDATE ON `doctor` FOR EACH ROW BEGIN
    INSERT INTO auditoria (tabla, accion, cod_registro, datos)
    VALUES ('doctor', 'UPDATE', NEW.coddoc, CONCAT_WS(',', NEW.coddoc, NEW.dnidoc, NEW.nomdoc, NEW.apedoc, NEW.codespe, NEW.sexo, NEW.telefo, NEW.fechanaci, NEW.correo, NEW.naciona, NEW.estado, NEW.fecha_create));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_cambios`
--

CREATE TABLE `historial_cambios` (
  `id` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `campo` varchar(50) NOT NULL,
  `valor_anterior` text NOT NULL,
  `valor_nuevo` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_medica_normal`
--

CREATE TABLE `historia_medica_normal` (
  `id_historia` int(11) NOT NULL,
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
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `historia_medica_normal`
--

INSERT INTO `historia_medica_normal` (`id_historia`, `fecha`, `nombre_madre`, `nombre_padre`, `fecha_nacimiento`, `peso`, `talla`, `perimetro_cefalico`, `direccion`, `telefono`, `temperatura`, `saturacion_oxigeno`, `pulso`, `presion_arterial`, `respiracion`, `antecedentes_familiares`, `antecedentes_personales`, `examen_ojos`, `examen_nariz`, `examen_oidos`, `examen_boca`, `examen_cuello`, `examen_torax`, `examen_corazon`, `examen_pulmones`, `examen_abdomen`, `examen_genitales`, `examen_articulaciones`, `diagnostico_tratamiento`, `id_paciente`) VALUES
(13, '2025-01-15', 'Prueba', 'Pruebas', '2010-01-15', 35.00, 30.00, '30', 'El Bosque', '04243363970', 12, 12, 121, '21', 21, 'Bien', 'Bien', 'Bien', 'Bien', 'Bien', 'Bien', 'Bien', 'Bien', 'Bien', 'Bien', 'Bien', 'Bien', 'Bien', 'Bien', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `codhor` int(11) NOT NULL,
  `nomhor` varchar(30) NOT NULL,
  `coddoc` int(11) NOT NULL,
  `estado` char(1) NOT NULL,
  `fere` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `codcit` int(11) NOT NULL,
  `codpaci` int(11) NOT NULL,
  `coddoc` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `monto_bs` decimal(10,2) NOT NULL,
  `metodo_pago` int(11) NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id_pago`, `codcit`, `codpaci`, `coddoc`, `monto`, `monto_bs`, `metodo_pago`, `referencia`, `fecha`) VALUES
(4, 5, 1, 2, 10.00, 587.94, 1, '0102', '2025-02-04 20:39:05'),
(5, 6, 1, 2, 20.00, 1175.88, 1, '0105', '2025-02-05 03:23:15');

--
-- Disparadores `pagos`
--
DELIMITER $$
CREATE TRIGGER `after_insert_pagos` AFTER INSERT ON `pagos` FOR EACH ROW BEGIN
    INSERT INTO auditoria (tabla, accion, cod_registro, datos)
    VALUES ('pagos', 'INSERT', NEW.id_pago, CONCAT_WS(',', NEW.id_pago, NEW.codcit, NEW.codpaci, NEW.coddoc, NEW.monto, NEW.monto_bs, NEW.metodo_pago, NEW.referencia, NEW.fecha));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_pagos` AFTER UPDATE ON `pagos` FOR EACH ROW BEGIN
    INSERT INTO auditoria (tabla, accion, cod_registro, datos)
    VALUES ('pagos', 'UPDATE', NEW.id_pago, CONCAT_WS(',', NEW.id_pago, NEW.codcit, NEW.codpaci, NEW.coddoc, NEW.monto, NEW.monto_bs, NEW.metodo_pago, NEW.referencia, NEW.fecha));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `specialty`
--

CREATE TABLE `specialty` (
  `codespe` int(11) NOT NULL,
  `nombrees` varchar(50) NOT NULL,
  `fecha_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `specialty`
--

INSERT INTO `specialty` (`codespe`, `nombrees`, `fecha_create`) VALUES
(4, 'Pediatría', '2020-09-28 02:41:59');

--
-- Disparadores `specialty`
--
DELIMITER $$
CREATE TRIGGER `after_insert_specialty` AFTER INSERT ON `specialty` FOR EACH ROW BEGIN
    INSERT INTO auditoria (tabla, accion, cod_registro, datos)
    VALUES ('specialty', 'INSERT', NEW.codespe, CONCAT_WS(',', NEW.codespe, NEW.nombrees, NEW.fecha_create));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_specialty` AFTER UPDATE ON `specialty` FOR EACH ROW BEGIN
    INSERT INTO auditoria (tabla, accion, cod_registro, datos)
    VALUES ('specialty', 'UPDATE', NEW.codespe, CONCAT_WS(',', NEW.codespe, NEW.nombrees, NEW.fecha_create));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `cargo` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `email`, `clave`, `cargo`) VALUES
(1, 'Yenitze Perdomo', 'Admin', 'yenitze@hotmail.com', 'e3afed0047b08059d0fada10f400c1e5', '1');

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `after_insert_usuarios` AFTER INSERT ON `usuarios` FOR EACH ROW BEGIN
    INSERT INTO auditoria (tabla, accion, cod_registro, datos)
    VALUES ('usuarios', 'INSERT', NEW.id, CONCAT_WS(',', NEW.id, NEW.nombre, NEW.usuario, NEW.email, NEW.clave, NEW.cargo));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_update_usuarios` AFTER UPDATE ON `usuarios` FOR EACH ROW BEGIN
    INSERT INTO auditoria (tabla, accion, cod_registro, datos)
    VALUES ('usuarios', 'UPDATE', NEW.id, CONCAT_WS(',', NEW.id, NEW.nombre, NEW.usuario, NEW.email, NEW.clave, NEW.cargo));
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`codcit`),
  ADD KEY `codpaci` (`codpaci`,`coddoc`,`codespe`),
  ADD KEY `coddoc` (`coddoc`),
  ADD KEY `codespe` (`codespe`);

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id_auditoria`);

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`codpaci`);

--
-- Indices de la tabla `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`coddoc`),
  ADD KEY `codespe` (`codespe`);

--
-- Indices de la tabla `historial_cambios`
--
ALTER TABLE `historial_cambios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historia_medica_normal`
--
ALTER TABLE `historia_medica_normal`
  ADD PRIMARY KEY (`id_historia`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`codhor`),
  ADD KEY `coddoc` (`coddoc`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`);

--
-- Indices de la tabla `specialty`
--
ALTER TABLE `specialty`
  ADD PRIMARY KEY (`codespe`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `appointment`
--
ALTER TABLE `appointment`
  MODIFY `codcit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id_auditoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `customers`
--
ALTER TABLE `customers`
  MODIFY `codpaci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `doctor`
--
ALTER TABLE `doctor`
  MODIFY `coddoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `historial_cambios`
--
ALTER TABLE `historial_cambios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historia_medica_normal`
--
ALTER TABLE `historia_medica_normal`
  MODIFY `id_historia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `codhor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `specialty`
--
ALTER TABLE `specialty`
  MODIFY `codespe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`codpaci`) REFERENCES `customers` (`codpaci`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`coddoc`) REFERENCES `doctor` (`coddoc`),
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`codespe`) REFERENCES `specialty` (`codespe`);

--
-- Filtros para la tabla `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`codespe`) REFERENCES `specialty` (`codespe`);

--
-- Filtros para la tabla `historia_medica_normal`
--
ALTER TABLE `historia_medica_normal`
  ADD CONSTRAINT `historia_medica_normal_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `customers` (`codpaci`);

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`coddoc`) REFERENCES `doctor` (`coddoc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
