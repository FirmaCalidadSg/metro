-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-02-2025 a las 17:01:06
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
-- Base de datos: `metrolink`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `departamento` int(11) NOT NULL,
  `codigo_postal` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id`, `nombre`, `departamento`, `codigo_postal`) VALUES
(6, 'Ibagué', 1, '000'),
(7, 'Cali', 2, '760000'),
(8, 'Cúcuta', 3, '777000'),
(10, 'Buga', 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_capacidad`
--

CREATE TABLE `control_capacidad` (
  `id` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  `planta_id` int(11) NOT NULL,
  `linea_id` int(11) NOT NULL,
  `proceso_id` int(11) NOT NULL,
  `turno_id` int(11) NOT NULL,
  `operario` varchar(100) NOT NULL,
  `horas_hombre` decimal(5,2) NOT NULL,
  `num_operarios` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `control_capacidad`
--

INSERT INTO `control_capacidad` (`id`, `fecha_registro`, `planta_id`, `linea_id`, `proceso_id`, `turno_id`, `operario`, `horas_hombre`, `num_operarios`, `created_at`, `updated_at`) VALUES
(1, '2025-02-05', 1, 1, 0, 1, 'pepito perez', 64.00, 8, '2025-02-05 19:37:35', '2025-02-05 19:37:35'),
(2, '2025-02-05', 1, 1, 0, 1, 'pepito perez', 64.00, 8, '2025-02-05 19:40:08', '2025-02-05 19:40:08'),
(3, '2025-02-05', 1, 1, 0, 1, 'pepito perez', 64.00, 8, '2025-02-05 19:40:53', '2025-02-05 19:40:53'),
(4, '2025-02-05', 1, 1, 0, 1, 'pepito perez', 64.00, 8, '2025-02-05 19:40:53', '2025-02-05 19:40:53'),
(5, '2025-02-05', 1, 1, 0, 1, 'pepito perez', 64.00, 8, '2025-02-05 19:40:58', '2025-02-05 19:40:58'),
(6, '2025-02-05', 1, 1, 0, 1, 'pepito perez', 64.00, 8, '2025-02-05 19:40:58', '2025-02-05 19:40:58'),
(7, '2025-02-05', 1, 1, 0, 1, 'pepito perez', 64.00, 8, '2025-02-05 19:41:02', '2025-02-05 19:41:02'),
(8, '2025-02-05', 1, 1, 0, 1, 'pepito perez', 64.00, 8, '2025-02-05 19:41:02', '2025-02-05 19:41:02'),
(9, '2025-02-05', 1, 1, 0, 1, 'pepito perez', 64.00, 8, '2025-02-05 19:50:40', '2025-02-05 19:50:40'),
(10, '2025-02-05', 1, 1, 0, 1, 'pepito perez', 64.00, 8, '2025-02-05 19:50:54', '2025-02-05 19:50:54'),
(11, '2025-02-05', 1, 1, 0, 1, 'pepito perez', 64.00, 8, '2025-02-05 19:55:58', '2025-02-05 19:55:58'),
(12, '2025-02-05', 1, 1, 0, 1, 'pepito perez', 64.00, 8, '2025-02-05 19:58:19', '2025-02-05 19:58:19'),
(13, '2025-02-05', 1, 0, 0, 1, 'pepito perez', 64.00, 8, '2025-02-05 20:19:05', '2025-02-05 20:19:05'),
(14, '2025-02-05', 1, 1, 0, 1, 'pepito perez', 64.00, 8, '2025-02-05 22:19:07', '2025-02-05 22:19:07'),
(15, '2025-02-05', 1, 1, 0, 1, 'pepito perez', 64.00, 8, '2025-02-05 22:20:48', '2025-02-05 22:20:48'),
(16, '2025-02-05', 1, 1, 0, 1, 'pepito perez', 64.00, 8, '2025-02-05 22:21:31', '2025-02-05 22:21:31'),
(17, '2025-02-05', 1, 0, 0, 1, 'pepito perez', 64.00, 8, '2025-02-06 13:17:56', '2025-02-06 13:17:56'),
(18, '2025-02-06', 1, 2, 0, 1, 'pepito perez', 64.00, 8, '2025-02-06 17:02:17', '2025-02-06 17:02:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `danoequipo`
--

CREATE TABLE `danoequipo` (
  `id` int(11) NOT NULL,
  `equipo` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `danoequipo`
--

INSERT INTO `danoequipo` (`id`, `equipo`, `descripcion`, `fecha`, `estado`) VALUES
(1, 1, 'Descripcion E1', '2024-11-29 22:50:00', 'OK'),
(3, 1, 'Falla en el termostato', '2025-02-17 15:53:47', 'Pendiente'),
(4, 1, 'Pérdida de calor excesiva', '2025-02-17 15:53:47', 'Reparado'),
(5, 1, 'Puerta con cierre defectuoso', '2025-02-17 15:53:47', 'En proceso'),
(6, 1, 'Ventilador no funciona', '2025-02-17 15:53:47', 'Pendiente'),
(7, 1, 'Resistencia quemada', '2025-02-17 15:53:47', 'Reparado'),
(8, 2, 'Quemadores no calientan', '2025-02-17 15:53:47', 'Pendiente'),
(9, 2, 'Ruido excesivo al funcionar', '2025-02-17 15:53:47', 'Reparado'),
(10, 2, 'Panel de control dañado', '2025-02-17 15:53:47', 'Pendiente'),
(11, 2, 'Sensor de temperatura falla', '2025-02-17 15:53:47', 'En proceso'),
(12, 2, 'Filtro de aire obstruido', '2025-02-17 15:53:47', 'Reparado'),
(13, 3, 'Fuga de gas detectada', '2025-02-17 15:53:47', 'Pendiente'),
(14, 3, 'Perilla de encendido atascada', '2025-02-17 15:53:47', 'Reparado'),
(15, 3, 'Desgaste en el cableado eléctrico', '2025-02-17 15:53:47', 'Pendiente'),
(16, 3, 'Problema en el encendido automático', '2025-02-17 15:53:47', 'Reparado'),
(17, 3, 'Llama inestable en los quemadores', '2025-02-17 15:53:47', 'En proceso'),
(18, 4, 'Motor emite sonido anormal', '2025-02-17 15:53:47', 'Pendiente'),
(19, 4, 'Piezas internas desgastadas', '2025-02-17 15:53:47', 'Reparado'),
(20, 4, 'Cable de alimentación roto', '2025-02-17 15:53:47', 'En proceso'),
(21, 4, 'Vibración excesiva al usar', '2025-02-17 15:53:47', 'Pendiente'),
(22, 4, 'Botón de encendido no responde', '2025-02-17 15:53:47', 'Reparado'),
(23, 5, 'Cuchillas desafiladas', '2025-02-17 15:53:47', 'Pendiente'),
(24, 5, 'Base con grietas visibles', '2025-02-17 15:53:47', 'Reparado'),
(25, 5, 'Falta de lubricación en engranajes', '2025-02-17 15:53:47', 'En proceso'),
(26, 5, 'Interruptor con falso contacto', '2025-02-17 15:53:47', 'Pendiente'),
(27, 5, 'Soporte suelto', '2025-02-17 15:53:47', 'Reparado'),
(28, 6, 'Motor con sobrecalentamiento', '2025-02-17 15:56:51', 'Pendiente'),
(29, 6, 'Correa de transmisión desgastada', '2025-02-17 15:56:51', 'Reparado'),
(30, 7, 'Pérdida de refrigeración', '2025-02-17 15:56:51', 'En proceso'),
(31, 7, 'Termostato con fallas', '2025-02-17 15:56:51', 'Pendiente'),
(32, 8, 'Panel de control no responde', '2025-02-17 15:56:51', 'Pendiente'),
(33, 8, 'Fuga de líquido refrigerante', '2025-02-17 15:56:51', 'Reparado'),
(34, 9, 'Vibraciones excesivas', '2025-02-17 15:56:51', 'En proceso'),
(35, 9, 'Interruptor de encendido defectuoso', '2025-02-17 15:56:51', 'Pendiente'),
(36, 10, 'Cableado en mal estado', '2025-02-17 15:56:51', 'Reparado'),
(37, 10, 'Ruido fuerte al operar', '2025-02-17 15:56:51', 'Pendiente'),
(38, 11, 'Cuchillas desafiladas', '2025-02-17 15:56:51', 'En proceso'),
(39, 11, 'Base con grietas visibles', '2025-02-17 15:56:51', 'Pendiente'),
(40, 12, 'Falla en resistencia térmica', '2025-02-17 15:56:51', 'Reparado'),
(41, 12, 'Pérdida de calor en la estructura', '2025-02-17 15:56:51', 'Pendiente'),
(42, 13, 'Botón de encendido no responde', '2025-02-17 15:56:51', 'En proceso'),
(43, 13, 'Engranajes desgastados', '2025-02-17 15:56:51', 'Reparado'),
(44, 14, 'Desgaste en las piezas internas', '2025-02-17 15:56:51', 'Pendiente'),
(45, 14, 'Fuga de gas detectada', '2025-02-17 15:56:51', 'Reparado'),
(46, 15, 'Puerta con cierre defectuoso', '2025-02-17 15:56:51', 'Pendiente'),
(47, 15, 'Sensor de temperatura no funciona', '2025-02-17 15:56:51', 'En proceso'),
(48, 16, 'Fugas de aceite en motor', '2025-02-17 15:56:51', 'Pendiente'),
(49, 16, 'Filtro obstruido', '2025-02-17 15:56:51', 'Reparado'),
(50, 17, 'Rodamientos dañados', '2025-02-17 15:56:51', 'En proceso'),
(51, 17, 'Correa de ventilador desgastada', '2025-02-17 15:56:51', 'Pendiente'),
(52, 18, 'Problema en el sistema de encendido', '2025-02-17 15:56:51', 'Pendiente'),
(53, 18, 'Perdida de eficiencia térmica', '2025-02-17 15:56:51', 'Reparado'),
(54, 19, 'Ventilador bloqueado por residuos', '2025-02-17 15:56:51', 'En proceso'),
(55, 19, 'Válvula de seguridad defectuosa', '2025-02-17 15:56:51', 'Pendiente'),
(56, 20, 'Sobrecalentamiento del motor', '2025-02-17 15:56:51', 'Reparado'),
(57, 20, 'Pérdida de presión en el sistema', '2025-02-17 15:56:51', 'Pendiente'),
(58, 21, 'Cable de alimentación suelto', '2025-02-17 15:56:51', 'En proceso'),
(59, 21, 'Problema en el sensor de humedad', '2025-02-17 15:56:51', 'Reparado'),
(60, 22, 'Válvula obstruida', '2025-02-17 15:56:51', 'Pendiente'),
(61, 22, 'Circuito eléctrico con fallas', '2025-02-17 15:56:51', 'Reparado'),
(62, 23, 'Sistema de enfriamiento ineficiente', '2025-02-17 15:56:51', 'Pendiente'),
(63, 23, 'Ruido anormal en el motor', '2025-02-17 15:56:51', 'En proceso'),
(64, 24, 'Cortocircuito en panel de control', '2025-02-17 15:56:51', 'Pendiente'),
(65, 24, 'Piezas internas desgastadas', '2025-02-17 15:56:51', 'Reparado'),
(66, 25, 'Problema en el compresor', '2025-02-17 15:56:51', 'En proceso'),
(67, 25, 'Ventilación insuficiente', '2025-02-17 15:56:51', 'Pendiente'),
(68, 26, 'Lubricación deficiente en engranajes', '2025-02-17 15:56:51', 'Reparado'),
(69, 26, 'Puerta con cierre defectuoso', '2025-02-17 15:56:51', 'Pendiente'),
(70, 27, 'Desgaste en rodillos', '2025-02-17 15:56:51', 'Pendiente'),
(71, 27, 'Pérdida de presión en pistones', '2025-02-17 15:56:51', 'En proceso'),
(72, 28, 'Lámparas de control quemadas', '2025-02-17 15:56:51', 'Reparado'),
(73, 28, 'Sensor de nivel defectuoso', '2025-02-17 15:56:51', 'Pendiente'),
(74, 29, 'Filtro de aire obstruido', '2025-02-17 15:56:51', 'Pendiente'),
(75, 29, 'Vibraciones inusuales en operación', '2025-02-17 15:56:51', 'Reparado'),
(76, 30, 'Interruptor principal no responde', '2025-02-17 15:56:51', 'En proceso'),
(77, 30, 'Panel digital con fallas', '2025-02-17 15:56:51', 'Pendiente'),
(78, 31, 'Pérdida de aislamiento térmico', '2025-02-17 15:56:51', 'Pendiente'),
(79, 31, 'Ruido en el motor', '2025-02-17 15:56:51', 'Reparado'),
(80, 32, 'Motor emite olor a quemado', '2025-02-17 15:56:51', 'En proceso'),
(81, 32, 'Correas flojas en transmisión', '2025-02-17 15:56:51', 'Pendiente'),
(82, 33, 'Resistencia de calor defectuosa', '2025-02-17 15:56:51', 'Reparado'),
(83, 33, 'Interruptor con falso contacto', '2025-02-17 15:56:51', 'Pendiente'),
(84, 34, 'Sobrecalentamiento en los cables', '2025-02-17 15:56:51', 'Pendiente'),
(85, 34, 'Fallo en sistema de seguridad', '2025-02-17 15:56:51', 'Reparado'),
(86, 35, 'Ventilador atascado', '2025-02-17 15:56:51', 'En proceso'),
(87, 35, 'Circuito de control no responde', '2025-02-17 15:56:51', 'Pendiente'),
(88, 36, 'Compresor con fugas', '2025-02-17 15:56:51', 'Pendiente'),
(89, 36, 'Válvula de seguridad con fallas', '2025-02-17 15:56:51', 'Reparado'),
(90, 37, 'Sobrecalentamiento en el transformador', '2025-02-17 15:56:51', 'Pendiente'),
(91, 37, 'Fugas de líquido refrigerante', '2025-02-17 15:56:51', 'Reparado'),
(92, 38, 'Sistema eléctrico con cortocircuito', '2025-02-17 15:56:51', 'En proceso'),
(93, 38, 'Botón de seguridad no activa', '2025-02-17 15:56:51', 'Pendiente'),
(94, 39, 'Pérdida de potencia en el motor', '2025-02-17 15:56:51', 'Pendiente'),
(95, 39, 'Engranajes rotos', '2025-02-17 15:56:51', 'Reparado'),
(96, 40, 'Falla en el sensor de temperatura', '2025-02-17 15:56:51', 'En proceso'),
(97, 40, 'Base inestable', '2025-02-17 15:56:51', 'Pendiente'),
(98, 41, 'Perdida de sellado en cámara', '2025-02-17 15:56:51', 'Pendiente'),
(99, 41, 'Fugas en tuberías', '2025-02-17 15:56:51', 'Reparado'),
(100, 42, 'Desgaste en rodamientos', '2025-02-17 15:56:51', 'Pendiente'),
(101, 42, 'Fuga en válvula de control', '2025-02-17 15:56:51', 'Reparado'),
(102, 43, 'Sistema de escape bloqueado', '2025-02-17 15:56:51', 'En proceso'),
(103, 43, 'Sobrecalentamiento en condensador', '2025-02-17 15:56:51', 'Pendiente'),
(104, 44, 'Panel de control con errores', '2025-02-17 15:56:51', 'Pendiente'),
(105, 44, 'Vibraciones excesivas en operación', '2025-02-17 15:56:51', 'Reparado'),
(106, 45, 'Fallo en el circuito eléctrico', '2025-02-17 15:56:51', 'Pendiente'),
(107, 45, 'Compresor con ruido inusual', '2025-02-17 15:56:51', 'Reparado'),
(108, 46, 'Fugas en las conexiones de gas', '2025-02-17 15:56:51', 'Pendiente'),
(109, 46, 'Resistencia de calentamiento rota', '2025-02-17 15:56:51', 'Reparado'),
(110, 47, 'Sobrecalentamiento en el panel', '2025-02-17 15:56:51', 'En proceso'),
(111, 47, 'Cableado dañado', '2025-02-17 15:56:51', 'Pendiente'),
(112, 48, 'Rodillos desgastados', '2025-02-17 15:56:51', 'Reparado'),
(113, 48, 'Interruptor defectuoso', '2025-02-17 15:56:51', 'Pendiente'),
(114, 49, 'Sistema hidráulico con pérdida de presión', '2025-02-17 15:56:51', 'Pendiente'),
(115, 49, 'Desgaste en sellos de seguridad', '2025-02-17 15:56:51', 'Reparado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `definicion`
--

CREATE TABLE `definicion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `valor` varchar(100) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `definicion`
--

INSERT INTO `definicion` (`id`, `nombre`, `valor`, `descripcion`) VALUES
(1, 'D1', 'Definicion valor', 'Descripcion D1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `pais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id`, `nombre`, `pais`) VALUES
(1, 'Tolima', 1),
(2, 'Valle del Cauca', 1),
(3, 'Norte de Santander', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dtiempo`
--

CREATE TABLE `dtiempo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dtiempo`
--

INSERT INTO `dtiempo` (`id`, `nombre`) VALUES
(1, 'Planeado De No Operación'),
(2, 'Paradas Y/O Ajustes (Mantenimiento)'),
(3, 'Paradas Y/O Ajustes (Proceso)(Disponibilidad)'),
(4, 'Perdidas De Velocidad (Rendimiento)'),
(5, 'Productos de Calidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `modelo` varchar(80) NOT NULL,
  `estado` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id`, `nombre`, `modelo`, `estado`) VALUES
(4, 'Horno Industrial', 'HT-5000', 'Operativo'),
(5, 'Horno Industrial', 'HT-6000', 'En Mantenimiento'),
(6, 'Horno Industrial', 'HT-7000', 'Fuera de Servicio'),
(7, 'Batidora Industrial', 'B-200X', 'Operativo'),
(8, 'Batidora Industrial', 'B-250XL', 'Operativo'),
(9, 'Batidora Industrial', 'B-300PRO', 'En Mantenimiento'),
(10, 'Refrigerador', 'CoolMax-500', 'Operativo'),
(11, 'Refrigerador', 'CoolMax-600', 'Operativo'),
(12, 'Refrigerador', 'CoolMax-700', 'Fuera de Servicio'),
(13, 'Congelador', 'FrostX-1000', 'Operativo'),
(14, 'Congelador', 'FrostX-1100', 'Operativo'),
(15, 'Congelador', 'FrostX-1200', 'En Mantenimiento'),
(16, 'Amasadora', 'MixPro-5', 'Operativo'),
(17, 'Amasadora', 'MixPro-6', 'Operativo'),
(18, 'Amasadora', 'MixPro-7', 'Fuera de Servicio'),
(19, 'Freidora', 'FryKing-300', 'Operativo'),
(20, 'Freidora', 'FryKing-400', 'Operativo'),
(21, 'Freidora', 'FryKing-500', 'En Mantenimiento'),
(22, 'Procesador de Alimentos', 'ProFood-1', 'Operativo'),
(23, 'Procesador de Alimentos', 'ProFood-2', 'Operativo'),
(24, 'Procesador de Alimentos', 'ProFood-3', 'Fuera de Servicio'),
(25, 'Estufa Industrial', 'HeatMax-900', 'Operativo'),
(26, 'Estufa Industrial', 'HeatMax-950', 'Operativo'),
(27, 'Estufa Industrial', 'HeatMax-1000', 'En Mantenimiento'),
(28, 'Cámara de Fermentación', 'FermentX-300', 'Operativo'),
(29, 'Cámara de Fermentación', 'FermentX-350', 'Operativo'),
(30, 'Cámara de Fermentación', 'FermentX-400', 'Fuera de Servicio'),
(31, 'Tostador', 'ToastMaster-200', 'Operativo'),
(32, 'Tostador', 'ToastMaster-250', 'Operativo'),
(33, 'Tostador', 'ToastMaster-300', 'En Mantenimiento'),
(34, 'Molino de Carne', 'MeatGrind-100', 'Operativo'),
(35, 'Molino de Carne', 'MeatGrind-200', 'Operativo'),
(36, 'Molino de Carne', 'MeatGrind-300', 'Fuera de Servicio'),
(37, 'Lavavajillas Industrial', 'CleanDish-500', 'Operativo'),
(38, 'Lavavajillas Industrial', 'CleanDish-600', 'Operativo'),
(39, 'Lavavajillas Industrial', 'CleanDish-700', 'En Mantenimiento'),
(40, 'Extractor de Jugos', 'JuiceX-1', 'Operativo'),
(41, 'Extractor de Jugos', 'JuiceX-2', 'Operativo'),
(42, 'Extractor de Jugos', 'JuiceX-3', 'Fuera de Servicio'),
(43, 'Selladora al Vacío', 'VacSeal-100', 'Operativo'),
(44, 'Selladora al Vacío', 'VacSeal-200', 'Operativo'),
(45, 'Selladora al Vacío', 'VacSeal-300', 'En Mantenimiento'),
(46, 'Máquina de Hielo', 'IcePro-500', 'Operativo'),
(47, 'Máquina de Hielo', 'IcePro-600', 'Operativo'),
(48, 'Máquina de Hielo', 'IcePro-700', 'Fuera de Servicio'),
(49, 'Licuadora Industrial', 'BlendTech-1', 'Operativo'),
(50, 'Licuadora Industrial', 'BlendTech-2', 'Operativo'),
(51, 'Licuadora Industrial', 'BlendTech-3', 'En Mantenimiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea`
--

CREATE TABLE `linea` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `proceso` int(11) NOT NULL,
  `planta_id` int(11) NOT NULL,
  `tipo_unidad` int(11) NOT NULL,
  `citg` int(11) NOT NULL COMMENT 'Aplica Capacidad ideal teórica General',
  `citr` int(11) NOT NULL COMMENT ' Aplica Capacidad ideal teórica por referencia',
  `supervisor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `linea`
--

INSERT INTO `linea` (`id`, `nombre`, `proceso`, `planta_id`, `tipo_unidad`, `citg`, `citr`, `supervisor`) VALUES
(1, 'Linea 1', 1, 1, 0, 0, 0, ''),
(2, 'Linea 2', 1, 1, 0, 0, 0, ''),
(3, 'Linea 3', 3, 2, 0, 0, 0, ''),
(4, 'Linea 4', 3, 2, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineaproducto`
--

CREATE TABLE `lineaproducto` (
  `id` int(11) NOT NULL,
  `planta_id` int(11) NOT NULL,
  `proceso_id` int(11) NOT NULL,
  `linea_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `unidad` varchar(11) NOT NULL,
  `peso` int(11) NOT NULL,
  `rendimiento` int(11) NOT NULL,
  `produccion_ajustada` int(11) NOT NULL,
  `produccion_teorica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `lineaproducto`
--

INSERT INTO `lineaproducto` (`id`, `planta_id`, `proceso_id`, `linea_id`, `producto_id`, `unidad`, `peso`, `rendimiento`, `produccion_ajustada`, `produccion_teorica`) VALUES
(1, 1, 1, 1, 1, '0', 10, 1, 40000, 44000),
(2, 1, 1, 2, 7, '0', 10, 1, 24000, 25000),
(3, 1, 1, 2, 7, '0', 10, 1, 27000, 30000),
(4, 1, 1, 2, 7, 'Unidades', 10, 1, 10000, 11000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `codigo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `nombre`, `codigo`) VALUES
(1, 'Colombia', '57'),
(3, 'Venezuela', '58'),
(4, 'Chile', '054');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paros`
--

CREATE TABLE `paros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `dtiempo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paros`
--

INSERT INTO `paros` (`id`, `nombre`, `dtiempo_id`) VALUES
(1, 'Fallas de equipos', 2),
(2, 'Cambio de producto o formato', 3),
(3, 'Cambio insumos / material de empaque', 3),
(4, 'Gestión', 3),
(5, 'Organización de Línea', 3),
(6, 'Logística Externa', 3),
(7, 'Logística Interna', 3),
(8, 'Mediciones y ajustes', 3),
(9, 'Pequeñas paradas', 4),
(10, 'Perdidas de velocidad', 4),
(11, 'Productos defectuosos', 5),
(12, 'Reproceso', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantas`
--

CREATE TABLE `plantas` (
  `id` int(11) NOT NULL,
  `nombre_planta` varchar(255) NOT NULL,
  `ciudad_id` int(11) NOT NULL,
  `responsable_id` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `plantas`
--

INSERT INTO `plantas` (`id`, `nombre_planta`, `ciudad_id`, `responsable_id`, `created`) VALUES
(1, 'Buga', 10, 0, '2025-01-26 19:53:03'),
(2, 'Palmira', 10, NULL, '2025-01-29 19:30:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso`
--

CREATE TABLE `proceso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `linea_id` int(11) NOT NULL,
  `responsable_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proceso`
--

INSERT INTO `proceso` (`id`, `nombre`, `descripcion`, `linea_id`, `responsable_id`) VALUES
(1, 'EMPAQUE SÓLIDOS', 'EMPAQUE SÓLIDOS', 1, 0),
(2, 'ENVASE LÍQUIDOS', 'ENVASE LÍQUIDOS', 2, 0),
(3, 'FRACCIONAMIENTO', 'FRACCIONAMIENTO', 2, 0),
(4, 'INYECCION PREFORMA', 'INYECCION PREFORMA', 3, 0),
(5, 'INTERESTERIFICACION', 'INTERESTERIFICACION', 3, 0),
(6, 'INYECCIÓN CONVENCIONAL', 'INYECCIÓN CONVENCIONAL', 2, 0),
(7, 'INYECCIÓN PARED DELGADA IML', 'INYECCIÓN PARED DELGADA IML', 2, 0),
(8, 'INYECTO- SOPLADO', 'INYECTO- SOPLADO', 4, 0),
(9, 'JABONERÍA', 'INYECTO- SOPLADO', 4, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `planta_id` int(11) NOT NULL,
  `proceso_id` int(11) NOT NULL,
  `linea_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `codigo` varchar(60) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `planta_id`, `proceso_id`, `linea_id`, `nombre`, `codigo`, `descripcion`) VALUES
(1, 1, 1, 1, 'Harina', '231231564', 'Desc P1'),
(2, 1, 2, 3, 'Aceite', '002', 'Desc P2'),
(4, 2, 3, 4, 'Grasa', 'p3', 'Desc P3'),
(5, 1, 2, 1, 'Margarina', '054', 'Desc P4'),
(6, 2, 4, 3, 'Mantequilla', '809', 'mantequilla x 500g'),
(7, 1, 1, 2, 'Mantequilla', '809', 'mantequilla x 500g'),
(8, 2, 4, 3, 'Mantequilla', '809', 'mantequilla x 500g'),
(9, 1, 3, 1, 'Aceite', '809', ' x 500g'),
(10, 2, 4, 2, 'Aceite', '809', ' x 1500g');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `razones_paro`
--

CREATE TABLE `razones_paro` (
  `id` int(11) NOT NULL,
  `subparo_id` int(11) DEFAULT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `razones_paro`
--

INSERT INTO `razones_paro` (`id`, `subparo_id`, `descripcion`) VALUES
(1, 1, 'ee43'),
(2, 1, 'Mantenimiento Preventivo'),
(3, 1, 'ee43'),
(4, 1, 'Mantenimiento Preventivo'),
(5, 2, 'Domingo, festivo'),
(6, 3, 'Tiempo ocasionado o asignable a otro proceso ajeno a esta línea'),
(7, 3, 'Tiempo sin programa'),
(8, 3, 'Tiempo no programado por actividad especial'),
(9, 3, 'Prioridad a otra línea de producción por planeación'),
(10, 3, 'Tiempo no programado por capacitación'),
(11, 4, 'No programado por política local'),
(12, 5, 'Inventario programado'),
(13, 6, 'Alimentación y refrigerio'),
(14, 6, 'Relevos planeados en otras líneas por alimentación y refrigerio\r\n'),
(15, 7, 'Falta de materia prima (bases grasas)'),
(16, 7, 'Falta de material de empaque'),
(17, 7, 'Falta Insumo'),
(18, 8, 'Electricidad\r\n'),
(19, 8, 'Agua Potable\r\n'),
(20, 8, 'PTAR'),
(21, 8, 'Nitrógeno\r\n'),
(22, 8, 'Combustible'),
(23, 8, 'Aire'),
(24, 8, 'Vapor'),
(25, 8, 'Amoníaco\r\n'),
(26, 9, 'Falta personal'),
(27, 10, 'Ensayos de investigación y desarrollo'),
(28, 10, 'Otros ensayos'),
(29, 11, 'Limpieza y desinfección planeada'),
(30, 12, 'Esperando alcanzar condiciones de proceso'),
(31, 12, 'Preparación de insumos / ingredientes / batch de producto '),
(32, 8, 'Vapor'),
(33, 8, 'Amoníaco\r\n'),
(34, 13, 'Drenaje'),
(35, 13, 'Esperando alcanzar condiciones para fin de proceso'),
(36, 14, 'En espera de resultados de análisis de laboratorio'),
(37, 14, 'Por preparación de insumos / ingredientes / batch de producto '),
(38, 15, 'Daño eléctrico equipo'),
(39, 15, 'Daño electrónico equipo'),
(40, 16, 'Daño instrumentación equipo'),
(41, 17, 'Daño mecánico equipo'),
(42, 18, 'Drenaje'),
(43, 18, 'Cambio, Lavados y/o Barrido de la línea y equipos'),
(44, 18, 'Cambio de material de empaque por cambio de producto'),
(45, 19, 'Cambio de formato (cambios de presentación, gramaje, moldes)'),
(46, 20, 'Cambio de ingrediente'),
(47, 20, 'Cambio de Insumo'),
(48, 20, 'Cambio de rollo / material de empaque'),
(49, 20, 'Cambio de tinta/solvente en codificadores'),
(50, 21, 'Información errada / incompleta'),
(51, 22, 'Falta de agua'),
(52, 22, 'Falta aire comprimido'),
(53, 22, 'Falta combustible'),
(54, 22, 'Falta de refrigeración'),
(55, 22, 'Falta energía eléctrica'),
(56, 22, 'Falta Vapor'),
(57, 22, 'No se encuentra el repuesto en almacén'),
(58, 23, 'Accidentes de trabajo y/o condiciones de riesgo activadas'),
(59, 23, 'Accidentes Ambientales y/o condicione de riesgo activadas'),
(60, 23, 'Evento de inocuidad y/o condicione de riesgo activadas'),
(61, 24, 'Capacitación no programada'),
(62, 24, 'Reunión no programada'),
(63, 24, 'Otro'),
(64, 25, 'Dar prioridad a alguna línea'),
(65, 25, 'Solicitud de adelanto de producción'),
(66, 26, 'Operación realizada por personal en entrenamiento / inducción'),
(67, 27, 'Derrame de insumo o ingrediente'),
(68, 27, 'Derrame de producto'),
(69, 27, 'Limpieza entrega de turno/Programar tiempo limite y ventanas horarias'),
(70, 28, 'Falta mano de obra para operar una máquina o equipo (EXPERIENCIA CONOCIMIENTO)'),
(71, 28, 'Interrupción de líneas para dar prioridad a otra'),
(72, 28, 'Ausentismos o calamidades'),
(73, 29, 'No hay disponibilidad de Silos'),
(74, 29, 'No hay disponibilidad de tanques'),
(75, 29, 'No hay espacio en Bodegas'),
(76, 30, 'Falta de abastecimiento de Material de empaque'),
(77, 30, 'Falta de abastecimiento de insumos e ingredientes'),
(78, 31, 'Adición / cancelación de producto por planeación'),
(79, 32, 'Falta de Materia prima (Palma, soya, canola, palmiste, girasol, otros)'),
(80, 33, 'No hay disponibilidad de silos'),
(81, 33, 'No hay disponibilidad de tanques'),
(82, 33, 'No hay espacio en Bodegas'),
(83, 34, 'Describa la razón del paro'),
(84, 35, 'Falta de material de empaque'),
(85, 35, 'No hay disponibilidad de tanques'),
(86, 35, 'No hay espacio en Bodegas'),
(87, 36, 'Espera análisis de laboratorio de pilotos o reformulaciones'),
(88, 36, 'Espera de análisis de laboratorio'),
(89, 37, 'Limpieza de equipo por desviaciones de inocuidad'),
(90, 38, 'Ajustes por variaciones de las condiciones de proceso'),
(91, 39, 'Ajuste por variación de calidad de materia prima'),
(92, 39, 'Ajuste por variación de las condiciones del producto'),
(93, 39, 'Ajuste por variación de calidad de material de empaque'),
(94, 40, 'Atascamiento línea y/o banda de producto'),
(95, 40, 'Pequeñas paradas'),
(96, 40, 'Limpiezas pequeñas línea y/o banda de producto'),
(97, 41, 'Asociado a calidad'),
(98, 41, 'Asociado a personal'),
(99, 41, 'Asociado a equipo'),
(100, 42, 'Tiempos en vacío'),
(101, 43, 'Productos defectuosos'),
(102, 44, 'Reproceso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `refencia_linea`
--

CREATE TABLE `refencia_linea` (
  `id` int(11) NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `capacidad_teorica` varchar(255) NOT NULL,
  `linea_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`) VALUES
(1, 'Root'),
(2, 'Administrador'),
(3, 'Supervisor'),
(4, 'Operador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subparos`
--

CREATE TABLE `subparos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `paro_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subparos`
--

INSERT INTO `subparos` (`id`, `nombre`, `paro_id`) VALUES
(1, 'Mantenimiento Programado', 1),
(2, 'Domingo, Festivo', 2),
(3, 'Tiempo no programado', 2),
(4, 'No programado por política local', 2),
(5, 'Inventario', 2),
(6, 'Tiempo planeado para descanso y refrigerio', 2),
(7, 'Materia prima, insumos y/o material de empaque', 3),
(8, 'Servicios', 3),
(9, 'Personal', 3),
(10, 'Pruebas planeadas', 4),
(11, 'Limpieza y desinfección planeadas', 5),
(12, 'Arranque de proceso', 6),
(13, 'Fin de Proceso', 6),
(14, 'Esperas por Análisis de laboratorio', 6),
(15, 'Daño eléctrico', 1),
(16, 'Daño instrumentación equipo', 1),
(17, 'Daño mecánico', 1),
(18, 'Cambio de producto', 2),
(19, 'Cambio de formato (referencia)', 2),
(20, 'Cambio insumos / material de empaque', 3),
(21, 'Problemas de Comunicación', 4),
(22, 'Daño y/o suspensión de servicios', 4),
(23, 'Riesgos y/o accidentes (SST, Ambientales e Inocuidad)', 4),
(24, 'Reuniones No programadas', 4),
(25, 'Adelantos de Producción', 4),
(26, 'Falta de Habilidad en los operadores', 4),
(27, 'Limpiezas', 4),
(28, 'Personal Faltante', 5),
(29, 'Falta de espacio de almacenamiento externo', 6),
(30, 'Falta de abastecimiento de MEEI´s', 6),
(31, 'Cambios del programa de producción', 6),
(32, 'Faltante de Materia Prima', 6),
(33, 'Falta de espacio de Almacenamiento interno', 7),
(34, 'Entrega de Materia Prima Ineficiente', 7),
(35, 'Falta de abastecimiento de MEEI´s', 7),
(36, 'Espera análisis de laboratorio', 8),
(37, 'Limpieza de equipos por condiciones', 8),
(38, 'Ajuste de maquina', 8),
(39, 'Ajustes calidad de producto', 8),
(40, 'Ajustes de proceso y condición', 9),
(41, 'Tiempo baja velocidad', 10),
(42, 'Tiempos en vacío', 10),
(43, 'Productos defectuosos', 11),
(44, 'Reproceso', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id` int(11) NOT NULL,
  `turno` varchar(255) NOT NULL,
  `planta_id` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `turno`, `planta_id`, `fecha_inicio`, `fecha_fin`, `hora_inicio`, `hora_fin`, `created`) VALUES
(1, '1', 1, '2025-01-01', '2025-01-31', '06:00:00', '14:00:00', '2025-01-27 03:34:57'),
(2, '2', 1, '2025-01-01', '2025-01-31', '14:00:00', '22:00:00', '2025-01-27 03:35:49'),
(3, '3', 1, '2025-01-01', '2025-01-31', '22:00:00', '06:00:00', '2025-01-27 03:36:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `credencial` varchar(255) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `identificacion` bigint(20) NOT NULL,
  `creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `usuario`, `credencial`, `rol_id`, `identificacion`, `creacion`) VALUES
(2, 'ALEXANDER', 'OREJUELA  ARBOLEDA', 'root', '$2y$10$2ntEdxSS/UY4518ec8GYUejHlzaolXBKHieH..LvJYWu1DFu.5S6y', 1, 14696620, '2024-11-27 15:08:49'),
(3, 'Emilia11', 'Jeiger11', 'jemilia11', '$2y$10$qwUeAjtFo05TwxpI5IK4AOY/BpDu.645ZLik48LTS9KnUTNLhpONm', 3, 1112233, '2024-11-27 15:52:19'),
(5, 'juan ', 'Patiño', 'j.patino', '$2y$10$8tjkp3O5Z27u3h1TmNytt.8TNe.NGVy5/DjRwYC1sIsHlq/0nMGGO', 2, 123456, '2025-01-16 22:03:53'),
(6, 'ALEXANDER', 'OREJUELA  ARBOLEDA', 'a.orejuela', '$2y$10$Hrt.VJQWPH7mBHFXGCt9lulA9Mavgg9z9PFaZsOKAJysJrnQciV62', 2, 7894444, '2025-01-17 14:16:44');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departamento` (`departamento`);

--
-- Indices de la tabla `control_capacidad`
--
ALTER TABLE `control_capacidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `danoequipo`
--
ALTER TABLE `danoequipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipo` (`equipo`);

--
-- Indices de la tabla `definicion`
--
ALTER TABLE `definicion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pais` (`pais`);

--
-- Indices de la tabla `dtiempo`
--
ALTER TABLE `dtiempo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `linea`
--
ALTER TABLE `linea`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proceso` (`proceso`);

--
-- Indices de la tabla `lineaproducto`
--
ALTER TABLE `lineaproducto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `linea` (`linea_id`),
  ADD KEY `producto` (`producto_id`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paros`
--
ALTER TABLE `paros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dtiempo_id` (`dtiempo_id`);

--
-- Indices de la tabla `plantas`
--
ALTER TABLE `plantas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proceso`
--
ALTER TABLE `proceso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `linea_id` (`linea_id`),
  ADD KEY `planta_id` (`planta_id`),
  ADD KEY `proceso_id` (`proceso_id`);

--
-- Indices de la tabla `razones_paro`
--
ALTER TABLE `razones_paro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subparo_id` (`subparo_id`);

--
-- Indices de la tabla `refencia_linea`
--
ALTER TABLE `refencia_linea`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subparos`
--
ALTER TABLE `subparos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paro_id` (`paro_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `control_capacidad`
--
ALTER TABLE `control_capacidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `danoequipo`
--
ALTER TABLE `danoequipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT de la tabla `definicion`
--
ALTER TABLE `definicion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `linea`
--
ALTER TABLE `linea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `lineaproducto`
--
ALTER TABLE `lineaproducto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `plantas`
--
ALTER TABLE `plantas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proceso`
--
ALTER TABLE `proceso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `razones_paro`
--
ALTER TABLE `razones_paro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de la tabla `refencia_linea`
--
ALTER TABLE `refencia_linea`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `paros`
--
ALTER TABLE `paros`
  ADD CONSTRAINT `paros_ibfk_1` FOREIGN KEY (`dtiempo_id`) REFERENCES `dtiempo` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`linea_id`) REFERENCES `linea` (`id`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`planta_id`) REFERENCES `plantas` (`id`),
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`proceso_id`) REFERENCES `proceso` (`id`);

--
-- Filtros para la tabla `razones_paro`
--
ALTER TABLE `razones_paro`
  ADD CONSTRAINT `razones_paro_ibfk_1` FOREIGN KEY (`subparo_id`) REFERENCES `subparos` (`id`);

--
-- Filtros para la tabla `subparos`
--
ALTER TABLE `subparos`
  ADD CONSTRAINT `subparos_ibfk_1` FOREIGN KEY (`paro_id`) REFERENCES `paros` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
