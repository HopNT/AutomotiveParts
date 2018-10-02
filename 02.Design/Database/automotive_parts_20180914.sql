-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: automotive_parts
-- ------------------------------------------------------
-- Server version	5.5.5-10.2.14-MariaDB

--
-- Table structure for table `role`
--
CREATE TABLE `tbl_role` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`role_name` VARCHAR(64) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`description` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`updated_at` DATETIME NULL DEFAULT NULL,
	`created_at` DATETIME NULL DEFAULT NULL,
	`status` TINYINT(4) NULL DEFAULT NULL,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;

--
-- Table structure for table `tbl_menu`
--
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

--
-- Table structure for table `tbl_menu_role`
--
CREATE TABLE `tbl_menu_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `tbl_nation`
--
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

--
-- Table structure for table `tbl_accessary_link`
--
CREATE TABLE `tbl_accessary_link` (
  `accessary_link_id` int(11) NOT NULL AUTO_INCREMENT,
  `accessary_id` int(11) NOT NULL,
  PRIMARY KEY (`accessary_link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `tbl_catalog_accessary`
--
CREATE TABLE `tbl_catalog_accessary` (
  `catalog_accessary_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`catalog_accessary_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Table structure for table `tbl_trademark`
--
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

--
-- Table structure for table `tbl_catalog_parts`
--
CREATE TABLE `tbl_catalog_parts` (
  `catalog_parts_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`catalog_parts_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `tbl_parts`
--
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

--
-- Table structure for table `tbl_accessary`
--
CREATE TABLE `tbl_accessary` (
  `accessary_id` int(11) NOT NULL AUTO_INCREMENT,
  `accessary_link_id` int(11) DEFAULT NULL,
  `catalog_accessary_id` int(11) DEFAULT NULL,
  `parts_id` int(11) DEFAULT NULL,
  `trademark_id` int(11) DEFAULT NULL,
  `nation_id` int(11) DEFAULT NULL,
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
  UNIQUE KEY `idx_tbl_accessary_code` (`code`) USING BTREE,
  KEY `idx_tbl_accessary_parts_id` (`parts_id`) USING BTREE,
  KEY `idx_tbl_accessary_catalog_accessary_id` (`catalog_accessary_id`) USING BTREE,
  KEY `idx_tbl_accessary_trademark_id` (`trademark_id`) USING BTREE,
  KEY `idx_tbl_accessary_nation_id` (`nation_id`) USING BTREE,
  KEY `idx_tbl_accessary_accessary_link_id` (`accessary_link_id`),
  CONSTRAINT `fk_tbl_accessary_accessary_link_id` FOREIGN KEY (`accessary_link_id`) REFERENCES `tbl_accessary_link` (`accessary_link_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_accessary_catalog_accessary_id` FOREIGN KEY (`catalog_accessary_id`) REFERENCES `tbl_catalog_accessary` (`catalog_accessary_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_accessary_nation_id` FOREIGN KEY (`nation_id`) REFERENCES `tbl_nation` (`nation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_accessary_parts_id` FOREIGN KEY (`parts_id`) REFERENCES `tbl_parts` (`parts_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_accessary_trademark_id` FOREIGN KEY (`trademark_id`) REFERENCES `tbl_trademark` (`trademark_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Table structure for table `tbl_motion_system`
--
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

--
-- Table structure for table `tbl_year_manufacture`
--
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

--
-- Table structure for table `tbl_factory`
--
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

--
-- Table structure for table `tbl_car_manufacturer`
--
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

--
-- Table structure for table `tbl_car_brand`
--
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
  UNIQUE KEY `idx_tbl_car_manufacturer_code_brand` (`code_brand`),
  KEY `idx_tbl_car_manufacturer_nation_id` (`nation_id`),
  CONSTRAINT `fk_tbl_car_manufacturer_nation_id` FOREIGN KEY (`nation_id`) REFERENCES `tbl_nation` (`nation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `tbl_catalog_car`
--
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

--
-- Table structure for table `tbl_car`
--
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

--
-- Table structure for table `tbl_car_parts`
--
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

--
-- Table structure for table `tbl_user`
--
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

--
-- Table structure for table `tbl_user_accessary`
--
CREATE TABLE `tbl_user_accessary` (
  `user_accessary_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `accessary_id` int(11) DEFAULT NULL,
  `garage_price` double DEFAULT NULL,
  `retail_price` double DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_accessary_id`) USING BTREE,
  KEY `idx_tbl_user_accessary_user_id` (`user_id`) USING BTREE,
  KEY `idx_tbl_user_accessary_accessary_id` (`accessary_id`) USING BTREE,
  CONSTRAINT `fk_tbl_user_accessary_accessary_id` FOREIGN KEY (`accessary_id`) REFERENCES `tbl_accessary` (`accessary_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_user_accessary_user_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Table structure for table `tbl_admin_password_resets`
--
CREATE TABLE `tbl_admin_password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `tbl_password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

--
-- Table structure for table `tbl_password_resets`
--
CREATE TABLE `tbl_password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `tbl_password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

INSERT INTO `tbl_role` VALUES (1, 'Administrator', NULL, NULL, NULL, 1);
INSERT INTO `tbl_role` VALUES (2, 'Product Provider', NULL, NULL, NULL, 1);
INSERT INTO `tbl_role` VALUES (3, 'Client', NULL, NULL, NULL, 1);

INSERT INTO `tbl_menu` VALUES (1, 0, 1, 'Account Management', NULL, '/admin/account-management', 0, 1, 'account-management', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (2, 1, 1, 'Update role', NULL, '', 0, 0, 'save-role|edit-role|delete-role|add-role', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (3, 1, 2, 'Update user', NULL, NULL, 0, 0, 'save-user', NULL, NULL);

--
-- Table structure for table `tbl_parts_accessary`
--
CREATE TABLE `tbl_parts_accessary` (
	`parts_accessary_id` INT(11) NOT NULL AUTO_INCREMENT,
	`parts_id` INT(11) NULL DEFAULT NULL,
	`accessary_id` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`parts_accessary_id`),
	INDEX `idx_tbl_parts_accessary_parts_id` (`parts_id`),
	INDEX `idx_tbl_parts_accessary_accessary_id` (`accessary_id`),
	CONSTRAINT `fk_tbl_parts_accessary_accessary_id` FOREIGN KEY (`accessary_id`) REFERENCES `tbl_accessary` (`accessary_id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT `fk_tbl_parts_accessary_parts_id` FOREIGN KEY (`parts_id`) REFERENCES `tbl_parts` (`parts_id`) ON UPDATE NO ACTION ON DELETE NO ACTION
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

--
-- Alter table structure for table `tbl_accessary`
--
ALTER TABLE `tbl_accessary`
	DROP COLUMN `parts_id`,
	DROP INDEX `idx_tbl_accessary_parts_id`,
	DROP FOREIGN KEY `fk_tbl_accessary_parts_id`;
	
--
-- Alter table structure for table `tbl_menu`
--	
ALTER TABLE `tbl_menu`
	CHANGE COLUMN `parrent_id` `parent_id` INT(11) NULL DEFAULT NULL AFTER `id`;

--
-- Alter table structure for table `tbl_car_parts`
--	
ALTER TABLE `tbl_car_parts`
	CHANGE COLUMN `car_parts_id` `car_parts_id` INT(11) NOT NULL AUTO_INCREMENT FIRST;
