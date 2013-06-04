<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'medicamento';
	try {
		
		$connection->beginTransaction();
		
		if($_POST['action'] == 'EDITAR'){
		
			$user->getAcao($tabela, 'editar');
		
			$pdo = $connection->prepare("
					UPDATE medicamento SET 
							medicamento = ?,							
							codigo_barras = ?,							
							laboratorio_id = ?,							
							quantidade = ?,							
							quantidade_minima = ?,							
							obs = ?,							
							status = ?							
 					WHERE id = ?
			");
			$params = array(
				$_POST['medicamento'],
				$_POST['codigo_barras'],
				$_POST['laboratorio_id'],
				$_POST['quantidade'],
				$_POST['quantidade_minima'],
				$_POST['obs'],
				$_POST['status'],
				$_POST['id']
			);
		}
		else if ($_POST['action'] == 'INSERIR'){
		
			$user->getAcao($tabela, 'adicionar');
		
			$pdo = $connection->prepare("
				INSERT INTO medicamento 
					(
						medicamento,						
						codigo_barras,						
						laboratorio_id,						
						quantidade,						
						quantidade_minima,						
						obs,						
						status,						
						filial_id					
					) 
				VALUES 
					(
						?,	?,	?,	?,	?,	?,	?, {$user->filial_id}
					)
			");
			$params = array(
				$_POST['medicamento'],		
				$_POST['codigo_barras'],		
				$_POST['laboratorio_id'],		
				$_POST['quantidade'],		
				$_POST['quantidade_minima'],		
				$_POST['obs'],		
				$_POST['status']		
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