<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/permissoes_br/perfil/delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:191729906951d18a18329403-53050262%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e1455c78b42658ee3a013c149b3f8f5bf676a1ab' => 
    array (
      0 => 'class/smarty/templates/padrao/permissoes_br/perfil/delete.tpl',
      1 => 1351271043,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '191729906951d18a18329403-53050262',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a1832eec8_81408483',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a1832eec8_81408483')) {function content_51d18a1832eec8_81408483($_smarty_tpl) {?><<?php ?>?php
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