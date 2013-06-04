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
		
		if($_POST['action'] == 'EDITAR'){
		
			$user->getAcao($tabela, 'editar');
		
			$pdo = $connection->prepare("
					UPDATE filial SET 
							filial = ?,							
							uf_id = ?,							
							cidade_id = ?,							
							bairro = ?,							
							endereco = ?,							
							cep = ?,							
							telefone = ?							
 					WHERE id = ?
			");
			$params = array(
				$_POST['filial'],
				$_POST['uf_id'],
				$_POST['cidade_id'],
				$_POST['bairro'],
				$_POST['endereco'],
				$_POST['cep'],
				$_POST['telefone'],
				$_POST['id']
			);
			$pdo->execute($params);
		}
		else if ($_POST['action'] == 'INSERIR'){
		
			$user->getAcao($tabela, 'adicionar');
		
			$pdo = $connection->prepare("
				INSERT INTO filial 
					(
						filial,						
						uf_id,						
						cidade_id,						
						bairro,						
						endereco,						
						cep,						
						telefone
					) 
				VALUES 
					(
						?,	?,	?,	?,	?,	?,	?
					)
			");
			
			$params = array(
				$_POST['filial'],		
				$_POST['uf_id'],		
				$_POST['cidade_id'],		
				$_POST['bairro'],		
				$_POST['endereco'],		
				$_POST['cep'],		
				$_POST['telefone']		
			);
			
			$pdo->execute($params);
			
			$pdo = $connection->prepare("
				SELECT id FROM filial ORDER BY id DESC LIMIT 1
			");
			
			$pdo->execute();
			$filial = $pdo->fetch(PDO::FETCH_OBJ);
			
			$pdo = $connection->prepare("
				INSERT INTO usuarios 
					(
						nome,						
						perfil_id,						
						email,						
						login,						
						senha,						
						administrador,						
						status,
						filial_id
					) 
				VALUES 
					(
						?,	1,	?,	?,	?,	'2',  '1', ?
					)
			");
			
			$params = array(
				$_POST['filial'],		
				$_POST['email'],		
				$_POST['login'],		
				md5($_POST['senha']),
				$filial->id
			);
			
			$pdo->execute($params);
		}
		else{
			die(json_encode(array(
				'success'=>false, 
				'msg'=>utf8_encode(ACTION_NOT_FOUND)
			)));
		}
		
		echo json_encode(array('success'=>true, 'msg'=>SAVED_SUCCESS));
	}
	catch (PDOException $e) {

		echo json_encode(array('success'=>false, 'msg'=>ERROR_SAVE_DATA, 'erro'=>$e->getMessage()));
	}
}