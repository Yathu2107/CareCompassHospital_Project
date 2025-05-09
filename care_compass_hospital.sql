-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 17, 2025 at 04:27 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `care compass hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE IF NOT EXISTS `admin_users` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `email` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', 'Start@2002@');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE IF NOT EXISTS `appointments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `age` int NOT NULL,
  `gender` varchar(10) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `department_id` int DEFAULT NULL,
  `doctor_id` int DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `branch` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`),
  KEY `doctor_id` (`doctor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `name`, `age`, `gender`, `mobile`, `department_id`, `doctor_id`, `appointment_date`, `appointment_time`, `email`, `branch`) VALUES
(2, 'Kishoak', 22, 'Male', '0777397860', 2, 5, '2025-03-09', '16:30:00', 'Kishok123@gmail.com', 'Kandy');

-- --------------------------------------------------------

--
-- Table structure for table `completed_appointments`
--

DROP TABLE IF EXISTS `completed_appointments`;
CREATE TABLE IF NOT EXISTS `completed_appointments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `appointment_id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `department_id` int DEFAULT NULL,
  `doctor_id` int DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `branch` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `completed_appointments`
--

INSERT INTO `completed_appointments` (`id`, `appointment_id`, `name`, `gender`, `mobile`, `department_id`, `doctor_id`, `appointment_time`, `email`, `status`, `created_at`, `branch`) VALUES
(1, 1, 'Kishoak', 'Male', '0777397860', 1, 1, '17:00:00', 'Kishok123@gmail.com', 'completed', '2025-03-05 14:01:32', 'Colombo');

-- --------------------------------------------------------

--
-- Table structure for table `completed_report_request`
--

DROP TABLE IF EXISTS `completed_report_request`;
CREATE TABLE IF NOT EXISTS `completed_report_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `report_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `upload_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `request_id` (`request_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `completed_report_request`
--

INSERT INTO `completed_report_request` (`id`, `request_id`, `name`, `mobile_number`, `email`, `report_name`, `file_path`, `upload_date`) VALUES
(1, 1, 'kishok', '0775158398', 'Kishok123@gmail.com', 'blood chemistry reports', 'uploads/bill.pdf', '2025-02-20 05:05:05');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'Cardiology'),
(2, 'Psychiatrists'),
(3, 'Ent Surgeon'),
(4, 'Gynaecologist'),
(5, 'Oncological Surgeon'),
(6, 'Peadiatric Surgeon'),
(7, 'Rheumatalogist'),
(8, 'Urologist'),
(9, 'Chest Physcian'),
(10, 'Diabetic specialist'),
(11, 'Eye Surgeon'),
(12, 'Nephrologist'),
(13, 'Oncologist'),
(14, 'Peadiatrician'),
(15, 'Sports Medicine'),
(16, 'Vaccinologist'),
(17, 'Dental Surgeon'),
(18, 'Diabetologist'),
(19, 'General Physician'),
(20, 'Orthopaedic Surgeon'),
(21, 'Phsyciatric Councelling'),
(22, 'Thoracic Surgeon'),
(23, 'Vascular & Transplant Surgeon'),
(24, 'Dermatologist'),
(25, 'Dieticions & Nutrician'),
(26, 'General Surgeon'),
(27, 'Neuro Surgeon'),
(28, 'Peadiatric Neonatalogist'),
(29, 'Urologist - Kidney Transplant Surgeon'),
(30, 'Venereologist');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

DROP TABLE IF EXISTS `doctors`;
CREATE TABLE IF NOT EXISTS `doctors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `department_id` int DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `department_id`, `branch`) VALUES
(1, 'Dr. Godvin Constantine', 1, 'Colombo'),
(2, 'Dr. S.Narenthiran', 1, 'Kandy'),
(3, 'Dr. M.H.M.Zacky', 1, 'Kurunegala'),
(4, 'Dr. (MRS) Dasanthi Akmeemana', 2, 'Colombo'),
(5, 'Dr. S. Sivadas', 2, 'Kandy'),
(6, 'Dr. K.G.N.Seneviratne', 3, 'Colombo'),
(7, 'Dr. R.Sakaff', 3, 'Kandy'),
(8, 'Dr. R.S.Drhaman', 3, 'Kurunegala'),
(9, 'Dr. K.Seevaratnam', 3, 'Colombo'),
(10, 'Dr. (MRS).Selvi Vettivelu', 3, 'Kandy'),
(11, 'Dr. (MRS) Gowry.P.Senthilanathan', 4, 'Colombo'),
(12, 'Dr. (MRS) A.R.J.P.Niyas', 4, 'Kandy'),
(13, 'Dr. Sanath .P.Akmeemana', 4, 'Kurunegala'),
(14, 'Dr. (MRS) Rani Sithambarapilla', 4, 'Colombo'),
(15, 'Dr. R.Prathapan', 4, 'Kandy'),
(16, 'Dr. S.Asogan', 4, 'Kurunegala'),
(17, 'Prof. Harshalal Senevirathna', 4, 'Colombo'),
(18, 'Pro. S.F.L.Akbar', 4, 'Kurunegala'),
(19, 'Dr. R.Sriskanthan', 4, 'Colombo'),
(20, 'Dr. Sunil Kulathunga', 4, 'Kandy'),
(21, 'Dr. Ariyathurai Parthiepan', 5, 'Colombo'),
(22, 'Dr. Chandima Suriyarachchi', 6, 'Colombo'),
(23, 'Dr. J.V.Ariyasinghei', 7, 'Colombo'),
(24, 'Dr. (MS) Ushagowry Saravanamuttu', 7, 'Kandy'),
(25, 'Dr. Manjula Wijewardena', 8, 'Colombo'),
(26, 'Dr. Aflah Sadikeen', 9, 'Colombo'),
(27, 'Dr. S.Rishikesavan', 9, 'Kandy'),
(28, 'Dr. S.Muhunthan', 9, 'Kurunegala'),
(29, 'Dr. M.S.M.Firdous', 10, 'Colombo'),
(30, 'Dr. Sujatha Pathirage', 11, 'Colombo'),
(31, 'Dr. (MRS) M.Mithrakuma', 11, 'Kandy'),
(32, 'Dr. Vasuki Gurusamy', 11, 'Kurunegala'),
(33, 'Dr. (MRS) Mareena Reffai', 11, 'Colombo'),
(34, 'Dr. S.Mathu', 12, 'Colombo'),
(35, 'Dr.Nadarajah Jeyakumaran', 13, 'Colombo'),
(36, 'Dr.(MS) Umagowry Sarawanamuththu', 13, 'Kandy'),
(37, 'Dr. (MS) Kala Somasundaram', 14, 'Colombo'),
(38, 'Dr. T.Sekar', 14, 'Kandy'),
(39, 'Dr. K.Sivakumar', 14, 'Kurunegala'),
(40, 'Dr. Samantha Chandimal Jayawardena', 14, 'Colombo'),
(41, 'Dr. Priyanthi Molligoda', 14, 'Kandy'),
(42, 'Dr. (MRS) Thamodani Liyanage', 14, 'Kurunegala'),
(43, 'Dr. R.Ajanthan', 14, 'Colombo'),
(44, 'Dr.Padmalal Pathirage', 15, 'Colombo'),
(45, 'Dr. (MRS) Omala Wimalaratne', 16, 'Colombo'),
(46, 'Dr. P.Kirupakaran', 17, 'Colombo'),
(47, 'Dr. Henry.N.Rajaratnam', 18, 'Colombo'),
(48, 'PRO.J. Indrakumar', 19, 'Colombo'),
(49, 'DR. S.Mangaleshwaran', 19, 'Kandy'),
(50, 'Dr. (Mrs)T.Rajshankar', 19, 'Kurunegala'),
(51, 'Dr. T.Veerasudhan', 19, 'Colombo'),
(52, 'Dr. R.Gnanasekeram', 20, 'Colombo'),
(53, 'Dr. J.Jeyakumar', 20, 'Kandy'),
(54, 'Dr. S.Sritharan', 20, 'Kurunegala'),
(55, 'Dr. Swarnakumar', 20, 'Colombo'),
(56, 'Mrs. Yashoda Ratnapala', 21, 'Colombo'),
(57, 'Dr. D.M.S.Handagala', 22, 'Colombo'),
(58, 'Dr.Thanoj Fernando', 23, 'Colombo'),
(59, 'Dr.Joel Arudchelvam', 23, 'Kandy'),
(60, 'Dr. K.Satgurunathan', 24, 'Colombo'),
(61, 'Mrs.Iqbal', 25, 'Colombo'),
(62, 'Dr. K.Alagaratnam', 26, 'Colombo'),
(63, 'Dr. Thevarajah Bhishman', 26, 'Kandy'),
(64, 'Dr. V.Suthagaran', 26, 'Kurunegala'),
(65, 'Dr. Rajiv.G. Rajendran', 26, 'Colombo'),
(66, 'Prof. Deepaka Weerasekara', 26, 'Kandy'),
(67, 'Dr. T.Rajakaruna', 27, 'Colombo'),
(68, 'Dr. Rajeev Sathanandaraja', 28, 'Kandy'),
(69, 'Dr.Kumaradasan Umashankar', 29, 'Colombo'),
(70, 'Dr. (MRS)Sathya Herath', 30, 'Colombo');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_availability`
--

DROP TABLE IF EXISTS `doctor_availability`;
CREATE TABLE IF NOT EXISTS `doctor_availability` (
  `id` int NOT NULL AUTO_INCREMENT,
  `doctor_id` int DEFAULT NULL,
  `available_day` varchar(10) DEFAULT NULL,
  `available_time` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_id` (`doctor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=250 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `doctor_availability`
--

INSERT INTO `doctor_availability` (`id`, `doctor_id`, `available_day`, `available_time`) VALUES
(1, 1, 'Monday', '17:30 - 20:00'),
(2, 1, 'Wednesday', '17:00 - 20:00'),
(3, 2, 'Wednesday', '12:30 - 15:30'),
(4, 3, 'Saturday', '12:00 - 15:00'),
(5, 4, 'Monday', '18:30 - 21:30'),
(6, 4, 'Wednesday', '18:30 - 21:30'),
(7, 4, 'Thursday', '17:00 - 20:00'),
(8, 4, 'Saturday', '14:00 - 17:00'),
(9, 5, 'Sunday', '16:30 - 19:30'),
(10, 6, 'Monday', '18:00 - 21:00'),
(11, 6, 'Wednesday', '18:00 - 21:00'),
(12, 6, 'Friday', '18:00 - 21:00'),
(13, 7, 'Monday', '19:30 - 22:30'),
(14, 7, 'Wednesday', '20:30 - 23:30'),
(15, 8, 'Tuesday', '12:00 - 15:00'),
(16, 8, 'Saturday', '12:00 - 15:00'),
(17, 9, 'Tuesday', '17:00 - 20:00'),
(18, 9, 'Thursday', '19:30 - 22:30'),
(19, 9, 'Saturday', '19:30 - 22:30'),
(20, 10, 'Sunday', '08:00 - 11:00'),
(21, 11, 'Monday', '15:30 - 18:30'),
(22, 11, 'Tuesday', '15:30 - 18:30'),
(23, 11, 'Thursday', '15:30 - 18:30'),
(24, 11, 'Saturday', '18:30 - 21:30'),
(25, 12, 'Monday', '15:30 - 18:30'),
(26, 12, 'Tuesday', '15:30 - 18:30'),
(27, 12, 'Wednesday', '15:30 - 18:30'),
(28, 12, 'Thursday', '15:30 - 18:30'),
(29, 12, 'Friday', '15:30 - 18:30'),
(30, 12, 'Sunday', '15:30 - 18:30'),
(31, 13, 'Monday', '16:00 - 19:00'),
(32, 13, 'Tuesday', '16:00 - 19:00'),
(33, 13, 'Wednesday', '16:00 - 19:00'),
(34, 13, 'Thursday', '16:00 - 19:00'),
(35, 13, 'Friday', '16:00 - 19:00'),
(36, 13, 'Saturday', '12:00 - 15:00'),
(37, 13, 'Sunday', '20:00 - 23:00'),
(38, 14, 'Monday', '16:30 - 19:30'),
(39, 14, 'Tuesday', '16:30 - 19:30'),
(40, 14, 'Wednesday', '16:30 - 19:30'),
(41, 14, 'Thursday', '16:30 - 19:30'),
(42, 14, 'Friday', '16:30 - 19:30'),
(43, 14, 'Saturday', '19:00 - 21:00'),
(44, 14, 'Sunday', '10:30 - 13:30'),
(45, 15, 'Monday', '19:00 - 21:00'),
(46, 15, 'Wednesday', '19:00 - 21:00'),
(47, 15, 'Friday', '19:00 - 21:00'),
(48, 15, 'Saturday', '17:00 - 20:00'),
(49, 16, 'Monday', '20:00 - 23:00'),
(50, 16, 'Tuesday', '20:00 - 23:00'),
(51, 16, 'Saturday', '08:00 - 11:00'),
(52, 16, 'Sunday', '10:30 - 13:30'),
(53, 17, 'Tuesday', '08:00 - 11:00'),
(54, 17, 'Wednesday', '08:00 - 11:00'),
(55, 17, 'Friday', '08:30 - 11:30'),
(56, 17, 'Saturday', '08:00 - 11:00'),
(57, 18, 'Tuesday', '09:00 - 12:00'),
(58, 18, 'Thursday', '09:00 - 12:00'),
(59, 18, 'Saturday', '15:30 - 18:30'),
(60, 18, 'Sunday', '15:30 - 18:30'),
(61, 19, 'Tuesday', '18:30 - 21:30'),
(62, 20, 'Wednesday', '14:00 - 17:00'),
(63, 20, 'Thursday', '07:30 - 16:30'),
(64, 20, 'Friday', '07:30 - 10:30'),
(65, 20, 'Sunday', '08:30 - 11:30'),
(66, 21, 'Monday', '16:00 - 19:00'),
(67, 21, 'Wednesday', '16:00 - 19:00'),
(68, 21, 'Friday', '16:00 - 19:00'),
(69, 22, 'Monday', '18:00 - 21:00'),
(70, 22, 'Tuesday', '18:00 - 21:00'),
(71, 22, 'Wednesday', '18:00 - 21:00'),
(72, 22, 'Thursday', '18:00 - 21:00'),
(73, 22, 'Friday', '18:00 - 21:00'),
(74, 23, 'Wednesday', '11:00 - 14:00'),
(75, 23, 'Saturday', '11:00 - 14:00'),
(76, 23, 'Sunday', '11:00 - 14:00'),
(77, 24, 'Saturday', '18:30 - 21:30'),
(78, 25, 'Monday', '17:00 - 20:00'),
(79, 25, 'Saturday', '17:00 - 20:00'),
(80, 26, 'Monday', '16:00 - 19:00'),
(81, 27, 'Friday', '17:00 - 20:00'),
(82, 27, 'Saturday', '17:00 - 20:00'),
(83, 27, 'Sunday', '17:00 - 20:00'),
(84, 28, 'Saturday', '08:30 - 11:30'),
(85, 29, 'Friday', '16:00 - 19:00'),
(86, 30, 'Monday', '08:00 - 13:00'),
(87, 30, 'Tuesday', '08:00 - 13:00'),
(88, 30, 'Wednesday', '08:00 - 13:00'),
(89, 30, 'Thursday', '08:00 - 13:00'),
(90, 30, 'Friday', '08:00 - 13:00'),
(91, 30, 'Saturday', '13:00 - 16:00'),
(92, 31, 'Monday', '10:00 - 13:00'),
(93, 32, 'Monday', '15:15 - 18:15'),
(94, 32, 'Tuesday', '15:30 - 18:30'),
(95, 32, 'Sunday', '12:00 - 15:00'),
(96, 33, 'Monday', '18:30 - 21:30'),
(97, 33, 'Tuesday', '18:30 - 21:00'),
(98, 33, 'Wednesday', '18:30 - 21:00'),
(99, 33, 'Thursday', '18:30 - 21:00'),
(100, 33, 'Friday', '18:30 - 21:00'),
(101, 33, 'Saturday', '18:30 - 21:00'),
(102, 34, 'Tuesday', '20:15 - 23:15'),
(103, 35, 'Monday', '17:00 - 20:00'),
(104, 35, 'Saturday', '16:00 - 19:00'),
(105, 36, 'Thursday', '16:00 - 19:00'),
(106, 36, 'Saturday', '17:00 - 20:00'),
(107, 37, 'Monday', '08:00 - 11:00'),
(108, 37, 'Tuesday', '17:30 - 20:30'),
(109, 37, 'Saturday', '08:00 - 11:00'),
(110, 37, 'Sunday', '17:30 - 20:30'),
(111, 38, 'Monday', '09:00 - 12:00'),
(112, 38, 'Saturday', '13:00 - 16:00'),
(113, 38, 'Sunday', '13:00 - 16:00'),
(114, 39, 'Monday', '16:00 - 19:00'),
(115, 39, 'Tuesday', '16:00 - 19:00'),
(116, 39, 'Wednesday', '16:00 - 19:00'),
(117, 39, 'Thursday', '16:00 - 19:00'),
(118, 39, 'Friday', '16:00 - 19:00'),
(119, 39, 'Saturday', '16:00 - 19:00'),
(120, 39, 'Sunday', '16:00 - 19:00'),
(121, 40, 'Monday', '17:00 - 20:00'),
(122, 40, 'Wednesday', '17:00 - 20:00'),
(123, 40, 'Thursday', '17:00 - 20:00'),
(124, 40, 'Friday', '17:00 - 20:00'),
(125, 41, 'Tuesday', '08:00 - 11:00'),
(126, 41, 'Wednesday', '08:00 - 11:00'),
(127, 41, 'Thursday', '08:00 - 11:00'),
(128, 41, 'Friday', '08:00 - 11:00'),
(129, 42, 'Tuesday', '10:00 - 13:00'),
(130, 42, 'Wednesday', '10:00 - 13:00'),
(131, 42, 'Thursday', '10:00 - 13:00'),
(132, 42, 'Friday', '10:00 - 13:00'),
(133, 43, 'Sunday', '08:45 - 11:45'),
(134, 44, 'Monday', '17:30 - 20:30'),
(135, 44, 'Tuesday', '17:30 - 20:30'),
(136, 44, 'Wednesday', '17:30 - 20:30'),
(137, 44, 'Thursday', '17:30 - 20:30'),
(138, 44, 'Friday', '17:30 - 20:30'),
(139, 45, 'Saturday', '09:00 - 12:00'),
(140, 46, 'Monday', '16:00 - 19:00'),
(141, 46, 'Thursday', '18:00 - 21:00'),
(142, 47, 'Tuesday', '17:00 - 20:00'),
(143, 47, 'Thursday', '17:00 - 20:00'),
(144, 47, 'Saturday', '09:00 - 12:00'),
(145, 48, 'Monday', '07:00 - 10:00'),
(146, 48, 'Tuesday', '07:00 - 10:00'),
(147, 48, 'Wednesday', '07:00 - 10:00'),
(148, 48, 'Thursday', '07:00 - 10:00'),
(149, 48, 'Friday', '07:00 - 10:00'),
(150, 48, 'Saturday', '07:00 - 10:00'),
(151, 48, 'Sunday', '07:00 - 10:00'),
(152, 49, 'Monday', '09:00 - 16:30'),
(153, 49, 'Tuesday', '09:00 - 16:30'),
(154, 49, 'Wednesday', '09:00 - 16:30'),
(155, 49, 'Thursday', '09:00 - 16:30'),
(156, 49, 'Friday', '09:00 - 16:30'),
(157, 49, 'Saturday', '09:00 - 16:30'),
(158, 49, 'Sunday', '09:00 - 16:30'),
(159, 50, 'Monday', '16:30 - 19:30'),
(160, 50, 'Tuesday', '16:30 - 19:30'),
(161, 50, 'Wednesday', '16:30 - 19:30'),
(162, 50, 'Thursday', '16:30 - 19:30'),
(163, 50, 'Friday', '16:30 - 19:30'),
(164, 50, 'Saturday', '16:30 - 19:30'),
(165, 50, 'Sunday', '16:30 - 19:30'),
(166, 51, 'Monday', '19:30 - 22:30'),
(167, 51, 'Tuesday', '19:30 - 22:30'),
(168, 51, 'Wednesday', '19:30 - 22:30'),
(169, 51, 'Thursday', '19:30 - 22:30'),
(170, 51, 'Friday', '19:30 - 22:30'),
(171, 51, 'Saturday', '19:30 - 22:30'),
(172, 51, 'Sunday', '19:30 - 22:30'),
(173, 52, 'Monday', '20:30 - 23:00'),
(174, 52, 'Wednesday', '20:30 - 23:00'),
(175, 52, 'Saturday', '15:30 - 18:30'),
(176, 53, 'Tuesday', '20:30 - 23:00'),
(177, 53, 'Thursday', '20:30 - 23:00'),
(178, 53, 'Friday', '20:30 - 23:00'),
(179, 53, 'Sunday', '14:00 - 17:00'),
(180, 54, 'Wednesday', '12:00 - 15:00'),
(181, 54, 'Friday', '14:00 - 17:00'),
(182, 55, 'Friday', '07:00 - 10:00'),
(183, 56, 'Monday', '08:00 - 11:00'),
(184, 56, 'Wednesday', '08:00 - 11:00'),
(185, 56, 'Thursday', '08:00 - 11:00'),
(186, 57, 'Wednesday', '17:30 - 20:30'),
(187, 57, 'Sunday', '10:00 - 13:00'),
(188, 58, 'Saturday', '17:00 - 20:00'),
(189, 59, 'Sunday', '15:00 - 18:00'),
(190, 60, 'Monday', '11:00 - 14:00'),
(191, 60, 'Tuesday', '11:00 - 14:00'),
(192, 60, 'Wednesday', '11:00 - 14:00'),
(193, 60, 'Thursday', '11:00 - 14:00'),
(194, 60, 'Friday', '11:00 - 14:00'),
(195, 61, 'Monday', '09:30 - 12:30'),
(196, 61, 'Tuesday', '09:30 - 12:30'),
(197, 61, 'Thursday', '09:30 - 12:30'),
(198, 61, 'Friday', '09:30 - 12:30'),
(199, 62, 'Monday', '10:00 - 13:00'),
(200, 62, 'Tuesday', '10:00 - 13:00'),
(201, 62, 'Wednesday', '10:00 - 13:00'),
(202, 62, 'Thursday', '10:00 - 13:00'),
(203, 62, 'Friday', '10:00 - 13:00'),
(204, 62, 'Saturday', '10:00 - 13:00'),
(205, 62, 'Sunday', '10:00 - 13:00'),
(206, 63, 'Monday', '10:00 - 16:00'),
(207, 63, 'Tuesday', '10:00 - 16:00'),
(208, 63, 'Wednesday', '10:00 - 16:00'),
(209, 63, 'Thursday', '10:00 - 16:00'),
(210, 63, 'Friday', '10:00 - 16:00'),
(211, 63, 'Saturday', '10:00 - 16:00'),
(212, 63, 'Sunday', '10:00 - 16:00'),
(213, 64, 'Monday', '16:00 - 19:00'),
(214, 64, 'Tuesday', '16:00 - 19:00'),
(215, 64, 'Wednesday', '16:00 - 19:00'),
(216, 64, 'Thursday', '16:00 - 19:00'),
(217, 64, 'Friday', '16:00 - 19:00'),
(218, 64, 'Saturday', '16:00 - 19:00'),
(219, 64, 'Sunday', '16:00 - 19:00'),
(220, 65, 'Monday', '17:30 - 20:30'),
(221, 65, 'Tuesday', '17:30 - 20:30'),
(222, 65, 'Wednesday', '17:30 - 20:30'),
(223, 65, 'Thursday', '17:30 - 20:30'),
(224, 65, 'Friday', '17:30 - 20:30'),
(225, 65, 'Saturday', '17:30 - 20:30'),
(226, 65, 'Sunday', '17:30 - 20:30'),
(227, 66, 'Monday', '19:00 - 21:00'),
(228, 66, 'Tuesday', '19:00 - 21:00'),
(229, 66, 'Wednesday', '19:00 - 21:00'),
(230, 66, 'Thursday', '19:00 - 21:00'),
(231, 66, 'Friday', '19:00 - 21:00'),
(232, 66, 'Saturday', '19:00 - 21:00'),
(233, 66, 'Sunday', '19:00 - 21:00'),
(234, 67, 'Monday', '17:30 - 20:30'),
(235, 67, 'Tuesday', '17:30 - 20:30'),
(236, 67, 'Wednesday', '17:30 - 20:30'),
(237, 67, 'Thursday', '17:30 - 20:30'),
(238, 67, 'Friday', '17:30 - 20:30'),
(239, 68, 'Monday', '18:00 - 21:00'),
(240, 68, 'Thursday', '18:00 - 21:00'),
(241, 68, 'Friday', '18:00 - 21:00'),
(242, 68, 'Saturday', '18:00 - 21:00'),
(243, 69, 'Wednesday', '07:30 - 10:30'),
(244, 69, 'Sunday', '07:30 - 10:30'),
(245, 70, 'Tuesday', '16:30 - 19:30'),
(246, 70, 'Thursday', '16:30 - 19:30');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `appointment_id` int NOT NULL,
  `users_email` varchar(100) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `invoice_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `channeling_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `doctor_fee` decimal(10,2) NOT NULL DEFAULT '0.00',
  `service_charges` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `appointment_id`, `users_email`, `total_amount`, `invoice_date`, `channeling_fee`, `doctor_fee`, `service_charges`) VALUES
(1, 1, 'Kishok123@gmail.com', 7200.00, '2025-02-20 04:50:04', 2500.00, 4000.00, 700.00),
(2, 3, 'Yathushan2117@gmail.com', 7200.00, '2025-03-02 05:34:17', 2000.00, 5000.00, 200.00),
(3, 3, 'Yathushan2117@gmail.com', 7200.00, '2025-03-02 05:35:40', 2000.00, 5000.00, 200.00),
(4, 8, 'Yathushan2117@gmail.com', 9800.00, '2025-03-02 06:08:26', 2500.00, 7000.00, 300.00),
(5, 1, 'Kishok123@gmail.com', 8500.00, '2025-03-05 14:01:32', 3000.00, 5000.00, 500.00);

-- --------------------------------------------------------

--
-- Table structure for table `report_feedback`
--

DROP TABLE IF EXISTS `report_feedback`;
CREATE TABLE IF NOT EXISTS `report_feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `report_id` int DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `feedback` text,
  `is_submitted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_report` (`report_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `report_feedback`
--

INSERT INTO `report_feedback` (`id`, `report_id`, `rating`, `feedback`, `is_submitted`) VALUES
(1, 1, 5, 'Good and Quick Service!', 0),
(2, 1, 4, 'Good!', 0);

-- --------------------------------------------------------

--
-- Table structure for table `report_invoice`
--

DROP TABLE IF EXISTS `report_invoice`;
CREATE TABLE IF NOT EXISTS `report_invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `report_name` varchar(255) DEFAULT NULL,
  `report_charges` double DEFAULT NULL,
  `service_charges` double DEFAULT NULL,
  `total_charges` double DEFAULT NULL,
  `invoice_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `request_id` (`request_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `report_invoice`
--

INSERT INTO `report_invoice` (`id`, `request_id`, `name`, `mobile_number`, `email`, `report_name`, `report_charges`, `service_charges`, `total_charges`, `invoice_date`) VALUES
(1, 1, 'kishok', '0775158398', 'Kishok123@gmail.com', 'blood chemistry reports', 3000, 300, 3300, '2025-02-20 05:03:37'),
(2, 2, 'kishok', '0775158398', 'Kishok123@gmail.com', 'blood chemistry reports', 5000, 500, 5500, '2025-03-05 14:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `staff_users`
--

DROP TABLE IF EXISTS `staff_users`;
CREATE TABLE IF NOT EXISTS `staff_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staff_users`
--

INSERT INTO `staff_users` (`id`, `firstName`, `lastName`, `dateOfBirth`, `gender`, `email`, `password`) VALUES
(1, 'Murugesu', 'Yathushan', '2002-07-21', 'Male', 'Yathushan2117@gmail.com', 'Start@2002@');

-- --------------------------------------------------------

--
-- Table structure for table `test_requests`
--

DROP TABLE IF EXISTS `test_requests`;
CREATE TABLE IF NOT EXISTS `test_requests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `report_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `test_requests`
--

INSERT INTO `test_requests` (`id`, `name`, `mobile_number`, `email`, `report_name`) VALUES
(2, 'kishok', '0775158398', 'Kishok123@gmail.com', 'blood chemistry reports');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobileNumber` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`, `mobileNumber`) VALUES
(1, 'Murugesu', 'Yathushan', 'Yathushan2117@gmail.com', '707489ab1146eda2ce4af5c4768d0c2e', '777397860'),
(2, 'Logeshwaran', 'kishok', 'Kishok123@gmail.com', '707489ab1146eda2ce4af5c4768d0c2e', '0775158398');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
