<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'entrada_produtos';
	try {
		$pdo = $connection->prepare("DELETE FROM entrada_produtos WHERE id = ?");
		$pdo->execute(array(
			$_POST['id']
		));
		
		$pdo = $connection->prepare("
			UPDATE medicamento SET 
				quantidade = quantidade - ? 
			WHERE id = ?
		");
		
		$pdo->execute(array(
			(int) $_POST['quantidade'],
			$_POST['medicamento_id']
		));
		
		echo json_encode(array('success'=>true, 'msg'=>REMOVED_SUCCESS));
	}
	catch (PDOException $e) {
		echo json_encode(array('success'=>false, 'msg'=>ERRO_DELETE_DATA, 'erro'=>$e->getMessage()));
	}
}