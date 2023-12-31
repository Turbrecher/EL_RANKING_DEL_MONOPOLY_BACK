-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-12-2023 a las 23:44:42
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `monopoly_competicion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--

CREATE TABLE `jugador`
(
    `id`        int(3)      NOT NULL,
    `nombre`    varchar(50) NOT NULL,
    `apellidos` varchar(50) NOT NULL,
    `nick`      varchar(50) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida`
(
    `id`        int(3)      NOT NULL,
    `id_torneo` int(3)      NOT NULL,
    `nombre`    varchar(50) NOT NULL,
    `ganador`   varchar(50) NOT NULL,
    `fecha`     date        NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntuacion`
--

CREATE TABLE `puntuacion`
(
    `nick_jugador` varchar(50) NOT NULL,
    `id_torneo`    int(3)      NOT NULL,
    `id_partida`    int(3)      NOT NULL,
    `puntos`       int(3)      NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneo`
--

CREATE TABLE `torneo`
(
    `id`           int(3)      NOT NULL,
    `nombre`       varchar(50) NOT NULL,
    `fecha_inicio` date        NOT NULL,
    `fecha_fin`    date        NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `torneo`
--

INSERT INTO `torneo` (`id`, `nombre`, `fecha_inicio`, `fecha_fin`)
VALUES (1, 'Torneo 2023', '2023-01-01', '2023-12-31');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `jugador`
--
ALTER TABLE `jugador`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `nick` (`nick`);

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `unique_nombre` (`nombre`),
    ADD KEY `fk_foreign_key_torneo_id` (`id_torneo`),
    ADD KEY `fk_foreign_key_ganador` (`ganador`);

--
-- Indices de la tabla `puntuacion_partida`
--
ALTER TABLE `puntuacion`
    ADD PRIMARY KEY (`nick_jugador`, `id_partida`,`id_torneo`),
    ADD KEY `fk_foreign_key_id_partida` (`id_partida`),
    ADD KEY `fk_foreign_key_id_torneo` (`id_torneo`);



--
-- Indices de la tabla `torneo`
--
ALTER TABLE `torneo`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `jugador`
--
ALTER TABLE `jugador`
    MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 11;

--
-- AUTO_INCREMENT de la tabla `partida`
--
ALTER TABLE `partida`
    MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 1;

--
-- AUTO_INCREMENT de la tabla `torneo`
--
ALTER TABLE `torneo`
    MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 1;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
    ADD CONSTRAINT `fk_foreign_key_ganador` FOREIGN KEY (`ganador`) REFERENCES `jugador` (`nick`),
    ADD CONSTRAINT `fk_foreign_key_torneo_id` FOREIGN KEY (`id_torneo`) REFERENCES `torneo` (`id`);

--
-- Filtros para la tabla `puntuacion`
--
ALTER TABLE `puntuacion`
    ADD CONSTRAINT `fk_foreign_key_id_partida` FOREIGN KEY (`id_partida`) REFERENCES `partida` (`id`),
    ADD CONSTRAINT `fk_foreign_key_id_torneo` FOREIGN KEY (`id_torneo`) REFERENCES `torneo` (`id`),
    ADD CONSTRAINT `fk_foreign_key_nick_jugador` FOREIGN KEY (`nick_jugador`) REFERENCES `jugador` (`nick`);


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
