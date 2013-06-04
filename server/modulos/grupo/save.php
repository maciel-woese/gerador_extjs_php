<?php
if($_POST){
	require('../../autoLoad.php');
	$tabela = 'grupo';
	try {
		
		$connection->beginTransaction();
		
		if($_POST['action'] == 'EDITAR'){
			$pdo = $connection->prepare("
					UPDATE grupo SET 
							grupo = :grupo							
 					WHERE id = :id
			");
			
			$pdo->bindParam(':grupo', $_POST['grupo'], PDO::PARAM_STR);
			$pdo->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
			
		}
		else if ($_POST['action'] == 'INSERIR'){
			$pdo = $connection->prepare("
				INSERT INTO grupo 
					(grupo) 
				VALUES 
					(:grupo)
			");
		}
		
		$pdo->bindParam(':grupo', $_POST['grupo']);
		
		$pdo->execute();
		
		$connection->commit();
		echo json_encode(array('success'=>true, 'msg'=>'salvo com sucesso'));
	}
	catch (PDOException $e) {
		$connection->rollBack();
		echo json_encode(array('success'=>false, 'msg'=>$e->getMessage()));
	}
}