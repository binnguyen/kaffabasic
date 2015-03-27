-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2015 at 11:50 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `velacafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `isdelete` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `isdelete`) VALUES
(1, 'Soup', 0),
(2, 'Vegetarian With Steam Rice', 0),
(3, 'Chicken With Steam Rice', 0),
(4, 'Beef With Steam Rice', 0),
(5, 'Shrimp With Steam Rice', 0),
(6, 'Appertizer', 0),
(7, 'Beef Rice Noddle Soup', 0),
(8, 'Rice Noddle With Pork Broth', 0),
(9, 'Egg Noddle With Pork Broth', 0),
(10, 'Rice ', 0),
(11, 'Chicken', 0),
(12, 'Drink', 0);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
`id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `name`, `value`, `type`) VALUES
(1, 'logo', '/img/upload/config/KAFFA-NEN-TRANG-h40-w250.png', 'file'),
(2, 'logo_printer', '/img/upload/config/logo-KAFFA.png', 'file'),
(3, 'print_phone', '08.66 8484 91', 'text'),
(4, 'print_address', '47 - Ho Ba Kien - P.15 - Q10 - TP HCM', 'text'),
(5, 'max_quantity_order', '22', 'text'),
(6, 'thank_text', 'Thank you. See you again', 'text'),
(7, 'currency', '$', 'text'),
(8, 'end_year', '2030', 'text'),
(9, 'emailId', 'kaffacoffee47@gmail.com', 'text'),
(10, 'emailPassword', 'vela2013#', 'text'),
(11, 'sitename', 'Kaffa Coffe', 'text'),
(12, 'print_number', '1', 'text'),
(13, 'key_note', 'Key note', 'text'),
(14, 'number_decimal', '2', 'text'),
(15, 'currency_before', '1', 'text'),
(16, 'lang', 'en_us', 'text');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE IF NOT EXISTS `coupon` (
`id` int(11) NOT NULL,
  `code` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `value` double NOT NULL,
  `fromdate` bigint(20) NOT NULL,
  `todate` bigint(20) NOT NULL,
  `isdelete` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `reuse` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `value`, `fromdate`, `todate`, `isdelete`, `type`, `description`, `reuse`) VALUES
(30, 'F1FDEDBC', 20, 1425142800, 1456765200, 0, 1, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `managetable`
--

CREATE TABLE IF NOT EXISTS `managetable` (
`id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `isdelete` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `managetable`
--

INSERT INTO `managetable` (`id`, `name`, `isdelete`) VALUES
(1, 'A1', 0),
(2, 'A2', 0),
(3, 'A3', 0),
(4, 'A4', 0),
(5, 'A5', 0),
(6, 'A6', 0),
(7, 'A7', 0),
(8, 'A8', 0),
(9, 'A9', 0),
(10, 'A10', 0),
(11, 'B1', 0),
(12, 'B2', 0),
(13, 'B3', 0),
(14, 'B4', 0),
(15, 'B5', 0),
(16, 'B6', 0),
(17, 'B7', 0),
(18, 'B8', 0),
(19, 'B9', 0),
(20, 'B10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `cost` double NOT NULL,
  `take_away_cost` double NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8_unicode_ci NOT NULL,
  `cat_id` int(11) NOT NULL,
  `is_combo` int(11) DEFAULT NULL,
  `isdelete` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `cost`, `take_away_cost`, `description`, `image`, `cat_id`, `is_combo`, `isdelete`) VALUES
(1, 'menu-1', 26000, 21000, '', ' ', 1, 0, 1),
(2, 'menu-2', 30000, 24000, '', ' ', 1, 0, 1),
(3, 'menu-3', 30000, 24000, '', ' ', 1, 0, 1),
(4, 'menu-4', 26000, 21000, '', ' ', 1, 0, 1),
(5, 'menu-5', 30000, 24000, '', ' ', 1, 0, 1),
(6, 'menu-6', 30000, 24000, '', ' ', 2, 0, 1),
(7, 'menu-7', 30000, 24000, '', ' ', 2, 0, 1),
(8, 'menu-8', 30000, 24000, '', ' ', 2, 0, 1),
(9, 'menu-9', 30000, 24000, '', ' ', 2, 0, 1),
(10, 'menu-10', 30000, 24000, '', ' ', 2, 0, 1),
(11, 'menu-11', 35000, 28000, '', ' ', 2, NULL, 1),
(12, 'menu-12', 35000, 28000, '', ' ', 2, 0, 1),
(13, 'menu-13', 35000, 28000, '', ' ', 2, 0, 1),
(14, 'menu-14', 40000, 32000, '', ' ', 3, 0, 1),
(15, 'menu-15', 35000, 28000, '', ' ', 3, 0, 1),
(16, 'menu-16', 30000, 24000, '', ' ', 3, 0, 1),
(17, 'menu-17', 40000, 32000, '', ' ', 3, 0, 1),
(18, 'menu-18', 30000, 24000, '', ' ', 3, 0, 1),
(19, 'menu-19', 30000, 24000, '', ' ', 3, NULL, 1),
(20, 'menu-20', 35000, 28000, '', ' ', 3, 0, 1),
(21, 'menu-21', 32000, 26000, '', ' ', 4, 0, 1),
(22, 'menu-22', 32000, 26000, '', ' ', 4, 0, 1),
(23, 'menu-23', 32000, 26000, '', ' ', 4, 0, 1),
(24, 'menu-24', 32000, 26000, '', ' ', 4, 0, 1),
(25, 'menu-25', 32000, 26000, '', ' ', 4, NULL, 1),
(26, 'menu-26', 32000, 26000, '', ' ', 4, 0, 1),
(27, 'menu-27', 32000, 26000, '', ' ', 4, 0, 1),
(28, 'menu-28', 32000, 26000, '', ' ', 4, 0, 1),
(29, 'menu-29', 32000, 26000, '', ' ', 4, 0, 1),
(30, 'menu-30', 32000, 26000, '', ' ', 4, 0, 1),
(31, 'menu-31', 38000, 32000, '', ' ', 5, 0, 1),
(32, 'menu-32', 38000, 32000, '', ' ', 5, 0, 1),
(33, 'menu-33', 40000, 32000, '', ' ', 5, 0, 1),
(34, 'menu-34', 38000, 32000, '', ' ', 5, 0, 1),
(35, 'menu-35', 40000, 34000, '', ' ', 5, 0, 1),
(36, 'menu-36', 38000, 32000, '', ' ', 5, 0, 1),
(37, 'menu-37', 38000, 32000, '', ' ', 5, 0, 1),
(38, 'menu-38', 40000, 34000, '', ' ', 5, 0, 1),
(39, 'menu-39', 42000, 36000, '', ' ', 6, 0, 1),
(40, 'menu-40', 38000, 32000, '', ' ', 6, 0, 1),
(41, 'menu-41', 38000, 32000, '', ' ', 6, 0, 1),
(42, 'menu-42', 38000, 32000, '', ' ', 6, 0, 1),
(43, 'menu-43', 35000, 0, '', ' ', 7, NULL, 1),
(44, 'menu-44', 45000, 0, '', ' ', 7, NULL, 1),
(45, 'menu-45', 40000, 0, '', ' ', 7, NULL, 1),
(46, 'menu-46', 45000, 0, '', ' ', 7, 0, 1),
(47, 'menu-47', 35000, 0, '', ' ', 7, NULL, 1),
(48, 'menu-48', 35000, 0, '', ' ', 7, NULL, 1),
(49, 'menu-49', 35000, 0, '', ' ', 7, NULL, 1),
(50, 'menu-50', 20000, 0, '', ' ', 7, NULL, 1),
(51, 'menu-51', 2000, 0, '', ' ', 8, NULL, 1),
(52, 'menu-52', 25000, 25000, '', ' ', 7, NULL, 1),
(53, 'Kung Pao Chicken With Shrimp', 8.95, 8.95, '', ' ', 5, 0, 0),
(54, 'Kung Pao Shrimp', 8.5, 8.5, '', ' ', 5, 0, 0),
(55, 'Sweet and Sour Shrimp', 9.5, 9.5, '', ' ', 5, 0, 0),
(56, 'Shrimp With Block Bean Sause', 8.5, 8.5, '', ' ', 5, NULL, 0),
(57, 'menu-57', 30000, 30000, '', ' ', 7, 0, 1),
(58, 'menu-58', 30000, 30000, '', ' ', 1, 0, 1),
(59, 'menu-59', 25000, 25000, '', ' ', 1, 0, 1),
(60, 'menu-60', 25000, 20000, '', ' ', 7, 0, 1),
(61, 'menu-61', 25000, 25000, '', ' ', 7, 0, 1),
(62, 'menu-62', 25000, 25000, '', ' ', 7, 0, 1),
(63, 'menu-63', 25000, 25000, '', ' ', 8, 0, 1),
(64, 'menu-64', 30000, 30000, '', ' ', 8, 0, 1),
(65, 'menu-65', 30000, 30000, '', ' ', 1, 0, 1),
(66, 'menu-66', 25000, 25000, '', ' ', 1, 0, 1),
(67, 'menu-67', 25000, 25000, '', ' ', 1, 0, 1),
(73, 'menu-73', 30000, 30000, '', ' ', 7, 0, 1),
(74, 'menu-74', 35000, 35000, '', ' ', 3, 0, 1),
(75, 'menu-75', 30000, 30000, '', ' ', 7, 0, 1),
(76, 'menu-76', 30000, 30000, '', ' ', 7, 0, 1),
(77, 'menu-77', 30000, 30000, '', ' ', 7, 0, 1),
(78, 'menu-78', 28000, 28000, '', ' ', 2, 0, 1),
(79, 'menu-79', 32000, 32000, '', ' ', 1, 0, 1),
(80, 'menu-80', 30000, 30000, '', ' ', 7, 0, 1),
(81, 'Broccoli Shrimp', 8.5, 8.5, '', ' ', 5, 0, 0),
(82, 'menu-82', 30000, 24000, '', ' ', 1, NULL, 1),
(83, 'Broccoli Chicken', 7.95, 7.95, '', ' ', 4, 0, 0),
(84, 'Brocolli Beef', 7.95, 7.95, '', ' ', 4, 0, 0),
(85, 'Spicy Steak Beef', 7.95, 7.95, '', ' ', 4, 0, 0),
(86, 'Mongolian Beef', 7.95, 7.95, '', ' ', 4, 0, 0),
(87, 'Lemon Chicken', 7.5, 7.5, '', ' ', 3, NULL, 0),
(88, 'MOO GOO GAIPAN', 7.5, 7.5, '', ' ', 3, NULL, 0),
(89, 'Sweet and Sour Chicken or Pork', 7.5, 7.5, '', ' ', 3, NULL, 0),
(90, 'Kung Pao Chicken', 7.5, 7.5, '', ' ', 3, NULL, 0),
(91, 'Mabo Tofu', 6.95, 6.95, '', ' ', 2, 0, 0),
(92, 'menu-92', 10000, 10000, '', ' ', 1, 0, 1),
(93, 'menu-93', 40000, 40000, '', ' ', 1, 0, 1),
(94, 'menu-94', 42000, 42000, '', ' ', 7, 0, 1),
(95, 'menu-95', 42000, 42000, '', ' ', 7, 0, 1),
(96, 'menu-96', 10000, 10000, '', ' ', 8, 0, 1),
(97, 'menu-97', 42000, 42000, '', ' ', 7, 0, 1),
(98, 'menu-98', 42000, 42000, '', ' ', 7, 0, 1),
(99, 'menu-99', 42000, 42000, '', ' ', 7, 0, 1),
(100, 'menu-100', 42000, 42000, '', ' ', 7, 0, 1),
(101, 'menu-101', 42000, 42000, '', ' ', 7, 0, 1),
(102, 'menu-102', 32000, 32000, '', ' ', 8, 0, 1),
(103, 'menu-103', 42000, 42000, '', ' ', 8, 0, 1),
(104, 'menu-104', 28000, 28000, '', ' ', 2, 0, 1),
(105, 'menu-105', 20000, 20000, '', ' ', 8, 0, 1),
(106, 'menu-106', 30, 30, '', ' ', 2, 0, 1),
(107, 'menu-107', 30000, 30000, '', ' ', 2, 0, 1),
(108, 'menu-108', 15000, 15000, '', ' ', 7, 0, 1),
(111, 'menu-111', 10, 10, '', ' ', 1, 0, 1),
(117, 'menu-117', 28000, 28000, '', ' ', 2, 0, 1),
(118, 'menu-118', 26000, 26000, '', ' ', 1, 0, 1),
(119, 'menu-119', 12000, 12000, '', ' ', 1, 0, 1),
(120, 'Home Style Bean Curd', 6.95, 6.95, '', ' ', 2, NULL, 0),
(121, 'Vegetables Bean Curd', 6.95, 6.95, '', ' ', 2, 0, 0),
(122, 'menu-122', 5000, 5000, '', ' ', 8, 0, 1),
(123, 'menu-123', 40000, 40000, '', ' ', 8, 0, 1),
(124, 'menu-124', 40000, 40000, '', ' ', 8, 0, 1),
(125, 'menu-125', 25000, 25000, '', ' ', 6, 0, 1),
(126, 'menu-126', 32000, 32000, '', ' ', 8, 0, 1),
(127, 'Assorted Vegetables', 6.95, 6.95, '', ' ', 2, 0, 0),
(128, 'Egg Drop Soup', 5.95, 5.95, '', ' ', 1, 0, 0),
(129, 'menu-129', 50000, 50000, '', ' ', 8, 0, 1),
(130, 'Hot and sour soup', 5.95, 5.95, '', ' ', 1, NULL, 0),
(131, 'Won Ton Soup', 5.95, 5.95, '', ' ', 1, 0, 0),
(132, 'Beef Rice Noodle Soup Normal Size', 6.5, 6.5, '', ' ', 7, NULL, 0),
(133, 'Beef Rice Noodle Soup Large Size', 8.95, 8.95, '', ' ', 7, NULL, 0),
(134, 'Crispy Skin Tofu', 3.25, 3.25, '', ' ', 6, NULL, 0),
(135, 'menu-135', 30000, 30000, '', ' ', 1, 0, 1),
(136, 'menu-136', 40000, 40000, '', ' ', 1, 0, 1),
(137, 'menu-137', 40000, 40000, '', ' ', 7, 0, 1),
(138, 'menu-138', 5000, 5000, '', ' ', 8, 0, 1),
(139, '2 springs rolls filled', 3.25, 3.25, '', ' ', 6, NULL, 0),
(140, '2 chrimps spring rolls wrapped', 3.25, 3.25, '', ' ', 6, 0, 0),
(141, '2 srispy eggs rolls filled', 2.5, 2.5, '', ' ', 6, NULL, 0),
(142, 'Egg Noddle Soup with Fish/Shrimp', 7.5, 7.5, '', ' ', 9, 0, 0),
(143, 'Special Egg Noddle Soup', 8.5, 8.5, '', ' ', 9, NULL, 0),
(144, 'Egg Noddle Soup', 5.95, 5.95, '', ' ', 9, NULL, 0),
(145, 'Rice Noddle Soup with Sea Food', 6.5, 6.5, '', ' ', 8, NULL, 0),
(146, 'Special Rice Noddle Soup', 9, 9, '', ' ', 8, NULL, 0),
(147, 'Clear Rice Noddle Soup', 7.5, 7.5, '', ' ', 8, NULL, 0),
(148, 'Sweet Sour Chicken Served / steam rice', 7.5, 7.5, '', ' ', 11, NULL, 0),
(149, 'Chickend Fu-Yung Served w/ Steam Rice', 8.5, 8.5, '', ' ', 11, 0, 0),
(150, 'Stir Fried Chicken /steam rice', 7.5, 7.5, '', ' ', 11, NULL, 0),
(151, 'Egg Rolls, Grilled Pork Served w/fried rice', 7.25, 7.25, '', ' ', 10, 0, 0),
(152, 'Shrimp Fried Rice', 6.75, 6.75, '', ' ', 10, NULL, 0),
(153, 'Grilled Pork Chop Served /steam rice', 6.95, 6.95, '', ' ', 10, NULL, 0),
(154, 'Grilled Pork Served/ steam rice', 5.5, 5.5, '', ' ', 10, NULL, 0),
(155, 'Teriyaki Chicken Served w/ Steam Rice', 4.95, 4.95, '', ' ', 10, 0, 0),
(156, 'Fruits Share', 3.25, 3.25, '', ' ', 12, NULL, 0),
(157, 'menu-157', 10000, 10000, '', ' ', 8, 0, 1),
(158, 'menu-158', 10000, 10000, '', ' ', 1, 0, 1),
(159, 'Young Coconut Juice', 2.25, 2.25, '', ' ', 12, NULL, 0),
(160, 'menu-160', 95000, 95000, '', ' ', 8, 0, 1),
(161, 'menu-161', 40000, 40000, '', ' ', 5, 0, 1),
(162, 'menu-162', 30000, 30000, '', ' ', 8, 0, 1),
(163, 'menu-163', 40000, 40000, '', ' ', 1, 0, 1),
(164, 'menu-164', 40000, 40000, '', ' ', 1, 0, 1),
(165, 'menu-165', 20000, 20000, '', ' ', 1, 0, 1),
(166, 'menu-166', 5000, 5000, '', ' ', 8, 0, 1),
(167, 'menu-167', 8000, 8000, '', ' ', 1, 0, 1),
(168, 'menu-168', 0, 0, '', ' ', 1, 0, 1),
(169, 'menu-169', 26000, 26000, '', ' ', 2, 0, 1),
(170, 'menu-170', 26000, 26000, '', ' ', 6, 0, 1),
(171, 'Penny Worth Leaves Juice', 2.25, 2.25, '', ' ', 12, 0, 0),
(172, 'menu-172', 26000, 26000, '', ' ', 6, 0, 1),
(173, 'Fresh Orange Juice', 2.5, 2.5, '', ' ', 12, 0, 0),
(174, 'Fresh Lemonate', 2.25, 2.25, '', ' ', 12, NULL, 0),
(175, 'menu-175', 5000, 5000, '', ' ', 1, 0, 1),
(176, 'menu-176', 0, 0, '', ' ', 1, 0, 1),
(177, 'menu-177', 20000, 20000, '', ' ', 1, 0, 1),
(178, 'menu-178', 7000, 7000, '', ' ', 1, 0, 1),
(179, 'menu-179', 5000, 5000, '', ' ', 1, 0, 1),
(180, 'menu-180', 10000, 10000, '', ' ', 8, 0, 1),
(181, 'menu-181', 15000, 15000, '', ' ', 1, 0, 1),
(182, 'menu-182', 20000, 20000, '', ' ', 1, 0, 1),
(183, 'menu-183', 20000, 20000, '', ' ', 1, 0, 1),
(184, 'menu-184', 20000, 20000, '', ' ', 1, 0, 1),
(185, 'menu-185', 500000, 500000, '', ' ', 1, 0, 1),
(186, 'Salty Plum Ice Drink', 2.25, 2.25, '', ' ', 12, 0, 0),
(187, 'Thai Ice Tea', 2.25, 2.25, '', ' ', 12, 0, 0),
(188, 'menu-188', 0, 0, '', ' ', 1, 0, 1),
(189, 'menu-189', 28000, 28000, '', ' ', 1, 0, 1),
(190, 'menu-190', 20000, 20000, '', ' ', 9, 0, 1),
(191, 'menu-191', 30000, 30000, '', ' ', 1, 0, 1),
(192, 'menu-192', 5000, 5000, '', ' ', 1, 0, 1),
(193, 'menu-193', 5000, 5000, '', ' ', 1, 0, 1),
(194, 'menu-194', 7000, 7000, '', ' ', 1, 0, 1),
(195, 'menu-195', 42000, 42000, '', ' ', 1, 0, 1),
(196, 'menu-196', 40000, 40000, '', ' ', 1, 0, 1),
(197, 'menu-197', 7000, 7000, '', ' ', 1, 0, 1),
(198, 'menu-198', 10000, 10000, '', ' ', 1, 0, 1),
(199, 'menu-199', 40000, 40000, '', ' ', 1, 0, 1),
(200, 'menu-200', 10000, 10000, '', ' ', 1, 0, 1),
(201, 'menu-201', 10000, 10000, '', ' ', 1, 0, 1),
(202, 'menu-202', 29000, 29000, '', ' ', 1, 0, 1),
(203, 'menu-203', 20000, 20000, '', ' ', 1, 0, 1),
(204, 'menu-204', 18000, 18000, '', ' ', 1, 0, 1),
(205, 'menu-205', 30000, 30000, '', ' ', 1, 0, 1),
(206, 'menu-206', 12000, 12000, '', ' ', 1, 0, 1),
(207, 'menu-207', 32000, 32000, '', ' ', 1, 0, 1),
(208, 'menu-208', 15000, 15000, '', ' ', 1, 0, 1),
(209, 'menu-209', 10000, 10000, '', ' ', 1, 0, 1),
(210, 'menu-210', 10000, 10000, '', ' ', 1, 0, 1),
(211, 'menu-211', 35000, 35000, '', ' ', 1, 0, 1),
(212, 'menu-212', 15000, 15000, '', ' ', 1, 0, 1),
(213, 'menu-213', 35000, 35000, '', ' ', 1, 0, 1),
(214, 'menu-214', 12000, 12000, '', ' ', 1, 0, 1),
(215, 'menu-215', 15000, 15000, '', ' ', 1, 0, 1),
(216, 'menu-216', 26000, 26000, '', ' ', 1, 0, 1),
(217, 'menu-217', 5000, 5000, '', ' ', 1, 0, 1),
(218, 'menu-218', 32000, 32000, '', ' ', 1, 0, 1),
(219, 'Soy Beam Milk', 1.75, 1.75, '', ' ', 12, 0, 0),
(220, 'Soft Drink', 1.25, 1.25, '', ' ', 12, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `create_date` bigint(20) NOT NULL,
  `total_cost` double NOT NULL,
  `total_real_cost` double NOT NULL,
  `isdelete` int(11) NOT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `surtax_id` int(11) NOT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `table_id`, `create_date`, `total_cost`, `total_real_cost`, `isdelete`, `coupon_id`, `user_id`, `surtax_id`, `status`) VALUES
(3, 1, 1427361159, 86000, 86000, 1, -1, 2, 0, 'pending'),
(4, 1, 1427367840, 71.05, 71.05, 0, -1, 1, 0, 'finish'),
(5, 5, 1427368021, 95.65, 95.65, 0, -1, 1, 0, 'finish'),
(6, 1, 1427368005, 48.35, 48.35, 0, -1, 1, 0, 'finish'),
(7, 1, 1427368406, 112.45, 112.45, 0, -1, 1, 0, 'finish');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE IF NOT EXISTS `order_detail` (
`id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `cost_type` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `menu_cost` double NOT NULL,
  `real_cost` int(11) NOT NULL,
  `isdelete` int(11) NOT NULL,
  `discount` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `menu_id`, `cost_type`, `quantity`, `menu_cost`, `real_cost`, `isdelete`, `discount`) VALUES
(10, 4, 81, 1, 4, 8.5, 34, 0, -1),
(11, 4, 53, 1, 4, 8.95, 36, 0, -1),
(12, 4, 220, 1, 1, 1.25, 1, 0, -1),
(26, 6, 55, 1, 1, 9.5, 10, 0, -1),
(27, 6, 56, 1, 1, 8.5, 9, 0, -1),
(28, 6, 81, 1, 1, 8.5, 9, 0, -1),
(29, 6, 83, 1, 1, 7.95, 8, 0, -1),
(30, 6, 84, 1, 1, 7.95, 8, 0, -1),
(31, 6, 128, 1, 1, 5.95, 6, 0, -1),
(32, 5, 145, 1, 3, 6.5, 20, 0, -1),
(33, 5, 54, 1, 1, 8.5, 9, 0, -1),
(34, 5, 56, 1, 1, 8.5, 9, 0, -1),
(35, 5, 83, 1, 1, 7.95, 8, 0, -1),
(36, 5, 91, 1, 1, 6.95, 7, 0, -1),
(37, 5, 220, 1, 5, 1.25, 6, 0, -1),
(38, 5, 55, 1, 4, 9.5, 38, 0, -1),
(43, 7, 55, 1, 1, 9.5, 10, 0, -1),
(44, 7, 53, 1, 7, 8.95, 63, 0, -1),
(45, 7, 56, 1, 1, 8.5, 9, 0, -1),
(46, 7, 83, 1, 4, 7.95, 32, 0, -1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `user_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `full_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `isdelete` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`, `full_name`, `type`, `isdelete`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 1, 0),
(2, 'hung', '3baaa792aa3eec25897a6a84cf8b30a096990336', 'hung', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `managetable`
--
ALTER TABLE `managetable`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `managetable`
--
ALTER TABLE `managetable`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=221;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
