<?php /* Smarty version Smarty-3.1.8, created on 2013-07-01 10:54:32
         compiled from "class/smarty/templates/padrao/permissoes_br/usuarios/save.tpl" */ ?>
<?php /*%%SmartyHeaderCode:49373070451d18a18499ba5-42701138%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '066af4cd9b2dbc6c1ab9ce0c146444253d846e45' => 
    array (
      0 => 'class/smarty/templates/padrao/permissoes_br/usuarios/save.tpl',
      1 => 1351274167,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '49373070451d18a18499ba5-42701138',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_51d18a184a1474_70719265',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d18a184a1474_70719265')) {function content_51d18a184a1474_70719265($_smarty_tpl) {?><<?php ?>?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'usuarios';
	try {
		
		$connection->beginTransaction();
		
		if($_POST['action'] == 'EDITAR'){
		
			$pdo = $connection->prepare("
					UPDATE usuarios SET 
							nome = ?,							
							perfil_id = ?,							
							email = ?,							
							login = ?,							
							administrador = ?,							
							status = ?							
 					WHERE id = ?
			");
			$params = array(
				$_POST['nome'],
				$_POST['perfil_id'],
				$_POST['email'],
				$_POST['login'],
				$_POST['administrador'],
				$_POST['status'],
				$_POST['id']
			);
		}
		else if ($_POST['action'] == 'INSERIR'){
		
			$pdo = $connection->prepare("
				INSERT INTO usuarios 
					(
						nome,						
						perfil_id,						
						email,						
						login,						
						senha,						
						administrador,						
						status						
					) 
				VALUES 
					(
						?,	?,	?,	?,	?,	?,	?			
					)
			");
			$params = array(
				$_POST['nome'],		
				$_POST['perfil_id'],		
				$_POST['email'],		
				$_POST['login'],		
				md5($_POST['senha']),		
				$_POST['administrador'],		
				$_POST['status']		
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