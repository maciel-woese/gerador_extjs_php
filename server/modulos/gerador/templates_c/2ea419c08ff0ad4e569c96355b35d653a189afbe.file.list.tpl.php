<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:12
         compiled from "class/smarty/templates/desktop/permissoes_br/permissoes/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:49285861452457e14358a10-16085483%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2ea419c08ff0ad4e569c96355b35d653a189afbe' => 
    array (
      0 => 'class/smarty/templates/desktop/permissoes_br/permissoes/list.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '49285861452457e14358a10-16085483',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e143653e1_14139244',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e143653e1_14139244')) {function content_52457e143653e1_14139244($_smarty_tpl) {?><<?php ?>?php
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