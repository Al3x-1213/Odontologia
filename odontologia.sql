-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-09-2023 a las 22:32:12
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `odontologia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alergias`
--

CREATE TABLE IF NOT EXISTS `alergias` (
  `id_alergia` int(1) NOT NULL AUTO_INCREMENT,
  `alergia` varchar(30) NOT NULL,
  PRIMARY KEY (`id_alergia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `alergias`
--

INSERT INTO `alergias` (`id_alergia`, `alergia`) VALUES
(1, 'Sin alergia'),
(2, 'Con alergia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `causa_consulta`
--

CREATE TABLE IF NOT EXISTS `causa_consulta` (
  `id_causa_consulta` int(1) NOT NULL AUTO_INCREMENT,
  `causa_consulta` varchar(80) NOT NULL,
  `id_seguro` int(1) NOT NULL,
  PRIMARY KEY (`id_causa_consulta`),
  KEY `id_seguro` (`id_seguro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

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

CREATE TABLE IF NOT EXISTS `consultas` (
  `id_consulta` int(4) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(3) NOT NULL,
  `id_causa_consulta` int(1) NOT NULL,
  `fecha_atencion` date NOT NULL,
  `id_turno_consulta` int(1) NOT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `id_doctor` int(1) NOT NULL,
  `id_status_consulta` int(1) NOT NULL,
  `fecha_solicitud` date NOT NULL,
  PRIMARY KEY (`id_consulta`),
  KEY `id_paciente` (`id_paciente`),
  KEY `id_causa_consulta` (`id_causa_consulta`),
  KEY `id_doctor` (`id_doctor`),
  KEY `id_status_consulta` (`id_status_consulta`),
  KEY `id_turno_consulta` (`id_turno_consulta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id_consulta`, `id_paciente`, `id_causa_consulta`, `fecha_atencion`, `id_turno_consulta`, `hora_inicio`, `hora_fin`, `id_doctor`, `id_status_consulta`, `fecha_solicitud`) VALUES
(1, 2, 1, '2023-09-13', 1, NULL, NULL, 1, 1, '2023-09-11'),
(2, 3, 2, '2023-09-13', 1, NULL, NULL, 1, 2, '2023-09-08'),
(7, 2, 2, '2023-09-18', 2, '13:29:00', '14:29:00', 1, 1, '2023-09-13'),
(8, 3, 3, '2023-09-18', 1, '08:00:00', '08:00:00', 1, 4, '2023-09-12'),
(9, 2, 1, '2023-09-04', 2, NULL, NULL, 1, 1, '2023-09-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE IF NOT EXISTS `cuentas` (
  `id_cuenta` int(3) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `id_dato_personal` int(3) NOT NULL,
  `id_tipo_usuario` int(1) NOT NULL,
  `id_status_usuario` int(1) NOT NULL,
  PRIMARY KEY (`id_cuenta`),
  KEY `id_datos_personales` (`id_dato_personal`),
  KEY `id_tipo_usuario` (`id_tipo_usuario`),
  KEY `id_status_usuario` (`id_status_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `cuentas`
--

INSERT INTO `cuentas` (`id_cuenta`, `usuario`, `clave`, `id_dato_personal`, `id_tipo_usuario`, `id_status_usuario`) VALUES
(1, 'marisoldiaz', '4955683d760e39b8839cfd5d51db2133', 1, 1, 1),
(2, 'david123', 'b60f15385b905be9c977c59aa3420fd2', 2, 2, 1),
(3, 'veronicatrias', '4955683d760e39b8839cfd5d51db2133', 5, 1, 1),
(4, 'alejandrourdaneta', '0a2a58cccf143acc6c360e892af6137e', 6, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_personales`
--

CREATE TABLE IF NOT EXISTS `datos_personales` (
  `id_dato_personal` int(3) NOT NULL AUTO_INCREMENT,
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
  `fecha_registro` date NOT NULL,
  PRIMARY KEY (`id_dato_personal`),
  UNIQUE KEY `cedula` (`cedula`),
  KEY `id_discapacidad` (`id_discapacidad`),
  KEY `id_alergia` (`id_alergia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `datos_personales`
--

INSERT INTO `datos_personales` (`id_dato_personal`, `nombre`, `apellido`, `cedula`, `edad`, `fecha_nacimiento`, `telefono_1`, `telefono_2`, `correo`, `id_discapacidad`, `id_alergia`, `fecha_registro`) VALUES
(1, 'Marisol', 'Díaz', 12345678, 54, '1969-07-10', '04147483647', '', 'marisoldiaz@gmail.com', 2, 1, '2023-08-03'),
(2, 'David', 'Trias', 33123456, 12, '2010-09-25', '04121234567', '02121234567', 'odontologiamarisoldiaz@gmail.com', 1, 1, '2023-09-13'),
(3, 'Andrea', 'Marques', 13045216, 47, '1976-06-20', '04123216549', '02123216549', 'odontologiamarisoldiaz@gmail.com', 1, 2, '2023-09-13'),
(4, 'Angelica', 'Fuentes', 25654872, 28, '1995-03-07', '04165421896', '02125487652', 'odontologiamarisoldiaz@gmail.com', 1, 1, '2023-09-13'),
(5, 'Veronica', 'Trias', 30565326, 19, '2004-09-03', '04125214967', '02121254879', 'veronicatrias@gmail.com', 1, 1, '2023-09-13'),
(6, 'Alejandro', 'Urdaneta', 28424292, 22, '2000-12-13', '04141254879', '02123564872', 'alejandrourdaneta@gmail.com', 1, 1, '2023-09-13');

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
(1, 'Sin discapacidad'),
(2, 'Con discapacidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctores`
--

CREATE TABLE IF NOT EXISTS `doctores` (
  `id_doctor` int(1) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(3) NOT NULL,
  PRIMARY KEY (`id_doctor`),
  UNIQUE KEY `id_usuario_2` (`id_usuario`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `doctores`
--

INSERT INTO `doctores` (`id_doctor`, `id_usuario`) VALUES
(1, 1),
(2, 3),
(3, 4);

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
(1, 'Sin seguro'),
(2, 'Con seguro');

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
  ADD CONSTRAINT `consultas_ibfk_9` FOREIGN KEY (`id_paciente`) REFERENCES `datos_personales` (`id_dato_personal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD CONSTRAINT `cuentas_ibfk_1` FOREIGN KEY (`id_dato_personal`) REFERENCES `datos_personales` (`id_dato_personal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cuentas_ibfk_2` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cuentas_ibfk_3` FOREIGN KEY (`id_status_usuario`) REFERENCES `status_usuario` (`id_status_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD CONSTRAINT `datos_personales_ibfk_3` FOREIGN KEY (`id_discapacidad`) REFERENCES `discapacidad` (`id_discapacidad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `datos_personales_ibfk_4` FOREIGN KEY (`id_alergia`) REFERENCES `alergias` (`id_alergia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD CONSTRAINT `doctores_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `cuentas` (`id_cuenta`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
