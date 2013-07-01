<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/server/Login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:147012551351d18a1823a0e9-91598948%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b7999b3d3c2b5c7e9569dd69eb3809529ccfacd1' => 
    array (
      0 => 'class/smarty/templates/padrao/server/Login.tpl',
      1 => 1351175569,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '147012551351d18a1823a0e9-91598948',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a18245886_02823116',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a18245886_02823116')) {function content_51d18a18245886_02823116($_smarty_tpl) {?><<?php ?>?php
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