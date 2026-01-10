-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2020 at 01:28 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comikomakeup`
--

-- --------------------------------------------------------

--
-- Table structure for table `img`
--

CREATE TABLE `img` (
  `id` int(11) NOT NULL,
  `src` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idLook` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `img`
--

INSERT INTO `img` (`id`, `src`, `alt`, `idLook`) VALUES
(1, 'smokey/naslovna.jpg', 'naslovnaSmokey', 1),
(2, 'smokey/1.jpg', '1Smokey', 1),
(3, 'zeleni cut crease/naslovna.jpg', 'zeleni cut crease', 2),
(4, 'zeleni cut crease/1.jpg', 'zeleni cut crease', 2),
(5, 'kp mua/naslovna.jpg', 'kp mua', 3),
(6, 'kp mua/1.jpg', 'kp mua', 3),
(7, 'teksas nosivi/naslovna1.jpg', 'everyday glam', 4),
(8, 'teksas nosivi/naslovna.jpg', 'everyday glam', 4),
(9, 'plava rolka/naslovna.jpg', 'plava rolka', 5);

-- --------------------------------------------------------

--
-- Table structure for table `korsinik`
--

CREATE TABLE `korsinik` (
  `id` int(11) NOT NULL,
  `ime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admin` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `look`
--

CREATE TABLE `look` (
  `id` int(11) NOT NULL,
  `nazivLooka` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `opis` varchar(270) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idNaslovneSlike` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `look`
--

INSERT INTO `look` (`id`, `nazivLooka`, `opis`, `idNaslovneSlike`) VALUES
(1, 'Classic Smokey Eye - Klasičan Smokey eye', NULL, 1),
(2, 'Zeleni cut crease - inspirisan make up lookom Nine Nikcevic', NULL, 3),
(3, 'Paun zeleni  cigla crven cut crease sa šljokicama', NULL, 5),
(4, 'Everyday Glam - Nosivi smeđi sa Inglot pigmentom', NULL, 7),
(5, 'Plavi mačkasti cut crease sa šljokicama - nocni glam', NULL, 9);

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE `meni` (
  `id` int(11) NOT NULL,
  `naziv` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`id`, `naziv`) VALUES
(1, 'header'),
(2, 'admin'),
(3, 'footer');

-- --------------------------------------------------------

--
-- Table structure for table `meniLink`
--

CREATE TABLE `meniLink` (
  `id` int(11) NOT NULL,
  `nazivLinka` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `hrefLinka` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `meniId` int(11) NOT NULL,
  `adminLink` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meniLink`
--

INSERT INTO `meniLink` (`id`, `nazivLinka`, `hrefLinka`, `meniId`, `adminLink`) VALUES
(1, 'Početna', 'home.php', 1, 0),
(2, 'Makeup', 'makeup.php', 1, 0),
(3, 'Autor', 'autor.php', 3, 0),
(4, 'Dokumentacija', 'dokumentacija.pdf', 3, 0),
(5, 'Sitemap', 'sitemap.xml', 3, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idLook` (`idLook`);

--
-- Indexes for table `korsinik`
--
ALTER TABLE `korsinik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `look`
--
ALTER TABLE `look`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idNaslovneSlike` (`idNaslovneSlike`);

--
-- Indexes for table `meni`
--
ALTER TABLE `meni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meniLink`
--
ALTER TABLE `meniLink`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meniId` (`meniId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `img`
--
ALTER TABLE `img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `korsinik`
--
ALTER TABLE `korsinik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `look`
--
ALTER TABLE `look`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `meniLink`
--
ALTER TABLE `meniLink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `img`
--
ALTER TABLE `img`
  ADD CONSTRAINT `img_ibfk_1` FOREIGN KEY (`idLook`) REFERENCES `look` (`id`);

--
-- Constraints for table `meniLink`
--
ALTER TABLE `meniLink`
  ADD CONSTRAINT `menilink_ibfk_1` FOREIGN KEY (`meniId`) REFERENCES `meni` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
