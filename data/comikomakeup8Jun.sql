-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2020 at 02:12 PM
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
(11, 'britney/naslovna.jpg', 'natural1', 6),
(12, 'zeleni smokey/naslovna.jpg', 'zeleni smokey/naslovna.jpg', 7),
(13, 'zeleni smokey/1.jpg', 'zeleni smokey/1.jpg', 7),
(14, 'zeleni smokey/2.jpg', 'zeleni smokey/2.jpg', 7),
(15, 'zeleni smokey/3.jpg', 'zeleni smokey/3.jpg', 7),
(16, 'andja crveni karmin/naslovna.jpg', 'crveni karmin', 8),
(17, 'olja februar/naslovna.jpg', 'maturski mejkap', 9),
(18, 'olja februar/1.jpg', NULL, 9),
(19, 'olja februar/naslovna1.jpg', NULL, 9),
(20, 'andja crveni karmin/1.jpg', NULL, 8);

-- --------------------------------------------------------

--
-- Table structure for table `kategorijeLook`
--

CREATE TABLE `kategorijeLook` (
  `id` int(11) NOT NULL,
  `imeKat` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorijeLook`
--

INSERT INTO `kategorijeLook` (`id`, `imeKat`) VALUES
(1, 'Na meni'),
(2, 'Na klijentima');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `profilna` varchar(1200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `username`, `email`, `pass`, `profilna`, `admin`) VALUES
(2, 'Milica', 'Pavlović', 'Comika', 'milicap1598@gmail.com', '104b99554bbef125216a425bea21c06e', 'default.png', b'1'),
(3, '', '', 'bombon', 'bombonica@gmail.com', 'fe41048a05c2af36581f787a73f6df75', 'default.png', b'0'),
(4, '', '', 'Đubriša', 'milos@gmail.com', '9d7f19923299e9f2514117b5523c00ee', 'default.png', b'0');

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
(1, 'Classic Smokey Eye - Klasičan Smokey eye', 'Effective smokey eye\r\n_____________________________________\r\n\r\nEyes:\r\n@toofaced chocolate gold\r\n@makeuprevolution @revolutionbeautyserbia goddes of love highlithter for the inner corner\r\n@inglotsrbija eyeliner 77\r\n\r\nFace:\r\n@urbandecaycosmetics all nighter 5.0 + @maybelline\r\nSUPERSTAY\r\n@revolutionbeautyserbia @makeuprevolution contouring palette\r\n@sm_cosmeticsshop @svjetlana_minic rich peach highliter\r\n\r\nBrows:\r\n@schwarzkopf got2be glued water resistanr spiking glue\r\n@max_factor_srbija brow shaper 30\r\n\r\nLips:\r\n@essence_cosmetics brow pencil\r\n______________________________________________\r\n\r\n#volimoboje #makeupmilicapavlovic #comikomakeup #sminkanjebeograd #sminkanje #profesionalnasminka #profesionalnosminkanje #profesionalnosminkanjebeograd #sminkanjebeograd #sminkanje #profesionalnasminka #profesionalnosminkanje #profesionalnosminkanjebeograd #makeupmilicapavlovic #comikomakeup #smokey #smokeyeye #smokey_eye #smoke #black #blacksmoke #blacksmokey #blacksmokeyeye #udsrbija', 1, '2020-06-05 20:21:49', 1),
(2, 'Zeleni cut crease - inspirisan make up lookom Nine Nikcevic', NULL, 1, '2020-06-05 20:21:49', 3),
(3, 'Paun cut crease', '_____________________________________\r\n\r\nEyes:\r\n@morphebrushes x @jaclynhillcosmetics in buns, mocha & Central Park\r\n@anastasiabeverlyhills @norvina NORVINA vol.2\r\n@toofaced chocolate gold + @inglotsrbija duraline\r\n@nyxcosmetics_serbia @nyxcosmetics glitter gli 10\r\n@makeuprevolution @revolutionbeautyserbia goddes of love highlithter for the inner corner\r\n@inglotsrbija @inglot_cosmetics amc pure pigment eyeshadow 113 ft. Duraline\r\n@aurakozmetika wing it up eyeliner\r\n\r\nFace:\r\n@urbandecaycosmetics all nighter 0.5\r\n@revolutionbeautyserbia @makeuprevolution contouring palette\r\n@rimmellondonsrbija insta contour\r\n@sm_cosmeticsshop @svjetlana_minic rich peach highliter\r\n\r\nBrows:\r\n@schwarzkopf got2be glued water resistanr spiking glue\r\n@max_factor_srbija brow shaper 30\r\n\r\nLips:\r\n@essence_cosmetics pencil + @golden.rose.srbija longstay liquid matte lipstick 13 + @revlon colorstay foundation\r\n______________________________________________\r\n', 1, '2020-06-05 20:21:49', 5),
(4, 'Everyday Glam - Nosivi smeđi sa Inglot pigmentom', '_____________________________________\r\n\r\nEyes:\r\n@morphebrushes x @jaclynhillcosmetics in buns, mocha & Central Park\r\n\r\n@makeuprevolution @revolutionbeautyserbia goddes of love highlithter for the inner corner\r\n@inglotsrbija @inglot_cosmetics amc pure pigment eyeshadow 119 ft. Duraline\r\n@aurakozmetika wing it up eyeliner\r\n\r\nFace:\r\n@urbandecaycosmetics all nighter 0.5\r\n@revolutionbeautyserbia @makeuprevolution contouring palette\r\n@rimmellondonsrbija insta contour\r\n@sm_cosmeticsshop @svjetlana_minic rich peach highliter\r\n\r\nBrows:\r\n@schwarzkopf got2be glued water resistanr spiking glue\r\n@max_factor_srbija brow shaper 30\r\n\r\nLips:\r\n@essence_cosmetics pencil + @golden.rose.srbija longstay liquid matte lipstick 13 + @revlon colorstay foundation\r\n______________________________________________\r\n\r\n#volimoboje #makeupmilicapavlovic #comikomakeup #sminkanjebeograd #sminkanje #profesionalnasminka #profesionalnosminkanje #profesionalnosminkanjebeograd #sminkanjebeograd #sminkanje #profesionalnasminka #profesionalnosminkanje #profesionalnosminkanjebeograd #makeupmilicapavlovic #comikomakeup', 1, '2020-06-05 20:21:49', 7),
(5, 'Plavi mačkasti cut crease sa šljokicama - nocni glam', NULL, 1, '2020-06-05 20:21:49', 9),
(6, 'Wet nude - prirodni mokri makeup', 'Honey & 90s\' Britney Spears vibes', 1, '2020-06-05 20:21:49', 11),
(7, 'Green smokey - zeleni \"smokey eye\"', 'Gamer fairy \r\n_____________________________________\r\n\r\nEyes:\r\n@anastasiabeverlyhills @norvina NORVINA vol.2\r\n@makeuprevolution @revolutionbeautyserbia highlithter palette for the inner corner\r\n@aurakozmetika wing it up eyeliner\r\n\r\nFace:\r\n@urbandecaycosmetics all nighter 0.5\r\n@revolutionbeautyserbia @makeuprevolution contouring palette\r\n@jeffreestar @jeffreestarcosmetics wet dream highlihter\r\n@morphebrushes x @jaclynhill palette for dots\r\n\r\nBrows:\r\n@schwarzkopf got2be glued water resistanr spiking glue\r\n@max_factor_srbija brow shaper 30\r\n\r\nLips:\r\n@essence_cosmetics pencil + @golden.rose.srbija longstay liquid matte lipstick 23\r\n______________________________________________\r\n\r\n#volimoboje #makeupmilicapavlovic #comikomakeup #sminkanjebeograd #sminkanje #profesionalnasminka #profesionalnosminkanje #profesionalnosminkanjebeograd #sminkanjebeograd #sminkanje #profesionalnasminka #profesionalnosminkanje #profesionalnosminkanjebeograd #makeupmilicapavlovic #comikomakeup', 1, '2020-06-05 20:21:49', 12),
(8, 'Glamurozni dnevni mejkap sa crvenim karminom', NULL, 2, '2020-06-05 21:17:03', 16),
(9, 'Maturski mejkap', NULL, 2, '2020-06-05 21:17:03', 17);

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
(6, 'Kontakt', 'kontakt.php', 1, 0),
(7, 'Zakaži', 'zakazivanje.php', 1, 0),
(8, 'Cenovnik', 'cenovnik.php', 1, 0);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kategorijeLook`
--
ALTER TABLE `kategorijeLook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `look`
--
ALTER TABLE `look`
  MODIFY `idL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `meniLink`
--
ALTER TABLE `meniLink`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `img`
--
ALTER TABLE `img`
  ADD CONSTRAINT `img_ibfk_1` FOREIGN KEY (`idLook`) REFERENCES `look` (`idL`);

--
-- Constraints for table `kategorijeLook`
--
ALTER TABLE `kategorijeLook`
  ADD CONSTRAINT `kategorijelook_ibfk_1` FOREIGN KEY (`id`) REFERENCES `look` (`idKat`);

--
-- Constraints for table `meniLink`
--
ALTER TABLE `meniLink`
  ADD CONSTRAINT `menilink_ibfk_1` FOREIGN KEY (`meniId`) REFERENCES `meni` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
