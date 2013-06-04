<?php
if($_POST){
	require('../../autoLoad.php');
	$tabela = 'grupo';
	try {
		$connection->beginTransaction();
		
		$pdo = $connection->prepare("DELETE FROM grupo WHERE id = :id");
		$pdo->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
		$pdo->execute();
		
		$connection->commit();
		
		echo json_encode(array('success'=>true, 'msg'=>'Removido com sucesso'));
	}
	catch (PDOException $e) {
		$connection->rollBack();
		echo json_encode(array('success'=>false, 'msg'=>$e->getMessage()));
	}
}