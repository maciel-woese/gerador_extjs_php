<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:12
         compiled from "class/smarty/templates/desktop/permissoes_br/permissoes/save.tpl" */ ?>
<?php /*%%SmartyHeaderCode:66238849252457e143696a3-81256298%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b0011e6d072c1a3b9cc67f7438be629968d6fb16' => 
    array (
      0 => 'class/smarty/templates/desktop/permissoes_br/permissoes/save.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '66238849252457e143696a3-81256298',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e14378898_85956771',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e14378898_85956771')) {function content_52457e14378898_85956771($_smarty_tpl) {?><<?php ?>?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

	require('../../autoLoad.php');
	require('../../lib/Permissoes.class.php');
	$p = new Permissoes();
	if($_POST){
		$json = stripcslashes('{ "dados": ['.$_POST['json'].'] }');
		$json = json_decode($json, true);
		
		if(isset($_POST['action']) and $_POST['action']=='USUARIO'){
			echo $p->setModulosUsuario($json, $_POST['usuario_id']);
		}
		else if(isset($_POST['action']) and $_POST['action']=='PERFIL'){
			echo $p->setModulosPerfil($json, $_POST['perfil_id']);
		}
	}
?<?php ?>><?php }} ?>