-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 15-04-2023 a las 14:58:09
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
-- Base de datos: `consultorio_riccio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(9) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `cedula` varchar(9) NOT NULL,
  `edad` int(3) NOT NULL,
  `numero` varchar(11) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `nombre_usuario` varchar(60) NOT NULL,
  `clave` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  `tipo_usuario` int(1) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id_admin`, `nombre`, `apellido`, `cedula`, `edad`, `numero`, `correo`, `nombre_usuario`, `clave`, `status`, `tipo_usuario`, `fecha`) VALUES
(1, 'alex', 'urda', '23456543', 43, '04245678921', 'alex1@hotmail.com', 'alex1213', '5d41402abc4b2a76b9719d911017c592', 1, 1, '2023-04-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consulta`
--

CREATE TABLE `consulta` (
  `id_consulta` int(9) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `numero` varchar(11) NOT NULL,
  `cedula` varchar(9) NOT NULL,
  `causa` varchar(90) NOT NULL,
  `dia` varchar(20) NOT NULL,
  `fecha_solicitud` date NOT NULL,
  `fecha_atencion` date DEFAULT NULL,
  `nombre_doctora` varchar(30) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `consulta`
--

INSERT INTO `consulta` (`id_consulta`, `nombre`, `apellido`, `numero`, `cedula`, `causa`, `dia`, `fecha_solicitud`, `fecha_atencion`, `nombre_doctora`, `status`) VALUES
(1, 'alejandro', 'urdaneta', '04142341234', '26345324', 'mantenimiento de breakers', 'lunes', '2023-04-13', '2023-04-15', 'roxana riccio', 1),
(2, 'luis', 'martinez', '04142345651', '12345678', 'se me rompió un diente', 'martes', '2023-04-14', NULL, 'roxana riccio', 0),
(3, 'jose luis', 'moran', '432543', '432523', 'Consulta odontologica general', 'miercoles', '2023-04-14', NULL, 'roxana riccio', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente1`
--

CREATE TABLE `paciente1` (
  `id_paciente` int(9) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `cedula` varchar(9) NOT NULL,
  `edad` int(3) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `numero` varchar(11) NOT NULL,
  `clave` varchar(200) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paciente1`
--

INSERT INTO `paciente1` (`id_paciente`, `nombre`, `apellido`, `cedula`, `edad`, `correo`, `numero`, `clave`, `fecha`) VALUES
(1, 'alex', 'urda', '28123456', 22, 'alex@hotmail.com', '04142376814', '4d186321c1a7f0f354b297e8914ab240', '2023-04-09'),
(2, 'brian', 'algara', '23456789', 21, 'algara@gmail.com', '04123456781', '38d0a1a5b671e28babe460737856a1a7', '2023-04-15');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `consulta`
--
ALTER TABLE `consulta`
  ADD PRIMARY KEY (`id_consulta`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `paciente1`
--
ALTER TABLE `paciente1`
  ADD PRIMARY KEY (`id_paciente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `consulta`
--
ALTER TABLE `consulta`
  MODIFY `id_consulta` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `paciente1`
--
ALTER TABLE `paciente1`
  MODIFY `id_paciente` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
