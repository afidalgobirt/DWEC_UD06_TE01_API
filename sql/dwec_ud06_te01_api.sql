-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2022 a las 18:16:39
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dwec_ud06_te01_api`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(9) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`id`, `name`, `lastName`, `address`, `email`, `phone`) VALUES
(1, 'Aitor', 'Fidalgo', 'Calle Etxegorri', 'afidalgo@birt.eus', '123456789'),
(2, 'Gorka', 'Fernandez', 'Calle Mezo', 'gfernandez@birt.eus', '123456789'),
(3, 'David', 'Uriarte', 'Calle Gorostiza', 'duriarte@birt.eus', '123456789'),
(4, 'Borja', 'Perez', 'Calle Buenavista', 'bperez@birt.eus', '123456789'),
(5, 'Amaia', 'Gonzalez', 'Calle Me falta un tornillo', 'agonzalez@birt.eus', '123456789'),
(6, 'Maider', 'Hernandez', 'Calle Karl Marx', 'mhernandez@birt.eus', '123456789');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `unitOfMeasure` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `pricePerUnit` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `name`, `stock`, `unitOfMeasure`, `pricePerUnit`) VALUES
(1, 'Camiseta 1', 60, 'ud', 12.45),
(2, 'Camiseta 2', 30, 'ud', 15.45),
(3, 'Camiseta 3', 25, 'ud', 19.95),
(4, 'Sudadera 1', 10, 'ud', 19.95),
(5, 'Sudadera 2', 17, 'ud', 24.45),
(6, 'Sudadera 3', 32, 'ud', 29.95);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saleorder`
--

CREATE TABLE `saleorder` (
  `id` int(6) UNSIGNED NOT NULL,
  `clientId` int(6) UNSIGNED NOT NULL,
  `orderDateTime` datetime NOT NULL,
  `expectedDeliveryDate` date NOT NULL,
  `deliveryDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `saleorder`
--

INSERT INTO `saleorder` (`id`, `clientId`, `orderDateTime`, `expectedDeliveryDate`, `deliveryDate`) VALUES
(1, 1, '2022-05-08 17:57:58', '2022-05-22', '1970-01-01'),
(2, 1, '2022-05-08 17:59:53', '2022-07-22', '1970-01-01'),
(3, 2, '2022-05-08 18:00:03', '2022-06-12', '1970-01-01'),
(4, 3, '2022-05-08 18:00:10', '2022-06-16', '1970-01-01'),
(5, 3, '2022-05-08 18:00:24', '2022-05-19', '1970-01-01'),
(6, 3, '2022-05-08 18:00:28', '2022-09-19', '1970-01-01'),
(7, 4, '2022-05-08 18:00:34', '2022-05-19', '1970-01-01'),
(8, 5, '2022-05-08 18:00:44', '2022-05-30', '1970-01-01'),
(9, 5, '2022-05-08 18:00:50', '2022-07-18', '1970-01-01'),
(10, 6, '2022-05-08 18:01:05', '2022-06-13', '1970-01-01'),
(11, 6, '2022-05-08 18:01:11', '2022-07-07', '1970-01-01'),
(12, 6, '2022-05-08 18:01:23', '2022-07-24', '1970-01-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saleorderline`
--

CREATE TABLE `saleorderline` (
  `id` int(6) UNSIGNED NOT NULL,
  `saleOrderId` int(6) UNSIGNED NOT NULL,
  `productId` int(6) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `saleorderline`
--

INSERT INTO `saleorderline` (`id`, `saleOrderId`, `productId`, `quantity`) VALUES
(1, 1, 1, 2),
(2, 1, 4, 1),
(3, 2, 3, 3),
(4, 3, 6, 6),
(5, 3, 1, 2),
(6, 3, 2, 4),
(7, 4, 5, 1),
(8, 5, 1, 1),
(9, 5, 4, 7),
(10, 5, 2, 2),
(11, 6, 2, 1),
(12, 7, 5, 2),
(13, 8, 3, 2),
(14, 8, 4, 1),
(15, 8, 6, 7),
(16, 9, 6, 1),
(17, 9, 2, 2),
(18, 9, 3, 4),
(19, 10, 1, 1),
(20, 11, 4, 2),
(21, 11, 3, 2),
(22, 12, 1, 5),
(23, 12, 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `saleorder`
--
ALTER TABLE `saleorder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientFK` (`clientId`) USING BTREE;

--
-- Indices de la tabla `saleorderline`
--
ALTER TABLE `saleorderline`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saleOrderFK` (`saleOrderId`),
  ADD KEY `productFK` (`productId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `client`
--
ALTER TABLE `client`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `saleorder`
--
ALTER TABLE `saleorder`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `saleorderline`
--
ALTER TABLE `saleorderline`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `saleorder`
--
ALTER TABLE `saleorder`
  ADD CONSTRAINT `client` FOREIGN KEY (`clientId`) REFERENCES `client` (`id`);

--
-- Filtros para la tabla `saleorderline`
--
ALTER TABLE `saleorderline`
  ADD CONSTRAINT `productFK` FOREIGN KEY (`productId`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `saleOrderFK` FOREIGN KEY (`saleOrderId`) REFERENCES `saleorder` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
