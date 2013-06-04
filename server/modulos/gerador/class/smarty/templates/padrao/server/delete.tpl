<?php
{if $autor == true}
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/
{/if}

if($_POST){
	require('../../autoLoad.php');
	$tabela = '{$TABELA}';
	try {
		if($_POST['action'] == 'DELETAR'){
{if $permissoes == 'sim'}		
			$user->getAcao($tabela, 'deletar');
{/if}		
			$pdo = $connection->prepare("DELETE FROM {$TABELA} WHERE {$CHAVE} = ?");
			$pdo->execute(array(
				$_POST['id']
			));
			
			echo json_encode(array('success'=>true, 'msg'=>REMOVED_SUCCESS));
		}
		else{
			throw new PDOException(utf8_encode(ACTION_NOT_FOUND));
		}
	}
	catch (PDOException $e) {
		echo json_encode(array('success'=>false, 'msg'=>ERRO_DELETE_DATA, 'erro'=>$e->getMessage()));
	}
}