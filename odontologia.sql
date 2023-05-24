-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 24-05-2023 a las 02:47:09
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
-- Estructura de tabla para la tabla `causa_consulta`
--

CREATE TABLE IF NOT EXISTS `causa_consulta` (
  `id_causa_consulta` int(1) NOT NULL AUTO_INCREMENT,
  `causa_consulta` varchar(80) NOT NULL,
  PRIMARY KEY (`id_causa_consulta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `causa_consulta`
--

INSERT INTO `causa_consulta` (`id_causa_consulta`, `causa_consulta`) VALUES
(1, 'Limpieza bucal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE IF NOT EXISTS `consultas` (
  `id_consulta` int(4) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(3) NOT NULL,
  `id_causa_consulta` int(1) NOT NULL,
  `fecha_atencion` date NOT NULL,
  `id_doctor` int(1) NOT NULL,
  `id_status_consulta` int(1) NOT NULL,
  `fecha_solicitud` date NOT NULL,
  PRIMARY KEY (`id_consulta`),
  KEY `id_paciente` (`id_paciente`),
  KEY `id_causa_consulta` (`id_causa_consulta`),
  KEY `id_doctor` (`id_doctor`),
  KEY `id_status_consulta` (`id_status_consulta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_consulta`
--

CREATE TABLE IF NOT EXISTS `status_consulta` (
  `id_status_consulta` int(1) NOT NULL AUTO_INCREMENT,
  `status_consulta` varchar(15) NOT NULL,
  PRIMARY KEY (`id_status_consulta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `status_consulta`
--

INSERT INTO `status_consulta` (`id_status_consulta`, `status_consulta`) VALUES
(1, 'Atendido'),
(2, 'No atendido'),
(3, 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status_usuario`
--

CREATE TABLE IF NOT EXISTS `status_usuario` (
  `id_status_usuario` int(1) NOT NULL AUTO_INCREMENT,
  `status_usuario` varchar(10) NOT NULL,
  PRIMARY KEY (`id_status_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `status_usuario`
--

INSERT INTO `status_usuario` (`id_status_usuario`, `status_usuario`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

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
  `fecha_registro` date NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario` (`usuario`,`cedula`),
  KEY `id_tipo_usuario` (`id_tipo_usuario`),
  KEY `id_status_usuario` (`id_status_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `clave`, `id_tipo_usuario`, `id_status_usuario`, `nombre`, `apellido`, `cedula`, `edad`, `fecha_nacimiento`, `telefono_1`, `telefono_2`, `correo`, `fecha_registro`) VALUES
(1, 'veronicatrias', '4955683d760e39b8839cfd5d51db2133', 1, 1, 'Veronica', 'Trias', 12345678, 18, '2004-09-03', '04121234567', '02121234567', 'vero_123@gmail.com', '2023-05-23'),
(2, 'alexandra123', 'b60f15385b905be9c977c59aa3420fd2', 2, 1, 'Alexandra', 'Sanchez', 32165498, 25, '1998-05-03', '04243216549', '', 'ale321@hotmail.com', '2023-05-23');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `consultas_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultas_ibfk_2` FOREIGN KEY (`id_causa_consulta`) REFERENCES `causa_consulta` (`id_causa_consulta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultas_ibfk_3` FOREIGN KEY (`id_doctor`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultas_ibfk_4` FOREIGN KEY (`id_status_consulta`) REFERENCES `status_consulta` (`id_status_consulta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_status_usuario`) REFERENCES `status_usuario` (`id_status_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
