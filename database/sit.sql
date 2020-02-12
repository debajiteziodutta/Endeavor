-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 24, 2019 at 02:51 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sit`
--

-- --------------------------------------------------------

--
-- Table structure for table `apply_placement`
--

DROP TABLE IF EXISTS `apply_placement`;
CREATE TABLE IF NOT EXISTS `apply_placement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `std_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `apply_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apply_placement`
--

INSERT INTO `apply_placement` (`id`, `std_id`, `place_id`, `apply_date`) VALUES
(34, 35, 122, '2019-11-23 13:59:45'),
(35, 35, 129, '2019-11-24 14:17:14'),
(36, 35, 123, '2019-11-24 14:21:48'),
(37, 35, 130, '2019-11-24 14:39:05');

-- --------------------------------------------------------

--
-- Table structure for table `apply_training`
--

DROP TABLE IF EXISTS `apply_training`;
CREATE TABLE IF NOT EXISTS `apply_training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `std_id` int(11) NOT NULL,
  `tr_id` int(11) NOT NULL,
  `apply_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apply_training`
--

INSERT INTO `apply_training` (`id`, `std_id`, `tr_id`, `apply_date`) VALUES
(11, 35, 61, '2019-11-24 14:17:52');

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

DROP TABLE IF EXISTS `dept`;
CREATE TABLE IF NOT EXISTS `dept` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_no` varchar(10) NOT NULL,
  `dept_name` varchar(20) NOT NULL,
  `no_sem` text,
  PRIMARY KEY (`dept_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`dept_id`, `dept_no`, `dept_name`, `no_sem`) VALUES
(31, '012', 'BCA', '6'),
(32, '123', 'CSE', '8');

-- --------------------------------------------------------

--
-- Table structure for table `feedbcak`
--

DROP TABLE IF EXISTS `feedbcak`;
CREATE TABLE IF NOT EXISTS `feedbcak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedbcak`
--

INSERT INTO `feedbcak` (`id`, `u_id`, `message`, `date_time`) VALUES
(35, 35, 'Good', '2019-11-24 13:24:46'),
(36, 35, 'Fantastic ', '2019-11-24 13:24:58'),
(37, 35, 'GB fyftf gigikjnllgcrt  uv  v gc yf x y vh jgc txtfv h bg xty', '2019-11-24 17:26:24'),
(38, 35, 'GB 2 adc hiucbascKBckb liawbb wdib v jvdsh vbiu gfbajhvg  a gu', '2019-11-24 17:31:28'),
(39, 35, 'G3 djasdfn lniuld icbubcjb uc kd bcvuyG VVLIW GFNWK.GVABN,VC KJAN VJK HADS VHVHGC HGf ck jh', '2019-11-24 17:32:49'),
(40, 35, 'Deba 1', '2019-11-24 17:41:14'),
(41, 34, 'Ad nsdkjadn cndasivn kbvjkbskjvbsjk v', '2019-11-24 17:42:21'),
(42, 34, 'AHDBisabinadjknvkj bvkjbfkvkfbvk fb', '2019-11-24 17:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `heritage`
--

DROP TABLE IF EXISTS `heritage`;
CREATE TABLE IF NOT EXISTS `heritage` (
  `hid` int(11) NOT NULL AUTO_INCREMENT,
  `contents` varchar(255) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`hid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `heritage`
--

INSERT INTO `heritage` (`hid`, `contents`, `time_stamp`) VALUES
(5, 'cadh ciadbciadnilc buad cvkhbv ksb v badn vjh udbcvhl adhuvcu axjvugv\r\n', '2019-11-24 10:52:30'),
(6, 'accdd ncnksnvnfkvfv fvfvf b f', '2019-11-24 12:13:40'),
(7, 'bgfnh nt m m ntbytb ytnyj mum,jy ,', '2019-11-24 12:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `placement`
--

DROP TABLE IF EXISTS `placement`;
CREATE TABLE IF NOT EXISTS `placement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept` varchar(25) NOT NULL,
  `sem` varchar(50) DEFAULT NULL,
  `company_name` varchar(200) DEFAULT NULL,
  `arriving_date` date DEFAULT NULL,
  `last_apply_date` date DEFAULT NULL,
  `eligibity_criteria` varchar(255) DEFAULT NULL,
  `vacancy` varchar(255) DEFAULT NULL,
  `job_role` varchar(100) DEFAULT NULL,
  `pdf_name` varchar(50) DEFAULT NULL,
  `contact_details` varchar(255) DEFAULT NULL,
  `active_backlog` varchar(5) DEFAULT NULL,
  `Round_name` varchar(1000) DEFAULT NULL,
  `Round_duration` varchar(1000) DEFAULT NULL,
  `notes` varchar(2000) DEFAULT NULL,
  `link` varchar(10000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `dept` (`dept`)
) ENGINE=MyISAM AUTO_INCREMENT=131 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `placement`
--

INSERT INTO `placement` (`id`, `dept`, `sem`, `company_name`, `arriving_date`, `last_apply_date`, `eligibity_criteria`, `vacancy`, `job_role`, `pdf_name`, `contact_details`, `active_backlog`, `Round_name`, `Round_duration`, `notes`, `link`, `created_at`) VALUES
(122, '31', '5', 'Google', '2019-11-27', '2019-11-24', 'All through 60%', '100', 'manager', '', '4587962153', 'Yes', '', '', '', 'https://results.nptel.ac.in/sep/', '2019-11-23 13:54:51'),
(123, '31', '5', 'asdnjkn', '2019-11-20', '2019-11-29', '12th', '14', '100', '', '1245784521', 'Yes', '', '', '', 'www.facebook.com', '2019-11-24 12:33:24'),
(124, '31', '5', 'fsgghgh', '2019-11-29', '2019-11-19', 'ggshhfnhg', '12', 'gvdbg tyj mm', '', 'vgbhn m m jkjasckjndkj cnjkd', 'No', '', '', 'GOOD ', 'www.facebook.com', '2019-11-24 12:38:25'),
(125, '31', '5', 'asf vsdafgjvnkj vnksfn vk', '2019-11-26', '2019-11-05', '12th', '', '', '', '1245784521', 'Yes', '', '', '', 'www.facebook.com', '2019-11-24 12:57:19'),
(126, '31', '5', 'asdnjkn', '2019-10-29', '2019-11-26', '12th', '', '', '', '1245784521', 'Yes', '', '', '', 'https://www.facebook.com', '2019-11-24 13:00:47'),
(127, '31', '1', 'asdnjkn', '2019-11-27', '2019-12-02', '12th', '12', '', '', '1245784521', 'Yes', '', '', '', 'https://www.facebook.com', '2019-11-24 13:02:07'),
(128, '31', '1', 'asdnjkn', '2019-11-29', '2019-12-04', '12th', '14', '100', '', '1245784521', 'Yes', '', '', '', 'www.facebook.com', '2019-11-24 13:03:28'),
(129, '31', '5', 'xdfxfcfc vgg v', '2020-04-05', '2019-12-12', 'sex trytcyv gh bhbjj  zr sty', '', '', '', 'ds gd fhg hgv uv bhbz rtyvvbjb srxtxhfhc h vvjhrz tyv', 'Yes', '', '', 'good ftyf yugbkbkz rgfcvjhbb restdchvbj bb kkb', 'www.facebook.com', '2019-11-24 13:11:05'),
(130, '31', '5', 'Google1', '2020-12-12', '2020-02-12', 'absckjancjn ', '', '', '', 'jkbjckbdsjknc kkbckbck bckd bk ds', 'Yes', '', '', 'jhsjkac nscn onso non', 'https://facebook.com', '2019-11-24 14:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

DROP TABLE IF EXISTS `signup`;
CREATE TABLE IF NOT EXISTS `signup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rollno` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `dept` varchar(25) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '2',
  `dob` date DEFAULT NULL,
  `dobfile` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `marks10` text,
  `file10` varchar(50) DEFAULT NULL,
  `marks12` text,
  `file12` varchar(50) DEFAULT NULL,
  `deploma_marks` varchar(10) DEFAULT NULL,
  `deploma_file` varchar(50) DEFAULT NULL,
  `sem_marks` varchar(500) DEFAULT NULL,
  `sem_file` varchar(500) DEFAULT NULL,
  `ignored_message` varchar(50) NOT NULL DEFAULT 'null',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `rollno`, `name`, `dept`, `email`, `password`, `status`, `dob`, `dobfile`, `gender`, `marks10`, `file10`, `marks12`, `file12`, `deploma_marks`, `deploma_file`, `sem_marks`, `sem_file`, `ignored_message`) VALUES
(34, 'root', 'root', 'TPO', 'localhost@gmail.com', '202cb962ac59075b964b07152d234b70', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'null'),
(35, '33401217073', 'bikash ghosh', '31', 'ghosh2000slg@gmail.com', '140f6969d5213fd0ece03148e62e461e', 0, '2000-01-12', 'DOB_33401217073.cpp', 'Mail', '78', '10th_33401217073.cpp', '45', '12th_33401217073.exe', '', '', '78/89/78/58//', '1st_33401217073.cpp/2nd_33401217073.cpp/3rd_33401217073.pdf/4th_33401217073.cpp//', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `training`
--

DROP TABLE IF EXISTS `training`;
CREATE TABLE IF NOT EXISTS `training` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(255) DEFAULT NULL,
  `sem` varchar(50) DEFAULT NULL,
  `Company_name` varchar(255) DEFAULT NULL,
  `training_topic` varchar(255) DEFAULT NULL,
  `Prerequisites` varchar(255) DEFAULT NULL,
  `training_details` varchar(255) DEFAULT NULL,
  `Starting_date` date DEFAULT NULL,
  `last_apply_date` date DEFAULT NULL,
  `tenure` int(11) DEFAULT NULL,
  `details_of_company` varchar(255) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tid`),
  KEY `department` (`department`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training`
--

INSERT INTO `training` (`tid`, `department`, `sem`, `Company_name`, `training_topic`, `Prerequisites`, `training_details`, `Starting_date`, `last_apply_date`, `tenure`, `details_of_company`, `notes`, `created_at`) VALUES
(61, '31', '5', 'asjn ', 'asc ', 'xsac', '', '2020-01-01', '2019-12-25', 25, 'ds asdn vnfsvjighuif vmb cw uacy fgdsajfbj ', 'sax', '2019-11-24 07:01:32'),
(62, '31', '5', 'hhccgv yyc xgfchc ych', 'c c cyg', 'd yf ', '', '2019-11-29', '2019-11-04', 45, 'dyd yhvvuyvjhbhcggx ', '', '2019-11-24 13:12:59'),
(63, '32', '7', 'v  h vghv jgvjhb', 'ft ffg', 'fhhfhgf hj xhdtr djhvhxhd tv cgf dffxhv v  fdz c vnvv  xt cgf ', 'Baba Passport Appointment Reciept.pdf', '2019-11-29', '2019-11-04', 45, 'x fycycvvjhb styxtx hgvjhvv xd gch vdzd v h dzyd cvhuvatwvs gioj vyxewe x bf eae z v vyzewares u bl vd e r cu uy xrCw x u u ares xg ', 'trs5 dytfyfrsyf yg  us duyg yrs res t goif ue Y SDFIHY Yt du hi dr e sug ;u fra 5 dio i wya u iu dr4 ay a fut ', '2019-11-24 13:15:06');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
