-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 14/05/2026 às 14:44
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_alpha`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_pedido`
--

DROP TABLE IF EXISTS `tb_pedido`;
CREATE TABLE IF NOT EXISTS `tb_pedido` (
  `ID_PEDIDO` int NOT NULL AUTO_INCREMENT,
  `ID_USUARIO` int NOT NULL,
  `BANCO_PEDIDO` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `CONTA_PEDIDO` varchar(30) COLLATE utf8mb3_unicode_ci NOT NULL,
  `CAPITAL_PEDIDO` decimal(10,2) NOT NULL,
  `TAXA_PEDIDO` decimal(10,2) NOT NULL,
  `TEMPO_PEDIDO` int NOT NULL,
  `RENDIMENTO_PEDIDO` decimal(10,2) NOT NULL,
  `TOTAL_PEDIDO` decimal(10,2) NOT NULL,
  PRIMARY KEY (`ID_PEDIDO`),
  KEY `FK_USUARIO_PEDIDO` (`ID_USUARIO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuario`
--

DROP TABLE IF EXISTS `tb_usuario`;
CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `ID_USUARIO` int NOT NULL AUTO_INCREMENT,
  `NOME_USUARIO` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `CPF_USUARIO` varchar(14) COLLATE utf8mb3_unicode_ci NOT NULL,
  `EMAIL_USUARIO` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `SENHA_USUARIO` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_USUARIO`),
  UNIQUE KEY `EMAIL_USUARIO` (`EMAIL_USUARIO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
