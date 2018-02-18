-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.11 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table employees.attendance
CREATE TABLE IF NOT EXISTS `attendance` (
  `attendance_id` int(11) NOT NULL AUTO_INCREMENT,
  `attendance_employee_id` varchar(25) DEFAULT NULL,
  `attendance_timein` datetime DEFAULT NULL,
  `attendance_timeout` datetime DEFAULT NULL,
  `attendance_notes` text,
  `attendance_absent` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`attendance_id`),
  KEY `attendance_id` (`attendance_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Dumping data for table employees.attendance: 7 rows
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
INSERT INTO `attendance` (`attendance_id`, `attendance_employee_id`, `attendance_timein`, `attendance_timeout`, `attendance_notes`, `attendance_absent`) VALUES
	(22, '009', '2018-02-17 19:55:00', '2018-02-17 20:05:00', '', 0),
	(21, '003', '2018-02-17 19:55:00', '2018-02-17 20:00:00', '', 0),
	(20, '007', '2018-02-17 19:55:00', '2018-02-17 20:00:00', '', 0),
	(19, '004', '2018-02-17 18:35:00', '2018-02-17 18:40:00', '', 0),
	(18, '008', '2018-02-17 17:50:00', '2018-02-17 23:28:00', '', 0),
	(17, '002', '2018-02-17 00:00:00', '2018-02-17 00:00:00', 'Got sick.', 1),
	(14, '001', '2018-02-17 07:50:00', '2018-02-17 09:00:00', '', NULL);
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;

-- Dumping structure for table employees.attendance_breakdown
CREATE TABLE IF NOT EXISTS `attendance_breakdown` (
  `attendance_breakdown_id` int(11) NOT NULL AUTO_INCREMENT,
  `total_attendance_id` int(11) DEFAULT NULL,
  `attendance_breakdown_employee_id` varchar(20) NOT NULL,
  `attendance_breakdown_creator_id` int(11) NOT NULL,
  `attendance_breakdown_time_in` datetime DEFAULT NULL,
  `attendance_breakdown_time_out` datetime DEFAULT NULL,
  `attendance_breakdown_duration` int(11) DEFAULT NULL,
  `attendance_breakdown_shift` enum('r','ot') DEFAULT 'r',
  PRIMARY KEY (`attendance_breakdown_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table employees.attendance_breakdown: 10 rows
/*!40000 ALTER TABLE `attendance_breakdown` DISABLE KEYS */;
INSERT INTO `attendance_breakdown` (`attendance_breakdown_id`, `total_attendance_id`, `attendance_breakdown_employee_id`, `attendance_breakdown_creator_id`, `attendance_breakdown_time_in`, `attendance_breakdown_time_out`, `attendance_breakdown_duration`, `attendance_breakdown_shift`) VALUES
	(23, 22, '009', 1, '2018-02-17 19:55:00', '2018-02-17 20:05:00', 10, 'r'),
	(22, 21, '003', 1, '2018-02-17 19:55:00', '2018-02-17 20:00:00', 5, 'r'),
	(21, 20, '007', 1, '2018-02-17 19:55:00', '2018-02-17 20:00:00', 5, 'r'),
	(20, 19, '004', 1, '2018-02-17 18:35:00', '2018-02-17 18:40:00', 5, 'r'),
	(19, 18, '008', 1, '2018-02-17 17:50:00', '2018-02-17 23:28:00', 338, 'r'),
	(18, 14, '001', 1, '2018-02-17 15:36:00', '2018-02-17 21:36:00', 360, 'r'),
	(17, 14, '001', 1, '2018-02-17 13:05:00', '2018-02-17 15:35:00', 150, 'r'),
	(16, 14, '001', 1, '2018-02-17 09:05:00', '2018-02-17 11:50:00', 165, 'r'),
	(15, 14, '001', 1, '2018-02-17 08:55:00', '2018-02-17 09:00:00', 5, 'r'),
	(14, 14, '001', 1, '2018-02-17 07:50:00', '2018-02-17 08:50:00', 60, 'r');
/*!40000 ALTER TABLE `attendance_breakdown` ENABLE KEYS */;

-- Dumping structure for table employees.companies
CREATE TABLE IF NOT EXISTS `companies` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(50) DEFAULT NULL,
  `company_location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table employees.companies: 1 rows
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` (`company_id`, `company_name`, `company_location`) VALUES
	(1, 'Unimac', NULL);
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;

-- Dumping structure for table employees.employees
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(50) NOT NULL,
  `employee_creator_id` int(11) DEFAULT NULL,
  `employee_iqama_id` varchar(20) DEFAULT NULL,
  `employee_computer_id` varchar(20) DEFAULT NULL,
  `employee_full_name` varchar(100) DEFAULT NULL,
  `employee_gender` tinyint(4) DEFAULT NULL,
  `employee_status_id` int(11) DEFAULT NULL,
  `employee_firstname` varchar(50) DEFAULT NULL,
  `employee_middlename` varchar(50) DEFAULT NULL,
  `employee_lastname` varchar(50) DEFAULT NULL,
  `employee_company_id` int(11) DEFAULT NULL,
  `employee_bithdate` datetime DEFAULT NULL,
  `employee_starting_date` datetime DEFAULT NULL,
  `employee_position_id` int(11) DEFAULT NULL,
  `employee_location_id` int(11) DEFAULT NULL,
  `employee_photo` varchar(50) DEFAULT NULL,
  `employee_date_added` datetime DEFAULT NULL,
  `employee_date_modified` datetime DEFAULT NULL,
  `employee_mobile_no` varchar(20) DEFAULT NULL,
  `employee_nationality` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- Dumping data for table employees.employees: 11 rows
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` (`id`, `employee_id`, `employee_creator_id`, `employee_iqama_id`, `employee_computer_id`, `employee_full_name`, `employee_gender`, `employee_status_id`, `employee_firstname`, `employee_middlename`, `employee_lastname`, `employee_company_id`, `employee_bithdate`, `employee_starting_date`, `employee_position_id`, `employee_location_id`, `employee_photo`, `employee_date_added`, `employee_date_modified`, `employee_mobile_no`, `employee_nationality`) VALUES
	(20, '001', 21, '3126214764856', '', 'Mohammed Al-bhagdadi', 1, 28, NULL, NULL, NULL, 1, '2018-02-15 00:00:00', NULL, 3, 4, NULL, '2018-02-07 09:11:51', NULL, '09264859374', '2'),
	(21, '002', 21, '25654565456', '', 'Murshid al-Akhtar', 1, 1, NULL, NULL, NULL, 1, '1986-05-05 00:00:00', NULL, 1, 3, NULL, '2018-02-07 09:32:46', NULL, '0546137373', '1'),
	(22, '003', 21, '25654565456', '', 'Ayyoob al-Yacoub', 1, 1, NULL, NULL, NULL, 1, '1986-05-05 00:00:00', NULL, 1, 3, NULL, '2018-02-07 09:33:39', NULL, '0546137373', '1'),
	(23, '004', 21, '25654565456', '', 'Maazin al-Baten', 1, 1, NULL, NULL, NULL, 1, '1986-05-05 00:00:00', NULL, 1, 3, NULL, '2018-02-07 09:33:43', NULL, '0546137373', '1'),
	(24, '005', 21, '12345', '', 'Hasan el-Hosseini', 1, 1, NULL, NULL, NULL, 1, '2018-02-15 00:00:00', NULL, 3, 3, NULL, '2018-02-07 10:34:24', NULL, '09876545637', '3'),
	(25, '006', 21, '12345', '096787', 'Jafar al-Ghattas', 0, 1, NULL, NULL, NULL, 1, '2018-02-23 00:00:00', '2018-02-23 00:00:00', 5, 2, NULL, '2018-02-07 10:38:05', NULL, '09127836444', '4'),
	(26, '007', 21, '23243', '64564', 'Aasim al-Rad', 0, 1, NULL, NULL, NULL, 1, '2018-02-15 00:00:00', '2018-02-09 00:00:00', 4, 2, NULL, '2018-02-07 13:18:40', NULL, '0943543554', '4'),
	(27, '008', 21, '23243', '64564', 'Jawaad el-Haq', 0, 1, NULL, NULL, NULL, 1, '2018-02-15 00:00:00', '2018-02-09 00:00:00', 4, 2, NULL, '2018-02-07 13:19:41', NULL, '0943543554', '4'),
	(28, '009', 21, '23243', '64564', 'Usaama el-Abed', 0, 1, NULL, NULL, NULL, 1, '2018-02-15 00:00:00', '2018-02-09 00:00:00', 4, 2, NULL, '2018-02-07 13:19:47', NULL, '0943543554', '4'),
	(29, '0010', 21, '23243', '64564', 'Unais al-Safar', 0, 1, NULL, NULL, NULL, 1, '2018-02-15 00:00:00', '2018-02-09 00:00:00', 4, 2, NULL, '2018-02-07 13:24:11', NULL, '0943543554', '4'),
	(30, '0011', 21, '657565476', '334536', 'Usama bin-Laden', 1, 1, NULL, NULL, NULL, 1, '1972-02-15 00:00:00', '2018-02-09 00:00:00', 4, 2, 'employee_5a828820319ab.png', '2018-02-07 13:24:11', NULL, '09765654345', '2');
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;

-- Dumping structure for table employees.locations
CREATE TABLE IF NOT EXISTS `locations` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `location_company_id` int(11) DEFAULT NULL,
  `location_name` varchar(50) DEFAULT NULL,
  `location_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumping data for table employees.locations: 8 rows
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` (`location_id`, `location_company_id`, `location_name`, `location_description`) VALUES
	(1, 1, 'Head Office- HOB', NULL),
	(2, 1, 'PNU Site', NULL),
	(3, 1, 'KKIA Site', NULL),
	(4, 1, 'Sulai Camp', NULL),
	(5, 1, 'Rumah Site', NULL),
	(6, 1, 'Lab', NULL),
	(7, 1, 'Baraka Site', NULL),
	(18, 1, 'Asdfasdfasdf', NULL);
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;

-- Dumping structure for table employees.nationalities
CREATE TABLE IF NOT EXISTS `nationalities` (
  `nationality_id` int(11) NOT NULL AUTO_INCREMENT,
  `nationality_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nationality_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table employees.nationalities: 7 rows
/*!40000 ALTER TABLE `nationalities` DISABLE KEYS */;
INSERT INTO `nationalities` (`nationality_id`, `nationality_name`) VALUES
	(1, 'Filipino'),
	(2, 'Indian'),
	(3, 'Saudi'),
	(4, 'Pakistani'),
	(5, 'Indonesian'),
	(6, 'Qatari'),
	(7, 'Afghan');
/*!40000 ALTER TABLE `nationalities` ENABLE KEYS */;

-- Dumping structure for table employees.positions
CREATE TABLE IF NOT EXISTS `positions` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table employees.positions: 9 rows
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;
INSERT INTO `positions` (`position_id`, `position_name`) VALUES
	(1, 'Operator Crusher'),
	(2, 'Bus Driver'),
	(3, 'Welder'),
	(4, 'Operator, Steel Roller'),
	(5, 'Foreman'),
	(6, 'Operator, Milling Machine'),
	(7, 'Light Driver'),
	(8, 'Sensor Man'),
	(11, NULL);
/*!40000 ALTER TABLE `positions` ENABLE KEYS */;

-- Dumping structure for table employees.status
CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) DEFAULT NULL,
  `status_description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Dumping data for table employees.status: 2 rows
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`status_id`, `status_name`, `status_description`) VALUES
	(1, 'Regular', NULL),
	(28, 'Contractual', NULL);
/*!40000 ALTER TABLE `status` ENABLE KEYS */;

-- Dumping structure for table employees.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_firstname` varchar(50) DEFAULT '0',
  `user_middlename` varchar(50) DEFAULT '0',
  `user_lastname` varchar(50) DEFAULT '0',
  `user_gender` tinyint(4) DEFAULT '0',
  `user_birthdate` date DEFAULT NULL,
  `user_photo` varchar(50) DEFAULT '0',
  `user_status` enum('active','inactive','blocked') NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table employees.users: 22 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `user_firstname`, `user_middlename`, `user_lastname`, `user_gender`, `user_birthdate`, `user_photo`, `user_status`) VALUES
	(1, 'Kara Jenny', 'Manalang', 'Peregrina', 0, '1976-08-25', '0', 'active'),
	(2, 'Erwin Rody', 'Cabading', 'Kayanan', 1, '1990-09-28', '0', 'active'),
	(3, 'Princess Nora', 'Postigo', 'Cabatbat', 0, '1996-11-09', '0', 'active'),
	(4, 'Emilio Cesar', 'Abad', 'Ligaya', 1, '1992-10-01', '0', 'active'),
	(5, 'Maan Valerie', 'Barcelona', 'Pipit', 0, '1988-09-23', '0', 'active'),
	(6, 'Christian Marcelo', 'Cruz', 'Kayanan', 1, '1986-09-19', '0', 'active'),
	(7, 'Isabel April', 'Gacutan', 'Camama', 0, '1988-07-18', '0', 'active'),
	(8, 'Robert', 'Datoy', 'Bandong', 1, '1977-09-01', '0', 'active'),
	(10, 'Joshua Julius', 'Guerrero', 'Bigtas', 1, '1979-06-02', '0', 'active'),
	(11, 'Andrew', 'Arbues', 'Dumalugdog', 1, '1990-08-26', '0', 'active'),
	(12, 'Linus', 'Arao', 'Buan', 1, '1982-04-24', '0', 'active'),
	(13, 'Cristina', 'Gutierrez', 'Dausan', 0, '1992-11-13', '0', 'active'),
	(14, 'Kris', 'Parani', 'Calica', 0, '1995-03-04', '0', 'active'),
	(15, 'Vianne', 'Dayao', 'Satsatin', 0, '1980-05-27', '0', 'active'),
	(16, 'Corazon Joana', 'Baladad', 'Balanay', 0, '2000-09-23', '0', 'active'),
	(17, 'Christian', 'Gutierrez', 'Bulan', 1, '1982-06-27', '0', 'active'),
	(18, 'David', 'Tamayo', 'Bauan', 1, '1997-05-07', '0', 'active'),
	(19, 'Katrina', 'Magtoto', 'Alonsagay', 0, '1994-07-16', '0', 'active'),
	(20, 'Iza Katrina', 'Tinsay', 'Asiman', 0, '1999-07-18', '0', 'active'),
	(21, 'Roxanne', 'Tamayo', 'Postigo', 0, '1976-10-14', '0', 'active'),
	(22, 'Gizelle', 'Bulan', 'Bandong', 0, '1981-08-23', '0', 'active'),
	(23, 'Maureen Geraldine', 'Cabuhat', 'Asiman', 0, '1996-12-26', '0', 'active');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
