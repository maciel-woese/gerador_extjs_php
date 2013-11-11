<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'clientes';
	try {
		
		if($_POST['action'] == 'EDITAR'){
		
			$user->getAcao($tabela, 'editar');
		
			$pdo = $connection->prepare("
					UPDATE clientes SET 
							tipo_cliente = ?,							
							nome_completo = ?,							
							razao_social = ?,							
							nome_fantasia = ?,							
							pessoa_contato = ?,							
							data_nascimento = ?,							
							sexo = ?,							
							cpf = ?,							
							cnpj = ?,							
							ie = ?,							
							im = ?,							
							identidade = ?,							
							profissao = ?,							
							data_cadastro = ?,							
							cadastrado_por = ?,							
							data_alteracao = ?,							
							situacao_cadastral = ?							
 					WHERE cod_cliente = ?
			");
			$params = array(
				$_POST['tipo_cliente'],
				$_POST['nome_completo'],
				$_POST['razao_social'],
				$_POST['nome_fantasia'],
				$_POST['pessoa_contato'],
				implode('-', array_reverse(explode('/', $_POST['data_nascimento']))),
				$_POST['sexo'],
				$_POST['cpf'],
				$_POST['cnpj'],
				$_POST['ie'],
				$_POST['im'],
				$_POST['identidade'],
				$_POST['profissao'],
				implode('-', array_reverse(explode('/', $_POST['data_cadastro_date'])))." ".$_POST['data_cadastro_time'],
				$_POST['cadastrado_por'],
				implode('-', array_reverse(explode('/', $_POST['data_alteracao_date'])))." ".$_POST['data_alteracao_time'],
				$_POST['situacao_cadastral'],
				$_POST['cod_cliente']
			);
			$pdo->execute($params);
		}
		else if ($_POST['action'] == 'INSERIR'){
		
			$user->getAcao($tabela, 'adicionar');
		
			$pdo = $connection->prepare("
				INSERT INTO clientes 
					(
						tipo_cliente,						
						nome_completo,						
						razao_social,						
						nome_fantasia,						
						pessoa_contato,						
						data_nascimento,						
						sexo,						
						cpf,						
						cnpj,						
						ie,						
						im,						
						identidade,						
						profissao,						
						data_cadastro,						
						cadastrado_por,						
						data_alteracao,						
						situacao_cadastral						
					) 
				VALUES 
					(
						?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?,	?			
					)
			");
			$params = array(
				$_POST['tipo_cliente'],		
				$_POST['nome_completo'],		
				$_POST['razao_social'],		
				$_POST['nome_fantasia'],		
				$_POST['pessoa_contato'],		
				implode('-', array_reverse(explode('/', $_POST['data_nascimento']))),		
				$_POST['sexo'],		
				$_POST['cpf'],		
				$_POST['cnpj'],		
				$_POST['ie'],		
				$_POST['im'],		
				$_POST['identidade'],		
				$_POST['profissao'],		
				implode('-', array_reverse(explode('/', $_POST['data_cadastro_date'])))." ".$_POST['data_cadastro_time'],		
				$_POST['cadastrado_por'],		
				implode('-', array_reverse(explode('/', $_POST['data_alteracao_date'])))." ".$_POST['data_alteracao_time'],		
				$_POST['situacao_cadastral']		
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