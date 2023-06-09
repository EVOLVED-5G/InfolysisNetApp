-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 27, 2021 at 09:45 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

CREATE DATABASE nettapp_evolved5g;
USE nettapp_evolved5g;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nettapp_evolved5g`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` tinytext COLLATE utf8mb4_unicode_ci,
  `password` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` tinytext COLLATE utf8mb4_unicode_ci,
  `active` int(10) UNSIGNED DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `role`, `email`, `active`, `last_login`) VALUES
(1, 'admin', '6a6b62c50f7d74bb7e1ce50959ff0b5c12bb7379', 'admin', 'admin@email.com', 1, '2021-10-19 09:40:50');
insert into admins values (2,'admin2','315f166c5aca63a157f7d41007675cb44a948b33','admin','','1',null);

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` tinytext COLLATE utf8mb4_unicode_ci,
  `antenna` tinytext COLLATE utf8mb4_unicode_ci,
  `coordinates` tinytext COLLATE utf8mb4_unicode_ci,
  `active` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `name`, `antenna`, `coordinates`, `active`) VALUES
(1, 'Area_1', 'Antenna_1', 'x1,y1', 1),
(2, 'Area_4', 'Antenna_1', 'x4,y4', 1),
(3, 'Area_2', 'Antenna_2', 'x2,y2', 1),
(4, 'Area_3', 'Antenna_1', 'x3,y3', 1),
(5, 'Area_5', 'Antenna_3', 'x1,y2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` tinytext COLLATE utf8mb4_unicode_ci,
  `link` tinytext COLLATE utf8mb4_unicode_ci,
  `machine_id` int(11) NOT NULL,
  `active` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `link`, `machine_id`, `active`) VALUES
(1, 'file_1', 'link_1', 1, 1),
(2, 'file_2', 'link_2', 2, 1),
(3, 'file_3', 'link_3', 1, 1),
(4, 'file_4', 'link_4', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

DROP TABLE IF EXISTS `incidents`;
CREATE TABLE IF NOT EXISTS `incidents` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` tinytext COLLATE utf8mb4_unicode_ci,
  `incident` int(10) UNSIGNED DEFAULT NULL,
  `incidenttype` int(10) UNSIGNED DEFAULT NULL,
  `incidentlocation` tinytext COLLATE utf8mb4_unicode_ci,
  `incidenttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `machine_id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incidents`
--

INSERT INTO `incidents` (`id`, `name`, `incident`, `incidenttype`, `incidentlocation`, `incidenttime`, `machine_id`, `user_id`) VALUES
(1, 'incident_1', 1, 1, 'x1,y1', '2021-10-19 09:14:28', 1, 1),
(2, 'incident_2', 2, 1, 'x1,y1', '2021-10-19 09:15:56', 1, 1),
(3, 'incident_3', 2, 1, 'x2,y2', '2021-10-19 09:15:56', 2, 3),
(4, 'incident_4', 1, 2, 'x2,y2', '2021-10-19 09:15:56', 2, 2),
(5, 'Incident_5', 1, 3, 'x1,y2', '2021-10-21 11:26:46', 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `machines`
--

DROP TABLE IF EXISTS `machines`;
CREATE TABLE IF NOT EXISTS `machines` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` tinytext COLLATE utf8mb4_unicode_ci,
  `area` int(10) UNSIGNED DEFAULT NULL,
  `status` int(10) UNSIGNED DEFAULT NULL,
  `active` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `machines`
--

INSERT INTO `machines` (`id`, `name`, `area`, `status`, `active`) VALUES
(1, 'machine_1', 1, 1, 1),
(2, 'machine_2', 2, 1, 1),
(3, 'machine_3', 1, 3, 1),
(4, 'machine_4', 3, 2, 1),
(5, 'machine_5', 3, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `policies`
--

DROP TABLE IF EXISTS `policies`;
CREATE TABLE IF NOT EXISTS `policies` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `whodefinition` tinytext COLLATE utf8mb4_unicode_ci,
  `who` tinytext COLLATE utf8mb4_unicode_ci,
  `targetdefinition` int(10) UNSIGNED DEFAULT NULL,
  `target` int(10) UNSIGNED DEFAULT NULL,
  `daytime` tinytext COLLATE utf8mb4_unicode_ci,
  `action` int(10) UNSIGNED DEFAULT NULL,
  `active` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` tinytext COLLATE utf8mb4_unicode_ci,
  `surname` tinytext COLLATE utf8mb4_unicode_ci,
  `role` tinytext COLLATE utf8mb4_unicode_ci,
  `email` tinytext COLLATE utf8mb4_unicode_ci,
  `user_areas` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `role`, `email`, `user_areas`, `active`) VALUES
(1, 'John', 'Smith', 'role_1', 'jsmith@email.com', '2,3,4', 1),
(2, 'Clark', 'Kent', 'role_1', 'superman@email.com', '1,2', 1),
(3, 'Jane', 'Doe', 'role_2', 'jdoe@email.com', '2', 1),
(4, 'Peter', 'Parker', 'role_1', 'spiderman@email.com', '1,2,4', 1),
(5, 'Bruce', 'Wayne', 'role_3', 'batman@email.com', '1,3,5', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
