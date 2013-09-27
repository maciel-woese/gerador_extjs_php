<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:11
         compiled from "class/smarty/templates/desktop/server/mysql/sql.tpl" */ ?>
<?php /*%%SmartyHeaderCode:127688712852457e13986f97-96600178%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b4bca45cdda8a715fae6486f70e55c12822c5c1' => 
    array (
      0 => 'class/smarty/templates/desktop/server/mysql/sql.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '127688712852457e13986f97-96600178',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'menu' => 0,
    'field' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e13ae87b9_35915728',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e13ae87b9_35915728')) {function content_52457e13ae87b9_35915728($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>

DROP TABLE IF EXISTS `modulos`;
CREATE TABLE `modulos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modulo` varchar(45) NOT NULL,
  `descricao` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;



INSERT INTO `modulos` (`id`, `modulo`,`descricao`) VALUES 
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo2']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo2']['index']++;
?> 
 (<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo2']['index']+1;?>
, '<?php echo $_smarty_tpl->tpl_vars['field']->value;?>
',	'<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['field']->value);?>
'),
<?php } ?> 
 (<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo2']['index']+2;?>
, 'perfil',		'Perfil'),
 (<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo2']['index']+3;?>
, 'usuarios',	'Usuarios');
 
 
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
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo3']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo3']['index']++;
?> 
 ('listar', 	<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo3']['index']+1;?>
, 'Listar'),
 ('adicionar', 	<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo3']['index']+1;?>
, 'Adicionar'),
 ('editar', 	<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo3']['index']+1;?>
, 'Editar'),
 ('deletar', 	<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo3']['index']+1;?>
, 'Deletar'),
 <?php } ?> 	
 ('listar', 	<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo3']['index']+2;?>
, 'Listar'),
 ('adicionar', 	<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo3']['index']+2;?>
, 'Adicionar'),
 ('editar', 	<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo3']['index']+2;?>
, 'Editar'),
 ('deletar', 	<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo3']['index']+2;?>
, 'Deletar'),
 ('modulos',	<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo3']['index']+2;?>
,	'Add. Modulos'),
 
 ('listar', 	<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo3']['index']+3;?>
, 'Listar'),
 ('adicionar', 	<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo3']['index']+3;?>
, 'Adicionar'),
 ('editar', 	<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo3']['index']+3;?>
, 'Editar'),
 ('deletar', 	<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo3']['index']+3;?>
, 'Deletar'),
 ('modulos',	<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo3']['index']+3;?>
,	'Add. Modulos');
 
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


<?php }} ?>