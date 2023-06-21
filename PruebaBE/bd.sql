-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.14 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla prueba_dvp.tickets
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) DEFAULT NULL,
  `asunto` varchar(250) DEFAULT NULL,
  `descripcion` text,
  `prioridad` varchar(10) DEFAULT NULL COMMENT 'Alta | Media | Baja',
  `fch_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fch_edicion` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estatus` varchar(10) DEFAULT NULL COMMENT 'Abierto |  Cerrado',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla prueba_dvp.tickets: 4 rows
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` (`id`, `usuario`, `asunto`, `descripcion`, `prioridad`, `fch_creacion`, `fch_edicion`, `estatus`) VALUES
	(1, 'usuario', 'asunto', 'descripcion', 'prioridad', '2023-06-21 02:59:36', '2023-06-21 02:59:36', 'Abierto'),
	(3, 'usuario3', 'asunto3', 'descripcion3', 'prioridad3', '2023-06-21 03:04:55', '2023-06-21 03:04:55', 'Abierto'),
	(4, 'Usuario nuevo', 'testeo rest', 'testeo rest testeo rest testeo rest', 'Alto', '2023-06-21 06:10:07', '2023-06-21 06:10:07', 'Abierto'),
	(5, 'Usuario nuevo', 'testeo rest', 'testeo rest testeo rest testeo rest', 'Alto', '2023-06-21 06:12:12', '2023-06-21 06:12:12', 'Abierto');
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
