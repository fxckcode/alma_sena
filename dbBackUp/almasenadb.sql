-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-09-2023 a las 16:13:04
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
  `fk_elemento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Sin categoria'),
(2, 'Cabeza'),
(3, 'Visual'),
(4, 'Auditivo'),
(5, 'Respiratorio'),
(6, 'Prendas'),
(7, 'Calzado'),
(40, 'Batas'),
(42, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elementos`
--

CREATE TABLE `elementos` (
  `id` int(11) NOT NULL,
  `fk_categoria` int(11) NOT NULL,
  `fk_talla` int(10) NOT NULL,
  `elemento` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `color` varchar(10) NOT NULL,
  `existencias` int(10) NOT NULL,
  `observacion` varchar(500) NOT NULL,
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `elementos`
--

INSERT INTO `elementos` (`id`, `fk_categoria`, `fk_talla`, `elemento`, `marca`, `color`, `existencias`, `observacion`, `estado`) VALUES
(62, 2, 21, 'Casco', 'ninguna', 'Blanco', 6, 'Una caja\n', 'activo'),
(63, 6, 3, 'Guaantes', 'X-Fit', 'Negro', 9, '', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento`
--

CREATE TABLE `movimiento` (
  `id` int(11) NOT NULL,
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

INSERT INTO `movimiento` (`id`, `tipo_movimiento`, `tomador`, `elemento`, `ficha`, `cantidad`, `observacion`, `fecha`) VALUES
(54, 'salida', 11223344, 62, 2147483647, 5, 'hola', '2023-09-11'),
(55, 'salida', 12104533, 62, 231313123, 4, '', '2023-09-11'),
(56, 'entrada', 12388888, 62, 0, 10, '', '2023-09-11'),
(57, 'salida', 11223344, 62, 211231231, 2, '', '2023-09-13'),
(58, 'entrada', 12388888, 62, 0, 2, '', '2023-09-13'),
(59, 'salida', 11223344, 62, 231313, 1, '2131', '2023-09-14'),
(60, 'salida', 11223344, 62, 23123131, 2, '', '2023-09-14'),
(61, 'salida', 11223344, 62, 2121212, 2, '', '2023-09-14'),
(62, 'salida', 11223344, 63, 2121212, 3, '', '2023-09-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tallas`
--

CREATE TABLE `tallas` (
  `id` int(11) NOT NULL,
  `tallas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tallas`
--

INSERT INTO `tallas` (`id`, `tallas`) VALUES
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
(11223344, 'user', '', 'ee11cbb19052e40b07aac0ca060c23ee', 'user@gmail.com', 'user'),
(12104533, 'Federrico 12', '03108869831', '', 'adolfo19512@hotmail.co', 'user'),
(12104535, 'Adolfo el perro', '3108869831', '', 'adolfo1951@hotmail.com', 'user'),
(12104539, 'José Fernando Gonzales Pacheco', '3108869831', '', 'jfgp@mail.com', 'user'),
(12265488, 'Max Power', '3108869831', '473803f0f2ebd77d83ee60daaa61f381', 'jafajardo8845@soy.sena.edu.co', 'admin'),
(12388888, 'Diego Duran', '02938109', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 'admin'),
(31232312, 'Prueba', '1111111111', 'c893bad68927b457dbed39460e6afd62', 'prueba@gmail.com', 'user'),
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
  ADD KEY `fkElemento` (`fk_elemento`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `elementos`
--
ALTER TABLE `elementos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idTipo` (`fk_talla`),
  ADD KEY `fkCategoria` (`fk_categoria`);

--
-- Indices de la tabla `movimiento`
--
ALTER TABLE `movimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tomador` (`tomador`),
  ADD KEY `elemento` (`elemento`),
  ADD KEY `elemento_2` (`elemento`);

--
-- Indices de la tabla `tallas`
--
ALTER TABLE `tallas`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `elementos`
--
ALTER TABLE `elementos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `movimiento`
--
ALTER TABLE `movimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `tallas`
--
ALTER TABLE `tallas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`fk_elemento`) REFERENCES `elementos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `elementos`
--
ALTER TABLE `elementos`
  ADD CONSTRAINT `elementos_ibfk_1` FOREIGN KEY (`fk_talla`) REFERENCES `tallas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `elementos_ibfk_2` FOREIGN KEY (`fk_categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `movimiento`
--
ALTER TABLE `movimiento`
  ADD CONSTRAINT `movimiento_ibfk_1` FOREIGN KEY (`tomador`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movimiento_ibfk_2` FOREIGN KEY (`elemento`) REFERENCES `elementos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
