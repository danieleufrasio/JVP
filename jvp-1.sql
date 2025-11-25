-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25/11/2025 às 00:25
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `jvp-1`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `codigo_interno` varchar(20) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `status` varchar(20) NOT NULL,
  `criadoem` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `codigo`, `codigo_interno`, `nome`, `status`, `criadoem`) VALUES
(1, 'CLI001', '777', 'Cliente Exemplo', 'ativo', '2025-11-24 10:58:31'),
(2, 'CLI002', 'INT002', 'Construtora Alta', 'ativo', '2025-11-24 10:58:31'),
(3, 'CLI003', 'INT003', 'Beta Engenharia', 'inativo', '2025-11-24 10:58:31'),
(4, 'CLI004', 'INT004', 'Gamma Serviços', 'ativo', '2025-11-24 10:58:31'),
(5, 'CLI005', 'INT005', 'Delta Projetos', 'ativo', '2025-11-24 10:58:31');

-- --------------------------------------------------------

--
-- Estrutura para tabela `colaboradores`
--

CREATE TABLE `colaboradores` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `nivelacesso` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `colaboradores`
--

INSERT INTO `colaboradores` (`id`, `codigo`, `nome`, `email`, `nivelacesso`, `status`, `usuario`, `senha`) VALUES
(10, '777', 'Carla Ramos', 'carla@example.com', 'verificador', 'ativo', 'carlar', '$2y$10$1VHTeNG5XA1ZWHhOJewkqujiKMYXihpAFyoJCrJ7yaGwD2qdj211m');

-- --------------------------------------------------------

--
-- Estrutura para tabela `elementos`
--

CREATE TABLE `elementos` (
  `id` int(11) NOT NULL,
  `tipo_projeto_id` int(11) NOT NULL,
  `sigla` varchar(10) NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `criadoem` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `elementos`
--

INSERT INTO `elementos` (`id`, `tipo_projeto_id`, `sigla`, `descricao`, `criadoem`) VALUES
(1, 1, 'VIG', 'Viga de Concreto', '2025-11-24 11:03:28'),
(2, 1, 'PIL', 'Pilar Estrutural', '2025-11-24 11:03:28'),
(3, 2, 'TOM', 'Tomada de Piso', '2025-11-24 11:03:28'),
(4, 3, 'HDI', 'Hidrante Interno', '2025-11-24 11:03:28'),
(5, 4, 'GPS', 'Geoponto de Sondagem', '2025-11-24 11:03:28'),
(6, 5, 'EIV', 'Entrada de Água Industrial', '2025-11-24 11:03:28');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `fornecedor` varchar(150) NOT NULL,
  `status` varchar(20) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `criadoem` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id`, `codigo`, `fornecedor`, `status`, `descricao`, `criadoem`) VALUES
(1, 'FORN001', 'Construmix Materiais', 'ativo', 'Materiais básicos para obras civis', '2025-11-24 11:07:25'),
(2, 'FORN002', 'Alpha Ferragens', 'ativo', 'Ferragens e metais estruturais', '2025-11-24 11:07:25'),
(3, 'FORN003', 'Beta Elétrica', 'ativo', 'Fornecimento de equipamentos elétricos', '2025-11-24 11:07:25'),
(4, 'FORN004', 'Gamma Pavimentações', 'ativo', 'Serviços de pavimentação e asfaltamento', '2025-11-24 11:07:25'),
(5, 'FORN005', 'Delta Engenharia', 'inativo', 'Engenharia de projetos e consultoria', '2025-11-24 11:07:25');

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagens`
--

CREATE TABLE `imagens` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `is_background` tinyint(1) NOT NULL DEFAULT 0,
  `criadoem` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `obras`
--

CREATE TABLE `obras` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `clienteid` int(11) NOT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'ativo',
  `dataconclusao` date DEFAULT NULL,
  `criadoem` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `obras`
--

INSERT INTO `obras` (`id`, `codigo`, `nome`, `clienteid`, `endereco`, `status`, `dataconclusao`, `criadoem`) VALUES
(1, 'OBR001', 'Residencial Primavera', 1, 'Rua das Flores, 123', 'ativo', '2026-05-15', '2025-11-24 11:10:52'),
(2, 'OBR002', 'Centro Comercial Alpha', 2, 'Av. Central, 512', 'ativo', '2025-12-01', '2025-11-24 11:10:52'),
(3, 'OBR003', 'Hospital Beta', 3, 'Rua Saúde, 933', 'inativo', NULL, '2025-11-24 11:10:52');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pavimentos`
--

CREATE TABLE `pavimentos` (
  `id` int(11) NOT NULL,
  `obraid` int(11) NOT NULL,
  `sigla` varchar(20) NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `criadoem` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pavimentos`
--

INSERT INTO `pavimentos` (`id`, `obraid`, `sigla`, `descricao`, `criadoem`) VALUES
(1, 1, 'TÉRREO', 'Pavimento Térreo', '2025-11-24 11:08:29'),
(2, 1, '1ANDAR', 'Primeiro Andar', '2025-11-24 11:08:29'),
(3, 1, 'COBERT', 'Cobertura', '2025-11-24 11:08:29'),
(4, 2, 'SUBSOLO1', 'Primeiro Subsolo', '2025-11-24 11:08:29'),
(5, 2, 'SUBSOLO2', 'Segundo Subsolo', '2025-11-24 11:08:29');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pranchas`
--

CREATE TABLE `pranchas` (
  `id` int(11) NOT NULL,
  `clienteid` int(11) NOT NULL,
  `obraid` int(11) NOT NULL,
  `tipo_projeto_id` int(11) NOT NULL,
  `elemento_id` int(11) NOT NULL,
  `pavimento_id` int(11) NOT NULL,
  `tipo_papel_id` int(11) NOT NULL,
  `codigo` varchar(30) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'ativo',
  `criadoem` datetime DEFAULT current_timestamp(),
  `projetado_id` int(11) DEFAULT NULL,
  `verificado_id` int(11) DEFAULT NULL,
  `calculado_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pranchas`
--

INSERT INTO `pranchas` (`id`, `clienteid`, `obraid`, `tipo_projeto_id`, `elemento_id`, `pavimento_id`, `tipo_papel_id`, `codigo`, `descricao`, `arquivo`, `status`, `criadoem`, `projetado_id`, `verificado_id`, `calculado_id`) VALUES
(13, 5, 2, 9, 6, 1, 4, '530', '', '', 'ativo', '2025-11-24 15:18:39', 10, 10, 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos`
--

CREATE TABLE `servicos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `criadoem` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipos_papel`
--

CREATE TABLE `tipos_papel` (
  `id` int(11) NOT NULL,
  `sigla` varchar(5) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `equivalencia` decimal(6,3) NOT NULL,
  `valor_equivalencia` decimal(6,3) NOT NULL,
  `criadoem` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipos_papel`
--

INSERT INTO `tipos_papel` (`id`, `sigla`, `descricao`, `equivalencia`, `valor_equivalencia`, `criadoem`) VALUES
(1, 'A4', 'Folha A4', 0.125, 0.125, '2025-11-24 11:04:36'),
(2, 'A3', 'Folha A3', 0.250, 0.250, '2025-11-24 11:04:36'),
(3, 'A2', 'Folha A2', 0.500, 0.500, '2025-11-24 11:04:36'),
(4, 'A1', 'Folha A1', 1.000, 1.000, '2025-11-24 11:04:36'),
(5, 'A0', 'Folha A0', 2.000, 2.000, '2025-11-24 11:04:36');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipos_projeto`
--

CREATE TABLE `tipos_projeto` (
  `id` int(11) NOT NULL,
  `sigla` varchar(10) NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `criadoem` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipos_projeto`
--

INSERT INTO `tipos_projeto` (`id`, `sigla`, `descricao`, `criadoem`) VALUES
(1, 'AE', 'Arquitetura e Engenharia', '2025-11-24 11:02:18'),
(2, 'EC', 'Estruturas de Concreto', '2025-11-24 11:02:18'),
(3, 'EL', 'Instalações Elétricas', '2025-11-24 11:02:18'),
(4, 'SP', 'Serviços de Pavimentação', '2025-11-24 11:02:18'),
(5, 'GEO', 'Geotecnia', '2025-11-24 11:02:18'),
(6, 'HD', 'Hidrossanitário', '2025-11-24 11:02:18'),
(7, 'APL', 'Geral', '2025-11-24 11:48:34'),
(8, 'APL', 'Geral', '2025-11-24 11:48:41'),
(9, 'APL', 'Geral', '2025-11-24 11:48:47'),
(10, 'APL', 'Geral', '2025-11-24 11:50:42');

-- --------------------------------------------------------

--
-- Estrutura para tabela `visitantesfeedback`
--

CREATE TABLE `visitantesfeedback` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `comentario` text NOT NULL,
  `nota` tinyint(4) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `criadoem` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `elementos`
--
ALTER TABLE `elementos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_projeto_id` (`tipo_projeto_id`);

--
-- Índices de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `imagens`
--
ALTER TABLE `imagens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `obras`
--
ALTER TABLE `obras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clienteid` (`clienteid`);

--
-- Índices de tabela `pavimentos`
--
ALTER TABLE `pavimentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pranchas`
--
ALTER TABLE `pranchas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clienteid` (`clienteid`),
  ADD KEY `obraid` (`obraid`),
  ADD KEY `pavimento_id` (`pavimento_id`),
  ADD KEY `tipo_papel_id` (`tipo_papel_id`),
  ADD KEY `fk_pranchas_tipo_projeto` (`tipo_projeto_id`),
  ADD KEY `fk_pranchas_elemento` (`elemento_id`),
  ADD KEY `fk_pranchas_projetado` (`projetado_id`),
  ADD KEY `fk_pranchas_verificado` (`verificado_id`),
  ADD KEY `fk_pranchas_calculado` (`calculado_id`);

--
-- Índices de tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tipos_papel`
--
ALTER TABLE `tipos_papel`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tipos_projeto`
--
ALTER TABLE `tipos_projeto`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `visitantesfeedback`
--
ALTER TABLE `visitantesfeedback`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `colaboradores`
--
ALTER TABLE `colaboradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `elementos`
--
ALTER TABLE `elementos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `imagens`
--
ALTER TABLE `imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `obras`
--
ALTER TABLE `obras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `pavimentos`
--
ALTER TABLE `pavimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `pranchas`
--
ALTER TABLE `pranchas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tipos_papel`
--
ALTER TABLE `tipos_papel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tipos_projeto`
--
ALTER TABLE `tipos_projeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `visitantesfeedback`
--
ALTER TABLE `visitantesfeedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `elementos`
--
ALTER TABLE `elementos`
  ADD CONSTRAINT `elementos_ibfk_1` FOREIGN KEY (`tipo_projeto_id`) REFERENCES `tipos_projeto` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `obras`
--
ALTER TABLE `obras`
  ADD CONSTRAINT `obras_ibfk_1` FOREIGN KEY (`clienteid`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `pranchas`
--
ALTER TABLE `pranchas`
  ADD CONSTRAINT `fk_pranchas_calculado` FOREIGN KEY (`calculado_id`) REFERENCES `colaboradores` (`id`),
  ADD CONSTRAINT `fk_pranchas_elemento` FOREIGN KEY (`elemento_id`) REFERENCES `elementos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pranchas_projetado` FOREIGN KEY (`projetado_id`) REFERENCES `colaboradores` (`id`),
  ADD CONSTRAINT `fk_pranchas_tipo_projeto` FOREIGN KEY (`tipo_projeto_id`) REFERENCES `tipos_projeto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pranchas_verificado` FOREIGN KEY (`verificado_id`) REFERENCES `colaboradores` (`id`),
  ADD CONSTRAINT `pranchas_ibfk_1` FOREIGN KEY (`clienteid`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pranchas_ibfk_2` FOREIGN KEY (`obraid`) REFERENCES `obras` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pranchas_ibfk_5` FOREIGN KEY (`pavimento_id`) REFERENCES `pavimentos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pranchas_ibfk_6` FOREIGN KEY (`tipo_papel_id`) REFERENCES `tipos_papel` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
