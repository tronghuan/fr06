-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 07, 2014 at 08:14 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fr06_group2`
--
CREATE DATABASE IF NOT EXISTS `fr06_group2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fr06_group2`;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `brand_desc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `brand_desc`) VALUES
(1, 'Smart-OSC', '          Smart OSC'),
(2, 'FPT-2', '                               abc'),
(3, 'SB-StarBoba', 'Sabota'),
(4, 'Dell', '            Công ty máy tính        '),
(5, 'ABC', 'DEMO BRAND'),
(6, 'Brand 2', 'DEMO BRAND'),
(7, 'Brand 3', 'DEMO BRAND'),
(8, 'Brand 4', 'DEMO BRAND'),
(9, 'Brand 5', 'DEMO BRAND');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category_parentId` int(11) DEFAULT NULL,
  `category_order` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`),
  KEY `fk_category_category_idx` (`category_parentId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_parentId`, `category_order`) VALUES
(1, 'Điện thoại', 0, 1),
(2, 'Iphone', 0, 5),
(3, 'Nokia', 1, 2),
(4, 'Tablet', 18, 4),
(5, 'Laptop', 0, 10),
(6, 'Thực phẩm', 0, 6),
(7, 'Hàng gia dụng', 6, 7),
(8, 'Bàn phím', 0, 18),
(9, 'Tai nghe Beast', 7, 8),
(10, 'MTXT', 7, 9),
(11, 'Dell', 0, 11),
(12, 'Latitude', 0, 12),
(13, 'Lenovo', 0, 19),
(14, 'Ban phim', 0, 13),
(18, 'Miracle', 3, 3),
(24, 'maganta', 0, 15),
(25, 'magenta', 0, 16),
(26, 'abc', 0, 17),
(27, 'Main_category', 0, 20),
(28, 'lalala', 0, 21),
(29, 'Dell Xps', 0, 14);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) DEFAULT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('052d20a0c013b5202566a465c68e00e4', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', 1409648441, ''),
('52fc58d492b64047fab7587d038144c9', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', 1409640746, 'a:2:{s:9:"user_data";s:0:"";s:13:"cart_contents";a:7:{s:32:"646d8026a150c196195db2fc7cda4e49";a:7:{s:5:"rowid";s:32:"646d8026a150c196195db2fc7cda4e49";s:2:"id";s:2:"80";s:3:"qty";s:1:"1";s:5:"price";s:6:"230450";s:4:"name";s:14:"HTC Desire 510";s:7:"options";a:2:{s:7:"image_c";s:143:"<img class="thumbnail" width="210px" height="210px" src="http://localhost/fr06/public/images/product/80/Untitled-3.jpg" alt="HTC Desire 510" />";s:7:"image_m";s:132:"<img class="thumbnail" width="" height="" src="http://localhost/fr06/public/images/product/80/Untitled-3.jpg" alt="HTC Desire 510" >";}s:8:"subtotal";i:230450;}s:32:"b8e4005bec349627b9638a44dad272c6";a:7:{s:5:"rowid";s:32:"b8e4005bec349627b9638a44dad272c6";s:2:"id";s:2:"11";s:3:"qty";s:1:"1";s:5:"price";s:6:"230450";s:4:"name";s:19:"Asus Zenfone 4 A450";s:7:"options";a:2:{s:7:"image_c";s:152:"<img class="thumbnail" width="210px" height="210px" src="http://localhost/fr06/public/images/product/11/zenfone-4-a450.jpg" alt="Asus Zenfone 4 A450" />";s:7:"image_m";s:141:"<img class="thumbnail" width="" height="" src="http://localhost/fr06/public/images/product/11/zenfone-4-a450.jpg" alt="Asus Zenfone 4 A450" >";}s:8:"subtotal";i:230450;}s:32:"5164b68198a2c42243ec803b46bd3673";a:7:{s:5:"rowid";s:32:"5164b68198a2c42243ec803b46bd3673";s:2:"id";s:2:"76";s:3:"qty";s:1:"2";s:5:"price";s:6:"207405";s:4:"name";s:14:"Asus Zenfone 4";s:7:"options";a:2:{s:7:"image_c";s:149:"<img class="thumbnail" width="210px" height="210px" src="http://localhost/fr06/public/images/product/76/Asus-Zenfone-4-1.jpg" alt="Asus Zenfone 4" />";s:7:"image_m";s:138:"<img class="thumbnail" width="" height="" src="http://localhost/fr06/public/images/product/76/Asus-Zenfone-4-1.jpg" alt="Asus Zenfone 4" >";}s:8:"subtotal";i:414810;}s:32:"b5f42f02f8af54b570658b2d819a7eae";a:7:{s:5:"rowid";s:32:"b5f42f02f8af54b570658b2d819a7eae";s:2:"id";s:2:"92";s:3:"qty";s:1:"1";s:5:"price";s:6:"675000";s:4:"name";s:18:"Asus FonePad 7-8GB";s:7:"options";a:2:{s:7:"image_c";s:165:"<img class="thumbnail" width="210px" height="210px" src="http://localhost/fr06/public/images/product/92/Asus-FonePad-7FE170CG-360-36.jpg" alt="Asus FonePad 7-8GB" />";s:7:"image_m";s:154:"<img class="thumbnail" width="" height="" src="http://localhost/fr06/public/images/product/92/Asus-FonePad-7FE170CG-360-36.jpg" alt="Asus FonePad 7-8GB" >";}s:8:"subtotal";i:675000;}s:32:"c38a94ae1621e2354878e1fde28dcbcf";a:7:{s:5:"rowid";s:32:"c38a94ae1621e2354878e1fde28dcbcf";s:2:"id";s:3:"100";s:3:"qty";s:1:"1";s:5:"price";s:6:"230450";s:4:"name";s:14:"HTC One Mini 2";s:7:"options";a:2:{s:7:"image_c";s:151:"<img class="thumbnail" width="210px" height="210px" src="http://localhost/fr06/public/images/product/100/HTC-One-Mini-2-36.jpg" alt="HTC One Mini 2" />";s:7:"image_m";s:140:"<img class="thumbnail" width="" height="" src="http://localhost/fr06/public/images/product/100/HTC-One-Mini-2-36.jpg" alt="HTC One Mini 2" >";}s:8:"subtotal";i:230450;}s:11:"total_items";i:6;s:10:"cart_total";i:1781160;}}'),
('53fb1d699410674f5c80c2e77beff507', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', 1409709578, 'a:2:{s:9:"user_data";s:0:"";s:13:"cart_contents";a:4:{s:32:"41f9671a9a846be2afb458353fbc0e17";a:7:{s:5:"rowid";s:32:"41f9671a9a846be2afb458353fbc0e17";s:2:"id";s:2:"80";s:3:"qty";s:1:"1";s:5:"price";s:6:"230450";s:4:"name";s:14:"HTC Desire 510";s:7:"options";a:2:{s:7:"image_c";s:143:"<img class="thumbnail" width="210px" height="210px" src="http://localhost/fr06/public/images/product/80/Untitled-3.jpg" alt="HTC Desire 510" />";s:7:"image_m";s:140:"<img class="thumbnail" width="90px" height="90px" src="http://localhost/fr06/public/images/product/80/Untitled-3.jpg" alt="HTC Desire 510" >";}s:8:"subtotal";i:230450;}s:32:"69941f744c0efeea1f23507d488d6825";a:7:{s:5:"rowid";s:32:"69941f744c0efeea1f23507d488d6825";s:2:"id";s:2:"92";s:3:"qty";s:1:"1";s:5:"price";s:6:"675000";s:4:"name";s:18:"Asus FonePad 7-8GB";s:7:"options";a:2:{s:7:"image_c";s:165:"<img class="thumbnail" width="210px" height="210px" src="http://localhost/fr06/public/images/product/92/Asus-FonePad-7FE170CG-360-36.jpg" alt="Asus FonePad 7-8GB" />";s:7:"image_m";s:162:"<img class="thumbnail" width="90px" height="90px" src="http://localhost/fr06/public/images/product/92/Asus-FonePad-7FE170CG-360-36.jpg" alt="Asus FonePad 7-8GB" >";}s:8:"subtotal";i:675000;}s:11:"total_items";i:2;s:10:"cart_total";i:905450;}}'),
('e5a2f753521e1b79a4879605039d67a3', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', 1409642060, 'a:1:{s:9:"user_data";s:0:"";}');

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
(1, 'number_item_per_page', '7'),
(2, 'number_product_per_page', '8'),
(3, 'image_size_max_with', '1024'),
(4, 'image_size_max_height', '860'),
(5, 'image_thumb_max_with', '177'),
(6, 'image_thumb_max_height', '177'),
(7, 'using_ajax_update', '1'),
(8, 'using_jquery', '1'),
(9, 'upload_dir', './public/admin/images/'),
(10, 'upload_images_product_default_dir', './public/images/product/'),
(11, 'image_type_up_load', 'gif|jpeg|jpg|png'),
(12, 'max_file_size', '1024'),
(13, 'time_to_checkout', '1800'),
(14, 'number_item_limit_before_require_login_or_checkout', '17'),
(15, 'type_of_money', 'dollar|vnd'),
(16, 'language', 'vn|en');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(4) NOT NULL,
  `country_code` char(10) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  PRIMARY KEY (`country_id`),
  KEY `country_code` (`country_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_code`, `country_name`) VALUES
(1, 'US', 'United States'),
(2, 'CA', 'Canada'),
(3, 'AF', 'Afghanistan'),
(4, 'AL', 'Albania'),
(5, 'DZ', 'Algeria'),
(6, 'DS', 'American Samoa'),
(7, 'AD', 'Andorra'),
(8, 'AO', 'Angola'),
(9, 'AI', 'Anguilla'),
(10, 'AQ', 'Antarctica'),
(11, 'AG', 'Antigua and/or Barbuda'),
(12, 'AR', 'Argentina'),
(13, 'AM', 'Armenia'),
(14, 'AW', 'Aruba'),
(15, 'AU', 'Australia'),
(16, 'AT', 'Austria'),
(17, 'AZ', 'Azerbaijan'),
(18, 'BS', 'Bahamas'),
(19, 'BH', 'Bahrain'),
(20, 'BD', 'Bangladesh'),
(21, 'BB', 'Barbados'),
(22, 'BY', 'Belarus'),
(23, 'BE', 'Belgium'),
(24, 'BZ', 'Belize'),
(25, 'BJ', 'Benin'),
(26, 'BM', 'Bermuda'),
(27, 'BT', 'Bhutan'),
(28, 'BO', 'Bolivia'),
(29, 'BA', 'Bosnia and Herzegovina'),
(30, 'BW', 'Botswana'),
(31, 'BV', 'Bouvet Island'),
(32, 'BR', 'Brazil'),
(33, 'IO', 'British lndian Ocean Territory'),
(34, 'BN', 'Brunei Darussalam'),
(35, 'BG', 'Bulgaria'),
(36, 'BF', 'Burkina Faso'),
(37, 'BI', 'Burundi'),
(38, 'KH', 'Cambodia'),
(39, 'CM', 'Cameroon'),
(40, 'CV', 'Cape Verde'),
(41, 'KY', 'Cayman Islands'),
(42, 'CF', 'Central African Republic'),
(43, 'TD', 'Chad'),
(44, 'CL', 'Chile'),
(45, 'CN', 'China'),
(46, 'CX', 'Christmas Island'),
(47, 'CC', 'Cocos (Keeling) Islands'),
(48, 'CO', 'Colombia'),
(49, 'KM', 'Comoros'),
(50, 'CG', 'Congo'),
(51, 'CK', 'Cook Islands'),
(52, 'CR', 'Costa Rica'),
(53, 'HR', 'Croatia (Hrvatska)'),
(54, 'CU', 'Cuba'),
(55, 'CY', 'Cyprus'),
(56, 'CZ', 'Czech Republic'),
(57, 'DK', 'Denmark'),
(58, 'DJ', 'Djibouti'),
(59, 'DM', 'Dominica'),
(60, 'DO', 'Dominican Republic'),
(61, 'TP', 'East Timor'),
(62, 'EC', 'Ecuador'),
(63, 'EG', 'Egypt'),
(64, 'SV', 'El Salvador'),
(65, 'GQ', 'Equatorial Guinea'),
(66, 'ER', 'Eritrea'),
(67, 'EE', 'Estonia'),
(68, 'ET', 'Ethiopia'),
(69, 'FK', 'Falkland Islands (Malvinas)'),
(70, 'FO', 'Faroe Islands'),
(71, 'FJ', 'Fiji'),
(72, 'FI', 'Finland'),
(73, 'FR', 'France'),
(74, 'FX', 'France, Metropolitan'),
(75, 'GF', 'French Guiana'),
(76, 'PF', 'French Polynesia'),
(77, 'TF', 'French Southern Territories'),
(78, 'GA', 'Gabon'),
(79, 'GM', 'Gambia'),
(80, 'GE', 'Georgia'),
(81, 'DE', 'Germany'),
(82, 'GH', 'Ghana'),
(83, 'GI', 'Gibraltar'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'ID', 'Indonesia'),
(101, 'IR', 'Iran (Islamic Republic of)'),
(102, 'IQ', 'Iraq'),
(103, 'IE', 'Ireland'),
(104, 'IL', 'Israel'),
(105, 'IT', 'Italy'),
(106, 'CI', 'Ivory Coast'),
(107, 'JM', 'Jamaica'),
(108, 'JP', 'Japan'),
(109, 'JO', 'Jordan'),
(110, 'KZ', 'Kazakhstan'),
(111, 'KE', 'Kenya'),
(112, 'KI', 'Kiribati'),
(113, 'KP', 'Korea, Democratic People''s Republic of'),
(114, 'KR', 'Korea, Republic of'),
(115, 'XK', 'Kosovo'),
(116, 'KW', 'Kuwait'),
(117, 'KG', 'Kyrgyzstan'),
(118, 'LA', 'Lao People''s Democratic Republic'),
(119, 'LV', 'Latvia'),
(120, 'LB', 'Lebanon'),
(121, 'LS', 'Lesotho'),
(122, 'LR', 'Liberia'),
(123, 'LY', 'Libyan Arab Jamahiriya'),
(124, 'LI', 'Liechtenstein'),
(125, 'LT', 'Lithuania'),
(126, 'LU', 'Luxembourg'),
(127, 'MO', 'Macau'),
(128, 'MK', 'Macedonia'),
(129, 'MG', 'Madagascar'),
(130, 'MW', 'Malawi'),
(131, 'MY', 'Malaysia'),
(132, 'MV', 'Maldives'),
(133, 'ML', 'Mali'),
(134, 'MT', 'Malta'),
(135, 'MH', 'Marshall Islands'),
(136, 'MQ', 'Martinique'),
(137, 'MR', 'Mauritania'),
(138, 'MU', 'Mauritius'),
(139, 'TY', 'Mayotte'),
(140, 'MX', 'Mexico'),
(141, 'FM', 'Micronesia, Federated States of'),
(142, 'MD', 'Moldova, Republic of'),
(143, 'MC', 'Monaco'),
(144, 'MN', 'Mongolia'),
(145, 'ME', 'Montenegro'),
(146, 'MS', 'Montserrat'),
(147, 'MA', 'Morocco'),
(148, 'MZ', 'Mozambique'),
(149, 'MM', 'Myanmar'),
(150, 'NA', 'Namibia'),
(151, 'NR', 'Nauru'),
(152, 'NP', 'Nepal'),
(153, 'NL', 'Netherlands'),
(154, 'AN', 'Netherlands Antilles'),
(155, 'NC', 'New Caledonia'),
(156, 'NZ', 'New Zealand'),
(157, 'NI', 'Nicaragua'),
(158, 'NE', 'Niger'),
(159, 'NG', 'Nigeria'),
(160, 'NU', 'Niue'),
(161, 'NF', 'Norfork Island'),
(162, 'MP', 'Northern Mariana Islands'),
(163, 'NO', 'Norway'),
(164, 'OM', 'Oman'),
(165, 'PK', 'Pakistan'),
(166, 'PW', 'Palau'),
(167, 'PA', 'Panama'),
(168, 'PG', 'Papua New Guinea'),
(169, 'PY', 'Paraguay'),
(170, 'PE', 'Peru'),
(171, 'PH', 'Philippines'),
(172, 'PN', 'Pitcairn'),
(173, 'PL', 'Poland'),
(174, 'PT', 'Portugal'),
(175, 'PR', 'Puerto Rico'),
(176, 'QA', 'Qatar'),
(177, 'RE', 'Reunion'),
(178, 'RO', 'Romania'),
(179, 'RU', 'Russian Federation'),
(180, 'RW', 'Rwanda'),
(181, 'KN', 'Saint Kitts and Nevis'),
(182, 'LC', 'Saint Lucia'),
(183, 'VC', 'Saint Vincent and the Grenadines'),
(184, 'WS', 'Samoa'),
(185, 'SM', 'San Marino'),
(186, 'ST', 'Sao Tome and Principe'),
(187, 'SA', 'Saudi Arabia'),
(188, 'SN', 'Senegal'),
(189, 'RS', 'Serbia'),
(190, 'SC', 'Seychelles'),
(191, 'SL', 'Sierra Leone'),
(192, 'SG', 'Singapore'),
(193, 'SK', 'Slovakia'),
(194, 'SI', 'Slovenia'),
(195, 'SB', 'Solomon Islands'),
(196, 'SO', 'Somalia'),
(197, 'ZA', 'South Africa'),
(198, 'GS', 'South Georgia South Sandwich Islands'),
(199, 'ES', 'Spain'),
(200, 'LK', 'Sri Lanka'),
(201, 'SH', 'St. Helena'),
(202, 'PM', 'St. Pierre and Miquelon'),
(203, 'SD', 'Sudan'),
(204, 'SR', 'Suriname'),
(205, 'SJ', 'Svalbarn and Jan Mayen Islands'),
(206, 'SZ', 'Swaziland'),
(207, 'SE', 'Sweden'),
(208, 'CH', 'Switzerland'),
(209, 'SY', 'Syrian Arab Republic'),
(210, 'TW', 'Taiwan'),
(211, 'TJ', 'Tajikistan'),
(212, 'TZ', 'Tanzania, United Republic of'),
(213, 'TH', 'Thailand'),
(214, 'TG', 'Togo'),
(215, 'TK', 'Tokelau'),
(216, 'TO', 'Tonga'),
(217, 'TT', 'Trinidad and Tobago'),
(218, 'TN', 'Tunisia'),
(219, 'TR', 'Turkey'),
(220, 'TM', 'Turkmenistan'),
(221, 'TC', 'Turks and Caicos Islands'),
(222, 'TV', 'Tuvalu'),
(223, 'UG', 'Uganda'),
(224, 'UA', 'Ukraine'),
(225, 'AE', 'United Arab Emirates'),
(226, 'GB', 'United Kingdom'),
(227, 'UM', 'United States minor outlying islands'),
(228, 'UY', 'Uruguay'),
(229, 'UZ', 'Uzbekistan'),
(230, 'VU', 'Vanuatu'),
(231, 'VA', 'Vatican City State'),
(232, 'VE', 'Venezuela'),
(233, 'VN', 'Vietnam'),
(234, 'VG', 'Virigan Islands (British)'),
(235, 'VI', 'Virgin Islands (U.S.)'),
(236, 'WF', 'Wallis and Futuna Islands'),
(237, 'EH', 'Western Sahara'),
(238, 'YE', 'Yemen'),
(239, 'YU', 'Yugoslavia'),
(240, 'ZR', 'Zaire'),
(241, 'ZM', 'Zambia'),
(242, 'ZW', 'Zimbabwe');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`image_id`, `image_path`, `product_id`, `image_name`) VALUES
(17, 'file_4.jpg', 4, NULL),
(18, 'file_1_3.jpg', 2, NULL),
(19, 'image03.jpg', 5, NULL),
(20, 'dien_thoai_samsung_galaxy_win_i8552.jpg', 6, NULL),
(21, '8xb.jpg', 7, NULL),
(22, 'Samsung-Galaxy-V-kich-800x496-thuoc.jpg', 9, NULL),
(23, 'xl5.jpg', 10, NULL),
(24, 'zenfone-4-a450.jpg', 11, NULL),
(25, 'Asus-Zenfone-4-1.jpg', 76, NULL),
(26, 'asus-zenfone-6_clip_image006.jpg', 79, NULL),
(27, 'Untitled-3.jpg', 80, NULL),
(28, 'ipad-mini_clip_image002.jpg', 81, NULL),
(29, 'Samsung-Galaxy-Tab-4-T311-360-36.jpg', 90, NULL),
(30, 'Samsung-Galaxy-Tab-3-Lite-T111-hinh360-36.jpg', 91, NULL),
(32, 'Sony-Xperia-Z1-360-36.jpg', 93, NULL),
(33, 'iPhone-4S-360-36.jpg', 94, NULL),
(34, 'iPhone-4S-360-36.jpg', 95, NULL),
(35, 'Nokia-Lumia-930-360-36.jpg', 96, NULL),
(36, 'samsung-galaxy-alpha-360-1-35.jpg', 97, NULL),
(37, 'LG-G3-360-36.jpg', 98, NULL),
(38, 'Samsung-Galaxy-Note-3-Neo-360-36.jpg', 99, NULL),
(39, 'HTC-One-Mini-2-36.jpg', 100, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `order_date`, `order_status`, `order_fullName`, `order_email`, `order_address`, `order_phone`, `order_gender`) VALUES
(16, 0, 0, 'abc', 'Hanoi@gmail.com', 'ha noi', '123456789', NULL),
(17, 0, 0, 'wertyu', 'sadfghjk@gamil.com', 'adsfdgfghkjl;', '12345', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`orderdetail_id`, `product_price`, `order_quantity`, `product_id`, `order_id`) VALUES
(8, 230450, 1, 80, 17);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_date` int(11) NOT NULL,
  `product_desc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_info_tech` text,
  `product_mainImageId` int(11) DEFAULT NULL,
  `product_price` double NOT NULL,
  `product_sale` int(2) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `country_id` int(4) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `fk_product_brand_idx` (`brand_id`),
  KEY `fk_product_thumb_idx` (`product_mainImageId`),
  KEY `fk_product_country_idx` (`country_id`) COMMENT '"countrry provide"'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_date`, `product_desc`, `product_info_tech`, `product_mainImageId`, `product_price`, `product_sale`, `brand_id`, `country_id`) VALUES
(2, 'T-Mobile Wing Phone', 1408932567, '<p>Comfort is a very important thing nowadays because it is a&nbsp;<strong>condition</strong>&nbsp;of&nbsp;<em>satisfaction</em>&nbsp;and calmness. It&nbsp;<em>is clear</em>&nbsp;that our way of life must be as&nbsp;<strong>comfortable</strong>&nbsp;as possible. Home electronics&nbsp;<em>satisfy our wishes</em>&nbsp;and make our life&nbsp;<strong>more pleasant</strong>. We must admit that our way of life depends on quality of&nbsp;<em>different goods</em>&nbsp;of popular brands. Many of our clients were surprised by the incredible&nbsp;<strong>assortment of products</strong>&nbsp;in our store. You know, we have many devoted customers all over the world, and this fact proves that we sell only quality commodities. Recipe of our success is a fair price and premium quality. We understand that it is very complicated to amaze present clients, they are so whimsical, but our products are&nbsp;<strong>very flexible</strong>&nbsp;and reliable.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>Here you can find&nbsp;<em>something more</em>&nbsp;than just home electronics; you can find real&nbsp;<strong>comfort and satisfaction here!</strong>&nbsp;Our goods are the combination of perfect design and an ideal functionality. We have a tremendous variety of different models. Nowadays clients&rsquo; claims become so scrupulous that sometimes it is very hard to satisfy them. But we provide only real bestsellers and our products have a great number of options what can really help you. You&rsquo;ll be amazed with its simplicity and durability.Our manufactures and vendors&nbsp;<strong>provide only new technologies</strong>&nbsp;and it is very important because nowadays we see a&nbsp;<em>furious development</em>&nbsp;of electronics industry. Also we provide different economical, social and even technological researches. The main goal of their analysis is to find out the changes of clients&rsquo; demands and other useful data. We are trying to introduce positive results of our explorations.</p>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '1234', 18, 3000000, 12, 7, 7),
(4, 'Kyocera Wildcard Prepaid', 123456789, '<p>Our manufactures and vendors provide only new&nbsp;<strong>technologies</strong>&nbsp;and it is very important because nowadays we see a furious development of electronics industry. Also we provide different economical, social and even technological researches. The main goal of their analysis is to find out the changes of clients&rsquo; demands and other useful data. We are&nbsp;<em>trying to introduce</em>&nbsp;positive results of our explorations.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\r\\\\\\\\n\\\\\\\\r\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\\\\\\\\\r\\\\\\\\\\\\\\\\n\\\\\\\\\\\\\\\\r\\\\\\\\\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\r\\\\\\\\n\\\\\\\\r\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\r\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\n\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\r\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\r\\\\\\\\n\\\\\\\\r\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\\\\\\\\\r\\\\\\\\\\\\\\\\n\\\\\\\\\\\\\\\\r\\\\\\\\\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\r\\\\\\\\n\\\\\\\\r\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>If you want to know more information about our goods, terms, guarantees and other features, you can address our superb&nbsp;<strong>24/7 support</strong>&nbsp;system. Also you can save some money at our store because we always provide different promos and you can get good discount and other benefits.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\r\\\\\\\\n\\\\\\\\r\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\\\\\\\\\r\\\\\\\\\\\\\\\\n\\\\\\\\\\\\\\\\r\\\\\\\\\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\r\\\\\\\\n\\\\\\\\r\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\r\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\n\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\r\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\r\\\\\\\\n\\\\\\\\r\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\\\\\\\\\r\\\\\\\\\\\\\\\\n\\\\\\\\\\\\\\\\r\\\\\\\\\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\r\\\\\\\\n\\\\\\\\r\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>Remember that only in our store&nbsp;<strong>you can buy</strong>&nbsp;fashionable, solid and&nbsp;<strong>very functional</strong>&nbsp;home electronics. Comfort is a&nbsp;<em>very important thing</em>&nbsp;nowadays because it is a condition of satisfaction and calmness. It is clear that our way of life must be as comfortable as possible. Home electronics satisfy our wishes and make our life more pleasant.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\r\\\\\\\\n\\\\\\\\r\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\\\\\\\\\r\\\\\\\\\\\\\\\\n\\\\\\\\\\\\\\\\r\\\\\\\\\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\r\\\\\\\\n\\\\\\\\r\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\r\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\r\\\\\\\\n\\\\\\\\r\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\\\\\\\\\r\\\\\\\\\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\r\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '1234', 17, 19800000, 8, 2, 15),
(5, 'MOTORIZR Z10', 123456789, '<p>Our manufactures and vendors provide only new&nbsp;<strong>technologies</strong>&nbsp;and it is very important because nowadays we see a furious development of electronics industry. Also we provide different economical, social and even technological researches. The main goal of their analysis is to find out the changes of clients&rsquo; demands and other useful data. We are&nbsp;<em>trying to introduce</em>&nbsp;positive results of our explorations.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>If you want to know more information about our goods, terms, guarantees and other features, you can address our superb&nbsp;<strong>24/7 support</strong>&nbsp;system. Also you can save some money at our store because we always provide different promos and you can get good discount and other benefits.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>Remember that only in our store&nbsp;<strong>you can buy</strong>&nbsp;fashionable, solid and&nbsp;<strong>very functional</strong>&nbsp;home electronics. Comfort is a&nbsp;<em>very important thing</em>&nbsp;nowadays because it is a condition of satisfaction and calmness. It is clear that our way of life must be as comfortable as possible. Home electronics satisfy our wishes and make our life more pleasant.</p>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '1234', 19, 20000000, 0, 2, 18),
(6, 'Galaxy Win I8552 White', 123456789, '<h2><strong>Samsung Galaxy Win: Si&ecirc;u nhanh - Si&ecirc;u rẻ</strong></h2>\\r\\n\\r\\n<p><strong>Galaxy Win I8552</strong>&nbsp;l&agrave; điện thoại th&ocirc;ng minh sử dụng CPU 4 nh&acirc;n gi&aacute; rẻ nhất ch&iacute;nh h&atilde;ng. Ngo&agrave;i ra điểm đ&aacute;ng ch&uacute; &yacute; của&nbsp;Samsung Galaxy&nbsp;Win l&agrave; hệ thống cảm biến gi&uacute;p điều khiển m&aacute;y bằng cử chỉ, 2 khe cắm sim (Mini-Sim v&agrave; Micro-Sim), m&agrave;n h&igrave;nh rộng 4.7 inches, hệ điều h&agrave;nh Android OS, v4.1.2 (Jelly Bean) với giao diện t&ugrave;y biến TouchWiz tuyệt đẹp.</p>\\r\\n', '1234', 20, 20000000, 0, 2, 17),
(7, 'HTC 8XC620e Blue', 123456789, '<h2>Điện thoại di động HTC Windows Phone 8X</h2>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p><img alt=\\"\\\\\\\\\\" src=\\"\\\\\\\\\\" /></p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>Chụp bức ảnh rộng gấp đ&ocirc;i với ống k&iacute;nh m&aacute;y ảnh trước c&oacute; g&oacute;c cực rộng.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>Chụp nhiều người hơn trong bức ảnh, trong đ&oacute; c&oacute; cả bạn! Giờ đ&acirc;y, bạn dễ d&agrave;ng chụp được nhiều người hơn trong bức ảnh với m&aacute;y ảnh trước c&oacute; g&oacute;c cực rộng 88&deg; độc nhất. H&atilde;y tận hưởng bức ảnh với nhiều người hơn, khung h&igrave;nh nền rộng hơn, nhiều kỷ niệm hơn.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>Chụp những bức ảnh đ&aacute;ng kinh ngạc&mdash;ngay cả trong điều kiện thiếu &aacute;nh s&aacute;ng.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>HTC ImageChip gi&uacute;p bạn chụp được những bức ảnh c&oacute; chất lượng cao nhất, sắc n&eacute;t, ch&acirc;n thực ngay cả trong điều kiện thiếu &aacute;nh s&aacute;ng chẳng hạn như trong một nh&agrave; h&agrave;ng mờ ảo, chụp ảnh ở trong nh&agrave; hoặc l&uacute;c ho&agrave;ng h&ocirc;n.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>Chụp nhanh mỗi bức ảnh với n&uacute;t chụp ảnh ri&ecirc;ng biệt.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>Lưu giữ những khoảnh khắc đẹp với t&iacute;nh năng k&iacute;ch hoạt tức th&igrave; (ngay cả từ&nbsp;m&agrave;n h&igrave;nh&nbsp;kh&oacute;a!) v&agrave; n&uacute;t m&aacute;y ảnh b&ecirc;n ngo&agrave;i ri&ecirc;ng biệt. Ngắm, chụp, chia sẻ ngay tức th&igrave;.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>Kiểu d&aacute;ng đẹp đi liền với chức năng phong ph&uacute;.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>Sở hữu c&ocirc;ng nghệ mới nhất v&agrave; tuyệt vời nhất tr&ecirc;n một thiết kế độc đ&aacute;o v&agrave; nổi bật. Ch&uacute;ng t&ocirc;i đ&atilde; loại bỏ đi những khe hở kh&ocirc;ng cần thiết v&agrave; c&aacute;c chi tiết cầu kỳ để c&oacute; một chiếc điện thoại ho&agrave;n chỉnh với kiểu d&aacute;ng mượt m&agrave;. Ch&uacute;ng t&ocirc;i đảm bảo bạn sẽ đồng &yacute; rằng 8X cho cảm gi&aacute;c v&ocirc; c&ugrave;ng thoải m&aacute;i khi nghe điện thoại hoặc cầm tr&ecirc;n tay.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>M&agrave;u sắc v&agrave; lớp tr&aacute;ng b&oacute;ng độc đ&aacute;o</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>Lớp tr&aacute;ng b&oacute;ng mờ trở n&ecirc;n cực kỳ đặc biệt với những m&agrave;u sắc kh&aacute;c lạ để ho&agrave;n thiện phong c&aacute;ch c&aacute; nh&acirc;n của bạn.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>M&agrave;n h&igrave;nh sống động v&agrave; rực rỡ trong bất kỳ điều kiện n&agrave;o.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>H&igrave;nh ảnh r&otilde; n&eacute;t hơn bao giờ hết&mdash;ngay cả dưới &aacute;nh nắng trực tiếp hoặc ở g&oacute;c lệch&mdash;tr&ecirc;n m&agrave;n h&igrave;nh hiển thị được d&aacute;t mỏng của HTC với m&agrave;u sắc rực rỡ v&agrave; sắc n&eacute;t với độ tương phản cao. M&agrave;n h&igrave;nh gương Gorilla&reg; nhẹ, cứng c&aacute;p, chống trầy xước, giảm thiểu hao m&ograve;n trong qu&aacute; tr&igrave;nh sử dụng, nhờ vậy bạn c&oacute; thể thưởng thức m&agrave;n h&igrave;nh đẹp, r&otilde; n&eacute;t v&agrave; l&acirc;u bền.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>Khả năng giải tr&iacute; được khuếch đại với bộ khuếch đại độc quyền, c&agrave;i sẵn cho Beats Audio.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>Tận hưởng &acirc;m nhạc theo một c&aacute;ch kh&aacute;c với &acirc;m trầm s&acirc;u hơn, thanh &acirc;m r&otilde; r&agrave;ng hơn v&agrave; những nốt cao sắc n&eacute;t hơn kh&ocirc;ng những khi nghe nhạc m&agrave; cả khi chơi game, xem phim v&agrave; video.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>Thế giới của bạn được cập nhật một c&aacute;ch li&ecirc;n tục.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>&nbsp;</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>Thay đổi k&iacute;ch thước, sắp xếp lại v&agrave; đổi m&agrave;u cho c&aacute;c biểu tượng Tile v&agrave; c&aacute;c Ứng dụng tr&ecirc;n m&agrave;n h&igrave;nh khởi động của bạn, để cập nhật li&ecirc;n tục v&agrave; dễ d&agrave;ng tiếp cận với những thứ bạn y&ecirc;u th&iacute;ch v&agrave; những người quan trọng nhất.</p>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '1234', 21, 20000000, 0, 2, 3),
(9, 'Galaxy G313H White ', 123456789, '<p>Như một m&oacute;n qu&agrave; tri &acirc;n, Samsung tung ra thị trường chiếc smartphone d&agrave;nh ri&ecirc;ng cho thị trường Việt. Chiếc m&aacute;y ra đời dựa tr&ecirc;n những khảo s&aacute;t chi tiết thị trường, nhu cầu v&agrave; th&oacute;i quen của người d&ugrave;ng Việt Nam. M&aacute;y chạy hệ điều h&agrave;nh Android, 2 sim 2 s&oacute;ng, trang bị 2 camera, m&agrave;n h&igrave;nh 4 inch, tăng &acirc;m lượng cuộc gọi gi&uacute;p người d&ugrave;ng sử dụng m&aacute;y thuận tiện trong điều kiện ngo&agrave;i trời, ồn &agrave;o. M&aacute;y thuộc ph&acirc;n kh&uacute;c tầm trung, th&iacute;ch hợp với người d&ugrave;ng trẻ.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\r\\\\\\\\n\\\\\\\\r\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p><img alt=\\"\\\\\\\\\\" src=\\"http://localhost/fr06/public/images/product/9/temp/Samsung-Galaxy-V-kich-800x496-thuoc.jpg\\" />&nbsp;<br />\\r\\n\\\\r\\\\n\\\\\\\\r\\\\\\\\nSản phẩm d&agrave;nh ri&ecirc;ng cho thị trường Việt</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\r\\\\\\\\n\\\\\\\\r\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<h3>Sản phẩm m&agrave;n h&igrave;nh 4inch chuẩn mực</h3>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\r\\\\\\\\n\\\\\\\\r\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>Theo khảo s&aacute;t của Samsung, m&agrave;n h&igrave;nh k&iacute;ch thước 4.0 inch rất được ưa chuộng trong ph&acirc;n kh&uacute;c smartphone gi&aacute; rẻ. Tương tự như Galaxy Trend Lite, Galaxy V được trang bị m&agrave;n h&igrave;nh 4.0 inch, c&ocirc;ng nghệ m&agrave;n h&igrave;nh TFT 16 triệu m&agrave;u, cảm ứng điện dung đa điểm. M&agrave;n h&igrave;nh hiển thị h&igrave;nh ảnh, m&agrave;u sắc kh&aacute; tốt, độ ph&acirc;n giải&nbsp;480x854 px đ&aacute;p ứng việc duyệt web, xem h&igrave;nh ảnh kh&aacute; ch&acirc;n thực, sống động.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\r\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '1234', 22, 20000000, 30, 2, 10),
(10, 'Nokia RM-1013 X2', 123456789, '<p>Th&acirc;n thiện v&agrave; tiện lợi, đ&oacute; l&agrave; những g&igrave; m&agrave; d&ograve;ng Nokia X mang lại cho người d&ugrave;ng. Nokia X2 với sự n&acirc;ng cấp về m&agrave;n h&igrave;nh, cấu h&igrave;nh v&agrave; tiếp tục đưa kh&aacute;ch h&agrave;ng đến những trải nghiệm mượt m&agrave;, sẽ l&agrave; sản phẩm g&acirc;y sốt thị trường sau những th&agrave;nh c&ocirc;ng m&agrave; Nokia X c&oacute; được.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p><img alt=\\"\\\\\\\\\\" src=\\"\\\\\\\\\\" /></p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<h2>Thiết kế nổi bật</h2>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>Nokia X2 Dual Sim được ho&agrave;n thiện với hai lớp mới mẻ, bền bỉ v&agrave; độc đ&aacute;o. Với nhiều m&agrave;u sắc mạnh mẽ, Nokia X2 thiết kế nổi bật v&agrave; ho&agrave;n to&agrave;n vừa vặn trong l&ograve;ng b&agrave;n tay. Lớp vỏ nhựa chất lượng cao vững chắc, bền đẹp, kh&ocirc;ng b&aacute;m v&acirc;n tay. Nokia X2 mang thiết kế ph&ugrave; hợp với nhiều lứa tuổi, cả những bạn trẻ năng động v&agrave; những người lớn tuổi.</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p><img alt=\\"\\\\\\\\\\" src=\\"\\\\\\\\\\" /></p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<h2>M&agrave;n h&igrave;nh 4,3 inch c&ocirc;ng nghệ ClearBack LCD</h2>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>M&agrave;n h&igrave;nh l&agrave; một điểm n&acirc;ng cấp đ&aacute;ng kể của Nokia X2 Dual Sim so với thế hệ Nokia X đầu ti&ecirc;n. K&iacute;ch thước m&agrave;n h&igrave;nh lớn 4,3 inch cho bạn nhiều trải nghiệm hơn, xem phim, chơi game hay l&agrave;m việc cũng dễ d&agrave;ng hơn. C&ocirc;ng nghệ hiển thị Clear Back LCD độc quyền của Nokia gi&uacute;p m&aacute;y hiển thị h&igrave;nh ảnh r&otilde; r&agrave;ng, ngay cả khi dưới điều kiện trời nắng gắt. Mặt k&iacute;nh chống xước bền bỉ, giảm mối lo xước m&agrave;n h&igrave;nh của bạn. Đặc biệt, bạn c&oacute; thể chạm hai lần l&ecirc;n m&agrave;n h&igrave;nh để mở m&aacute;y đầy s&agrave;nh điệu m&agrave; kh&ocirc;ng cần d&ugrave;ng ph&iacute;m nguồn. Một t&iacute;nh năng rất tiện lợi v&agrave; cao cấp.</p>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '1234', 23, 20000000, 0, 2, 8),
(11, 'Asus Zenfone 4 A450', 4, '<p>1234</p>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '1234', 24, 5400000, 0, 3, 225),
(76, 'Asus Zenfone 4', 4, '<p>1234</p>\\r\\n\\r\\n<p>\\\\r\\\\n\\\\r\\\\n</p>\\r\\n\\r\\n<p>\\\\\\\\r\\\\\\\\n</p>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '1234', 25, 6700000, 10, 3, 222),
(79, 'Asus Zenfone 6 A601', 4, '<p>1234</p>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '1234', 26, 12500000, 0, 3, 222),
(80, 'HTC Desire 510', 4, '<p>1234</p>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '1234', 27, 2300000, 0, 3, 222),
(81, 'iPad mini Wifi 16GB', 4, '<p>1234</p>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '1234', 28, 6000000, 0, 3, 222),
(90, 'Galaxy Tab SM-T331', 4, '<p>1234</p>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '1234', 29, 17800000, 0, 3, 222),
(91, 'Galaxy Tab 3 Lite', 4, '<p>1234</p>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '1234', 30, 12400000, 0, 3, 222),
(93, 'Xperia Z1 C6902', 4, '<p>1234</p>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '1234', 32, 7000000, 0, 3, 222),
(94, 'iPhone 4S 8GB', 4, '<p>1234</p>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '1234', 33, 3400000, 0, 3, 222),
(95, 'iPhone 4S 8GB', 4, '<p>1234</p>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '1234', 34, 8000000, 0, 3, 222),
(96, 'Nokia Lumia 930', 4, '<p>1234</p>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '1234', 35, 7999999, 0, 3, 222),
(97, 'Galaxy Alpha', 4, '<p>1234</p>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '1234', 36, 1500000, 0, 3, 222),
(98, 'LG G3 D855 16GB', 4, '<p>1234</p>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '1234', 37, 9900000, 0, 3, 222),
(99, 'Galaxy Note 3 Neo', 4, '<p>1234</p>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '1234', 38, 23000000, 0, 3, 222),
(100, 'HTC One Mini 2', 4, '<p>1234</p>\\r\\n\\r\\n<p>\\\\r\\\\n</p>\\r\\n', '1234', 39, 16000000, 0, 3, 222);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=274 ;

--
-- Dumping data for table `productcategory`
--

INSERT INTO `productcategory` (`productCategory_id`, `category_id`, `product_id`) VALUES
(219, 1, 2),
(221, 1, 5),
(225, 1, 6),
(228, 1, 7),
(231, 1, 9),
(233, 1, 10),
(234, 1, 4),
(237, 1, 11),
(238, 2, 11),
(242, 1, 79),
(244, 1, 80),
(246, 4, 81),
(248, 1, 90),
(250, 1, 91),
(254, 1, 93),
(256, 1, 94),
(258, 1, 95),
(260, 1, 96),
(262, 1, 97),
(264, 1, 98),
(266, 1, 99),
(268, 1, 100),
(269, 1, 76);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `pro_id` int(11) NOT NULL,
  `img_link` text NOT NULL,
  `img_order` int(11) NOT NULL,
  KEY `fk_Slider_product_id_idx` (`img_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`pro_id`, `img_link`, `img_order`) VALUES
(76, '25', 1),
(11, '24', 2),
(7, '21', 3),
(79, '26', 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`, `user_level`, `user_fullName`, `user_email`, `user_address`, `user_phone`, `user_gender`) VALUES
(12, 'tuan_anh_1006', 'e2fc714c4727ee9395f324cd2e7f331f', 1, 'Tuan', 'anhnt01682@yahoo.com', 'The Usa', '123123', 2),
(14, 'SuperMan', '202cb962ac59075b964b07152d234b70', 1, '123123', '1212@yahoo.com', 'Viet nam', '123', 1),
(16, 'binhnh', '1234', 2, 'Nguyen Huy Binh', 'huybinh.ad@gmail.com', 'Viet Nam', '0987654321', 1),
(17, 'huandt', 'e10adc3949ba59abbe56e057f20f883e', 2, 'Đào Trọng Huấn', 'huandt@smartosc.com', 'Viet Nam', '1232456789', 1),
(18, 'dondd', '12345679', 2, 'Nguyễn Đắc Đông', 'dong@gmail.com', 'Việt Nam', '09876543321', 1),
(21, 'dongenverdie', 'laksdjflkasjdflkj', 1, 'ádofijsdlfj', 'dongneverdie@ga.com', 'lskdjflkj', '1234567898', 1),
(22, 'admin', '21232f297a57a5a743894a0e4a801fc3', 2, NULL, NULL, NULL, NULL, NULL);

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
  ADD CONSTRAINT `fk_product_brand` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_country` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_thumb` FOREIGN KEY (`product_mainImageId`) REFERENCES `image` (`image_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `productcategory`
--
ALTER TABLE `productcategory`
  ADD CONSTRAINT `fk_productCategory_Category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ProductCategory_Product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
