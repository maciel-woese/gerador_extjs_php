<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'clientes_anotacoes';
	try {
		
		if($_POST['action'] == 'EDITAR'){
		
			$user->getAcao($tabela, 'editar');
		
			$pdo = $connection->prepare("
					UPDATE clientes_anotacoes SET 
							cod_cliente = ?,							
							anotacao = ?,							
							cadastrado_por = ?,							
							data_cadastro = ?,							
							ativo = ?							
 					WHERE controle = ?
			");
			$params = array(
				$_POST['cod_cliente'],
				$_POST['anotacao'],
				$_POST['cadastrado_por'],
				implode('-', array_reverse(explode('/', $_POST['data_cadastro_date'])))." ".$_POST['data_cadastro_time'],
				$_POST['ativo'],
				$_POST['controle']
			);
			$pdo->execute($params);
		}
		else if ($_POST['action'] == 'INSERIR'){
		
			$user->getAcao($tabela, 'adicionar');
		
			$pdo = $connection->prepare("
				INSERT INTO clientes_anotacoes 
					(
						cod_cliente,						
						anotacao,						
						cadastrado_por,						
						data_cadastro,						
						ativo						
					) 
				VALUES 
					(
						?,	?,	?,	?,	?			
					)
			");
			$params = array(
				$_POST['cod_cliente'],		
				$_POST['anotacao'],		
				$_POST['cadastrado_por'],		
				implode('-', array_reverse(explode('/', $_POST['data_cadastro_date'])))." ".$_POST['data_cadastro_time'],		
				$_POST['ativo']		
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