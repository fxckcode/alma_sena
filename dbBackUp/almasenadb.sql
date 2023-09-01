-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-09-2023 a las 18:32:54
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `almasenadb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `fkElemento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `nombreCat` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nombreCat`) VALUES
(1, 'Sin categoria'),
(2, 'Cabeza'),
(3, 'Visual'),
(4, 'Auditivo'),
(5, 'Respiratorio'),
(6, 'Prendas'),
(7, 'Calzado'),
(40, 'Batas'),
(41, 'Prueba 2'),
(42, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elementos`
--

CREATE TABLE `elementos` (
  `idElemento` int(11) NOT NULL,
  `fkCategoria` int(11) NOT NULL,
  `fkTalla` int(10) NOT NULL,
  `elemento` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `color` varchar(10) NOT NULL,
  `existencias` int(10) NOT NULL,
  `observacion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `elementos`
--

INSERT INTO `elementos` (`idElemento`, `fkCategoria`, `fkTalla`, `elemento`, `marca`, `color`, `existencias`, `observacion`) VALUES
(60, 2, 21, 'gafas prueba', 'caterpilar', 'negro', 28, 'Dos cajas'),
(61, 7, 15, 'Botas de seguridad', 'Brama', 'Marrones', 13, 'Tiene la caja nueva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento`
--

CREATE TABLE `movimiento` (
  `idMovimiento` int(11) NOT NULL,
  `tipo_movimiento` enum('salida','entrada') NOT NULL,
  `tomador` int(50) NOT NULL,
  `elemento` int(11) NOT NULL,
  `ficha` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `observacion` text NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimiento`
--

INSERT INTO `movimiento` (`idMovimiento`, `tipo_movimiento`, `tomador`, `elemento`, `ficha`, `cantidad`, `observacion`, `fecha`) VALUES
(30, 'salida', 12104533, 60, 3123131, 1, '', '2023-08-30'),
(31, 'salida', 12104533, 61, 3123131, 1, '', '2023-08-30'),
(32, 'entrada', 12388888, 60, 0, 12, '', '2023-08-30'),
(33, 'salida', 98752, 60, 312313, 7, '', '2023-08-30'),
(34, 'salida', 12104533, 60, 231332321, 1, 'tiene todo completado', '2023-08-31'),
(35, 'salida', 12104533, 61, 231332321, 1, 'tiene todo completado', '2023-08-31'),
(36, 'salida', 12104535, 60, 2147483647, 1, 'zapatos sdaaaaaaaaa', '2023-09-01'),
(37, 'entrada', 12388888, 61, 0, 10, '', '2023-09-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tallas`
--

CREATE TABLE `tallas` (
  `idTalla` int(11) NOT NULL,
  `tallas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tallas`
--

INSERT INTO `tallas` (`idTalla`, `tallas`) VALUES
(2, 'Talla s'),
(3, 'Talla m'),
(4, 'Talla L'),
(5, 'Talla xL'),
(6, 'Talla 30'),
(7, 'Talla 31'),
(8, 'Talla 32'),
(9, 'Talla 33'),
(10, 'Talla 34'),
(11, 'Talla 35'),
(12, 'Talla 36'),
(13, 'Talla 37'),
(14, 'Talla 38'),
(15, 'Talla 39'),
(16, 'Talla 40'),
(17, 'Talla 41'),
(18, 'Talla 42'),
(19, 'Talla 43'),
(20, 'Talla 44'),
(21, 'No aplica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `rol` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `telefono`, `password`, `email`, `rol`) VALUES
(98752, 'Carlos Andrés Carne de res', '310310310', '7cec85c75537840dad40251576e5b757', 's@sss.com', 'user'),
(12103539, 'Carlos Andrés Cubides', '321000254', '', 'ccubides@gmail.com', 'user'),
(12104533, 'Federrico', '03108869831', '', 'adolfo1951@hotmail.co', 'user'),
(12104535, 'Adolfo ', '3108869831', '', 'adolfo1951@hotmail.com', 'user'),
(12104539, 'José Fernando Gonzales Pacheco', '3108869831', '', 'jfgp@mail.com', 'user'),
(12265488, 'Max Power', '3108869831', '473803f0f2ebd77d83ee60daaa61f381', 'jafajardo8845@soy.sena.edu.co', 'admin'),
(12388888, 'admin 34', '02938109', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 'admin'),
(106134531, 'Francisca', '0', '26588e932c7ccfa1df309280702fe1b5', 'fran@mail.com.co', 'user'),
(123654789, 'José Fernando Gonzales Pacheco', '3108869831', '202cb962ac59075b964b07152d234b70', 'cachon@cuernos.com', 'user'),
(325539287, 'Fernando Gonzales Pacheco', '325739528', '', 'pacheco@correo.com', 'user'),
(1223334444, 'ferdinand', '3108869831', 'ebf6994fb3dacbfd95b8653d210b6bcc', '123@mail.co', 'user'),
(2147483647, 'Usuario de Prueba', '0', 'd375af34cc08aba9a1cc9b6596a70c36', 'test@mail.co', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkElemento` (`fkElemento`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `elementos`
--
ALTER TABLE `elementos`
  ADD PRIMARY KEY (`idElemento`),
  ADD KEY `idTipo` (`fkTalla`),
  ADD KEY `fkCategoria` (`fkCategoria`);

--
-- Indices de la tabla `movimiento`
--
ALTER TABLE `movimiento`
  ADD PRIMARY KEY (`idMovimiento`),
  ADD KEY `tomador` (`tomador`),
  ADD KEY `elemento` (`elemento`),
  ADD KEY `elemento_2` (`elemento`);

--
-- Indices de la tabla `tallas`
--
ALTER TABLE `tallas`
  ADD PRIMARY KEY (`idTalla`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `elementos`
--
ALTER TABLE `elementos`
  MODIFY `idElemento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `movimiento`
--
ALTER TABLE `movimiento`
  MODIFY `idMovimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `tallas`
--
ALTER TABLE `tallas`
  MODIFY `idTalla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`fkElemento`) REFERENCES `elementos` (`idElemento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `elementos`
--
ALTER TABLE `elementos`
  ADD CONSTRAINT `elementos_ibfk_1` FOREIGN KEY (`fkTalla`) REFERENCES `tallas` (`idTalla`) ON UPDATE CASCADE,
  ADD CONSTRAINT `elementos_ibfk_2` FOREIGN KEY (`fkCategoria`) REFERENCES `categorias` (`idCategoria`) ON DELETE CASCADE;

--
-- Filtros para la tabla `movimiento`
--
ALTER TABLE `movimiento`
  ADD CONSTRAINT `movimiento_ibfk_1` FOREIGN KEY (`tomador`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movimiento_ibfk_2` FOREIGN KEY (`elemento`) REFERENCES `elementos` (`idElemento`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
