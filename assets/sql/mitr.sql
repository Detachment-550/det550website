-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: db2.internal:3306
-- Generation Time: Dec 05, 2018 at 09:55 PM
-- Server version: 5.6.33-0ubuntu0.14.04.1
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afrotc_mitr`
--

-- --------------------------------------------------------

--
-- Table structure for table `acknowledge_posts`
--

CREATE TABLE `acknowledge_posts` (
  `rin` int(10) NOT NULL,
  `announcement_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acknowledge_posts`
--

INSERT INTO `acknowledge_posts` (`rin`, `announcement_id`) VALUES
(661262304, 1),
(661550966, 1),
(661635829, 1),
(661635829, 2),
(661635829, 3),
(661635829, 4),
(661650063, 10),
(661683036, 1),
(661780318, 1),
(661780318, 2),
(661780318, 3),
(661780318, 4),
(661831919, 1),
(661831919, 2),
(661831919, 3),
(661831919, 4),
(661930459, 1),
(661930459, 2),
(661930459, 3),
(661930459, 4),
(661948874, 1),
(661948874, 2),
(661948874, 3),
(661948874, 4),
(661950110, 1),
(661950110, 2),
(661950110, 3),
(661950110, 4),
(661957755, 1),
(661957755, 2),
(661957755, 3),
(661957755, 4),
(661965691, 1),
(661965691, 2),
(661965691, 3),
(661965691, 4),
(661972687, 1),
(661972687, 2),
(661972687, 3),
(661972687, 4),
(661972687, 6),
(661972687, 7),
(661972687, 8),
(661972687, 9),
(661972687, 10),
(661972698, 1),
(661972698, 2),
(661972698, 3),
(661972698, 4);

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `title` varchar(255) COLLATE ascii_bin NOT NULL,
  `subject` varchar(255) COLLATE ascii_bin NOT NULL,
  `body` mediumtext COLLATE ascii_bin NOT NULL,
  `createdBy` int(10) NOT NULL,
  `uid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`title`, `subject`, `body`, `createdBy`, `uid`, `date`) VALUES
('Fake Announcement', 'This is a test.', 'This is a fake announcement with random text in it about nothing very important.', 123123123, 1, '2018-12-05 23:54:21'),
('Fake Announcement', 'Something', 'Something happened that\'s important', 123123123, 2, '2018-12-05 23:54:21'),
('Fake Announcement', 'Something', 'Something exciting is going to happen', 661550966, 3, '2018-12-05 23:54:21'),
('asdfq', 'asdf', 'asdfasdf', 661550966, 4, '2018-12-05 23:54:21'),
('Test', 'test', 'test', 661687244, 5, '2018-12-06 00:04:07'),
('test', 'test', 'test', 661687244, 6, '2018-12-06 00:09:05'),
('another test', 'test', 'since the other one didnt work', 661687244, 7, '2018-12-06 00:10:27'),
('asdf', 'asdf', 'asdf', 661687244, 8, '2018-12-06 00:25:31'),
('last test', 'its going to work now', 'plz', 661687244, 9, '2018-12-06 00:26:35'),
('Fake Announcement', 'Testing group announcement notification', 'Testing group announcement notification  hopefully it works!!', 661550966, 10, '2018-12-06 00:56:04');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `rin` int(10) UNSIGNED NOT NULL,
  `eventid` int(11) UNSIGNED NOT NULL,
  `excused_absence` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`rin`, `eventid`, `excused_absence`) VALUES
(123123123, 4294967295, 0),
(661262304, 1, NULL),
(661262304, 2, NULL),
(661310280, 2, NULL),
(661788027, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cadet`
--

CREATE TABLE `cadet` (
  `firstName` varchar(255) COLLATE ascii_bin DEFAULT NULL,
  `rank` varchar(10) COLLATE ascii_bin DEFAULT NULL,
  `rin` int(11) NOT NULL,
  `primaryEmail` varchar(100) COLLATE ascii_bin DEFAULT NULL,
  `secondaryEmail` varchar(255) COLLATE ascii_bin DEFAULT NULL,
  `primaryPhone` bigint(15) NOT NULL,
  `secondaryPhone` bigint(15) DEFAULT NULL,
  `password` varchar(255) COLLATE ascii_bin DEFAULT NULL,
  `bio` text COLLATE ascii_bin,
  `flight` varchar(20) COLLATE ascii_bin NOT NULL,
  `position` varchar(100) COLLATE ascii_bin DEFAULT NULL,
  `groupMe` varchar(50) COLLATE ascii_bin NOT NULL,
  `AFGoals` text COLLATE ascii_bin,
  `awards` text COLLATE ascii_bin,
  `middleName` varchar(255) COLLATE ascii_bin DEFAULT NULL,
  `lastName` varchar(255) COLLATE ascii_bin NOT NULL,
  `PGoals` text COLLATE ascii_bin NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `rfid` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `cadet`
--

INSERT INTO `cadet` (`firstName`, `rank`, `rin`, `primaryEmail`, `secondaryEmail`, `primaryPhone`, `secondaryPhone`, `password`, `bio`, `flight`, `position`, `groupMe`, `AFGoals`, `awards`, `middleName`, `lastName`, `PGoals`, `admin`, `rfid`) VALUES
('Nicholas ', 'AS300', 661204967, NULL, NULL, 0, NULL, '$2y$10$LFeI4jUTFF3ylXzufS8UK.OiP.ti1HCaSjvY38tQXVT2XFVP3m37.', NULL, 'None', NULL, '', NULL, NULL, NULL, 'Szczesniuk', '', 0, 20223),
('Nicholas', 'AS400', 661262304, 'worlen@rpi.edu', 'nworley97@yahoo.com', 8604618165, 0, '$2y$10$qRmMFCGAekDIzOB1c3S5sOdWBGfJmLaEGy.aI7pJ4h9JCSI/Hv6vS', '<p>Senior Year Aeronautical Engineering Student.', 'None', 'Operations Group Commander', 'Nicholas Worley', 'Attend AFIT and become a Flight Test Engineer', '<ul><li>Field Training Distinguished Graduate</li><li>Field Training Warrior Spirit</li><li>General Military Excellence Medal</li><li>Reserve Officer Association Award</li><li>Scottish Rite Southern Jurisdiction Award</li><li>Detachment 550 Spirit Award</li><li>Captain Floyd C Morrow Award</li><li>Physical Excellence Ribbon</li><li>2017 LEDx representative</li></ul>', '', 'Worley', '<p>Excellence</p>', 1, 25848),
('Miles', 'AS400', 661304363, NULL, NULL, 0, NULL, '$2y$10$WWSy9fWlGugkLOJ/8a1qu.n3IQi7XLmr4xnG5oVzRmxD3dVPUQGXm', NULL, 'None', NULL, '', NULL, NULL, NULL, 'D\'Ascensio', '', 1, 10985),
('Andrew', 'AS400', 661310280, 'bombea@rpi.edu', '', 7194648559, 0, '$2y$10$QTeb7dKVsLElFZbbl4gU.ePjNGGPPnj3Gu.XqE09tqDEnoCOgUwMS', NULL, 'None', '', '', NULL, NULL, NULL, 'Bomberg', '', 1, 10792),
('Paul', 'AS400', 661423316, 'hotalp@rpi.edu', 'p.s.hotaling@gmail.com', 4135757417, 0, '$2y$10$25T6xaXO7lff8cfIZb.qhO1JIyRMQQKEcKI5G37KnsMK.uKT8uk5y', NULL, 'None', 'CC/TSS', 'Paul Hotaling', '<p>Commission</p>', NULL, NULL, 'Hotaling', '<p><br></p>', 1, 10904),
('Ivan', 'None', 661429225, 'bereti@rpi.edu', '', 5185427984, 0, '$2y$10$NCrICjeLHGjtrFIkRvv1qeVXSwm3vO4CFUq7eMvWENGna3fSFz.4u', NULL, 'None', '', '', NULL, NULL, NULL, 'Beretvas', '', 0, 11261),
('Ha\'Ani-Belle', 'AS300', 661470133, 'quichh@rpi.edu', '', 0, 0, '$2y$10$1VdL2Rr0xbKglmfhmr04GuLAczYRzkEVwhiiYWKYInpLxXR8Ri.Am', NULL, 'Bravo', '', '', NULL, NULL, NULL, 'Quichocho', '', 1, 16723),
('Collin', 'AS200', 661502656, NULL, NULL, 0, NULL, '$2y$10$7ThptvElwIglMSU6rvE4/.qFhfKJWnGvu3EMw0LFzHJE4UjCqjpJ2', NULL, 'Bravo', NULL, '', NULL, NULL, NULL, 'Recore', '', 1, 22003),
('Stephanie', 'None', 661527408, NULL, NULL, 0, NULL, '$2y$10$SS1nfZmrHiPMC1fros8wluXu4YimDmy7bfLbWZyOeUJUYLmZ/3Ms6', NULL, 'None', NULL, '', NULL, NULL, NULL, 'Tan', '', 1, 0),
('Edward', 'AS400', 661542604, 'maxwee@rpi.edu', 'edwardmaxwell89@gmail.com', 2073913931, 0, '$2y$10$tgvxx2DhaDqxyQZE60uTTOsh0NK7idODcHvvpQiBxGbUjcM42rGWq', '<p class=\"MsoNormal\"><span style=\"color: rgb(34, 34, 34); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">Edward Maxwell is currently a senior at\nRensselaer Polytechnic Institute (RPI) in Troy, NY, where he studies\nAeronautical and Mechanical Engineering with a focus in space vehicle\ndesign.', 'None', 'CW/CC', '', NULL, '<p class=\"MsoNormal\" style=\"margin-bottom:0in;margin-bottom:.0001pt\"><b><span style=\"font-size:12.0pt;line-height:\n107%;font-family:', NULL, 'Maxwell', '', 1, 0),
('Corey', 'AS350', 661543683, NULL, NULL, 0, NULL, '$2y$10$hs6Lgj7V.wwzQt7R2HWfT.v5j.klDokEV6Z0TwlAlKMOpCUys6eTC', NULL, 'Bravo', NULL, '', NULL, NULL, NULL, 'Person', '', 0, 12312),
('Joseph', 'AS300', 661550966, 'messaj@rpi.edu', 'jmessare46@gmail.com', 5855009728, 0, '$2y$10$vzuUXA21f9Cv7VJfjWeDKehro067ob16QVLlwy34G4f5JGlOd3OOi', '<p>Cadet Messare started his ROTC career at RIT in 2016. He currently is an Information Technology ', 'Alpha', 'Deputy Flight Commander', 'Joseph Messare', '<ul><li>Become an ALO</li></ul>', '<ul><li>Silver Medal for Military Excellence</li></ul>', 'William', 'Messare', '<ul><li>Get over 30 pull-ups</li><li>Save $100 a month</li></ul>', 1, 22983),
('Sydney', 'AS200', 661582760, 'lukes@rpi.edu', 'sydneyluke1@aol.com', 5187299887, 0, '$2y$10$/acoQJUJ1yUnEcThvaUmkuLmgcY2NYAz.TeYCZ4hLzftkWZmp8i4K', NULL, 'Charlie', 'IIK', '', NULL, NULL, NULL, 'Luke', '', 0, 0),
('Andrew', 'AS300', 661622412, NULL, NULL, 0, NULL, '$2y$10$v/wi8NO5qfsaq9JlWKwmQOHxlwogvUiaC.SQivcPq8YVKyTOnxDjm', NULL, 'Alpha', NULL, '', NULL, NULL, NULL, 'Woods', '', 1, 0),
('Spencer', 'AS300', 661624427, 'schins@rpi.edu', 'spencer.schindler17@gmail.com', 8454176930, 0, '$2y$10$KlMmBuTG35bozC/Kj5JuCuo/jZoggbwpcTk/sh.Y1Citwe7IlAdu.', NULL, 'Bravo', 'Bravo Flight Commander ', 'spencer.schindler17@mail.com', '<p>Space Officer or Developmental Engineer</p>', NULL, '', 'Schindler', '', 0, 0),
('Karthik', 'AS300', 661635600, NULL, NULL, 0, NULL, '$2y$10$Wz57mtBC/xTKUxMZ1HHr3.rjn7wr2SyghT0O3MYUqLMoNTqvH5kc2', NULL, 'None', NULL, '', NULL, NULL, NULL, 'Krishnan', '', 1, 16183),
('Jack', 'AS250', 661635829, 'rogerj9@rpi.edu', 'rogerj9@rpi.edu', 603, 0, '$2y$10$WUvs24jLYttNRDZKwwIMAuUALtz8cuVtXfGf1veLzilRqrvu3YGMG', NULL, 'Charlie', '', '', NULL, NULL, NULL, 'Rogers', '', 0, 0),
('John', 'None', 661650063, NULL, NULL, 0, NULL, '$2y$10$zOW2X1u2siCtCc4FJaDB.u5jzbMv2vf4gjndUXbw54c6n7rArJvQC', NULL, 'None', NULL, '', NULL, NULL, NULL, 'Gay', '', 1, 0),
('Brian', 'AS250', 661683036, 'leew15@rpi.edu', 'wonjong1998@yahoo.com', 9145747732, 0, '$2y$10$nf27V4UycNYss6QwSf.LAer81QJKPRCGjVjGrqD958WTBskhhxfbW', NULL, 'Bravo', '', 'Brian Lee', NULL, NULL, NULL, 'Lee', '', 0, 0),
('Andy', 'None', 661687244, 'skyorb351@gmail.com', '', 0, 0, '$2y$10$xlPKH8AP1bWdF.lg0Y9me.RyN8bj/C6cTq65OvA3/O4ySg0QUnq1q', NULL, 'None', '', '', NULL, NULL, NULL, 'Son', '', 1, 0),
('Bailey', 'AS200', 661779757, NULL, NULL, 0, NULL, '$2y$10$Ikwjzi7RaIjglikIStVAL.xeQcUsA3dFFeg/MbcJFLMFaFMicMBD.', NULL, 'Alpha', NULL, '', NULL, NULL, NULL, 'Daigle', '', 0, 18839),
('Ian', 'AS200', 661780318, 'moriai@rpi.edu', 'ian.a.moriarty@gmail.com', 4138245286, 0, '$2y$10$tr8W/0hmTpJY5bYye.d2LOzMjnWMPl7v0mMOR92zU7.F3n1MqgWui', NULL, 'Alpha', 'GMCA', 'Ian Moriarty', NULL, NULL, NULL, 'Moriarty', '', 0, 0),
('Jacob', 'AS400', 661783829, NULL, NULL, 0, NULL, '$2y$10$RpAsEmLd7BdNYmRszNAPo.kxRkwLM10FOcsXKs1aQkPdR6PoYQqI6', NULL, 'None', NULL, '', NULL, NULL, NULL, 'Krott', '', 1, 21169),
('Katherine', 'AS200', 661788027, 'donovk5@rpi.edu', '', 0, 0, '$2y$10$afQQR8/bpIUu6.Im8RjN7.gmqq8pQqfDRuNNBhNTMPF9p/LDbdW4q', NULL, 'Bravo', '', '', NULL, NULL, NULL, 'Donovan', '', 1, 18803),
('Isabel', 'AS300', 661801613, NULL, NULL, 0, NULL, '$2y$10$AC9do9HgYzLKRV0xgLSxV.w95sPnRVY0QsOvdogbCwqKcGdjed442', NULL, 'Charlie', NULL, '', NULL, NULL, NULL, 'Perry', '', 1, 21313),
('Alexander', 'AS100', 661831919, 'ferena@rpi.edu', '', 0, 0, '$2y$10$NaGOOZ8mMIMtf7bIALs2g.RSO9htCRJUSPNOP3I6isWgNNrN0udfG', NULL, 'Alpha', '', '', NULL, NULL, NULL, 'Ferenczhalmy', '', 0, 24458),
('Jason', 'AS100', 661930459, 'almquj@rpi.edu', 'jasona.tuba@gmail.com', 2077408732, 0, '$2y$10$ObPpepAts4FHySd1y7hwPOAQJ9h7c1cV.J7W971pu.FqditP6hp0G', NULL, 'Alpha', '', 'Jason Almquist', NULL, NULL, NULL, 'Almquist', '', 0, 22870),
('Abigail', 'AS200', 661948874, 'atrapani@albany.edu', '', 6314063249, 0, '$2y$10$3s5oU5rPY.WJT1vRPXULZuODn67VRDDPPqGQ0JRLtLol.xtcA9ZxG', NULL, 'Alpha', 'Commander, Materiel Flight', '', NULL, NULL, NULL, 'Trapani', '', 0, 21046),
('Brianna', 'AS400', 661948876, 'bdoublee6921@gmail.com', '', 0, 0, '$2y$10$Nd52p3VUaKGBsc6jRyus1e2XZAttOEiAxj5oy08asX9jumeRFPRqS', NULL, 'None', '', '', NULL, NULL, NULL, 'Tator', '', 1, 21073),
('Jason', 'AS200', 661948878, 'dougaj@rpi.edu', '', 0, 0, '$2y$10$9LxeS6hvW97K0mxMEU7L9uAE9UCru5Var8OUcMFllqjx7JGA8hWnG', NULL, 'Alpha', 'Recruiting & Retention', '', NULL, NULL, NULL, 'Dougall', '', 0, 0),
('Aaron', 'AS200', 661949404, 'adostie0@gmail.com', 'dostia@rpi.edu', 3157230487, 0, '$2y$10$wtQ39cYdxzMENSAd1JFfGeg2gmf92SYvAmk28.q3sSRt2M/cJFJx2', NULL, 'Charlie', 'Military Personnel Flight/UDT Co-Commander', '', NULL, NULL, '', 'Dostie', '', 0, 0),
('Stephanie', 'AS200', 661950110, 'hands@rpi.edu', 'sr26hand@siena.edu', 5186833507, 0, '$2y$10$tXgxMd5SJvl5zfY6P0JGPuMEUjKlkklYRuCyHeccesM2Re9Rk35iS', '<p>Sophomore at Siena College - Majoring in Finance</p>', 'Alpha', 'Commander, Education, Communications, and Public Affairs Flight', 'Stephanie Hand', '<p>Become an Air Force Cargo Pilot', '<p>- Cadet of the Month (October F18)</p>', '', 'Hand', '<p>Develop leadership qualities within myself that will be continuously applied throughout my life</p>', 1, 0),
('James', 'AS100', 661951781, 'hofmaj2@rpi.edu', 'jwhofmann@albany.edu', 5189250570, 0, '$2y$10$Vq7wh1LPVv36KDrtKwW1Re9j84aKIfr1/YIDb2SXxezz4w9WrZZuG', NULL, 'Bravo', '', 'James Hofmann', NULL, NULL, NULL, 'Hofmann', '', 0, 0),
('Michael', 'AS100', 661956110, 'sweenm2@rpi.edu', '', 518, 0, '$2y$10$BAw8D3ihlkMHyAO5WsIan.DOnQNQMri0juEIVI2vEvRuL2/X56vea', '<p><br></p>', 'Charlie', '', '', NULL, NULL, NULL, 'Sweeney', '', 1, 23490),
('Olivia', 'AS100', 661957755, 'thomao2@rpi.edu', 'ofthomas@albany.edu', 5855459055, 0, '$2y$10$Z0Mb9cdr.WuZvhprXgb8WeVGct3w45oCcout9AYyfZVSuu9W5fVYC', '<p>Human Biology Major at University at Albany</p>', 'Charlie', '', 'Olivia Thomas', '<p>To become a physician in the Air Force.</p>', NULL, NULL, 'Thomas', '', 0, 0),
('Phu', 'AS100', 661965691, 'thaip@rpi.edu', 'phuthai45@yahoo.com', 3154207868, 0, '$2y$10$f85gnoGNPwmXPoHqG.A/Ve6d8dCIlJPzbnjZDH7TP5tIKtMRkMLJ.', NULL, 'Alpha', '', '', NULL, NULL, NULL, 'Thai', '', 0, 0),
('Nina', 'AS100', 661972636, NULL, NULL, 0, NULL, '$2y$10$d1DdjF9BsRBGQGO.u7o4eer1w9ZZ1C2WsEtpZAOuLphf4TNcGJVMi', NULL, 'Charlie', NULL, '', NULL, NULL, NULL, 'Macagnone', '', 0, 25740),
('Schuyler', 'AS250', 661972639, NULL, NULL, 0, NULL, '$2y$10$cTppv8CRW1Am8DJ1.GJT9OIMo79GECgvMJXCDx1KAt46YaBrTOJOq', NULL, 'Charlie', NULL, '', NULL, NULL, NULL, 'Smith', '', 0, 25803),
('Cedric', 'AS250', 661972651, '11cedricrobinson@gmail.com', '1cedricrobinson@gmail.com', 5167871743, 5167871743, '$2y$10$bSDES0gf62DjMMN.YX0Ojehdg3yKPh8hMCk6/MDDFx3gv/0.PgM9m', NULL, 'Charlie', '', 'Cedric Robinson ', NULL, NULL, NULL, 'Robinson', '', 0, 0),
('Justin', 'AS350', 661972652, 'jhealy2995@gmail.com', 'healyj@rpi.edu', 5702508256, 0, '$2y$10$aLnFjishWN7RFUkq38yP3ukYUezYcSt8IW0wQ0hQYdqTzoO0wTEDK', NULL, 'Alpha', '', '', NULL, NULL, NULL, 'Healy', '', 0, 0),
('Greg', 'AS250', 661972683, 'glaupheimer@albany.edu', 'glaupheimer17@hotmail.com', 5162798211, 0, '$2y$10$XiU8rl1uV.UuwfmZfXmFNOuxoVW5ao2/24EXVhhQXIlmVSzA1v3/W', NULL, 'Charlie', '', 'Greg Laupheimer', NULL, NULL, NULL, 'Laupheimer', '', 0, 0),
('Katie', 'AS250', 661972687, 'webstk2@rpi.edu', 'kwebster@albany.edu', 7164672038, 0, '$2y$10$QZGdL..ntQECM.F9Ie55GeehJwpHaK2R.NEgOqgcgwSf.2RD8zLeO', NULL, 'Alpha', '', '', NULL, NULL, NULL, 'Webster', '', 0, 0),
('Jessica', 'AS100', 661972698, 'brucej2@rpi.edu', 'jbruce0531@yahoo.com', 5185969221, 0, '$2y$10$y3.61oVQapCuLzsCOG4Rd.0SImCVk/TEtRiH7dMZMFAHetXXZmAZK', '<p>Jessica Bruce: I am f<span style=\"font-size: 1rem;\">rom Whitehall, NY, a Criminal Justice Major at UAlbany, and a first term AFROTC Cadet</span></p>', 'Alpha', '', 'Jessica Bruce', '<p>Security Forces Officer</p>', NULL, NULL, 'Bruce', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cadetEvent`
--

CREATE TABLE `cadetEvent` (
  `name` varchar(255) COLLATE ascii_bin DEFAULT NULL,
  `mandatory` tinyint(1) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `eventID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `cadetEvent`
--

INSERT INTO `cadetEvent` (`name`, `mandatory`, `date`, `eventID`) VALUES
('Test Event', 1, '2018-11-22 00:00:00', 1),
('PT 37', 1, '2018-11-30 00:00:00', 2),
('a', 1, '2018-12-04 00:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `cadetGroup`
--

CREATE TABLE `cadetGroup` (
  `label` varchar(255) COLLATE ascii_bin NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `cadetGroup`
--

INSERT INTO `cadetGroup` (`label`, `id`) VALUES
('Operations Group', 1),
('Test Group', 2);

-- --------------------------------------------------------

--
-- Table structure for table `groupMember`
--

CREATE TABLE `groupMember` (
  `groupID` int(11) NOT NULL,
  `rin` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `groupMember`
--

INSERT INTO `groupMember` (`groupID`, `rin`) VALUES
(1, 123123123),
(2, 661687244),
(2, 661550966);

-- --------------------------------------------------------

--
-- Table structure for table `wiki`
--

CREATE TABLE `wiki` (
  `name` varchar(255) NOT NULL,
  `body` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wiki`
--

INSERT INTO `wiki` (`name`, `body`) VALUES
('admin', '<h2><b><u>Admin Wiki</u></b></h2><h6>This page is only visible/accessible to users with administrative privileges (only some POC).</h6>'),
('announcements', '<h2><b><u>Announcements Wiki Page</u></b></h2><h6><br></h6>'),
('attendance', ''),
('directory', '<h2><b><u>Directory Wiki Page<br></u></b><h6><br></h6></h2>'),
('editprofile', '<h2><b><u>Edit Profile Wiki</u></b></h2><p>This page allows you to edit your profile seen by the rest of the detachment. There are groups of attributes that can be edited at one time. If you click save on one of these groups it will only save for that group of attributes and changes on other attributes will be discarded. Below are the following groups:</p><h4>General Information:</h4><ul><li>Profile Picture ( Once a new picture is uploaded it may take some time to appear on the website )</li><li>Primary Email</li><li>Secondary Email</li><li>Primary Phone</li><li>Secondary Phone</li><li>Group Me</li><li>Position</li></ul><h4>Biography</h4><ul><li>Please describe a little background about yourself and why you joined AF ROTC. Feel free to put some interesting facts cadets might not know about you.</li></ul><h4>Air Force Goals</h4><ul><li>Air Force Goals (awards, positions, jobs, etc.)</li></ul><h4>Personal Goals</h4><ul><li>Personal goals (fitness, financial, family, etc.)</li></ul>'),
('email', '<h2><b><u>Email Wiki Page</u></b></h2><h6><b><u><br></u></b></h6>'),
('events', '<p><b><u>Events Wiki Page</u></b></p><p>This page allows you to view an event and all attendees to the event. Attendance can be tracked with an admin, and every cadet who checks in with an admin at an event will be displayed as present. Attendance can be entered either with an RPI ID card or the cadet\'s RIN.</p>'),
('faq', '<h2><b><u>FAQ</u></b></h2><h6>This is for any commonly asked ROTC questions cadets might have.</h6>'),
('home', '<h2><b><u>Home Page Wiki</u></b></h2><h6>This page displays the 5 most recent announcements as well as your PT and LLAB attendance %.</h6><p></p><p></p>'),
('index', '<h2><b><u>Login Page Wiki</u></b></h2><ul><li>This page requires your RIN and password</li><li>This is the only page accessible without an account</li></ul>'),
('profile', '<h2><b><u>Profile Wiki Page</u></b></h2><h6>This is where you can view your profile as it is seen by other users. The edit profile page is also linked to this page where you can modify most of the information associated with your website. </h6><h6><br></h6><h6>The following are modifiable attributes on your profile:</h6><ul><li>Primary Phone Number</li><li>Secondary Phone Number</li><li>Primary Email</li></ul>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acknowledge_posts`
--
ALTER TABLE `acknowledge_posts`
  ADD PRIMARY KEY (`rin`,`announcement_id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`rin`,`eventid`);

--
-- Indexes for table `cadet`
--
ALTER TABLE `cadet`
  ADD PRIMARY KEY (`rin`);

--
-- Indexes for table `cadetEvent`
--
ALTER TABLE `cadetEvent`
  ADD PRIMARY KEY (`eventID`);

--
-- Indexes for table `cadetGroup`
--
ALTER TABLE `cadetGroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wiki`
--
ALTER TABLE `wiki`
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cadetEvent`
--
ALTER TABLE `cadetEvent`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cadetGroup`
--
ALTER TABLE `cadetGroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
