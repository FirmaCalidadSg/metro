-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-02-2025 a las 15:36:45
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

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
-- Estructura de tabla para la tabla `categoriaparos`
--

CREATE TABLE `categoriaparos` (
  `id_categoria` int(11) NOT NULL,
  `id_distribucion` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoriaparos`
--

INSERT INTO `categoriaparos` (`id_categoria`, `id_distribucion`, `nombre`, `descripcion`) VALUES
(5, 1, 'Planeado De No Operación', 'Planeado De No Operación'),
(6, 1, 'Paros Operacionales', 'Paros Operacionales'),
(7, 1, 'Fallas de Equipos', 'Fallas de Equipos'),
(8, 1, 'Fallas Organizacionales', 'Fallas Organizacionales'),
(9, 1, 'Productos de Calidad', 'Productos de Calidad');

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
(1, 1, 'Descripcion E1', '2024-11-29 22:50:00', 'OK');

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
(1, 'D1', 'Definicion valors', 'Descripcion D1');

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
-- Estructura de tabla para la tabla `distribuciontiempos`
--

CREATE TABLE `distribuciontiempos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `distribuciontiempos`
--

INSERT INTO `distribuciontiempos` (`id`, `nombre`) VALUES
(2, 'Paradas Y/O Ajustes (Mantenimiento)'),
(3, 'Paradas Y/O Ajustes (Proceso) (Disponibilidad)'),
(4, 'Perdidas De Velocidad (Rendimiento)'),
(1, 'Planeado De No Operación'),
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
(1, 'E1', 'EM1---', 'OK'),
(3, 'E2', 'EM2', 'OK');

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
  `linea` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `capacidad_produccion` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `lineaproducto`
--

INSERT INTO `lineaproducto` (`id`, `linea`, `producto`, `capacidad_produccion`) VALUES
(1, 1, 1, 0.2),
(2, 1, 2, 0.22),
(3, 4, 2, 8);

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
-- Estructura de tabla para la tabla `plantas`
--

CREATE TABLE `plantas` (
  `id` int(11) NOT NULL,
  `nombre_planta` varchar(255) NOT NULL,
  `ciudad_id` int(11) NOT NULL,
  `responsable_id` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `plantas`
--

INSERT INTO `plantas` (`id`, `nombre_planta`, `ciudad_id`, `responsable_id`, `created`) VALUES
(1, 'Buga', 10, NULL, '2025-01-26 19:53:03'),
(2, 'Palmira', 10, NULL, '2025-01-29 19:30:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso`
--

CREATE TABLE `proceso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `planta_id` int(11) NOT NULL,
  `responsable_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proceso`
--

INSERT INTO `proceso` (`id`, `nombre`, `descripcion`, `planta_id`, `responsable_id`) VALUES
(1, 'EMPAQUE SÓLIDOS', 'EMPAQUE SÓLIDOS', 1, 0),
(3, 'ENVASE LÍQUIDOS', 'ENVASE LÍQUIDOS', 1, 0),
(4, 'FRACCIONAMIENTO', 'FRACCIONAMIENTO', 1, 0),
(5, 'INYECCION PREFORMA', 'INYECCION PREFORMA', 1, 0),
(6, 'INTERESTERIFICACION', 'INTERESTERIFICACION', 1, 0),
(7, 'INYECCIÓN CONVENCIONAL', 'INYECCIÓN CONVENCIONAL', 1, 0),
(8, 'INYECCIÓN PARED DELGADA IML', 'INYECCIÓN PARED DELGADA IML', 1, 0),
(9, 'INYECTO- SOPLADO', 'INYECTO- SOPLADO', 1, 0),
(10, 'JABONERÍA', 'INYECTO- SOPLADO', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `codigo` varchar(60) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `codigo`, `descripcion`) VALUES
(1, 'Producto 1', '231231564', 'Desc P1'),
(2, 'Producto 2', '002', 'Desc P2');

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
-- Estructura de tabla para la tabla `subcategoriaparos`
--

CREATE TABLE `subcategoriaparos` (
  `id_subcategoria` int(11) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subcategoriaparos`
--

INSERT INTO `subcategoriaparos` (`id_subcategoria`, `id_categoria`, `nombre`, `descripcion`) VALUES
(10, 5, 'Mantenimiento Programado', 'Mantenimiento Programado'),
(11, 5, 'Tiempo fuera de programación', 'Tiempo fuera de programación'),
(12, 5, 'Falta de programación', 'Falta de programación'),
(13, 6, 'Cambios y ajustes', 'Cambios y ajustes'),
(14, 6, 'Limpieza operacional', 'Limpieza operacional'),
(15, 7, 'Fallas mecánicas', 'Fallas mecánicas'),
(16, 7, 'Fallas eléctricas', 'Fallas eléctricas'),
(17, 8, 'Falta de materiales', 'Falta de materiales'),
(18, 8, 'Falta de personal', 'Falta de personal'),
(19, 8, 'Falta de servicios', 'Falta de servicios'),
(20, 9, 'Productos defectuosos	', 'Productos defectuosos	'),
(21, 9, 'Reproceso', 'Reproceso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposparos`
--

CREATE TABLE `tiposparos` (
  `id_tipo` int(11) NOT NULL,
  `id_subcategoria` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tiposparos`
--

INSERT INTO `tiposparos` (`id_tipo`, `id_subcategoria`, `nombre`, `descripcion`) VALUES
(1, 10, 'Mantenimiento Correctivo	', 'Mantenimiento Correctivo	'),
(2, 10, 'Mantenimiento Preventivo	', 'Mantenimiento Preventivo	'),
(3, 11, 'Domingo, festivo', 'Domingo, festivo'),
(4, 12, 'Sin programa de producción', 'Sin programa de producción'),
(5, 13, 'Cambio de formato', 'Cambio de formato'),
(6, 13, 'Cambio de sabor', 'Cambio de sabor'),
(7, 13, 'Ajustes de equipo', 'Ajustes de equipo'),
(8, 14, 'Limpieza de equipo', 'Limpieza de equipo'),
(9, 15, 'Falla mecánica', 'Falla mecánica'),
(10, 16, 'Falla eléctrica', 'Falla eléctrica'),
(11, 17, 'Falta de materia prima', 'Falta de materia prima');

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
(1, '1', 1, '2025-01-01', '2025-01-31', '06:00:00', '14:00:00', '2025-01-26 22:34:57'),
(2, '2', 1, '2025-01-01', '2025-01-31', '14:00:00', '22:00:00', '2025-01-26 22:35:49'),
(3, '3', 1, '2025-01-01', '2025-01-31', '22:00:00', '06:00:00', '2025-01-26 22:36:09');

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
-- Indices de la tabla `categoriaparos`
--
ALTER TABLE `categoriaparos`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departamento` (`departamento`);

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
-- Indices de la tabla `distribuciontiempos`
--
ALTER TABLE `distribuciontiempos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

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
  ADD KEY `linea` (`linea`),
  ADD KEY `producto` (`producto`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `subcategoriaparos`
--
ALTER TABLE `subcategoriaparos`
  ADD PRIMARY KEY (`id_subcategoria`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `tiposparos`
--
ALTER TABLE `tiposparos`
  ADD PRIMARY KEY (`id_tipo`),
  ADD KEY `id_subcategoria` (`id_subcategoria`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
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
-- AUTO_INCREMENT de la tabla `categoriaparos`
--
ALTER TABLE `categoriaparos`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `danoequipo`
--
ALTER TABLE `danoequipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `definicion`
--
ALTER TABLE `definicion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `distribuciontiempos`
--
ALTER TABLE `distribuciontiempos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT de la tabla `subcategoriaparos`
--
ALTER TABLE `subcategoriaparos`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `tiposparos`
--
ALTER TABLE `tiposparos`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `subcategoriaparos`
--
ALTER TABLE `subcategoriaparos`
  ADD CONSTRAINT `subcategoriaparos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoriaparos` (`id_categoria`);

--
-- Filtros para la tabla `tiposparos`
--
ALTER TABLE `tiposparos`
  ADD CONSTRAINT `tiposparos_ibfk_1` FOREIGN KEY (`id_subcategoria`) REFERENCES `subcategoriaparos` (`id_subcategoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
