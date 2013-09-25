<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'verification_products';
	try {
		
		if($_POST['action'] == 'EDITAR'){
		
			$pdo = $connection->prepare("
					UPDATE verification_products SET 
							verification_id = ?,							
							product_id = ?,							
							quantity1 = ?,							
							quantity2 = ?,							
							quantity_finish = ?							
 					WHERE id = ?
			");
			$params = array(
				$_POST['verification_id'],
				$_POST['product_id'],
				$_POST['quantity1'],
				$_POST['quantity2'],
				$_POST['quantity_finish'],
				$_POST['id']
			);
			$pdo->execute($params);
		}
		else if ($_POST['action'] == 'INSERIR'){
		
			$pdo = $connection->prepare("
				INSERT INTO verification_products 
					(
						verification_id,						
						product_id,						
						quantity1,						
						quantity2,						
						quantity_finish						
					) 
				VALUES 
					(
						?,	?,	?,	?,	?			
					)
			");
			$params = array(
				$_POST['verification_id'],		
				$_POST['product_id'],		
				$_POST['quantity1'],		
				$_POST['quantity2'],		
				$_POST['quantity_finish']		
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