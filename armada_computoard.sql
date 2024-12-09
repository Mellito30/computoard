-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2024 a las 02:56:31
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
-- Base de datos: `armada_computoard`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivos`
--

CREATE TABLE `dispositivos` (
  `id` int(11) NOT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `departamento` varchar(255) DEFAULT NULL,
  `tipo_dispositivo` varchar(255) DEFAULT NULL,
  `modelo` varchar(255) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dispositivos`
--

INSERT INTO `dispositivos` (`id`, `estado`, `departamento`, `tipo_dispositivo`, `modelo`, `fecha_ingreso`, `fecha_salida`) VALUES
(2, NULL, 'M-1', 'Computadora', 'Dell Latitude', '2024-12-03', '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int(11) NOT NULL,
  `nombre_solicitante` varchar(255) NOT NULL,
  `rango_solicitante` varchar(255) NOT NULL,
  `nombre_departamento` varchar(255) NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `correo_electronico` varchar(255) NOT NULL,
  `descripcion_solicitud` text NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `nombre_solicitante`, `rango_solicitante`, `nombre_departamento`, `asunto`, `correo_electronico`, `descripcion_solicitud`, `fecha`) VALUES
(1, 'Comandante JCK', 'Capitán Navío ', 'Computo ', 'Computadora Rota', 'anfellikr@gmail.com', 'hola, tengo un problema grande, tan grande como nunca.', '2024-12-05 13:46:52'),
(2, 'Anfer', 'GENERAL DE GENERALES', 'GENERAL', 'GENERAL', 'generalanfer@gmail.com', 'Es un problema, tan grande y tan GENERAL, que es grande y es muy GENERAL', '2024-12-05 13:50:38');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
