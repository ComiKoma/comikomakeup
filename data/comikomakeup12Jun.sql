-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2020 at 11:21 PM
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
-- Table structure for table `autor`
--

CREATE TABLE `autor` (
  `id` int(11) NOT NULL,
  `naslov` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `opis` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `slika` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `autor`
--

INSERT INTO `autor` (`id`, `naslov`, `opis`, `slika`) VALUES
(1, 'O autoru', 'Ja sam Milica Pavlović (broj indeksa 73/17). Dolazim iz Beograda, studentkinja sam druge godine Visoke ICT škole koju sam upisala nakon završene Trinaeste beogradske gimnazije.Dinamički sajt Comikomakeup predstavlja moju realizaciju jedne od predispitnih obaveza na fakultetu iz predmeta Praktikum Web programiranje PHP.\r\nNameravam da ovim sajtom napravim korak napred u karijeri programera i ujedno prikažem drugima moju ljubav prema šminci i iskustvo u šminkanju svih onih koje sam privukla svojim talentom.', 'assets/img/autor/1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cenovnik`
--

CREATE TABLE `cenovnik` (
  `id` int(11) NOT NULL,
  `nazivUsluge` varchar(270) COLLATE utf8_unicode_ci NOT NULL,
  `cena` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cenovnik`
--

INSERT INTO `cenovnik` (`id`, `nazivUsluge`, `cena`) VALUES
(1, 'Jednostavnija šminka za stare mušterije - do sat i po vremena', '1500'),
(2, 'Kompleksnija šminka (eyeliner, cut crease, i slično), ako dolazite da se šminkate kod mene prvi put ili nemate ideju kakvu biste šminku -2 sata.', '1800'),
(3, 'Šminkanje za tzv. Noć Veštica ili maskenbal - 3 sata', '3000'),
(4, 'Doplata za moje vestačke trepavice', '300'),
(5, 'Dolazak na kućnu adresu: moguć ukoliko ima bar dve osobe za šminkanje na toj adresi, ako ne naplaćuje se', '1000');

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
(9, 'plava rolka/naslovna.jpg', 'plava rolka', 5),
(10, 'plava rolka/1.jpg', 'plava rolka/1.jpg', 5),
(13, 'zeleni smokey/1.jpg', 'zeleni smokey/1.jpg', 7),
(14, 'zeleni smokey/2.jpg', 'zeleni smokey/2.jpg', 7),
(16, 'andja crveni karmin/naslovna.jpg', 'crveni karmin', 8),
(17, 'olja februar/naslovna.jpg', 'maturski mejkap', 9),
(18, 'olja februar/1.jpg', NULL, 9),
(20, 'andja crveni karmin/1.jpg', NULL, 8),
(21, 'britney/1.jpg', 'britney1', 6),
(22, 'britney/2.jpg', 'britney2', 6);

-- --------------------------------------------------------

--
-- Table structure for table `kategorijeLook`
--

CREATE TABLE `kategorijeLook` (
  `idK` int(11) NOT NULL,
  `imeKat` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorijeLook`
--

INSERT INTO `kategorijeLook` (`idK`, `imeKat`) VALUES
(1, 'Na meni'),
(2, 'Na klijentima');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `username` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `profilna` varchar(1200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `username`, `email`, `pass`, `profilna`, `admin`) VALUES
(2, 'Comika', 'milicap1598@gmail.com', '104b99554bbef125216a425bea21c06e', 'default.png', b'1'),
(3, 'bombon', 'bombonica@gmail.com', 'fe41048a05c2af36581f787a73f6df75', 'default.png', b'0'),
(4, 'Đubriša', 'milos@gmail.com', '9d7f19923299e9f2514117b5523c00ee', 'default.png', b'0'),
(5, 'VesicaKesica', 'ivica969@gmail.com', '43c23ff7baca28fdedc707bda6615d27', 'default.png', b'0'),
(6, 'ljubav1', 'ljubav@gmail.com', '0610beb7ee6198af82c2c4ca29b81f80', 'default.png', b'0'),
(7, 'MilenAdmin', 'milenadmin@gmail.com', 'd50be0f5096f0c2210d8372fec3dbf56', 'default.png', b'1'),
(8, 'Milena', 'milena@gmail.com', 'f17cf4c7952a98d24cf0324152d9a70f', 'default.png', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `look`
--

CREATE TABLE `look` (
  `idL` int(11) NOT NULL,
  `nazivLooka` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `opis` varchar(1270) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idKat` int(11) NOT NULL,
  `datumKacenja` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idNaslovneSlike` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `look`
--

INSERT INTO `look` (`idL`, `nazivLooka`, `opis`, `idKat`, `datumKacenja`, `idNaslovneSlike`) VALUES
(1, 'Classic Smokey Eye - Klasičan Smokey eye', 'Na očima:\n@toofaced chocolate gold\n@makeuprevolution @revolutionbeautyserbia goddes of love highlithter for the inner corner\n@inglotsrbija eyeliner 77\n\nFace:\n@urbandecaycosmetics all nighter 5.0 + @maybelline\nSUPERSTAY\n@revolutionbeautyserbia @makeuprevolution contouring palette\n@sm_cosmeticsshop @svjetlana_minic rich peach highliter\n\nBrows:\n@schwarzkopf got2be glued water resistanr spiking glue\n@max_factor_srbija brow shaper 30\n\nLips:\n@essence_cosmetics brow pencil', 1, '2020-05-01 20:21:49', 1),
(2, 'Zeleni cut crease', 'Na očima:\n@toofaced chocolate gold\n@makeuprevolution @revolutionbeautyserbia goddes of love highlithter for the inner corner\n@inglotsrbija eyeliner 77\n\nFace:\n@urbandecaycosmetics all nighter 5.0 + @maybelline\nSUPERSTAY\n@revolutionbeautyserbia @makeuprevolution contouring palette\n@sm_cosmeticsshop @svjetlana_minic rich peach highliter\n\nBrows:\n@schwarzkopf got2be glued water resistanr spiking glue\n@max_factor_srbija brow shaper 30\n\nLips:\n@essence_cosmetics brow pencil', 1, '2020-05-02 20:21:49', 3),
(3, 'Šareni cut crease', 'Eyes:\n@morphebrushes x @jaclynhillcosmetics in buns, mocha & Central Park\n@anastasiabeverlyhills @norvina NORVINA vol.2\n@toofaced chocolate gold + @inglotsrbija duraline\n@nyxcosmetics_serbia @nyxcosmetics glitter gli 10\n@makeuprevolution @revolutionbeautyserbia goddes of love highlithter for the inner corner\n@inglotsrbija @inglot_cosmetics amc pure pigment eyeshadow 113 ft. Duraline\n@aurakozmetika wing it up eyeliner\n\nFace:\n@urbandecaycosmetics all nighter 0.5\n@revolutionbeautyserbia @makeuprevolution contouring palette\n@rimmellondonsrbija insta contour\n@sm_cosmeticsshop @svjetlana_minic rich peach highliter\n\nBrows:\n@schwarzkopf got2be glued water resistanr spiking glue\n@max_factor_srbija brow shaper 30\n\nLips:\n@essence_cosmetics pencil + @golden.rose.srbija longstay liquid matte lipstick 13 + @revlon colorstay foundation', 1, '2020-05-03 20:21:49', 6),
(4, 'Everyday Glam - Nosivi smeđi sa Inglot pigmentom', 'Eyes:\n@morphebrushes x @jaclynhillcosmetics in buns, mocha & Central Park\n\n@makeuprevolution @revolutionbeautyserbia goddes of love highlithter for the inner corner\n@inglotsrbija @inglot_cosmetics amc pure pigment eyeshadow 119 ft. Duraline\n@aurakozmetika wing it up eyeliner\n\nFace:\n@urbandecaycosmetics all nighter 0.5\n@revolutionbeautyserbia @makeuprevolution contouring palette\n@rimmellondonsrbija insta contour\n@sm_cosmeticsshop @svjetlana_minic rich peach highliter\n\nBrows:\n@schwarzkopf got2be glued water resistanr spiking glue\n@max_factor_srbija brow shaper 30\n\nLips:\n@essence_cosmetics pencil + @golden.rose.srbija longstay liquid matte lipstick 13 + @revlon colorstay foundation', 1, '2020-05-04 20:21:49', 8),
(5, 'Plavi cut crease', 'Nestoo:\n@toofaced chocolate gold\n@makeuprevolution @revolutionbeautyserbia goddes of love highlithter for the inner corner\n@inglotsrbija eyeliner 77\n\nFace:\n@urbandecaycosmetics all nighter 5.0 + @maybelline\nSUPERSTAY\n@revolutionbeautyserbia @makeuprevolution contouring palette\n@sm_cosmeticsshop @svjetlana_minic rich peach highliter\n\nBrows:\n@schwarzkopf got2be glued water resistanr spiking glue\n@max_factor_srbija brow shaper 30\n\nLips:\n@essence_cosmetics brow pencil', 1, '2020-05-05 20:21:49', 9),
(6, 'Wet nude - prirodni mokri makeup', 'Honey & 90s\' Britney Spears vibes', 1, '2020-05-06 20:21:49', 21),
(7, 'Green smokey - zeleni ', 'Na očima:\n@anastasiabeverlyhills @norvina NORVINA vol.2\n@makeuprevolution @revolutionbeautyserbia highlithter palette for the inner corner\n@aurakozmetika wing it up eyeliner\n\nFace:\n@urbandecaycosmetics all nighter 0.5\n@revolutionbeautyserbia @makeuprevolution contouring palette\n@jeffreestar @jeffreestarcosmetics wet dream highlihter\n@morphebrushes x @jaclynhill palette for dots\n\nBrows:\n@schwarzkopf got2be glued water resistanr spiking glue\n@max_factor_srbija brow shaper 30\n\nLips:\n@essence_cosmetics pencil + @golden.rose.srbija longstay liquid matte lipstick 23', 1, '2020-05-07 20:21:49', 13),
(8, 'Nosivi mejkap, svakodnevni glamur', 'Ovaj look je primer čiste klasike i elegancije po pitanju šminke. Crveni karmin i blaga senka na očima su uvek u modi!', 2, '2020-05-08 21:17:03', 16),
(9, 'Maturski mejkap', 'Odličan za svečanosti kao što su maturske večeri ili svadbe.', 2, '2020-05-09 21:17:03', 18);

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
(5, 'Sitemap', 'sitemap.xml', 3, 0),
(6, 'Zakaži', 'zakazi.php', 1, 0),
(8, 'Cenovnik', 'cenovnik.php', 1, 0),
(9, 'Admin panel', 'admin.php', 1, 1),
(10, 'Look', 'adminLook.php', 2, 1),
(12, 'Kategorije', 'adminKategorije.php', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autor`
--
ALTER TABLE `autor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cenovnik`
--
ALTER TABLE `cenovnik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idLook` (`idLook`);

--
-- Indexes for table `kategorijeLook`
--
ALTER TABLE `kategorijeLook`
  ADD PRIMARY KEY (`idK`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `look`
--
ALTER TABLE `look`
  ADD PRIMARY KEY (`idL`),
  ADD KEY `idNaslovneSlike` (`idNaslovneSlike`),
  ADD KEY `kategorija` (`idKat`);

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
-- AUTO_INCREMENT for table `autor`
--
ALTER TABLE `autor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cenovnik`
--
ALTER TABLE `cenovnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `img`
--
ALTER TABLE `img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `kategorijeLook`
--
ALTER TABLE `kategorijeLook`
  MODIFY `idK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `look`
--
ALTER TABLE `look`
  MODIFY `idL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `meniLink`
--
ALTER TABLE `meniLink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `img`
--
ALTER TABLE `img`
  ADD CONSTRAINT `img_ibfk_1` FOREIGN KEY (`idLook`) REFERENCES `look` (`idL`);

--
-- Constraints for table `look`
--
ALTER TABLE `look`
  ADD CONSTRAINT `look_ibfk_1` FOREIGN KEY (`idKat`) REFERENCES `kategorijeLook` (`idK`);

--
-- Constraints for table `meniLink`
--
ALTER TABLE `meniLink`
  ADD CONSTRAINT `menilink_ibfk_1` FOREIGN KEY (`meniId`) REFERENCES `meni` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
