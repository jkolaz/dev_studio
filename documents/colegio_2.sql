-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2015 a las 23:38:07
-- Versión del servidor: 10.0.17-MariaDB
-- Versión de PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `colegio_2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anio`
--

CREATE TABLE `anio` (
  `ANI_id` int(11) NOT NULL,
  `ANI_inicio_clases` date NOT NULL,
  `ANI_fin_clases` date NOT NULL,
  `ANI_inicio_matricula` date NOT NULL,
  `ANI_estado` enum('0','1') NOT NULL DEFAULT '1',
  `ANI_fecha_reg` datetime NOT NULL,
  `ANI_fecha_mod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ANI_desc` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `anio`
--

INSERT INTO `anio` (`ANI_id`, `ANI_inicio_clases`, `ANI_fin_clases`, `ANI_inicio_matricula`, `ANI_estado`, `ANI_fecha_reg`, `ANI_fecha_mod`, `ANI_desc`) VALUES
(1, '2014-03-03', '2014-12-19', '2014-01-06', '0', '2013-11-01 10:00:00', '2015-06-19 19:39:48', '2014'),
(2, '2015-03-02', '2015-12-18', '2015-01-05', '1', '2014-11-07 10:16:20', '2015-06-19 19:39:23', '2015');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignado`
--

CREATE TABLE `asignado` (
  `ASIG_id` int(11) NOT NULL,
  `CURS_id` int(11) NOT NULL,
  `USUA_id` int(11) NOT NULL,
  `ASIG_horasNominales` int(11) NOT NULL,
  `ASIG_horasReales` double NOT NULL,
  `ASIG_flagActivo` char(1) NOT NULL DEFAULT 'A',
  `ASIG_estado` char(2) NOT NULL DEFAULT 'AC',
  `ASIG_fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ASIG_usuarioRegistro` varchar(20) NOT NULL,
  `ASIG_criterio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asignado`
--

INSERT INTO `asignado` (`ASIG_id`, `CURS_id`, `USUA_id`, `ASIG_horasNominales`, `ASIG_horasReales`, `ASIG_flagActivo`, `ASIG_estado`, `ASIG_fechaRegistro`, `ASIG_usuarioRegistro`, `ASIG_criterio`) VALUES
(21, 1, 107, 0, 0, 'A', 'AC', '2015-09-14 15:56:59', '', ''),
(22, 2, 107, 0, 0, 'A', 'AC', '2015-09-14 15:57:24', '', '["2","3","4","5","1"]'),
(23, 3, 107, 0, 0, 'A', 'AC', '2015-09-14 15:57:57', '', ''),
(24, 4, 107, 0, 0, 'A', 'AC', '2015-09-14 15:58:56', '', ''),
(25, 5, 107, 0, 0, 'A', 'AC', '2015-09-14 15:59:34', '', ''),
(26, 6, 107, 0, 0, 'A', 'AC', '2015-09-14 15:59:57', '', ''),
(27, 7, 108, 0, 0, 'A', 'AC', '2015-09-14 16:00:31', '', ''),
(28, 8, 109, 0, 0, 'A', 'AC', '2015-09-14 16:00:58', '', ''),
(29, 9, 110, 0, 0, 'A', 'AC', '2015-09-14 16:02:27', '', ''),
(30, 10, 110, 0, 0, 'A', 'AC', '2015-09-14 16:02:56', '', ''),
(31, 11, 110, 0, 0, 'A', 'AC', '2015-09-14 16:03:28', '', ''),
(32, 12, 110, 0, 0, 'A', 'AC', '2015-09-14 16:03:58', '', ''),
(33, 13, 110, 0, 0, 'A', 'AC', '2015-09-14 16:04:36', '', ''),
(34, 14, 110, 0, 0, 'A', 'AC', '2015-09-14 16:05:05', '', ''),
(35, 15, 108, 0, 0, 'A', 'AC', '2015-09-14 16:05:30', '', ''),
(36, 16, 109, 0, 0, 'A', 'AC', '2015-09-14 16:05:46', '', ''),
(37, 18, 111, 0, 0, 'A', 'AC', '2015-09-14 16:07:25', '', ''),
(38, 24, 109, 0, 0, 'A', 'AC', '2015-09-14 16:07:42', '', ''),
(39, 17, 111, 0, 0, 'A', 'AC', '2015-09-14 16:07:55', '', ''),
(40, 21, 111, 0, 0, 'A', 'AC', '2015-09-14 16:08:19', '', ''),
(41, 22, 111, 0, 0, 'A', 'AC', '2015-09-14 16:08:38', '', ''),
(42, 23, 108, 0, 0, 'A', 'AC', '2015-09-14 16:08:53', '', ''),
(43, 19, 111, 0, 0, 'A', 'AC', '2015-09-14 16:09:14', '', ''),
(44, 20, 111, 0, 0, 'A', 'AC', '2015-09-14 16:09:28', '', ''),
(45, 26, 112, 0, 0, 'A', 'AC', '2015-09-14 16:10:39', '', ''),
(46, 32, 109, 0, 0, 'A', 'AC', '2015-09-14 16:11:08', '', ''),
(47, 25, 112, 0, 0, 'A', 'AC', '2015-09-14 16:12:29', '', ''),
(48, 29, 112, 0, 0, 'A', 'AC', '2015-09-14 16:13:36', '', ''),
(49, 30, 112, 0, 0, 'A', 'AC', '2015-09-14 16:13:54', '', ''),
(50, 31, 108, 0, 0, 'A', 'AC', '2015-09-14 16:14:42', '', ''),
(51, 27, 112, 0, 0, 'A', 'AC', '2015-09-14 16:14:56', '', ''),
(52, 28, 112, 0, 0, 'A', 'AC', '2015-09-14 16:15:37', '', ''),
(53, 34, 114, 0, 0, 'A', 'AC', '2015-09-14 16:16:27', '', ''),
(54, 40, 109, 0, 0, 'A', 'AC', '2015-09-14 16:16:42', '', ''),
(55, 33, 114, 0, 0, 'A', 'AC', '2015-09-14 16:16:55', '', ''),
(56, 37, 114, 0, 0, 'A', 'AC', '2015-09-14 16:17:22', '', ''),
(57, 38, 114, 0, 0, 'A', 'AC', '2015-09-14 16:17:34', '', ''),
(59, 39, 108, 0, 0, 'A', 'AC', '2015-09-14 16:18:38', '', ''),
(60, 35, 114, 0, 0, 'A', 'AC', '2015-09-14 16:19:30', '', ''),
(61, 36, 114, 0, 0, 'A', 'AC', '2015-09-14 16:19:41', '', ''),
(62, 42, 113, 0, 0, 'A', 'AC', '2015-09-14 16:21:04', '', ''),
(63, 48, 109, 0, 0, 'A', 'AC', '2015-09-14 16:21:23', '', ''),
(64, 41, 113, 0, 0, 'A', 'AC', '2015-09-14 16:21:40', '', ''),
(65, 45, 113, 0, 0, 'A', 'AC', '2015-09-14 16:21:57', '', ''),
(66, 46, 113, 0, 0, 'A', 'AC', '2015-09-14 16:22:12', '', ''),
(67, 47, 108, 0, 0, 'A', 'AC', '2015-09-14 16:22:26', '', ''),
(68, 43, 113, 0, 0, 'A', 'AC', '2015-09-14 16:22:41', '', ''),
(69, 44, 113, 0, 0, 'A', 'AC', '2015-09-14 16:22:59', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bimestre`
--

CREATE TABLE `bimestre` (
  `BIME_id` int(10) UNSIGNED NOT NULL,
  `BIME_nombre` varchar(20) NOT NULL,
  `BIME_abreviatura` varchar(5) NOT NULL,
  `BIME_orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bimestre`
--

INSERT INTO `bimestre` (`BIME_id`, `BIME_nombre`, `BIME_abreviatura`, `BIME_orden`) VALUES
(1, 'Primer Bimestre', 'B1', 1),
(2, 'Segundo Bimestre', 'B2', 2),
(3, 'Tercer Bimestre', 'B3', 3),
(4, 'Cuarto Bimestre', 'B4', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `CALI_id` int(11) NOT NULL,
  `USUA_id` int(11) NOT NULL,
  `ASIG_id` int(10) NOT NULL DEFAULT '0',
  `GRAD_id` int(11) NOT NULL,
  `CURS_id` int(11) NOT NULL,
  `BIME_id` int(11) NOT NULL,
  `CALI_parcial1` decimal(10,2) NOT NULL DEFAULT '0.00',
  `CALI_parcial2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `CALI_estado` int(11) NOT NULL DEFAULT '1',
  `CALI_fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `calificacion`
--

INSERT INTO `calificacion` (`CALI_id`, `USUA_id`, `ASIG_id`, `GRAD_id`, `CURS_id`, `BIME_id`, `CALI_parcial1`, `CALI_parcial2`, `CALI_estado`, `CALI_fechaRegistro`) VALUES
(1, 2, 2, 1, 2, 1, '0.00', '0.00', 1, '2015-10-29 04:23:48'),
(2, 2, 2, 1, 2, 2, '6.60', '0.00', 1, '2015-10-29 04:24:09'),
(3, 4, 0, 1, 2, 1, '0.00', '0.00', 1, '2015-10-29 04:27:02'),
(4, 4, 0, 1, 2, 2, '0.00', '0.00', 1, '2015-10-29 04:27:02'),
(5, 4, 0, 1, 2, 3, '0.00', '0.00', 1, '2015-10-29 04:27:02'),
(6, 4, 0, 1, 2, 4, '0.00', '0.00', 1, '2015-10-29 04:27:02'),
(7, 4, 0, 1, 8, 1, '0.00', '0.00', 1, '2015-10-29 04:27:03'),
(8, 4, 0, 1, 8, 2, '0.00', '0.00', 1, '2015-10-29 04:27:03'),
(9, 4, 0, 1, 8, 3, '0.00', '0.00', 1, '2015-10-29 04:27:03'),
(10, 4, 0, 1, 8, 4, '0.00', '0.00', 1, '2015-10-29 04:27:03'),
(11, 4, 0, 1, 1, 1, '0.00', '0.00', 1, '2015-10-29 04:27:03'),
(12, 4, 0, 1, 1, 2, '0.00', '0.00', 1, '2015-10-29 04:27:03'),
(13, 4, 0, 1, 1, 3, '0.00', '0.00', 1, '2015-10-29 04:27:03'),
(14, 4, 0, 1, 1, 4, '0.00', '0.00', 1, '2015-10-29 04:27:03'),
(15, 4, 0, 1, 5, 1, '0.00', '0.00', 1, '2015-10-29 04:27:03'),
(16, 4, 0, 1, 5, 2, '0.00', '0.00', 1, '2015-10-29 04:27:03'),
(17, 4, 0, 1, 5, 3, '0.00', '0.00', 1, '2015-10-29 04:27:03'),
(18, 4, 0, 1, 5, 4, '0.00', '0.00', 1, '2015-10-29 04:27:03'),
(19, 4, 0, 1, 6, 1, '0.00', '0.00', 1, '2015-10-29 04:27:03'),
(20, 4, 0, 1, 6, 2, '0.00', '0.00', 1, '2015-10-29 04:27:03'),
(21, 4, 0, 1, 6, 3, '0.00', '0.00', 1, '2015-10-29 04:27:03'),
(22, 4, 0, 1, 6, 4, '0.00', '0.00', 1, '2015-10-29 04:27:03'),
(23, 4, 0, 1, 7, 1, '0.00', '0.00', 1, '2015-10-29 04:27:04'),
(24, 4, 0, 1, 7, 2, '0.00', '0.00', 1, '2015-10-29 04:27:04'),
(25, 4, 0, 1, 7, 3, '0.00', '0.00', 1, '2015-10-29 04:27:04'),
(26, 4, 0, 1, 7, 4, '0.00', '0.00', 1, '2015-10-29 04:27:04'),
(27, 4, 0, 1, 3, 1, '0.00', '0.00', 1, '2015-10-29 04:27:04'),
(28, 4, 0, 1, 3, 2, '0.00', '0.00', 1, '2015-10-29 04:27:04'),
(29, 4, 0, 1, 3, 3, '0.00', '0.00', 1, '2015-10-29 04:27:04'),
(30, 4, 0, 1, 3, 4, '0.00', '0.00', 1, '2015-10-29 04:27:04'),
(31, 4, 0, 1, 4, 1, '0.00', '0.00', 1, '2015-10-29 04:27:04'),
(32, 4, 0, 1, 4, 2, '0.00', '0.00', 1, '2015-10-29 04:27:04'),
(33, 4, 0, 1, 4, 3, '0.00', '0.00', 1, '2015-10-29 04:27:04'),
(34, 4, 0, 1, 4, 4, '0.00', '0.00', 1, '2015-10-29 04:27:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion_detalle`
--

CREATE TABLE `calificacion_detalle` (
  `CALD_id` int(11) NOT NULL,
  `CALI_id` int(11) NOT NULL,
  `USUA_id` int(11) NOT NULL,
  `GRAD_id` int(11) NOT NULL,
  `CURS_id` int(11) NOT NULL,
  `BIME_id` int(11) NOT NULL,
  `CRIT_id` int(11) NOT NULL,
  `CALD_parcial` int(11) NOT NULL DEFAULT '0',
  `CALD_nota` decimal(10,2) NOT NULL DEFAULT '0.00',
  `CALD_estado` int(11) NOT NULL DEFAULT '1',
  `CALD_fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `calificacion_detalle`
--

INSERT INTO `calificacion_detalle` (`CALD_id`, `CALI_id`, `USUA_id`, `GRAD_id`, `CURS_id`, `BIME_id`, `CRIT_id`, `CALD_parcial`, `CALD_nota`, `CALD_estado`, `CALD_fechaRegistro`) VALUES
(1, 1, 2, 1, 2, 1, 1, 0, '0.00', 1, '2015-10-29 04:23:48'),
(2, 1, 2, 1, 2, 1, 2, 0, '0.00', 1, '2015-10-29 04:23:48'),
(3, 1, 2, 1, 2, 1, 3, 0, '0.00', 1, '2015-10-29 04:23:48'),
(4, 1, 2, 1, 2, 1, 4, 0, '0.00', 1, '2015-10-29 04:23:48'),
(5, 1, 2, 1, 2, 1, 5, 0, '0.00', 1, '2015-10-29 04:23:48'),
(6, 2, 2, 1, 2, 2, 1, 0, '16.00', 1, '2015-10-29 04:24:09'),
(7, 2, 2, 1, 2, 2, 2, 0, '17.00', 1, '2015-10-29 04:24:09'),
(8, 2, 2, 1, 2, 2, 3, 0, '0.00', 1, '2015-10-29 04:24:10'),
(9, 2, 2, 1, 2, 2, 4, 0, '0.00', 1, '2015-10-29 04:24:10'),
(10, 2, 2, 1, 2, 2, 5, 0, '0.00', 1, '2015-10-29 04:24:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `COME_id` int(10) UNSIGNED NOT NULL,
  `COME_titulo` varchar(50) DEFAULT NULL,
  `COME_texto` varchar(500) NOT NULL,
  `COME_fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `USUA_idRegistro` int(10) UNSIGNED NOT NULL,
  `USUA_idDestino` int(10) UNSIGNED NOT NULL,
  `CURS_id` int(11) NOT NULL,
  `COME_fechaModificacion` datetime DEFAULT NULL,
  `COME_usuarioModificacion` varchar(20) DEFAULT NULL,
  `COME_fechaEliminacion` datetime DEFAULT NULL,
  `COME_usuarioEliminacion` varchar(20) DEFAULT NULL,
  `COME_estado` char(2) NOT NULL DEFAULT 'AC',
  `COME_flagActivo` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario_edicion`
--

CREATE TABLE `comentario_edicion` (
  `COME_id` int(10) UNSIGNED NOT NULL,
  `CEDI_edicion` int(10) UNSIGNED NOT NULL,
  `CEDI_fechaEdicion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CEDI_usuarioEdicion` varchar(20) NOT NULL,
  `CEDI_estado` char(2) NOT NULL DEFAULT 'AC',
  `CEDI_flagActivo` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `criterio`
--

CREATE TABLE `criterio` (
  `CRIT_id` int(10) UNSIGNED NOT NULL,
  `CRIT_nombre` varchar(50) NOT NULL,
  `CRIT_abreviatura` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `criterio`
--

INSERT INTO `criterio` (`CRIT_id`, `CRIT_nombre`, `CRIT_abreviatura`) VALUES
(1, 'Nota actitudinal', 'NA'),
(2, 'ParticipaciÃ³n en clase', 'PART'),
(3, 'Puntualidad', 'PUNT'),
(4, 'Practica', 'PRAC'),
(5, 'Examen Final', 'EF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuota`
--

CREATE TABLE `cuota` (
  `CUOT_id` int(10) UNSIGNED NOT NULL,
  `CUOT_numero` int(11) NOT NULL,
  `CUOT_anhoMesReferencia` char(6) NOT NULL,
  `CUOT_monto` double DEFAULT NULL,
  `CUOT_fechaVencimiento` date NOT NULL,
  `CUOT_moraDiaria` double NOT NULL,
  `CUOT_observaciones` varchar(500) DEFAULT NULL,
  `CUOT_fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CUOT_usuarioRegistro` varchar(20) NOT NULL,
  `CUOT_fechaModificacion` datetime DEFAULT NULL,
  `CUOT_usuarioModificacion` varchar(20) DEFAULT NULL,
  `CUOT_fechaEliminacion` datetime DEFAULT NULL,
  `CUOT_usuarioEliminacion` varchar(20) DEFAULT NULL,
  `CUOT_estado` char(2) NOT NULL DEFAULT 'AC',
  `CUOT_flagActivo` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `CURS_id` int(10) UNSIGNED NOT NULL,
  `CURS_nombre` varchar(100) NOT NULL,
  `CURS_abreviatura` varchar(30) NOT NULL,
  `CURS_horas` int(11) NOT NULL,
  `CURS_horasReales` double NOT NULL,
  `CURS_fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CURS_usuarioRegistro` varchar(20) NOT NULL,
  `CURS_fechaModificacion` datetime DEFAULT NULL,
  `CURS_usuarioModificacion` varchar(20) DEFAULT NULL,
  `CURS_estado` char(2) NOT NULL DEFAULT 'AC',
  `CURS_flagActivo` char(1) NOT NULL DEFAULT 'A',
  `GRAD_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`CURS_id`, `CURS_nombre`, `CURS_abreviatura`, `CURS_horas`, `CURS_horasReales`, `CURS_fechaRegistro`, `CURS_usuarioRegistro`, `CURS_fechaModificacion`, `CURS_usuarioModificacion`, `CURS_estado`, `CURS_flagActivo`, `GRAD_id`) VALUES
(1, 'ComunicaciÃ³n 1', 'C I', 5, 0, '2015-09-14 14:55:11', '', NULL, NULL, 'AC', 'A', 1),
(2, 'Ciencia y Ambiente 1', 'CA I', 5, 0, '2015-09-14 14:55:45', '', NULL, NULL, 'AC', 'A', 1),
(3, 'MatemÃ¡tica 1', 'Mat I', 5, 0, '2015-09-14 14:56:10', '', NULL, NULL, 'AC', 'A', 1),
(4, 'Personal Social 1', 'PS I', 4, 0, '2015-09-14 14:56:41', '', NULL, NULL, 'AC', 'A', 1),
(5, 'EducaciÃ³n FÃ­sica 1', 'EF I', 2, 0, '2015-09-14 14:57:07', '', NULL, NULL, 'AC', 'A', 1),
(6, 'EducaciÃ³n Religiosa 1', 'ER I', 2, 0, '2015-09-14 14:57:32', '', NULL, NULL, 'AC', 'A', 1),
(7, 'Ingles 1', 'Ingles 1', 2, 0, '2015-09-14 14:57:54', '', NULL, NULL, 'AC', 'A', 1),
(8, 'ComputaciÃ³n 1', 'Com I', 2, 0, '2015-09-14 14:58:21', '', NULL, NULL, 'AC', 'A', 1),
(9, 'ComunicaciÃ³n 2', 'C II', 5, 0, '2015-09-14 14:58:49', '', NULL, NULL, 'AC', 'A', 2),
(10, 'Ciencia y Ambiente 2', 'CA II', 5, 0, '2015-09-14 14:59:37', '', NULL, NULL, 'AC', 'A', 2),
(11, 'MatemÃ¡tica 2', 'Mat II', 5, 0, '2015-09-14 15:00:16', '', NULL, NULL, 'AC', 'A', 2),
(12, 'Personal Social 2', 'PS II', 4, 0, '2015-09-14 15:00:52', '', NULL, NULL, 'AC', 'A', 2),
(13, 'EducaciÃ³n FÃ­sica 2', 'EF II', 2, 0, '2015-09-14 15:01:17', '', NULL, NULL, 'AC', 'A', 2),
(14, 'EducaciÃ³n Religiosa 2', 'ER II', 2, 0, '2015-09-14 15:09:32', '', NULL, NULL, 'AC', 'A', 2),
(15, 'Ingles 2', 'Ingles 2', 2, 0, '2015-09-14 15:09:51', '', NULL, NULL, 'AC', 'A', 2),
(16, 'ComputaciÃ³n 2', 'Com II', 2, 0, '2015-09-14 15:10:17', '', NULL, NULL, 'AC', 'A', 2),
(17, 'ComunicaciÃ³n 3', 'C III', 5, 0, '2015-09-14 15:10:44', '', NULL, NULL, 'AC', 'A', 3),
(18, 'Ciencia y ambiente 3', 'CA III', 4, 0, '2015-09-14 15:11:10', '', NULL, NULL, 'AC', 'A', 3),
(19, 'MatemÃ¡tica 3', 'Mat III', 5, 0, '2015-09-14 15:11:31', '', NULL, NULL, 'AC', 'A', 3),
(20, 'Personal Social 3', 'PS III', 4, 0, '2015-09-14 15:11:58', '', NULL, NULL, 'AC', 'A', 3),
(21, 'EducaciÃ³n FÃ­sica 3', 'EF III', 2, 0, '2015-09-14 15:12:19', '', NULL, NULL, 'AC', 'A', 3),
(22, 'EducaciÃ³n Religiosa 3', 'ER III', 2, 0, '2015-09-14 15:12:43', '', NULL, NULL, 'AC', 'A', 3),
(23, 'Ingles 3', 'Ingles 3', 2, 0, '2015-09-14 15:12:59', '', NULL, NULL, 'AC', 'A', 3),
(24, 'ComputaciÃ³n 3', 'Com III', 2, 0, '2015-09-14 15:14:04', '', NULL, NULL, 'AC', 'A', 3),
(25, 'ComunicaciÃ³n 4', 'C IV', 5, 0, '2015-09-14 15:14:29', '', NULL, NULL, 'AC', 'A', 4),
(26, 'Ciencia y ambiente 4', 'CA IV', 4, 0, '2015-09-14 15:14:53', '', NULL, NULL, 'AC', 'A', 4),
(27, 'MatemÃ¡tica 4', 'Mat IV', 5, 0, '2015-09-14 15:15:15', '', NULL, NULL, 'AC', 'A', 4),
(28, 'Personal Social 4', 'PS IV', 4, 0, '2015-09-14 15:15:50', '', NULL, NULL, 'AC', 'A', 4),
(29, 'EducaciÃ³n FÃ­sica 4', 'EF IV', 2, 0, '2015-09-14 15:16:16', '', NULL, NULL, 'AC', 'A', 4),
(30, 'EducaciÃ³n Religiosa 4', 'ER IV', 2, 0, '2015-09-14 15:16:50', '', NULL, NULL, 'AC', 'A', 4),
(31, 'Ingles 4', 'Ingles 4', 2, 0, '2015-09-14 15:17:05', '', NULL, NULL, 'AC', 'A', 4),
(32, 'ComputaciÃ³n 4', 'Com IV', 2, 0, '2015-09-14 15:17:31', '', NULL, NULL, 'AC', 'A', 4),
(33, 'ComunicaciÃ³n 5', 'C V', 4, 0, '2015-09-14 15:17:53', '', NULL, NULL, 'AC', 'A', 5),
(34, 'Ciencia y  Ambiente 5', 'CA V', 4, 0, '2015-09-14 15:18:18', '', NULL, NULL, 'AC', 'A', 5),
(35, 'MatemÃ¡tica 5', 'Mat V', 5, 0, '2015-09-14 15:18:44', '', NULL, NULL, 'AC', 'A', 5),
(36, 'Personal Social 5', 'PS V', 4, 0, '2015-09-14 15:19:07', '', NULL, NULL, 'AC', 'A', 5),
(37, 'EducaciÃ³n FÃ­sica 5', 'EF V', 2, 0, '2015-09-14 15:19:41', '', NULL, NULL, 'AC', 'A', 5),
(38, 'EducaciÃ³n Religiosa 5', 'ER V', 2, 0, '2015-09-14 15:20:06', '', NULL, NULL, 'AC', 'A', 5),
(39, 'Ingles 5', 'Ingles 5', 2, 0, '2015-09-14 15:20:24', '', NULL, NULL, 'AC', 'A', 5),
(40, 'ComputaciÃ³n 5', 'Com V', 2, 0, '2015-09-14 15:20:44', '', NULL, NULL, 'AC', 'A', 5),
(41, 'ComunicaciÃ³n 6', 'C VI', 5, 0, '2015-09-14 15:21:08', '', NULL, NULL, 'AC', 'A', 6),
(42, 'Ciencia y ambiente 6', 'CA VI', 4, 0, '2015-09-14 15:21:31', '', NULL, NULL, 'AC', 'A', 6),
(43, 'MatemÃ¡tica 6', 'Mat VI', 5, 0, '2015-09-14 15:21:50', '', NULL, NULL, 'AC', 'A', 6),
(44, 'Personal Social 6', 'PS VI', 4, 0, '2015-09-14 15:22:15', '', NULL, NULL, 'AC', 'A', 6),
(45, 'EducaciÃ³n FÃ­sica 6', 'EF VI', 2, 0, '2015-09-14 15:23:08', '', NULL, NULL, 'AC', 'A', 6),
(46, 'EducaciÃ³n Religiosa 6', 'ER VI', 2, 0, '2015-09-14 15:23:28', '', NULL, NULL, 'AC', 'A', 6),
(47, 'Ingles 6', 'Ingles 6', 2, 0, '2015-09-14 15:24:06', '', NULL, NULL, 'AC', 'A', 6),
(48, 'ComputaciÃ³n 6', 'Com VI', 2, 0, '2015-09-14 15:24:30', '', NULL, NULL, 'AC', 'A', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso_x_grado_x_usuario`
--

CREATE TABLE `curso_x_grado_x_usuario` (
  `CGU_id` int(10) UNSIGNED NOT NULL,
  `USUA_id` int(10) UNSIGNED NOT NULL,
  `GRAD_id` int(10) UNSIGNED NOT NULL,
  `CURS_id` int(10) UNSIGNED NOT NULL,
  `CGU_cant` int(11) NOT NULL DEFAULT '1',
  `ASIG_id` int(10) NOT NULL DEFAULT '0',
  `CGU_stado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `curso_x_grado_x_usuario`
--

INSERT INTO `curso_x_grado_x_usuario` (`CGU_id`, `USUA_id`, `GRAD_id`, `CURS_id`, `CGU_cant`, `ASIG_id`, `CGU_stado`) VALUES
(1, 2, 1, 2, 1, 22, 1),
(2, 2, 1, 8, 1, 28, 1),
(3, 2, 1, 1, 1, 21, 1),
(4, 2, 1, 5, 1, 25, 1),
(5, 2, 1, 6, 1, 26, 1),
(6, 2, 1, 7, 1, 27, 1),
(7, 2, 1, 3, 1, 23, 1),
(8, 2, 1, 4, 1, 24, 1),
(9, 4, 1, 2, 1, 22, 1),
(10, 4, 1, 8, 1, 28, 1),
(11, 4, 1, 1, 1, 21, 1),
(12, 4, 1, 5, 1, 25, 1),
(13, 4, 1, 6, 1, 26, 1),
(14, 4, 1, 7, 1, 27, 1),
(15, 4, 1, 3, 1, 23, 1),
(16, 4, 1, 4, 1, 24, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `DOCU_id` int(10) UNSIGNED NOT NULL,
  `DOCU_nombre` varchar(200) NOT NULL,
  `DOCU_tipo` char(1) NOT NULL,
  `DOCU_flagActivo` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`DOCU_id`, `DOCU_nombre`, `DOCU_tipo`, `DOCU_flagActivo`) VALUES
(1, 'Partida de nacimiento', 'A', 'A'),
(2, 'DNI alumno', 'A', 'A'),
(3, 'DNI madre', 'A', 'A'),
(4, 'DNI padre', 'A', 'A'),
(5, 'Certificado de estudios', 'A', 'A'),
(11, 'Título docente', 'P', 'A'),
(12, 'Constancias de trabajo', 'P', 'A'),
(13, 'Examen concurso público', 'P', 'A'),
(14, 'Sílabo del curso', 'P', 'A'),
(15, 'Plan curricular', 'P', 'A'),
(16, 'Unidades de aprendizaje', 'P', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_x_entregar`
--

CREATE TABLE `documento_x_entregar` (
  `DXEN_id` int(11) NOT NULL,
  `USUA_id` int(10) NOT NULL,
  `CURS_id` int(10) NOT NULL,
  `DOCU_id` int(10) NOT NULL,
  `DXEN_fechaEntrega` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_x_grado_x_usuario`
--

CREATE TABLE `documento_x_grado_x_usuario` (
  `USUA_id` int(10) UNSIGNED NOT NULL,
  `GRAD_id` int(10) UNSIGNED NOT NULL,
  `DOCU_id` int(10) UNSIGNED NOT NULL,
  `DXGU_fechaEntrega` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `GRAD_id` int(10) UNSIGNED NOT NULL,
  `GRAD_nombre` varchar(50) NOT NULL,
  `GRAD_abreviatura` varchar(20) NOT NULL,
  `GRAD_numero` int(11) DEFAULT NULL,
  `GRAD_alumnos` int(11) NOT NULL DEFAULT '0',
  `GRAD_profesores` int(11) NOT NULL DEFAULT '0',
  `GRAD_tutores` int(11) NOT NULL DEFAULT '0',
  `GRAD_auxiliares` int(11) NOT NULL DEFAULT '0',
  `GRAD_deudas` double NOT NULL DEFAULT '0',
  `GRAD_fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `GRAD_usuarioRegistro` varchar(20) NOT NULL,
  `GRAD_fechaModificacion` datetime DEFAULT NULL,
  `GRAD_usuarioModificacion` varchar(20) DEFAULT NULL,
  `GRAD_fechaEliminacion` datetime DEFAULT NULL,
  `GRAD_usuarioEliminacion` varchar(20) DEFAULT NULL,
  `GRAD_estado` char(2) NOT NULL DEFAULT 'AC',
  `GRAD_flagActivo` char(1) NOT NULL DEFAULT 'A',
  `NIVE_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`GRAD_id`, `GRAD_nombre`, `GRAD_abreviatura`, `GRAD_numero`, `GRAD_alumnos`, `GRAD_profesores`, `GRAD_tutores`, `GRAD_auxiliares`, `GRAD_deudas`, `GRAD_fechaRegistro`, `GRAD_usuarioRegistro`, `GRAD_fechaModificacion`, `GRAD_usuarioModificacion`, `GRAD_fechaEliminacion`, `GRAD_usuarioEliminacion`, `GRAD_estado`, `GRAD_flagActivo`, `NIVE_id`) VALUES
(1, 'Primero', '1ro', 1, 0, 0, 0, 0, 0, '2014-06-07 18:59:46', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 2),
(2, 'Segundo', '2do', 2, 0, 0, 0, 0, 0, '2014-06-07 18:59:46', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 2),
(3, 'Tercero', '3ro', 3, 0, 0, 0, 0, 0, '2014-06-07 18:59:46', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 2),
(4, 'Cuarto', '4to', 4, 0, 0, 0, 0, 0, '2014-06-07 18:59:46', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 2),
(5, 'Quinto', '5to', 5, 0, 0, 0, 0, 0, '2014-06-07 18:59:46', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 2),
(6, 'Sexto', '6to', 6, 0, 0, 0, 0, 0, '2014-06-07 18:59:46', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 2),
(7, 'Primero', '1ro', 1, 0, 0, 0, 0, 0, '2014-06-07 18:59:46', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(8, 'Segundo', '2do', 2, 0, 0, 0, 0, 0, '2014-06-07 18:59:46', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(9, 'Tercero', '3ro', 3, 0, 0, 0, 0, 0, '2014-06-07 18:59:46', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(10, 'Cuarto', '4to', 4, 0, 0, 0, 0, 0, '2014-06-07 18:59:46', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(11, 'Quinto', '5to', 5, 0, 0, 0, 0, 0, '2014-06-07 18:59:46', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado_x_usuario`
--

CREATE TABLE `grado_x_usuario` (
  `USUA_id` int(10) UNSIGNED NOT NULL,
  `GRAD_id` int(10) UNSIGNED NOT NULL,
  `GXUS_estado` char(2) NOT NULL DEFAULT 'AC',
  `GXUS_anhoReferencia` int(11) NOT NULL,
  `GXUS_aula` varchar(20) DEFAULT NULL,
  `ANIO_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grado_x_usuario`
--

INSERT INTO `grado_x_usuario` (`USUA_id`, `GRAD_id`, `GXUS_estado`, `GXUS_anhoReferencia`, `GXUS_aula`, `ANIO_id`) VALUES
(2, 1, 'AC', 2015, 'UNICO', 2),
(4, 1, 'AC', 2015, 'UNICO', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `MENU_id` int(10) UNSIGNED NOT NULL,
  `MENU_nombre` varchar(50) NOT NULL,
  `MENU_ruta` varchar(500) DEFAULT NULL,
  `MENU_idPadre` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `MENU_fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MENU_flagActivo` char(1) NOT NULL DEFAULT 'A',
  `MENU_orden` int(11) DEFAULT NULL,
  `MENU_estado` varchar(1) CHARACTER SET utf8 NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`MENU_id`, `MENU_nombre`, `MENU_ruta`, `MENU_idPadre`, `MENU_fechaRegistro`, `MENU_flagActivo`, `MENU_orden`, `MENU_estado`) VALUES
(1, 'Configuracion', NULL, 0, '2014-06-07 18:40:45', 'A', NULL, '1'),
(2, 'Matricula', NULL, 0, '2014-06-07 18:40:45', 'A', NULL, '1'),
(3, 'Alumnos', NULL, 0, '2014-06-07 18:40:45', 'A', NULL, '1'),
(4, 'Profesores', NULL, 0, '2014-06-07 18:40:45', 'A', NULL, '1'),
(5, 'Ayuda', NULL, 0, '2014-06-07 18:40:45', 'A', NULL, '1'),
(10, 'Niveles', 'educacion/nivel/listar', 1, '2014-06-07 18:40:45', 'A', NULL, '1'),
(11, 'Grados', 'educacion/grado/listar', 1, '2014-06-07 18:40:45', 'A', NULL, '1'),
(12, 'Cursos', 'educacion/curso/listar', 1, '2014-06-08 02:36:38', 'A', NULL, '1'),
(20, 'Alumnos', 'seguridad/usuario/listar_alumnos', 3, '2014-06-07 18:40:45', 'A', NULL, '1'),
(21, 'Profesores', 'seguridad/usuario/listar_profesores', 4, '2014-06-07 18:40:45', 'A', NULL, '1'),
(22, 'Padres de familia', 'seguridad/usuario/listar_padres_familia', 2, '2014-06-08 02:49:22', 'A', NULL, '1'),
(23, 'Personal administrativo', 'seguridad/usuario/listar_administrativos', 2, '2014-06-12 02:39:23', 'A', NULL, '1'),
(30, 'Notas', 'reportes/alumnos/notas', 3, '2014-06-07 18:40:45', 'D', NULL, '1'),
(31, 'Criterios de Evaluación', 'configuracion/criterio', 1, '2014-06-07 18:40:45', 'D', NULL, '1'),
(40, 'Roles', 'seguridad/rol/listar', 1, '2014-06-07 18:40:45', 'A', NULL, '1'),
(41, 'Usuarios', 'seguridad/usuario/listar', 1, '2014-06-07 18:40:45', 'A', NULL, '1'),
(42, 'usuarios', 'usuario/user/listar', 0, '2014-10-29 22:04:31', 'D', NULL, '1'),
(43, 'Nuevo Personal Administrativo', 'usuario/user/add/5', 1, '2014-10-29 22:06:41', 'A', NULL, '1'),
(44, 'Listar Usuarios', 'usuario/user/listar', 1, '2014-10-29 22:06:41', 'A', NULL, '1'),
(45, 'Listar Profesores', 'seguridad/usuario/listar_profesores/2', 1, '2015-06-15 20:34:27', 'A', NULL, '1'),
(46, 'Estudiantes Registrados', 'seguridad/usuario/estudiante/R', 3, '2015-06-15 20:35:44', 'A', NULL, '1'),
(47, 'Estudiantes Matriculados', 'seguridad/usuario/estudiante/M', 3, '2015-06-15 20:36:39', 'A', NULL, '1'),
(48, 'Configuración', NULL, 0, '2015-06-19 20:29:37', 'D', NULL, '1'),
(49, 'Año Escolar', 'configuracion/configuracion/getAnioEscolar', 1, '2015-06-19 20:29:37', 'A', NULL, '1'),
(50, 'Rol', 'seguridad/rol', 1, '2015-09-14 14:44:58', 'D', NULL, '1'),
(51, 'Tipo de matricula', 'configuracion/tipo_matricula', 1, '2015-11-20 03:11:02', 'A', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel`
--

CREATE TABLE `nivel` (
  `NIVE_id` int(10) UNSIGNED NOT NULL,
  `NIVE_nombre` varchar(50) NOT NULL,
  `NIVE_abreviatura` varchar(20) NOT NULL,
  `NIVE_alumnos` int(11) DEFAULT '0',
  `NIVE_profesores` int(11) DEFAULT '0',
  `NIVE_tutores` int(11) DEFAULT '0',
  `NIVE_auxiliares` int(11) DEFAULT '0',
  `NIVE_deudas` double DEFAULT '0',
  `NIVE_observaciones` varchar(500) DEFAULT NULL,
  `NIVE_fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `NIVE_usuarioRegistro` varchar(20) NOT NULL,
  `NIVE_fechaModificacion` datetime DEFAULT NULL,
  `NIVE_usuarioModificacion` varchar(20) DEFAULT NULL,
  `NIVE_fechaEliminacion` datetime DEFAULT NULL,
  `NIVE_usuarioEliminacion` varchar(20) DEFAULT NULL,
  `NIVE_estado` char(2) NOT NULL DEFAULT 'AC',
  `NIVE_flagActivo` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nivel`
--

INSERT INTO `nivel` (`NIVE_id`, `NIVE_nombre`, `NIVE_abreviatura`, `NIVE_alumnos`, `NIVE_profesores`, `NIVE_tutores`, `NIVE_auxiliares`, `NIVE_deudas`, `NIVE_observaciones`, `NIVE_fechaRegistro`, `NIVE_usuarioRegistro`, `NIVE_fechaModificacion`, `NIVE_usuarioModificacion`, `NIVE_fechaEliminacion`, `NIVE_usuarioEliminacion`, `NIVE_estado`, `NIVE_flagActivo`) VALUES
(1, 'Inicial', 'Inicial', 72, 6, 3, 2, 1150, NULL, '2014-06-07 18:46:07', 'cgomezm', NULL, NULL, NULL, NULL, 'EE', 'E'),
(2, 'Primaria', 'Primaria', 185, 15, 5, 4, 6320, NULL, '2014-06-07 18:46:07', 'cgomezm', NULL, NULL, NULL, NULL, 'AC', 'A'),
(3, 'Secundaria', 'Secundaria', 143, 21, 5, 0, 4500, NULL, '2014-06-07 18:46:07', 'cgomezm', NULL, NULL, NULL, NULL, 'EE', 'E'),
(4, 'CETPRO', 'CETPRO', 101, 12, 0, 3, 220, NULL, '2014-06-09 02:47:17', 'cgomezm', NULL, NULL, NULL, NULL, 'EE', 'E'),
(5, 'CEBA', 'CEBA', 93, 10, 0, 2, 990, NULL, '2014-06-09 02:47:17', 'cgomezm', NULL, NULL, NULL, NULL, 'EE', 'E'),
(6, 'CEPRE', 'CEPRE', 254, 23, 8, 0, 3880, NULL, '2014-06-09 02:47:17', 'cgomezm', NULL, NULL, NULL, NULL, 'EE', 'E');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `USUA_id` int(10) UNSIGNED NOT NULL,
  `CUOT_id` int(10) UNSIGNED NOT NULL,
  `PAGO_montoProgramado` double DEFAULT NULL,
  `PAGO_montoReal` double DEFAULT NULL,
  `PAGO_fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PAGO_usuarioRegistro` varchar(20) NOT NULL,
  `PAGO_fechaPago` datetime DEFAULT NULL,
  `PAGO_estado` char(2) NOT NULL DEFAULT 'PE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `panel`
--

CREATE TABLE `panel` (
  `PAN_id` int(11) NOT NULL,
  `PAN_nombre` varchar(20) NOT NULL,
  `PAN_url` text NOT NULL,
  `PAN_image` text,
  `PAN_permanente` enum('0','1') NOT NULL DEFAULT '0',
  `PAN_estado` enum('0','1') NOT NULL DEFAULT '1',
  `PAN_fecha_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PAN_fecha_mod` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `panel`
--

INSERT INTO `panel` (`PAN_id`, `PAN_nombre`, `PAN_url`, `PAN_image`, `PAN_permanente`, `PAN_estado`, `PAN_fecha_reg`, `PAN_fecha_mod`) VALUES
(1, 'Matricula', '', NULL, '0', '1', '2015-07-12 02:18:32', '0000-00-00 00:00:00'),
(2, 'configuracion', '', '', '0', '1', '2015-07-14 04:42:14', '2015-07-14 06:42:14'),
(3, 'educacion', '', '', '0', '1', '2015-07-14 04:42:14', '2015-07-14 06:42:14'),
(4, 'persona', '', '', '1', '1', '2015-07-14 04:42:14', '2015-07-14 06:42:14'),
(5, 'seguridad', '', '', '1', '1', '2015-07-14 04:42:14', '2015-07-14 06:42:14'),
(6, 'usuario', '', '', '0', '1', '2015-07-14 04:42:14', '2015-07-14 06:42:14'),
(7, 'notas', '', '', '0', '1', '2015-07-31 20:17:41', '2015-07-31 15:17:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pariente`
--

CREATE TABLE `pariente` (
  `USUA_idHijo` int(10) UNSIGNED NOT NULL,
  `USUA_idPadre` int(10) UNSIGNED NOT NULL,
  `PARI_tipo` varchar(3) NOT NULL DEFAULT 'PAD',
  `PARI_flagActivo` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pariente`
--

INSERT INTO `pariente` (`USUA_idHijo`, `USUA_idPadre`, `PARI_tipo`, `PARI_flagActivo`) VALUES
(2, 15, 'MAD', 'A'),
(3, 16, 'MAD', 'A'),
(4, 17, 'PAD', 'A'),
(5, 18, 'PAD', 'A'),
(6, 19, 'PAD', 'A'),
(7, 20, 'PAD', 'A'),
(8, 21, 'PAD', 'A'),
(9, 22, 'PAD', 'A'),
(10, 23, 'PAD', 'A'),
(11, 24, 'PAD', 'A'),
(12, 25, 'PAD', 'A'),
(13, 26, 'PAD', 'A'),
(14, 27, 'PAD', 'A'),
(28, 38, 'PAD', 'A'),
(29, 39, 'PAD', 'A'),
(30, 40, 'PAD', 'A'),
(31, 41, 'PAD', 'A'),
(32, 42, 'PAD', 'A'),
(33, 43, 'PAD', 'A'),
(34, 44, 'PAD', 'A'),
(35, 45, 'PAD', 'A'),
(36, 46, 'PAD', 'A'),
(37, 47, 'PAD', 'A'),
(48, 60, 'PAD', 'A'),
(49, 61, 'PAD', 'A'),
(50, 62, 'PAD', 'A'),
(51, 63, 'PAD', 'A'),
(52, 64, 'PAD', 'A'),
(53, 65, 'PAD', 'A'),
(54, 66, 'PAD', 'A'),
(55, 67, 'PAD', 'A'),
(56, 68, 'PAD', 'A'),
(57, 69, 'PAD', 'A'),
(58, 70, 'PAD', 'A'),
(59, 71, 'PAD', 'A'),
(95, 96, 'PAD', 'A'),
(95, 97, 'MAD', 'A'),
(98, 99, 'PAD', 'A'),
(98, 100, 'MAD', 'A'),
(101, 102, 'PAD', 'A'),
(101, 103, 'MAD', 'A'),
(104, 105, 'PAD', 'A'),
(104, 106, 'MAD', 'A'),
(115, 116, 'PAD', 'A'),
(115, 117, 'MAD', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `ROL_id` int(10) UNSIGNED NOT NULL,
  `MENU_id` int(10) UNSIGNED NOT NULL,
  `PERM_flagActivo` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`ROL_id`, `MENU_id`, `PERM_flagActivo`) VALUES
(2, 1, 'A'),
(2, 2, 'A'),
(2, 3, 'A'),
(2, 12, 'A'),
(2, 20, 'A'),
(2, 22, 'A'),
(2, 30, 'A'),
(5, 1, 'A'),
(5, 2, 'A'),
(5, 3, 'A'),
(5, 10, 'A'),
(5, 11, 'A'),
(5, 12, 'A'),
(5, 20, 'A'),
(5, 22, 'A'),
(5, 23, 'A'),
(5, 30, 'A'),
(5, 31, 'A'),
(5, 40, 'A'),
(5, 41, 'A'),
(5, 43, 'A'),
(5, 44, 'A'),
(5, 45, 'A'),
(5, 46, 'A'),
(5, 47, 'A'),
(5, 49, 'A'),
(5, 51, 'A'),
(6, 1, 'A'),
(6, 2, 'A'),
(6, 3, 'A'),
(6, 4, 'A'),
(6, 5, 'A'),
(6, 10, 'A'),
(6, 11, 'A'),
(6, 12, 'A'),
(6, 20, 'A'),
(6, 21, 'A'),
(6, 22, 'A'),
(6, 23, 'A'),
(6, 30, 'A'),
(6, 31, 'A'),
(6, 40, 'A'),
(6, 41, 'A'),
(6, 42, 'A'),
(6, 43, 'A'),
(6, 44, 'A'),
(6, 45, 'A'),
(6, 46, 'A'),
(6, 47, 'A'),
(6, 48, 'A'),
(6, 49, 'A'),
(6, 50, 'A'),
(6, 51, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_panel`
--

CREATE TABLE `permiso_panel` (
  `PP_id` int(11) NOT NULL,
  `ROL_id` int(11) NOT NULL,
  `PAN_id` int(11) NOT NULL,
  `PP_estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `ROL_id` int(10) UNSIGNED NOT NULL,
  `ROL_nombre` varchar(50) NOT NULL,
  `ROL_fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ROL_usuarioRegistro` varchar(20) NOT NULL,
  `ROL_fechaModificacion` datetime DEFAULT NULL,
  `ROL_usuarioModificacion` varchar(20) DEFAULT NULL,
  `ROL_estado` char(2) NOT NULL DEFAULT 'AC',
  `ROL_flagActivo` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`ROL_id`, `ROL_nombre`, `ROL_fechaRegistro`, `ROL_usuarioRegistro`, `ROL_fechaModificacion`, `ROL_usuarioModificacion`, `ROL_estado`, `ROL_flagActivo`) VALUES
(1, 'Alumno', '2014-06-07 18:40:45', '', NULL, NULL, 'AC', 'A'),
(2, 'Profesor', '2014-06-07 18:40:45', '', NULL, NULL, 'AC', 'A'),
(3, 'Padre de familia', '2014-06-07 18:40:45', '', NULL, NULL, 'AC', 'A'),
(4, 'Apoderado', '2014-06-07 18:40:45', '', NULL, NULL, 'AC', 'A'),
(5, 'Personal Administrativo', '2014-06-07 18:40:45', '', NULL, NULL, 'AC', 'A'),
(6, 'Aministrador', '2015-09-19 00:12:55', '1', NULL, NULL, 'AC', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_matricula`
--

CREATE TABLE `tipo_matricula` (
  `tm_id` int(11) NOT NULL,
  `tm_nombre` varchar(30) NOT NULL,
  `tm_estado` int(1) NOT NULL DEFAULT '1',
  `tm_fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tm_fecha_modificacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_matricula`
--

INSERT INTO `tipo_matricula` (`tm_id`, `tm_nombre`, `tm_estado`, `tm_fecha_registro`, `tm_fecha_modificacion`) VALUES
(1, 'Matricula Nueva', 1, '2015-11-20 03:49:53', '0000-00-00 00:00:00'),
(2, 'Traslado', 1, '2015-11-20 03:49:53', '0000-00-00 00:00:00'),
(3, 'Matricula Año Nuevo', 1, '2015-11-20 03:50:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `USUA_id` int(10) UNSIGNED NOT NULL,
  `USUA_codigo` varchar(20) DEFAULT NULL,
  `USUA_nombres` varchar(100) DEFAULT NULL,
  `USUA_apellidoPaterno` varchar(50) DEFAULT NULL,
  `USUA_apellidoMaterno` varchar(50) DEFAULT NULL,
  `USUA_login` varchar(20) DEFAULT NULL,
  `USUA_clave` varchar(50) DEFAULT NULL,
  `USUA_dni` varchar(15) DEFAULT NULL,
  `USUA_email` varchar(200) DEFAULT NULL,
  `USUA_telefonos` varchar(200) DEFAULT NULL,
  `USUA_sexo` char(1) DEFAULT NULL,
  `USUA_ordenMerito` int(11) NOT NULL,
  `GRAD_id` int(11) UNSIGNED DEFAULT '0',
  `USUA_fechaNacimiento` date DEFAULT NULL,
  `USUA_observaciones` varchar(500) DEFAULT NULL,
  `USUA_imagen` varchar(500) NOT NULL,
  `USUA_fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `USUA_usuarioRegistro` varchar(20) NOT NULL,
  `USUA_fechaModificacion` datetime DEFAULT NULL,
  `USUA_usuarioModificacion` varchar(20) DEFAULT NULL,
  `USUA_fechaEliminacion` datetime DEFAULT NULL,
  `USUA_usuarioEliminacion` varchar(20) DEFAULT NULL,
  `USUA_estado` char(2) NOT NULL DEFAULT 'AC',
  `USUA_flagActivo` char(1) NOT NULL DEFAULT 'A',
  `ROL_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`USUA_id`, `USUA_codigo`, `USUA_nombres`, `USUA_apellidoPaterno`, `USUA_apellidoMaterno`, `USUA_login`, `USUA_clave`, `USUA_dni`, `USUA_email`, `USUA_telefonos`, `USUA_sexo`, `USUA_ordenMerito`, `GRAD_id`, `USUA_fechaNacimiento`, `USUA_observaciones`, `USUA_imagen`, `USUA_fechaRegistro`, `USUA_usuarioRegistro`, `USUA_fechaModificacion`, `USUA_usuarioModificacion`, `USUA_fechaEliminacion`, `USUA_usuarioEliminacion`, `USUA_estado`, `USUA_flagActivo`, `ROL_id`) VALUES
(1, NULL, 'Julio Alcides', 'Salsavilca', 'Huamanyauri', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '47140697', 'j.salsavilca@jkolaz.com', '954124126', 'M', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 5),
(2, '20140001', 'Amy', 'AGUIRRE', 'SOTELO', '2014001', 'e10adc3949ba59abbe56e057f20f883e', '10874854', '', '992284460', 'F', 0, 1, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(3, '20140002', 'Noelia Sofia Marisel', 'ALONSO', 'RENGIFO', '2014002', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'F', 0, 1, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(4, '20140003', 'Lia Valentina', 'CALDERON', 'SALAZAR', '2014003', 'e10adc3949ba59abbe56e057f20f883e', '10874855', '', '992284460', 'F', 0, 1, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(5, '20140004', 'Angelina Miranda', 'CASTILLO', 'LARREA', '2014004', 'e10adc3949ba59abbe56e057f20f883e', '10874856', '', '992284460', 'F', 0, 1, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(6, '20140005', 'Lluneyci Marie', 'CHAVEZ', 'MUÑOZ', '2014005', 'e10adc3949ba59abbe56e057f20f883e', '10874857', '', '992284460', 'F', 0, 1, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(7, '20140006', 'Joaquin Gabriel', 'DIAZ', 'VASQUEZ', '2014006', 'e10adc3949ba59abbe56e057f20f883e', '10874858', '', '992284460', 'M', 0, 1, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(8, '20140007', 'Angel Daniel', 'FERNANDEZ', 'PITA', '2014007', 'e10adc3949ba59abbe56e057f20f883e', '10874859', '', '992284460', 'M', 0, 1, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(9, '20140008', 'Jean Pierre', 'HUAMANY', 'PAJUELO', '2014008', 'e10adc3949ba59abbe56e057f20f883e', '10874860', '', '992284460', 'M', 0, 1, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(10, '20140009', 'Jhordan Samir', 'LAZO', 'GARCIA', '2014009', 'e10adc3949ba59abbe56e057f20f883e', '10874861', '', '992284460', 'M', 0, 1, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(11, '20140010', 'Diana Lucia', 'LLACUACHAQUI', 'CARRERA', '2014010', 'e10adc3949ba59abbe56e057f20f883e', '10874863', '', '992284460', 'M', 0, 1, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(12, '20140011', 'Segundo Leonel', 'ORE', 'UBALTAR', '2014011', 'e10adc3949ba59abbe56e057f20f883e', '10874862', '', '992284460', 'M', 0, 1, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(13, '20140012', 'Ian Hakim', 'PERALES', 'DAVILA', '2014012', 'e10adc3949ba59abbe56e057f20f883e', '10874864', '', '992284460', 'M', 0, 1, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(14, '20140013', 'Angelina', 'RIVERS', 'JACINTO', '2014013', 'e10adc3949ba59abbe56e057f20f883e', '10874865', '', '992284460', 'M', 0, 1, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(15, 'PD0001', 'Angela', 'Sotelo', 'Nuñez', 'PD0001', 'e10adc3949ba59abbe56e057f20f883e', '10874866', '', '992284460', 'F', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(16, 'PD0002', 'Luz', 'Rengifo', 'Cardenas', 'PD0002', 'e10adc3949ba59abbe56e057f20f883e', '10874867', '', '992284460', 'F', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(17, 'PD0003', 'Angelica', 'Salazar', 'Chavez', 'PD0003', 'e10adc3949ba59abbe56e057f20f883e', '10874868', '', '992284460', 'F', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(18, 'PD0004', 'Carmen', 'Larrea', 'Aguilar', 'PD0004', 'e10adc3949ba59abbe56e057f20f883e', '10874869', '', '992284460', 'F', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(19, 'PD0005', 'Kiara', 'Muñoz', 'Bueno', 'PD0005', 'e10adc3949ba59abbe56e057f20f883e', '10874870', '', '992284460', 'F', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(20, 'PD0006', 'Raquel', 'Vasquez', 'Salas', 'PD0006', 'e10adc3949ba59abbe56e057f20f883e', '10874871', '', '992284460', 'F', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(21, 'PD0007', 'Milagros', 'Pita', 'Roldan', 'PD0007', 'e10adc3949ba59abbe56e057f20f883e', '10874872', '', '992284460', 'F', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(22, 'PD0008', 'Flor', 'Pajuelo', 'Sandoval', 'PD0008', 'e10adc3949ba59abbe56e057f20f883e', '10874873', '', '992284460', 'F', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(23, 'PD0009', 'Teresa', 'Garcia', 'Nuñez', 'PD0009', 'e10adc3949ba59abbe56e057f20f883e', '10874874', '', '992284460', 'F', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(24, 'PD0010', 'Beatriz', 'Carrera', 'Salas', 'PD0010', 'e10adc3949ba59abbe56e057f20f883e', '10874875', '', '992284460', 'F', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(25, 'PD0011', 'Pamela', 'Ubaltar', 'Rosas', 'PD0011', 'e10adc3949ba59abbe56e057f20f883e', '10874876', '', '992284460', 'F', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(26, 'PD0012', 'Wendy', 'Davila', 'Becerra', 'PD0012', 'e10adc3949ba59abbe56e057f20f883e', '10874877', '', '992284460', 'M', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(27, 'PD0013', 'Claudia', 'Jacinto', 'Rios', 'PD0013', 'e10adc3949ba59abbe56e057f20f883e', '10874878', '', '992284460', 'M', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(28, '20140014', 'Nicole Georgette', 'Caceres', 'Aguirre', '20140014', 'e10adc3949ba59abbe56e057f20f883e', '10874879', '', '992284460', 'M', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(29, '20140015', 'Brenda', 'Elias', 'Juarez', '20140015', 'e10adc3949ba59abbe56e057f20f883e', '10874880', '', '992284460', 'M', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(30, '20140016', 'Angelina', 'Estrada', 'Salinas', '20140016', 'e10adc3949ba59abbe56e057f20f883e', '10874881', '', '992284460', 'M', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(31, '20140017', 'Vivian Coral', 'Mora', 'Delgado', '20140017', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(32, '20140018', 'Cielo Celeste', 'Ocampo', 'Bautista', '20140018', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(33, '20140019', 'Alvaro Alberto', 'Salmon', 'Esquen', '20140019', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(34, '20140020', 'Jossety', 'Sandoval', 'Cruz', '20140020', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(35, '20140021', 'Alexandra', 'Utani', 'Lopez', '20140021', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(36, '20140022', 'Aaron', 'Vasquez', 'Rodriguez', '20140022', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(37, '20140023', 'Joaquin', 'Vila', 'Salinas', '20140023', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 2, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(38, 'PD0014', 'Patricia', 'Aguirre', 'Solis', 'PD0014', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(39, 'PD0015', 'Melva', 'Juarez', 'Flores', 'PD0015', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(40, 'PD0016', 'Beatriz', 'Salinas', 'Vega', 'PD0016', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(41, 'PD0017', 'Flavia', 'Delgado', 'Cruz', 'PD0017', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(42, 'PD0018', 'Celia', 'Bautista', 'Rojas', 'PD0018', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(43, 'PD0019', 'Marialuz', 'Esquen', 'Casas', 'PD0019', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(44, 'PD0020', 'Sonia', 'Cruz', 'Ramos', 'PD0020', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(45, 'PD0021', 'Sonia', 'Lopez', 'Sosa', 'PD0021', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(46, 'PD0022', 'Sofia', 'Rodriguez', 'Rosas', 'PD0022', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(47, 'PD0023', 'Maria', 'Salinas', 'Vega', 'PD0023', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(48, '20140024', 'Joseph Manuel', 'Choy', 'Fernandez', '20140024', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 3, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(49, '20140025', 'Renato', 'Flores', 'Ponciano', '20140025', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 3, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(50, '20140026', 'Heidi', 'Gomero', 'Nole', '20140026', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 3, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(51, '20140027', 'Stiven Dennys', 'Hinostroza', 'Chavez', '20140027', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 3, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(52, '20140028', 'Luis Franco', 'Mallqui', 'Llacuachaqui', '20140028', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 3, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(53, '20140029', 'Angela Marina', 'Munives', 'Esquen', '20140029', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 3, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(54, '20140030', 'Janaina Raichel ', 'Muñoz', 'Cardenas', '20140030', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 3, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(55, '20140031', 'Nicol', 'Panuera', 'Vega', '20140031', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 3, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(56, '20140032', 'Nathaly', 'Pillaca', 'Allccahuaman', '20140032', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 3, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(57, '20140033', 'Santiago Enrique', 'Rodulfo', 'Ramirez', '20140033', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 3, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(58, '20140034', 'Jesus Manuel', 'Soriano', 'Goicochea', '20140034', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 3, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(59, '20140035', 'Jared Alexander', 'Tasayco', 'Minas', '20140035', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 3, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(60, 'PD0024', 'Angelica', 'Fernandez', 'Perez', 'PD0024', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(61, 'PD0025', 'Lucia', 'Ponciano', 'Velez', 'PD0025', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(62, 'PD0026', 'Noelia', 'Nole', 'Chavez', 'PD0026', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(63, 'PD0027', 'Maria', 'Chavez', 'Napan', 'PD0027', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(64, 'PD0028', 'Juana', 'Llacuachaqui', 'Mora', 'PD0028', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(65, 'PD0029', 'Rachel', 'Esquen', 'Murrillo', 'PD0029', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(66, 'PD0030', 'Anamaria', 'Cardenas', 'Rosi', 'PD0030', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(67, 'PD0031', 'Silvia', 'Vega', 'Solis', 'PD0031', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(68, 'PD0032', 'Luz', 'Allccahuaman', 'Vega', 'PD0032', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(69, 'PD0033', 'Soledad', 'Ramirez', 'Peña', 'PD0033', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(70, 'PD0034', 'Maribel', 'Goicochea', 'Muñoz', 'PD0034', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(71, 'PD0035', 'Angelina', 'Minas', 'Chavez', 'PD0035', 'e10adc3949ba59abbe56e057f20f883e', '10874853', '', '992284460', 'M', 0, 0, NULL, NULL, '', '2014-06-07 18:40:45', 'admin', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(73, '20140036', 'jose', 'cenizario', 'rojas', '45667300', '43d22c02ddb4957ae93a1afdfe46f1f2', '45667300', 'rey_black2015@hotmail.com', NULL, 'M', 0, 0, NULL, NULL, '', '2015-04-11 23:54:44', '', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(75, '20140037', 'jose', 'cenizario', 'rojas', '45667300', '43d22c02ddb4957ae93a1afdfe46f1f2', '45667300', 'rey_black2015@hotmail.com', NULL, 'M', 0, 0, NULL, NULL, '', '2015-04-11 23:55:33', '', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(79, '45667300', 'jose luis', 'cenizario', 'rojas', '45667300', 'e10adc3949ba59abbe56e057f20f883e', '45667300', 'rey_black2015@hotmail.com', NULL, 'M', 0, 0, NULL, NULL, '', '2015-04-24 21:17:09', '', NULL, NULL, NULL, NULL, 'DC', 'D', 2),
(82, NULL, 'Jose Luis', 'Cenizario', 'Rojas', 'Cenizario', 'e10adc3949ba59abbe56e057f20f883e', '45667300', 'rey_black2015@hotmail.com', NULL, 'M', 0, 0, NULL, NULL, '', '2015-04-24 23:57:30', '', NULL, NULL, NULL, NULL, 'AC', 'A', 5),
(83, NULL, 'Sharlyn', 'Ramos', 'Olortegui', 'Sharlyn', 'e10adc3949ba59abbe56e057f20f883e', '45667300', 'ramos_666@hotmail.com', NULL, 'F', 0, 0, NULL, NULL, '', '2015-04-25 00:05:49', '', NULL, NULL, NULL, NULL, 'AC', 'A', 5),
(84, '20140038', 'Jose Luis', 'Cenizario', 'Rojas', '45667300', '43d22c02ddb4957ae93a1afdfe46f1f2', '45667300', 'rey_black2015@hotmail.com', NULL, 'M', 0, 0, NULL, NULL, '', '2015-05-13 22:46:44', '', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(86, '20140039', 'jose', 'cenizario', 'rojas', '45667300', '43d22c02ddb4957ae93a1afdfe46f1f2', '45667300', 'jlcenizario@hotmail.con', NULL, 'M', 0, 0, NULL, NULL, '', '2015-05-28 00:43:18', '', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(95, '20150001', 'juan', 'huapaya', 'romero', '20204541', 'fac6469baf0087a08e676335bd5a70ac', '20204541', 'jsalsavilca@vmcdevelopment.com', NULL, 'M', 0, 0, NULL, NULL, '', '2015-06-16 22:55:56', '', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(96, 'PD00036', 'juan', 'huapaya', 'huapaya', '54646546', '9e8f277c050db25269459e5f0f20f165', '54646546', NULL, NULL, 'M', 0, 0, NULL, NULL, '', '2015-06-16 22:55:56', '', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(97, 'PD00037', 'Luz', 'romero', 'Cardenas', '54654654', '9c0a218672f4235642b290a8498e8ce0', '54654654', NULL, NULL, 'F', 0, 0, NULL, NULL, '', '2015-06-16 22:55:56', '', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(98, '20150001', 'erika betty', 'salsavilca', 'huamanyauri', '45646546', '67f40b2f4d7ab09112dd1a62b0aaa7aa', '45646546', 'e.salsavilca@gmail.com', NULL, 'F', 0, 0, NULL, NULL, '', '2015-06-16 23:23:50', '', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(99, 'PD00038', 'alcides julian', 'salsavilca', 'ramos', '16151503', 'da508e1d83f3f70d6504fdcc97c2efbe', '16151503', NULL, NULL, 'M', 0, 0, NULL, NULL, '', '2015-06-16 23:23:50', '', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(100, 'PD00039', 'betty dora', 'huamanyauri', 'sotil', '16151461', '1cc0acedcb7f75f61c654ddef1260c0d', '16151461', NULL, NULL, 'F', 0, 0, NULL, NULL, '', '2015-06-16 23:23:50', '', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(101, '20150001', 'Jose', 'Cenizario', 'Rojas', '45667300', '43d22c02ddb4957ae93a1afdfe46f1f2', '45667300', 'jlcenizario@hotmail.com', NULL, 'M', 0, 0, NULL, NULL, '', '2015-06-20 01:25:15', '', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(102, 'PD00040', 'jose', 'cenizario', 'ro', '45666031', 'c9e9929674681c8e7c36f7412a15a1ec', '45666031', NULL, NULL, 'M', 0, 0, NULL, NULL, '', '2015-06-20 01:25:15', '', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(103, 'PD00041', 'silvi', 'gkj', 'gkjk', '45678411', 'f933b32816158549cf1b5a2d180091f4', '45678411', NULL, NULL, 'F', 0, 0, NULL, NULL, '', '2015-06-20 01:25:15', '', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(104, '20150001', 'sharlyn', 'ramos', 'olortegui', '45187012', '35a1b403a5e53d7930d3022093ce1495', '45187012', 'ramos@hotmail.com', NULL, 'F', 0, 0, NULL, NULL, '', '2015-06-27 01:05:45', '', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(105, 'PD00042', 'carlos', 'ramos', 'chacon', '43588741', '17abe42d88df927ae46e76f3f720dd50', '43588741', NULL, NULL, 'M', 0, 0, NULL, NULL, '', '2015-06-27 01:05:45', '', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(106, 'PD00043', 'isabel', 'olortegui', 'reyes', '42587413', '920cd09dea6f1a3a8576ff396f5cd23e', '42587413', NULL, NULL, 'F', 0, 0, NULL, NULL, '', '2015-06-27 01:05:45', '', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(107, 'PROF2015001', 'Melissa', 'Barzola', 'Pino', 'PROF2015001', 'e10adc3949ba59abbe56e057f20f883e', '47140698', ' ', NULL, 'F', 0, 0, NULL, NULL, '', '2015-09-14 15:45:13', '', NULL, NULL, NULL, NULL, 'AC', 'A', 2),
(108, 'PROF2015002', 'Luis', 'Ramos', 'OlÃ³rtegui', 'PROF2015002', 'e10adc3949ba59abbe56e057f20f883e', ' ', ' ', NULL, 'M', 0, 0, NULL, NULL, '', '2015-09-14 15:45:55', '', NULL, NULL, NULL, NULL, 'AC', 'A', 2),
(109, 'PROF2015003', 'Sharlyn', 'Ramos', 'OlÃ³rtegui', 'PROF2015003', 'e10adc3949ba59abbe56e057f20f883e', ' ', ' ', NULL, 'F', 0, 0, NULL, NULL, '', '2015-09-14 15:46:37', '', NULL, NULL, NULL, NULL, 'AC', 'A', 2),
(110, 'PROF2015004', 'Josselin Franccesca ', 'Torres', 'FabiÃ¡n', 'PROF2015004', 'e10adc3949ba59abbe56e057f20f883e', ' ', ' ', NULL, 'F', 0, 0, NULL, NULL, '', '2015-09-14 15:47:10', '', NULL, NULL, NULL, NULL, 'AC', 'A', 2),
(111, 'PROF2015005', 'Miriam', 'CÃ¡ceres', 'HernÃ¡ndez', 'PROF2015005', 'e10adc3949ba59abbe56e057f20f883e', ' ', ' ', NULL, 'F', 0, 0, NULL, NULL, '', '2015-09-14 15:51:37', '', NULL, NULL, NULL, NULL, 'AC', 'A', 2),
(112, 'PROF2015006', 'Rosa MarÃ­a ', 'Cruces', 'Torres', 'PROF2015006', 'e10adc3949ba59abbe56e057f20f883e', ' ', ' ', NULL, 'F', 0, 0, NULL, NULL, '', '2015-09-14 15:52:36', '', NULL, NULL, NULL, NULL, 'AC', 'A', 2),
(113, 'PROF2015007', 'Jesica', 'Morales', 'FernÃ¡ndez', 'PROF2015007', 'e10adc3949ba59abbe56e057f20f883e', ' ', ' ', NULL, 'F', 0, 0, NULL, NULL, '', '2015-09-14 15:53:14', '', NULL, NULL, NULL, NULL, 'AC', 'A', 2),
(114, 'PROF2015008', 'Wendy', 'Villafuerte', 'Rojas', 'PROF2015008', 'e10adc3949ba59abbe56e057f20f883e', ' ', ' ', NULL, 'F', 0, 0, NULL, NULL, '', '2015-09-14 15:53:48', '', NULL, NULL, NULL, NULL, 'AC', 'A', 2),
(115, '20150001', 'Jose', 'Cenizario', 'Rojas', '20150001', '43d22c02ddb4957ae93a1afdfe46f1f2', '45667300', 'jlcenizario@', NULL, 'M', 0, 0, NULL, NULL, '', '2015-09-26 01:55:42', '', NULL, NULL, NULL, NULL, 'AC', 'A', 1),
(116, 'PD00044', 'jose', 'cenizario', 'andrade', 'PD00044', 'e5f7158c561277baed80d9aa372f5974', '45646540', NULL, NULL, 'M', 0, 0, NULL, NULL, '', '2015-09-26 01:55:42', '', NULL, NULL, NULL, NULL, 'AC', 'A', 3),
(117, 'PD00045', 'silvia', 'rojas', 'zuniga', 'PD00045', '3d0bf4c37136b93d1ae09f0fe9033b22', '45646460', NULL, NULL, 'F', 0, 0, NULL, NULL, '', '2015-09-26 01:55:42', '', NULL, NULL, NULL, NULL, 'AC', 'A', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anio`
--
ALTER TABLE `anio`
  ADD PRIMARY KEY (`ANI_id`);

--
-- Indices de la tabla `asignado`
--
ALTER TABLE `asignado`
  ADD PRIMARY KEY (`ASIG_id`);

--
-- Indices de la tabla `bimestre`
--
ALTER TABLE `bimestre`
  ADD PRIMARY KEY (`BIME_id`);

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`CALI_id`);

--
-- Indices de la tabla `calificacion_detalle`
--
ALTER TABLE `calificacion_detalle`
  ADD PRIMARY KEY (`CALD_id`),
  ADD KEY `CALI_id` (`CALI_id`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`COME_id`),
  ADD KEY `fk_comentario_usuario1` (`USUA_idDestino`),
  ADD KEY `fk_comentario_usuario2` (`USUA_idRegistro`);

--
-- Indices de la tabla `comentario_edicion`
--
ALTER TABLE `comentario_edicion`
  ADD PRIMARY KEY (`COME_id`,`CEDI_edicion`);

--
-- Indices de la tabla `criterio`
--
ALTER TABLE `criterio`
  ADD PRIMARY KEY (`CRIT_id`);

--
-- Indices de la tabla `cuota`
--
ALTER TABLE `cuota`
  ADD PRIMARY KEY (`CUOT_id`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`CURS_id`),
  ADD KEY `fk_curso_grado1` (`GRAD_id`);

--
-- Indices de la tabla `curso_x_grado_x_usuario`
--
ALTER TABLE `curso_x_grado_x_usuario`
  ADD PRIMARY KEY (`CGU_id`),
  ADD KEY `fk_curso_x_grado_usuario_curso1` (`CURS_id`),
  ADD KEY `fk_curso_x_grado_usuario_grado_x_usuario1` (`USUA_id`,`GRAD_id`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`DOCU_id`);

--
-- Indices de la tabla `documento_x_entregar`
--
ALTER TABLE `documento_x_entregar`
  ADD PRIMARY KEY (`DXEN_id`);

--
-- Indices de la tabla `documento_x_grado_x_usuario`
--
ALTER TABLE `documento_x_grado_x_usuario`
  ADD PRIMARY KEY (`USUA_id`,`GRAD_id`,`DOCU_id`),
  ADD KEY `fk_documento_entregado_documento1` (`DOCU_id`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`GRAD_id`),
  ADD KEY `fk_grado_nivel1` (`NIVE_id`);

--
-- Indices de la tabla `grado_x_usuario`
--
ALTER TABLE `grado_x_usuario`
  ADD PRIMARY KEY (`USUA_id`,`GRAD_id`,`ANIO_id`),
  ADD KEY `fk_grado_x_usuario_usuario1` (`USUA_id`),
  ADD KEY `fk_grado_x_usuario_grado1` (`GRAD_id`),
  ADD KEY `ANIO_id` (`ANIO_id`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`MENU_id`);

--
-- Indices de la tabla `nivel`
--
ALTER TABLE `nivel`
  ADD PRIMARY KEY (`NIVE_id`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`USUA_id`,`CUOT_id`),
  ADD KEY `fk_cuota_x_alumno_cuota1` (`CUOT_id`);

--
-- Indices de la tabla `panel`
--
ALTER TABLE `panel`
  ADD PRIMARY KEY (`PAN_id`);

--
-- Indices de la tabla `pariente`
--
ALTER TABLE `pariente`
  ADD PRIMARY KEY (`USUA_idHijo`,`USUA_idPadre`),
  ADD KEY `fk_pariente_usuario2` (`USUA_idPadre`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`ROL_id`,`MENU_id`),
  ADD KEY `fk_permiso_menu1_idx` (`MENU_id`);

--
-- Indices de la tabla `permiso_panel`
--
ALTER TABLE `permiso_panel`
  ADD PRIMARY KEY (`PP_id`),
  ADD KEY `ROL_id` (`ROL_id`),
  ADD KEY `PAN_id` (`PAN_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`ROL_id`);

--
-- Indices de la tabla `tipo_matricula`
--
ALTER TABLE `tipo_matricula`
  ADD PRIMARY KEY (`tm_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`USUA_id`),
  ADD KEY `fk_usuario_tipo_usuario_idx` (`ROL_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anio`
--
ALTER TABLE `anio`
  MODIFY `ANI_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `asignado`
--
ALTER TABLE `asignado`
  MODIFY `ASIG_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT de la tabla `bimestre`
--
ALTER TABLE `bimestre`
  MODIFY `BIME_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `CALI_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `calificacion_detalle`
--
ALTER TABLE `calificacion_detalle`
  MODIFY `CALD_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `COME_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `criterio`
--
ALTER TABLE `criterio`
  MODIFY `CRIT_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `cuota`
--
ALTER TABLE `cuota`
  MODIFY `CUOT_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `CURS_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT de la tabla `curso_x_grado_x_usuario`
--
ALTER TABLE `curso_x_grado_x_usuario`
  MODIFY `CGU_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `DOCU_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `documento_x_entregar`
--
ALTER TABLE `documento_x_entregar`
  MODIFY `DXEN_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
  MODIFY `GRAD_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `MENU_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT de la tabla `nivel`
--
ALTER TABLE `nivel`
  MODIFY `NIVE_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `panel`
--
ALTER TABLE `panel`
  MODIFY `PAN_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `permiso_panel`
--
ALTER TABLE `permiso_panel`
  MODIFY `PP_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `ROL_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `tipo_matricula`
--
ALTER TABLE `tipo_matricula`
  MODIFY `tm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `USUA_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificacion_detalle`
--
ALTER TABLE `calificacion_detalle`
  ADD CONSTRAINT `calificacion_detalle_ibfk_1` FOREIGN KEY (`CALI_id`) REFERENCES `calificacion` (`CALI_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_comentario_usuario1` FOREIGN KEY (`USUA_idDestino`) REFERENCES `usuario` (`USUA_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comentario_usuario2` FOREIGN KEY (`USUA_idRegistro`) REFERENCES `usuario` (`USUA_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comentario_edicion`
--
ALTER TABLE `comentario_edicion`
  ADD CONSTRAINT `fk_comentario_edicion_comentario1` FOREIGN KEY (`COME_id`) REFERENCES `comentario` (`COME_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk_curso_grado1` FOREIGN KEY (`GRAD_id`) REFERENCES `grado` (`GRAD_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `curso_x_grado_x_usuario`
--
ALTER TABLE `curso_x_grado_x_usuario`
  ADD CONSTRAINT `fk_curso_x_grado_usuario_curso1` FOREIGN KEY (`CURS_id`) REFERENCES `curso` (`CURS_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_curso_x_grado_usuario_grado_x_usuario1` FOREIGN KEY (`USUA_id`,`GRAD_id`) REFERENCES `grado_x_usuario` (`USUA_id`, `GRAD_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `documento_x_grado_x_usuario`
--
ALTER TABLE `documento_x_grado_x_usuario`
  ADD CONSTRAINT `fk_documento_entregado_documento1` FOREIGN KEY (`DOCU_id`) REFERENCES `documento` (`DOCU_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_documento_pendiente_grado_x_usuario1` FOREIGN KEY (`USUA_id`,`GRAD_id`) REFERENCES `grado_x_usuario` (`USUA_id`, `GRAD_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grado`
--
ALTER TABLE `grado`
  ADD CONSTRAINT `fk_grado_nivel1` FOREIGN KEY (`NIVE_id`) REFERENCES `nivel` (`NIVE_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grado_x_usuario`
--
ALTER TABLE `grado_x_usuario`
  ADD CONSTRAINT `fk_grado_x_usuario_anio1` FOREIGN KEY (`ANIO_id`) REFERENCES `anio` (`ANI_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_grado_x_usuario_grado1` FOREIGN KEY (`GRAD_id`) REFERENCES `grado` (`GRAD_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_grado_x_usuario_usuario1` FOREIGN KEY (`USUA_id`) REFERENCES `usuario` (`USUA_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `fk_cuota_x_alumno_cuota1` FOREIGN KEY (`CUOT_id`) REFERENCES `cuota` (`CUOT_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cuota_x_alumno_usuario1` FOREIGN KEY (`USUA_id`) REFERENCES `usuario` (`USUA_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pariente`
--
ALTER TABLE `pariente`
  ADD CONSTRAINT `fk_pariente_usuario1` FOREIGN KEY (`USUA_idHijo`) REFERENCES `usuario` (`USUA_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pariente_usuario2` FOREIGN KEY (`USUA_idPadre`) REFERENCES `usuario` (`USUA_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `fk_permiso_menu1` FOREIGN KEY (`MENU_id`) REFERENCES `menu` (`MENU_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_permiso_rol1` FOREIGN KEY (`ROL_id`) REFERENCES `rol` (`ROL_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `permiso_panel`
--
ALTER TABLE `permiso_panel`
  ADD CONSTRAINT `PAN_id1` FOREIGN KEY (`PAN_id`) REFERENCES `panel` (`PAN_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_tipo_usuario` FOREIGN KEY (`ROL_id`) REFERENCES `rol` (`ROL_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
