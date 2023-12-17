-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-12-2023 a las 18:24:42
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cleanshoes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boleta`
--

CREATE TABLE `boleta` (
  `id_Boleta` int(11) NOT NULL,
  `id_Orden` int(11) NOT NULL,
  `igv` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_Cliente` int(11) NOT NULL,
  `id_Persona` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_Cliente`, `id_Persona`, `id_Usuario`, `fecha_creacion`) VALUES
(3, 6, 6, '2023-12-10 14:20:01'),
(4, 7, 7, '2023-12-10 14:58:47'),
(5, 8, 8, '2023-12-10 15:08:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descripcion`
--

CREATE TABLE `descripcion` (
  `id_Descripcion` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `descripcion`
--

INSERT INTO `descripcion` (`id_Descripcion`, `nombre`) VALUES
(1, 'Cuerpo exterior'),
(2, 'Media suela'),
(3, 'Secado delicado'),
(4, 'Cuerpo exterior e interior'),
(5, 'Pasadores'),
(6, 'Desodorización'),
(7, 'Plantillas'),
(8, 'Suela');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_descripcion`
--

CREATE TABLE `detalle_descripcion` (
  `id_DetalleDescripcion` int(11) NOT NULL,
  `id_Servicio` int(11) NOT NULL,
  `id_Descripcion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_descripcion`
--

INSERT INTO `detalle_descripcion` (`id_DetalleDescripcion`, `id_Servicio`, `id_Descripcion`) VALUES
(1, 4, 1),
(2, 4, 2),
(3, 4, 3),
(4, 5, 4),
(5, 5, 2),
(6, 5, 5),
(7, 5, 3),
(8, 5, 6),
(9, 6, 4),
(10, 6, 2),
(11, 6, 5),
(12, 6, 8),
(13, 6, 7),
(14, 6, 3),
(15, 6, 6),
(16, 17, 4),
(17, 17, 2),
(18, 17, 5),
(19, 17, 3),
(20, 17, 6),
(21, 18, 4),
(22, 18, 2),
(23, 18, 5),
(24, 18, 8),
(25, 18, 3),
(26, 18, 6),
(27, 19, 1),
(28, 19, 2),
(29, 19, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_servicio`
--

CREATE TABLE `detalle_servicio` (
  `id_DetalleServicio` int(11) NOT NULL,
  `id_Servicio` int(11) NOT NULL,
  `id_Orden` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `subTotal` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_servicio`
--

INSERT INTO `detalle_servicio` (`id_DetalleServicio`, `id_Servicio`, `id_Orden`, `cantidad`, `subTotal`) VALUES
(59, 4, 77, 2, 30),
(60, 5, 77, 5, 125),
(65, 4, 78, 3, 45),
(66, 6, 78, 4, 140),
(68, 13, 79, 1, 29),
(69, 12, 79, 2, 38);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion_envio`
--

CREATE TABLE `direccion_envio` (
  `id_Direccion_Envio` int(11) NOT NULL,
  `id_Cliente` int(11) NOT NULL,
  `distrito` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `direccion_envio`
--

INSERT INTO `direccion_envio` (`id_Direccion_Envio`, `id_Cliente`, `distrito`, `direccion`, `referencia`, `estado`) VALUES
(3, 3, 'Chiclayo', 'Avenida chiclayo 1979', 'Frente al parquesito', 'Activo'),
(4, 4, 'CHICLAYO', 'Avenida Lambayeque 1979', 'Frente a Lima gas', 'Activo'),
(5, 5, 'JLO', 'Av. Chiclayo 1975', 'A dos cuadras de la despensa', 'Activo'),
(12, 3, 'Chiclayo', 'Calle Eligas Aguirre 4855', 'Frente al mercado', 'Activo'),
(13, 3, 'La victoria', 'Lambayeque 445', 'Frente al parde', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `id_Orden` int(11) NOT NULL,
  `id_Cliente` int(11) NOT NULL,
  `id_Direccion` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `tipoDespacho` varchar(50) DEFAULT NULL,
  `tipoPago` varchar(50) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `tiempoTotalEntrega` int(11) DEFAULT NULL,
  `estado_pago` varchar(20) DEFAULT NULL,
  `estado_orden` varchar(20) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orden`
--

INSERT INTO `orden` (`id_Orden`, `id_Cliente`, `id_Direccion`, `total`, `tipoDespacho`, `tipoPago`, `descripcion`, `tiempoTotalEntrega`, `estado_pago`, `estado_orden`, `fecha_creacion`) VALUES
(77, 3, 3, 155, 'Domicilio', NULL, NULL, NULL, NULL, 'Pendiente', '2023-12-17 10:59:53'),
(78, 3, NULL, 185, 'Tienda', NULL, NULL, NULL, NULL, 'Pendiente', '2023-12-17 11:16:37'),
(79, 3, NULL, 67, 'Tienda', NULL, NULL, NULL, NULL, 'Pendiente', '2023-12-17 11:17:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_Persona` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `dni` varchar(12) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `celular` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_Persona`, `nombres`, `apellidos`, `dni`, `correo`, `celular`) VALUES
(6, 'Nemias David', 'Vasquez', '73116807', 'nemiasvasquezs@hotmail.com', '955651442'),
(7, 'Dayra Fabiola', 'Vasquez Suarez', '87654321', 'dayra@hotmail.com', '955651442'),
(8, 'Mildred Yolanda', 'Suarez Alvarado', '12312312', 'mildred@hotmail.com', '966651442');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id_Servicio` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `n_Pares` int(5) DEFAULT NULL,
  `descripcion_Simple` varchar(30) DEFAULT NULL,
  `tiempo_estimado_entrega` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `categoria` varchar(20) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_Servicio`, `nombre`, `precio`, `n_Pares`, `descripcion_Simple`, `tiempo_estimado_entrega`, `fecha_creacion`, `categoria`, `estado`) VALUES
(4, 'Lavado Simple', 15, 1, 'Limpieza superficial', 2, '2023-12-03 14:48:31', 'Principal', 'Activo'),
(5, 'Lavado Estándar', 25, 1, 'Limpieza interior y exterior', 3, '2023-12-03 14:48:32', 'Principal', 'Activo'),
(6, 'Lavado Premium', 35, 1, 'Limpieza profunda', 4, '2023-12-03 14:48:32', 'Principal', 'Activo'),
(11, 'Blanqueamiento con UV de media suela', 20, 1, NULL, NULL, '2023-12-03 20:21:08', 'Adicional', 'Activo'),
(12, 'Repintado de zapatillas', 19, 1, '(Parte pequeña)', NULL, '2023-12-03 20:21:08', 'Adicional', 'Activo'),
(13, 'Repintado de zapatillas', 29, 1, '(Parte grande)', NULL, '2023-12-03 20:21:08', 'Adicional', 'Activo'),
(14, 'Repintado de zapatillas', 39, 1, '(Todo el calzado)', NULL, '2023-12-03 20:21:08', 'Adicional', 'Activo'),
(15, 'Cambio de color', 59, 1, NULL, NULL, '2023-12-03 20:21:08', 'Adicional', 'Activo'),
(16, 'Restauración de gamuza', 10, 1, NULL, NULL, '2023-12-03 20:21:08', 'Adicional', 'Activo'),
(17, '3 Pares Lavado Estandar', 60, 3, 'Limpieza interior y exterior', 2, '2023-12-03 22:32:55', 'Promocion', 'Activo'),
(18, '3 Pares Lavado Premium', 80, 3, 'Limpieza profunda', 3, '2023-12-03 22:32:55', 'Promocion', 'Activo'),
(19, '3x2 Pares Lavado simple', 30, 3, 'Limpieza superficial', 4, '2023-12-03 22:32:55', 'Promocion', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `id_Trabajador` int(11) NOT NULL,
  `id_Persona` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_Usuario` int(11) NOT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `password` varchar(20) NOT NULL,
  `rol` varchar(50) DEFAULT NULL,
  `estado` varchar(20) NOT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_Usuario`, `usuario`, `password`, `rol`, `estado`, `fecha_creacion`) VALUES
(6, 'NEMIASVS', 'nemias1234', 'Cliente', 'Activo', '2023-12-10 14:20:01'),
(7, 'dayra@hotmail.com', 'Dayra123', 'Cliente', 'Activo', '2023-12-10 14:58:47'),
(8, 'mildred@hotmail.com', 'Mildre123', 'Cliente', 'Activo', '2023-12-10 15:08:57');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `boleta`
--
ALTER TABLE `boleta`
  ADD PRIMARY KEY (`id_Boleta`),
  ADD KEY `id_Orden` (`id_Orden`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_Cliente`),
  ADD KEY `id_Persona` (`id_Persona`),
  ADD KEY `id_Usuario` (`id_Usuario`);

--
-- Indices de la tabla `descripcion`
--
ALTER TABLE `descripcion`
  ADD PRIMARY KEY (`id_Descripcion`);

--
-- Indices de la tabla `detalle_descripcion`
--
ALTER TABLE `detalle_descripcion`
  ADD PRIMARY KEY (`id_DetalleDescripcion`),
  ADD KEY `fk_id_detalle_descripcion` (`id_Servicio`),
  ADD KEY `fk_id_Detalle_Descripcion_Descripcion` (`id_Descripcion`);

--
-- Indices de la tabla `detalle_servicio`
--
ALTER TABLE `detalle_servicio`
  ADD PRIMARY KEY (`id_DetalleServicio`),
  ADD KEY `id_Servicio` (`id_Servicio`),
  ADD KEY `id_Orden` (`id_Orden`);

--
-- Indices de la tabla `direccion_envio`
--
ALTER TABLE `direccion_envio`
  ADD PRIMARY KEY (`id_Direccion_Envio`),
  ADD KEY `id_Cliente` (`id_Cliente`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`id_Orden`),
  ADD KEY `id_Cliente` (`id_Cliente`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_Persona`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_Servicio`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`id_Trabajador`),
  ADD KEY `id_Persona` (`id_Persona`),
  ADD KEY `id_Usuario` (`id_Usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `boleta`
--
ALTER TABLE `boleta`
  MODIFY `id_Boleta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `descripcion`
--
ALTER TABLE `descripcion`
  MODIFY `id_Descripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalle_descripcion`
--
ALTER TABLE `detalle_descripcion`
  MODIFY `id_DetalleDescripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `detalle_servicio`
--
ALTER TABLE `detalle_servicio`
  MODIFY `id_DetalleServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `direccion_envio`
--
ALTER TABLE `direccion_envio`
  MODIFY `id_Direccion_Envio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `id_Orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_Persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_Servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  MODIFY `id_Trabajador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `boleta`
--
ALTER TABLE `boleta`
  ADD CONSTRAINT `boleta_ibfk_1` FOREIGN KEY (`id_Orden`) REFERENCES `orden` (`id_Orden`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_Persona`) REFERENCES `persona` (`id_Persona`),
  ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`id_Usuario`) REFERENCES `usuario` (`id_Usuario`);

--
-- Filtros para la tabla `detalle_descripcion`
--
ALTER TABLE `detalle_descripcion`
  ADD CONSTRAINT `fk_id_Detalle_Descripcion_Descripcion` FOREIGN KEY (`id_Descripcion`) REFERENCES `descripcion` (`id_Descripcion`),
  ADD CONSTRAINT `fk_id_detalle_descripcion` FOREIGN KEY (`id_Servicio`) REFERENCES `servicio` (`id_Servicio`);

--
-- Filtros para la tabla `detalle_servicio`
--
ALTER TABLE `detalle_servicio`
  ADD CONSTRAINT `detalle_servicio_ibfk_1` FOREIGN KEY (`id_Servicio`) REFERENCES `servicio` (`id_Servicio`),
  ADD CONSTRAINT `detalle_servicio_ibfk_2` FOREIGN KEY (`id_Orden`) REFERENCES `orden` (`id_Orden`);

--
-- Filtros para la tabla `direccion_envio`
--
ALTER TABLE `direccion_envio`
  ADD CONSTRAINT `direccion_envio_ibfk_1` FOREIGN KEY (`id_Cliente`) REFERENCES `cliente` (`id_Cliente`);

--
-- Filtros para la tabla `orden`
--
ALTER TABLE `orden`
  ADD CONSTRAINT `orden_ibfk_1` FOREIGN KEY (`id_Cliente`) REFERENCES `cliente` (`id_Cliente`);

--
-- Filtros para la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD CONSTRAINT `trabajador_ibfk_1` FOREIGN KEY (`id_Persona`) REFERENCES `persona` (`id_Persona`),
  ADD CONSTRAINT `trabajador_ibfk_2` FOREIGN KEY (`id_Usuario`) REFERENCES `usuario` (`id_Usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
