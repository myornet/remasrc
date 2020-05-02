CREATE DATABASE  IF NOT EXISTS `ipnorte_remasrc` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ipnorte_remasrc`;

CREATE USER IF NOT EXISTS 'remasrc'@'localhost' IDENTIFIED BY 'twO^FBY-}4';
GRANT ALL PRIVILEGES ON ipnorte_remasrc.* TO 'remasrc'@'localhost';
FLUSH PRIVILEGES;



-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: ipnorte_remasrc
-- ------------------------------------------------------
-- Server version	5.7.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `asincrono_temporales`
--

DROP TABLE IF EXISTS `asincrono_temporales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asincrono_temporales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asincrono_id` int(11) DEFAULT '0',
  `clave_1` varchar(100) DEFAULT NULL,
  `clave_2` varchar(100) DEFAULT NULL,
  `texto_1` varchar(100) DEFAULT NULL,
  `texto_2` varchar(100) DEFAULT NULL,
  `texto_3` varchar(100) DEFAULT NULL,
  `texto_4` varchar(100) DEFAULT NULL,
  `texto_5` varchar(100) DEFAULT NULL,
  `texto_6` varchar(100) DEFAULT NULL,
  `texto_7` varchar(100) DEFAULT NULL,
  `texto_8` varchar(100) DEFAULT NULL,
  `texto_9` varchar(100) DEFAULT NULL,
  `texto_10` varchar(100) DEFAULT NULL,
  `texto_11` varchar(100) DEFAULT NULL,
  `texto_12` varchar(100) DEFAULT NULL,
  `texto_13` varchar(100) DEFAULT NULL,
  `texto_14` varchar(100) DEFAULT NULL,
  `texto_15` varchar(100) DEFAULT NULL,
  `texto_16` varchar(100) DEFAULT NULL,
  `texto_17` varchar(100) DEFAULT NULL,
  `texto_18` varchar(100) DEFAULT NULL,
  `texto_19` varchar(100) DEFAULT NULL,
  `texto_20` varchar(100) DEFAULT NULL,
  `texto_21` varchar(100) DEFAULT NULL,
  `texto_22` varchar(100) DEFAULT NULL,
  `texto_23` varchar(100) DEFAULT NULL,
  `texto_24` varchar(100) DEFAULT NULL,
  `texto_25` varchar(100) DEFAULT NULL,
  `texto_26` varchar(100) DEFAULT NULL,
  `decimal_1` decimal(10,2) DEFAULT NULL,
  `decimal_2` decimal(10,2) DEFAULT NULL,
  `decimal_3` decimal(10,3) DEFAULT NULL,
  `entero_1` int(11) DEFAULT NULL,
  `entero_2` int(11) DEFAULT NULL,
  `entero_3` int(11) DEFAULT NULL,
  `entero_4` int(11) DEFAULT NULL,
  `entero_5` int(11) DEFAULT NULL,
  `fecha_1` date DEFAULT NULL,
  `fecha_2` date DEFAULT NULL,
  `fecha_3` date DEFAULT NULL,
  `txt_1` text,
  `txt_2` text,
  PRIMARY KEY (`id`),
  KEY `IDX_CLAVE_1` (`clave_1`),
  KEY `IDX_CLAVE_2` (`clave_2`)
) ENGINE=MyISAM AUTO_INCREMENT=45676 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `asincronos`
--

DROP TABLE IF EXISTS `asincronos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asincronos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `propietario` varchar(120) DEFAULT NULL,
  `remote_ip` varchar(100) DEFAULT NULL,
  `final` datetime DEFAULT NULL,
  `proceso` varchar(150) DEFAULT NULL,
  `p1` varchar(250) DEFAULT NULL,
  `p2` varchar(250) DEFAULT NULL,
  `p3` varchar(250) DEFAULT NULL,
  `p4` varchar(250) DEFAULT NULL,
  `p5` varchar(250) DEFAULT NULL,
  `p6` varchar(250) DEFAULT NULL,
  `p7` varchar(250) DEFAULT NULL,
  `p8` varchar(250) DEFAULT NULL,
  `p9` varchar(250) DEFAULT NULL,
  `p10` varchar(250) DEFAULT NULL,
  `p11` varchar(250) DEFAULT NULL,
  `p12` varchar(250) DEFAULT NULL,
  `p13` varchar(250) DEFAULT NULL,
  `p14` varchar(250) DEFAULT NULL,
  `p15` varchar(250) DEFAULT NULL,
  `p16` varchar(250) DEFAULT NULL,
  `p17` varchar(250) DEFAULT NULL,
  `p18` varchar(250) DEFAULT NULL,
  `p19` varchar(250) DEFAULT NULL,
  `p20` varchar(250) DEFAULT NULL,
  `action_do` varchar(150) DEFAULT NULL,
  `target` varchar(50) DEFAULT NULL,
  `titulo` varchar(250) DEFAULT NULL,
  `subtitulo` varchar(250) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL,
  `total` int(11) DEFAULT '0',
  `contador` int(11) DEFAULT '0',
  `porcentaje` int(11) DEFAULT '0',
  `msg` varchar(150) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_proceso` (`proceso`),
  KEY `idx_propietario` (`propietario`,`remote_ip`)
) ENGINE=MyISAM AUTO_INCREMENT=172 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `beneficiario_adicionales`
--

DROP TABLE IF EXISTS `beneficiario_adicionales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beneficiario_adicionales` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `beneficiario_id` int(11) DEFAULT '0',
  `persona_id` int(11) DEFAULT '0',
  `tipo_parentezco` varchar(12) DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  `observaciones` text,
  `alta_centro_id` int(11) DEFAULT '0',
  `nuevo_titular_beneficio_id` int(11) DEFAULT '0',
  `user_created` varchar(50) DEFAULT NULL,
  `user_modified` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxu_persona_id_estado` (`beneficiario_id`,`persona_id`,`estado`),
  KEY `idx_beneficiario` (`beneficiario_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1559 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `beneficiario_beneficio_detalles`
--

DROP TABLE IF EXISTS `beneficiario_beneficio_detalles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beneficiario_beneficio_detalles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) DEFAULT '0',
  `beneficiario_beneficio_id` int(11) DEFAULT '0',
  `codigo_producto` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `cantidad` int(11) DEFAULT '0',
  `importe` decimal(10,2) DEFAULT '0.00',
  `observaciones` text,
  `permanente` tinyint(1) DEFAULT '0',
  `fecha_hasta` date DEFAULT NULL,
  `user_created` varchar(50) DEFAULT NULL,
  `user_modified` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `NewIndex1` (`beneficiario_beneficio_id`),
  KEY `NewIndex3` (`codigo_producto`)
) ENGINE=MyISAM AUTO_INCREMENT=1602 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `beneficiario_beneficios`
--

DROP TABLE IF EXISTS `beneficiario_beneficios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beneficiario_beneficios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `beneficiario_id` int(11) DEFAULT '0',
  `persona_id` int(11) DEFAULT '0',
  `alta_centro_id` int(11) DEFAULT '0',
  `user_created` varchar(50) DEFAULT NULL,
  `user_modified` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `NewIndex1` (`beneficiario_id`)
) ENGINE=MyISAM AUTO_INCREMENT=885 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `beneficiario_novedades`
--

DROP TABLE IF EXISTS `beneficiario_novedades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beneficiario_novedades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `beneficiario_id` int(11) DEFAULT '0',
  `alta_centro_id` int(11) DEFAULT '0',
  `usuario` varchar(150) DEFAULT NULL,
  `centro_atencion` varchar(150) DEFAULT NULL,
  `novedad` text,
  `adjunto` varchar(150) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `beneficiarios`
--

DROP TABLE IF EXISTS `beneficiarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beneficiarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) DEFAULT '0',
  `estado` tinyint(1) DEFAULT '1',
  `fecha_alta` date DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL,
  `alta_centro_id` int(11) DEFAULT '0',
  `observaciones` text,
  `user_created` varchar(50) DEFAULT NULL,
  `user_modified` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxu_persona_id_estado` (`persona_id`,`estado`)
) ENGINE=MyISAM AUTO_INCREMENT=629 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `centros`
--

DROP TABLE IF EXISTS `centros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `centros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `domicilio` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefonos` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsable` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `user_created` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_modified` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `conexiones`
--

DROP TABLE IF EXISTS `conexiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conexiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `municipalidad` varchar(150) DEFAULT NULL,
  `domicilio` varchar(150) DEFAULT NULL,
  `responsable` varchar(150) DEFAULT NULL,
  `telefonos` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `app_remas_remoto` varchar(200) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `user_local` varchar(50) DEFAULT NULL,
  `user_remoto` varchar(150) DEFAULT NULL,
  `pin_local` varchar(150) DEFAULT NULL,
  `pin_remoto` varchar(150) DEFAULT NULL,
  `user_created` varchar(100) DEFAULT NULL,
  `user_modified` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_pin_local` (`pin_local`),
  KEY `idx_activa` (`activo`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `global_datos`
--

DROP TABLE IF EXISTS `global_datos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `global_datos` (
  `id` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `concepto_1` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `concepto_2` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `concepto_3` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `logico_1` tinyint(1) DEFAULT '0',
  `logico_2` tinyint(1) DEFAULT '0',
  `entero_1` int(11) DEFAULT '0',
  `entero_2` int(11) DEFAULT '0',
  `decimal_1` decimal(10,2) DEFAULT '0.00',
  `decimal_2` decimal(10,2) DEFAULT '0.00',
  `fecha_1` date DEFAULT NULL,
  `fecha_2` date DEFAULT NULL,
  `texto_1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_concepto` (`concepto_1`,`concepto_2`,`concepto_3`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `grupos`
--

DROP TABLE IF EXISTS `grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo_id` int(11) DEFAULT '0',
  `menu_id` int(11) DEFAULT '0',
  `url` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_created` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_modified` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=884 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personas`
--

DROP TABLE IF EXISTS `personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_documento` varchar(12) DEFAULT NULL,
  `documento` varchar(11) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `sexo` varchar(1) DEFAULT 'M',
  `fecha_alta` date DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `fecha_nacimiento` date DEFAULT NULL,
  `cuit_cuil` varchar(11) DEFAULT NULL,
  `calle` varchar(150) DEFAULT NULL,
  `numero` int(5) DEFAULT '0',
  `barrio` varchar(12) DEFAULT NULL,
  `localidad` varchar(150) DEFAULT NULL,
  `codigo_postal` varchar(8) DEFAULT NULL,
  `provincia` varchar(50) DEFAULT NULL,
  `telefono_fijo` varchar(30) DEFAULT NULL,
  `telefono_movil` varchar(30) DEFAULT NULL,
  `telefono_mensajes` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tipo_ocupacion_oficio` varchar(12) DEFAULT NULL,
  `tipo_ocupacion_oficio_actual` varchar(12) DEFAULT NULL,
  `condicion_ocupacion_actual` varchar(12) DEFAULT NULL,
  `ingresos` decimal(10,2) DEFAULT '0.00',
  `tipo_cobertura_medica` varchar(12) DEFAULT NULL,
  `tipo_nivel_instruccion` varchar(12) DEFAULT NULL,
  `institucion` varchar(100) DEFAULT NULL,
  `institucion_anio_grado` int(11) DEFAULT '0',
  `institucion_turno` varchar(2) DEFAULT NULL,
  `tipo_discapacidad` varchar(12) DEFAULT NULL,
  `tipo_vivienda` varchar(12) DEFAULT NULL,
  `habitaciones` int(3) DEFAULT '0',
  `tipo_condicion_vivienda` varchar(12) DEFAULT NULL,
  `monto_alquiler` decimal(10,2) DEFAULT '0.00',
  `tipo_electricidad` varchar(12) DEFAULT NULL,
  `tipo_agua` varchar(12) DEFAULT NULL,
  `tipo_conexion_agua` varchar(12) DEFAULT NULL,
  `tipo_banio` varchar(12) DEFAULT NULL,
  `tipo_techo` varchar(12) DEFAULT NULL,
  `tipo_piso` varchar(12) DEFAULT NULL,
  `vivienda_precaria` tinyint(1) DEFAULT '0',
  `nbi` tinyint(1) DEFAULT '0',
  `observaciones` text,
  `alta_centro_id` int(11) DEFAULT '0',
  `user_created` varchar(50) DEFAULT NULL,
  `user_modified` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_tdocNdoc` (`tipo_documento`,`documento`),
  KEY `idx_apenom` (`apellido`,`nombre`)
) ENGINE=MyISAM AUTO_INCREMENT=2140 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tmp_personas`
--

DROP TABLE IF EXISTS `tmp_personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tmp_personas` (
  `id` int(11) NOT NULL DEFAULT '0',
  `tipo_documento` varchar(12) DEFAULT NULL,
  `documento` varchar(11) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `sexo` varchar(1) DEFAULT 'M',
  `fecha_alta` date DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `fecha_nacimiento` date DEFAULT NULL,
  `cuit_cuil` varchar(11) DEFAULT NULL,
  `calle` varchar(150) DEFAULT NULL,
  `numero` int(5) DEFAULT '0',
  `barrio` varchar(12) DEFAULT NULL,
  `localidad` varchar(150) DEFAULT NULL,
  `codigo_postal` varchar(8) DEFAULT NULL,
  `provincia` varchar(50) DEFAULT NULL,
  `telefono_fijo` varchar(30) DEFAULT NULL,
  `telefono_movil` varchar(30) DEFAULT NULL,
  `telefono_mensajes` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tipo_ocupacion_oficio` varchar(12) DEFAULT NULL,
  `ingresos` decimal(10,2) DEFAULT '0.00',
  `tipo_cobertura_medica` varchar(12) DEFAULT NULL,
  `tipo_nivel_instruccion` varchar(12) DEFAULT NULL,
  `institucion` varchar(100) DEFAULT NULL,
  `tipo_discapacidad` varchar(12) DEFAULT NULL,
  `tipo_vivienda` varchar(12) DEFAULT NULL,
  `habitaciones` int(3) DEFAULT '0',
  `tipo_condicion_vivienda` varchar(12) DEFAULT NULL,
  `monto_alquiler` decimal(10,2) DEFAULT '0.00',
  `tipo_electricidad` varchar(12) DEFAULT NULL,
  `tipo_agua` varchar(12) DEFAULT NULL,
  `tipo_banio` varchar(12) DEFAULT NULL,
  `tipo_techo` varchar(12) DEFAULT NULL,
  `tipo_piso` varchar(12) DEFAULT NULL,
  `observaciones` text,
  `alta_centro_id` int(11) DEFAULT '0',
  `user_created` varchar(50) DEFAULT NULL,
  `user_modified` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `descripcion` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `grupo_id` int(11) DEFAULT '0',
  `perfil` int(11) DEFAULT '1',
  `centro_id` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-23 18:11:10
