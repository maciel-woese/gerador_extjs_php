

DROP TABLE IF EXISTS `modulos`;
CREATE TABLE `modulos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modulo` varchar(45) NOT NULL,
  `descricao` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;



INSERT INTO `modulos` (`id`, `modulo`,`descricao`) VALUES 
{foreach from=$menu item=field name=foo2} 
 ({$smarty.foreach.foo2.index+1}, '{$field}',	'{$field|capitalize}'),
{/foreach} 
 ({$smarty.foreach.foo2.index+2}, 'perfil',		'Perfil'),
 ({$smarty.foreach.foo2.index+3}, 'usuarios',	'Usuarios');
 
 
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
{foreach from=$menu item=field name=foo3} 
 ('listar', 	{$smarty.foreach.foo3.index+1}, 'Listar'),
 ('adicionar', 	{$smarty.foreach.foo3.index+1}, 'Adicionar'),
 ('editar', 	{$smarty.foreach.foo3.index+1}, 'Editar'),
 ('deletar', 	{$smarty.foreach.foo3.index+1}, 'Deletar'),
 {/foreach} 	
 ('listar', 	{$smarty.foreach.foo3.index+2}, 'Listar'),
 ('adicionar', 	{$smarty.foreach.foo3.index+2}, 'Adicionar'),
 ('editar', 	{$smarty.foreach.foo3.index+2}, 'Editar'),
 ('deletar', 	{$smarty.foreach.foo3.index+2}, 'Deletar'),
 ('modulos',	{$smarty.foreach.foo3.index+2},	'Add. Modulos'),
 
 ('listar', 	{$smarty.foreach.foo3.index+3}, 'Listar'),
 ('adicionar', 	{$smarty.foreach.foo3.index+3}, 'Adicionar'),
 ('editar', 	{$smarty.foreach.foo3.index+3}, 'Editar'),
 ('deletar', 	{$smarty.foreach.foo3.index+3}, 'Deletar'),
 ('modulos',	{$smarty.foreach.foo3.index+3},	'Add. Modulos');
 
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


