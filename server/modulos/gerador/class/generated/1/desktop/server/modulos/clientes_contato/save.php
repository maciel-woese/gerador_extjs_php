<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'clientes_contato';
	try {
		
		if($_POST['action'] == 'EDITAR'){
		
			$user->getAcao($tabela, 'editar');
		
			$pdo = $connection->prepare("
					UPDATE clientes_contato SET 
							cod_cliente = ?,							
							tipo_contato = ?,							
							descricao = ?,							
							observacao = ?							
 					WHERE controle = ?
			");
			$params = array(
				$_POST['cod_cliente'],
				$_POST['tipo_contato'],
				$_POST['descricao'],
				$_POST['observacao'],
				$_POST['controle']
			);
			$pdo->execute($params);
		}
		else if ($_POST['action'] == 'INSERIR'){
		
			$user->getAcao($tabela, 'adicionar');
		
			$pdo = $connection->prepare("
				INSERT INTO clientes_contato 
					(
						cod_cliente,						
						tipo_contato,						
						descricao,						
						observacao						
					) 
				VALUES 
					(
						?,	?,	?,	?			
					)
			");
			$params = array(
				$_POST['cod_cliente'],		
				$_POST['tipo_contato'],		
				$_POST['descricao'],		
				$_POST['observacao']		
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