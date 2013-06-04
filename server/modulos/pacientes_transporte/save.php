<?php
/**
*	@Autor: Maciel Sousa
*	@Email: macielcr7@gmail.com
**/

if($_POST){
	require('../../autoLoad.php');
	$tabela = 'pacientes_transporte';
	try {
		
		$connection->beginTransaction();
		
		if($_POST['action'] == 'EDITAR'){
		
			$pdo = $connection->prepare("
					UPDATE pacientes_transporte SET 
							paciente_id = ?,							
							acompanhado = ?,							
							local_consulta = ?,							
							espera = ?,							
							hora = ?,							
							fone = ?,							
							obs = ?							
 					WHERE id = ?
			");
			
			$params = array(
				$_POST['paciente_id'],
				$_POST['acompanhado'],
				$_POST['local_consulta'],
				$_POST['espera'],
				$_POST['hora'],
				$_POST['fone'],
				$_POST['obs'],
				$_POST['id']
			);
		}
		else if ($_POST['action'] == 'INSERIR'){
			$pdo = $connection->prepare("
				INSERT INTO pacientes_transporte 
					(
						paciente_id,						
						acompanhado,						
						local_consulta,						
						espera,						
						hora,						
						fone,						
						obs,				
						agendamento_transporte_id
					) 
				VALUES 
					(
						?,	?,	?,	?,	?,	?,	?,	?
					)
			");
			$params = array(
				$_POST['paciente_id'],
				$_POST['acompanhado'],
				$_POST['local_consulta'],
				$_POST['espera'],
				$_POST['hora'],
				$_POST['fone'],
				$_POST['obs'],
				$_POST['agendamento_transporte_id']		
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