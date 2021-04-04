-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-04-2021 a las 09:30:36
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `project`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conversiones`
--

CREATE TABLE `conversiones` (
  `id` int(11) NOT NULL,
  `origen` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` double NOT NULL,
  `fecha` date NOT NULL,
  `destino` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resultado` double NOT NULL,
  `ratio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210402092941', '2021-04-02 11:30:24', 108),
('DoctrineMigrations\\Version20210403201917', '2021-04-03 22:19:31', 52),
('DoctrineMigrations\\Version20210403202146', '2021-04-03 22:21:59', 75),
('DoctrineMigrations\\Version20210403202338', '2021-04-03 22:23:45', 75),
('DoctrineMigrations\\Version20210403203034', '2021-04-03 22:30:40', 34),
('DoctrineMigrations\\Version20210403223729', '2021-04-04 00:37:54', 44),
('DoctrineMigrations\\Version20210404001226', '2021-04-04 02:12:32', 126),
('DoctrineMigrations\\Version20210404010208', '2021-04-04 03:02:13', 45),
('DoctrineMigrations\\Version20210404011553', '2021-04-04 03:16:18', 39);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `sector_id` int(11) DEFAULT NULL,
  `nombre` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` int(11) DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `sector_id`, `nombre`, `telefono`, `email`) VALUES
(49, 38, 'meal.ly', 643235234, 'meal@meal.ly'),
(50, 38, 'nutriti', 653546765, 'nutriti@gmail.com'),
(51, 39, 'LastComputer', 654345645, 'LastComputer@gmail.com'),
(52, 39, 'cobyte', 2147483647, 'cobyte@cobyte.com'),
(53, 40, 'automobus', 2147483647, 'automobus@gmail.com'),
(54, 40, 'collabcar', 938283823, 'collabcar@gmail.com'),
(55, 41, 'funding.ly', 653456723, 'funding@funding.ly'),
(56, 41, 'moneyswipe', 645343532, 'moneyswipe@gamil.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sectores`
--

CREATE TABLE `sectores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sectores`
--

INSERT INTO `sectores` (`id`, `nombre`) VALUES
(38, 'Alimenticio'),
(39, 'Tecnologico'),
(40, 'Automocion'),
(41, 'Financiero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(21, 'dummy@user.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$h23euWQJUpJZ1+pKpxAMvw$T9+oB63PpLlZZZ7rQ5a07bNnPKccFcTx3Y6Xc0HYPeo'),
(22, 'dummy@admin.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$Z2lKZTJGOUhaeUtTbk9FVw$FTYI+wqA07No9AzeXN2R3L4UIRPjXfxC5wxxMGWhT9Q'),
(23, 'prueba@prueba.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$TjYxOFJ4ektlZ2M1NHMyNQ$oKMOknKH6yMRvd6MsdMFmAQO9iL6QvMJ8mZcDdZf1bM');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `conversiones`
--
ALTER TABLE `conversiones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_70DD49A5DE95C867` (`sector_id`);

--
-- Indices de la tabla `sectores`
--
ALTER TABLE `sectores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `conversiones`
--
ALTER TABLE `conversiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `sectores`
--
ALTER TABLE `sectores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `FK_70DD49A5DE95C867` FOREIGN KEY (`sector_id`) REFERENCES `sectores` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
