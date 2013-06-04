<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'pacientes';
	try {
		
		$connection->beginTransaction();
		
		if($_POST['action'] == 'EDITAR'){
		
			$user->getAcao($tabela, 'editar');
		
			$pdo = $connection->prepare("
					UPDATE pacientes SET 
							paciente = ?,							
							data_nascimento = ?,							
							sexo = ?,							
							tipo_sanguineo = ?,							
							rg = ?,							
							cpf = ?,							
							uf_id = ?,							
							cidade_id = ?,							
							bairro = ?,							
							endereco = ?,							
							cep = ?,							
							trabalho = ?,							
							telefone = ?,							
							pai = ?,							
							mae = ?,							
							obs = ?,							
							status = ?							
 					WHERE id = ?
			");
			$params = array(
				$_POST['paciente'],
				implode('-', array_reverse(explode('/', $_POST['data_nascimento']))),
				$_POST['sexo'],
				$_POST['tipo_sanguineo'],
				$_POST['rg'],
				$_POST['cpf'],
				$_POST['uf_id'],
				$_POST['cidade_id'],
				$_POST['bairro'],
				$_POST['endereco'],
				$_POST['cep'],
				$_POST['trabalho'],
				$_POST['telefone'],
				$_POST['pai'],
				$_POST['mae'],
				$_POST['obs'],
				$_POST['status'],
				$_POST['id']
			);
		}
		else if ($_POST['action'] == 'INSERIR'){
		
			$user->getAcao($tabela, 'adicionar');
		
			$pdo = $connection->prepare("
				INSERT INTO pacientes 
					(
						data_cadastro,						
						paciente,						
						data_nascimento,						
						sexo,						
						tipo_sanguineo,						
						rg,						
						cpf,						
						uf_id,						
						cidade_id,						
						bairro,						
						endereco,						
						cep,						
						trabalho,						
						telefone,						
						pai,						
						mae,						
						obs,						
						status						
					) 
				VALUES 
					(
						NOW(),	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?			
					)
			");
			$params = array(
				$_POST['paciente'],		
				implode('-', array_reverse(explode('/', $_POST['data_nascimento']))),		
				$_POST['sexo'],		
				$_POST['tipo_sanguineo'],		
				$_POST['rg'],		
				$_POST['cpf'],		
				$_POST['uf_id'],		
				$_POST['cidade_id'],		
				$_POST['bairro'],		
				$_POST['endereco'],		
				$_POST['cep'],		
				$_POST['trabalho'],		
				$_POST['telefone'],		
				$_POST['pai'],		
				$_POST['mae'],		
				$_POST['obs'],		
				$_POST['status']		
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