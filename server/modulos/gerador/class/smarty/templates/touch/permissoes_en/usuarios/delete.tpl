<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'usuarios';
	try {
		$connection->beginTransaction();
		
		$pdo = $connection->prepare("DELETE FROM usuarios WHERE id = ?");
		$pdo->execute(array(
			$_POST['id']
		));
		
		$connection->commit();
		echo json_encode(array('success'=>true, 'msg'=>'Removed Successfully'));
	}
	catch (PDOException $e) {
		$connection->rollBack();
		echo json_encode(array('success'=>false, 'msg'=>'Error Deleting Data!', 'erro'=>$e->getMessage()));
	}
}

?>