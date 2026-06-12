-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2026 a las 17:49:47
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_comic`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `id_autor` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `nacionalidad` varchar(60) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `especialidad` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`id_autor`, `nombre`, `nacionalidad`, `fecha_nacimiento`, `especialidad`) VALUES
(1, 'Chip Zdarsky', 'Canadiense', '1975-01-01', 'Guionista'),
(2, 'Zeb Wells', 'Estadounidense', '1977-01-01', 'Guionista'),
(3, 'Jan', 'Española', '1939-03-11', 'Autor Completo'),
(4, 'Francisco Ibáñez', 'Española', '1936-03-15', 'Autor Completo'),
(5, 'David López', 'Española', '1977-01-01', 'Dibujante'),
(6, 'Carlos Pacheco', 'Española', '1960-11-14', 'Dibujante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `ciudad` varchar(60) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `fecha_alta` date NOT NULL,
  `observaciones` text DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `ciudad`, `email`, `fecha_alta`, `observaciones`, `telefono`) VALUES
(1, 'Ana García', 'Segovia', 'ana@gmail.com', '2026-05-20', 'Recoge en tienda', '921111111'),
(2, 'Luis Martín', 'Madrid', 'luis@gmail.com', '2026-05-22', 'Cliente habitual', NULL),
(3, 'Marta Sanz', 'Valladolid', NULL, '2026-05-25', 'Prefiere edición cartoné', '983222333'),
(4, 'Carlos Ruiz', 'Toledo', 'carlos@gmail.com', '2026-05-26', NULL, '925444555'),
(5, 'Lucía Pérez', 'Salamanca', NULL, '2026-05-27', 'Le gustan los mangas', '923777888');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colecciones`
--

CREATE TABLE `colecciones` (
  `id_coleccion` int(11) NOT NULL,
  `nombre_coleccion` varchar(100) NOT NULL,
  `formato` varchar(100) NOT NULL,
  `precio_medio` decimal(6,2) NOT NULL,
  `fecha_lanzamiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `colecciones`
--

INSERT INTO `colecciones` (`id_coleccion`, `nombre_coleccion`, `formato`, `precio_medio`, `fecha_lanzamiento`) VALUES
(1, 'Marvel Deluxe', 'Cartoné', 22.95, '2020-02-15'),
(2, 'DC Pocket', 'Tomo', 53.25, '2024-03-10'),
(3, 'Superhumor', 'Cartoné', 18.50, '2019-09-01'),
(4, 'Biblioteca Marvel', 'Rústica', 14.95, '2021-06-10'),
(5, 'Absolute DC', 'Cartoné', 35.50, '2023-10-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comics`
--

CREATE TABLE `comics` (
  `id_comic` int(11) NOT NULL,
  `titulo_comic` varchar(120) NOT NULL,
  `numero` int(11) NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `descuento` decimal(5,2) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `guionista` varchar(80) DEFAULT NULL,
  `sinopsis` text DEFAULT NULL,
  `editorial_texto` varchar(80) DEFAULT NULL,
  `autor_principal` varchar(100) DEFAULT NULL,
  `dibujante` varchar(100) DEFAULT NULL,
  `colorista` varchar(100) DEFAULT NULL,
  `entintador` varchar(100) DEFAULT NULL,
  `nacionalidad_autor` varchar(60) DEFAULT NULL,
  `fecha_nacimiento_autor` date DEFAULT NULL,
  `id_editorial` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comics`
--

INSERT INTO `comics` (`id_comic`, `titulo_comic`, `numero`, `precio`, `descuento`, `stock`, `fecha_publicacion`, `guionista`, `sinopsis`, `editorial_texto`, `autor_principal`, `dibujante`, `colorista`, `entintador`, `nacionalidad_autor`, `fecha_nacimiento_autor`, `id_editorial`) VALUES
(1, 'Batman', 1, 3.50, NULL, 30, '2024-04-12', 'Chip Zdarsky', 'Primer número de una etapa reciente.', 'ECC Ediciones', 'Chip Zdarsky', 'Carlos Pacheco', NULL, NULL, 'Canadiense', '1975-01-01', 2),
(2, 'Spider-Man', 12, 4.20, NULL, 18, '2024-05-03', 'Zeb Wells', 'Entrega centrada en Peter Parker', 'Panini Comics', 'Zeb Wells', 'David López', NULL, NULL, 'Estadounidense', '1977-01-01', 1),
(3, 'Superlópez', 3, 12.95, NULL, 8, '2023-11-20', NULL, 'Edición especial en formato tomo.', 'Norma Editorial', 'Jan', 'Jan', NULL, 'Jan', 'Española', '1939-03-11', 3),
(4, 'Mortadelo y Filemón', 215, 7.50, NULL, 14, '2022-06-18', NULL, NULL, 'Norma Editorial', 'Francisco Ibáñez', 'Francisco Ibáñez', NULL, 'Juan Manuel Muños Chueca', 'Española', '1936-03-15', 3),
(7, 'Rompetechos', 1, 12.50, NULL, 20, '2023-05-10', NULL, 'Las aventuras del personaje más despistado del cómic español.', 'Bruguera', 'Francisco Ibáñez', 'Francisco Ibáñez', NULL, NULL, 'Española', '1936-03-15', 6),
(8, 'Capitán Trueno', 15, 9.95, 10.00, 12, '2022-09-01', 'Víctor Mora', 'Nueva aventura del héroe medieval.', 'Ediciones B', 'Víctor Mora', 'Ambrós', NULL, NULL, 'Española', '1931-06-06', 7),
(9, 'Superlópez', 8, 14.50, NULL, 18, '2024-01-20', 'Jan', 'Parodia de los superhéroes clásicos.', 'Ediciones B', 'Jan', 'Jan', NULL, 'Jan', 'Española', '1939-02-11', 7),
(10, 'Blacksad', 3, 19.95, 5.00, 10, '2021-11-15', 'Juan Díaz Canales', 'Investigación detectivesca protagonizada por animales antropomórficos.', 'Norma Editorial', 'Juanjo Guarnido', 'Juanjo Guarnido', 'Juan Guarnido', NULL, 'Española', '1967-01-01', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comic_autoria`
--

CREATE TABLE `comic_autoria` (
  `id_participacion` int(11) NOT NULL,
  `id_comic` int(11) NOT NULL,
  `id_autor` int(11) NOT NULL,
  `rol` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comic_autoria`
--

INSERT INTO `comic_autoria` (`id_participacion`, `id_comic`, `id_autor`, `rol`) VALUES
(1, 1, 1, 'Guionista'),
(2, 1, 5, 'Dibujante'),
(3, 2, 2, 'Guionista'),
(4, 2, 6, 'Dibujante'),
(5, 3, 3, 'Guionista'),
(6, 3, 3, 'Dibujante'),
(7, 4, 4, 'Guionista'),
(8, 4, 4, 'Dibujante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_comic` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id_detalle`, `id_pedido`, `id_comic`, `cantidad`, `precio_unitario`) VALUES
(1, 1, 1, 2, 3.50),
(2, 1, 3, 1, 12.95),
(3, 2, 2, 3, 4.20),
(4, 4, 1, 1, 3.50),
(5, 4, 2, 2, 4.20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editoriales`
--

CREATE TABLE `editoriales` (
  `id_editorial` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `pais` varchar(70) NOT NULL,
  `fundacion` date NOT NULL,
  `web` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `editoriales`
--

INSERT INTO `editoriales` (`id_editorial`, `nombre`, `pais`, `fundacion`, `web`) VALUES
(1, 'Panini Comics', 'Italia', '1961-01-01', 'https://www.panini.es'),
(2, 'ECC Ediciones', 'España', '2012-01-01', NULL),
(3, 'Norma Editorial', 'España', '1977-01-01', 'https://www.normaeditorial.com'),
(4, 'Planeta Cómic', 'España', '1982-01-01', 'https://www.planetacomic.com'),
(5, 'Marvel Comics', 'Estados Unidos', '1939-01-01', NULL),
(6, 'Bruguera', 'España', '1910-02-10', NULL),
(7, 'Ediciones B', 'España', '1987-01-01', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha_pedido` date NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_cliente`, `fecha_pedido`, `estado`) VALUES
(1, 1, '2026-06-01', 'Pendiente'),
(2, 2, '2026-06-01', 'Enviado'),
(3, 1, '2026-06-04', 'Entregado'),
(4, 3, '2026-06-04', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_autores_comics`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_autores_comics` (
`id_autor` int(11)
,`nombre` varchar(100)
,`titulo_comic` varchar(120)
,`rol` varchar(30)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_pedidos_resumen`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_pedidos_resumen` (
`id_pedido` int(11)
,`fecha_pedido` date
,`estado` varchar(20)
,`nombre` varchar(80)
,`titulo_comic` varchar(120)
,`cantidad` int(11)
,`precio_unitario` decimal(6,2)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_autores_comics`
--
DROP TABLE IF EXISTS `vista_autores_comics`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_autores_comics`  AS SELECT `a`.`id_autor` AS `id_autor`, `a`.`nombre` AS `nombre`, `c`.`titulo_comic` AS `titulo_comic`, `ca`.`rol` AS `rol` FROM ((`autores` `a` join `comic_autoria` `ca` on(`a`.`id_autor` = `ca`.`id_autor`)) join `comics` `c` on(`ca`.`id_comic` = `c`.`id_comic`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_pedidos_resumen`
--
DROP TABLE IF EXISTS `vista_pedidos_resumen`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_pedidos_resumen`  AS SELECT `p`.`id_pedido` AS `id_pedido`, `p`.`fecha_pedido` AS `fecha_pedido`, `p`.`estado` AS `estado`, `cl`.`nombre` AS `nombre`, `c`.`titulo_comic` AS `titulo_comic`, `dp`.`cantidad` AS `cantidad`, `dp`.`precio_unitario` AS `precio_unitario` FROM (((`pedidos` `p` join `clientes` `cl` on(`p`.`id_cliente` = `cl`.`id_cliente`)) join `detalle_pedido` `dp` on(`p`.`id_pedido` = `dp`.`id_pedido`)) join `comics` `c` on(`dp`.`id_comic` = `c`.`id_comic`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`id_autor`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `colecciones`
--
ALTER TABLE `colecciones`
  ADD PRIMARY KEY (`id_coleccion`);

--
-- Indices de la tabla `comics`
--
ALTER TABLE `comics`
  ADD PRIMARY KEY (`id_comic`),
  ADD KEY `fk_editorial` (`id_editorial`);

--
-- Indices de la tabla `comic_autoria`
--
ALTER TABLE `comic_autoria`
  ADD PRIMARY KEY (`id_participacion`),
  ADD KEY `id_comic` (`id_comic`),
  ADD KEY `id_autor` (`id_autor`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_comic` (`id_comic`);

--
-- Indices de la tabla `editoriales`
--
ALTER TABLE `editoriales`
  ADD PRIMARY KEY (`id_editorial`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `id_autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `colecciones`
--
ALTER TABLE `colecciones`
  MODIFY `id_coleccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `comics`
--
ALTER TABLE `comics`
  MODIFY `id_comic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `comic_autoria`
--
ALTER TABLE `comic_autoria`
  MODIFY `id_participacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `editoriales`
--
ALTER TABLE `editoriales`
  MODIFY `id_editorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comics`
--
ALTER TABLE `comics`
  ADD CONSTRAINT `fk_editorial` FOREIGN KEY (`id_editorial`) REFERENCES `editoriales` (`id_editorial`);

--
-- Filtros para la tabla `comic_autoria`
--
ALTER TABLE `comic_autoria`
  ADD CONSTRAINT `comic_autoria_ibfk_1` FOREIGN KEY (`id_comic`) REFERENCES `comics` (`id_comic`),
  ADD CONSTRAINT `comic_autoria_ibfk_2` FOREIGN KEY (`id_autor`) REFERENCES `autores` (`id_autor`);

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`id_comic`) REFERENCES `comics` (`id_comic`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
