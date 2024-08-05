-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 02. Aug 2024 um 15:40
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `be22_exam5_animal_adoption_kutay_altan`
--
CREATE DATABASE IF NOT EXISTS `be22_exam5_animal_adoption_kutay_altan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `be22_exam5_animal_adoption_kutay_altan`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `age` int(2) NOT NULL,
  `vaccine` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `animals`
--

INSERT INTO `animals` (`id`, `fname`, `picture`, `breed`, `size`, `age`, `vaccine`) VALUES
(1, 'Whiskers', 'siamese.jpg', 'Siamese', 'Medium', 2, 'Yes'),
(2, 'Shadow', 'persian.jpg', 'Persian', 'Medium', 4, 'No'),
(3, 'Mittens', 'maine.jpg', 'Maine Coon', 'Large', 3, 'No'),
(4, 'Luna', 'british.jpeg', 'British Shorthair', 'Medium', 1, 'Yes'),
(5, 'Cloud', 'van.jpg', 'Van', 'Large', 5, 'Yes');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `fname`, `password`, `email`, `picture`, `status`) VALUES
(6, 'noadmin', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'noadmin@noadmin.com', 'bob.png', 'user'),
(7, 'Pepe', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'admin@mail.com', 'pepe.jpg', 'admin'),
(8, 'John', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'johnny@mail.com', 'user.png', 'user'),
(9, 'Kennedy', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'ken@mail.com', 'admin.png', 'user'),
(10, 'Barb', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'barb@mail.com', 'alice.png', 'user');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
