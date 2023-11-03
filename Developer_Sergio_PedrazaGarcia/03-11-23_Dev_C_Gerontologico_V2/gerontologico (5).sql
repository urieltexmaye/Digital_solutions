-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2023 a las 06:54:54
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gerontologico`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `Id` int(11) NOT NULL,
  `NombreUsuario` varchar(90) NOT NULL,
  `Tipo_Sevicio` varchar(20) NOT NULL,
  `FechaHora` date NOT NULL,
  `Asistencia` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`Id`, `NombreUsuario`, `Tipo_Sevicio`, `FechaHora`, `Asistencia`) VALUES
(86, 'Luis Perez Contreras', 'Psicológico', '2023-10-27', 1),
(88, 'Beatriz  Quitero Gutierrez', 'Médico', '2023-10-27', 1),
(89, 'Luis Perez Contreras', 'Médico', '2023-10-27', 1),
(92, 'Ramses Hernandez Fazmin', 'Médico', '2023-10-27', 1),
(93, 'Sergio Pedraza García', 'Psicológico', '2023-10-27', 0),
(94, 'David Ricardo Isidro Lora', 'Psicológico', '2023-10-27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosadministrador`
--

CREATE TABLE `datosadministrador` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `Apellidos` varchar(55) NOT NULL,
  `Teléfono` char(10) NOT NULL,
  `Rol` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `datosadministrador`
--

INSERT INTO `datosadministrador` (`Id`, `Nombre`, `Apellidos`, `Teléfono`, `Rol`) VALUES
(1, 'Berenice', 'Lorem Hernandez', '7721763847', 'Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosmedicos`
--

CREATE TABLE `datosmedicos` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `Apellidos` varchar(55) NOT NULL,
  `Especialidad` varchar(20) NOT NULL,
  `Teléfono` char(10) NOT NULL,
  `Rol` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `datosmedicos`
--

INSERT INTO `datosmedicos` (`Id`, `Nombre`, `Apellidos`, `Especialidad`, `Teléfono`, `Rol`) VALUES
(1, 'Vicente', 'Mendez', 'Psicologo', '7721267582', 'Doctor'),
(2, 'Luis Daniel', 'Jazmín Gúzman', 'Fisio Terapeuta', '7728674898', 'Doctor'),
(3, 'Pedro', 'Flores Benítez', 'Médico', '7721635373', 'Doctor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosusuario`
--

CREATE TABLE `datosusuario` (
  `Id_user` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `Apellidos` varchar(55) NOT NULL,
  `Teléfono` char(10) NOT NULL,
  `CorreoElectrónico` varchar(40) NOT NULL,
  `Danza` tinyint(1) DEFAULT NULL,
  `Pintura` tinyint(1) DEFAULT NULL,
  `Cocina` tinyint(1) DEFAULT NULL,
  `Tutor_Nombre` varchar(40) NOT NULL,
  `Tutor_apellidos` varchar(55) NOT NULL,
  `Tutor_Teléfono` char(10) NOT NULL,
  `Tutor_Dirección` varchar(70) NOT NULL,
  `Rol` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `datosusuario`
--

INSERT INTO `datosusuario` (`Id_user`, `Nombre`, `Apellidos`, `Teléfono`, `CorreoElectrónico`, `Danza`, `Pintura`, `Cocina`, `Tutor_Nombre`, `Tutor_apellidos`, `Tutor_Teléfono`, `Tutor_Dirección`, `Rol`) VALUES
(49, 'Sergio', 'Pedraza García', '7721878237', 'sergiopedraza1@gmail.com', 1, 0, 0, 'Ulises', 'Pedraza Torres', '7773432523', 'IXMIQUILPAN HGO', 'user'),
(50, 'Luis', 'Perez Contreras', '7727136623', 'luisP@gmail.com', 1, 1, 0, 'Geronimo Rafael', 'Remirez Durazno', '7776435354', 'IXMIQUILPAN HGO', 'user'),
(51, 'Beatriz ', 'Quitero Gutierrez', '7712233434', 'beatrizq@gmail.com', 1, 1, 0, 'Ulises', 'Rivera Torres', '7721265645', 'IXMIQUILPAN HGO', 'user'),
(52, 'Ramses', 'Hernandez Fazmin', '7767343532', 'RamsesH@gmail.com', 1, 0, 1, 'Toni', 'Benitez Kiwi', '8754532543', 'IXMIQUILPAN HGO', 'user'),
(53, 'David Ricardo', 'Isidro Lora Jdhdhhdhdhdhdhhdhdhdhdh', '7772183823', 'DavidLora@gmail.com', 1, 1, 1, 'Geronimo Rafael Hdhdhhdhdhdn Hhdhdh', 'Dhdhhdhdhdhdhhdh Bdhdhhdhdhdhdhdhhd', '7721267673', 'IXMIQUILPAN HGO', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `datosadministrador`
--
ALTER TABLE `datosadministrador`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `datosmedicos`
--
ALTER TABLE `datosmedicos`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `datosusuario`
--
ALTER TABLE `datosusuario`
  ADD PRIMARY KEY (`Id_user`),
  ADD UNIQUE KEY `Teléfono` (`Teléfono`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT de la tabla `datosadministrador`
--
ALTER TABLE `datosadministrador`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `datosmedicos`
--
ALTER TABLE `datosmedicos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `datosusuario`
--
ALTER TABLE `datosusuario`
  MODIFY `Id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
