/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 100413
 Source Host           : localhost:3306
 Source Schema         : cleaning_introduces

 Target Server Type    : MySQL
 Target Server Version : 100413
 File Encoding         : 65001

 Date: 03/06/2021 14:05:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_menu_order
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu_order`;
CREATE TABLE `admin_menu_order`  (
  `amo_admin` int(11) NOT NULL DEFAULT 0,
  `amo_module` int(11) NOT NULL DEFAULT 0,
  `amo_order` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`amo_admin`, `amo_module`) USING BTREE,
  INDEX `amo_order`(`amo_order`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for admin_translate
-- ----------------------------
DROP TABLE IF EXISTS `admin_translate`;
CREATE TABLE `admin_translate`  (
  `tra_keyword` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tra_text` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lang_id` int(11) NULL DEFAULT NULL,
  `tra_source` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`tra_keyword`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user`  (
  `adm_id` int(11) NOT NULL AUTO_INCREMENT,
  `adm_loginname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `adm_password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `adm_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `adm_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `adm_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `adm_phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `adm_mobile` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `adm_cskh` tinyint(4) NULL DEFAULT 0,
  `adm_job` tinyint(4) NOT NULL DEFAULT 0,
  `adm_access_module` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `adm_access_category` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `adm_date` int(11) NULL DEFAULT 0,
  `adm_isadmin` tinyint(1) NULL DEFAULT 0,
  `adm_active` tinyint(1) NULL DEFAULT 1,
  `lang_id` tinyint(1) NULL DEFAULT 1,
  `adm_delete` int(11) NULL DEFAULT 0,
  `adm_all_category` int(1) NULL DEFAULT NULL,
  `adm_edit_all` int(1) NULL DEFAULT 0,
  `admin_id` int(1) NULL DEFAULT 0,
  PRIMARY KEY (`adm_id`) USING BTREE,
  INDEX `adm_date`(`adm_date`) USING BTREE,
  INDEX `admin_id`(`admin_id`) USING BTREE,
  INDEX `lang_id`(`lang_id`) USING BTREE,
  INDEX `adm_isadmin`(`adm_isadmin`) USING BTREE,
  INDEX `adm_active`(`adm_active`) USING BTREE,
  INDEX `adm_cskh`(`adm_cskh`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 446 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for admin_user_category
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_category`;
CREATE TABLE `admin_user_category`  (
  `auc_admin_id` int(11) NOT NULL DEFAULT 0,
  `auc_category_id` int(11) NOT NULL DEFAULT 0
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for admin_user_language
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_language`;
CREATE TABLE `admin_user_language`  (
  `aul_admin_id` int(11) NOT NULL DEFAULT 0,
  `aul_lang_id` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`aul_admin_id`, `aul_lang_id`) USING BTREE,
  INDEX `aul_lang_id`(`aul_lang_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for admin_user_right
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_right`;
CREATE TABLE `admin_user_right`  (
  `adu_admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `adu_admin_module_id` int(11) NOT NULL DEFAULT 0,
  `adu_add` int(1) NULL DEFAULT 0,
  `adu_edit` int(1) NULL DEFAULT 0,
  `adu_delete` int(1) NULL DEFAULT 0,
  PRIMARY KEY (`adu_admin_id`, `adu_admin_module_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 446 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for categories_multi_parent
-- ----------------------------
DROP TABLE IF EXISTS `categories_multi_parent`;
CREATE TABLE `categories_multi_parent`  (
  `cmp_id` int(11) NOT NULL AUTO_INCREMENT,
  `cmp_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cmp_rewrite_name` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `cmp_icon` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NULL DEFAULT NULL,
  `cmp_has_child` bit(1) NOT NULL,
  `cmp_background` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NULL DEFAULT NULL,
  `bgt_type` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NULL DEFAULT NULL,
  `cmp_meta_description` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NULL DEFAULT NULL,
  `cmp_active` bit(1) NULL DEFAULT NULL,
  `cmp_parent_id` int(11) NULL DEFAULT NULL,
  `web_id` int(11) NOT NULL,
  `post_type_id` varchar(100) CHARACTER SET armscii8 COLLATE armscii8_bin NULL DEFAULT NULL,
  PRIMARY KEY (`cmp_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = armscii8 COLLATE = armscii8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for configuration
-- ----------------------------
DROP TABLE IF EXISTS `configuration`;
CREATE TABLE `configuration`  (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `web_id` int(11) NOT NULL,
  `con_admin_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_site_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_meta_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_meta_keywords` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_mod_rewrite` int(1) NULL DEFAULT 0,
  `con_extenstion` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '\'html\'',
  `lang_id` int(11) NULL DEFAULT 1,
  `con_active_contact` int(1) NOT NULL DEFAULT 0,
  `con_hotline` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_hotline_banhang` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_hotline_hotro_kythuat` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_address` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_background_homepage` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_info_payment` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_fee_transport` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_contact_sale` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_info_company` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_logo_top` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_logo_bottom` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_page_fb` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_link_fb` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_link_twitter` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_link_insta` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_map` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_banner_image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `con_banner_title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `con_banner_description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `con_banner_active` int(1) NOT NULL,
  `con_rewrite_name_homepage` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`con_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 74 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for languages
-- ----------------------------
DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages`  (
  `lang_id` int(11) NOT NULL DEFAULT 0,
  `lang_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `lang_path` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT '\'home\'',
  `lang_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `lang_domain` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`lang_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for modules
-- ----------------------------
DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules`  (
  `mod_id` int(11) NOT NULL AUTO_INCREMENT,
  `mod_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mod_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mod_listname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mod_listfile` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mod_order` int(11) NULL DEFAULT 0,
  `mod_help` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`mod_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for post
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post`  (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `post_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `post_type_background` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `post_image_background` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `post_color_background` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `post_profile` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `post_meta_description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `post_rewrite_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cmp_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `ptd_id` int(11) NULL DEFAULT NULL,
  `post_type_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_id` int(11) NULL DEFAULT NULL,
  `post_datetime_create` datetime(0) NULL DEFAULT current_timestamp(0),
  `post_datetime_update` datetime(0) NULL DEFAULT current_timestamp(0),
  `post_active` bit(1) NULL DEFAULT NULL,
  PRIMARY KEY (`post_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 47 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for post_detail
-- ----------------------------
DROP TABLE IF EXISTS `post_detail`;
CREATE TABLE `post_detail`  (
  `ptd_id` int(11) NOT NULL AUTO_INCREMENT,
  `ptd_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`ptd_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for post_type
-- ----------------------------
DROP TABLE IF EXISTS `post_type`;
CREATE TABLE `post_type`  (
  `post_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_type_title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `post_type_description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `post_type_show` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `post_type_active` bit(1) NULL DEFAULT NULL,
  `allow_show_homepage` bit(1) NULL DEFAULT NULL,
  `web_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`post_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_image_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `product_price` float NOT NULL,
  `product_currency` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_active` bit(1) NULL DEFAULT NULL,
  `web_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`product_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for website_config
-- ----------------------------
DROP TABLE IF EXISTS `website_config`;
CREATE TABLE `website_config`  (
  `web_id` int(11) NOT NULL AUTO_INCREMENT,
  `web_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `web_active` bit(1) NOT NULL DEFAULT b'1',
  `web_url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `web_icon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `web_description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`web_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
