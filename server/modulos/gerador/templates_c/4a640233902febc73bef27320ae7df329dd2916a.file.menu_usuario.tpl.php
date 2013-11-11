<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:11
         compiled from "class/smarty/templates/desktop/server/menu_usuario.tpl" */ ?>
<?php /*%%SmartyHeaderCode:186908869352457e137a3060-81439272%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4a640233902febc73bef27320ae7df329dd2916a' => 
    array (
      0 => 'class/smarty/templates/desktop/server/menu_usuario.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '186908869352457e137a3060-81439272',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e137bae00_22037898',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e137bae00_22037898')) {function content_52457e137bae00_22037898($_smarty_tpl) {?><<?php ?>?php
<?php if ($_smarty_tpl->tpl_vars['autor']->value==true){?>
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
<?php }?>

	require_once('../lib/Connection.class.php');
	require_once('../lib/Usuarios.class.php');
	$user = new Usuarios();
	$connection = new Connection;
	if(!$user->isLogado()){
		die(json_encode(array('success'=> false, 'logout'=> true)));
	}
	echo $user->getMenu();
	<?php }} ?>