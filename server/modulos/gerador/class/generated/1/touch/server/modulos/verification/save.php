<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'verification';
	try {
		
		if($_POST['action'] == 'EDITAR'){
		
			$pdo = $connection->prepare("
					UPDATE verification SET 
							user_id = ?,							
							date_start = ?,							
							date_finish = ?							
 					WHERE id = ?
			");
			$params = array(
				$_POST['user_id'],
				implode('-', array_reverse(explode('/', $_POST['date_start_date'])))." ".$_POST['date_start_time'],
				implode('-', array_reverse(explode('/', $_POST['date_finish_date'])))." ".$_POST['date_finish_time'],
				$_POST['id']
			);
			$pdo->execute($params);
		}
		else if ($_POST['action'] == 'INSERIR'){
		
			$pdo = $connection->prepare("
				INSERT INTO verification 
					(
						user_id,						
						date_start,						
						date_finish						
					) 
				VALUES 
					(
						?,	?,	?			
					)
			");
			$params = array(
				$_POST['user_id'],		
				implode('-', array_reverse(explode('/', $_POST['date_start_date'])))." ".$_POST['date_start_time'],		
				implode('-', array_reverse(explode('/', $_POST['date_finish_date'])))." ".$_POST['date_finish_time']		
			);
			$pdo->execute($params);
		}
		else{
			throw new PDOException(utf8_encode(ACTION_NOT_FOUND));
		}
		echo json_encode(array('success'=>true, 'msg'=>SAVED_SUCCESS));
	}
	catch (PDOException $e) {
		echo json_encode(array('success'=>false, 'msg'=>ERROR_SAVE_DATA, 'erro'=>$e->getMessage()));
	}
}