<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/permissoes_br/usuarios/model.tpl" */ ?>
<?php /*%%SmartyHeaderCode:106160759451d18a1840e366-98826105%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'febd5c0a0452fecfebd3cc90e49b113889a2f827' => 
    array (
      0 => 'class/smarty/templates/padrao/permissoes_br/usuarios/model.tpl',
      1 => 1351271190,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '106160759451d18a1840e366-98826105',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a1841e607_77374944',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a1841e607_77374944')) {function content_51d18a1841e607_77374944($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.model.ModelUsuarios', {
    extend: 'Ext.data.Model',

    fields: [
		{
			name: 'id',								 
			type: 'int'
		},				
		{
			name: 'nome',								 
			type: 'string'
		},				
		{
			name: 'perfil',								 
			type: 'string'
		},				
		{
			name: 'perfil_id',								 
			type: 'int'
		},				
		{
			name: 'email',								 
			type: 'string'
		},				
		{
			name: 'login',								 
			type: 'string'
		},				
		{
			name: 'senha',								 
			type: 'string'
		},				
		{
			name: 'administrador',								 
			type: 'string'
		},				
		{
			name: 'status',								 
			type: 'string'
		}				
    ]
});<?php }} ?>