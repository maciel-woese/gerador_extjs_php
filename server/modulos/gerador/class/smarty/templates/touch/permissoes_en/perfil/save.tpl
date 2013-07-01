<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'perfil';
	try {
		
		$connection->beginTransaction();
		
		if($_POST['action'] == 'EDITAR'){
		
			$pdo = $connection->prepare("
					UPDATE perfil SET 
							perfil = ?							
 					WHERE id = ?
			");
			$params = array(
				$_POST['perfil'],
				$_POST['id']
			);
		}
		else if ($_POST['action'] == 'INSERIR'){
		
			$pdo = $connection->prepare("
				INSERT INTO perfil 
					(
						perfil						
					) 
				VALUES 
					(
						?			
					)
			");
			$params = array(
				$_POST['perfil']		
			);
		}
		
		$pdo->execute($params);
				
		$connection->commit();
		echo json_encode(array('success'=>true, 'msg'=>'Saved Successfully'));
	}
	catch (PDOException $e) {
		$connection->rollBack();
		echo json_encode(array('success'=>false, 'msg'=>'Error Saving Data!', 'erro'=>$e->getMessage()));
	}
}