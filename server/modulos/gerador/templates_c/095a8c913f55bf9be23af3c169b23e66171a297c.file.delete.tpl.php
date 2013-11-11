<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:12
         compiled from "class/smarty/templates/desktop/permissoes_br/usuarios/delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16860766252457e14204d91-57750354%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '095a8c913f55bf9be23af3c169b23e66171a297c' => 
    array (
      0 => 'class/smarty/templates/desktop/permissoes_br/usuarios/delete.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16860766252457e14204d91-57750354',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e14211139_29236224',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e14211139_29236224')) {function content_52457e14211139_29236224($_smarty_tpl) {?><<?php ?>?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'usuarios';
	try {
		$connection->beginTransaction();
		
		$pdo = $connection->prepare("DELETE FROM usuarios WHERE id = ?");
		$pdo->execute(array(
			$_POST['id']
		));
		
		$connection->commit();
		echo json_encode(array('success'=>true, 'msg'=>'Removido com sucesso'));
	}
	catch (PDOException $e) {
		$connection->rollBack();
		echo json_encode(array('success'=>false, 'msg'=>'Erro ao apagar dados!', 'erro'=>$e->getMessage()));
	}
}

?<?php ?>><?php }} ?>