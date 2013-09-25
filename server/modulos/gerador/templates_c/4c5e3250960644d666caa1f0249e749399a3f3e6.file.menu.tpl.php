<?php /* Smarty version Smarty-3.1.8, created on 2013-09-13 09:33:56
         compiled from "class/smarty/templates/touch/server/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5347832652330634343ab7-90391462%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4c5e3250960644d666caa1f0249e749399a3f3e6' => 
    array (
      0 => 'class/smarty/templates/touch/server/menu.tpl',
      1 => 1353943042,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5347832652330634343ab7-90391462',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'menu' => 0,
    'field' => 0,
    'sair' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52330634380520_84932348',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52330634380520_84932348')) {function content_52330634380520_84932348($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/maciel/www/maciel/gerador_extjs_php/server/modulos/gerador/class/smarty/libs/plugins/modifier.capitalize.php';
?>{
	dados: [
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>		
		{ 
			modulo: "<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['field']->value);?>
",
			descricao: "<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['field']->value);?>
",
			action: "list"
		},
<?php } ?>
		{
			modulo: "Logout",
			descricao: "<?php echo $_smarty_tpl->tpl_vars['sair']->value;?>
",
			action: "logout"
		}
	]
}<?php }} ?>