-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 01-Jun-2017 às 20:38
-- Versão do servidor: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzaria`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE `administrador` (
  `administrador_id` int(11) NOT NULL,
  `administrador_nome` varchar(100) DEFAULT NULL,
  `administrador_login` varchar(100) DEFAULT NULL,
  `administrador_senha` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `administrador`
--

INSERT INTO `administrador` (`administrador_id`, `administrador_nome`, `administrador_login`, `administrador_senha`) VALUES
(1, 'Mr. Bean', 'bean', '123'),
(2, 'Sr. Burnnes', 'burnnes', '123'),
(4, 'Big Smoke', 'gordogta', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` int(11) NOT NULL,
  `categoria_nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `categoria_nome`) VALUES
(9, 'Doce'),
(11, 'Salgada'),
(12, 'Moda'),
(13, 'Especial');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cep`
--

CREATE TABLE `cep` (
  `nome` varchar(255) DEFAULT NULL,
  `cep_inicio` varchar(8) DEFAULT NULL,
  `cep_fim` varchar(8) DEFAULT NULL,
  `cep_calculador` varchar(8) DEFAULT NULL,
  `uf` char(2) NOT NULL,
  `estado` varchar(40) NOT NULL,
  `preco` decimal(6,2) DEFAULT NULL,
  `prazo` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cep`
--

INSERT INTO `cep` (`nome`, `cep_inicio`, `cep_fim`, `cep_calculador`, `uf`, `estado`, `preco`, `prazo`) VALUES
('AC - Capital', '69900000', '69920999', NULL, 'AC', 'Acre', NULL, NULL),
('AC - Interior', '69921000', '69999999', NULL, 'AC', 'Acre', NULL, NULL),
('AL - Capital', '57000000', '57099999', NULL, 'AL', 'Alagoas', NULL, NULL),
('AL - Interior', '57100000', '57999999', NULL, 'AL', 'Alagoas', NULL, NULL),
('AP - Capital', '68900000', '68911999', NULL, 'AP', 'Amapá', NULL, NULL),
('AP - Interior', '68912000', '68999999', NULL, 'AP', 'Amapá', NULL, NULL),
('AM - CAPITAL', '69000000', '69099999', NULL, 'AM', 'Amazonas', NULL, NULL),
('AM - INTERIOR', '69100000', '69299999', NULL, 'AM', 'Amazonas', NULL, NULL),
('BA - CAPITAL', '40000000', '42499999', NULL, 'BA', 'Bahia', NULL, NULL),
('BA - INTERIOR', '42500000', '48999999', NULL, 'BA', 'Bahia', NULL, NULL),
('CE - CAPITAL', '60000000', '61599999', NULL, 'CE', 'Ceará', NULL, NULL),
('CE - INTERIOR', '61600000', '63999999', NULL, 'CE', 'Ceará', NULL, NULL),
('DF - INTERIOR', '70000000', '72799999', NULL, 'DF', 'Distrito Federal', NULL, NULL),
('ES - CAPITAL', '29099999', '29099999', NULL, 'ES', 'Espírito Santo', NULL, NULL),
('ES - INTERIOR', '29100000', '29999999', NULL, 'ES', 'Espírito Santo', NULL, NULL),
('GO - CAPITAL', '76600000', '76600000', NULL, 'GO', 'Goiás', NULL, NULL),
('GO - INTERIOR', '72800000', '72999999', NULL, 'GO', 'Goiás', NULL, NULL),
('MA - CAPITAL', '65000000', '65109999', NULL, 'MA', 'Maranhão', NULL, NULL),
('MA - INTERIOR', '65110000', '65999999', NULL, 'MA', 'Maranhão', NULL, NULL),
('MT - CAPITAL', '78000000', '78099999', NULL, 'MT', 'Mato Grosso', NULL, NULL),
('MT - INTERIOR', '78100000', '78899999', NULL, 'MT', 'Mato Grosso', NULL, NULL),
('MS - CAPITAL', '79000000', '79124999', NULL, 'MS', 'Mato Grosso do Sul', NULL, NULL),
('MS - INTERIOR', '79125000', '79999999', NULL, 'MS', 'Mato Grosso do Sul', NULL, NULL),
('MG - CAPITAL', '30000000', '31999999', NULL, 'MG', 'Minas Gerais', NULL, NULL),
('MG - INTERIOR', '32000000', '39999999', NULL, 'MG', 'Minas Gerais', NULL, NULL),
('PA - CAPITAL', '66000000', '66999999', NULL, 'PA', 'Pará', NULL, NULL),
('PA - INTERIOR', '67000000', '68899999', NULL, 'PA', 'Pará', NULL, NULL),
('PR - CAPITAL', '80000000', '82999999', NULL, 'PR', 'Paraná', NULL, NULL),
('PR - INTERIOR', '83000000', '87999999', NULL, 'PR', 'Paraná', NULL, NULL),
('PE - CAPITAL', '50000000', '52999999', NULL, 'PE', 'Pernambuco', NULL, NULL),
('PE - INTERIOR', '53000000', '56999999', NULL, 'PE', 'Pernambuco', NULL, NULL),
('PI - CAPITAL', '64000000', '64099999', NULL, 'PI', 'Piauí', NULL, NULL),
('PI - INTERIOR', '64100000', '64999999', NULL, 'PI', 'Piauí', NULL, NULL),
('RJ - CAPITAL', '20000000', '23799999', NULL, 'RJ', 'Rio de Janeiro', NULL, NULL),
('RJ - INTERIOR', '23800000', '28999999', NULL, 'RJ', 'Rio de Janeiro', NULL, NULL),
('RN - CAPITAL', '59000000', '59139999', NULL, 'RN', 'Rio Grande do Norte', NULL, NULL),
('RN - INTERIOR', '59140000', '59999999', NULL, 'RN', 'Rio Grande do Norte', NULL, NULL),
('RS - CAPITAL', '90000000', '91999999', NULL, 'RS', 'Rio Grande do Sul', NULL, NULL),
('RS - INTERIOR', '92000000', '99999999', NULL, 'RS', 'Rio Grande do Sul', NULL, NULL),
('RO - CAPITAL', '78900000', '78924999', NULL, 'RO', 'Rondônia', NULL, NULL),
('RO - INTERIOR', '78925000', '78999999', NULL, 'RO', 'Rondônia', NULL, NULL),
('RR - CAPITAL', '69300000', '69339999', NULL, 'RR', 'Roraima', NULL, NULL),
('RR - INTERIOR', '69340000', '69399999', NULL, 'RR', 'Roraima', NULL, NULL),
('SC - CAPITAL', '88000000', '88099999', NULL, 'SC', 'Santa Catarina', NULL, NULL),
('SC - INTERIOR', '88100000', '89999999', NULL, 'SC', 'Santa Catarina', NULL, NULL),
('SP - CAPITAL', '01000000', '05999999', NULL, 'SP', 'São Paulo', NULL, NULL),
('SP - INTERIOR', '08450000', '19999999', NULL, 'SP', 'São Paulo', NULL, NULL),
('SE - CAPITAL', '49000000', '49098999', NULL, 'SE', 'Sergipe', NULL, NULL),
('SE - INTERIOR', '49099999', '49999999', NULL, 'SE', 'Sergipe', NULL, NULL),
('TO - CAPITAL', '77000000', '77249999', NULL, 'TO', 'Tocantins', NULL, NULL),
('TO - INTERIOR', '77250000', '77999999', NULL, 'TO', 'Tocantins', NULL, NULL),
('AM - INTERIOR', '69300000', '69899999', NULL, 'AM', 'Amazonas', NULL, NULL),
('DF - CAPITAL', '73000000', '73699999', NULL, 'DF', 'Distrito Federal', NULL, NULL),
('GO - INTERIOR', '73700000', '76599999', NULL, 'GO', 'Goiás', NULL, NULL),
('GO - CAPITAL', '76629970', '76629970', NULL, 'GO', 'Goiás', NULL, NULL),
('SP - CAPITAL', '08000000', '08499999', NULL, 'SP', 'São Paulo', NULL, NULL),
('DF - CAPITAL ', '70000001', '70639999', NULL, 'DF', 'Distrito Federal', NULL, NULL),
('DF - CAPITAL', '70700000', '70999999', NULL, 'DF', 'Distrito Federal', NULL, NULL),
('GO - INTERIOR', '76600001', '76999999', NULL, 'GO', 'Goiás', NULL, NULL),
('PB - Capital', '58000000', '58500000', NULL, 'PB', 'Paraiba', NULL, NULL),
('PB - Interior', '58501000', '58999999', NULL, 'PB', 'Paraiba', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `cliente_id` int(11) NOT NULL,
  `cliente_nome` varchar(200) NOT NULL,
  `cliente_cidade` varchar(200) NOT NULL,
  `cliente_estado` char(2) NOT NULL,
  `cliente_bairro` varchar(100) NOT NULL,
  `cliente_cep` varchar(9) NOT NULL,
  `cliente_telefone` varchar(15) NOT NULL,
  `cliente_celular` varchar(15) NOT NULL,
  `cliente_email` varchar(50) NOT NULL,
  `cliente_endereco` varchar(200) NOT NULL,
  `cliente_login` varchar(100) NOT NULL,
  `cliente_senha` varchar(100) NOT NULL,
  `cliente_nascimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`cliente_id`, `cliente_nome`, `cliente_cidade`, `cliente_estado`, `cliente_bairro`, `cliente_cep`, `cliente_telefone`, `cliente_celular`, `cliente_email`, `cliente_endereco`, `cliente_login`, `cliente_senha`, `cliente_nascimento`) VALUES
(1, 'Carl Johnson', 'João Pessoa', 'PB', 'Cristo', '58070-540', '8888-8888', '9999-9999', '', 'Rua Morise Miranda de Gusmão', 'cj', '123', '1990-10-10'),
(2, 'Son Goku', 'João Pessoa', 'PB', 'Cristo', '58071-180', '3223-3030', '98767-5657', '', 'Rua Leonel Pinto de Abreu', 'goku', '123', '1991-01-01'),
(3, 'Piccolo Daimao', 'João Pessoa', 'PB', 'Cristo', '58071-180', '(83)9898-9898', '(83)9898-9898', 'piccolo@gmail.com', 'Rua Leonel Pinto de Abreu 404', 'piccolo', '123', '1777-07-07'),
(5, 'Ryder', 'Los Santos', 'PB', 'Groove Street', '58070-540', '(83)3223-3333', '(83)9878-6546', 'rydergta@gmail.com', 'Groove Street S/N', 'ryder', '123', '2112-12-21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE `contato` (
  `contato_id` int(11) NOT NULL,
  `contato_nome` varchar(100) NOT NULL,
  `contato_cidade` varchar(50) NOT NULL,
  `contato_email` varchar(50) NOT NULL,
  `contato_telefone` varchar(15) NOT NULL,
  `contato_celular` varchar(15) NOT NULL,
  `contato_assunto` varchar(50) NOT NULL,
  `contato_mensagem` text NOT NULL,
  `contato_data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cupom`
--

CREATE TABLE `cupom` (
  `cupom_id` int(11) NOT NULL,
  `cupom_nome` varchar(50) NOT NULL,
  `cupom_cliente` int(11) NOT NULL,
  `cupom_vencimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_login_administrador`
--

CREATE TABLE `dados_login_administrador` (
  `dados_login_administrador_id` int(11) NOT NULL,
  `dados_login_administrador` int(11) NOT NULL,
  `dados_login_administrador_data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `dados_login_administrador`
--

INSERT INTO `dados_login_administrador` (`dados_login_administrador_id`, `dados_login_administrador`, `dados_login_administrador_data`) VALUES
(1, 1, '2017-05-30 12:28:20'),
(2, 1, '2017-05-30 12:28:38'),
(3, 1, '2017-05-30 13:06:06'),
(4, 2, '2017-05-31 11:17:02'),
(5, 1, '2017-05-31 11:38:52'),
(6, 1, '2017-05-31 11:45:32'),
(7, 1, '2017-05-31 11:46:51'),
(8, 1, '2017-05-31 13:12:13'),
(9, 1, '2017-05-31 13:15:11'),
(10, 2, '2017-05-31 13:16:08'),
(11, 1, '2017-05-31 13:18:26'),
(12, 1, '2017-05-31 17:56:12'),
(13, 1, '2017-05-31 18:21:44'),
(14, 1, '2017-05-31 19:21:40'),
(15, 1, '2017-05-31 19:27:24'),
(16, 1, '2017-05-31 20:28:58'),
(17, 1, '2017-05-31 20:33:26'),
(18, 1, '2017-05-31 20:36:22'),
(19, 1, '2017-05-31 22:33:58'),
(20, 3, '2017-05-31 22:41:15'),
(21, 1, '2017-05-31 22:43:03'),
(22, 1, '2017-05-31 22:59:26'),
(23, 1, '2017-05-31 23:17:23'),
(24, 2, '2017-05-31 23:21:28'),
(25, 1, '2017-05-31 23:23:11'),
(26, 1, '2017-05-31 23:28:55'),
(27, 1, '2017-05-31 23:47:32'),
(28, 1, '2017-05-31 23:58:08'),
(29, 1, '2017-06-01 00:26:57'),
(30, 1, '2017-06-01 00:37:50'),
(31, 1, '2017-06-01 03:37:24'),
(32, 1, '2017-06-01 05:21:41'),
(33, 1, '2017-06-01 06:04:16'),
(34, 1, '2017-06-01 17:32:57');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_login_cliente`
--

CREATE TABLE `dados_login_cliente` (
  `dados_login_cliente_id` int(11) NOT NULL,
  `dados_login_cliente` int(11) NOT NULL,
  `dados_login_cliente_data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `metas`
--

CREATE TABLE `metas` (
  `meta_id` int(11) NOT NULL,
  `meta_tipo` int(11) NOT NULL,
  `meta_texto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `metas`
--

INSERT INTO `metas` (`meta_id`, `meta_tipo`, `meta_texto`) VALUES
(1, 1, 'O melhor site de pizzaria de João Pessoa'),
(2, 2, 'pizzaria, online, quatro queijos, portuguesa, pizza chocolate.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `metas_tipo`
--

CREATE TABLE `metas_tipo` (
  `metas_tipo_id` int(11) NOT NULL,
  `metas_tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `metas_tipo`
--

INSERT INTO `metas_tipo` (`metas_tipo_id`, `metas_tipo`) VALUES
(1, 'description'),
(2, 'keywords');

-- --------------------------------------------------------

--
-- Estrutura da tabela `meus_pedidos`
--

CREATE TABLE `meus_pedidos` (
  `meus_pedidos_id` int(11) NOT NULL,
  `meus_pedidos_cliente` int(11) NOT NULL,
  `meus_pedidos_data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `meus_pedidos_tipo_pagamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `pedidos_id` int(11) NOT NULL,
  `pedidos_cliente` int(11) NOT NULL,
  `pedidos_data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pedidos_tipo_pagamento` int(11) NOT NULL,
  `pedidos_pizza` int(11) NOT NULL,
  `pedidos_status` varchar(50) NOT NULL,
  `pedidos_qtd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`pedidos_id`, `pedidos_cliente`, `pedidos_data`, `pedidos_tipo_pagamento`, `pedidos_pizza`, `pedidos_status`, `pedidos_qtd`) VALUES
(1, 2, '2017-06-01 10:01:58', 2, 12, 'pendente', 1),
(2, 2, '2017-06-01 10:01:58', 2, 9, 'pendente', 1),
(3, 2, '2017-06-01 10:01:58', 2, 13, 'pendente', 7),
(4, 3, '2017-06-01 22:54:09', 1, 10, 'pendente', 4),
(5, 3, '2017-06-01 23:07:33', 1, 12, 'pendente', 2),
(6, 3, '2017-06-01 23:08:04', 2, 15, 'pendente', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pizzas`
--

CREATE TABLE `pizzas` (
  `pizza_id` int(11) NOT NULL,
  `pizza_categoria` int(11) NOT NULL,
  `pizza_nome` varchar(150) NOT NULL,
  `pizza_preco` decimal(6,2) NOT NULL,
  `pizza_descricao` text NOT NULL,
  `pizza_foto_inicio` varchar(150) NOT NULL,
  `pizza_foto_detalhes` varchar(150) NOT NULL,
  `pizza_foto_pedido` varchar(150) NOT NULL,
  `pizza_nome_url` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pizzas`
--

INSERT INTO `pizzas` (`pizza_id`, `pizza_categoria`, `pizza_nome`, `pizza_preco`, `pizza_descricao`, `pizza_foto_inicio`, `pizza_foto_detalhes`, `pizza_foto_pedido`, `pizza_nome_url`) VALUES
(5, 9, 'Chocolate', '15.00', 'Pizza de chocolate', 'fotos/4fcd810a9a0ce.jpg', 'detalhes/4fcd810a9a0ce.jpg', '', NULL),
(6, 11, 'Portuguesa', '15.00', '																		Pizza portuguesa														', 'fotos/4fcd81449ee0f.jpg', 'detalhes/4fcd81449ee0f.jpg', '', NULL),
(8, 12, 'Moda', '15.00', '																		Pizza a moda														', 'fotos/4fcd747c73e92.jpg', 'detalhes/4fcd747c73e92.jpg', '', NULL),
(9, 11, '4 queijos', '85.00', '																		Pizza 4 queijos															', 'fotos/4fcd8157732d2.jpg', 'detalhes/4fcd8157732d2.jpg', '', NULL),
(10, 11, 'Bacon', '99.00', '												Pizza de bacon', 'fotos/4fcd82fa56d26.jpg', 'detalhes/4fcd82fa56d26.jpg', '', NULL),
(11, 9, 'Morango', '15.00', '						Pizza de morango			', 'fotos/4fce3c04688d9.jpg', 'detalhes/4fce3c04688d9.jpg', '', 'acucar tipo 1'),
(12, 11, 'Calabresa', '56.98', '												Pizza de calabresa', 'fotos/4fce6a23dac5d.jpg', 'detalhes/4fce6a23dac5d.jpg', '', NULL),
(13, 12, 'Moda 2', '55.00', '						Pizza a moda 2				', 'fotos/4fce6a468416e.jpg', 'detalhes/4fce6a468416e.jpg', '', NULL),
(14, 9, 'Prestigio', '15.00', '						Pizza de prestigio				', 'fotos/4fce705736def.jpg', 'detalhes/4fce705736def.jpg', '', NULL),
(15, 12, 'Moda 3', '15.00', '			Moda 3	', 'fotos/4fce706b1fcd0.jpg', 'detalhes/4fce706b1fcd0.jpg', '', NULL),
(16, 11, 'Americana', '15.00', '																		Pizza Americana', 'fotos/4fce7082bacc3.jpg', 'detalhes/4fce7082bacc3.jpg', '', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_pagamento`
--

CREATE TABLE `tipo_pagamento` (
  `tipo_pagamento_id` int(11) NOT NULL,
  `tipo_pagamento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_pagamento`
--

INSERT INTO `tipo_pagamento` (`tipo_pagamento_id`, `tipo_pagamento`) VALUES
(1, 'Receber em casa'),
(2, 'Pagar ao buscar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`administrador_id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indexes for table `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`contato_id`);

--
-- Indexes for table `cupom`
--
ALTER TABLE `cupom`
  ADD PRIMARY KEY (`cupom_id`);

--
-- Indexes for table `dados_login_administrador`
--
ALTER TABLE `dados_login_administrador`
  ADD PRIMARY KEY (`dados_login_administrador_id`);

--
-- Indexes for table `dados_login_cliente`
--
ALTER TABLE `dados_login_cliente`
  ADD PRIMARY KEY (`dados_login_cliente_id`);

--
-- Indexes for table `metas`
--
ALTER TABLE `metas`
  ADD PRIMARY KEY (`meta_id`);

--
-- Indexes for table `metas_tipo`
--
ALTER TABLE `metas_tipo`
  ADD PRIMARY KEY (`metas_tipo_id`);

--
-- Indexes for table `meus_pedidos`
--
ALTER TABLE `meus_pedidos`
  ADD PRIMARY KEY (`meus_pedidos_id`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`pedidos_id`);

--
-- Indexes for table `pizzas`
--
ALTER TABLE `pizzas`
  ADD PRIMARY KEY (`pizza_id`);

--
-- Indexes for table `tipo_pagamento`
--
ALTER TABLE `tipo_pagamento`
  ADD PRIMARY KEY (`tipo_pagamento_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrador`
--
ALTER TABLE `administrador`
  MODIFY `administrador_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `contato`
--
ALTER TABLE `contato`
  MODIFY `contato_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cupom`
--
ALTER TABLE `cupom`
  MODIFY `cupom_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dados_login_administrador`
--
ALTER TABLE `dados_login_administrador`
  MODIFY `dados_login_administrador_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `dados_login_cliente`
--
ALTER TABLE `dados_login_cliente`
  MODIFY `dados_login_cliente_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `metas`
--
ALTER TABLE `metas`
  MODIFY `meta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `metas_tipo`
--
ALTER TABLE `metas_tipo`
  MODIFY `metas_tipo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `meus_pedidos`
--
ALTER TABLE `meus_pedidos`
  MODIFY `meus_pedidos_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `pedidos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pizzas`
--
ALTER TABLE `pizzas`
  MODIFY `pizza_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tipo_pagamento`
--
ALTER TABLE `tipo_pagamento`
  MODIFY `tipo_pagamento_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
