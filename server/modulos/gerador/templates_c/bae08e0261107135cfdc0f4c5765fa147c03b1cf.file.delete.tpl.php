<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:11
         compiled from "class/smarty/templates/desktop/permissoes_br/perfil/delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:132209469852457e13dcbae8-91915063%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bae08e0261107135cfdc0f4c5765fa147c03b1cf' => 
    array (
      0 => 'class/smarty/templates/desktop/permissoes_br/perfil/delete.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '132209469852457e13dcbae8-91915063',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e13dd6d34_49916035',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e13dd6d34_49916035')) {function content_52457e13dd6d34_49916035($_smarty_tpl) {?><<?php ?>?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'perfil';
	try {
		$connection->beginTransaction();
		
		$pdo = $connection->prepare("DELETE FROM perfil WHERE id = ?");
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
}<?php }} ?>