-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 02-05-2022 a las 10:15:23
-- Versión del servidor: 10.5.13-MariaDB
-- Versión de PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id18871277_dwec_ud06_te01_api`
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saleOrder`
--

CREATE TABLE `saleOrder` (
  `id` int(6) UNSIGNED NOT NULL,
  `clientId` int(6) UNSIGNED NOT NULL,
  `orderDateTime` datetime NOT NULL,
  `expectedDeliveryDate` date NOT NULL,
  `deliveryDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saleOrderLine`
--

CREATE TABLE `saleOrderLine` (
  `id` int(6) UNSIGNED NOT NULL,
  `saleOrderId` int(6) UNSIGNED NOT NULL,
  `productId` int(6) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Indices de la tabla `saleOrder`
--
ALTER TABLE `saleOrder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientFK` (`clientId`) USING BTREE;

--
-- Indices de la tabla `saleOrderLine`
--
ALTER TABLE `saleOrderLine`
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
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `saleOrder`
--
ALTER TABLE `saleOrder`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `saleOrderLine`
--
ALTER TABLE `saleOrderLine`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `saleOrder`
--
ALTER TABLE `saleOrder`
  ADD CONSTRAINT `client` FOREIGN KEY (`clientId`) REFERENCES `client` (`id`);

--
-- Filtros para la tabla `saleOrderLine`
--
ALTER TABLE `saleOrderLine`
  ADD CONSTRAINT `productFK` FOREIGN KEY (`productId`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `saleOrderFK` FOREIGN KEY (`saleOrderId`) REFERENCES `saleOrder` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
