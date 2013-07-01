<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/permissoes_br/usuarios/delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:169542742651d18a18491235-77265864%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '72f61212b67b373111ad6453180bb1b4744af7ea' => 
    array (
      0 => 'class/smarty/templates/padrao/permissoes_br/usuarios/delete.tpl',
      1 => 1351271352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '169542742651d18a18491235-77265864',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a184972f6_25259834',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a184972f6_25259834')) {function content_51d18a184972f6_25259834($_smarty_tpl) {?><<?php ?>?php
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