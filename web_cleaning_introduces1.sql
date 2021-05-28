-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 27, 2021 lúc 04:57 AM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web_cleaning_introduces`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_menu_order`
--

CREATE TABLE `admin_menu_order` (
  `amo_admin` int(11) NOT NULL DEFAULT 0,
  `amo_module` int(11) NOT NULL DEFAULT 0,
  `amo_order` int(11) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Đang đổ dữ liệu cho bảng `admin_menu_order`
--

INSERT INTO `admin_menu_order` (`amo_admin`, `amo_module`, `amo_order`) VALUES
(1, 14, 0),
(1, 23, 5),
(1, 87, 0),
(1, 35, 3),
(1, 11, 6),
(1, 18, 0),
(1, 46, 0),
(1, 10, 9),
(1, 26, 4),
(1, 19, 8),
(1, 72, 0),
(1, 67, 13),
(1, 24, 12),
(439, 35, 0),
(439, 26, 0),
(439, 67, 0),
(439, 24, 0),
(1, 88, 8),
(1, 89, 9),
(438, 19, 0),
(1, 91, 0),
(1, 92, 2),
(1, 93, 0),
(1, 94, 0),
(1, 95, 11),
(440, 23, 0),
(440, 91, 0),
(440, 19, 0),
(1, 96, 10),
(441, 96, 0),
(441, 19, 0),
(441, 91, 0),
(441, 23, 0),
(441, 11, 0),
(441, 35, 0),
(441, 67, 0),
(441, 89, 0),
(441, 88, 0),
(441, 26, 0),
(441, 14, 0),
(441, 95, 0),
(441, 92, 0),
(441, 24, 0),
(442, 96, 0),
(442, 35, 0),
(442, 26, 0),
(442, 95, 0),
(442, 92, 0),
(442, 11, 0),
(442, 23, 0),
(442, 67, 0),
(442, 89, 0),
(442, 88, 0),
(442, 14, 0),
(442, 24, 0),
(442, 91, 0),
(1, 97, 0),
(1, 99, 2),
(1, 98, 1),
(1, 100, 8),
(1, 101, 9),
(1, 102, 6),
(1, 103, 7),
(1, 104, 0),
(1, 105, 0),
(1, 106, 0),
(1, 107, 0),
(1, 108, 0),
(1, 109, 0),
(1, 110, 0),
(1, 3, 1),
(1, 2, 2),
(1, 4, 7),
(1, 1, 2),
(1, 6, 5),
(1, 5, 0),
(1, 7, 3),
(1, 8, 0),
(1, 9, 0),
(1, 12, 3),
(1, 13, 1),
(1, 15, 2),
(1, 16, 1),
(1, 17, 6),
(1, 20, 3),
(1, 21, 1),
(443, 2, 0),
(443, 7, 0),
(443, 6, 0),
(445, 12, 0),
(445, 8, 0),
(445, 13, 0),
(445, 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_translate`
--

CREATE TABLE `admin_translate` (
  `tra_keyword` varchar(255) NOT NULL,
  `tra_text` varchar(255) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `tra_source` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `admin_translate`
--

INSERT INTO `admin_translate` (`tra_keyword`, `tra_text`, `lang_id`, `tra_source`) VALUES
('0323de4f66a1700e2173e9bcdce02715', 'Logout', 1, 'Logout'),
('b61541208db7fa7dba42c85224405911', 'Menu', 1, 'Menu'),
('e050b402c1f5326f8d350c61694e0513', 'Show list menu', 1, 'Show list menu'),
('6bc362dbf494c61ea117fe3c71ca48a5', 'Move', 1, 'Move'),
('d6705b26e977120f7fff7f6541aa3680', 'Menu listing', 1, 'Menu listing'),
('3e4f6b98dd47b06bb7d7b452338d8f13', 'Thứ tự', 1, 'Thứ tự'),
('ada8b28aaf732f572121bdaf7b734e05', 'Tên menu', 1, 'Tên menu'),
('9d73d841b7a35ee09471fbc8382063d1', 'Liên kết', 1, 'Liên kết'),
('69ea36f3046522e3b87d0ca79a1d721e', 'Vị trí', 1, 'Vị trí'),
('bb2562bfee18c26343fc91d08e28a625', 'No selected', 1, 'No selected'),
('c9cc8cce247e49bae79f15173ce97354', 'Save', 1, 'Save'),
('3744738d8abab2f3bfbc43742096ccc6', 'Mở ra cửa sổ', 1, 'Mở ra cửa sổ'),
('4d3d769b812b6faa6b76e1a8abaece2d', 'Active', 1, 'Active'),
('5fb63579fc981698f97d55bfecb213ea', 'Copy', 1, 'Copy'),
('7dce122004969d56ae2e0245cb754d35', 'Edit', 1, 'Edit'),
('f2a6c498fb90ee345d997f888fce3b18', 'Delete', 1, 'Delete'),
('dfaa01f3617bd390d1cb2bab9cf0520f', 'Click to edit...', 1, 'Click to edit...'),
('8929ef313c0fd6e43446cc0aa86b70cd', 'Tìm kiếm', 1, 'Tìm kiếm'),
('f1851d5600eae616ee802a31ac74701b', 'Enter', 1, 'Enter'),
('063c5bad4cb4e38270a8064282d8cf26', 'Sort A->Z or Z->A', 1, 'Sort A->Z or Z->A'),
('d879cb7ec352716ee940adac5c505340', 'Do you want to delete the product you\'ve selected ?', 1, 'Do you want to delete the product you\'ve selected ?'),
('24c0b84c19d8cdde90951ac6762f0706', 'Delete all selected', 1, 'Delete all selected'),
('17ae5cc83fa7a949d2008d5d2a556fe2', 'Total record', 1, 'Total record'),
('8d6e39135454a7027fc058ab43383aa8', 'Trang tĩnh', 1, 'Trang tĩnh'),
('1cd2c2f7a203be1d0a7cc942037d51ad', 'Tin tức', 1, 'Tin tức'),
('1d1aa192b5f3b65f18a833224b52a22d', 'Sản phẩm', 1, 'Sản phẩm'),
('33f0741f9e26310fbe1a9511048e4996', 'Giới thiệu', 1, 'Giới thiệu'),
('8881984856eea95a37c6b2f116da5da0', 'Phụ kiện', 1, 'Phụ kiện'),
('bb0ca7b10e0403c6cf6d0856a303c80b', 'Giải pháp', 1, 'Giải pháp'),
('399474704c5d235108c1df6dc63e8417', 'Hỏi đáp', 1, 'Hỏi đáp'),
('f01435acd94ced9d198b163136a6ceb1', 'Chọn danh mục', 1, 'Chọn danh mục'),
('88cca1554d60a722c9329867fe6726de', 'Tên danh mục', 1, 'Tên danh mục'),
('7e1f42134de6654908c29d8416edc842', 'Thêm mới danh mục', 1, 'Thêm mới danh mục'),
('6925a750d9e84cdbab22e95eadc99906', 'Loại danh mục', 1, 'Loại danh mục'),
('6cd9e20b34570fd85452d6841057d2c2', 'Chọn loại danh mục', 1, 'Chọn loại danh mục'),
('29deb7955c1d18575d56aaae47bf1a5e', 'Sắp xếp', 1, 'Sắp xếp'),
('3c6f336189cf75e45b09039066ab2cc4', 'Ảnh', 1, 'Ảnh'),
('3d94238c027cc777954c8c3e10ddb258', 'Danh mục cha', 1, 'Danh mục cha'),
('cf210dbf1670fa82368c0a1e7f4e56c4', 'Chọn danh mục con', 1, 'Chọn danh mục con'),
('bc214b2709bc9d5700f8e0b32cbc4d79', 'Tiếp tục thêm', 1, 'Tiếp tục thêm'),
('77f6903f0ac02331b5a7001a05519ae8', 'Thêm mới', 1, 'Thêm mới'),
('8e9d61188f4cad473a2f12626dabb1e4', 'Danh sách ảnh', 1, 'Danh sách ảnh'),
('af1b98adf7f686b84cd0b443e022b7a0', 'Categories', 1, 'Categories'),
('53d8de583ea7608b24d2aaf0edd90f0b', 'Danh mục', 1, 'Danh mục'),
('cd48206067ac5f62cc664794150bd319', 'Category listing', 1, 'Category listing'),
('498f79c4c5bbde77f1bceb6c86fd0f6d', 'Show', 1, 'Show'),
('a28c6d1503fde7e355cda9ce2b7ba5d0', 'Are you want duplicate record', 1, 'Are you want duplicate record'),
('573d643cf1e507e3939566ee8cb85bfe', 'Please enter category name', 1, 'Please enter category name'),
('40a3f6e61efa652c8a06e67a33ada355', 'Sửa danh mục', 1, 'Sửa danh mục'),
('06e0e9ebf644616fd56c521f74611b00', 'Danh mục con', 1, 'Danh mục con'),
('5254652803211a21b0aafdc1b278cd09', 'Lưu lại', 1, 'Lưu lại'),
('4bf239867967133d56e22c691b990730', 'Làm lại', 1, 'Làm lại'),
('46c397226dd34c77dcc8c64859c9e520', 'Banner Listing', 1, 'Banner Listing'),
('664e2136bf45dca2ea4eed276d90ae19', 'Banner name', 1, 'Banner name'),
('88a126c7b39a4e035444d5ed8323fa72', 'Link banner', 1, 'Link banner'),
('0b366e999e00a10cbbef9819cfff1023', 'Loại Banner', 1, 'Loại Banner'),
('bafd7322c6e97d25b6299b5d6fe8920b', 'No', 1, 'No'),
('1c124c3750c7d7a139a12f66cd64af28', 'Login Name', 1, 'Login Name'),
('f11b368cddfe37c47af9b9d91c6ba4f0', 'Full name', 1, 'Full name'),
('ce8ae9da5b7cd6c3df2929543a9af92d', 'Email', 1, 'Email'),
('94a064527b49d1806c785017cb4de5e2', 'Username GN', 1, 'Username GN'),
('fc8c9c23f2469829de2243f7f8d72444', 'Right module', 1, 'Right module'),
('57d056ed0984166336b7879c2af3657f', 'City', 1, 'City'),
('572fdff36c9419a3204e0a27c851150b', 'Fake Login', 1, 'Fake Login'),
('99dea78007133396a7b8ed70578ac6ae', 'Login', 1, 'Login'),
('9d5b888617863d159ab820e180d623ef', 'Are you sure to delete', 1, 'Are you sure to delete'),
('27163bae262de21ce154cfbdfd477c2b', 'Management website version 1.0', 1, 'Management website version 1.0'),
('09f0c5159c5e34504e453eff3fc70324', 'Account Management', 1, 'Account Management'),
('08bd40c7543007ad06e4fce31618f6ec', 'Account', 1, 'Account'),
('dc647eb65e6711e155375218212b3964', 'Password', 1, 'Password'),
('a58f11905c6e4e604025da091fd21392', 'City/District Listing', 1, 'City/District Listing'),
('8833c8e8224a14b07aa3e6e75adff5c8', 'Click vào để sửa đổi sau đó enter để lưu lại', 1, 'Click vào để sửa đổi sau đó enter để lưu lại'),
('e74687ce22a0dd5b084b221e0245d9c1', 'Nhân bản thêm một bản ghi mới', 1, 'Nhân bản thêm một bản ghi mới'),
('103e26ede1d9a1ef79d9a695ad38f076', 'Bạn muốn sửa đổi bản ghi', 1, 'Bạn muốn sửa đổi bản ghi'),
('56ee3495a32081ccb6d2376eab391bfa', 'Listing', 1, 'Listing'),
('a261e9c2d70b7377da04817678ffe28b', 'Thêm menu mới', 1, 'Thêm menu mới'),
('40782f943cb26695685719d494a86558', 'Click sửa đổi sau đó chọn save', 1, 'Click sửa đổi sau đó chọn save'),
('a5915972963fbe301b98cba71fec357b', 'Bạn muốn xóa bản ghi?', 1, 'Bạn muốn xóa bản ghi?'),
('4631c1fd35806f277b34ba3c70069489', 'You have successfully deleted', 1, 'You have successfully deleted'),
('327431af0359c7ac54080e8671c1fc80', 'You have successfully duplicated', 1, 'You have successfully duplicated'),
('ae4b89f870785ea13dba02f1dcd0a20a', 'Tiêu đề', 1, 'Tiêu đề'),
('990cc9a866a8c9f700e8b18da651ca66', 'Statics Listing', 1, 'Statics Listing'),
('a915353abb7e8032f213f403c089865a', 'Chọn danh mục cha', 1, 'Chọn danh mục cha'),
('af871bda571ca25c95d085fbd134daa1', 'Giá phải lớn hơn 0 !', 1, 'Giá phải lớn hơn 0 !'),
('fba94834af2988e51fdaf118bed1a949', 'Giá nhập về phải lớn hơn 0 !', 1, 'Giá nhập về phải lớn hơn 0 !'),
('d9b718cad121430960a45708020bd80a', 'Add new record', 1, 'Add new record'),
('78c02d516a42555f271f43eb874ac677', 'Sửa menu', 1, 'Sửa menu'),
('2374b44bec1b6a80cc13c07d0d19f91c', 'Admin User listing', 1, 'Admin User listing'),
('8b14cccf460524cc522b671cb73c4a60', 'Username is not empty and> 3 characters', 1, 'Username is not empty and> 3 characters'),
('4a2625fe1771a1890227ec50ee1f86ea', 'Administrator account already exists', 1, 'Administrator account already exists'),
('df10cc9b682c4dbf276339eb45b2a65b', 'Password must be greater than 4 characters', 1, 'Password must be greater than 4 characters'),
('16648260e58b4cf9d458e1a197ef43f1', 'Email is invalid', 1, 'Email is invalid'),
('7ccf75fa7498152efe4e152833455c67', 'Login name', 1, 'Login name'),
('bcc254b55c4a1babdf1dcb82c207506b', 'Phone', 1, 'Phone'),
('4c231e0da3eaaa6a9752174f7f9cfb31', 'Confirm password', 1, 'Confirm password'),
('7b15160cb91a523014f1606660fd1851', 'Username trên Giao nhận', 1, 'Username trên Giao nhận'),
('99938282f04071859941e18f16efcf42', 'select', 1, 'select'),
('22884db148f0ffb0d830ba431102b0b5', 'module', 1, 'module'),
('34ec78fcc91ffb1e54cd85e4a0924332', 'add', 1, 'add'),
('de95b43bceeb4b998aed4aed5cef1ae7', 'edit', 1, 'edit'),
('099af53f601532dbd31e0ea99ffdeb64', 'delete', 1, 'delete'),
('84a8921b25f505d0d2077aeb5db4bc16', 'Static', 1, 'Static'),
('06145a21dcec7395085b033e6e169b61', 'Menus', 1, 'Menus'),
('f9aae5fda8d810a29f12d1e61b4ab25f', 'Users', 1, 'Users'),
('a54f98b0e23e6925c855760cdabd7168', 'Banners', 1, 'Banners'),
('edd7ae75c3a820d7fb5b331a020c4626', 'Admin User - Management', 1, 'Admin User - Management'),
('eb631b70ae7c721773f91b506c815082', 'Configurations', 1, 'Configurations'),
('e2f06abaff2623821632a05249f4c5f6', 'List City - District', 1, 'List City - District'),
('f3d873c4bc4d8c1dea06311d3226b919', 'Admin city', 1, 'Admin city'),
('c9cb3dbd637672e65c8138311808f73b', 'all_category', 1, 'all_category'),
('03368e3c1eb4d2a9048775874301b19f', 'Select category', 1, 'Select category'),
('97efa0b62a66b41fd988ec7fc2e694bb', 'save_change', 1, 'save_change'),
('7a6e7491825990107cbfa71abe947112', 'All_category', 1, 'All_category'),
('efd07a93bff07c8dd52624d900172d83', 'Thêm mới Admin User', 1, 'Thêm mới Admin User'),
('e0626222614bdee31951d84c64e5e9ff', 'Select', 1, 'Select'),
('e55f75a29310d7b60f7ac1d390c8ae42', 'Module', 1, 'Module'),
('ec211f7c20af43e742bf2570c3cb84f9', 'Add', 1, 'Add'),
('6bcecfe8349eb783b735d815c8e08c28', 'Edit member profile', 1, 'Edit member profile'),
('b36aa562ba43e1963c42cdec3c8b5b77', 'Change password member', 1, 'Change password member'),
('3544848f820b9d94a3f3871a382cf138', 'New password', 1, 'New password'),
('0b39c5aca15b84b1ad53a94d6b3feb78', 'Change password', 1, 'Change password'),
('8547034108ba0285d5339f5e149d9b32', 'Please enter new password', 1, 'Please enter new password'),
('2516af6cb654137bb71e9d2fd6c577d2', 'New password and confirm password is not correct', 1, 'New password and confirm password is not correct'),
('3b7db4b6d510cc3156e3acf4365e7a74', 'Cập nhật', 1, 'Cập nhật'),
('57fbf1acc87fb60f9ea8ebdbbb873302', 'Your_new_password_has_been_updated', 1, 'Your_new_password_has_been_updated'),
('ad31a6749699923d66d1fb1afa1a78c5', 'Management website', 1, 'Management website'),
('c1c079acfea640c60e08f76c4eae4dab', 'SẢN PHẨM MỚI', 1, 'SẢN PHẨM MỚI'),
('dfb3f308150a65be9f2b3776879b4cdc', 'Duyệt qua các sản phẩm mới, cập nhật thường xuyên', 1, 'Duyệt qua các sản phẩm mới, cập nhật thường xuyên'),
('54c5e0cb2f195f47de74243385314e49', 'Nội dung chi tiết :', 1, 'Nội dung chi tiết :'),
('65d7b8f0308d6bed4b30d91af0d9acd9', 'Color name', 1, 'Color name'),
('ffa1c67d17bb3b3ccca2e626c7fa44a5', 'Mã code', 1, 'Mã code'),
('b718adec73e04ce3ec720dd11a06a308', 'ID', 1, 'ID'),
('fb1d215c46b16d004d71483d247eb176', 'Color Listing', 1, 'Color Listing'),
('3e6a625faef0050601371de85af0630d', 'Size name', 1, 'Size name'),
('aca0dd65318fb8532af8ae91b91fc1d6', 'Product Size', 1, 'Product Size'),
('6af2109688acf1234730ddc15f6a59c7', 'Product Color', 1, 'Product Color'),
('afe41e484cf5d42d74d1efce223871c2', 'You_have_successfully_deleted', 1, 'You_have_successfully_deleted'),
('793739f171c8356a3d8aa366bf455b5a', 'Chưa xem', 1, 'Chưa xem'),
('eb5e7b5ef24ecf4d42c4b74cb295dec5', 'Đã xem', 1, 'Đã xem'),
('b76918aa83cd0685b8e969ff61eff798', 'Đang chờ thanh toán', 1, 'Đang chờ thanh toán'),
('0c9c7bc3568d7fc304a41332711f57de', 'Đã thanh toán', 1, 'Đã thanh toán'),
('a2b57e36de565a06d07625fd9a0437aa', 'Hủy đơn hàng', 1, 'Hủy đơn hàng'),
('7153dddbbb8537dac3d3a1b2c6c51511', 'Show trang chủ', 1, 'Show trang chủ'),
('3fd6ae6527e079f8aacb1c5f58c585f0', 'News Listing', 1, 'News Listing'),
('b78a3223503896721cca1303f776159b', 'Title', 1, 'Title'),
('d96bc4fb209368557926632abc71b9e1', 'Từ khóa', 1, 'Từ khóa'),
('a240fa27925a635b08dc28c9e4f9216d', 'Order', 1, 'Order'),
('8ec67083eb05fd0b30175aa5b5a485f8', 'Thêm tin mới', 1, 'Thêm tin mới'),
('f98d981cdc7da27407fa8f66b9bca872', 'Link từ khóa', 1, 'Link từ khóa'),
('8514dc4860c43710f9e778b6b8ad740c', 'Tên hãng sản xuất', 1, 'Tên hãng sản xuất'),
('905e1df471ccc43c7e88dffdabf54f14', 'Thêm mới hỗ trợ', 1, 'Thêm mới hỗ trợ'),
('6329f6e769e5b65184ed00b305c74fc9', 'Tên thương hiệu', 1, 'Tên thương hiệu'),
('27cb367e4039f33f15e891503f2e43c1', 'Ảnh minh họa', 1, 'Ảnh minh họa'),
('4594b97fc007a53b3e727dff76015a92', 'Please_enter_Old_password', 1, 'Please_enter_Old_password'),
('a7c31c1d5e83cb69a35bb36a907abb44', 'Please_enter_New_password', 1, 'Please_enter_New_password'),
('5fad91acf14ca6920bb84cb7bd72c9c0', 'New_password_must_be_at_least_6_characters', 1, 'New_password_must_be_at_least_6_characters'),
('ff3806e80cd949908764c0b76cf0af83', 'Please_enter_confirm_password', 1, 'Please_enter_confirm_password'),
('afb12635ac15e867c3968bc1459532c1', 'New_password_and_confirm_password_is_not_correct', 1, 'New_password_and_confirm_password_is_not_correct'),
('01c643fcdc6979fe16e0aa1a492192e8', 'edit_the_information_management', 1, 'edit_the_information_management'),
('3bd27d5b87038caa242f4f4020245af6', 'Change_your_Email', 1, 'Change_your_Email'),
('3359f0cd1bbefac69fac3f4a2e7edd42', 'Change_your_password', 1, 'Change_your_password'),
('e1f42c3f43ff8b2826b3162969b9f459', 'User login', 1, 'User login'),
('01557660faa28f8ec65992d1ddbb7b79', 'Your Email', 1, 'Your Email'),
('c93ce0c5bad27f3f26a54a17d9e42657', 'Change email', 1, 'Change email'),
('09a5a307de671894b4276b0ea8577671', 'Reset all', 1, 'Reset all'),
('062d2b8bc2cfac7772c75ae8090fb9d1', 'Old password', 1, 'Old password'),
('6ab96a5df54aa6aae2bab9ea75ab76c9', 'Confirm new password', 1, 'Confirm new password'),
('353dabf6d46427c82546b9a493614ad0', 'Please_enter_new_password', 1, 'Please_enter_new_password'),
('161416d9bb2f251dab12b009051c85ac', 'Thương hiệu', 1, 'Thương hiệu'),
('adb21d16073a2d324a01b6ef0607efde', 'Đơn hàng', 1, 'Đơn hàng'),
('e995a5932fc16e06c02e2ec7e0985170', 'Kích thước', 1, 'Kích thước'),
('b4aca97983db90a346429bacf1a6b816', 'Màu sắc', 1, 'Màu sắc'),
('2135c7c4a14b20cd2651f2297e005bf5', 'Hướng dẫn - Thông tin', 1, 'Hướng dẫn - Thông tin'),
('d7a00df7478eb7c92d3fc2671f3566b3', 'Quản trị admin', 1, 'Quản trị admin'),
('6412d9f6e554ab2497733cbd65b32a91', 'Bình luận', 1, 'Bình luận'),
('ff7fa908ac437f52a7c25d0c557a1239', 'Show trang chủ mobile', 1, 'Show trang chủ mobile'),
('eadd8eafc98af58c6c7a6f032fe1a8a3', 'Please_select_modules!', 1, 'Please_select_modules!'),
('6ff29916f99fff9d2494d28e721ae77e', 'Banner', 1, 'Banner'),
('8c9c59395abb8654a28653fa7f3ff206', 'Danh mục gợi ý search', 1, 'Danh mục gợi ý search'),
('8b9811f0cb3464dcdc25f384e9578425', 'Chi nhánh', 1, 'Chi nhánh'),
('65b4a513e733f5f8b279feb6b73445bf', 'Khách mua hàng', 1, 'Khách mua hàng'),
('0caa5ce1a76fe25eae5446acc49ab375', 'Khách hàng', 1, 'Khách hàng'),
('e4f9cc8111066b490548cdcbb0273883', 'List Ngân hàng :', 1, 'List Ngân hàng :'),
('d28be3f99afba35abdbbfe4c99b6e1e3', 'Please_enter_your_email', 1, 'Please_enter_your_email'),
('78d20478f2f45aa8b7145bd54d06402a', 'information_was_updated_successfully', 1, 'information_was_updated_successfully'),
('cb5feb1b7314637725a2e73bdc9f7295', 'Color', 1, 'Color'),
('6f6cb72d544962fa333e2e34ce64f719', 'Size', 1, 'Size'),
('4194726ee334e1085d93e002837b73f0', 'Hot', 1, 'Hot'),
('c65c66b68d2029f77c4b8fe396d3c625', 'Tên thuộc tính', 1, 'Tên thuộc tính'),
('0831d9774255a1d295eaea3ad9dd19bc', 'Thuộc tính cha', 1, 'Thuộc tính cha');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_user`
--

CREATE TABLE `admin_user` (
  `adm_id` int(11) NOT NULL,
  `adm_loginname` varchar(100) DEFAULT NULL,
  `adm_password` varchar(100) DEFAULT NULL,
  `adm_name` varchar(255) DEFAULT NULL,
  `adm_email` varchar(255) DEFAULT NULL,
  `adm_address` varchar(255) DEFAULT NULL,
  `adm_phone` varchar(255) DEFAULT NULL,
  `adm_mobile` varchar(255) DEFAULT NULL,
  `adm_cskh` tinyint(4) DEFAULT 0,
  `adm_job` tinyint(4) NOT NULL DEFAULT 0,
  `adm_access_module` varchar(255) DEFAULT NULL,
  `adm_access_category` text DEFAULT NULL,
  `adm_date` int(11) DEFAULT 0,
  `adm_isadmin` tinyint(1) DEFAULT 0,
  `adm_active` tinyint(1) DEFAULT 1,
  `lang_id` tinyint(1) DEFAULT 1,
  `adm_delete` int(11) DEFAULT 0,
  `adm_all_category` int(1) DEFAULT NULL,
  `adm_edit_all` int(1) DEFAULT 0,
  `admin_id` int(1) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `admin_user`
--

INSERT INTO `admin_user` (`adm_id`, `adm_loginname`, `adm_password`, `adm_name`, `adm_email`, `adm_address`, `adm_phone`, `adm_mobile`, `adm_cskh`, `adm_job`, `adm_access_module`, `adm_access_category`, `adm_date`, `adm_isadmin`, `adm_active`, `lang_id`, `adm_delete`, `adm_all_category`, `adm_edit_all`, `admin_id`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyễn An', 'tuankiet', 'Số 15 ngõ 143 - Trung Kính - Trung Hòa - Cầu Giấy - Hà Nội', '(84-04) 784 7135 - (84-04) 219 2996', '095 330 8125', 0, 0, NULL, NULL, 0, 1, 1, 1, 0, NULL, 0, 0),
(443, 'giaovien01', '25f9e794323b453885f5181f1b624d0b', 'Giáo viên 01', '', NULL, 'aâ', NULL, 0, 0, NULL, '', 0, 0, 1, 1, 1, 0, 0, 1),
(444, 'diepcd', 'e10adc3949ba59abbe56e057f20f883e', 'Can Diep', 'diepcd@gmail.com', NULL, '0987898870', NULL, 0, 0, NULL, '', 0, 0, 1, 1, 1, 0, 0, 1),
(445, '000200000029', 'e10adc3949ba59abbe56e057f20f883e', 'Đỗ Tuấn Kiệt', 'kietdat123@gmail.com', NULL, '0814171601', NULL, 0, 0, NULL, '', 0, 0, 1, 1, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_user_category`
--

CREATE TABLE `admin_user_category` (
  `auc_admin_id` int(11) NOT NULL DEFAULT 0,
  `auc_category_id` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_user_language`
--

CREATE TABLE `admin_user_language` (
  `aul_admin_id` int(11) NOT NULL DEFAULT 0,
  `aul_lang_id` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Đang đổ dữ liệu cho bảng `admin_user_language`
--

INSERT INTO `admin_user_language` (`aul_admin_id`, `aul_lang_id`) VALUES
(4, 1),
(5, 1),
(5, 2),
(6, 1),
(7, 1),
(8, 1),
(8, 2),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(33, 2),
(35, 1),
(36, 1),
(36, 2),
(37, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(46, 1),
(48, 1),
(49, 1),
(49, 2),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(55, 1),
(55, 2),
(56, 1),
(57, 1),
(57, 2),
(58, 1),
(58, 2),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(65, 1),
(65, 2),
(66, 1),
(66, 2),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1),
(135, 1),
(136, 1),
(137, 1),
(138, 1),
(139, 1),
(140, 1),
(141, 1),
(142, 1),
(143, 1),
(144, 1),
(145, 1),
(146, 1),
(147, 1),
(148, 1),
(149, 1),
(150, 1),
(151, 1),
(152, 1),
(153, 1),
(154, 1),
(155, 1),
(156, 1),
(157, 1),
(158, 1),
(159, 1),
(160, 1),
(161, 1),
(162, 1),
(163, 1),
(164, 1),
(165, 1),
(166, 1),
(167, 1),
(168, 1),
(169, 1),
(170, 1),
(171, 1),
(172, 1),
(173, 1),
(174, 1),
(175, 1),
(176, 1),
(177, 1),
(178, 1),
(179, 1),
(180, 1),
(181, 1),
(182, 1),
(183, 1),
(184, 1),
(185, 1),
(186, 1),
(187, 1),
(188, 1),
(189, 1),
(190, 1),
(191, 1),
(192, 1),
(193, 1),
(194, 1),
(195, 1),
(196, 1),
(197, 1),
(198, 1),
(199, 1),
(200, 1),
(201, 1),
(202, 1),
(203, 1),
(204, 1),
(205, 1),
(206, 1),
(207, 1),
(208, 1),
(209, 1),
(210, 1),
(211, 1),
(212, 1),
(213, 1),
(214, 1),
(215, 1),
(216, 1),
(217, 1),
(218, 1),
(219, 1),
(220, 1),
(221, 1),
(222, 1),
(223, 1),
(224, 1),
(225, 1),
(226, 1),
(227, 1),
(228, 1),
(229, 1),
(230, 1),
(231, 1),
(232, 1),
(233, 1),
(234, 1),
(235, 1),
(236, 1),
(237, 1),
(238, 1),
(239, 1),
(240, 1),
(241, 1),
(242, 1),
(243, 1),
(244, 1),
(245, 1),
(246, 1),
(247, 1),
(248, 1),
(249, 1),
(250, 1),
(251, 1),
(252, 1),
(253, 1),
(254, 1),
(255, 1),
(256, 1),
(257, 1),
(258, 1),
(259, 1),
(260, 1),
(261, 1),
(262, 1),
(263, 1),
(264, 1),
(265, 1),
(266, 1),
(267, 1),
(268, 1),
(269, 1),
(270, 1),
(271, 1),
(272, 1),
(273, 1),
(274, 1),
(275, 1),
(276, 1),
(277, 1),
(278, 1),
(279, 1),
(280, 1),
(281, 1),
(282, 1),
(283, 1),
(284, 1),
(285, 1),
(286, 1),
(287, 1),
(288, 1),
(289, 1),
(290, 1),
(291, 1),
(292, 1),
(293, 1),
(294, 1),
(295, 1),
(296, 1),
(297, 1),
(298, 1),
(299, 1),
(300, 1),
(301, 1),
(302, 1),
(303, 1),
(304, 1),
(305, 1),
(306, 1),
(307, 1),
(308, 1),
(309, 1),
(310, 1),
(311, 1),
(312, 1),
(313, 1),
(314, 1),
(315, 1),
(316, 1),
(317, 1),
(318, 1),
(319, 1),
(320, 1),
(321, 1),
(322, 1),
(323, 1),
(324, 1),
(325, 1),
(326, 1),
(327, 1),
(328, 1),
(329, 1),
(330, 1),
(331, 1),
(332, 1),
(333, 1),
(334, 1),
(335, 1),
(336, 1),
(337, 1),
(338, 1),
(339, 1),
(340, 1),
(341, 1),
(342, 1),
(343, 1),
(344, 1),
(345, 1),
(346, 1),
(347, 1),
(348, 1),
(349, 1),
(350, 1),
(351, 1),
(352, 1),
(353, 1),
(354, 1),
(355, 1),
(356, 1),
(357, 1),
(358, 1),
(359, 1),
(360, 1),
(361, 1),
(362, 1),
(363, 1),
(364, 1),
(365, 1),
(366, 1),
(367, 1),
(368, 1),
(369, 1),
(370, 1),
(371, 1),
(372, 1),
(373, 1),
(374, 1),
(375, 1),
(376, 1),
(377, 1),
(378, 1),
(379, 1),
(380, 1),
(381, 1),
(382, 1),
(383, 1),
(384, 1),
(385, 1),
(386, 1),
(387, 1),
(388, 1),
(389, 1),
(390, 1),
(391, 1),
(392, 1),
(393, 1),
(394, 1),
(395, 1),
(396, 1),
(397, 1),
(398, 1),
(399, 1),
(400, 1),
(401, 1),
(402, 1),
(403, 1),
(404, 1),
(405, 1),
(406, 1),
(407, 1),
(408, 1),
(409, 1),
(410, 1),
(411, 1),
(412, 1),
(413, 1),
(414, 1),
(415, 1),
(416, 1),
(417, 1),
(418, 1),
(419, 1),
(420, 1),
(421, 1),
(422, 1),
(423, 1),
(424, 1),
(425, 1),
(426, 1),
(427, 1),
(428, 1),
(429, 1),
(430, 1),
(431, 1),
(432, 1),
(433, 1),
(434, 1),
(435, 1),
(436, 1),
(437, 1),
(438, 1),
(439, 1),
(440, 1),
(441, 1),
(442, 1),
(443, 1),
(444, 1),
(445, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_user_right`
--

CREATE TABLE `admin_user_right` (
  `adu_admin_id` int(11) NOT NULL,
  `adu_admin_module_id` int(11) NOT NULL DEFAULT 0,
  `adu_add` int(1) DEFAULT 0,
  `adu_edit` int(1) DEFAULT 0,
  `adu_delete` int(1) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Đang đổ dữ liệu cho bảng `admin_user_right`
--

INSERT INTO `admin_user_right` (`adu_admin_id`, `adu_admin_module_id`, `adu_add`, `adu_edit`, `adu_delete`) VALUES
(438, 19, 1, 1, 1),
(439, 67, 1, 0, 0),
(439, 35, 1, 0, 0),
(439, 26, 1, 0, 0),
(439, 24, 0, 0, 0),
(440, 91, 1, 1, 0),
(440, 23, 1, 1, 0),
(440, 19, 1, 1, 1),
(441, 96, 1, 1, 1),
(441, 95, 1, 1, 1),
(441, 92, 1, 1, 1),
(441, 91, 1, 1, 1),
(441, 89, 1, 1, 1),
(441, 88, 1, 1, 1),
(441, 67, 1, 1, 1),
(441, 35, 1, 1, 1),
(441, 26, 1, 1, 1),
(441, 24, 1, 1, 1),
(441, 23, 1, 1, 1),
(441, 19, 1, 1, 1),
(441, 14, 1, 1, 1),
(441, 11, 1, 1, 1),
(442, 11, 1, 1, 1),
(442, 24, 1, 1, 1),
(442, 26, 1, 1, 1),
(442, 35, 1, 1, 1),
(442, 67, 1, 1, 1),
(442, 88, 1, 1, 1),
(442, 89, 1, 1, 1),
(442, 91, 1, 1, 1),
(442, 92, 1, 1, 1),
(442, 95, 1, 1, 1),
(442, 96, 1, 1, 1),
(443, 7, 0, 0, 0),
(444, 7, 1, 1, 0),
(444, 6, 1, 1, 0),
(443, 6, 0, 0, 1),
(445, 13, 1, 1, 1),
(445, 12, 1, 1, 1),
(445, 8, 1, 1, 1),
(445, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories_multi_parent`
--

CREATE TABLE `categories_multi_parent` (
  `cmp_id` int(11) NOT NULL,
  `cmp_name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `cmp_rewrite_name` varchar(255) COLLATE armscii8_bin NOT NULL,
  `cmp_icon` varchar(255) COLLATE armscii8_bin DEFAULT NULL,
  `cmp_has_child` bit(64) NOT NULL,
  `cmp_post` text COLLATE armscii8_bin DEFAULT NULL,
  `cmp_background` varchar(255) COLLATE armscii8_bin DEFAULT NULL,
  `bgt_type` varchar(255) COLLATE armscii8_bin DEFAULT NULL,
  `cmp_meta_description` varchar(255) COLLATE armscii8_bin DEFAULT NULL,
  `cmp_active` bit(64) DEFAULT NULL,
  `cmp_parent_id` int(11) DEFAULT NULL,
  `cmp_order` int(11) NOT NULL,
  `web_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Đang đổ dữ liệu cho bảng `categories_multi_parent`
--

INSERT INTO `categories_multi_parent` (`cmp_id`, `cmp_name`, `cmp_rewrite_name`, `cmp_icon`, `cmp_has_child`, `cmp_post`, `cmp_background`, `bgt_type`, `cmp_meta_description`, `cmp_active`, `cmp_parent_id`, `cmp_order`, `web_id`) VALUES
(1, 'trang chủ', 'trang-chu', '<i class=\"fas fa-home\"></i>', b'0000000000000000000000000000000000000000000000000000000000000000', '<h1>this is port quan ao</h1>', 'clean-slideshow5.jpg,wash-slideshow1.jpg,clean-slideshow6.jpg,clean-slideshow6.jpg,clean-slideshow6.jpg', 'slide', NULL, b'0000000000000000000000000000000000000000000000000000000000000001', NULL, 0, 1),
(2, 'áo', 'ao', '<i class=\"fas fa-home\"></i>', b'0000000000000000000000000000000000000000000000000000000000000000', '<h1>this is post child</h1>', 'clean-slideshow6.jpg', 'static', NULL, b'0000000000000000000000000000000000000000000000000000000000000000', 1, 0, 1),
(3, 'quần', 'quan', '<i class=\"fas fa-home\"></i>', b'0000000000000000000000000000000000000000000000000000000000000000', '<h1>this is post</h1>', 'n-slideshow6.jpg,clean-slideshow6.jpg,clean-slideshow6.jpg', 'slide', NULL, b'0000000000000000000000000000000000000000000000000000000000000000', 1, 0, 1),
(4, 'phụ kiện', 'phu-kien', '<i class=\"fas fa-bell\"></i>', b'0000000000000000000000000000000000000000000000000000000000000001', '<h1>this is post</h1>', 'clean-slideshow5.jpg', 'static', NULL, b'0000000000000000000000000000000000000000000000000000000000000001', NULL, 0, 1),
(5, 'mũ', 'mu', NULL, b'0000000000000000000000000000000000000000000000000000000000000000', '<h1> this is post </h1>', 'clean-slideshow5.jpg', 'static', NULL, b'0000000000000000000000000000000000000000000000000000000000000001', 4, 0, 1),
(6, 'tất', 'tat', NULL, b'0000000000000000000000000000000000000000000000000000000000000000', '<h1>this is post</h1>', 'clean-slideshow5.jpg,wash-slideshow1.jpg,clean-slideshow6.jpg,clean-slideshow6.jpg,clean-slideshow6.jpg', 'slide', 'clean-slideshow5.jpg,wash-slideshow1.jpg,clean-slideshow6.jpg,clean-slideshow6.jpg,clean-slideshow6.jpg', b'0000000000000000000000000000000000000000000000000000000000000001', 4, 0, 1),
(7, 'liên hệ', 'lien-he', '<i class=\"fas fa-moon\"></i>', b'0000000000000000000000000000000000000000000000000000000000000000', '<h1>this is post</h1>', 'clean-slideshow5.jpg,wash-slideshow1.jpg,clean-slideshow6.jpg,clean-slideshow6.jpg,clean-slideshow6.jpg', NULL, NULL, b'0000000000000000000000000000000000000000000000000000000000000001', NULL, 0, 1),
(9, 'dịch vụ vệ sinh', 'dich-vu-ve-sinh', '<i class=\"fas fa-home\"></i>', b'0000000000000000000000000000000000000000000000000000000000000001', 'dsa', 'clean-slideshow5.jpg', 'static', NULL, b'0000000000000000000000000000000000000000000000000000000000000001', NULL, 0, 1),
(10, 'lau nhà', 'lau-nha', '<i class=\"fas fa-home\">', b'0000000000000000000000000000000000000000000000000000000000000001', 'das', 'clean-slideshow5.jpg,wash-slideshow1.jpg,clean-slideshow6.jpg,clean-slideshow6.jpg,clean-slideshow6.jpg', 'slide', 'clean-slideshow5.jpg,wash-slideshow1.jpg,clean-slideshow6.jpg,clean-slideshow6.jpg,clean-slideshow6.jpg', b'0000000000000000000000000000000000000000000000000000000000000001', 9, 0, 1),
(11, 'nhà cao tầng', 'nha-cao-tang', '<i class=\"fas fa-home\"></i>', b'0000000000000000000000000000000000000000000000000000000000000000', NULL, 'clean-slideshow5.jpg', 'static', 'static', b'0000000000000000000000000000000000000000000000000000000000000000', 10, 0, 1),
(12, 'nhà thấp tầng', 'nha-thap-tang', '<i class=\"fas fa-home\">', b'0000000000000000000000000000000000000000000000000000000000000000', NULL, 'clean-slideshow5.jpg', 'static', NULL, b'0000000000000000000000000000000000000000000000000000000000000000', 10, 0, 1),
(15, 'lau vườn', 'lau-vuon', NULL, b'0000000000000000000000000000000000000000000000000000000000000000', 'ddddd', 'clean-slideshow5.jpg,wash-slideshow1.jpg,clean-slideshow6.jpg,clean-slideshow6.jpg,clean-slideshow6.jpg', 'slide', 'ssssssss', b'0000000000000000000000000000000000000000000000000000000000000001', 9, 0, 1),
(16, 'trang chủ', 'trang-chu', NULL, b'0000000000000000000000000000000000000000000000000000000000000000', NULL, NULL, NULL, NULL, NULL, NULL, 0, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `configuration`
--

CREATE TABLE `configuration` (
  `con_id` int(11) NOT NULL,
  `web_id` int(11) NOT NULL,
  `con_admin_email` varchar(255) DEFAULT NULL,
  `con_site_title` varchar(255) DEFAULT NULL,
  `con_meta_description` text DEFAULT NULL,
  `con_meta_keywords` text DEFAULT NULL,
  `con_mod_rewrite` tinyint(1) DEFAULT 0,
  `con_extenstion` varchar(20) DEFAULT '''html''',
  `lang_id` int(11) DEFAULT 1,
  `con_active_contact` bit(1) NOT NULL DEFAULT b'0',
  `con_hotline` varchar(255) DEFAULT NULL,
  `con_hotline_banhang` varchar(255) DEFAULT NULL,
  `con_hotline_hotro_kythuat` varchar(255) DEFAULT NULL,
  `con_address` text DEFAULT NULL,
  `con_background_homepage` varchar(255) DEFAULT NULL,
  `con_info_payment` text DEFAULT NULL,
  `con_fee_transport` text DEFAULT NULL,
  `con_contact_sale` text DEFAULT NULL,
  `con_info_company` text DEFAULT NULL,
  `con_logo_top` varchar(255) DEFAULT NULL,
  `con_logo_bottom` varchar(255) DEFAULT NULL,
  `con_page_fb` text DEFAULT NULL,
  `con_link_fb` varchar(255) DEFAULT NULL,
  `con_link_twiter` varchar(255) DEFAULT NULL,
  `con_link_insta` varchar(255) DEFAULT NULL,
  `con_map` text DEFAULT NULL,
  `con_banner_image` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `con_banner_title` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `con_banner_description` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `con_banner_active` bit(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `configuration`
--

INSERT INTO `configuration` (`con_id`, `web_id`, `con_admin_email`, `con_site_title`, `con_meta_description`, `con_meta_keywords`, `con_mod_rewrite`, `con_extenstion`, `lang_id`, `con_active_contact`, `con_hotline`, `con_hotline_banhang`, `con_hotline_hotro_kythuat`, `con_address`, `con_background_homepage`, `con_info_payment`, `con_fee_transport`, `con_contact_sale`, `con_info_company`, `con_logo_top`, `con_logo_bottom`, `con_page_fb`, `con_link_fb`, `con_link_twiter`, `con_link_insta`, `con_map`, `con_banner_image`, `con_banner_title`, `con_banner_description`, `con_banner_active`) VALUES
(2, 1, 'webcleaning@gmail.com', 'DỊCH VỤ VỆ SINH CHUYÊN NGHIỆP', NULL, NULL, 0, '\'html\'', 1, b'0', '035.955.9225', '096.755.9885', '036485214', 'Nhà 2B Ngõ 19, Liễu Giai, Quận Ba Đình, Hà Nội', NULL, NULL, NULL, NULL, 'Nhà 2B Ngõ 19, Liễu Giai, Quận Ba Đình, Hà Nội', NULL, NULL, NULL, 'https://facebook.com', 'https://twitter.com', 'https://instagram.com', NULL, NULL, NULL, NULL, b'0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `languages`
--

CREATE TABLE `languages` (
  `lang_id` int(11) NOT NULL DEFAULT 0,
  `lang_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang_path` varchar(15) COLLATE utf8_unicode_ci DEFAULT '''home''',
  `lang_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang_domain` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `languages`
--

INSERT INTO `languages` (`lang_id`, `lang_name`, `lang_path`, `lang_image`, `lang_domain`) VALUES
(1, 'Tiếng việt', 'vn', 'data/lang_icon/icon/vietnam-512.png', NULL),
(2, 'English', 'en', 'data/lang_icon/icon/English-icon.png', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `modules`
--

CREATE TABLE `modules` (
  `mod_id` int(11) NOT NULL,
  `mod_name` varchar(100) DEFAULT NULL,
  `mod_path` varchar(255) DEFAULT NULL,
  `mod_listname` varchar(100) DEFAULT NULL,
  `mod_listfile` varchar(100) DEFAULT NULL,
  `mod_order` int(11) DEFAULT 0,
  `mod_help` mediumtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Đang đổ dữ liệu cho bảng `modules`
--

INSERT INTO `modules` (`mod_id`, `mod_name`, `mod_path`, `mod_listname`, `mod_listfile`, `mod_order`, `mod_help`) VALUES
(16, 'Cài Đặt Website', 'WebsiteManage', 'Cài Đặt', 'website.php', 3, NULL),
(15, 'Quản Lý Danh Mục', 'Categories', 'Cài Đặt', 'categories.php', 2, NULL),
(14, 'Cài Đặt Hiển Thị', 'Configuations', 'Cài đặt', 'configuations.php', 1, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(100) DEFAULT NULL,
  `post_description` varchar(100) DEFAULT NULL,
  `post_type_background` varchar(100) DEFAULT NULL,
  `post_image_background` varchar(100) DEFAULT NULL,
  `post_color_background` varchar(100) DEFAULT NULL,
  `post_profile` varchar(100) DEFAULT NULL,
  `post_meta_description` varchar(100) DEFAULT NULL,
  `post_rewrite_name` varchar(100) DEFAULT NULL,
  `cmp_id` int(11) DEFAULT NULL,
  `ptd_id` int(11) DEFAULT NULL,
  `post_type_id` varchar(100) DEFAULT NULL,
  `produce_id` int(11) DEFAULT NULL,
  `post_datetime_create` datetime DEFAULT current_timestamp(),
  `post_datetime_update` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `post`
--

INSERT INTO `post` (`post_id`, `post_title`, `post_description`, `post_type_background`, `post_image_background`, `post_color_background`, `post_profile`, `post_meta_description`, `post_rewrite_name`, `cmp_id`, `ptd_id`, `post_type_id`, `produce_id`, `post_datetime_create`, `post_datetime_update`) VALUES
(1, 'dịch vụ giặt thảm gia đình', 'Dịch vụ giặt thảm tại nhà uy tín chuyên nghiệp tại hà nội. Để góp phần làm đẹp', 'static', 'carpet-cleaning.jpg', '#ffffff', 'carpet-cleaning.jpg', NULL, 'dich-vu-giat-tham-gia-dinh', 1, 1, '1', 1, '2021-05-19 15:21:47', '2021-05-19 15:21:47'),
(2, 'giặt ghế sofa da, sofa nỉ', 'Giặt ghế sofa uy tín chuyên nghiệp tại hà nội của công ty vệ sinh công nghiệp Hà Nội 1', 'static', 'sofa-cleaning.jpeg', '#ffffff', 'sofa-cleaning.jpeg', NULL, 'giat-ghe-sofa-da-va-sofa-ni', 1, 2, '1', 1, '2021-05-19 16:01:17', '2021-05-19 16:01:17'),
(3, 'khuyến mãi lên đến 50%', 'tất các dịch vụ bên chúng tôi đồng loạt giảm giá đến 50% trong ngày hôm nay', 'static', 'window-washing2.jpg', NULL, 'profile.png', NULL, 'khuyen-mai-50%', 1, 3, '2', 2, '2021-05-20 11:03:26', '2021-05-20 11:03:26'),
(4, 'dịch vụ dọn nhà', 'dọn nhà đón tết, lộc đẩy sân', NULL, 'carpet-cleaning.jpg', NULL, NULL, NULL, 'dich-vu-don-nha', 1, 4, '2', 1, '2021-05-24 14:47:43', '2021-05-24 14:47:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_detail`
--

CREATE TABLE `post_detail` (
  `ptd_id` int(11) NOT NULL,
  `ptd_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `post_detail`
--

INSERT INTO `post_detail` (`ptd_id`, `ptd_text`) VALUES
(1, '<div class=\"post\">\r\n    <p>\r\n        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto fuga cumque tempora vero officiis nostrum, et maiores voluptatum voluptates odio, in illum incidunt porro illo facilis corrupti fugit! Sit, voluptatibus?\r\n    </p>\r\n</div>'),
(2, '<div class=\"post\">\r\n    <p>\r\n        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto fuga cumque tempora vero officiis nostrum, et maiores voluptatum voluptates odio, in illum incidunt porro illo facilis corrupti fugit! Sit, voluptatibus?\r\n    </p>\r\n</div>'),
(3, '<div class=\"post\">\r\n    <p>\r\n        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto fuga cumque tempora vero officiis nostrum, et maiores voluptatum voluptates odio, in illum incidunt porro illo facilis corrupti fugit! Sit, voluptatibus?\r\n    </p>\r\n</div>'),
(4, '<div class=\"post\"><p>hahhahaha</p></div>');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post_type`
--

CREATE TABLE `post_type` (
  `post_type_id` int(11) NOT NULL,
  `post_type_title` varchar(100) NOT NULL,
  `post_type_description` varchar(100) DEFAULT NULL,
  `post_type_show` varchar(100) DEFAULT NULL,
  `cmp_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `post_type`
--

INSERT INTO `post_type` (`post_type_id`, `post_type_title`, `post_type_description`, `post_type_show`, `cmp_id`) VALUES
(1, 'services', 'Dịch Vụ Vệ Sinh Công Nghiệp', '1', '1,2'),
(2, 'chương trình khuyến mãi', 'nhân dịp 30-4 và 1-5', '2', '7');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `produce`
--

CREATE TABLE `produce` (
  `produce_id` int(11) NOT NULL,
  `produce_name` varchar(100) NOT NULL,
  `produce_description` varchar(100) DEFAULT NULL,
  `produce_image_path` text DEFAULT NULL,
  `produce_price` float NOT NULL,
  `produce_currency` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `website_config`
--

CREATE TABLE `website_config` (
  `web_id` int(11) NOT NULL,
  `web_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `web_active` bit(1) NOT NULL DEFAULT b'1',
  `web_url` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `web_icon` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `web_description` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `website_config`
--

INSERT INTO `website_config` (`web_id`, `web_name`, `web_active`, `web_url`, `web_icon`, `web_description`) VALUES
(1, 'Dịch Vụ Vệ Sinh Công Nghiệp', b'1', NULL, 'data/web_icon/icon_default/default.png', NULL),
(2, 'Cây Cảnh Hà Nội', b'1', NULL, 'data/web_icon/icon_default/default.png', NULL),
(3, 'Dịch Vụ Test', b'1', NULL, 'data/web_icon/icon/restaurant_website.png', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin_menu_order`
--
ALTER TABLE `admin_menu_order`
  ADD PRIMARY KEY (`amo_admin`,`amo_module`) USING BTREE,
  ADD KEY `amo_order` (`amo_order`) USING BTREE;

--
-- Chỉ mục cho bảng `admin_translate`
--
ALTER TABLE `admin_translate`
  ADD PRIMARY KEY (`tra_keyword`) USING BTREE;

--
-- Chỉ mục cho bảng `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`adm_id`) USING BTREE,
  ADD KEY `adm_date` (`adm_date`) USING BTREE,
  ADD KEY `admin_id` (`admin_id`) USING BTREE,
  ADD KEY `lang_id` (`lang_id`) USING BTREE,
  ADD KEY `adm_isadmin` (`adm_isadmin`) USING BTREE,
  ADD KEY `adm_active` (`adm_active`) USING BTREE,
  ADD KEY `adm_cskh` (`adm_cskh`) USING BTREE;

--
-- Chỉ mục cho bảng `admin_user_language`
--
ALTER TABLE `admin_user_language`
  ADD PRIMARY KEY (`aul_admin_id`,`aul_lang_id`) USING BTREE,
  ADD KEY `aul_lang_id` (`aul_lang_id`) USING BTREE;

--
-- Chỉ mục cho bảng `admin_user_right`
--
ALTER TABLE `admin_user_right`
  ADD PRIMARY KEY (`adu_admin_id`,`adu_admin_module_id`) USING BTREE;

--
-- Chỉ mục cho bảng `categories_multi_parent`
--
ALTER TABLE `categories_multi_parent`
  ADD PRIMARY KEY (`cmp_id`);

--
-- Chỉ mục cho bảng `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`con_id`) USING BTREE;

--
-- Chỉ mục cho bảng `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`lang_id`) USING BTREE;

--
-- Chỉ mục cho bảng `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`mod_id`) USING BTREE;

--
-- Chỉ mục cho bảng `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Chỉ mục cho bảng `post_detail`
--
ALTER TABLE `post_detail`
  ADD PRIMARY KEY (`ptd_id`);

--
-- Chỉ mục cho bảng `post_type`
--
ALTER TABLE `post_type`
  ADD PRIMARY KEY (`post_type_id`);

--
-- Chỉ mục cho bảng `produce`
--
ALTER TABLE `produce`
  ADD PRIMARY KEY (`produce_id`);

--
-- Chỉ mục cho bảng `website_config`
--
ALTER TABLE `website_config`
  ADD PRIMARY KEY (`web_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `adm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=446;

--
-- AUTO_INCREMENT cho bảng `admin_user_right`
--
ALTER TABLE `admin_user_right`
  MODIFY `adu_admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=446;

--
-- AUTO_INCREMENT cho bảng `categories_multi_parent`
--
ALTER TABLE `categories_multi_parent`
  MODIFY `cmp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `configuration`
--
ALTER TABLE `configuration`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `modules`
--
ALTER TABLE `modules`
  MODIFY `mod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `post_detail`
--
ALTER TABLE `post_detail`
  MODIFY `ptd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `post_type`
--
ALTER TABLE `post_type`
  MODIFY `post_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `produce`
--
ALTER TABLE `produce`
  MODIFY `produce_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `website_config`
--
ALTER TABLE `website_config`
  MODIFY `web_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
