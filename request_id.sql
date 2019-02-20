-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2019 at 10:55 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `request_id`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `nik` varchar(15) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `nik`, `password`) VALUES
(1, 'mridwan', '1', '2a149812ea3acb43f33d04eed5f0e9d1'),
(2, 'admin', '2', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `nik` int(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `site_id` int(4) NOT NULL,
  `location` varchar(50) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`nik`, `username`, `name`, `site_id`, `location`, `dept`, `email`, `password`) VALUES
(1, 'mridwan', 'Muhammad Ridwan', 1, 'Graha Kirana', 'IT', 'muhammad.ridwan@cj.net', '2a149812ea3acb43f33d04eed5f0e9d1'),
(302, 'user', 'user', 1, '', 'HR', 'user@cj.net', 'ee11cbb19052e40b07aac0ca060c23ee'),
(303, 'admin', 'admin', 1, '', 'IT', 'admin@cj.net', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` int(10) NOT NULL,
  `request_no` varchar(15) NOT NULL,
  `rq_no` int(4) NOT NULL,
  `requested_by` varchar(15) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `nik` varchar(10) DEFAULT NULL,
  `description` text NOT NULL,
  `id` varchar(15) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `date` varchar(10) NOT NULL,
  `system_date` date NOT NULL,
  `response` text NOT NULL,
  `closed_by` varchar(50) DEFAULT NULL,
  `form_file` varchar(100) NOT NULL,
  `request_attachment` varchar(100) NOT NULL,
  `status` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `request_type`
--

CREATE TABLE `request_type` (
  `type_id` int(5) NOT NULL,
  `type_code` varchar(3) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `last_no` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_type`
--

INSERT INTO `request_type` (`type_id`, `type_code`, `type_name`, `last_no`) VALUES
(1, 'EI', 'Email ID (@cjlogistics.co.id)', 0),
(2, 'IL', 'ID Login (Ailisxe/NS/TMS/GLink)', 0),
(3, 'VN', 'VPN', 0),
(4, 'WF', 'CJ-Guest ID', 0),
(5, 'IS', 'InfraStructure (PC/Notebook Issue)', 0),
(6, 'GC', 'GCC', 0),
(7, 'MD', 'MDG S/4 Hana System', 0),
(8, 'SP', 'SAP S/4 HANA System', 0),
(9, 'AI', 'AilisXE', 0),
(10, 'NS', 'nSolution', 0),
(11, 'GL', 'G-Link', 0);

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `site_id` int(4) NOT NULL,
  `site_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`site_id`, `site_name`) VALUES
(1, 'GRAHA KIRANA'),
(2, 'WH JDC'),
(3, 'WH LAZADA MMP'),
(4, 'WH MARUNDA'),
(5, 'WH HENKEL'),
(6, 'WH HANKOOK'),
(7, 'WH POSCO'),
(8, 'WH TITAN MERAK'),
(9, 'INDORAMA'),
(10, 'WH SURABAYA MONDELEZ'),
(11, 'WH SURABAYA LAZADA'),
(12, 'WH HENKEL PASURUAN'),
(13, 'WH MAKASAR'),
(14, 'WH BALIKPAPAN'),
(15, 'WH MEDAN SAMPALI'),
(16, 'WH MEDAN KIM'),
(17, 'OFFICE PERAK'),
(18, 'OFFICE BANDARA SOEKARNO HATTA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `request_type`
--
ALTER TABLE `request_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`site_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `nik` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=304;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1075;

--
-- AUTO_INCREMENT for table `request_type`
--
ALTER TABLE `request_type`
  MODIFY `type_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `site_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
