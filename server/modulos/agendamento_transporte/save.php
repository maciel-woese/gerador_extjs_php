<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'agendamento_transporte';
	try {
		
		$connection->beginTransaction();
		
		if($_POST['action'] == 'EDITAR'){
		
			$user->getAcao($tabela, 'editar');
		
			$pdo = $connection->prepare("
					UPDATE agendamento_transporte SET 
							data = ?,							
							hora_saida = ?,							
							usuario_id = ?,							
							veiculo_id = ?,							
							destino = ?,							
							obs = ?					
 					WHERE id = ?
			");
			$params = array(
				implode('-', array_reverse(explode('/', $_POST['data']))),
				$_POST['hora_saida'],
				$user->id,
				$_POST['veiculo_id'],
				$_POST['destino'],
				$_POST['obs'],
				$_POST['id']
			);
		}
		else if ($_POST['action'] == 'INSERIR'){
		
			$user->getAcao($tabela, 'adicionar');
		
			$pdo = $connection->prepare("
				INSERT INTO agendamento_transporte 
					(
						data,						
						hora_saida,						
						usuario_id,						
						veiculo_id,						
						destino,						
						obs,				
						filial_id			
					) 
				VALUES 
					(
						?,	?,	?,	?,	?,	?, {$user->filial_id}
					)
			");
			$params = array(
				implode('-', array_reverse(explode('/', $_POST['data']))),		
				$_POST['hora_saida'],		
				$user->id,
				$_POST['veiculo_id'],		
				$_POST['destino'],		
				$_POST['obs']		
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