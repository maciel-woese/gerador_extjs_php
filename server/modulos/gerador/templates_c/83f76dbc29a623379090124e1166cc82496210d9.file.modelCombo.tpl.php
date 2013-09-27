<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:08
         compiled from "class/smarty/templates/desktop/model/modelCombo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:85791048152457e105ec354-46326976%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '83f76dbc29a623379090124e1166cc82496210d9' => 
    array (
      0 => 'class/smarty/templates/desktop/model/modelCombo.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '85791048152457e105ec354-46326976',
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
  'unifunc' => 'content_52457e106236a7_61844010',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e106236a7_61844010')) {function content_52457e106236a7_61844010($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
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
			name: 'id'//,
			//type: '<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
'
		},
		{
			name: 'descricao',
			type: 'string'
		}
	]
});<?php }} ?>