<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/permissoes_br/permissoes/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:168518852651d18a185f39d0-66424521%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '218a4cdd41f12c92f24b47aed32b3b9b33392cb1' => 
    array (
      0 => 'class/smarty/templates/padrao/permissoes_br/permissoes/list.tpl',
      1 => 1351271592,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '168518852651d18a185f39d0-66424521',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a185f9a90_57204171',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a185f9a90_57204171')) {function content_51d18a185f9a90_57204171($_smarty_tpl) {?><<?php ?>?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

	require('../../autoLoad.php');
	require('../../lib/Permissoes.class.php');
	$p = new Permissoes();
	if($_POST){
		if(isset($_POST['action']) and $_POST['action']=='USUARIO'){
			echo $p->getTreeUsuario($_POST['perfil_id'], $_POST['usuario_id']);
		}
		else if(isset($_POST['action']) and $_POST['action']=='PERFIL'){
			echo $p->getTreePerfil($_POST['perfil_id']);
		}	
	}
?<?php ?>><?php }} ?>