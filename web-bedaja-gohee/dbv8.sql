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
  `ord_date_added` date NOT NULL,
  `ord_pickup_date` date NOT NULL,
  `ord_pickup_time` time NOT NULL,
  `ord_time_added` time NOT NULL,
  `ord_saved` int(1) NOT NULL DEFAULT 0,
  `ord_status` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ord_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=10000013 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_wbapp.tbl_orders: 1 rows
/*!40000 ALTER TABLE `tbl_orders` DISABLE KEYS */;
INSERT INTO `tbl_orders` (`ord_id`, `ord_customer`, `ord_phone_num`, `ord_date_added`, `ord_pickup_date`, `ord_pickup_time`, `ord_time_added`, `ord_saved`, `ord_status`) VALUES
	(10000011, 'Josh Santos', '09102373494', '2023-06-05', '2023-06-16', '00:00:00', '03:39:07', 1, 1),
	(10000012, 'Naya', '0923456789', '2023-06-05', '2023-06-21', '06:41:00', '03:41:10', 1, 1);
/*!40000 ALTER TABLE `tbl_orders` ENABLE KEYS */;

-- Dumping structure for table db_wbapp.tbl_orders_items
CREATE TABLE IF NOT EXISTS `tbl_orders_items` (
  `ord_id` int(8) NOT NULL DEFAULT 0,
  `prod_id` int(8) NOT NULL DEFAULT 0,
  `ord_qty` int(8) NOT NULL DEFAULT 0,
  `ord_total` float NOT NULL DEFAULT 0,
  KEY `prod_id` (`prod_id`),
  KEY `res_id` (`ord_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_wbapp.tbl_orders_items: 10 rows
/*!40000 ALTER TABLE `tbl_orders_items` DISABLE KEYS */;
INSERT INTO `tbl_orders_items` (`ord_id`, `prod_id`, `ord_qty`, `ord_total`) VALUES
	(10000001, 10000002, 1, 0),
	(10000002, 10000002, 1, 0),
	(10000003, 10000006, 1, 0),
	(10000003, 10000004, 1, 0),
	(10000003, 10000004, 1, 0),
	(10000003, 10000005, 1, 0),
	(10000004, 10000006, 1, 0),
	(10000006, 10000001, 2, 0),
	(10000008, 10000005, 5, 0),
	(10000009, 10000003, 1, 0),
	(10000011, 10000005, 1, 0),
	(10000011, 10000010, 1, 0),
	(10000012, 10000005, 1, 0),
	(10000012, 10000017, 1, 0);
/*!40000 ALTER TABLE `tbl_orders_items` ENABLE KEYS */;

-- Dumping structure for table db_wbapp.tbl_product
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `prod_id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(180) NOT NULL DEFAULT '',
  `prod_description` varchar(180) NOT NULL DEFAULT '',
  `prod_date_added` date NOT NULL,
  `prod_time_added` time NOT NULL,
  `prod_date_updated` date NOT NULL,
  `prod_time_updated` time NOT NULL,
  `type_id` int(3) NOT NULL DEFAULT 0,
  `prod_price` float NOT NULL,
  `prod_status` int(11) NOT NULL,
  PRIMARY KEY (`prod_id`),
  KEY `type_id` (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10000018 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_wbapp.tbl_product: 7 rows
/*!40000 ALTER TABLE `tbl_product` DISABLE KEYS */;
INSERT INTO `tbl_product` (`prod_id`, `prod_name`, `prod_description`, `prod_date_added`, `prod_time_added`, `prod_date_updated`, `prod_time_updated`, `type_id`, `prod_price`, `prod_status`) VALUES
	(10000001, 'Pork Cordon Bleu', 'Pork Cordon Bleu (20 Persons)', '2023-03-07', '08:45:11', '2023-06-05', '03:22:29', 302, 1100, 0),
	(10000002, 'Chicken Lollipop', 'Chicken Lolli (20 Persons)', '2023-03-07', '08:45:34', '2023-06-05', '03:22:05', 301, 900, 0),
	(10000003, 'Buttered Chicken', 'Buttered (20 Persons)', '2023-03-07', '09:40:08', '2023-06-05', '03:22:15', 301, 1000, 0),
	(10000004, 'Crab Relleno', 'Relleno (20 Persons)', '2023-03-07', '09:41:07', '2023-06-05', '03:21:21', 304, 1150, 0),
	(10000005, 'Beef Mechado', 'Mechado (20 Persons)', '2023-03-07', '09:42:19', '2023-06-05', '03:21:00', 303, 1150, 0),
	(10000006, 'Beef Stroganoff', 'Stroganoff', '2023-03-07', '09:44:43', '0000-00-00', '00:00:00', 303, 1150, 0),
	(10000007, 'Chicken Kebob', 'Chicken Balls', '2023-05-15', '17:32:31', '2023-05-15', '17:32:59', 301, 900, 1),
	(10000008, 'Shrimp Tempura', 'Tempura (15 Persons)\r\n', '2023-06-05', '03:15:03', '2023-06-05', '03:20:06', 304, 1200, 1),
	(10000009, 'Fish W/ Buttered Lemon Sauce', 'Buttered (15 Persons)', '2023-06-05', '03:15:52', '2023-06-05', '03:18:37', 304, 1200, 1),
	(10000010, 'Roast Beef', 'Roasted (15 Persons)', '2023-06-05', '03:16:28', '2023-06-05', '03:19:39', 303, 1200, 1),
	(10000011, 'Beef Steak ', 'Steak', '2023-06-05', '03:16:52', '0000-00-00', '00:00:00', 303, 1150, 1),
	(10000012, 'Egg Treasure', 'Egg W/ Pork Meat (20 Persons)', '2023-06-05', '03:17:57', '2023-06-05', '03:20:25', 302, 950, 1),
	(10000013, 'Breaded Pork Chop', 'Pork Chop (20 Persons)', '2023-06-05', '03:23:02', '0000-00-00', '00:00:00', 302, 1100, 1),
	(10000014, 'Pork Stuffed', 'Pork Stuffed (20 Persons)', '2023-06-05', '03:23:41', '0000-00-00', '00:00:00', 302, 1200, 1),
	(10000015, 'Hawaiian Burger', 'Burger', '2023-06-05', '03:24:14', '0000-00-00', '00:00:00', 302, 1050, 1),
	(10000016, 'Pork Fillet Mignon', 'Pork Fillet ', '2023-06-05', '03:24:52', '0000-00-00', '00:00:00', 302, 1250, 1),
	(10000017, 'Chicken Curry ', 'Curry (20 Persons)', '2023-06-05', '03:25:42', '0000-00-00', '00:00:00', 301, 950, 1);
/*!40000 ALTER TABLE `tbl_product` ENABLE KEYS */;

-- Dumping structure for table db_wbapp.tbl_product_type
CREATE TABLE IF NOT EXISTS `tbl_product_type` (
  `type_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(180) NOT NULL DEFAULT '',
  `type_date_added` date NOT NULL,
  `type_time_added` time NOT NULL,
  `type_date_updated` date NOT NULL,
  `type_time_updated` time NOT NULL,
  `type_status` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=305 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_wbapp.tbl_product_type: 4 rows
/*!40000 ALTER TABLE `tbl_product_type` DISABLE KEYS */;
INSERT INTO `tbl_product_type` (`type_id`, `type_name`, `type_date_added`, `type_time_added`, `type_date_updated`, `type_time_updated`, `type_status`) VALUES
	(301, 'Chicken', '2023-03-07', '08:35:12', '0000-00-00', '00:00:00', 1),
	(302, 'Pork', '2023-03-07', '08:35:12', '0000-00-00', '00:00:00', 1),
	(303, 'Beef', '2023-03-07', '08:35:12', '0000-00-00', '00:00:00', 1),
	(304, 'Seafood', '2023-03-07', '08:35:12', '0000-00-00', '00:00:00', 1);
/*!40000 ALTER TABLE `tbl_product_type` ENABLE KEYS */;

-- Dumping structure for table db_wbapp.tbl_type
CREATE TABLE IF NOT EXISTS `tbl_type` (
  `type_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(180) NOT NULL DEFAULT '',
  `type_date_added` date NOT NULL,
  `type_time_added` time NOT NULL,
  `type_date_updated` date NOT NULL,
  `type_time_updated` time NOT NULL,
  `type_status` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`type_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=23454 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_wbapp.tbl_type: 10 rows
/*!40000 ALTER TABLE `tbl_type` DISABLE KEYS */;
INSERT INTO `tbl_type` (`type_id`, `type_name`, `type_date_added`, `type_time_added`, `type_date_updated`, `type_time_updated`, `type_status`) VALUES
	(23432, 'Beers', '2023-03-22', '09:11:36', '0000-00-00', '00:00:00', 1),
	(23431, 'Cocktails', '2023-03-22', '09:11:29', '0000-00-00', '00:00:00', 1),
	(23430, 'Beverages', '2023-03-22', '09:11:20', '0000-00-00', '00:00:00', 1),
	(23433, 'Noodles', '2023-03-22', '09:11:42', '0000-00-00', '00:00:00', 1),
	(23434, 'Rice Meals With Drinks', '2023-03-22', '09:11:54', '0000-00-00', '00:00:00', 1),
	(23435, 'Starters', '2023-03-22', '09:12:00', '0000-00-00', '00:00:00', 1),
	(23436, 'Pizza', '2023-03-22', '09:12:05', '0000-00-00', '00:00:00', 1),
	(23437, 'Rice Bowls', '2023-03-22', '09:12:12', '0000-00-00', '00:00:00', 1),
	(23440, 'Others', '2023-03-22', '11:08:18', '0000-00-00', '00:00:00', 1),
	(23453, 'Others', '2023-03-23', '10:56:37', '0000-00-00', '00:00:00', 1);
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
) ENGINE=MyISAM AUTO_INCREMENT=10000021 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_wbapp.tbl_users: 2 rows
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` (`user_id`, `user_lastname`, `user_firstname`, `user_email`, `user_password`, `user_date_added`, `user_time_added`, `user_date_updated`, `user_time_updated`, `user_status`, `user_token`, `user_access`) VALUES
	(10000018, 'Ajero', 'Vester Ajero', 'vester@gmail.com', '3e7388ed35f3b651b38dd0fb8e398ba8', '2023-06-04', '21:00:41', '0000-00-00', '00:00:00', 1, '', 'Manager'),
	(10000020, 'Nase', 'Pablo', 'nase@gmail.com', '6c1e77eb6aa5d2e1cc84b719622cf73c', '2023-06-05', '01:49:38', '0000-00-00', '00:00:00', 1, '', 'Staff'),
	(10000015, 'Bedaja', 'Arabella', '', '633de4b0c14ca52ea2432a3c8a5c4c31', '2023-06-04', '02:16:09', '2023-06-05', '04:03:02', 1, '', 'Staff');
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
