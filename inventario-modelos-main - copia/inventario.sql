-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2025 a las 13:30:06
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `categoriaName` varchar(50) DEFAULT 'NOT NULL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `categoriaName`) VALUES
(101, 'Perecederos'),
(102, 'No perecederos'),
(103, 'Semi-perecederos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `checking`
--

CREATE TABLE `checking` (
  `id_checking` int(11) NOT NULL,
  `fecha_entrega` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
INSERT INTO `checking` (`fecha_entrega`) VALUES
('2025-05-08 10:00:00'),
('2025-05-09 11:30:00'),
('2025-05-10 09:15:00'),
('2025-05-11 14:45:00'),
('2025-05-12 08:30:00'); 
--
-- Estructura de tabla para la tabla `checking_detalle`
--

CREATE TABLE `checking_detalle` (
  `id_checking` int(11) NOT NULL,
  `id_ingrediente` int(11) NOT NULL,
  `cantidad` varchar(20) DEFAULT NULL,
  `coste_total` int(20) DEFAULT NULL,
  `provedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
INSERT INTO `checking_detalle` (`id_cheking`, `id_ingrediente`, `cantidad`, `coste_total`, `provedor`) VALUES

(1, 45, '1000 ml', 500, 1),
(1, 46, '30 unidades', 300, 2),
(1, 47, '500 ml', 200, 3),
(2, 48, '1500 g', 800, 2),
(2, 49, '2000 g', 1200, 2),
(2, 50, '1200 g', 700, 2),
(3, 51, '800 g', 400, 3),
(3, 52, '250 g', 150, 3),
(4, 53, '1500 g', 600, 1),
(4, 54, '1200 g', 300, 1),
(5, 55, '1000 g', 200, 1);
-- Estructura de tabla para la tabla `ingrediente`
--

CREATE TABLE `ingrediente` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `cantidad` varchar(20) NOT NULL DEFAULT 'NOT NULL',
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingrediente`
--

INSERT INTO `ingrediente` (`id`, `name`, `cantidad`, `id_categoria`) VALUES
(45, 'Leche entera', '1000 ml', 101),
(46, 'Huevos', '30 unidades', 101),
(47, 'Yogur natural', '500 ml', 101),
(48, 'Carne molida', '1500 g', 101),
(49, 'Pollo', '2000 g', 101),
(50, 'Pescado', '1200 g', 101),
(51, 'Queso fresco', '800 g', 101),
(52, 'Mantequilla', '250 g', 101),
(53, 'Tomates', '1500 g', 101),
(54, 'Zanahorias', '1200 g', 101),
(55, 'Cebolla', '1000 g', 101),
(56, 'Pimientos', '800 g', 101),
(57, 'Espinaca', '400 g', 101),
(58, 'Brócoli', '500 g', 101),
(59, 'Plátanos', '1000 g', 101),
(60, 'Carne de res', '1800 g', 101),
(61, 'Carne de pollo', '1600 g', 101),
(62, 'Carne de chancho', '1700 g', 101),
(63, 'Pan de molde', '600 g', 103),
(64, 'Tortillas de harina', '300 g', 103),
(65, 'Galletas saladas', '200 g', 103),
(66, 'Embutidos', '500 g', 103),
(67, 'Jamón cocido', '700 g', 103),
(68, 'Salchichas', '1000 g', 103),
(69, 'Pasta cocida', '500 g', 103),
(70, 'Frutas deshidratadas', '300 g', 103),
(71, 'Yuca cocida', '700 g', 103),

(73, 'Arroz', '5000 g', 102),
(74, 'Harina de trigo', '4000 g', 102),
(75, 'Azúcar', '3000 g', 102),
(76, 'Sal', '2000 g', 102),
(77, 'Aceite vegetal', '2500 ml', 102),
(78, 'Vinagre', '1000 ml', 102),
(79, 'Lentejas', '1500 g', 102),
(80, 'Frijoles', '1700 g', 102),
(81, 'Café molido', '900 g', 102),
(82, 'Té en bolsitas', '500 g', 102),
(83, 'Leche en polvo', '1200 g', 102),
(84, 'Cereal en caja', '800 g', 102),
(85, 'Chocolate en polvo', '600 g', 102),
(86, 'Maicena', '1000 g', 102),
(87, 'Avena', '2000 g', 102);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingrediente_reabastecimiento`
--

CREATE TABLE `ingrediente_reabastecimiento` (
  `id_ingrediente` int(11) NOT NULL,
  `cost_unit` int(11) NOT NULL,
  `Almacenamiento_Max` varchar(20) DEFAULT NULL,
  `Punto_de_reordenar` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provedor`
--

CREATE TABLE `provedor` (
  `id_provedor` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `especialidad` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--


--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `checking`
--
ALTER TABLE `checking`
  ADD PRIMARY KEY (`id_checking`) NOT NULL AUTO_INCREMENT=1;

--
-- Indices de la tabla `checking_detalle`
--
ALTER TABLE `checking_detalle`
  ADD KEY `detall1` (`id_cheking`),
  ADD KEY `integr1` (`id_ingrediente`),
  ADD KEY `prove` (`provedor`);

--
-- Indices de la tabla `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `ingrediente_reabastecimiento`
--
ALTER TABLE `ingrediente_reabastecimiento`
  ADD KEY `RELACION1` (`id_ingrediente`);

--
-- Indices de la tabla `provedor`
--
ALTER TABLE `provedor`
  ADD PRIMARY KEY (`id_provedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de la tabla `checking`
--
ALTER TABLE `checking`
  MODIFY `id_checking` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingrediente`
--
ALTER TABLE `ingrediente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `provedor`
--
ALTER TABLE `provedor`
  MODIFY `id_provedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `checking_detalle`
--
ALTER TABLE `checking_detalle`
  ADD CONSTRAINT `detall1` FOREIGN KEY (`id_checking`) REFERENCES `checking` (`id_checking`),
  ADD CONSTRAINT `integr1` FOREIGN KEY (`id_ingrediente`) REFERENCES `ingrediente` (`id`),
  ADD CONSTRAINT `prove` FOREIGN KEY (`provedor`) REFERENCES `provedor` (`id_provedor`);

--
-- Filtros para la tabla `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD CONSTRAINT `ingrediente_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);

--
-- Filtros para la tabla `ingrediente_reabastecimiento`
--
ALTER TABLE `ingrediente_reabastecimiento`
  ADD CONSTRAINT `RELACION1` FOREIGN KEY (`id_ingrediente`) REFERENCES `ingrediente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
