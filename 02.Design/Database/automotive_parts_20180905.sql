-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: automotive_parts
-- ------------------------------------------------------
-- Server version	5.5.5-10.2.14-MariaDB

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
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_accessary`
--

DROP TABLE IF EXISTS `tbl_accessary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_accessary` (
  `accessary_id` int(11) NOT NULL AUTO_INCREMENT,
  `catalog_accessary_id` int(11) DEFAULT NULL,
  `parts_id` int(11) DEFAULT NULL,
  `trademark_id` int(11) DEFAULT NULL,
  `nation_id` int(11) DEFAULT NULL,
  `option_code_1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `option_code_2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_en` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_vi` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `acronym_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unsigned_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo_top` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo_bottom` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo_left` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo_right` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo_inner` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo_outer` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`accessary_id`) USING BTREE,
  UNIQUE KEY `idx_tbl_accessary_option_code_1` (`option_code_1`) USING BTREE,
  UNIQUE KEY `idx_tbl_accessary_option_code_2` (`option_code_2`) USING BTREE,
  UNIQUE KEY `idx_tbl_accessary_code` (`code`) USING BTREE,
  KEY `idx_tbl_accessary_parts_id` (`parts_id`) USING BTREE,
  KEY `idx_tbl_accessary_catalog_accessary_id` (`catalog_accessary_id`) USING BTREE,
  KEY `idx_tbl_accessary_trademark_id` (`trademark_id`) USING BTREE,
  KEY `idx_tbl_accessary_nation_id` (`nation_id`) USING BTREE,
  CONSTRAINT `fk_tbl_accessary_catalog_accessary_id` FOREIGN KEY (`catalog_accessary_id`) REFERENCES `tbl_catalog_accessary` (`catalog_accessary_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_accessary_nation_id` FOREIGN KEY (`nation_id`) REFERENCES `tbl_nation` (`nation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_accessary_parts_id` FOREIGN KEY (`parts_id`) REFERENCES `tbl_parts` (`parts_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_accessary_trademark_id` FOREIGN KEY (`trademark_id`) REFERENCES `tbl_trademark` (`trademark_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_accessary`
--

LOCK TABLES `tbl_accessary` WRITE;
/*!40000 ALTER TABLE `tbl_accessary` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_accessary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_car`
--

DROP TABLE IF EXISTS `tbl_car`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_car` (
  `car_id` int(11) NOT NULL AUTO_INCREMENT,
  `catalog_car_id` int(11) DEFAULT NULL,
  `car_manufacturer_id` int(11) DEFAULT NULL,
  `nation_id` int(11) DEFAULT NULL,
  `factory_id` int(11) DEFAULT NULL,
  `year_manufacture_id` int(11) DEFAULT NULL,
  `motion_system_id` int(11) DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number_of_doors` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`car_id`) USING BTREE,
  UNIQUE KEY `idx_tbl_car_code` (`code`) USING BTREE,
  KEY `idx_tbl_car_catalog_car_id` (`catalog_car_id`),
  KEY `idx_tbl_car_car_manufacturer_id` (`car_manufacturer_id`),
  KEY `idx_tbl_car_nation_id` (`nation_id`),
  KEY `idx_tbl_car_factory_id` (`factory_id`),
  KEY `idx_tbl_car_year_manufacture_id` (`year_manufacture_id`),
  KEY `idx_tbl_car_motion_system_id` (`motion_system_id`),
  CONSTRAINT `fk_tbl_car_car_manufacturer_id` FOREIGN KEY (`car_manufacturer_id`) REFERENCES `tbl_car_manufacturer` (`car_manufacturer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_car_catalog_car_id` FOREIGN KEY (`catalog_car_id`) REFERENCES `tbl_catalog_car` (`catalog_car_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_car_factory_id` FOREIGN KEY (`factory_id`) REFERENCES `tbl_factory` (`factory_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_car_motion_system_id` FOREIGN KEY (`motion_system_id`) REFERENCES `tbl_motion_system` (`motion_system_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_car_nation_id` FOREIGN KEY (`nation_id`) REFERENCES `tbl_nation` (`nation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_car_year_manufacture_id` FOREIGN KEY (`year_manufacture_id`) REFERENCES `tbl_year_manufacture` (`year_manufacture_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_car`
--

LOCK TABLES `tbl_car` WRITE;
/*!40000 ALTER TABLE `tbl_car` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_car` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_car_brand`
--

DROP TABLE IF EXISTS `tbl_car_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_car_brand` (
  `car_brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `nation_id` int(11) DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code_brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`car_brand_id`) USING BTREE,
  UNIQUE KEY `idx_tbl_car_manufacturer_code` (`code`),
  KEY `idx_tbl_car_manufacturer_nation_id` (`nation_id`),
  CONSTRAINT `fk_tbl_car_manufacturer_nation_id` FOREIGN KEY (`nation_id`) REFERENCES `tbl_nation` (`nation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_car_brand`
--

LOCK TABLES `tbl_car_brand` WRITE;
/*!40000 ALTER TABLE `tbl_car_brand` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_car_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_car_manufacturer`
--

DROP TABLE IF EXISTS `tbl_car_manufacturer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_car_manufacturer` (
  `car_manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`car_manufacturer_id`) USING BTREE,
  UNIQUE KEY `idx_tbl_car_manufacturer_code` (`code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_car_manufacturer`
--

LOCK TABLES `tbl_car_manufacturer` WRITE;
/*!40000 ALTER TABLE `tbl_car_manufacturer` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_car_manufacturer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_car_parts`
--

DROP TABLE IF EXISTS `tbl_car_parts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_car_parts` (
  `car_parts_id` int(11) NOT NULL,
  `car_id` int(11) DEFAULT NULL,
  `parts_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`car_parts_id`) USING BTREE,
  KEY `idx_tbl_car_parts_car_id` (`car_id`) USING BTREE,
  KEY `idx_tbl_car_parts_parts_id` (`parts_id`) USING BTREE,
  CONSTRAINT `fk_tbl_car_parts_car_id` FOREIGN KEY (`car_id`) REFERENCES `tbl_car` (`car_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_car_parts_parts_id` FOREIGN KEY (`parts_id`) REFERENCES `tbl_parts` (`parts_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_car_parts`
--

LOCK TABLES `tbl_car_parts` WRITE;
/*!40000 ALTER TABLE `tbl_car_parts` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_car_parts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_catalog_accessary`
--

DROP TABLE IF EXISTS `tbl_catalog_accessary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_catalog_accessary` (
  `catalog_accessary_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`catalog_accessary_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_catalog_accessary`
--

LOCK TABLES `tbl_catalog_accessary` WRITE;
/*!40000 ALTER TABLE `tbl_catalog_accessary` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_catalog_accessary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_catalog_car`
--

DROP TABLE IF EXISTS `tbl_catalog_car`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_catalog_car` (
  `catalog_car_id` int(11) NOT NULL AUTO_INCREMENT,
  `car_brand_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`catalog_car_id`) USING BTREE,
  KEY `idx_tbl_catalog_car_car_brand_id` (`car_brand_id`) USING BTREE,
  CONSTRAINT `fk_tbl_catalog_car_car_brand_id` FOREIGN KEY (`car_brand_id`) REFERENCES `tbl_car_brand` (`car_brand_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_catalog_car`
--

LOCK TABLES `tbl_catalog_car` WRITE;
/*!40000 ALTER TABLE `tbl_catalog_car` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_catalog_car` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_catalog_parts`
--

DROP TABLE IF EXISTS `tbl_catalog_parts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_catalog_parts` (
  `catalog_parts_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`catalog_parts_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_catalog_parts`
--

LOCK TABLES `tbl_catalog_parts` WRITE;
/*!40000 ALTER TABLE `tbl_catalog_parts` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_catalog_parts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_factory`
--

DROP TABLE IF EXISTS `tbl_factory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_factory` (
  `factory_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`factory_id`) USING BTREE,
  KEY `idx_tbl_factory_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_factory`
--

LOCK TABLES `tbl_factory` WRITE;
/*!40000 ALTER TABLE `tbl_factory` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_factory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_menu`
--

DROP TABLE IF EXISTS `tbl_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_menu` (
  `id` int(11) NOT NULL,
  `parrent_id` int(11) DEFAULT NULL,
  `display_order` int(2) DEFAULT NULL,
  `function_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT NULL,
  `is_menu` tinyint(1) DEFAULT NULL,
  `route_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_id` tinyint(1) DEFAULT NULL,
  `is_frontend` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_menu`
--

LOCK TABLES `tbl_menu` WRITE;
/*!40000 ALTER TABLE `tbl_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_menu_role`
--

DROP TABLE IF EXISTS `tbl_menu_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_menu_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_menu_role`
--

LOCK TABLES `tbl_menu_role` WRITE;
/*!40000 ALTER TABLE `tbl_menu_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_menu_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_motion_system`
--

DROP TABLE IF EXISTS `tbl_motion_system`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_motion_system` (
  `motion_system_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`motion_system_id`) USING BTREE,
  UNIQUE KEY `idx_tbl_motion_system_code` (`code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_motion_system`
--

LOCK TABLES `tbl_motion_system` WRITE;
/*!40000 ALTER TABLE `tbl_motion_system` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_motion_system` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nation`
--

DROP TABLE IF EXISTS `tbl_nation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_nation` (
  `nation_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_vi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`nation_id`) USING BTREE,
  UNIQUE KEY `idx_tbl_nation_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nation`
--

LOCK TABLES `tbl_nation` WRITE;
/*!40000 ALTER TABLE `tbl_nation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_nation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_parts`
--

DROP TABLE IF EXISTS `tbl_parts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_parts` (
  `parts_id` int(11) NOT NULL AUTO_INCREMENT,
  `catalog_parts_id` int(11) DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `width` double DEFAULT NULL,
  `height` double DEFAULT NULL,
  `number_of_tooth` int(11) DEFAULT NULL,
  `inner_diameter` double DEFAULT NULL,
  `outer_diameter` double DEFAULT NULL,
  `torque` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `life_cycle` int(11) DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `liquor` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`parts_id`) USING BTREE,
  UNIQUE KEY `idx_tbl_parts_code` (`code`),
  KEY `idx_tbl_parts_catalog_parts_id` (`catalog_parts_id`),
  CONSTRAINT `fk_tbl_parts_catalog_parts_id` FOREIGN KEY (`catalog_parts_id`) REFERENCES `tbl_catalog_parts` (`catalog_parts_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_parts`
--

LOCK TABLES `tbl_parts` WRITE;
/*!40000 ALTER TABLE `tbl_parts` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_parts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_trademark`
--

DROP TABLE IF EXISTS `tbl_trademark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_trademark` (
  `trademark_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`trademark_id`) USING BTREE,
  UNIQUE KEY `idx_tbl_trademark` (`code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_trademark`
--

LOCK TABLES `tbl_trademark` WRITE;
/*!40000 ALTER TABLE `tbl_trademark` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_trademark` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth_day` date DEFAULT NULL,
  `gender` int(1) DEFAULT NULL,
  `identify_card` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `driving_license` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  UNIQUE KEY `idx_tbl_user_code` (`code`) USING BTREE,
  UNIQUE KEY `idx_tbl_user_username` (`username`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user_accessary`
--

DROP TABLE IF EXISTS `tbl_user_accessary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user_accessary` (
  `user_parts_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `accessary_id` int(11) DEFAULT NULL,
  `garage_price` double DEFAULT NULL,
  `retail_price` double DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_parts_id`) USING BTREE,
  KEY `idx_tbl_user_accessary_user_id` (`user_id`) USING BTREE,
  KEY `idx_tbl_user_accessary_accessary_id` (`accessary_id`) USING BTREE,
  CONSTRAINT `fk_tbl_user_accessary_accessary_id` FOREIGN KEY (`accessary_id`) REFERENCES `tbl_accessary` (`accessary_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_user_accessary_user_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user_accessary`
--

LOCK TABLES `tbl_user_accessary` WRITE;
/*!40000 ALTER TABLE `tbl_user_accessary` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_user_accessary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_year_manufacture`
--

DROP TABLE IF EXISTS `tbl_year_manufacture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_year_manufacture` (
  `year_manufacture_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`year_manufacture_id`) USING BTREE,
  UNIQUE KEY `idx_tabl_year_manufacture_code` (`code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_year_manufacture`
--

LOCK TABLES `tbl_year_manufacture` WRITE;
/*!40000 ALTER TABLE `tbl_year_manufacture` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_year_manufacture` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-05 16:22:00
/*
 Navicat Premium Data Transfer

 Source Server         : ConnectMySQLDB
 Source Server Type    : MySQL
 Source Server Version : 100134
 Source Host           : localhost:3306
 Source Schema         : automotive_parts

 Target Server Type    : MySQL
 Target Server Version : 100134
 File Encoding         : 65001

 Date: 20/09/2018 01:17:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_role
-- ----------------------------
DROP TABLE IF EXISTS `tbl_role`;
CREATE TABLE `tbl_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `status` tinyint(4) NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_role
-- ----------------------------
INSERT INTO `tbl_role` VALUES (1, 'Administrator', NULL, NULL, NULL, 1);
INSERT INTO `tbl_role` VALUES (2, 'Product Provider', NULL, NULL, NULL, 1);
INSERT INTO `tbl_role` VALUES (3, 'Client', NULL, NULL, NULL, 1);

SET FOREIGN_KEY_CHECKS = 1;



/*
 Navicat Premium Data Transfer

 Source Server         : ConnectMySQLDB
 Source Server Type    : MySQL
 Source Server Version : 100134
 Source Host           : localhost:3306
 Source Schema         : automotive_parts

 Target Server Type    : MySQL
 Target Server Version : 100134
 File Encoding         : 65001

 Date: 20/09/2018 01:17:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `birth_day` date NULL DEFAULT NULL,
  `gender` int(1) NULL DEFAULT NULL,
  `identify_card` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `driving_license` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `fax` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `user_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `role_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  UNIQUE INDEX `idx_tbl_user_username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES (1, 'Tu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'nguyenthanhtu94@gmail.com', NULL, '$2y$10$Z68lmp6iqE4NLSlNo9W/Tu.73XsR6kiKwG9ra1GuHPqw/N2osekBG', '0', '1', '2018-09-06 00:01:20', '2018-09-06 00:01:20', NULL, 1);

SET FOREIGN_KEY_CHECKS = 1;



/*
 Navicat Premium Data Transfer

 Source Server         : ConnectMySQLDB
 Source Server Type    : MySQL
 Source Server Version : 100134
 Source Host           : localhost:3306
 Source Schema         : automotive_parts

 Target Server Type    : MySQL
 Target Server Version : 100134
 File Encoding         : 65001

 Date: 20/09/2018 01:16:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_admin_password_resets
-- ----------------------------
DROP TABLE IF EXISTS `tbl_admin_password_resets`;
CREATE TABLE `tbl_admin_password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `tbl_password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;



/*
 Navicat Premium Data Transfer

 Source Server         : ConnectMySQLDB
 Source Server Type    : MySQL
 Source Server Version : 100134
 Source Host           : localhost:3306
 Source Schema         : automotive_parts

 Target Server Type    : MySQL
 Target Server Version : 100134
 File Encoding         : 65001

 Date: 20/09/2018 01:16:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_menu
-- ----------------------------
DROP TABLE IF EXISTS `tbl_menu`;
CREATE TABLE `tbl_menu`  (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NULL DEFAULT NULL,
  `display_order` int(2) NULL DEFAULT NULL,
  `function_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `menu_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `is_delete` tinyint(1) NULL DEFAULT NULL,
  `is_menu` tinyint(1) NULL DEFAULT NULL,
  `route_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `event_id` tinyint(1) NULL DEFAULT NULL,
  `is_frontend` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_menu
-- ----------------------------
INSERT INTO `tbl_menu` VALUES (1, 0, 1, 'Account Management', NULL, '/admin/account-management', 0, 1, 'account-management', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (2, 1, 1, 'Update role', NULL, '', 0, 0, 'save-role|edit-role|delete-role|add-role', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (3, 1, 2, 'Update user', NULL, NULL, 0, 0, 'save-user', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;



/*
 Navicat Premium Data Transfer

 Source Server         : ConnectMySQLDB
 Source Server Type    : MySQL
 Source Server Version : 100134
 Source Host           : localhost:3306
 Source Schema         : automotive_parts

 Target Server Type    : MySQL
 Target Server Version : 100134
 File Encoding         : 65001

 Date: 20/09/2018 01:16:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_menu_role
-- ----------------------------
DROP TABLE IF EXISTS `tbl_menu_role`;
CREATE TABLE `tbl_menu_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NULL DEFAULT NULL,
  `role_id` int(11) NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_menu_role
-- ----------------------------
INSERT INTO `tbl_menu_role` VALUES (1, 1, 4, NULL);
INSERT INTO `tbl_menu_role` VALUES (2, 2, 4, NULL);
INSERT INTO `tbl_menu_role` VALUES (3, 3, 4, NULL);
INSERT INTO `tbl_menu_role` VALUES (4, 1, 5, NULL);
INSERT INTO `tbl_menu_role` VALUES (5, 2, 5, NULL);
INSERT INTO `tbl_menu_role` VALUES (6, 1, 6, NULL);
INSERT INTO `tbl_menu_role` VALUES (7, 2, 6, NULL);
INSERT INTO `tbl_menu_role` VALUES (8, 1, 7, NULL);
INSERT INTO `tbl_menu_role` VALUES (9, 2, 7, NULL);
INSERT INTO `tbl_menu_role` VALUES (10, 1, 8, NULL);
INSERT INTO `tbl_menu_role` VALUES (11, 3, 8, NULL);
INSERT INTO `tbl_menu_role` VALUES (12, 1, 9, NULL);
INSERT INTO `tbl_menu_role` VALUES (13, 3, 9, NULL);
INSERT INTO `tbl_menu_role` VALUES (15, 1, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (16, 2, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (17, 3, 1, NULL);

SET FOREIGN_KEY_CHECKS = 1;




/*
 Navicat Premium Data Transfer

 Source Server         : ConnectMySQLDB
 Source Server Type    : MySQL
 Source Server Version : 100134
 Source Host           : localhost:3306
 Source Schema         : automotive_parts

 Target Server Type    : MySQL
 Target Server Version : 100134
 File Encoding         : 65001

 Date: 20/09/2018 01:16:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_password_resets
-- ----------------------------
DROP TABLE IF EXISTS `tbl_password_resets`;
CREATE TABLE `tbl_password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `tbl_password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
