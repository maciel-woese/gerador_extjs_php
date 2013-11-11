<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:11
         compiled from "class/smarty/templates/desktop/server/Login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:124520417152457e13b83f86-67764458%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4edcb8ab8307f807f05c965a86725af6a55d6620' => 
    array (
      0 => 'class/smarty/templates/desktop/server/Login.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '124520417152457e13b83f86-67764458',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e13b9e441_78712319',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e13b9e441_78712319')) {function content_52457e13b9e441_78712319($_smarty_tpl) {?><<?php ?>?php
<?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>

if($_POST){
	error_reporting(0);
	require_once('../lib/Connection.class.php');
	require_once('../lib/Usuarios.class.php');
	$user = new Usuarios();
	if($_POST['action']=='LOGIN'){
		echo $user->setLogar($_POST['login'], $_POST['senha']);
	}
}

?<?php ?>><?php }} ?>