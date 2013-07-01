<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'usuarios';
	try {
		$pdo = $connection->prepare("DELETE FROM usuarios WHERE id = ?");
		$pdo->execute(array(
			$_POST['id']
		));
		echo json_encode(array('success'=>true, 'msg'=>'Removido com sucesso'));
	}
	catch (PDOException $e) {
		echo json_encode(array('success'=>false, 'msg'=>'Erro ao apagar dados!', 'erro'=>$e->getMessage()));
	}
}