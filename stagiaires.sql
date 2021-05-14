-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 14 mei 2021 om 17:32
-- Serverversie: 10.4.18-MariaDB
-- PHP-versie: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `stagiaires`
--

CREATE TABLE `stagiaires` (
  `ID` int(11) NOT NULL,
  `voornaam` varchar(50) NOT NULL,
  `achternaam` varchar(50) NOT NULL,
  `geboortedatum` date NOT NULL,
  `straat` varchar(50) NOT NULL,
  `stad` text NOT NULL,
  `postcode` varchar(8) NOT NULL,
  `telefoonnummer` int(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `opleiding` varchar(50) NOT NULL,
  `niveau` int(10) NOT NULL,
  `leerjaar` int(10) NOT NULL,
  `school` varchar(50) NOT NULL,
  `SLBer` varchar(50) NOT NULL,
  `SLBerTel` int(11) NOT NULL,
  `SLBerEmail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `stagiaires`
--

INSERT INTO `stagiaires` (`ID`, `voornaam`, `achternaam`, `geboortedatum`, `straat`, `stad`, `postcode`, `telefoonnummer`, `email`, `opleiding`, `niveau`, `leerjaar`, `school`, `SLBer`, `SLBerTel`, `SLBerEmail`) VALUES
(3, 'Mart', 'van den Burg', '2021-05-12', 'Spanjaarskrocht 96', 'Noordwijkerhout', '2211ER', 642350993, '1033969@mborijnland.nl', 'Applicatie mediaontwikkelaar', 4, 3, 'MBO Rijnland', 'Braas', 64444444, 'voorbeeld@hotmail.com'),
(5, 'BArt', 'van den Burg224', '2021-05-15', '311asda', 'eqew', '131', 2423423, '1033969@mborijnland.nlqwe', 'Applicatie mediaontwiqekkelaar', 2, 8, 'MBO qew', 'eqw', 311, '12@hotmail.com'),
(6, 'Mart', 'van den Burg', '0000-00-00', 'Spanjaarskrocht 96', 'Noordwijkerhout', '2211ER', 642350993, '1033969@mborijnland.nl', 'Applicatie mediaontwikkelaar', 4, 3, 'MBO Rijnland', 'Braas', 64444444, 'voorbeeld@hotmail.com'),
(7, 'Mart', 'van den Burg', '0000-00-00', 'Spanjaarskrocht 96', 'Noordwijkerhout', '2211ER', 642350993, '1033969@mborijnland.nl', 'Applicatie mediaontwikkelaar', 4, 3, 'MBO Rijnland', 'Braas', 64444444, 'voorbeeld@hotmail.com');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `stagiaires`
--
ALTER TABLE `stagiaires`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `stagiaires`
--
ALTER TABLE `stagiaires`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
