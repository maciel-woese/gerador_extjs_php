<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:11
         compiled from "class/smarty/templates/desktop/permissoes_br/perfil/model.tpl" */ ?>
<?php /*%%SmartyHeaderCode:164029016152457e13cee395-66264330%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3410d4a11a08710055050ca6031c4ee31ce5eff5' => 
    array (
      0 => 'class/smarty/templates/desktop/permissoes_br/perfil/model.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '164029016152457e13cee395-66264330',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e13d03e49_65621593',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e13d03e49_65621593')) {function content_52457e13d03e49_65621593($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.model.ModelPerfil', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'id',								 
			type: 'int'
		},				
		{
			name: 'perfil',								 
			type: 'string'
		}				
    ]
});<?php }} ?>