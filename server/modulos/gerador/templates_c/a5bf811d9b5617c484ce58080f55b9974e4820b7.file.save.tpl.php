<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/permissoes_br/perfil/save.tpl" */ ?>
<?php /*%%SmartyHeaderCode:181850915951d18a18333a41-64671634%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a5bf811d9b5617c484ce58080f55b9974e4820b7' => 
    array (
      0 => 'class/smarty/templates/padrao/permissoes_br/perfil/save.tpl',
      1 => 1351271096,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '181850915951d18a18333a41-64671634',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a1833b1a4_08540843',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a1833b1a4_08540843')) {function content_51d18a1833b1a4_08540843($_smarty_tpl) {?><<?php ?>?php
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