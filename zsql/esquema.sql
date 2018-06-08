-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2015 a las 21:56:07
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `saltashop2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sp_operadores`
--

CREATE TABLE IF NOT EXISTS `sp_operadores` (
  `op_id` int(11) NOT NULL AUTO_INCREMENT,
  `op_rol` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `op_correo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `op_password` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `op_nombre` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `op_apellido` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `op_dni` int(11) NOT NULL,
  `op_genero` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `op_estado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`op_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='datos de operadores' AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `sp_operadores`
--

INSERT INTO `sp_operadores` (`op_id`, `op_rol`, `op_correo`, `op_password`, `op_nombre`, `op_apellido`, `op_dni`, `op_genero`, `op_estado`) VALUES
(1, 'administrador', 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', 'nombre', 'apellido', 11111111, 'M', 'A'),
(2, 'vendedor', 'juan@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Juan', 'Perez', 11111111, 'M', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sp_ordenes`
--

CREATE TABLE IF NOT EXISTS `sp_ordenes` (
  `ord_id` int(11) NOT NULL AUTO_INCREMENT,
  `us_id` int(11) NOT NULL,
  `ord_nombre_us` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ord_forma_pago` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ord_estado` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ord_estado_fecha` datetime NOT NULL,
  `ord_total` decimal(15,2) NOT NULL,
  `ord_fecha` datetime NOT NULL,
  `ord_cantidad_vendida` int(11) NOT NULL,
  PRIMARY KEY (`ord_id`),
  KEY `ordenes_usID_FK` (`us_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sp_orden_detalle`
--

CREATE TABLE IF NOT EXISTS `sp_orden_detalle` (
  `od_id` int(11) NOT NULL AUTO_INCREMENT,
  `ord_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `producto_cantidad` int(11) NOT NULL,
  `producto_precio` decimal(15,2) NOT NULL,
  `producto_subtotal` decimal(15,2) NOT NULL,
  `producto_nombre` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`od_id`),
  KEY `OD_ordID_FK` (`ord_id`),
  KEY `OD_productoID_FK` (`producto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sp_orden_historial`
--

CREATE TABLE IF NOT EXISTS `sp_orden_historial` (
  `historia_id` int(11) NOT NULL AUTO_INCREMENT,
  `ord_id` int(11) NOT NULL,
  `historia_fecha` datetime NOT NULL,
  `historia_accion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `historia_descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`historia_id`),
  KEY `OH_ordenID_FK` (`ord_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sp_productos`
--

CREATE TABLE IF NOT EXISTS `sp_productos` (
  `producto_id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_marca_id` int(11) NOT NULL COMMENT 'FK(sp_producto_marcas)',
  `producto_categoria_id` int(11) NOT NULL COMMENT 'FK(producto_categorias)',
  `producto_nombre` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `producto_descripcion_corta` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `producto_descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `producto_cantidad` int(11) NOT NULL,
  `producto_precio` decimal(15,2) NOT NULL,
  `producto_cantidad_comprada` int(11) DEFAULT '0',
  `producto_estado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`producto_id`),
  KEY `producto_categoria_id` (`producto_categoria_id`),
  KEY `producto_marca_id` (`producto_marca_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='datos de productos del negocio' AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sp_producto_categorias`
--

CREATE TABLE IF NOT EXISTS `sp_producto_categorias` (
  `producto_categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_categoria_nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `producto_categoria_padre_id` int(11) NOT NULL DEFAULT '0',
  `producto_categoria_estado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`producto_categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='datos de categorias de productos' AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sp_producto_imgs`
--

CREATE TABLE IF NOT EXISTS `sp_producto_imgs` (
  `producto_img_id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_id` int(11) NOT NULL COMMENT 'FK(sp_productos)',
  `producto_img_nombre` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `producto_img_predeterminado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `producto_img_alt` varchar(200) NOT NULL,
  PRIMARY KEY (`producto_img_id`),
  KEY `producto_id` (`producto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='nombre de la imagenes vinculadas a un producto determinado' AUTO_INCREMENT=65 ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sp_producto_marcas`
--

CREATE TABLE IF NOT EXISTS `sp_producto_marcas` (
  `producto_marca_id` int(11) NOT NULL AUTO_INCREMENT,
  `producto_marca_nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `producto_marca_estado` char(1) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`producto_marca_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='datos filiatorios de marcas de productos' AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sp_usuarios`
--

CREATE TABLE IF NOT EXISTS `sp_usuarios` (
  `us_id` int(11) NOT NULL AUTO_INCREMENT,
  `us_correo` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `us_password` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `us_nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `us_apellido` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `us_dni` int(11) NOT NULL,
  `us_provincia` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `us_ciudad` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `us_cpostal` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `us_domicilio` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `us_telefono` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `us_celular` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `us_estado` char(1) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`us_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `sp_usuarios`
--

INSERT INTO `sp_usuarios` (`us_id`, `us_correo`, `us_password`, `us_nombre`, `us_apellido`, `us_dni`, `us_provincia`, `us_ciudad`, `us_cpostal`, `us_domicilio`, `us_telefono`, `us_celular`, `us_estado`) VALUES
(1, 'user@user.com', 'e10adc3949ba59abbe56e057f20f883e', 'name', 'lastname', 11111111, 'Salta', 'Salta', '5600', 'calle', 'tel', 'cel', 'A');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sp_ordenes`
--
ALTER TABLE `sp_ordenes`
  ADD CONSTRAINT `ordenes_usID_FK` FOREIGN KEY (`us_id`) REFERENCES `sp_usuarios` (`us_id`) ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sp_orden_detalle`
--
ALTER TABLE `sp_orden_detalle`
  ADD CONSTRAINT `OD_ordID_FK` FOREIGN KEY (`ord_id`) REFERENCES `sp_ordenes` (`ord_id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `OD_productoID_FK` FOREIGN KEY (`producto_id`) REFERENCES `sp_productos` (`producto_id`) ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sp_orden_historial`
--
ALTER TABLE `sp_orden_historial`
  ADD CONSTRAINT `OH_ordenID_FK` FOREIGN KEY (`ord_id`) REFERENCES `sp_ordenes` (`ord_id`) ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sp_productos`
--
ALTER TABLE `sp_productos`
  ADD CONSTRAINT `productos_categoriaID_FK` FOREIGN KEY (`producto_categoria_id`) REFERENCES `sp_producto_categorias` (`producto_categoria_id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `productos_marcaID_FK` FOREIGN KEY (`producto_marca_id`) REFERENCES `sp_producto_marcas` (`producto_marca_id`) ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sp_producto_imgs`
--
ALTER TABLE `sp_producto_imgs`
  ADD CONSTRAINT `imgs_productoID_FK` FOREIGN KEY (`producto_id`) REFERENCES `sp_productos` (`producto_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
