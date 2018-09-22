-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: automotive_parts
-- ------------------------------------------------------
-- Server version	5.5.5-10.3.8-MariaDB

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
-- Table structure for table `dm_bophanxe`
--

DROP TABLE IF EXISTS `dm_bophanxe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_bophanxe` (
  `bophanxe_id` int(11) NOT NULL AUTO_INCREMENT,
  `nhom_bophanxe_id` int(11) DEFAULT NULL,
  `ma` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path_anh_kythuat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `ngay_cap_nhat` datetime DEFAULT NULL,
  PRIMARY KEY (`bophanxe_id`),
  UNIQUE KEY `idx_ma_bophanxe` (`ma`),
  KEY `idx_bophanxe_nhom` (`nhom_bophanxe_id`),
  CONSTRAINT `fk_bophanxe_nhom` FOREIGN KEY (`nhom_bophanxe_id`) REFERENCES `nhom_bophanxe` (`nhom_bophanxe_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_bophanxe`
--

LOCK TABLES `dm_bophanxe` WRITE;
/*!40000 ALTER TABLE `dm_bophanxe` DISABLE KEYS */;
/*!40000 ALTER TABLE `dm_bophanxe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm_hangxe`
--

DROP TABLE IF EXISTS `dm_hangxe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_hangxe` (
  `hangxe_id` int(11) NOT NULL AUTO_INCREMENT,
  `quocgia_id` int(11) DEFAULT NULL,
  `ma` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_brand` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `ngay_cap_nhat` datetime DEFAULT NULL,
  PRIMARY KEY (`hangxe_id`),
  UNIQUE KEY `idx_ma_hangxe` (`ma`),
  UNIQUE KEY `idx_ma_brand` (`ma_brand`),
  KEY `idx_quocgia_id` (`quocgia_id`),
  CONSTRAINT `fk_hangxe_quocgia` FOREIGN KEY (`quocgia_id`) REFERENCES `dm_quocgia` (`quocgia_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_hangxe`
--

LOCK TABLES `dm_hangxe` WRITE;
/*!40000 ALTER TABLE `dm_hangxe` DISABLE KEYS */;
/*!40000 ALTER TABLE `dm_hangxe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm_hethongchuyendong`
--

DROP TABLE IF EXISTS `dm_hethongchuyendong`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_hethongchuyendong` (
  `hethongchuyendong_id` int(11) NOT NULL AUTO_INCREMENT,
  `ma` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `ngay_cap_nhat` datetime DEFAULT NULL,
  PRIMARY KEY (`hethongchuyendong_id`),
  UNIQUE KEY `idx_ma_hethongchuyendong` (`ma`),
  KEY `idx_hethongchuyendong_id` (`hethongchuyendong_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_hethongchuyendong`
--

LOCK TABLES `dm_hethongchuyendong` WRITE;
/*!40000 ALTER TABLE `dm_hethongchuyendong` DISABLE KEYS */;
/*!40000 ALTER TABLE `dm_hethongchuyendong` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm_namsanxuat`
--

DROP TABLE IF EXISTS `dm_namsanxuat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_namsanxuat` (
  `namsanxuat_id` int(11) NOT NULL AUTO_INCREMENT,
  `ma` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nam` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `ngay_cap_nhat` datetime DEFAULT NULL,
  PRIMARY KEY (`namsanxuat_id`),
  UNIQUE KEY `idx_ma_namsanxuat` (`ma`),
  KEY `idx_namsanxuat_id` (`namsanxuat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_namsanxuat`
--

LOCK TABLES `dm_namsanxuat` WRITE;
/*!40000 ALTER TABLE `dm_namsanxuat` DISABLE KEYS */;
/*!40000 ALTER TABLE `dm_namsanxuat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm_nhamaysanxuat`
--

DROP TABLE IF EXISTS `dm_nhamaysanxuat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_nhamaysanxuat` (
  `nhamaysanxuat_id` int(11) NOT NULL AUTO_INCREMENT,
  `ma` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dia_chi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `ngay_cap_nhat` datetime DEFAULT NULL,
  PRIMARY KEY (`nhamaysanxuat_id`),
  UNIQUE KEY `idx_ma_nhamaysanxuat` (`ma`),
  KEY `idx_nhamaysanxuat_id` (`nhamaysanxuat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_nhamaysanxuat`
--

LOCK TABLES `dm_nhamaysanxuat` WRITE;
/*!40000 ALTER TABLE `dm_nhamaysanxuat` DISABLE KEYS */;
/*!40000 ALTER TABLE `dm_nhamaysanxuat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm_nhasanxuat`
--

DROP TABLE IF EXISTS `dm_nhasanxuat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_nhasanxuat` (
  `nhasanxuat_id` int(11) NOT NULL AUTO_INCREMENT,
  `ma` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `ngay_cap_nhat` datetime DEFAULT NULL,
  PRIMARY KEY (`nhasanxuat_id`),
  UNIQUE KEY `idx_ma_nhasanxuat` (`ma`),
  KEY `idx_nhasanxuat_id` (`nhasanxuat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_nhasanxuat`
--

LOCK TABLES `dm_nhasanxuat` WRITE;
/*!40000 ALTER TABLE `dm_nhasanxuat` DISABLE KEYS */;
/*!40000 ALTER TABLE `dm_nhasanxuat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm_nhom_xe`
--

DROP TABLE IF EXISTS `dm_nhom_xe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_nhom_xe` (
  `nhom_xe_id` int(11) NOT NULL AUTO_INCREMENT,
  `hang_xe_id` int(11) DEFAULT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `ngay_cap_nhat` datetime DEFAULT NULL,
  PRIMARY KEY (`nhom_xe_id`),
  KEY `idx_nhomxe_hangxe` (`hang_xe_id`),
  CONSTRAINT `fk_nhomxe_hangxe` FOREIGN KEY (`hang_xe_id`) REFERENCES `dm_hangxe` (`hangxe_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_nhom_xe`
--

LOCK TABLES `dm_nhom_xe` WRITE;
/*!40000 ALTER TABLE `dm_nhom_xe` DISABLE KEYS */;
/*!40000 ALTER TABLE `dm_nhom_xe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm_phutung`
--

DROP TABLE IF EXISTS `dm_phutung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_phutung` (
  `phutung_id` int(11) NOT NULL AUTO_INCREMENT,
  `nhom_phutung_id` int(11) DEFAULT NULL,
  `bophanxe_id` int(11) DEFAULT NULL,
  `thuonghieu_id` int(11) DEFAULT NULL,
  `quocgia_id` int(11) DEFAULT NULL,
  `maphu_1` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maphu_2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma_lienketnhasxkhac` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_tienganh` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_tiengviet` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_viettat` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_khongdau` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path_anh_kythuat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `toado_anh_kythuat` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rong` double DEFAULT NULL,
  `cao` double DEFAULT NULL,
  `so_rang` int(11) DEFAULT NULL,
  `duongkinh_trong` double DEFAULT NULL,
  `duongkinh_ngoai` double DEFAULT NULL,
  `momen_xoan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tuoi_tho` int(11) DEFAULT NULL,
  `dungdich_sudung` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `khoi_luong` double DEFAULT NULL,
  `path_anh_tren` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path_anh_duoi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path_anh_trai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path_anh_phai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path_anh_trong` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path_anh_ngoai` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `ngay_cap_nhat` datetime DEFAULT NULL,
  PRIMARY KEY (`phutung_id`),
  UNIQUE KEY `idx_maphu_1` (`maphu_1`),
  UNIQUE KEY `idx_maphu_2` (`maphu_2`),
  UNIQUE KEY `idx_ma_phutung` (`ma`),
  KEY `idx_bophanxe_id` (`bophanxe_id`),
  KEY `idx_nhom_phutung_id` (`nhom_phutung_id`),
  KEY `idx_thuonghieu_id` (`thuonghieu_id`),
  KEY `idx_quocgia_id` (`quocgia_id`),
  CONSTRAINT `fk_phutung_bophanxe` FOREIGN KEY (`bophanxe_id`) REFERENCES `dm_bophanxe` (`bophanxe_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_phutung_nhom_phutung` FOREIGN KEY (`nhom_phutung_id`) REFERENCES `nhom_phutung` (`nhom_phutung_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_phutung_quocgia` FOREIGN KEY (`quocgia_id`) REFERENCES `dm_quocgia` (`quocgia_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_phutung_thuonghieu` FOREIGN KEY (`thuonghieu_id`) REFERENCES `dm_thuonghieu` (`thuonghieu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_phutung`
--

LOCK TABLES `dm_phutung` WRITE;
/*!40000 ALTER TABLE `dm_phutung` DISABLE KEYS */;
/*!40000 ALTER TABLE `dm_phutung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm_quocgia`
--

DROP TABLE IF EXISTS `dm_quocgia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_quocgia` (
  `quocgia_id` int(11) NOT NULL AUTO_INCREMENT,
  `ma` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_tiengviet` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_tienganh` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `ngay_cap_nhat` datetime DEFAULT NULL,
  PRIMARY KEY (`quocgia_id`),
  UNIQUE KEY `idx_ma_quocgia` (`ma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_quocgia`
--

LOCK TABLES `dm_quocgia` WRITE;
/*!40000 ALTER TABLE `dm_quocgia` DISABLE KEYS */;
/*!40000 ALTER TABLE `dm_quocgia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm_thuonghieu`
--

DROP TABLE IF EXISTS `dm_thuonghieu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_thuonghieu` (
  `thuonghieu_id` int(11) NOT NULL AUTO_INCREMENT,
  `ma` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `ngay_cap_nhat` datetime DEFAULT NULL,
  PRIMARY KEY (`thuonghieu_id`),
  UNIQUE KEY `idx_ma_thuonghieu` (`ma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_thuonghieu`
--

LOCK TABLES `dm_thuonghieu` WRITE;
/*!40000 ALTER TABLE `dm_thuonghieu` DISABLE KEYS */;
/*!40000 ALTER TABLE `dm_thuonghieu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dm_xe`
--

DROP TABLE IF EXISTS `dm_xe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dm_xe` (
  `xe_id` int(11) NOT NULL AUTO_INCREMENT,
  `nhom_xe_id` int(11) DEFAULT NULL,
  `nhasanxuat_id` int(11) DEFAULT NULL,
  `quocgia_id` int(11) DEFAULT NULL,
  `nhamaysanxuat_id` int(11) DEFAULT NULL,
  `namsanxuat_id` int(11) DEFAULT NULL,
  `hethongchuyendong_id` int(11) DEFAULT NULL,
  `ma` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `so_cua` int(11) DEFAULT NULL,
  `trang_thai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `ngay_cap_nhat` datetime DEFAULT NULL,
  PRIMARY KEY (`xe_id`),
  UNIQUE KEY `idx_ma_xe` (`ma`),
  KEY `idx_nhasanxuat_id` (`nhasanxuat_id`),
  KEY `idx_quocgia_id` (`quocgia_id`),
  KEY `idx_nhamaysanxuat_id` (`nhamaysanxuat_id`),
  KEY `idx_namsanxuat_id` (`namsanxuat_id`),
  KEY `idx_hethongchuyendong_id` (`hethongchuyendong_id`),
  KEY `idx_xe_nhomxe` (`nhom_xe_id`),
  CONSTRAINT `fk_xe_hethongchuyendong` FOREIGN KEY (`hethongchuyendong_id`) REFERENCES `dm_hethongchuyendong` (`hethongchuyendong_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_xe_namsanxuat` FOREIGN KEY (`namsanxuat_id`) REFERENCES `dm_namsanxuat` (`namsanxuat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_xe_nhamaysanxuat` FOREIGN KEY (`nhamaysanxuat_id`) REFERENCES `dm_nhamaysanxuat` (`nhamaysanxuat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_xe_nhasanxuat` FOREIGN KEY (`nhasanxuat_id`) REFERENCES `dm_nhasanxuat` (`nhasanxuat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_xe_nhomxe` FOREIGN KEY (`nhom_xe_id`) REFERENCES `dm_nhom_xe` (`nhom_xe_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_xe_quocgia` FOREIGN KEY (`quocgia_id`) REFERENCES `dm_quocgia` (`quocgia_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dm_xe`
--

LOCK TABLES `dm_xe` WRITE;
/*!40000 ALTER TABLE `dm_xe` DISABLE KEYS */;
/*!40000 ALTER TABLE `dm_xe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nhom_bophanxe`
--

DROP TABLE IF EXISTS `nhom_bophanxe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nhom_bophanxe` (
  `nhom_bophanxe_id` int(11) NOT NULL AUTO_INCREMENT,
  `ma` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `ngay_cap_nhat` datetime DEFAULT NULL,
  PRIMARY KEY (`nhom_bophanxe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nhom_bophanxe`
--

LOCK TABLES `nhom_bophanxe` WRITE;
/*!40000 ALTER TABLE `nhom_bophanxe` DISABLE KEYS */;
/*!40000 ALTER TABLE `nhom_bophanxe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nhom_phutung`
--

DROP TABLE IF EXISTS `nhom_phutung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nhom_phutung` (
  `nhom_phutung_id` int(11) NOT NULL AUTO_INCREMENT,
  `ma` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nhom_phutung_cha_id` int(11) DEFAULT NULL,
  `trang_thai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `ngay_cap_nhat` datetime DEFAULT NULL,
  PRIMARY KEY (`nhom_phutung_id`),
  UNIQUE KEY `idx_ma_nhom_phutung` (`ma`),
  KEY `idx_nhom_phutung_cha_id` (`nhom_phutung_cha_id`),
  CONSTRAINT `fk_nhom_phutung_cha` FOREIGN KEY (`nhom_phutung_cha_id`) REFERENCES `nhom_phutung` (`nhom_phutung_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nhom_phutung`
--

LOCK TABLES `nhom_phutung` WRITE;
/*!40000 ALTER TABLE `nhom_phutung` DISABLE KEYS */;
/*!40000 ALTER TABLE `nhom_phutung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thanhvien`
--

DROP TABLE IF EXISTS `thanhvien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thanhvien` (
  `thanhvien_id` int(11) NOT NULL AUTO_INCREMENT,
  `ma` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `gioi_tinh` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cmnd` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gplx` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dia_chi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dien_thoai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_taikhoan` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mat_khau` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loai_taikhoan` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `ngay_cap_nhat` datetime DEFAULT NULL,
  PRIMARY KEY (`thanhvien_id`),
  UNIQUE KEY `idx_ma_thanhvien` (`ma`),
  UNIQUE KEY `idx_ten_taikhoan` (`ten_taikhoan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thanhvien`
--

LOCK TABLES `thanhvien` WRITE;
/*!40000 ALTER TABLE `thanhvien` DISABLE KEYS */;
/*!40000 ALTER TABLE `thanhvien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thanhvien_phutung`
--

DROP TABLE IF EXISTS `thanhvien_phutung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thanhvien_phutung` (
  `thanhvien_phutung_id` int(11) NOT NULL AUTO_INCREMENT,
  `thanhvien_id` int(11) DEFAULT NULL,
  `phutung_id` int(11) DEFAULT NULL,
  `giaban_garage` double DEFAULT NULL,
  `giaban_le` double DEFAULT NULL,
  `soluong_hienco` int(11) DEFAULT NULL,
  `trang_thai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `ngay_cap_nhat` datetime DEFAULT NULL,
  PRIMARY KEY (`thanhvien_phutung_id`),
  KEY `idx_thanhvien_phutung_id` (`thanhvien_id`),
  KEY `idx_phutung_thanhvien_id` (`phutung_id`),
  CONSTRAINT `fk_thanhvien_phutung_1` FOREIGN KEY (`thanhvien_id`) REFERENCES `thanhvien` (`thanhvien_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_thanhvien_phutung_2` FOREIGN KEY (`phutung_id`) REFERENCES `dm_phutung` (`phutung_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thanhvien_phutung`
--

LOCK TABLES `thanhvien_phutung` WRITE;
/*!40000 ALTER TABLE `thanhvien_phutung` DISABLE KEYS */;
/*!40000 ALTER TABLE `thanhvien_phutung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xe_bophanxe`
--

DROP TABLE IF EXISTS `xe_bophanxe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xe_bophanxe` (
  `xe_bophanxe` int(11) NOT NULL AUTO_INCREMENT,
  `xe_id` int(11) DEFAULT NULL,
  `bophanxe_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`xe_bophanxe`),
  KEY `idx_xe_bophanxe_1` (`xe_id`),
  KEY `idx_xe_bophanxe_2` (`bophanxe_id`),
  CONSTRAINT `fk_xe_bophanxe_1` FOREIGN KEY (`xe_id`) REFERENCES `dm_xe` (`xe_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_xe_bophanxe_2` FOREIGN KEY (`bophanxe_id`) REFERENCES `dm_bophanxe` (`bophanxe_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xe_bophanxe`
--

LOCK TABLES `xe_bophanxe` WRITE;
/*!40000 ALTER TABLE `xe_bophanxe` DISABLE KEYS */;
/*!40000 ALTER TABLE `xe_bophanxe` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-03 20:22:59
