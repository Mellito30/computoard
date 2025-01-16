-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para armada_computoard
CREATE DATABASE IF NOT EXISTS `armada_computoard` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `armada_computoard`;

-- Volcando estructura para tabla armada_computoard.dispositivos
CREATE TABLE IF NOT EXISTS `dispositivos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `departamento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipo_dispositivo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modelo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla armada_computoard.dispositivos: ~11 rows (aproximadamente)
INSERT INTO `dispositivos` (`id`, `estado`, `departamento`, `tipo_dispositivo`, `modelo`, `fecha_ingreso`, `fecha_salida`) VALUES
	(1, 'Reparado', 'M-1', 'Laptop', 'Lenovo', '2025-01-30', NULL),
	(2, 'Reparado', 'M-6', 'Laptop', 'Latitude', '2025-02-01', NULL),
	(3, 'En Proceso', 'Capitania ', 'Impresora', 'Epson ', '2025-01-02', NULL),
	(4, 'Reparado', 're', 'lapto', 'dell', '2025-01-18', NULL),
	(5, 'Sin Iniciar', 'M-6', 'tablet', 'dell', '2025-02-01', NULL),
	(6, 'En Proceso', 'prueba', 'Epson', 'Latitude', '2025-02-07', NULL),
	(7, 'Reparado', 'M-5', 'compu', 'xps', '2025-02-02', '2025-01-24'),
	(8, 'En Proceso', 'comando', 'laptop', 'dell', '2025-01-24', NULL),
	(9, 'En Proceso', 'M-6', 'Epson', 'dell', '2025-01-31', NULL),
	(10, 'En Proceso', 'Central', 'Epson', 'Dell Latitude', '2025-02-02', NULL),
	(11, 'Sin Iniciar', 'M-6', 'a', 'dell', '2025-02-02', '2025-01-15');

-- Volcando estructura para tabla armada_computoard.formulario
CREATE TABLE IF NOT EXISTS `formulario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `apellido_usuario` varchar(255) DEFAULT NULL,
  `rango` varchar(255) DEFAULT NULL,
  `clave` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla armada_computoard.formulario: ~0 rows (aproximadamente)
INSERT INTO `formulario` (`id`, `nombre_usuario`, `apellido_usuario`, `rango`, `clave`) VALUES
	(1, 'Anfer', 'Lorenzo', 'Programador', '$2y$10$EViPSLQBwOntSfUBVqnr9.u308KfV/4J2fcd1mIuUbZEmp9C1S3QK'),
	(3, 'Dora', 'Martinez', 'Programador', '$2y$10$/IzVAdknYmYLhG9hRs/EW.CsiCAfL2xOzUJQ8MX9pjJbXE3FZDwGK');

-- Volcando estructura para tabla armada_computoard.solicitudes
CREATE TABLE IF NOT EXISTS `solicitudes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_solicitante` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rango_solicitante` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nombre_departamento` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `asunto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `correo_electronico` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion_solicitud` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla armada_computoard.solicitudes: ~0 rows (aproximadamente)
INSERT INTO `solicitudes` (`id`, `nombre_solicitante`, `rango_solicitante`, `nombre_departamento`, `asunto`, `correo_electronico`, `descripcion_solicitud`, `fecha`) VALUES
	(1, 'franddy', 'Administrador', 'm-1', 'quiero solicitar que me vengan a instalar una red ', 'franddyleonel@gmail.com', '', '2025-01-08 14:37:42'),
	(2, 'Gua', 'Administracion', 'Computo ', 'Arreglo de router ', 'generalanfer@gmail.com', 'el router del departamento de computo se encuentra descompuesto, por favor venir a solucionar la problemática presentada. ', '2025-01-14 12:07:29');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
