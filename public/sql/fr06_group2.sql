-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2014 at 04:20 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fr06_group2`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `brand_desc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `brand_desc`) VALUES
(1, 'Smart-OSC', 'Công ty của Việt Nam'),
(2, 'FPT-2', 'Tập đoàn FPT 123'),
(3, 'SB-StarBoba', 'DotaGame'),
(4, 'Dell', 'Công ty máy tính');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category_parentId` int(11) NOT NULL,
  `cate_orderby` int(12) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `fk_category_category_idx` (`category_parentId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_parentId`, `cate_orderby`) VALUES
(2, 'Iphone6', 0, 4),
(3, 'Nokia', 0, 1),
(4, 'Tablet', 0, 3),
(5, 'Laptop', 0, 2),
(6, 'Thực phẩm', 0, 5),
(7, 'Hàng gia dụng', 6, 6),
(8, 'Bàn phím', 7, 7),
(9, 'Tai nghe Beast', 6, 8);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_content` text NOT NULL,
  `comment_status` char(1) DEFAULT '0',
  `comment_name` varchar(128) NOT NULL,
  `comment_email` varchar(128) NOT NULL,
  `comment_date` int(11) DEFAULT NULL,
  `comment_rate` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `fk_comment_product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `config_value` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`config_id`, `config_name`, `config_value`) VALUES
(1, 'number item per page', '7'),
(2, 'number product per page', '9'),
(3, 'image_size_max_with', '1024'),
(4, 'image_size_max_height', '860'),
(5, 'image_thumb_max_with', '177'),
(6, 'image_thumb_max_height', '177'),
(7, 'using_ajax_update', '1'),
(8, 'using_jquery', '1'),
(9, 'upload_dir', './public/admin/images/'),
(10, 'upload_images_product_default_dir', './public/admin/images/product/'),
(11, 'image_type_up_load', 'gif|jpeg|jpg|png'),
(12, 'max_file_size', '1024'),
(13, 'time_to_checkout', '1800'),
(14, 'number_item_limit_before_require_login_or_checkout', '17'),
(15, 'type_of_money', 'dollar|vnd|ndt|cnd'),
(16, 'language', 'vn|uk|fr|sp|jp');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  KEY `fk_Image_product_id_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` int(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `order_fullName` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `order_email` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `order_phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `order_gender` int(1) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE IF NOT EXISTS `orderdetail` (
  `orderdetail_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_price` double NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`orderdetail_id`),
  KEY `fk_OrderDetail_order_id_idx` (`order_id`),
  KEY `fk__idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_date` int(11) NOT NULL,
  `product_desc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_mainImageId` int(11) DEFAULT NULL,
  `product_price` double NOT NULL,
  `product_sale` int(2) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_country` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `fk_product_brand_idx` (`brand_id`),
  KEY `fk_product_thumb_idx` (`product_mainImageId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `productcategory`
--

CREATE TABLE IF NOT EXISTS `productcategory` (
  `productCategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`productCategory_id`),
  KEY `fk_ProductCategory_Product1_idx` (`product_id`),
  KEY `fk_productCategory_Category_idx` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `slider_id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_position` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`slider_id`),
  KEY `fk_Slider_product_id_idx` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_level` int(2) NOT NULL,
  `user_fullName` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_gender` int(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`, `user_level`, `user_fullName`, `user_email`, `user_address`, `user_phone`, `user_gender`) VALUES
(1, 'huandt', 'e10adc3949ba59abbe56e057f20f883e', 2, 'Nguyễn Tuấn Anh', 'anhnt01682@yahoo.com', '0', '0129999999', 1),
(2, 'HuyPham', 'LS2ltulZTMC3WI3W2gCXCjYGrDMvEffkuLGIcTBIRsHQheyJRe', 2, 'Huy', 'tuan_anh_1006@yahoo.com', 'abcdef', '123123', 2),
(6, '2', '6eiDrOfBAxwdiSDN5t/DZWcIjGg/+M3yAXCwx/G7XLGK1wxSUf', 2, '345', '2@yahoo.com', '0', '2', 0),
(11, '12', 'c20ad4d76fe97759aa27a0c99bff6710', 1, '12', '1212@yahoo.com', '0', '12', 1),
(12, 'tuan_anh_1006', 'e2fc714c4727ee9395f324cd2e7f331f', 1, 'Tuan', 'anhnt01682@yahoo.com', '0', '123123', 0),
(13, '12345', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'tuan_anh_1006', 'anhnt01682@yahoo.com', '0', '123123', 1),
(14, 'SuperMan', '202cb962ac59075b964b07152d234b70', 1, '123123', '1212@yahoo.com', '0', '123', 1),
(15, 'abcd', 'c4ca4238a0b923820dcc509a6f75849b', 2, '1', 'anhnt01682@yahoo.com', '0', '1', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_Image_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `fk_OrderDetail_order_id` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_OrderDetail_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_thumb` FOREIGN KEY (`product_mainImageId`) REFERENCES `image` (`image_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `productcategory`
--
ALTER TABLE `productcategory`
  ADD CONSTRAINT `fk_productCategory_Category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ProductCategory_Product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `slider`
--
ALTER TABLE `slider`
  ADD CONSTRAINT `fk_Slider_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
