-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Aug 01, 2023 at 02:04 AM
-- Server version: 5.6.51
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `development_pmam_armamento`
--

-- --------------------------------------------------------

--
-- Table structure for table `armto_foto`
--

CREATE TABLE `armto_foto` (
  `ID` int(11) NOT NULL,
  `ID_ARMTO` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `type` varchar(15) NOT NULL,
  `content` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `armto_foto`
--
ALTER TABLE `armto_foto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_ARMTO` (`ID_ARMTO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `armto_foto`
--
ALTER TABLE `armto_foto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `armto_foto`
--
ALTER TABLE `armto_foto`
  ADD CONSTRAINT `armto_foto_ibfk_1` FOREIGN KEY (`ID_ARMTO`) REFERENCES `armto` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
