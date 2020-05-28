-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 25-05-2020 a las 18:15:02
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `atenea`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aspecto`
--

CREATE TABLE `aspecto` (
  `id` int(11) NOT NULL,
  `favorable` tinyint(1) NOT NULL,
  `interno` tinyint(1) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `aspecto`
--

INSERT INTO `aspecto` (`id`, `favorable`, `interno`, `descripcion`) VALUES
(24, 1, 1, 'gasdgadsg'),
(25, 1, 0, 'Ramon oportunidad'),
(26, 0, 0, 'yuiouioyiou'),
(27, 0, 1, 'Ramon debildiad'),
(30, 1, 0, 'Rafa oportunidad'),
(31, 0, 1, 'asdgasgdasdg'),
(32, 0, 0, 'Rafa Amenaza'),
(33, 1, 0, 'Rafa Oportunidad 2'),
(34, 1, 0, 'Ramon oportunidad 2'),
(36, 0, 0, 'Pruebaas'),
(37, 1, 1, 'Fortaleza'),
(38, 1, 1, 'Prueba'),
(51, 1, 1, 'andres fortaleza'),
(52, 0, 0, 'andres amenaza'),
(53, 1, 0, 'andres oportunidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aspecto_cuestion`
--

CREATE TABLE `aspecto_cuestion` (
  `aspecto_id` int(11) NOT NULL,
  `cuestion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `aspecto_cuestion`
--

INSERT INTO `aspecto_cuestion` (`aspecto_id`, `cuestion_id`) VALUES
(24, 12),
(25, 13),
(26, 13),
(27, 12),
(30, 14),
(31, 15),
(32, 14),
(33, 14),
(34, 13),
(34, 17),
(36, 14),
(37, 15),
(37, 16),
(38, 16),
(51, 20),
(52, 21),
(53, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE `contrato` (
  `id` int(11) NOT NULL,
  `unidad_id_id` int(11) NOT NULL,
  `fecha_alta` date NOT NULL,
  `fecha_baja` date DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contrato`
--

INSERT INTO `contrato` (`id`, `unidad_id_id`, `fecha_alta`, `fecha_baja`, `descripcion`) VALUES
(8, 14, '2020-04-30', '2023-04-30', 'Descripcion asdasdgfandsgoanidsg'),
(13, 43, '2020-05-09', '2021-07-09', 'asdgasdgasdgasdgasd'),
(15, 54, '2020-05-25', '2021-05-25', 'contrato andres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuestion`
--

CREATE TABLE `cuestion` (
  `id` int(11) NOT NULL,
  `subtipo_id` int(11) NOT NULL,
  `interno` tinyint(1) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cuestion`
--

INSERT INTO `cuestion` (`id`, `subtipo_id`, `interno`, `descripcion`) VALUES
(12, 9, 1, 'Ramon?'),
(13, 10, 0, 'Ramon externo?'),
(14, 10, 0, 'Rafa externa'),
(15, 11, 1, 'Rafa interna'),
(16, 9, 1, 'Rafa interna 2'),
(17, 10, 0, 'Ramon externa 3'),
(20, 9, 1, 'C interna andres'),
(21, 10, 0, 'c externa andres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuestion_unidad`
--

CREATE TABLE `cuestion_unidad` (
  `id` int(11) NOT NULL,
  `cuestion_id` int(11) DEFAULT NULL,
  `unidad_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cuestion_unidad`
--

INSERT INTO `cuestion_unidad` (`id`, `cuestion_id`, `unidad_id`) VALUES
(4, 12, 19),
(5, 13, 19),
(6, 14, 14),
(7, 15, 14),
(8, 16, 14),
(9, 17, 19),
(12, 20, 54),
(13, 21, 54);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expectativa`
--

CREATE TABLE `expectativa` (
  `id` int(11) NOT NULL,
  `parte_interesada_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `expectativa`
--

INSERT INTO `expectativa` (`id`, `parte_interesada_id`, `nombre`) VALUES
(7, 9, 'Reducir gastos'),
(8, 11, 'Reducir gastos'),
(9, 9, 'Reducir gastos 2'),
(10, 11, 'Reducir gastos 3'),
(19, 16, '1234'),
(21, 18, 'expectativa andres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factores_potenciales_de_exito`
--

CREATE TABLE `factores_potenciales_de_exito` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_alta` date NOT NULL,
  `fecha_baja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `factores_potenciales_de_exito`
--

INSERT INTO `factores_potenciales_de_exito` (`id`, `descripcion`, `fecha_alta`, `fecha_baja`) VALUES
(21, 'agasgdgd', '2020-05-12', '2020-05-12'),
(22, 'Factor Rafa', '2020-05-22', '2020-05-22'),
(23, 'Rafa Factor 2', '2020-05-20', '2020-05-20'),
(24, 'Factor 777', '2020-05-22', '2020-05-22'),
(25, 'Prueba', '2020-05-22', '2020-05-22'),
(28, 'Nuevo factor', '2020-05-22', '2020-05-22'),
(30, 'factor andres', '2020-05-24', '2020-05-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factores_potenciales_de_exito_aspecto`
--

CREATE TABLE `factores_potenciales_de_exito_aspecto` (
  `factores_potenciales_de_exito_id` int(11) NOT NULL,
  `aspecto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `factores_potenciales_de_exito_aspecto`
--

INSERT INTO `factores_potenciales_de_exito_aspecto` (`factores_potenciales_de_exito_id`, `aspecto_id`) VALUES
(21, 24),
(21, 25),
(21, 26),
(21, 27),
(22, 31),
(22, 32),
(22, 33),
(22, 37),
(23, 30),
(23, 31),
(23, 32),
(23, 33),
(24, 31),
(24, 32),
(24, 33),
(24, 36),
(24, 37),
(25, 31),
(25, 32),
(25, 36),
(25, 37),
(28, 30),
(28, 31),
(28, 32),
(28, 37),
(30, 51),
(30, 52),
(30, 53);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200425191827', '2020-04-27 15:19:52'),
('20200425192118', '2020-04-27 15:19:52'),
('20200428142316', '2020-04-28 14:23:55'),
('20200428152036', '2020-04-28 15:20:42'),
('20200428203953', '2020-04-28 20:39:57'),
('20200430153444', '2020-04-30 15:37:56'),
('20200430172601', '2020-04-30 17:26:09'),
('20200501144017', '2020-05-01 14:40:36'),
('20200504152746', '2020-05-04 15:27:59'),
('20200504161359', '2020-05-07 18:12:36'),
('20200511144105', '2020-05-11 14:41:13'),
('20200515211804', '2020-05-15 21:18:46'),
('20200519183635', '2020-05-20 14:46:53'),
('20200522124415', '2020-05-24 16:43:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partes_interesadas`
--

CREATE TABLE `partes_interesadas` (
  `id` int(11) NOT NULL,
  `tipo_parte_interesada_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `partes_interesadas`
--

INSERT INTO `partes_interesadas` (`id`, `tipo_parte_interesada_id`, `nombre`) VALUES
(9, 19, 'Pruebasss'),
(11, 3, 'asdfasdfasdfasdf'),
(16, 19, 'Nueva parte'),
(18, 21, 'parte andres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `tipo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `tipo`) VALUES
(1, 'l'),
(2, 'le');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subtipo_cuestion`
--

CREATE TABLE `subtipo_cuestion` (
  `id` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `interno` tinyint(1) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `subtipo_cuestion`
--

INSERT INTO `subtipo_cuestion` (`id`, `tipo_id`, `interno`, `descripcion`) VALUES
(9, 8, 1, 'Subtipo internos'),
(10, 9, 0, 'Subtipo externo'),
(11, 11, 1, 'Nuevo subtipo'),
(12, 8, 1, 'Prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cuestion`
--

CREATE TABLE `tipo_cuestion` (
  `id` int(11) NOT NULL,
  `interno` tinyint(1) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_cuestion`
--

INSERT INTO `tipo_cuestion` (`id`, `interno`, `descripcion`) VALUES
(8, 1, 'Tipo internas'),
(9, 0, 'Tipo externa'),
(10, 0, 'Tipo externa 2'),
(11, 1, 'Nuevo tipo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_partes_interesadas`
--

CREATE TABLE `tipo_partes_interesadas` (
  `id` int(11) NOT NULL,
  `unidad_de_gestion_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_partes_interesadas`
--

INSERT INTO `tipo_partes_interesadas` (`id`, `unidad_de_gestion_id`, `nombre`) VALUES
(3, 14, 'Proveedores'),
(10, 14, 'Mercancias'),
(19, 14, 'Tipo 32'),
(21, 54, 'tipo andres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_de_gestion`
--

CREATE TABLE `unidad_de_gestion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` int(11) NOT NULL,
  `unidad_de_gestion_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `unidad_de_gestion`
--

INSERT INTO `unidad_de_gestion` (`id`, `nombre`, `descripcion`, `tipo`, `unidad_de_gestion_id`) VALUES
(14, 'Rafa, S.L.', 'Bar de alterne', 1, NULL),
(16, 'Antonio,S.A', 'asdgadjfngadñlofgnañosdkgnañosdkgnasdñokfgnasd', 2, 14),
(17, 'Pepe, S.A', 'asdgadfoighajoñgiaksdñgoknasd', 3, 14),
(19, 'Ramon, S.L.U', 'asdgasdgasdgasdgas', 2, 14),
(43, 'Alberto, S.A', 'Gimnasio 24h', 1, NULL),
(54, 'Andres', 'Andres', 1, NULL),
(55, 'Andresito', 'Andres', 2, 54);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_alta` date NOT NULL,
  `fecha_baja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `roles`, `password`, `nombre`, `apellidos`, `telefono`, `fecha_alta`, `fecha_baja`) VALUES
(1, 'rafa@rafa.com', '[\"ROLE_ADMIN\"]', '$2y$13$KXRxoVknVazShaCDeXiL6OvRQyGc.j579xC/vYj1RwvOY8T2z9x8W', 'Rafa', 'Serrano Cárdenas', '123456789', '2020-04-27', NULL),
(17, 'rsanchez@gmail.com', '[\"ROLE_USER\"]', '$2y$13$1wnrH.BYU/Z6JZ1Y8EliBuCn.qgXQy44zuNy/mR4si2SCh5TU/PyK', 'Ramon', 'Sanchez Rodriguez', '123456789', '2020-05-04', NULL),
(19, 'usuario@usuario.com', '[\"ROLE_USER\"]', '$2y$13$2xc32T9D4Fb.SX0ei6YLpu3wQAcKxAmFRCwUcsNYtEL3zrz5bY6IO', 'Usuario', 'Testingg', '123456789', '2020-05-02', NULL),
(23, 'usuario4@usuario.com', '[\"ROLE_USER\"]', '$2y$13$I7qbZXiKDPuMHsBBCh75iu6e88J9dLex7hpOMZOBe6Rq90lQaTKiy', 'Usuario', 'Usuario', '123456789', '2020-05-02', NULL),
(24, 'usuario5@usuario.com', '[\"ROLE_USER\"]', '$2y$13$Ul4MpEvX5RB.Z7pv3r05reeUnNDhd/iHsxZZI.8ZQ6B3isiZ9eHdK', 'usuario', 'Usuario', '123456789', '2020-05-02', NULL),
(26, 'usuario6@usuario.com', '[\"ROLE_USER\"]', '$2y$13$re0J0Cj6W76dFvVl9Fl/tuTx30wdK3b9F5mwVakBOmTTxrWjhjzg.', 'Usuario', 'Usuario', '123456789', '2020-05-02', NULL),
(27, 'usuario7@usuario.com', '[\"ROLE_USER\"]', '$2y$13$cQetpfdHaez.Ar1XsqOxm.ScGJqII/3KIJtNYVoCni39Y76yBC68i', 'usuario', 'Usuario', '123456789', '2020-05-02', NULL),
(28, 'usuario8@usuario.com', '[\"ROLE_USER\"]', '$2y$13$M9UVHcNdY2zYSbO/XGiNoOv8fB/QU1EnvtF/8YbmuCeOOIGIMg2MC', 'Usuario', 'Usuario', '123456789', '2020-05-02', NULL),
(30, 'usuario9@usuario.com', '[\"ROLE_USER\"]', '$2y$13$oHmFZxE6Kb5a8JuDPpgWO.UbGNsxtm/rz/5jW41/zCSVC0pCYqSma', 'Usuario', 'Usuario', '123456789', '2020-05-02', NULL),
(32, 'usuario10@usuario.com', '[\"ROLE_USER\"]', '$2y$13$2U.4WbxBsJBI0E/zbME3Z.jgxn.V.IELbd0PbEA3KubddVX6GkrfK', 'Usuario', 'usuario', '123456789', '2020-05-02', NULL),
(33, 'usuario11@usuario.com', '[\"ROLE_USER\"]', '$2y$13$BEJsnVLmi8BjkZ6O.N8qkeezgfpG0ivcFYash6sDnKYIP9GY5zq16', 'Usuario', 'Usuario', '123456789', '2020-05-02', NULL),
(35, 'alberto@alberto.com', '[\"ROLE_SUPER\"]', '$2y$13$XAp7MzSylxZfcyQ9M9L0.u3lH2l6OjZmd.qlJ0x4nIjMWpShh1HPu', 'Alberto', 'Chica', '123456789', '2020-05-04', NULL),
(36, 'rsantana@gmail.com', '[\"ROLE_USER\"]', '$2y$13$emNufj05Tz5wcwf0ws0bDu5o9s1UhJZXL3x817RFUj.SSXzhzkIaK', 'Raul', 'Santana', '25425232', '2020-05-04', NULL),
(41, 'achica@gmail.com', '[\"ROLE_SUPER\"]', '$2y$13$w0J2LlPaXvWQXrvmZdYPNelyYmZa/GHxuRNmXB13SfvwowVo8oQLu', 'Alberto', 'Chica', '123456789', '2020-05-07', NULL),
(42, 'rserrano@gmail.com', '[\"ROLE_SUPER\"]', '$2y$13$HRuVXOr3rDlHZ8EZNXcgcul6OVbwPkOmwb9z6Iyy/wsoghNm4D41e', 'Rafa', 'Serrano', '123456789', '2020-05-09', NULL),
(43, 'asdfas@asdfasdf.com', '[\"ROLE_USER\"]', '$2y$13$lUNC59PJGVb3zLcXi7Pc..Z7hwg3/b98zUVAKS0VQQiCovYz8stb2', 'asdgasgd', 'asdgasdgasdg', '123456789', '2020-05-09', NULL),
(44, 'asdfasd@asdgagdf.com', '[\"ROLE_USER\"]', '$2y$13$3LpQlRVsp73b69EFN1BduuBAaXeoRSpQ7EphjCdFjn0e1vl1/RNMm', 'asdfasdgasdga', 'asdgasdgasdgadg', '123456789', '2020-05-09', NULL),
(45, 'super@super.com', '[\"ROLE_SUPER\"]', '$2y$13$vAHGno.UHSnhQZb15cAFz.01O/hMHAsbMBM/fx24Xz8eI/ngDgnra', 'Super', 'Usuario', '123456789', '2020-05-25', NULL),
(49, 'superandres@super.com', '[\"ROLE_SUPER\"]', '$2y$13$kkN1b6M4UQKg5fHchyh12.GsaPWWGOZkxpbiaZUOtJDF5YSRy51wG', 'Super', 'Andres', '123456789', '2020-05-25', NULL),
(50, 'afernandez@gmail.com', '[\"ROLE_USER\"]', '$2y$13$Qnq7HJ.2BnNc2LHI6LFeKeISs8r8jSpOmrOpyvG5cMymQpg5ih0x6', 'andres', 'fernandez', '123456789', '2020-05-24', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_unidad_permiso`
--

CREATE TABLE `usuario_unidad_permiso` (
  `id` int(11) NOT NULL,
  `permiso_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `unidad_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario_unidad_permiso`
--

INSERT INTO `usuario_unidad_permiso` (`id`, `permiso_id`, `usuario_id`, `unidad_id`) VALUES
(12, 2, 17, 19),
(14, 2, 19, 14),
(18, 2, 23, 14),
(19, 2, 24, 14),
(20, 2, 26, 14),
(21, 2, 27, 14),
(22, 2, 28, 14),
(23, 2, 30, 14),
(24, 2, 32, 14),
(25, 2, 33, 14),
(34, 1, 42, 43),
(35, 2, 43, 14),
(36, 2, 44, 14),
(37, 1, 45, 14),
(41, 1, 49, 54),
(42, 2, 50, 54);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aspecto`
--
ALTER TABLE `aspecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `aspecto_cuestion`
--
ALTER TABLE `aspecto_cuestion`
  ADD PRIMARY KEY (`aspecto_id`,`cuestion_id`),
  ADD KEY `IDX_E47BD33C1928CA76` (`aspecto_id`),
  ADD KEY `IDX_E47BD33CE8BD8BB5` (`cuestion_id`);

--
-- Indices de la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_66696523CEE5691C` (`unidad_id_id`);

--
-- Indices de la tabla `cuestion`
--
ALTER TABLE `cuestion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_88697F18E245C6A3` (`subtipo_id`);

--
-- Indices de la tabla `cuestion_unidad`
--
ALTER TABLE `cuestion_unidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_185FD1F9E8BD8BB5` (`cuestion_id`),
  ADD KEY `IDX_185FD1F99D01464C` (`unidad_id`);

--
-- Indices de la tabla `expectativa`
--
ALTER TABLE `expectativa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A9062C78EC8BC28` (`parte_interesada_id`);

--
-- Indices de la tabla `factores_potenciales_de_exito`
--
ALTER TABLE `factores_potenciales_de_exito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factores_potenciales_de_exito_aspecto`
--
ALTER TABLE `factores_potenciales_de_exito_aspecto`
  ADD PRIMARY KEY (`factores_potenciales_de_exito_id`,`aspecto_id`),
  ADD KEY `IDX_C22BD8CF3375A19F` (`factores_potenciales_de_exito_id`),
  ADD KEY `IDX_C22BD8CF1928CA76` (`aspecto_id`);

--
-- Indices de la tabla `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `partes_interesadas`
--
ALTER TABLE `partes_interesadas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FA9836F8483881C0` (`tipo_parte_interesada_id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subtipo_cuestion`
--
ALTER TABLE `subtipo_cuestion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_13A5004EA9276E6C` (`tipo_id`);

--
-- Indices de la tabla `tipo_cuestion`
--
ALTER TABLE `tipo_cuestion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_partes_interesadas`
--
ALTER TABLE `tipo_partes_interesadas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_631BA757D9176606` (`unidad_de_gestion_id`);

--
-- Indices de la tabla `unidad_de_gestion`
--
ALTER TABLE `unidad_de_gestion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F3EC8CDBD9176606` (`unidad_de_gestion_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2265B05DE7927C74` (`email`);

--
-- Indices de la tabla `usuario_unidad_permiso`
--
ALTER TABLE `usuario_unidad_permiso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ACB3A7836CEFAD37` (`permiso_id`),
  ADD KEY `IDX_ACB3A783DB38439E` (`usuario_id`),
  ADD KEY `IDX_ACB3A7839D01464C` (`unidad_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aspecto`
--
ALTER TABLE `aspecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `contrato`
--
ALTER TABLE `contrato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `cuestion`
--
ALTER TABLE `cuestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `cuestion_unidad`
--
ALTER TABLE `cuestion_unidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `expectativa`
--
ALTER TABLE `expectativa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `factores_potenciales_de_exito`
--
ALTER TABLE `factores_potenciales_de_exito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `partes_interesadas`
--
ALTER TABLE `partes_interesadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `subtipo_cuestion`
--
ALTER TABLE `subtipo_cuestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tipo_cuestion`
--
ALTER TABLE `tipo_cuestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tipo_partes_interesadas`
--
ALTER TABLE `tipo_partes_interesadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `unidad_de_gestion`
--
ALTER TABLE `unidad_de_gestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `usuario_unidad_permiso`
--
ALTER TABLE `usuario_unidad_permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aspecto_cuestion`
--
ALTER TABLE `aspecto_cuestion`
  ADD CONSTRAINT `FK_E47BD33C1928CA76` FOREIGN KEY (`aspecto_id`) REFERENCES `aspecto` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_E47BD33CE8BD8BB5` FOREIGN KEY (`cuestion_id`) REFERENCES `cuestion` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `FK_66696523CEE5691C` FOREIGN KEY (`unidad_id_id`) REFERENCES `unidad_de_gestion` (`id`);

--
-- Filtros para la tabla `cuestion`
--
ALTER TABLE `cuestion`
  ADD CONSTRAINT `FK_88697F18E245C6A3` FOREIGN KEY (`subtipo_id`) REFERENCES `subtipo_cuestion` (`id`);

--
-- Filtros para la tabla `cuestion_unidad`
--
ALTER TABLE `cuestion_unidad`
  ADD CONSTRAINT `FK_185FD1F99D01464C` FOREIGN KEY (`unidad_id`) REFERENCES `unidad_de_gestion` (`id`),
  ADD CONSTRAINT `FK_185FD1F9E8BD8BB5` FOREIGN KEY (`cuestion_id`) REFERENCES `cuestion` (`id`);

--
-- Filtros para la tabla `expectativa`
--
ALTER TABLE `expectativa`
  ADD CONSTRAINT `FK_A9062C78EC8BC28` FOREIGN KEY (`parte_interesada_id`) REFERENCES `partes_interesadas` (`id`);

--
-- Filtros para la tabla `factores_potenciales_de_exito_aspecto`
--
ALTER TABLE `factores_potenciales_de_exito_aspecto`
  ADD CONSTRAINT `FK_C22BD8CF1928CA76` FOREIGN KEY (`aspecto_id`) REFERENCES `aspecto` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C22BD8CF3375A19F` FOREIGN KEY (`factores_potenciales_de_exito_id`) REFERENCES `factores_potenciales_de_exito` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `partes_interesadas`
--
ALTER TABLE `partes_interesadas`
  ADD CONSTRAINT `FK_FA9836F8483881C0` FOREIGN KEY (`tipo_parte_interesada_id`) REFERENCES `tipo_partes_interesadas` (`id`);

--
-- Filtros para la tabla `subtipo_cuestion`
--
ALTER TABLE `subtipo_cuestion`
  ADD CONSTRAINT `FK_13A5004EA9276E6C` FOREIGN KEY (`tipo_id`) REFERENCES `tipo_cuestion` (`id`);

--
-- Filtros para la tabla `tipo_partes_interesadas`
--
ALTER TABLE `tipo_partes_interesadas`
  ADD CONSTRAINT `FK_631BA757D9176606` FOREIGN KEY (`unidad_de_gestion_id`) REFERENCES `unidad_de_gestion` (`id`);

--
-- Filtros para la tabla `unidad_de_gestion`
--
ALTER TABLE `unidad_de_gestion`
  ADD CONSTRAINT `FK_F3EC8CDBD9176606` FOREIGN KEY (`unidad_de_gestion_id`) REFERENCES `unidad_de_gestion` (`id`);

--
-- Filtros para la tabla `usuario_unidad_permiso`
--
ALTER TABLE `usuario_unidad_permiso`
  ADD CONSTRAINT `FK_ACB3A7836CEFAD37` FOREIGN KEY (`permiso_id`) REFERENCES `permisos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_ACB3A7839D01464C` FOREIGN KEY (`unidad_id`) REFERENCES `unidad_de_gestion` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_ACB3A783DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
