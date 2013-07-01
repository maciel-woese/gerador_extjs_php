<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'usuarios';
	try {
		
		$connection->beginTransaction();
		
		if($_POST['action'] == 'EDITAR'){
		
			$pdo = $connection->prepare("
					UPDATE usuarios SET 
							nome = ?,							
							data_cadastro = ?,							
							email = ?,							
							login = ?,							
							id_grupo = ?,							
							status = ?,							
							exportar = ?							
 					WHERE id = ?
			");
			$params = array(
				$_POST['nome'],
				implode('-', array_reverse(explode('/', $_POST['data_cadastro']))),
				$_POST['email'],
				$_POST['login'],
				$_POST['id_grupo'],
				$_POST['status'],
				$_POST['exportar'],
				$_POST['id']
			);
		}
		else if ($_POST['action'] == 'INSERIR'){
		
			$pdo = $connection->prepare("
				INSERT INTO usuarios 
					(
						nome,						
						data_cadastro,						
						email,						
						login,						
						id_grupo,						
						status,						
						exportar						
					) 
				VALUES 
					(
						?,	?,	?,	?,	?,	?,	?			
					)
			");
			$params = array(
				$_POST['nome'],		
				implode('-', array_reverse(explode('/', $_POST['data_cadastro']))),		
				$_POST['email'],		
				$_POST['login'],		
				$_POST['id_grupo'],		
				$_POST['status'],		
				$_POST['exportar']		
			);
		}
		else if ($_POST['action'] == 'EXPORTAR'){
			$pdo = $connection->prepare("
				UPDATE usuarios SET 
					exportar = ?							
				WHERE id = ?
			");
			$params = array(
				$_POST['exportar'],
				$_POST['usuario_id']
			);
		}
		else if ($_POST['action'] == 'STATUS'){
			$pdo = $connection->prepare("
				UPDATE usuarios SET 
					status = ?							
				WHERE id = ?
			");
			$params = array(
				$_POST['status'],
				$_POST['usuario_id']
			);
		}
		else{
			throw new PDOException(utf8_encode("Nenhuma Ação Encontrada..."));
		}
		
		$pdo->execute($params);
		
		$connection->commit();
		echo json_encode(array('success'=>true, 'msg'=>'Registro Salvo com Sucesso'));
	}
	catch (PDOException $e) {
		$connection->rollBack();
		echo json_encode(array('success'=>false, 'msg'=>$e->getMessage()));
	}
}