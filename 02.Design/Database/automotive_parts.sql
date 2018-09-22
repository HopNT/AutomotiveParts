-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.8-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for automotive_parts
CREATE DATABASE IF NOT EXISTS `automotive_parts` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `automotive_parts`;

-- Dumping structure for table automotive_parts.dm_bophanxe
CREATE TABLE IF NOT EXISTS `dm_bophanxe` (
  `bophanxe_id` int(11) NOT NULL AUTO_INCREMENT,
  `ma` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `ngay_cap_nhat` datetime DEFAULT NULL,
  PRIMARY KEY (`bophanxe_id`),
  UNIQUE KEY `idx_ma_bophanxe` (`ma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table automotive_parts.dm_hangxe
CREATE TABLE IF NOT EXISTS `dm_hangxe` (
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

-- Data exporting was unselected.
-- Dumping structure for table automotive_parts.dm_hethongchuyendong
CREATE TABLE IF NOT EXISTS `dm_hethongchuyendong` (
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

-- Data exporting was unselected.
-- Dumping structure for table automotive_parts.dm_namsanxuat
CREATE TABLE IF NOT EXISTS `dm_namsanxuat` (
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

-- Data exporting was unselected.
-- Dumping structure for table automotive_parts.dm_nhamaysanxuat
CREATE TABLE IF NOT EXISTS `dm_nhamaysanxuat` (
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

-- Data exporting was unselected.
-- Dumping structure for table automotive_parts.dm_nhasanxuat
CREATE TABLE IF NOT EXISTS `dm_nhasanxuat` (
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

-- Data exporting was unselected.
-- Dumping structure for table automotive_parts.dm_phutung
CREATE TABLE IF NOT EXISTS `dm_phutung` (
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

-- Data exporting was unselected.
-- Dumping structure for table automotive_parts.dm_quocgia
CREATE TABLE IF NOT EXISTS `dm_quocgia` (
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

-- Data exporting was unselected.
-- Dumping structure for table automotive_parts.dm_thuonghieu
CREATE TABLE IF NOT EXISTS `dm_thuonghieu` (
  `thuonghieu_id` int(11) NOT NULL AUTO_INCREMENT,
  `ma` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trang_thai` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngay_tao` datetime DEFAULT NULL,
  `ngay_cap_nhat` datetime DEFAULT NULL,
  PRIMARY KEY (`thuonghieu_id`),
  UNIQUE KEY `idx_ma_thuonghieu` (`ma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table automotive_parts.dm_xe
CREATE TABLE IF NOT EXISTS `dm_xe` (
  `xe_id` int(11) NOT NULL AUTO_INCREMENT,
  `hangxe_id` int(11) DEFAULT NULL,
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
  KEY `idx_hangxe_id` (`hangxe_id`),
  KEY `idx_nhasanxuat_id` (`nhasanxuat_id`),
  KEY `idx_quocgia_id` (`quocgia_id`),
  KEY `idx_nhamaysanxuat_id` (`nhamaysanxuat_id`),
  KEY `idx_namsanxuat_id` (`namsanxuat_id`),
  KEY `idx_hethongchuyendong_id` (`hethongchuyendong_id`),
  CONSTRAINT `fk_xe_hangxe` FOREIGN KEY (`hangxe_id`) REFERENCES `dm_hangxe` (`hangxe_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_xe_hethongchuyendong` FOREIGN KEY (`hethongchuyendong_id`) REFERENCES `dm_hethongchuyendong` (`hethongchuyendong_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_xe_namsanxuat` FOREIGN KEY (`namsanxuat_id`) REFERENCES `dm_namsanxuat` (`namsanxuat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_xe_nhamaysanxuat` FOREIGN KEY (`nhamaysanxuat_id`) REFERENCES `dm_nhamaysanxuat` (`nhamaysanxuat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_xe_nhasanxuat` FOREIGN KEY (`nhasanxuat_id`) REFERENCES `dm_nhasanxuat` (`nhasanxuat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_xe_quocgia` FOREIGN KEY (`quocgia_id`) REFERENCES `dm_quocgia` (`quocgia_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table automotive_parts.nhom_phutung
CREATE TABLE IF NOT EXISTS `nhom_phutung` (
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

-- Data exporting was unselected.
-- Dumping structure for table automotive_parts.thanhvien
CREATE TABLE IF NOT EXISTS `thanhvien` (
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

-- Data exporting was unselected.
-- Dumping structure for table automotive_parts.thanhvien_phutung
CREATE TABLE IF NOT EXISTS `thanhvien_phutung` (
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

-- Data exporting was unselected.
-- Dumping structure for table automotive_parts.xe_phutung
CREATE TABLE IF NOT EXISTS `xe_phutung` (
  `xe_phutung_id` int(11) NOT NULL AUTO_INCREMENT,
  `phutung_id` int(11) DEFAULT NULL,
  `xe_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`xe_phutung_id`),
  KEY `idx_phutung_id` (`phutung_id`),
  KEY `idx_xe_id` (`xe_id`),
  CONSTRAINT `fk_xe_phutung_1` FOREIGN KEY (`phutung_id`) REFERENCES `dm_phutung` (`phutung_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_xe_phutung_2` FOREIGN KEY (`xe_id`) REFERENCES `dm_xe` (`xe_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
