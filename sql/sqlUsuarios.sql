
DROP TABLE IF EXISTS `modulos`;
CREATE TABLE `modulos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modulo` varchar(45) NOT NULL,
  `descricao` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;



INSERT INTO `modulos` (`id`, `modulo`,`descricao`) VALUES 
 
 (1, 'agendamento_exame','Agendamento_Exame'), 
 (2, 'agendamento_transporte','Agendamento_Transporte'), 
 (3, 'cidades','Cidades'), 
 (4, 'consulta','Consulta'), 
 (5, 'entrada_medicamento','Entrada_Medicamento'), 
 (6, 'entrada_produtos','Entrada_Produtos'), 
 (7, 'especialidades','Especialidades'), 
 (8, 'estados','Estados'), 
 (9, 'fornecedor','Fornecedor'), 
 (10, 'laboratorio','Laboratorio'), 
 (11, 'medicamento','Medicamento'), 
 (12, 'medico','Medico'), 
 (13, 'pacientes','Pacientes'), 
 (14, 'pacientes_transporte','Pacientes_Transporte'), 
 (15, 'saida_medicamento','Saida_Medicamento'), 
 (16, 'saida_produtos','Saida_Produtos'), 
 (17, 'veiculos','Veiculos'); 
 
 
DROP TABLE IF EXISTS `modulos_acoes`;
CREATE TABLE `modulos_acoes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `acao` varchar(45) NOT NULL,
  `modulo_id` int(10) unsigned NOT NULL,
  `acao_desc` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_modulos_acoes_1` (`modulo_id`),
  CONSTRAINT `FK_modulos_acoes_1` FOREIGN KEY (`modulo_id`) REFERENCES `modulos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `modulos_acoes` (`acao`,`modulo_id`, `acao_desc`) VALUES 
 
 ('listar', 1, 'Listar'),
 ('adicionar', 1, 'Adicionar'),
 ('editar', 1, 'Editar'),
 ('deletar', 1, 'Deletar'), 
 
 ('listar', 2, 'Listar'),
 ('adicionar', 2, 'Adicionar'),
 ('editar', 2, 'Editar'),
 ('deletar', 2, 'Deletar'), 
 
 ('listar', 3, 'Listar'),
 ('adicionar', 3, 'Adicionar'),
 ('editar', 3, 'Editar'),
 ('deletar', 3, 'Deletar'), 
 
 ('listar', 4, 'Listar'),
 ('adicionar', 4, 'Adicionar'),
 ('editar', 4, 'Editar'),
 ('deletar', 4, 'Deletar'), 
 
 ('listar', 5, 'Listar'),
 ('adicionar', 5, 'Adicionar'),
 ('editar', 5, 'Editar'),
 ('deletar', 5, 'Deletar'), 
 
 ('listar', 6, 'Listar'),
 ('adicionar', 6, 'Adicionar'),
 ('editar', 6, 'Editar'),
 ('deletar', 6, 'Deletar'), 
 
 ('listar', 7, 'Listar'),
 ('adicionar', 7, 'Adicionar'),
 ('editar', 7, 'Editar'),
 ('deletar', 7, 'Deletar'), 
 
 ('listar', 8, 'Listar'),
 ('adicionar', 8, 'Adicionar'),
 ('editar', 8, 'Editar'),
 ('deletar', 8, 'Deletar'), 
 
 ('listar', 9, 'Listar'),
 ('adicionar', 9, 'Adicionar'),
 ('editar', 9, 'Editar'),
 ('deletar', 9, 'Deletar'), 
 
 ('listar', 10, 'Listar'),
 ('adicionar', 10, 'Adicionar'),
 ('editar', 10, 'Editar'),
 ('deletar', 10, 'Deletar'), 
 
 ('listar', 11, 'Listar'),
 ('adicionar', 11, 'Adicionar'),
 ('editar', 11, 'Editar'),
 ('deletar', 11, 'Deletar'), 
 
 ('listar', 12, 'Listar'),
 ('adicionar', 12, 'Adicionar'),
 ('editar', 12, 'Editar'),
 ('deletar', 12, 'Deletar'), 
 
 ('listar', 13, 'Listar'),
 ('adicionar', 13, 'Adicionar'),
 ('editar', 13, 'Editar'),
 ('deletar', 13, 'Deletar'), 
 
 ('listar', 14, 'Listar'),
 ('adicionar', 14, 'Adicionar'),
 ('editar', 14, 'Editar'),
 ('deletar', 14, 'Deletar'), 
 
 ('listar', 15, 'Listar'),
 ('adicionar', 15, 'Adicionar'),
 ('editar', 15, 'Editar'),
 ('deletar', 15, 'Deletar'), 
 
 ('listar', 16, 'Listar'),
 ('adicionar', 16, 'Adicionar'),
 ('editar', 16, 'Editar'),
 ('deletar', 16, 'Deletar'), 
 
 ('listar', 17, 'Listar'),
 ('adicionar', 17, 'Adicionar'),
 ('editar', 17, 'Editar'),
 ('deletar', 17, 'Deletar'); 
 	
 
 
DROP TABLE IF EXISTS `perfil`;
CREATE TABLE `perfil` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `perfil` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `perfil` (`id`,`perfil`) VALUES 
 (1, 'Administrador');

 
 
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `perfil_id` int(10) unsigned NOT NULL,
  `email` varchar(95) NOT NULL,
  `login` varchar(45) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `administrador` enum('1','2') NOT NULL DEFAULT '2' COMMENT '1 - sim, 2 - nao',
  `status` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1 - ativo, 2 - desativado',
  PRIMARY KEY (`id`),
  KEY `FK_usuarios_1` (`perfil_id`),
  CONSTRAINT `FK_usuarios_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `usuarios` (`nome`, `perfil_id`, `email`, `login`, `senha`, `administrador`) VALUES 
 ('Administrador', 1, 'admin@admin.com.br', 'admin', md5('admin'), '1');

 
 
DROP TABLE IF EXISTS `permissoes_perfil`;
CREATE TABLE `permissoes_perfil` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `perfil_id` int(10) unsigned NOT NULL,
  `acao_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_permissoes_perfil_1` (`perfil_id`),
  KEY `FK_permissoes_perfil_2` (`acao_id`),
  CONSTRAINT `FK_permissoes_perfil_2` FOREIGN KEY (`acao_id`) REFERENCES `modulos_acoes` (`id`),
  CONSTRAINT `FK_permissoes_perfil_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS `permissoes_usuario`;
CREATE TABLE `permissoes_usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` int(10) unsigned NOT NULL,
  `acao_id` int(10) unsigned NOT NULL,
  `acesso` enum('S','N') NOT NULL DEFAULT 'S' COMMENT 'S = Permitido, N - Negado',
  PRIMARY KEY (`id`),
  KEY `FK_permissoes_usuario_1` (`usuario_id`),
  KEY `FK_permissoes_usuario_2` (`acao_id`),
  CONSTRAINT `FK_permissoes_usuario_2` FOREIGN KEY (`acao_id`) REFERENCES `modulos_acoes` (`id`),
  CONSTRAINT `FK_permissoes_usuario_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


