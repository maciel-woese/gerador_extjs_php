<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'filial';
	try {
		
		if(($user->filial_id_admin!=1) and ($user->administrador!=true)){
			die(json_encode(array(
				'success'	=> false,
				'msg'		=> utf8_encode("Permissões Insuficientes!"),
				'dados'		=> array()
			)));
		}
		
		$pdo = $connection->prepare("DELETE FROM filial WHERE id = ?");
		$pdo->execute(array(
			$_POST['id']
		));
		
		echo json_encode(array('success'=>true, 'msg'=>REMOVED_SUCCESS));
	}
	catch (PDOException $e) {
		echo json_encode(array('success'=>false, 'msg'=>ERRO_DELETE_DATA, 'erro'=>$e->getMessage()));
	}
}