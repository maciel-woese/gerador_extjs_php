<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:11
         compiled from "class/smarty/templates/desktop/permissoes_br/perfil/save.tpl" */ ?>
<?php /*%%SmartyHeaderCode:128090106852457e13ddb0d1-91453062%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9f90c9e67ab4b7723d39bf43c747837ffbedae5d' => 
    array (
      0 => 'class/smarty/templates/desktop/permissoes_br/perfil/save.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '128090106852457e13ddb0d1-91453062',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e13deb6c0_76264261',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e13deb6c0_76264261')) {function content_52457e13deb6c0_76264261($_smarty_tpl) {?><<?php ?>?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'perfil';
	try {
		
		$connection->beginTransaction();
		
		if($_POST['action'] == 'EDITAR'){
		
			$pdo = $connection->prepare("
					UPDATE perfil SET 
							perfil = ?							
 					WHERE id = ?
			");
			$params = array(
				$_POST['perfil'],
				$_POST['id']
			);
		}
		else if ($_POST['action'] == 'INSERIR'){
		
			$pdo = $connection->prepare("
				INSERT INTO perfil 
					(
						perfil						
					) 
				VALUES 
					(
						?			
					)
			");
			$params = array(
				$_POST['perfil']		
			);
		}
		
		$pdo->execute($params);
				
		$connection->commit();
		echo json_encode(array('success'=>true, 'msg'=>'Registro Salvo com Sucesso'));
	}
	catch (PDOException $e) {
		$connection->rollBack();
		echo json_encode(array('success'=>false, 'msg'=>'Erro ao salvar dados!', 'erro'=>$e->getMessage()));
	}
}<?php }} ?>