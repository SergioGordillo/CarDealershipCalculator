-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2017 a las 21:38:08
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `concesionario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `NIF` varchar(9) NOT NULL,
  `Nombre` varchar(25) NOT NULL,
  `Apellido1` varchar(25) NOT NULL,
  `Apellido2` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`NIF`, `Nombre`, `Apellido1`, `Apellido2`) VALUES
('11111111A', 'Juan', 'Perez', 'Lopez'),
('22222222A', 'Luisa', 'Vera', 'Garcia'),
('33333333A', 'Antonio', 'Gomez', 'Torres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coches`
--

CREATE TABLE `coches` (
  `Id` int(11) NOT NULL,
  `Marca` varchar(20) NOT NULL,
  `Modelo` varchar(20) NOT NULL,
  `Precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `coches`
--

INSERT INTO `coches` (`Id`, `Marca`, `Modelo`, `Precio`) VALUES
(1, 'Ford', 'Fiesta', 1000),
(2, 'Ford', 'Escord', 1500),
(3, 'Renault', 'Megane', 1600),
(4, 'Renault', 'Laguna', 1700),
(5, 'BMW', '320D', 3000),
(6, 'BMW', '330d', 3500),
(7, 'Testla', 'ModelS', 5000),
(8, 'Testla', 'ModelX', 6000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extra`
--

CREATE TABLE `extra` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `extra`
--

INSERT INTO `extra` (`Id`, `Nombre`, `Precio`) VALUES
(1, 'Climatizador', 100),
(2, 'GPS', 150),
(3, 'Pantalla Tactil', 300),
(4, 'Farox Xenon', 400),
(5, 'Tapiceria Cuero', 350),
(6, 'Techo Solar', 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extrapedido`
--

CREATE TABLE `extrapedido` (
  `IdPedido` int(11) NOT NULL,
  `IdExtra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `extrapedido`
--

INSERT INTO `extrapedido` (`IdPedido`, `IdExtra`) VALUES
(6, 4),
(7, 1),
(7, 2),
(7, 3),
(8, 2),
(8, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `Id` int(11) NOT NULL,
  `IdCoche` int(11) NOT NULL,
  `IdCliente` varchar(9) NOT NULL,
  `Fecha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`Id`, `IdCoche`, `IdCliente`, `Fecha`) VALUES
(2, 2, '22222222A', 1513283264),
(3, 2, '22222222A', 1513283294),
(4, 2, '22222222A', 1513283339),
(5, 2, '22222222A', 1513283361),
(6, 5, '22222222A', 1513283557),
(7, 8, '33333333A', 1513283593),
(8, 5, '22222222A', 1513283822);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`NIF`);

--
-- Indices de la tabla `coches`
--
ALTER TABLE `coches`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `extra`
--
ALTER TABLE `extra`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `extrapedido`
--
ALTER TABLE `extrapedido`
  ADD PRIMARY KEY (`IdPedido`,`IdExtra`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `coches`
--
ALTER TABLE `coches`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `extra`
--
ALTER TABLE `extra`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
