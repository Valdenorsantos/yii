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
-- Table structure for table `armto`
--

CREATE TABLE `armto` (
  `ID` int(11) NOT NULL,
  `NUMSERIE` varchar(20) NOT NULL,
  `TOMBO` varchar(20) NOT NULL,
  `TIPO` tinyint(1) NOT NULL,
  `MARCA` int(11) NOT NULL,
  `CALIBRE` int(11) NOT NULL,
  `MODELO` int(11) NOT NULL,
  `QTCARREGADORES` tinyint(4) NOT NULL DEFAULT '0',
  `IDLOTACAO` int(11) UNSIGNED DEFAULT NULL,
  `IDSITUACAO` int(11) NOT NULL,
  `OCORRENCIA` varchar(30) DEFAULT NULL,
  `OBSERVACAO` varchar(60) DEFAULT NULL,
  `COR` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `armto`
--
ALTER TABLE `armto`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `NUMSERIE` (`NUMSERIE`,`TOMBO`),
  ADD KEY `ID_SITUACAO` (`IDSITUACAO`),
  ADD KEY `FOTO` (`MODELO`),
  ADD KEY `MARCA` (`MARCA`),
  ADD KEY `CALIBRE` (`CALIBRE`),
  ADD KEY `IDLOTACAO` (`IDLOTACAO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `armto`
--
ALTER TABLE `armto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `armto`
--
ALTER TABLE `armto`
  ADD CONSTRAINT `armto_ibfk_4` FOREIGN KEY (`MARCA`) REFERENCES `aux_armto_marca` (`ID`),
  ADD CONSTRAINT `armto_ibfk_5` FOREIGN KEY (`CALIBRE`) REFERENCES `aux_armto_calibre` (`ID`),
  ADD CONSTRAINT `armto_ibfk_6` FOREIGN KEY (`MODELO`) REFERENCES `aux_armto_modelo` (`ID`),
  ADD CONSTRAINT `armto_ibfk_7` FOREIGN KEY (`IDLOTACAO`) REFERENCES `development_pmam_dpa`.`aux_lotacoes` (`ID`),
  ADD CONSTRAINT `armto_idsituacao` FOREIGN KEY (`IDSITUACAO`) REFERENCES `aux_armto_situacao` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
