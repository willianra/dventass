-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-10-2017 a las 20:22:49
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ebadis2017`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `almacenid` int(11) NOT NULL,
  `departamento` varchar(20) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`almacenid`, `departamento`, `direccion`, `email`, `telefono`) VALUES
(1000, 'Santa Cruz', 'Av. Macelo Tercero Banzer', 'ebadistribuidora@gmail.com', '33666987');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avala`
--

CREATE TABLE `avala` (
  `personaid` int(11) NOT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `avala`
--

INSERT INTO `avala` (`personaid`, `estado`) VALUES
(9, 1),
(10, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepaquete`
--

CREATE TABLE `detallepaquete` (
  `paqueteid` int(11) NOT NULL,
  `productoid` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detallepaquete`
--

INSERT INTO `detallepaquete` (`paqueteid`, `productoid`, `cantidad`) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 4),
(1, 4, 1),
(1, 5, 3),
(1, 6, 4),
(1, 7, 2),
(1, 8, 4),
(1, 9, 2),
(1, 10, 1),
(1, 11, 1),
(1, 12, 2),
(1, 13, 2),
(1, 14, 3),
(1, 15, 2),
(1, 16, 1),
(1, 17, 1),
(1, 18, 2),
(1, 19, 3),
(1, 20, 2),
(1, 21, 2),
(1, 22, 2),
(1, 23, 3),
(1, 24, 1),
(1, 25, 3),
(1, 26, 2),
(1, 27, 1),
(1, 28, 2),
(1, 29, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleproducto`
--

CREATE TABLE `detalleproducto` (
  `almacenid` int(11) NOT NULL,
  `productoid` int(11) NOT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalleproducto`
--

INSERT INTO `detalleproducto` (`almacenid`, `productoid`, `stock`) VALUES
(1000, 1, 100),
(1000, 2, 100),
(1000, 3, 100),
(1000, 4, 100),
(1000, 5, 100),
(1000, 6, 100),
(1000, 7, 100),
(1000, 8, 100),
(1000, 9, 100),
(1000, 10, 100),
(1000, 11, 100),
(1000, 12, 100),
(1000, 13, 100),
(1000, 14, 100),
(1000, 15, 100),
(1000, 16, 100),
(1000, 17, 100),
(1000, 18, 100),
(1000, 19, 100),
(1000, 20, 100),
(1000, 21, 100),
(1000, 22, 100),
(1000, 23, 100),
(1000, 24, 100),
(1000, 25, 100),
(1000, 26, 100),
(1000, 27, 100),
(1000, 28, 100),
(1000, 29, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `nroPatronal` int(11) NOT NULL,
  `nit` int(11) DEFAULT NULL,
  `razonSocial` varchar(100) DEFAULT NULL,
  `nombreComercial` varchar(100) DEFAULT NULL,
  `tipoEmpresa` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`nroPatronal`, `nit`, `razonSocial`, `nombreComercial`, `tipoEmpresa`) VALUES
(9563, 1026415028, 'TRANSPORTE Y ALMACENAMIENTO', 'AGENCIA DESPACHANTE DE ADUANAS EL TROMPILLO S.R.L.', 'PRIVADA'),
(11966, 1015087029, 'DESPACHANTE DE ADUANAS', '\" AGENCIA DESPACHANTE DE ADUANAS LOS ANGELES S.R.L. \"', 'PRIVADA'),
(13332, 1020757027, 'ELABORACIÓN DE PRODUCTOS ALIMENTICIOS', 'PIL ANDINA S.A.', 'PRIVADA'),
(46901, 1026687020, 'ACTIVIDADES DE ALOJAMIENTO Y SERVICIOS DE COMIDAS', 'HAMBURGUESAS TOBY LTDA.', 'PRIVADA'),
(132475, 150250021, 'EXPLOTACIÓN DE MINAS Y CANTERAS', 'YPFB - PETROANDINA S.A.M.', 'PUBLICA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrega`
--

CREATE TABLE `entrega` (
  `planificacionid` int(11) NOT NULL,
  `entregaid` int(11) NOT NULL,
  `fechaEntrega` date DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `paqueteid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entrega`
--

INSERT INTO `entrega` (`planificacionid`, `entregaid`, `fechaEntrega`, `cantidad`, `paqueteid`) VALUES
(101, 1, '2017-09-04', 1, 1),
(102, 2, '2017-09-20', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

CREATE TABLE `paquete` (
  `paqueteid` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paquete`
--

INSERT INTO `paquete` (`paqueteid`, `descripcion`, `color`) VALUES
(1, 'PAQUETE URBANO PRE-NATAL', 'ROJO'),
(2, 'PAQUETE URBANO LACTANCIA', 'AMARILLO'),
(3, 'PAQUETE RURAL PRE-NATAL', 'AZUL'),
(4, 'PAQUETE URBANO LACTANCIA', 'VERDE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `pedidoid` int(11) NOT NULL,
  `fechaEntrega` date DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `vigencia` int(11) DEFAULT NULL,
  `almacenid` int(11) DEFAULT NULL,
  `productoid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`pedidoid`, `fechaEntrega`, `cantidad`, `vigencia`, `almacenid`, `productoid`) VALUES
(123, '2017-09-11', 2, 5, 1000, 1),
(124, '2017-09-29', 40, 5, 1000, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `personaid` int(11) NOT NULL,
  `ci` int(11) DEFAULT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `paterno` varchar(20) DEFAULT NULL,
  `materno` varchar(20) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `tipoid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`personaid`, `ci`, `nombre`, `paterno`, `materno`, `direccion`, `telefono`, `email`, `tipoid`) VALUES
(1, 4648829, 'Francisco', 'Mendez', 'Perez', 'c/ Agustin Lara Nº 69', '64957020', 'francisco@gmail.com', 4),
(2, 8229977, 'Martina', 'Miranda', 'Mamani', 'Av. Independecia Nº241', '62803375', 'martinamiranda@gmail.com', 4),
(3, 1941331, 'Sixto', 'Nuñez', 'Jimenez', 'Av. 10 de Noviembre Nº1024', '77303634', 'sixtonuñez@gmail.com', 3),
(4, 12839884, 'Vidal', 'Orellana', 'Arispe', 'c/Matamoros Nº310', '77938079', 'vidalorellana@hotmail.com', 3),
(5, 12839194, 'Eladia', 'Paz', 'Lino', 'Av. Independecia Nº1010', '69363050', 'eladiapaz@gmail.com', 3),
(6, 2983162, 'Jose', 'Pedraza', 'Saavedra', 'Av. Libertad Nº495', '64025549', 'josepedraza@gmail.com', 5),
(7, 11403335, 'Alejandro', 'Perez', 'Cruz', 'Av. Jesus Carranza Nº60', '76065647', 'alejandro@gmail.com', 1),
(8, 51584684, 'Jhonny', 'Vasquez', 'Ari', 'Av.Alemana 4º Anillo Nº124', '76468074', 'jhonny@gmail.com', 1),
(9, 9852580, 'Maria Alejandra', 'Vargas', 'Suarez', 'Av. Japon 3º Anillo Externo', '74145547', 'mariaalejandra@gmail.com', 2),
(10, 9851580, 'Jessica', 'Martinez', 'Alba', 'Av. Mutualista c/8  4º Anillo', '77775547', 'martinezalva@gmail.com', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personalalmacen`
--

CREATE TABLE `personalalmacen` (
  `personaid` int(11) NOT NULL,
  `almacenid` int(11) NOT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personalalmacen`
--

INSERT INTO `personalalmacen` (`personaid`, `almacenid`, `estado`) VALUES
(1, 1000, 1),
(2, 1000, 1),
(3, 1000, 1),
(4, 1000, 1),
(5, 1000, 1),
(6, 1000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personalempresa`
--

CREATE TABLE `personalempresa` (
  `personaid` int(11) NOT NULL,
  `empresaid` int(11) NOT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personalempresa`
--

INSERT INTO `personalempresa` (`personaid`, `empresaid`, `estado`) VALUES
(6, 132475, 1),
(7, 132475, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planificacion`
--

CREATE TABLE `planificacion` (
  `planificacionid` int(11) NOT NULL,
  `trabajadorid` int(11) DEFAULT NULL,
  `beneficiarioid` int(11) DEFAULT NULL,
  `cantidadPaqueteEstimado` int(11) DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `almacenid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `planificacion`
--

INSERT INTO `planificacion` (`planificacionid`, `trabajadorid`, `beneficiarioid`, `cantidadPaqueteEstimado`, `fechaInicio`, `fechaFin`, `almacenid`) VALUES
(101, 7, 9, 7, '2017-09-01', '2017-09-30', 1000),
(102, 8, 10, 5, '2017-09-04', '2017-09-29', 1000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `productoid` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `precioCompra` double DEFAULT NULL,
  `precioVenta` double DEFAULT NULL,
  `proveedorid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`productoid`, `nombre`, `precioCompra`, `precioVenta`, `proveedorid`) VALUES
(1, 'Mermelada Fortificada\r\n', 10, 15, 3),
(2, 'Piña\r\n', 10, 15, 3),
(3, 'Arroz de Primera\r\n', 7, 10, 4),
(4, 'Miel de Abeja\r\n', 9, 12, 5),
(5, 'Aceite Vegetal fortificado con vitamina A\r\n', 12, 17, 6),
(6, 'Gelatina Fortificada\r\n', 1, 2.5, 7),
(7, 'Maizena\r\n', 7, 10, 7),
(8, 'Flan Fortificado\r\n', 2, 3, 7),
(9, 'Queso madurado Adam\r\n', 14, 20, 8),
(10, 'Queso Fresco Prensado\r\n', 14, 18, 8),
(11, 'Queso Fundido\r\n', 15, 17, 8),
(12, 'Frejol\r\n', 10, 12, 8),
(13, 'Lenteja\r\n', 10, 12, 8),
(14, 'Palmitos\r\n', 15, 18, 8),
(15, 'Mani Natural\r\n', 5, 9, 8),
(16, 'Harina Fortificada de Trigo\r\n', 8, 10, 8),
(17, 'Palitos de Amaranto\r\n', 6, 8, 8),
(18, 'Mantequilla de Sesamo\r\n', 15, 18, 8),
(19, 'Uvas Pasas\r\n', 8, 12, 8),
(20, 'Fideo Fortificado Con hierro\r\n', 5, 7, 9),
(21, 'Sopa Deshidratada Instantanea\r\n', 5, 7, 10),
(22, 'Sopa de Choclo\r\n', 5, 7, 10),
(23, 'Leche Fluida UHT\r\n', 5, 6, 1),
(24, 'Leche en polvo Entera Instantanea (lata)\r\n', 10, 15, 1),
(25, 'Leche saborizada UHT\r\n', 6, 8, 1),
(26, 'Yogurt lactea\r\n', 2, 3, 1),
(27, 'Yogurt Frutado\r\n', 3, 4, 1),
(28, 'Yogurt Bebible\r\n', 2, 3, 1),
(29, 'Yogurt Probiatico\r\n', 2, 3, 1),
(30, 'Mantequilla Pasteorizada con Sal\r\n', 7, 8, 1),
(31, 'Yogurt Sachet\r\n', 3, 4, 1),
(32, 'Juguito Sachet\r\n', 2, 3, 1),
(33, 'Dulce de Leche\r\n', 7, 10, 1),
(34, 'Sal Yodada y fluorada\r\n', 1, 2, 11),
(35, 'Jugo Natural de Fruta\r\n', 10, 12, 2),
(36, 'Barra de Chocolate Silvestre con Leche\r\n', 2, 4, 12),
(37, 'Azucar Blanca\r\n', 5, 7, 15),
(38, 'Suplemento Nutricional\r\n', 15, 20, 13),
(39, 'Hojuela de Quinua\r\n', 8, 10, 14),
(40, 'Quinua Real el Grano\r\n', 8, 10, 14),
(41, 'Hojuela de Sebada Pre-cocido\r\n', 10, 13, 14),
(42, 'Sesamo lavao y tostada\r\n', 12, 14, 14),
(43, 'Castaña(Almendra)\r\n', 12, 14, 14),
(44, 'Cereal Integral(granolado)\r\n', 12, 14, 14),
(45, 'Api\r\n', 10, 12, 14),
(46, 'Alimento Chocolatado en polvo\r\n', 14, 16, 14),
(47, 'Cereal Instantaneo de Amaranto\r\n', 14, 17, 14),
(48, 'Carne Vegetal\r\n', 10, 13, 14),
(49, 'Trigo Pelado\r\n', 8, 10, 14),
(50, 'Linaza Integral\r\n', 10, 12, 14),
(51, 'Barra de Cereales 6 Unidades\r\n', 5, 7, 14),
(52, 'Chiavena\r\n', 12, 14, 14),
(53, 'Quinua Extruida\r\n', 12, 14, 14),
(54, 'Bebida Lacteos con kumi Quinua\r\n', 5, 7, 14),
(55, 'Refresco Instantaneo de Cereales \r\n', 8, 10, 14),
(56, 'Galletas de Almendra con Avena\r\n', 5, 6, 14),
(57, 'Chia\r\n', 8, 10, 14),
(58, 'Garbanzo\r\n', 8, 10, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `proveedorid` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `departamento` varchar(20) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(8) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`proveedorid`, `nombre`, `departamento`, `direccion`, `telefono`, `email`) VALUES
(1, 'PIL', 'Santa Cruz', 'Av. Beni 5to anillo nº 44', '33451271', 'pilinfo@gmail.com'),
(2, 'TAMPICO', 'Santa Cruz', 'Av. Virgen de Cotoca y 3º Anillo Externo nº 25', '33846917', 'tampicoingo@gmail.com'),
(3, 'ARCOR', 'Santa Cruz', '4º Anillo Radial 10 nº 86', '33547154', 'arcorinf@gmail.com'),
(4, 'BRANCO', 'Santa Cruz', '4º Anillo Av. Alemana c/5 nº 74', '33571598', 'brancoinfo@gmail.com'),
(5, 'COLONIA DE ORO', 'Santa Cruz', 'Parque Industrial C/11 nº 23', '33695841', 'coloniainfo@gmail.com'),
(6, 'FINO', 'Santa Cruz', 'Km. 28 Carretera al Norte', '33521478', 'finoinfo@gmail.com'),
(7, 'KIKO', 'Santa Cruz', 'Av. Alemana 4ºAnillo nº159', '33416458', 'kikoinfo@gmail.com'),
(8, 'LA GRANJA', 'Santa Cruz', 'Av. Mutualista C/11 Nº14', '33825147', 'lagranja@gmail.com'),
(9, 'LAZZARONI', 'Santa Cruz', '4º Anillo Parque Industrial C/9', '33692514', 'lazzaroniing@gmail.com'),
(10, 'MAGGI', 'Santa Cruz', 'AV. Cotoca c/4 esquina Figueroa', '33475702', 'maggiinf@gmail.com'),
(11, 'REFISAL', 'Santa Cruz', 'Av. las Palmas nº 3367', '33951247', 'refisalinf@gmail.com'),
(12, 'NESTLE', 'Santa Cruz', 'Av. Tres pasos al Frente c/6 nº25', '33468217', 'nestleinf@gmail.com'),
(13, 'VITAMIN', 'Santa Cruz', 'AV. Guapay C/7 nº 159', '33852467', 'nestleinf@gmail.com'),
(14, 'VITNATURE', 'Santa Cruz', 'Av. Alemana C/ Sao', '36674157', 'vitnature@gmail.com'),
(15, 'UNAGRO', 'Santa Cruz', 'Av. Beni 5º Anillo', '35554872', 'unagroinf@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `nroPatronal` int(11) NOT NULL,
  `nroSucursal` int(11) NOT NULL,
  `departamento` varchar(50) DEFAULT NULL,
  `municipo` varchar(50) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `fax` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`nroPatronal`, `nroSucursal`, `departamento`, `municipo`, `direccion`, `telefono`, `fax`) VALUES
(9563, 1, 'Santa Cruz', 'Santa Cruz', 'Avenida Trompillo N° 411 Zona: El Pari Nº115', '3587197', '527238'),
(9563, 2, 'Santa Cruz', 'Santa Cruz', 'Av. 3 Pasos Al Frente_barrio Convifag N° S/n Zona: Villa Primero De Mayo Nº3325', '3473889', NULL),
(11966, 1, 'Santa Cruz', 'Santa Cruz', 'Av. Paragua 2º Anillo c/6 Nº1871', '3475703', '3338714'),
(11966, 2, 'Santa Cruz', 'Warnes', 'c/ Ignacio Warnes Nº 23', '3992207', NULL),
(13332, 1, 'Santa Cruz', 'Santa Cruz', 'Av. Blanco Galindo Km.10.5 N° S/n Zona: PiÑami', '4260164', '4264410'),
(13332, 2, 'Santa Cruz', 'Buena Ventura', 'Las Lomas N° S/n Zona: Valle del Rosario N° 258', '77940917', NULL),
(46901, 1, 'Santa Cruz', 'Cotoca', 'c/ Paurito esquina Crnl. Savedra Nº3325', '3339093', NULL),
(46901, 2, 'Santa Cruz', 'Santa Cruz', 'AV. Cristobal Mendoza', '3369451', NULL),
(132475, 1, 'Santa Cruz', 'Cotoca', 'Av.Jose Estenssoro Zona:Villa Mercedes nº 213', '3713000', '33713065'),
(132475, 2, 'Santa Cruz', 'Santa Cruz', 'Calle Ayacucho N° 511 Zona: B/casco Viejo Nº 69', '3345150', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `tipoid` int(11) NOT NULL,
  `descripcion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`tipoid`, `descripcion`) VALUES
(1, 'TRABAJADOR'),
(2, 'BENEFICIARIO'),
(3, 'EMPLEADO'),
(4, 'ADMINITRADOR'),
(5, 'GERENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `personaid` int(11) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `login` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`personaid`, `password`, `login`) VALUES
(6, '111', 'gerentejose');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`almacenid`);

--
-- Indices de la tabla `avala`
--
ALTER TABLE `avala`
  ADD PRIMARY KEY (`personaid`);

--
-- Indices de la tabla `detallepaquete`
--
ALTER TABLE `detallepaquete`
  ADD PRIMARY KEY (`paqueteid`,`productoid`),
  ADD KEY `paqueteid` (`paqueteid`),
  ADD KEY `productoid` (`productoid`);

--
-- Indices de la tabla `detalleproducto`
--
ALTER TABLE `detalleproducto`
  ADD PRIMARY KEY (`almacenid`,`productoid`),
  ADD KEY `almacenid` (`almacenid`),
  ADD KEY `productoid` (`productoid`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`nroPatronal`);

--
-- Indices de la tabla `entrega`
--
ALTER TABLE `entrega`
  ADD PRIMARY KEY (`planificacionid`,`entregaid`),
  ADD KEY `paqueteid` (`paqueteid`),
  ADD KEY `planificacionid` (`planificacionid`);

--
-- Indices de la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD PRIMARY KEY (`paqueteid`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`pedidoid`),
  ADD KEY `almacenid` (`almacenid`),
  ADD KEY `productoid` (`productoid`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`personaid`);

--
-- Indices de la tabla `personalalmacen`
--
ALTER TABLE `personalalmacen`
  ADD PRIMARY KEY (`personaid`,`almacenid`),
  ADD KEY `almacenid` (`almacenid`),
  ADD KEY `personaid` (`personaid`);

--
-- Indices de la tabla `personalempresa`
--
ALTER TABLE `personalempresa`
  ADD PRIMARY KEY (`personaid`,`empresaid`),
  ADD KEY `empresaid` (`empresaid`),
  ADD KEY `personaid` (`personaid`);

--
-- Indices de la tabla `planificacion`
--
ALTER TABLE `planificacion`
  ADD PRIMARY KEY (`planificacionid`),
  ADD KEY `almacenid` (`almacenid`),
  ADD KEY `beneficiarioid` (`beneficiarioid`),
  ADD KEY `trabajadorid` (`trabajadorid`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`productoid`),
  ADD KEY `proveedorid` (`proveedorid`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`proveedorid`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`nroPatronal`,`nroSucursal`),
  ADD KEY `nroPatronal` (`nroPatronal`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`tipoid`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`personaid`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `avala`
--
ALTER TABLE `avala`
  ADD CONSTRAINT `FK_Avala_Persona` FOREIGN KEY (`personaid`) REFERENCES `persona` (`personaid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detallepaquete`
--
ALTER TABLE `detallepaquete`
  ADD CONSTRAINT `FK_DetallePaquete_Paquete` FOREIGN KEY (`paqueteid`) REFERENCES `paquete` (`paqueteid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_DetallePaquete_Producto` FOREIGN KEY (`productoid`) REFERENCES `producto` (`productoid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entrega`
--
ALTER TABLE `entrega`
  ADD CONSTRAINT `FK_Entrega_Paquete` FOREIGN KEY (`paqueteid`) REFERENCES `paquete` (`paqueteid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Entrega_Planificacion` FOREIGN KEY (`planificacionid`) REFERENCES `planificacion` (`planificacionid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `FK_Pedido_Almacen` FOREIGN KEY (`almacenid`) REFERENCES `almacen` (`almacenid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Pedido_Producto` FOREIGN KEY (`productoid`) REFERENCES `producto` (`productoid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `personalalmacen`
--
ALTER TABLE `personalalmacen`
  ADD CONSTRAINT `FK_PersonalAlmacen_Almacen` FOREIGN KEY (`almacenid`) REFERENCES `almacen` (`almacenid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PersonalAlmacen_Persona` FOREIGN KEY (`personaid`) REFERENCES `persona` (`personaid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `personalempresa`
--
ALTER TABLE `personalempresa`
  ADD CONSTRAINT `FK_PersonalEmpresa_Empresa` FOREIGN KEY (`empresaid`) REFERENCES `empresa` (`nroPatronal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_PersonalEmpresa_Persona` FOREIGN KEY (`personaid`) REFERENCES `persona` (`personaid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `planificacion`
--
ALTER TABLE `planificacion`
  ADD CONSTRAINT `FK_Planificacion_Almacen` FOREIGN KEY (`almacenid`) REFERENCES `almacen` (`almacenid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Planificacion_Avala` FOREIGN KEY (`beneficiarioid`) REFERENCES `avala` (`personaid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Planificacion_Persona` FOREIGN KEY (`trabajadorid`) REFERENCES `persona` (`personaid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `FK_Producto_Proveedor` FOREIGN KEY (`proveedorid`) REFERENCES `proveedor` (`proveedorid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
