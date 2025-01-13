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
  `estado` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `departamento` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipo_dispositivo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modelo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla armada_computoard.dispositivos: ~0 rows (aproximadamente)

-- Volcando estructura para tabla armada_computoard.formulario
CREATE TABLE IF NOT EXISTS `formulario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `apellido_usuario` varchar(255) DEFAULT NULL,
  `rango` varchar(255) DEFAULT NULL,
  `clave` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla armada_computoard.formulario: ~1 rows (aproximadamente)
REPLACE INTO `formulario` (`id`, `nombre_usuario`, `apellido_usuario`, `rango`, `clave`) VALUES
	(1, 'Anfer', 'Lorenzo', 'Programador', '$2y$10$EViPSLQBwOntSfUBVqnr9.u308KfV/4J2fcd1mIuUbZEmp9C1S3QK');

-- Volcando estructura para tabla armada_computoard.solicitudes
CREATE TABLE IF NOT EXISTS `solicitudes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_solicitante` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `rango_solicitante` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nombre_departamento` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `asunto` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `correo_electronico` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion_solicitud` text COLLATE utf8mb4_general_ci NOT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla armada_computoard.solicitudes: ~0 rows (aproximadamente)
REPLACE INTO `solicitudes` (`id`, `nombre_solicitante`, `rango_solicitante`, `nombre_departamento`, `asunto`, `correo_electronico`, `descripcion_solicitud`, `fecha`) VALUES
	(1, 'franddy', 'Administrador', 'm-1', 'quiero solicitar que me vengan a instalar una red ', 'franddyleonel@gmail.com', '', '2025-01-08 14:37:42');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
