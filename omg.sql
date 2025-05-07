-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/05/2025 às 17:13
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `omg`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `conservaçao_predial`
--

CREATE TABLE `conservaçao_predial` (
  `id` int(11) NOT NULL,
  `estado` varchar(200) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `eletrica`
--

CREATE TABLE `eletrica` (
  `id` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `gases_medicinais`
--

CREATE TABLE `gases_medicinais` (
  `id` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `hidráulica`
--

CREATE TABLE `hidráulica` (
  `id` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico_semanal`
--

CREATE TABLE `historico_semanal` (
  `id` int(11) NOT NULL,
  `semana` varchar(20) DEFAULT NULL,
  `setor` varchar(50) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `data_registro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `marcenaria`
--

CREATE TABLE `marcenaria` (
  `id` int(11) NOT NULL,
  `estado` varchar(200) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mecânica`
--

CREATE TABLE `mecânica` (
  `id` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pintura`
--

CREATE TABLE `pintura` (
  `id` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `refrigeração`
--

CREATE TABLE `refrigeração` (
  `id` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sistema_de_tratamento_agua`
--

CREATE TABLE `sistema_de_tratamento_agua` (
  `id` int(11) NOT NULL,
  `estado` varchar(200) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `conservaçao_predial`
--
ALTER TABLE `conservaçao_predial`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `eletrica`
--
ALTER TABLE `eletrica`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `gases_medicinais`
--
ALTER TABLE `gases_medicinais`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `hidráulica`
--
ALTER TABLE `hidráulica`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `historico_semanal`
--
ALTER TABLE `historico_semanal`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `marcenaria`
--
ALTER TABLE `marcenaria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `mecânica`
--
ALTER TABLE `mecânica`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pintura`
--
ALTER TABLE `pintura`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `refrigeração`
--
ALTER TABLE `refrigeração`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `sistema_de_tratamento_agua`
--
ALTER TABLE `sistema_de_tratamento_agua`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `conservaçao_predial`
--
ALTER TABLE `conservaçao_predial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `eletrica`
--
ALTER TABLE `eletrica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `gases_medicinais`
--
ALTER TABLE `gases_medicinais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `hidráulica`
--
ALTER TABLE `hidráulica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `historico_semanal`
--
ALTER TABLE `historico_semanal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `marcenaria`
--
ALTER TABLE `marcenaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mecânica`
--
ALTER TABLE `mecânica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pintura`
--
ALTER TABLE `pintura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `refrigeração`
--
ALTER TABLE `refrigeração`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sistema_de_tratamento_agua`
--
ALTER TABLE `sistema_de_tratamento_agua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
