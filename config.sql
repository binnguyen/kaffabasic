-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 01, 2015 at 04:28 PM
-- Server version: 5.5.40-0ubuntu1
-- PHP Version: 5.5.12-2ubuntu4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cafebasic`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
`id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `name`, `value`, `type`) VALUES
(1, 'logo', '/img/upload/config/logo-inner.png', 'file'),
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config`
--
ALTER TABLE `config`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
