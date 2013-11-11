<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'clientes_endereco';
	try {
		
		if($_POST['action'] == 'EDITAR'){
		
			$user->getAcao($tabela, 'editar');
		
			$pdo = $connection->prepare("
					UPDATE clientes_endereco SET 
							cod_cliente = ?,							
							estado = ?,							
							cidade = ?,							
							bairro = ?,							
							logradouro = ?,							
							num_end = ?,							
							complemento = ?,							
							cep = ?,							
							cx_postal = ?							
 					WHERE controle = ?
			");
			$params = array(
				$_POST['cod_cliente'],
				$_POST['estado'],
				$_POST['cidade'],
				$_POST['bairro'],
				$_POST['logradouro'],
				$_POST['num_end'],
				$_POST['complemento'],
				$_POST['cep'],
				$_POST['cx_postal'],
				$_POST['controle']
			);
			$pdo->execute($params);
		}
		else if ($_POST['action'] == 'INSERIR'){
		
			$user->getAcao($tabela, 'adicionar');
		
			$pdo = $connection->prepare("
				INSERT INTO clientes_endereco 
					(
						cod_cliente,						
						estado,						
						cidade,						
						bairro,						
						logradouro,						
						num_end,						
						complemento,						
						cep,						
						cx_postal						
					) 
				VALUES 
					(
						?,	?,	?,	?,	?,	?,	?,	?,	?			
					)
			");
			$params = array(
				$_POST['cod_cliente'],		
				$_POST['estado'],		
				$_POST['cidade'],		
				$_POST['bairro'],		
				$_POST['logradouro'],		
				$_POST['num_end'],		
				$_POST['complemento'],		
				$_POST['cep'],		
				$_POST['cx_postal']		
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