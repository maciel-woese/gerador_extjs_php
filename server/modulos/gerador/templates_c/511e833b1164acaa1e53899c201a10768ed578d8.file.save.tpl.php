<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/permissoes_br/permissoes/save.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10711544251d18a185fc516-33748712%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '511e833b1164acaa1e53899c201a10768ed578d8' => 
    array (
      0 => 'class/smarty/templates/padrao/permissoes_br/permissoes/save.tpl',
      1 => 1351536401,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10711544251d18a185fc516-33748712',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a18603033_35699878',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a18603033_35699878')) {function content_51d18a18603033_35699878($_smarty_tpl) {?><<?php ?>?php
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