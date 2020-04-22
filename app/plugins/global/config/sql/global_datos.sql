/*
SQLyog Community Edition- MySQL GUI v8.01 
MySQL - 5.0.51b : Database - remas_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `global_datos` */

DROP TABLE IF EXISTS `global_datos`;

CREATE TABLE `global_datos` (
  `id` varchar(12) NOT NULL,
  `concepto_1` varchar(100) default NULL,
  `concepto_2` varchar(100) default NULL,
  `concepto_3` varchar(100) default NULL,
  `logico_1` tinyint(1) default '0',
  `logico_2` tinyint(1) default '0',
  `entero_1` int(11) default '0',
  `entero_2` int(11) default '0',
  `decimal_1` decimal(10,2) default '0.00',
  `decimal_2` decimal(10,2) default '0.00',
  `fecha_1` date default NULL,
  `fecha_2` date default NULL,
  `texto_1` text,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_concepto` (`concepto_1`,`concepto_2`,`concepto_3`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
