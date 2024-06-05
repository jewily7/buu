-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 04, 2024 at 07:52 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctor_appo`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `doctor_id` int NOT NULL,
  `patient_id` int NOT NULL,
  `schedule_id` int NOT NULL,
  `appointment_number` varchar(32) NOT NULL,
  `reason_for_appointment` varchar(64) NOT NULL,
  `appointment_time` varchar(32) NOT NULL,
  `status` varchar(32) NOT NULL,
  `save_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `doctor_id`, `patient_id`, `schedule_id`, `appointment_number`, `reason_for_appointment`, `appointment_time`, `status`, `save_date`) VALUES
(1, 1, 4, 1, '4', ',fgndlkgnldkgds', '17:49', 'تکمیل شده', '2024-05-31 02:48:39');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `image` varchar(64) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `address` text NOT NULL,
  `date_of_birth` varchar(32) NOT NULL,
  `degree` varchar(32) NOT NULL,
  `expert_in` varchar(32) NOT NULL,
  `d_status` varchar(16) NOT NULL,
  `added_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `email`, `password`, `image`, `phone`, `address`, `date_of_birth`, `degree`, `expert_in`, `d_status`, `added_on`) VALUES
(6, 'Faizy', 'faizy@gmail.com', '123', '', '5382309771', 'Balkh', '', '', '', 'فعال', '2024-06-04 22:39:52'),
(7, 'Faizy', 'faizy@gmail.com', '123', '', '5382309771', 'Balkh', '', '', '', 'فعال', '2024-06-04 22:40:27'),
(8, 'Omran', 'omran@gmail.com', '123', '', '456257123', '', '', '', '', 'فعال', '2024-06-04 22:41:37');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedule`
--

DROP TABLE IF EXISTS `doctor_schedule`;
CREATE TABLE IF NOT EXISTS `doctor_schedule` (
  `s_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `doctor_id` int NOT NULL,
  `schedule_date` date NOT NULL,
  `schedule_day` varchar(32) NOT NULL,
  `start_time` varchar(32) NOT NULL,
  `end_time` varchar(32) NOT NULL,
  `average_consultion_time` varchar(32) NOT NULL,
  `schedule_status` varchar(32) NOT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `doctor_schedule`
--

INSERT INTO `doctor_schedule` (`s_id`, `doctor_id`, `schedule_date`, `schedule_day`, `start_time`, `end_time`, `average_consultion_time`, `schedule_status`) VALUES
(1, 1, '1403-03-11', 'یکشنبه', '08:00', '23:59', '4', 'فعال');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `fullname` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `birth_date` varchar(32) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `address` varchar(120) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `fullname`, `email`, `password`, `birth_date`, `phone`, `address`, `created_date`) VALUES
(2, 'فیضی', 'faizy@gmail.com', 'asd123', '1403/3/14', '55555555555555', 'sfadf', '2024-05-30 15:59:42'),
(3, 'faizy', 'faizy@gmail.com', 'admin', '1403/3/6', '5555555555', 'asdfasfa', '2024-05-30 16:02:34'),
(4, 'faizy', 'faizy@gmail.com', 'faizy123', '1403/3/11', '55555555555555555', 'kaya', '2024-05-31 02:47:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `hospital` varchar(32) NOT NULL,
  `photo` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `hospital`, `photo`) VALUES
(1, 'admin@gmail.com', 'admin', '', '', 'faizy1.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
