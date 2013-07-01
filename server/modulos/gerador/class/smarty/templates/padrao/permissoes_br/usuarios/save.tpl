<?php
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
}