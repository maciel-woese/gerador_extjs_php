<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:11
         compiled from "class/smarty/templates/desktop/css.tpl" */ ?>
<?php /*%%SmartyHeaderCode:210460684252457e137bfb19-83932088%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6685d4610e027e1d8df757db2b55a403cd42e987' => 
    array (
      0 => 'class/smarty/templates/desktop/css.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '210460684252457e137bfb19-83932088',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
    'tabelas' => 0,
    'field' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e13849092_57776768',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e13849092_57776768')) {function content_52457e13849092_57776768($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>
/*SHORTCUT*/
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tabelas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>
	.<?php echo $_smarty_tpl->tpl_vars['field']->value;?>
-shortcut {
		background-image: url(../images/list48x48.png);
	}
<?php } ?>
	.perfil-shortcut {
		background-image: url(../images/list48x48.png);
	}
	.usuarios-shortcut {
		background-image: url(../images/list48x48.png);
	}
	
/*SHORTCUT IE6*/
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tabelas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>
	.x-ie6 .<?php echo $_smarty_tpl->tpl_vars['field']->value;?>
-shortcut {
		background-image: none;
		filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/list48x48.png', sizingMethod='scale');
	}	
<?php } ?>
	.x-ie6 .perfil-shortcut {
		background-image: none;
		filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/list48x48.png', sizingMethod='scale');
	}
	.x-ie6 .usuarios-shortcut {
		background-image: none;
		filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='images/list48x48.png', sizingMethod='scale');
	}
	
/*ICON-GRID*/
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['field']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tabelas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
$_smarty_tpl->tpl_vars['field']->_loop = true;
?>
	.<?php echo $_smarty_tpl->tpl_vars['field']->value;?>
 {
		background-image: url( ../images/list16x16.png ) !important;
	}
<?php } ?>
	.perfil {
		background-image: url( ../images/list16x16.png ) !important;
	}
	.usuarios {
		background-image: url( ../images/list16x16.png ) !important;
	}
<?php }} ?>