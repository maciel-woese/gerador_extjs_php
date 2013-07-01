<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/server/autoLoad.tpl" */ ?>
<?php /*%%SmartyHeaderCode:59349684651d18a180e1e49-18104506%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'be85ff921d68e28c27c1bb5e3a46da10a4811d8e' => 
    array (
      0 => 'class/smarty/templates/padrao/server/autoLoad.tpl',
      1 => 1350852034,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '59349684651d18a180e1e49-18104506',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'permissoes' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a180ec859_88385652',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a180ec859_88385652')) {function content_51d18a180ec859_88385652($_smarty_tpl) {?><<?php ?>?php
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