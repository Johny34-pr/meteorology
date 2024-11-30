-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--
-- Gép: localhost:3306
-- Létrehozás ideje: 2024. Nov 30. 20:26
-- Kiszolgáló verziója: 10.5.26-MariaDB-0+deb11u2
-- PHP verzió: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `meteorology`
--
CREATE DATABASE IF NOT EXISTS `meteorology` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `meteorology`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `instruments`
--

CREATE TABLE `instruments` (
  `instrument_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `model_number` varchar(255) DEFAULT NULL,
  `status` enum('használatban','használaton kívül','javítás alatt') DEFAULT 'használaton kívül',
  `location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `instruments`
--

INSERT INTO `instruments` (`instrument_id`, `name`, `type`, `model_number`, `status`, `location_id`) VALUES
(1, 'Thermometer A', 'Hőmérő', 'T100', 'használatban', 1),
(2, 'Hygrometer A', 'Páramérő', 'H200', 'használaton kívül', 2),
(3, 'Thermometer C', 'Hőmérő', 'T300', 'használatban', 1),
(4, 'Hygrometer B', 'Páramérő', 'H200', 'használatban', 1),
(5, 'Thermometer B', 'Hőmérő', 'T100', 'használatban', 2);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `station_name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `county` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `locations`
--

INSERT INTO `locations` (`location_id`, `station_name`, `city`, `county`) VALUES
(1, 'Állomás 1', 'Budapest', 'Pest'),
(2, 'Állomás 2', 'Debrecen', 'Hajdú-Bihar'),
(3, 'Állomás 3', 'Szeged', 'Csongrád');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `measurements`
--

CREATE TABLE `measurements` (
  `measurement_id` int(11) NOT NULL,
  `operator_id` int(11) NOT NULL DEFAULT 1,
  `instrument_id` int(11) NOT NULL DEFAULT 1,
  `value` decimal(10,2) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `location_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `measurements`
--

INSERT INTO `measurements` (`measurement_id`, `operator_id`, `instrument_id`, `value`, `unit`, `timestamp`, `location_id`) VALUES
(5, 2, 1, '10.00', '°C', '2024-11-16 12:00:24', NULL),
(10, 4, 1, '4.00', '%', '2024-11-16 14:11:59', 1),
(11, 4, 4, '33.00', 'W', '2024-11-16 20:24:45', NULL),
(12, 4, 1, '55.00', 'W', '2024-11-16 20:34:45', NULL),
(14, 4, 4, '22.00', 'W', '2024-11-16 21:23:22', 1),
(15, 4, 1, '-5.00', '°C', '2024-11-16 21:46:15', 1),
(16, 5, 3, '44.00', '°C', '2024-08-13 22:02:29', NULL),
(17, 4, 1, '24.00', '°C', '2024-05-14 14:35:56', 1),
(18, 4, 1, '-15.00', '°C', '2024-01-10 11:15:07', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `operators`
--

CREATE TABLE `operators` (
  `operator_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `reg_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `operators`
--

INSERT INTO `operators` (`operator_id`, `email`, `username`, `password`, `name`, `location_id`, `reg_time`) VALUES
(2, '', 'janedoe', 'password456', 'Jane Doe', 2, '2024-11-15 21:27:24'),
(4, 'kincses.istvan03@gmail.com', 'István', '09cf65199c7c7ff89e511de72e00b8e47beacde9d826957fb253e90578823852', 'Kincses István', 1, '2024-11-15 21:27:24'),
(5, 'asd@teszt.hu', 'johndoe', '', 'John Doe', NULL, '2024-11-16 12:52:37');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `instruments`
--
ALTER TABLE `instruments`
  ADD PRIMARY KEY (`instrument_id`),
  ADD KEY `location_id` (`location_id`);

--
-- A tábla indexei `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- A tábla indexei `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`measurement_id`),
  ADD KEY `operator_id` (`operator_id`),
  ADD KEY `instrument_id` (`instrument_id`),
  ADD KEY `location_id` (`location_id`);

--
-- A tábla indexei `operators`
--
ALTER TABLE `operators`
  ADD PRIMARY KEY (`operator_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `location_id` (`location_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `instruments`
--
ALTER TABLE `instruments`
  MODIFY `instrument_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `measurements`
--
ALTER TABLE `measurements`
  MODIFY `measurement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT a táblához `operators`
--
ALTER TABLE `operators`
  MODIFY `operator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `instruments`
--
ALTER TABLE `instruments`
  ADD CONSTRAINT `instruments_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`);

--
-- Megkötések a táblához `measurements`
--
ALTER TABLE `measurements`
  ADD CONSTRAINT `measurements_ibfk_1` FOREIGN KEY (`operator_id`) REFERENCES `operators` (`operator_id`),
  ADD CONSTRAINT `measurements_ibfk_2` FOREIGN KEY (`instrument_id`) REFERENCES `instruments` (`instrument_id`),
  ADD CONSTRAINT `measurements_ibfk_3` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`);

--
-- Megkötések a táblához `operators`
--
ALTER TABLE `operators`
  ADD CONSTRAINT `operators_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
