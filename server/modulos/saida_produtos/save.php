<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'saida_produtos';
	try {
		if($_POST['action'] == 'EDITAR'){
			$pdo = $connection->prepare("
				SELECT (m.quantidade + e.quantidade) as quantidade 
				FROM medicamento as m
				INNER JOIN saida_produtos as e ON (m.id=e.medicamento_id)
				WHERE e.id = ? AND e.medicamento_id = ?
			");
			
			$pdo->execute(array(
				$_POST['id'],
				$_POST['medicamento_id']
			));

			$query = $pdo->fetch(PDO::FETCH_OBJ);
			if($pdo->rowCount()==0){
				die(json_encode(array(
					'success'=>false, 
					'msg'=>utf8_encode("Medicamento Não Encontrado!")
				)));
			}
			$quantidade = ((int) $query->quantidade - (int) $_POST['quantidade']);
		
			$pdo = $connection->prepare("
					UPDATE saida_produtos SET 
							saida_id = ?,							
							medicamento_id = ?,							
							quantidade = ?							
 					WHERE id = ?
			");
			$params = array(
				$_POST['saida_id'],
				$_POST['medicamento_id'],
				$_POST['quantidade'],
				$_POST['id']
			);
			$pdo->execute($params);
		}
		else if ($_POST['action'] == 'INSERIR'){
			$pdo = $connection->prepare("
				SELECT count(*) as total
				FROM saida_produtos as e 
				WHERE e.saida_id = ? AND e.medicamento_id = ?
			");
			
			$pdo->execute(array(
				$_POST['saida_id'],
				$_POST['medicamento_id']
			));
			$query = $pdo->fetch(PDO::FETCH_OBJ);
			
			if($query->total>0){
				die(json_encode(array(
					'success'=>false, 
					'msg'=>utf8_encode("Este Medicamento Já Existe na Lista")
				)));
			}
			
			$pdo = $connection->prepare("
				INSERT INTO saida_produtos 
					(
						saida_id,						
						medicamento_id,						
						quantidade						
					) 
				VALUES 
					(
						?,	?,	?			
					)
			");
			$params = array(
				$_POST['saida_id'],		
				$_POST['medicamento_id'],
				$_POST['quantidade']		
			);
			$pdo->execute($params);
			
			
			$pdo = $connection->prepare("
				UPDATE medicamento SET 
					quantidade = quantidade - ? 
				WHERE id = ?
			");
			
			$pdo->execute(array(
				(int) $_POST['quantidade'],
				$_POST['medicamento_id']
			));
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