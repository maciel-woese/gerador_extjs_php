<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'usuarios';
	try {
		if(isset($_POST['perfil_id'])){
			$perfil_id = $_POST['perfil_id'];
		}
		else{
			$perfil_id = 2;
		}
		
		if($_POST['action'] == 'EDITAR'){
			$pdo = $connection->prepare("
					UPDATE usuarios SET 
							nome = ?,							
							perfil_id = ?,							
							email = ?,							
							login = ?,									
							status = ?							
 					WHERE id = ?
			");
			$params = array(
				$_POST['nome'],
				$perfil_id,
				$_POST['email'],
				$_POST['login'],
				$_POST['status'],
				$_POST['id']
			);
			$pdo->execute($params);
		}
		else if ($_POST['action'] == 'INSERIR'){
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
						?,	?,	?,	?,	?,	'2',  ?,  ?
					)
			");
			
			$params = array(
				$_POST['nome'],		
				$perfil_id,
				$_POST['email'],		
				$_POST['login'],		
				md5($_POST['senha']),		
				$_POST['status'],		
				$user->filial_id
			);
			$pdo->execute($params);
		}
		else if ($_POST['action'] == 'ALTERAR_SENHA'){
			$pdo = $connection->prepare("
					SELECT * FROM usuarios 
 					WHERE id = ? AND senha = ?
			");
			$params = array(
				$_POST['id'],
				md5($_POST['senha2'])
			);
			$pdo->execute($params);
			if($pdo->rowCount()>0){
				$pdo = $connection->prepare("
						UPDATE usuarios SET 
							senha = ?
						WHERE id = ?
				");
				$params = array(
					md5($_POST['senha2']),
					$_POST['id']
				);
				$pdo->execute($params);
			}
			else{
				die(json_encode(array(
					'success'=>false, 
					'msg'=>utf8_encode("Senha Atual Não Confere...")
				)));
			}
		}
		else{
			die(json_encode(array(
				'success'=>false, 
				'msg'=>utf8_encode("Ação Não Encontrada...")
			)));
		}
		
		echo json_encode(array('success'=>true, 'msg'=>'Registro Salvo com Sucesso'));
	}
	catch (PDOException $e) {
		echo json_encode(array('success'=>false, 'msg'=>'Erro ao salvar dados!', 'erro'=>$e->getMessage()));
	}
}