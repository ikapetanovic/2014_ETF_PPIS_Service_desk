-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 04, 2014 at 06:41 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `service_desk_kcus_db`
--
CREATE DATABASE IF NOT EXISTS `service_desk_kcus_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `service_desk_kcus_db`;

-- --------------------------------------------------------

--
-- Table structure for table `dobavljaci`
--

CREATE TABLE IF NOT EXISTS `dobavljaci` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) NOT NULL,
  `grad` varchar(45) NOT NULL,
  `adresa` varchar(100) NOT NULL,
  `vrsta` varchar(45) NOT NULL,
  `dostupnost` varchar(45) DEFAULT NULL,
  `vrijednost` varchar(45) DEFAULT NULL,
  `utjecaj` varchar(45) DEFAULT NULL,
  `rizik` varchar(45) DEFAULT NULL,
  `kategorija` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dogadaj`
--

CREATE TABLE IF NOT EXISTS `dogadaj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` varchar(45) NOT NULL,
  `naziv` varchar(45) NOT NULL,
  `kategorija` varchar(45) NOT NULL,
  `podkategorija` varchar(45) NOT NULL,
  `prioritet` varchar(45) NOT NULL,
  `opis` varchar(250) DEFAULT NULL,
  `status` varchar(45) NOT NULL,
  `id_korisnickog_racuna` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1_idx` (`id_korisnickog_racuna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `generalno_pravilo`
--

CREATE TABLE IF NOT EXISTS `generalno_pravilo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pravilo` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `incident`
--

CREATE TABLE IF NOT EXISTS `incident` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum_prijavljivanja` varchar(45) NOT NULL,
  `naziv` varchar(45) NOT NULL,
  `kategorija` varchar(45) NOT NULL,
  `podkategorija` varchar(45) NOT NULL,
  `prioritet` varchar(45) NOT NULL,
  `opis` varchar(250) DEFAULT NULL,
  `komentar` varchar(250) NOT NULL,
  `status` varchar(45) NOT NULL,
  `stanje` varchar(45) NOT NULL,
  `datum_rjesavanja` varchar(45) NOT NULL,
  `id_dogadaja` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK3_idx` (`id_dogadaja`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `korisnicki_racun`
--

CREATE TABLE IF NOT EXISTS `korisnicki_racun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `broj_telefona` varchar(45) NOT NULL,
  `email_adresa` varchar(45) NOT NULL,
  `odjel` varchar(45) NOT NULL,
  `korisnicko_ime` varchar(45) NOT NULL,
  `korisnicka_sifra` varchar(45) NOT NULL,
  `korisnicka_grupa` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `korisnicki_racun`
--

INSERT INTO `korisnicki_racun` (`id`, `ime`, `prezime`, `broj_telefona`, `email_adresa`, `odjel`, `korisnicko_ime`, `korisnicka_sifra`, `korisnicka_grupa`) VALUES
(1, 'Denis', 'Hasanbašić', '061/111-111', 'd.h.administrator@kcus.ba', 'IT', 'd.h.administrator', '111-111', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `performanse`
--

CREATE TABLE IF NOT EXISTS `performanse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_dobavljaca` int(11) NOT NULL,
  `datum` date NOT NULL,
  `navrijeme` varchar(45) NOT NULL,
  `pospecifikaciji` varchar(45) NOT NULL,
  `bezfluktuacija` varchar(45) NOT NULL,
  `nepredvidjene` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK4_idx` (`id_dobavljaca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `specificno_pravilo`
--

CREATE TABLE IF NOT EXISTS `specificno_pravilo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vrijednost` int(11) NOT NULL,
  `trajanje` int(11) NOT NULL,
  `grad` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ugovori`
--

CREATE TABLE IF NOT EXISTS `ugovori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(100) NOT NULL,
  `vrsta` varchar(45) NOT NULL,
  `broj` varchar(45) NOT NULL,
  `vrijednost` varchar(45) NOT NULL,
  `pocetni_datum` date NOT NULL,
  `krajnji_datum` date NOT NULL,
  `period_obnavljanja` varchar(45) NOT NULL,
  `opis` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `zahtjev`
--

CREATE TABLE IF NOT EXISTS `zahtjev` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum_prijavljivanja` varchar(45) NOT NULL,
  `naziv` varchar(45) NOT NULL,
  `kategorija` varchar(45) NOT NULL,
  `podkategorija` varchar(45) NOT NULL,
  `prioritet` varchar(45) NOT NULL,
  `opis` varchar(250) DEFAULT NULL,
  `komentar` varchar(250) NOT NULL,
  `status` varchar(45) NOT NULL,
  `datum_rjesavanja` varchar(45) NOT NULL,
  `id_dogadaja` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK2_idx` (`id_dogadaja`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dogadaj`
--
ALTER TABLE `dogadaj`
  ADD CONSTRAINT `FK1` FOREIGN KEY (`id_korisnickog_racuna`) REFERENCES `korisnicki_racun` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `incident`
--
ALTER TABLE `incident`
  ADD CONSTRAINT `FK3` FOREIGN KEY (`id_dogadaja`) REFERENCES `dogadaj` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `performanse`
--
ALTER TABLE `performanse`
  ADD CONSTRAINT `FK4` FOREIGN KEY (`id_dobavljaca`) REFERENCES `dobavljaci` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `zahtjev`
--
ALTER TABLE `zahtjev`
  ADD CONSTRAINT `FK2` FOREIGN KEY (`id_dogadaja`) REFERENCES `dogadaj` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
