<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'product';
	try {
		
		if($_POST['action'] == 'EDITAR'){
		
			$pdo = $connection->prepare("
					UPDATE product SET 
							code = ?,							
							product = ?,							
							quantity = ?							
 					WHERE id = ?
			");
			$params = array(
				$_POST['code'],
				$_POST['product'],
				$_POST['quantity'],
				$_POST['id']
			);
			$pdo->execute($params);
		}
		else if ($_POST['action'] == 'INSERIR'){
		
			$pdo = $connection->prepare("
				INSERT INTO product 
					(
						code,						
						product,						
						quantity						
					) 
				VALUES 
					(
						?,	?,	?			
					)
			");
			$params = array(
				$_POST['code'],		
				$_POST['product'],		
				$_POST['quantity']		
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