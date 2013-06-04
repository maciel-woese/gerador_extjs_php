<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'consulta';
	try {
		
		if($_POST['action'] == 'BAIXA_CONSULTA'){
			$user->getAcao($tabela, 'editar');
		
			$pdo = $connection->prepare("
					UPDATE consulta SET 
						faltou = ?,
						queixa_principal = ?,
						exame_fisico = ?,
						hipotese_diagnostica = ?,
						tratamento = ?
 					WHERE id = ?
			");
			$params = array(
				$_POST['faltou'],
				$_POST['queixa_principal'],
				$_POST['exame_fisico'],
				$_POST['hipotese_diagnostica'],
				$_POST['tratamento'],
				$_POST['id']
			);
			$pdo->execute($params);
			$senha = "";
		}
		else if($_POST['action'] == 'EDITAR'){
		
			$user->getAcao($tabela, 'editar');
		
			$pdo = $connection->prepare("
					UPDATE consulta SET 
							data_hora = ?,							
							medico_id = ?,							
							paciente_id = ?
 					WHERE id = ?
			");
			$params = array(
				implode('-', array_reverse(explode('/', $_POST['data_hora_date'])))." ".$_POST['data_hora_time'],
				$_POST['medico_id'],
				$_POST['paciente_id'],
				$_POST['id']
			);
			$pdo->execute($params);
			$senha = "";
		}
		else if ($_POST['action'] == 'INSERIR'){
			$user->getAcao($tabela, 'adicionar');
			
			$pdo = $connection->prepare("
				SELECT IF(MAX(senha)IS NULL,1, senha+1) as senha
				FROM consulta
				WHERE DATE_FORMAT(data_hora, '%Y-%m-%d') = DATE_FORMAT(?, '%Y-%m-%d') AND 
				filial_id = '{$user->filial_id}'
			");
			$params = array(
				implode('-', array_reverse(explode('/', $_POST['data_hora_date'])))
			);
			
			$pdo->execute($params);
			$senha = $pdo->fetch(PDO::FETCH_OBJ);
			
			$pdo = $connection->prepare("
				INSERT INTO consulta 
					(
						data_hora,						
						medico_id,						
						paciente_id,						
						senha,
						filial_id
					) 
				VALUES 
					(
						?,	?,	?,	?, {$user->filial_id}
					)
			");
			$params = array(
				implode('-', array_reverse(explode('/', $_POST['data_hora_date'])))." ".$_POST['data_hora_time'],		
				$_POST['medico_id'],		
				$_POST['paciente_id'],		
				$senha->senha
			);
			$pdo->execute($params);
			$senha = $senha->senha;
		}
		else{
			throw new PDOException(utf8_encode(ACTION_NOT_FOUND));
		}
		
		echo json_encode(array('success'=>true, 'msg'=>SAVED_SUCCESS, 'senha'=>$senha));
	}
	catch (PDOException $e) {
		echo json_encode(array('success'=>false, 'msg'=>ERROR_SAVE_DATA, 'erro'=>$e->getMessage()));
	}
}