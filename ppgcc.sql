-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Fev-2022 às 20:37
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ppgcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivo`
--

CREATE TABLE `arquivo` (
  `id` int(11) NOT NULL,
  `nome` text COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `caminho` text COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data_criacao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `arquivo`
--

INSERT INTO `arquivo` (`id`, `nome`, `tipo`, `caminho`, `id_usuario`, `data_criacao`) VALUES
(383, 'ps4.png0d1d0642536014c8a58165bd9e10954e.png', 'png', '../../assets/uploads/ps4.png0d1d0642536014c8a58165bd9e10954e.png', 1, '2022-01-28 14:33:38'),
(385, 'workshop.jpege9bb8cfa877b6c0c9cdc60136d3b119e.jpeg987244d8da3f9f503b7b05375858f23e.jpeg', 'jpeg', '../../assets/uploads/workshop.jpege9bb8cfa877b6c0c9cdc60136d3b119e.jpeg987244d8da3f9f503b7b05375858f23e.jpeg', 1, '2022-01-28 21:39:08'),
(389, 'Modelo de Requerimento.doc3f914154fa963f3f40221154452ff8d6.doc', 'doc', '../../assets/uploads/Modelo de Requerimento.doc3f914154fa963f3f40221154452ff8d6.doc', 1, '2022-01-29 18:02:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `defesas`
--

CREATE TABLE `defesas` (
  `id` int(11) NOT NULL,
  `titulo` text COLLATE utf8_unicode_ci NOT NULL,
  `local` text COLLATE utf8_unicode_ci NOT NULL,
  `horario` datetime NOT NULL,
  `conteudo` text COLLATE utf8_unicode_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `data_criacao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `defesas`
--

INSERT INTO `defesas` (`id`, `titulo`, `local`, `horario`, `conteudo`, `usuario_id`, `data_criacao`) VALUES
(20, 'adas 1', 'asdasd', '2022-01-28 13:26:00', '<p>zczsd</p>', 1, '2022-01-28 13:27:04'),
(21, 'ANÁLISE DA INFLUÊNCIA DE FATORES DE COMPLEXIDADE SOBRE O TEMPO DE VIDA DE PULL REQUESTS ANÁLISE DA INFLUÊNCIA DE FATORES DE COMPLEXIDADE SOBRE O TEMPO DE VIDA DE PULL REQUESTS', 'centro de convensoes', '2022-01-28 14:31:00', '<p><img src=\"../../assets/uploads/ps4.png0d1d0642536014c8a58165bd9e10954e.png\" alt=\"ps4.png0d1d0642536014c8a58165bd9e10954e.png\" width=\"600\" height=\"600\" />sdasd</p>', 1, '2022-01-28 14:31:17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia`
--

CREATE TABLE `noticia` (
  `id` int(11) NOT NULL,
  `titulo` text COLLATE utf8_unicode_ci NOT NULL,
  `previa` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `conteudo` text COLLATE utf8_unicode_ci NOT NULL,
  `img` text COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data_publicacao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `noticia`
--

INSERT INTO `noticia` (`id`, `titulo`, `previa`, `conteudo`, `img`, `id_usuario`, `data_publicacao`) VALUES
(97, 'Projeto Web Academy: Capacitação em desenvolvimento web full-stack Universidade Federal Acre', 'weqwe', '<p><img src=\"../../assets/uploads/workshop.jpege9bb8cfa877b6c0c9cdc60136d3b119e.jpeg987244d8da3f9f503b7b05375858f23e.jpeg\" alt=\"workshop.jpege9bb8cfa877b6c0c9cdc60136d3b119e.jpeg987244d8da3f9f503b7b05375858f23e.jpeg\" width=\"900\" height=\"397\" />adasd</p>', '../../assets/uploads/workshop.jpege9bb8cfa877b6c0c9cdc60136d3b119e.jpeg987244d8da3f9f503b7b05375858f23e.jpeg', 1, '2022-01-28 13:24:36'),
(98, 'Apresentação do PPGCC Jose', 'ASas', '<p><img src=\"../../assets/uploads/workshop.jpege9bb8cfa877b6c0c9cdc60136d3b119e.jpeg987244d8da3f9f503b7b05375858f23e.jpeg\" alt=\"workshop.jpege9bb8cfa877b6c0c9cdc60136d3b119e.jpeg987244d8da3f9f503b7b05375858f23e.jpeg\" width=\"900\" height=\"397\" /></p>', '../../assets/uploads/ps4.png0d1d0642536014c8a58165bd9e10954e.png', 1, '2022-01-28 14:33:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `secao`
--

CREATE TABLE `secao` (
  `id` int(11) NOT NULL,
  `titulo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `icon` text COLLATE utf8_unicode_ci NOT NULL,
  `ordem` int(11) NOT NULL,
  `ativada` tinyint(1) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data_criacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `secao`
--

INSERT INTO `secao` (`id`, `titulo`, `icon`, `ordem`, `ativada`, `id_usuario`, `data_criacao`) VALUES
(84, 'Sobre Programa', 'fas fa-ad', 2, 1, 1, '2021-12-02 22:20:43'),
(85, 'Processos seletivos', 'fas fa-ad', 1, 1, 1, '2021-12-02 22:22:40'),
(86, 'Acadêmico', 'fas fa-ad', 4, 1, 1, '2021-12-02 22:23:27'),
(87, 'Documentos', 'fas fa-ad', 5, 1, 1, '2021-12-02 22:24:41'),
(95, 'Contato', 'fab fa-android', 3, 0, 1, '2021-12-21 21:06:34');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subsecao`
--

CREATE TABLE `subsecao` (
  `id` int(11) NOT NULL,
  `id_secao` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `conteudo` text NOT NULL,
  `ordem` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `ativada` tinyint(1) NOT NULL,
  `data_criacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `subsecao`
--

INSERT INTO `subsecao` (`id`, `id_secao`, `titulo`, `conteudo`, `ordem`, `id_usuario`, `ativada`, `data_criacao`) VALUES
(65, 84, 'Curso de Mestrado', '', 4, 1, 1, '2021-12-02 22:20:59'),
(66, 84, 'Coordenação ', '', 3, 1, 1, '2021-12-02 22:21:17'),
(67, 84, 'Infraestrutura', '', 5, 1, 1, '2021-12-02 22:21:43'),
(68, 84, 'Docentes', '<p><a href=\"../../assets/uploads/ps4.png0d1d0642536014c8a58165bd9e10954e.png\">ps4.png0d1d0642536014c8a58165bd9e10954e.png</a></p>', 1, 1, 1, '2021-12-02 22:21:57'),
(69, 84, 'Linhas de Pesquisa', '', 6, 1, 1, '2021-12-02 22:22:10'),
(70, 84, 'Planejamento Estratégico', '', 2, 1, 1, '2021-12-02 22:22:27'),
(71, 85, 'Editais', '<p><a href=\"../../assets/uploads/workshop.jpege9bb8cfa877b6c0c9cdc60136d3b119e.jpeg987244d8da3f9f503b7b05375858f23e.jpeg\">workshop.jpege9bb8cfa877b6c0c9cdc60136d3b119e.jpeg987244d8da3f9f503b7b05375858f23e.jpeg</a></p>', 2, 1, 1, '2021-12-02 22:22:52'),
(72, 85, 'Resultados', '', 3, 1, 0, '2021-12-02 22:23:03'),
(73, 85, 'Anteriores', '<p>jkHJHD SFDHBSD A S<a href=\"../../assets/uploads/ps4.png0d1d0642536014c8a58165bd9e10954e.png\">ps4.png0d1d0642536014c8a58165bd9e10954e.png</a>DAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>\r\n<p>jkHJHD SFDHBSD A SDAS D AJHSDA SJHDAS DASDA SDVASDH ASHDBASD A SDHASDBAHSD</p>', 1, 1, 1, '2021-12-02 22:23:16'),
(74, 86, 'Matrículas', '', 1, 1, 0, '2021-12-02 22:23:37'),
(75, 86, 'Ofertas Disciplinas', '', 2, 1, 1, '2021-12-02 22:23:51'),
(76, 86, ' Calendário Acadêmico', '', 3, 1, 1, '2021-12-02 22:24:06'),
(77, 86, 'Agenda de defesas', '', 4, 1, 1, '2021-12-02 22:24:18'),
(78, 86, 'Perguntas frequentes', '', 5, 1, 1, '2021-12-02 22:24:29'),
(79, 87, 'Regimentos e Normas', '', 1, 1, 1, '2021-12-02 22:24:57'),
(80, 87, 'Formulários', '', 2, 1, 1, '2021-12-02 22:25:11'),
(81, 87, 'Modelos', '', 3, 1, 1, '2021-12-02 22:25:21'),
(82, 87, 'Portarias', '', 4, 1, 0, '2021-12-02 22:25:32'),
(96, 84, 'reweqweqwe', '', 7, 120, 1, '2022-01-16 23:57:21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `usuario` text COLLATE utf8_unicode_ci NOT NULL,
  `senha` text COLLATE utf8_unicode_ci NOT NULL,
  `permissao` int(1) NOT NULL,
  `ativado` tinyint(1) DEFAULT NULL,
  `data_cadastro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `usuario`, `senha`, `permissao`, `ativado`, `data_cadastro`) VALUES
(1, 'admin@gmail.com', '123', 2, 1, '2021-12-05 03:52:26'),
(120, 'user1@gmail.com', '123', 1, 1, '2022-01-16 10:59:43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_secao`
--

CREATE TABLE `usuario_secao` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_secao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuario_secao`
--

INSERT INTO `usuario_secao` (`id`, `id_usuario`, `id_secao`) VALUES
(190, 119, 84),
(191, 119, 85),
(192, 119, 86),
(193, 119, 87),
(194, 119, 95),
(226, 1, 84),
(227, 1, 85),
(228, 1, 86),
(229, 1, 87),
(255, 120, 84),
(256, 120, 85);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `arquivo`
--
ALTER TABLE `arquivo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `defesas`
--
ALTER TABLE `defesas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `secao`
--
ALTER TABLE `secao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `subsecao`
--
ALTER TABLE `subsecao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario_secao`
--
ALTER TABLE `usuario_secao`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `arquivo`
--
ALTER TABLE `arquivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=390;

--
-- AUTO_INCREMENT de tabela `defesas`
--
ALTER TABLE `defesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de tabela `secao`
--
ALTER TABLE `secao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT de tabela `subsecao`
--
ALTER TABLE `subsecao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT de tabela `usuario_secao`
--
ALTER TABLE `usuario_secao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
