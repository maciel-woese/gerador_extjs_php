<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'entrada_medicamento';
	try {
		
		$user->getAcao($tabela, 'deletar');
		
		$pdo = $connection->prepare("DELETE FROM entrada_medicamento WHERE id = ?");
		$pdo->execute(array(
			$_POST['id']
		));
		
		echo json_encode(array('success'=>true, 'msg'=>REMOVED_SUCCESS));
	}
	catch (PDOException $e) {
		echo json_encode(array('success'=>false, 'msg'=>ERRO_DELETE_DATA, 'erro'=>$e->getMessage()));
	}
}