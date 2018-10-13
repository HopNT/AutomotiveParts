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

 Date: 13/10/2018 16:13:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_accessary
-- ----------------------------
DROP TABLE IF EXISTS `tbl_accessary`;
CREATE TABLE `tbl_accessary`  (
  `accessary_id` int(11) NOT NULL AUTO_INCREMENT,
  `catalog_accessary_id` int(11) NULL DEFAULT NULL,
  `trademark_id` int(11) NULL DEFAULT NULL,
  `nation_id` int(11) NULL DEFAULT NULL,
  `type` int(1) NULL DEFAULT NULL,
  `code` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name_en` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name_vi` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `acronym_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `unsigned_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_top` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_top_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_bottom` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_bottom_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_left` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_left_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_right` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_right_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_inner` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_inner_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_outer` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_outer_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `prioritize` int(1) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`accessary_id`) USING BTREE,
  UNIQUE INDEX `idx_tbl_accessary_code`(`code`) USING BTREE,
  INDEX `idx_tbl_accessary_catalog_accessary_id`(`catalog_accessary_id`) USING BTREE,
  INDEX `idx_tbl_accessary_trademark_id`(`trademark_id`) USING BTREE,
  INDEX `idx_tbl_accessary_nation_id`(`nation_id`) USING BTREE,
  CONSTRAINT `fk_tbl_accessary_catalog_accessary_id` FOREIGN KEY (`catalog_accessary_id`) REFERENCES `tbl_catalog_accessary` (`catalog_accessary_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_accessary_nation_id` FOREIGN KEY (`nation_id`) REFERENCES `tbl_nation` (`nation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_accessary_trademark_id` FOREIGN KEY (`trademark_id`) REFERENCES `tbl_trademark` (`trademark_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_accessary_link
-- ----------------------------
DROP TABLE IF EXISTS `tbl_accessary_link`;
CREATE TABLE `tbl_accessary_link`  (
  `accessary_link_id` int(11) NOT NULL AUTO_INCREMENT,
  `accessary_id` int(11) NOT NULL,
  `accessary_value` int(11) NOT NULL,
  PRIMARY KEY (`accessary_link_id`) USING BTREE,
  INDEX `fk_tbl_accessary_link_accessary_id`(`accessary_id`) USING BTREE,
  CONSTRAINT `fk_tbl_accessary_link_accessary_id` FOREIGN KEY (`accessary_id`) REFERENCES `tbl_accessary` (`accessary_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

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

-- ----------------------------
-- Table structure for tbl_car
-- ----------------------------
DROP TABLE IF EXISTS `tbl_car`;
CREATE TABLE `tbl_car`  (
  `car_id` int(11) NOT NULL AUTO_INCREMENT,
  `catalog_car_id` int(11) NULL DEFAULT NULL,
  `car_manufacturer_id` int(11) NULL DEFAULT NULL,
  `nation_id` int(11) NULL DEFAULT NULL,
  `factory_id` int(11) NULL DEFAULT NULL,
  `year_manufacture_id` int(11) NULL DEFAULT NULL,
  `motion_system_id` int(11) NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `number_of_doors` int(11) NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `status` int(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`car_id`) USING BTREE,
  UNIQUE INDEX `idx_tbl_car_code`(`code`) USING BTREE,
  INDEX `idx_tbl_car_catalog_car_id`(`catalog_car_id`) USING BTREE,
  INDEX `idx_tbl_car_car_manufacturer_id`(`car_manufacturer_id`) USING BTREE,
  INDEX `idx_tbl_car_nation_id`(`nation_id`) USING BTREE,
  INDEX `idx_tbl_car_factory_id`(`factory_id`) USING BTREE,
  INDEX `idx_tbl_car_year_manufacture_id`(`year_manufacture_id`) USING BTREE,
  INDEX `idx_tbl_car_motion_system_id`(`motion_system_id`) USING BTREE,
  CONSTRAINT `fk_tbl_car_car_manufacturer_id` FOREIGN KEY (`car_manufacturer_id`) REFERENCES `tbl_car_manufacturer` (`car_manufacturer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_car_catalog_car_id` FOREIGN KEY (`catalog_car_id`) REFERENCES `tbl_catalog_car` (`catalog_car_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_car_factory_id` FOREIGN KEY (`factory_id`) REFERENCES `tbl_factory` (`factory_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_car_motion_system_id` FOREIGN KEY (`motion_system_id`) REFERENCES `tbl_motion_system` (`motion_system_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_car_nation_id` FOREIGN KEY (`nation_id`) REFERENCES `tbl_nation` (`nation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_car_year_manufacture_id` FOREIGN KEY (`year_manufacture_id`) REFERENCES `tbl_year_manufacture` (`year_manufacture_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_car_brand
-- ----------------------------
DROP TABLE IF EXISTS `tbl_car_brand`;
CREATE TABLE `tbl_car_brand`  (
  `car_brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `nation_id` int(11) NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `code_brand` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `status` int(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`car_brand_id`) USING BTREE,
  UNIQUE INDEX `idx_tbl_car_manufacturer_code`(`code`) USING BTREE,
  UNIQUE INDEX `idx_tbl_car_manufacturer_code_brand`(`code_brand`) USING BTREE,
  INDEX `idx_tbl_car_manufacturer_nation_id`(`nation_id`) USING BTREE,
  CONSTRAINT `fk_tbl_car_manufacturer_nation_id` FOREIGN KEY (`nation_id`) REFERENCES `tbl_nation` (`nation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_car_manufacturer
-- ----------------------------
DROP TABLE IF EXISTS `tbl_car_manufacturer`;
CREATE TABLE `tbl_car_manufacturer`  (
  `car_manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `status` int(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`car_manufacturer_id`) USING BTREE,
  UNIQUE INDEX `idx_tbl_car_manufacturer_code`(`code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_car_parts
-- ----------------------------
DROP TABLE IF EXISTS `tbl_car_parts`;
CREATE TABLE `tbl_car_parts`  (
  `car_parts_id` int(11) NOT NULL AUTO_INCREMENT,
  `car_id` int(11) NULL DEFAULT NULL,
  `parts_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`car_parts_id`) USING BTREE,
  INDEX `idx_tbl_car_parts_car_id`(`car_id`) USING BTREE,
  INDEX `idx_tbl_car_parts_parts_id`(`parts_id`) USING BTREE,
  CONSTRAINT `fk_tbl_car_parts_car_id` FOREIGN KEY (`car_id`) REFERENCES `tbl_car` (`car_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_car_parts_parts_id` FOREIGN KEY (`parts_id`) REFERENCES `tbl_parts` (`parts_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_catalog_accessary
-- ----------------------------
DROP TABLE IF EXISTS `tbl_catalog_accessary`;
CREATE TABLE `tbl_catalog_accessary`  (
  `catalog_accessary_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `parent_id` int(11) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`catalog_accessary_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_catalog_car
-- ----------------------------
DROP TABLE IF EXISTS `tbl_catalog_car`;
CREATE TABLE `tbl_catalog_car`  (
  `catalog_car_id` int(11) NOT NULL AUTO_INCREMENT,
  `car_brand_id` int(11) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `status` int(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`catalog_car_id`) USING BTREE,
  INDEX `idx_tbl_catalog_car_car_brand_id`(`car_brand_id`) USING BTREE,
  CONSTRAINT `fk_tbl_catalog_car_car_brand_id` FOREIGN KEY (`car_brand_id`) REFERENCES `tbl_car_brand` (`car_brand_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_catalog_parts
-- ----------------------------
DROP TABLE IF EXISTS `tbl_catalog_parts`;
CREATE TABLE `tbl_catalog_parts`  (
  `catalog_parts_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NULL DEFAULT NULL,
  `icon` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `icon_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `status` int(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`catalog_parts_id`) USING BTREE,
  INDEX `idx_tbl_catalog_parts_parent_id`(`parent_id`) USING BTREE,
  CONSTRAINT `fk_tbl_catalog_parts_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `tbl_catalog_parts` (`catalog_parts_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_factory
-- ----------------------------
DROP TABLE IF EXISTS `tbl_factory`;
CREATE TABLE `tbl_factory`  (
  `factory_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `address` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `status` int(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`factory_id`) USING BTREE,
  INDEX `idx_tbl_factory_code`(`code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

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
INSERT INTO `tbl_menu` VALUES (1, 0, 8, 'QL Tài Khoản', NULL, '/admin/account-management', 0, 1, 'account-management', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (2, 1, 1, 'Cập nhật thông tin Quyền', NULL, '', 0, 0, 'edit-role|delete-role|add-role', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (3, 1, 2, 'Cập nhật thông tin User', NULL, NULL, 0, 0, 'save-user|get-user|delete-user|view_profile|change_password', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (4, 0, 5, 'QL Danh Mục Ô tô', NULL, '/admin/car-management', 0, 1, 'car-management', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (5, 4, 1, 'Cập nhật thông tin Hãng Xe', NULL, NULL, 0, 0, 'car-brand-save|car-brand-getById|car-brand-delete|car-brand-get-all', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (6, 4, 2, 'Cập nhật thông tin Loại Xe', NULL, NULL, 0, 0, 'catalog-car-save|catalog-car-delete|catalog-car-getById|catalog-car-getByCarBrand', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (7, 4, 3, 'Cập nhật thông tin Xe', NULL, NULL, 0, 0, 'car-save|car-edit|car-delete|car-brand-get-all|catalog-car-getByCarBrand|parts-search-by-text|catalog-car-get-all', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (8, 0, 1, 'QL Danh Mục Quốc Gia', NULL, '/admin/nation-management', 0, 1, 'nation-management', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (9, 8, 1, 'Cập nhật thông tin Quốc Gia', NULL, NULL, 0, 0, 'nation-save|nation-getById|nation-delete', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (10, 0, 2, 'QL Danh Mục Thương Hiệu', NULL, '/admin/trademark-management', 0, 1, 'trademark-management', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (11, 10, 2, 'Cập nhật thông tin Thương Hiệu', NULL, NULL, 0, 0, 'trademark-getById|trademark-delete|trademark-save', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (12, 0, 4, 'QL Danh Mục Bộ Phận Xe', NULL, '/admin/parts-management', 0, 1, 'parts-management', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (13, 12, 1, 'Cập nhật thông tin Nhóm Bộ Phận Xe', NULL, NULL, 0, 0, 'catalog-parts-save|catalog-parts-getById|catalog-parts-delete|catalog-parts-get-all|catalog-parts-search-by-text', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (14, 12, 2, 'Cập nhật thông tin Bộ Phận Xe', NULL, NULL, 0, 0, 'accessary-search-by-text|parts-save|parts-get-by-id|parts-delete', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (15, 0, 6, 'QL Danh Mục Giá - Phụ Tùng', NULL, '/admin/price-management', 0, 1, 'price-management', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (16, 15, 1, 'Cập nhật thông tin Giá - Phụ Tùng', NULL, NULL, 0, 0, 'accessary-get-all|accessary-search-by-text|price-save|price-edit|price-delete', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (17, 0, 7, 'QL Phê Duyệt Phụ Tùng', NULL, '/admin/temp-price-management', 0, 1, 'temp-price-management', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (18, 17, 1, 'Cập nhật thông tin Phê Duyệt Phụ Tùng', NULL, NULL, 0, 0, 'temp-price-save|temp-price-edit|temp-price-approve|temp-price-reject|temp-price-delete|trademark-get-all|nation-get-all', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (19, 0, 3, 'QL Danh Mục Phụ Tùng', NULL, '/admin/accessary-management', 0, 1, 'accessary-management', NULL, NULL);
INSERT INTO `tbl_menu` VALUES (20, 19, 1, 'Cập nhật thông tin Phụ Tùng', NULL, NULL, 0, 0, 'accessary-save|accessary-edit|accessary-delete|accessary-search-by-text-limited', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_menu_role
-- ----------------------------
INSERT INTO `tbl_menu_role` VALUES (1, 1, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (2, 2, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (3, 3, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (4, 4, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (5, 5, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (6, 6, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (7, 7, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (8, 8, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (9, 9, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (10, 10, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (11, 11, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (12, 12, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (13, 13, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (14, 14, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (15, 15, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (16, 16, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (17, 17, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (18, 18, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (19, 19, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (20, 20, 1, NULL);
INSERT INTO `tbl_menu_role` VALUES (21, 15, 2, NULL);
INSERT INTO `tbl_menu_role` VALUES (22, 16, 2, NULL);
INSERT INTO `tbl_menu_role` VALUES (23, 17, 2, NULL);
INSERT INTO `tbl_menu_role` VALUES (24, 18, 2, NULL);

-- ----------------------------
-- Table structure for tbl_motion_system
-- ----------------------------
DROP TABLE IF EXISTS `tbl_motion_system`;
CREATE TABLE `tbl_motion_system`  (
  `motion_system_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `status` int(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`motion_system_id`) USING BTREE,
  UNIQUE INDEX `idx_tbl_motion_system_code`(`code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_nation
-- ----------------------------
DROP TABLE IF EXISTS `tbl_nation`;
CREATE TABLE `tbl_nation`  (
  `nation_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name_vi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `status` int(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`nation_id`) USING BTREE,
  UNIQUE INDEX `idx_tbl_nation_code`(`code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_parts
-- ----------------------------
DROP TABLE IF EXISTS `tbl_parts`;
CREATE TABLE `tbl_parts`  (
  `parts_id` int(11) NOT NULL AUTO_INCREMENT,
  `catalog_parts_id` int(11) NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `width` decimal(10, 2) NULL DEFAULT NULL,
  `height` decimal(10, 2) NULL DEFAULT NULL,
  `number_of_tooth` int(11) NULL DEFAULT NULL,
  `inner_diameter` decimal(10, 2) NULL DEFAULT NULL,
  `outer_diameter` decimal(10, 2) NULL DEFAULT NULL,
  `torque` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `life_cycle` int(11) NULL DEFAULT NULL,
  `weight` decimal(10, 2) NULL DEFAULT NULL,
  `liquor` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `status` int(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`parts_id`) USING BTREE,
  UNIQUE INDEX `idx_tbl_parts_code`(`code`) USING BTREE,
  INDEX `idx_tbl_parts_catalog_parts_id`(`catalog_parts_id`) USING BTREE,
  CONSTRAINT `fk_tbl_parts_catalog_parts_id` FOREIGN KEY (`catalog_parts_id`) REFERENCES `tbl_catalog_parts` (`catalog_parts_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_parts_accessary
-- ----------------------------
DROP TABLE IF EXISTS `tbl_parts_accessary`;
CREATE TABLE `tbl_parts_accessary`  (
  `parts_accessary_id` int(11) NOT NULL AUTO_INCREMENT,
  `parts_id` int(11) NULL DEFAULT NULL,
  `accessary_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`parts_accessary_id`) USING BTREE,
  INDEX `idx_tbl_parts_accessary_parts_id`(`parts_id`) USING BTREE,
  INDEX `idx_tbl_parts_accessary_accessary_id`(`accessary_id`) USING BTREE,
  CONSTRAINT `fk_tbl_parts_accessary_accessary_id` FOREIGN KEY (`accessary_id`) REFERENCES `tbl_accessary` (`accessary_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_parts_accessary_parts_id` FOREIGN KEY (`parts_id`) REFERENCES `tbl_parts` (`parts_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

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
  `status` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_role
-- ----------------------------
INSERT INTO `tbl_role` VALUES (1, 'Quản trị viên', NULL, '2018-10-13 09:41:16', NULL, 1);
INSERT INTO `tbl_role` VALUES (2, 'Nhà cung cấp', NULL, NULL, NULL, 1);
INSERT INTO `tbl_role` VALUES (3, 'Khách hàng', NULL, NULL, NULL, 1);

-- ----------------------------
-- Table structure for tbl_temp_price
-- ----------------------------
DROP TABLE IF EXISTS `tbl_temp_price`;
CREATE TABLE `tbl_temp_price`  (
  `temp_price_id` int(11) NOT NULL AUTO_INCREMENT,
  `trademark_id` int(11) NULL DEFAULT NULL,
  `nation_id` int(11) NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `type` int(1) NULL DEFAULT NULL,
  `code` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name_en` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name_vi` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `acronym_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `unsigned_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_top` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_top_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_bottom` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_bottom_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_left` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_left_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_right` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_right_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_inner` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_inner_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_outer` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `photo_outer_name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `garage_price` decimal(15, 0) NULL DEFAULT NULL,
  `retail_price` decimal(15, 0) NULL DEFAULT NULL,
  `quantity` int(11) NULL DEFAULT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `status` int(11) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`temp_price_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_trademark
-- ----------------------------
DROP TABLE IF EXISTS `tbl_trademark`;
CREATE TABLE `tbl_trademark`  (
  `trademark_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `status` int(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`trademark_id`) USING BTREE,
  UNIQUE INDEX `idx_tbl_trademark`(`code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
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
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  UNIQUE INDEX `idx_tbl_user_code`(`code`) USING BTREE,
  UNIQUE INDEX `idx_tbl_user_username`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES (1, NULL, 'Tu', '1994-08-28', 1, '1', '1', 'Địa chỉ', '0123456789', '1', 'nguyenthanhtu94@gmail.com', NULL, '$2y$10$ZV7v1aWdG1qsVgo3RBw9t.RCwzW38mWJdkIQ759XBwkLpICyV/fPy', '0', '1', '2018-09-06 00:01:20', '2018-10-13 09:59:24', 'd3MpTw82E6v4BzgiX3S67aAo3zSqsLI4RFlcp74NqPppQkBNIuqmtOPtejrK', 1, NULL);
INSERT INTO `tbl_user` VALUES (2, NULL, 'Manh Mít Ướt', '2018-09-19', 0, '2222', '3333', '4444', '123456789', '1111', 'manhnv@gmail.com', NULL, '$2y$10$Z68lmp6iqE4NLSlNo9W/Tu.73XsR6kiKwG9ra1GuHPqw/N2osekBG', '1', '1', '2018-09-27 00:43:17', '2018-10-13 09:58:26', NULL, 2, NULL);

-- ----------------------------
-- Table structure for tbl_user_accessary
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_accessary`;
CREATE TABLE `tbl_user_accessary`  (
  `user_accessary_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `accessary_id` int(11) NULL DEFAULT NULL,
  `garage_price` decimal(15, 0) NULL DEFAULT NULL,
  `retail_price` decimal(15, 0) NULL DEFAULT NULL,
  `quantity` int(11) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`user_accessary_id`) USING BTREE,
  INDEX `idx_tbl_user_accessary_user_id`(`user_id`) USING BTREE,
  INDEX `idx_tbl_user_accessary_accessary_id`(`accessary_id`) USING BTREE,
  CONSTRAINT `fk_tbl_user_accessary_accessary_id` FOREIGN KEY (`accessary_id`) REFERENCES `tbl_accessary` (`accessary_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_user_accessary_user_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tbl_year_manufacture
-- ----------------------------
DROP TABLE IF EXISTS `tbl_year_manufacture`;
CREATE TABLE `tbl_year_manufacture`  (
  `year_manufacture_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `year` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `status` int(1) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`year_manufacture_id`) USING BTREE,
  UNIQUE INDEX `idx_tabl_year_manufacture_code`(`code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
