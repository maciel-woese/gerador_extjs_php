<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'medico';
	try {
		
		$connection->beginTransaction();
		
		if($_POST['action'] == 'EDITAR'){
		
			$user->getAcao($tabela, 'editar');
		
			$pdo = $connection->prepare("
					UPDATE medico SET 
							medico = ?,							
							crm = ?,							
							especialidade_id = ?,							
							uf_id = ?,							
							cidade_id = ?,							
							bairro = ?,							
							endereco = ?,							
							cep = ?,							
							telefone = ?							
 					WHERE id = ?
			");
			$params = array(
				$_POST['medico'],
				$_POST['crm'],
				$_POST['especialidade_id'],
				$_POST['uf_id'],
				$_POST['cidade_id'],
				$_POST['bairro'],
				$_POST['endereco'],
				$_POST['cep'],
				$_POST['telefone'],
				$_POST['id']
			);
		}
		else if ($_POST['action'] == 'INSERIR'){
		
			$user->getAcao($tabela, 'adicionar');
		
			$pdo = $connection->prepare("
				INSERT INTO medico 
					(
						medico,						
						crm,						
						especialidade_id,						
						uf_id,						
						cidade_id,						
						bairro,						
						endereco,						
						cep,						
						telefone,
						filial_id						
					) 
				VALUES 
					(
						?,	?,	?,	?,	?,	?,	?,	?,	?, {$user->filial_id}
					)
			");
			$params = array(
				$_POST['medico'],		
				$_POST['crm'],		
				$_POST['especialidade_id'],		
				$_POST['uf_id'],		
				$_POST['cidade_id'],		
				$_POST['bairro'],		
				$_POST['endereco'],		
				$_POST['cep'],		
				$_POST['telefone']		
			);
		}
		else{
			throw new PDOException(utf8_encode(ACTION_NOT_FOUND));
		}
		
		$pdo->execute($params);
				
		$connection->commit();
		echo json_encode(array('success'=>true, 'msg'=>SAVED_SUCCESS));
	}
	catch (PDOException $e) {
		$connection->rollBack();
		echo json_encode(array('success'=>false, 'msg'=>ERROR_SAVE_DATA, 'erro'=>$e->getMessage()));
	}
}