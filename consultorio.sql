-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 10-07-2023 a las 00:05:42
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `consultorio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `causa_consulta`
--

CREATE TABLE IF NOT EXISTS `causa_consulta` (
  `id_causa_consulta` int(1) NOT NULL AUTO_INCREMENT,
  `causa_consulta` varchar(80) NOT NULL,
  `filtro` int(1) NOT NULL,
  PRIMARY KEY (`id_causa_consulta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `causa_consulta`
--

INSERT INTO `causa_consulta` (`id_causa_consulta`, `causa_consulta`, `filtro`) VALUES
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

CREATE TABLE IF NOT EXISTS `consultas` (
  `id_consulta` int(4) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(3) NOT NULL,
  `id_causa_consulta` int(1) NOT NULL,
  `fecha_atencion` date NOT NULL,
  `id_turno_consulta` int(1) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `id_doctor` int(1) NOT NULL,
  `id_status_consulta` int(1) NOT NULL,
  `fecha_solicitud` date NOT NULL,
  PRIMARY KEY (`id_consulta`),
  KEY `id_paciente` (`id_paciente`),
  KEY `id_causa_consulta` (`id_causa_consulta`),
  KEY `id_doctor` (`id_doctor`),
  KEY `id_status_consulta` (`id_status_consulta`),
  KEY `id_turno_consulta` (`id_turno_consulta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id_consulta`, `id_paciente`, `id_causa_consulta`, `fecha_atencion`, `id_turno_consulta`, `hora_inicio`, `hora_fin`, `id_doctor`, `id_status_consulta`, `fecha_solicitud`) VALUES
(1, 5, 1, '2023-06-19', 1, '00:00:00', '00:00:00', 3, 4, '2023-06-08'),
(2, 2, 3, '2023-06-19', 1, '08:30:00', '09:30:00', 3, 4, '2023-06-08'),
(3, 5, 7, '2023-06-16', 1, '09:30:00', '10:30:00', 3, 1, '2023-06-08'),
(4, 2, 5, '2023-06-19', 1, '10:30:00', '11:00:00', 3, 4, '2023-06-08'),
(8, 30, 4, '2023-06-16', 1, '11:00:00', '12:00:00', 3, 4, '2023-06-11'),
(9, 38, 3, '2023-06-16', 2, '13:00:00', '14:00:00', 3, 4, '2023-06-11'),
(10, 5, 4, '2023-06-16', 2, '14:00:00', '14:30:00', 3, 4, '2023-06-11'),
(11, 38, 6, '2023-06-18', 2, '14:30:00', '15:30:00', 3, 2, '2023-06-11'),
(12, 31, 5, '2023-06-19', 2, '15:30:00', '16:00:00', 3, 3, '2023-06-11'),
(13, 2, 2, '2023-06-19', 1, '00:00:00', '00:00:00', 3, 3, '2023-06-16'),
(14, 5, 5, '2023-06-12', 2, '00:00:00', '00:00:00', 3, 3, '2023-06-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discapacidad`
--

CREATE TABLE IF NOT EXISTS `discapacidad` (
  `id_discapacidad` int(1) NOT NULL AUTO_INCREMENT,
  `discapacidad` varchar(16) NOT NULL,
  PRIMARY KEY (`id_discapacidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `discapacidad`
--

INSERT INTO `discapacidad` (`id_discapacidad`, `discapacidad`) VALUES
(1, 'Con discapacidad'),
(2, 'SIn discapacidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctores`
--

CREATE TABLE IF NOT EXISTS `doctores` (
  `id_doctor` int(1) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(3) NOT NULL,
  PRIMARY KEY (`id_doctor`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `doctores`
--

INSERT INTO `doctores` (`id_doctor`, `id_usuario`) VALUES
(1, 1),
(2, 3),
(3, 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguro`
--

CREATE TABLE IF NOT EXISTS `seguro` (
  `id_seguro` int(1) NOT NULL AUTO_INCREMENT,
  `seguro` varchar(10) NOT NULL,
  PRIMARY KEY (`id_seguro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `seguro`
--

INSERT INTO `seguro` (`id_seguro`, `seguro`) VALUES
(1, 'Con seguro'),
(2, 'Sin seguro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_consulta`
--

CREATE TABLE IF NOT EXISTS `status_consulta` (
  `id_status_consulta` int(1) NOT NULL AUTO_INCREMENT,
  `status_consulta` varchar(15) NOT NULL,
  PRIMARY KEY (`id_status_consulta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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

CREATE TABLE IF NOT EXISTS `status_usuario` (
  `id_status_usuario` int(1) NOT NULL AUTO_INCREMENT,
  `status_usuario` varchar(10) NOT NULL,
  PRIMARY KEY (`id_status_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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

CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `id_tipo_usuario` int(1) NOT NULL AUTO_INCREMENT,
  `tipo_usuario` varchar(15) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `turno_consulta` (
  `id_turno_consulta` int(1) NOT NULL AUTO_INCREMENT,
  `turno_consulta` varchar(6) NOT NULL,
  PRIMARY KEY (`id_turno_consulta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(3) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `id_tipo_usuario` int(1) NOT NULL,
  `id_status_usuario` int(1) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) NOT NULL,
  `cedula` int(8) NOT NULL,
  `edad` int(2) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono_1` varchar(11) NOT NULL,
  `telefono_2` varchar(11) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `id_discapacidad` int(1) NOT NULL,
  `id_seguro` int(1) NOT NULL,
  `fecha_registro` date NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario` (`usuario`,`cedula`),
  KEY `id_tipo_usuario` (`id_tipo_usuario`),
  KEY `id_status_usuario` (`id_status_usuario`),
  KEY `id_discapacidad` (`id_discapacidad`),
  KEY `id_seguro` (`id_seguro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `clave`, `id_tipo_usuario`, `id_status_usuario`, `nombre`, `apellido`, `cedula`, `edad`, `fecha_nacimiento`, `telefono_1`, `telefono_2`, `correo`, `id_discapacidad`, `id_seguro`, `fecha_registro`) VALUES
(1, 'veronicatrias', '4955683d760e39b8839cfd5d51db2133', 1, 1, 'Veronica', 'Trias', 12345678, 18, '2004-09-03', '04121234567', '02121234567', 'vero_123@gmail.com', 2, 2, '2023-05-23'),
(2, 'alexandra123', 'b60f15385b905be9c977c59aa3420fd2', 2, 1, 'Alexandra', 'Sanchez', 32165498, 25, '1998-05-03', '04243216549', '', 'ale321@hotmail.com', 2, 2, '2023-05-23'),
(3, 'alejandrourdaneta', '0a2a58cccf143acc6c360e892af6137e', 1, 1, 'Alejandro', 'Urdaneta', 14725836, 22, '2000-12-13', '04241472583', '02121472583', 'alex147@hotmail.com', 2, 2, '2023-05-26'),
(5, 'david123', 'b60f15385b905be9c977c59aa3420fd2', 2, 1, 'David', 'Trias', 74185296, 21, '2001-09-25', '04167418529', '02127418529', 'david_741@gmail.com', 2, 2, '2023-05-26'),
(6, 'petronila123', 'b60f15385b905be9c977c59aa3420fd2', 2, 1, 'Petronila', 'Sinforosa', 36925814, 28, '1995-03-24', '04263692581', '02123692581', 'petronila_sinforosa@hotmail.com', 2, 2, '2023-05-29'),
(30, 'fulanito123', 'b60f15385b905be9c977c59aa3420fd2', 2, 1, 'Fulanito', 'Perez', 96385274, 23, '1999-09-18', '04149638527', '02129638527', 'fulanito_p@gmail.com', 2, 2, '2023-06-07'),
(31, 'isabel123', 'b60f15385b905be9c977c59aa3420fd2', 2, 1, 'Isabel', 'Gomez', 45678912, 30, '1993-02-04', '04164567891', '02124567891', 'isabel321@hotmail.com', 2, 2, '2023-06-08'),
(35, 'marisoldiaz', '4955683d760e39b8839cfd5d51db2133', 1, 1, 'Marisol', 'Díaz', 85296374, 45, '1978-01-27', '04148529637', '02128529637', 'doctoramarisol@gmail.com', 2, 2, '2023-06-09'),
(38, 'leonardo123', 'b60f15385b905be9c977c59aa3420fd2', 2, 1, 'Leonardo', 'Trias', 85274196, 31, '1991-09-25', '04268527419', '02128527419', 'leonardot@gmail.com', 2, 2, '2023-06-09');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `consultas_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultas_ibfk_5` FOREIGN KEY (`id_doctor`) REFERENCES `doctores` (`id_doctor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultas_ibfk_6` FOREIGN KEY (`id_status_consulta`) REFERENCES `status_consulta` (`id_status_consulta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultas_ibfk_7` FOREIGN KEY (`id_turno_consulta`) REFERENCES `turno_consulta` (`id_turno_consulta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultas_ibfk_8` FOREIGN KEY (`id_causa_consulta`) REFERENCES `causa_consulta` (`id_causa_consulta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD CONSTRAINT `doctores_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_status_usuario`) REFERENCES `status_usuario` (`id_status_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`id_discapacidad`) REFERENCES `discapacidad` (`id_discapacidad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_4` FOREIGN KEY (`id_seguro`) REFERENCES `seguro` (`id_seguro`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
