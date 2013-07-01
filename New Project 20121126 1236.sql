-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.41


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema framework
--

CREATE DATABASE IF NOT EXISTS framework;
USE framework;

--
-- Definition of table `generated`
--

DROP TABLE IF EXISTS `generated`;
CREATE TABLE `generated` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `project_zip` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `data` datetime NOT NULL,
  `versao` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `ip` varchar(45) COLLATE latin1_general_ci NOT NULL,
  `layout` enum('padrao','desktop','touch') COLLATE latin1_general_ci NOT NULL DEFAULT 'padrao',
  `server` enum('php','nodejs') COLLATE latin1_general_ci NOT NULL DEFAULT 'php',
  `usuario_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `generated`
--

/*!40000 ALTER TABLE `generated` DISABLE KEYS */;
INSERT INTO `generated` (`id`,`project`,`project_zip`,`data`,`versao`,`ip`,`layout`,`server`,`usuario_id`) VALUES 
 (1,'dfd','zipeds/1/0f6dbe3059e121129d351af2be9577a5.zip','2012-10-30 17:52:52','1.0.1','127.0.0.1','padrao','php',0),
 (2,'dfd','zipeds/1/525a5c207a11fe042f724aaa087131f0.zip','2012-10-30 17:53:11','1.0.1','127.0.0.1','padrao','php',0);
/*!40000 ALTER TABLE `generated` ENABLE KEYS */;


--
-- Definition of table `grupo`
--

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE `grupo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grupo`
--

/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
INSERT INTO `grupo` (`id`,`grupo`) VALUES 
 (1,'Administrador'),
 (2,'Cliente');
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;


--
-- Definition of table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `data_cadastro` date NOT NULL,
  `email` varchar(150) NOT NULL,
  `login` varchar(30) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1' COMMENT '1 - Ativado, 0 - Desativado',
  `tempo` varchar(32) NOT NULL DEFAULT '0',
  `exportar` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`,`login`),
  KEY `FK_usuarios_1` (`id_grupo`),
  CONSTRAINT `FK_usuarios_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`,`nome`,`data_cadastro`,`email`,`login`,`senha`,`id_grupo`,`status`,`tempo`,`exportar`) VALUES 
 (1,'Maciel','2012-10-30','macielcr7@gmail.com','macielcr7','b35fe674cb18fb2004fcf091a253d9ca',1,'1','1353944210','1'),
 (2,'Demo','2012-10-30','demo@demo.com','demo','fe01ce2a7fbac8fafaed7c982a04e229',2,'1','0','0'),
 (3,'Sousa','2012-10-30','sousa.justa@gmail.com','sousa','0c8b7fff469703da5e219f1c807a2153',1,'1','0','0'),
 (12,'macielc.ronaldo','2012-11-19','macielc.ronaldo@hotmail.com','macielc.ronaldo','b35fe674cb18fb2004fcf091a253d9ca',2,'0','0','0');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
