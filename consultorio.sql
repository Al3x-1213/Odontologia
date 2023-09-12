-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 04-09-2023 a las 15:33:04
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

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
-- Estructura de tabla para la tabla `alergias`
--

CREATE TABLE `alergias` (
  `id_alergia` int(1) NOT NULL,
  `alergia` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alergias`
--

INSERT INTO `alergias` (`id_alergia`, `alergia`) VALUES
(1, 'Sin alergia'),
(2, 'con alergia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `causa_consulta`
--

CREATE TABLE `causa_consulta` (
  `id_causa_consulta` int(1) NOT NULL,
  `causa_consulta` varchar(80) NOT NULL,
  `id_seguro` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `causa_consulta`
--

INSERT INTO `causa_consulta` (`id_causa_consulta`, `causa_consulta`, `id_seguro`) VALUES
(1, 'Consulta Diagnóstica', 1),
(2, 'Limpieza Bucal', 1),
(3, 'Blanqueamiento Dental', 1),
(4, 'Extracción de Dientes', 1),
(5, 'Obturación de Caries', 1),
(6, 'Dientes Artificiales / Dentadura Postiza', 1),
(7, 'Tratamiento para Alineación Dental', 1),
(8, 'Estética', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id_consulta` int(4) NOT NULL,
  `id_paciente` int(3) NOT NULL,
  `id_causa_consulta` int(1) NOT NULL,
  `fecha_atencion` date NOT NULL,
  `id_turno_consulta` int(1) NOT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `id_doctor` int(1) NOT NULL,
  `id_status_consulta` int(1) NOT NULL,
  `fecha_solicitud` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id_consulta`, `id_paciente`, `id_causa_consulta`, `fecha_atencion`, `id_turno_consulta`, `hora_inicio`, `hora_fin`, `id_doctor`, `id_status_consulta`, `fecha_solicitud`) VALUES
(1, 2, 2, '2023-08-04', 2, '13:30:00', '14:00:00', 1, 1, '2023-08-03'),
(2, 3, 5, '2023-08-04', 2, '14:00:00', '15:00:00', 1, 1, '2023-08-03'),
(3, 4, 2, '2023-08-04', 2, '15:00:00', '15:30:00', 1, 2, '2023-08-03'),
(4, 5, 1, '2023-08-07', 1, '08:00:00', '08:30:00', 1, 2, '2023-08-03'),
(5, 6, 2, '2023-08-08', 2, '13:00:00', '13:30:00', 1, 2, '2023-08-03'),
(6, 9, 1, '2023-08-24', 1, '00:00:00', '00:00:00', 3, 1, '2023-08-23'),
(7, 9, 2, '2023-08-25', 1, '00:00:00', '00:00:00', 1, 2, '2023-08-01'),
(8, 4, 1, '2023-08-31', 1, NULL, NULL, 1, 3, '2023-08-30'),
(9, 9, 6, '2023-09-01', 1, '08:45:00', '09:30:00', 3, 2, '2023-08-30'),
(10, 4, 6, '2023-09-01', 2, '23:43:00', '00:00:00', 3, 2, '2023-08-30'),
(12, 12, 5, '2023-09-01', 1, NULL, NULL, 3, 3, '2023-08-30'),
(13, 17, 1, '2023-09-01', 1, NULL, NULL, 3, 3, '2023-08-30'),
(14, 18, 4, '2023-09-01', 1, NULL, NULL, 3, 3, '2023-08-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discapacidad`
--

CREATE TABLE `discapacidad` (
  `id_discapacidad` int(1) NOT NULL,
  `discapacidad` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `discapacidad`
--

INSERT INTO `discapacidad` (`id_discapacidad`, `discapacidad`) VALUES
(1, 'Sin discapacidad'),
(2, 'Con discapacidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctores`
--

CREATE TABLE `doctores` (
  `id_doctor` int(1) NOT NULL,
  `id_usuario` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `doctores`
--

INSERT INTO `doctores` (`id_doctor`, `id_usuario`) VALUES
(1, 1),
(2, 7),
(3, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguro`
--

CREATE TABLE `seguro` (
  `id_seguro` int(1) NOT NULL,
  `seguro` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `seguro`
--

INSERT INTO `seguro` (`id_seguro`, `seguro`) VALUES
(1, 'Sin seguro'),
(2, 'Con seguro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_consulta`
--

CREATE TABLE `status_consulta` (
  `id_status_consulta` int(1) NOT NULL,
  `status_consulta` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `status_consulta`
--

INSERT INTO `status_consulta` (`id_status_consulta`, `status_consulta`) VALUES
(1, 'Atendido'),
(2, 'No atendido'),
(3, 'Por confirmar'),
(4, 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_usuario`
--

CREATE TABLE `status_usuario` (
  `id_status_usuario` int(1) NOT NULL,
  `status_usuario` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `status_usuario`
--

INSERT INTO `status_usuario` (`id_status_usuario`, `status_usuario`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'Sin cuenta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(1) NOT NULL,
  `tipo_usuario` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `tipo_usuario`) VALUES
(1, 'Administrador'),
(2, 'Paciente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno_consulta`
--

CREATE TABLE `turno_consulta` (
  `id_turno_consulta` int(1) NOT NULL,
  `turno_consulta` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `turno_consulta`
--

INSERT INTO `turno_consulta` (`id_turno_consulta`, `turno_consulta`) VALUES
(1, 'Mañana'),
(2, 'Tarde');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(3) NOT NULL,
  `usuario` varchar(30) DEFAULT NULL,
  `clave` varchar(50) DEFAULT NULL,
  `id_tipo_usuario` int(1) NOT NULL,
  `id_status_usuario` int(1) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) NOT NULL,
  `cedula` int(8) NOT NULL,
  `edad` int(2) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono_1` varchar(11) NOT NULL,
  `telefono_2` varchar(11) DEFAULT NULL,
  `correo` varchar(60) NOT NULL,
  `id_discapacidad` int(1) DEFAULT NULL,
  `id_alergia` int(1) DEFAULT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `clave`, `id_tipo_usuario`, `id_status_usuario`, `nombre`, `apellido`, `cedula`, `edad`, `fecha_nacimiento`, `telefono_1`, `telefono_2`, `correo`, `id_discapacidad`, `id_alergia`, `fecha_registro`) VALUES
(1, 'marisoldiaz', '4955683d760e39b8839cfd5d51db2133', 1, 1, 'Marisol', 'Díaz', 12345678, 54, '1969-07-10', '04147483647', '', 'marisoldiaz@gmail.com', 2, 1, '2023-08-03'),
(2, '', '', 2, 3, 'Andrea', 'Marques', 13045268, 47, '1976-06-20', '0412457634', '', 'andremarques2006', 2, 1, '2023-08-03'),
(3, '', '', 2, 3, 'Angelica', 'Fuentes', 25324785, 28, '1995-03-07', '04165421786', '', 'angiefuentes95@gmail.com', 2, 1, '2023-08-03'),
(4, '', '', 2, 3, 'Francisco', 'Castellano', 12754622, 48, '1974-09-14', '04243256487', '', 'franciscoc14@hotmail.com', 2, 1, '2023-08-03'),
(5, '', '', 2, 3, 'Marta', 'Osorio', 8125496, 56, '1967-01-17', '04263245698', '', 'osoriomarta1967@hotmail.com', 2, 1, '2023-08-03'),
(6, '', '', 2, 3, 'Saul', 'Peña', 28564128, 22, '2000-11-08', '04125487632', '', 'saulpeña08@gmail.com', 2, 1, '2023-08-03'),
(7, 'veronicatrias', '4955683d760e39b8839cfd5d51db2133', 1, 1, 'Veronica', 'Trias', 30565326, 18, '2004-09-03', '04128050440', '02121234567', 'veronicatrias@gmail.com', 1, 1, '2023-08-23'),
(8, 'alex1213', '5d41402abc4b2a76b9719d911017c592', 1, 1, 'Alejandro', 'Urdaneta', 32165498, 22, '2000-12-13', '04242124928', '02123216549', 'alejandrourdaneta@gmail.com', 1, 1, '2023-08-23'),
(9, 'david123', 'b60f15385b905be9c977c59aa3420fd2', 2, 1, 'David', 'Trias', 45678912, 12, '2010-09-25', '04124567891', '', 'davidtrias@gmail.com', 1, 1, '2023-08-23'),
(12, NULL, NULL, 2, 3, 'angeli', 'guillen', 23443646, 32, '2023-08-30', '0464345054', '436634564', 'a@h.com', 1, 1, '2023-08-30'),
(17, NULL, NULL, 2, 3, 'alex', 'urdaneta', 28424292, 22, '2000-12-13', '04242124928', '02124812132', 'alejandrourdaneta1213@gmail.com', 1, 2, '2023-08-30'),
(18, NULL, NULL, 2, 3, 'elwin', 'Tusa', 54234534, 0, '2023-08-01', '12345678909', '23456789098', 'et@h.com', 1, 2, '2023-08-30'),
(20, 'yoao', '1234', 2, 1, 'joao', 'perez', 34562534, 38, '2000-09-01', '22324563465', '25465464524', 'joaoperez@hotmail.com', 1, 1, '2023-09-02'),
(21, 'alexito', '4515618360b4cad0eb3a09225c07dfd4', 2, 1, 'alexis', 'arias', 34563255, 20, '2003-06-11', '43524359435', '43524359435', 'aarias@hotmail.com', 1, 1, '2023-09-02');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alergias`
--
ALTER TABLE `alergias`
  ADD PRIMARY KEY (`id_alergia`);

--
-- Indices de la tabla `causa_consulta`
--
ALTER TABLE `causa_consulta`
  ADD PRIMARY KEY (`id_causa_consulta`),
  ADD KEY `id_seguro` (`id_seguro`);

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id_consulta`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `id_causa_consulta` (`id_causa_consulta`),
  ADD KEY `id_doctor` (`id_doctor`),
  ADD KEY `id_status_consulta` (`id_status_consulta`),
  ADD KEY `id_turno_consulta` (`id_turno_consulta`);

--
-- Indices de la tabla `discapacidad`
--
ALTER TABLE `discapacidad`
  ADD PRIMARY KEY (`id_discapacidad`);

--
-- Indices de la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD PRIMARY KEY (`id_doctor`),
  ADD UNIQUE KEY `id_usuario_2` (`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `seguro`
--
ALTER TABLE `seguro`
  ADD PRIMARY KEY (`id_seguro`);

--
-- Indices de la tabla `status_consulta`
--
ALTER TABLE `status_consulta`
  ADD PRIMARY KEY (`id_status_consulta`);

--
-- Indices de la tabla `status_usuario`
--
ALTER TABLE `status_usuario`
  ADD PRIMARY KEY (`id_status_usuario`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `turno_consulta`
--
ALTER TABLE `turno_consulta`
  ADD PRIMARY KEY (`id_turno_consulta`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD KEY `id_tipo_usuario` (`id_tipo_usuario`),
  ADD KEY `id_status_usuario` (`id_status_usuario`),
  ADD KEY `id_discapacidad` (`id_discapacidad`),
  ADD KEY `id_alergia` (`id_alergia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alergias`
--
ALTER TABLE `alergias`
  MODIFY `id_alergia` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `causa_consulta`
--
ALTER TABLE `causa_consulta`
  MODIFY `id_causa_consulta` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id_consulta` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `discapacidad`
--
ALTER TABLE `discapacidad`
  MODIFY `id_discapacidad` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `doctores`
--
ALTER TABLE `doctores`
  MODIFY `id_doctor` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `seguro`
--
ALTER TABLE `seguro`
  MODIFY `id_seguro` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `status_consulta`
--
ALTER TABLE `status_consulta`
  MODIFY `id_status_consulta` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `status_usuario`
--
ALTER TABLE `status_usuario`
  MODIFY `id_status_usuario` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo_usuario` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `turno_consulta`
--
ALTER TABLE `turno_consulta`
  MODIFY `id_turno_consulta` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `causa_consulta`
--
ALTER TABLE `causa_consulta`
  ADD CONSTRAINT `causa_consulta_ibfk_1` FOREIGN KEY (`id_seguro`) REFERENCES `seguro` (`id_seguro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `consultas_ibfk_5` FOREIGN KEY (`id_doctor`) REFERENCES `doctores` (`id_doctor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultas_ibfk_6` FOREIGN KEY (`id_status_consulta`) REFERENCES `status_consulta` (`id_status_consulta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultas_ibfk_7` FOREIGN KEY (`id_turno_consulta`) REFERENCES `turno_consulta` (`id_turno_consulta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultas_ibfk_8` FOREIGN KEY (`id_causa_consulta`) REFERENCES `causa_consulta` (`id_causa_consulta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultas_ibfk_9` FOREIGN KEY (`id_paciente`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD CONSTRAINT `doctores_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_status_usuario`) REFERENCES `status_usuario` (`id_status_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`id_discapacidad`) REFERENCES `discapacidad` (`id_discapacidad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_4` FOREIGN KEY (`id_alergia`) REFERENCES `alergias` (`id_alergia`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
