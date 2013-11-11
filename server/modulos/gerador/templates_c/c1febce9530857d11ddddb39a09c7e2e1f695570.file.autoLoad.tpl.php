<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:11
         compiled from "class/smarty/templates/desktop/server/autoLoad.tpl" */ ?>
<?php /*%%SmartyHeaderCode:155369326852457e1384f8c3-24337817%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c1febce9530857d11ddddb39a09c7e2e1f695570' => 
    array (
      0 => 'class/smarty/templates/desktop/server/autoLoad.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '155369326852457e1384f8c3-24337817',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'permissoes' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e1386ac67_71148774',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e1386ac67_71148774')) {function content_52457e1386ac67_71148774($_smarty_tpl) {?><<?php ?>?php
error_reporting(0);
require_once('../../lib/Connection.class.php');
require_once('../../lib/Buscar.class.php');
require_once('../../lib/Paginar.class.php');
require_once('../../lib/funcoes.php');
<?php if ($_smarty_tpl->tpl_vars['permissoes']->value=='sim'){?>
require_once('../../lib/Usuarios.class.php');
$user = new Usuarios();
if(!$user->isLogado()){
	die(json_encode(array('success'=> false, 'logout'=> true)));
}
<?php }?>
$connection = new Connection;
?<?php ?>>
<?php }} ?>