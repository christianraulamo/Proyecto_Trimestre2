-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-02-2020 a las 18:50:58
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `receta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingrediente`
--

CREATE TABLE `ingrediente` (
  `IdIngrediente` int(11) NOT NULL,
  `IngredientePrincipal` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ingrediente`
--

INSERT INTO `ingrediente` (`IdIngrediente`, `IngredientePrincipal`) VALUES
(1, 'Pesto'),
(2, 'Carne'),
(3, 'Pez Espada'),
(4, 'Ternera'),
(5, 'Sardina'),
(6, 'Salmon '),
(7, 'Salmon '),
(8, 'Garbanzo'),
(9, 'Pera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `otros`
--

CREATE TABLE `otros` (
  `IdOtros` int(11) NOT NULL,
  `Otros` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `otros`
--

INSERT INTO `otros` (`IdOtros`, `Otros`) VALUES
(1, 'q'),
(2, 'a'),
(3, 'a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta`
--

CREATE TABLE `receta` (
  `IdRec` int(11) NOT NULL,
  `NomRec` varchar(300) NOT NULL,
  `Tiempo` int(11) NOT NULL,
  `Raciones` int(11) NOT NULL,
  `Temporada` varchar(200) DEFAULT NULL,
  `Posicion` varchar(300) NOT NULL,
  `Clase` varchar(300) NOT NULL,
  `Tipo` varchar(300) NOT NULL,
  `Uso` varchar(300) NOT NULL,
  `Metodo` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `receta`
--

INSERT INTO `receta` (`IdRec`, `NomRec`, `Tiempo`, `Raciones`, `Temporada`, `Posicion`, `Clase`, `Tipo`, `Uso`, `Metodo`) VALUES
(9, 'Prueba', 21, 2, 'Primavera', 'Aperitivo', 'Pasta', 'Vegetariano', 'Fiesta', 'Horno'),
(14, 'a', 2, 2, 'Invierno', 'a', 'a', 'a', 'a', 'a'),
(29, 'a', 3, 3, 'Otoño', '3', '3', '33', '3', '3'),
(42, 'a', 3, 3, 'Otoño', 'f', 'f', 'f', 'f', 'f'),
(43, 'a', 232, 2, 'Invierno', '3', '33', '3', '3', '3'),
(44, 'a', 2, 2, 'Invierno', '2', '2', '2', '2', '2'),
(45, 'a', 3, 3, 'Invierno', '3', '3', '3', '3', '3'),
(46, 'a', 2, 2, 'Otoño', '2', '2', '2', '2', '2'),
(47, 'a', 2, 2, 'Otoño', '2', '2', '2', '2', '2'),
(48, 'a', 2, 2, 'Primavera', '2', '2', '2', '22', '2'),
(49, 'a', 2, 2, 'Primavera', '2', '2', '2', '22', '2'),
(50, 'a', 3, 3, 'Otoño', '3', '3', '3', '3', '3'),
(51, 'a', 3, 3, 'Otoño', '3', '3', '3', '3', '3'),
(52, 'a', 3, 3, 'Otoño', '3', '3', '3', '3', '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetasfavoritas`
--

CREATE TABLE `recetasfavoritas` (
  `IdRec` int(11) NOT NULL,
  `IdUsu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rec_ingrediente`
--

CREATE TABLE `rec_ingrediente` (
  `IdRec` int(11) NOT NULL,
  `IdIngrediente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rec_ingrediente`
--

INSERT INTO `rec_ingrediente` (`IdRec`, `IdIngrediente`) VALUES
(9, 1),
(14, 2),
(42, 7),
(45, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IdUsu` int(11) NOT NULL,
  `Correo` varchar(100) NOT NULL,
  `NomUsu` varchar(100) NOT NULL,
  `ApeUsu` varchar(100) NOT NULL,
  `Contraseña` varchar(100) NOT NULL,
  `Admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsu`, `Correo`, `NomUsu`, `ApeUsu`, `Contraseña`, `Admin`) VALUES
(0, 'prueba@gmail.com', 'pruebas', 'prueba', 'c893bad68927b457dbed39460e6afd62', 1),
(2, 'davidgmz.deepbox@gmail.com', 'David', 'Gómez Parra', 'dc78298261719c5922b2f7f9258e3448', 0),
(6, 'ejemplo@gmail.com', 'Christian', 'Amo Olsson', '2f1767dc31e7a8dc68b2c21bf07984ff', 0),
(11, 'a@gmail.com', 'a', '', 'd41d8cd98f00b204e9800998ecf8427e', 0),
(12, 'prueba2@gmail.com', 'prueba', '', 'd41d8cd98f00b204e9800998ecf8427e', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD PRIMARY KEY (`IdIngrediente`);

--
-- Indices de la tabla `otros`
--
ALTER TABLE `otros`
  ADD PRIMARY KEY (`IdOtros`);

--
-- Indices de la tabla `receta`
--
ALTER TABLE `receta`
  ADD PRIMARY KEY (`IdRec`);

--
-- Indices de la tabla `recetasfavoritas`
--
ALTER TABLE `recetasfavoritas`
  ADD PRIMARY KEY (`IdRec`,`IdUsu`),
  ADD KEY `IdUsu` (`IdUsu`);

--
-- Indices de la tabla `rec_ingrediente`
--
ALTER TABLE `rec_ingrediente`
  ADD PRIMARY KEY (`IdRec`,`IdIngrediente`),
  ADD KEY `IdIngrediente` (`IdIngrediente`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ingrediente`
--
ALTER TABLE `ingrediente`
  MODIFY `IdIngrediente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `otros`
--
ALTER TABLE `otros`
  MODIFY `IdOtros` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `receta`
--
ALTER TABLE `receta`
  MODIFY `IdRec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `recetasfavoritas`
--
ALTER TABLE `recetasfavoritas`
  ADD CONSTRAINT `recetasfavoritas_ibfk_1` FOREIGN KEY (`IdRec`) REFERENCES `receta` (`IdRec`),
  ADD CONSTRAINT `recetasfavoritas_ibfk_2` FOREIGN KEY (`IdUsu`) REFERENCES `usuario` (`IdUsu`);

--
-- Filtros para la tabla `rec_ingrediente`
--
ALTER TABLE `rec_ingrediente`
  ADD CONSTRAINT `rec_ingrediente_ibfk_1` FOREIGN KEY (`IdIngrediente`) REFERENCES `ingrediente` (`IdIngrediente`),
  ADD CONSTRAINT `rec_ingrediente_ibfk_2` FOREIGN KEY (`IdRec`) REFERENCES `receta` (`IdRec`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
