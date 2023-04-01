-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.27-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_wbapp
CREATE DATABASE IF NOT EXISTS `db_wbapp` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `db_wbapp`;

-- Dumping structure for table db_wbapp.tbl_orders
CREATE TABLE IF NOT EXISTS `tbl_orders` (
  `ord_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `ord_customer` varchar(180) NOT NULL DEFAULT '',
  `ord_phone_num` varchar(50) NOT NULL DEFAULT '',
  `ord_description` varchar(180) NOT NULL DEFAULT '',
  `ord_amount` int(10) NOT NULL DEFAULT 0,
  `ord_date_added` date NOT NULL,
  `ord_orders_date` date NOT NULL,
  `ord_orders_time` time NOT NULL,
  `ord_time_added` time NOT NULL,
  `ord_saved` int(1) NOT NULL DEFAULT 0,
  `ord_status` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ord_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10000003 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_wbapp.tbl_orders: 2 rows
/*!40000 ALTER TABLE `tbl_orders` DISABLE KEYS */;
INSERT INTO `tbl_orders` (`ord_id`, `ord_customer`, `ord_phone_num`, `ord_description`, `ord_amount`, `ord_date_added`, `ord_orders_date`, `ord_orders_time`, `ord_time_added`, `ord_saved`, `ord_status`) VALUES
	(10000001, 'Jay Antonilla', '1234', '', 0, '2023-03-07', '2023-03-19', '14:43:00', '08:42:24', 1, 1),
	(10000002, 'Dave Buyco', '923457000', '', 0, '2023-03-07', '2023-03-21', '15:30:00', '09:23:29', 1, 1);
/*!40000 ALTER TABLE `tbl_orders` ENABLE KEYS */;

-- Dumping structure for table db_wbapp.tbl_orders_items
CREATE TABLE IF NOT EXISTS `tbl_orders_items` (
  `ord_id` int(8) NOT NULL DEFAULT 0,
  `prod_id` int(8) NOT NULL DEFAULT 0,
  `ord_qty` int(8) NOT NULL DEFAULT 0,
  `ord_total_am` float NOT NULL DEFAULT 0,
  KEY `prod_id` (`prod_id`),
  KEY `res_id` (`ord_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_wbapp.tbl_orders_items: 2 rows
/*!40000 ALTER TABLE `tbl_orders_items` DISABLE KEYS */;
INSERT INTO `tbl_orders_items` (`ord_id`, `prod_id`, `ord_qty`, `ord_total_am`) VALUES
	(10000001, 10000002, 1, 0),
	(10000002, 10000002, 1, 0);
/*!40000 ALTER TABLE `tbl_orders_items` ENABLE KEYS */;

-- Dumping structure for table db_wbapp.tbl_product
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `prod_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(180) NOT NULL DEFAULT '',
  `prod_description` varchar(180) NOT NULL DEFAULT '',
  `prod_image` varchar(180) NOT NULL DEFAULT '',
  `prod_date_added` date NOT NULL,
  `prod_time_added` time NOT NULL,
  `prod_date_updated` date NOT NULL,
  `prod_time_updated` time NOT NULL,
  `prod_status` int(1) NOT NULL DEFAULT 0,
  `type_id` int(3) NOT NULL DEFAULT 0,
  `prod_price` float NOT NULL,
  PRIMARY KEY (`prod_id`),
  KEY `type_id` (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10000007 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_wbapp.tbl_product: 6 rows
/*!40000 ALTER TABLE `tbl_product` DISABLE KEYS */;
INSERT INTO `tbl_product` (`prod_id`, `prod_name`, `prod_description`, `prod_image`, `prod_date_added`, `prod_time_added`, `prod_date_updated`, `prod_time_updated`, `prod_status`, `type_id`, `prod_price`) VALUES
	(10000001, 'Pork Cordon Bleu', 'Pork Cordon Bleu', '', '2023-03-07', '08:45:11', '0000-00-00', '00:00:00', 1, 302, 1100),
	(10000002, 'Chicken Lollipop', 'Chicken Lolli', '', '2023-03-07', '08:45:34', '0000-00-00', '00:00:00', 1, 301, 900),
	(10000003, 'Buttered Chicken', 'Buttered', '', '2023-03-07', '09:40:08', '0000-00-00', '00:00:00', 1, 301, 1000),
	(10000004, 'Crab Relleno', 'Relleno', '', '2023-03-07', '09:41:07', '0000-00-00', '00:00:00', 1, 304, 1150),
	(10000005, 'Beef Mechado', 'Mechado', '', '2023-03-07', '09:42:19', '0000-00-00', '00:00:00', 1, 303, 1150),
	(10000006, 'Beef Stroganoff', 'Stroganoff', '', '2023-03-07', '09:44:43', '0000-00-00', '00:00:00', 1, 303, 1150);
/*!40000 ALTER TABLE `tbl_product` ENABLE KEYS */;

-- Dumping structure for table db_wbapp.tbl_product_inv
CREATE TABLE IF NOT EXISTS `tbl_product_inv` (
  `res_id` int(8) NOT NULL DEFAULT 0,
  `prod_id` int(8) NOT NULL DEFAULT 0,
  `prod_qty` int(8) NOT NULL DEFAULT 0,
  KEY `prod_id` (`prod_id`),
  KEY `res_id` (`res_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_wbapp.tbl_product_inv: 2 rows
/*!40000 ALTER TABLE `tbl_product_inv` DISABLE KEYS */;
INSERT INTO `tbl_product_inv` (`res_id`, `prod_id`, `prod_qty`) VALUES
	(10000001, 10000002, 1),
	(10000002, 10000002, 1);
/*!40000 ALTER TABLE `tbl_product_inv` ENABLE KEYS */;

-- Dumping structure for table db_wbapp.tbl_product_pricing
CREATE TABLE IF NOT EXISTS `tbl_product_pricing` (
  `prod_id` int(8) NOT NULL DEFAULT 0,
  `prod_retail_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  KEY `prod_id` (`prod_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_wbapp.tbl_product_pricing: 0 rows
/*!40000 ALTER TABLE `tbl_product_pricing` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_product_pricing` ENABLE KEYS */;

-- Dumping structure for table db_wbapp.tbl_product_qty
CREATE TABLE IF NOT EXISTS `tbl_product_qty` (
  `prodqty_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `prodqty_date_added` date NOT NULL,
  `prodqty_time_added` time NOT NULL,
  `prodqty_date_updated` date NOT NULL,
  `prodqty_time_updated` time NOT NULL,
  `prodqty_quantity` int(10) NOT NULL DEFAULT 0,
  `prod_id` int(8) NOT NULL DEFAULT 0,
  PRIMARY KEY (`prodqty_id`),
  KEY `prod_id` (`prod_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10000001 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_wbapp.tbl_product_qty: 0 rows
/*!40000 ALTER TABLE `tbl_product_qty` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_product_qty` ENABLE KEYS */;

-- Dumping structure for table db_wbapp.tbl_release_inv
CREATE TABLE IF NOT EXISTS `tbl_release_inv` (
  `rel_id` int(8) NOT NULL DEFAULT 0,
  `prod_id` int(8) NOT NULL DEFAULT 0,
  `prod_qty` int(8) NOT NULL DEFAULT 0,
  KEY `prod_id` (`prod_id`),
  KEY `rel_id` (`rel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_wbapp.tbl_release_inv: 0 rows
/*!40000 ALTER TABLE `tbl_release_inv` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_release_inv` ENABLE KEYS */;

-- Dumping structure for table db_wbapp.tbl_release_items
CREATE TABLE IF NOT EXISTS `tbl_release_items` (
  `rel_id` int(8) NOT NULL DEFAULT 0,
  `prod_id` int(8) NOT NULL DEFAULT 0,
  `rel_qty` int(8) NOT NULL DEFAULT 0,
  KEY `rel_id` (`rel_id`),
  KEY `prod_id` (`prod_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_wbapp.tbl_release_items: 0 rows
/*!40000 ALTER TABLE `tbl_release_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_release_items` ENABLE KEYS */;

-- Dumping structure for table db_wbapp.tbl_type
CREATE TABLE IF NOT EXISTS `tbl_type` (
  `type_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(180) NOT NULL DEFAULT '',
  `type_date_added` date NOT NULL,
  `type_time_added` time NOT NULL,
  `type_date_updated` date NOT NULL,
  `type_time_updated` time NOT NULL,
  `type_status` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=305 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_wbapp.tbl_type: 4 rows
/*!40000 ALTER TABLE `tbl_type` DISABLE KEYS */;
INSERT INTO `tbl_type` (`type_id`, `type_name`, `type_date_added`, `type_time_added`, `type_date_updated`, `type_time_updated`, `type_status`) VALUES
	(301, 'Chicken', '2023-03-07', '08:35:12', '0000-00-00', '00:00:00', 1),
	(302, 'Pork', '2023-03-07', '08:35:12', '0000-00-00', '00:00:00', 1),
	(303, 'Beef', '2023-03-07', '08:35:12', '0000-00-00', '00:00:00', 1),
	(304, 'Seafood', '2023-03-07', '08:35:12', '0000-00-00', '00:00:00', 1);
/*!40000 ALTER TABLE `tbl_type` ENABLE KEYS */;

-- Dumping structure for table db_wbapp.tbl_users
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_lastname` varchar(180) NOT NULL DEFAULT '',
  `user_firstname` varchar(180) NOT NULL DEFAULT '',
  `user_email` varchar(180) NOT NULL DEFAULT '',
  `user_password` varchar(180) NOT NULL DEFAULT '',
  `user_date_added` date NOT NULL,
  `user_time_added` time NOT NULL,
  `user_date_updated` date NOT NULL,
  `user_time_updated` time NOT NULL,
  `user_status` int(1) NOT NULL DEFAULT 0,
  `user_token` varchar(255) NOT NULL DEFAULT '',
  `user_access` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10000004 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_wbapp.tbl_users: 3 rows
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` (`user_id`, `user_lastname`, `user_firstname`, `user_email`, `user_password`, `user_date_added`, `user_time_added`, `user_date_updated`, `user_time_updated`, `user_status`, `user_token`, `user_access`) VALUES
	(10000001, 'Bedaja', 'Ella Marie', 'ella@gmail.com', 'mm', '2023-03-03', '17:40:22', '2023-03-03', '17:50:38', 1, '', 'Staff'),
	(10000002, 'Bedaja', 'Arabella', 'arabedaja@gmail.com', 'NB', '2023-03-04', '16:10:41', '0000-00-00', '00:00:00', 1, '', 'Staff'),
	(10000003, 'Gevero', 'Remart ', 'gevero@gmail.com', 'gv', '2023-03-07', '08:01:49', '0000-00-00', '00:00:00', 1, '', 'Staff');
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
