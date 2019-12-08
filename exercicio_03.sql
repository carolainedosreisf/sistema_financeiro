-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 08-Dez-2019 às 19:55
-- Versão do servidor: 5.7.26
-- versão do PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exercicio_03`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `creditos`
--

DROP TABLE IF EXISTS `creditos`;
CREATE TABLE IF NOT EXISTS `creditos` (
  `id_credito` int(11) NOT NULL AUTO_INCREMENT,
  `id_plan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nome` text NOT NULL,
  `valor` double NOT NULL,
  PRIMARY KEY (`id_credito`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `creditos`
--

INSERT INTO `creditos` (`id_credito`, `id_plan`, `id_user`, `nome`, `valor`) VALUES
(19, 3, 1, 'salario', 1800),
(18, 7, 1, 'Farmacia', 1000),
(4, 3, 1, 'Extra', 700),
(21, 3, 1, 'Extra', 40),
(27, 20, 6, 'fgts', 164);

-- --------------------------------------------------------

--
-- Estrutura da tabela `debitos`
--

DROP TABLE IF EXISTS `debitos`;
CREATE TABLE IF NOT EXISTS `debitos` (
  `id_debito` int(11) NOT NULL AUTO_INCREMENT,
  `id_plan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nome` text NOT NULL,
  `valor` double NOT NULL,
  PRIMARY KEY (`id_debito`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `debitos`
--

INSERT INTO `debitos` (`id_debito`, `id_plan`, `id_user`, `nome`, `valor`) VALUES
(1, 3, 1, 'Mercado', 700),
(2, 3, 1, 'RaÃ§Ã£o', 60),
(4, 3, 1, 'Farmacia', 100),
(5, 3, 1, 'GÃ¡s', 77.6),
(7, 3, 1, 'Luz', 220.74),
(8, 3, 1, 'Roupas', 200.34),
(18, 3, 1, 'Lanche', 44.9),
(21, 23, 6, 'Lanche', 44.95),
(23, 20, 6, 'Lanche', 33.5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `planilhas`
--

DROP TABLE IF EXISTS `planilhas`;
CREATE TABLE IF NOT EXISTS `planilhas` (
  `id_plan` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `mes_ano` text NOT NULL,
  PRIMARY KEY (`id_plan`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `planilhas`
--

INSERT INTO `planilhas` (`id_plan`, `id_user`, `mes`, `ano`, `mes_ano`) VALUES
(3, 1, 6, 2019, '06/2019'),
(6, 1, 8, 2019, '08/2019'),
(5, 2, 4, 2019, '04/2019'),
(16, 1, 1, 2019, '01/2019'),
(20, 6, 9, 2019, '09/2019'),
(27, 6, 11, 2019, '11/2019');

-- --------------------------------------------------------

--
-- Estrutura da tabela `redefinir_senha`
--

DROP TABLE IF EXISTS `redefinir_senha`;
CREATE TABLE IF NOT EXISTS `redefinir_senha` (
  `id_user` int(11) NOT NULL,
  `valid` text NOT NULL,
  `time_d` varchar(200) NOT NULL,
  `data_d` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `cod_log` int(11) NOT NULL,
  `nome_img` text NOT NULL,
  `nome_img_original` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `sobrenome`, `telefone`, `email`, `senha`, `cod_log`, `nome_img`, `nome_img_original`) VALUES
(6, 'Carolaine', 'dos Reis Francisco', '48996725458', 'caroldosreis97@gmail.com', 'super123', 27505, 'padrao.jpg', 'padrao.jpg'),
(2, 'David', 'Vitor AntÃ´nio', '48996725458', 'david.vitora@gmail.com', 'superfantastico', 21997, 'padrao.jpg', 'padrao.jpg'),
(23, 'Sr. ', 'Teste', '(48) 99999-0000', 'teste@teste.com.br', 'super123', 0, 'thumbnail_1573482901.png', 'resize_1573482901.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
