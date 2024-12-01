-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Dec 01. 22:51
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

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
(4, 'Hygrometer B', 'Páramérő', 'H200', 'használatban', 6),
(5, 'Thermometer B', 'Hőmérő', 'T100', 'használatban', 2),
(6, 'Hőmérő', 'Hőmérséklet érzékelő', 'HT-101', 'használatban', 1),
(7, 'Páratartalom mérő', 'Higrométer', 'HG-202', 'használatban', 2),
(8, 'Nyomásérzékelő', 'Barométer', 'BP-303', 'használaton kívül', 3),
(9, 'Szélsebesség mérő', 'Anemométer', 'AM-404', 'használatban', 4),
(10, 'UV-érzékelő', 'Fényérzékelő', 'UV-505', 'használaton kívül', 5),
(11, 'Légszennyezettség mérő', 'PM-szenzor', 'PM-606', 'használatban', 1),
(12, 'Csapadékmérő', 'Ombrométer', 'OM-707', 'használatban', 2),
(13, 'Hőmérséklet mérő', 'Hőmérséklet érzékelő', 'HT-102', 'javítás alatt', 3);

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
(3, 'Állomás 3', 'Szeged', 'Csongrád'),
(4, 'Budapesti mérőállomás', 'Budapest', 'Pest'),
(5, 'Debreceni mérőállomás', 'Debrecen', 'Hajdú-Bihar'),
(6, 'Szegedi mérőállomás', 'Szeged', 'Csongrád'),
(7, 'Pécsi mérőállomás', 'Pécs', 'Baranya'),
(8, 'Győri mérőállomás', 'Győr', 'Győr-Moson-Sopron');

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
(5, 2, 1, 10.00, '°C', '2024-01-09 12:00:24', NULL),
(10, 4, 1, 4.00, '%', '2024-04-09 14:11:59', 1),
(11, 4, 4, 33.00, 'W', '2024-05-09 20:24:45', NULL),
(12, 4, 1, 55.00, 'W', '2024-06-12 20:34:45', NULL),
(14, 4, 4, 22.00, 'W', '2024-09-11 21:23:22', 1),
(15, 4, 1, -5.00, '°C', '2024-11-16 21:46:15', 1),
(17, 4, 1, 24.00, '°C', '2024-11-18 14:35:56', 1),
(85, 10, 1, 25.40, '°C', '2024-11-20 10:00:00', 1),
(86, 7, 2, 60.50, '%', '2024-11-20 10:05:00', 2),
(87, 8, 3, 1013.20, 'hPa', '2024-11-26 10:10:00', 3),
(88, 4, 4, 5.70, 'm/s', '2024-12-01 10:15:00', 4),
(89, 9, 5, 7.80, 'UV', '2024-12-01 10:20:00', 5),
(90, 6, 6, 35.00, 'ug/m3', '2024-12-01 11:00:00', 1),
(91, 7, 7, 10.20, 'mm', '2024-12-01 11:05:00', 2),
(92, 6, 1, 26.10, '°C', '2024-12-01 12:00:00', 1),
(93, 7, 2, 58.00, '%', '2024-12-01 12:05:00', 2),
(94, 4, 4, 6.10, 'm/s', '2024-12-01 12:10:00', 4),
(95, 8, 6, 29.50, 'ug/m3', '2024-12-01 12:15:00', 1),
(96, 9, 7, 12.30, 'mm', '2024-12-01 12:20:00', 2),
(97, 11, 8, 15.00, '°C', '2024-12-01 13:00:00', 3),
(98, 4, 6, -2.00, '°C', '2024-12-01 22:32:32', 1);

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
(2, '', 'janedoe', 'password456', 'Jane Doe', 1, '2024-11-15 21:27:24'),
(4, 'kincses.istvan03@gmail.com', 'István', '09cf65199c7c7ff89e511de72e00b8e47beacde9d826957fb253e90578823852', 'Kincses István', 1, '2024-11-15 21:27:24'),
(6, 'teszt.elek@test.co.uk', 'Elek', '918ecd3695e61dcb22159f23586cae294edb8bae37f6b477d50d42338c06e905', 'Teszt Elek', NULL, '2024-12-01 22:12:47'),
(7, 'operator1@company.com', 'operator1', '688787d8ff144c502c7f5cffaafe2cc588d86079f9de88304c26b0cb99ce91c6', 'Kiss Péter', 1, '2024-12-01 22:21:46'),
(8, 'operator2@company.com', 'operator2', '688787d8ff144c502c7f5cffaafe2cc588d86079f9de88304c26b0cb99ce91c6', 'Nagy Anna', 2, '2024-12-01 22:21:46'),
(9, 'operator3@company.com', 'operator3', '688787d8ff144c502c7f5cffaafe2cc588d86079f9de88304c26b0cb99ce91c6', 'Szabó Béla', 3, '2024-12-01 22:21:46'),
(10, 'operator4@company.com', 'operator4', '688787d8ff144c502c7f5cffaafe2cc588d86079f9de88304c26b0cb99ce91c6', 'Varga Katalin', 4, '2024-12-01 22:21:46'),
(11, 'operator5@company.com', 'operator5', '688787d8ff144c502c7f5cffaafe2cc588d86079f9de88304c26b0cb99ce91c6', 'Tóth Dávid', 5, '2024-12-01 22:21:46');

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
  MODIFY `instrument_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT a táblához `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `measurements`
--
ALTER TABLE `measurements`
  MODIFY `measurement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT a táblához `operators`
--
ALTER TABLE `operators`
  MODIFY `operator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
