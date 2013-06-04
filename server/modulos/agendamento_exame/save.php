<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'agendamento_exame';
	try {
		
		$connection->beginTransaction();
		
		if($_POST['action'] == 'EDITAR'){
		
			$user->getAcao($tabela, 'editar');
		
			$pdo = $connection->prepare("
					UPDATE agendamento_exame SET 
							data_exame = ?,							
							data_entrega = ?,							
							usuario_id = ?,							
							paciente_id = ?							
 					WHERE id = ?
			");
			$params = array(
				implode('-', array_reverse(explode('/', $_POST['data_exame_date'])))." ".$_POST['data_exame_time'],
				implode('-', array_reverse(explode('/', $_POST['data_entrega_date'])))." ".$_POST['data_entrega_time'],
				$user->id,
				$_POST['paciente_id'],
				$_POST['id']
			);
		}
		else if ($_POST['action'] == 'INSERIR'){
		
			$user->getAcao($tabela, 'adicionar');
		
			$pdo = $connection->prepare("
				INSERT INTO agendamento_exame 
					(
						data_exame,						
						data_entrega,						
						usuario_id,						
						paciente_id,
						filial_id
					) 
				VALUES 
					(
						?,	?,	?,	?, {$user->filial_id}
					)
			");
			$params = array(
				implode('-', array_reverse(explode('/', $_POST['data_exame_date'])))." ".$_POST['data_exame_time'],		
				implode('-', array_reverse(explode('/', $_POST['data_entrega_date'])))." ".$_POST['data_entrega_time'],		
				$user->id,
				$_POST['paciente_id']		
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