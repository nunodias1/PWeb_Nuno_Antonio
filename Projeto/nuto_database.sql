-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Jan-2024 às 11:06
-- Versão do servidor: 10.4.10-MariaDB
-- versão do PHP: 7.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `nuto_database`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `comentario_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `comentario` text DEFAULT NULL,
  `sneaker_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sneakers`
--

CREATE TABLE `sneakers` (
  `sneaker_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `data_lancamento` date DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `sneakers`
--

INSERT INTO `sneakers` (`sneaker_id`, `nome`, `marca`, `data_lancamento`, `preco`, `imagem`) VALUES
(1, 'Air Max 1 Travis Scott', 'Nike', '2022-05-25', '150.00', 'https://images.stockx.com/360/Nike-Air-Max-1-Travis-Scott-Baroque-Brown/Images/Nike-Air-Max-1-Travis-Scott-Baroque-Brown/Lv2/img01.jpg?fm=avif&auto=compress&w=576&dpr=1&updated_at=1645099992&h=384&q=57'),
(2, 'Air Jordan 4 SB Pine Green', 'Nike', '2023-03-17', '225.00', 'https://images.stockx.com/360/Air-Jordan-4-Retro-SB-Pine-Green/Images/Air-Jordan-4-Retro-SB-Pine-Green/Lv2/img01.jpg?fm=avif&auto=compress&w=576&dpr=1&updated_at=1678350115&h=384&q=57'),
(3, 'Air Jordan 1 Retro High OG Washed Black', 'Nike', '2023-06-10', '180.00', 'https://images.stockx.com/360/Air-Jordan-1-Retro-High-OG-Washed-Black/Images/Air-Jordan-1-Retro-High-OG-Washed-Black/Lv2/img01.jpg?fm=avif&auto=compress&w=576&dpr=1&updated_at=1686248226&h=384&q=57');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`comentario_id`),
  ADD KEY `sneaker_id` (`sneaker_id`);

--
-- Índices para tabela `sneakers`
--
ALTER TABLE `sneakers`
  ADD PRIMARY KEY (`sneaker_id`);

--
-- Índices para tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `comentario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `sneakers`
--
ALTER TABLE `sneakers`
  MODIFY `sneaker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`sneaker_id`) REFERENCES `sneakers` (`sneaker_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
