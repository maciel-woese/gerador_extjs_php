<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/model/modelCombo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27105427651d18a1863ff98-04073484%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c3411d6fafda3db239af090a5e82db53bc22bbee' => 
    array (
      0 => 'class/smarty/templates/padrao/model/modelCombo.tpl',
      1 => 1349269985,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27105427651d18a1863ff98-04073484',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'app' => 0,
    'name' => 0,
    'type' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a186556e9_65652526',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a186556e9_65652526')) {function content_51d18a186556e9_65652526($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?><?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>

Ext.define('<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['app']->value);?>
.model.<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
', {
	extend: 'Ext.data.Model',

	fields: [
		{
			name: 'id',
			type: '<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
'
		},
		{
			name: 'descricao',
			type: 'string'
		}
	]
});<?php }} ?>