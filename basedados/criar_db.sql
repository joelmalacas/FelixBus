-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 02, 2025 at 07:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `felixbus`
--
CREATE DATABASE IF NOT EXISTS `felixbus` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `felixbus`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_func`
--

CREATE TABLE `admin_func` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `cargo` varchar(30) DEFAULT NULL,
  `NIF` varchar(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_func`
--

INSERT INTO `admin_func` (`id`, `nome`, `email`, `password`, `estado`, `cargo`, `NIF`) VALUES
(5, 'Administrador', 'admin@felixbus.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'OFFLINE', 'ADMIN', '524801766'),
(8, 'Teste', 'teste@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'OFFLINE', 'FUNCIONARIO', '204571988');

-- --------------------------------------------------------

--
-- Table structure for table `alerta`
--

CREATE TABLE `alerta` (
  `id` int(11) NOT NULL,
  `nomeALERTA` varchar(50) DEFAULT NULL,
  `descricao` longtext DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alerta`
--

INSERT INTO `alerta` (`id`, `nomeALERTA`, `descricao`, `estado`) VALUES
(2, 'Greve do Fundão', 'Greve dia: 26 a 2 de janeiro', 'Visivel');

-- --------------------------------------------------------

--
-- Table structure for table `bilhete`
--

CREATE TABLE `bilhete` (
  `id` int(11) NOT NULL,
  `id_transacao` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_rota` int(11) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bilhete`
--

INSERT INTO `bilhete` (`id`, `id_transacao`, `id_cliente`, `id_rota`, `valor`, `estado`) VALUES
(1, 20, 15, 4, 15.00, 'Comprado'),
(2, 22, 15, 5, 17.00, 'Comprado'),
(3, 25, 15, 5, 18.00, 'Expirado'),
(4, 27, 15, 5, 19.00, 'Expirado'),
(5, 30, 17, 5, 11.00, 'Anulado'),
(6, 34, 17, 5, 15.00, 'Anulado'),
(7, 40, 17, 5, 14.00, 'Anulado'),
(8, 44, 17, 5, 16.00, 'Anulado'),
(9, 48, 17, 6, 18.00, 'Anulado'),
(10, 55, 8, 5, 8.00, 'Anulado'),
(11, 57, 17, 5, 8.00, 'Anulado');

-- --------------------------------------------------------

--
-- Table structure for table `carteira`
--

CREATE TABLE `carteira` (
  `id` int(11) NOT NULL,
  `NIF` varchar(9) DEFAULT NULL,
  `saldo` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carteira`
--

INSERT INTO `carteira` (`id`, `NIF`, `saldo`) VALUES
(1, '244497591', 7.00),
(2, '123456789', 39.00),
(9, '524801766', 69.00),
(12, '209815421', 22.00),
(18, '254908765', 0.00),
(19, '204571988', 35.00);

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `NIF` varchar(9) DEFAULT NULL,
  `telemovel` varchar(14) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `password`, `email`, `NIF`, `telemovel`, `estado`, `status`) VALUES
(14, 'Cabrito', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'cabrito@gmail.com', '244497591', '912977256', 'PENDENTE', 'OFFLINE'),
(15, 'Felipe', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'felipe@gmail.com', '123456789', '913331444', 'ACEITE', 'OFFLINE'),
(17, 'Tiago', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', 'tiago@gmail.com', '209815421', '912977256', 'ACEITE', 'OFFLINE'),
(18, 'Joel', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', 'joelmalacas@gmail.com', '254908765', '912977256', 'PENDENTE', 'OFFLINE');

-- --------------------------------------------------------

--
-- Table structure for table `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `localizacao` text DEFAULT NULL,
  `contactos` text DEFAULT NULL,
  `HorarioFuncionamento` text DEFAULT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `empresa`
--

INSERT INTO `empresa` (`id`, `localizacao`, `contactos`, `HorarioFuncionamento`, `descricao`) VALUES
(1, 'Avenida Central, 123, Cidade Nova', 'Telefone: (+351) 987654321, Email: contato@felixbus.pt', 'Segunda a Sexta: 08:00 - 18:00, Sábado: 09:00 - 14:00, Domingo: Fechado', 'FelixBus é uma empresa de transporte rodoviário especializada em viagens intermunicipais e fretamento, oferecendo segurança, conforto e pontualidade.');

-- --------------------------------------------------------

--
-- Table structure for table `rotas`
--

CREATE TABLE `rotas` (
  `id` int(11) NOT NULL,
  `origem` varchar(50) DEFAULT NULL,
  `destino` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rotas`
--

INSERT INTO `rotas` (`id`, `origem`, `destino`) VALUES
(4, 'Algarve', 'Lisboa Santa Apolónia'),
(5, 'Lisboa Santa Apolónia', 'Guimarães'),
(6, 'Lisboa Santa Apolónia', 'Porto');

-- --------------------------------------------------------

--
-- Table structure for table `time_rotas`
--

CREATE TABLE `time_rotas` (
  `id` int(11) NOT NULL,
  `Data_hora` datetime DEFAULT NULL,
  `capacidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `time_rotas`
--

INSERT INTO `time_rotas` (`id`, `Data_hora`, `capacidade`) VALUES
(4, '2024-12-23 18:45:00', 49),
(5, '2024-12-27 12:55:00', 37),
(6, '2025-01-15 14:30:00', 35);

-- --------------------------------------------------------

--
-- Table structure for table `transacoes`
--

CREATE TABLE `transacoes` (
  `id` int(11) NOT NULL,
  `NIF` varchar(9) DEFAULT NULL,
  `saldo` decimal(10,2) DEFAULT NULL,
  `transacao` varchar(10) DEFAULT NULL,
  `data_transacao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transacoes`
--

INSERT INTO `transacoes` (`id`, `NIF`, `saldo`, `transacao`, `data_transacao`) VALUES
(1, '123456789', 5.00, '+ 5', '2024-12-22 23:43:34'),
(2, '123456789', 20.00, '+ 15', '2024-12-23 00:03:28'),
(3, '244497591', 7.00, '+ 7', '2024-12-23 00:06:32'),
(4, '123456789', 32.00, '+ 12', '2024-12-23 02:24:56'),
(5, '209815421', 23.00, '+ 23', '2024-12-23 14:26:16'),
(6, '209815421', 28.00, '+ 5', '2024-12-23 14:26:49'),
(7, '123456789', 12.00, '- 20', '2024-12-26 00:44:36'),
(8, '123456789', 0.00, '- 12', '2024-12-26 00:44:55'),
(9, '123456789', 15.00, '+ 15', '2024-12-26 00:45:13'),
(10, '123456789', 28.00, '+ 13', '2024-12-26 14:16:00'),
(11, '123456789', 11.00, '- 17', '2024-12-26 15:05:16'),
(13, '123456789', 51.00, '+ 40', '2024-12-26 15:07:16'),
(14, '123456789', 41.00, '- 10', '2024-12-26 15:09:10'),
(16, '123456789', 38.00, '+ 20', '2024-12-26 15:28:53'),
(19, '123456789', 23.00, '- 15', '2024-12-26 15:37:13'),
(20, '524801766', 0.00, '+ 15', '2024-12-26 15:37:13'),
(21, '123456789', 6.00, '- 17', '2024-12-26 16:46:29'),
(22, '524801766', 0.00, '+ 17', '2024-12-26 16:46:29'),
(23, '123456789', 46.00, '+ 40', '2024-12-26 16:51:35'),
(24, '123456789', 28.00, '- 18', '2024-12-26 16:51:50'),
(25, '524801766', 28.00, '+ 18', '2024-12-26 16:51:50'),
(26, '123456789', 9.00, '- 19', '2024-12-26 16:58:06'),
(27, '524801766', 69.00, '+ 19', '2024-12-26 16:58:06'),
(28, '123456789', 39.00, '+ 30', '2024-12-26 19:25:29'),
(29, '209815421', 17.00, '- 11', '2024-12-30 22:13:12'),
(30, '524801766', 80.00, '+ 11', '2024-12-30 22:13:12'),
(31, '209815421', 28.00, '+ 11.00', '2024-12-30 23:01:26'),
(32, '524801766', 69.00, '- 11.00', '2024-12-30 23:01:26'),
(33, '209815421', 13.00, '- 15', '2024-12-30 23:07:25'),
(34, '524801766', 84.00, '+ 15', '2024-12-30 23:07:25'),
(35, '209815421', 28.00, '+ 15.00', '2024-12-30 23:07:35'),
(36, '524801766', 69.00, '- 15.00', '2024-12-30 23:07:35'),
(37, '209815421', 62.00, '+ 34', '2024-12-30 23:10:42'),
(38, '209815421', 37.00, '- 25', '2024-12-30 23:10:58'),
(39, '209815421', 23.00, '- 14', '2024-12-30 23:19:15'),
(40, '524801766', 83.00, '+ 14', '2024-12-30 23:19:15'),
(41, '209815421', 37.00, '+ 14.00', '2024-12-30 23:46:03'),
(42, '524801766', 69.00, '- 14.00', '2024-12-30 23:46:03'),
(43, '209815421', 21.00, '- 16', '2025-01-02 03:22:45'),
(44, '524801766', 85.00, '+ 16', '2025-01-02 03:22:45'),
(45, '209815421', 37.00, '+ 16.00', '2025-01-02 03:24:12'),
(46, '524801766', 69.00, '- 16.00', '2025-01-02 03:24:12'),
(47, '209815421', 19.00, '- 18', '2025-01-02 03:29:43'),
(48, '524801766', 87.00, '+ 18', '2025-01-02 03:29:43'),
(49, '209815421', 37.00, '+ 18.00', '2025-01-02 03:34:45'),
(50, '524801766', 69.00, '- 18.00', '2025-01-02 03:34:45'),
(51, '204571988', 20.00, '+ 20', '2025-01-02 15:24:11'),
(52, '204571988', 10.00, '- 10', '2025-01-02 15:30:29'),
(53, '204571988', 35.00, '+ 25', '2025-01-02 15:41:09'),
(54, '204571988', 27.00, '- 8', '2025-01-02 15:41:20'),
(55, '524801766', 77.00, '+ 8', '2025-01-02 15:41:20'),
(56, '209815421', 29.00, '- 8', '2025-01-02 16:23:35'),
(57, '524801766', 85.00, '+ 8', '2025-01-02 16:23:35'),
(58, '209815421', 37.00, '+ 8.00', '2025-01-02 16:23:41'),
(59, '524801766', 77.00, '- 8.00', '2025-01-02 16:23:41'),
(60, '204571988', 35.00, '+ 8.00', '2025-01-02 16:24:38'),
(61, '524801766', 69.00, '- 8.00', '2025-01-02 16:24:38'),
(63, '209815421', 12382.00, '+ 12345', '2025-01-02 16:58:38'),
(64, '209815421', 11382.00, '- 1000', '2025-01-02 16:59:20'),
(65, '209815421', 1382.00, '- 10000', '2025-01-02 16:59:35'),
(66, '209815421', 82.00, '- 1300', '2025-01-02 16:59:43'),
(67, '209815421', 52.00, '- 30', '2025-01-02 17:04:37'),
(68, '209815421', 22.00, '- 30', '2025-01-02 17:04:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_func`
--
ALTER TABLE `admin_func`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `NIF` (`NIF`);

--
-- Indexes for table `alerta`
--
ALTER TABLE `alerta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bilhete`
--
ALTER TABLE `bilhete`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transacao` (`id_transacao`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_rota` (`id_rota`);

--
-- Indexes for table `carteira`
--
ALTER TABLE `carteira`
  ADD PRIMARY KEY (`id`),
  ADD KEY `NIF` (`NIF`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `NIF` (`NIF`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rotas`
--
ALTER TABLE `rotas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_rotas`
--
ALTER TABLE `time_rotas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transacoes`
--
ALTER TABLE `transacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `NIF` (`NIF`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_func`
--
ALTER TABLE `admin_func`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `alerta`
--
ALTER TABLE `alerta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bilhete`
--
ALTER TABLE `bilhete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `carteira`
--
ALTER TABLE `carteira`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rotas`
--
ALTER TABLE `rotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `time_rotas`
--
ALTER TABLE `time_rotas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transacoes`
--
ALTER TABLE `transacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bilhete`
--
ALTER TABLE `bilhete`
  ADD CONSTRAINT `bilhete_ibfk_1` FOREIGN KEY (`id_transacao`) REFERENCES `transacoes` (`id`),
  ADD CONSTRAINT `bilhete_ibfk_3` FOREIGN KEY (`id_rota`) REFERENCES `rotas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
