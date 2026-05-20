-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 19-05-2026 a las 21:40:29
-- Versión del servidor: 5.7.39
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `conweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `id_actividad` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `texto` varchar(255) NOT NULL,
  `detalle` varchar(255) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`id_actividad`, `id_usuario`, `tipo`, `texto`, `detalle`, `color`, `fecha_hora`) VALUES
(1, 2, 'contacto', 'Rafael Muñoz Gonzalez añadido a Contactos', '', '', '2026-05-15 21:27:50'),
(2, 2, 'contacto', 'Mama prez actualizado', 'Contacto modificado', '', '2026-05-15 21:28:31'),
(3, 2, 'categoria', 'Categoría Trabajo creada', 'Trabajo', '#1E4D8C', '2026-05-15 21:29:00'),
(4, 2, 'categoria', 'Categoría Oficina creada', 'Oficina', '#EF4444', '2026-05-15 21:29:09'),
(5, 2, 'categoria', 'Categoría Amigos actualizada', 'Amigos', '#2BB673', '2026-05-15 21:29:58'),
(6, 2, 'perfil', 'Perfil de usuario actualizado', 'Lola', '', '2026-05-15 21:30:20'),
(7, 2, 'csv', 'Exportación CSV realizada', 'Contactos exportados', '', '2026-05-15 21:30:32'),
(8, 2, 'contacto', 'Mama Perez actualizado', 'Contacto modificado', '', '2026-05-15 21:31:12'),
(9, 1, 'categoria', 'Categoría AMIGOS creada', 'AMIGOS', '#74D9A7', '2026-05-16 16:43:58'),
(10, 1, 'categoria', 'Categoría TRABAJO creada', 'TRABAJO', '#6FAEF2', '2026-05-16 16:44:08'),
(11, 1, 'categoria', 'Categoría PROVEEDOR creada', 'PROVEEDOR', '#9B7CF3', '2026-05-16 16:44:15'),
(12, 1, 'categoria', 'Categoría FAMILIA creada', 'FAMILIA', '#E91E63', '2026-05-16 16:44:26'),
(13, 1, 'categoria', 'Categoría OCIO creada', 'OCIO', '#C65A00', '2026-05-16 16:44:43'),
(14, 1, 'contacto', 'Rafael FWE añadido a Contactos', '', '', '2026-05-16 16:45:40'),
(15, 1, 'contacto', 'Lola Perez Vazquez añadido a Contactos', '', '', '2026-05-16 16:47:39'),
(16, 1, 'contacto', 'Julio Muñoz añadido a Contactos', '', '', '2026-05-16 16:48:17'),
(17, 1, 'contacto', 'Carmen Rodriguez añadido a Contactos', '', '', '2026-05-16 16:48:42'),
(18, 1, 'contacto', 'Manuel Vazquez Perez añadido a Contactos', '', '', '2026-05-16 16:49:14'),
(19, 1, 'contacto', 'Lola Perez Vazquez actualizado', 'Contacto modificado', '', '2026-05-16 17:29:56'),
(20, 1, 'contacto', 'Carmen Rodriguez actualizado', 'Contacto modificado', '', '2026-05-16 17:30:07'),
(21, 1, 'contacto', 'Amapola añadido a Contactos', '', '', '2026-05-16 18:13:23'),
(22, 1, 'categoria', 'Categoría Padel creada', 'Padel', '#7AD7F0', '2026-05-16 18:39:06'),
(23, 1, 'categoria', 'Categoría PADEL actualizada', 'PADEL', '#7AD7F0', '2026-05-16 18:39:17'),
(24, 1, 'contacto', 'Arturo Serrano González añadido a Contactos', '', '', '2026-05-16 18:40:09'),
(25, 1, 'contacto', 'Arturo Serrano González actualizado', 'Contacto modificado', '', '2026-05-16 18:40:32'),
(26, 1, 'contacto', 'Prueva añadido a Contactos', '', '', '2026-05-16 19:12:38'),
(27, 1, 'categoria', 'Categoría sdew creada', 'sdew', '#F5C45E', '2026-05-16 19:12:45'),
(28, 1, 'perfil', 'Perfil de usuario actualizado', 'Sergio', '', '2026-05-16 19:12:50'),
(29, 1, 'perfil', 'Perfil de usuario actualizado', 'Sergio', '', '2026-05-16 19:13:12'),
(30, 1, 'perfil', 'Perfil de usuario actualizado', 'Sergio', '', '2026-05-16 19:13:37'),
(31, 1, 'perfil', 'Perfil de usuario actualizado', 'Sergio', '', '2026-05-16 19:34:14'),
(32, 1, 'perfil', 'Perfil de usuario actualizado', 'Sergio M', '', '2026-05-16 19:34:20'),
(33, 1, 'perfil', 'Perfil de usuario actualizado', 'Sergio', '', '2026-05-16 19:34:24'),
(34, 1, 'contacto', 'drferv añadido a Contactos', '', '', '2026-05-17 11:54:39'),
(35, 1, 'categoria', 'Categoría erfer creada', 'erfer', '#E57ACD', '2026-05-17 11:54:48'),
(36, 1, 'perfil', 'Perfil de usuario actualizado', 'Sergio fr', '', '2026-05-17 11:54:56'),
(37, 1, 'perfil', 'Perfil de usuario actualizado', 'Sergio', '', '2026-05-17 11:55:00'),
(38, 1, 'perfil', 'Perfil de usuario actualizado', 'Sergio', '', '2026-05-17 12:33:14'),
(39, 1, 'categoria', 'Categoría Fútbol creada', 'Fútbol', '#F5C45E', '2026-05-17 21:02:52'),
(40, 1, 'categoria', 'Categoría FÚTBOL actualizada', 'FÚTBOL', '#F5C45E', '2026-05-17 21:03:13'),
(41, 1, 'categoria', 'Categoría Banquillo creada', 'Banquillo', '#E57ACD', '2026-05-17 21:18:38'),
(42, 1, 'contacto', 'Lola Perez Vazquez actualizado', 'Contacto modificado', '', '2026-05-17 21:22:03'),
(43, 1, 'contacto', 'Rafael FWE actualizado', 'Contacto modificado', '', '2026-05-17 21:22:19'),
(44, 1, 'perfil', 'Perfil de usuario actualizado', 'Sergio', '', '2026-05-17 23:56:01'),
(45, 1, 'perfil', 'Perfil de usuario actualizado', 'Sergio', '', '2026-05-17 23:56:03'),
(46, 1, 'categoria', 'Categoría PRUEBA creada', 'PRUEBA', '#7AD7F0', '2026-05-19 18:01:21'),
(47, 1, 'categoria', 'Categoría AMIGOS actualizada', 'AMIGOS', '#74D9A7', '2026-05-19 18:30:37'),
(48, 1, 'csv', 'Exportación CSV realizada', 'Contactos exportados', '', '2026-05-19 18:31:08'),
(49, 1, 'categoria', 'Categoría AMIGOS actualizada', 'AMIGOS', '#74D9A7', '2026-05-19 20:12:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `color_hex` varchar(7) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`, `color_hex`, `id_usuario`) VALUES
(7, 'Amigos', '#74D9A7', 2),
(12, 'Trabajo', '#1E4D8C', 2),
(13, 'Oficina', '#E91E63', 2),
(14, 'AMIGOS', '#74D9A7', 1),
(15, 'TRABAJO', '#6FAEF2', 1),
(16, 'PROVEEDOR', '#9B7CF3', 1),
(18, 'OCIO', '#C65A00', 1),
(24, 'PRUEBA', '#7AD7F0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id_contacto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(150) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `empresa` varchar(120) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `notas` text,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `eliminado` tinyint(1) NOT NULL DEFAULT '0',
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id_contacto`, `nombre`, `apellidos`, `telefono`, `email`, `empresa`, `id_categoria`, `notas`, `fecha_creacion`, `eliminado`, `id_usuario`) VALUES
(1, 'Laura', 'García López', '600123456', 'laura@email.com', 'Diseño Web Studio', 2, 'Contacto de prueba del proyecto.', '2026-05-11 21:09:32', 1, 1),
(2, 'Carlos', 'Martín Ruiz', '611222333', 'carlos@email.com', 'Tech Solutions', 9, 'Cliente interesado en servicios web.', '2026-05-11 21:09:32', 1, 1),
(3, 'Ana', 'Pérez Santos', '622333444', 'ana@email.com', 'Freelance', NULL, 'Contacto personal.', '2026-05-11 21:09:32', 1, 1),
(4, 'Rafael', 'Muñozzzzz', '924565758', 'rafgme@gmail.com', 'Zafra Digital', 3, 'Contacto primero creado de prueba.', '2026-05-11 21:36:39', 1, 1),
(5, 'dee', 'eded', 'deed', 'dee@dd.com', 'deed', NULL, 'ede', '2026-05-11 21:47:53', 1, 1),
(6, 'Mama', 'Perez', '658719245', 'ser@heh.com', 'Lidel', 13, 'nuevo contacto', '2026-05-12 20:41:28', 0, 2),
(7, 'Amapola', 'Robles Perez', '87878787', 'ama@gmail.es', 'Dinamo SL', 1, 'hola caracola', '2026-05-13 19:10:43', 1, 1),
(8, 'rgrg', '', '', '', '', NULL, '', '2026-05-14 17:24:10', 1, 1),
(9, 'Mauel', '', '', '', '', NULL, '', '2026-05-15 20:29:34', 1, 1),
(10, 'Rafael Muñoz Gonzalez', '', '58767876', 'afa@gmail.es', 'Diter SL', 7, 'no hay nada que decir.', '2026-05-15 21:27:50', 0, 2),
(11, 'Rafael FWE', '', '67365435', 'RAFA@GMAIL.COM', 'Lidel SL', 14, 'Compañero de trabajo', '2026-05-16 16:45:40', 0, 1),
(12, 'Lola Perez Vazquez', '', '6587198276', '', 'conweb', 18, 'Amiga de café', '2026-05-16 16:47:39', 0, 1),
(13, 'Julio Muñoz', '', '657656890', 'julio@gmail.es', 'VF SL', NULL, '', '2026-05-16 16:48:17', 1, 1),
(14, 'Carmen Rodriguez', '', '', '', 'Diter', 16, '', '2026-05-16 16:48:42', 0, 1),
(15, 'Manuel Vazquez Perez', '', '36464747', 'ma@gmail.com', 'Diter SL', 17, '', '2026-05-16 16:49:14', 0, 1),
(16, 'Amapola', '', '924571602', 'ama@hotmail.com', 'Dia SL', 15, '', '2026-05-16 18:13:23', 0, 1),
(17, 'Arturo Serrano González', '', '', 'arturito@hotmail.es', 'Padel Tour SL', 19, 'Amigo del padel', '2026-05-16 18:40:09', 0, 1),
(18, 'Prueva', '', '', '', '', NULL, '', '2026-05-16 19:12:38', 1, 1),
(19, 'drferv', '', '', '', '', NULL, '', '2026-05-17 11:54:39', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto_categoria`
--

CREATE TABLE `contacto_categoria` (
  `id_contacto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_acceso`
--

CREATE TABLE `registro_acceso` (
  `id_acceso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(45) DEFAULT NULL,
  `navegador` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `registro_acceso`
--

INSERT INTO `registro_acceso` (`id_acceso`, `id_usuario`, `fecha_hora`, `ip`, `navegador`) VALUES
(1, 1, '2026-05-13 21:05:51', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(2, 1, '2026-05-14 16:31:30', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(3, 1, '2026-05-14 16:36:14', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(4, 1, '2026-05-14 16:51:50', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(5, 1, '2026-05-14 16:56:43', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(6, 1, '2026-05-14 17:01:17', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(7, 1, '2026-05-14 17:06:16', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(8, 1, '2026-05-14 17:49:50', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(9, 1, '2026-05-14 18:56:00', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(10, 1, '2026-05-14 18:57:26', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(11, 1, '2026-05-14 18:58:50', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(12, 1, '2026-05-14 19:05:37', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(13, 1, '2026-05-14 20:05:21', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(14, 2, '2026-05-14 20:12:14', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(15, 2, '2026-05-14 21:20:36', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(16, 2, '2026-05-14 23:38:51', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(17, 2, '2026-05-14 23:38:59', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(18, 2, '2026-05-15 00:05:06', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(19, 2, '2026-05-15 00:05:11', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(20, 2, '2026-05-15 00:41:45', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(21, 1, '2026-05-15 00:42:01', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(22, 1, '2026-05-15 00:46:25', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(23, 2, '2026-05-15 00:47:44', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(24, 1, '2026-05-15 17:15:18', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(25, 1, '2026-05-15 19:33:17', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(26, 1, '2026-05-15 19:37:55', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(27, 1, '2026-05-15 20:02:59', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(28, 1, '2026-05-15 20:04:05', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(29, 1, '2026-05-15 20:14:02', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(30, 1, '2026-05-15 20:28:58', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(31, 2, '2026-05-15 21:26:56', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(32, 2, '2026-05-15 22:17:57', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(33, 1, '2026-05-15 23:37:06', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(34, 1, '2026-05-15 23:54:34', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(35, 1, '2026-05-15 23:55:41', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(36, 1, '2026-05-16 00:02:43', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(37, 1, '2026-05-16 00:03:39', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(38, 1, '2026-05-16 00:05:16', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(39, 1, '2026-05-16 00:06:54', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(40, 1, '2026-05-16 00:35:40', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(41, 1, '2026-05-16 12:49:59', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(42, 1, '2026-05-16 12:50:09', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(43, 1, '2026-05-16 12:50:15', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(44, 1, '2026-05-16 16:45:55', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(45, 1, '2026-05-16 17:23:15', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(46, 2, '2026-05-16 17:23:42', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(47, 1, '2026-05-16 17:24:35', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(48, 1, '2026-05-16 17:46:00', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(49, 1, '2026-05-16 18:03:51', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(50, 1, '2026-05-16 18:37:54', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(51, 1, '2026-05-16 18:38:22', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(52, 1, '2026-05-16 18:41:05', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(53, 1, '2026-05-16 19:12:19', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(54, 1, '2026-05-17 02:11:20', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(55, 1, '2026-05-17 02:11:25', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(56, 1, '2026-05-17 11:22:24', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(57, 1, '2026-05-17 11:25:49', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(58, 1, '2026-05-17 11:44:23', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(59, 1, '2026-05-17 11:45:14', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(60, 1, '2026-05-17 11:49:23', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(61, 1, '2026-05-17 11:49:45', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(62, 1, '2026-05-17 11:49:53', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(63, 1, '2026-05-17 11:50:07', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(64, 1, '2026-05-17 11:50:39', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(65, 1, '2026-05-17 11:51:11', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(66, 1, '2026-05-17 11:53:36', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(67, 1, '2026-05-17 11:53:41', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(68, 1, '2026-05-17 11:53:45', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(69, 1, '2026-05-17 11:53:50', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(70, 1, '2026-05-17 11:54:29', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(71, 1, '2026-05-17 14:47:23', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(72, 1, '2026-05-17 16:30:20', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(73, 1, '2026-05-17 19:01:32', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(74, 12, '2026-05-17 19:02:15', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(75, 1, '2026-05-17 19:02:22', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(76, 1, '2026-05-17 19:30:06', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(77, 1, '2026-05-17 19:30:22', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(78, 1, '2026-05-17 19:31:11', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(79, 1, '2026-05-17 19:31:27', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(80, 1, '2026-05-17 20:00:01', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(81, 2, '2026-05-17 20:00:49', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(82, 1, '2026-05-17 20:00:56', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(83, 1, '2026-05-17 20:05:03', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(84, 1, '2026-05-17 23:03:56', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(85, 1, '2026-05-17 23:36:09', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(86, 12, '2026-05-17 23:57:39', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(87, 2, '2026-05-17 23:58:01', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(88, 1, '2026-05-17 23:58:10', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(89, 1, '2026-05-18 01:02:45', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(90, 1, '2026-05-18 17:02:51', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(91, 1, '2026-05-18 19:33:11', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(92, 1, '2026-05-18 23:26:57', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(93, 1, '2026-05-19 01:58:32', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(94, 1, '2026-05-19 16:53:29', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(95, 1, '2026-05-19 17:15:43', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(96, 1, '2026-05-19 18:00:42', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(97, 1, '2026-05-19 18:01:29', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(98, 1, '2026-05-19 18:03:55', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(99, 1, '2026-05-19 18:05:13', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(100, 1, '2026-05-19 18:26:08', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(101, 1, '2026-05-19 18:27:36', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0'),
(102, 1, '2026-05-19 18:28:20', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:140.0) Gecko/20100101 Firefox/140.0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `id_rol` int(11) NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `password_hash`, `fecha_registro`, `activo`, `id_rol`, `foto_perfil`) VALUES
(1, 'Sergio', 'sergio@conweb.com', '$2y$10$PDljKq7kGX7RjRmB9AbrRue0WKH9TJMO/BchOlyTFrTERl/bvr4Ua', '2026-05-11 21:09:32', 1, 1, 'assets/img/usuarios/usuario_1_1779211721.jpg'),
(2, 'Lola', 'lola@conweb.com', '$2y$10$.ICxYsNazM.GQFvvMBqUSeg7JCgjhrIK3oQRqE9O9F2eFYoO2L8mq', '2026-05-12 19:47:08', 1, 2, NULL),
(10, 'sd', 'ss@gmail.com', '$2y$10$VsGQB.zAcURcUZPEk80LWuDQEUvGqJ4aOgYAwg97TTeB.cUcSqfj2', '2026-05-15 00:42:29', 1, 2, NULL),
(11, 'adds', 'sasd@gmail.com', '$2y$10$tUsSbCBmbUCATUC8mRhiCO4yEU4J5iROBuRhVk8nyxG9yLrJTECXK', '2026-05-15 00:44:23', 1, 2, NULL),
(12, 'manu', 'manu@gmail.es', '$2y$10$ULPKGtL6aoNkOxyZBSsbg.f.YQVivRiuu3I8fuRqeAtr5gk3moiGa', '2026-05-17 11:54:21', 1, 2, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`id_actividad`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`,`nombre`),
  ADD UNIQUE KEY `id_usuario_2` (`id_usuario`,`color_hex`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id_contacto`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `contacto_categoria`
--
ALTER TABLE `contacto_categoria`
  ADD PRIMARY KEY (`id_contacto`,`id_categoria`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `registro_acceso`
--
ALTER TABLE `registro_acceso`
  ADD PRIMARY KEY (`id_acceso`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `id_actividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `registro_acceso`
--
ALTER TABLE `registro_acceso`
  MODIFY `id_acceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `categorias_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD CONSTRAINT `contactos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `contacto_categoria`
--
ALTER TABLE `contacto_categoria`
  ADD CONSTRAINT `contacto_categoria_ibfk_1` FOREIGN KEY (`id_contacto`) REFERENCES `contactos` (`id_contacto`) ON DELETE CASCADE,
  ADD CONSTRAINT `contacto_categoria_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE;

--
-- Filtros para la tabla `registro_acceso`
--
ALTER TABLE `registro_acceso`
  ADD CONSTRAINT `registro_acceso_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
