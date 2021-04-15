/*
 Navicat Premium Data Transfer

 Source Server         : LocalDB
 Source Server Type    : MySQL
 Source Server Version : 100113
 Source Host           : localhost:3306
 Source Schema         : db_epu

 Target Server Type    : MySQL
 Target Server Version : 100113
 File Encoding         : 65001

 Date: 08/01/2021 13:16:19
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
-- Records of admin_menu_order
-- ----------------------------
INSERT INTO `admin_menu_order` VALUES (1, 14, 14);
INSERT INTO `admin_menu_order` VALUES (1, 23, 5);
INSERT INTO `admin_menu_order` VALUES (1, 87, 0);
INSERT INTO `admin_menu_order` VALUES (1, 35, 3);
INSERT INTO `admin_menu_order` VALUES (1, 11, 15);
INSERT INTO `admin_menu_order` VALUES (1, 18, 0);
INSERT INTO `admin_menu_order` VALUES (1, 46, 0);
INSERT INTO `admin_menu_order` VALUES (1, 10, 2);
INSERT INTO `admin_menu_order` VALUES (1, 26, 4);
INSERT INTO `admin_menu_order` VALUES (1, 19, 8);
INSERT INTO `admin_menu_order` VALUES (1, 72, 0);
INSERT INTO `admin_menu_order` VALUES (1, 67, 13);
INSERT INTO `admin_menu_order` VALUES (1, 24, 12);
INSERT INTO `admin_menu_order` VALUES (439, 35, 0);
INSERT INTO `admin_menu_order` VALUES (439, 26, 0);
INSERT INTO `admin_menu_order` VALUES (439, 67, 0);
INSERT INTO `admin_menu_order` VALUES (439, 24, 0);
INSERT INTO `admin_menu_order` VALUES (1, 88, 8);
INSERT INTO `admin_menu_order` VALUES (1, 89, 9);
INSERT INTO `admin_menu_order` VALUES (438, 19, 0);
INSERT INTO `admin_menu_order` VALUES (1, 91, 0);
INSERT INTO `admin_menu_order` VALUES (1, 92, 2);
INSERT INTO `admin_menu_order` VALUES (1, 93, 0);
INSERT INTO `admin_menu_order` VALUES (1, 94, 0);
INSERT INTO `admin_menu_order` VALUES (1, 95, 11);
INSERT INTO `admin_menu_order` VALUES (440, 23, 0);
INSERT INTO `admin_menu_order` VALUES (440, 91, 0);
INSERT INTO `admin_menu_order` VALUES (440, 19, 0);
INSERT INTO `admin_menu_order` VALUES (1, 96, 10);
INSERT INTO `admin_menu_order` VALUES (441, 96, 0);
INSERT INTO `admin_menu_order` VALUES (441, 19, 0);
INSERT INTO `admin_menu_order` VALUES (441, 91, 0);
INSERT INTO `admin_menu_order` VALUES (441, 23, 0);
INSERT INTO `admin_menu_order` VALUES (441, 11, 0);
INSERT INTO `admin_menu_order` VALUES (441, 35, 0);
INSERT INTO `admin_menu_order` VALUES (441, 67, 0);
INSERT INTO `admin_menu_order` VALUES (441, 89, 0);
INSERT INTO `admin_menu_order` VALUES (441, 88, 0);
INSERT INTO `admin_menu_order` VALUES (441, 26, 0);
INSERT INTO `admin_menu_order` VALUES (441, 14, 0);
INSERT INTO `admin_menu_order` VALUES (441, 95, 0);
INSERT INTO `admin_menu_order` VALUES (441, 92, 0);
INSERT INTO `admin_menu_order` VALUES (441, 24, 0);
INSERT INTO `admin_menu_order` VALUES (442, 96, 0);
INSERT INTO `admin_menu_order` VALUES (442, 35, 0);
INSERT INTO `admin_menu_order` VALUES (442, 26, 0);
INSERT INTO `admin_menu_order` VALUES (442, 95, 0);
INSERT INTO `admin_menu_order` VALUES (442, 92, 0);
INSERT INTO `admin_menu_order` VALUES (442, 11, 0);
INSERT INTO `admin_menu_order` VALUES (442, 23, 0);
INSERT INTO `admin_menu_order` VALUES (442, 67, 0);
INSERT INTO `admin_menu_order` VALUES (442, 89, 0);
INSERT INTO `admin_menu_order` VALUES (442, 88, 0);
INSERT INTO `admin_menu_order` VALUES (442, 14, 0);
INSERT INTO `admin_menu_order` VALUES (442, 24, 0);
INSERT INTO `admin_menu_order` VALUES (442, 91, 0);
INSERT INTO `admin_menu_order` VALUES (1, 97, 0);
INSERT INTO `admin_menu_order` VALUES (1, 99, 2);
INSERT INTO `admin_menu_order` VALUES (1, 98, 1);
INSERT INTO `admin_menu_order` VALUES (1, 100, 8);
INSERT INTO `admin_menu_order` VALUES (1, 101, 9);
INSERT INTO `admin_menu_order` VALUES (1, 102, 6);
INSERT INTO `admin_menu_order` VALUES (1, 103, 7);
INSERT INTO `admin_menu_order` VALUES (1, 104, 0);
INSERT INTO `admin_menu_order` VALUES (1, 105, 0);
INSERT INTO `admin_menu_order` VALUES (1, 106, 0);
INSERT INTO `admin_menu_order` VALUES (1, 107, 0);
INSERT INTO `admin_menu_order` VALUES (1, 108, 0);
INSERT INTO `admin_menu_order` VALUES (1, 109, 0);
INSERT INTO `admin_menu_order` VALUES (1, 110, 0);
INSERT INTO `admin_menu_order` VALUES (1, 3, 6);
INSERT INTO `admin_menu_order` VALUES (1, 2, 4);
INSERT INTO `admin_menu_order` VALUES (1, 4, 0);
INSERT INTO `admin_menu_order` VALUES (1, 1, 7);
INSERT INTO `admin_menu_order` VALUES (1, 6, 2);
INSERT INTO `admin_menu_order` VALUES (1, 5, 1);
INSERT INTO `admin_menu_order` VALUES (1, 7, 3);
INSERT INTO `admin_menu_order` VALUES (1, 8, 5);
INSERT INTO `admin_menu_order` VALUES (1, 9, 0);
INSERT INTO `admin_menu_order` VALUES (1, 12, 0);
INSERT INTO `admin_menu_order` VALUES (1, 13, 0);
INSERT INTO `admin_menu_order` VALUES (1, 15, 4);
INSERT INTO `admin_menu_order` VALUES (1, 16, 0);
INSERT INTO `admin_menu_order` VALUES (1, 17, 6);
INSERT INTO `admin_menu_order` VALUES (1, 20, 3);
INSERT INTO `admin_menu_order` VALUES (1, 21, 1);
INSERT INTO `admin_menu_order` VALUES (443, 2, 0);
INSERT INTO `admin_menu_order` VALUES (443, 7, 0);
INSERT INTO `admin_menu_order` VALUES (443, 6, 0);

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
-- Records of admin_translate
-- ----------------------------
INSERT INTO `admin_translate` VALUES ('0323de4f66a1700e2173e9bcdce02715', 'Logout', 1, 'Logout');
INSERT INTO `admin_translate` VALUES ('b61541208db7fa7dba42c85224405911', 'Menu', 1, 'Menu');
INSERT INTO `admin_translate` VALUES ('e050b402c1f5326f8d350c61694e0513', 'Show list menu', 1, 'Show list menu');
INSERT INTO `admin_translate` VALUES ('6bc362dbf494c61ea117fe3c71ca48a5', 'Move', 1, 'Move');
INSERT INTO `admin_translate` VALUES ('d6705b26e977120f7fff7f6541aa3680', 'Menu listing', 1, 'Menu listing');
INSERT INTO `admin_translate` VALUES ('3e4f6b98dd47b06bb7d7b452338d8f13', 'Thứ tự', 1, 'Thứ tự');
INSERT INTO `admin_translate` VALUES ('ada8b28aaf732f572121bdaf7b734e05', 'Tên menu', 1, 'Tên menu');
INSERT INTO `admin_translate` VALUES ('9d73d841b7a35ee09471fbc8382063d1', 'Liên kết', 1, 'Liên kết');
INSERT INTO `admin_translate` VALUES ('69ea36f3046522e3b87d0ca79a1d721e', 'Vị trí', 1, 'Vị trí');
INSERT INTO `admin_translate` VALUES ('bb2562bfee18c26343fc91d08e28a625', 'No selected', 1, 'No selected');
INSERT INTO `admin_translate` VALUES ('c9cc8cce247e49bae79f15173ce97354', 'Save', 1, 'Save');
INSERT INTO `admin_translate` VALUES ('3744738d8abab2f3bfbc43742096ccc6', 'Mở ra cửa sổ', 1, 'Mở ra cửa sổ');
INSERT INTO `admin_translate` VALUES ('4d3d769b812b6faa6b76e1a8abaece2d', 'Active', 1, 'Active');
INSERT INTO `admin_translate` VALUES ('5fb63579fc981698f97d55bfecb213ea', 'Copy', 1, 'Copy');
INSERT INTO `admin_translate` VALUES ('7dce122004969d56ae2e0245cb754d35', 'Edit', 1, 'Edit');
INSERT INTO `admin_translate` VALUES ('f2a6c498fb90ee345d997f888fce3b18', 'Delete', 1, 'Delete');
INSERT INTO `admin_translate` VALUES ('dfaa01f3617bd390d1cb2bab9cf0520f', 'Click to edit...', 1, 'Click to edit...');
INSERT INTO `admin_translate` VALUES ('8929ef313c0fd6e43446cc0aa86b70cd', 'Tìm kiếm', 1, 'Tìm kiếm');
INSERT INTO `admin_translate` VALUES ('f1851d5600eae616ee802a31ac74701b', 'Enter', 1, 'Enter');
INSERT INTO `admin_translate` VALUES ('063c5bad4cb4e38270a8064282d8cf26', 'Sort A->Z or Z->A', 1, 'Sort A->Z or Z->A');
INSERT INTO `admin_translate` VALUES ('d879cb7ec352716ee940adac5c505340', 'Do you want to delete the product you\'ve selected ?', 1, 'Do you want to delete the product you\'ve selected ?');
INSERT INTO `admin_translate` VALUES ('24c0b84c19d8cdde90951ac6762f0706', 'Delete all selected', 1, 'Delete all selected');
INSERT INTO `admin_translate` VALUES ('17ae5cc83fa7a949d2008d5d2a556fe2', 'Total record', 1, 'Total record');
INSERT INTO `admin_translate` VALUES ('8d6e39135454a7027fc058ab43383aa8', 'Trang tĩnh', 1, 'Trang tĩnh');
INSERT INTO `admin_translate` VALUES ('1cd2c2f7a203be1d0a7cc942037d51ad', 'Tin tức', 1, 'Tin tức');
INSERT INTO `admin_translate` VALUES ('1d1aa192b5f3b65f18a833224b52a22d', 'Sản phẩm', 1, 'Sản phẩm');
INSERT INTO `admin_translate` VALUES ('33f0741f9e26310fbe1a9511048e4996', 'Giới thiệu', 1, 'Giới thiệu');
INSERT INTO `admin_translate` VALUES ('8881984856eea95a37c6b2f116da5da0', 'Phụ kiện', 1, 'Phụ kiện');
INSERT INTO `admin_translate` VALUES ('bb0ca7b10e0403c6cf6d0856a303c80b', 'Giải pháp', 1, 'Giải pháp');
INSERT INTO `admin_translate` VALUES ('399474704c5d235108c1df6dc63e8417', 'Hỏi đáp', 1, 'Hỏi đáp');
INSERT INTO `admin_translate` VALUES ('f01435acd94ced9d198b163136a6ceb1', 'Chọn danh mục', 1, 'Chọn danh mục');
INSERT INTO `admin_translate` VALUES ('88cca1554d60a722c9329867fe6726de', 'Tên danh mục', 1, 'Tên danh mục');
INSERT INTO `admin_translate` VALUES ('7e1f42134de6654908c29d8416edc842', 'Thêm mới danh mục', 1, 'Thêm mới danh mục');
INSERT INTO `admin_translate` VALUES ('6925a750d9e84cdbab22e95eadc99906', 'Loại danh mục', 1, 'Loại danh mục');
INSERT INTO `admin_translate` VALUES ('6cd9e20b34570fd85452d6841057d2c2', 'Chọn loại danh mục', 1, 'Chọn loại danh mục');
INSERT INTO `admin_translate` VALUES ('29deb7955c1d18575d56aaae47bf1a5e', 'Sắp xếp', 1, 'Sắp xếp');
INSERT INTO `admin_translate` VALUES ('3c6f336189cf75e45b09039066ab2cc4', 'Ảnh', 1, 'Ảnh');
INSERT INTO `admin_translate` VALUES ('3d94238c027cc777954c8c3e10ddb258', 'Danh mục cha', 1, 'Danh mục cha');
INSERT INTO `admin_translate` VALUES ('cf210dbf1670fa82368c0a1e7f4e56c4', 'Chọn danh mục con', 1, 'Chọn danh mục con');
INSERT INTO `admin_translate` VALUES ('bc214b2709bc9d5700f8e0b32cbc4d79', 'Tiếp tục thêm', 1, 'Tiếp tục thêm');
INSERT INTO `admin_translate` VALUES ('77f6903f0ac02331b5a7001a05519ae8', 'Thêm mới', 1, 'Thêm mới');
INSERT INTO `admin_translate` VALUES ('8e9d61188f4cad473a2f12626dabb1e4', 'Danh sách ảnh', 1, 'Danh sách ảnh');
INSERT INTO `admin_translate` VALUES ('af1b98adf7f686b84cd0b443e022b7a0', 'Categories', 1, 'Categories');
INSERT INTO `admin_translate` VALUES ('53d8de583ea7608b24d2aaf0edd90f0b', 'Danh mục', 1, 'Danh mục');
INSERT INTO `admin_translate` VALUES ('cd48206067ac5f62cc664794150bd319', 'Category listing', 1, 'Category listing');
INSERT INTO `admin_translate` VALUES ('498f79c4c5bbde77f1bceb6c86fd0f6d', 'Show', 1, 'Show');
INSERT INTO `admin_translate` VALUES ('a28c6d1503fde7e355cda9ce2b7ba5d0', 'Are you want duplicate record', 1, 'Are you want duplicate record');
INSERT INTO `admin_translate` VALUES ('573d643cf1e507e3939566ee8cb85bfe', 'Please enter category name', 1, 'Please enter category name');
INSERT INTO `admin_translate` VALUES ('40a3f6e61efa652c8a06e67a33ada355', 'Sửa danh mục', 1, 'Sửa danh mục');
INSERT INTO `admin_translate` VALUES ('06e0e9ebf644616fd56c521f74611b00', 'Danh mục con', 1, 'Danh mục con');
INSERT INTO `admin_translate` VALUES ('5254652803211a21b0aafdc1b278cd09', 'Lưu lại', 1, 'Lưu lại');
INSERT INTO `admin_translate` VALUES ('4bf239867967133d56e22c691b990730', 'Làm lại', 1, 'Làm lại');
INSERT INTO `admin_translate` VALUES ('46c397226dd34c77dcc8c64859c9e520', 'Banner Listing', 1, 'Banner Listing');
INSERT INTO `admin_translate` VALUES ('664e2136bf45dca2ea4eed276d90ae19', 'Banner name', 1, 'Banner name');
INSERT INTO `admin_translate` VALUES ('88a126c7b39a4e035444d5ed8323fa72', 'Link banner', 1, 'Link banner');
INSERT INTO `admin_translate` VALUES ('0b366e999e00a10cbbef9819cfff1023', 'Loại Banner', 1, 'Loại Banner');
INSERT INTO `admin_translate` VALUES ('bafd7322c6e97d25b6299b5d6fe8920b', 'No', 1, 'No');
INSERT INTO `admin_translate` VALUES ('1c124c3750c7d7a139a12f66cd64af28', 'Login Name', 1, 'Login Name');
INSERT INTO `admin_translate` VALUES ('f11b368cddfe37c47af9b9d91c6ba4f0', 'Full name', 1, 'Full name');
INSERT INTO `admin_translate` VALUES ('ce8ae9da5b7cd6c3df2929543a9af92d', 'Email', 1, 'Email');
INSERT INTO `admin_translate` VALUES ('94a064527b49d1806c785017cb4de5e2', 'Username GN', 1, 'Username GN');
INSERT INTO `admin_translate` VALUES ('fc8c9c23f2469829de2243f7f8d72444', 'Right module', 1, 'Right module');
INSERT INTO `admin_translate` VALUES ('57d056ed0984166336b7879c2af3657f', 'City', 1, 'City');
INSERT INTO `admin_translate` VALUES ('572fdff36c9419a3204e0a27c851150b', 'Fake Login', 1, 'Fake Login');
INSERT INTO `admin_translate` VALUES ('99dea78007133396a7b8ed70578ac6ae', 'Login', 1, 'Login');
INSERT INTO `admin_translate` VALUES ('9d5b888617863d159ab820e180d623ef', 'Are you sure to delete', 1, 'Are you sure to delete');
INSERT INTO `admin_translate` VALUES ('27163bae262de21ce154cfbdfd477c2b', 'Management website version 1.0', 1, 'Management website version 1.0');
INSERT INTO `admin_translate` VALUES ('09f0c5159c5e34504e453eff3fc70324', 'Account Management', 1, 'Account Management');
INSERT INTO `admin_translate` VALUES ('08bd40c7543007ad06e4fce31618f6ec', 'Account', 1, 'Account');
INSERT INTO `admin_translate` VALUES ('dc647eb65e6711e155375218212b3964', 'Password', 1, 'Password');
INSERT INTO `admin_translate` VALUES ('a58f11905c6e4e604025da091fd21392', 'City/District Listing', 1, 'City/District Listing');
INSERT INTO `admin_translate` VALUES ('8833c8e8224a14b07aa3e6e75adff5c8', 'Click vào để sửa đổi sau đó enter để lưu lại', 1, 'Click vào để sửa đổi sau đó enter để lưu lại');
INSERT INTO `admin_translate` VALUES ('e74687ce22a0dd5b084b221e0245d9c1', 'Nhân bản thêm một bản ghi mới', 1, 'Nhân bản thêm một bản ghi mới');
INSERT INTO `admin_translate` VALUES ('103e26ede1d9a1ef79d9a695ad38f076', 'Bạn muốn sửa đổi bản ghi', 1, 'Bạn muốn sửa đổi bản ghi');
INSERT INTO `admin_translate` VALUES ('56ee3495a32081ccb6d2376eab391bfa', 'Listing', 1, 'Listing');
INSERT INTO `admin_translate` VALUES ('a261e9c2d70b7377da04817678ffe28b', 'Thêm menu mới', 1, 'Thêm menu mới');
INSERT INTO `admin_translate` VALUES ('40782f943cb26695685719d494a86558', 'Click sửa đổi sau đó chọn save', 1, 'Click sửa đổi sau đó chọn save');
INSERT INTO `admin_translate` VALUES ('a5915972963fbe301b98cba71fec357b', 'Bạn muốn xóa bản ghi?', 1, 'Bạn muốn xóa bản ghi?');
INSERT INTO `admin_translate` VALUES ('4631c1fd35806f277b34ba3c70069489', 'You have successfully deleted', 1, 'You have successfully deleted');
INSERT INTO `admin_translate` VALUES ('327431af0359c7ac54080e8671c1fc80', 'You have successfully duplicated', 1, 'You have successfully duplicated');
INSERT INTO `admin_translate` VALUES ('ae4b89f870785ea13dba02f1dcd0a20a', 'Tiêu đề', 1, 'Tiêu đề');
INSERT INTO `admin_translate` VALUES ('990cc9a866a8c9f700e8b18da651ca66', 'Statics Listing', 1, 'Statics Listing');
INSERT INTO `admin_translate` VALUES ('a915353abb7e8032f213f403c089865a', 'Chọn danh mục cha', 1, 'Chọn danh mục cha');
INSERT INTO `admin_translate` VALUES ('af871bda571ca25c95d085fbd134daa1', 'Giá phải lớn hơn 0 !', 1, 'Giá phải lớn hơn 0 !');
INSERT INTO `admin_translate` VALUES ('fba94834af2988e51fdaf118bed1a949', 'Giá nhập về phải lớn hơn 0 !', 1, 'Giá nhập về phải lớn hơn 0 !');
INSERT INTO `admin_translate` VALUES ('d9b718cad121430960a45708020bd80a', 'Add new record', 1, 'Add new record');
INSERT INTO `admin_translate` VALUES ('78c02d516a42555f271f43eb874ac677', 'Sửa menu', 1, 'Sửa menu');
INSERT INTO `admin_translate` VALUES ('2374b44bec1b6a80cc13c07d0d19f91c', 'Admin User listing', 1, 'Admin User listing');
INSERT INTO `admin_translate` VALUES ('8b14cccf460524cc522b671cb73c4a60', 'Username is not empty and> 3 characters', 1, 'Username is not empty and> 3 characters');
INSERT INTO `admin_translate` VALUES ('4a2625fe1771a1890227ec50ee1f86ea', 'Administrator account already exists', 1, 'Administrator account already exists');
INSERT INTO `admin_translate` VALUES ('df10cc9b682c4dbf276339eb45b2a65b', 'Password must be greater than 4 characters', 1, 'Password must be greater than 4 characters');
INSERT INTO `admin_translate` VALUES ('16648260e58b4cf9d458e1a197ef43f1', 'Email is invalid', 1, 'Email is invalid');
INSERT INTO `admin_translate` VALUES ('7ccf75fa7498152efe4e152833455c67', 'Login name', 1, 'Login name');
INSERT INTO `admin_translate` VALUES ('bcc254b55c4a1babdf1dcb82c207506b', 'Phone', 1, 'Phone');
INSERT INTO `admin_translate` VALUES ('4c231e0da3eaaa6a9752174f7f9cfb31', 'Confirm password', 1, 'Confirm password');
INSERT INTO `admin_translate` VALUES ('7b15160cb91a523014f1606660fd1851', 'Username trên Giao nhận', 1, 'Username trên Giao nhận');
INSERT INTO `admin_translate` VALUES ('99938282f04071859941e18f16efcf42', 'select', 1, 'select');
INSERT INTO `admin_translate` VALUES ('22884db148f0ffb0d830ba431102b0b5', 'module', 1, 'module');
INSERT INTO `admin_translate` VALUES ('34ec78fcc91ffb1e54cd85e4a0924332', 'add', 1, 'add');
INSERT INTO `admin_translate` VALUES ('de95b43bceeb4b998aed4aed5cef1ae7', 'edit', 1, 'edit');
INSERT INTO `admin_translate` VALUES ('099af53f601532dbd31e0ea99ffdeb64', 'delete', 1, 'delete');
INSERT INTO `admin_translate` VALUES ('84a8921b25f505d0d2077aeb5db4bc16', 'Static', 1, 'Static');
INSERT INTO `admin_translate` VALUES ('06145a21dcec7395085b033e6e169b61', 'Menus', 1, 'Menus');
INSERT INTO `admin_translate` VALUES ('f9aae5fda8d810a29f12d1e61b4ab25f', 'Users', 1, 'Users');
INSERT INTO `admin_translate` VALUES ('a54f98b0e23e6925c855760cdabd7168', 'Banners', 1, 'Banners');
INSERT INTO `admin_translate` VALUES ('edd7ae75c3a820d7fb5b331a020c4626', 'Admin User - Management', 1, 'Admin User - Management');
INSERT INTO `admin_translate` VALUES ('eb631b70ae7c721773f91b506c815082', 'Configurations', 1, 'Configurations');
INSERT INTO `admin_translate` VALUES ('e2f06abaff2623821632a05249f4c5f6', 'List City - District', 1, 'List City - District');
INSERT INTO `admin_translate` VALUES ('f3d873c4bc4d8c1dea06311d3226b919', 'Admin city', 1, 'Admin city');
INSERT INTO `admin_translate` VALUES ('c9cb3dbd637672e65c8138311808f73b', 'all_category', 1, 'all_category');
INSERT INTO `admin_translate` VALUES ('03368e3c1eb4d2a9048775874301b19f', 'Select category', 1, 'Select category');
INSERT INTO `admin_translate` VALUES ('97efa0b62a66b41fd988ec7fc2e694bb', 'save_change', 1, 'save_change');
INSERT INTO `admin_translate` VALUES ('7a6e7491825990107cbfa71abe947112', 'All_category', 1, 'All_category');
INSERT INTO `admin_translate` VALUES ('efd07a93bff07c8dd52624d900172d83', 'Thêm mới Admin User', 1, 'Thêm mới Admin User');
INSERT INTO `admin_translate` VALUES ('e0626222614bdee31951d84c64e5e9ff', 'Select', 1, 'Select');
INSERT INTO `admin_translate` VALUES ('e55f75a29310d7b60f7ac1d390c8ae42', 'Module', 1, 'Module');
INSERT INTO `admin_translate` VALUES ('ec211f7c20af43e742bf2570c3cb84f9', 'Add', 1, 'Add');
INSERT INTO `admin_translate` VALUES ('6bcecfe8349eb783b735d815c8e08c28', 'Edit member profile', 1, 'Edit member profile');
INSERT INTO `admin_translate` VALUES ('b36aa562ba43e1963c42cdec3c8b5b77', 'Change password member', 1, 'Change password member');
INSERT INTO `admin_translate` VALUES ('3544848f820b9d94a3f3871a382cf138', 'New password', 1, 'New password');
INSERT INTO `admin_translate` VALUES ('0b39c5aca15b84b1ad53a94d6b3feb78', 'Change password', 1, 'Change password');
INSERT INTO `admin_translate` VALUES ('8547034108ba0285d5339f5e149d9b32', 'Please enter new password', 1, 'Please enter new password');
INSERT INTO `admin_translate` VALUES ('2516af6cb654137bb71e9d2fd6c577d2', 'New password and confirm password is not correct', 1, 'New password and confirm password is not correct');
INSERT INTO `admin_translate` VALUES ('3b7db4b6d510cc3156e3acf4365e7a74', 'Cập nhật', 1, 'Cập nhật');
INSERT INTO `admin_translate` VALUES ('57fbf1acc87fb60f9ea8ebdbbb873302', 'Your_new_password_has_been_updated', 1, 'Your_new_password_has_been_updated');
INSERT INTO `admin_translate` VALUES ('ad31a6749699923d66d1fb1afa1a78c5', 'Management website', 1, 'Management website');
INSERT INTO `admin_translate` VALUES ('c1c079acfea640c60e08f76c4eae4dab', 'SẢN PHẨM MỚI', 1, 'SẢN PHẨM MỚI');
INSERT INTO `admin_translate` VALUES ('dfb3f308150a65be9f2b3776879b4cdc', 'Duyệt qua các sản phẩm mới, cập nhật thường xuyên', 1, 'Duyệt qua các sản phẩm mới, cập nhật thường xuyên');
INSERT INTO `admin_translate` VALUES ('54c5e0cb2f195f47de74243385314e49', 'Nội dung chi tiết :', 1, 'Nội dung chi tiết :');
INSERT INTO `admin_translate` VALUES ('65d7b8f0308d6bed4b30d91af0d9acd9', 'Color name', 1, 'Color name');
INSERT INTO `admin_translate` VALUES ('ffa1c67d17bb3b3ccca2e626c7fa44a5', 'Mã code', 1, 'Mã code');
INSERT INTO `admin_translate` VALUES ('b718adec73e04ce3ec720dd11a06a308', 'ID', 1, 'ID');
INSERT INTO `admin_translate` VALUES ('fb1d215c46b16d004d71483d247eb176', 'Color Listing', 1, 'Color Listing');
INSERT INTO `admin_translate` VALUES ('3e6a625faef0050601371de85af0630d', 'Size name', 1, 'Size name');
INSERT INTO `admin_translate` VALUES ('aca0dd65318fb8532af8ae91b91fc1d6', 'Product Size', 1, 'Product Size');
INSERT INTO `admin_translate` VALUES ('6af2109688acf1234730ddc15f6a59c7', 'Product Color', 1, 'Product Color');
INSERT INTO `admin_translate` VALUES ('afe41e484cf5d42d74d1efce223871c2', 'You_have_successfully_deleted', 1, 'You_have_successfully_deleted');
INSERT INTO `admin_translate` VALUES ('793739f171c8356a3d8aa366bf455b5a', 'Chưa xem', 1, 'Chưa xem');
INSERT INTO `admin_translate` VALUES ('eb5e7b5ef24ecf4d42c4b74cb295dec5', 'Đã xem', 1, 'Đã xem');
INSERT INTO `admin_translate` VALUES ('b76918aa83cd0685b8e969ff61eff798', 'Đang chờ thanh toán', 1, 'Đang chờ thanh toán');
INSERT INTO `admin_translate` VALUES ('0c9c7bc3568d7fc304a41332711f57de', 'Đã thanh toán', 1, 'Đã thanh toán');
INSERT INTO `admin_translate` VALUES ('a2b57e36de565a06d07625fd9a0437aa', 'Hủy đơn hàng', 1, 'Hủy đơn hàng');
INSERT INTO `admin_translate` VALUES ('7153dddbbb8537dac3d3a1b2c6c51511', 'Show trang chủ', 1, 'Show trang chủ');
INSERT INTO `admin_translate` VALUES ('3fd6ae6527e079f8aacb1c5f58c585f0', 'News Listing', 1, 'News Listing');
INSERT INTO `admin_translate` VALUES ('b78a3223503896721cca1303f776159b', 'Title', 1, 'Title');
INSERT INTO `admin_translate` VALUES ('d96bc4fb209368557926632abc71b9e1', 'Từ khóa', 1, 'Từ khóa');
INSERT INTO `admin_translate` VALUES ('a240fa27925a635b08dc28c9e4f9216d', 'Order', 1, 'Order');
INSERT INTO `admin_translate` VALUES ('8ec67083eb05fd0b30175aa5b5a485f8', 'Thêm tin mới', 1, 'Thêm tin mới');
INSERT INTO `admin_translate` VALUES ('f98d981cdc7da27407fa8f66b9bca872', 'Link từ khóa', 1, 'Link từ khóa');
INSERT INTO `admin_translate` VALUES ('8514dc4860c43710f9e778b6b8ad740c', 'Tên hãng sản xuất', 1, 'Tên hãng sản xuất');
INSERT INTO `admin_translate` VALUES ('905e1df471ccc43c7e88dffdabf54f14', 'Thêm mới hỗ trợ', 1, 'Thêm mới hỗ trợ');
INSERT INTO `admin_translate` VALUES ('6329f6e769e5b65184ed00b305c74fc9', 'Tên thương hiệu', 1, 'Tên thương hiệu');
INSERT INTO `admin_translate` VALUES ('27cb367e4039f33f15e891503f2e43c1', 'Ảnh minh họa', 1, 'Ảnh minh họa');
INSERT INTO `admin_translate` VALUES ('4594b97fc007a53b3e727dff76015a92', 'Please_enter_Old_password', 1, 'Please_enter_Old_password');
INSERT INTO `admin_translate` VALUES ('a7c31c1d5e83cb69a35bb36a907abb44', 'Please_enter_New_password', 1, 'Please_enter_New_password');
INSERT INTO `admin_translate` VALUES ('5fad91acf14ca6920bb84cb7bd72c9c0', 'New_password_must_be_at_least_6_characters', 1, 'New_password_must_be_at_least_6_characters');
INSERT INTO `admin_translate` VALUES ('ff3806e80cd949908764c0b76cf0af83', 'Please_enter_confirm_password', 1, 'Please_enter_confirm_password');
INSERT INTO `admin_translate` VALUES ('afb12635ac15e867c3968bc1459532c1', 'New_password_and_confirm_password_is_not_correct', 1, 'New_password_and_confirm_password_is_not_correct');
INSERT INTO `admin_translate` VALUES ('01c643fcdc6979fe16e0aa1a492192e8', 'edit_the_information_management', 1, 'edit_the_information_management');
INSERT INTO `admin_translate` VALUES ('3bd27d5b87038caa242f4f4020245af6', 'Change_your_Email', 1, 'Change_your_Email');
INSERT INTO `admin_translate` VALUES ('3359f0cd1bbefac69fac3f4a2e7edd42', 'Change_your_password', 1, 'Change_your_password');
INSERT INTO `admin_translate` VALUES ('e1f42c3f43ff8b2826b3162969b9f459', 'User login', 1, 'User login');
INSERT INTO `admin_translate` VALUES ('01557660faa28f8ec65992d1ddbb7b79', 'Your Email', 1, 'Your Email');
INSERT INTO `admin_translate` VALUES ('c93ce0c5bad27f3f26a54a17d9e42657', 'Change email', 1, 'Change email');
INSERT INTO `admin_translate` VALUES ('09a5a307de671894b4276b0ea8577671', 'Reset all', 1, 'Reset all');
INSERT INTO `admin_translate` VALUES ('062d2b8bc2cfac7772c75ae8090fb9d1', 'Old password', 1, 'Old password');
INSERT INTO `admin_translate` VALUES ('6ab96a5df54aa6aae2bab9ea75ab76c9', 'Confirm new password', 1, 'Confirm new password');
INSERT INTO `admin_translate` VALUES ('353dabf6d46427c82546b9a493614ad0', 'Please_enter_new_password', 1, 'Please_enter_new_password');
INSERT INTO `admin_translate` VALUES ('161416d9bb2f251dab12b009051c85ac', 'Thương hiệu', 1, 'Thương hiệu');
INSERT INTO `admin_translate` VALUES ('adb21d16073a2d324a01b6ef0607efde', 'Đơn hàng', 1, 'Đơn hàng');
INSERT INTO `admin_translate` VALUES ('e995a5932fc16e06c02e2ec7e0985170', 'Kích thước', 1, 'Kích thước');
INSERT INTO `admin_translate` VALUES ('b4aca97983db90a346429bacf1a6b816', 'Màu sắc', 1, 'Màu sắc');
INSERT INTO `admin_translate` VALUES ('2135c7c4a14b20cd2651f2297e005bf5', 'Hướng dẫn - Thông tin', 1, 'Hướng dẫn - Thông tin');
INSERT INTO `admin_translate` VALUES ('d7a00df7478eb7c92d3fc2671f3566b3', 'Quản trị admin', 1, 'Quản trị admin');
INSERT INTO `admin_translate` VALUES ('6412d9f6e554ab2497733cbd65b32a91', 'Bình luận', 1, 'Bình luận');
INSERT INTO `admin_translate` VALUES ('ff7fa908ac437f52a7c25d0c557a1239', 'Show trang chủ mobile', 1, 'Show trang chủ mobile');
INSERT INTO `admin_translate` VALUES ('eadd8eafc98af58c6c7a6f032fe1a8a3', 'Please_select_modules!', 1, 'Please_select_modules!');
INSERT INTO `admin_translate` VALUES ('6ff29916f99fff9d2494d28e721ae77e', 'Banner', 1, 'Banner');
INSERT INTO `admin_translate` VALUES ('8c9c59395abb8654a28653fa7f3ff206', 'Danh mục gợi ý search', 1, 'Danh mục gợi ý search');
INSERT INTO `admin_translate` VALUES ('8b9811f0cb3464dcdc25f384e9578425', 'Chi nhánh', 1, 'Chi nhánh');
INSERT INTO `admin_translate` VALUES ('65b4a513e733f5f8b279feb6b73445bf', 'Khách mua hàng', 1, 'Khách mua hàng');
INSERT INTO `admin_translate` VALUES ('0caa5ce1a76fe25eae5446acc49ab375', 'Khách hàng', 1, 'Khách hàng');
INSERT INTO `admin_translate` VALUES ('e4f9cc8111066b490548cdcbb0273883', 'List Ngân hàng :', 1, 'List Ngân hàng :');
INSERT INTO `admin_translate` VALUES ('d28be3f99afba35abdbbfe4c99b6e1e3', 'Please_enter_your_email', 1, 'Please_enter_your_email');
INSERT INTO `admin_translate` VALUES ('78d20478f2f45aa8b7145bd54d06402a', 'information_was_updated_successfully', 1, 'information_was_updated_successfully');
INSERT INTO `admin_translate` VALUES ('cb5feb1b7314637725a2e73bdc9f7295', 'Color', 1, 'Color');
INSERT INTO `admin_translate` VALUES ('6f6cb72d544962fa333e2e34ce64f719', 'Size', 1, 'Size');
INSERT INTO `admin_translate` VALUES ('4194726ee334e1085d93e002837b73f0', 'Hot', 1, 'Hot');
INSERT INTO `admin_translate` VALUES ('c65c66b68d2029f77c4b8fe396d3c625', 'Tên thuộc tính', 1, 'Tên thuộc tính');
INSERT INTO `admin_translate` VALUES ('0831d9774255a1d295eaea3ad9dd19bc', 'Thuộc tính cha', 1, 'Thuộc tính cha');

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
) ENGINE = MyISAM AUTO_INCREMENT = 445 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES (1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn An', 'diepcd@gmail.com', 'Số 15 ngõ 143 - Trung Kính - Trung Hòa - Cầu Giấy - Hà Nội', '(84-04) 784 7135 - (84-04) 219 2996', '095 330 8125', 0, 0, NULL, NULL, 0, 1, 1, 1, 0, NULL, 0, 0);
INSERT INTO `admin_user` VALUES (443, 'giaovien01', '25f9e794323b453885f5181f1b624d0b', 'Giáo viên 01', '', NULL, 'aâ', NULL, 0, 0, NULL, '', 0, 0, 1, 1, 0, 0, 0, 1);
INSERT INTO `admin_user` VALUES (444, 'diepcd', 'e10adc3949ba59abbe56e057f20f883e', 'Can Diep', 'diepcd@gmail.com', NULL, '0987898870', NULL, 0, 0, NULL, '', 0, 0, 1, 1, 1, 0, 0, 1);

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
-- Records of admin_user_language
-- ----------------------------
INSERT INTO `admin_user_language` VALUES (4, 1);
INSERT INTO `admin_user_language` VALUES (5, 1);
INSERT INTO `admin_user_language` VALUES (5, 2);
INSERT INTO `admin_user_language` VALUES (6, 1);
INSERT INTO `admin_user_language` VALUES (7, 1);
INSERT INTO `admin_user_language` VALUES (8, 1);
INSERT INTO `admin_user_language` VALUES (8, 2);
INSERT INTO `admin_user_language` VALUES (9, 1);
INSERT INTO `admin_user_language` VALUES (10, 1);
INSERT INTO `admin_user_language` VALUES (11, 1);
INSERT INTO `admin_user_language` VALUES (12, 1);
INSERT INTO `admin_user_language` VALUES (13, 1);
INSERT INTO `admin_user_language` VALUES (14, 1);
INSERT INTO `admin_user_language` VALUES (15, 1);
INSERT INTO `admin_user_language` VALUES (16, 1);
INSERT INTO `admin_user_language` VALUES (17, 1);
INSERT INTO `admin_user_language` VALUES (18, 1);
INSERT INTO `admin_user_language` VALUES (19, 1);
INSERT INTO `admin_user_language` VALUES (20, 1);
INSERT INTO `admin_user_language` VALUES (21, 1);
INSERT INTO `admin_user_language` VALUES (22, 1);
INSERT INTO `admin_user_language` VALUES (23, 1);
INSERT INTO `admin_user_language` VALUES (24, 1);
INSERT INTO `admin_user_language` VALUES (25, 1);
INSERT INTO `admin_user_language` VALUES (26, 1);
INSERT INTO `admin_user_language` VALUES (27, 1);
INSERT INTO `admin_user_language` VALUES (28, 1);
INSERT INTO `admin_user_language` VALUES (29, 1);
INSERT INTO `admin_user_language` VALUES (30, 1);
INSERT INTO `admin_user_language` VALUES (31, 1);
INSERT INTO `admin_user_language` VALUES (32, 1);
INSERT INTO `admin_user_language` VALUES (33, 1);
INSERT INTO `admin_user_language` VALUES (33, 2);
INSERT INTO `admin_user_language` VALUES (35, 1);
INSERT INTO `admin_user_language` VALUES (36, 1);
INSERT INTO `admin_user_language` VALUES (36, 2);
INSERT INTO `admin_user_language` VALUES (37, 1);
INSERT INTO `admin_user_language` VALUES (39, 1);
INSERT INTO `admin_user_language` VALUES (40, 1);
INSERT INTO `admin_user_language` VALUES (41, 1);
INSERT INTO `admin_user_language` VALUES (42, 1);
INSERT INTO `admin_user_language` VALUES (43, 1);
INSERT INTO `admin_user_language` VALUES (44, 1);
INSERT INTO `admin_user_language` VALUES (46, 1);
INSERT INTO `admin_user_language` VALUES (48, 1);
INSERT INTO `admin_user_language` VALUES (49, 1);
INSERT INTO `admin_user_language` VALUES (49, 2);
INSERT INTO `admin_user_language` VALUES (50, 1);
INSERT INTO `admin_user_language` VALUES (51, 1);
INSERT INTO `admin_user_language` VALUES (52, 1);
INSERT INTO `admin_user_language` VALUES (53, 1);
INSERT INTO `admin_user_language` VALUES (55, 1);
INSERT INTO `admin_user_language` VALUES (55, 2);
INSERT INTO `admin_user_language` VALUES (56, 1);
INSERT INTO `admin_user_language` VALUES (57, 1);
INSERT INTO `admin_user_language` VALUES (57, 2);
INSERT INTO `admin_user_language` VALUES (58, 1);
INSERT INTO `admin_user_language` VALUES (58, 2);
INSERT INTO `admin_user_language` VALUES (59, 1);
INSERT INTO `admin_user_language` VALUES (60, 1);
INSERT INTO `admin_user_language` VALUES (61, 1);
INSERT INTO `admin_user_language` VALUES (62, 1);
INSERT INTO `admin_user_language` VALUES (65, 1);
INSERT INTO `admin_user_language` VALUES (65, 2);
INSERT INTO `admin_user_language` VALUES (66, 1);
INSERT INTO `admin_user_language` VALUES (66, 2);
INSERT INTO `admin_user_language` VALUES (67, 1);
INSERT INTO `admin_user_language` VALUES (68, 1);
INSERT INTO `admin_user_language` VALUES (69, 1);
INSERT INTO `admin_user_language` VALUES (70, 1);
INSERT INTO `admin_user_language` VALUES (72, 1);
INSERT INTO `admin_user_language` VALUES (73, 1);
INSERT INTO `admin_user_language` VALUES (74, 1);
INSERT INTO `admin_user_language` VALUES (75, 1);
INSERT INTO `admin_user_language` VALUES (76, 1);
INSERT INTO `admin_user_language` VALUES (77, 1);
INSERT INTO `admin_user_language` VALUES (78, 1);
INSERT INTO `admin_user_language` VALUES (79, 1);
INSERT INTO `admin_user_language` VALUES (80, 1);
INSERT INTO `admin_user_language` VALUES (81, 1);
INSERT INTO `admin_user_language` VALUES (82, 1);
INSERT INTO `admin_user_language` VALUES (83, 1);
INSERT INTO `admin_user_language` VALUES (85, 1);
INSERT INTO `admin_user_language` VALUES (86, 1);
INSERT INTO `admin_user_language` VALUES (87, 1);
INSERT INTO `admin_user_language` VALUES (88, 1);
INSERT INTO `admin_user_language` VALUES (89, 1);
INSERT INTO `admin_user_language` VALUES (90, 1);
INSERT INTO `admin_user_language` VALUES (91, 1);
INSERT INTO `admin_user_language` VALUES (92, 1);
INSERT INTO `admin_user_language` VALUES (93, 1);
INSERT INTO `admin_user_language` VALUES (94, 1);
INSERT INTO `admin_user_language` VALUES (95, 1);
INSERT INTO `admin_user_language` VALUES (96, 1);
INSERT INTO `admin_user_language` VALUES (97, 1);
INSERT INTO `admin_user_language` VALUES (98, 1);
INSERT INTO `admin_user_language` VALUES (99, 1);
INSERT INTO `admin_user_language` VALUES (100, 1);
INSERT INTO `admin_user_language` VALUES (101, 1);
INSERT INTO `admin_user_language` VALUES (102, 1);
INSERT INTO `admin_user_language` VALUES (103, 1);
INSERT INTO `admin_user_language` VALUES (104, 1);
INSERT INTO `admin_user_language` VALUES (105, 1);
INSERT INTO `admin_user_language` VALUES (106, 1);
INSERT INTO `admin_user_language` VALUES (107, 1);
INSERT INTO `admin_user_language` VALUES (108, 1);
INSERT INTO `admin_user_language` VALUES (109, 1);
INSERT INTO `admin_user_language` VALUES (110, 1);
INSERT INTO `admin_user_language` VALUES (111, 1);
INSERT INTO `admin_user_language` VALUES (112, 1);
INSERT INTO `admin_user_language` VALUES (113, 1);
INSERT INTO `admin_user_language` VALUES (114, 1);
INSERT INTO `admin_user_language` VALUES (115, 1);
INSERT INTO `admin_user_language` VALUES (116, 1);
INSERT INTO `admin_user_language` VALUES (117, 1);
INSERT INTO `admin_user_language` VALUES (118, 1);
INSERT INTO `admin_user_language` VALUES (119, 1);
INSERT INTO `admin_user_language` VALUES (120, 1);
INSERT INTO `admin_user_language` VALUES (121, 1);
INSERT INTO `admin_user_language` VALUES (122, 1);
INSERT INTO `admin_user_language` VALUES (123, 1);
INSERT INTO `admin_user_language` VALUES (124, 1);
INSERT INTO `admin_user_language` VALUES (125, 1);
INSERT INTO `admin_user_language` VALUES (126, 1);
INSERT INTO `admin_user_language` VALUES (127, 1);
INSERT INTO `admin_user_language` VALUES (128, 1);
INSERT INTO `admin_user_language` VALUES (129, 1);
INSERT INTO `admin_user_language` VALUES (130, 1);
INSERT INTO `admin_user_language` VALUES (131, 1);
INSERT INTO `admin_user_language` VALUES (132, 1);
INSERT INTO `admin_user_language` VALUES (133, 1);
INSERT INTO `admin_user_language` VALUES (134, 1);
INSERT INTO `admin_user_language` VALUES (135, 1);
INSERT INTO `admin_user_language` VALUES (136, 1);
INSERT INTO `admin_user_language` VALUES (137, 1);
INSERT INTO `admin_user_language` VALUES (138, 1);
INSERT INTO `admin_user_language` VALUES (139, 1);
INSERT INTO `admin_user_language` VALUES (140, 1);
INSERT INTO `admin_user_language` VALUES (141, 1);
INSERT INTO `admin_user_language` VALUES (142, 1);
INSERT INTO `admin_user_language` VALUES (143, 1);
INSERT INTO `admin_user_language` VALUES (144, 1);
INSERT INTO `admin_user_language` VALUES (145, 1);
INSERT INTO `admin_user_language` VALUES (146, 1);
INSERT INTO `admin_user_language` VALUES (147, 1);
INSERT INTO `admin_user_language` VALUES (148, 1);
INSERT INTO `admin_user_language` VALUES (149, 1);
INSERT INTO `admin_user_language` VALUES (150, 1);
INSERT INTO `admin_user_language` VALUES (151, 1);
INSERT INTO `admin_user_language` VALUES (152, 1);
INSERT INTO `admin_user_language` VALUES (153, 1);
INSERT INTO `admin_user_language` VALUES (154, 1);
INSERT INTO `admin_user_language` VALUES (155, 1);
INSERT INTO `admin_user_language` VALUES (156, 1);
INSERT INTO `admin_user_language` VALUES (157, 1);
INSERT INTO `admin_user_language` VALUES (158, 1);
INSERT INTO `admin_user_language` VALUES (159, 1);
INSERT INTO `admin_user_language` VALUES (160, 1);
INSERT INTO `admin_user_language` VALUES (161, 1);
INSERT INTO `admin_user_language` VALUES (162, 1);
INSERT INTO `admin_user_language` VALUES (163, 1);
INSERT INTO `admin_user_language` VALUES (164, 1);
INSERT INTO `admin_user_language` VALUES (165, 1);
INSERT INTO `admin_user_language` VALUES (166, 1);
INSERT INTO `admin_user_language` VALUES (167, 1);
INSERT INTO `admin_user_language` VALUES (168, 1);
INSERT INTO `admin_user_language` VALUES (169, 1);
INSERT INTO `admin_user_language` VALUES (170, 1);
INSERT INTO `admin_user_language` VALUES (171, 1);
INSERT INTO `admin_user_language` VALUES (172, 1);
INSERT INTO `admin_user_language` VALUES (173, 1);
INSERT INTO `admin_user_language` VALUES (174, 1);
INSERT INTO `admin_user_language` VALUES (175, 1);
INSERT INTO `admin_user_language` VALUES (176, 1);
INSERT INTO `admin_user_language` VALUES (177, 1);
INSERT INTO `admin_user_language` VALUES (178, 1);
INSERT INTO `admin_user_language` VALUES (179, 1);
INSERT INTO `admin_user_language` VALUES (180, 1);
INSERT INTO `admin_user_language` VALUES (181, 1);
INSERT INTO `admin_user_language` VALUES (182, 1);
INSERT INTO `admin_user_language` VALUES (183, 1);
INSERT INTO `admin_user_language` VALUES (184, 1);
INSERT INTO `admin_user_language` VALUES (185, 1);
INSERT INTO `admin_user_language` VALUES (186, 1);
INSERT INTO `admin_user_language` VALUES (187, 1);
INSERT INTO `admin_user_language` VALUES (188, 1);
INSERT INTO `admin_user_language` VALUES (189, 1);
INSERT INTO `admin_user_language` VALUES (190, 1);
INSERT INTO `admin_user_language` VALUES (191, 1);
INSERT INTO `admin_user_language` VALUES (192, 1);
INSERT INTO `admin_user_language` VALUES (193, 1);
INSERT INTO `admin_user_language` VALUES (194, 1);
INSERT INTO `admin_user_language` VALUES (195, 1);
INSERT INTO `admin_user_language` VALUES (196, 1);
INSERT INTO `admin_user_language` VALUES (197, 1);
INSERT INTO `admin_user_language` VALUES (198, 1);
INSERT INTO `admin_user_language` VALUES (199, 1);
INSERT INTO `admin_user_language` VALUES (200, 1);
INSERT INTO `admin_user_language` VALUES (201, 1);
INSERT INTO `admin_user_language` VALUES (202, 1);
INSERT INTO `admin_user_language` VALUES (203, 1);
INSERT INTO `admin_user_language` VALUES (204, 1);
INSERT INTO `admin_user_language` VALUES (205, 1);
INSERT INTO `admin_user_language` VALUES (206, 1);
INSERT INTO `admin_user_language` VALUES (207, 1);
INSERT INTO `admin_user_language` VALUES (208, 1);
INSERT INTO `admin_user_language` VALUES (209, 1);
INSERT INTO `admin_user_language` VALUES (210, 1);
INSERT INTO `admin_user_language` VALUES (211, 1);
INSERT INTO `admin_user_language` VALUES (212, 1);
INSERT INTO `admin_user_language` VALUES (213, 1);
INSERT INTO `admin_user_language` VALUES (214, 1);
INSERT INTO `admin_user_language` VALUES (215, 1);
INSERT INTO `admin_user_language` VALUES (216, 1);
INSERT INTO `admin_user_language` VALUES (217, 1);
INSERT INTO `admin_user_language` VALUES (218, 1);
INSERT INTO `admin_user_language` VALUES (219, 1);
INSERT INTO `admin_user_language` VALUES (220, 1);
INSERT INTO `admin_user_language` VALUES (221, 1);
INSERT INTO `admin_user_language` VALUES (222, 1);
INSERT INTO `admin_user_language` VALUES (223, 1);
INSERT INTO `admin_user_language` VALUES (224, 1);
INSERT INTO `admin_user_language` VALUES (225, 1);
INSERT INTO `admin_user_language` VALUES (226, 1);
INSERT INTO `admin_user_language` VALUES (227, 1);
INSERT INTO `admin_user_language` VALUES (228, 1);
INSERT INTO `admin_user_language` VALUES (229, 1);
INSERT INTO `admin_user_language` VALUES (230, 1);
INSERT INTO `admin_user_language` VALUES (231, 1);
INSERT INTO `admin_user_language` VALUES (232, 1);
INSERT INTO `admin_user_language` VALUES (233, 1);
INSERT INTO `admin_user_language` VALUES (234, 1);
INSERT INTO `admin_user_language` VALUES (235, 1);
INSERT INTO `admin_user_language` VALUES (236, 1);
INSERT INTO `admin_user_language` VALUES (237, 1);
INSERT INTO `admin_user_language` VALUES (238, 1);
INSERT INTO `admin_user_language` VALUES (239, 1);
INSERT INTO `admin_user_language` VALUES (240, 1);
INSERT INTO `admin_user_language` VALUES (241, 1);
INSERT INTO `admin_user_language` VALUES (242, 1);
INSERT INTO `admin_user_language` VALUES (243, 1);
INSERT INTO `admin_user_language` VALUES (244, 1);
INSERT INTO `admin_user_language` VALUES (245, 1);
INSERT INTO `admin_user_language` VALUES (246, 1);
INSERT INTO `admin_user_language` VALUES (247, 1);
INSERT INTO `admin_user_language` VALUES (248, 1);
INSERT INTO `admin_user_language` VALUES (249, 1);
INSERT INTO `admin_user_language` VALUES (250, 1);
INSERT INTO `admin_user_language` VALUES (251, 1);
INSERT INTO `admin_user_language` VALUES (252, 1);
INSERT INTO `admin_user_language` VALUES (253, 1);
INSERT INTO `admin_user_language` VALUES (254, 1);
INSERT INTO `admin_user_language` VALUES (255, 1);
INSERT INTO `admin_user_language` VALUES (256, 1);
INSERT INTO `admin_user_language` VALUES (257, 1);
INSERT INTO `admin_user_language` VALUES (258, 1);
INSERT INTO `admin_user_language` VALUES (259, 1);
INSERT INTO `admin_user_language` VALUES (260, 1);
INSERT INTO `admin_user_language` VALUES (261, 1);
INSERT INTO `admin_user_language` VALUES (262, 1);
INSERT INTO `admin_user_language` VALUES (263, 1);
INSERT INTO `admin_user_language` VALUES (264, 1);
INSERT INTO `admin_user_language` VALUES (265, 1);
INSERT INTO `admin_user_language` VALUES (266, 1);
INSERT INTO `admin_user_language` VALUES (267, 1);
INSERT INTO `admin_user_language` VALUES (268, 1);
INSERT INTO `admin_user_language` VALUES (269, 1);
INSERT INTO `admin_user_language` VALUES (270, 1);
INSERT INTO `admin_user_language` VALUES (271, 1);
INSERT INTO `admin_user_language` VALUES (272, 1);
INSERT INTO `admin_user_language` VALUES (273, 1);
INSERT INTO `admin_user_language` VALUES (274, 1);
INSERT INTO `admin_user_language` VALUES (275, 1);
INSERT INTO `admin_user_language` VALUES (276, 1);
INSERT INTO `admin_user_language` VALUES (277, 1);
INSERT INTO `admin_user_language` VALUES (278, 1);
INSERT INTO `admin_user_language` VALUES (279, 1);
INSERT INTO `admin_user_language` VALUES (280, 1);
INSERT INTO `admin_user_language` VALUES (281, 1);
INSERT INTO `admin_user_language` VALUES (282, 1);
INSERT INTO `admin_user_language` VALUES (283, 1);
INSERT INTO `admin_user_language` VALUES (284, 1);
INSERT INTO `admin_user_language` VALUES (285, 1);
INSERT INTO `admin_user_language` VALUES (286, 1);
INSERT INTO `admin_user_language` VALUES (287, 1);
INSERT INTO `admin_user_language` VALUES (288, 1);
INSERT INTO `admin_user_language` VALUES (289, 1);
INSERT INTO `admin_user_language` VALUES (290, 1);
INSERT INTO `admin_user_language` VALUES (291, 1);
INSERT INTO `admin_user_language` VALUES (292, 1);
INSERT INTO `admin_user_language` VALUES (293, 1);
INSERT INTO `admin_user_language` VALUES (294, 1);
INSERT INTO `admin_user_language` VALUES (295, 1);
INSERT INTO `admin_user_language` VALUES (296, 1);
INSERT INTO `admin_user_language` VALUES (297, 1);
INSERT INTO `admin_user_language` VALUES (298, 1);
INSERT INTO `admin_user_language` VALUES (299, 1);
INSERT INTO `admin_user_language` VALUES (300, 1);
INSERT INTO `admin_user_language` VALUES (301, 1);
INSERT INTO `admin_user_language` VALUES (302, 1);
INSERT INTO `admin_user_language` VALUES (303, 1);
INSERT INTO `admin_user_language` VALUES (304, 1);
INSERT INTO `admin_user_language` VALUES (305, 1);
INSERT INTO `admin_user_language` VALUES (306, 1);
INSERT INTO `admin_user_language` VALUES (307, 1);
INSERT INTO `admin_user_language` VALUES (308, 1);
INSERT INTO `admin_user_language` VALUES (309, 1);
INSERT INTO `admin_user_language` VALUES (310, 1);
INSERT INTO `admin_user_language` VALUES (311, 1);
INSERT INTO `admin_user_language` VALUES (312, 1);
INSERT INTO `admin_user_language` VALUES (313, 1);
INSERT INTO `admin_user_language` VALUES (314, 1);
INSERT INTO `admin_user_language` VALUES (315, 1);
INSERT INTO `admin_user_language` VALUES (316, 1);
INSERT INTO `admin_user_language` VALUES (317, 1);
INSERT INTO `admin_user_language` VALUES (318, 1);
INSERT INTO `admin_user_language` VALUES (319, 1);
INSERT INTO `admin_user_language` VALUES (320, 1);
INSERT INTO `admin_user_language` VALUES (321, 1);
INSERT INTO `admin_user_language` VALUES (322, 1);
INSERT INTO `admin_user_language` VALUES (323, 1);
INSERT INTO `admin_user_language` VALUES (324, 1);
INSERT INTO `admin_user_language` VALUES (325, 1);
INSERT INTO `admin_user_language` VALUES (326, 1);
INSERT INTO `admin_user_language` VALUES (327, 1);
INSERT INTO `admin_user_language` VALUES (328, 1);
INSERT INTO `admin_user_language` VALUES (329, 1);
INSERT INTO `admin_user_language` VALUES (330, 1);
INSERT INTO `admin_user_language` VALUES (331, 1);
INSERT INTO `admin_user_language` VALUES (332, 1);
INSERT INTO `admin_user_language` VALUES (333, 1);
INSERT INTO `admin_user_language` VALUES (334, 1);
INSERT INTO `admin_user_language` VALUES (335, 1);
INSERT INTO `admin_user_language` VALUES (336, 1);
INSERT INTO `admin_user_language` VALUES (337, 1);
INSERT INTO `admin_user_language` VALUES (338, 1);
INSERT INTO `admin_user_language` VALUES (339, 1);
INSERT INTO `admin_user_language` VALUES (340, 1);
INSERT INTO `admin_user_language` VALUES (341, 1);
INSERT INTO `admin_user_language` VALUES (342, 1);
INSERT INTO `admin_user_language` VALUES (343, 1);
INSERT INTO `admin_user_language` VALUES (344, 1);
INSERT INTO `admin_user_language` VALUES (345, 1);
INSERT INTO `admin_user_language` VALUES (346, 1);
INSERT INTO `admin_user_language` VALUES (347, 1);
INSERT INTO `admin_user_language` VALUES (348, 1);
INSERT INTO `admin_user_language` VALUES (349, 1);
INSERT INTO `admin_user_language` VALUES (350, 1);
INSERT INTO `admin_user_language` VALUES (351, 1);
INSERT INTO `admin_user_language` VALUES (352, 1);
INSERT INTO `admin_user_language` VALUES (353, 1);
INSERT INTO `admin_user_language` VALUES (354, 1);
INSERT INTO `admin_user_language` VALUES (355, 1);
INSERT INTO `admin_user_language` VALUES (356, 1);
INSERT INTO `admin_user_language` VALUES (357, 1);
INSERT INTO `admin_user_language` VALUES (358, 1);
INSERT INTO `admin_user_language` VALUES (359, 1);
INSERT INTO `admin_user_language` VALUES (360, 1);
INSERT INTO `admin_user_language` VALUES (361, 1);
INSERT INTO `admin_user_language` VALUES (362, 1);
INSERT INTO `admin_user_language` VALUES (363, 1);
INSERT INTO `admin_user_language` VALUES (364, 1);
INSERT INTO `admin_user_language` VALUES (365, 1);
INSERT INTO `admin_user_language` VALUES (366, 1);
INSERT INTO `admin_user_language` VALUES (367, 1);
INSERT INTO `admin_user_language` VALUES (368, 1);
INSERT INTO `admin_user_language` VALUES (369, 1);
INSERT INTO `admin_user_language` VALUES (370, 1);
INSERT INTO `admin_user_language` VALUES (371, 1);
INSERT INTO `admin_user_language` VALUES (372, 1);
INSERT INTO `admin_user_language` VALUES (373, 1);
INSERT INTO `admin_user_language` VALUES (374, 1);
INSERT INTO `admin_user_language` VALUES (375, 1);
INSERT INTO `admin_user_language` VALUES (376, 1);
INSERT INTO `admin_user_language` VALUES (377, 1);
INSERT INTO `admin_user_language` VALUES (378, 1);
INSERT INTO `admin_user_language` VALUES (379, 1);
INSERT INTO `admin_user_language` VALUES (380, 1);
INSERT INTO `admin_user_language` VALUES (381, 1);
INSERT INTO `admin_user_language` VALUES (382, 1);
INSERT INTO `admin_user_language` VALUES (383, 1);
INSERT INTO `admin_user_language` VALUES (384, 1);
INSERT INTO `admin_user_language` VALUES (385, 1);
INSERT INTO `admin_user_language` VALUES (386, 1);
INSERT INTO `admin_user_language` VALUES (387, 1);
INSERT INTO `admin_user_language` VALUES (388, 1);
INSERT INTO `admin_user_language` VALUES (389, 1);
INSERT INTO `admin_user_language` VALUES (390, 1);
INSERT INTO `admin_user_language` VALUES (391, 1);
INSERT INTO `admin_user_language` VALUES (392, 1);
INSERT INTO `admin_user_language` VALUES (393, 1);
INSERT INTO `admin_user_language` VALUES (394, 1);
INSERT INTO `admin_user_language` VALUES (395, 1);
INSERT INTO `admin_user_language` VALUES (396, 1);
INSERT INTO `admin_user_language` VALUES (397, 1);
INSERT INTO `admin_user_language` VALUES (398, 1);
INSERT INTO `admin_user_language` VALUES (399, 1);
INSERT INTO `admin_user_language` VALUES (400, 1);
INSERT INTO `admin_user_language` VALUES (401, 1);
INSERT INTO `admin_user_language` VALUES (402, 1);
INSERT INTO `admin_user_language` VALUES (403, 1);
INSERT INTO `admin_user_language` VALUES (404, 1);
INSERT INTO `admin_user_language` VALUES (405, 1);
INSERT INTO `admin_user_language` VALUES (406, 1);
INSERT INTO `admin_user_language` VALUES (407, 1);
INSERT INTO `admin_user_language` VALUES (408, 1);
INSERT INTO `admin_user_language` VALUES (409, 1);
INSERT INTO `admin_user_language` VALUES (410, 1);
INSERT INTO `admin_user_language` VALUES (411, 1);
INSERT INTO `admin_user_language` VALUES (412, 1);
INSERT INTO `admin_user_language` VALUES (413, 1);
INSERT INTO `admin_user_language` VALUES (414, 1);
INSERT INTO `admin_user_language` VALUES (415, 1);
INSERT INTO `admin_user_language` VALUES (416, 1);
INSERT INTO `admin_user_language` VALUES (417, 1);
INSERT INTO `admin_user_language` VALUES (418, 1);
INSERT INTO `admin_user_language` VALUES (419, 1);
INSERT INTO `admin_user_language` VALUES (420, 1);
INSERT INTO `admin_user_language` VALUES (421, 1);
INSERT INTO `admin_user_language` VALUES (422, 1);
INSERT INTO `admin_user_language` VALUES (423, 1);
INSERT INTO `admin_user_language` VALUES (424, 1);
INSERT INTO `admin_user_language` VALUES (425, 1);
INSERT INTO `admin_user_language` VALUES (426, 1);
INSERT INTO `admin_user_language` VALUES (427, 1);
INSERT INTO `admin_user_language` VALUES (428, 1);
INSERT INTO `admin_user_language` VALUES (429, 1);
INSERT INTO `admin_user_language` VALUES (430, 1);
INSERT INTO `admin_user_language` VALUES (431, 1);
INSERT INTO `admin_user_language` VALUES (432, 1);
INSERT INTO `admin_user_language` VALUES (433, 1);
INSERT INTO `admin_user_language` VALUES (434, 1);
INSERT INTO `admin_user_language` VALUES (435, 1);
INSERT INTO `admin_user_language` VALUES (436, 1);
INSERT INTO `admin_user_language` VALUES (437, 1);
INSERT INTO `admin_user_language` VALUES (438, 1);
INSERT INTO `admin_user_language` VALUES (439, 1);
INSERT INTO `admin_user_language` VALUES (440, 1);
INSERT INTO `admin_user_language` VALUES (441, 1);
INSERT INTO `admin_user_language` VALUES (442, 1);
INSERT INTO `admin_user_language` VALUES (443, 1);
INSERT INTO `admin_user_language` VALUES (444, 1);

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
) ENGINE = MyISAM AUTO_INCREMENT = 445 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of admin_user_right
-- ----------------------------
INSERT INTO `admin_user_right` VALUES (438, 19, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (439, 67, 1, 0, 0);
INSERT INTO `admin_user_right` VALUES (439, 35, 1, 0, 0);
INSERT INTO `admin_user_right` VALUES (439, 26, 1, 0, 0);
INSERT INTO `admin_user_right` VALUES (439, 24, 0, 0, 0);
INSERT INTO `admin_user_right` VALUES (440, 91, 1, 1, 0);
INSERT INTO `admin_user_right` VALUES (440, 23, 1, 1, 0);
INSERT INTO `admin_user_right` VALUES (440, 19, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (441, 96, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (441, 95, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (441, 92, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (441, 91, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (441, 89, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (441, 88, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (441, 67, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (441, 35, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (441, 26, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (441, 24, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (441, 23, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (441, 19, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (441, 14, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (441, 11, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (442, 11, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (442, 24, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (442, 26, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (442, 35, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (442, 67, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (442, 88, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (442, 89, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (442, 91, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (442, 92, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (442, 95, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (442, 96, 1, 1, 1);
INSERT INTO `admin_user_right` VALUES (443, 7, 0, 0, 0);
INSERT INTO `admin_user_right` VALUES (444, 7, 1, 1, 0);
INSERT INTO `admin_user_right` VALUES (444, 6, 1, 1, 0);
INSERT INTO `admin_user_right` VALUES (443, 6, 0, 0, 1);

-- ----------------------------
-- Table structure for calender
-- ----------------------------
DROP TABLE IF EXISTS `calender`;
CREATE TABLE `calender`  (
  `cal_id` int(11) NOT NULL AUTO_INCREMENT,
  `cal_code` varchar(50) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `cal_code_md5` varchar(32) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `cal_user_id` int(11) NOT NULL,
  `cal_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cal_weekday` varchar(50) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NULL DEFAULT '0',
  `cal_checkin_time` tinyint(11) NULL DEFAULT 0,
  `cal_admin_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`cal_id`) USING BTREE,
  UNIQUE INDEX `cal_code_md5`(`cal_code_md5`) USING BTREE,
  INDEX `cal_user_id`(`cal_user_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 49 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of calender
-- ----------------------------
INSERT INTO `calender` VALUES (48, 'CL-001', '63a98530317ac1ceac504bf0bf4d2494', 32, 'Điểm Danh Hàng Ngày', '2,3,4,5,6', 8, NULL);

-- ----------------------------
-- Table structure for categories_multi
-- ----------------------------
DROP TABLE IF EXISTS `categories_multi`;
CREATE TABLE `categories_multi`  (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cat_name_rewrite` varchar(266) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cat_order` int(5) NULL DEFAULT NULL,
  `cat_picture` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cat_banner` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cat_banner_link` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `cat_background` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cat_title` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `cat_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `cat_meta_keyword` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `cat_meta_title` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `cat_meta_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `cat_active` int(1) NULL DEFAULT 1,
  `lang_id` int(1) NULL DEFAULT 1,
  `cat_parent_id` int(11) NOT NULL DEFAULT 0,
  `cat_has_child` int(11) NOT NULL DEFAULT 1,
  `cat_all_child` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cat_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cat_hot` tinyint(4) NULL DEFAULT 0,
  `admin_id` int(11) NULL DEFAULT 0,
  `cat_show_mob` tinyint(1) NULL DEFAULT 0,
  `cat_show` int(1) NULL DEFAULT 0,
  `cat_create_time` int(11) NULL DEFAULT 0,
  `cat_update_at` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`cat_id`) USING BTREE,
  INDEX `cat_parent_id`(`cat_parent_id`) USING BTREE,
  INDEX `cat_order`(`cat_order`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 91 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories_multi
-- ----------------------------
INSERT INTO `categories_multi` VALUES (1, 'Cơ hội đi Nhật', 'don-hang-nhat-ban', 0, 'vyv1571800953.png', NULL, NULL, NULL, NULL, '<div style=\"text-align: justify;\">\r\n	<span style=\"font-size:16px;\"><span style=\"font-family:verdana,geneva,sans-serif;\">Trang thông tin cập nhật tất cả đơn hàng <strong>Xuất khẩu lao động Nhật Bản</strong></span></span></div>\r\n<div style=\"text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"text-align: justify;\">\r\n	<span style=\"font-size:16px;\"><span style=\"font-family:verdana,geneva,sans-serif;\"><strong>Donhangnhatban.vn</strong> mang đến những đơn hàng xuất khẩu lao động tại Nhật Bản cho Thực tập sinh với đa dạng ngành nghề như: Đơn hàng xây dựng, Đơn hàng cơ khí, <strong>Đơn hàng chế biến thực phẩm</strong>... Đặc biệt các đơn hàng làm nông nghiệp, <strong>hộ lý, điều dưỡng tại Nhật Bản</strong> luôn thu hút số lượng lớn người tham gia thi tuyển. </span></span></div>\r\n<div style=\"text-align: justify;\">\r\n	&nbsp;</div>\r\n<div style=\"text-align: justify;\">\r\n	<span style=\"font-size:16px;\"><span style=\"font-family:verdana,geneva,sans-serif;\">Người lao động sẽ được hưởng mức thu nhập trung bình <strong>30 triệu/tháng trở lên</strong> và <strong>thời gian làm việc từ 1 - 5 năm.</strong></span></span></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	&nbsp;</div>', '', '', '', 1, 1, 0, 1, '1,86', 'product', 0, 1, 0, 0, 0, 1573613359);
INSERT INTO `categories_multi` VALUES (9, 'Hướng dẫn', 'huong-dan', 3, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 1, 1, 0, 0, '9', 'static', 0, 1, 0, 0, 0, 0);
INSERT INTO `categories_multi` VALUES (10, 'Giới thiệu', 'gioi-thieu', 1, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', 1, 1, 0, 0, '10', 'static', 0, 1, 0, 0, 0, 0);
INSERT INTO `categories_multi` VALUES (37, 'Đào tạo', 'Đào tạo', 4, NULL, NULL, NULL, NULL, NULL, '<p>\r\n	Đào tạo</p>', 'Đào tạo', 'Đào tạo', 'Đào tạo', 1, 1, 0, 0, '37', 'static', 0, 1, 0, 0, 1527126434, 1527126434);
INSERT INTO `categories_multi` VALUES (43, 'Tin tức', 'tin-tuc', 1, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, 1, 0, 1, '43,7,26,27,30,34,22,31,32,33,85', 'news', 1, 1, 0, 0, 1527523185, 1527523185);
INSERT INTO `categories_multi` VALUES (82, 'Chương trình', 'chuong-trinh', 2, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, 1, 0, 0, '82', 'static', 0, 1, 0, 0, 1534746486, 1534746486);
INSERT INTO `categories_multi` VALUES (86, 'Kỹ năng đặc định', 'visa-dac-dinh', 3, 'gke1577932518.jpg', NULL, NULL, NULL, NULL, '<div>\r\n	<div>\r\n		<strong><span style=\"font-size:16px;\"><span style=\"font-family:comic sans ms,cursive;\">Visa đặc định là gì?</span></span></strong></div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		<span style=\"font-size:14px;\"><span style=\"font-family:comic sans ms,cursive;\">Ngày 29/10/2019, Chính phủ Nhật Bản đã chính thức thông qua luật mới cho phép các doanh nghiệp Nhật Bản tiếp nhận lao động nước ngoài theo dạng visa mới có tên là visa kỹ năng đặc định. Visa đặc định Tokutei Ginou cho phép người lao động có thể ở lại Nhật trong thời gian dài hơn và có thể bảo lãnh gia đình sang sống cùng trong suốt thời hạn lao động. Ngoài ra, người lao động cũng được phép chuyển việc làm, chuyển công ty trong giới hạn ngành nghề mà visa quy định.</span></span></div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		<span style=\"font-size:14px;\"><span style=\"font-family:comic sans ms,cursive;\">So với visa của chương trình thực tập sinh kỹ năng hiện hành thì loại visa mới này có phạm vi ngành nghề được nới rộng hơn và các yêu cầu về bằng cấp, chuyên môn cũng khá nới lỏng.</span></span></div>\r\n	<div>\r\n		&nbsp;</div>\r\n</div>\r\n<p>\r\n	&nbsp;</p>', '', '', '', 1, 1, 1, 0, '86', 'product', 1, 1, 0, 0, 1569057278, 1577933520);
INSERT INTO `categories_multi` VALUES (90, 'Góc tư vấn', 'goc-tu-van', 1, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 1, 1, 0, 0, '90', 'news', 0, 1, 0, 0, 1576467988, 1576467988);

-- ----------------------------
-- Table structure for classes
-- ----------------------------
DROP TABLE IF EXISTS `classes`;
CREATE TABLE `classes`  (
  `cls_id` int(11) NOT NULL AUTO_INCREMENT,
  `cls_code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cls_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cls_faculty_id` int(11) NOT NULL,
  `cls_school_id` int(11) NOT NULL,
  `cls_active` tinyint(1) NULL DEFAULT 0,
  `cls_create_time` int(11) NULL DEFAULT NULL,
  `cls_update_time` int(11) NULL DEFAULT NULL,
  `admin_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`cls_id`) USING BTREE,
  INDEX `cls_faculty_id`(`cls_faculty_id`) USING BTREE,
  INDEX `cls_school_id`(`cls_school_id`) USING BTREE,
  INDEX `cls_active`(`cls_active`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of classes
-- ----------------------------
INSERT INTO `classes` VALUES (1, 'CLASS_001', 'Lớp 1', 30, 40, 1, 1589464515, 1589464515, NULL);
INSERT INTO `classes` VALUES (2, 'CLASS_002', 'Lớp 2', 30, 40, 1, 1589292821, 1589292821, NULL);
INSERT INTO `classes` VALUES (3, 'CLASS_003', 'Lớp 3', 30, 40, 0, 1592646252, 1592646252, NULL);

-- ----------------------------
-- Table structure for configuration
-- ----------------------------
DROP TABLE IF EXISTS `configuration`;
CREATE TABLE `configuration`  (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_page_size` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_left_size` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_right_size` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_admin_email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_site_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_meta_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_meta_keywords` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_currency` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_mod_rewrite` tinyint(1) NULL DEFAULT 0,
  `con_lang_id` int(11) NULL DEFAULT 1,
  `con_extenstion` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '\'html\'',
  `lang_id` int(11) NULL DEFAULT 1,
  `con_contact` int(11) NULL DEFAULT 0,
  `con_hotline` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_hotline_banhang` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_hotline_hotro_kythuat` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_background_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_background_color` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_address` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_image_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_picture_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_background_homepage` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_theme_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_info_payment` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_fee_transport` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_buy_shop` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_contact_sale` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_info_company` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_logo_top` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_logo_bottom` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_page_fb` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_link_fb` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_link_twiter` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_link_insta` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `con_map` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_footer` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `con_content_ship` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`con_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of configuration
-- ----------------------------
INSERT INTO `configuration` VALUES (1, '1133', '215', '230', 'simvn@gmail.com', 'Kho sim lớn nhất Việt Nam | Sim.Vn', '', '', 'VND', 1, 1, 'html', 1, 0, '024.62.968.968', '04 632 77 555', '04 632 95 012', '', '#f6ebcf', 'Số 22 Thành Công, Ba Đình, Hà Nội', '', '', 'ktm1540045257.png', '', '<p style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">Vietcombank:</strong>&nbsp;Trần xu&acirc;n diện : 0721000523747 Chi nh&aacute;nh Kỳ đồng<br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">Sacombank:</strong>&nbsp;Trần xu&acirc;n diện : 060099383677 CN Trung t&acirc;m<br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">Đ&ocirc;ng &Aacute;:</strong>&nbsp;Nguyễn thị tuyết trinh 0103674795 Chi nh&aacute;nh quy nhơn<br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">Agribank:&nbsp;</strong>Nguyễn thị tuyết trinh 1604205302028 CN Ph&uacute; nhuận<br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">Nam &Aacute;:</strong>&nbsp;Trần xu&acirc;n diện 701019611100001 CN B&igrave;nh Phước</p>\r\n<p style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\"><a href=\"http://dathangsi.vn/bangia\" style=\"margin: 0px; padding: 0px; font-size: 16px; color: rgb(0, 102, 51); line-height: 20px; box-sizing: border-box; text-decoration-line: none; border: 0px;\">DOWNLOAD BẢNG GI&Aacute; SỈ</a></strong></p>\r\n<p style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\"><a href=\"http://dathangsi.vn/bangia/printer.php\" style=\"margin: 0px; padding: 0px; font-size: 16px; color: rgb(0, 102, 51); line-height: 20px; box-sizing: border-box; text-decoration-line: none; border: 0px;\">IN BẢNG GI&Aacute; SỈ</a></strong></p>\r\n', '<p style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">Th&agrave;nh phố Hồ Ch&iacute; Minh​</strong><br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	- Nội th&agrave;nh ph&iacute;:&nbsp;<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">25K&nbsp;</strong><br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	-&nbsp;Ngoại th&agrave;nh ph&iacute;:&nbsp;<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">30K</strong><br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	- Huyện ngoại th&agrave;nh ph&iacute;:&nbsp;<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">35K</strong></p>\r\n<p style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">Tỉnh th&agrave;nh kh&aacute;c&nbsp;</strong>-&nbsp;<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">TL dưới 1Kg&nbsp;</strong><br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	- Miền Nam -&nbsp;T&acirc;y Nguy&ecirc;n ph&iacute;:&nbsp;<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">55K</strong><br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	- Miền Trung - Miền Bắc&nbsp;ph&iacute;:&nbsp;<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">60K</strong></p>\r\n<p style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">H&agrave;ng cồng kềnh hoặc số lượng nhiều</strong><br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	Gủi ch&agrave;nh xe chi ph&iacute; từ&nbsp;<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">50K&nbsp;</strong>đến&nbsp;<strong style=\"margin: 0px; padding: 0px; line-height: 22px; box-sizing: border-box;\">100K</strong></p>\r\n<div>\r\n	&nbsp;</div>\r\n', '<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(255, 102, 0); line-height: 22px; box-sizing: border-box;\">ĐỊA CHỈ:&nbsp;</strong><strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 0); line-height: 22px; box-sizing: border-box;\">37 Đường C27, Phường 12, Q.T&acirc;n B&igrave;nh, Tp.HCM&nbsp;<br style=\"margin: 0px; padding: 0px; font-size: 13px; color: rgb(102, 102, 102); line-height: 20px; box-sizing: border-box;\" />\r\n	( Ho&agrave;ng Hoa Th&aacute;m &raquo; Nguyễn Minh Ho&agrave;n &raquo; Hẻm 58 &raquo; Đường C27 )</strong></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<a href=\"https://www.google.com/maps/place/%C4%90%C6%B0%E1%BB%9Dng+C27,+Ph%C6%B0%E1%BB%9Dng+12,+T%C3%A2n+B%C3%ACnh,+H%E1%BB%93+Ch%C3%AD+Minh,+Vi%E1%BB%87t+Nam/@10.7986851,106.6466218,17z/data=!4m5!3m4!1s0x317529496640fa6d:0x640e38f05c0947ee!8m2!3d10.7979895!4d106.6491324\" style=\"margin: 0px; padding: 0px; font-size: 16px; color: rgb(0, 102, 51); line-height: 20px; box-sizing: border-box; text-decoration-line: none; border: 0px;\" target=\"_blank\"><strong style=\"margin: 0px; padding: 0px; font-size: 15px; color: rgb(0, 0, 255); line-height: 22px; box-sizing: border-box;\">&nbsp;Bản đồ chỉ dẫn đường đi</strong></a></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 255); line-height: 22px; box-sizing: border-box;\">GIỜ L&Agrave;M VIỆC: T2- T7 : TỪ 8h ĐẾN 18H !!!</strong></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 255); line-height: 22px; box-sizing: border-box; text-transform: uppercase;\">NGHĨ TRƯA TỪ 12H ĐẾN 13H30</strong></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 102); line-height: 22px; box-sizing: border-box;\">QU&Iacute; KH&Aacute;CH VUI L&Ograve;NG TỚI TRONG GIỜ L&Agrave;M VIỆC</strong></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 3px 10px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 102); line-height: 22px; box-sizing: border-box;\">XIN CH&Acirc;N TH&Agrave;NH CẢM ƠN!!!</strong></p>\r\n', '<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 0); line-height: 22px; box-sizing: border-box;\">Kh&aacute;ch HCM</strong>&nbsp;<br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(255, 0, 0); line-height: 22px; box-sizing: border-box; font-size: 20px !important;\">0902 985 499</strong>&nbsp;<i style=\"margin: 0px; padding: 0px 5px; font-size: 13px; color: rgb(153, 51, 0); line-height: 20px; box-sizing: border-box; font-weight: bold;\">(Ms Th&uacute;y)</i></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 0); line-height: 22px; box-sizing: border-box;\">Kh&aacute;ch Tỉnh</strong>&nbsp;<br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(255, 0, 0); line-height: 22px; box-sizing: border-box; font-size: 20px !important;\">0932 621 233</strong>&nbsp;<i style=\"margin: 0px; padding: 0px 5px; font-size: 13px; color: rgb(153, 51, 0); line-height: 20px; box-sizing: border-box; font-weight: bold;\">(Ms Hương)</i></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 0); line-height: 22px; box-sizing: border-box;\">Mua sỉ sll, nhận order</strong>&nbsp;<br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(255, 0, 0); line-height: 22px; box-sizing: border-box; font-size: 20px !important;\">0934 030 287&nbsp;</strong><i style=\"margin: 0px; padding: 0px 5px; font-size: 13px; color: rgb(153, 51, 0); line-height: 20px; box-sizing: border-box; font-weight: bold;\">(Ms Trinh)</i></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 0); line-height: 22px; box-sizing: border-box;\">H&agrave;ng bảo h&agrave;nh kh&aacute;ch tỉnh</strong>&nbsp;<br style=\"margin: 0px; padding: 0px; font-size: 13px; line-height: 20px; box-sizing: border-box;\" />\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(255, 0, 0); line-height: 22px; box-sizing: border-box; font-size: 20px !important;\">0974 947 857&nbsp;</strong><i style=\"margin: 0px; padding: 0px 5px; font-size: 13px; color: rgb(153, 51, 0); line-height: 20px; box-sizing: border-box; font-weight: bold;\">(Mr Trường)</i></p>\r\n', '<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(255, 102, 0); line-height: 22px; box-sizing: border-box;\">ĐỊA CHỈ:&nbsp;</strong><strong style=\"margin: 0px; padding: 0px; color: rgb(255, 0, 255); line-height: 22px; box-sizing: border-box;\">37 Đường C27, Phường 12, Q.T&acirc;n B&igrave;nh, Tp.HCM&nbsp;<br style=\"margin: 0px; padding: 0px; font-size: 13px; color: rgb(102, 102, 102); line-height: 20px; box-sizing: border-box;\" />\r\n	( Ho&agrave;ng Hoa Th&aacute;m &raquo; Nguyễn Minh Ho&agrave;n &raquo; Hẻm 58 &raquo; Đường C27 )</strong></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<a href=\"https://www.google.com/maps/place/%C4%90%C6%B0%E1%BB%9Dng+C27,+Ph%C6%B0%E1%BB%9Dng+12,+T%C3%A2n+B%C3%ACnh,+H%E1%BB%93+Ch%C3%AD+Minh,+Vi%E1%BB%87t+Nam/@10.7986851,106.6466218,17z/data=!4m5!3m4!1s0x317529496640fa6d:0x640e38f05c0947ee!8m2!3d10.7979895!4d106.6491324\" style=\"margin: 0px; padding: 0px; font-size: 16px; color: rgb(0, 102, 51); line-height: 20px; box-sizing: border-box; text-decoration-line: none; border: 0px;\" target=\"_blank\"><strong style=\"margin: 0px; padding: 0px; font-size: 15px; color: rgb(0, 0, 255); line-height: 22px; box-sizing: border-box;\">&nbsp;Bản đồ chỉ dẫn đường đi</strong></a></p>\r\n<p>\r\n	<strong style=\"margin: 0px; padding: 0px; font-family: Arial; font-size: 15px; color: rgb(0, 102, 204); line-height: 22px; box-sizing: border-box; text-align: center;\">&nbsp;&nbsp;</strong><span style=\"color: rgb(102, 102, 102); font-family: Arial; font-size: 13px; text-align: center;\">&nbsp;</span><br style=\"margin: 0px; padding: 0px; font-family: Arial; font-size: 13px; color: rgb(102, 102, 102); line-height: 20px; box-sizing: border-box; text-align: center;\" />\r\n	<strong style=\"margin: 0px; padding: 0px; font-family: Arial; color: rgb(255, 0, 0); line-height: 22px; box-sizing: border-box; text-align: center; font-size: 20px !important;\">LI&Ecirc;N HỆ MUA SỈ V&Agrave; Đ&Oacute;NG H&Agrave;NG ĐI TỈNH</strong></p>\r\n<p style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box; text-align: center;\">\r\n	&nbsp;</p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 0); line-height: 22px; box-sizing: border-box;\">Kh&aacute;ch HCM</strong>&nbsp;<strong style=\"margin: 0px; padding: 0px; color: rgb(255, 0, 0); line-height: 22px; box-sizing: border-box; font-size: 20px !important;\">0902 985 499</strong>&nbsp;<strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 0); line-height: 22px; box-sizing: border-box;\">Ms Th&uacute;y</strong></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 0); line-height: 22px; box-sizing: border-box;\">Kh&aacute;ch Tỉnh</strong>&nbsp;<strong style=\"margin: 0px; padding: 0px; color: rgb(255, 0, 0); line-height: 22px; box-sizing: border-box; font-size: 20px !important;\">0932 621 233</strong>&nbsp;<strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 0); line-height: 22px; box-sizing: border-box;\">Ms Hương</strong></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 0); line-height: 22px; box-sizing: border-box;\">Mua sỉ sll, nhận order</strong>&nbsp;<strong style=\"margin: 0px; padding: 0px; color: rgb(255, 0, 0); line-height: 22px; box-sizing: border-box; font-size: 20px !important;\">0934 030 287&nbsp;</strong><strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 0); line-height: 22px; box-sizing: border-box;\">Ms Trinh</strong></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 0); line-height: 22px; box-sizing: border-box;\">H&agrave;ng bảo h&agrave;nh kh&aacute;ch tỉnh</strong>&nbsp;<strong style=\"margin: 0px; padding: 0px; color: rgb(255, 0, 0); line-height: 22px; box-sizing: border-box; font-size: 20px !important;\">0974 947 857&nbsp;</strong><strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 0); line-height: 22px; box-sizing: border-box;\">Mr Trường</strong></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 0); line-height: 22px; box-sizing: border-box;\">Gmail:&nbsp;trinh240887@gmail.com</strong></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 255); line-height: 22px; box-sizing: border-box;\">GIỜ L&Agrave;M VIỆC: T2 - T7 : TỪ 8h ĐẾN 18H !!!</strong></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 255); line-height: 22px; box-sizing: border-box; text-transform: uppercase;\">NGHĨ TRƯA TỪ 12H ĐẾN 13H30</strong></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(153, 51, 102); line-height: 22px; box-sizing: border-box;\">QU&Iacute; KH&Aacute;CH VUI L&Ograve;NG GỌI TRONG GIỜ L&Agrave;M VIỆC. XIN CẢM ƠN!!!!</strong></p>\r\n<p>\r\n	<strong style=\"margin: 0px; padding: 0px; font-family: Arial; font-size: 15px; color: rgb(0, 102, 204); line-height: 22px; box-sizing: border-box; text-align: center;\">&nbsp;&nbsp;</strong><span style=\"color: rgb(102, 102, 102); font-family: Arial; font-size: 13px; text-align: center;\">&nbsp;</span></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(255, 157, 0); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(0, 102, 204); line-height: 22px; box-sizing: border-box;\">ĐỐI VỚI KH&Aacute;C H&Agrave;NG ĐẾN VĂN PH&Ograve;NG</strong>&nbsp;<br style=\"margin: 0px; padding: 0px; font-size: 13px; color: rgb(102, 102, 102); line-height: 20px; box-sizing: border-box;\" />\r\n	NHỮNG SẢN PHẨM BAO TEST KH&Aacute;CH H&Agrave;NG MUA V&Agrave; KIỂM TẠI CHỖ, KIỂM TRA ĐẦY ĐỦ H&Agrave;NG H&Oacute;A TRƯỚC KHI RA VỀ, SẢN PHẨM ĐƯỢC ĐỔI TRẢ TRONG 7 NG&Agrave;Y QU&Iacute; KH&Aacute;CH ĐEM H&Oacute;A ĐƠN THEO ĐỂ ĐC ĐỔI H&Agrave;NG, KH&Ocirc;NG BẢO H&Agrave;NH NHỮNG TRƯỜNG HỢP SẢN PHẨM BỊ BIẾN DẠNG, CH&Aacute;Y NỔ V&Agrave; PHỤ KIỆN ĐI K&Egrave;M!!!&nbsp;<br style=\"margin: 0px; padding: 0px; font-size: 13px; color: rgb(102, 102, 102); line-height: 20px; box-sizing: border-box;\" />\r\n	XIN CH&Acirc;N TH&Agrave;NH CẢM ƠN.&nbsp;<br style=\"margin: 0px; padding: 0px; font-size: 13px; color: rgb(102, 102, 102); line-height: 20px; box-sizing: border-box;\" />\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(0, 102, 204); line-height: 22px; box-sizing: border-box;\">&nbsp;&nbsp;</strong></p>\r\n<p align=\"center\" style=\"margin: 0px; padding: 5px 0px; font-family: Arial; font-size: 15px; color: rgb(102, 102, 102); line-height: 25px; box-sizing: border-box;\">\r\n	<strong style=\"margin: 0px; padding: 0px; color: rgb(0, 128, 0); line-height: 22px; box-sizing: border-box;\">GIAO H&Agrave;NG MIỄN PH&Iacute; NỘI TH&Agrave;NH VỚI H&Oacute;A ĐƠN TỪ 1TR5 TRỞ L&Ecirc;N, DƯỚI 1.5 TRIỆU PH&Iacute; GIAO H&Agrave;NG 30K</strong></p>\r\n<p align=\"center\">\r\n	<a href=\"http://dathangsi.vn/bangia\" style=\"font-weight:bold; color:#063; text-transform:uppercase; font-size:16px\">BẢNG B&Aacute;O GI&Aacute; MỚI NHẤT</a></p>\r\n', 'thg1571712124.png', 'zma1540045297.png', '', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for faculties
-- ----------------------------
DROP TABLE IF EXISTS `faculties`;
CREATE TABLE `faculties`  (
  `fac_id` int(11) NOT NULL AUTO_INCREMENT,
  `fac_school_id` int(11) NOT NULL,
  `fac_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fac_active` tinyint(4) NULL DEFAULT 0,
  `fac_create_time` int(11) NULL DEFAULT NULL,
  `fac_update_time` int(11) NULL DEFAULT NULL,
  `admin_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`fac_id`) USING BTREE,
  INDEX `fac_school_id`(`fac_school_id`) USING BTREE,
  INDEX `fac_active`(`fac_active`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of faculties
-- ----------------------------
INSERT INTO `faculties` VALUES (14, 40, 'Quản Lý Công Nghiệp Và Năng Lượng', 1, 1589132545, 1589132545, NULL);
INSERT INTO `faculties` VALUES (16, 40, 'Kỹ Thuật Điện ', 1, 1589132968, 1589132968, NULL);
INSERT INTO `faculties` VALUES (17, 40, 'Điều Khiển và Tự Động Hóa', 1, 1589132990, 1589132990, NULL);
INSERT INTO `faculties` VALUES (18, 40, 'Điện Tử Viễn Thông ', 1, 1589133049, 1589133049, NULL);
INSERT INTO `faculties` VALUES (19, 40, 'Kinh Tế Và Quản Lý', 1, 1589133071, 1589133071, NULL);
INSERT INTO `faculties` VALUES (20, 40, 'Khoa Xây Dựng ', 1, 1589133085, 1589133085, NULL);
INSERT INTO `faculties` VALUES (23, 40, 'Bộ Môn Khoa Học Chính Trị', 1, 1589133142, 1589133142, NULL);
INSERT INTO `faculties` VALUES (24, 40, 'Môn GDTC&QPAN', 1, 1589133162, 1589133162, NULL);
INSERT INTO `faculties` VALUES (25, 29, 'Công trình ', 1, 1589133266, 1589133266, NULL);
INSERT INTO `faculties` VALUES (26, 29, 'Kỹ thuật tài nguyên nước ', 1, 1589133283, 1589133283, NULL);
INSERT INTO `faculties` VALUES (27, 29, 'Thủy văn và tài nguyên nước ', 1, 1589133300, 1589133300, NULL);
INSERT INTO `faculties` VALUES (28, 29, 'Cơ khí ', 1, 1589133317, 1589133317, NULL);
INSERT INTO `faculties` VALUES (29, 29, 'Điện-Điện tử ', 1, 1589133330, 1589133330, NULL);
INSERT INTO `faculties` VALUES (30, 40, 'Công Nghệ Thông Tin', 1, 1589292305, 1589292305, NULL);
INSERT INTO `faculties` VALUES (31, 37, 'Chế @ tạo máy ', 0, 1589448482, 1589448482, NULL);

-- ----------------------------
-- Table structure for files
-- ----------------------------
DROP TABLE IF EXISTS `files`;
CREATE TABLE `files`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `content` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `status` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of files
-- ----------------------------
INSERT INTO `files` VALUES (2, '6631748382823089848.txt', 'chín số tám mươi ba kim hoàng xin nghe ạ chị cho hỏi là đồng nai anh ngắt điện đằng gió to được không. à em tra cứu được mất tiền hay sao anh à bị phường á mất liền nó chừng nào lên á anh tính hỏi á nó nhớ phương hoa phường quyết thắng. số điện thoại khách hàng là nguyễn thái thịnh ngô minh đúng rồi. phường quyết thắng khu vực của anh hiện tại trên giữ máy trong giây lát nha liên hòa hai phường quyết thắng em chưa nhận được thông tin ở khu vực này gặp sự cố hoặc mất lâu chưa anh. mất cũng ba tiếng rồi ba tiếng rồi hả anh. xong nguyên khu vực khoa luôn hay là chỉ riêng nhà anh thôi à cũng miết nó không có ra ngoài đường nữa không biết nhưng mà chắc nó không rành nữa tại vì nhà lên tao có sửa ra đi không. anh kiểm tra giúp em tivi trong nhà không có bị bật xuống không anh.thế rồi để em báo kỹ thuật xuống kiểm tra nhà anh trước nha liên hệ số điện thoại này gặp anh tên gì không long. anh đông á anh rồi thì nhân viên liên hệ lại nghe máy giúp em thời gian hỗ trợ xong mới là hai tiếng kể từ khi báo trung tâm nha.à dạ minh coi có ai có liên hệ lại anh để biết nữa dạ rồi em nói anh hiểu rồi cám ơn anh liên hệ kiểm tâm chào anh ạ.', 1);
INSERT INTO `files` VALUES (3, '6631748400002959034.txt', 'danh số 309 lê kim sinh nghe có gì anh cho em hỏi làm sao chứ nhà em nó bị cắt điện nè chị. mất điện chỉ riêng nhà chị hay toàn khu vực điện mất điện chị dạ không đê một nhà em thôi vui lòng cung cấp giúp em sơn trên giây lát đi nghỉ nhờ chị là ai đứng tên về à. dạ à nghi là để em coi lại cái đã dạ thì kiếm dạ vậy vậy chị giữ máy đi chị nhận máy đi dạ.dạ là. thùy trang. sao lại đấu liên doanh. hộ kinh doanh nguyễn thị thùy trang ở xã huyện nào ạ dạ đông hòa dĩ an bình dương. năm mươi mốt xẹt ba quốc lộ một k nha khu phố đông phường đông hòa thuộc dĩ an bình dương đúng hông ạ. mức địa chỉ riêng nhà chị chị kiểm tra giúp em xi bi hoặc cầu dao dưới đồng hồ điện đen mở hay đang tắt rồi à. dạ không là như vậy là hồi sáng có hai anh nào tới hỏi bưu điện mà nói là đóng trên điện vẫn đầy đủ ngồi nhưng mà. đi kiếm cái hộp điện làm sai gì đó rồi không có rồi đi ra rồi bây giờ là mất điện á. dạ chị tìm giúp em là dưới đồng hồ điện có cầu dao hoặc là seri chị nhìn giúp em là gạt lên hay giờ xuống về à. dạ chờ em một xíu chị ạ.dạ em đang nhờ em tí. à.em cũng không biết em không rành cái này nữa để kêu chồng em em coi thử coi sao cái đã dạ địa chỉ của chị có phải là thửa đất 320 khu phố đông a phường đông hòa không chị. hai mươi mốt xẹt ba năm mươi mốt xẹt ba đà địa chỉ mới đúng không ạ ở đây em chỉ thấy hộ kinh doanh nguyễn thị thùy trang một hộ. là thủ dây gì ở 5200 phố đông an. anh ơi. anh ra coi cái cầu dao ý vậy là nó cúp hay là nó mở vậy. cầu dao lốc nè. chị giữ máy đi nó chọc em coi rồi em nói lại cho dạ.đây này hoàn thành ấy.nó là nó đang túc hay nó đang mở.bên nhà nè. xem cái bởi vì nè.đang có phòng anh mở lên coi.à nó nó gà xuống luôn nhưng mà mở giờ mở lên là không được luôn chị dạ chị không thể mở lên đúng không ạ vui lòng rút hết tất cả các thiết bị điện trong nhà ra giúp em sau đó mở lại chứ không có điện không à. rút hết chết mày điện á hả chị biết sao hông tại vì ở đây là mát xa con xê xông hơi giờ rút ra là rút hết bao nhiêu cái sao mà lúc được. vì có thể là các thiết bị điện trong nhà đang chặn chập dẫn đến là xi bi gạt xuống để bảo vệ đường dây đó chị à. chị vui lòng kiểm tra hết các thiết bị điện trong nhà giúp em xem có chạm chập hay không sau đó mở sim đi lại có điện nghe không ạ nếu có điện chị vui lòng kiểm tra các thiết bị điện không có điện chị vui lòng liên hệ lại để được hỗ trợ sửa chữa giúp em ạ. dạ dạ dạ dạ cám ơn chị liên hệ trung tâm chào chị à.anh gà thoát cái.', 1);
INSERT INTO `files` VALUES (4, '6631748558916748990.txt', 'danh số bảy chín thới an xin nghe ạ. ờ cho tôi hỏi a phú lệ xe cúp điện bấy giờ có hả. dạ khu vực này thuộc ở châu thành tiền giang đúng hông chị. dạ hiện nay a. khu vực này là thuộc huyện phú khiết. dạ dự kiến tại khu vực này là 14 giờ có điện trở lại nha chị là 2 giờ. dạ rồi dạ.mình cám ơn chị liên hệ trung tâm em.', 1);
INSERT INTO `files` VALUES (5, '6631748571801650880.txt', 'danh số 55 hà xuân nghe ờ cái a ở vĩnh bình á ấp lộc hiệp bữa nào cúp điện a cưng đâu quên. anh là khách hàng đặng văn minh địa chỉ là 383 xẹt năm ấp lộc hiệp xã vĩnh bình phú ninh lộc chờ lát đúng hông anh. dạ cám ơn đúng rồi dạ em kiểm tra hệ thống là ngày hôm nay khu vực dự kiến là chưa có lịch công tác tuy nhiên là anh đang báo mất điện hay sao ạ. số điện hỏi thăm coi bữa nào cúp điện vậy đó dạ em kiểm tra hệ thống nè dự kiến năm ngày tới chưa có lịch công tác ngoài đường sự cố ạ. ờ vậy hổm có nói ơ nghe thông báo nghe hổng được rồi có người hướng dẫn ơ cũng toàn điện lực nhờ cũng gắn giùm nhắn thu bữa thứ 6 thứ 7 gì tui quên. em kiểm tra hệ thống này dự kiến năm ngày tới là chưa có lịch công tác mọi sự sự cố xảy ra nha. coi như năm ngày tới là không năm ngày tới là hồi cúp á hả dạ đúng rồi anh dự kiến năm ngày tới anh giữ máy dùm em giây lát tuy nhiên là anh có nhận được. tin nhắn á. vào à. ngày 29/11 đúng không ạ ờ. đang có báo nhận được thông báo lịch ngừng giảm cung cấp điện bắt đầu từ 7 giờ sáng ngày mùng 08/12 đến 17 giờ chiều đúng hông anh.dạ trường hợp trên thì em sẽ ghi nhận là yêu cầu của anh và chuyển lại điện lực kiểm tra chủ động phản hồi lại trong vòng à. hai tiếng nha. ờ vì vậy là chút nữa mới biết kết quả hai tiếng nữa nếu cứng quá là thứ 6 thứ 7000 sắp tới ha ý là phê chủ động liên hệ lại rồi phản hồi thông tin này chưa anh trong vòng hai tiếng ạ. khi cần trợ giúp về lại qua số di động anh gọi gặp anh tên gì anh. trần minh đặng minh nè dạ dielac liên hệ lại anh minh vui lòng nghe máy giùm em nha.rồi rồi cám ơn dạ em cảm ơn anh liên hệ thằng tâm xin chào ạ.', 1);
INSERT INTO `files` VALUES (6, '6631748584686552770.txt', 'dạ em số không bảy ngày nay xin nghe. dạ chị ơi em hỏi cái nhà em nó xài để chín ba em xài chín đó chị. dạ mà em xài ké á ờ nãy cái anh hướng dẫn cho đồng hồ sao chị.ở đây em thấy lúc nãy là anh phương đề nghị kiểm tra công tơ điện đúng không ạ dạ đúng rồi chị. bây giờ anh muốn kiểm tra là ở ngoài đồng hồ anh kiểm tra rồi mà ảnh ghé là mình xài điện ké á là. dậy mình sài nhiều là cái phí lên vậy đó. nhưng mà hắn kêu là nếu mà xài điên ké thì ấn chỉ số tổng đài điện để mà gắn đồng hồ đó chị.là bây giờ anh muốn gắn công tơ điện để sử dụng. hay là ăn muốn tăng định mức ở hộ khách hàng này anh. dạ ý là em hỏi là cái a anh nói là gắn đồng hồ xài ké mà nhà em bên nhà ông phương á. vẫn a hồi nhà em sao nó xài ké mình điện mình hồng phương. là anh hướng dẫn anh anh. dạ anh kỹ thuật viên nãy anh nãy giờ anh anh anh nói anh chị nó nói chị.nó chỉ hết số này nè em mới điện hỏi coi. tại vì ở đây em thấy số điện thoại của anh khách quan là khách hàng dương văn phương. ờ ai đúng ai của xuân lộc thị lúc nãy có đề nghị kiểm tra công tơ điện còn ở đây là anh đề nghị là tăng định mức. để em sử dụng chung của huế phát hàng dương văn phương này luôn đúng không anh dạ đúng rồi dạ dạ nếu không anh muốn tăng lên nút ở tại điểm này thì vui lòng cho em hỏi anh có sổ hộ khẩu tại điểm đề nghị được không ạ. dạ có chị nếu vậy anh đi chuẩn bị sẵn giúp em sổ hộ khẩu của người muốn tăng thêm định mức kèm theo khách hàng dương quang phương mà chứng minh của khách hàng. dương văn phương này thì đừng lộc sẽ hỗ trợ cấp định mức chanh sử dụng. dạ cái số tốn tiền gì không chị dạ không còn ngày không có tốn phí đâu anh. à load mà họ cho mình luôn chị hả ở đây là không điện lực không có lắp công tơ điện cho anh anh tại vì ở đây là anh muốn dùng chung định mức thì điện lực hay tính lâu nay là hộ khách hàng này. dương văn phương này hiện tại là định mức là đang một hộ anh đề nghị cấp em để mất thì điện lực sẽ đến hỗ trợ cấp thêm cho anh một định mức còn với định mức của hồ dương quang phương này thì anh phải có được số hộ là hai hồ. thế công tơ phụ gắn phía sau này là anh phải tự mua ngoài thị trường hoàng anh gắn thôi. còn nếu mà anh muốn gắn công tơ điện để sử dụng riêng thì lúc đó điện lực mới gắn một công tơ riêng cho anh. ờ thế không phải là cắp định mức chung với khách hàng dương văn phương này. rồi rồi vậy cám ơn chị dạ là anh chưa hỏi như vậy thôi có muốn em tiếp nhận thông tin luôn ạ dạ dạ để em hỏi nha chị dạ dạ rồi. anh không hỗ trợ tên nào nữa không ạ chứ không ấy chị.dạ cám ơn liên hệ trung tâm chào anh cám ơn chị dạ.', 1);
INSERT INTO `files` VALUES (7, '6631748606161389253.txt', 'dạ số ba mươi lăm anh tuấn sinh nga. có điện a ngay chỗ trường hưng a hưng về chợ bến tranh nó nhiên cúp điện rồi chừng nào có vậy anh. dạ nó xã huyện nào anh lương hòa lạc á dạ nếu xã lương hòa lạc thì đáng sự cố và xã lương hòa lạc dự kiến là 14 giờ sẽ có điện lại nên thông cảm rồi.rồi rồi dạ anh cần hỗ trợ nữa không à không không dạ tóm lại trung tâm hoặc em xin chào anh ạ.', 1);
INSERT INTO `files` VALUES (8, '6631748661995964105.txt', 'dạ dạ số chín sáu kim ngưu xin nghe. à chị ơi em ở bên chỗ cái hộ kinh doanh huyền chỉ có đó chị dạ ơ nhờ bên em á có cái đợt hai ơ dưới cái đường ba của tháng 11 chưa có đóng điện á nãy. thế mẹ ăn chú nghe tại vì hồi hồi nãy mẹ nó xuống á kêu ơ đóng điện bên em ơ tại vì là không có đóng tiền điện á em kêu mấy anh chờ em chút xíu đi đóng rồi có gì em điện em đưa lại hóa đơn nó đánh coi. thế a mẹ anh kêu ừ cái em chưa có bị tới nữa em đóng điện xuống rồi bây giờ nhà chị cho em cái số điện liên lạc với cái bên mà bị đóng điện lên đó chị. chị xác nhận cho hộ kinh doanh rồi chỉ có đúng không ạ dạ đúng rồi ạ cách đây 10 phút chị có liên hệ xác nhận chi phí đóng cáp đúng không ạ. đúng rồi đúng rồi dạ thông tin điện lực vẫn đang tiếp nhận và vẫn đang trong quá trình hỗ trợ được chị. dạ chị thông cảm đợi giúp em ạ không quá một ngày làm việc điện lực sẽ liên hệ phản hồi ạ. mất một ngày á chị dạ vâng ạ thông tin của chị trong một ngày làm việc ạ.hiện tại là chị đã thanh toán tiền nợ chưa ạ. em đi đóng rồi em kêu mấy anh ơ kêu á mấy anh xuống kêu cắt điện em nói là đợi em đi đóng đi rồi có về có gì về em đưa a. đưa cái cái hóa đơn trên đấy chúng tôi cái em vừa đi cái mẹ ở nhà cúp điện luôn không có chở em về tới luôn. dạ chị thông cảm giúp em ạ anh theo quy định là chị đâu quá hạn thanh toán á chị. em biết rồi nhưng mà em đã nói với nay anh là chờ em chút xíu em đi đóng cái em về liền rồi em đưa đưa cái phiếu cho mấy ảnh coi mà làm cái gì mà kêu ừ rồi làm gì mà tự nhiên cái. em đi chứ ở nhà cúp vậy đó. dạ lúc nãy là chị đâu có liên hệ anh tại là do là chị đã bị mất điện quá hạn á hay là chỉ cần phải thanh toán chi phí đóng cắt. thì chị thông cảm đợi giúp em trong một ngày làm việc để luật sẽ liên hệ lại thông báo chị phi đóng cáp ạ để chị thanh toán sau đó mới cấp điện lại được ạ. mình thanh toán em đi đâu thanh toán gì dạ chị thanh toán phải trực tiếp điện lực hoặc là chuyển khoản đó chị chi phí đóng cáp thì không thể thanh toán qua điểm thu hộ được ạ. vậy bây giờ chị cho em cái tài khoản đi chừng nào có được á thì em chuyển qua luôn. dạ chị cần tài khoản của ngân hàng nào ạ. tra phong banh ý chị.dạ sacombank của chi nhánh đức hòa long đúng không ạ đúng rồi ạ.dạ chị ghi nhận lại giúp em. rồi thì đặt đi dạ xa cam man số tài khoản của phòng giao dịch đức hòa là 0700. rồi. dạ 557. dạ 11771 ạ. một một mấy dạ máy bẩy một.em đọc lại con 700557 nhiêu nữa chị dạ 0700. 55711771 ạ.vậy giờ làm xong tới chừng nào mà bên kia báo xuống là em đóng tiền cho đây là là là bên đó xuống đây làm sao vậy à sau khi chị thanh toán được chi phí đóng cắt rồi thì chị liên hệ lại trung tâm giúp em. liên hệ trung tâm nào chị số này hay là nào số điện thoại này đó chị. cái dây a cái cái cái báo cắt ư cái này ai ai sẽ liên lạc cho em. dạ điện luật sẽ liên hệ trực tiếp với chị đâu thông báo chi phí ạ. rồi rồi.dạ vâng chị cần hỗ trợ gì nữa xong ạ.', 1);
INSERT INTO `files` VALUES (9, '6631748790844982989.txt', 'danh số bốn ba nguyễn linh sinh. dạ chị ơi cho em hỏi nào sáng mưa này em có đi đóng tiền đó của chị là ngừng cung cấp điện nhà em rồi em đóng rồi mà không biết là có có chừng nào mới có điện lại á chị. địa chỉ của em là ba. 34520 tự phước ạ. ai là người đứng tên trên hóa đơn điện của nhà anh vì à dạ phan duyệt bình nè em mới đổi lại a em mới đổi lại cái người chủ chủ hộ là em đứng à. mà đổi tên rồi nhưng mà trên hóa đơn tháng này anh nhận được có phải là phan thiết bình là người đứng tên trên hóa đơn không ạ dạ đúng rồi ạ. chị ở khu vực ấp thuận phường thành phố nào vậy anh của em ấy là là ở a. phường 11 á. thành phố đà lạt á ạ. anh vui lòng giữ máy em kiểm tra thông tin của anh ạ.dạ cám ơn anh đã giữ máy cho em xác nhận một thông tin á là anh xuống điện lực thanh toán luôn hay sao ạ dạ em em đã xuống rồi thanh toán xong hết rồi à rồi. nhưng anh đã thanh toán kim chi phí đóng cắt điện chưa vì anh dạ đúng xong luôn à chị dạ. thông tin của anh em đã ghi nhận rồi thời gian hỗ trợ có nghi lộc là tối đa trong vòng hai tiếng nhân viên người luật sẽ cố gắng liên hệ và xuống mở điện lại cho anh mong anh thông cảm á. dạ dạ dạ dạ có dạ em cám ơn chị nghen dạ khi nhân viên điện lực liên hệ thì anh nhớ chuối điện thoại bắt máy giúp em được hỗ trợ sớm ạ. dạ dạ rồi ạ dạ sao nó cần hỗ trợ thêm thông tin gì nữa không ạ dạ không ạ em cám ơn ạ dạ cám ơn anh đã liên hệ trung tâm chợ ạ.dạ dạ.', 1);
INSERT INTO `files` VALUES (10, '6631748816614786767.txt', 'em thấy xuân chính nguyễn xuân nghe.chị cho ờ cho hỏi là là là cái tên cái tin nhắn vô vô cái báo điện trong điện thoại là là. à chị hay là ai vậy. tin nhắn thông báo gì vậy anh. thông báo mà tiền điện hay cúp điện đồ qua trong cái điện thoại nè còn nhắn sao không à nhắn trước lần cho ta biết chứ đây mình đồ nó hư hết trơn à. giờ nó mới nhắn nguồn à hồi sáu tây ha tháng 12 nè là cúp điện mà giờ mới ngắn mà. bắt đầu 5 giờ tới 7 giờ đồ nó hư hết trơn ngắn ngắn trước chứ sao tự nhiên toàn nhắn sau không à. dạ khách hàng đang gọi là vấn đề nguyễn văn đông phải không anh đúng rồi đúng rồi lộn mày quyết. khu 251. dạ rồi mai mốt á chị. nhớ là ai mà ai mà nhắn trong điện thoại viên nhắn trước giùm bữa nha. đang nắng nắng bít ơ bây giờ mình tính đến nó về nó ấy rồi cái nhắn trễ không à dạ. vui lòng kiểm tra lại thông tin giúp em ạ điện lực thông báo gửi tin nhắn cho anh ngày hôm qua là ngày 05/12 chứ không phải ngày hôm nay điện lực mới nhắn. ủa mà sao mà mà mà mà nó báo ơ nó mới vừa báo á. anh đọc lại tin nhắn giúp em điện lực có báo kính gửi khách hàng lò bánh mì nguyễn văn dương có mã khách hàng bê bê không bốn năm sáu không không bốn. điện lực tân nguyên sinh thông báo thời gian vui lòng nghe em đọc hết ca tin nhắn của điện lực ạ ở lập tân uyên sinh thông báo thời gian ngừng giảm cung cấp. điện tại trụ hai trăm năm mươi mốt tỷ ba thái hòa khu phố vĩnh phước phường thái hòa tân uyên bình dương vào lúc 5 giờ sáng ngày 06/12. chị kiếm có điện trở lại vào lúc 7 giờ sáng lý do sửa chữa điện rất mong quý khách hàng thông cảm ngày thông báo ngày năm tháng mười một mười hai. dạ xin lỗi chín mong quý khách hàng thông cảm ngày 05/12/2018 trân trọng có nghĩa là ngày 05/12/2018 là điện lực. gửi tin nhắn cho anh cúp điện ngày mùng 6 chứ không phải là điện lực mới gửi hôm nay vui lòng kiểm tra và đọc hết tin nhắn giúp em thông báo giúp em. lúc đó điện lực cũng thông báo gửi tin nhắn trước một ngày chứ không có gửi tin nhắn cùng ngày. xong rồi 07/11 điện lực thông báo là mất điện trung tâm xin nghe. à mà mà ủa mà mà mà sao cái điện thoại này nó vô xanh. vấn đề này anh kiểm tra lại điện thoại của anh cho tín hiệu điện thoại của anh chứ không phải là tín hiệu điện thoại của điện lực và tin nhắn từ điện lực điện lực thông báo đã gửi trước cho anh một ngày rồi. nãy giờ nó đấy đấy đấy coi lại coi.anh cần hỗ trợ thông tin gì nữa phải không ạ.', 1);
INSERT INTO `files` VALUES (11, '6631748923988969171.txt', 'chị vĩnh phước a sớm giờ xin nghe ạ. alo chị ơi cho em hỏi là cái hộ mà trần quang tư á hay sao mà chú đóng tiền điện kịp mà cắt hả chị. chắc vậy hả khách hàng đăng ký bưu điện tên gì ạ. trần quang tư trần văn tư ạ đúng rồi ở ấp tân thuận châu khánh á. xã huyện nào vậy em. à ấp hai xã châu khánh huyện long phú huyện sóc trăng. cũng làm giữ máy kiểm tra thông tin ạ.dạ xin lỗi giữ máy lâu ạ hiện tại anh có trên dự giấy báo tiền điện nó không anh. dạ dạ anh cứ đi gửi giấy báo tiền điện nữa hay không ạ. giữ không chị số tiền mười đã đã đóng số tiền bao nhiêu anh có biết không ạ. cũng như là bà lá ba đi a còn mắc đi làm giờ không bắt có nhà rồi bà bỏ nhà đi rồi còn thiếu đâu anh. khách hàng mốt ngàn ba trăm bốn chục đồng rồi nhân viên là cắt rồi chị cắt điện nè nếu trường hợp khách hàng chưa thanh toán tiền điện thì được á điện lại đúng không anh quá thời gian quy định thì đường thị tuyết hằng thất điện thôi ạ. dạ dạ muốn ra gắn lại là sao chị anh thanh toán tiền điện còn chi phí đóng cắc giúp em ạ. đóng rồi mở ra gờ gán hả chị dạ đúng rồi anh ngày 1810 tiếng mà. anh đến trực tiếp tại điện lực thanh toán giúp em ạ bốn bốn dạ rồi ý là phải báo với điện lực là nó bị cắt liền nhanh đi lực thu thêm chi phí đóng cắt ạ. dạ rồi dạ.thao tác trên này cần em hỗ trợ thông tin nào khác không ạ xong chị dạ có nếu liên hệ trung tâm chưa anh.', 1);
INSERT INTO `files` VALUES (12, '6631749095787661015.txt', 'dạ số 335 anh tuấn anh nghe đâu.dạ thôi anh ơi dạ tôi khách hàng ờ chỗ tổ năm xe chỗ hiểu á.hết hạn là phải là nguyễn hữu thuế ấp đồng ở long thành đồng nai đúng không ạ à đúng rồi tức là có cái nghị trung tâm là lúc a. 12 giờ 27 phút có để xóa phút đó anh lại vấn đề đúng rồi hợp đồng ý cho điện lực trồng trụ cao thuế trên thủ đức của nhà mình đúng không ạ đúng rồi do cái cột cũ bây giờ đổ bê tông nó tôi không đồng ý đổ bê tông nữa. dạ yêu cầu sẽ tiếp nhận là để chắc kiểm tra phản hồi cho anh sớm anh yên tâm à. 0 giờ giờ thay thì không người ta đổ bê tông. à đấu vào trong là sao anh. đổ chân cột cũ ư ờ trận phục cũ á. thế là bây giờ anh muốn điện lực phản hồi hay là anh hủy yêu cầu nè anh.bảo nghĩ thế đổ bê tông. anh ạ anh báo đổ bê tông là sao em chưa hiểu anh nói có nghĩa bây giờ ủa trinh cột cũ á đỗ chân cục cũ với a cái trần cục cũ á. là bây giờ nó mất về vấn đề gì mày điện ở hộ này anh hộ nguyễn hữu thuế nè anh. ủa nằm trong đất tôi ơ mất a gần hai mét. cước rồi bây giờ anh không đồng ý với điện lực là trồng trụ điện có được chứ anh nhà anh của anh đúng không à. trong trong ấy không được đổ bê tông nữa. qua nguyễn trọng dòng đỗ bên hông là sao em chưa hiểu anh ừ. còn cứ cột cột mới chồng không được trọng ấy nhá. thế là bây giờ anh không đồng ý có được trồng trụ mới của điện lực tranh đức nhà anh đúng không à ờ đúng đúng rồi dạ yêu cầu coi đã tiếp nhận rồi anh được không anh sẽ phản hồi cho anh sớm anh yên tâm à. ờ hình như không a cái này bên tư nhân làm phải không. dạ còn vấn đề do tư nhân hay do điện lực thi công á anh thì sẽ kiểm tra phản hồi cho anh nữa à. ừ thế này là tư nhân nó làm. nhưng mà theo điện là thằng nào hè hay là của điện lực à. khách hàng tư nhân á. chứ không phải bên công ty điện lực.dạ nếu trụ điện của khách hàng. cổng kia nó thu nhỏ đó ở trục ừ còng có rắc ơ nhà anh. ví dụ điện của khách hàng nhà khác trồng trên đất của anh thì anh vui lòng liên hệ với a chính quyền địa phương xã tà đây xuống xử lý anh đi là không có ở trụ điện của khách hàng là mong anh thông cảm rồi. bây giờ là 10 triệu chính vô phải không dạ lấn tới phòng kinh tế hạ tầng á anh phòng địa chính á anh. đinh thị xã được không dạ đúng rồi anh thanh toán qua số điện thoại của địa phương mình đó anh họ sẽ biết cho anh nè. rồi rồi rồi. cắm vào nhá dạ cảm ơn liên hệ trung tâm em xin chào anh tưởng lấy ngày.dạ nếu không còn vấn đề gì khác em nhấc máy trước.', 1);
INSERT INTO `files` VALUES (13, '6631749143032301273.txt', 'danh số bảy chín thúy an xin nghe ạ. à chị ơi a. em a gì à. hủy xanh thì chỉ có ai kêu vô sửa điện giùm em với chị dạ cho em hỏi là hiện nay là anh mất điện riêng nhà anh hay là nhiều nhà. à ghim nhà em à cái nhà dạ cho em hỏi tên khách hàng à trên hóa đơn điện của nhà anh là tên gì ạ à khánh xanh. thạnh săn nhà khu vực này là phường xã hai thị trấn nào anh. hoàng sóc. ấp hoàng sóc xã gì ạ dạ xã ô sơm thổ sơn dạ. thuộc định lực ờ huyện nào ạ. huyện hòn đất hoàng đắc dạ. anh kiểm tra giúp em xi bi hay cầu dao dưới đồng hồ của điện lực á bị gạt xuống không anh. dạ không a xê bênh cơ không có bị dạ thổ xã thổ sơn đúng hông anh. dạ đúng rồi dạ. hiện nay về thông tin mất điện tại vị trí nhà anh em xin được phép tiếp nhận để nhờ nhân viên điện lực hòn đá hỗ trợ tại đây ạ về thời gian xử lý tại nhà trong vòng hai tiếng trước khi đến nhân viên sẽ gọi trước cho anh. anh vui lòng nghe máy giùm em ạ chứ em hỏi là liên hệ gặp anh tên gì được ạ.à trọng anh trọng dạ qua số di động này luôn đúng hông anh dạ đúng rồi dạ vâng ạ cám ơn anh trọng liên hệ đến trung tâm em xin chào anh ạ.', 1);
INSERT INTO `files` VALUES (14, '6631749267586352860.txt', 'dạ dạ số bảy tám chu văn sinh nghi à. ủa chị ơi cho em hỏi trên chỗ xà bang cốc chỗ an bị ờ điện điện ngoài chủ nó không vô chị ơi chớp chớp chớp vậy đó. cắn mất điện một à anh bị điện áp chập chờn không ổn định phải không anh. thì à điện không điện mà giờ nó cúp luôn rồi trong nhà em á ngay diễn ông vô đồng hồ ngay cái trụ ở ngoài á dạ vậy là mất điện hoàn toàn luôn.chị cầu dao dưới đồng hồ điện dạ được cầu dao ý đồng hồ điện hộ anh có đang bật lên không anh.', 1);
INSERT INTO `files` VALUES (15, '6631749417910208226.txt', 'tại vì số muốn làm tài xin nghe. à em ơi cho anh hỏi mà bên điện lực của thị xã ngã năm chưa em. dạ đây liên hệ với tổng đài điện lực miền nam bao gồm cả ngã năm. ờ mà tại vì bên cái chỗ mà khóm ba phường một ở nhà cũng không đổi cho thằng hoàng nó có bị điện nó bị hư á em nhờ vô sửa chữa mà anh không biết anh bấm đại số này nè. dạ hiện tại thì anh thấy lâm một một nhà anh đến mức điện đúng phải không đúng rồi nhà một nhà đó nhà cũng đổi văn hoàng á đường khóm ba phường một á. dạ đường kênh vĩnh long á anh dạ anh thấy là chữ kênh dưới đồng hồ điện có bị bật xuống không anh. nó nó bật bây giờ nó làm như nó hư hết trơn chỗ bật luôn rồi. thế là anh thấy bật xuống không ạ ờ bật xuống mà bật bật lên ở nhã chứ bật lên nó nhảy xuống mà giờ nó hư luôn nó không có nó không còn bật nữa.dạ nhờ nhờ sửa chữa giùm anh. rồi bây giờ anh thử rút hết thiết bị điện trong nhà ra sau đó anh bật lên lại xem được không. rồi rút hết trơn thiết bị trong nhà ra hết rồi giờ bật lên gần vừa bật lên nó không nhảy luôn nó không có điện luôn. để em chuyển cái địa lịch ngã năm ngã năm để anh kiểm tra và xử lý anh trường hợp mất điện ở nhà trước khoảng hai tiếng dạ rồi rồi rồi cám ơn anh vâng thế điện lực đó liên hệ lại gặp anh.hoàng ạ.', 1);
INSERT INTO `files` VALUES (16, '6631749546759227110.txt', 'ờ chị ơi em ở một trăm ba ba nguyễn đáng á chị dạ bữa hổm em có báo về cái vụ mất điện ở chỗ em á tức là cái seri bên em á. là rất là nhiều hộ xài chung một cái xê bê đó nhưng mà tại sao mà cứ chỗ em bật hoài trong khi hiện giờ em đang không có xài một cái thiết bị nào hết á. vậy là hộ nguyễn văn trưởng đúng không ạ đúng rồi nhưng mà nói giải quyết cho bên em để tăng cái công suất tới giờ em cũng chưa thấy có ngày hôm qua có anh kia anh tới anh đem cho bọn em một cái hợp đồng em ký. nhưng mà hiện thời bên em cũng chưa có được tăng nữa thì bây giờ là nó đang có báo rồi sao ngày 03/12 đã được chuyển về điện lực họ chị là nhân viên đã tiếp nhận thông tin và đang hỗ trợ hò vẫn đang trong quá trình. đấy ạ thôi dò miết mà trong vòng ba ngày làm việc không tính thứ 7 chủ nhật à ờ thì ngày hôm qua có một anh đã đem cho em cái hợp đồng ký rồi đó chị. à nhưng mà ngày hôm nay thì hiện thời bây giờ là bên em đang bị bật nữa rồi cho nên chị báo về đó lại bật giúp em đi ạ dạ là em ghi nhận thông tin và chuyển này là phải nhân viên.bên hỗ trợ ạ dạ rồi em cám ơn chị nhiều ạ còn hợp đồng thì em đã ký rồi dạ cám ơn chị dạ rồi dạ rồi dạ dạ.', 1);
INSERT INTO `files` VALUES (17, '6631749559644129000.txt', 'nhà danh số bốn mươi tám ngọc hồi xin nghe cho anh hỏi cái cái anh có cái a cái viettel pay đấy. dạ bắn tiền đấy chứ ư anh tại sao cái cầm đấy việt theo bay là vẫn còn tiền mà không không chuyển đi được nhỉ. em kiểm tra cho anh cái. dạ tức là anh chuyển thanh toán bằng viettel bay. à đúng rồi phản ánh được. có nghĩa là khó chuyển được nhưng mà còn còn ít tiền nó muốn chuyển đi mà không chuyển được.tức là hà anh xác nhận thanh toán là đã chuyển nhân. không có nghĩa là bây giờ nhà anh chuyển chuyển thì chuyển không một lần hai ba lần nhưng còn có nghĩa là giờ vẫn còn tiền nhưng lại muốn chuyển nốt không truyền được. à tức là anh thanh toán viettel pay thì không thanh toán được không ạ đúng hông anh. cứ kiểm tra cho anh cái xem cái hệ thống nó thế nào mà nhè về chỉ vào này nếu như anh có sử dụng viettel bay thì anh có thể liên hệ lại với đơn vị hệ thống viettel để kiểm tra lại thông tin này giúp anh nha.dạ viettel thì số điện thoại gì thế nào. à là anh có thể liên hệ lại 1080 để kiểm tra lại được thông tin này giúp anh nha.dạ 01080 ạ trước số tổng đài anh bấm mã vùng khu vực của khách hàng anh.dạ đúng ạ.', 1);
INSERT INTO `files` VALUES (18, '6631749808752232175.txt', 'dạ cái số bảy tám hả phan xin nghe ạ. à chị ơi chị kiểm tra lại giúp em cái a tỉ số điện cũ với tỷ số cũ với chỉ số mới của tháng 1 á em đọc cái mã khách hàng ý. dạ anh vui lòng cung cấp mã khách hàng giúp em ạ 1507. db1507 phải không ạ. dạ bt1507 rồi dạ bao nhiêu đó anh. 005. 2033. 2033 khách hàng là nhà công vụ. không còn công an tỉnh bà rịa vũng tàu phải không ạ. chị số cũ và chỉ số mấy không anh. chủ cũ với tỷ số mới của tháng 11 nhá dạ tháng 11 số số cũ là.dạ chị số cũ là 2274 dạ em xin lỗi. bây giờ là chỉ số mới là chỉ số cũ em thấy ở đây là khách hàng sử dụng là công tơ. bà giá phải không ạ. vậy em chờ máy giúp em để em mở ra thông tin hóa đơn lên em kiểm tra thông tin này.thanh toán là nó không đưa hóa đơn trực tiếp ạ. bây giờ giờ bình thường thì một tháng mười một hai không mười tám giờ bình thường chỉ số mới là. 7602. chủ cũ nhà chị số cũ là 7471.một số mới chị số mới là 7602.dạ ờ một à. chì một tháng mười một hai không mười tám nha. một là từ ngày bao nhiêu ạ dạ từ ngày bốn tháng mười hai không mười tám tới ngày ba tháng mười hai hai không mười tám.mười. tháng 10 đến ngày mùng ba tháng năm tháng mười một đúng không dạ đúng rồi anh. chờ chưa anh.dạ cái này là của tháng 11 à thế đúng rồi anh.thịnh còn cái tháng 12 đã có chưa có nghĩa là từ này mùng 03/11 đến. dạ có rồi anh. đọc cho em luôn cái số nữa với. bây giờ anh cần hỗ trợ thông tin chị số mới chỉ số cũ của dạ hiện tại chị số mà em vừa cung cấp cho anh là chỉ mới có của. vô bình thường thôi nha anh em đọc tiếp giờ cao điểm nha anh. của kỳ 01/11 phương nha dạ chị số cũ là 2233.chị số mới ở nhà 2274.giờ thấp điểm là 3701.chị số mới của giờ thấp điểm là 3776.rồi chưa anh. 3776.rồi tổng sản lượng của 3 giờ. là chỉ số cũ là. 13406.chị số mới là 13654.rồi chưa anh. dạ rồi bây giờ em đọc tiếp của tháng a mười hai phải không anh. có nghĩa là từ cái ngày mùng. chị ngày mùng 3.dạ chị ngày hôm nay này. dạ bây giờ từ ngày 04/11 tới ngày 03/12 ghi lại giúp em. vào bình thường chỉ số cũ là 7602. khu chị số mới nhà 7763.mà giờ cao điểm. chị số cũ là 2274. chị cho má nhạc 2333.chị số cũ giờ thấp điểm là 3776.chị số mới là 3857.rồi vậy anh dạ bây giờ em hỗ trợ thêm a thông tin tổng sản lượng luôn nha anh. tổng sản lượng của khách hàng của kỳ một tháng mười hai hai không mười tám. dạ là. chị số cũ là 13654. chị số mới là 13953.vậy anh còn cần hỗ trợ thông tin gì nữa không anh.dạ vậy em cám ơn anh liên hệ trung tâm chờ nè.Upload audioAudio nameOKList audioAudio 6631750173824452348Audio 6631749877471708917Audio 6631749868881774323Audio 6631749808752232175Audio 6631749559644129000Audio 6631749546759227110Audio 6631749417910208226Audio 6631749267586352860Audio 6631749143032301273Audio 6631749095787661015Audio 6631748923988969171Audio 6631748816614786767Audio 6631748790844982989Audio 6631748661995964105', 1);
INSERT INTO `files` VALUES (19, '6631749868881774323.txt', 'số 103 rưỡi xin nghe. ừ em ơi cho chị hỏi là bây giờ mình muốn a đăng ký ơ số điện thoại để báo tiền điện vô a điện thoại á. dạ vẫn thấy đăng ký sao em vui lòng cho em biết là chị đang ở huyện tỉnh thành phố nam ạ ở quận ba giắc. giờ vắt chị vui lòng liên hệ tổng đài thành phố chí minh giúp em 1900545454 để được hỗ trợ.à 1900545454 hả dạ vâng rồi rồi cám ơn em cảm ơn chị liên hệ tổng đài xin chào chị.', 1);
INSERT INTO `files` VALUES (20, '6631749877471708917.txt', 'dạ em số không bảy hoàng lê xin nghe. à dạ hồi nãy anh mới địa chỉ anh mới hết tiền rồi a điện ngoài tủ miền bắc rồi đấy chị. dạ là ở ngoài đồng hồ điện nguyễn mất hiện luôn đúng không anh à giờ anh rút điện anh đang coi nó chớp chớp chớp chớp hoài cũ á. hiện tại là còn chớp hay là mất điện thẳng ạ giờ mất cưng giấc mất luôn rồi nó điện ngay nhà anh thôi để anh nói dưới xong chứ em hỏi. đồng hồ điện qua nay đứng tên vợ. nguyễn thị hoa á ngay chỗ 40 á anh ở xã nào hay phường nào ạ. xã xà bang.sao ba đức á. dạ xã ba châu đức bà rịa bình tân á. dạ vui lòng giữ máy em kiểm tra thông tin hỗ trợ. dạ rồi anh hấp nào của xã xà bang nè anh. có xe bắc một.khách hàng nguyễn thị hoa ở ấp xà bang một đúng rồi. tính tiền tháng vừa rồi của anh là bao nhiêu vậy hoặc anh có đang giữ hóa đơn điện nó không mà có thể đọc giúp em mã khách hàng được không anh tại vì khách hàng nguyễn thị hoa ở xà bang một. em đang tốt lắm nhiều khách hàng.à vâng có nhớ anh đâu có cầm bên này đâu mà anh nhớ được anh nói tổ bao nhiêu ạ. tổ bốn mươi bốn bốn mươi ờ chiều đi báo kiểu để em dở tin nhớ đọc nha thôi. do mình nhớ được mà nhớ vui lòng chứ không hỏi nếu được mật liên hệ lại gặp anh tên gì ạ. bên hậu vậy rồi nó không có thu lộc liên hệ lại giúp em dạ rồi liên hệ số này nha dạ không quá hai tiếng. rồi rồi dạ.cám ơn liên hệ trung tâm chưa anh.', 1);
INSERT INTO `files` VALUES (21, '6631750173824452348.txt', 'chắc thế chắc chín nhiệm xích nghe. à mà chị a cái điện bị hư rồi sửa được không chị. bị hư là mất tiền kiếm một hò hay xung quanh khu vực có khách hàng là mất điện không ạ. không mà mật khẩu anh em à. dạ mất tiền một hồi đã kiểm tra cầu gia hòa seri tổng dưới đồng hồ điện của điện lực có bật lên bật xuống gì chưa anh. cái a đỏ bụp cái mất đi điện cho luôn. dạ hiện tại đồng hồ điện của điện lực đang có trong nhà hay bà triệu quân ạ. ở trong nhà chị ơi. dạ cầu dao hồi seri tổng dưới đồng hồ điện của điện lực đang bực lên hay bật xuống à.hắn cũng đỏ không anh tắt luôn rồi. tivi bật xuống hay sao anh hay là vẫn còn một giao á chị. dạ đúng rồi kiểu chờ. còn giao a. là bật xuống chứ không à. mà nó không có điện đó. bây giờ đang ở trạng thái off hay lon ạ hay bật xuống hay bật lên anh.thì à hôm mới nổi lên tắt luôn rồi giao luôn rồi.dạ bây giờ vui lòng bật cầu dao lên lại giúp em xem trong nhà của anh có điện hay không ạ. không chị ơi hoặc rồi không có đó. tầm hồi có còn tín hiệu nó sáng đèn gì không anh. không chị. vầng vui lòng cung cấp tên và địa chỉ cụ thể nơi đang mất điện để điện lực kiểm tra sửa chữa. ở a cầu đê hai ở kiên giang ấy chị. vui lòng cung cấp tên và địa chỉ cụ thể của hộ gia đình anh giúp em để điện lực có thông tin sửa chữa. à nguyễn đệ. địa chỉ trên giấy báo tiền điện hiện đang ở đâu ạ. à chị giang chị ơi. dạ kiên giang là tỉnh một tỉnh sẽ có rất nhiều khách hàng khác nhau. ở huyện cờ hòa tỉnh kiên giang nè vui lòng bảo cắt cho em và địa chỉ cụ thể trên giấy báo điện giúp em để điện lực có thông tin địa chỉ nhà anh đến sửa chữa. à ý là 4 / 12 chiều. chị hiểu hai á.vầng. xã vĩnh hòa hưng bắc ấy không anh. đúng rồi chị liên hệ sửa chữa gặp anh tên gì vậy anh. tin để chị ơi vui lòng để điện thoại nhấc máy trong vòng hai tiếng điện lực sẽ có nhân viên liên hệ để sửa chữa.ừ dạ cám ơn đã liên hệ trong tâm chờ.', 1);

-- ----------------------------
-- Table structure for files_content
-- ----------------------------
DROP TABLE IF EXISTS `files_content`;
CREATE TABLE `files_content`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `content` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `sentiment` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 407 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of files_content
-- ----------------------------
INSERT INTO `files_content` VALUES (1, '6631748382823089848.txt', 'chín số tám mươi ba kim hoàng xin nghe ạ chị cho hỏi là đồng nai anh ngắt điện đằng gió to được không', 0);
INSERT INTO `files_content` VALUES (2, '6631748382823089848.txt', 'à em tra cứu được mất tiền hay sao anh à bị phường á mất liền nó chừng nào lên á anh tính hỏi á nó nhớ phương hoa phường quyết thắng', 0);
INSERT INTO `files_content` VALUES (3, '6631748382823089848.txt', 'số điện thoại khách hàng là nguyễn thái thịnh ngô minh đúng rồi', 0);
INSERT INTO `files_content` VALUES (4, '6631748382823089848.txt', 'phường quyết thắng khu vực của anh hiện tại trên giữ máy trong giây lát nha liên hòa hai phường quyết thắng em chưa nhận được thông tin ở khu vực này gặp sự cố hoặc mất lâu chưa anh', 0);
INSERT INTO `files_content` VALUES (5, '6631748382823089848.txt', 'mất cũng ba tiếng rồi ba tiếng rồi hả anh', 0);
INSERT INTO `files_content` VALUES (6, '6631748382823089848.txt', 'xong nguyên khu vực khoa luôn hay là chỉ riêng nhà anh thôi à cũng miết nó không có ra ngoài đường nữa không biết nhưng mà chắc nó không rành nữa tại vì nhà lên tao có sửa ra đi không', 0);
INSERT INTO `files_content` VALUES (7, '6631748382823089848.txt', 'anh kiểm tra giúp em tivi trong nhà không có bị bật xuống không anh', 0);
INSERT INTO `files_content` VALUES (8, '6631748382823089848.txt', 'thế rồi để em báo kỹ thuật xuống kiểm tra nhà anh trước nha liên hệ số điện thoại này gặp anh tên gì không long', 0);
INSERT INTO `files_content` VALUES (9, '6631748382823089848.txt', 'anh đông á anh rồi thì nhân viên liên hệ lại nghe máy giúp em thời gian hỗ trợ xong mới là hai tiếng kể từ khi báo trung tâm nha', 0);
INSERT INTO `files_content` VALUES (10, '6631748382823089848.txt', 'à dạ minh coi có ai có liên hệ lại anh để biết nữa dạ rồi em nói anh hiểu rồi cám ơn anh liên hệ kiểm tâm chào anh ạ', 0);
INSERT INTO `files_content` VALUES (11, '6631748400002959034.txt', 'danh số 309 lê kim sinh nghe có gì anh cho em hỏi làm sao chứ nhà em nó bị cắt điện nè chị', 0);
INSERT INTO `files_content` VALUES (12, '6631748400002959034.txt', 'mất điện chỉ riêng nhà chị hay toàn khu vực điện mất điện chị dạ không đê một nhà em thôi vui lòng cung cấp giúp em sơn trên giây lát đi nghỉ nhờ chị là ai đứng tên về à', 0);
INSERT INTO `files_content` VALUES (13, '6631748400002959034.txt', 'dạ à nghi là để em coi lại cái đã dạ thì kiếm dạ vậy vậy chị giữ máy đi chị nhận máy đi dạ', 0);
INSERT INTO `files_content` VALUES (14, '6631748400002959034.txt', 'dạ là', 0);
INSERT INTO `files_content` VALUES (15, '6631748400002959034.txt', 'thùy trang', 0);
INSERT INTO `files_content` VALUES (16, '6631748400002959034.txt', 'sao lại đấu liên doanh', 0);
INSERT INTO `files_content` VALUES (17, '6631748400002959034.txt', 'hộ kinh doanh nguyễn thị thùy trang ở xã huyện nào ạ dạ đông hòa dĩ an bình dương', 0);
INSERT INTO `files_content` VALUES (18, '6631748400002959034.txt', 'năm mươi mốt xẹt ba quốc lộ một k nha khu phố đông phường đông hòa thuộc dĩ an bình dương đúng hông ạ', 0);
INSERT INTO `files_content` VALUES (19, '6631748400002959034.txt', 'mức địa chỉ riêng nhà chị chị kiểm tra giúp em xi bi hoặc cầu dao dưới đồng hồ điện đen mở hay đang tắt rồi à', 0);
INSERT INTO `files_content` VALUES (20, '6631748400002959034.txt', 'dạ không là như vậy là hồi sáng có hai anh nào tới hỏi bưu điện mà nói là đóng trên điện vẫn đầy đủ ngồi nhưng mà', 0);
INSERT INTO `files_content` VALUES (21, '6631748400002959034.txt', 'đi kiếm cái hộp điện làm sai gì đó rồi không có rồi đi ra rồi bây giờ là mất điện á', 0);
INSERT INTO `files_content` VALUES (22, '6631748400002959034.txt', 'dạ chị tìm giúp em là dưới đồng hồ điện có cầu dao hoặc là seri chị nhìn giúp em là gạt lên hay giờ xuống về à', 0);
INSERT INTO `files_content` VALUES (23, '6631748400002959034.txt', 'dạ chờ em một xíu chị ạ', 1);
INSERT INTO `files_content` VALUES (24, '6631748400002959034.txt', 'dạ em đang nhờ em tí', 1);
INSERT INTO `files_content` VALUES (25, '6631748400002959034.txt', 'à', 0);
INSERT INTO `files_content` VALUES (26, '6631748400002959034.txt', 'em cũng không biết em không rành cái này nữa để kêu chồng em em coi thử coi sao cái đã dạ địa chỉ của chị có phải là thửa đất 320 khu phố đông a phường đông hòa không chị', 0);
INSERT INTO `files_content` VALUES (27, '6631748400002959034.txt', 'hai mươi mốt xẹt ba năm mươi mốt xẹt ba đà địa chỉ mới đúng không ạ ở đây em chỉ thấy hộ kinh doanh nguyễn thị thùy trang một hộ', 0);
INSERT INTO `files_content` VALUES (28, '6631748400002959034.txt', 'là thủ dây gì ở 5200 phố đông an', 0);
INSERT INTO `files_content` VALUES (29, '6631748400002959034.txt', 'anh ơi', 0);
INSERT INTO `files_content` VALUES (30, '6631748400002959034.txt', 'anh ra coi cái cầu dao ý vậy là nó cúp hay là nó mở vậy', 0);
INSERT INTO `files_content` VALUES (31, '6631748400002959034.txt', 'cầu dao lốc nè', 0);
INSERT INTO `files_content` VALUES (32, '6631748400002959034.txt', 'chị giữ máy đi nó chọc em coi rồi em nói lại cho dạ', 0);
INSERT INTO `files_content` VALUES (33, '6631748400002959034.txt', 'đây này hoàn thành ấy', 0);
INSERT INTO `files_content` VALUES (34, '6631748400002959034.txt', 'nó là nó đang túc hay nó đang mở', 0);
INSERT INTO `files_content` VALUES (35, '6631748400002959034.txt', 'bên nhà nè', 1);
INSERT INTO `files_content` VALUES (36, '6631748400002959034.txt', 'xem cái bởi vì nè', 1);
INSERT INTO `files_content` VALUES (37, '6631748400002959034.txt', 'đang có phòng anh mở lên coi', 0);
INSERT INTO `files_content` VALUES (38, '6631748400002959034.txt', 'à nó nó gà xuống luôn nhưng mà mở giờ mở lên là không được luôn chị dạ chị không thể mở lên đúng không ạ vui lòng rút hết tất cả các thiết bị điện trong nhà ra giúp em sau đó mở lại chứ không có điện không à', 0);
INSERT INTO `files_content` VALUES (39, '6631748400002959034.txt', 'rút hết chết mày điện á hả chị biết sao hông tại vì ở đây là mát xa con xê xông hơi giờ rút ra là rút hết bao nhiêu cái sao mà lúc được', 0);
INSERT INTO `files_content` VALUES (40, '6631748400002959034.txt', 'vì có thể là các thiết bị điện trong nhà đang chặn chập dẫn đến là xi bi gạt xuống để bảo vệ đường dây đó chị à', 0);
INSERT INTO `files_content` VALUES (41, '6631748400002959034.txt', 'chị vui lòng kiểm tra hết các thiết bị điện trong nhà giúp em xem có chạm chập hay không sau đó mở sim đi lại có điện nghe không ạ nếu có điện chị vui lòng kiểm tra các thiết bị điện không có điện chị vui lòng liên hệ lại để được hỗ trợ sửa chữa giúp em ạ', 0);
INSERT INTO `files_content` VALUES (42, '6631748400002959034.txt', 'dạ dạ dạ dạ cám ơn chị liên hệ trung tâm chào chị à', 0);
INSERT INTO `files_content` VALUES (43, '6631748400002959034.txt', 'anh gà thoát cái', 0);
INSERT INTO `files_content` VALUES (44, '6631748558916748990.txt', 'danh số bảy chín thới an xin nghe ạ', 0);
INSERT INTO `files_content` VALUES (45, '6631748558916748990.txt', 'ờ cho tôi hỏi a phú lệ xe cúp điện bấy giờ có hả', 0);
INSERT INTO `files_content` VALUES (46, '6631748558916748990.txt', 'dạ khu vực này thuộc ở châu thành tiền giang đúng hông chị', 0);
INSERT INTO `files_content` VALUES (47, '6631748558916748990.txt', 'dạ hiện nay a', 0);
INSERT INTO `files_content` VALUES (48, '6631748558916748990.txt', 'khu vực này là thuộc huyện phú khiết', 0);
INSERT INTO `files_content` VALUES (49, '6631748558916748990.txt', 'dạ dự kiến tại khu vực này là 14 giờ có điện trở lại nha chị là 2 giờ', 0);
INSERT INTO `files_content` VALUES (50, '6631748558916748990.txt', 'dạ rồi dạ', 0);
INSERT INTO `files_content` VALUES (51, '6631748558916748990.txt', 'mình cám ơn chị liên hệ trung tâm em', 1);
INSERT INTO `files_content` VALUES (52, '6631748571801650880.txt', 'danh số 55 hà xuân nghe ờ cái a ở vĩnh bình á ấp lộc hiệp bữa nào cúp điện a cưng đâu quên', 0);
INSERT INTO `files_content` VALUES (53, '6631748571801650880.txt', 'anh là khách hàng đặng văn minh địa chỉ là 383 xẹt năm ấp lộc hiệp xã vĩnh bình phú ninh lộc chờ lát đúng hông anh', 0);
INSERT INTO `files_content` VALUES (54, '6631748571801650880.txt', 'dạ cám ơn đúng rồi dạ em kiểm tra hệ thống là ngày hôm nay khu vực dự kiến là chưa có lịch công tác tuy nhiên là anh đang báo mất điện hay sao ạ', 0);
INSERT INTO `files_content` VALUES (55, '6631748571801650880.txt', 'số điện hỏi thăm coi bữa nào cúp điện vậy đó dạ em kiểm tra hệ thống nè dự kiến năm ngày tới chưa có lịch công tác ngoài đường sự cố ạ', 0);
INSERT INTO `files_content` VALUES (56, '6631748571801650880.txt', 'ờ vậy hổm có nói ơ nghe thông báo nghe hổng được rồi có người hướng dẫn ơ cũng toàn điện lực nhờ cũng gắn giùm nhắn thu bữa thứ 6 thứ 7 gì tui quên', 0);
INSERT INTO `files_content` VALUES (57, '6631748571801650880.txt', 'em kiểm tra hệ thống này dự kiến năm ngày tới là chưa có lịch công tác mọi sự sự cố xảy ra nha', 0);
INSERT INTO `files_content` VALUES (58, '6631748571801650880.txt', 'coi như năm ngày tới là không năm ngày tới là hồi cúp á hả dạ đúng rồi anh dự kiến năm ngày tới anh giữ máy dùm em giây lát tuy nhiên là anh có nhận được', 0);
INSERT INTO `files_content` VALUES (59, '6631748571801650880.txt', 'tin nhắn á', 0);
INSERT INTO `files_content` VALUES (60, '6631748571801650880.txt', 'vào à', 0);
INSERT INTO `files_content` VALUES (61, '6631748571801650880.txt', 'ngày 29/11 đúng không ạ ờ', 0);
INSERT INTO `files_content` VALUES (62, '6631748571801650880.txt', 'đang có báo nhận được thông báo lịch ngừng giảm cung cấp điện bắt đầu từ 7 giờ sáng ngày mùng 08/12 đến 17 giờ chiều đúng hông anh', 0);
INSERT INTO `files_content` VALUES (63, '6631748571801650880.txt', 'dạ trường hợp trên thì em sẽ ghi nhận là yêu cầu của anh và chuyển lại điện lực kiểm tra chủ động phản hồi lại trong vòng à', 0);
INSERT INTO `files_content` VALUES (64, '6631748571801650880.txt', 'hai tiếng nha', 1);
INSERT INTO `files_content` VALUES (65, '6631748571801650880.txt', 'ờ vì vậy là chút nữa mới biết kết quả hai tiếng nữa nếu cứng quá là thứ 6 thứ 7000 sắp tới ha ý là phê chủ động liên hệ lại rồi phản hồi thông tin này chưa anh trong vòng hai tiếng ạ', 0);
INSERT INTO `files_content` VALUES (66, '6631748571801650880.txt', 'khi cần trợ giúp về lại qua số di động anh gọi gặp anh tên gì anh', 0);
INSERT INTO `files_content` VALUES (67, '6631748571801650880.txt', 'trần minh đặng minh nè dạ dielac liên hệ lại anh minh vui lòng nghe máy giùm em nha', 1);
INSERT INTO `files_content` VALUES (68, '6631748571801650880.txt', 'rồi rồi cám ơn dạ em cảm ơn anh liên hệ thằng tâm xin chào ạ', 1);
INSERT INTO `files_content` VALUES (69, '6631748584686552770.txt', 'dạ em số không bảy ngày nay xin nghe', 0);
INSERT INTO `files_content` VALUES (70, '6631748584686552770.txt', 'dạ chị ơi em hỏi cái nhà em nó xài để chín ba em xài chín đó chị', 1);
INSERT INTO `files_content` VALUES (71, '6631748584686552770.txt', 'dạ mà em xài ké á ờ nãy cái anh hướng dẫn cho đồng hồ sao chị', 0);
INSERT INTO `files_content` VALUES (72, '6631748584686552770.txt', 'ở đây em thấy lúc nãy là anh phương đề nghị kiểm tra công tơ điện đúng không ạ dạ đúng rồi chị', 0);
INSERT INTO `files_content` VALUES (73, '6631748584686552770.txt', 'bây giờ anh muốn kiểm tra là ở ngoài đồng hồ anh kiểm tra rồi mà ảnh ghé là mình xài điện ké á là', 0);
INSERT INTO `files_content` VALUES (74, '6631748584686552770.txt', 'dậy mình sài nhiều là cái phí lên vậy đó', 0);
INSERT INTO `files_content` VALUES (75, '6631748584686552770.txt', 'nhưng mà hắn kêu là nếu mà xài điên ké thì ấn chỉ số tổng đài điện để mà gắn đồng hồ đó chị', 0);
INSERT INTO `files_content` VALUES (76, '6631748584686552770.txt', 'là bây giờ anh muốn gắn công tơ điện để sử dụng', 0);
INSERT INTO `files_content` VALUES (77, '6631748584686552770.txt', 'hay là ăn muốn tăng định mức ở hộ khách hàng này anh', 0);
INSERT INTO `files_content` VALUES (78, '6631748584686552770.txt', 'dạ ý là em hỏi là cái a anh nói là gắn đồng hồ xài ké mà nhà em bên nhà ông phương á', 0);
INSERT INTO `files_content` VALUES (79, '6631748584686552770.txt', 'vẫn a hồi nhà em sao nó xài ké mình điện mình hồng phương', 0);
INSERT INTO `files_content` VALUES (80, '6631748584686552770.txt', 'là anh hướng dẫn anh anh', 0);
INSERT INTO `files_content` VALUES (81, '6631748584686552770.txt', 'dạ anh kỹ thuật viên nãy anh nãy giờ anh anh anh nói anh chị nó nói chị', 0);
INSERT INTO `files_content` VALUES (82, '6631748584686552770.txt', 'nó chỉ hết số này nè em mới điện hỏi coi', 0);
INSERT INTO `files_content` VALUES (83, '6631748584686552770.txt', 'tại vì ở đây em thấy số điện thoại của anh khách quan là khách hàng dương văn phương', 0);
INSERT INTO `files_content` VALUES (84, '6631748584686552770.txt', 'ờ ai đúng ai của xuân lộc thị lúc nãy có đề nghị kiểm tra công tơ điện còn ở đây là anh đề nghị là tăng định mức', 0);
INSERT INTO `files_content` VALUES (85, '6631748584686552770.txt', 'để em sử dụng chung của huế phát hàng dương văn phương này luôn đúng không anh dạ đúng rồi dạ dạ nếu không anh muốn tăng lên nút ở tại điểm này thì vui lòng cho em hỏi anh có sổ hộ khẩu tại điểm đề nghị được không ạ', 0);
INSERT INTO `files_content` VALUES (86, '6631748584686552770.txt', 'dạ có chị nếu vậy anh đi chuẩn bị sẵn giúp em sổ hộ khẩu của người muốn tăng thêm định mức kèm theo khách hàng dương quang phương mà chứng minh của khách hàng', 0);
INSERT INTO `files_content` VALUES (87, '6631748584686552770.txt', 'dương văn phương này thì đừng lộc sẽ hỗ trợ cấp định mức chanh sử dụng', 0);
INSERT INTO `files_content` VALUES (88, '6631748584686552770.txt', 'dạ cái số tốn tiền gì không chị dạ không còn ngày không có tốn phí đâu anh', 0);
INSERT INTO `files_content` VALUES (89, '6631748584686552770.txt', 'à load mà họ cho mình luôn chị hả ở đây là không điện lực không có lắp công tơ điện cho anh anh tại vì ở đây là anh muốn dùng chung định mức thì điện lực hay tính lâu nay là hộ khách hàng này', 0);
INSERT INTO `files_content` VALUES (90, '6631748584686552770.txt', 'dương văn phương này hiện tại là định mức là đang một hộ anh đề nghị cấp em để mất thì điện lực sẽ đến hỗ trợ cấp thêm cho anh một định mức còn với định mức của hồ dương quang phương này thì anh phải có được số hộ là hai hồ', 0);
INSERT INTO `files_content` VALUES (91, '6631748584686552770.txt', 'thế công tơ phụ gắn phía sau này là anh phải tự mua ngoài thị trường hoàng anh gắn thôi', 0);
INSERT INTO `files_content` VALUES (92, '6631748584686552770.txt', 'còn nếu mà anh muốn gắn công tơ điện để sử dụng riêng thì lúc đó điện lực mới gắn một công tơ riêng cho anh', 0);
INSERT INTO `files_content` VALUES (93, '6631748584686552770.txt', 'ờ thế không phải là cắp định mức chung với khách hàng dương văn phương này', 0);
INSERT INTO `files_content` VALUES (94, '6631748584686552770.txt', 'rồi rồi vậy cám ơn chị dạ là anh chưa hỏi như vậy thôi có muốn em tiếp nhận thông tin luôn ạ dạ dạ để em hỏi nha chị dạ dạ rồi', 0);
INSERT INTO `files_content` VALUES (95, '6631748584686552770.txt', 'anh không hỗ trợ tên nào nữa không ạ chứ không ấy chị', 0);
INSERT INTO `files_content` VALUES (96, '6631748584686552770.txt', 'dạ cám ơn liên hệ trung tâm chào anh cám ơn chị dạ', 1);
INSERT INTO `files_content` VALUES (97, '6631748606161389253.txt', 'dạ số ba mươi lăm anh tuấn sinh nga', 0);
INSERT INTO `files_content` VALUES (98, '6631748606161389253.txt', 'có điện a ngay chỗ trường hưng a hưng về chợ bến tranh nó nhiên cúp điện rồi chừng nào có vậy anh', 0);
INSERT INTO `files_content` VALUES (99, '6631748606161389253.txt', 'dạ nó xã huyện nào anh lương hòa lạc á dạ nếu xã lương hòa lạc thì đáng sự cố và xã lương hòa lạc dự kiến là 14 giờ sẽ có điện lại nên thông cảm rồi', 0);
INSERT INTO `files_content` VALUES (100, '6631748606161389253.txt', 'rồi rồi dạ anh cần hỗ trợ nữa không à không không dạ tóm lại trung tâm hoặc em xin chào anh ạ', 0);
INSERT INTO `files_content` VALUES (101, '6631748661995964105.txt', 'dạ dạ số chín sáu kim ngưu xin nghe', 0);
INSERT INTO `files_content` VALUES (102, '6631748661995964105.txt', 'à chị ơi em ở bên chỗ cái hộ kinh doanh huyền chỉ có đó chị dạ ơ nhờ bên em á có cái đợt hai ơ dưới cái đường ba của tháng 11 chưa có đóng điện á nãy', 0);
INSERT INTO `files_content` VALUES (103, '6631748661995964105.txt', 'thế mẹ ăn chú nghe tại vì hồi hồi nãy mẹ nó xuống á kêu ơ đóng điện bên em ơ tại vì là không có đóng tiền điện á em kêu mấy anh chờ em chút xíu đi đóng rồi có gì em điện em đưa lại hóa đơn nó đánh coi', 0);
INSERT INTO `files_content` VALUES (104, '6631748661995964105.txt', 'thế a mẹ anh kêu ừ cái em chưa có bị tới nữa em đóng điện xuống rồi bây giờ nhà chị cho em cái số điện liên lạc với cái bên mà bị đóng điện lên đó chị', 0);
INSERT INTO `files_content` VALUES (105, '6631748661995964105.txt', 'chị xác nhận cho hộ kinh doanh rồi chỉ có đúng không ạ dạ đúng rồi ạ cách đây 10 phút chị có liên hệ xác nhận chi phí đóng cáp đúng không ạ', 0);
INSERT INTO `files_content` VALUES (106, '6631748661995964105.txt', 'đúng rồi đúng rồi dạ thông tin điện lực vẫn đang tiếp nhận và vẫn đang trong quá trình hỗ trợ được chị', 0);
INSERT INTO `files_content` VALUES (107, '6631748661995964105.txt', 'dạ chị thông cảm đợi giúp em ạ không quá một ngày làm việc điện lực sẽ liên hệ phản hồi ạ', 0);
INSERT INTO `files_content` VALUES (108, '6631748661995964105.txt', 'mất một ngày á chị dạ vâng ạ thông tin của chị trong một ngày làm việc ạ', 0);
INSERT INTO `files_content` VALUES (109, '6631748661995964105.txt', 'hiện tại là chị đã thanh toán tiền nợ chưa ạ', 0);
INSERT INTO `files_content` VALUES (110, '6631748661995964105.txt', 'em đi đóng rồi em kêu mấy anh ơ kêu á mấy anh xuống kêu cắt điện em nói là đợi em đi đóng đi rồi có về có gì về em đưa a', 0);
INSERT INTO `files_content` VALUES (111, '6631748661995964105.txt', 'đưa cái cái hóa đơn trên đấy chúng tôi cái em vừa đi cái mẹ ở nhà cúp điện luôn không có chở em về tới luôn', 0);
INSERT INTO `files_content` VALUES (112, '6631748661995964105.txt', 'dạ chị thông cảm giúp em ạ anh theo quy định là chị đâu quá hạn thanh toán á chị', 0);
INSERT INTO `files_content` VALUES (113, '6631748661995964105.txt', 'em biết rồi nhưng mà em đã nói với nay anh là chờ em chút xíu em đi đóng cái em về liền rồi em đưa đưa cái phiếu cho mấy ảnh coi mà làm cái gì mà kêu ừ rồi làm gì mà tự nhiên cái', 0);
INSERT INTO `files_content` VALUES (114, '6631748661995964105.txt', 'em đi chứ ở nhà cúp vậy đó', 0);
INSERT INTO `files_content` VALUES (115, '6631748661995964105.txt', 'dạ lúc nãy là chị đâu có liên hệ anh tại là do là chị đã bị mất điện quá hạn á hay là chỉ cần phải thanh toán chi phí đóng cắt', 0);
INSERT INTO `files_content` VALUES (116, '6631748661995964105.txt', 'thì chị thông cảm đợi giúp em trong một ngày làm việc để luật sẽ liên hệ lại thông báo chị phi đóng cáp ạ để chị thanh toán sau đó mới cấp điện lại được ạ', 0);
INSERT INTO `files_content` VALUES (117, '6631748661995964105.txt', 'mình thanh toán em đi đâu thanh toán gì dạ chị thanh toán phải trực tiếp điện lực hoặc là chuyển khoản đó chị chi phí đóng cáp thì không thể thanh toán qua điểm thu hộ được ạ', 0);
INSERT INTO `files_content` VALUES (118, '6631748661995964105.txt', 'vậy bây giờ chị cho em cái tài khoản đi chừng nào có được á thì em chuyển qua luôn', 0);
INSERT INTO `files_content` VALUES (119, '6631748661995964105.txt', 'dạ chị cần tài khoản của ngân hàng nào ạ', 0);
INSERT INTO `files_content` VALUES (120, '6631748661995964105.txt', 'tra phong banh ý chị', 0);
INSERT INTO `files_content` VALUES (121, '6631748661995964105.txt', 'dạ sacombank của chi nhánh đức hòa long đúng không ạ đúng rồi ạ', 0);
INSERT INTO `files_content` VALUES (122, '6631748661995964105.txt', 'dạ chị ghi nhận lại giúp em', 0);
INSERT INTO `files_content` VALUES (123, '6631748661995964105.txt', 'rồi thì đặt đi dạ xa cam man số tài khoản của phòng giao dịch đức hòa là 0700', 0);
INSERT INTO `files_content` VALUES (124, '6631748661995964105.txt', 'rồi', 0);
INSERT INTO `files_content` VALUES (125, '6631748661995964105.txt', 'dạ 557', 0);
INSERT INTO `files_content` VALUES (126, '6631748661995964105.txt', 'dạ 11771 ạ', 0);
INSERT INTO `files_content` VALUES (127, '6631748661995964105.txt', 'một một mấy dạ máy bẩy một', 0);
INSERT INTO `files_content` VALUES (128, '6631748661995964105.txt', 'em đọc lại con 700557 nhiêu nữa chị dạ 0700', 0);
INSERT INTO `files_content` VALUES (129, '6631748661995964105.txt', '55711771 ạ', 0);
INSERT INTO `files_content` VALUES (130, '6631748661995964105.txt', 'vậy giờ làm xong tới chừng nào mà bên kia báo xuống là em đóng tiền cho đây là là là bên đó xuống đây làm sao vậy à sau khi chị thanh toán được chi phí đóng cắt rồi thì chị liên hệ lại trung tâm giúp em', 0);
INSERT INTO `files_content` VALUES (131, '6631748661995964105.txt', 'liên hệ trung tâm nào chị số này hay là nào số điện thoại này đó chị', 0);
INSERT INTO `files_content` VALUES (132, '6631748661995964105.txt', 'cái dây a cái cái cái báo cắt ư cái này ai ai sẽ liên lạc cho em', 0);
INSERT INTO `files_content` VALUES (133, '6631748661995964105.txt', 'dạ điện luật sẽ liên hệ trực tiếp với chị đâu thông báo chi phí ạ', 0);
INSERT INTO `files_content` VALUES (134, '6631748661995964105.txt', 'rồi rồi', 0);
INSERT INTO `files_content` VALUES (135, '6631748661995964105.txt', 'dạ vâng chị cần hỗ trợ gì nữa xong ạ', 0);
INSERT INTO `files_content` VALUES (136, '6631748790844982989.txt', 'danh số bốn ba nguyễn linh sinh', 0);
INSERT INTO `files_content` VALUES (137, '6631748790844982989.txt', 'dạ chị ơi cho em hỏi nào sáng mưa này em có đi đóng tiền đó của chị là ngừng cung cấp điện nhà em rồi em đóng rồi mà không biết là có có chừng nào mới có điện lại á chị', 1);
INSERT INTO `files_content` VALUES (138, '6631748790844982989.txt', 'địa chỉ của em là ba', 0);
INSERT INTO `files_content` VALUES (139, '6631748790844982989.txt', '34520 tự phước ạ', 0);
INSERT INTO `files_content` VALUES (140, '6631748790844982989.txt', 'ai là người đứng tên trên hóa đơn điện của nhà anh vì à dạ phan duyệt bình nè em mới đổi lại a em mới đổi lại cái người chủ chủ hộ là em đứng à', 0);
INSERT INTO `files_content` VALUES (141, '6631748790844982989.txt', 'mà đổi tên rồi nhưng mà trên hóa đơn tháng này anh nhận được có phải là phan thiết bình là người đứng tên trên hóa đơn không ạ dạ đúng rồi ạ', 0);
INSERT INTO `files_content` VALUES (142, '6631748790844982989.txt', 'chị ở khu vực ấp thuận phường thành phố nào vậy anh của em ấy là là ở a', 0);
INSERT INTO `files_content` VALUES (143, '6631748790844982989.txt', 'phường 11 á', 0);
INSERT INTO `files_content` VALUES (144, '6631748790844982989.txt', 'thành phố đà lạt á ạ', 0);
INSERT INTO `files_content` VALUES (145, '6631748790844982989.txt', 'anh vui lòng giữ máy em kiểm tra thông tin của anh ạ', 0);
INSERT INTO `files_content` VALUES (146, '6631748790844982989.txt', 'dạ cám ơn anh đã giữ máy cho em xác nhận một thông tin á là anh xuống điện lực thanh toán luôn hay sao ạ dạ em em đã xuống rồi thanh toán xong hết rồi à rồi', 0);
INSERT INTO `files_content` VALUES (147, '6631748790844982989.txt', 'nhưng anh đã thanh toán kim chi phí đóng cắt điện chưa vì anh dạ đúng xong luôn à chị dạ', 0);
INSERT INTO `files_content` VALUES (148, '6631748790844982989.txt', 'thông tin của anh em đã ghi nhận rồi thời gian hỗ trợ có nghi lộc là tối đa trong vòng hai tiếng nhân viên người luật sẽ cố gắng liên hệ và xuống mở điện lại cho anh mong anh thông cảm á', 0);
INSERT INTO `files_content` VALUES (149, '6631748790844982989.txt', 'dạ dạ dạ dạ có dạ em cám ơn chị nghen dạ khi nhân viên điện lực liên hệ thì anh nhớ chuối điện thoại bắt máy giúp em được hỗ trợ sớm ạ', 0);
INSERT INTO `files_content` VALUES (150, '6631748790844982989.txt', 'dạ dạ rồi ạ dạ sao nó cần hỗ trợ thêm thông tin gì nữa không ạ dạ không ạ em cám ơn ạ dạ cám ơn anh đã liên hệ trung tâm chợ ạ', 0);
INSERT INTO `files_content` VALUES (151, '6631748790844982989.txt', 'dạ dạ', 0);
INSERT INTO `files_content` VALUES (152, '6631748816614786767.txt', 'em thấy xuân chính nguyễn xuân nghe', 1);
INSERT INTO `files_content` VALUES (153, '6631748816614786767.txt', 'chị cho ờ cho hỏi là là là cái tên cái tin nhắn vô vô cái báo điện trong điện thoại là là', 0);
INSERT INTO `files_content` VALUES (154, '6631748816614786767.txt', 'à chị hay là ai vậy', 0);
INSERT INTO `files_content` VALUES (155, '6631748816614786767.txt', 'tin nhắn thông báo gì vậy anh', 0);
INSERT INTO `files_content` VALUES (156, '6631748816614786767.txt', 'thông báo mà tiền điện hay cúp điện đồ qua trong cái điện thoại nè còn nhắn sao không à nhắn trước lần cho ta biết chứ đây mình đồ nó hư hết trơn à', 0);
INSERT INTO `files_content` VALUES (157, '6631748816614786767.txt', 'giờ nó mới nhắn nguồn à hồi sáu tây ha tháng 12 nè là cúp điện mà giờ mới ngắn mà', 0);
INSERT INTO `files_content` VALUES (158, '6631748816614786767.txt', 'bắt đầu 5 giờ tới 7 giờ đồ nó hư hết trơn ngắn ngắn trước chứ sao tự nhiên toàn nhắn sau không à', 0);
INSERT INTO `files_content` VALUES (159, '6631748816614786767.txt', 'dạ khách hàng đang gọi là vấn đề nguyễn văn đông phải không anh đúng rồi đúng rồi lộn mày quyết', 0);
INSERT INTO `files_content` VALUES (160, '6631748816614786767.txt', 'khu 251', 0);
INSERT INTO `files_content` VALUES (161, '6631748816614786767.txt', 'dạ rồi mai mốt á chị', 0);
INSERT INTO `files_content` VALUES (162, '6631748816614786767.txt', 'nhớ là ai mà ai mà nhắn trong điện thoại viên nhắn trước giùm bữa nha', 0);
INSERT INTO `files_content` VALUES (163, '6631748816614786767.txt', 'đang nắng nắng bít ơ bây giờ mình tính đến nó về nó ấy rồi cái nhắn trễ không à dạ', 0);
INSERT INTO `files_content` VALUES (164, '6631748816614786767.txt', 'vui lòng kiểm tra lại thông tin giúp em ạ điện lực thông báo gửi tin nhắn cho anh ngày hôm qua là ngày 05/12 chứ không phải ngày hôm nay điện lực mới nhắn', 0);
INSERT INTO `files_content` VALUES (165, '6631748816614786767.txt', 'ủa mà sao mà mà mà mà nó báo ơ nó mới vừa báo á', 0);
INSERT INTO `files_content` VALUES (166, '6631748816614786767.txt', 'anh đọc lại tin nhắn giúp em điện lực có báo kính gửi khách hàng lò bánh mì nguyễn văn dương có mã khách hàng bê bê không bốn năm sáu không không bốn', 0);
INSERT INTO `files_content` VALUES (167, '6631748816614786767.txt', 'điện lực tân nguyên sinh thông báo thời gian vui lòng nghe em đọc hết ca tin nhắn của điện lực ạ ở lập tân uyên sinh thông báo thời gian ngừng giảm cung cấp', 0);
INSERT INTO `files_content` VALUES (168, '6631748816614786767.txt', 'điện tại trụ hai trăm năm mươi mốt tỷ ba thái hòa khu phố vĩnh phước phường thái hòa tân uyên bình dương vào lúc 5 giờ sáng ngày 06/12', 0);
INSERT INTO `files_content` VALUES (169, '6631748816614786767.txt', 'chị kiếm có điện trở lại vào lúc 7 giờ sáng lý do sửa chữa điện rất mong quý khách hàng thông cảm ngày thông báo ngày năm tháng mười một mười hai', 0);
INSERT INTO `files_content` VALUES (170, '6631748816614786767.txt', 'dạ xin lỗi chín mong quý khách hàng thông cảm ngày 05/12/2018 trân trọng có nghĩa là ngày 05/12/2018 là điện lực', 0);
INSERT INTO `files_content` VALUES (171, '6631748816614786767.txt', 'gửi tin nhắn cho anh cúp điện ngày mùng 6 chứ không phải là điện lực mới gửi hôm nay vui lòng kiểm tra và đọc hết tin nhắn giúp em thông báo giúp em', 0);
INSERT INTO `files_content` VALUES (172, '6631748816614786767.txt', 'lúc đó điện lực cũng thông báo gửi tin nhắn trước một ngày chứ không có gửi tin nhắn cùng ngày', 0);
INSERT INTO `files_content` VALUES (173, '6631748816614786767.txt', 'xong rồi 07/11 điện lực thông báo là mất điện trung tâm xin nghe', 0);
INSERT INTO `files_content` VALUES (174, '6631748816614786767.txt', 'à mà mà ủa mà mà mà sao cái điện thoại này nó vô xanh', 0);
INSERT INTO `files_content` VALUES (175, '6631748816614786767.txt', 'vấn đề này anh kiểm tra lại điện thoại của anh cho tín hiệu điện thoại của anh chứ không phải là tín hiệu điện thoại của điện lực và tin nhắn từ điện lực điện lực thông báo đã gửi trước cho anh một ngày rồi', 0);
INSERT INTO `files_content` VALUES (176, '6631748816614786767.txt', 'nãy giờ nó đấy đấy đấy coi lại coi', 0);
INSERT INTO `files_content` VALUES (177, '6631748816614786767.txt', 'anh cần hỗ trợ thông tin gì nữa phải không ạ', 0);
INSERT INTO `files_content` VALUES (178, '6631748923988969171.txt', 'chị vĩnh phước a sớm giờ xin nghe ạ', 1);
INSERT INTO `files_content` VALUES (179, '6631748923988969171.txt', 'alo chị ơi cho em hỏi là cái hộ mà trần quang tư á hay sao mà chú đóng tiền điện kịp mà cắt hả chị', 0);
INSERT INTO `files_content` VALUES (180, '6631748923988969171.txt', 'chắc vậy hả khách hàng đăng ký bưu điện tên gì ạ', 0);
INSERT INTO `files_content` VALUES (181, '6631748923988969171.txt', 'trần quang tư trần văn tư ạ đúng rồi ở ấp tân thuận châu khánh á', 0);
INSERT INTO `files_content` VALUES (182, '6631748923988969171.txt', 'xã huyện nào vậy em', 1);
INSERT INTO `files_content` VALUES (183, '6631748923988969171.txt', 'à ấp hai xã châu khánh huyện long phú huyện sóc trăng', 0);
INSERT INTO `files_content` VALUES (184, '6631748923988969171.txt', 'cũng làm giữ máy kiểm tra thông tin ạ', 0);
INSERT INTO `files_content` VALUES (185, '6631748923988969171.txt', 'dạ xin lỗi giữ máy lâu ạ hiện tại anh có trên dự giấy báo tiền điện nó không anh', 0);
INSERT INTO `files_content` VALUES (186, '6631748923988969171.txt', 'dạ dạ anh cứ đi gửi giấy báo tiền điện nữa hay không ạ', 0);
INSERT INTO `files_content` VALUES (187, '6631748923988969171.txt', 'giữ không chị số tiền mười đã đã đóng số tiền bao nhiêu anh có biết không ạ', 0);
INSERT INTO `files_content` VALUES (188, '6631748923988969171.txt', 'cũng như là bà lá ba đi a còn mắc đi làm giờ không bắt có nhà rồi bà bỏ nhà đi rồi còn thiếu đâu anh', 0);
INSERT INTO `files_content` VALUES (189, '6631748923988969171.txt', 'khách hàng mốt ngàn ba trăm bốn chục đồng rồi nhân viên là cắt rồi chị cắt điện nè nếu trường hợp khách hàng chưa thanh toán tiền điện thì được á điện lại đúng không anh quá thời gian quy định thì đường thị tuyết hằng thất điện thôi ạ', 0);
INSERT INTO `files_content` VALUES (190, '6631748923988969171.txt', 'dạ dạ muốn ra gắn lại là sao chị anh thanh toán tiền điện còn chi phí đóng cắc giúp em ạ', 0);
INSERT INTO `files_content` VALUES (191, '6631748923988969171.txt', 'đóng rồi mở ra gờ gán hả chị dạ đúng rồi anh ngày 1810 tiếng mà', 0);
INSERT INTO `files_content` VALUES (192, '6631748923988969171.txt', 'anh đến trực tiếp tại điện lực thanh toán giúp em ạ bốn bốn dạ rồi ý là phải báo với điện lực là nó bị cắt liền nhanh đi lực thu thêm chi phí đóng cắt ạ', 0);
INSERT INTO `files_content` VALUES (193, '6631748923988969171.txt', 'dạ rồi dạ', 0);
INSERT INTO `files_content` VALUES (194, '6631748923988969171.txt', 'thao tác trên này cần em hỗ trợ thông tin nào khác không ạ xong chị dạ có nếu liên hệ trung tâm chưa anh', 0);
INSERT INTO `files_content` VALUES (195, '6631749095787661015.txt', 'dạ số 335 anh tuấn anh nghe đâu', 0);
INSERT INTO `files_content` VALUES (196, '6631749095787661015.txt', 'dạ thôi anh ơi dạ tôi khách hàng ờ chỗ tổ năm xe chỗ hiểu á', 0);
INSERT INTO `files_content` VALUES (197, '6631749095787661015.txt', 'hết hạn là phải là nguyễn hữu thuế ấp đồng ở long thành đồng nai đúng không ạ à đúng rồi tức là có cái nghị trung tâm là lúc a', 0);
INSERT INTO `files_content` VALUES (198, '6631749095787661015.txt', '12 giờ 27 phút có để xóa phút đó anh lại vấn đề đúng rồi hợp đồng ý cho điện lực trồng trụ cao thuế trên thủ đức của nhà mình đúng không ạ đúng rồi do cái cột cũ bây giờ đổ bê tông nó tôi không đồng ý đổ bê tông nữa', 0);
INSERT INTO `files_content` VALUES (199, '6631749095787661015.txt', 'dạ yêu cầu sẽ tiếp nhận là để chắc kiểm tra phản hồi cho anh sớm anh yên tâm à', 1);
INSERT INTO `files_content` VALUES (200, '6631749095787661015.txt', '0 giờ giờ thay thì không người ta đổ bê tông', 0);
INSERT INTO `files_content` VALUES (201, '6631749095787661015.txt', 'à đấu vào trong là sao anh', 0);
INSERT INTO `files_content` VALUES (202, '6631749095787661015.txt', 'đổ chân cột cũ ư ờ trận phục cũ á', 0);
INSERT INTO `files_content` VALUES (203, '6631749095787661015.txt', 'thế là bây giờ anh muốn điện lực phản hồi hay là anh hủy yêu cầu nè anh', 0);
INSERT INTO `files_content` VALUES (204, '6631749095787661015.txt', 'bảo nghĩ thế đổ bê tông', 0);
INSERT INTO `files_content` VALUES (205, '6631749095787661015.txt', 'anh ạ anh báo đổ bê tông là sao em chưa hiểu anh nói có nghĩa bây giờ ủa trinh cột cũ á đỗ chân cục cũ với a cái trần cục cũ á', 0);
INSERT INTO `files_content` VALUES (206, '6631749095787661015.txt', 'là bây giờ nó mất về vấn đề gì mày điện ở hộ này anh hộ nguyễn hữu thuế nè anh', 0);
INSERT INTO `files_content` VALUES (207, '6631749095787661015.txt', 'ủa nằm trong đất tôi ơ mất a gần hai mét', 0);
INSERT INTO `files_content` VALUES (208, '6631749095787661015.txt', 'cước rồi bây giờ anh không đồng ý với điện lực là trồng trụ điện có được chứ anh nhà anh của anh đúng không à', 0);
INSERT INTO `files_content` VALUES (209, '6631749095787661015.txt', 'trong trong ấy không được đổ bê tông nữa', 0);
INSERT INTO `files_content` VALUES (210, '6631749095787661015.txt', 'qua nguyễn trọng dòng đỗ bên hông là sao em chưa hiểu anh ừ', 0);
INSERT INTO `files_content` VALUES (211, '6631749095787661015.txt', 'còn cứ cột cột mới chồng không được trọng ấy nhá', 0);
INSERT INTO `files_content` VALUES (212, '6631749095787661015.txt', 'thế là bây giờ anh không đồng ý có được trồng trụ mới của điện lực tranh đức nhà anh đúng không à ờ đúng đúng rồi dạ yêu cầu coi đã tiếp nhận rồi anh được không anh sẽ phản hồi cho anh sớm anh yên tâm à', 0);
INSERT INTO `files_content` VALUES (213, '6631749095787661015.txt', 'ờ hình như không a cái này bên tư nhân làm phải không', 0);
INSERT INTO `files_content` VALUES (214, '6631749095787661015.txt', 'dạ còn vấn đề do tư nhân hay do điện lực thi công á anh thì sẽ kiểm tra phản hồi cho anh nữa à', 0);
INSERT INTO `files_content` VALUES (215, '6631749095787661015.txt', 'ừ thế này là tư nhân nó làm', 0);
INSERT INTO `files_content` VALUES (216, '6631749095787661015.txt', 'nhưng mà theo điện là thằng nào hè hay là của điện lực à', 0);
INSERT INTO `files_content` VALUES (217, '6631749095787661015.txt', 'khách hàng tư nhân á', 0);
INSERT INTO `files_content` VALUES (218, '6631749095787661015.txt', 'chứ không phải bên công ty điện lực', 0);
INSERT INTO `files_content` VALUES (219, '6631749095787661015.txt', 'dạ nếu trụ điện của khách hàng', 0);
INSERT INTO `files_content` VALUES (220, '6631749095787661015.txt', 'cổng kia nó thu nhỏ đó ở trục ừ còng có rắc ơ nhà anh', 0);
INSERT INTO `files_content` VALUES (221, '6631749095787661015.txt', 'ví dụ điện của khách hàng nhà khác trồng trên đất của anh thì anh vui lòng liên hệ với a chính quyền địa phương xã tà đây xuống xử lý anh đi là không có ở trụ điện của khách hàng là mong anh thông cảm rồi', 0);
INSERT INTO `files_content` VALUES (222, '6631749095787661015.txt', 'bây giờ là 10 triệu chính vô phải không dạ lấn tới phòng kinh tế hạ tầng á anh phòng địa chính á anh', 0);
INSERT INTO `files_content` VALUES (223, '6631749095787661015.txt', 'đinh thị xã được không dạ đúng rồi anh thanh toán qua số điện thoại của địa phương mình đó anh họ sẽ biết cho anh nè', 0);
INSERT INTO `files_content` VALUES (224, '6631749095787661015.txt', 'rồi rồi rồi', 0);
INSERT INTO `files_content` VALUES (225, '6631749095787661015.txt', 'cắm vào nhá dạ cảm ơn liên hệ trung tâm em xin chào anh tưởng lấy ngày', 0);
INSERT INTO `files_content` VALUES (226, '6631749095787661015.txt', 'dạ nếu không còn vấn đề gì khác em nhấc máy trước', 0);
INSERT INTO `files_content` VALUES (227, '6631749143032301273.txt', 'danh số bảy chín thúy an xin nghe ạ', 0);
INSERT INTO `files_content` VALUES (228, '6631749143032301273.txt', 'à chị ơi a', 0);
INSERT INTO `files_content` VALUES (229, '6631749143032301273.txt', 'em a gì à', 1);
INSERT INTO `files_content` VALUES (230, '6631749143032301273.txt', 'hủy xanh thì chỉ có ai kêu vô sửa điện giùm em với chị dạ cho em hỏi là hiện nay là anh mất điện riêng nhà anh hay là nhiều nhà', 0);
INSERT INTO `files_content` VALUES (231, '6631749143032301273.txt', 'à ghim nhà em à cái nhà dạ cho em hỏi tên khách hàng à trên hóa đơn điện của nhà anh là tên gì ạ à khánh xanh', 0);
INSERT INTO `files_content` VALUES (232, '6631749143032301273.txt', 'thạnh săn nhà khu vực này là phường xã hai thị trấn nào anh', 0);
INSERT INTO `files_content` VALUES (233, '6631749143032301273.txt', 'hoàng sóc', 0);
INSERT INTO `files_content` VALUES (234, '6631749143032301273.txt', 'ấp hoàng sóc xã gì ạ dạ xã ô sơm thổ sơn dạ', 0);
INSERT INTO `files_content` VALUES (235, '6631749143032301273.txt', 'thuộc định lực ờ huyện nào ạ', 1);
INSERT INTO `files_content` VALUES (236, '6631749143032301273.txt', 'huyện hòn đất hoàng đắc dạ', 0);
INSERT INTO `files_content` VALUES (237, '6631749143032301273.txt', 'anh kiểm tra giúp em xi bi hay cầu dao dưới đồng hồ của điện lực á bị gạt xuống không anh', 0);
INSERT INTO `files_content` VALUES (238, '6631749143032301273.txt', 'dạ không a xê bênh cơ không có bị dạ thổ xã thổ sơn đúng hông anh', 0);
INSERT INTO `files_content` VALUES (239, '6631749143032301273.txt', 'dạ đúng rồi dạ', 0);
INSERT INTO `files_content` VALUES (240, '6631749143032301273.txt', 'hiện nay về thông tin mất điện tại vị trí nhà anh em xin được phép tiếp nhận để nhờ nhân viên điện lực hòn đá hỗ trợ tại đây ạ về thời gian xử lý tại nhà trong vòng hai tiếng trước khi đến nhân viên sẽ gọi trước cho anh', 0);
INSERT INTO `files_content` VALUES (241, '6631749143032301273.txt', 'anh vui lòng nghe máy giùm em ạ chứ em hỏi là liên hệ gặp anh tên gì được ạ', 0);
INSERT INTO `files_content` VALUES (242, '6631749143032301273.txt', 'à trọng anh trọng dạ qua số di động này luôn đúng hông anh dạ đúng rồi dạ vâng ạ cám ơn anh trọng liên hệ đến trung tâm em xin chào anh ạ', 0);
INSERT INTO `files_content` VALUES (243, '6631749267586352860.txt', 'dạ dạ số bảy tám chu văn sinh nghi à', 0);
INSERT INTO `files_content` VALUES (244, '6631749267586352860.txt', 'ủa chị ơi cho em hỏi trên chỗ xà bang cốc chỗ an bị ờ điện điện ngoài chủ nó không vô chị ơi chớp chớp chớp vậy đó', 0);
INSERT INTO `files_content` VALUES (245, '6631749267586352860.txt', 'cắn mất điện một à anh bị điện áp chập chờn không ổn định phải không anh', 0);
INSERT INTO `files_content` VALUES (246, '6631749267586352860.txt', 'thì à điện không điện mà giờ nó cúp luôn rồi trong nhà em á ngay diễn ông vô đồng hồ ngay cái trụ ở ngoài á dạ vậy là mất điện hoàn toàn luôn', 0);
INSERT INTO `files_content` VALUES (247, '6631749267586352860.txt', 'chị cầu dao dưới đồng hồ điện dạ được cầu dao ý đồng hồ điện hộ anh có đang bật lên không anh', 0);
INSERT INTO `files_content` VALUES (248, '6631749417910208226.txt', 'tại vì số muốn làm tài xin nghe', 0);
INSERT INTO `files_content` VALUES (249, '6631749417910208226.txt', 'à em ơi cho anh hỏi mà bên điện lực của thị xã ngã năm chưa em', 0);
INSERT INTO `files_content` VALUES (250, '6631749417910208226.txt', 'dạ đây liên hệ với tổng đài điện lực miền nam bao gồm cả ngã năm', 0);
INSERT INTO `files_content` VALUES (251, '6631749417910208226.txt', 'ờ mà tại vì bên cái chỗ mà khóm ba phường một ở nhà cũng không đổi cho thằng hoàng nó có bị điện nó bị hư á em nhờ vô sửa chữa mà anh không biết anh bấm đại số này nè', 0);
INSERT INTO `files_content` VALUES (252, '6631749417910208226.txt', 'dạ hiện tại thì anh thấy lâm một một nhà anh đến mức điện đúng phải không đúng rồi nhà một nhà đó nhà cũng đổi văn hoàng á đường khóm ba phường một á', 0);
INSERT INTO `files_content` VALUES (253, '6631749417910208226.txt', 'dạ đường kênh vĩnh long á anh dạ anh thấy là chữ kênh dưới đồng hồ điện có bị bật xuống không anh', 0);
INSERT INTO `files_content` VALUES (254, '6631749417910208226.txt', 'nó nó bật bây giờ nó làm như nó hư hết trơn chỗ bật luôn rồi', 0);
INSERT INTO `files_content` VALUES (255, '6631749417910208226.txt', 'thế là anh thấy bật xuống không ạ ờ bật xuống mà bật bật lên ở nhã chứ bật lên nó nhảy xuống mà giờ nó hư luôn nó không có nó không còn bật nữa', 0);
INSERT INTO `files_content` VALUES (256, '6631749417910208226.txt', 'dạ nhờ nhờ sửa chữa giùm anh', 0);
INSERT INTO `files_content` VALUES (257, '6631749417910208226.txt', 'rồi bây giờ anh thử rút hết thiết bị điện trong nhà ra sau đó anh bật lên lại xem được không', 0);
INSERT INTO `files_content` VALUES (258, '6631749417910208226.txt', 'rồi rút hết trơn thiết bị trong nhà ra hết rồi giờ bật lên gần vừa bật lên nó không nhảy luôn nó không có điện luôn', 0);
INSERT INTO `files_content` VALUES (259, '6631749417910208226.txt', 'để em chuyển cái địa lịch ngã năm ngã năm để anh kiểm tra và xử lý anh trường hợp mất điện ở nhà trước khoảng hai tiếng dạ rồi rồi rồi cám ơn anh vâng thế điện lực đó liên hệ lại gặp anh', 0);
INSERT INTO `files_content` VALUES (260, '6631749417910208226.txt', 'hoàng ạ', 0);
INSERT INTO `files_content` VALUES (261, '6631749546759227110.txt', 'ờ chị ơi em ở một trăm ba ba nguyễn đáng á chị dạ bữa hổm em có báo về cái vụ mất điện ở chỗ em á tức là cái seri bên em á', 0);
INSERT INTO `files_content` VALUES (262, '6631749546759227110.txt', 'là rất là nhiều hộ xài chung một cái xê bê đó nhưng mà tại sao mà cứ chỗ em bật hoài trong khi hiện giờ em đang không có xài một cái thiết bị nào hết á', 0);
INSERT INTO `files_content` VALUES (263, '6631749546759227110.txt', 'vậy là hộ nguyễn văn trưởng đúng không ạ đúng rồi nhưng mà nói giải quyết cho bên em để tăng cái công suất tới giờ em cũng chưa thấy có ngày hôm qua có anh kia anh tới anh đem cho bọn em một cái hợp đồng em ký', 0);
INSERT INTO `files_content` VALUES (264, '6631749546759227110.txt', 'nhưng mà hiện thời bên em cũng chưa có được tăng nữa thì bây giờ là nó đang có báo rồi sao ngày 03/12 đã được chuyển về điện lực họ chị là nhân viên đã tiếp nhận thông tin và đang hỗ trợ hò vẫn đang trong quá trình', 0);
INSERT INTO `files_content` VALUES (265, '6631749546759227110.txt', 'đấy ạ thôi dò miết mà trong vòng ba ngày làm việc không tính thứ 7 chủ nhật à ờ thì ngày hôm qua có một anh đã đem cho em cái hợp đồng ký rồi đó chị', 0);
INSERT INTO `files_content` VALUES (266, '6631749546759227110.txt', 'à nhưng mà ngày hôm nay thì hiện thời bây giờ là bên em đang bị bật nữa rồi cho nên chị báo về đó lại bật giúp em đi ạ dạ là em ghi nhận thông tin và chuyển này là phải nhân viên', 0);
INSERT INTO `files_content` VALUES (267, '6631749546759227110.txt', 'bên hỗ trợ ạ dạ rồi em cám ơn chị nhiều ạ còn hợp đồng thì em đã ký rồi dạ cám ơn chị dạ rồi dạ rồi dạ dạ', 1);
INSERT INTO `files_content` VALUES (268, '6631749559644129000.txt', 'nhà danh số bốn mươi tám ngọc hồi xin nghe cho anh hỏi cái cái anh có cái a cái viettel pay đấy', 0);
INSERT INTO `files_content` VALUES (269, '6631749559644129000.txt', 'dạ bắn tiền đấy chứ ư anh tại sao cái cầm đấy việt theo bay là vẫn còn tiền mà không không chuyển đi được nhỉ', 0);
INSERT INTO `files_content` VALUES (270, '6631749559644129000.txt', 'em kiểm tra cho anh cái', 0);
INSERT INTO `files_content` VALUES (271, '6631749559644129000.txt', 'dạ tức là anh chuyển thanh toán bằng viettel bay', 0);
INSERT INTO `files_content` VALUES (272, '6631749559644129000.txt', 'à đúng rồi phản ánh được', 0);
INSERT INTO `files_content` VALUES (273, '6631749559644129000.txt', 'có nghĩa là khó chuyển được nhưng mà còn còn ít tiền nó muốn chuyển đi mà không chuyển được', 0);
INSERT INTO `files_content` VALUES (274, '6631749559644129000.txt', 'tức là hà anh xác nhận thanh toán là đã chuyển nhân', 0);
INSERT INTO `files_content` VALUES (275, '6631749559644129000.txt', 'không có nghĩa là bây giờ nhà anh chuyển chuyển thì chuyển không một lần hai ba lần nhưng còn có nghĩa là giờ vẫn còn tiền nhưng lại muốn chuyển nốt không truyền được', 0);
INSERT INTO `files_content` VALUES (276, '6631749559644129000.txt', 'à tức là anh thanh toán viettel pay thì không thanh toán được không ạ đúng hông anh', 0);
INSERT INTO `files_content` VALUES (277, '6631749559644129000.txt', 'cứ kiểm tra cho anh cái xem cái hệ thống nó thế nào mà nhè về chỉ vào này nếu như anh có sử dụng viettel bay thì anh có thể liên hệ lại với đơn vị hệ thống viettel để kiểm tra lại thông tin này giúp anh nha', 0);
INSERT INTO `files_content` VALUES (278, '6631749559644129000.txt', 'dạ viettel thì số điện thoại gì thế nào', 0);
INSERT INTO `files_content` VALUES (279, '6631749559644129000.txt', 'à là anh có thể liên hệ lại 1080 để kiểm tra lại được thông tin này giúp anh nha', 0);
INSERT INTO `files_content` VALUES (280, '6631749559644129000.txt', 'dạ 01080 ạ trước số tổng đài anh bấm mã vùng khu vực của khách hàng anh', 0);
INSERT INTO `files_content` VALUES (281, '6631749559644129000.txt', 'dạ đúng ạ', 1);
INSERT INTO `files_content` VALUES (282, '6631749808752232175.txt', 'dạ cái số bảy tám hả phan xin nghe ạ', 0);
INSERT INTO `files_content` VALUES (283, '6631749808752232175.txt', 'à chị ơi chị kiểm tra lại giúp em cái a tỉ số điện cũ với tỷ số cũ với chỉ số mới của tháng 1 á em đọc cái mã khách hàng ý', 0);
INSERT INTO `files_content` VALUES (284, '6631749808752232175.txt', 'dạ anh vui lòng cung cấp mã khách hàng giúp em ạ 1507', 0);
INSERT INTO `files_content` VALUES (285, '6631749808752232175.txt', 'db1507 phải không ạ', 0);
INSERT INTO `files_content` VALUES (286, '6631749808752232175.txt', 'dạ bt1507 rồi dạ bao nhiêu đó anh', 0);
INSERT INTO `files_content` VALUES (287, '6631749808752232175.txt', '005', 0);
INSERT INTO `files_content` VALUES (288, '6631749808752232175.txt', '2033', 0);
INSERT INTO `files_content` VALUES (289, '6631749808752232175.txt', '2033 khách hàng là nhà công vụ', 0);
INSERT INTO `files_content` VALUES (290, '6631749808752232175.txt', 'không còn công an tỉnh bà rịa vũng tàu phải không ạ', 0);
INSERT INTO `files_content` VALUES (291, '6631749808752232175.txt', 'chị số cũ và chỉ số mấy không anh', 0);
INSERT INTO `files_content` VALUES (292, '6631749808752232175.txt', 'chủ cũ với tỷ số mới của tháng 11 nhá dạ tháng 11 số số cũ là', 0);
INSERT INTO `files_content` VALUES (293, '6631749808752232175.txt', 'dạ chị số cũ là 2274 dạ em xin lỗi', 0);
INSERT INTO `files_content` VALUES (294, '6631749808752232175.txt', 'bây giờ là chỉ số mới là chỉ số cũ em thấy ở đây là khách hàng sử dụng là công tơ', 0);
INSERT INTO `files_content` VALUES (295, '6631749808752232175.txt', 'bà giá phải không ạ', 0);
INSERT INTO `files_content` VALUES (296, '6631749808752232175.txt', 'vậy em chờ máy giúp em để em mở ra thông tin hóa đơn lên em kiểm tra thông tin này', 0);
INSERT INTO `files_content` VALUES (297, '6631749808752232175.txt', 'thanh toán là nó không đưa hóa đơn trực tiếp ạ', 0);
INSERT INTO `files_content` VALUES (298, '6631749808752232175.txt', 'bây giờ giờ bình thường thì một tháng mười một hai không mười tám giờ bình thường chỉ số mới là', 0);
INSERT INTO `files_content` VALUES (299, '6631749808752232175.txt', '7602', 0);
INSERT INTO `files_content` VALUES (300, '6631749808752232175.txt', 'chủ cũ nhà chị số cũ là 7471', 0);
INSERT INTO `files_content` VALUES (301, '6631749808752232175.txt', 'một số mới chị số mới là 7602', 0);
INSERT INTO `files_content` VALUES (302, '6631749808752232175.txt', 'dạ ờ một à', 0);
INSERT INTO `files_content` VALUES (303, '6631749808752232175.txt', 'chì một tháng mười một hai không mười tám nha', 0);
INSERT INTO `files_content` VALUES (304, '6631749808752232175.txt', 'một là từ ngày bao nhiêu ạ dạ từ ngày bốn tháng mười hai không mười tám tới ngày ba tháng mười hai hai không mười tám', 0);
INSERT INTO `files_content` VALUES (305, '6631749808752232175.txt', 'mười', 0);
INSERT INTO `files_content` VALUES (306, '6631749808752232175.txt', 'tháng 10 đến ngày mùng ba tháng năm tháng mười một đúng không dạ đúng rồi anh', 0);
INSERT INTO `files_content` VALUES (307, '6631749808752232175.txt', 'chờ chưa anh', 0);
INSERT INTO `files_content` VALUES (308, '6631749808752232175.txt', 'dạ cái này là của tháng 11 à thế đúng rồi anh', 0);
INSERT INTO `files_content` VALUES (309, '6631749808752232175.txt', 'thịnh còn cái tháng 12 đã có chưa có nghĩa là từ này mùng 03/11 đến', 0);
INSERT INTO `files_content` VALUES (310, '6631749808752232175.txt', 'dạ có rồi anh', 0);
INSERT INTO `files_content` VALUES (311, '6631749808752232175.txt', 'đọc cho em luôn cái số nữa với', 0);
INSERT INTO `files_content` VALUES (312, '6631749808752232175.txt', 'bây giờ anh cần hỗ trợ thông tin chị số mới chỉ số cũ của dạ hiện tại chị số mà em vừa cung cấp cho anh là chỉ mới có của', 0);
INSERT INTO `files_content` VALUES (313, '6631749808752232175.txt', 'vô bình thường thôi nha anh em đọc tiếp giờ cao điểm nha anh', 0);
INSERT INTO `files_content` VALUES (314, '6631749808752232175.txt', 'của kỳ 01/11 phương nha dạ chị số cũ là 2233', 0);
INSERT INTO `files_content` VALUES (315, '6631749808752232175.txt', 'chị số mới ở nhà 2274', 0);
INSERT INTO `files_content` VALUES (316, '6631749808752232175.txt', 'giờ thấp điểm là 3701', 0);
INSERT INTO `files_content` VALUES (317, '6631749808752232175.txt', 'chị số mới của giờ thấp điểm là 3776', 0);
INSERT INTO `files_content` VALUES (318, '6631749808752232175.txt', 'rồi chưa anh', 0);
INSERT INTO `files_content` VALUES (319, '6631749808752232175.txt', '3776', 0);
INSERT INTO `files_content` VALUES (320, '6631749808752232175.txt', 'rồi tổng sản lượng của 3 giờ', 0);
INSERT INTO `files_content` VALUES (321, '6631749808752232175.txt', 'là chỉ số cũ là', 0);
INSERT INTO `files_content` VALUES (322, '6631749808752232175.txt', '13406', 0);
INSERT INTO `files_content` VALUES (323, '6631749808752232175.txt', 'chị số mới là 13654', 0);
INSERT INTO `files_content` VALUES (324, '6631749808752232175.txt', 'rồi chưa anh', 0);
INSERT INTO `files_content` VALUES (325, '6631749808752232175.txt', 'dạ rồi bây giờ em đọc tiếp của tháng a mười hai phải không anh', 0);
INSERT INTO `files_content` VALUES (326, '6631749808752232175.txt', 'có nghĩa là từ cái ngày mùng', 0);
INSERT INTO `files_content` VALUES (327, '6631749808752232175.txt', 'chị ngày mùng 3', 0);
INSERT INTO `files_content` VALUES (328, '6631749808752232175.txt', 'dạ chị ngày hôm nay này', 0);
INSERT INTO `files_content` VALUES (329, '6631749808752232175.txt', 'dạ bây giờ từ ngày 04/11 tới ngày 03/12 ghi lại giúp em', 0);
INSERT INTO `files_content` VALUES (330, '6631749808752232175.txt', 'vào bình thường chỉ số cũ là 7602', 0);
INSERT INTO `files_content` VALUES (331, '6631749808752232175.txt', 'khu chị số mới nhà 7763', 0);
INSERT INTO `files_content` VALUES (332, '6631749808752232175.txt', 'mà giờ cao điểm', 0);
INSERT INTO `files_content` VALUES (333, '6631749808752232175.txt', 'chị số cũ là 2274', 0);
INSERT INTO `files_content` VALUES (334, '6631749808752232175.txt', 'chị cho má nhạc 2333', 0);
INSERT INTO `files_content` VALUES (335, '6631749808752232175.txt', 'chị số cũ giờ thấp điểm là 3776', 0);
INSERT INTO `files_content` VALUES (336, '6631749808752232175.txt', 'chị số mới là 3857', 0);
INSERT INTO `files_content` VALUES (337, '6631749808752232175.txt', 'rồi vậy anh dạ bây giờ em hỗ trợ thêm a thông tin tổng sản lượng luôn nha anh', 0);
INSERT INTO `files_content` VALUES (338, '6631749808752232175.txt', 'tổng sản lượng của khách hàng của kỳ một tháng mười hai hai không mười tám', 0);
INSERT INTO `files_content` VALUES (339, '6631749808752232175.txt', 'dạ là', 0);
INSERT INTO `files_content` VALUES (340, '6631749808752232175.txt', 'chị số cũ là 13654', 0);
INSERT INTO `files_content` VALUES (341, '6631749808752232175.txt', 'chị số mới là 13953', 0);
INSERT INTO `files_content` VALUES (342, '6631749808752232175.txt', 'vậy anh còn cần hỗ trợ thông tin gì nữa không anh', 0);
INSERT INTO `files_content` VALUES (343, '6631749808752232175.txt', 'dạ vậy em cám ơn anh liên hệ trung tâm chờ nè', 1);
INSERT INTO `files_content` VALUES (344, '6631749808752232175.txt', 'Upload audioAudio nameOKList audioAudio 6631750173824452348Audio 6631749877471708917Audio 6631749868881774323Audio 6631749808752232175Audio 6631749559644129000Audio 6631749546759227110Audio 6631749417910208226Audio 6631749267586352860Audio 6631749143032301273Audio 6631749095787661015Audio 6631748923988969171Audio 6631748816614786767Audio 6631748790844982989Audio 6631748661995964105', 0);
INSERT INTO `files_content` VALUES (345, '6631749868881774323.txt', 'số 103 rưỡi xin nghe', 0);
INSERT INTO `files_content` VALUES (346, '6631749868881774323.txt', 'ừ em ơi cho chị hỏi là bây giờ mình muốn a đăng ký ơ số điện thoại để báo tiền điện vô a điện thoại á', 0);
INSERT INTO `files_content` VALUES (347, '6631749868881774323.txt', 'dạ vẫn thấy đăng ký sao em vui lòng cho em biết là chị đang ở huyện tỉnh thành phố nam ạ ở quận ba giắc', 1);
INSERT INTO `files_content` VALUES (348, '6631749868881774323.txt', 'giờ vắt chị vui lòng liên hệ tổng đài thành phố chí minh giúp em 1900545454 để được hỗ trợ', 0);
INSERT INTO `files_content` VALUES (349, '6631749868881774323.txt', 'à 1900545454 hả dạ vâng rồi rồi cám ơn em cảm ơn chị liên hệ tổng đài xin chào chị', 1);
INSERT INTO `files_content` VALUES (350, '6631749877471708917.txt', 'dạ em số không bảy hoàng lê xin nghe', 0);
INSERT INTO `files_content` VALUES (351, '6631749877471708917.txt', 'à dạ hồi nãy anh mới địa chỉ anh mới hết tiền rồi a điện ngoài tủ miền bắc rồi đấy chị', 0);
INSERT INTO `files_content` VALUES (352, '6631749877471708917.txt', 'dạ là ở ngoài đồng hồ điện nguyễn mất hiện luôn đúng không anh à giờ anh rút điện anh đang coi nó chớp chớp chớp chớp hoài cũ á', 0);
INSERT INTO `files_content` VALUES (353, '6631749877471708917.txt', 'hiện tại là còn chớp hay là mất điện thẳng ạ giờ mất cưng giấc mất luôn rồi nó điện ngay nhà anh thôi để anh nói dưới xong chứ em hỏi', 0);
INSERT INTO `files_content` VALUES (354, '6631749877471708917.txt', 'đồng hồ điện qua nay đứng tên vợ', 0);
INSERT INTO `files_content` VALUES (355, '6631749877471708917.txt', 'nguyễn thị hoa á ngay chỗ 40 á anh ở xã nào hay phường nào ạ', 0);
INSERT INTO `files_content` VALUES (356, '6631749877471708917.txt', 'xã xà bang', 0);
INSERT INTO `files_content` VALUES (357, '6631749877471708917.txt', 'sao ba đức á', 0);
INSERT INTO `files_content` VALUES (358, '6631749877471708917.txt', 'dạ xã ba châu đức bà rịa bình tân á', 0);
INSERT INTO `files_content` VALUES (359, '6631749877471708917.txt', 'dạ vui lòng giữ máy em kiểm tra thông tin hỗ trợ', 0);
INSERT INTO `files_content` VALUES (360, '6631749877471708917.txt', 'dạ rồi anh hấp nào của xã xà bang nè anh', 0);
INSERT INTO `files_content` VALUES (361, '6631749877471708917.txt', 'có xe bắc một', 0);
INSERT INTO `files_content` VALUES (362, '6631749877471708917.txt', 'khách hàng nguyễn thị hoa ở ấp xà bang một đúng rồi', 0);
INSERT INTO `files_content` VALUES (363, '6631749877471708917.txt', 'tính tiền tháng vừa rồi của anh là bao nhiêu vậy hoặc anh có đang giữ hóa đơn điện nó không mà có thể đọc giúp em mã khách hàng được không anh tại vì khách hàng nguyễn thị hoa ở xà bang một', 0);
INSERT INTO `files_content` VALUES (364, '6631749877471708917.txt', 'em đang tốt lắm nhiều khách hàng', 1);
INSERT INTO `files_content` VALUES (365, '6631749877471708917.txt', 'à vâng có nhớ anh đâu có cầm bên này đâu mà anh nhớ được anh nói tổ bao nhiêu ạ', 0);
INSERT INTO `files_content` VALUES (366, '6631749877471708917.txt', 'tổ bốn mươi bốn bốn mươi ờ chiều đi báo kiểu để em dở tin nhớ đọc nha thôi', 0);
INSERT INTO `files_content` VALUES (367, '6631749877471708917.txt', 'do mình nhớ được mà nhớ vui lòng chứ không hỏi nếu được mật liên hệ lại gặp anh tên gì ạ', 0);
INSERT INTO `files_content` VALUES (368, '6631749877471708917.txt', 'bên hậu vậy rồi nó không có thu lộc liên hệ lại giúp em dạ rồi liên hệ số này nha dạ không quá hai tiếng', 0);
INSERT INTO `files_content` VALUES (369, '6631749877471708917.txt', 'rồi rồi dạ', 0);
INSERT INTO `files_content` VALUES (370, '6631749877471708917.txt', 'cám ơn liên hệ trung tâm chưa anh', 0);
INSERT INTO `files_content` VALUES (371, '6631750173824452348.txt', 'chắc thế chắc chín nhiệm xích nghe', 1);
INSERT INTO `files_content` VALUES (372, '6631750173824452348.txt', 'à mà chị a cái điện bị hư rồi sửa được không chị', 0);
INSERT INTO `files_content` VALUES (373, '6631750173824452348.txt', 'bị hư là mất tiền kiếm một hò hay xung quanh khu vực có khách hàng là mất điện không ạ', 0);
INSERT INTO `files_content` VALUES (374, '6631750173824452348.txt', 'không mà mật khẩu anh em à', 0);
INSERT INTO `files_content` VALUES (375, '6631750173824452348.txt', 'dạ mất tiền một hồi đã kiểm tra cầu gia hòa seri tổng dưới đồng hồ điện của điện lực có bật lên bật xuống gì chưa anh', 0);
INSERT INTO `files_content` VALUES (376, '6631750173824452348.txt', 'cái a đỏ bụp cái mất đi điện cho luôn', 0);
INSERT INTO `files_content` VALUES (377, '6631750173824452348.txt', 'dạ hiện tại đồng hồ điện của điện lực đang có trong nhà hay bà triệu quân ạ', 0);
INSERT INTO `files_content` VALUES (378, '6631750173824452348.txt', 'ở trong nhà chị ơi', 0);
INSERT INTO `files_content` VALUES (379, '6631750173824452348.txt', 'dạ cầu dao hồi seri tổng dưới đồng hồ điện của điện lực đang bực lên hay bật xuống à', 0);
INSERT INTO `files_content` VALUES (380, '6631750173824452348.txt', 'hắn cũng đỏ không anh tắt luôn rồi', 0);
INSERT INTO `files_content` VALUES (381, '6631750173824452348.txt', 'tivi bật xuống hay sao anh hay là vẫn còn một giao á chị', 0);
INSERT INTO `files_content` VALUES (382, '6631750173824452348.txt', 'dạ đúng rồi kiểu chờ', 0);
INSERT INTO `files_content` VALUES (383, '6631750173824452348.txt', 'còn giao a', 0);
INSERT INTO `files_content` VALUES (384, '6631750173824452348.txt', 'là bật xuống chứ không à', 0);
INSERT INTO `files_content` VALUES (385, '6631750173824452348.txt', 'mà nó không có điện đó', 0);
INSERT INTO `files_content` VALUES (386, '6631750173824452348.txt', 'bây giờ đang ở trạng thái off hay lon ạ hay bật xuống hay bật lên anh', 0);
INSERT INTO `files_content` VALUES (387, '6631750173824452348.txt', 'thì à hôm mới nổi lên tắt luôn rồi giao luôn rồi', 0);
INSERT INTO `files_content` VALUES (388, '6631750173824452348.txt', 'dạ bây giờ vui lòng bật cầu dao lên lại giúp em xem trong nhà của anh có điện hay không ạ', 0);
INSERT INTO `files_content` VALUES (389, '6631750173824452348.txt', 'không chị ơi hoặc rồi không có đó', 0);
INSERT INTO `files_content` VALUES (390, '6631750173824452348.txt', 'tầm hồi có còn tín hiệu nó sáng đèn gì không anh', 0);
INSERT INTO `files_content` VALUES (391, '6631750173824452348.txt', 'không chị', 0);
INSERT INTO `files_content` VALUES (392, '6631750173824452348.txt', 'vầng vui lòng cung cấp tên và địa chỉ cụ thể nơi đang mất điện để điện lực kiểm tra sửa chữa', 0);
INSERT INTO `files_content` VALUES (393, '6631750173824452348.txt', 'ở a cầu đê hai ở kiên giang ấy chị', 0);
INSERT INTO `files_content` VALUES (394, '6631750173824452348.txt', 'vui lòng cung cấp tên và địa chỉ cụ thể của hộ gia đình anh giúp em để điện lực có thông tin sửa chữa', 0);
INSERT INTO `files_content` VALUES (395, '6631750173824452348.txt', 'à nguyễn đệ', 0);
INSERT INTO `files_content` VALUES (396, '6631750173824452348.txt', 'địa chỉ trên giấy báo tiền điện hiện đang ở đâu ạ', 0);
INSERT INTO `files_content` VALUES (397, '6631750173824452348.txt', 'à chị giang chị ơi', 0);
INSERT INTO `files_content` VALUES (398, '6631750173824452348.txt', 'dạ kiên giang là tỉnh một tỉnh sẽ có rất nhiều khách hàng khác nhau', 0);
INSERT INTO `files_content` VALUES (399, '6631750173824452348.txt', 'ở huyện cờ hòa tỉnh kiên giang nè vui lòng bảo cắt cho em và địa chỉ cụ thể trên giấy báo điện giúp em để điện lực có thông tin địa chỉ nhà anh đến sửa chữa', 0);
INSERT INTO `files_content` VALUES (400, '6631750173824452348.txt', 'à ý là 4 / 12 chiều', 0);
INSERT INTO `files_content` VALUES (401, '6631750173824452348.txt', 'chị hiểu hai á', 0);
INSERT INTO `files_content` VALUES (402, '6631750173824452348.txt', 'vầng', 0);
INSERT INTO `files_content` VALUES (403, '6631750173824452348.txt', 'xã vĩnh hòa hưng bắc ấy không anh', 0);
INSERT INTO `files_content` VALUES (404, '6631750173824452348.txt', 'đúng rồi chị liên hệ sửa chữa gặp anh tên gì vậy anh', 0);
INSERT INTO `files_content` VALUES (405, '6631750173824452348.txt', 'tin để chị ơi vui lòng để điện thoại nhấc máy trong vòng hai tiếng điện lực sẽ có nhân viên liên hệ để sửa chữa', 0);
INSERT INTO `files_content` VALUES (406, '6631750173824452348.txt', 'ừ dạ cám ơn đã liên hệ trong tâm chờ', 0);

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
-- Records of languages
-- ----------------------------
INSERT INTO `languages` VALUES (1, 'Tiếng việt', 'vn', NULL, NULL);
INSERT INTO `languages` VALUES (2, 'English', 'en', NULL, NULL);

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
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of modules
-- ----------------------------
INSERT INTO `modules` VALUES (1, 'Quản lý Administrators', 'admin_user', 'Thêm mới|Danh sách', 'add.php|listing.php', 0, NULL);
INSERT INTO `modules` VALUES (2, 'Quản lý Sinh Viên', 'users', 'Thêm mới|Danh sách', 'add.php|listing.php', 0, NULL);
INSERT INTO `modules` VALUES (3, 'Quản lý Kiểu khuôn mặt', 'questions', 'Thêm mới|Danh sách', 'add.php|listing.php', 0, NULL);
INSERT INTO `modules` VALUES (4, 'Quản lý Trường', 'schools', 'Thêm mới|Danh sách', 'add.php|listing.php', 0, NULL);
INSERT INTO `modules` VALUES (5, 'Quản lý Khoa', 'faculties', 'Thêm mới|Danh sách', 'add.php|listing.php', 0, NULL);
INSERT INTO `modules` VALUES (6, 'Quản lý Lớp', 'classes', 'Thêm mới|Danh sách', 'add.php|listing.php', 0, NULL);
INSERT INTO `modules` VALUES (7, 'Quản lý Cán Bộ - GV', 'officials', 'Thêm mới|Danh sách', 'add.php|listing.php', 0, NULL);
INSERT INTO `modules` VALUES (8, 'Duyệt Ảnh', 'users_photos', 'Danh sách', 'listing.php', 0, NULL);

-- ----------------------------
-- Table structure for phinxlog
-- ----------------------------
DROP TABLE IF EXISTS `phinxlog`;
CREATE TABLE `phinxlog`  (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `start_time` timestamp(0) NULL DEFAULT NULL,
  `end_time` timestamp(0) NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`version`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of phinxlog
-- ----------------------------
INSERT INTO `phinxlog` VALUES (20200428181837, 'Base', '2020-04-28 20:32:18', '2020-04-28 20:32:19', 0);
INSERT INTO `phinxlog` VALUES (20200428190049, 'DiepCd', '2020-04-28 21:00:49', '2020-04-28 21:00:49', 0);
INSERT INTO `phinxlog` VALUES (20200429102124, 'Tam1', '2020-04-30 10:21:19', '2020-04-30 10:21:20', 0);
INSERT INTO `phinxlog` VALUES (20200429173409, 'Tam2', '2020-04-30 10:21:20', '2020-04-30 10:21:20', 0);
INSERT INTO `phinxlog` VALUES (20200502040437, 'Diepcd', '2020-05-02 06:04:37', '2020-05-02 06:04:37', 0);
INSERT INTO `phinxlog` VALUES (20200504141328, 'Diepcd1', '2020-05-04 16:13:28', '2020-05-04 16:13:28', 0);

-- ----------------------------
-- Table structure for questions
-- ----------------------------
DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions`  (
  `que_id` int(11) NOT NULL AUTO_INCREMENT,
  `que_stt` int(2) NULL DEFAULT 1,
  `que_content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `que_required` tinyint(1) NULL DEFAULT 1,
  `que_img_example` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `que_active` tinyint(1) NULL DEFAULT 1,
  `que_created_at` int(11) NULL DEFAULT NULL,
  `que_updated_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`que_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of questions
-- ----------------------------
INSERT INTO `questions` VALUES (2, 2, 'Ảnh tự nhiên (Chính diện, cảm xúc tự nhiên, không đeo kính)', 1, 'mil1588653334.JPG', 1, 1588418165, 1588653334);
INSERT INTO `questions` VALUES (3, 1, 'Ảnh thẻ/Ảnh CMT/Ảnh hộ chiếu', 1, 'hvv1588843178.JPG', 1, 1588418311, 1588843178);
INSERT INTO `questions` VALUES (4, 4, 'Ảnh nghiêng bên trái', 1, 'vln1588653345.JPG', 1, 1588481723, 1588653345);
INSERT INTO `questions` VALUES (5, 5, 'Ảnh nghiêng bên phải', 1, 'fun1588653350.JPG', 1, 1588481729, 1588653350);
INSERT INTO `questions` VALUES (6, 6, 'Ảnh hơi cúi đầu (Nếu có)', 0, 'tiw1588653355.JPG', 1, 1588481734, 1588653355);
INSERT INTO `questions` VALUES (7, 7, 'Ảnh nghiêng bên trái có kính (Nếu có)', 0, 'qez1588653361.JPG', 1, 1588481739, 1588653361);
INSERT INTO `questions` VALUES (8, 8, 'Ảnh nghiêng bên phải có kính (Nếu có)', 0, 'fxz1588653366.JPG', 1, 1588481745, 1588653366);
INSERT INTO `questions` VALUES (9, 9, 'Ảnh chụp xa (Khoảng 2m-3m, nếu bạn thường đeo kính thì có thể chụp với kính)', 1, 'txa1588653371.JPG', 1, 1588481751, 1588653371);
INSERT INTO `questions` VALUES (10, 10, 'Ảnh có bàn tay (Bạn có thể dùng tay che 1 bộ phận trên khuôn mặt) (Nếu có)', 0, 'jul1588653375.JPG', 1, 1588482063, 1588653375);
INSERT INTO `questions` VALUES (11, 11, 'Ảnh mang khẩu trang (Nếu có)', 0, 'vca1588653380.JPG', 1, 1588482067, 1588653380);
INSERT INTO `questions` VALUES (15, 0, 'Ảnh khi bạn đeo kính cận (nếu có)', 0, 'cva1588843424.JPG', 1, 1588843424, NULL);

-- ----------------------------
-- Table structure for schools
-- ----------------------------
DROP TABLE IF EXISTS `schools`;
CREATE TABLE `schools`  (
  `sch_id` int(11) NOT NULL AUTO_INCREMENT,
  `sch_code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sch_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sch_active` tinyint(4) NULL DEFAULT 0,
  `sch_create_time` int(11) NULL DEFAULT NULL,
  `sch_update_time` int(11) NULL DEFAULT NULL,
  `sch_admin_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`sch_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 44 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of schools
-- ----------------------------
INSERT INTO `schools` VALUES (29, 'ĐHTL', 'Đại Học Thủy Lợi ', 1, 1589070752, NULL, NULL);
INSERT INTO `schools` VALUES (32, 'ĐHKTQD', 'Đại Học Kinh Tế Quốc Dân ', 1, 1589070873, NULL, NULL);
INSERT INTO `schools` VALUES (33, 'ĐHLHN', 'Đại Học Luật Hà Nội ', 1, 1589070941, NULL, NULL);
INSERT INTO `schools` VALUES (34, 'HVHCQG', 'Học Viện Hành Chính Quốc Gia ', 1, 1589070973, NULL, NULL);
INSERT INTO `schools` VALUES (35, 'ĐHHN', 'Đại Học Hà Nội ', 1, 1589071033, NULL, NULL);
INSERT INTO `schools` VALUES (37, 'HVTA', 'Học Viện Tòa Án', 1, 1589071086, NULL, NULL);
INSERT INTO `schools` VALUES (39, 'CĐDL-HN', 'Cao Đảng Du Lịch Hà Nội', 1, 1589073493, NULL, NULL);
INSERT INTO `schools` VALUES (40, 'ĐHĐL', 'Đại Học Điện Lực', 1, 1589126240, NULL, NULL);
INSERT INTO `schools` VALUES (42, 'ĐHMHN', 'Đại Học Mở Hà Nội ', 1, 1589126320, NULL, NULL);
INSERT INTO `schools` VALUES (43, 'HVCSND', 'Học Viện Cảnh Sát Nhân Dân', 1, 1589126437, NULL, NULL);

-- ----------------------------
-- Table structure for user_calender
-- ----------------------------
DROP TABLE IF EXISTS `user_calender`;
CREATE TABLE `user_calender`  (
  `ucl_id` int(11) NOT NULL AUTO_INCREMENT,
  `ucl_calender_id` int(11) NOT NULL,
  `ucl_user_id` int(11) NOT NULL,
  `ucl_type` int(11) NULL DEFAULT NULL,
  `ucl_date` int(11) NULL DEFAULT NULL,
  `ucl_admin_id` int(11) NULL DEFAULT NULL,
  `ucl_active` tinyint(4) NULL DEFAULT NULL,
  PRIMARY KEY (`ucl_id`) USING BTREE,
  UNIQUE INDEX `user_calender`(`ucl_calender_id`, `ucl_user_id`) USING BTREE,
  INDEX `ucl_calender_id`(`ucl_calender_id`) USING BTREE,
  INDEX `ucl_type`(`ucl_type`) USING BTREE,
  INDEX `ucl_user_id`(`ucl_user_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 35 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_calender
-- ----------------------------
INSERT INTO `user_calender` VALUES (32, 48, 1, NULL, 1592610073, NULL, 1);
INSERT INTO `user_calender` VALUES (33, 48, 2, NULL, 1592610073, NULL, 1);
INSERT INTO `user_calender` VALUES (34, 48, 32, NULL, 1592610073, NULL, 1);

-- ----------------------------
-- Table structure for user_calender_history
-- ----------------------------
DROP TABLE IF EXISTS `user_calender_history`;
CREATE TABLE `user_calender_history`  (
  `uch_id` int(11) NOT NULL AUTO_INCREMENT,
  `uch_calender_id` int(11) NOT NULL,
  `uch_user_id` int(11) NOT NULL,
  `uch_year` int(4) NULL DEFAULT NULL,
  `uch_month` int(2) NULL DEFAULT NULL,
  `uch_day` int(2) NULL DEFAULT NULL,
  `uch_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`uch_id`) USING BTREE,
  UNIQUE INDEX `user_alender`(`uch_calender_id`, `uch_user_id`) USING BTREE,
  INDEX `uch_user_id`(`uch_user_id`) USING BTREE,
  INDEX `uch_year`(`uch_year`) USING BTREE,
  INDEX `uch_month`(`uch_month`) USING BTREE,
  INDEX `uch_day`(`uch_day`) USING BTREE,
  INDEX `uch_time`(`uch_time`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of user_calender_history
-- ----------------------------
INSERT INTO `user_calender_history` VALUES (4, 48, 32, 2020, 6, 20, 1592641542);

-- ----------------------------
-- Table structure for user_translate
-- ----------------------------
DROP TABLE IF EXISTS `user_translate`;
CREATE TABLE `user_translate`  (
  `ust_keyword` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ust_text` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `lang_id` int(11) NOT NULL DEFAULT 1,
  `ust_source` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ust_date` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ust_keyword`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_translate
-- ----------------------------
INSERT INTO `user_translate` VALUES ('1f83f614dae003f1e4bb5225435c3866', 'Họ và tên không được để trống.', 1, 'Họ và tên không được để trống.', 1588389875);
INSERT INTO `user_translate` VALUES ('7df92386b0667ec62858ecc411139b62', 'Ngày sinh', 1, 'Ngày sinh', 1588389875);
INSERT INTO `user_translate` VALUES ('acb0fe6e3359debba83717b7fe998b72', 'Mã sinh viên không được để trống', 1, 'Mã sinh viên không được để trống', 1588389875);
INSERT INTO `user_translate` VALUES ('586b2454108f018746f101407275822b', 'Số chứng minh thư không được để trống', 1, 'Số chứng minh thư không được để trống', 1588389875);
INSERT INTO `user_translate` VALUES ('78904eb042760df254efeaee4e62e309', 'Họ và Tên không được để trống.', 1, 'Họ và Tên không được để trống.', 1588404672);
INSERT INTO `user_translate` VALUES ('8175052d224a6f8f5f8d214e49459738', 'Bạn chưa nhập Ngày sinh', 1, 'Bạn chưa nhập Ngày sinh', 1588404672);
INSERT INTO `user_translate` VALUES ('97c76d3df42f966453603f273bc3e00e', 'Mã Tài Khoản không được để trống', 1, 'Mã Tài Khoản không được để trống', 1588404672);
INSERT INTO `user_translate` VALUES ('8e383e195cbc5f84759f347f96296dc0', 'Số CMND/Hộ chiếu không được để trống.', 1, 'Số CMND/Hộ chiếu không được để trống.', 1588404672);
INSERT INTO `user_translate` VALUES ('928a2b0e792d81d9d139dc0c5840eae4', 'Họ và tê không được để trống', 1, 'Họ và tê không được để trống', 1588409129);
INSERT INTO `user_translate` VALUES ('8cf10cd0f17f25dae40e3204f6687381', 'Mã Sinh Viên không được để trống', 1, 'Mã Sinh Viên không được để trống', 1588410074);
INSERT INTO `user_translate` VALUES ('36e2221b9e9f1aec05b2ab388dbcd03a', 'Mã Cán Bộ - Giáo Viên không được để trống', 1, 'Mã Cán Bộ - Giáo Viên không được để trống', 1588415053);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `use_id` int(11) NOT NULL AUTO_INCREMENT,
  `use_class_id` int(11) NULL DEFAULT -1,
  `use_faculty_id` int(11) NULL DEFAULT 0,
  `use_school_id` int(11) NULL DEFAULT 0,
  `use_password` varchar(35) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `use_salt` varchar(35) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `use_birthdays` int(11) UNSIGNED NULL DEFAULT 0,
  `use_gender` tinyint(1) NULL DEFAULT 0,
  `use_code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `use_code_md5` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `use_idnumber` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `use_idnumber_md5` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `use_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `use_type` tinyint(1) NULL DEFAULT 1,
  `use_picture` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `use_created_time` int(11) NULL DEFAULT 0,
  `use_updated_time` int(11) NULL DEFAULT 0,
  `admin_id` int(11) NULL DEFAULT 0,
  `use_active` tinyint(1) NULL DEFAULT 0,
  `use_approved_image` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`use_id`) USING BTREE,
  UNIQUE INDEX `use_code_md5`(`use_code_md5`) USING BTREE,
  UNIQUE INDEX `use_idnumber_md5`(`use_idnumber_md5`) USING BTREE,
  INDEX `use_class_id`(`use_class_id`) USING BTREE,
  INDEX `use_faculty_id`(`use_faculty_id`) USING BTREE,
  INDEX `use_school_id`(`use_school_id`) USING BTREE,
  INDEX `use_gender`(`use_gender`) USING BTREE,
  INDEX `use_type`(`use_type`) USING BTREE,
  INDEX `use_active`(`use_active`) USING BTREE,
  INDEX `use_approved_image`(`use_approved_image`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 1, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-001', 'f7f8074c9ac335297b78dbbec0426822', '113287001', 'df8251da705c7d904183a44bc9ff3220', 'Lương Duy Cường', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (2, 1, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-002', '48e5ce0a9519fef761f2cc53bd777ce2', '113287002', '4b86fea77335cf51c8cf2c31ad4e7325', 'Nguyễn Việt Anh', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (3, 1, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-003', '41ad45b7321c83b653f2a00ad83ebe47', '113287003', '105b54a5c76c54c8cff0ebc00a5fee92', 'Thân Đức Mạnh', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (4, 1, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-004', '4a9585c67cfded7ef30bf2281049dbce', '113287004', 'f414a0e5adb13e6fe53fc23c54c2d9a8', 'Nguyễn Hải Đăng', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (5, 1, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-005', 'f8b83650c5aa44094d5907c0cbfb9e91', '113287005', '2e54dfc07bb872eb4d2b7be0839147be', 'Nguyễn Hữu Thế Duyệt', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (6, 1, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-006', 'fe778defe767d05de3fb68fccd8589e6', '113287006', '373d6985bf9008bd4298de620c5cde8e', 'Đỗ Đăng Trường Giang', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (7, 1, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-007', '1deaaff48acd5a55cd87a186f85ae316', '113287007', '88bc49e757985038aaaeccb82a1d0832', 'Phạm Thanh Hải', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (8, 1, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-008', '8261e1bcfc0bef26c2a7b89307b19091', '113287008', '4ffe444b042dbee56fefe2ac7061bf65', 'Nguyễn Đức Hiếu', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (9, 1, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-009', '770159fed00e5e8d54c3ba1b086a21d9', '113287009', '5debc68f13d49cf151fdeec340351df5', 'Phạm Việt Hoàng', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (10, 1, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-010', 'cef45d598c9a78fbbad4516af4991e1d', '113287010', 'c61720ab1fe843c2fac5a9abec9ef99d', 'Trần Quốc Hùng', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (11, 1, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-011', '37fd46f143620c3f4d0b7f5dc24f8abc', '113287011', '121081566c3f4e6d5970a3bf8f9f6c37', 'Hoàng Anh Tấn', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (12, 1, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-012', 'dc9ecc0f0da0ab28d459fd818d980186', '113287012', '926d1b50455bfb7570b0a79e6516e214', 'Nguyễn Văn Việt', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (13, 1, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-013', 'cd5bad024661e19a8c39b69d760f091a', '113287013', '623c21cfe81a41be000f655759ae7b8b', 'Nguyễn Thanh Lâm', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (14, 1, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-014', '7072d6b575d4d3efe23bbe135379d989', '113287014', 'aebab435826f69f696c33dba32404ab6', 'Bùi Thị Diệu Linh', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (15, 1, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-015', '96011a04b527f30083d5af5cca6ccba5', '113287015', '3a09e00f873860baa7077fa7419a08eb', 'Hoàng Hoài Nam', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (16, 2, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-016', '4d3821d7ff121acfbd243e142ce16053', '113287016', '8a78d2c5c560bf8ebe51e60d8c3c0111', 'Bích Ngọc', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (17, 2, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-017', 'cfecc0a22a3b879c39e9d561c4982648', '113287017', '6d67779ee71fea8e3e3d2a4989307279', 'Nguyễn Anh Nhân', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (18, 2, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-018', '8ed47d10466cd81df8f6e6b7c5603997', '113287018', '1dc3e9a2e0617e6342c45111a5fad240', 'Bùi Đức Thắng', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (19, 2, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-019', '7fc4e0ea334a5eb1aa75c7e568e3337e', '113287019', '541455b0cbb912be900f2580716f79dd', 'Phạm Danh Vương', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (20, 2, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-020', 'c16756b36385da76d3cd3de8cdc2735c', '113287020', '5e3e684a4779808049a404ef33500521', 'Nguyễn Trung Hà', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (21, 2, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-021', '996dcc71e4298d72b24f60b5c978db06', '113287021', 'd017b06602c0fab7e841cb045ed59a0f', 'Phùng Chí Thanh', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (22, 2, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-022', '96cae9785fca5a9e0525ee20cdf0d441', '113287022', 'bba18a2fadac2c77ed98e774b1069051', 'Lưu Tuấn Đạt', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (23, 2, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-023', 'e1225843a3a4e93d3bfe8a6bea028059', '113287023', 'ed949326ce695a3722608c5e98825b2f', 'Vũ Hoàng Quân', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (24, 2, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-024', '8ce368fddc13edc09aa4501b09686943', '113287024', '0820b7fec391fedd595be7a28794a559', 'Hà Mai Lan', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (25, 2, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-025', '150b4f289f6dfe41c84426e7752767be', '113287025', 'cc778fc1354f3aef44b6e8ed6e4f3241', 'Lê Minh Trung Hiếu', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (26, 2, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-026', '4dc8fd6154134f63a400d8761358a5a6', '113287026', '40c21876ca89d1531e7b16c011190ee9', 'Trần Viết Chiến', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (27, 2, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-027', '9221792ce8b747395996474919c633e1', '113287027', '62703f142d5a9f708ffe93e28229525c', 'Lê Quang Huy', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (28, 2, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-028', '2fab020b392f3b460158615c7131e757', '113287028', '16b1e1e4bd2fd7fe44c36a5837e24501', 'Nguyễn Lam Trường', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (29, 2, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959810400, 1, 'SV-029', '2267f588950513a902b6adb18e96e4d1', '113287029', 'af7e4133697db756ed7ef8282ee579e9', 'Dương Minh Đức', 2, NULL, 1592604543, 1592604557, 1, 1, 1);
INSERT INTO `users` VALUES (30, 2, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959792400, 1, 'SV-030', 'c925093d9b7046116f14f105e72fb3ba', '113287030', '19390b617f694ea19c9d89c25e2cfaf9', 'Nguyễn Anh Đức', 2, 'qyg1592633566.jpg', 1592604543, 1592633566, 1, 1, 1);
INSERT INTO `users` VALUES (31, 2, 30, 40, '5c6af4647d8c779e58b334245b7a063d', '918060e41cceb36ed1c1566c83ab07bc', 959792400, 1, 'SV-031', 'cecec0fc09b15d7c2db53a409624bc69', '113287031', 'ec8cebe3771aa2142bb3b0eea5652ab6', 'Bùi Đình Sơn', 2, 'bka1592633543.jpg', 1592604543, 1592633543, 1, 1, 1);
INSERT INTO `users` VALUES (32, 2, 30, 40, 'f87cebc858b52c87c157a356aef6608b', '217df8f70c0cabf543f5f249a8b55842', 1592586000, 1, 'SV-032', 'f32c280d2dc154e0ec0476c3495be89a', '113287032', '47872cf6857afac1493183fb33022f51', 'Cấn Đức Điệp', 2, 'xkk1592633507.JPG', 1592606170, 1592646663, 1, 1, 1);

-- ----------------------------
-- Table structure for users_photos
-- ----------------------------
DROP TABLE IF EXISTS `users_photos`;
CREATE TABLE `users_photos`  (
  `up_id` int(11) NOT NULL AUTO_INCREMENT,
  `up_user_id` int(11) NOT NULL,
  `up_question_id` int(11) NOT NULL,
  `up_picture` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `up_created_time` int(11) NULL DEFAULT 0,
  `up_updated_time` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`up_id`) USING BTREE,
  UNIQUE INDEX `up_user_id`(`up_user_id`, `up_question_id`) USING BTREE,
  INDEX `up_question_id`(`up_question_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 176 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users_photos
-- ----------------------------
INSERT INTO `users_photos` VALUES (1, 1, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (2, 1, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (3, 1, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (4, 1, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (5, 1, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (6, 2, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (7, 2, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (8, 2, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (9, 2, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (10, 2, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (11, 3, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (12, 3, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (13, 3, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (14, 3, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (15, 3, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (16, 4, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (17, 4, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (18, 4, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (19, 4, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (20, 4, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (21, 5, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (22, 5, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (23, 5, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (24, 5, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (25, 5, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (26, 6, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (27, 6, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (28, 6, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (29, 6, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (30, 6, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (31, 7, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (32, 7, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (33, 7, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (34, 7, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (35, 7, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (36, 8, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (37, 8, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (38, 8, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (39, 8, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (40, 8, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (41, 9, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (42, 9, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (43, 9, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (44, 9, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (45, 9, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (46, 10, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (47, 10, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (48, 10, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (49, 10, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (50, 10, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (51, 11, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (52, 11, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (53, 11, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (54, 11, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (55, 11, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (56, 12, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (57, 12, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (58, 12, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (59, 12, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (60, 13, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (61, 13, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (62, 13, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (63, 13, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (64, 13, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (65, 14, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (66, 14, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (67, 14, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (68, 14, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (69, 14, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (70, 15, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (71, 15, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (72, 15, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (73, 15, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (74, 15, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (75, 16, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (76, 16, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (77, 16, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (78, 16, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (79, 16, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (80, 17, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (81, 17, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (82, 17, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (83, 17, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (84, 17, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (85, 18, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (86, 18, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (87, 18, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (88, 18, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (89, 18, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (90, 19, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (91, 19, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (92, 19, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (93, 19, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (94, 19, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (95, 20, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (96, 20, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (97, 20, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (98, 20, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (99, 20, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (100, 21, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (101, 21, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (102, 21, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (103, 21, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (104, 21, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (105, 22, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (106, 22, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (107, 22, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (108, 22, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (109, 22, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (110, 23, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (111, 23, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (112, 23, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (113, 23, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (114, 23, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (115, 24, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (116, 24, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (117, 24, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (118, 24, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (119, 24, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (120, 25, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (121, 25, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (122, 25, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (123, 25, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (124, 25, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (125, 26, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (126, 26, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (127, 26, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (128, 26, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (129, 26, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (130, 27, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (131, 27, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (132, 27, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (133, 27, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (134, 27, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (135, 28, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (136, 28, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (137, 28, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (138, 28, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (139, 28, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (140, 29, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (141, 29, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (142, 29, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (143, 29, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (144, 29, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (145, 30, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (146, 30, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (147, 30, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (148, 30, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (149, 30, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (150, 31, 3, '01_user_001.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (151, 31, 2, '01_user_002.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (152, 31, 4, '01_user_003.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (153, 31, 5, '01_user_004.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (154, 31, 9, '01_user_005.jpg', 1592625759, 1592625759);
INSERT INTO `users_photos` VALUES (165, 32, 15, 'cmj1592627504.jpeg', 1592627504, 1592627504);
INSERT INTO `users_photos` VALUES (166, 32, 3, 'njs1592627507.jpeg', 1592627507, 1592627507);
INSERT INTO `users_photos` VALUES (167, 32, 2, 'ift1592627511.jpeg', 1592627511, 1592627511);
INSERT INTO `users_photos` VALUES (168, 32, 4, 'avk1592627513.jpeg', 1592627513, 1592627513);
INSERT INTO `users_photos` VALUES (169, 32, 5, 'nky1592627517.jpeg', 1592627517, 1592627517);
INSERT INTO `users_photos` VALUES (170, 32, 6, 'oit1592627519.jpeg', 1592627519, 1592627519);
INSERT INTO `users_photos` VALUES (171, 32, 7, 'seg1592627523.jpeg', 1592627523, 1592627523);
INSERT INTO `users_photos` VALUES (172, 32, 8, 'kvo1592627526.jpeg', 1592627526, 1592627526);
INSERT INTO `users_photos` VALUES (173, 32, 9, 'lxx1592627529.jpeg', 1592627529, 1592627529);
INSERT INTO `users_photos` VALUES (174, 32, 10, 'teo1592627532.jpeg', 1592627532, 1592627532);
INSERT INTO `users_photos` VALUES (175, 32, 11, 'eeo1592627535.jpeg', 1592627535, 1592627535);

SET FOREIGN_KEY_CHECKS = 1;
