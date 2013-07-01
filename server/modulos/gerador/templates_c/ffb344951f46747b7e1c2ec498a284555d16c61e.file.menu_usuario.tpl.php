<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/server/menu_usuario.tpl" */ ?>
<?php /*%%SmartyHeaderCode:59455122351d18a180d51c9-60535926%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ffb344951f46747b7e1c2ec498a284555d16c61e' => 
    array (
      0 => 'class/smarty/templates/padrao/server/menu_usuario.tpl',
      1 => 1350912963,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '59455122351d18a180d51c9-60535926',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'autor' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a180defd2_61349954',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a180defd2_61349954')) {function content_51d18a180defd2_61349954($_smarty_tpl) {?><<?php ?>?php
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