-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for projetomario
CREATE DATABASE IF NOT EXISTS `projetomario` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `projetomario`;

-- Dumping structure for table projetomario.evento
CREATE TABLE IF NOT EXISTS `evento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_evento` varchar(255) NOT NULL,
  `descricao_evento` text NOT NULL,
  `tipo_evento` varchar(255) NOT NULL,
  `data_evento_inicio` datetime DEFAULT NULL,
  `data_evento_fim` datetime DEFAULT NULL,
  `data_inscricao_inicio` datetime DEFAULT NULL,
  `data_inscricao_fim` datetime DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1510 DEFAULT CHARSET=utf8;

-- Dumping data for table projetomario.evento: ~2 rows (approximately)
/*!40000 ALTER TABLE `evento` DISABLE KEYS */;
INSERT INTO `evento` (`id`, `nome_evento`, `descricao_evento`, `tipo_evento`, `data_evento_inicio`, `data_evento_fim`, `data_inscricao_inicio`, `data_inscricao_fim`, `usuario_id`) VALUES
	(1508, 'outro nome', 'outra desc', 'Palestra', '2021-11-29 21:14:00', '2021-11-30 21:14:00', '0000-00-00 00:00:00', '2021-11-13 21:14:00', 12),
	(1509, 'Nome evento 1', 'Evento teste do TCC', 'Encontro', '2021-12-30 19:20:00', '2021-12-30 23:21:00', '0000-00-00 00:00:00', '2021-12-08 19:21:00', 11);
/*!40000 ALTER TABLE `evento` ENABLE KEYS */;

-- Dumping structure for table projetomario.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `funcao` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `curso` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Dumping data for table projetomario.usuario: ~5 rows (approximately)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `email`, `funcao`, `nome`, `senha`, `curso`) VALUES
	(10, 'Aluno@ielusc.br', 'Aluno', 'Aluno', '202cb962ac59075b964b07152d234b70', ''),
	(11, 'coordenadora@ielusc.br', 'Coordenador', 'Coordenadora', '202cb962ac59075b964b07152d234b70', ''),
	(12, 'coordenador@ielusc.br', 'Coordenador', 'Coordenador', '202cb962ac59075b964b07152d234b70', ''),
	(13, 'aluna@ielusc.br', 'Aluno', 'aluna', '202cb962ac59075b964b07152d234b70', ''),
	(14, 'adm@ielusc.br', 'Administrador', 'Adm', '202cb962ac59075b964b07152d234b70', ''),
	(15, 'aluno1@ielusc.br', 'Aluno', 'aluno1', '202cb962ac59075b964b07152d234b70', '');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Dumping structure for table projetomario.usuario_evento
CREATE TABLE IF NOT EXISTS `usuario_evento` (
  `id_evento` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `horas_validadas` int(11) NOT NULL,
  `horas_evento` int(11) NOT NULL,
  PRIMARY KEY (`id_evento`,`id_usuario`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `id_evento_fk` FOREIGN KEY (`id_evento`) REFERENCES `evento` (`id`),
  CONSTRAINT `id_usuario_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table projetomario.usuario_evento: ~0 rows (approximately)
/*!40000 ALTER TABLE `usuario_evento` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_evento` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
