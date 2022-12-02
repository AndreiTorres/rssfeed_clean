-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2022 a las 07:59:02
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rssfeedclean`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id_noticia` int(11) NOT NULL,
  `noticia_titulo` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `noticia_enlace` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `noticia_descripcion` text COLLATE utf8_spanish2_ci NOT NULL,
  `noticia_fechapub` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `noticia_categoria` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `noticia_imagen` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `id_url` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `urls`
--

CREATE TABLE `urls` (
  `id_url` int(11) NOT NULL,
  `sitio_url` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `enlace` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `contrasena_usuario` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `correo_usuario` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `token_exp` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `contrasena_usuario`, `correo_usuario`, `token`, `token_exp`) VALUES
(8, 'Andrei', 'RSdaxoJJUh4kY', 'demo1@example.com', NULL, NULL),
(9, 'Jesus', 'RSlbeWDhc4mug', 'demo2@example.com', NULL, NULL),
(10, 'Jesus', 'RSlbeWDhc4mug', 'demo3@example.com', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2Njk5NTgyODUsImV4cCI6MTY3MDA0NDY4NSwiZGF0YSI6eyJpZCI6IjEwIiwiY29ycmVvIjoiZGVtbzNAZXhhbXBsZS5jb20ifX0.sYD9vKuX-fIjJ48ffZZ6rCgJU3ezjQkYy8mKVC4aQgc', '1701499687');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id_noticia`),
  ADD KEY `url_noticia` (`id_url`);

--
-- Indices de la tabla `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`id_url`),
  ADD KEY `URL_USUARIO` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo_usuario` (`correo_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `urls`
--
ALTER TABLE `urls`
  MODIFY `id_url` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `url_noticia` FOREIGN KEY (`id_url`) REFERENCES `urls` (`id_url`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `urls`
--
ALTER TABLE `urls`
  ADD CONSTRAINT `URL_USUARIO` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
