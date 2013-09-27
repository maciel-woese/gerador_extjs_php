<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'correios_bairros';
	try {
		
		if($_POST['action'] == 'EDITAR'){
		
			$user->getAcao($tabela, 'editar');
		
			$pdo = $connection->prepare("
					UPDATE correios_bairros SET 
							uf_sigla = ?,							
							localidade_id = ?,							
							bairro_nome = ?,							
							bairro_nome_abreviado = ?,							
							ativo = ?,							
							cadastrado_por = ?,							
							data_cadastro = ?							
 					WHERE id = ?
			");
			$params = array(
				$_POST['uf_sigla'],
				$_POST['localidade_id'],
				$_POST['bairro_nome'],
				$_POST['bairro_nome_abreviado'],
				$_POST['ativo'],
				$_POST['cadastrado_por'],
				implode('-', array_reverse(explode('/', $_POST['data_cadastro_date'])))." ".$_POST['data_cadastro_time'],
				$_POST['id']
			);
			$pdo->execute($params);
		}
		else if ($_POST['action'] == 'INSERIR'){
		
			$user->getAcao($tabela, 'adicionar');
		
			$pdo = $connection->prepare("
				INSERT INTO correios_bairros 
					(
						uf_sigla,						
						localidade_id,						
						bairro_nome,						
						bairro_nome_abreviado,						
						ativo,						
						cadastrado_por,						
						data_cadastro						
					) 
				VALUES 
					(
						?,	?,	?,	?,	?,	?,	?			
					)
			");
			$params = array(
				$_POST['uf_sigla'],		
				$_POST['localidade_id'],		
				$_POST['bairro_nome'],		
				$_POST['bairro_nome_abreviado'],		
				$_POST['ativo'],		
				$_POST['cadastrado_por'],		
				implode('-', array_reverse(explode('/', $_POST['data_cadastro_date'])))." ".$_POST['data_cadastro_time']		
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