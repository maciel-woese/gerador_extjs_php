<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'entrada_medicamento';
	try {
		
		$connection->beginTransaction();
		
		if($_POST['action'] == 'EDITAR'){
		
			$user->getAcao($tabela, 'editar');
		
			$pdo = $connection->prepare("
					UPDATE entrada_medicamento SET 
							usuario_id = ?,
							fornecedor_id = ?,							
							nota = ?							
 					WHERE id = ?
			");
			$params = array(
				$user->id,
				$_POST['fornecedor_id'],
				$_POST['nota'],
				$_POST['id']
			);
		}
		else if ($_POST['action'] == 'INSERIR'){
		
			$user->getAcao($tabela, 'adicionar');
		
			$pdo = $connection->prepare("
				INSERT INTO entrada_medicamento 
					(
						data_cadastro,						
						usuario_id,						
						fornecedor_id,						
						nota,					
						filial_id					
					) 
				VALUES 
					(
						NOW(),	?,	?,	?, {$user->filial_id}
					)
			");
			$params = array(
				$user->id,
				$_POST['fornecedor_id'],		
				$_POST['nota']		
			);
		}
		else{
			throw new PDOException(utf8_encode(ACTION_NOT_FOUND));
		}
		
		$pdo->execute($params);
				
		$connection->commit();
		echo json_encode(array('success'=>true, 'msg'=>SAVED_SUCCESS));
	}
	catch (PDOException $e) {
		$connection->rollBack();
		echo json_encode(array('success'=>false, 'msg'=>ERROR_SAVE_DATA, 'erro'=>$e->getMessage()));
	}
}