-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Ott 08, 2024 alle 07:35
-- Versione del server: 8.0.39
-- Versione PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orizon_start2impact_project`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int NOT NULL AUTO_INCREMENT,
  `country` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `country`
--

INSERT INTO `country` (`id`, `country`) VALUES
(1, 'Italia'),
(2, 'Francia'),
(3, 'Nepal'),
(4, 'Brasile'),
(6, 'spain'),
(31, 'Cina'),
(32, 'Mongolia'),
(34, 'india'),
(35, 'Venezuela'),
(36, 'Peru'),
(37, 'Vietnam'),
(38, 'Laos'),
(40, 'argentina'),
(41, 'Vietnam'),
(42, 'Laos'),
(43, 'norway'),
(44, 'Finland'),
(45, 'Russia'),
(46, 'Paraguay'),
(47, 'Uruguay');

-- --------------------------------------------------------

--
-- Struttura della tabella `trips`
--

CREATE TABLE IF NOT EXISTS `trips` (
  `trip_id` int NOT NULL AUTO_INCREMENT,
  `trip_name` varchar(40) NOT NULL,
  `available_slots` int NOT NULL,
  `country_id` int NOT NULL,
  PRIMARY KEY (`trip_id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `trips`
--

INSERT INTO `trips` (`trip_id`, `trip_name`, `available_slots`, `country_id`) VALUES
(1, 'Viaggio a Roma', 10, 1),
(2, 'Viaggio a Parigi', 10, 2),
(3, 'Viaggio in Amazzonia', 20, 4),
(4, 'Viaggio a Rio de Janeiro', 15, 4),
(5, 'Viaggio sull\'Himalaya', 20, 3),
(8, 'Viaggio a Pechino', 15, 31);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `trips`
--
ALTER TABLE `trips`
  ADD CONSTRAINT `trips_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
