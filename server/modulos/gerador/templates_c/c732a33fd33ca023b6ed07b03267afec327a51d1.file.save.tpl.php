<?php /* Smarty version Smarty-3.1.8, created on 2013-09-27 09:46:12
         compiled from "class/smarty/templates/desktop/permissoes_br/usuarios/save.tpl" */ ?>
<?php /*%%SmartyHeaderCode:126849598452457e14214d68-68908503%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c732a33fd33ca023b6ed07b03267afec327a51d1' => 
    array (
      0 => 'class/smarty/templates/desktop/permissoes_br/usuarios/save.tpl',
      1 => 1380126225,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '126849598452457e14214d68-68908503',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_52457e14224fa9_96418714',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52457e14224fa9_96418714')) {function content_52457e14224fa9_96418714($_smarty_tpl) {?><<?php ?>?php
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