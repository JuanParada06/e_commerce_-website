-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 13-04-2024 a las 05:07:17
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `empresa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_empleados`
--

CREATE TABLE `lista_empleados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `apellidos` varchar(128) NOT NULL,
  `correo` varchar(128) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `rol` int(1) NOT NULL,
  `archivo_n` varchar(255) NOT NULL,
  `archivo` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lista_empleados`
--

INSERT INTO `lista_empleados` (`id`, `nombre`, `apellidos`, `correo`, `pass`, `rol`, `archivo_n`, `archivo`, `status`, `eliminado`) VALUES
(1, 'Juan ', 'Parada', 'Juan@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 3, 'fa473fb8a579fae18ab9375fcc6d1a97.png', 'Captura de pantalla (11).png', 1, 0),
(2, 'Carlos ', 'Bayardo', 'carlos@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 2, '5a4450427b22c0ac6920e4b70cfb04f6.png', 'Captura de pantalla 2024-04-08 194657.png', 1, 0),
(3, 'Carlos ', 'Parada', 'cap@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 1, 'e153a803171648270e82e677dbe5b546.png', 'Captura de pantalla 2024-04-08 235223.png', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `clave` varchar(148) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `fecha`, `id_usuario`, `status`, `clave`) VALUES
(1, '2024-04-13', 0, 0, ''),
(2, '2024-04-13', 2, 1, '661a01958dc73'),
(3, '2024-04-13', 2, 1, '661a01cf2fe19'),
(4, '2024-04-13', 2, 1, '661a023f0fda0'),
(5, '2024-04-13', 2, 1, '661a027826db6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_productos`
--

CREATE TABLE `pedidos_productos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos_productos`
--

INSERT INTO `pedidos_productos` (`id`, `id_pedido`, `id_producto`, `cantidad`, `precio`) VALUES
(1, 1, 5, 1, 500),
(2, 1, 14, 1, 500),
(4, 2, 15, 2, 500),
(5, 3, 15, 2, 500),
(6, 4, 15, 1, 500),
(7, 5, 15, 1, 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(138) NOT NULL,
  `codigo` varchar(32) NOT NULL,
  `descripcion` text NOT NULL,
  `costo` double NOT NULL,
  `stock` int(11) NOT NULL,
  `archivo_n` varchar(255) NOT NULL,
  `archivo` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(1) NOT NULL DEFAULT 0,
  `autor` varchar(148) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `codigo`, `descripcion`, `costo`, `stock`, `archivo_n`, `archivo`, `status`, `eliminado`, `autor`) VALUES
(1, 'Una habitacion impropia', 'libro1', 'Libro Fisico', 200, 94, '71aaf1704832b9f2f37f07d65b6f37c0.jpg', 'Libro1.jpg', 1, 0, 'EmlilianoGonzález '),
(2, 'Divina Comedia', 'libro2', 'Libro Fisico', 500, 98, '84e6e484a281ec653485004d0781e5f9.jpg', 'comedia.jpg', 1, 0, 'Dante Alighieri'),
(3, 'Harry Potter y el Prisionero de Azkaban', 'Libro3', 'libro fisico', 400, 98, '20d944ccd0b83f601b376f9751877a23.jpeg', 'har.jpeg', 1, 0, 'J.K Rowling'),
(4, 'Harry Potter y la piedra filosofal', 'Libro4', 'Libro Fisico', 500, 97, 'e708c85b05dc08c15fde4e8446b7b6ba.jpeg', 'HARRY1.jpeg', 1, 0, 'J.K Rowling'),
(5, 'Harry Potter y las reliquias de la muerte', 'Libro5', 'Libro Fisico', 500, 98, 'e640f397ec94d3a9eaad2111133b6d31.jpg', 'Harry.jpg', 1, 0, 'J.K Rowling'),
(6, 'Harry Potter y la camara de los secretos', 'Libro6', 'Libro Fisico', 400, 100, '81be24f6394bf1f9b761c611af358186.jpeg', 'harry2.jpeg', 1, 0, 'J.K Rowling'),
(7, 'Danza De Dragones ', 'Libro7', 'Libro Fisico', 500, 99, '75395d27e8fea8439dfd15453d0a531a.jpg', 'tronos.jpg', 1, 0, 'George Martin'),
(8, 'Fuego y Sangre', 'Libro8', 'Libro Fisico', 500, 98, '88e9c5bd1acbdebdb830f321d5965238.jpg', 'juego.jpg', 1, 0, 'George Martin'),
(9, 'Juego de Tronos ', 'Libro9', 'Libro Fisico', 500, 100, '25355758913d97d1008dede52f637668.jpg', 'libro.jpg', 1, 0, 'George Martin'),
(10, 'Choque de Reyes', 'libro10', 'Libro Fisico', 500, 99, 'bf1eb6b21a18ad595308dbd9ffd96391.jpg', 'lirr.jpg', 1, 0, 'George Martin'),
(11, 'El jardín de las mariposas', 'Libro11', 'Libro Fisico', 500, 99, 'cadd7f6e6e680de0480ff12b27e70894.jpg', 'jardin.jpg', 1, 0, 'Dot Hutchison'),
(12, 'Doctor Sueño', 'Libro12', 'Libro Fisico', 500, 99, 'e98e099fdba6b1b2e3b877278d74f7fe.jpg', 'a.jpg', 1, 0, 'Stephen King'),
(13, 'El resplandor', 'Libro13', 'Libro Fisico', 500, 98, '0521bef1d6abb000682be2424b11d30f.jpg', 'b.jpg', 1, 0, 'Stephen King'),
(14, 'Percy Jackson y los dioses del Olimpo: El Ladrón del rayo.', 'Libro14', 'Libro Fisico', 500, 94, '9015abbbc0e7eceb2b9e489e770d905f.jpg', 'c.jpg', 1, 0, 'Rick Riordan'),
(15, '¡Gracias!', 'Libro15', 'Libro Fisico', 500, 92, '0c533f574e4b520a1250d81fa762ffb5.jpg', 'd.jpg', 1, 0, 'Andrés Manuel López Obrador'),
(16, 'League of Legends. Reinos de Runaterra', 'Libro16', 'Libro Fisico', 500, 99, '6d1c434c6bdd49e8489465ece768687b.jpg', 'aa.jpg', 1, 0, 'Riot Games Merchandise Inc ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `archivo` varchar(64) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`id`, `nombre`, `archivo`, `status`, `eliminado`) VALUES
(1, '2x1', '339182404074a2a8c2ae211f5dfbc086.jpg', 1, 0),
(2, 'Descuento', 'c74e801e08b52b0704f41293241163ad.jpg', 1, 0),
(3, '70%', '31cce137232bb206ebf3dafc19b13910.jpg', 1, 0),
(4, 'Variado', 'a725ace5872aeaaf09f32fc85a438b3c.png', 1, 0),
(5, 'promo', 'db5859c951ea86a8fcfe480e35d5e1c7.png', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `total_pedido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `id_pedido`, `total_pedido`, `id_usuario`) VALUES
(1, 2, 1300, 0),
(2, 3, 1300, 0),
(3, 4, 750, 0),
(4, 5, 750, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `lista_empleados`
--
ALTER TABLE `lista_empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `lista_empleados`
--
ALTER TABLE `lista_empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
