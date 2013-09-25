<?php /* Smarty version Smarty-3.1.8, created on 2013-09-13 09:33:56
         compiled from "class/smarty/templates/touch/server/autoLoad.tpl" */ ?>
<?php /*%%SmartyHeaderCode:985830943523306343e4620-39772868%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '80bdc6ad4daa017fc651714ebeee6cbda5fbe573' => 
    array (
      0 => 'class/smarty/templates/touch/server/autoLoad.tpl',
      1 => 1350852034,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '985830943523306343e4620-39772868',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'permissoes' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_523306343fca35_55693624',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523306343fca35_55693624')) {function content_523306343fca35_55693624($_smarty_tpl) {?><<?php ?>?php
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